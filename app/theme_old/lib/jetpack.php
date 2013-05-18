<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Mariehogebrandt
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function mariehogebrandt_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'mariehogebrandt_infinite_scroll_setup' );
