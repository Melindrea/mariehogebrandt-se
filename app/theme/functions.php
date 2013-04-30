<?php
/**
 * Mariehogebrandt functions and definitions
 *
 * @package Mariehogebrandt
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/lib/jetpack.php' );
require( get_template_directory() . '/lib/vendor/mobile-detect.php' );
require( get_template_directory() . '/lib/vendor/tgm-plugin-activation.php' );

if ( ! function_exists( 'mariehogebrandt_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function mariehogebrandt_setup()
{

    /**
     * Custom template tags for this theme.
     */
    require( get_template_directory() . '/lib/template-tags.php' );

    /**
     * Custom functions that act independently of the theme templates
     */
    require( get_template_directory() . '/lib/extras.php' );

    /**
     * Customizer additions
     */
    require( get_template_directory() . '/lib/customizer.php' );

    /**
     * WordPress.com-specific functions and definitions
     */
    //require( get_template_directory() . '/lib/wpcom.php' );

    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on Mariehogebrandt, use a find and replace
     * to change 'mariehogebrandt' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'mariehogebrandt', get_template_directory() . '/languages' );

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );

    /**
     * Enable support for Post Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'mariehogebrandt' ),
    ) );

    /**
     * Enable support for Post Formats
     */
    add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // mariehogebrandt_setup
add_action( 'after_setup_theme', 'mariehogebrandt_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function mariehogebrandt_register_custom_background()
{
    $args = array(
        'default-color' => 'ffffff',
        'default-image' => '',
    );

    $args = apply_filters( 'mariehogebrandt_custom_background_args', $args );

    add_theme_support( 'custom-background', $args );
}
add_action( 'after_setup_theme', 'mariehogebrandt_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function mariehogebrandt_widgets_init()
{
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'mariehogebrandt' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'mariehogebrandt_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function mariehogebrandt_scripts()
{
    wp_enqueue_style( 'Mariehogebrandt-style', get_stylesheet_uri() );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'mariehogebrandt_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/lib/custom-header.php' );
