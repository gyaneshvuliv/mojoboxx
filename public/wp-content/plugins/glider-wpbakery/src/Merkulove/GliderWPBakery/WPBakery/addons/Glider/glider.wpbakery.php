<?php
/**
 * Glider Create a responsive carousel slider.
 * Exclusively on Envato Market: https://1.envato.market/glider-wpbakery
 *
 * @encoding        UTF-8
 * @version         1.0.1
 * @copyright       Copyright (C) 2018 - 2020 Merkulove ( https://merkulov.design/ ). All rights reserved.
 * @license         Envato License https://1.envato.market/KYbje
 * @contributors    Alexander Khmelnitskiy (info@alexander.khmelnitskiy.ua), Dmitry Merkulov (dmitry@merkulov.design)
 * @support         help@merkulov.design
 **/

/** See https://getuikit.com/v2/docs/slider.html */

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

use Merkulove\GliderWPBakery;

class wpbGlider {

	public static $css = '';

	/**
	 * Get things started.
	 *
	 * @throws Exception
	 * @since  1.0.0
	 * @access public
	 **/
    public function __construct() {

        /** Add scripts. */
        add_action( 'wp_enqueue_scripts', [$this, 'scripts' ] );

        /** Add styles. */
	    add_action( 'wp_enqueue_scripts', [$this, 'styles' ] );

	    /** Glider addon map. */
	    $this->map_glider();
	    $this->map_glider_child();

	    /** Shortcodes for Glider addon. */
        add_shortcode( 'mdp_glider', [$this, 'shortcode_func'] );
        add_shortcode( 'mdp_gliderslide', [$this, 'child_shortcode_func'] );

    }

	/**
	 * Load CSS Styles.
	 *
	 * @since  1.0.0
	 * @access public
	 **/
	public function styles() {

		/** Add UIkit 2 Grid, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-grid', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-grid', GliderWPBakery::$url . 'css/uikit-2-grid' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-grid' );
		}

		/** Add UIkit 2 Slidenav, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-slidenav', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-slidenav', GliderWPBakery::$url . 'css/uikit-2-slidenav' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-slidenav' );
		}

		/** Add UIkit 2 Slider, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-slider', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-slider', GliderWPBakery::$url . 'css/uikit-2-slider' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-slider' );
		}

		wp_enqueue_style( 'mdp-wpb-glider', GliderWPBakery::$url . 'css/wpb-glider' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );

	}

	/**
	 * Load scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 **/
    public function scripts() {

        /** Add UIkit 2 Core, if not added. */
        if ( ! wp_script_is( 'mdp-uikit-2-core', 'enqueued' ) ) {
            wp_register_script( 'mdp-uikit-2-core', GliderWPBakery::$url . 'js/uikit-2-core' . GliderWPBakery::$suffix . '.js', ['jquery'], GliderWPBakery::$version, true );
            wp_enqueue_script( 'mdp-uikit-2-core' );
        }

	    /** Add UIkit 2 touch, if not added. */
	    if ( ! wp_script_is( 'mdp-uikit-2-touch', 'enqueued' ) ) {
		    wp_register_script( 'mdp-uikit-2-touch', GliderWPBakery::$url . 'js/uikit-2-touch' . GliderWPBakery::$suffix . '.js', ['jquery', 'mdp-uikit-2-core'], GliderWPBakery::$version, true );
		    wp_enqueue_script( 'mdp-uikit-2-touch' );
	    }

	    /** Add UIkit 2 utility, if not added. */
	    if ( ! wp_script_is( 'mdp-uikit-2-utility', 'enqueued' ) ) {
		    wp_register_script( 'mdp-uikit-2-utility', GliderWPBakery::$url . 'js/uikit-2-utility' . GliderWPBakery::$suffix . '.js', ['jquery', 'mdp-uikit-2-core'], GliderWPBakery::$version, true );
		    wp_enqueue_script( 'mdp-uikit-2-utility' );
	    }

	    /** Add UIkit 2 Grid, if not added. */
	    if ( ! wp_script_is( 'mdp-uikit-2-grid', 'enqueued' ) ) {
		    wp_register_script( 'mdp-uikit-2-grid', GliderWPBakery::$url . 'js/uikit-2-grid' . GliderWPBakery::$suffix . '.js', ['jquery', 'mdp-uikit-2-core'], GliderWPBakery::$version, true );
		    wp_enqueue_script( 'mdp-uikit-2-grid' );
	    }

        /** Add UIkit 2 slider, if not added. */
        if ( ! wp_script_is( 'mdp-uikit-2-slider', 'enqueued' ) ) {
            wp_register_script( 'mdp-uikit-2-slider', GliderWPBakery::$url . 'js/uikit-2-slider' . GliderWPBakery::$suffix . '.js', ['jquery', 'mdp-uikit-2-core'], GliderWPBakery::$version, true );
            wp_enqueue_script( 'mdp-uikit-2-slider' );
        }

    }

	/**
	 * Prepare array of settings for UIkit slider.
	 *
	 * @param array $settings - Shortcode settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 **/
    private function get_uikit_slider_config( $settings ) {

	    $configuration = [];

	    /** Center items mode. */
	    if ( $settings['center_mode'] ) {

		    $configuration[] = 'center: true';

	    } else {

		    $configuration[] = 'center: false';

	    }

	    /** Infinite scrolling. */
	    if ( $settings['enable_infinite_scrolling'] ) {

		    $configuration[] = 'infinite: true';

	    } else {

		    $configuration[] = 'infinite: false';

	    }

	    /** Defines whether or not the slider items should switch automatically. */
	    if ( $settings['autoplay'] ) {

		    $configuration[] = 'autoplay: true';
		    $configuration[] = 'autoplayInterval: ' . $settings['autoplay_interval'];

	    } else {

		    $configuration[] = 'autoplay: false';

	    }

	    /** Pause autoplay when hovering a slider. */
	    if ( $settings['pause_on_hover'] ) {

		    $configuration[] = 'pauseOnHover: true';

	    } else {

		    $configuration[] = 'pauseOnHover: false';

	    }

	    return $configuration;

    }

	/**
	 * Return inline css for current instance of addon.
	 *
	 * @param array $settings   - Shortcode settings.
	 * @param string $id        - Unique id for current block.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return false|string
	 **/
	private function get_inline_css_gliderslide( $settings, $id ) {

		$css = '';

		if ( ! empty( $settings['item_height'] ) ) {
			$css .= ".{$id} > div > div { height: {$settings['item_height']}; overflow: hidden; }";
		}

	    if ( ! empty( $settings['item_font_container'] ) ) {
		    $settings['item_font_container'] = urldecode( $settings['item_font_container'] );
		    $settings['item_font_container'] = str_replace( '|', ';', $settings['item_font_container'] );
		    $settings['item_font_container'] = str_replace( '_', '-', $settings['item_font_container'] );
		    $css .= ".{$id} * { {$settings['item_font_container']}; }";
	    }

	    if ( 'yes' !== $settings['item_use_theme_fonts'] ) {
		    $google_font_css = $this->get_google_font_inline_css( $settings['item_google_font'] );
		    $css .= ".{$id} * { {$google_font_css} }";
	    }

		return $css;

    }

	/**
	 * Return inline css for current instance of addon.
	 *
	 * @param array $settings   - Shortcode settings.
	 * @param string $id        - Unique id for current block.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return false|string
	 **/
    private function get_inline_css_glider( $settings, $id ) {

	    $css = '';

	    # Arrow size.
	    $css .= "#{$id} .mdp-slider-container .mdp-slidenav .vc_icon_element-icon { font-size: {$settings['icon_size']}; }";

	    # Arrow color.
	    $css .= "#{$id} .mdp-slider-container .mdp-slidenav { color: {$settings['icon_color']}; }";

	    return $css;

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

	/**
	 * Shortcodes for Glider container.
	 *
	 * @param      $atts
	 * @param null $content
	 *
	 * @since  1.0.0
	 * @access public
	 * @return false|string
	 **/
    public function shortcode_func( $atts, $content = null ) {

        $settings = shortcode_atts( [
            'small'                         => '1',
            'medium'                        => '1',
            'large'                         => '1',
            'gutter'                        => 'mdp-grid-default',
            'show_next_prev'                => false,
            'center_mode'                   => false,
            'enable_infinite_scrolling'     => true,
            'item_gutter'                   => 'mdp-grid-collapse',
            'fullscreen_mode'               => false,
            'autoplay'                      => false,
            'autoplay_interval'             => '7000',
            'pause_on_hover'                => false,

            'prev_icon'                     => 'fas fa-chevron-left',
            'next_icon'                     => 'fas fa-chevron-right',
            'icon_size'                     => '30px',
            'icon_color'                    => 'rgba(183,183,183,0.7)',
            'nav_position'                  => 'center',

            'slideset_style'                => '',

        ], $atts );

        /** Fix unclosed/unwanted paragraph tags in $content. */
        $content = wpb_js_remove_wpautop( $content, true );

        /** UIkit Slider configuration. */
        $config = $this->get_uikit_slider_config( $settings );

	    $fullscreen_class = '';
	    if ( $settings['fullscreen_mode'] ) {
		    $fullscreen_class = 'mdp-slider-fullscreen';
	    }

	    /** Unique id for current block. */
	    $id = 'mdp-glider-' . md5( json_encode( $atts ) );

	    /** Prepare inline CSS for this instance of addon. */
        $css = $this->get_inline_css_glider( $settings, $id );

        $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $settings['slideset_style'], '' ), 'mdp_glider', $atts );

        ob_start(); ?>
	    <?php printf( "<style>%s</style>", $css . self::$css ); ?>
        <div class="mdp-glider mdp-slidenav-position-<?php esc_attr_e( $settings['nav_position'] ); ?>" id="<?php esc_attr_e( $id ); ?>">
            <div data-mdp-slider="{<?php echo implode( ', ', $config ); ?>}">
                <div class="mdp-slider-container <?php esc_attr_e( $style_class ); ?>">
                    <ul class="mdp-slider mdp-grid <?php esc_attr_e( $settings['item_gutter'] ); ?> <?php esc_attr_e( $fullscreen_class ); ?> mdp-grid-width-small-1-<?php esc_attr_e( $settings['small'] ); ?> mdp-grid-width-medium-1-<?php esc_attr_e( $settings['medium'] ); ?> mdp-grid-width-large-1-<?php esc_attr_e( $settings['large'] ); ?>">
                        <?php
                        $content = do_shortcode( $content );
                        $content = GliderWPBakery\Helper::get_instance()->remove_prefix( $content, '<p>' );
                        $content = GliderWPBakery\Helper::get_instance()->remove_suffix( $content, '</p>' );
                        echo do_shortcode( $content );
                        ?>
                    </ul>
                    <?php if ( $settings['show_next_prev'] ) : ?>
	                    <?php vc_icon_element_fonts_enqueue( 'fontawesome' ); // Enqueue needed icon font. ?>
                        <a href="#" class="mdp-slidenav mdp-slidenav-previous" data-mdp-slider-item="previous"><span class="vc_icon_element-icon <?php esc_attr_e( $settings['prev_icon'] ); ?>"></span></a>
                        <a href="#" class="mdp-slidenav mdp-slidenav-next" data-mdp-slider-item="next"><span class="vc_icon_element-icon <?php esc_attr_e( $settings['next_icon'] ); ?>"></span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php

        return ob_get_clean();

    }

	/**
	 * Shortcodes for Glider item.
	 *
	 * @param      $atts
	 * @param null $content
	 *
	 * @since  1.0.0
	 * @access public
	 * @return false|string
	 *
	 **/
    public function child_shortcode_func( $atts, $content = null ) {

	    $settings = shortcode_atts( [
		    'item_height'               => 'auto',
		    'item_style'                => '',
            'item_font_container'       => '',
            'item_use_theme_fonts'      => 'yes',
            'item_google_font'          => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
	    ], $atts );

	    /** Fix unclosed/unwanted paragraph tags in $content. */
        $content = wpb_js_remove_wpautop( $content, true );

	    /** Unique id for current block. */
	    $class_id = 'mdp-gliderslide-' . md5( json_encode( $atts ) );

	    /** Prepare inline CSS for this instance of addon. */
	    $css = $this->get_inline_css_gliderslide( $settings, $class_id );

	    $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $settings['item_style'], '' ), 'mdp_gliderslide', $atts );

	    /** Add inline styles. */
	    self::$css .= $css;

	    /** Render Item. */
        ob_start();

	    ?><li class="mdp-gliderslide <?php esc_attr_e( $class_id ); ?>"><div class="mdp-flex mdp-flex-center mdp-flex-middle"><div class="mdp-glider-content <?php esc_attr_e( $style_class ); ?>"><?php echo do_shortcode( $content ); ?></div></div></li><?php

        return ob_get_clean();

    }

	/**
	 * Slider container map
	 *
	 * @since  1.0.0
	 * @access public
     * @throws Exception
	 **/
    public function map_glider() {

	    /** Check, just in case. */
	    if ( ! function_exists( 'vc_map' ) ) { return; }

	    /** Control params. */
	    $params = [];

	    /** General Tab. */
	    if ( true ) {

		    # Small.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'small',
			    'heading'       => esc_html__( 'Small', 'glider-wpbakery'),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Number of items you want to display on small breakpoint.', 'glider-wpbakery'),
			    'value'         => [
				    esc_html__( '1',    'glider-wpbakery' ) => '1',
				    esc_html__( '2',    'glider-wpbakery' ) => '2',
				    esc_html__( '3',    'glider-wpbakery' ) => '3',
				    esc_html__( '4',    'glider-wpbakery' ) => '4',
				    esc_html__( '5',    'glider-wpbakery' ) => '5',
				    esc_html__( '6',    'glider-wpbakery' ) => '6',
				    esc_html__( '10',   'glider-wpbakery' ) => '7',
			    ],
		    ];

		    # Medium.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'medium',
			    'heading'       => esc_html__( 'Medium', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Number of items you want to display on medium breakpoint.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( '1',    'glider-wpbakery' ) => '1',
				    esc_html__( '2',    'glider-wpbakery' ) => '2',
				    esc_html__( '3',    'glider-wpbakery' ) => '3',
				    esc_html__( '4',    'glider-wpbakery' ) => '4',
				    esc_html__( '5',    'glider-wpbakery' ) => '5',
				    esc_html__( '6',    'glider-wpbakery' ) => '6',
				    esc_html__( '10',   'glider-wpbakery' ) => '7',
			    ],
		    ];

		    # Large.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'large',
			    'heading'       => esc_html__( 'Large', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Number of items you want to display on large breakpoint.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( '1',    'glider-wpbakery' ) => '1',
				    esc_html__( '2',    'glider-wpbakery' ) => '2',
				    esc_html__( '3',    'glider-wpbakery' ) => '3',
				    esc_html__( '4',    'glider-wpbakery' ) => '4',
				    esc_html__( '5',    'glider-wpbakery' ) => '5',
				    esc_html__( '6',    'glider-wpbakery' ) => '6',
				    esc_html__( '10',   'glider-wpbakery' ) => '7',
			    ],
		    ];

		    # Item gutter.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'item_gutter',
			    'heading'       => esc_html__( 'Item gutter', 'glider-wpbakery'),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Use it if you want some spacing between your elements.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( 'None',     'glider-wpbakery' ) => 'mdp-grid-collapse',
				    esc_html__( 'Small',    'glider-wpbakery' ) => 'mdp-grid-small',
				    esc_html__( 'Medium',   'glider-wpbakery' ) => 'mdp-grid-medium',
				    esc_html__( 'Large',    'glider-wpbakery' ) => 'mdp-grid-large',
			    ],
		    ];

		    # Center Mode.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'center_mode',
			    'heading'       => esc_html__( 'Center Mode', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Enable this if you want to center the elements.', 'glider-wpbakery'),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery') => 'true'],
		    ];

		    # Enable Infinite Scrolling
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'enable_infinite_scrolling',
			    'heading'       => esc_html__( 'Enable Infinite Scrolling', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'By default, the slider loops through all items. Enable this checkbox to disable that behaviour.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true'],
			    'std'           => 'true',
		    ];

		    # Fullscreen mode.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'fullscreen_mode',
			    'heading'       => esc_html__( 'Fullscreen mode', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Each slide stretches to 100% the height of the viewport.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true'],
		    ];

		    # Autoplay.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'autoplay',
			    'heading'       => esc_html__( 'Autoplay', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines whether or not the slider items should switch automatically.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery') => 'true'],
		    ];

		    # Autoplay Interval.
		    $params[] = [
			    'type'          => 'textfield',
			    'param_name'    => 'autoplay_interval',
			    'heading'       => esc_html__( 'Autoplay Interval', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines the timespan between switching slider items, in milliseconds.', 'glider-wpbakery' ),
			    'value'         => '7000',
			    'dependency'    => [
				    'element'   => 'autoplay',
				    'not_empty' => true,
			    ],
		    ];

		    # Pause on hover.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'pause_on_hover',
			    'heading'       => esc_html__( 'Pause on hover', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Pause autoplay when hovering a slider.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true'],
			    'dependency'    => [
				    'element'   => 'autoplay',
				    'not_empty' => true,
			    ],
		    ];

        } // END General Tab.

	    /** Navigation Tab. */
	    if ( true ) {

		    # Show next and previous.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'show_next_prev',
			    'heading'       => esc_html__( 'Show next and previous', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines a navigation with previous and next buttons to browse through slider.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true'],
		    ];

		    # Position.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'nav_position',
			    'heading'       => esc_html__( 'Position', 'glider-wpbakery'),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( 'Default',    'glider-wpbakery' ) => 'center',
				    esc_html__( 'Bottom Left',    'glider-wpbakery' ) => 'bottom-left',
				    esc_html__( 'Bottom Center',    'glider-wpbakery' ) => 'bottom-center',
				    esc_html__( 'Bottom Right',    'glider-wpbakery' ) => 'bottom-right',
			    ],
			    'dependency'    => [
				    'element'   => 'show_next_prev',
				    'value'     => 'true'
			    ]
		    ];

		    /** Prev Icon. */
		    $params[] = [
			    'param_name'    => 'prev_icon',
			    'type'          => 'iconpicker',
			    'heading'       => esc_html__( 'Prev Icon', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'value'         => 'fas fa-chevron-left',
			    'settings'      => [
				    'emptyIcon'     => false, // default true, display an "EMPTY" icon?
				    'iconsPerPage'  => 200, // default 100, how many icons per/page to display
			    ],
			    'dependency'    => [
				    'element'   => 'show_next_prev',
				    'value'     => 'true'
			    ]
		    ];

		    /** Next Icon. */
		    $params[] = [
			    'param_name'    => 'next_icon',
			    'type'          => 'iconpicker',
			    'heading'       => esc_html__( 'Next Icon', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'value'         => 'fas fa-chevron-right',
			    'settings'      => [
				    'emptyIcon'     => false, // default true, display an "EMPTY" icon?
				    'iconsPerPage'  => 200, // default 100, how many icons per/page to display
			    ],
			    'dependency'    => [
				    'element'   => 'show_next_prev',
				    'value'     => 'true'
			    ]
		    ];

		    /** Icon Size. */
		    $params[] = [
			    'param_name'    => 'icon_size',
			    'type'          => 'textfield',
			    'heading'       => esc_html__( 'Icon Size ', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Enter size in px for previous and next buttons.', 'glider-wpbakery' ),
			    'value'         => '30px',
			    'dependency'    => [
				    'element'   => 'show_next_prev',
				    'value'     => 'true'
			    ]
		    ];

		    /** Icon Color. */
		    $params[] = [
			    'param_name'    => 'icon_color',
			    'type'          => 'colorpicker',
			    'heading'       => esc_html__( 'Icon color ', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'value'         => 'rgba(183,183,183,0.7)',
			    'dependency'    => [
				    'element'   => 'show_next_prev',
				    'value'     => 'true'
			    ]
		    ];

        } // END Navigation Tab.

	    /** Style Tab. */
	    if ( true ) {

		    /** Item Style. */
		    $params[] = [
			    'param_name'    => 'slideset_style',
			    'type'          => 'css_editor',
			    'heading'       => esc_html__( 'Style', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
		    ];

	    } // END Style Tab.

        /** Register "container" Glider element. It will hold all inner (child) content elements. */
	    vc_map( [
		    'name'                      => esc_html__( 'Glider', 'glider-wpbakery' ),
		    'base'                      => 'mdp_glider',
		    'as_parent'                 => ['only' => 'mdp_gliderslide'], // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'           => true,
		    'show_settings_on_create'   => true,
		    'category'                  => esc_html__( 'Content', 'glider-wpbakery' ),
		    'is_container'              => true,
		    'description'               => esc_html__('Create sets and groups of items, allowing to loop through the sets.', 'glider-wpbakery'),
		    'js_view'                   => 'VcColumnView',
		    'icon'                      => 'icon-mdp-glider',
		    'params'                    => $params,
	    ] );

    }

	/**
	 * Slide item map
	 *
	 * @since  1.0.0
	 * @access public
	 * @throws Exception
	 **/
    public function map_glider_child() {

	    /** Check, just in case. */
	    if ( ! function_exists( 'vc_map' ) ) { return; }

	    /** Control params. */
	    $params = [];

	    /*********************/
	    /*    Content Tab.     */
	    /*********************/
	    if ( true ) {

		    # Title.
		    $params[] = [
			    'type'          => 'textfield',
			    'param_name'    => 'slide_name',
			    'admin_label'   => true,
			    'heading'       => esc_html__( 'Title', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Content', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Title for slide item.', 'glider-wpbakery' ),
		    ];

		    # Slide Content.
		    $params[] = [
			    'type'          => 'textarea_html',
			    'param_name'    => 'content',
			    'heading'       => esc_html__( 'Slide Content', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Content', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Content of slide in the slider.', 'glider-wpbakery' ),
		    ];

	    } // END Content Tab.

	    /*********************/
	    /*    Style Tab.     */
	    /*********************/
	    if ( true ) {

		    /** Item Height. */
		    $params[] = [
			    'param_name'    => 'item_height',
			    'type'          => 'textfield',
			    'heading'       => esc_html__( 'Height', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
			    'value'         => 'auto',
		    ];

		    /** Item Style. */
		    $params[] = [
			    'param_name'    => 'item_style',
			    'type'          => 'css_editor',
			    'heading'       => esc_html__( 'Style', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
		    ];

		    /** Item Font. */
		    $params[] = [
			    'param_name' => 'item_font_container',
			    'type' => 'font_container',
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
			    'value' => '',
			    'settings' => [
				    'fields' => [
					    'font_size',
					    'line_height',
					    'color',
					    'font_size_description' => esc_html__( 'Enter font size.', 'glider-wpbakery' ),
					    'line_height_description' => esc_html__( 'Enter line height.', 'glider-wpbakery' ),
					    'color_description' => esc_html__( 'Select heading color.', 'glider-wpbakery' ),
				    ],
			    ],
		    ];

		    /** Use default font family?. */
		    $params[] = [
			    'param_name'    => 'item_use_theme_fonts',
			    'type'          => 'checkbox',
			    'heading'       => esc_html__( 'Use default font family?', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Use font family from the theme.', 'glider-wpbakery' ),
			    'std'           => 'yes',
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'yes'],
		    ];

		    /** Item Google Font. */
		    /** @noinspection SpellCheckingInspection */
		    $params[] = [
			    'param_name'    => 'item_google_font',
			    'type'          => 'google_fonts',
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
			    'value'         => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
			    'settings' => [
				    'fields' => [
					    'font_family_description' => esc_html__( 'Select font family.', 'glider-wpbakery' ),
					    'font_style_description' => esc_html__( 'Select font styling.', 'glider-wpbakery' ),
				    ],
			    ],
			    'dependency'    => [
				    'element' => 'item_use_theme_fonts',
				    'value_not_equal_to' => 'yes'
			    ]
		    ];

	    } // END Style Tab.

	    /** Register "child" Glider element. */
	    vc_map( [
		    'name'              => esc_html__( 'Glider Slide', 'glider-wpbakery' ),
		    'base'              => 'mdp_gliderslide',
		    'content_element'   => true,
		    'description'       => esc_html__( 'Single element of slider, You can place your images, HTML content or Video.', 'glider-wpbakery' ),
		    'as_child'          => ['only' => 'mdp_glider'],
		    'icon'              => 'icon-mdp-gliderslide',
		    'params'            => $params,
	    ] );

    }
}

/**
 * "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality.
 **/
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_mdp_glider extends WPBakeryShortCodesContainer { }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_mdp_gliderslide extends WPBakeryShortCode { }
}

/** Run. */
new wpbGlider();
