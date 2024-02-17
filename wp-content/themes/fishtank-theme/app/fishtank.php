<?php

namespace App;

/**
 * Alter admin footer
 */
add_filter('admin_footer_text', function () {
	echo '<span>Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Created by <a href="https://fishtankagency.com/" target="_blank">Fishtank Agency</a></span>';
});

/**
 * Remove welcome panel
 */
remove_action('welcome_panel', 'wp_welcome_panel');

/**
 * Disable WP Admin Bar front end
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Remove dns-prefetch Link from WordPress Head (Frontend)
 */
remove_action('wp_head', 'wp_resource_hints', 2);

/**
 * Disable head stuff
 */
function disable_header_stuff()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', __NAMESPACE__ . '\\disable_emojis_tinymce');
	add_filter('wp_resource_hints', __NAMESPACE__ . '\\disable_emojis_remove_dns_prefetch', 10, 2);
	remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
	remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
	remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
	remove_action('wp_head', 'index_rel_link'); // index link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // prev link
	remove_action('wp_head', 'start_post_rel_link', 10, 0); // start link
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
	remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
	remove_action('in_admin_header', 'wp_global_styles_render_svg_filters');
}
add_action('init', __NAMESPACE__ . '\\disable_header_stuff');

/**
 * Remove jQuery migrate from frontend
 */
function dequeue_jquery_migrate($scripts)
{
	if (!is_admin() && !empty($scripts->registered['jquery'])) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			['jquery-migrate']
		);
	}
}
add_action('wp_default_scripts', __NAMESPACE__ . '\\dequeue_jquery_migrate');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

		$urls = array_diff($urls, array($emoji_svg_url));
	}
	return $urls;
}

/**
 * Remove H1 from tinMC
 */
add_filter('tiny_mce_before_init', function ($in) {
	$in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
	return $in;
});

/**
 * Remove comments from WP Admin
 */

add_action('admin_init', function () {
	// Redirect any user trying to access comments page
	global $pagenow;

	if ($pagenow === 'edit-comments.php') {
		wp_safe_redirect(admin_url());
		exit;
	}

	// Remove comments metabox from dashboard
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

	// Disable support for comments and trackbacks in post types
	foreach (get_post_types() as $post_type) {
		if (post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
	remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
});

// Remove comments icon from admin bar
add_action('wp_before_admin_bar_render', function () {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
});

/**
 * Remove Yoast comments nonsense
 */
add_filter('wpseo_debug_markers', '__return_false');

/* Move Yoast metabox to bottom */
add_filter('wpseo_metabox_prio', function () {
	return 'low';
});

add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {
	// Add a new toolbar called "Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Simple'] = array();
	$toolbars['Simple'][1] = array('bold', 'italic', 'underline', 'link', 'removeformat');

	// Edit the "Full" toolbar and remove 'code' option
	// - delete from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if (($key = array_search('code', $toolbars['Full'][2])) !== false) {
		unset($toolbars['Full'][2][$key]);
	}
	// return $toolbars - IMPORTANT!
	return $toolbars;
});

/**
 * Hides unecessary fields for users editing their own profiles in the CMS
 */
add_action('admin_head', function () {
	if (!current_user_can('administrator')) {
		echo '<style id="hide-unused-profile-fields"> form#your-profile > h2:first-of-type, form#your-profile > table:first-of-type, tr.user-url-wrap, tr.user-description-wrap, .application-passwords { display: none !important; } </style>';
	}
});
