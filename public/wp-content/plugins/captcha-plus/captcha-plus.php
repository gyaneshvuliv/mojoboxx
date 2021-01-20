<?php
/*
Plugin Name: Captcha Plus by BestWebSoft
Plugin URI: https://bestwebsoft.com/products/wordpress/plugins/captcha/
Description: #1 super security anti-spam captcha plugin for WordPress forms.
Author: BestWebSoft
Text Domain: captcha-plus
Domain Path: /languages
Version: 5.0.9
Author URI: https://bestwebsoft.com/
License: Proprietary
*/

$cptch_path = dirname( __FILE__ );

if ( file_exists( $cptch_path . '/includes/envato-update.php' ) )
	require_once( $cptch_path . '/includes/envato-update.php' );

if ( ! function_exists( 'cptchpls_admin_menu' ) ) {
	function cptchpls_admin_menu() {
		global $submenu, $wp_version, $cptch_plugin_info;

		if ( ! is_plugin_active( 'captcha-pro/captcha_pro.php' ) ) {
			$settings_page = add_menu_page(
                __( 'Captcha Plus Settings', 'captcha-plus' ),
                'Captcha',
                'manage_options',
                'captcha-plus.php',
                'cptch_page_router',
                'none'
            );

			add_submenu_page(
                'captcha-plus.php',
                __( 'Captcha Plus Settings', 'captcha-plus' ),
                __( 'Settings', 'captcha-plus' ),
                'manage_options',
                'captcha-plus.php',
                'cptch_page_router'
            );

			$packages_page = add_submenu_page(
                'captcha-plus.php',
                __( 'Captcha Plus Packages', 'captcha-plus' ),
                __( 'Packages', 'captcha-plus' ),
                'manage_options',
                'captcha-packages.php',
                'cptch_page_router'
            );

			$whitelist_page = add_submenu_page(
                'captcha-plus.php',
                __( 'Captcha Plus Whitelist', 'captcha-plus' ),
                __( 'Whitelist', 'captcha-plus' ),
                'manage_options',
                'captcha-whitelist.php',
                'cptch_page_router'
            );

			add_submenu_page(
                'captcha-plus.php',
                'BWS Panel',
                'BWS Panel',
                'manage_options',
                'cptch-bws-panel',
                'bws_add_menu_render'
            );

			add_action( "load-{$settings_page}", 'cptch_add_tabs' );
			add_action( "load-{$packages_page}", 'cptch_add_tabs' );
			add_action( "load-{$whitelist_page}", 'cptch_add_tabs' );
		}
	}
}

/* add help tab */
if ( ! function_exists( 'cptch_add_tabs' ) ) {
	function cptch_add_tabs() {
		$args = array(
			'id'		=> 'cptch',
			'section'	=> '200538879'
		);
		bws_help_tab( get_current_screen(), $args );
	}
}

if ( ! function_exists( 'cptchpls_plugins_loaded' ) ) {
	function cptchpls_plugins_loaded() {
		/* Internationalization */
		load_plugin_textdomain( 'captcha-plus', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}

if ( ! function_exists ( 'cptchpls_init' ) ) {
	function cptchpls_init() {
		global $cptch_plugin_info, $cptch_ip_in_whitelist, $cptch_options;

		require_once( dirname( __FILE__ ) . '/bws_menu/bws_include.php' );
		bws_include_init( plugin_basename( __FILE__ ) );

		$free = 'captcha-bws/captcha-bws.php';
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( $free ) ) {
			deactivate_plugins( $free );
		}

		if ( empty( $cptch_plugin_info ) ) {
			if ( ! function_exists( 'get_plugin_data' ) )
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			$cptch_plugin_info = get_plugin_data( __FILE__ );
		}

		/* Function check if plugin is compatible with current WP version */
		bws_wp_min_version_check( plugin_basename( __FILE__ ), $cptch_plugin_info, '4.5' );

		$is_admin = is_admin() && ! defined( 'DOING_AJAX' );

		/* Call register settings function */
		$pages = array(
			'captcha-plus.php',
			'captcha-packages.php',
			'captcha-whitelist.php'
		);

		if ( ! $is_admin || ( isset( $_GET['page'] ) && in_array( $_GET['page'], $pages ) ) ) {
			cptch_settings();
		}
		if ( $is_admin ) {
			return;
		}
		$user_loggged_in		= is_user_logged_in();
		$cptch_ip_in_whitelist	= cptch_whitelisted_ip();

		/*
		 * Add the CAPTCHA to the WP login form
		 */
		if ( $cptch_options['forms']['wp_login']['enable'] ) {
			add_action( 'login_form', 'cptch_login_form' );
			if ( ! $cptch_ip_in_whitelist ) {
				add_filter( 'authenticate', 'cptch_login_check', 21, 1 );
				add_filter( 'wp_authenticate_user', 'cptch_login_check', 21, 1 );
			}
		}

		/*
		 * Add the CAPTCHA to the WP register form
		 */
		if ( $cptch_options['forms']['wp_register']['enable'] ) {
			add_action( 'register_form', 'cptch_register_form' );
			add_action( 'signup_extra_fields', 'wpmu_cptch_register_form' );
			add_action( 'signup_blogform', 'wpmu_cptch_register_form' );

			if ( ! $cptch_ip_in_whitelist ) {
				add_filter( 'registration_errors', 'cptch_register_check', 9, 1 );
				if ( is_multisite() ) {
					add_filter( 'wpmu_validate_user_signup', 'cptch_register_validate' );
					add_filter( 'wpmu_validate_blog_signup', 'cptch_register_validate' );
				}
			}
		}

		/*
		 * Add the CAPTCHA into the WP lost password form
		 */
		if ( $cptch_options['forms']['wp_lost_password']['enable'] ) {
			add_action( 'lostpassword_form', 'cptch_lostpassword_form' );
			if ( ! $cptch_ip_in_whitelist ) {
				add_filter( 'allow_password_reset', 'cptch_lostpassword_check' );
			}
		}

		/*
		 * Add the CAPTCHA to the WP comments form
		 */
		if ( cptch_captcha_is_needed( 'wp_comments', $user_loggged_in ) ) {
			/*
			 * Common hooks to add necessary actions for the WP comment form,
			 * but some themes don't contain these hooks in their comments form templates
			 */
			add_action( 'comment_form_after_fields', 'cptch_comment_form_wp3', 1 );
			add_action( 'comment_form_logged_in_after', 'cptch_comment_form_wp3', 1 );
			/*
			 * Try to display the CAPTCHA before the close tag </form>
			 * in case if hooks 'comment_form_after_fields' or 'comment_form_logged_in_after'
			 * are not included to the theme comments form template
			 */
			add_action( 'comment_form', 'cptch_comment_form' );
			if ( ! $cptch_ip_in_whitelist )
				add_filter( 'preprocess_comment', 'cptch_comment_post' );
		}

		/*
		 * Add the CAPTCHA to the Contact Form by BestWebSoft plugin forms
		 */
		if ( $cptch_options['forms']['bws_contact']['enable'] ) {
			add_filter( 'cntctfrmpr_display_captcha', 'cptch_cf_form', 10, 2 );
			add_filter( 'cntctfrm_display_captcha', 'cptch_cf_form', 10, 2 );
			if ( ! $cptch_ip_in_whitelist ) {
				add_filter( 'cntctfrm_check_form', 'cptch_check_bws_contact_form' );
				add_filter( 'cntctfrmpr_check_form', 'cptch_check_bws_contact_form' );
			}
		}

		/*
		 * Add the CAPTCHA to the Contact Form 7 plugin form
		 */
		if ( $cptch_options['forms']['cf7_contact']['enable'] ) {
			require_once( dirname( __FILE__ ) . '/includes/captcha_for_cf7.php' );
			/* add shortcode handler */
			wpcf7_add_shortcode_bws_captcha();
			if ( ! $cptch_ip_in_whitelist ) {
				/* validation for captcha */
				add_filter( 'wpcf7_validate_bwscaptcha', 'wpcf7_bws_captcha_validation_filter', 10, 2 );
				/* add messages for Captha errors */
				add_filter( 'wpcf7_messages', 'wpcf7_bwscaptcha_messages' );
				/* add warning message */
				add_action( 'wpcf7_admin_notices', 'wpcf7_bwscaptcha_display_warning_message' );
			}
		}
	}
}

if ( ! function_exists ( 'cptchpls_admin_init' ) ) {
	function cptchpls_admin_init() {
		global $bws_plugin_info, $cptch_plugin_info, $bws_shortcode_list;
		/* Add variable for bws_menu */
		if ( empty( $bws_plugin_info ) ) {
			$bws_plugin_info = array( 'id' => '145', 'version' => $cptch_plugin_info["Version"] );
		}
		if ( ! function_exists( 'deactivate_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		/**
		 * add CAPTCHA to global $bws_shortcode_list
		 * @since 4.2.3
		 */
		$bws_shortcode_list['cptch'] = array( 'name' => 'Captcha' );

		/**
		 * Add BWS CAPTCHA shortcode button in to the tool panel on the Contact Form 7 pages
		 * @since 4.2.3
		 */
		if ( ! isset( $_REQUEST['page'] ) || ! preg_match( '/wpcf7/', $_REQUEST['page'] ) ) {
			return;
		}
		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}
		if ( $cptch_options['forms']['cf7_contact']['enable'] ) {
			require_once( dirname( __FILE__ ) . '/includes/captcha_for_cf7.php' );
			wpcf7_add_tag_generator_bws_captcha();
		}
	}
}

if ( ! function_exists( 'cptch_create_table' ) ) {
	function cptch_create_table() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}cptch_whitelist` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`ip` CHAR(31) NOT NULL,
			`ip_from_int` BIGINT,
			`ip_to_int` BIGINT,
			`add_time` DATETIME,
			PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
		dbDelta( $sql );

		$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}cptch_images` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` CHAR(100) NOT NULL,
			`package_id` INT NOT NULL,
			`number` INT NOT NULL,
			PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
		dbDelta( $sql );

		$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}cptch_packages` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`name` CHAR(100) NOT NULL,
			`folder` CHAR(100) NOT NULL,
			`settings` LONGTEXT NOT NULL,
			`user_settings` LONGTEXT NOT NULL,
			`add_time` DATETIME NOT NULL,
			PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
		dbDelta( $sql );

		$sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}cptch_responses` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
			`response` CHAR(100) NOT NULL,
			`add_time` INT(20) NOT NULL,
			PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
		dbDelta( $sql );

		/* remove unnecessary columns from 'whitelist' table */
		$column_exists = $wpdb->query( "SHOW COLUMNS FROM `{$wpdb->prefix}cptch_whitelist` LIKE 'ip_from'" );
		if ( 0 < $column_exists ) {
			$wpdb->query( "ALTER TABLE `{$wpdb->prefix}cptch_whitelist` DROP `ip_from`;" );
		}
		$column_exists = $wpdb->query( "SHOW COLUMNS FROM `{$wpdb->prefix}cptch_whitelist` LIKE 'ip_to'" );
		if ( 0 < $column_exists ) {
			$wpdb->query( "ALTER TABLE `{$wpdb->prefix}cptch_whitelist` DROP `ip_to`;" );
		}
		/* add new columns to 'whitelist' table */
		$column_exists = $wpdb->query( "SHOW COLUMNS FROM `{$wpdb->prefix}cptch_whitelist` LIKE 'add_time'" );
		if ( 0 == $column_exists ) {
			$wpdb->query( "ALTER TABLE `{$wpdb->prefix}cptch_whitelist` ADD `add_time` DATETIME;" );
		}
		/* add unique key */
		if ( 0 == $wpdb->query( "SHOW KEYS FROM `{$wpdb->prefix}cptch_whitelist` WHERE Key_name='ip'" ) ) {
			$wpdb->query( "ALTER TABLE `{$wpdb->prefix}cptch_whitelist` ADD UNIQUE(`ip`);" );
		}
		/* remove not necessary indexes */
		$indexes = $wpdb->get_results( "SHOW INDEX FROM `{$wpdb->prefix}cptch_whitelist` WHERE Key_name Like '%ip_%'" );
		if ( ! empty( $indexes ) ) {
			$query = "ALTER TABLE `{$wpdb->prefix}cptch_whitelist`";
			$drop = array();
			foreach( $indexes as $index )
				$drop[] = " DROP INDEX {$index->Key_name}";
			$query .= implode( ',', $drop );
			$wpdb->query( $query );
		}

		/**
		 * add new columns to the 'cptch_packages' table
		 * @since 4.2.3
		 */
		$column_exists = $wpdb->query( "SHOW COLUMNS FROM `{$wpdb->base_prefix}cptch_packages` LIKE 'settings'" );
		if ( 0 == $column_exists ) {
			$wpdb->query( "ALTER TABLE `{$wpdb->base_prefix}cptch_packages` ADD (`settings` LONGTEXT NOT NULL, `user_settings` LONGTEXT NOT NULL, `add_time` DATETIME NOT NULL );" );
			$wpdb->update(
				"{$wpdb->base_prefix}cptch_packages",
				array( 'add_time' => current_time( 'mysql' ) ),
				array( 'add_time' => '0000-00-00 00:00:00' )
			);
		}
	}
}

/**
 * Activation plugin function
 */
if ( ! function_exists( 'cptch_plugin_activate' ) ) {
	function cptch_plugin_activate() {
		global $wpdb;
		/* Activation function for network, check if it is a network activation - if so, run the activation function for each blog id */
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			$old_blog = $wpdb->blogid;

			/* Get all blog ids */
			$blogids = $wpdb->get_col( "SELECT `blog_id` FROM $wpdb->blogs" );
			foreach ( $blogids as $blog_id ) {
				switch_to_blog( $blog_id );
				cptch_create_table();
				cptch_settings();
			}

			switch_to_blog( 1 );
			register_uninstall_hook( __FILE__, 'cptch_delete_options' );
			switch_to_blog( $old_blog );
		} else {
			cptch_create_table();
			cptch_settings();
			register_uninstall_hook( __FILE__, 'cptch_delete_options' );
		}

		/* add all scheduled hooks */
		cptch_add_scheduled_hook();
	}
}

/* Register settings function */
if ( ! function_exists( 'cptch_settings' ) ) {
	function cptch_settings() {
		global $cptch_options, $cptch_plugin_info, $wpdb;

		if ( empty( $cptch_plugin_info ) ) {
			if ( ! function_exists( 'get_plugin_data' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}
			$cptch_plugin_info = get_plugin_data( __FILE__ );
		}

		$need_update = false;
		$db_version = 'plus-1.7';

		$cptch_options = get_option( 'cptch_options' );

		if ( empty( $cptch_options ) ) {
			if ( ! function_exists( 'cptch_get_default_options' ) ) {
				require_once( dirname( __FILE__ ) . '/includes/helpers.php' );
			}
			$cptch_options = cptch_get_default_options();
			update_option( 'cptch_options', $cptch_options );
		}

		if (
			empty( $cptch_options['plugin_option_version'] ) ||
			$cptch_options['plugin_option_version'] != 'plus-' . $cptch_plugin_info["Version"]
		) {
			$need_update = true;
			if ( is_multisite() ) {
				switch_to_blog( 1 );
				register_uninstall_hook( __FILE__, 'cptch_delete_options' );
				restore_current_blog();
			} else {
				register_uninstall_hook( __FILE__, 'cptch_delete_options' );
			}

			if ( ! function_exists( 'cptch_get_default_options' ) ) {
				require_once( dirname( __FILE__ ) . '/includes/helpers.php' );
			}
			$default_options = cptch_get_default_options();

			$cptch_options = cptch_parse_options( $cptch_options, $default_options );

			/* Enabling notice about possible conflict with W3 Total Cache */
			if ( version_compare( preg_replace( '/plus-/', '', $cptch_options['plugin_option_version'] ), '4.2.7', '<=' ) ) {
				$cptch_options['w3tc_notice'] = 1;
			}
		}

		/* Update tables when update plugin and tables changes*/
		if ( empty( $cptch_options['plugin_db_version'] ) || $cptch_options['plugin_db_version'] != $db_version ) {
			$need_update = true;
			cptch_create_table();

			if ( empty( $cptch_options['plugin_db_version'] ) ) {
				if ( ! class_exists( 'Cptch_Package_Loader' ) ) {
					require_once( dirname( __FILE__ ) . '/includes/class-cptch-package-loader.php' );
				}
				$package_loader = new Cptch_Package_Loader();
				$package_loader->save_packages( dirname( __FILE__ ) . '/images/package', false );
			}

			$cptch_options['plugin_db_version'] = $db_version;
		}

		if ( $need_update ) {
			update_option( 'cptch_options', $cptch_options );
		}
	}
}

/* Generate key */
if ( ! function_exists( 'cptch_generate_key' ) ) {
	function cptch_generate_key( $lenght = 15 ) {
		global $cptch_options;
		/* Under the string $simbols you write all the characters you want to be used to randomly generate the code. */
		$simbols = get_bloginfo( "url" ) . time();
		$simbols_lenght = strlen( $simbols );
		$simbols_lenght--;
		$str_key = NULL;
		for ( $x = 1; $x <= $lenght; $x++ ) {
			$position = rand( 0, $simbols_lenght );
			$str_key .= substr( $simbols, $position, 1 );
		}

		$cptch_options['str_key']['key'] = md5( $str_key );
		$cptch_options['str_key']['time'] = time();
		update_option( 'cptch_options', $cptch_options );
	}
}

if ( ! function_exists( 'cptch_whitelisted_ip' ) ) {
	function cptch_whitelisted_ip() {
		global $cptch_options, $wpdb;
		$checked = false;
		if ( empty( $cptch_options ) )
			$cptch_options = get_option( 'cptch_options' );
		$table = 1 == $cptch_options['use_limit_attempts_whitelist'] ? 'lmtttmpts_whitelist' : 'cptch_whitelist';
		$whitelist_exist = $wpdb->query( "SHOW TABLES LIKE '{$wpdb->prefix}{$table}'" );
		if ( ! empty( $whitelist_exist ) ) {
			$ip = cptch_get_ip();
			if ( ! empty( $ip ) ) {
				$column_exists = $wpdb->query( "SHOW COLUMNS FROM `{$wpdb->prefix}{$table}` LIKE 'ip_from_int'" );
				/* LimitAttempts Free hasn't `ip_from_int`, `ip_to_int` COLUMNS */
				if ( 0 == $column_exists ) {
					$result = $wpdb->get_var(
						"SELECT `id`
						FROM `{$wpdb->prefix}{$table}`
						WHERE `ip` = '{$ip}' LIMIT 1;"
					);
				} else {
					$ip_int = sprintf( '%u', ip2long( $ip ) );
					$result = $wpdb->get_var(
						"SELECT `id`
						FROM `{$wpdb->prefix}{$table}`
						WHERE ( `ip_from_int` <= {$ip_int} AND `ip_to_int` >= {$ip_int} ) OR `ip` LIKE '{$ip}' LIMIT 1;"
					);
				}
				$checked = is_null( $result ) || ! $result ? false : true;
			} else {
				$checked = false;
			}
		}
		return $checked;
	}
}

/**
 * Function displays captcha admin-pages
 * @see   groups_action_create_group(),
 * @since 4.3.1
 * @return void
 */
if ( ! function_exists( 'cptch_page_router' ) ) {
	function cptch_page_router() { ?>
		<div class="wrap">
			<?php if ( 'captcha-plus.php' == $_GET['page'] ) {
				if ( ! class_exists( 'Bws_Settings_Tabs' ) )
                    require_once( dirname( __FILE__ ) . '/bws_menu/class-bws-settings.php' );
				require_once( dirname( __FILE__ ) . '/includes/class-cptch-settings-tabs.php' );
				$page = new Cptch_Settings_Tabs( plugin_basename( __FILE__ ) ); ?>
				<h1><?php _e( 'Captcha Plus Settings', 'captcha-plus' ); ?></h1>
				<noscript>
					<div class="error below-h2">
						<p><strong><?php _e( 'WARNING', 'captcha-plus' ); ?>:</strong> <?php _e( 'The plugin works correctly only if JavaScript is enabled.', 'captcha-plus' ); ?></p>
					</div>
				</noscript>
				<?php $page->display_content();
			} else {
				switch ( $_GET['page'] ) {
					case 'captcha-packages.php':
						if ( ! class_exists( 'Cptch_Package_Loader' ) ) {
							require_once( dirname( __FILE__ ) . '/includes/class-cptch-package-list.php' );
						}

						$page = new Cptch_Package_List();
						break;
					case 'captcha-whitelist.php':
						require_once( dirname( __FILE__ ) . '/includes/helpers.php' );
						require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
						require_once( dirname( __FILE__ ) . '/includes/class-cptch-whitelist.php' );

						$limit_attempts_info = cptch_get_plugin_status( array( 'limit-attempts/limit-attempts.php', 'limit-attempts-pro/limit-attempts-pro.php' ), get_plugins(), is_network_admin() );
						$page = new Cptch_Whitelist( plugin_basename( __FILE__ ), $limit_attempts_info );
						break;
					default:
						/* closing of the div.wrap */
						echo '</div>';
						return;
				}
				$page->display_content();
			} ?>
		</div>
	<?php }
}

if ( ! function_exists( 'cptch_get_ip' ) ) {
	function cptch_get_ip() {
		$ip = '';
		if ( isset( $_SERVER ) ) {
			$server_vars = array( 'HTTP_X_REAL_IP', 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR' );
			foreach( $server_vars as $var ) {
				if ( isset( $_SERVER[ $var ] ) && ! empty( $_SERVER[ $var ] ) ) {
					if ( filter_var( $_SERVER[ $var ], FILTER_VALIDATE_IP ) ) {
						$ip = $_SERVER[ $var ];
						break;
					} else { /* if proxy */
						$ip_array = explode( ',', $_SERVER[ $var ] );
						if ( is_array( $ip_array ) && ! empty( $ip_array ) && filter_var( $ip_array[0], FILTER_VALIDATE_IP ) ) {
							$ip = $ip_array[0];
							break;
						}
					}
				}
			}
		}
		return $ip;
	}
}

/************** WP LOGIN FORM HOOKS ********************/
if ( ! function_exists( 'cptch_login_form' ) ) {
	function cptch_login_form() {
		global $cptch_ip_in_whitelist;
		if ( ! $cptch_ip_in_whitelist ) {
			if ( '' == session_id() ) {
			@session_start();
			}

			if ( isset( $_SESSION['cptch_login'] ) ) {
				unset( $_SESSION['cptch_login'] );
			}
		}

		echo cptch_display_captcha_custom( 'wp_login', 'cptch_wp_login' ) . '<br />';
		return true;
	}
}

if ( ! function_exists( 'cptch_login_check' ) ) {
	function cptch_login_check( $user ) {
		if (
			! isset( $_POST['wp-submit'] ) ||
			( isset( $_SESSION['cptch_login'] ) && true === $_SESSION["cptch_login"] ) ||
			cptch_is_limit_login_attempts_active()
		) {
			return $user;
		}

		if ( '' == session_id() ) {
			@session_start();
		}

		$user = cptch_check_custom_form( $user, 'wp_error', 'wp_login' );
		$_SESSION['cptch_login'] = is_wp_error( $user );

		return $user;
	}
}

/**
 *
 * @since 4.2.3
 */
if ( ! function_exists( 'cptch_is_limit_login_attempts_active' ) ) {
	function cptch_is_limit_login_attempts_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		return
			is_plugin_active( 'limit-login-attempts/limit-login-attempts.php' ) &&
			isset( $_REQUEST['loggedout'] ) &&
			isset( $_REQUEST['cptch_number'] ) &&
			'' == $_REQUEST['cptch_number'];
	}
}

/************** WP REGISTER FORM HOOKS ********************/

if ( ! function_exists( 'cptch_register_form' ) ) {
	function cptch_register_form() {
		echo cptch_display_captcha_custom( 'wp_register', 'cptch_wp_register' ) . '<br />';
		return true;
	}
}

if ( ! function_exists ( 'wpmu_cptch_register_form' ) ) {
	function wpmu_cptch_register_form( $errors ) {
		global $cptch_options, $cptch_ip_in_whitelist;

		/* the captcha html - register form */
		echo '<div class="cptch_block">';
		if ( '' != $cptch_options['title'] ) {
			echo '<span class="cptch_title">' . $cptch_options['title'] . '<span class="required"> ' . $cptch_options['required_symbol'] . '</span></span>';
		}
		if ( ! $cptch_ip_in_whitelist ) {
			if ( is_wp_error( $errors ) ) {
				$error_codes = $errors->get_error_codes();
				if ( is_array( $error_codes ) && ! empty( $error_codes ) ) {
					foreach ( $error_codes as $error_code ) {
						if ( 'captcha_' == substr( $error_code, 0, 8 ) ) {
							$error_message = $errors->get_error_message( $error_code );
							echo '<p class="error">' . $error_message . '</p>';
						}
					}
				}
			}
			echo cptch_display_captcha( 'wp_register' );
		} else {
			echo '<label class="cptch_whitelist_message">' . $cptch_options['whitelist_message'] . '</label>';
		}
		echo '</div><br />';
	}
}

if ( ! function_exists ( 'cptch_register_check' ) ) {
	function cptch_register_check( $error ) {
		return cptch_check_custom_form( $error, 'wp_error', 'wp_register' );
	}
}

if ( ! function_exists( 'cptch_register_validate' ) ) {
	function cptch_register_validate( $results ) {
		$results['errors'] = cptch_check_custom_form( $results['errors'], 'wp_error', 'wp_register' );
		if ( $results['errors']->get_error_messages() ) {
			$cptch_error = $results['errors']->get_error_message( 'cptch_error' );
			$lmtttmpts_error = $results['errors']->get_error_message( 'cptch_error_lmttmpts' );
			$error_message = $cptch_error . '<br>' . $lmtttmpts_error;
			$results['errors']->add( 'generic', $error_message );
		}
		return $results;
	}
}

/************** WP LOST PASSWORD FORM HOOKS ********************/

if ( ! function_exists ( 'cptch_lostpassword_form' ) ) {
	function cptch_lostpassword_form() {
		echo cptch_display_captcha_custom( 'wp_lost_password', 'cptch_wp_lost_password' ) . '<br />';
		return true;
	}
}

if ( ! function_exists ( 'cptch_lostpassword_check' ) ) {
	function cptch_lostpassword_check( $allow ) {
		return cptch_check_custom_form( $allow, 'wp_error', 'wp_lost_password' );
	}
}

/************** WP COMMENT FORM HOOKS ********************/

if ( ! function_exists( 'cptch_comment_form' ) ) {
	function cptch_comment_form() {
		echo cptch_display_captcha_custom( 'wp_comments', 'cptch_wp_comments' );
		return true;
	}
}

if ( ! function_exists( 'cptch_comment_form_wp3' ) ) {
	function cptch_comment_form_wp3() {
		remove_action( 'comment_form', 'cptch_comment_form' );
		echo cptch_display_captcha_custom( 'wp_comments', 'cptch_wp_comments' );
		return true;
	}
}

if ( ! function_exists( 'cptch_comment_post' ) ) {
	function cptch_comment_post( $comment ) {
		/*
		 * added for a compatibility with WP Wall plugin
		 * this does NOT add CAPTCHA to WP Wall plugin,
		 * it just prevents the "Error: You did not enter a Captcha phrase." when submitting a WP Wall comment
		 */
		if ( function_exists( 'WPWall_Widget' ) && isset( $_REQUEST['wpwall_comment'] ) ) {
			return $comment;
		}
		/* Skip the CAPTCHA for comment replies from the admin menu */
		if (
			isset( $_REQUEST['action'] ) &&
			'replyto-comment' == $_REQUEST['action'] &&
			(
				check_ajax_referer( 'replyto-comment', '_ajax_nonce', false ) ||
				check_ajax_referer( 'replyto-comment', '_ajax_nonce-replyto-comment', false )
			)
		)
			return $comment;

		/* Skip the CAPTCHA for trackback or pingback */
		if ( '' != $comment['comment_type'] && 'comment' != $comment['comment_type'] ) {
			return $comment;
		}
		$error = cptch_check_custom_form( true, 'string', 'wp_comments' );

		if ( is_string( $error ) ) {
			wp_die( $error . '<br />' . __( 'Click the BACK button on your browser, and try again.', 'captcha-plus' ) );
		}
		return $comment;
	}
}

/************** BWS CONTACT FORM ********************/
if ( ! function_exists ( 'cptch_cf_form' ) ) {
	function cptch_cf_form( $content = "", $form_slug = 'general' ) {
		return
			( is_string( $content ) ? $content : '' ) .
			cptch_display_captcha_custom( $form_slug );
	}
}

/**
 * @since 4.2.3
 */
if ( ! function_exists( 'cptch_check_bws_contact_form' ) ) {
	function cptch_check_bws_contact_form( $allow ) {
		if ( true !== $allow ) {
			return $allow;
		}
		return cptch_check_custom_form( true, 'wp_error' );
	}
}

/************** DISPLAY CAPTCHA VIA SHORTCODE ********************/

/**
 *
 * @since 4.2.3
 */
if ( ! function_exists( 'cptch_display_captcha_shortcode' ) ) {
	function cptch_display_captcha_shortcode( $args ) {
		global $cptch_options;

		if ( ! is_array( $args ) || empty( $args ) ) {
			return cptch_display_captcha_custom( 'general', 'cptch_shortcode' );
		}
		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}
		$form_slug	= empty( $args["form_slug"] ) ? 'general' : $args["form_slug"];
		$form_slug	= esc_attr( $form_slug );
		$form_slug	= empty( $form_slug ) || ! array_key_exists( $form_slug, $cptch_options['forms'] ) ? 'general' : $form_slug;
		$class_name	= empty( $args["class_name"] ) ? 'cptch_shortcode' : esc_attr( $args["class_name"] );

		return
				'general' == $form_slug ||
				$cptch_options['forms'][ $form_slug ]['enable']
			?
				cptch_display_captcha_custom( $form_slug, $class_name )
			:
				'';
	}
}

/**
 *
 * @since 4.2.3
 */
if ( ! function_exists( 'cptch_shortcode_button_content' ) ) {
	function cptch_shortcode_button_content( $content ) { ?>
		<div id="cptch" style="display:none;">
			<input class="bws_default_shortcode" type="hidden" name="default" value="[bws_captcha]" />
		</div>
	<?php }
}

/************** DISPLAY CAPTCHA VIA FILTER HOOK ********************/
/**
 *
 * @since 4.2.3
 */
if ( ! function_exists( 'cptch_display_filter' ) ) {
	function cptch_display_filter( $content = '', $form_slug = 'general', $class_name = "" ) {
		$args = array(
			'form_slug'		=> $form_slug,
			'class_name'	=> $class_name
		);
		if ( 'general' == $form_slug || cptch_captcha_is_needed( $form_slug, is_user_logged_in() ) ) {
			return $content . cptch_display_captcha_shortcode( $args );
		}
		return $content;
	}
}

if ( ! function_exists( 'cptch_verify_filter' ) ) {
	function cptch_verify_filter( $allow = true, $return_format = 'string', $form_slug = 'general' ) {

		if ( true !== $allow ) {
			return $allow;
		}
		if ( ! in_array( $return_format, array( 'string', 'wp_error' ) ) ) {
			$return_format = 'string';
		}
		if ( 'general' == $form_slug || cptch_captcha_is_needed( $form_slug, is_user_logged_in() ) ) {

			$allow = cptch_check_custom_form( true, $return_format, 'subscriber_captcha_check' );
			return $allow;
		}

		return $allow;
	}
}

/* Functionality of the captcha logic work for custom form */
if ( ! function_exists( 'cptch_display_captcha_custom' ) ) {
	function cptch_display_captcha_custom( $form_slug = 'general', $class_name = "", $input_name = 'cptch_number' ) {
		global $cptch_options, $cptch_ip_in_whitelist;

		if ( empty( $cptch_ip_in_whitelist ) ) {
			$cptch_ip_in_whitelist = cptch_whitelisted_ip();
		}
		if ( empty( $class_name ) ) {
			$label = $tag_open = $tag_close = '';
		} else {
			$label		=
					empty( $cptch_options['title'] )
				?
					''
				:
					'<span class="cptch_title cptch_to_remove">' . $cptch_options['title'] .'<span class="required"> ' . $cptch_options['required_symbol'] . '</span></span>';
			$tag_open	= '<p class="cptch_block">';
			$tag_close	= '</p>';
		}

		if ( $cptch_ip_in_whitelist ) {
			$content = '<label class="cptch_whitelist_message">' . $cptch_options['whitelist_message'] . '</label>';
		} else {

			if ( 'invisible' == $cptch_options['type'] && defined( 'DOING_AJAX' ) && DOING_AJAX ) {

				require_once( dirname( __FILE__ ) . '/includes/invisible.php' );
				$captcha = new Cptch_Invisible();

				if ( ! $captcha->is_errors() ) {
					$content = '<span class="cptch_wrap cptch_ajax_wrap"
						data-cptch-form="' . $form_slug . '"
						data-cptch-class="' . $class_name . '">'
							. $captcha->get_content() .
						'</span>';
				}
			} else {
				$content = cptch_display_captcha( $form_slug, $class_name, $input_name );
			}
		}
		$content = apply_filters( 'cptch_captcha_content', $content );
		return $tag_open . $label . $content . $tag_close;
	}
}

/**
 * Checks the answer for the CAPTCHA
 * @param  mixed   $allow          The result of the pevious checking
 * @param  string  $return_format  The type of the cheking result. Can be set as 'string' or 'wp_error
 * @return mixed                   boolean(true) - in case when the CAPTCHA answer is right, or user`s IP is in the whitelist,
 *                                 string or WP_Error object ( depending on the $return_format variable ) - in case when the CAPTCHA answer is wrong
 */
if ( ! function_exists( 'cptch_check_custom_form' ) ) {
	function cptch_check_custom_form( $allow = true, $return_format = 'string', $form_slug = 'general' ) {
		global $cptch_options, $cptch_ip_in_whitelist;

		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}
		$form_slugs = array(
			'wp_register'				=> 'registration_form_captcha_check',
			'wp_lost_password'			=> 'reset_pwd_form_captcha_check',
			'wp_comments'				=> 'comments_form_captcha_check',
			'bws_contact'				=> 'contact_form_captcha_check',
			'bws_booking'				=> 'booking_form_captcha_check',
			'contact_form_7'			=> 'contact_form_7_captcha_check',
		);

		if ( array_key_exists( $form_slug, $form_slugs ) ) {
			$la_form_slug = $form_slugs[ $form_slug ];
		}
		else {
			$la_form_slug = 'login_form';
		}

		/*
		 * Whether the user's IP is in the whitelist
		 */
		if ( is_null( $cptch_ip_in_whitelist ) ) {
			$cptch_ip_in_whitelist = cptch_whitelisted_ip();
		}
		if ( $cptch_ip_in_whitelist ) {
			return $allow;
		}
		$lmtttmpts_error = ( ! has_filter( 'lmtttmpts_check_ip' ) ) ? '' : apply_filters( 'lmtttmpts_wrong_captcha', $la_form_slug, '' ) ;

		if ( 'invisible' == $cptch_options['type'] ) {
			require_once( dirname( __FILE__ ) . '/includes/invisible.php' );
			$captcha = new Cptch_Invisible();
			$captcha->check();

			if ( $captcha->is_errors() ) {
				$error = $captcha->get_errors();
				if ( 'string' == $return_format ) {
					$error_message = $error->get_error_message();
					if( ! empty( $lmtttmpts_error ) )
					$error_message .= "\n" . $lmtttmpts_error;
					return $error_message;
				} else {
					if ( ! is_wp_error( $error ) ) {
						$error = new WP_Error();
					}
					if ( ! empty( $lmtttmpts_error ) && $la_form_slug != $lmtttmpts_error ) {
						if ( is_wp_error( $error ) ) {
							$error->add( 'cptch_error_lmtttmpts', $lmtttmpts_error );
						} else {
							$error .= '<br />' . $lmtttmpts_error;
						}
					}
					return $error;
				}
			} else {
				return $allow;
			}
		} else {
			/*
			 * Escaping the form slug before using it in case when the form slug
			 * was not sended via function parameters or if we use the CAPTCHA in custom forms
			 */
			if ( empty( $form_slug ) ) {
				$form_slug = isset( $_REQUEST['cptch_form'] ) ? esc_attr( $_REQUEST['cptch_form'] ) : 'general';
			} else {
				$form_slug = esc_attr( $form_slug );
			}
			$form_slug = empty( $form_slug ) || ! array_key_exists( $form_slug, $cptch_options['forms'] ) ? 'general' : $form_slug;

			$error_code = '';

			/* Not enough data to verify the CAPTCHA answer */
			if ( 'slide' == $cptch_options['type'] ) {
				/* Not enough data to verify the CAPTCHA answer */
				if ( empty( $_REQUEST['cptch_result'] ) ) {
					$error_code = 'no_answer';
					/* The CAPTCHA answer is wrong */
				} elseif ( ! cptch_check_slide_captcha_response( $_POST['cptch_result'] ) ) {
					$error_code = 'wrong_answer';
				}
			} else {
				/* The time limit is exhausted */
				if ( cptch_limit_exhausted() ) {
					$error_code = 'time_limit_off';
					/* Not enough data to verify the CAPTCHA answer */
				} elseif (
					empty( $_REQUEST['cptch_result'] ) ||
					! isset( $_REQUEST['cptch_number'] ) ||
					! isset( $_REQUEST['cptch_time'] )
				) {
					$error_code = 'no_answer';
					/* The CAPTCHA answer is wrong */
				} elseif ( 0 !== strcasecmp( trim( cptch_decode( $_REQUEST['cptch_result'], $cptch_options['str_key']['key'], $_REQUEST['cptch_time'] ) ), $_REQUEST['cptch_number'] ) ) {
					$error_code = 'wrong_answer';
				}
			}

			/* The CAPTCHA answer is right */
			if ( empty( $error_code ) ) {
				if ( ! has_filter( 'lmtttmpts_check_ip' ) ) {
					return $allow;
				} else {
					/* check for blocked IP in the Limit Attempts plugin lists */
					$errors = apply_filters( 'lmtttmpts_check_ip', true );
					/* if IP is blocked */
					if ( is_wp_error( $errors ) ) {
						$error_codes = $errors->get_error_codes();
						if ( is_array( $error_codes ) && ! empty( $error_codes ) ) {
							$allow = array();
							foreach ( $error_codes as $error_code )
								$allow[] = $errors->get_error_message( $error_code );
							$allow = implode( '<br />', $check_result );
						}
					} else {
						do_action( 'lmtttmpts_success_captcha', $la_form_slug, cptch_get_ip() );
					}
				}
				return $allow;
			}

			/* Fetch the error message */
			if ( 'string' == $return_format ) {
				$allow = $cptch_options[ $error_code ];
				if( ! empty( $lmtttmpts_error ) )
				$allow .= "\n" . $lmtttmpts_error;
			} else {
				if ( ! is_wp_error( $allow ) ) {
					$allow = new WP_Error();
				}
				$allow->add( 'cptch_error', $cptch_options[ $error_code ] );
				if ( ! empty( $lmtttmpts_error ) && $la_form_slug != $lmtttmpts_error ) {
					if ( is_wp_error( $allow ) ) {
						$allow->add( 'cptch_error_lmtttmpts', $lmtttmpts_error );
					} else {
						$allow .= '<br />' . $lmtttmpts_error;
					}
				}
			}
		}
		return $allow;
	}
}

/* Functionality of the captcha logic work */
if ( ! function_exists( 'cptch_display_captcha' ) ) {
	function cptch_display_captcha( $form_slug = 'general', $class_name = "", $input_name = 'cptch_number' ) {
		global $cptch_options;

		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}

		/**
		 * Escaping function parameters
		 * @since 4.2.3
		 */
		$form_slug	= esc_attr( $form_slug );
		$form_slug	= empty( $form_slug ) ? 'general' : $form_slug;
		$class_name	= esc_attr( $class_name );
		$input_name	= esc_attr( $input_name );
		$input_name	= empty( $input_name ) ? 'cptch_number' : $input_name;

		/**
		 * In case when the CAPTCHA uses in the custom form
		 * and there is no saved settings for this form
		 * making an attempt to get default settings
		 * @since 4.2.3
		 */
		if ( ! array_key_exists( $form_slug, $cptch_options['forms'] ) ) {
			if ( ! function_exists( 'cptch_get_default_options' ) ) {
				require_once( dirname( __FILE__ ) . '/includes/helpers.php' );
			}
			$default_options = cptch_get_default_options();
			/* prevent the need to get default settings on the next displaying of the CAPTCHA */
			if ( array_key_exists( $form_slug, $default_options['forms'] ) ) {
				$cptch_options['forms'][ $form_slug ] = $default_options['forms'][ $form_slug ];
				update_option( 'cptch_options', $cptch_options );
			} else {
				$form_slug = 'general';
			}
		}

		/**
		 * Display only the CAPTCHA container to replace it with the CAPTCHA
		 * after the whole page loading via AJAX
		 * @since 4.2.3
		 */
		if ( ( $cptch_options['load_via_ajax'] && ! defined( 'CPTCH_RELOAD_AJAX' ) ) ||
			'invisible' == $cptch_options['type']
		) {
			return cptch_add_scripts() .
				'<span 
				class="cptch_wrap cptch_ajax_wrap"
				data-cptch-form="' . $form_slug . '"
				data-cptch-input="' . $input_name . '"
				data-cptch-class="' . $class_name . '">' .
				__( 'Captcha loading...', 'captcha-plus' ) .
				'<noscript>' .
				__( 'In order to pass the CAPTCHA please enable JavaScript.', 'captcha-plus' ) .
				'</noscript>
				</span>';
		}

		if ( empty( $cptch_options['str_key']['key'] ) || $cptch_options['str_key']['time'] < time() - ( 24 * 60 * 60 ) ) {
			cptch_generate_key();
		}
		$str_key = $cptch_options['str_key']['key'];

		$id_postfix = rand( 0, 100 );
		$hidden_result_name = 'cptch_number' == $input_name ? 'cptch_result' : $input_name . '-cptch_result';
		$time = time();
		$time_limit_notice = cptch_add_time_limit_notice( $id_postfix );

		if ( 'recognition' == $cptch_options['type'] ) {
			$string = '';
			$captcha_content = '<span class="cptch_images_wrap">';
			$count = $cptch_options['images_count'];
			while ( $count != 0 ) {
				/*
				 * get element
				 */
				$image = rand( 1, 9 );
				$array_key = mt_rand( 0, abs( count( $cptch_options['used_packages'] ) - 1 ) );
				$operand =
						empty( $cptch_options['used_packages'][ $array_key ] )
					?
						cptch_generate_value( $image, false )
					:
						cptch_get_image( $image, '', $cptch_options['used_packages'][ $array_key ], false );

				$captcha_content .= '<span class="cptch_span">' . $operand . '</span>';
				$string .= $image;
				$count--;
			}
			$captcha_content .= '</span>
				<input id="cptch_input_' . $id_postfix . '" class="cptch_input ' . $class_name . '" type="text" autocomplete="off" name="' . $input_name . '" value="" maxlength="' . $cptch_options['images_count'] . '" size="' . $cptch_options['images_count'] . '" aria-required="true" required="required" style="margin-bottom:0;font-size: 12px;max-width:100%;" />
				<input type="hidden" name="' . $hidden_result_name . '" value="' . cptch_encode( $string, $str_key, $time ) . '" />';
		} else if ( 'slide' == $cptch_options['type'] ) {
			$captcha_content = '<div id="cptch_slide_captcha_container"></div>';
			$time_limit_notice = '';
		} else {
			/*
			 * array of math actions
			 */
			$math_actions = array();
			if ( in_array( 'plus', $cptch_options['math_actions'] ) ) {
				$math_actions[] = '&#43;';
			}
			if ( in_array( 'minus', $cptch_options['math_actions'] ) ) {
				$math_actions[] = '&minus;';
			}
			if ( in_array( 'multiplications', $cptch_options['math_actions'] ) ) {
				$math_actions[] = '&times;';
			}
			/* current math action */
			$rand_math_action = rand( 0, count( $math_actions ) - 1 );

			/*
			 * get elements of mathematical expression
			 */
			$array_math_expression		= array();
			$array_math_expression[0]	= rand( 1, 9 ); /* first part */
			$array_math_expression[1]	= rand( 1, 9 ); /* second part */
			/* Calculation of the result */
			switch( $math_actions[ $rand_math_action ] ) {
				case "&#43;":
					$array_math_expression[2] = $array_math_expression[0] + $array_math_expression[1];
					break;
				case "&minus;":
					/* Result must not be equal to the negative number */
					if ( $array_math_expression[0] < $array_math_expression[1] ) {
						$number = $array_math_expression[0];
						$array_math_expression[0] = $array_math_expression[1];
						$array_math_expression[1] = $number;
					}
					$array_math_expression[2] = $array_math_expression[0] - $array_math_expression[1];
					break;
				case "&times;":
					$array_math_expression[2] = $array_math_expression[0] * $array_math_expression[1];
					break;
			}

			/*
			 * array of allowed formats
			 */
			$allowed_formats			= array();
			$use_words = $use_numbeers	= false;
			if ( in_array( 'numbers', $cptch_options["operand_format"] ) ) {
				$allowed_formats[]		= 'number';
				$use_words				= true;
			}
			if ( in_array( 'words', $cptch_options["operand_format"] ) ) {
				$allowed_formats[]		= 'word';
				$use_numbeers			= true;
			}
			if ( in_array( 'images', $cptch_options["operand_format"] ) )
				$allowed_formats[]		= 'image';
			$use_only_words				= ( $use_words && ! $use_numbeers ) || ! $use_words;
			/* number of field, which will be as <input type="number"> */
			$rand_input					= rand( 0, 2 );

			/*
			 * get current format for each operand
			 * for example array( 'text', 'input', 'number' )
			 */
			$operand_formats	= array();
			$max_rand_value		= count( $allowed_formats ) - 1;
			for ( $i = 0; $i < 3; $i ++ )
				$operand_formats[] = $rand_input == $i ? 'input' : $allowed_formats[ mt_rand( 0, $max_rand_value ) ];

			/*
			 * get value of each operand
			 */
			$operand = array();
			foreach ( $operand_formats as $key => $format ) {
				switch ( $format ) {
					case 'input':
						$operand[] = '<input id="cptch_input_' . $id_postfix . '" class="cptch_input ' . $class_name . '" type="text" autocomplete="off" name="' . $input_name . '" value="" maxlength="2" size="2" aria-required="true" required="required" style="margin-bottom:0;display:inline;font-size: 12px;width: 40px;" />';
						break;
					case 'word':
						$operand[] = cptch_generate_value( $array_math_expression[ $key ] );
						break;
					case 'image':
						$array_key = mt_rand( 0, abs( count( $cptch_options['used_packages'] ) - 1 ) );
						$operand[] =
								empty( $cptch_options['used_packages'][ $array_key ] )
							?
								cptch_generate_value( $array_math_expression[ $key ] )
							:
								cptch_get_image( $array_math_expression[ $key ], $key, $cptch_options['used_packages'][ $array_key ], $use_only_words );
						break;
					case 'number':
					default:
						$operand[] = $array_math_expression[ $key ];
						break;
				}
			}
			$captcha_content = '<span class="cptch_span">' . $operand[0] . '</span>
					<span class="cptch_span">&nbsp;' . $math_actions[ $rand_math_action ] . '&nbsp;</span>
					<span class="cptch_span">' . $operand[1] . '</span>
					<span class="cptch_span">&nbsp;=&nbsp;</span>
					<span class="cptch_span">' . $operand[2] . '</span>
					<input type="hidden" name="' . $hidden_result_name . '" value="' . cptch_encode( $array_math_expression[ $rand_input ], $str_key, $time ) . '" />';
		}

		$cptch_reload_button = ( $cptch_options['type'] !== 'slide' ) ? cptch_add_reload_button( !!$cptch_options['display_reload_button'] ) : "" ;

		return
			$time_limit_notice .
			cptch_add_scripts() .
			'<span class="cptch_wrap cptch_' . $cptch_options['type'] . '">
				<label class="cptch_label" for="cptch_input_' . $id_postfix . '">' .
					$captcha_content .
					'<input type="hidden" name="cptch_time" value="' . $time . '" />
					<input type="hidden" name="cptch_form" value="' . $form_slug . '" />
				</label>' .
			$cptch_reload_button .
			'</span>';
	}
}

/**
 * Add necessary js scripts
 * @uses     for including necessary scripts on the pages witn the CAPTCHA only
 * @since    4.2.0
 * @param    void
 * @return   string   empty string - if the form has been loaded by PHP or the CAPTCHA has been reloaded, inline javascript - if the form has been loaded by AJAX
 */
if ( ! function_exists( 'cptch_add_scripts' ) ) {
	function cptch_add_scripts () {
		global $cptch_options;

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			if ( ! defined( 'CPTCH_RELOAD_AJAX' ) ) {
				/* This script will be included if the from was loaded via AJAX only but not during the CAPTCHA reloading */
				$script = '<script class="cptch_to_remove" type="text/javascript">
						( function( d, tag, id ) {
							var script = d.getElementById( id );
							if ( script )
								return;
							add_script( "", "", id );

							if ( typeof( cptch_vars ) == "undefined" ) {
								var local = {
									nonce:     "' . wp_create_nonce( 'cptch', 'cptch_nonce' ) . '",
									ajaxurl:   "' . admin_url( 'admin-ajax.php' ) . '",
									enlarge:   "' . $cptch_options['enlarge_images'] . '"
								};
								add_script( "", "/* <![CDATA[ */var cptch_vars=" + JSON.stringify( local ) + "/* ]]> */" );
							}

							d.addEventListener( "DOMContentLoaded", function() {
								var scripts         = d.getElementsByTagName( tag ),
									captcha_script  = /' . addcslashes( plugins_url( 'js/front_end_script.js' , __FILE__ ), '/' ) . '/,
									include_captcha = true;
								if ( scripts ) {
									for ( var i = 0; i < scripts.length; i++ ) {
										if ( scripts[ i ].src.match( captcha_script ) ) {
											include_captcha = false;
											break;
										}
									}
								}
								if ( typeof jQuery == "undefined" ) {
									var siteurl = "' . get_option( 'siteurl' ) . '";
									add_script( siteurl + "/wp-includes/js/jquery/jquery.js" );
									add_script( siteurl + "/wp-includes/js/jquery/jquery-migrate.min.js" );
								}
								if ( include_captcha )
									add_script( "' . plugins_url( 'js/front_end_script.js' , __FILE__ ) . '" );
							} );

							function add_script( url, content, js_id ) {
								url     = url     || "";
								content = content || "";
								js_id   = js_id   || "";
								var script = d.createElement( tag );
								if ( url )
									script.src = url;
								if ( content )
									script.appendChild( d.createTextNode( content ) );
								if ( js_id )
									script.id = js_id;
								script.setAttribute( "type", "text/javascript" );
								d.body.appendChild( script );
							}
						} )( document, "script", "cptch_script_loader" );
					</script>';

				return $script;
			}
		} elseif ( ! wp_script_is( 'cptch_front_end_script', 'registered' ) ) {
			wp_register_script( 'cptch_front_end_script', plugins_url( 'js/front_end_script.js' , __FILE__ ), array( 'jquery' ), false, $cptch_options['plugin_option_version'] );
			add_action( 'wp_footer', 'cptch_front_end_scripts' );
			if (
				$cptch_options['forms']['wp_login']['enable'] ||
				$cptch_options['forms']['wp_register']['enable'] ||
				$cptch_options['forms']['wp_lost_password']['enable']
			) {
				add_action( 'login_footer', 'cptch_front_end_scripts' );
			}
		}
		return '';
	}
}

/**
 * Adds a notice about the time expiration
 * @since     4.2.0
 * @param     int        $id_postfix    to generate an unique css ID on the page if there are more then one CAPTCHA
 * @return    string                    the message about the exhaustion of time limit and inline script for the displaying of this message
 */
if ( ! function_exists( 'cptch_add_time_limit_notice' ) ) {
	function cptch_add_time_limit_notice( $id_postfix ) {
		global $cptch_options;

		if ( ! $cptch_options['enable_time_limit'] ) {
			return '';
		}

		$id = "cptch_time_limit_notice_{$id_postfix}";

		$script = '( function( timeout ) {
            setTimeout(
                function() {
                    var notice = document.getElementById( "' . $id . '" );
                    if ( notice )
                        notice.style.display = "block";
                },
                timeout
            );
        } )( ' . $cptch_options['time_limit'] . '000 )';

		wp_register_script( 'cptch_time_limit_notice_script', '//' );
		wp_enqueue_script( 'cptch_time_limit_notice_script' );
		wp_add_inline_script( 'cptch_time_limit_notice_script', sprintf( $script ) );

		$html = '<span id="' . $id . '" class="cptch_time_limit_notice cptch_to_remove">' . $cptch_options['time_limit_off_notice'] . '</span>';

		return $html;
	}
}

/**
 * Add a reload button to the CAPTCHA block
 * @since     4.2.0
 * @param     boolean     $add_button  if 'true' - the button will be added
 * @return    string                   the button`s HTML-content
 */
if ( ! function_exists( 'cptch_add_reload_button' ) ) {
	function cptch_add_reload_button( $add_button ) {
		return
				$add_button
			?
				'<span class="cptch_reload_button_wrap hide-if-no-js">
					<noscript>
						<style type="text/css">
							.hide-if-no-js {
								display: none !important;
							}
						</style>
					</noscript>
					<span class="cptch_reload_button dashicons dashicons-update"></span>
				</span>'
			:
				'';
	}
}

/**
 * Display image in CAPTCHA
 * @param    int     $value       value of element of mathematical expression
 * @param    int     $place       which is an element in the mathematical expression
 * @param    array   $package_id  what package to use in current CAPTCHA ( if it is '-1' then all )
 * @return   string               html-structure of element
 */
if ( ! function_exists( 'cptch_get_image' ) ) {
	function cptch_get_image( $value, $place, $package_id, $use_only_words ) {
		global $wpdb, $cptch_options;

		$result = array();
		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}
		if ( empty( $cptch_options['used_packages'] ) ) {
			return cptch_generate_value( $value, $use_only_words );
		}
		$where = -1 == $package_id ? ' IN (' . implode( ',', $cptch_options['used_packages'] ) . ')' : '=' . $package_id;
		$images = $wpdb->get_results(
			"SELECT
				`{$wpdb->base_prefix}cptch_images`.`name` AS `file`,
				`{$wpdb->base_prefix}cptch_packages`.`folder` AS `folder`
			FROM
				`{$wpdb->base_prefix}cptch_images`
			LEFT JOIN
				`{$wpdb->base_prefix}cptch_packages`
			ON
				`{$wpdb->base_prefix}cptch_packages`.`id`=`{$wpdb->base_prefix}cptch_images`.`package_id`
			WHERE
				`{$wpdb->base_prefix}cptch_images`.`package_id` {$where}
				AND
				`{$wpdb->base_prefix}cptch_images`.`number`={$value};",
			ARRAY_N
		);
		if ( empty( $images ) ) {
			return cptch_generate_value( $value, $use_only_words );
		}
		if ( is_multisite() ) {
			switch_to_blog( 1 );
			$upload_dir = wp_upload_dir();
			restore_current_blog();
		} else {
			$upload_dir = wp_upload_dir();
		}
		$current_image = $images[ mt_rand( 0, count( $images ) - 1 ) ];
		$src = $upload_dir['basedir'] . '/bws_captcha_images/' . $current_image[1] . '/' . $current_image[0];
		if ( file_exists( $src ) ) {
			if ( 1 == $cptch_options['enlarge_images'] ) {
				switch( $place ) {
					case 0:
						$class = 'cptch_left';
						break;
					case 1:
						$class = 'cptch_center';
						break;
					case 2:
						$class = 'cptch_right';
						break;
					default:
						$class = '';
						break;
				}
			} else {
				$class = '';
			}
			$src = $upload_dir['basedir'] . '/bws_captcha_images/' . $current_image[1] . '/' . $current_image[0];
			$image_data = getimagesize( $src );
			return isset( $image_data['mime'] ) && ! empty( $image_data['mime'] ) ? '<img class="cptch_img ' . $class . '" src="data:' . $image_data['mime'] . ';base64,'. base64_encode( file_get_contents( $src ) ) . '" alt="image"/>' : cptch_generate_value( $value, $use_only_words );
		} else {
			return cptch_generate_value( $value, $use_only_words );
		}
	}
}

if ( ! function_exists( 'cptch_generate_value' ) ) {
	function cptch_generate_value( $value, $use_only_words = true ) {
		$random = $use_only_words ? 1 : mt_rand( 0, 1 );
		if ( 1 == $random ) {
			$number_string = array(
				0 => __( 'zero', 'captcha-plus' ),
				1 => __( 'one', 'captcha-plus' ),
				2 => __( 'two', 'captcha-plus' ),
				3 => __( 'three', 'captcha-plus' ),
				4 => __( 'four', 'captcha-plus' ),
				5 => __( 'five', 'captcha-plus' ),
				6 => __( 'six', 'captcha-plus' ),
				7 => __( 'seven', 'captcha-plus' ),
				8 => __( 'eight', 'captcha-plus' ),
				9 => __( 'nine', 'captcha-plus' ),

				10 => __( 'ten', 'captcha-plus' ),
				11 => __( 'eleven', 'captcha-plus' ),
				12 => __( 'twelve', 'captcha-plus' ),
				13 => __( 'thirteen', 'captcha-plus' ),
				14 => __( 'fourteen', 'captcha-plus' ),
				15 => __( 'fifteen', 'captcha-plus' ),
				16 => __( 'sixteen', 'captcha-plus' ),
				17 => __( 'seventeen', 'captcha-plus' ),
				18 => __( 'eighteen', 'captcha-plus' ),
				19 => __( 'nineteen', 'captcha-plus' ),

				20 => __( 'twenty', 'captcha-plus' ),
				21 => __( 'twenty one', 'captcha-plus' ),
				22 => __( 'twenty two', 'captcha-plus' ),
				23 => __( 'twenty three', 'captcha-plus' ),
				24 => __( 'twenty four', 'captcha-plus' ),
				25 => __( 'twenty five', 'captcha-plus' ),
				26 => __( 'twenty six', 'captcha-plus' ),
				27 => __( 'twenty seven', 'captcha-plus' ),
				28 => __( 'twenty eight', 'captcha-plus' ),
				29 => __( 'twenty nine', 'captcha-plus' ),

				30 => __( 'thirty', 'captcha-plus' ),
				31 => __( 'thirty one', 'captcha-plus' ),
				32 => __( 'thirty two', 'captcha-plus' ),
				33 => __( 'thirty three', 'captcha-plus' ),
				34 => __( 'thirty four', 'captcha-plus' ),
				35 => __( 'thirty five', 'captcha-plus' ),
				36 => __( 'thirty six', 'captcha-plus' ),
				37 => __( 'thirty seven', 'captcha-plus' ),
				38 => __( 'thirty eight', 'captcha-plus' ),
				39 => __( 'thirty nine', 'captcha-plus' ),

				40 => __( 'forty', 'captcha-plus' ),
				41 => __( 'forty one', 'captcha-plus' ),
				42 => __( 'forty two', 'captcha-plus' ),
				43 => __( 'forty three', 'captcha-plus' ),
				44 => __( 'forty four', 'captcha-plus' ),
				45 => __( 'forty five', 'captcha-plus' ),
				46 => __( 'forty six', 'captcha-plus' ),
				47 => __( 'forty seven', 'captcha-plus' ),
				48 => __( 'forty eight', 'captcha-plus' ),
				49 => __( 'forty nine', 'captcha-plus' ),

				50 => __( 'fifty', 'captcha-plus' ),
				51 => __( 'fifty one', 'captcha-plus' ),
				52 => __( 'fifty two', 'captcha-plus' ),
				53 => __( 'fifty three', 'captcha-plus' ),
				54 => __( 'fifty four', 'captcha-plus' ),
				55 => __( 'fifty five', 'captcha-plus' ),
				56 => __( 'fifty six', 'captcha-plus' ),
				57 => __( 'fifty seven', 'captcha-plus' ),
				58 => __( 'fifty eight', 'captcha-plus' ),
				59 => __( 'fifty nine', 'captcha-plus' ),

				60 => __( 'sixty', 'captcha-plus' ),
				61 => __( 'sixty one', 'captcha-plus' ),
				62 => __( 'sixty two', 'captcha-plus' ),
				63 => __( 'sixty three', 'captcha-plus' ),
				64 => __( 'sixty four', 'captcha-plus' ),
				65 => __( 'sixty five', 'captcha-plus' ),
				66 => __( 'sixty six', 'captcha-plus' ),
				67 => __( 'sixty seven', 'captcha-plus' ),
				68 => __( 'sixty eight', 'captcha-plus' ),
				69 => __( 'sixty nine', 'captcha-plus' ),

				70 => __( 'seventy', 'captcha-plus' ),
				71 => __( 'seventy one', 'captcha-plus' ),
				72 => __( 'seventy two', 'captcha-plus' ),
				73 => __( 'seventy three', 'captcha-plus' ),
				74 => __( 'seventy four', 'captcha-plus' ),
				75 => __( 'seventy five', 'captcha-plus' ),
				76 => __( 'seventy six', 'captcha-plus' ),
				77 => __( 'seventy seven', 'captcha-plus' ),
				78 => __( 'seventy eight', 'captcha-plus' ),
				79 => __( 'seventy nine', 'captcha-plus' ),

				80 => __( 'eighty', 'captcha-plus' ),
				81 => __( 'eighty one', 'captcha-plus' ),
				82 => __( 'eighty two', 'captcha-plus' ),
				83 => __( 'eighty three', 'captcha-plus' ),
				84 => __( 'eighty four', 'captcha-plus' ),
				85 => __( 'eighty five', 'captcha-plus' ),
				86 => __( 'eighty six', 'captcha-plus' ),
				87 => __( 'eighty seven', 'captcha-plus' ),
				88 => __( 'eighty eight', 'captcha-plus' ),
				89 => __( 'eighty nine', 'captcha-plus' ),

				90 => __( 'ninety', 'captcha-plus' ),
				91 => __( 'ninety one', 'captcha-plus' ),
				92 => __( 'ninety two', 'captcha-plus' ),
				93 => __( 'ninety three', 'captcha-plus' ),
				94 => __( 'ninety four', 'captcha-plus' ),
				95 => __( 'ninety five', 'captcha-plus' ),
				96 => __( 'ninety six', 'captcha-plus' ),
				97 => __( 'ninety seven', 'captcha-plus' ),
				98 => __( 'ninety eight', 'captcha-plus' ),
				99 => __( 'ninety nine', 'captcha-plus' )
			);
			$value = cptch_converting( $number_string[ $value ] );
		}
		return $value;
	}
}

if ( ! function_exists ( 'cptch_converting' ) ) {
	function cptch_converting( $number_string ) {
		global $cptch_options;

		if ( in_array( 'words', $cptch_options['operand_format'] ) && 'en-US' == get_bloginfo( 'language' ) ) {
			/* Array of htmlspecialchars for numbers and english letters */
			$htmlspecialchars_array = array();
			$htmlspecialchars_array['a'] = '&#97;';
			$htmlspecialchars_array['b'] = '&#98;';
			$htmlspecialchars_array['c'] = '&#99;';
			$htmlspecialchars_array['d'] = '&#100;';
			$htmlspecialchars_array['e'] = '&#101;';
			$htmlspecialchars_array['f'] = '&#102;';
			$htmlspecialchars_array['g'] = '&#103;';
			$htmlspecialchars_array['h'] = '&#104;';
			$htmlspecialchars_array['i'] = '&#105;';
			$htmlspecialchars_array['j'] = '&#106;';
			$htmlspecialchars_array['k'] = '&#107;';
			$htmlspecialchars_array['l'] = '&#108;';
			$htmlspecialchars_array['m'] = '&#109;';
			$htmlspecialchars_array['n'] = '&#110;';
			$htmlspecialchars_array['o'] = '&#111;';
			$htmlspecialchars_array['p'] = '&#112;';
			$htmlspecialchars_array['q'] = '&#113;';
			$htmlspecialchars_array['r'] = '&#114;';
			$htmlspecialchars_array['s'] = '&#115;';
			$htmlspecialchars_array['t'] = '&#116;';
			$htmlspecialchars_array['u'] = '&#117;';
			$htmlspecialchars_array['v'] = '&#118;';
			$htmlspecialchars_array['w'] = '&#119;';
			$htmlspecialchars_array['x'] = '&#120;';
			$htmlspecialchars_array['y'] = '&#121;';
			$htmlspecialchars_array['z'] = '&#122;';

			$simbols_lenght = strlen( $number_string );
			$simbols_lenght--;
			$number_string_new	= str_split( $number_string );
			$converting_letters	= rand( 1, $simbols_lenght );
			while ( $converting_letters != 0 ) {
				$position = rand( 0, $simbols_lenght );
				$number_string_new[ $position ] = isset( $htmlspecialchars_array[ $number_string_new[ $position ] ] ) ? $htmlspecialchars_array[ $number_string_new[ $position ] ] : $number_string_new[ $position ];
				$converting_letters--;
			}
			$number_string = '';
			foreach ( $number_string_new as $key => $value ) {
				$number_string .= $value;
			}
			return $number_string;
		} else {
			return $number_string;
		}
	}
}

/* Function for encodinf number */
if ( ! function_exists( 'cptch_encode' ) ) {
	function cptch_encode( $String, $Password, $timestamp ) {
		/* Check if key for encoding is empty */
		if ( ! $Password ) die ( __( "Encryption password is not set", 'captcha-plus' ) );

		$Salt	= md5( $timestamp, true );
		$String	= substr( pack( "H*", sha1( $String ) ), 0, 1 ) . $String;
		$StrLen	= strlen( $String );
		$Seq	= $Password;
		$Gamma	= '';

		while ( strlen( $Gamma ) < $StrLen ) {
			$Seq = pack( "H*", sha1( $Seq . $Gamma . $Salt ) );
			$Gamma .=substr( $Seq, 0, 8 );
		}

		return base64_encode( $String ^ $Gamma );
	}
}

/* Function for decoding number */
if ( ! function_exists( 'cptch_decode' ) ) {
	function cptch_decode( $String, $Key, $timestamp ) {
		/* Check if key for encoding is empty */
		if ( ! $Key ) die ( __( "Decryption password is not set", 'captcha-plus' ) );

		$Salt	= md5( $timestamp, true );
		$StrLen	= strlen( $String );
		$Seq	= $Key;
		$Gamma	= '';

		while ( strlen( $Gamma ) < $StrLen ) {
			$Seq = pack( "H*", sha1( $Seq . $Gamma . $Salt ) );
			$Gamma.= substr( $Seq, 0, 8 );
		}

		$String			= base64_decode( $String );
		$String			= $String ^ $Gamma;
		$DecodedString	= substr( $String, 1 );
		$Error			= ord( substr( $String, 0, 1 ) ^ substr( pack( "H*", sha1( $DecodedString ) ), 0, 1 ) );
		return $Error ? false : $DecodedString;
	}
}

/**
 * Check CAPTCHA life time
 * @return boolean
 */
if ( ! function_exists( 'cptch_limit_exhausted' ) ) {
	function cptch_limit_exhausted() {
		global $cptch_options;

		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}
		if (
			1 == $cptch_options['enable_time_limit'] &&
            isset( $_REQUEST['cptch_time'] ) &&
            $cptch_options['time_limit'] < time() - absint( $_REQUEST['cptch_time'] )
		) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'cptchpls_front_end_styles' ) ) {
	function cptchpls_front_end_styles() {
		if ( ! is_admin() ) {
			global $cptch_options;
			if ( empty( $cptch_options ) ) {
				$cptch_options = get_option( 'cptch_options' );
			}
			wp_enqueue_style( 'cptch_stylesheet', plugins_url( 'css/front_end_style.css', __FILE__ ), array(), $cptch_options['plugin_option_version'] );
			wp_enqueue_style( 'dashicons' );

			$device_type = isset( $_SERVER['HTTP_USER_AGENT'] ) && preg_match( '/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Windows Phone|Opera Mini/i', $_SERVER['HTTP_USER_AGENT'] ) ? 'mobile' : 'desktop';
			wp_enqueue_style( "cptch_{$device_type}_style", plugins_url( "css/{$device_type}_style.css", __FILE__ ), array(), $cptch_options['plugin_option_version'] );
		}
	}
}

if ( ! function_exists( 'cptch_front_end_scripts' ) ) {
	function cptch_front_end_scripts() {
		global $cptch_options;

		if ( empty( $cptch_options ) ) {
			$cptch_options = get_option( 'cptch_options' );
		}
		if (
			wp_script_is( 'cptch_front_end_script', 'registered' ) &&
			! wp_script_is( 'cptch_front_end_script', 'enqueued' )
		) {
			wp_enqueue_script( 'cptch_front_end_script' );
			$args = array(
				'nonce'			=> wp_create_nonce( 'cptch', 'cptch_nonce' ),
				'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
				'enlarge'		=> $cptch_options['enlarge_images'],
				'time_limit'	=> $cptch_options['time_limit']
			);
			wp_localize_script( 'cptch_front_end_script', 'cptch_vars', $args );

			if ( 'slide' === $cptch_options['type'] ) {
				wp_enqueue_script( 'slide-captcha-react', plugins_url( 'js/slide_captcha/dist/index-bundle.js', __FILE__ ), array( 'jquery' ), false, true );
				wp_localize_script( 'slide-captcha-react', 'wpSlideCaptcha', array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'start_slide' => __( 'Slide to verify', 'captcha-plus' ),
					'end_slide' => __( 'Verification passed', 'captcha-plus' )
				) );
			}
		}
	}
}

if ( ! function_exists ( 'cptchpls_admin_head' ) ) {
	function cptchpls_admin_head() {
		global $cptch_options;

		/* css for displaing an icon */
		wp_enqueue_style( 'cptch_icon', plugins_url( 'css/admin_page.css', __FILE__ ) );

		$pages = array(
			'captcha-plus.php',
			'captcha-packages.php',
			'captcha-whitelist.php'
		);

		if ( isset( $_REQUEST['page'] ) && in_array( $_REQUEST['page'], $pages ) ) {
			wp_enqueue_style( 'cptch_stylesheet', plugins_url( 'css/style.css', __FILE__ ), array(), $cptch_options['plugin_option_version'] );

			wp_enqueue_script( 'cptch_script', plugins_url( 'js/script.js' , __FILE__ ), array( 'jquery', 'jquery-ui-resizable', 'jquery-ui-tabs' ), $cptch_options['plugin_option_version'] );

			if ( 'captcha-plus.php' == $_REQUEST['page'] ) {
				bws_enqueue_settings_scripts();
				bws_plugins_include_codemirror();
			}
		}
	}
}

if ( ! function_exists( 'cptch_reload' ) ) {
	function cptch_reload() {
		check_ajax_referer( 'cptch', 'cptch_nonce' );

		if ( ! defined( 'CPTCH_RELOAD_AJAX' ) ) {
			define( 'CPTCH_RELOAD_AJAX', true );
		}
		$form_slug		= isset( $_REQUEST['cptch_form_slug'] ) ? esc_attr( $_REQUEST['cptch_form_slug'] ) : 'general';
		$class			= isset( $_REQUEST['cptch_input_class'] ) ? esc_attr( $_REQUEST['cptch_input_class'] ) : '';
		$input_name		= isset( $_REQUEST['cptch_input_name'] ) ? esc_attr( $_REQUEST['cptch_input_name'] ) : '';
		echo cptch_display_captcha_custom( $form_slug, $class, $input_name );

		die();
	}
}

if ( ! function_exists( 'cptchpls_plugin_action_links' ) ) {
	function cptchpls_plugin_action_links( $links, $file ) {
		if ( ! is_network_admin() ) {
			static $this_plugin;
			if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );

			if ( $file == $this_plugin ) {
				$settings_link = '<a href="admin.php?page=captcha-plus.php">' . __( 'Settings', 'captcha-plus' ) . '</a>';
				array_unshift( $links, $settings_link );
			}
		}
		return $links;
	}
}

if ( ! function_exists( 'cptchpls_register_plugin_links' ) ) {
	function cptchpls_register_plugin_links( $links, $file ) {
		$base = plugin_basename( __FILE__ );
		if ( $file == $base ) {
			if ( ! is_network_admin() ) {
				$links[] = '<a href="admin.php?page=captcha-plus.php">' . __( 'Settings', 'captcha-plus' ) . '</a>';
			}
			$links[] = '<a href="https://support.bestwebsoft.com/hc/en-us/sections/200538879" target="_blank">' . __( 'FAQ', 'captcha-plus' ) . '</a>';
			$links[] = '<a href="https://support.bestwebsoft.com">' . __( 'Support', 'captcha-plus' ) . '</a>';
		}
		return $links;
	}
}

if ( ! function_exists ( 'cptchpls_plugin_banner' ) ) {
	function cptchpls_plugin_banner() {
		global $hook_suffix, $cptch_plugin_info;

		/* Displays notice about possible conflict with W3 Total Cache plugin */
		echo cptch_w3tc_notice();

		if ( 'plugins.php' == $hook_suffix ) {
			bws_plugin_banner_to_settings( $cptch_plugin_info, 'cptch_options', 'captcha-bws', 'admin.php?page=captcha-plus.php' );
		}
		if ( isset( $_GET['page'] ) && 'captcha-plus.php' == $_GET['page'] ) {
			bws_plugin_suggest_feature_banner( $cptch_plugin_info, 'cptch_options', 'captcha-bws' );
		}
	}
}

/* Notice on the settings page about possible conflict with W3 Total Cache plugin */
if ( ! function_exists( 'cptch_w3tc_notice' ) ) {
	function cptch_w3tc_notice() {
		global $cptch_options, $cptch_plugin_info;
		if ( ! is_plugin_active( 'w3-total-cache/w3-total-cache.php' ) ) {
			return;
		}

		if ( empty( $cptch_options ) ) {
			$cptch_options = is_network_admin() ? get_site_option( 'cptch_options' ) : get_option( 'cptch_options' );
		}
		if ( empty( $cptch_options['w3tc_notice'] ) ) {
			return '';
		}
		if( isset( $_GET['cptch_nonce'] ) && wp_verify_nonce( $_GET['cptch_nonce'], 'cptch_clean_w3tc_notice' ) ) {
			unset( $cptch_options['w3tc_notice'] );
			if ( is_network_admin() ) {
				update_site_option( 'cptch_options', $cptch_options );
			} else {
				update_option( 'cptch_options', $cptch_options );
			}
			return '';
		}

		$url = add_query_arg(
			array(
				'cptch_clean_w3tc_notice'	=> '1',
				'cptch_nonce'				=> wp_create_nonce( 'cptch_clean_w3tc_notice' )
			),
			( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		);
		$close_link = "<a href=\"{$url}\" class=\"close_icon notice-dismiss\"></a>";
		$settings_link = sprintf(
			'<a href="%1$s">%2$s</a>',
			admin_url( 'admin.php?page=captcha-plus.php#cptch_load_via_ajax' ),
			__( 'settings page', 'captcha-plus' )
		);
		$message = sprintf(
			__( 'You\'re using W3 Total Cache plugin. If %1$s doesn\'t work properly, please clear the cache in W3 Total Cache plugin and turn on \'%2$s\' option on the plugin %3$s.', 'captcha-plus' ),
			$cptch_plugin_info['Name'],
			__( 'Show CAPTCHA after the end of the page loading', 'captcha-plus' ),
			$settings_link
		);
		return
			"<style>
				.cptch_w3tc_notice {
					position: relative;
				}
				.cptch_w3tc_notice a {
					text-decoration: none;
				}
			</style>
			<div class=\"cptch_w3tc_notice error\"><p>{$message}</p>{$close_link}</div>";
	}
}

/**
 *
 * @since 4.2.3
 */
if( ! function_exists( 'cptch_captcha_is_needed' ) ) {
	function cptch_captcha_is_needed( $form_slug, $user_loggged_in ) {
		global $cptch_options;
		return
			$cptch_options['forms'][ $form_slug ]['enable'] &&
			(
				! $user_loggged_in ||
				empty( $cptch_options['forms'][ $form_slug ]['hide_from_registered'] )
			);
	}
}

/* Function for delete delete options */
if ( ! function_exists ( 'cptch_delete_options' ) ) {
	function cptch_delete_options() {
		global $wpdb;
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$all_plugins		= get_plugins();
		$is_another_captcha	= array_key_exists( 'captcha-bws/captcha-bws.php', $all_plugins ) || array_key_exists( 'captcha-pro/captcha_pro.php', $all_plugins );

		/* do nothing more if Free or Pro BWS CAPTCHA are installed */
		if ( $is_another_captcha ) {
			return;
		}
		if ( is_multisite() ) {
			$old_blog = $wpdb->blogid;
			/* Get all blog ids */
			$blogids = $wpdb->get_col( "SELECT `blog_id` FROM $wpdb->blogs" );
			foreach ( $blogids as $blog_id ) {
				switch_to_blog( $blog_id );
				delete_option( 'cptch_options' );
				$prefix = 1 == $blog_id ? $wpdb->base_prefix : $wpdb->base_prefix . $blog_id . '_';
				$wpdb->query( "DROP TABLE `{$prefix}cptch_whitelist`;" );
			}
			switch_to_blog( 1 );
			$upload_dir = wp_upload_dir();
			switch_to_blog( $old_blog );
		} else {
			delete_option( 'cptch_options' );
			$wpdb->query( "DROP TABLE `{$wpdb->prefix}cptch_whitelist`;" );
			$upload_dir = wp_upload_dir();
		}

		/* clear all scheduled hooks */
		cptch_clear_scheduled_hook();

		/* delete images */
		$wpdb->query( "DROP TABLE `{$wpdb->base_prefix}cptch_images`, `{$wpdb->base_prefix}cptch_packages`;" );
		$images_dir	= $upload_dir['basedir'] . '/bws_captcha_images';
		$packages	= scandir( $images_dir );
		if ( is_array( $packages ) ) {
			foreach ( $packages as $package ) {
				if ( ! in_array( $package, array( '.', '..' ) ) ) {
					/* remove all files from package */
					array_map( 'unlink', glob( "{$images_dir}/{$package}/*.*" ) );
					/* remove package */
					rmdir( "{$images_dir}/{$package}" );
				}
			}
		}
		rmdir( $images_dir );

		require_once( dirname( __FILE__ ) . '/bws_menu/bws_include.php' );
		bws_include_init( plugin_basename( __FILE__ ) );
		bws_delete_plugin( plugin_basename( __FILE__ ) );
	}
}

/* Add Captcha forms to the Limit Attempts plugin */
if ( ! function_exists( 'cptchpls_add_lmtttmpts_forms' ) ) {
	function cptchpls_add_lmtttmpts_forms( $forms = array() ) {
		if ( ! is_array( $forms ) )
			$forms = array();

		$forms['cptch'] = array(
			'name'		=> 'Captcha Plugin',
			'forms'		=> array(),
		);
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$captcha_forms = cptch_get_forms();

		foreach ( $captcha_forms as $form_slug => $form_data ) {
			$forms["cptch"]["forms"]["{$form_slug}_captcha_check"] = $form_data;
		}
		return $forms;
	}
}

if ( ! function_exists( 'cptch_get_forms' ) ) {
	function cptch_get_forms() {
		global $cptch_forms;

		$default_forms = array(
			'login_form'				=> array( 'form_name' => __( 'Login form', 'сaptcha-plus' ) ),
			'registration_form'			=> array( 'form_name' => __( 'Registration form', 'сaptcha-plus' ) ),
			'reset_password_form'		=> array( 'form_name' => __( 'Reset password form', 'сaptcha-plus' ) ),
			'comments_form'				=> array( 'form_name' => __( 'Coments form', 'сaptcha-plus' ) ),
			'contact_form'				=> array( 'form_name' => 'Contact Form' ),
			'booking_form'				=> array( 'form_name' => 'Car Rental V2 Pro' ),
            'contact_form_7'			=> array( 'form_name' => 'Contact Form 7' ),
			'subscriber'				=> array( 'form_name' => 'Subscriber' ),
		);

		$custom_forms = apply_filters( 'cptch_add_custom_form', array() );
		$cptch_forms = array_merge( $default_forms, $custom_forms );

		foreach ( $cptch_forms as $form_slug => $form_data ) {
			$cptch_forms[ $form_slug ]['form_notice'] = cptch_get_form_notice( $form_slug );
		}

		$cptch_forms = apply_filters( 'cptch_forms', $cptch_forms );

		return $cptch_forms;
	}
}

if ( ! function_exists( 'cptch_get_form_notice' ) ) {
	function cptch_get_form_notice( $form_slug = '' ) {
		global $wp_version, $cptch_plugin_info;
		$form_notice = "";
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugins = array(
			'contact_form'			=> array( 'contact-form-plugin/contact_form.php', 'contact-form-pro/contact_form_pro.php' ),
			'booking_form'          => 'bws-car-rental-pro/bws-car-rental-pro.php',
            'subscriber'			=> array( 'subscriber/subscriber.php', 'subscriber-pro/subscriber-pro.php' ),
			'contact_form_7'		=> 'contact-form-7/wp-contact-form-7.php',
			'jetpack_contact_form'	=> 'jetpack/jetpack.php',
			'mailchimp_form'		=>'mailchimp-for-wp/mailchimp-for-wp.php'
		);

		if ( isset( $plugins[ $form_slug ] ) ) {
			$plugin_info = cptch_plugin_status( $plugins[ $form_slug ], get_plugins(), is_network_admin() );

			if ( 'activated' == $plugin_info['status'] ) {
				/* check required conditions */
				if ( 'contact_form_7' == $form_slug ) {
					if ( version_compare( $plugin_info['plugin_info']['Version'], '3.4', '<' ) ) {
						$form_notice = '<a href="' . self_admin_url( 'plugins.php' ) . '">' . sprintf( __( 'Update %s at least up to %s', 'captcha-plus' ), 'Contact Form 7', 'v3.4' ) . '</a>';
					} elseif (
						defined( 'WPCF7_VERSION' ) &&
						defined( 'WPCF7_REQUIRED_WP_VERSION' ) &&
						version_compare( $wp_version, WPCF7_REQUIRED_WP_VERSION, '<' )
					) {
						$form_notice = sprintf(
							__( '%1$s %2$s requires WordPress %3$s or higher.', 'captcha-plus' ),
							'Contact Form 7',
							WPCF7_VERSION,
							WPCF7_REQUIRED_WP_VERSION
						);
					}
				}
			} elseif ( 'deactivated' == $plugin_info['status'] ) {
				$form_notice = '<a href="' . self_admin_url( 'plugins.php' ) . '">' . __( 'Activate', 'captcha-plus' ) . '</a>';
			} elseif ( 'not_installed' == $plugin_info['status'] ) {
				if ( 'contact_form' == $form_slug ) {
					$form_notice = '<a href="https://bestwebsoft.com/products/wordpress/plugins/contact-form/?k=fa26df3911ebcd90c3e85117d6dd0ce0&pn=281&v=' . $cptch_plugin_info["Version"] . '&wp_v=' . $wp_version . '" target="_blank">' . __( 'Install Now', 'captcha-plus' ) . '</a>';
				} elseif ( 'subscriber' == $form_slug ) {
					$form_notice = '<a href="https://bestwebsoft.com/products/wordpress/plugins/subscriber/?k=c5c7708922e53ab2c3e5c1137d44e3a2&pn=281&v=' . $cptch_plugin_info["Version"] . '&wp_v=' . $wp_version . '" target="_blank">' . __( 'Install Now', 'captcha-plus' ) . '</a>';
				} else {
					$slug = explode( '/', $plugins[ $form_slug ] );
					$slug = $slug[0];
					$form_notice = sprintf( '<a href="http://wordpress.org/plugins/%s/" target="_blank">%s</a>', $slug, __( 'Install Now', 'captcha-plus' ) );
				}
			}
		}
		return apply_filters( 'cptch_form_notice', $form_notice, $form_slug );
	}
}

if ( ! function_exists( 'cptch_plugin_status' ) ) {
	function cptch_plugin_status( $plugins, $all_plugins, $is_network ) {
		$result = array(
			'status'		=> '',
			'plugin'		=> '',
			'plugin_info'	=> array(),
		);
		foreach ( (array)$plugins as $plugin ) {
			if ( array_key_exists( $plugin, $all_plugins ) ) {
				if (
					( $is_network && is_plugin_active_for_network( $plugin ) ) ||
					( ! $is_network && is_plugin_active( $plugin ) )
				) {
					$result['status']		= 'activated';
					$result['plugin']		= $plugin;
					$result['plugin_info']	= $all_plugins[ $plugin ];
					break;
				} else {
					$result['status']		= 'deactivated';
					$result['plugin']		= $plugin;
					$result['plugin_info']	= $all_plugins[ $plugin ];
				}

			}
		}
		if ( empty( $result['status'] ) ) {
			$result['status'] = 'not_installed';
		}
		return $result;
	}
}

/* create slide captcha response, g-recaptcha-response analogue */
if ( ! function_exists( 'cptch_set_slide_captcha_response' ) ) {
	function cptch_set_slide_captcha_response() {
		global $wp_hasher, $wpdb;

		// Generate something random for a response key.
		$key = wp_generate_password( 20, false );

		// Now insert the response, hashed, into the DB.
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . WPINC . '/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}

		$hashed    = time() . ':' . $wp_hasher->HashPassword( $key );
		$time = time();

		$key_saved = $wpdb->insert( $wpdb->base_prefix . 'cptch_responses', array( 'response' => $hashed, 'add_time' => $time ) );

		if ( false === $key_saved ) {
			return new WP_Error( 'no_response_key_update', __( 'Could not save captcha response to database.', 'captcha-plus' ) );
		}

		return $hashed;
	}
}

if ( ! function_exists( 'cptch_check_slide_captcha_response' ) ) {
	function cptch_check_slide_captcha_response( $response ) {
		global $wpdb;

		$allow = false;
		$expiration_duration  = 55;

		/* sanitize the response */
		$response = trim( esc_attr( $response ));

		/* check that the key exists and is not expired */
		$db_response = $wpdb->get_row( "SELECT `response`, `add_time` FROM `{$wpdb->prefix}cptch_responses` WHERE `response` = '{$response}';" );
		$response_request_time = $db_response->add_time;

		$expiration_time = $response_request_time + $expiration_duration;
		$is_expired = ( ! $expiration_time || time() > $expiration_time  ) ? true : false;

		if ( $db_response->response && ! $is_expired ) {
			/* allow to submit form  */
			$allow = true;
		}

		return $allow;
	}
}

if ( ! function_exists( 'cptch_validate_slide_captcha' ) ) {
	function cptch_validate_slide_captcha() {

		$result = array();

		/* if slide captcha passed - set response to db */
		if ( ! empty( $_POST['is_touch_end'] ) ) {
			$slide_captcha_response = cptch_set_slide_captcha_response();

			if ( is_wp_error( $slide_captcha_response ) ) {
				$result = array(
					'error' => array(
						'code' => '3848',
						'message' => __( 'Error', 'captcha-plus' )
					)
				);
			} else {
				$result = array (
					'slide_captcha_response'   => $slide_captcha_response
				);
			}
		}

		echo json_encode( $result );
		wp_die();
	}
}

if ( ! function_exists( 'cptch_delete_expired_responses' ) ) {
	function cptch_delete_expired_responses() {
		global $wpdb;

		$expiration_duration = MINUTE_IN_SECONDS; // captcha life time
		$expire = ( time() - $expiration_duration );

		$wpdb->query($wpdb->prepare("DELETE FROM `{$wpdb->prefix}cptch_responses` WHERE add_time <= %s", $expire));
	}
}

/* activation scheduled hook for delete expired response */
if ( ! function_exists( 'cptch_add_scheduled_hook' ) ) {
	function cptch_add_scheduled_hook () {
		if ( ! wp_next_scheduled ('delete_expired_responses' ) ) {
			wp_schedule_event (time () + HOUR_IN_SECONDS, 'hourly', 'delete_expired_responses');
		}
	}
}

/* deactivation scheduled hook for delete expired response */
if ( ! function_exists( 'cptch_clear_scheduled_hook' ) ) {
	function cptch_clear_scheduled_hook() {
		wp_clear_scheduled_hook ( 'delete_expired_responses');
	}
}

if ( ! function_exists( 'cptch_plus_deactivation' ) ) {
	function cptch_plus_deactivation() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}
}

register_activation_hook( __FILE__, 'cptch_plugin_activate' );

add_action( 'admin_menu', 'cptchpls_admin_menu', 1 );

add_action( 'init', 'cptchpls_init' );
add_action( 'admin_init', 'cptchpls_admin_init' );

add_action( 'plugins_loaded', 'cptchpls_plugins_loaded' );

/* Additional links on the plugin page */
add_filter( 'plugin_action_links', 'cptchpls_plugin_action_links', 10, 2 );
add_filter( 'plugin_row_meta', 'cptchpls_register_plugin_links', 10, 2 );

add_filter( 'lmtttmpts_plugin_forms', 'cptchpls_add_lmtttmpts_forms', 10, 1 );

add_action( 'admin_notices', 'cptchpls_plugin_banner' );

add_action( 'admin_enqueue_scripts', 'cptchpls_admin_head' );
add_action( 'wp_enqueue_scripts', 'cptchpls_front_end_styles' );
add_action( 'login_enqueue_scripts', 'cptchpls_front_end_styles' );

add_action( 'wp_ajax_cptch_reload', 'cptch_reload' );
add_action( 'wp_ajax_nopriv_cptch_reload', 'cptch_reload' );

add_filter( 'cptch_display', 'cptch_display_filter', 10, 3 );
add_filter( 'cptch_verify', 'cptch_verify', 10, 3 );

add_shortcode( 'bws_captcha', 'cptch_display_captcha_shortcode' );
add_filter( 'bws_shortcode_button_content', 'cptch_shortcode_button_content' );

//display captcha for the custom login form which used hook 'wp_login_form'
add_filter( 'login_form_middle', 'cptch_cf_form' );

add_action( 'wp_ajax_nopriv_validate_slide_captcha', 'cptch_validate_slide_captcha' );
add_action( 'wp_ajax_validate_slide_captcha', 'cptch_validate_slide_captcha' );

/* scheduled hook for delete expired response */
add_action ('delete_expired_responses', 'cptch_delete_expired_responses');