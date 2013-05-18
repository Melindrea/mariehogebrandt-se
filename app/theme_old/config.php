<?php
/**
 * Enable theme features
 */
add_theme_support('rewrites');              // Enable URL rewrites
add_theme_support('h5bp-htaccess');         // Enable HTML5 Boilerplate's .htaccess
add_theme_support('bootstrap-top-navbar');  // Enable Bootstrap's top navbar
add_theme_support('nice-search');           // Enable /?s= to /search/ redirect

define('POST_EXCERPT_LENGTH', 40);
