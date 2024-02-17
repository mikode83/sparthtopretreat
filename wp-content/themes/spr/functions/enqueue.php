<?php
function get_current_git_commit( $branch='master' ) {
	if ( $hash = file_get_contents( sprintf( '../.git/refs/heads/%s', $branch ) ) ) {
		return '?v='.trim($hash);
	} else {
		return false;
	}
}
function register_scripts(){
	wp_deregister_script( 'jquery' ); // the jquery handle is just an alias to load jquery-core with jquery-migrate
	wp_deregister_script( 'jquery-core' );
	wp_deregister_script( 'jquery-migrate' );

	$commit = get_current_git_commit();

	wp_enqueue_style( 'theme-styles', get_template_directory_uri().'/dist/css/main.min.css'.$commit );
	wp_enqueue_script( 'custom', get_template_directory_uri().'/dist/js/main.min.js'.$commit, array(),'', true);
}

add_action('wp_enqueue_scripts','register_scripts');


function vc_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
