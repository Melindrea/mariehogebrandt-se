<?php
/**
 * Enable theme features
 */
add_theme_support('root-relative-urls');    // Enable relative URLs
add_theme_support('rewrites');              // Enable URL rewrites
add_theme_support('nice-search');           // Enable /?s= to /search/ redirect

/**
 * Configuration values
 */
define('POST_EXCERPT_LENGTH', 40);

/**
 * .main classes
 */
function roots_wrapper_classes($classes) {
    if ( ! is_array($classes)) {
        $classes = array($classes);
    }
    if (roots_display_sidebar()) {
        // Classes on pages with the sidebar
        $classes[] = 'content-first';
    } else {
        // Classes on full width pages
        $classes[] = 'content-text';
    }

    return join(' ', $classes);
}

/**
 * Define which pages shouldn't have the sidebar
 *
 * See lib/sidebar.php for more details
 */
function roots_display_sidebar() {
  $sidebar_config = new Roots_Sidebar(
    /**
     * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
     * Any of these conditional tags that return true won't show the sidebar
     *
     * To use a function that accepts arguments, use the following format:
     *
     * array('function_name', array('arg1', 'arg2'))
     *
     * The second element must be an array even if there's only 1 argument.
     */
    array(
      'is_404',
    ),
    /**
     * Page template checks (via is_page_template())
     * Any of these page templates that return true won't show the sidebar
     */
    array(
      'template-custom.php',
    )
  );

  if (is_page() && !is_front_page() && !is_page_template()) {
    return false;
  }
  return $sidebar_config->display;
}

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

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 940px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 940; }
