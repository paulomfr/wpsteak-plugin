<?php declare(strict_types = 1);

namespace App\Providers;

use WPSteak\Providers\AbstractHookProvider;

class ThemeSupports extends AbstractHookProvider {

	/**
	 * {@inheritDoc}
	 */
	public function register_hooks() {
		$this->add_action( 'init', 'add_supports' );
	}

	protected function add_supports(): void {
		add_theme_support( 'align-wide' );

		add_theme_support( 'editor-styles' );

		add_theme_support( 'responsive-embeds' );
	}

}
