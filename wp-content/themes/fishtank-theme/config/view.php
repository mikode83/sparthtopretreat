<?php

return [

	/*
		|--------------------------------------------------------------------------
		| View Namespaces
		|--------------------------------------------------------------------------
		|
		| Blade has an underutilized feature that allows developers to add
		| supplemental view paths that may contain conflictingly named views.
		| These paths are prefixed with a namespace to get around the conflicts.
		| A use case might be including views from within a plugin folder.
		|
	*/

	'namespaces' => [
		/* Given the below example, in your views use something like: @include('WC::some.view.or.partial.here') */
		// 'WC' => WP_PLUGIN_DIR.'/woocommerce/templates/',
		'SVG' => get_theme_file_path() . '/resources/svg',
	],
];
