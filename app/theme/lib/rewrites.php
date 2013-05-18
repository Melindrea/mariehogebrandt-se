<?php
/**
 * URL rewriting
 *
 * Rewrites currently do not happen for child themes (or network installs)
 * @todo https://github.com/retlehs/roots/issues/461
 *
 * Rewrite:
 *   /wp-content/themes/themename/styles/ to /styles/
 *   /wp-content/themes/themename/scripts/  to /scripts/
 *   /wp-content/themes/themename/images/ to /images/
 *   /wp-content/plugins/              to /plugins/
 *
 * If you aren't using Apache, alternate configuration settings can be found in the docs.
 *
 * @link https://github.com/retlehs/roots/blob/master/doc/rewrites.md
 */
function roots_add_rewrites($content) {
  global $wp_rewrite;
  $roots_new_non_wp_rules = array(
    'styles/(.*)'      => THEME_PATH . '/styles/$1',
    'scripts/(.*)'       => THEME_PATH . '/scripts/$1',
    'images/(.*)'      => THEME_PATH . '/images/$1',
    'plugins/(.*)'         => RELATIVE_PLUGIN_PATH . '/$1'
  );
  $wp_rewrite->non_wp_rules = array_merge($wp_rewrite->non_wp_rules, $roots_new_non_wp_rules);
  return $content;
}

function roots_clean_urls($content) {
  if (strpos($content, RELATIVE_PLUGIN_PATH) > 0) {
    return str_replace('/' . RELATIVE_PLUGIN_PATH,  '/plugins', $content);
  } else {
    return str_replace('/' . THEME_PATH, '', $content);
  }
}

if (!is_multisite() && !is_child_theme()) {
  if (current_theme_supports('rewrites')) {
    add_action('generate_rewrite_rules', 'roots_add_rewrites');
  }

  if (!is_admin() && current_theme_supports('rewrites')) {
    $tags = array(
      'plugins_url',
      'bloginfo',
      'stylesheet_directory_uri',
      'template_directory_uri',
      'script_loader_src',
      'style_loader_src'
    );

    add_filters($tags, 'roots_clean_urls');
  }
}
