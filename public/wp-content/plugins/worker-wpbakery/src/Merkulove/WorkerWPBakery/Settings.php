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

use Merkulove\WorkerWPBakery;

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * SINGLETON: Class used to implement plugin settings.
 *
 * @since 1.0.0
 * @author Alexandr Khmelnytsky (info@alexander.khmelnitskiy.ua)
 **/
final class Settings {

	/**
	 * WorkerWPBakery Plugin settings.
	 *
	 * @var array()
	 * @since 1.0.0
	 **/
	public $options = [];

	/**
	 * The one true Settings.
	 *
	 * @var Settings
	 * @since 1.0.0
	 **/
	private static $instance;

	/**
	 * Sets up a new Settings instance.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	private function __construct() {

	}

	/**
	 * Render Tabs Headers.
	 *
	 * @param string $current - Selected tab key.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function render_tabs( $current = 'general' ) {

		/** Tabs array. */
		$tabs = [];

		$tabs['status'] = [
			'icon' => 'info',
			'name' => esc_html__( 'Status', 'worker-wpbakery' )
		];

		/** Activation tab enable only if plugin have Envato ID. */
		$plugin_id = EnvatoItem::get_instance()->get_id();
		if ( (int)$plugin_id > 0 ) {
			$tabs['activation'] = [
				'icon' => 'vpn_key',
				'name' => esc_html__( 'Activation', 'worker-wpbakery' )
			];
        }

		$tabs['uninstall'] = [
			'icon' => 'delete_sweep',
			'name' => esc_html__( 'Uninstall', 'worker-wpbakery' )
		];

		/** Render Tabs. */
		?>
        <aside class="mdc-drawer">
            <div class="mdc-drawer__content">
                <nav class="mdc-list">

                    <div class="mdc-drawer__header mdc-plugin-fixed">
                        <!--suppress HtmlUnknownAnchorTarget -->
                        <a class="mdc-list-item mdp-plugin-title" href="#wpwrap">
                            <i class="mdc-list-item__graphic" aria-hidden="true">
                                <img src="<?php echo esc_attr( WorkerWPBakery::$url . 'images/logo-color.svg' ); ?>" alt="<?php echo esc_html__( 'WorkerWPBakery', 'worker-wpbakery' ) ?>">
                            </i>
                            <span class="mdc-list-item__text">
                                <?php echo esc_html__( 'Worker', 'worker-wpbakery' ) ?>
                            </span>
                            <span class="mdc-list-item__text">
                                <sup> <?php echo esc_html__( 'ver.', 'worker-wpbakery' ) . esc_html( WorkerWPBakery::$version ); ?></sup>
                            </span>
                        </a>
                        <button type="submit" name="submit" id="submit"
                                class="mdc-button mdc-button--dense mdc-button--raised">
                            <span class="mdc-button__label"><?php echo esc_html__( 'Save changes', 'worker-wpbakery' ) ?></span>
                        </button>
                    </div>

                    <hr class="mdc-plugin-menu">
                    <hr class="mdc-list-divider">
                    <h6 class="mdc-list-group__subheader"><?php echo esc_html__( 'Plugin settings', 'worker-wpbakery' ) ?></h6>

					<?php

					// Plugin settings tabs
					foreach ( $tabs as $tab => $value ) {
						$class = ( $tab == $current ) ? ' mdc-list-item--activated' : '';
						echo "<a class='mdc-list-item " . esc_attr( $class ) . "' href='?page=mdp_worker_wpbakery_settings&tab=" . esc_attr( $tab ) . "'><i class='material-icons mdc-list-item__graphic' aria-hidden='true'>" . esc_attr( $value['icon'] ) . "</i><span class='mdc-list-item__text'>" . esc_attr( $value['name'] ) . "</span></a>";
					}

					/** Helpful links. */
					$this->support_link();

					/** Activation Status. */
					PluginActivation::get_instance()->display_status();

					?>
                </nav>
            </div>
        </aside>
		<?php
	}

	/**
	 * Displays useful links for an activated and non-activated plugin.
	 *
	 * @since 1.0.0
     *
     * @return void
	 **/
	public function support_link() { ?>

        <hr class="mdc-list-divider">
        <h6 class="mdc-list-group__subheader"><?php echo esc_html__( 'Helpful links', 'worker-wpbakery' ) ?></h6>

        <a class="mdc-list-item" href="https://docs.merkulov.design/tag/worker/" target="_blank">
            <i class="material-icons mdc-list-item__graphic" aria-hidden="true">collections_bookmark</i>
            <span class="mdc-list-item__text"><?php echo esc_html__( 'Documentation', 'worker-wpbakery' ) ?></span>
        </a>

		<?php if ( PluginActivation::get_instance()->is_activated() ) : /** Activated. */ ?>
            <a class="mdc-list-item" href="https://1.envato.market/worker-wpbakery-support" target="_blank">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">mail</i>
                <span class="mdc-list-item__text"><?php echo esc_html__( 'Get help', 'worker-wpbakery' ) ?></span>
            </a>
            <a class="mdc-list-item" href="https://1.envato.market/cc-downloads" target="_blank">
                <i class="material-icons mdc-list-item__graphic" aria-hidden="true">thumb_up</i>
                <span class="mdc-list-item__text"><?php echo esc_html__( 'Rate this plugin', 'worker-wpbakery' ) ?></span>
            </a>
		<?php endif; ?>

        <a class="mdc-list-item" href="https://1.envato.market/cc-merkulove" target="_blank">
            <i class="material-icons mdc-list-item__graphic" aria-hidden="true">store</i>
            <span class="mdc-list-item__text"><?php echo esc_html__( 'More plugins', 'worker-wpbakery' ) ?></span>
        </a>
		<?php

	}

	/**
	 * Add plugin settings page.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function add_settings_page() {

		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'admin_init', [ $this, 'settings_init' ] );

	}

	/**
	 * Generate Settings Page.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function settings_init() {

		/** Status Tab. */
		StatusTab::get_instance()->add_settings();

		/** Activation Tab. */
		PluginActivation::get_instance()->add_settings();

		/** Uninstall Tab. */
		UninstallTab::get_instance()->add_settings();

	}

	/**
	 * Add admin menu for plugin settings.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function add_admin_menu() {

		add_submenu_page(
			'options-general.php',
			esc_html__( 'Worker for WPBakery Settings', 'worker-wpbakery' ),
			esc_html__( 'Worker for WPBakery', 'worker-wpbakery' ),
			'manage_options',
			'mdp_worker_wpbakery_settings',
			[ $this, 'options_page' ]
		);

	}

	/**
	 * Plugin Settings Page.
	 *
	 * @since 1.0.0
	 * @access public
	 **/
	public function options_page() {

		/** User rights check. */
		if ( ! current_user_can( 'manage_options' ) ) { return; } ?>

        <!--suppress HtmlUnknownTarget -->
        <form action='options.php' method='post'>
            <div class="wrap">

				<?php
				$tab = 'status'; // Default tab
				if ( isset ( $_GET['tab'] ) ) { $tab = $_GET['tab']; }

				/** Render "WorkerWPBakery settings saved!" message. */
				$this->render_nags();

				/** Render Tabs Headers. */
				?><section class="mdp-aside"><?php $this->render_tabs( $tab ); ?></section><?php

				/** Render Tabs Body. */
				?><section class="mdp-tab-content"><?php

                    /** Activation Tab. */
                    if ( $tab == 'activation' ) {
						settings_fields( 'WorkerWPBakeryActivationOptionsGroup' );
						do_settings_sections( 'WorkerWPBakeryActivationOptionsGroup' );
						PluginActivation::get_instance()->render_pid();

                    /** Status tab. */
					} elseif ( $tab == 'status' ) {
						echo '<h3>' . esc_html__( 'System Requirements', 'worker-wpbakery' ) . '</h3>';
						StatusTab::get_instance()->render_form();

                    /** Uninstall Tab. */
					} elseif ( $tab == 'uninstall' ) {
						echo '<h3>' . esc_html__( 'Uninstall Settings', 'worker-wpbakery' ) . '</h3>';
						UninstallTab::get_instance()->render_form();
					}

					?>
                </section>
            </div>
        </form>

		<?php
	}

	/**
	 * Render "Settings Saved" nags.
	 *
	 * @since 1.0.0
     *
     * @return void
	 **/
	public function render_nags() {

		if ( ! isset( $_GET['settings-updated'] ) ) { return; }

		if ( strcmp( $_GET['settings-updated'], "true" ) == 0 ) {

			/** Render "Settings Saved" message. */
			UI::get_instance()->render_snackbar( esc_html__( 'Settings saved!', 'worker-wpbakery' ) );

		}

		if ( ! isset( $_GET['tab'] ) ) { return; }

		if ( strcmp( $_GET['tab'], "activation" ) == 0 ) {

			if ( PluginActivation::get_instance()->is_activated() ) {

				/** Render "Activation success" message. */
				UI::get_instance()->render_snackbar( esc_html__( 'Plugin activated successfully.', 'worker-wpbakery' ), 'success', 5500 );

			} else {

				/** Render "Activation failed" message. */
				UI::get_instance()->render_snackbar( esc_html__( 'Invalid purchase code.', 'worker-wpbakery' ), 'error', 5500 );

			}

		}

	}

	/**
	 * Main Settings Instance.
	 *
	 * Insures that only one instance of Settings exists in memory at any one time.
	 *
	 * @static
	 * @return Settings
	 * @since 1.0.0
	 **/
	public static function get_instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Settings ) ) {
			self::$instance = new Settings;
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
		_doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be cloned.', 'worker-wpbakery' ), '1.0.1' );
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
		_doing_it_wrong( __FUNCTION__, esc_html__( 'The whole idea of the singleton design pattern is that there is a single object therefore, we don\'t want the object to be unserialized.', 'worker-wpbakery' ), '1.0.1' );
	}

} // End Class Settings.
