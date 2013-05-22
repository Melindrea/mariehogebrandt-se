<?php
class GlobalActivityWidget extends WP_Widget
{
    protected $data;
    public function __construct()
    {
        //Get any existing copy of our transient data
        if (false === ($arr = get_transient('global-activity'))) {
            $user = 'Melindrea';
            $github = Feed::factory('Github')->setUser($user);
            $codepen = Feed::factory('Codepen')->setUser($user);
            $arr = array_merge($github->getPublicRepositories(),
                $github->getPublicGists(),
                $codepen->getPublicPens(),
                $this->recentPostsAndLinks());
            usort($arr, 'Feed::sort');

            set_transient('global-activity', $arr, 2*HOUR_IN_SECONDS);
        }

        $this->data = $arr;
    }

    public function render()
    {
        $data = $this->data;
        array_splice($data, 10);
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
}
