<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Example extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'blocks.example.inc.latest-posts',
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'latest_posts' => $this->latestPosts(),
		];
	}

	/**
	 * Returns the list of latest posts.
	 *
	 * @return string
	 */
	public function latestPosts()
	{
		$postsQuery = new \WP_Query([
			'post_type' => 'post',
			'posts_per_page' => '3',
			'post_status' => 'publish',
			'no_found_rows' => true,
		]);

		return $postsQuery;
	}
}
