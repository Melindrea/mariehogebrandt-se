<?php
/**
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 */
function roots_template_path() {
  return Roots_Wrapping::$main_template;
}

function roots_sidebar_path() {
  return Roots_Wrapping::sidebar();
}

class Roots_Wrapping {
  // Stores the full path to the main template file
  static $main_template;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  static $base;

  static function wrap($template) {
    self::$main_template = $template;

    self::$base = substr(basename(self::$main_template), 0, -4);

    if (self::$base === 'index') {
      self::$base = false;
    }

    $templates = array('base.php');

    if (self::$base) {
      array_unshift($templates, sprintf('base-%s.php', self::$base));
    }

    return locate_template($templates);
  }

  static function sidebar() {
    $templates = array('templates/sidebar.php');

    if (self::$base) {
      array_unshift($templates, sprintf('templates/sidebar-%s.php', self::$base));
    }

    return locate_template($templates);
  }
}
add_filter('template_include', array('Roots_Wrapping', 'wrap'), 99);

/**
 * Page titles
 */
function roots_title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      echo get_the_title(get_option('page_for_posts', true));
    } else {
      _e('Latest Posts', 'roots');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      echo $term->name;
    } elseif (is_post_type_archive()) {
      echo get_queried_object()->labels->name;
    } elseif (is_day()) {
      printf(__('Daily Archives: %s', 'roots'), get_the_date());
    } elseif (is_month()) {
      printf(__('Monthly Archives: %s', 'roots'), get_the_date('F Y'));
    } elseif (is_year()) {
      printf(__('Yearly Archives: %s', 'roots'), get_the_date('Y'));
    } elseif (is_author()) {
      printf(__('Author Archives: %s', 'roots'), get_the_author());
    } else {
      single_cat_title();
    }
  } elseif (is_search()) {
    printf(__('Search Results for %s', 'roots'), get_search_query());
  } elseif (is_404()) {
    _e('Not Found', 'roots');
  } else {
    the_title();
  }
}

function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

function is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}

function mh_the_post_thumbnail($size = 'large')
{
    $largeImageUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
    $featuredImage = get_the_post_thumbnail();
    $return = '<a href="';
    $return .= $largeImageUrl[0];
    $return .= '" class="thumbnail featured-image">';
    $return .= $featuredImage.'</a>'.PHP_EOL;

    echo $return;
}

function mh_get_thumbnail_size($intended)
{
    $mobileDetect = new Mobile_Detect();
    if ($mobileDetect->isMobile()) {
        return $intended . '-mobile';
    } elseif ($mobileDetect->isTablet()) {
        return $indented . '-tablet';
    }
    return $intended;
}
function mh_get_post_thumbnail_classes($size = 'thumbnail', $classes = null)
{
    $return = array("attachment-$size", 'img-polaroid');

    if ($classes) {
        if (is_array($classes)) {
            $return = array_merge($return, $classes);
        } else {
            $return[] = $classes;
        }
    }
    return array('class' => join(' ', $return));
}
function mh_latest_status()
{
    $args = array(
        'numberposts' => '1',
        'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => 'post-format-status',
                'operator' => 'IN'
            ),
        ),
    );

    $latestStatus = wp_get_recent_posts($args, OBJECT);
    $latestStatus = $latestStatus[0];
    $content = $latestStatus->post_content;

    if (count($latestStatus) > 0) {
        $view = View::factory('status')
        ->bind('content', $content)
        ->bind('time', strtotime($latestStatus->post_date))
        ->render();
    }
}

// http://wp-snippets.com/get-the-first-link-in-post/
// Assumes that the content is a link to the url
function get_content_link ($content = false, $echo = false) {
    if ($content === false) {
        $content = get_the_content();
    }

    $content = preg_match_all( '/hrefs*=s*["\']([^"\']+)/', $content, $links );
    $content = $links[1][0];

    if (empty($content)) {
        $content = false;
    }

    return $content;
}
