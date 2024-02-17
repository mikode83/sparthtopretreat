<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Roots\Acorn\View\Composers\Concerns\AcfFields;

class App extends Composer
{
	use AcfFields;

	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'*',
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'siteName' => $this->siteName(),
			'title' => $this->title(),
			'contact_details' => $this->contactDetails(),
			'socials' => $this->socials(),
		];
	}

	/**
	 * Returns the site name.
	 *
	 * @return string
	 */
	public function siteName()
	{
		return get_bloginfo('name', 'display');
	}

	/**
	 * Returns the post title.
	 *
	 * @return string
	 */
	public function title()
	{
		if (is_home()) {
			if ($home = get_option('page_for_posts', true)) {
				return get_the_title($home);
			}

			return __('Latest Posts', 'sage');
		}

		if (is_archive()) {
			return post_type_archive_title('', false);
		}

		if (is_search()) {
			return sprintf(
				__('Search Results for %s', 'sage'),
				get_search_query()
			);
		}

		if (is_404()) {
			return __('Not Found', 'sage');
		}

		return get_the_title();
	}

	/**
	 * Returns the required field as object.
	 *
	 * @return string
	 */
	public function contactDetails()
	{
		$contact_details = get_field('contact_details', 'option');
		return $contact_details;
	}

	/**
	 * Returns the required field as object.
	 *
	 * @return string
	 */
	public function socials()
	{
		$socials = get_field('socials', 'option');
		return $socials;
	}
}
