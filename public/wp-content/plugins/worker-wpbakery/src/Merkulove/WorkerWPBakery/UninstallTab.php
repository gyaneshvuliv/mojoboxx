<?php
/**
 * Worker creates a modern and stylish WPBakery addon to display business hours.
 * Exclusively on Envato Market: https://1.envato.market/worker-wpbakery
 *
 * @encoding        UTF-8
 * @version         1.0.1
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    {{contributors}}
 * @support         dmitry@merkulov.design
 **/

namespace Merkulove\WorkerWPBakery;

use Merkulove\WorkerWPBakery as WorkerWPBakery;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to implement UninstallTab tab on plugin settings page.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class UninstallTab {

	/**
	 * The one true UninstallTab.
	 *
	 * @var UninstallTab
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new UninstallTab instance.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function __construct() {

	}

	/**
	 * Render form with all settings fields.
	 *
	 * @access public
	 * @since 1.0.0
	 **/
	public function render_form() {

		settings_fields( 'WorkerWPBakeryUninstallOptionsGroup' );
		do_settings_sections( 'WorkerWPBakeryUninstallOptionsGroup' );

	}

	/**
	 * Generate Activation Tab.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function add_settings() {

		/** Uninstall Tab. */
		register_setting( 'WorkerWPBakeryUninstallOptionsGroup', 'mdp_worker_wpbakery_uninstall_settings' );
		add_settings_section( 'mdp_worker_wpbakery_settings_page_uninstall_section', '', null, 'WorkerWPBakeryUninstallOptionsGroup' );

		/** Delete plugin. */
		add_settings_field( 'delete_plugin', esc_html__( 'Removal settings:', 'worker-wpbakery' ), [$this, 'render_delete_plugin'], 'WorkerWPBakeryUninstallOptionsGroup', 'mdp_worker_wpbakery_settings_page_uninstall_section' );

	}

	/**
	 * Render "Delete Plugin" field.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function render_delete_plugin() {

		/** Get uninstall settings. */
		$uninstall_settings = get_option( 'mdp_worker_wpbakery_uninstall_settings' );

		/** Set Default value 'plugin' . */
		if ( ! isset( $uninstall_settings['delete_plugin'] ) ) {
			$uninstall_settings = [
				'delete_plugin' => 'plugin'
			];
		}

		$options = [
			'plugin' => esc_html__( 'Delete plugin only', 'worker-wpbakery' ),
			'plugin+settings' => esc_html__( 'Delete plugin and settings', 'worker-wpbakery' ),
		];

		/** Prepare description. */
		$helper_text = esc_html__( 'Choose which data to delete upon using the "Delete" action in the "Plugins" admin page.', 'worker-wpbakery' );

		/** Render select. */
		UI::get_instance()->render_select(
			$options,
			$uninstall_settings['delete_plugin'], // Selected option.
			esc_html__('Delete plugin', 'worker-wpbakery' ),
			$helper_text,
			['name' => 'mdp_worker_wpbakery_uninstall_settings[delete_plugin]']
		);

	}

	/**
	 * Main UninstallTab Instance.
	 *
	 * Insures that only one instance of UninstallTab exists in memory at any one time.
	 *
	 * @static
	 * @return UninstallTab
	 * @since 1.0.0
	 **/
	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof UninstallTab ) ) {
			self::$instance = new UninstallTab;
		}

		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @return void
	 * @since 1.0.0
	 * @access protected
	 **/
	public function __clone() {
		/** Cloning instances of the class is forbidden. */
		_doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be cloned.', 'worker-wpbakery' ), WorkerWPBakery::$version );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be unserialized.
	 *
	 * @return void
	 * @since 1.0.0
	 * @access protected
	 **/
	public function __wakeup() {
		/** Unserializing instances of the class is forbidden. */
		_doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be unserialized.', 'worker-wpbakery' ), WorkerWPBakery::$version );
	}

} // End Class UninstallTab.
