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

use Merkulove\WorkerWPBakery;

/** @noinspection PhpUnused */
class wpbWorker {

	/**
	 * Get things started.
	 *
	 * @throws Exception
	 * @since  1.0.0
	 * @access public
	 **/
	public function __construct() {

	    /** Create New Param Type: mdp_date_time. */
        vc_add_shortcode_param( 'mdp_date_time', [$this, 'date_time_settings_field'], WorkerWPBakery::$url . 'js/admin-worker' . WorkerWPBakery::$suffix . '.js'  );

		/** Worker addon map. */
        $this->worker_map();

		/** Shortcode for Worker addon. */
		add_shortcode('mdp_wpb_worker', [$this, 'mdp_wpb_worker_render'] );

	}

	/**
	 * Create html markup for mdp_date_time settings form.
	 *
	 * @param array $settings - Array of param settings for content element settings.
	 * @param string $value - Current attribute value. This maybe default value from param Array or user defined value.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 *
	 * @noinspection PhpUnused
	 **/
	public function date_time_settings_field( $settings, $value ) {

	    ob_start();

	    /** Prepare additional classes. */
	    $class = $settings['param_name'];
		$class .= ' ' . $settings['type'] . '_field';

		?>
        <div class="mdp-date-time">
            <!--suppress HtmlFormInputWithoutLabel -->
	        <input name="<?php esc_attr_e( $settings['param_name'] ); ?>"
                   config="<?php esc_attr_e( json_encode( $settings['picker_options'] ) ); ?>"
                   class="wpb_vc_param_value wpb-textinput <?php esc_attr_e( $class ); ?>"
                   type="text"
                   value="<?php esc_attr_e( $value ); ?>" />
        </div>
        <?php

        return ob_get_clean();
	}

	/**
	 * Shortcode [mdp_wpb_worker] output.
	 *
	 * @param $atts array - Shortcode parameters.
	 *
	 * @return false|string
	 * @since 1.0.0
	 * @access public
	 **/
	public function mdp_wpb_worker_render( $atts ) {

		ob_start();

		/** Get addon settings and set default values if empty. */
		/** @noinspection SpellCheckingInspection */
		$s = shortcode_atts( [
			'header_content_type' => '',
			'header_date_format' => '<h2>{time}</h2>
<span>{date}</span>',
			'header_open_msg' => esc_html__( 'We are open.', 'worker-wpbakery' ),
			'header_closed_msg' => esc_html__( 'Sorry, We are currently closed.', 'worker-wpbakery' ),
			'header_icon' => 'far fa-clock',
			'header_icon_size' => '30px',
			'header_image' => '',
			'header_image_size' => 'medium',
			'header_img_width' => '130px',
			'header_text' => esc_html__( 'Your Custom Message', 'worker-wpbakery' ),
			'header_content_position' => 'mdp-center-left',

			'sun_day_label' => esc_html__( 'Sunday', 'worker-wpbakery' ),
			'mon_day_label' => esc_html__( 'Monday', 'worker-wpbakery' ),
			'tue_day_label' => esc_html__( 'Tuesday', 'worker-wpbakery' ),
			'wed_day_label' => esc_html__( 'Wednesday', 'worker-wpbakery' ),
			'thu_day_label' => esc_html__( 'Thursday', 'worker-wpbakery' ),
			'fri_day_label' => esc_html__( 'Friday', 'worker-wpbakery' ),
			'sat_day_label' => esc_html__( 'Saturday', 'worker-wpbakery' ),

			'sun_closed' => 'yes',
			'mon_closed' => '',
			'tue_closed' => '',
			'wed_closed' => '',
			'thu_closed' => '',
			'fri_closed' => '',
			'sat_closed' => 'yes',

			'sun_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
			'mon_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
			'tue_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
			'wed_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
			'thu_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
			'fri_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
			'sat_closed_all_day_msg' => esc_html__( 'Closed All Day', 'worker-wpbakery' ),

			'sun_open_24' => '',
			'mon_open_24' => '',
			'tue_open_24' => '',
			'wed_open_24' => '',
			'thu_open_24' => '',
			'fri_open_24' => '',
			'sat_open_24' => '',

			'sun_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
			'mon_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
			'tue_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
			'wed_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
			'thu_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
			'fri_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
			'sat_open_all_day_msg' => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),

			'sun_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D', // URL Encoded [{"start_time":"09:00 AM","end_time":"08:00 PM"}]
			'mon_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D',
			'tue_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D',
			'wed_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D',
			'thu_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D',
			'fri_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D',
			'sat_business_hours' => '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D',

			'holidays_dates' => '',
			'holidays_recurring' => 'yes',
			'holidays_msg' => esc_html__( 'Special holiday hours in effect.', 'worker-wpbakery' ),

			'footer_content_type' => 'status',
			'footer_date_format' => '<h2>{time}</h2>
<span>{date}</span>',
			'footer_open_msg' => esc_html__( 'We are open.', 'worker-wpbakery' ),
			'footer_closed_msg' => esc_html__( 'Sorry, We are currently closed.', 'worker-wpbakery' ),
			'footer_icon' => 'far fa-clock',
			'footer_icon_size' => '30px',
			'footer_image' => '',
			'footer_image_size' => 'medium',
			'footer_img_width' => '130px',
			'footer_text' => esc_html__( 'Your Custom Message', 'worker-wpbakery' ),
			'footer_content_position' => 'mdp-center-left',

			'show_header' => 'yes',
			'header_height' => '120px',
			'header_style' => '',
			'header_font_container' => '',
			'header_use_theme_fonts' => 'yes',
			'header_google_font' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',

			'show_bh' => 'yes',
			'bh_style' => '',
			'bh_font_container' => '',
			'bh_use_theme_fonts' => 'yes',
			'bh_google_font' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
			'row_margin' => '4px',

			'show_footer' => 'yes',
			'footer_height' => '120px',
			'footer_style' => '',
			'footer_font_container' => '',
			'footer_use_theme_fonts' => 'yes',
			'footer_google_font' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal'
		], $atts, 'mdp_wpb_worker' );

		/** Crutch ¯\_(ツ)_/¯ */
        foreach ( ['sun','mon','tue','wed','thu','fri','sat'] as $day ) {

            /** Set default value. */
            if ( '`{`object Object`}`' === $s["{$day}_business_hours"] ) { $s["{$day}_business_hours"] = '%5B%7B%22start_time%22%3A%2209%3A00%20AM%22%2C%22end_time%22%3A%2208%3A00%20PM%22%7D%5D'; }

	        /** Convert to array. */
	        $s["{$day}_business_hours"] = json_decode( urldecode( $s["{$day}_business_hours"] ), true );
        }

		/** Unique id for current block. */
		$id = 'mdp-worker-' . md5( json_encode( $atts ) );

		/** Enqueue styles only if shortcode used on this page. */
		wp_enqueue_style( 'mdp-worker' );

		/** Prepare inline CSS for this instance of addon. */
		$css = '';
        if ( ! empty( $s['header_icon_size'] ) ) {
	        $css .= "#{$id} .mdp-worker-wpbakery-header-content .mdp-worker-wpbakery-icon .mdp-icon { font-size: {$s['header_icon_size']}; }";
        }

		if ( ! empty( $s['header_img_width'] ) ) {
			$css .= "#{$id} .mdp-worker-wpbakery-header-content .mdp-worker-wpbakery-image img { width: {$s['header_img_width']}; }";
		}

		if ( ! empty( $s['header_height'] ) ) {
			$css .= "#{$id} .mdp-worker-wpbakery-header { height: {$s['header_height']}; }";
		}

		if ( ! empty( $s['header_font_container'] ) ) {
			$s['header_font_container'] = urldecode( $s['header_font_container'] );
			$s['header_font_container'] = str_replace( '|', ';', $s['header_font_container'] );
			$s['header_font_container'] = str_replace( '_', '-', $s['header_font_container'] );
			$css .= "#{$id} .mdp-worker-wpbakery-header .mdp-worker-wpbakery-header-content > * { {$s['header_font_container']}; }";
		}

		if ( 'yes' !== $s['header_use_theme_fonts'] ) {
		    $header_google_font_css = $this->get_google_font_inline_css( $s['header_google_font'] );
			$css .= "#{$id} .mdp-worker-wpbakery-header .mdp-worker-wpbakery-header-content > * { {$header_google_font_css} }";
        }

		if ( ! empty( $s['bh_font_container'] ) ) {
			$s['bh_font_container'] = urldecode( $s['bh_font_container'] );
			$s['bh_font_container'] = str_replace( '|', ';', $s['bh_font_container'] );
			$s['bh_font_container'] = str_replace( '_', '-', $s['bh_font_container'] );
			$css .= "#{$id} .mdp-worker-wpbakery-hours { {$s['bh_font_container']}; }";
		}

		if ( 'yes' !== $s['bh_use_theme_fonts'] ) {
			$bh_google_font_css = $this->get_google_font_inline_css( $s['bh_google_font'] );
			$css .= "#{$id} .mdp-worker-wpbakery-hours .mdp-worker-wpbakery-row { {$bh_google_font_css} }";
		}

		if ( ! empty( $s['row_margin'] ) ) {
			$css .= "#{$id} .mdp-worker-wpbakery-hours .mdp-worker-wpbakery-row:not(:last-child) { margin-bottom: {$s['row_margin']}; }";
        }

		if ( ! empty( $s['footer_icon_size'] ) ) {
			$css .= "#{$id} .mdp-worker-wpbakery-footer-content .mdp-worker-wpbakery-icon .mdp-icon { font-size: {$s['footer_icon_size']}; }";
		}

		if ( ! empty( $s['footer_img_width'] ) ) {
			$css .= "#{$id} .mdp-worker-wpbakery-footer-content .mdp-worker-wpbakery-image img { width: {$s['footer_img_width']}; }";
		}

		if ( ! empty( $s['footer_height'] ) ) {
			$css .= "#{$id} .mdp-worker-wpbakery-footer { height: {$s['footer_height']}; }";
		}

		if ( ! empty( $s['footer_font_container'] ) ) {
			$s['footer_font_container'] = urldecode( $s['footer_font_container'] );
			$s['footer_font_container'] = str_replace( '|', ';', $s['footer_font_container'] );
			$s['footer_font_container'] = str_replace( '_', '-', $s['footer_font_container'] );
			$css .= "#{$id} .mdp-worker-wpbakery-footer .mdp-worker-wpbakery-footer-content > * { {$s['footer_font_container']}; }";
		}

		if ( 'yes' !== $s['footer_use_theme_fonts'] ) {
			$footer_google_font_css = $this->get_google_font_inline_css( $s['footer_google_font'] );
			$css .= "#{$id} .mdp-worker-wpbakery-footer .mdp-worker-wpbakery-footer-content > * { {$footer_google_font_css} }";
		}

		/** Add inline styles. */
		wp_add_inline_style( 'mdp-worker', $css );

		?>

		<!-- Start Worker for WPBakery WordPress Plugin -->
		<div id="<?php esc_attr_e( $id ); ?>" class="mdp-worker-wpbakery-addon-box">
			<?php if ( $s['show_header'] ) : ?>
                <?php
                $header_style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $s['header_style'], '' ), 'mdp_wpb_worker', $atts ); ?>
                <div class="mdp-worker-wpbakery-header <?php esc_attr_e( $s['header_content_position'] ); ?> <?php esc_attr_e( $header_style_class ); ?>">

                    <div class="mdp-worker-wpbakery-header-content">

						<?php if ( 'date' === $s['header_content_type'] ) : ?>
                            <div class="mdp-worker-wpbakery-date">
								<?php
								/** Get current date and time. */
								$current_time = current_time( get_option( 'time_format' ) );
								$current_date = current_time( get_option( 'date_format' ) );

								/** Make replacements. */
								$date_result = str_replace( '{time}', $current_time, $s['header_date_format'] );
								$date_result = str_replace( '{date}', $current_date, $date_result );

								/** Print result. */
								echo wp_kses_post( $date_result );
								?>
                            </div>
						<?php elseif ( 'status' === $s['header_content_type'] ) : ?>
                            <div class="mdp-worker-wpbakery-status">
								<?php if ( $this->is_open( $s ) ) : ?>
									<?php echo wp_kses_post( $s['header_open_msg'] ); ?>
								<?php else : ?>
									<?php echo wp_kses_post( $s['header_closed_msg'] ); ?>
								<?php endif; ?>
                            </div>
						<?php elseif ( 'icon' === $s['header_content_type'] ) : ?>
                            <?php vc_icon_element_fonts_enqueue( 'fontawesome' ); // Enqueue needed icon font. ?>
                            <div class="mdp-worker-wpbakery-icon">
                                <span class="mdp-icon <?php esc_attr_e( $s['header_icon'] ); ?>"></span>
                            </div>
						<?php elseif ( 'image' === $s['header_content_type'] ) : ?>
							<?php if ( ! empty( $s['header_image'] ) ) : ?>
                                <div class="mdp-worker-wpbakery-image">
	                                <?php echo wp_get_attachment_image( $s['header_image'], $s['header_image_size'] ); ?>
                                </div>
							<?php endif; ?>
						<?php elseif ( 'text' === $s['header_content_type'] ) : ?>
                            <div class="mdp-worker-wpbakery-text">
								<?php echo do_shortcode( $s['header_text'] ); ?>
                            </div>
						<?php endif; ?>
                    </div>

                </div>
			<?php endif; ?>

			<?php if ( $s['show_bh'] ) : ?>

		        <?php $bh_style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $s['bh_style'], '' ), 'mdp_wpb_worker', $atts ); ?>
                <div class="mdp-worker-wpbakery-hours <?php esc_attr_e( $bh_style_class ); ?>">
					<?php $week = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat']; /** Days of week. */ ?>
					<?php $week = $this->set_start_of_week( $week ); ?>

					<?php foreach ( $week as $day ) : ?>
                        <div class="mdp-worker-wpbakery-row">
                            <div class="mdp-worker-wpbakery-row-day">
								<?php echo wp_kses_post( $s["{$day}_day_label"] ); ?>
                            </div>
                            <div class="mdp-worker-wpbakery-row-hours">
								<?php if ( $this->is_holiday_today( $s['holidays_dates'], $s['holidays_recurring'], $day ) ) : ?>
									<?php echo wp_kses_post( $s["holidays_msg"] ); ?>
								<?php elseif ( 'yes' === $s["{$day}_closed"] ) : ?>
									<?php echo wp_kses_post( $s["{$day}_closed_all_day_msg"] ); ?>
								<?php elseif ( 'yes' === $s["{$day}_open_24"] ) : ?>
									<?php echo wp_kses_post( $s["{$day}_open_all_day_msg"] ); ?>
								<?php else : ?>
									<?php foreach ( $s["{$day}_business_hours"] as $hours ) : ?>
										<?php esc_html_e( $hours['start_time'] ); ?> - <?php esc_html_e( $hours['end_time'] ); ?>
									<?php endforeach; ?>
								<?php endif; ?>
                            </div>
                        </div>
					<?php endforeach; ?>

                </div>
			<?php endif; ?>

			<?php if ( $s['show_footer'] ) : ?>
                <?php $footer_style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $s['footer_style'], '' ), 'mdp_wpb_worker', $atts ); ?>
                <div class="mdp-worker-wpbakery-footer <?php esc_attr_e( $s['footer_content_position'] ); ?> <?php esc_attr_e( $footer_style_class ); ?>">

                    <div class="mdp-worker-wpbakery-footer-content">
						<?php if ( 'date' === $s['footer_content_type'] ) : ?>
                            <div class="mdp-worker-wpbakery-date">
								<?php
								/** Get current date and time. */
								$current_time = current_time( get_option( 'time_format' ) );
								$current_date = current_time( get_option( 'date_format' ) );

								/** Make replacements. */
								$date_result = str_replace( '{time}', $current_time, $s['footer_date_format'] );
								$date_result = str_replace( '{date}', $current_date, $date_result );

								/** Print result. */
								echo wp_kses_post( $date_result );
								?>
                            </div>
						<?php elseif ( 'status' === $s['footer_content_type'] ) : ?>
                            <div class="mdp-worker-wpbakery-status">
								<?php if ( $this->is_open( $s ) ) : ?>
									<?php echo wp_kses_post( $s['footer_open_msg'] ); ?>
								<?php else : ?>
									<?php echo wp_kses_post( $s['footer_closed_msg'] ); ?>
								<?php endif; ?>
                            </div>
						<?php elseif ( 'icon' === $s['footer_content_type'] ) : ?>
							<?php vc_icon_element_fonts_enqueue( 'fontawesome' ); // Enqueue needed icon font. ?>
                            <div class="mdp-worker-wpbakery-icon">
                                <span class="mdp-icon <?php esc_attr_e( $s['footer_icon'] ); ?>"></span>
                            </div>
						<?php elseif ( 'image' === $s['footer_content_type'] ) : ?>
							<?php if ( ! empty( $s['footer_image'] ) ) : ?>
                                <div class="mdp-worker-wpbakery-image">
	                                <?php echo wp_get_attachment_image( $s['footer_image'], $s['footer_image_size'] ); ?>
                                </div>
							<?php endif; ?>
						<?php elseif ( 'text' === $s['footer_content_type'] ) : ?>
                            <div class="mdp-worker-wpbakery-text">
								<?php echo do_shortcode( $s['footer_text'] ); ?>
                            </div>
						<?php endif; ?>
                    </div>

                </div>
			<?php endif; ?>
		</div>
		<!-- End Worker for WPBakery WordPress Plugin -->
		<?php
		return ob_get_clean();

	}

	/**
	 * Worker addon map.
	 *
	 * @throws Exception
	 **/
	public function worker_map() {

	    /** Check, just in case. */
	    if ( ! function_exists( 'vc_map' ) ) { return; }

	    /** Control params. */
		$params = [];

		/** Enable 24-hour Time format depending on global WP settings. */
		$time_24hr = false;
		$wp_time_format = get_option( 'time_format' );
		if ( ( strpos( $wp_time_format, 'G' ) !== false ) OR ( strpos( $wp_time_format, 'H' ) !== false) ) {
			$time_24hr = true;
		}

		/***********************
		 * Header Content Tab. *
		 ***********************/
        if ( true ) {

	        /** Content Type. */
	        $params[] = [
		        'param_name'    => 'header_content_type',
		        'type'          => 'dropdown',
		        'heading'       => esc_html__( 'Content Type', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
                'description'   => esc_html__( 'Select content to show in the header.', 'worker-wpbakery' ),
		        'value'         => [
			        esc_html__( 'Nothing',  'worker-wpbakery' )         => 'none',
			        esc_html__( 'Current Date',  'worker-wpbakery' )    => 'date',
			        esc_html__( 'Current Status',  'worker-wpbakery' )  => 'status',
			        esc_html__( 'Icon',  'worker-wpbakery' )            => 'icon',
			        esc_html__( 'Image',  'worker-wpbakery' )           => 'image',
			        esc_html__( 'Custom Message',  'worker-wpbakery' )  => 'text',
		        ],
		        'edit_field_class'  => 'mdp-control',
	        ];

	        /** Date/Time Format. */
	        $params[] = [
		        'param_name'    => 'header_date_format',
		        'type'          => 'textarea',
		        'heading'       => esc_html__( 'Date/Time Format', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => '<h2>{time}</h2>
<span>{date}</span>',
		        'edit_field_class'  => 'mdp-control',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'date'
		        ],
	        ];

	        /** Open Message. */
	        $params[] = [
		        'param_name'    => 'header_open_msg',
		        'type'          => 'textfield',
		        'heading'       => esc_html__( 'Open Message', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => esc_html__( 'We are open.', 'worker-wpbakery' ),
		        'edit_field_class'  => 'mdp-control',
                'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'status'
		        ],
	        ];

	        /** Closed Message. */
	        $params[] = [
		        'param_name'    => 'header_closed_msg',
		        'type'          => 'textfield',
		        'heading'       => esc_html__( 'Closed Message', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => esc_html__( 'Sorry, We are currently closed.', 'worker-wpbakery' ),
		        'edit_field_class'  => 'mdp-control',
                'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'status'
		        ],
	        ];

	        /** Icon. */
	        $params[] = [
		        'param_name'    => 'header_icon',
		        'type'          => 'iconpicker',
		        'heading'       => esc_html__( 'Icon', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => 'far fa-clock',
                'settings'      => [
                    'emptyIcon'     => false, // default true, display an "EMPTY" icon?
                    'iconsPerPage'  => 200, // default 100, how many icons per/page to display
                ],
		        'edit_field_class'  => 'mdp-control',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'icon'
		        ]
	        ];

	        /** Icon Size. */
	        $params[] = [
		        'param_name'    => 'header_icon_size',
		        'type'          => 'textfield',
		        'heading'       => esc_html__( 'Icon Size', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => '30px',
		        'edit_field_class'  => 'mdp-control mdp-control-small',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'icon'
		        ]
	        ];

	        /** Image. */
	        $params[] = [
		        'param_name'    => 'header_image',
		        'type'          => 'attach_image',
		        'heading'       => esc_html__( 'Image', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'edit_field_class'  => 'mdp-control',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'image'
		        ]
	        ];

	        /** Image size. */
	        $params[] = [
		        'param_name'    => 'header_image_size',
	            'type'          => 'textfield',
				'heading'       => esc_html__( 'Image size', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
				'value'         => 'large',
				'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'worker-wpbakery' ),
		        'edit_field_class'  => 'mdp-control',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'image'
		        ]
	        ];

	        /** Image Width. */
	        $params[] = [
		        'param_name'    => 'header_img_width',
		        'type'          => 'textfield',
		        'heading'       => esc_html__( 'Image Width', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => '130px',
		        'edit_field_class'  => 'mdp-control mdp-control-small',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'image'
		        ]
	        ];

	        /** Custom Message. */
	        $params[] = [
		        'param_name'    => 'header_text',
		        'type'          => 'textarea',
		        'heading'       => esc_html__( 'Custom Message', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => esc_html__( 'Your Custom Message', 'worker-wpbakery' ),
		        'edit_field_class'  => 'mdp-control',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => 'text'
		        ],
	        ];

	        /** Position. */
	        $params[] = [
		        'param_name'    => 'header_content_position',
		        'type'          => 'dropdown',
		        'heading'       => esc_html__( 'Position', 'worker-wpbakery' ),
		        'group'         => esc_html__( 'Header Content', 'worker-wpbakery' ),
		        'value'         => [
			        esc_html__( 'Top Left', 'worker-wpbakery' )        => 'mdp-top-left',
			        esc_html__( 'Top Center', 'worker-wpbakery' )      => 'mdp-top-center',
			        esc_html__( 'Top Right', 'worker-wpbakery' )       => 'mdp-top-right',
			        esc_html__( 'Center Left', 'worker-wpbakery' )     => 'mdp-center-left',
			        esc_html__( 'Center Center', 'worker-wpbakery' )   => 'mdp-center-center',
			        esc_html__( 'Center Right', 'worker-wpbakery' )    => 'mdp-center-right',
			        esc_html__( 'Bottom Left', 'worker-wpbakery' )     => 'mdp-bottom-left',
			        esc_html__( 'Bottom Center', 'worker-wpbakery' )   => 'mdp-bottom-center',
			        esc_html__( 'Bottom Right', 'worker-wpbakery' )    => 'mdp-bottom-right',
		        ],
		        'edit_field_class'  => 'mdp-control',
		        'dependency'    => [
			        'element'   => 'header_content_type',
			        'value'     => ['date', 'status', 'icon', 'image', 'text']
		        ]
	        ];

        } // END Header Content Tab.

		/***********************
		 * Business Hours Tab. *
		 ***********************/
		if ( true ) {

			/** Days of week. */
			$week = [
				'sun' => esc_html__( 'Sunday', 'worker-wpbakery' ),
				'mon' => esc_html__( 'Monday', 'worker-wpbakery' ),
				'tue' => esc_html__( 'Tuesday', 'worker-wpbakery' ),
				'wed' => esc_html__( 'Wednesday', 'worker-wpbakery' ),
				'thu' => esc_html__( 'Thursday', 'worker-wpbakery' ),
				'fri' => esc_html__( 'Friday', 'worker-wpbakery' ),
				'sat' => esc_html__( 'Saturday', 'worker-wpbakery' ),
			];

			/** Add array offset, to set correct first day of week. */
			$week = $this->set_start_of_week( $week );

			$count = 0;
			foreach ( $week as $key => $day ) {
				$count ++;

				/** Line separator. */
				$top_line = '';
				if ( $count > 1 ) { $top_line = 'mdp-top-line'; }

				/** Day Header. */
				$params[] = [
					'param_name'    => "{$key}_header",
					'type'          => 'textfield',
					'heading'       => "<h4><strong>{$day}</strong></h4>",
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
					'value'         => '',
					'edit_field_class'  => "mdp-control mdp-header {$top_line}",
				];

				/** Day Label. */
				$params[] = [
					'param_name'    => "{$key}_day_label",
					'type'          => 'textfield',
					'heading'       => esc_html__( 'Day Label:', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
					'value'         => $day,
					'edit_field_class'  => 'mdp-control',
				];

				/** Closed. */
				$default = '';
				if ( $count > 5 ) {
					$default = 'yes';
				}
				$params[] = [
					'param_name'    => "{$key}_closed",
					'type'          => 'checkbox',
					'heading'       => esc_html__( 'Closed All Day:', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
					'std'           => $default,
					'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],//,
					'edit_field_class'  => 'mdp-control'
				];

				/** Closed All Day Message. */
				$params[] = [
					'param_name'    => "{$key}_closed_all_day_msg",
					'type'          => 'textfield',
					'heading'       => esc_html__( 'Closed All Day Message:', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
					'value'         => esc_html__( 'Closed All Day', 'worker-wpbakery' ),
					'edit_field_class'  => 'mdp-control',
					'dependency'    => [
						'element'   => "{$key}_closed",
						'value'     => 'yes'
					],
				];

				/** Open 24 hours. */
				$params[] = [
					'param_name'    => "{$key}_open_24",
					'type'          => 'checkbox',
					'heading'       => esc_html__( 'Open 24 Hours:', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
					'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],//,
					'edit_field_class'  => 'mdp-control',
					'dependency'    => [
						'element'   => "{$key}_closed",
						'value_not_equal_to' => 'yes'
					]
				];

				/** Open 24 hours message. */
				$params[] = [
					'param_name'    => "{$key}_open_all_day_msg",
					'type'          => 'textfield',
					'heading'       => esc_html__( 'Open 24 hours message:', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
					'value'         => esc_html__( 'Open 24 hours', 'worker-wpbakery' ),
					'edit_field_class'  => 'mdp-control',
					'dependency'    => [
						'element'   => "{$key}_open_24",
						'value'     => 'yes'
					],
				];

				/** Business Hours. */
				$params[] = [
					'param_name' => "{$key}_business_hours",
			        'type' => 'param_group',
					'heading'       => esc_html__( 'Business Hours:', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Business Hours', 'worker-wpbakery' ),
			        'value' => [
				        [
					        'start_time' => $this->format_time( '9:00' ), // 'H:i'
					        'end_time' => $this->format_time( '20:00' ), // 'H:i'
				        ]
			        ],
			        'params' => [
				        [
					        'param_name'     => 'start_time',
					        'type'           => 'mdp_date_time',
					        'admin_label'    => true,
					        'heading'        => esc_html__( 'Start Time', 'worker-wpbakery' ),
					        'value'          => $this->format_time( '9:00' ), // 'H:i'
					        'picker_options' => [
                                'enableTime' => true,
                                'noCalendar' => true,
                                'dateFormat' => $this->time_format_to_js( $wp_time_format ),
                                'time_24hr'  => $time_24hr
                            ]
				        ],
				        [
					        'param_name'     => 'end_time',
					        'type'           => 'mdp_date_time',
					        'admin_label'    => true,
					        'heading'        => esc_html__( 'End Time', 'worker-wpbakery' ),
					        'value'          => $this->format_time( '20:00' ), // 'H:i'
					        'picker_options' => [
						        'enableTime' => true,
						        'noCalendar' => true,
						        'dateFormat' => $this->time_format_to_js( $wp_time_format ),
						        'time_24hr'  => $time_24hr
					        ]
				        ]
			        ],
					'dependency'    => [
						'element'               => "{$key}_open_24",
						'value_not_equal_to'    => 'yes'
					],

		        ];

			}


        } // END Business Hours Tab.

		/****************************
		 * Holidays & Special Days. *
		 ****************************/
		if ( true ) {

			/** Holidays. */
			$params[] = [
				'param_name'        => 'holidays_dates',
				'type'              => 'mdp_date_time',
				'heading'           => esc_html__( 'Holidays:', 'worker-wpbakery' ),
				'group'             => esc_html__( 'Holidays & Special Days', 'worker-wpbakery' ),
				'value'             => '',
				'edit_field_class'  => 'mdp-control',
				'picker_options'    => [
					'enableTime'    => false,
					'dateFormat'    => 'd-m-Y',
					'mode'          => 'multiple'
				]
			];

			/** Recurring. */
			$params[] = [
				'param_name'    => 'holidays_recurring',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Recurring:', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Holidays & Special Days', 'worker-wpbakery' ),
				'description'   => esc_html__( 'Enable to apply date range every year. So the year in the selection will be ignored.', 'worker-wpbakery' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control'
			];

			/** Holiday Message. */
			$params[] = [
				'param_name'        => 'holidays_msg',
				'type'              => 'textfield',
				'heading'           => esc_html__( 'Holiday Message:', 'worker-wpbakery' ),
				'group'             => esc_html__( 'Holidays & Special Days', 'worker-wpbakery' ),
				'value'             => esc_html__( 'Special holiday hours in effect.', 'worker-wpbakery' ),
				'edit_field_class'  => 'mdp-control',
			];

        }

		/***********************
		 * Footer Content Tab. *
		 ***********************/
		if ( true ) {

			/** Content Type. */
			$params[] = [
				'param_name'       => 'footer_content_type',
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Content Type', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'description'      => esc_html__( 'Select content to show in the footer.', 'worker-wpbakery' ),
				'value'            => [
					esc_html__( 'Nothing', 'worker-wpbakery' )        => 'none',
					esc_html__( 'Current Date', 'worker-wpbakery' )   => 'date',
					esc_html__( 'Current Status', 'worker-wpbakery' ) => 'status',
					esc_html__( 'Icon', 'worker-wpbakery' )           => 'icon',
					esc_html__( 'Image', 'worker-wpbakery' )          => 'image',
					esc_html__( 'Custom Message', 'worker-wpbakery' ) => 'text',
				],
				'edit_field_class' => 'mdp-control',
			];

			/** Date/Time Format. */
			$params[] = [
				'param_name'       => 'footer_date_format',
				'type'             => 'textarea',
				'heading'          => esc_html__( 'Date/Time Format', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => '<h2>{time}</h2>
<span>{date}</span>',
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'date'
				],
			];

			/** Open Message. */
			$params[] = [
				'param_name'       => 'footer_open_msg',
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Open Message', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => esc_html__( 'We are open.', 'worker-wpbakery' ),
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'status'
				],
			];

			/** Closed Message. */
			$params[] = [
				'param_name'       => 'footer_closed_msg',
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Closed Message', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => esc_html__( 'Sorry, We are currently closed.', 'worker-wpbakery' ),
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'status'
				],
			];

			/** Icon. */
			$params[] = [
				'param_name'       => 'footer_icon',
				'type'             => 'iconpicker',
				'heading'          => esc_html__( 'Icon', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'         => 'far fa-clock',
				'settings'         => [
					'emptyIcon'    => false, // default true, display an "EMPTY" icon?
					'iconsPerPage' => 200, // default 100, how many icons per/page to display
				],
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'icon'
				]
			];

			/** Icon Size. */
			$params[] = [
				'param_name'       => 'footer_icon_size',
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Icon Size', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => '30px',
				'edit_field_class' => 'mdp-control mdp-control-small',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'icon'
				]
			];

			/** Image. */
			$params[] = [
				'param_name'       => 'footer_image',
				'type'             => 'attach_image',
				'heading'          => esc_html__( 'Image', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'image'
				]
			];

			/** Image size. */
			$params[] = [
				'param_name'       => 'footer_image_size',
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Image size', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => 'large',
				'description'      => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'worker-wpbakery' ),
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'image'
				]
			];

			/** Image Width. */
			$params[] = [
				'param_name'       => 'footer_img_width',
				'type'             => 'textfield',
				'heading'          => esc_html__( 'Image Width', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => '130px',
				'edit_field_class' => 'mdp-control mdp-control-small',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'image'
				]
			];

			/** Custom Message. */
			$params[] = [
				'param_name'       => 'footer_text',
				'type'             => 'textarea',
				'heading'          => esc_html__( 'Custom Message', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => esc_html__( 'Your Custom Message', 'worker-wpbakery' ),
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => 'text'
				],
			];

			/** Position. */
			$params[] = [
				'param_name'       => 'footer_content_position',
				'type'             => 'dropdown',
				'heading'          => esc_html__( 'Position', 'worker-wpbakery' ),
				'group'            => esc_html__( 'Footer Content', 'worker-wpbakery' ),
				'value'            => [
					esc_html__( 'Top Left', 'worker-wpbakery' )      => 'mdp-top-left',
					esc_html__( 'Top Center', 'worker-wpbakery' )    => 'mdp-top-center',
					esc_html__( 'Top Right', 'worker-wpbakery' )     => 'mdp-top-right',
					esc_html__( 'Center Left', 'worker-wpbakery' )   => 'mdp-center-left',
					esc_html__( 'Center Center', 'worker-wpbakery' ) => 'mdp-center-center',
					esc_html__( 'Center Right', 'worker-wpbakery' )  => 'mdp-center-right',
					esc_html__( 'Bottom Left', 'worker-wpbakery' )   => 'mdp-bottom-left',
					esc_html__( 'Bottom Center', 'worker-wpbakery' ) => 'mdp-bottom-center',
					esc_html__( 'Bottom Right', 'worker-wpbakery' )  => 'mdp-bottom-right',
				],
				'edit_field_class' => 'mdp-control',
				'dependency'       => [
					'element' => 'footer_content_type',
					'value'   => [ 'date', 'status', 'icon', 'image', 'text' ]
				]
			];

		} // END Footer Content Tab.

		/*********************
		 * Header Style Tab. *
		 *********************/
		if ( true ) {

			/** Show Header. */
			$params[] = [
				'param_name'    => 'show_header',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Show Header', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Header Style', 'worker-wpbakery' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control'
			];


			/** Header Height. */
			$params[] = [
				'param_name'    => 'header_height',
				'type'          => 'textfield',
				'heading'       => esc_html__( 'Height', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Header Style', 'worker-wpbakery' ),
				'value'         => '120px',
				'edit_field_class'  => 'mdp-control mdp-control-small',
				'dependency'    => [
					'element'   => 'show_header',
					'value'     => 'yes'
				]
			];

			/** Header Style. */
			$params[] = [
					'param_name'    => 'header_style',
					'type'          => 'css_editor',
					'heading'       => esc_html__( 'Style', 'worker-wpbakery' ),
					'group'         => esc_html__( 'Header Style', 'worker-wpbakery' ),
					'dependency'    => [
						'element'   => 'show_header',
						'value'     => 'yes'
					]
			];

			/** Header Font. */
			$params[] = [
				'param_name' => 'header_font_container',
				'type' => 'font_container',
				'group'         => esc_html__( 'Header Style', 'worker-wpbakery' ),
				'value' => '',
				'edit_field_class'  => 'mdp-control mdp-control-small',
				'settings' => [
					'fields' => [
						'font_size',
						'line_height',
						'color',
						'font_size_description' => esc_html__( 'Enter font size.', 'worker-wpbakery' ),
						'line_height_description' => esc_html__( 'Enter line height.', 'worker-wpbakery' ),
						'color_description' => esc_html__( 'Select heading color.', 'worker-wpbakery' ),
					],
				],
				'dependency'    => [
					'element'   => 'show_header',
					'value'     => 'yes'
				]
			];

			/** Use default font family?. */
			$params[] = [
				'param_name'    => 'header_use_theme_fonts',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Use default font family?', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Header Style', 'worker-wpbakery' ),
				'description'   => esc_html__( 'Use font family from the theme.', 'js_composer' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control',
				'dependency'    => [
					'element'   => 'show_header',
					'value'     => 'yes'
				]
			];

			/** Header Google Font. */
			/** @noinspection SpellCheckingInspection */
			$params[] = [
				'param_name'    => 'header_google_font',
				'type'          => 'google_fonts',
				'group'         => esc_html__( 'Header Style', 'worker-wpbakery' ),
				'value'         => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings' => [
					'fields' => [
						'font_family_description' => esc_html__( 'Select font family.', 'worker-wpbakery' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'worker-wpbakery' ),
					],
				],
				'dependency'    => [
					'element' => 'header_use_theme_fonts',
					'value_not_equal_to' => 'yes'
				]

			];

		} // END Header Style Tab.

		/*****************************
		 * Business Hours Style Tab. *
		 *****************************/
		if ( true ) {

			/** Show Business Hours. */
			$params[] = [
				'param_name'    => 'show_bh',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Show Business Hours', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Business Hours Style', 'worker-wpbakery' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control'
			];

			/** Business Hours Style. */
			$params[] = [
				'param_name'    => 'bh_style',
				'type'          => 'css_editor',
				'heading'       => esc_html__( 'Style', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Business Hours Style', 'worker-wpbakery' ),
				'dependency'    => [
					'element'   => 'show_bh',
					'value'     => 'yes'
				]
			];

			/** Business Hours Font. */
			$params[] = [
				'param_name' => 'bh_font_container',
				'type' => 'font_container',
				'group'         => esc_html__( 'Business Hours Style', 'worker-wpbakery' ),
				'value' => '',
				'edit_field_class'  => 'mdp-control mdp-control-small',
				'settings' => [
					'fields' => [
						'font_size',
						'line_height',
						'color',
						'font_size_description' => esc_html__( 'Enter font size.', 'worker-wpbakery' ),
						'line_height_description' => esc_html__( 'Enter line height.', 'worker-wpbakery' ),
						'color_description' => esc_html__( 'Select heading color.', 'worker-wpbakery' ),
					],
				],
				'dependency'    => [
					'element'   => 'show_bh',
					'value'     => 'yes'
				]
			];

			/** Use default font family?. */
			$params[] = [
				'param_name'    => 'bh_use_theme_fonts',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Use default font family?', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Business Hours Style', 'worker-wpbakery' ),
				'description'   => esc_html__( 'Use font family from the theme.', 'js_composer' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control',
				'dependency'    => [
					'element'   => 'show_bh',
					'value'     => 'yes'
				]
			];

			/** Business Hours Google Font. */
			/** @noinspection SpellCheckingInspection */
			$params[] = [
				'param_name'    => 'bh_google_font',
				'type'          => 'google_fonts',
				'group'         => esc_html__( 'Business Hours Style', 'worker-wpbakery' ),
				'value'         => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings' => [
					'fields' => [
						'font_family_description' => esc_html__( 'Select font family.', 'worker-wpbakery' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'worker-wpbakery' ),
					],
				],
				'dependency'    => [
					'element' => 'bh_use_theme_fonts',
					'value_not_equal_to' => 'yes'
				]

			];

			/** Space Between. */
			$params[] = [
				'param_name'    => 'row_margin',
				'type'          => 'textfield',
				'heading'       => esc_html__( 'Space Between', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Business Hours Style', 'worker-wpbakery' ),
				'value'         => '4px',
				'edit_field_class'  => 'mdp-control mdp-control-small',
				'dependency'    => [
					'element'   => 'show_bh',
					'value'     => 'yes'
				]
			];

		} // END Business Hours Style Tab.

		/*********************
		 * Footer Style Tab. *
		 *********************/
		if ( true ) {

			/** Show Footer. */
			$params[] = [
				'param_name'    => 'show_footer',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Show Footer', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Footer Style', 'worker-wpbakery' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control'
			];


			/** Footer Height. */
			$params[] = [
				'param_name'    => 'footer_height',
				'type'          => 'textfield',
				'heading'       => esc_html__( 'Height', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Footer Style', 'worker-wpbakery' ),
				'value'         => '120px',
				'edit_field_class'  => 'mdp-control mdp-control-small',
				'dependency'    => [
					'element'   => 'show_footer',
					'value'     => 'yes'
				]
			];

			/** Footer Style. */
			$params[] = [
				'param_name'    => 'footer_style',
				'type'          => 'css_editor',
				'heading'       => esc_html__( 'Style', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Footer Style', 'worker-wpbakery' ),
				'dependency'    => [
					'element'   => 'show_footer',
					'value'     => 'yes'
				]
			];

			/** Footer Font. */
			$params[] = [
				'param_name' => 'footer_font_container',
				'type' => 'font_container',
				'group'         => esc_html__( 'Footer Style', 'worker-wpbakery' ),
				'value' => '',
				'edit_field_class'  => 'mdp-control mdp-control-small',
				'settings' => [
					'fields' => [
						'font_size',
						'line_height',
						'color',
						'font_size_description' => esc_html__( 'Enter font size.', 'worker-wpbakery' ),
						'line_height_description' => esc_html__( 'Enter line height.', 'worker-wpbakery' ),
						'color_description' => esc_html__( 'Select heading color.', 'worker-wpbakery' ),
					],
				],
				'dependency'    => [
					'element'   => 'show_footer',
					'value'     => 'yes'
				]
			];

			/** Use default font family?. */
			$params[] = [
				'param_name'    => 'footer_use_theme_fonts',
				'type'          => 'checkbox',
				'heading'       => esc_html__( 'Use default font family?', 'worker-wpbakery' ),
				'group'         => esc_html__( 'Footer Style', 'worker-wpbakery' ),
				'description'   => esc_html__( 'Use font family from the theme.', 'js_composer' ),
				'std'           => 'yes',
				'value'         => [esc_html__( 'Yes', 'worker-wpbakery' ) => 'yes'],
				'edit_field_class'  => 'mdp-control',
				'dependency'    => [
					'element'   => 'show_footer',
					'value'     => 'yes'
				]
			];

			/** Footer Google Font. */
			/** @noinspection SpellCheckingInspection */
			$params[] = [
				'param_name'    => 'footer_google_font',
				'type'          => 'google_fonts',
				'group'         => esc_html__( 'Footer Style', 'worker-wpbakery' ),
				'value'         => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings' => [
					'fields' => [
						'font_family_description' => esc_html__( 'Select font family.', 'worker-wpbakery' ),
						'font_style_description' => esc_html__( 'Select font styling.', 'worker-wpbakery' ),
					],
				],
				'dependency'    => [
					'element' => 'footer_use_theme_fonts',
					'value_not_equal_to' => 'yes'
				]

			];

		} // END Footer Style Tab.

        /** Add [mdp_wpb_worker] shortcode to the WPBakery Page Builder. */
		vc_map( [
			'name'                      => esc_html__( 'Worker', 'worker-wpbakery' ),
			'description'               => esc_html__( 'Creates a modern and stylish addon to display business hours.', 'worker-wpbakery' ),
			'base'                      => 'mdp_wpb_worker',
			'icon'                      => 'icon-mdp-worker-wpbakery',
			'category'                  => esc_html__( 'Content', 'worker-wpbakery' ),
			'show_settings_on_create'   => true,
			'params'                    => $params,
		] );

	}

	/**
	 * Add array offset, to set correct first day of week.
	 *
	 *
	 * @param $week array - Days of week, starting from Sun.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array - Days of week with correct first day.
	 */
	private function set_start_of_week( $week ) {

		/** Get WP Start day of the week. */
		$start_of_week = get_option( 'start_of_week' );

		/** Add offset to array. */
		for( $i = 0; $i < $start_of_week; $i++ ) {
			$this->array_shift ( $week );
		}

		return $week;
	}

	/**
	 * Make array offset.
	 *
	 * @param $arr array - Reference to array on which we will carry out manipulations.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 **/
	private function array_shift ( &$arr ) {

		$keys = array_keys( $arr );
		$val = $arr[$keys[0]];
		unset( $arr[$keys[0]] );
		$arr[$keys[0]] = $val;

	}

	/**
	 * Return time in WP format.
	 *
	 *
	 * @param $time string - Time in format 'H:i'
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string - Time in current WP format.
	 **/
	private function format_time( $time ) {

		/** Get WP time format. */
		$wp_time_format = get_option( 'time_format' );

		$time_obj = DateTime::createFromFormat( 'H:i', $time );

		if ( ! $time_obj ) {  return $time; }

		return $time_obj->format( $wp_time_format );

	}

	/**
	 * Convert php time format string to js.
	 * @see https://flatpickr.js.org/formatting/
	 *
	 * @param $time_format string - PHP Time in format, ex. 'g:i A'
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string - Time in current WP format.
	 **/
	private function time_format_to_js( $time_format ) {

		$js_format = $time_format;

		// AM/PM
		$js_format = str_replace( 'a', 'K', $js_format );
		$js_format = str_replace( 'A', 'K', $js_format );

		// g => G
		$js_format = str_replace( 'g', 'G', $js_format );

		return $js_format;
	}

	/**
	 * Return current status.
	 *
	 * @param $settings - All widget settings.
	 *
	 * @return bool - True if we are open now.
	 * @since 1.0.0
	 * @access public
	 **/
	private function is_open( $settings ) {

		/** Get current day prefix. */
		$day = strtolower( current_time( 'D' ) ); // mon

		/** Check if holiday today. */
		if ( $this->is_holiday( $settings['holidays_dates'], $settings['holidays_recurring'] ) ) {
			return false;
		}

		/** If we are closed all day. */
		if ( 'yes' === $settings["{$day}_closed"] ) {
			return false;
		}

		/** If we are open all day. */
		if ( 'yes' === $settings["{$day}_open_24"] ) {
			return true;
		}

		/** Check, are we opened now? */
		foreach ( $settings["{$day}_business_hours"] as $hours ) {

			/** Prepare variables. */
			$wp_time_format = get_option( 'time_format' );
			$current_time = current_time( $wp_time_format );

			$start_time = $hours['start_time'];
			$end_time = $hours['end_time'];

			/** Convert to same format. */
			$date1 = DateTime::createFromFormat( $wp_time_format, $current_time );
			$date2 = DateTime::createFromFormat( $wp_time_format, $start_time );
			$date3 = DateTime::createFromFormat( $wp_time_format, $end_time );

			/** If the current time between start_time and end_time - we are opened now. */
			if ( $date1 > $date2 && $date1 < $date3 ) {
				return true;
			}
		}

		/** We are closed by default. */
		return false;
	}

	/**
	 * Return true, if today is holiday.
	 *
	 * @param $dates string - Comma separated holiday dates.
	 *
	 * @param $recurring string - 'yes' if we need to apply date range every year. So the year in the dates will be ignored.
	 *
	 * @return bool - true if today is holiday.
	 * @since 1.0.0
	 * @access public
	 */
	private function is_holiday( $dates, $recurring ) {

		/** Convert $dates to array. */
		$dates = explode( ', ', $dates );

		/** Convert $recurring to bool. */
		if ( 'yes' === $recurring ) {
			$recurring = true;
		} else {
			$recurring = false;
		}

		/** Get today date. */
		$today = date( 'd-m-Y' );
		if ( $recurring ) {
			$today = substr( $today, 0, -5 );
		}

		/** Search holiday. */
		foreach ( $dates as $date ) {

			if ( $recurring ) {
				$date = substr( $date, 0, -5 );
			}

			/** Today is holiday. */
			if ( $today === $date ) {
				return true;
			}

		}

		/** Today is typical day. */
		return false;
	}

	/**
	 * Return true, if today is holiday for week day.
	 *
	 * @param $dates string - Comma separated holiday dates.
	 * @param $recurring string - 'yes' if we need to apply date range every year. So the year in the dates will be ignored.
	 * @param $day string - Current week day in short, ex.: mon
	 *
	 * @return bool - true if today is holiday.
	 * @since 1.0.0
	 * @access public
	 **/
	private function is_holiday_today( $dates, $recurring, $day ) {

		/** Convert $dates to array. */
		$dates = explode( ', ', $dates );

		/** Convert $recurring to bool. */
		if ( 'yes' === $recurring ) {
			$recurring = true;
		} else {
			$recurring = false;
		}

		/** Get today date. */
		$today = date( 'd-m-Y', strtotime( "{$day} this week" ) );
		if ( $recurring ) {
			$today = substr( $today, 0, -5 );
		}

		/** Search holiday. */
		foreach ( $dates as $date ) {

			if ( $recurring ) {
				$date = substr( $date, 0, -5 );
			}

			/** Today is holiday. */
			if ( $today === $date ) {
				return true;
			}

		}

		/** Today is typical day. */
		return false;
	}

	/**
	 * Return inline css style for google_font field.
	 *
	 * @param string $param - value of google_font field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string - css font styles.
	 **/
	private function get_google_font_inline_css( $param ) {

		$res = '';

		/** Decode. */
		$param = urldecode( $param );

		/** Split. */
		$tmp = explode( '|', $param );

		/** Combine to array. */
		$google_font['font_family'] = str_replace( 'font_family:', '', $tmp[0] );
		$google_font['font_style'] = str_replace( 'font_style:', '', $tmp[1] );

		/** Enqueue custom Google Font. */
		$this->enqueue_google_font( $google_font['font_family'] );

		/** Generate CSS. */
		$font_family = explode( ':', $google_font['font_family'] );
		$res .= 'font-family:' . $font_family[0] . ';';

		$font_styles = explode( ':', $google_font['font_style'] );
		$res .= 'font-weight:' . $font_styles[1] . ';';
		$res .= 'font-style:' . $font_styles[2] . ';';

		return $res;
	}

	/**
	 * Enqueue custom Google Font.
	 *
	 * @param string $font_family - Google font family.
	 *
	 * @since  1.0.0
	 * @access public
	 **/
	private function enqueue_google_font( $font_family ) {

		/** Get extra subsets for settings (latin/cyrillic/etc). */
		$settings = get_option( 'wpb_js_google_fonts_subsets' );

		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		/** Enqueue font from googleapis. */
		if ( ! empty( $font_family ) ) {
			wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $font_family ), '//fonts.googleapis.com/css?family=' . $font_family . $subsets );
		}

    }


} // END Class wpbWorker.

/** Run Worker addon. */
new wpbWorker();