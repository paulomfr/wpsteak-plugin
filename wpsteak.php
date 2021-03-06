<?php declare(strict_types = 1);

/**
 * WP Steak
 *
 * @package App
 *
 * Plugin Name: WP Steak
 * Description: A fully structured plugin.
 * Version: 3.0.1
 * Author: Apiki
 * Author URI: https://apiki.com/
 * Text Domain: app
 * Domain Path: /languages
 * Requires PHP: 7.4
 */

use Cedaro\WP\Plugin\Plugin;
use Cedaro\WP\Plugin\PluginFactory;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

/**
 * Retrieve the main plugin instance.
 *
 * @return \Cedaro\WP\Plugin
 */
function wpsteak(): Plugin {
	static $instance;

	if ( null === $instance ) {
		$instance = PluginFactory::create( 'app' );
	}

	return $instance;
}

$container = new League\Container\Container();

/* register the reflection container as a delegate to enable auto wiring. */
$container->delegate(
	( new League\Container\ReflectionContainer() )->cacheResolutions(),
);

$plugin = wpsteak(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride

$plugin->set_container( $container );
$plugin->register_hooks( $container->get( Cedaro\WP\Plugin\Provider\I18n::class ) );
$plugin->register_hooks( $container->get( WPSteak\Providers\I18n::class ) );

$config = ( require __DIR__ . '/config.php' );

foreach ( $config['service_providers'] as $service_provider ) {
	$container->addServiceProvider( $service_provider );
}

foreach ( $config['hook_providers'] as $hook_provider ) {
	$plugin->register_hooks( $container->get( $hook_provider ) );
}
