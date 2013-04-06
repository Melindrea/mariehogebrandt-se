<?php
define( 'DOING_AJAX', true );

global $wpdb;
global $wp_embed;

$GLOBALS[ '_wp_deprecated_widgets_callbacks' ] = array();

$path = str_replace('test/php', 'wordpress/wp-load.php', dirname(__FILE__));
require_once( $path );
