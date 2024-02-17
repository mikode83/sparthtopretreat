<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class CallToAction extends Composer
{
	/**
	 * List of views served by this composer.
	 *
	 * @var array
	 */
	protected static $views = [
		'partials.call-to-action',
	];

	/**
	 * Data to be passed to view before rendering.
	 *
	 * @return array
	 */
	public function with()
	{
		return [
			'cta_url' => $this->ctaUrl()
		];
	}

	public function ctaUrl()
	{
		if ($this->data['cta']['type'] == 'external') {
			$cta_url = $this->data['cta']['external'];
		} elseif ($this->data['cta']['type'] == 'download') {
			$cta_url = $this->data['cta']['download'];
		} else {
			$cta_url = $this->data['cta']['internal'];
		}

		return $cta_url;
	}
}
