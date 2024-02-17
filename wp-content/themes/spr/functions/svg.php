<?php
// Upload disallowed file types
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

define('IMG_PATH', get_bloginfo('template_url').'/assets/img/');

define('SVG_PATH', get_stylesheet_directory().'/assets/svg/');

function get_img($img) {
    $return = IMG_PATH.$img;
    return $return;
}

function get_svg($svg, $width = null, $height = null, $classes = null, $from_url = false) {

	if ($from_url) {
		// $url = $_SERVER['DOCUMENT_ROOT'].str_replace(home_url(), '', $svg);
		$url = $_SERVER['DOCUMENT_ROOT'].'/web/'.str_replace(home_url(), '', $svg);
		// $url = $svg;
		$svg = file_get_contents($svg, false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
	} else {
		$url = SVG_PATH.$svg;
	}

	$svg = file_get_contents($url);

	if(isset($width) && $width != '' ) {
        $svg = str_replace( '<svg', '<svg width="'.$width.'" ', $svg );
    }
    if(isset($height) && $height != '') {
        $svg = str_replace( '<svg', '<svg height="'.$height.'" ', $svg );
    }
    if(isset($classes) && $classes != '') {
        if(strpos($svg, 'class="') !== false) {
            $svg = str_replace( '_customClasses_', $classes, $svg );
        }
    } else {
		$svg = str_replace( ' _customClasses_', '', $svg );
	}
    return $svg;
}


function get_attachment_svg($ID,$width = null, $height = null){

    $path = get_attached_file($ID);
    $svg = file_get_contents($path);

    if(isset($width) && $width != '' ) {
        $svg = str_replace( '<svg', '<svg width="'.$width.'" ', $svg );
    }
    if(isset($height) && $height != '') {
        $svg = str_replace( '<svg', '<svg height="'.$height.'" ', $svg );
    }

    return $svg;
}
