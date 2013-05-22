<?php
class GlobalActivityWidget extends WP_Widget
{
    protected $data;

    private $fields = array(
        'title'          => 'Title (optional)',
        'length'          => 'Number of items',
        'github'          => 'Github username',
        'codepen'          => 'Codepen username',
        'deviant-art'          => 'DeviantArt username',
    );
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'widget-global-activity',
            'description' => __('Use this widget to add a list of recent projects', 'melindrea'),
        );

        add_action('save_post', array(&$this, 'flush_widget_cache'));
        add_action('deleted_post', array(&$this, 'flush_widget_cache'));
        add_action('switch_theme', array(&$this, 'flush_widget_cache'));

        $this->WP_Widget('widget-global-activity', __('Global Activity', 'melindrea'),
            $widget_ops);
        $this->alt_option_name = 'widget-global-activity';
    }

    public function flush_widget_cache() {
        wp_cache_delete('widget-global-activity', 'widget');
        delete_transient('widget-global-activity');
    }

    public function update($new_instance, $old_instance) {
        $instance = array_map('strip_tags', $new_instance);

        $this->flush_widget_cache();

        $alloptions = wp_cache_get('alloptions', 'options');

        if (isset($alloptions['widget-global-activity'])) {
            delete_option('widget-global-activity');
        }

        return $instance;
    }

    public function widget($args, $instance)
    {
        $cache = wp_cache_get('widget_roots_vcard', 'widget');

        if (!is_array($cache)) {
            $cache = array();
        }

        if (!isset($args['widget_id'])) {
            $args['widget_id'] = null;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();
        extract($args, EXTR_SKIP);

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);


        //Get any existing copy of our transient data
        if (false === ($arr = get_transient('widget-global-activity'))) {
            $arr = $this->recentPostsAndLinks();

            if ( ! empty($instance['github'])) {
                $user = $instance['github'];
                $github = Feed::factory('Github')->setUser($user);
                $arr = array_merge($arr, $github->getPublicRepositories(),
                    $github->getPublicGists());
            }

            if ( ! empty($instance['codepen'])) {
                $user = $instance['codepen'];
                $codepen = Feed::factory('Codepen')->setUser($user);
                $arr = array_merge($arr, $codepen->getPublicPens());
            }

            if ( ! empty($instance['deviant-art'])) {
                 $user = $instance['deviant-art'];
                 $deviantArt = Feed::factory('DeviantArt')->setUser($user);
                 $arr = array_merge($arr, $deviantArt->getDeviations());
            }
            usort($arr, 'Feed::sort');

            set_transient('widget-global-activity', $arr, 2*HOUR_IN_SECONDS);
        }

        $this->data = $arr;
        echo $before_widget;

        if ($title) {
            echo $before_title, $title, $after_title;
        }
        $length = empty($instance['length']) ? 10 : $instance['length'];
        $this->renderWidget($length);
        echo $after_widget;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_roots_vcard', $cache, 'widget');
    }

    public function renderWidget($length = 10)
    {
        $data = $this->data;
        array_splice($data, $length);
        $view = View::factory('global-activity-list')
        ->bind('items', $data)
        ->render();
    }

    protected function recentPostsAndLinks()
    {
        $args = array(
            'numberposts' => 20,
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-status',
                    'operator' => 'NOT IN',
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-aside',
                    'operator' => 'NOT IN',
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-gallery',
                    'operator' => 'NOT IN',
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-video',
                    'operator' => 'NOT IN',
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-audio',
                    'operator' => 'NOT IN',
                ),
                array(
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => 'post-format-chat',
                    'operator' => 'NOT IN',
                ),
            ),
        );
        $recentPosts = wp_get_recent_posts($args);

        $posts = array();
        if (count($recentPosts) > 0) {
            foreach ($recentPosts as $post) {
                $temp = array();
                $temp['name'] = $post['post_title'];
                $temp['description'] = $post['post_excerpt'];
                $temp['link'] = get_permalink($post['ID']);
                $temp['date'] = max($post['post_modified'], $post['post_date']);
                $format = get_post_format($post['ID']);
                if ($format === false) {
                    $format = 'post';
                }
                $temp['icon'] = 'entypo-'.$format;
                $posts[] = $temp;
            }
        }
        return $posts;
    }

    public function form($instance) {
        foreach($this->fields as $name => $label) {
            ${$name} = isset($instance[$name]) ? esc_attr($instance[$name]) : '';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id($name)); ?>">
                    <?php printf(__('%s', 'roots'), $label); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id($name)); ?>" name="<?php echo esc_attr($this->get_field_name($name)); ?>" type="text" value="<?php echo ${$name}; ?>">
            </p>
            <?php
        }
    }
}
