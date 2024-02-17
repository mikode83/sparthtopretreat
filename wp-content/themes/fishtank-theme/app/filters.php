<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
	return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

add_filter('oembed_response_data', function ($data) {
	$data['author_url'] = 'https://fishtankagency.com';
	$data['author_name'] = 'made@fishtankagency.com';
	return $data;
});
