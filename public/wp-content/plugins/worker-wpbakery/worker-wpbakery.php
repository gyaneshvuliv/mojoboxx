<?php
/**
 * Plugin Name: Worker for WPBakery
 * Plugin URI: https://1.envato.market/worker-wpbakery
 * Description: Creates a modern and stylish WPBakery addon to display business hours.
 * Author: Merkulove
 * Version: 1.0.1
 * Author URI: https://1.envato.market/7BP55
 * Requires PHP: 5.6
 * Requires at least: 3.0
 * Tested up to: 5.4
 **/

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

namespace Merkulove;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

/** Include plugin autoloader for additional classes. */
require __DIR__ . '/src/autoload.php';

use Merkulove\WorkerWPBakery\EnvatoItem;
use Merkulove\WorkerWPBakery\Helper;
use Merkulove\WorkerWPBakery\PluginHelper;
use Merkulove\WorkerWPBakery\PluginUpdater;
use Merkulove\WorkerWPBakery\Settings;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * SINGLETON: Core class used to implement a Worker plugin.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @since 1.0.0
 **/
final class WorkerWPBakery {

	/**
	 * Plugin version.
	 *
	 * @string version
	 * @since 1.0.0
	 **/
	public static $version = '';

	/**
	 * Use minified libraries if SCRIPT_DEBUG is turned off.
	 *
	 * @since 1.0.0
	 **/
	public static $suffix = '';

	/**
	 * URL (with trailing slash) to plugin folder.
	 *
	 * @var string
	 * @since 1.0.0
	 **/
	public static $url = '';

	/**
	 * PATH to plugin folder.
	 *
	 * @var string
	 * @since 1.0.0
	 **/
	public static $path = '';

	/**
	 * Plugin base name.
	 *
	 * @var string
	 * @since 1.0.0
	 **/
	public static $basename = '';

    /**
     * The one true Worker.
     *
     * @var WorkerWPBakery
     * @since 1.0.0
     **/
    private static $instance;

    /**
     * Sets up a new plugin instance.
     *
     * @since 1.0.0
     * @access public
     **/
    private function __construct() {

	    /** Initialize main variables. */
	    $this->initialization();

	    /** Define admin hooks. */
	    $this->admin_hooks();

	    /** Define public hooks. */
	    $this->public_hooks();

	    /** Define hooks that runs on both the front-end as well as the dashboard. */
	    $this->both_hooks();

    }

	/**
	 * Define hooks that runs on both the front-end as well as the dashboard.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return void
	 **/
	private function both_hooks() {

		/** Load translation. */
		add_action( 'plugins_loaded', [$this, 'load_textdomain'] );

		/** Register WPBakery addons. */
		add_action( 'plugins_loaded', [$this, 'register_wpbakery_addons' ] );

    }

	/**
	 * Registers a WPBakery element.
	 *
	 * @return void
	 * @since 1.0.0
	 * @access public
	 **/
	public function register_wpbakery_addons() {

		/** Check if WPBakery is installed */
		if ( ! defined( 'WPB_VC_VERSION' ) ) { return; }

		/** Load WPBakery addons. */
		add_action( 'vc_before_init', [$this, 'load_addons' ] );

		/** Load WPBakery templates */
		add_action( 'vc_before_init', [$this, 'load_templates' ] );

	}

	/**
	 * Load all available WPBakery Templates.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function load_templates() {

		/** Load WPBakery templates, file must ends by ".template.php" */
		$path = WorkerWPBakery::$path . 'src/Merkulove/WorkerWPBakery/WPBakery/templates/';
		foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path ))  as $filename ) {
			if ( substr( $filename, -13 ) == ".template.php" ) {
				/** @noinspection PhpIncludeInspection */
				require_once $filename;
			}
		}

	}

	/**
	 * Load all available WPBakery addons.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function load_addons() {

		/** Load WPBakery addons, file must ends by ".wpbakery.php" */
		$path = WorkerWPBakery::$path . 'src/Merkulove/WorkerWPBakery/WPBakery/addons/';
		foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $path ) ) as $filename ) {
			if ( substr( $filename, -13 ) == ".wpbakery.php" ) {
				/** @noinspection PhpIncludeInspection */
				require_once $filename;
			}
		}

	}

	/**
	 * Register all of the hooks related to the public-facing functionality.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return void
	 **/
	private function public_hooks() {

		/** Load CSS for Frontend Area. */
		add_action( 'wp_enqueue_scripts', [$this, 'styles'] ); // CSS.

		/** Load JavaScript for Frontend Area. */
		add_action( 'wp_enqueue_scripts', [$this, 'scripts'] ); // JS.

	}

	/**
	 * Add CSS for the public-facing side of the site.
	 *
	 * @return void
	 * @since 1.0.0
	 **/
	public function styles() {

		/** Frontend CSS for WPBakery editor. */
		if ( $this->is_vc_build() ) {
			wp_enqueue_style( 'flatpickr', self::$url . 'css/flatpickr' . self::$suffix . '.css', [], self::$version );
		}

		/** Register Frontend CSS for Addon. */
		wp_register_style( 'mdp-worker', self::$url . 'css/worker' . self::$suffix . '.css', [], self::$version );

	}

	/**
	 * Add JavaScript for the public-facing side of the site.
	 *
	 * @return void
	 * @since 1.0.0
	 **/
	public function scripts() {

		/** Frontend JS for WPBakery editor. */
		if ( $this->is_vc_build() ) {
			wp_enqueue_script( 'flatpickr', self::$url . 'js/flatpickr' . self::$suffix . '.js', [], self::$version, true );
		}

	}

	/**
	 * Detect if we are in the "Frontend Editor" mode in WPBakery.
	 *
	 * @return bool
	 * @since 1.0.0
	 **/
	public function is_vc_build() {

		return function_exists( 'vc_is_inline' ) && vc_is_inline() ? true : false;

	}

	/**
	 * Register all of the hooks related to the admin area functionality.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return void
	 **/
	private function admin_hooks() {

		/** Add plugin settings page. */
		Settings::get_instance()->add_settings_page();

		/** Load JS and CSS for Backend Area. */
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		/** Remove all "third-party" notices from plugin settings page. */
		add_action( 'in_admin_header', [$this, 'remove_all_notices'], 1000 );

		/** Remove "Thank you for creating with WordPress" and WP version only from plugin settings page. */
		add_action( 'admin_enqueue_scripts', [$this, 'remove_wp_copyrights'] );

    }

	/**
	 * Remove all other notices.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function remove_all_notices() {

		/** Work only on plugin settings page. */
		$screen = get_current_screen();

		if ( $screen->base != "settings_page_mdp_worker_wpbakery_settings" ) { return; }

		/** Remove other notices. */
		remove_all_actions( 'admin_notices' );
		remove_all_actions( 'all_admin_notices' );

	}

	/**
	 * Initialize main variables.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function initialization() {

		/** Plugin version. */
		if ( ! function_exists('get_plugin_data') ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		$plugin_data = get_plugin_data( __FILE__ );
		self::$version = $plugin_data['Version'];

		/** Gets the plugin URL (with trailing slash). */
		self::$url = plugin_dir_url( __FILE__ );

		/** Gets the plugin PATH. */
		self::$path = plugin_dir_path( __FILE__ );

		/** Use minified libraries if SCRIPT_DEBUG is turned off. */
		self::$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		/** Set plugin basename. */
		self::$basename = plugin_basename( __FILE__ );

		/** Initialize plugin settings. */
		Settings::get_instance();

		/** Initialize PluginHelper. */
		PluginHelper::get_instance();

		/** Plugin update mechanism enable only if plugin have Envato ID. */
		$plugin_id = EnvatoItem::get_instance()->get_id();
		if ( (int)$plugin_id > 0 ) {
			PluginUpdater::get_instance();
        }

	}

	/**
	 * Return plugin version.
	 *
	 * @return string
	 * @since 1.0.0
	 * @access public
	 **/
	public function get_version() {
		return self::$version;
	}

	/**
	 * Remove "Thank you for creating with WordPress" and WP version only from plugin settings page.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return void
	 **/
	public function remove_wp_copyrights() {

		/** Remove "Thank you for creating with WordPress" and WP version from plugin settings page. */
		$screen = get_current_screen(); // Get current screen.

		/** Plugin Settings Page. */
		if ( $screen->base == 'settings_page_mdp_worker_wpbakery_settings' ) {
			add_filter( 'admin_footer_text', '__return_empty_string', 11 );
			add_filter( 'update_footer', '__return_empty_string', 11 );
		}

	}

    /**
     * Loads the Worker translated strings.
     *
     * @since 1.0.0
     * @access public
     **/
    public function load_textdomain() {

        load_plugin_textdomain( 'worker-wpbakery', false, self::$path . '/languages/' );

    }

    /**
     * Add CSS for admin area.
     *
     * @since 1.0.0
     * @return void
     **/
    public function admin_styles() {

        /** Add styles only on setting page */
        $screen = get_current_screen();

	    /** Worker Settings Page. */
	    if ( $screen->base == "settings_page_mdp_worker_wpbakery_settings" ) {
		    wp_enqueue_style( 'merkulov-ui', self::$url . 'css/merkulov-ui.min.css', [], self::$version );
		    wp_enqueue_style( 'mdp-worker-wpbakery-admin', self::$url . 'css/admin' . self::$suffix . '.css', [], self::$version );

	    } elseif ( 'plugin-install' == $screen->base ) {

		    /** Styles only for our plugin. */
		    if ( isset( $_GET['plugin'] ) AND $_GET['plugin'] === 'worker-wpbakery' ) {
			    wp_enqueue_style( 'mdp-worker-wpbakery-plugin-install', self::$url . 'css/plugin-install' . self::$suffix . '.css', [], self::$version );
		    }
	    }

	    /** All admin pages. */
	    wp_enqueue_style( 'mdp-wpbakery-admin', self::$url . 'css/wpbakery-admin' . self::$suffix . '.css', [], self::$version );
	    wp_enqueue_style( 'flatpickr', self::$url . 'css/flatpickr' . self::$suffix . '.css', [], self::$version );

    }

    /**
     * Add JS for admin area.
     *
     * @since 1.0.0
     * @return void
     **/
    public function admin_scripts() {

	    /** Add styles only on setting page */
	    $screen = get_current_screen();

	    /** Worker Settings Page. */
	    if ( $screen->base == 'settings_page_mdp_worker_wpbakery_settings' ) {
		    wp_enqueue_script( 'merkulov-ui', self::$url . 'js/merkulov-ui' . self::$suffix . '.js', [], self::$version, true );
	    }

	    /** All admin pages. */
	    wp_enqueue_script( 'flatpickr', self::$url . 'js/flatpickr' . self::$suffix . '.js', [], self::$version, true );

    }

	/**
	 * Run when the plugin is activated.
	 *
	 * @static
	 * @since 1.0.0
	 **/
	public static function on_activation() {

		/** Security checks. */
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );

		/** Send install Action to our host. */
		Helper::get_instance()->send_action( 'install', 'worker-wpbakery', self::$version );

	}

	/**
	 * Main Worker Instance.
	 *
	 * Insures that only one instance of Worker exists in memory at any one time.
	 *
	 * @static
	 * @return WorkerWPBakery
	 * @since 1.0.0
	 **/
	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof WorkerWPBakery ) ) {
			self::$instance = new WorkerWPBakery;
		}

		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 **/
	public function __clone() {
		/** Cloning instances of the class is forbidden. */
		_doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be cloned.', 'worker-wpbakery' ), '1.0.1' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be unserialized.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 **/
	public function __wakeup() {
		/** Unserializing instances of the class is forbidden. */
		_doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be unserialized.', 'worker-wpbakery' ), '1.0.1' );
	}

} // End Class Worker.

/** Run when the plugin is activated. */
register_activation_hook( __FILE__, [ 'Merkulove\WorkerWPBakery', 'on_activation'] );

/** Run Worker class. */
WorkerWPBakery::get_instance();