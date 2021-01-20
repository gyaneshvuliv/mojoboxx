<?php
/**
 * Displays the content on the plugin settings page
 */

if ( ! class_exists( 'Cptch_Settings_Tabs' ) ) {
	class Cptch_Settings_Tabs extends Bws_Settings_Tabs {
		private $forms, $form_categories, $registered_forms;

		/**
		 * Constructor.
		 *
		 * @access public
		 *
		 * @see Bws_Settings_Tabs::__construct() for more information on default arguments.
		 *
		 * @param string $plugin_basename
		 */
		public function __construct( $plugin_basename ) {
			global $cptch_options, $cptch_plugin_info;

			$tabs = array(
				'settings'		=> array( 'label' => __( 'Settings', 'captcha-plus' ) ),
				'messages'		=> array( 'label' => __( 'Messages', 'captcha-plus' ) ),
				'misc'			=> array( 'label' => __( 'Misc', 'captcha-plus' ) ),
				'custom_code'	=> array( 'label' => __( 'Custom Code', 'ccaptcha-plus' ) ),
			);

			if ( ! function_exists( 'cptch_get_default_options' ) ) {
				require_once( dirname( __FILE__ ) . '/helpers.php' );
			}

			parent::__construct( array(
				'plugin_basename'		=> $plugin_basename,
				'plugins_info'			=> $cptch_plugin_info,
				'prefix'				=> 'cptch',
				'default_options'		=> cptch_get_default_options(),
				'options'				=> $cptch_options,
				'tabs'					=> $tabs,
				'doc_link'				=> 'https://docs.google.com/document/d/11_TUSAjMjG7hLa53lmyTZ1xox03hNlEA4tRmllFep3I/',
			) );

			$this->all_plugins = get_plugins();

			$this->forms = array(
				'wp_login'				=> array( 'name' => __( 'Login form', 'captcha-plus' ) ),
				'wp_register'			=> array( 'name' => __( 'Registration form', 'captcha-plus' ) ),
				'wp_lost_password'		=> array( 'name' => __( 'Reset password form', 'captcha-plus' ) ),
				'wp_comments'			=> array( 'name' => __( 'Comments form', 'captcha-plus' ) ),
				'bws_contact'			=> array( 'name' => 'Contact Form' ),
				'bws_booking'			=> array( 'name' => 'Car Rental V2 Pro' ),
				'cf7_contact'			=> array( 'name' => 'Contact Form 7' ),
			);

			/*
			 * Add users forms to the forms lists
			 */
			$user_forms = apply_filters( 'cptch_add_form', array() );
			if ( ! empty( $user_forms ) ) {
				/*
				 * Get default form slugs from defaults
				 * which have been added by hook "cptch_add_default_form" */
				$new_default_forms = array_diff( cptch_get_default_forms(), array_keys( $this->forms ) );
				/*
				 * Remove forms slugs form from the newly added
				 * which have not been added to defaults previously
				 */
				$new_forms = array_intersect( $new_default_forms, array_keys( $user_forms ) );
				/* Get the sub array with new form labels */
				$new_forms_fields = array_intersect_key( $user_forms, array_flip( $new_forms ) );
				$new_forms_fields = array_map( array( $this, 'sanitize_new_form_data' ), $new_forms_fields );
				if ( ! empty( $new_forms_fields ) ) {
					/* Add new forms labels to the registered */
					$this->forms = array_merge( $this->forms, $new_forms_fields );
					/* Add default settings in case if new forms settings have not been saved yet */
					foreach ( $new_forms as $new_form ) {
						if ( empty( $this->options['forms'][ $new_form ] ) ) {
							$this->options['forms'][ $new_form ] = $this->default_options['forms'][ $new_form ];
						}
					}
				}
			}

			/**
			* form categories are used when compatible plugins are displayed
			*/
			$this->form_categories = array(
				'wp_default' => array(
					'title' => __( 'WordPress default', 'captcha-plus' ),
					'forms' => array(
						'wp_login',
						'wp_register',
						'wp_lost_password',
						'wp_comments'
					)
				),
				'external' => array(
					'title' => __( 'External plugins', 'captcha-plus' ),
					'forms' => array(
						'bws_contact',
						'bws_booking',
						'cf7_contact'
					)
				),
			);

			/**
			* create list with default compatible forms
			*/
			$this->registered_forms = array_merge(
				$this->form_categories['wp_default']['forms'],
				$this->form_categories['external']['forms']
			);

			$user_forms = array_diff( array_keys( $this->forms ), $this->registered_forms );
			if ( ! empty( $user_forms) ) {
				$this->form_categories['external']['forms'] = array_merge( $this->form_categories['external']['forms'], $user_forms );
			}

			/**
			* get ralated plugins info
			*/
			$this->options = $this->get_related_plugins_info( $this->options );

			/**
			* The option restoring have place later then $this->__constuct
			* so related plugins info will be lost without this add_filter
			*/
			add_action( get_parent_class( $this ) . '_additional_misc_options', array( $this, 'additional_misc_options' ) );
			add_filter( get_parent_class( $this ) . '_additional_restore_options', array( $this, 'additional_restore_options' ) );
		}

		/**
		 * Save plugin options to the database
		 * @access public
		 * @param  void
		 * @return array    The action results
		 */
		public function save_options() {
			$message = $notice = $error = '';
			$notices = array();

			/*
			 * Display this notice in order to remind to the user that he need to go on the
			 * Contact Form 7 "edit form" page and insert [BWS_CAPTCHA] shortcode in to the form content
			 */
			if ( ! $this->options['forms']['cf7_contact']['enable'] && isset( $_REQUEST['cptch']['forms']['cf7_contact']['enable'] ) ) {
				$notices[] = sprintf( __( "Option for displaying Captcha with Contact Form 7 is enabled. For correct work, please don't forget to add the BWS CAPTCHA block to the necessary form (see %s).", 'captcha-plus' ), '<a href="https://support.bestwebsoft.com/hc/en-us/sections/200538879" target="_blank">FAQ</a>' );
			}

			/*
			 * Prepare general options
			 */
			$general_arrays = array(
				'math_actions'		=> __( 'Arithmetic Actions', 'captcha-plus' ),
				'operand_format'	=> __( 'Complexity', 'captcha-plus' ),
				'used_packages'		=> __( 'Image Packages', 'captcha-plus' )
			);
			$general_bool		= array( 'load_via_ajax', 'display_reload_button', 'enlarge_images', 'enable_time_limit', 'use_limit_attempts_whitelist' );
			$general_strings	= array( 'type', 'title', 'required_symbol', 'no_answer', 'wrong_answer', 'time_limit_off', 'time_limit_off_notice', 'whitelist_message' );

			foreach ( $general_bool as $option ) {
				$this->options[ $option ] = ! empty( $_REQUEST["cptch_{$option}"] );
			}

			foreach ( $general_strings as $option ) {
				$value = isset( $_REQUEST["cptch_{$option}"] ) ? stripslashes( sanitize_text_field( $_REQUEST["cptch_{$option}"] ) ) : '';

				if ( ! in_array( $option, array( 'title', 'required_symbol' ) ) && empty( $value ) ) {
					/* The index has been added in order to prevent the displaying of this message more than once */
					$notices['a'] = __( 'Text fields in the "Messages" tab must not be empty.', 'captcha-plus' );
				} else {
					$this->options[ $option ] = $value;
				}
			}

			if ( 'slide' == $this->options['type'] ) {
				$this->options['load_via_ajax'] = 0;
			}

			foreach ( $general_arrays as $option => $option_name ) {
				$value = isset( $_REQUEST["cptch_{$option}"] ) && is_array( $_REQUEST["cptch_{$option}"] ) ? array_map( 'esc_html', $_REQUEST["cptch_{$option}"] ) : array();

				/* "Arithmetic actions" and "Complexity" must not be empty */
				if ( empty( $value ) && 'used_packages' != $option && 'recognition' != $this->options['type'] ) {
					$notices[] = sprintf( __( '"%s" option must not be fully disabled.', 'captcha-plus' ), $option_name );
				} else {
					$this->options[ $option ] = $value;
				}
			}

			$this->options['images_count']	= isset( $_REQUEST['cptch_images_count'] ) ? absint( $_REQUEST['cptch_images_count'] ) : 4;
			$this->options['time_limit']	= isset( $_REQUEST['cptch_time_limit'] ) ? absint( $_REQUEST['cptch_time_limit'] ) : 120;

			/*
			 * Prepare forms options
			 */
			$forms		= array_keys( $this->forms );
			$form_bool = array( 'enable', 'hide_from_registered' );
			foreach ( $forms as $form_slug ) {
				foreach ( $form_bool as $option ) {
					$this->options['forms'][ $form_slug ][ $option ] = isset( $_REQUEST['cptch']['forms'][ $form_slug ][ $option ] );
				}
			}

			/*
			 * If the user has selected images for the CAPTCHA
			 * it is necessary that at least one of the images packages was selected on the General Options tab
			 */
			if (
				( $this->images_enabled() || 'recognition' == $this->options['type'] ) &&
				empty( $this->options['used_packages'] )
			) {
				if ( 'recognition' == $this->options['type'] ) {
					$notices[] = __( 'In order to use "Optical Character Recognition" type, please select at least one of the items in the option "Image Packages".', 'captcha-plus' );
					$this->options['type'] = 'math_actions';
				} else {
					$notices[] = __( 'In order to use images in the CAPTCHA, please select at least one of the items in the option "Image Packages". The "Images" checkbox in "Complexity" option has been disabled.', 'captcha-plus' );
				}
				$key = array_keys( $this->options['operand_format'], 'images' );
				unset( $this->options['operand_format'][$key[0]] );
				if ( empty( $this->options['operand_format'] ) ) {
					$this->options['operand_format'] = array( 'numbers', 'words' );
				}
			}

			$this->options = apply_filters( 'cptch_before_save_options', $this->options );
			update_option( 'cptch_options', $this->options );
			$notice		= implode( '<br />', $notices );
			$message	= __( "Settings saved.", 'captcha-plus' );

			return compact( 'message', 'notice' );
		}

		/**
		 * Displays 'settings' menu-tab
		 * @access public
		 * @param void
		 * @return void
		 */
		public function tab_settings() {
			$options = array(
				'use_limit_attempts_whitelist' => array(
					'type'				=> 'radio',
					'title'				=> __( 'Whitelist', 'captcha-plus' ),
					'block_description'	=> __( 'With a whitelist you can hide captcha field for your personal and trusted IP addresses.', 'captcha-plus' ),
					'array_options'		=> array(
						'0'	=> array( __( 'Default', 'captcha-plus' ) . ' <a href="admin.php?page=captcha-whitelist.php" target="_blank">' . __( 'Manage Whitelist', 'captcha-plus' ) . '</a>' ),
						'1'	=> array( 'Limit Attempts ' . $this->get_form_message( 'limit_attempts' ) ),
					)
				),
				'type'	=> array(
					'type'				=> 'radio',
					'title'				=> __( 'Captcha Type', 'captcha-plus' ),
					'array_options'		=> array(
						'math_actions'	=> array( __( 'Arithmetic actions', 'captcha-plus' ) ),
						'recognition'	=> array( __( 'Optical Character Recognition (OCR)', 'captcha-plus' ) ),
						'invisible'		=> array( __( 'Invisible', 'captcha-plus' ) ),
						'slide'		=> array( __( 'Slide captcha', 'captcha-plus' ) )
					)
				),
				'math_actions'	=> array(
					'type'			=> 'checkbox',
					'title'			=> __( 'Arithmetic Actions', 'captcha-plus' ),
					'array_options'	=> array(
						'plus'				=> array( __( 'Addition', 'captcha-plus' ) . '&nbsp;(+)' ),
						'minus'				=> array( __( 'Subtraction', 'captcha-plus' ) . '&nbsp;(-)' ),
						'multiplications'	=> array( __( 'Multiplication', 'captcha-plus' ) . '&nbsp;(x)' )
					),
					'class'			=> 'cptch_for_math_actions'
				),
				'operand_format' => array(
					'type'				=> 'checkbox',
					'title'				=> __( 'Complexity', 'captcha-plus' ),
					'array_options'		=> array(
						'numbers'		=> array( __( 'Numbers (1, 2, 3, etc.)', 'captcha-plus' ) ),
						'words'			=> array( __( 'Words (one, two, three, etc.)', 'captcha-plus' ) ),
						'images'		=> array( __( 'Images', 'captcha-plus' ) )
					),
					'class'				=> 'cptch_for_math_actions'
				),
				'images_count'	=> array(
					'type'				=> 'number',
					'title'				=> __( 'Number of Images', 'captcha-plus' ),
					'min'				=> 1,
					'max'				=> 10,
					'block_description'	=> __( 'Set a number of images to display simultaneously as a captcha question.', 'captcha-plus' ),
					'class'				=> 'cptch_for_recognition'
				),
				'used_packages' => array(
					'type'			=> 'pack_list',
					'title'			=> __( 'Image Packages', 'captcha-plus' ),
					'class'			=> 'cptch_images_options cptch_for_math_actions cptch_for_recognition'
				),
				'enlarge_images' => array(
					'type'					=> 'checkbox',
					'title'					=> __( 'Enlarge Images', 'captcha-plus' ),
					'inline_description'	=> __( 'Enable to enlarge captcha images on mouseover.', 'captcha-plus' ),
					'class'					=> 'cptch_images_options cptch_for_math_actions cptch_for_recognition'
				),
				'display_reload_button' => array(
					'type'					=> 'checkbox',
					'title'					=> __( 'Reload Button', 'captcha-plus' ),
					'inline_description'	=> __( 'Enable to display reload button for captcha.', 'captcha-plus' ),
					'class'					=> 'cptch_for_math_actions cptch_for_recognition'
				 ),
				'title'	=> array(
					'type'	=> 'text',
					'title'	=> __( 'Captcha Title', 'captcha-plus' ) ),
				'required_symbol' => array(
					'type'	=> 'text',
					'title'	=> __( 'Required Symbol', 'captcha-plus' ) ),
				'load_via_ajax' => array(
					'type'					=> 'checkbox',
					'title'					=> __( 'Advanced Protection', 'captcha-plus' ),
					'inline_description'	=> __( 'Enable to display captcha when the website page is loaded.', 'captcha-plus' ),
					'class'					=> 'cptch_for_math_actions cptch_for_recognition'
				)
			); ?>
			<h3 class="bws_tab_label"><?php _e( 'Captcha Settings', 'captcha-plus' ); ?></h3>
			<?php $this->help_phrase(); ?>
			<hr>
			<div class="bws_tab_sub_label"><?php _e( 'General', 'captcha-plus' ); ?></div>
			<table class="form-table">
				<tr>
					<th scope="row"><?php _e( 'Enable Captcha for', 'captcha-plus' ); ?></th>
					<td>
						<?php foreach ( $this->form_categories as $fieldset_name => $fieldset_data ) { ?>
							<p><i><?php echo $fieldset_data['title']; ?></i></p>
							<br>
							<fieldset id="<?php echo $fieldset_name; ?>">
								<?php foreach ( $fieldset_data['forms'] as $form_name ) { ?>
									<label class="cptch_related">
										<?php /**
										* if plugin is external and it is not active, it's checkbox should be disabled
										*/
										$disabled = in_array( $form_name, $this->registered_forms ) && (
												( isset( $this->options['related_plugins_info'][ $form_name ] ) &&
												'active' != $this->options['related_plugins_info'][ $form_name ]['status'] ) ||
												( isset( $this->options['related_plugins_info'][ $fieldset_name ] ) &&
												'active' != $this->options['related_plugins_info'][ $fieldset_name ]['status'] )
											);

										$value = $fieldset_name . '_' . $form_name;
										$id = 'cptch_' . $form_name . '_enable';
										$class = '';
										$name = 'cptch[forms][' . $form_name . '][enable]';
										$checked = !! $this->options['forms'][ $form_name ]['enable'];
										$this->add_checkbox_input( compact( 'id', 'name', 'checked', 'value', 'class', 'disabled' ) );

										echo $this->forms[ $form_name ]['name']; ?>
                                    </label>
										<?php if ( 'external' == $fieldset_name && $disabled ) {
											echo $this->get_form_message( $form_name ); /* show "instal/activate" mesage */
										} elseif ( 'bws_contact' == $form_name &&
											( is_plugin_active( 'contact-form-multi/contact-form-multi.php' ) ||
											is_plugin_active( 'contact-form-multi-pro/contact-form-multi-pro.php' ) ) ) { ?>
                                            <br /><span class="bws_info"> <?php _e( 'Enable to add the CAPTCHA to forms on their settings pages.', 'captcha-plus' ); ?></span>
										<?php } ?>
									<br />
								<?php } ?>
							</fieldset>
							<hr>
						<?php } ?>
					</td>
				</tr>
				<?php foreach ( $options as $key => $data ) { ?>
					<tr<?php if ( ! empty( $data['class'] ) ) echo ' class="' . $data['class'] . '"'; ?>>
						<th scope="row"><?php echo ucwords( $data['title'] ); ?></th>
						<td>
							<fieldset>
								<?php $func = "add_{$data['type']}_input";
								if ( isset( $data['array_options'] ) ) {
									$name = 'radio' == $data['type'] ? 'cptch_' . $key : 'cptch_' . $key . '[]';
									foreach ( $data['array_options'] as $slug => $sub_data ) {
										$id = "cptch_{$key}_{$slug}"; ?>
										<label for="<?php echo $id; ?>">
											<?php if (
												'use_limit_attempts_whitelist' == $key &&
												$slug &&
												'active' != $this->options['related_plugins_info']['limit_attempts']['status']
											) { ?>
												<input type="radio" id="<?php echo $id; ?>" name="<?php echo $name; ?>" disabled="disabled" />
											<?php } else {
												$checked = 'radio' == $data['type'] ? ( $slug == $this->options[ $key ] ) : in_array( $slug, $this->options[ $key ] );
												$value   = $slug;
												$this->$func( compact( 'id', 'name', 'value', 'checked' ) );
											}
											echo $sub_data[0]; ?>
										</label>
										<br />
									<?php }
								} else {
									$id = isset( $data['array_options'] ) ? '' : ( isset( $this->options[ $key ] ) ? "cptch_{$key}" : "cptch_form_general_{$key}" );
									$name		= $id;
									$value		= $this->options[ $key ];
									$checked	= !! $value;
									if ( 'used_packages' == $key ) {
										$open_tag = $close_tag = "";
									} else {
										$open_tag = "<label for=\"{$id}\">";
										$close_tag = "</label>";
									}
									if ( isset( $data['min'] ) )
										$min = $data['min'];
									if ( isset( $data['max'] ) )
										$max = $data['max'];
									echo $open_tag;
									$this->$func( compact( 'id', 'name', 'value', 'checked', 'min', 'max' ) );
									echo $close_tag;
									if ( isset( $data['inline_description'] ) ) { ?>
										<span class="bws_info"><?php echo $data['inline_description']; ?></span>
									<?php }
								} ?>
							</fieldset>
							<?php if ( isset( $data['block_description'] ) ) { ?>
								<span class="bws_info"><?php echo $data['block_description']; ?></span>
							<?php } ?>
						</td>
					</tr>
				<?php }

				$options = array(
					array(
						'id'					=> "cptch_enable_time_limit",
						'name'					=> "cptch_enable_time_limit",
						'checked'				=> $this->options['enable_time_limit'],
						'inline_description'	=> __( 'Enable to activate a time limit required to complete captcha.', 'captcha-plus' )
					),
					array(
						'id'	=> "cptch_time_limit",
						'name'	=> "cptch_time_limit",
						'value'	=> $this->options['time_limit'],
						'min'	=> 10,
						'max'	=> 9999
					)
				); ?>
				<tr class="cptch_for_math_actions cptch_for_recognition">
					<th><?php _e( 'Time Limit', 'captcha-plus' ); ?></th>
					<td>
						<?php $this->add_checkbox_input( $options[0] ); ?>
						<span class="bws_info"><?php echo $options[0]['inline_description']; ?></span>
					</td>
				</tr>
				<tr class="cptch_time_limit" <?php echo $options[0]['checked'] ? '' : ' style="display: none"'; ?>>
					<th scope="row"><?php _e( 'Time Limit Threshold', 'captcha-plus' ); ?></th>
					<td>
						<span class="cptch_time_limit">
							<?php $this->add_number_input( $options[1] ); echo '&nbsp;' . _e( 'sec', 'captcha-plus' ); ?>
						</span>
					</td>
				</tr>
			</table>
			<?php foreach ( $this->forms as $form_slug => $data ) {
				if ( 'wp_comments' == $form_slug ) {
					foreach ( $this->form_categories as $category_name => $category_data ) {
						if ( in_array( $form_slug, $category_data['forms'] ) ) {
							if ( 'wp_default' == $category_name )
								$category_title = 'WordPress - ';
							elseif ( 'external' == $category_name )
								$category_title = '';
							else
								$category_title = $category_data['title'] . ' - ';
							break;
						}
					} ?>
					<div class="bws_tab_sub_label cptch_<?php echo $form_slug; ?>_related_form"><?php echo $category_title . $data['name']; ?></div>
					<?php $id	= "cptch_form_{$form_slug}_hide_from_registered";
					$name		= "cptch[forms][{$form_slug}][hide_from_registered]";
					$checked	= !! $this->options['forms'][ $form_slug ]['hide_from_registered'];
					$style		= $info = $readonly = '';

					/* Multisite uses common "register" and "lostpassword" forms all sub-sites */
					if (
						$this->is_multisite &&
						in_array( $form_slug, array( 'wp_register', 'wp_lost_password' ) ) &&
						! in_array( get_current_blog_id(), array( 0, 1 ) )
					) {
						$info		= __( 'This option is available only for network or for main blog', 'captcha-plus' );
						$readonly	= ' readonly="readonly" disabled="disabled"';
					} elseif ( ! $this->options['forms'][ $form_slug ]['enable'] ) {
						$style = ' style="display: none;"';
					} ?>
					<table class="form-table cptch_<?php echo $form_slug; ?>_related_form cptch_related_form_bloc">
						<tr class="cptch_form_option_hide_from_registered"<?php echo $style; ?>>
							<th scope="row"><?php _e( 'Hide from Registered Users', 'captcha-plus' ); ?></th>
							<td>
								<?php $this->add_checkbox_input( compact( 'id', 'name', 'checked', 'readonly' ) ); ?> <span class="bws_info"><?php _e( 'Enable to hide captcha for registered users.', 'captcha-plus' ); ?></span>
							</td>
						</tr>
					</table><!-- .cptch_$form_slug -->
				<?php }
			}
		}

		/**
		 * Displays 'messages' menu-tab
		 * @access public
		 * @param void
		 * @return void
		 */
		public function tab_messages() { ?>
			<h3 class="bws_tab_label"><?php _e( 'Messages Settings', 'captcha-plus' ); ?></h3>
			<?php $this->help_phrase(); ?>
			<hr>
			<table class="form-table">
				<?php $messages = array(
					'no_answer'				=> array(
						'title'			=> __( 'Captcha Field is Empty', 'captcha-plus' ),
						'message'		=> __( 'Please complete the captcha.', 'captcha-plus' )
					),
					'wrong_answer'			=> array(
						'title'			=> __( 'Captcha is Incorrect', 'captcha-plus' ),
						'message'		=> __( 'Please enter correct captcha value.', 'captcha-plus' )
					),
					'time_limit_off'		=> array(
						'title'			=> __( 'Captcha Time Limit Exceeded', 'captcha-plus' ),
						'message'		=> __( 'Time limit exceeded. Please complete the captcha once again.', 'captcha-plus' ),
					),
					'time_limit_off_notice'	=> array(
						'title'			=> __( 'Answer Time Limit Exceeded', 'captcha-plus' ),
						'message'		=> __( 'Time limit exceeded. Please complete the captcha once again.', 'captcha-plus' ),
						'description'	=> __( 'This message will be displayed above the captcha field.', 'captcha-plus' )
					),
					'whitelist_message'		=> array(
						'title'			=> __( 'Whitelisted IP', 'captcha-plus' ),
						'message'		=> __( 'Your IP address is Whitelisted.', 'captcha-plus' ),
						'description'	=> __( 'This message will be displayed instead of the captcha field.', 'captcha-plus' )
					)
				);
				foreach ( $messages as $message_name => $data ) { ?>
					<tr>
						<th scope="row"><?php echo $data['title']; ?></th>
						<td>
							<textarea <?php echo 'id="cptch_' . $message_name . '" name="cptch_' . $message_name . '"'; ?>><?php echo trim( $this->options[ $message_name ] ); ?></textarea>
							<?php if ( isset( $data['description'] ) ) { ?>
								<div class="bws_info"><?php echo $data['description']; ?></div>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		<?php }

		/**
		 * Display custom options on the 'misc' tab
		 * @access public
		 */
		public function additional_misc_options() {
			do_action( 'cptch_settings_page_misc_action', $this->options );
		}

		/**
		 * Displays the HTML radiobutton with the specified attributes
		 * @access private
		 * @param  array  $args   An array of HTML attributes
		 * @return void
		 */
		private function add_radio_input( $args ) { ?>
			<input
				type="radio"
				id="<?php echo $args['id']; ?>"
				name="<?php echo $args['name']; ?>"
				value="<?php echo $args['value']; ?>"
				<?php echo $args['checked'] ? ' checked="checked"' : ''; ?> />
		<?php }

		/**
		 * Displays the HTML checkbox with the specified attributes
		 * @access private
		 * @param  array  $args   An array of HTML attributes
		 * @return void
		 */
		private function add_checkbox_input( $args ) { ?>
			<input
				type="checkbox"
				id="<?php echo $args['id']; ?>"
				name="<?php echo $args['name']; ?>"
				value="<?php echo ! empty( $args['value'] ) ? $args['value'] : 1; ?>"
				<?php echo ( ! empty( $args['disabled'] ) ) ? ' disabled="disabled"' : '';
				echo $args['checked'] ? ' checked="checked"' : ''; ?> />
		<?php }

		/**
		 * Displays the HTML number field with the specified attributes
		 * @access private
		 * @param  array  $args   An array of HTML attributes
		 * @return void
		 */
		private function add_number_input( $args ) { ?>
			<input
				type="number"
				step="1"
				min="<?php echo $args['min']; ?>"
				max="<?php echo $args['max']; ?>"
				id="<?php echo $args['id']; ?>"
				name="<?php echo $args['name']; ?>"
				value="<?php echo $args['value']; ?>" />
		<?php }

		/**
		 * Displays the HTML text field with the specified attributes
		 * @access private
		 * @param  array  $args   An array of HTML attributes
		 * @return void
		 */
		private function add_text_input( $args ) { ?>
			<input
				type="text"
				id="<?php echo $args['id']; ?>"
				name="<?php echo $args['name']; ?>"
				value="<?php echo $args['value']; ?>" />
		<?php }

		/**
		 * Displays the list of available package list on the form options tabs
		 * @access private
		 * @param  array  $args   An array of HTML attributes
		 * @return boolean
		 */
		private function add_pack_list_input( $args ) {
			global $wpdb;

			$package_list = $wpdb->get_results(
				"SELECT
					`{$wpdb->base_prefix}cptch_packages`.`id`,
					`{$wpdb->base_prefix}cptch_packages`.`name`,
					`{$wpdb->base_prefix}cptch_packages`.`folder`,
					`{$wpdb->base_prefix}cptch_packages`.`settings`,
					`{$wpdb->base_prefix}cptch_images`.`name` AS `image`
				FROM
					`{$wpdb->base_prefix}cptch_packages`
				LEFT JOIN
					`{$wpdb->base_prefix}cptch_images`
				ON
					`{$wpdb->base_prefix}cptch_images`.`package_id`=`{$wpdb->base_prefix}cptch_packages`.`id`
				GROUP BY `{$wpdb->base_prefix}cptch_packages`.`id`
				ORDER BY `name` ASC;",
				ARRAY_A
			);

			if ( empty( $package_list ) ) { ?>
				<span><?php _e( 'The image packages list is empty. Please restore default settings or re-install the plugin to fix this error.', 'captcha-plus' ); ?></span>
				<?php return false;
			}

			if ( $this->is_multisite ) {
				switch_to_blog( 1 );
				$upload_dir = wp_upload_dir();
				restore_current_blog();
			} else {
				$upload_dir = wp_upload_dir();
			}
			$packages_url = $upload_dir['baseurl'] . '/bws_captcha_images'; ?>
			<div class="cptch_tabs_package_list">
				<ul class="cptch_tabs_package_list_items">
				<?php foreach ( $package_list as $pack ) {
					$styles = '';
					if ( ! empty( $pack['settings'] ) ) {
						$settings = unserialize( $pack['settings'] );
						if ( is_array( $settings ) ) {
							$styles = ' style="';
							foreach ( $settings as $propery => $value )
								$styles .= "{$propery}: {$value};";
							$styles .= '"';
						}
					}
					$id			= "{$args['id']}_{$pack['id']}";
					$name		= "{$args['name']}[]";
					$value		= $pack['id'];
					$checked	= in_array( $pack['id'], $args['value'] ); ?>
					<li>
						<span><?php $this->add_checkbox_input( compact( 'id', 'name', 'value', 'checked' ) ); ?></span>
						<span><label for="<?php echo $id; ?>"><img src="<?php echo "{$packages_url}/{$pack['folder']}/{$pack['image']}"; ?>" title="<?php echo $pack['name']; ?>"<?php echo $styles; ?>/></label></span>
						<span><label for="<?php echo $id; ?>"><?php echo $pack['name']; ?></label></span>
					</li>
				<?php } ?>
				</ul>
			</div>
			<?php return true;
		}

		/**
		 * Displays messages 'insall now'/'activate' for not active plugins
		 * @param  string $status
		 * @return string
		 */
		private function get_form_message( $slug ) {
			switch ( $this->options['related_plugins_info'][ $slug ]['status'] ) {
				case 'deactivated':
					return ' <a href="plugins.php">' . __( 'Activate', 'captcha-plus' ) . '</a>';
				case 'not_installed':
					return ' <a href="' . $this->options['related_plugins_info'][ $slug ]['link'] . '" target="_blank">' . __( 'Install Now', 'captcha-plus' ) . '</a>';
				default:
					return '';
			}
		}

		/**
		 * Form data from the user call function for the "cptch_add_form_tab" hook
		 * @access private
		 * @param  string|array   $form_data   Each new form data
		 * @return array                       Sanitized label
		 */
		private function sanitize_new_form_data( $form_data ) {
			$form_data = (array)$form_data;
			/**
			 * Return an array with the one element only
			 * to prevent the processing of potentially dangerous data
			 * @see self::_construct()
			 */
			return array( 'name' => esc_html( trim( $form_data[0] ) ) );
		}

		/**
		 * Whether the images are enabled for the CAPTCHA
		 * @access private
		 * @param  void
		 * @return boolean
		 */
		private function images_enabled() {
			return in_array( 'images', $this->options['operand_format'] );
		}

		/**
		 * Custom functions for "Restore plugin options to defaults"
		 * @access public
		 */
		public function additional_restore_options( $default_options ) {
			$default_options = $this->get_related_plugins_info( $default_options );

			/* do not update package selection */
			$default_options['used_packages'] = $this->options['used_packages'];

			return $default_options;
		}

		/**
		 * Using for adding related plugin's info during the restoring or creating this class
		 * @access public
		 * @param  array
		 * @return array
		 */
		public function get_related_plugins_info( $options ) {
			/**
			* default compatible plugins
			*/
			$compatible_plugins = array(
				'bws_contact'		=> array( 'contact-form-plugin/contact_form.php', 'contact-form-pro/contact_form_pro.php' ),
				'bws_booking'       => 'bws-car-rental-pro/bws-car-rental-pro.php',
                'cf7_contact'		=> 'contact-form-7/wp-contact-form-7.php',
				'limit_attempts'	=> array( 'limit-attempts/limit-attempts.php', 'limit-attempts-pro/limit-attempts-pro.php' )
			);

			foreach ( $compatible_plugins as $plugin_slug => $plugin )
				$options['related_plugins_info'][ $plugin_slug ] = cptch_get_plugin_status( $plugin, $this->all_plugins );

			return $options;
		}
	}
}