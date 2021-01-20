<?php
/**
 * Plugin Name: Image Hover Add-on for WPBakery Page Builder
 * Plugin URI: https://www.infiwebs.com/wpbakery-image-hover
 * Description: Image Hover add-on for WPBakery adds 200+ different image hover styles.
 * Version: 1.0
 * Author: InfiWebs
 * Author URI: https://www.infiwebs.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin version.
if ( ! defined( 'WPB_IMAGE_HOVER_VERSION' ) ) {
	define( 'WPB_IMAGE_HOVER_VERSION', '1.0' );
}
// Plugin Root File.
if ( ! defined( 'WPB_IMAGE_HOVER_PLUGIN_FILE' ) ) {
	define( 'WPB_IMAGE_HOVER_PLUGIN_FILE', __FILE__ );
}
// Plugin Folder Path.
if ( ! defined( 'WPB_IMAGE_HOVER_PLUGIN_DIR' ) ) {
	define( 'WPB_IMAGE_HOVER_PLUGIN_DIR', wp_normalize_path( plugin_dir_path( WPB_IMAGE_HOVER_PLUGIN_FILE ) ) );
}
// Plugin Folder URL.
if ( ! defined( 'WPB_IMAGE_HOVER_PLUGIN_URL' ) ) {
	define( 'WPB_IMAGE_HOVER_PLUGIN_URL', plugin_dir_url( WPB_IMAGE_HOVER_PLUGIN_FILE ) );
}

if ( ! class_exists( 'WPBakery_Image_Hover_Addon' ) ) {

	/**
	 * Main WPBakery_Image_Hover_Addon Class.
	 *
	 * @since 1.0
	 */
	class WPBakery_Image_Hover_Addon {

		/**
		 * The one, true instance of this object.
		 *
		 * @since 1.0
		 * @static
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @since 1.0
		 * @static
		 * @access public
		 */
		public static function get_instance() {

			// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
			if ( null === self::$instance ) {
				self::$instance = new WPBakery_Image_Hover_Addon();
			}
			return self::$instance;
		}

		/**
		 * Initializes the plugin by setting localization, hooks, filters,
		 * and administrative functions.
		 *
		 * @since 1.0
		 * @access private
		 */
		private function __construct() {

			// Add admin notice if WPBakery is deactivated or not installed.
			add_action( 'admin_notices', array( $this, 'wpbakery_required_admin_notice' ) );

			// Load plugin textdomain.
			add_action( 'plugins_loaded', array( $this, 'textdomain' ) );

			// Enqueue styles on frontend.
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_styles' ), 9 );

		}

		/**
		 * Displays admin notice if WPBakery is not active.
		 *
		 * @access public
		 * @since 1.0
		 * @return void
		 */
		public function wpbakery_required_admin_notice() {
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				echo '<div class="notice notice-warning is-dismissible">
	             <p>' . esc_attr__( 'Image Hover Add-on for WPBakery Page Builder is installed and activated correctly. However, it will not take any effect until you install and activate WPBakery Page Builder.', 'image-hover' ) . '</p>
	         </div>';
			}
			?>
			<style type="text/css">
			.vc_wpb_image_hover_add_on {
				background-image: none !important;
			}
			.vc_wpb_image_hover_add_on:before {
				font-size: 32px;
			}
			</style>
			<?php
		}

		/**
		 * Loads the plugin language files.
		 *
		 * @access public
		 * @since 1.0
		 * @return void
		 */
		public function textdomain() {

			// Set text domain.
			$domain = 'image-hover';

			// Load the plugin textdomain.
			load_plugin_textdomain( $domain, false, dirname( plugin_basename( WPB_IMAGE_HOVER_PLUGIN_FILE ) ) . '/languages/' );
		}

		/**
		 * Enqueue image hover styles on frontend.
		 *
		 * @since 1.0
		 * @access public
		 * @return void
		 */
		public function frontend_styles() {

			// Register styles.
			wp_register_style( 'image-hover-add-on', WPB_IMAGE_HOVER_PLUGIN_URL . 'assets/css/min/imagehover-pro.min.css', '', WPB_IMAGE_HOVER_VERSION );

			// Enqueue styles on frontend.
			wp_enqueue_style( 'image-hover-add-on' );
		}

		/**
		 * Function to apply attributes to HTML tags.
		 * Devs can override attributes in a child theme by using the correct slug.
		 *
		 * @since 1.0.0
		 * @access public
		 * @param  string $slug    Slug to refer to the HTML tag.
		 * @param  array  $attributes Attributes for HTML tag.
		 * @return string The string of all attributes.
		 */
		public static function attributes( $slug, $attributes = [] ) {

			$out  = '';
			$attr = apply_filters( "wpb_attr_{$slug}", $attributes );

			if ( empty( $attr ) ) {
				$attr['class'] = $slug;
			}

			foreach ( $attr as $name => $value ) {
				if ( 'valueless_attribute' === $value ) {
					$out .= ' ' . esc_html( $name );
				} elseif ( ! empty( $value ) || strlen( $value ) > 0 || is_bool( $value ) ) {
					$value = str_replace( '  ', ' ', $value );
					$out  .= ' ' . esc_html( $name ) . '="' . esc_attr( $value ) . '"';
				}
			}

			return trim( $out );
		}

		/**
		 * Validate shortcode attribute value.
		 *
		 * @static
		 * @access public
		 * @since 1.0
		 * @param string $value         The value.
		 * @param string $accepted_unit The accepted unit.
		 * @param string $bc_support    Return value even if invalid.
		 * @return value
		 */
		public static function validate_shortcode_attr_value( $value, $accepted_unit, $bc_support = true ) {

			if ( '' !== $value ) {
				$value           = trim( $value );
				$unit            = preg_replace( '/[\d-]+/', '', $value );
				$numerical_value = preg_replace( '/[a-z,%]/', '', $value );

				if ( empty( $accepted_unit ) ) {
					return $numerical_value;
				}

				// Add unit if it's required.
				if ( empty( $unit ) ) {
					return $numerical_value . $accepted_unit;
				}

				// If unit was found use original value. BC support.
				if ( $bc_support || $unit === $accepted_unit ) {
					return $value;
				}

				return false;
			}

			return '';
		}
	}
}

/**
 * Instantiates the WPBakery_Image_Hover_Addon class.
 * Make sure the class is properly set-up.
 * The WPBakery_Image_Hover_Addon class is a singleton
 * so we can directly access the one true WPBakery_Image_Hover_Addon object using this function.
 *
 * @return object WPBakery_Image_Hover_Addon
 */
function wpbakery_image_hover_add_on() {
	return WPBakery_Image_Hover_Addon::get_instance();
}

/**
 * Instantiate WPBakery_Image_Hover_Addon class.
 *
 * @since 1.0
 * @return void
 */
function wpbakery_image_hover_add_on_activate() {
	wpbakery_image_hover_add_on();
}
add_action( 'after_setup_theme', 'wpbakery_image_hover_add_on_activate', 11 );

/**
 * Initialize image hover add-on once WPB elements are loaded.
 *
 * @since 1.0
 * @return void
 */
function init_wpbakery_image_hover_add_on() {
	require_once WPB_IMAGE_HOVER_PLUGIN_DIR . 'inc/image-hover-add-on.php';
}
add_action( 'init', 'init_wpbakery_image_hover_add_on', 12 );

/**
 * Auto activate elements on plugin activation.
 *
 * @since 1.0
 * @return void
 */
function auto_activate_image_hover_add_on() {

	// Auto activate element.
	if ( function_exists( 'wpbakery_auto_activate_element' ) ) {
		wpbakery_auto_activate_element( 'image_hover_add_on' );
	}

	$version = get_option( 'image_hover_add_on_version', false );

	if ( ! $version && class_exists( 'Fusion_Cache' ) ) {

		// Clear cache if no version number found.
		$fusion_cache = new Fusion_Cache();
		$fusion_cache->reset_all_caches();

	} elseif ( version_compare( WPB_IMAGE_HOVER_VERSION, $version, '>' ) && class_exists( 'Fusion_Cache' ) ) {

		// Clear cache as the version from database is different than current version.
		$fusion_cache = new Fusion_Cache();
		$fusion_cache->reset_all_caches();
	}

	// Update current version number to database.
	update_option( 'image_hover_add_on_version', WPB_IMAGE_HOVER_VERSION );
}

register_activation_hook( WPB_IMAGE_HOVER_PLUGIN_FILE, 'auto_activate_image_hover_add_on' );
