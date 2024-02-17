<?php

namespace App;

if (class_exists('ACF')) {
	// Hide ACF menu item in Production and Staging.
	if (defined('WP_ENV') && in_array(WP_ENV, ['production', 'staging'])) {
		add_filter('acf/settings/show_admin', '__return_false');
	}

	if (function_exists('add_filter')) {

		/**
		 * Set local json save path
		 * @param  string $path unmodified local path for acf-json
		 * @return string       our modified local path for acf-json
		 */
		add_filter('acf/settings/save_json', function ($path) {

			if (is_dir(get_stylesheet_directory() . '/resources')) {
				// This is Sage 10
				$path = get_stylesheet_directory() . '/resources/acf-json';
			} else {
				// This probably isn't Sage
				$path = get_stylesheet_directory() . '/acf-json';
			}

			// If the directory doesn't exist, create it.
			if (!is_dir($path)) {
				mkdir($path);
			}

			// Always return
			return $path;
		});

		/**
		 * Set local json load path
		 * @param  string $path unmodified local path for acf-json
		 * @return string       our modified local path for acf-json
		 */
		add_filter('acf/settings/load_json', function ($paths) {
			// Sage 10 path
			$paths[] = get_stylesheet_directory() . '/resources/acf-json';

			// Failsafe path
			$paths[] = get_stylesheet_directory() . '/acf-json';

			// return
			return $paths;
		});
	}

	/* SVG icons */
	add_filter('acf/load_field/name=svg_icon', function ($field) {
		// reset choices
		$field['choices'] = array();
		// get array of icons from svg icons folder...
		$svg_icons = scandir(__DIR__ . '/../resources/images/svg/icons/');
		//remove the .. and . from the array
		$svg_icons = array_diff($svg_icons, array('.', '..'));
		$field['choices']['none'] = 'None';
		// if we have an array...
		if (is_array($svg_icons)) {
			// loop through array
			foreach ($svg_icons as $icon) {
				// remove ".blade.php" from the name
				$icon_name = substr($icon, 0, -10);
				//User-friendly name
				$icon_label = str_replace('-', ' ', $icon_name);
				$icon_label = ucfirst($icon_label);

				$field['choices'][$icon_name] = $icon_label;
			}
		}
		// return the field
		return $field;
	});

	/**
	 * ACF Global Pages Setup
	 */
	if (function_exists('acf_add_options_page')) {
		$parent_globals_page = acf_add_options_page(array(
			'page_title' => 'Theme Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug' => 'theme-settings',
			'capability' => 'edit_posts',
			'icon_url' => 'dashicons-admin-settings',
			'redirect' => false,
			'position' => 4,
		));
	}
}
