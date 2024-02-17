<?php
/**
 * REMOVE UNWANTED <HEAD> ITMES
 *
 * Removes version info in src/href of items and gets rid of things like emojis.
 * and other user unnecessary stuff.
 *
 *
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles' );


/**
 * THEME SUPPORT
 *
 * Adds theme support of sidebars, menus and for customising back-end/wordpress.
 *
 *
 *
 */
// Remove admin bar at frontend
show_admin_bar( false );
// Register Nav menus and Sidebars
register_nav_menus();
register_sidebars();
add_theme_support( 'html5' );
// Add theme supprt to posts
add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-formats', array(
	'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio'
));
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'custom-logo' );
