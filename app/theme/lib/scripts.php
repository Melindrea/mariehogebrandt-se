<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/bootstrap.css
 * 2. /theme/assets/css/bootstrap-responsive.css
 * 3. /theme/assets/css/app.css
 * 4. /child-theme/style.css (if a child theme is activated)
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.9.1.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.6.2.min.js
 * 3. /theme/assets/js/plugins.js (in footer)
 * 4. /theme/assets/js/main.js    (in footer)
 */
function roots_scripts() {
    wp_register_style('mariehogebrandt_site', get_template_directory_uri() . '/styles/site.min.css', array('fonts'), null);
    wp_register_style('mariehogebrandt_fonts', 'http://fonts.googleapis.com/css?family=Source+Code+Pro:400,700', false, null);
    wp_enqueue_style('mariehogebrandt_site');
    wp_enqueue_style('mariehogebrandt_fonts');

    if (is_single() && comments_open() && get_option('thread_comments')) {
      wp_enqueue_script('comment-reply');
    }

    wp_register_script('mariehogebrandt_head', get_template_directory_uri() . '/scripts/head.min.js', array('jquery'), null, false);
    wp_register_script('mariehogebrandt_main', get_template_directory_uri() . '/scripts/main.min.js',  array('jquery'), null, true);
    wp_enqueue_script('mariehogebrandt_head');
    wp_enqueue_script('mariehogebrandt_main');
    wp_deregister_style( 'contact-form-7' ); //These styles are baked into the stylesheet

    if ( !is_page('contact')) {
        wp_deregister_script( 'contact-form-7' );
    }
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

// This function removes all markdown scripts/styles enqueued, as they
// are baked into the scripts/CSS of the theme
function mh_remove_markdown()
{
    if ( !is_admin()) {
        wp_deregister_style('wp-markdown-prettify');
        wp_deregister_style('wp-markdown-editor');

        wp_deregister_script('md_convert');
        wp_deregister_script('md_sanit');
        wp_deregister_script('md_edit');
        wp_deregister_script('wp-markdown-prettify');
        wp_deregister_script('wp-markdown-editor');
    }
}
add_action('wp_enqueue_scripts', 'mh_remove_markdown', 15);
