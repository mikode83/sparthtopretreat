<?php

/**
 * Theme setup.
 */

namespace App;

define('FISHTANK_BLOCKS', [
	'example',
]);

define('CORE_BLOCKS', [
	'block',
	'heading',
	'paragraph',
	'list',
	'image',
]);

/**
 * Register any blocks from our constant FISHTANK_BLOCKS array above ^^^
 */

add_action('init', function () {
	foreach (FISHTANK_BLOCKS as $block_name) {
		$block_json = get_template_directory() . '/resources/views/blocks/' . $block_name . '/block.json';
		register_block_type($block_json);
	}
});

/**
 * Only use custom blocks made by us
 *
 * feel free to edit for different post stypes etc...
 */

add_filter('allowed_block_types', function () {
	$fishtank_blocks = array();

	//loop through all constant FISHTANK_BLOCKS and add to be allowed
	foreach (FISHTANK_BLOCKS as $block_name) {
		$fishtank_blocks[] = 'fishtank/' . $block_name;
	}

	//add core blocks to be used
	foreach (CORE_BLOCKS as $block_name) {
		$fishtank_blocks[] = 'core/' . $block_name;
	}

	return $fishtank_blocks;
});

function mix_manifest($asset)
{
	$_mix_manifest = file_get_contents(__DIR__ . '/../public/manifest.json');
	$mix_manifest = json_decode($_mix_manifest);
	if (property_exists($mix_manifest, $asset)) {
		return get_template_directory_uri() . '/public/' . $mix_manifest->{$asset};
	} else {
		return get_template_directory_uri() . '/public/' . $asset;
	}
}

function register_fishtank_block_assets()
{
	foreach (FISHTANK_BLOCKS as $block_name) {
		wp_register_style('fishtank/' . $block_name, mix_manifest('styles/blocks/' . $block_name . '.css'), false, null);
		if (has_block('fishtank/' . $block_name)) {
			wp_enqueue_style('fishtank/' . $block_name);
		}

		if (file_exists(get_template_directory() . '/public/scripts/blocks/' . $block_name . '.js')) {
			wp_register_script('fishtank/' . $block_name, mix_manifest('scripts/blocks/' . $block_name . '.js'), null, null, true);
		}
	}

	/**
	 *
	 * Vendor Scripts
	 */

	wp_register_script('fishtank/swiper', mix_manifest('scripts/vendor/swiper.js'), null, null, true);
}

/**
 * Register/Enqueue the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('sage/main.css', mix_manifest('styles/main.css'), false, null);
	wp_enqueue_script('sage/manifest.js', mix_manifest('scripts/vendor/manifest.js'), null, null, true);
	wp_enqueue_script('sage/main.js', mix_manifest('scripts/main.js'), null, null, true);
	register_fishtank_block_assets();
}, 100);

/**
 * Register/Enqueue the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
	wp_enqueue_style('sage/editor.css', mix_manifest('styles/editor.css'), false, null);
	wp_enqueue_script('sage/manifest.js', mix_manifest('scripts/vendor/manifest.js'), null, null, true);
	wp_enqueue_script('sage/editor.js', mix_manifest('scripts/editor.js'), null, null, true);
	register_fishtank_block_assets();
}, 100);

/**
 * Register/Enqueue the admin assets with the block editor.
 *
 * @return void
 */
add_action('login_enqueue_scripts', function () {
	wp_enqueue_style('sage/admin.css', mix_manifest('styles/admin.css'), false, null);
}, 100);

/**
 * ACF Block Render Callback Function
 *
 * This is called from the block.json
 */

function acf_block_render_callback($block)
{
	// wp_enqueue_style($block['name']);
	// creat a slug from the blockname
	$slug = str_replace('fishtank/', '', $block['name']);
	// add the slug to the classes for the block
	$classes = [$slug];
	// If the ancor is set in the CMS us that as ID else use teh ACF created one
	$id = !empty($block['anchor']) ? $block['anchor'] : $block['id'];
	// If a class or classes are added via the CMS append that to array of classes
	if (!empty($block['className'])) {
		$classes[] = $block['className'];
	}
	// add class if is preview
	if (is_preview()) {
		$classes[] = 'is_preview';
	}

	$block['classes'] = implode(' ', $classes);
	// if the view exists then render it and pass the IS, Classes and ACF Block data.
	if (\View::exists("blocks/${slug}/${slug}")) {
		echo \Roots\view("blocks/${slug}/${slug}", ['block' => $block])->render();
	} else {
		// fallback
		echo 'No view file exists';
	}
}

/**
 * Adding a new (custom) block category to the top of the list.
 *
 * @param   array $block_categories                                Array of categories for block types.
 * @param   WP_Block_Editor_Context|string $block_editor_context   The current block editor context, or a string defining the context.
 */

add_filter('block_categories_all', function ($categories, $post) {
	array_unshift($categories, array(
		'slug' => 'fishtank',
		'title' => esc_html__('Fishtank Blocks', 'sage'),
	));

	return $categories;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
	/**
	 * Enable features from the Soil plugin if activated.
	 *
	 * @link https://roots.io/plugins/soil/
	 */
	add_theme_support('soil', [
		'clean-up',
		'nav-walker',
		'nice-search',
		'relative-urls',
	]);

	/**
	 * Disable full-site editing support.
	 *
	 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
	 */
	remove_theme_support('block-templates');

	/**
	 * Register the navigation menus.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	register_nav_menus([
		'primary_navigation' => __('Primary Navigation', 'sage'),
	]);

	/**
	 * Disable the default block patterns.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
	 */
	remove_theme_support('core-block-patterns');

	/**
	 * Enable plugins to manage the document title.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support('title-tag');

	/**
	 * Enable post thumbnail support.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	/**
	 * Enable responsive embed support.
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
	 */
	add_theme_support('responsive-embeds');

	remove_theme_support('widgets-block-editor');

	/**
	 * Enable HTML5 markup support.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support('html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
		'script',
		'style',
	]);

	/**
	 * Enable selective refresh for widgets in customizer.
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
	 */
	add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
	$config = [
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	];

	register_sidebar([
		'name' => __('Primary', 'sage'),
		'id' => 'sidebar-primary',
	] + $config);

	register_sidebar([
		'name' => __('Footer', 'sage'),
		'id' => 'sidebar-footer',
	] + $config);
});


/**
 * Create admin menu for reusable blocks.
 *
 * @link https://developer.wordpress.org/block-editor/developers/block-api/block-templates/
 */
add_action('admin_menu', function () {
	add_menu_page('Reusable Blocks', 'Reusable Blocks', 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22);
});
