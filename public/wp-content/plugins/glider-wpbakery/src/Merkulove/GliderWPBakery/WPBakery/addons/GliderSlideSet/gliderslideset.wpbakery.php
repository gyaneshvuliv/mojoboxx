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

/** See https://getuikit.com/v2/docs/slideset.html */

/** Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

use Merkulove\GliderWPBakery;

class wpbGliderSlideSet {

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
	    $this->map_vc_element();
	    $this->map_child_vc_element();

	    /** Shortcodes for Glider SlideSet addon. */
        add_shortcode( 'mdp_glider_slideset', [$this, 'shortcode_func'] );
        add_shortcode( 'mdp_glider_slidesetslide', [$this, 'child_shortcode_func'] );

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

		/** Add UIkit 2 animation, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-animation', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-animation', GliderWPBakery::$url . 'css/uikit-2-animation' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-animation' );
		}

		/** Add UIkit 2 Dotnav, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-dotnav', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-dotnav', GliderWPBakery::$url . 'css/uikit-2-dotnav' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-dotnav' );
		}

		/** Add UIkit 2 Flex, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-flex', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-flex', GliderWPBakery::$url . 'css/uikit-2-flex' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-flex' );
		}

		/** Add UIkit 2 Slidenav, if not added. */
		if ( ! wp_style_is( 'mdp-uikit-2-slidenav', 'enqueued' ) ) {
			wp_register_style( 'mdp-uikit-2-slidenav', GliderWPBakery::$url . 'css/uikit-2-slidenav' . GliderWPBakery::$suffix . '.css', [], GliderWPBakery::$version );
			wp_enqueue_style( 'mdp-uikit-2-slidenav' );
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

	    /** Add UIkit 2 slideset, if not added. */
	    if ( ! wp_script_is( 'mdp-uikit-2-slideset', 'enqueued' ) ) {
		    wp_register_script( 'mdp-uikit-2-slideset', GliderWPBakery::$url . 'js/uikit-2-slideset' . GliderWPBakery::$suffix . '.js', ['jquery', 'mdp-uikit-2-core'], GliderWPBakery::$version, true );
		    wp_enqueue_script( 'mdp-uikit-2-slideset' );
	    }

    }

	/**
	 * Prepare array of settings for UIkit slideset.
	 *
	 * @param array $settings - Shortcode settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 **/
	private function get_uikit_slideset_config( $settings ) {

		$configuration = [];

		$configuration[] = "small: '{$settings['small']}'";
		$configuration[] = "medium: '{$settings['medium']}'";
		$configuration[] = "large: '{$settings['large']}'";

		$configuration[] = "animation: '{$settings['animation']}'";

		$configuration[] = "duration: {$settings['duration']}";

		if ( $settings['autoplay'] ) {

			$configuration[] = 'autoplay: true';
			$configuration[] = "autoplayInterval: {$settings['autoplay_interval']}";

		} else {

			$configuration[] = 'autoplay: false';

		}

		if ( $settings['pause_on_hover'] ) {

			$configuration[] = "pauseOnHover: true";

		} else {

			$configuration[] = "pauseOnHover: false";

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
	private function get_inline_css_glider_slideset( $settings, $id ) {

		/** Prepare inline CSS for this instance of addon. */
		$css = '';

		# Arrow size.
		$css .= "#{$id} .mdp-glider-slideset-container .mdp-slidenav .vc_icon_element-icon { font-size: {$settings['icon_size']}; }";

		# Arrow color.
		$css .= "#{$id} .mdp-glider-slideset-container .mdp-slidenav { color: {$settings['icon_color']}; }";

		# Dotnav size and color.
		$slideset_id = "#{$id}";
		$css .= "
             $slideset_id .mdp-glider-slideset-container .mdp-dotnav > * > * {
                background-color: {$settings['dotnav_color']}; 
	            opacity: 0.5;
                width: {$settings['dotnav_size']};
                height: {$settings['dotnav_size']};
                cursor: pointer;
            }
            
            $slideset_id .mdp-glider-slideset-container .mdp-dotnav > * > :hover {
                opacity: 0.7;
            }
            
	        $slideset_id .mdp-glider-slideset-container .mdp-dotnav > .mdp-active > * { 
	            background-color: {$settings['dotnav_color']}; 
	            opacity: 1; 
            }
        ";

		$css .= "#{$id} .mdp-glider-slideset-container .mdp-slideset > li { display: flex; align-items: {$settings['vertical_align']}; }";

		return $css;

    }

	/**
	 * Shortcodes for Glider slideset container.
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
            'small'             => '1',
            'medium'            => '2',
            'large'             => '3',
            'gutter'            => 'mdp-grid-default',
		    'vertical_align'    => '',
            'show_navigation'   => FALSE,
            'show_next_prev'    => FALSE,
            'animation'         => 'fade',
            'duration'          => '500',
            'autoplay'          => FALSE,
            'autoplay_interval' => '7000',
            'pause_on_hover'    => FALSE,
            'prev_icon'         => 'fas fa-chevron-left',
            'next_icon'         => 'fas fa-chevron-right',
            'icon_size'         => '30px',
            'icon_color'        => 'rgba(183,183,183,0.7)',
            'nav_position'      => 'center',
            'dotnav_size'       => '30px',
            'dotnav_color'      => 'rgba(183,183,183,0.7)',
            'slideset_style'    => '',
        ], $atts );

        $slides_count = substr_count( $content, '[mdp_glider_slidesetslide' );

	    /** Fix unclosed/unwanted paragraph tags in $content. */
        $content = wpb_js_remove_wpautop( $content, true );

	    /** UIkit Slideset configuration. */
	    $config = $this->get_uikit_slideset_config( $settings );

	    /** Unique id for current block. */
	    $id = 'mdp-glider-slideset-' . md5( json_encode( $atts ) );

	    /** Prepare inline CSS for this instance of addon. */
	    $css = $this->get_inline_css_glider_slideset( $settings, $id );

	    $style_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $settings['slideset_style'], '' ), 'mdp_glider_slideset', $atts );

        ob_start(); ?>
        <?php printf( "<style>%s</style>", $css . self::$css ); ?>
        <div class="mdp-glider-slideset mdp-slidenav-position-<?php esc_attr_e( $settings['nav_position'] ); ?>" id="<?php esc_attr_e( $id ); ?>">
            <div class="mdp-glider-slideset-container <?php esc_attr_e( $style_class ); ?>" data-mdp-slideset="{<?php echo implode(", ", $config); ?>}">
                <div class="mdp-slidenav-position">
                    <ul class="mdp-grid mdp-slideset mdp-flex-center <?php esc_attr_e( $settings['gutter'] ); ?>">
	                    <?php
	                        $content = do_shortcode( $content );
	                        $content = GliderWPBakery\Helper::get_instance()->remove_prefix( $content, '<p>' );
	                        $content = GliderWPBakery\Helper::get_instance()->remove_suffix( $content, '</p>' );
	                        echo do_shortcode( $content );
                        ?>
                    </ul>

                    <?php if ( $settings['show_next_prev'] ) : ?>
	                    <?php vc_icon_element_fonts_enqueue( 'fontawesome' ); // Enqueue needed icon font. ?>
                        <a href="#" class="mdp-slidenav mdp-slidenav-previous" data-mdp-slideset-item="previous"><span class="vc_icon_element-icon <?php esc_attr_e( $settings['prev_icon'] ); ?>"></span></a>
                        <a href="#" class="mdp-slidenav mdp-slidenav-next" data-mdp-slideset-item="next"><span class="vc_icon_element-icon <?php esc_attr_e( $settings['next_icon'] ); ?>"></span></a>
                    <?php endif; ?>
                </div>

                <?php if ( $settings['show_navigation'] ) : ?>
                    <ul class="mdp-slideset-nav mdp-dotnav mdp-flex-center">
                        <?php for( $i = 0; $i < $slides_count; $i++ ) : ?>
                            <li data-mdp-slideset-item="<?php esc_attr_e( $i ); ?>"><a></a></li>
                        <?php endfor; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>

        <?php

        return ob_get_clean();

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
	private function get_inline_css_glider_slideset_item( $settings, $id ) {

		$css = '';

		if ( ! empty( trim( $settings['s_item_height'] ) ) ) {
			$css .= ".{$id} > div { height: {$settings['s_item_height']}; overflow: hidden; }";
		}

		if ( ! empty( $settings['s_item_font_container'] ) ) {
			$settings['s_item_font_container'] = urldecode( $settings['s_item_font_container'] );
			$settings['s_item_font_container'] = str_replace( '|', ';', $settings['s_item_font_container'] );
			$settings['s_item_font_container'] = str_replace( '_', '-', $settings['s_item_font_container'] );
			$css .= ".{$id} * { {$settings['s_item_font_container']}; }";
		}

		if ( 'yes' !== $settings['s_item_use_theme_fonts'] ) {
			$google_font_css = $this->get_google_font_inline_css( $settings['s_item_google_font'] );
			$css .= ".{$id} * { {$google_font_css} }";
		}

		/** Content Vertical Align. */
		$css .= ".{$id} > div { display: flex; align-items: {$settings['content_vertical_align']}; }";

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
	 * Shortcodes for Glider slideset item.
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
	    	'content_vertical_align'      => '',
		    's_item_height'               => 'auto',
		    's_item_style'                => '',
		    's_item_font_container'       => '',
		    's_item_use_theme_fonts'      => 'yes',
		    's_item_google_font'          => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
	    ], $atts );

    	/** Fix unclosed/unwanted paragraph tags in $content. */
        $content = wpb_js_remove_wpautop( $content, true );

	    /** Unique id for current block. */
	    $class_id = 'mdp-glider-slideset-item-' . md5( json_encode( $atts ) );

	    /** Prepare inline CSS for this instance of addon. */
	    $css = $this->get_inline_css_glider_slideset_item( $settings, $class_id );

	    /** Get margins from style. We will use it separately. */
	    $matches = [];
	    $margins = [];
	    $margins_css = '';
	    $regex = '/(margin|margin-top|margin-bottom|margin-left|margin-right)[ ]*:([ ]*((-*\d+(px|em|%|cm|in|pc|pt|mm|ex)|auto|inherit)[ ]*)(!important)*){1,4};/';

	    if ( preg_match_all( $regex, $settings['s_item_style'], $matches, PREG_OFFSET_CAPTURE ) ) {

	        $tmp_arr = $matches[0];
	        if ( ! $this->array_empty( $tmp_arr ) ) {
		        $margins = $matches[0];
            }

	        foreach ( $margins as $margin ) {
		        $settings['s_item_style'] = str_replace( $margin[0], '', $settings['s_item_style'] );
		        $margins_css .= $margin[0];
            }

        }

	    /** Apply margins. */
        if ( ! empty( $margins_css ) ) {
	        $css .= ".{$class_id} > div { {$margins_css} }";
        }

	    $chunks = preg_split( '/([{}])/', $settings['s_item_style'], -1, PREG_SPLIT_NO_EMPTY );
		if ( ! empty( $chunks[1] ) ) {
			$css .= ".{$class_id} > div { {$chunks[1]} }";
		}

	    /** Add inline styles. */
	    self::$css .= $css;

	    ob_start();
	    ?><li class="mdp-glider-slidesetslide <?php esc_attr_e( $class_id ); ?>"><div class="mdp-flex mdp-flex-center mdp-flex-middle"><div class="mdp-glider-content"><?php echo do_shortcode( $content ); ?></div></div></li><?php

        return ob_get_clean();

    }

	public function array_empty( $mixed ) {

        if ( is_array( $mixed ) ) {

			foreach ( $mixed as $value ) {

				if ( ! $this->array_empty( $value ) ) {

					return false;

				}

			}

		} elseif ( ! empty( $mixed ) ) {

			return false;

		}

		return true;
	}

	/**
	 * Glider Slideset container map
	 *
	 * @since  1.0.0
	 * @access public
	 * @throws Exception
	 **/
    public function map_vc_element() {

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
			    'heading'       => esc_html__( 'Small', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Number of items you want to display on small breakpoint.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( '1', 'glider-wpbakery' ) => '1',
				    esc_html__( '2', 'glider-wpbakery' ) => '2',
				    esc_html__( '3', 'glider-wpbakery' ) => '3',
				    esc_html__( '4', 'glider-wpbakery' ) => '4',
				    esc_html__( '5', 'glider-wpbakery' ) => '5',
				    esc_html__( '6', 'glider-wpbakery' ) => '6',
				    esc_html__( '10', 'glider-wpbakery' ) => '10'
			    ],
			    'std'           => '1',
		    ];

		    # Medium.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'medium',
			    'heading'       => esc_html__( 'Medium', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Number of items you want to display on medium breakpoint.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( '1', 'glider-wpbakery' ) => '1',
				    esc_html__( '2', 'glider-wpbakery' ) => '2',
				    esc_html__( '3', 'glider-wpbakery' ) => '3',
				    esc_html__( '4', 'glider-wpbakery' ) => '4',
				    esc_html__( '5', 'glider-wpbakery' ) => '5',
				    esc_html__( '6', 'glider-wpbakery' ) => '6',
				    esc_html__( '10', 'glider-wpbakery' ) => '10'
			    ],
			    'std'           => '2',
		    ];

		    # Large.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'large',
			    'heading'       => esc_html__( 'Large', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Number of items you want to display on large breakpoint.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( '1', 'glider-wpbakery' ) => '1',
				    esc_html__( '2', 'glider-wpbakery' ) => '2',
				    esc_html__( '3', 'glider-wpbakery' ) => '3',
				    esc_html__( '4', 'glider-wpbakery' ) => '4',
				    esc_html__( '5', 'glider-wpbakery' ) => '5',
				    esc_html__( '6', 'glider-wpbakery' ) => '6',
				    esc_html__( '10', 'glider-wpbakery' ) => '10'
			    ],
			    'std'           => '3',
		    ];

		    # Gutter.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'gutter',
			    'heading'       => esc_html__( 'Gutter', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Create a horizontal gutter between columns.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( 'Default', 'glider-wpbakery' )  => 'mdp-grid-default',
				    esc_html__( 'Large', 'glider-wpbakery' )    => 'mdp-grid-large',
				    esc_html__( 'Medium', 'glider-wpbakery' )   => 'mdp-grid-medium',
				    esc_html__( 'Small', 'glider-wpbakery' )    => 'mdp-grid-small',
				    esc_html__( 'Collapse', 'glider-wpbakery' ) => 'mdp-grid-collapse',
			    ],
			    'std'           => 'mdp-grid-default',
		    ];

		    # Vertical Align.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'vertical_align',
			    'heading'       => esc_html__( 'Vertical Align', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( 'Default', 'glider-wpbakery' )  => '',
				    esc_html__( 'Top', 'glider-wpbakery' )      => 'flex-start',
				    esc_html__( 'Middle', 'glider-wpbakery' )   => 'center',
				    esc_html__( 'Bottom', 'glider-wpbakery' )   => 'flex-end',
			    ]
		    ];

		    # Animation.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'animation',
			    'heading'       => esc_html__( 'Animation', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Allows you to add different animations to items when switching between them.', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( 'Fade',             'glider-wpbakery' ) => 'fade',
				    esc_html__( 'Scale',            'glider-wpbakery' ) => 'scale',
				    esc_html__( 'Slide Horizontal', 'glider-wpbakery' ) => 'slide-horizontal',
				    esc_html__( 'Slide Vertical',   'glider-wpbakery' ) => 'slide-vertical',
				    esc_html__( 'Slide Top',        'glider-wpbakery' ) => 'slide-top',
				    esc_html__( 'Slide Bottom',     'glider-wpbakery' ) => 'slide-bottom'
			    ]
		    ];

		    # Duration of animation.
		    $params[] = [
			    'type'          => 'textfield',
			    'param_name'    => 'duration',
			    'heading'       => esc_html__( 'Duration of animation', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines the transition duration in milliseconds.', 'glider-wpbakery' ),
			    'value'         => '500'
		    ];

		    # Autoplay.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'autoplay',
			    'heading'       => esc_html__( 'Autoplay', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines whether or not the slideset items should switch automatically.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true']
		    ];

		    # Autoplay Interval.
		    $params[] = [
			    'type'          => 'textfield',
			    'param_name'    => 'autoplay_interval',
			    'heading'       => esc_html__( 'Autoplay Interval', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines the timespan between switching slideset items, in milliseconds.', 'glider-wpbakery' ),
			    'value'         => '7000',
			    'dependency'    => [
				    'element'   => 'autoplay',
				    'not_empty' => true,
			    ]
		    ];

		    # Pause on hover.
		    $params[] = [
			    'type' => 'checkbox',
			    'param_name' => 'pause_on_hover',
			    'heading' => esc_html__('Pause on hover', 'glider-wpbakery'),
			    'group'         => esc_html__( 'General', 'glider-wpbakery' ),
			    'description' => esc_html__('Pause autoplay when hovering a slideset.', 'glider-wpbakery'),
			    'value' => [ esc_html__('Yes', 'glider-wpbakery') => 'true' ],
			    'dependency' => [
				    'element' => 'autoplay',
				    'not_empty' => true
			    ]
		    ];

        } // END General Tab

	    /** Navigation Tab. */
	    if ( true ) {

		    # Show next and previous.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'show_next_prev',
			    'heading'       => esc_html__( 'Show next and previous', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Defines a navigation with previous and next buttons to browse through slideset.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true']
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

		    # Show navigation.
		    $params[] = [
			    'type'          => 'checkbox',
			    'param_name'    => 'show_navigation',
			    'heading'       => esc_html__( 'Show Dotnav', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Create a dot navigation with a horizontal layout to navigate through slideset.', 'glider-wpbakery' ),
			    'value'         => [esc_html__( 'Yes', 'glider-wpbakery' ) => 'true']
		    ];

		    /** Icon Size. */
		    $params[] = [
			    'param_name'    => 'dotnav_size',
			    'type'          => 'textfield',
			    'heading'       => esc_html__( 'Dotnav Size ', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'description'   => esc_html__( 'Enter size in px for previous and next buttons.', 'glider-wpbakery' ),
			    'value'         => '30px',
			    'dependency'    => [
				    'element'   => 'show_navigation',
				    'value'     => 'true'
			    ]
		    ];

		    /** Icon Color. */
		    $params[] = [
			    'param_name'    => 'dotnav_color',
			    'type'          => 'colorpicker',
			    'heading'       => esc_html__( 'Dotnav color ', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Navigation', 'glider-wpbakery' ),
			    'value'         => 'rgba(183,183,183,0.7)',
			    'dependency'    => [
				    'element'   => 'show_navigation',
				    'value'     => 'true'
			    ]
		    ];

        } // END Navigation Tab

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
		    'name'                      => esc_html__( 'Glider SlideSet', 'glider-wpbakery' ),
		    'base'                      => 'mdp_glider_slideset',
		    'as_parent'                 => [ 'only' => 'mdp_glider_slidesetslide' ], // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		    'content_element'           => true,
		    'show_settings_on_create'   => true,
		    'category'                  => esc_html__( 'Content', 'glider-wpbakery' ),
		    'is_container'              => true,
		    'description'               => esc_html__( 'Create sets and groups of items, allowing to loop through the sets.', 'glider-wpbakery' ),
		    'js_view'                   => 'VcColumnView',
		    'icon'                      => 'icon-mdp-glider-slideset',
		    'params'                    => $params,
	    ] );

    }

	/**
	 * Glider Slideset item map
	 *
	 * @since  1.0.0
	 * @access public
	 * @throws Exception
	 **/
    public function map_child_vc_element() {

	    /** Check, just in case. */
	    if ( ! function_exists( 'vc_map' ) ) { return; }

	    /** Control params. */
	    $params = [];

	    /*********************/
	    /*   Content Tab.    */
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
			    'description'   => esc_html__( 'Content of slide in the slideset.', 'glider-wpbakery' ),
		    ];

		    # Content Vertical Align.
		    $params[] = [
			    'type'          => 'dropdown',
			    'param_name'    => 'content_vertical_align',
			    'heading'       => esc_html__( 'Content Vertical Align', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Content', 'glider-wpbakery' ),
			    'value'         => [
				    esc_html__( 'Default', 'glider-wpbakery' )  => '',
				    esc_html__( 'Top', 'glider-wpbakery' )      => 'flex-start',
				    esc_html__( 'Middle', 'glider-wpbakery' )   => 'center',
				    esc_html__( 'Bottom', 'glider-wpbakery' )   => 'flex-end',
			    ]
		    ];


        } // END Content Tab

	    /*********************/
	    /*    Style Tab.     */
	    /*********************/
	    if ( true ) {

		    /** Item Height. */
		    $params[] = [
			    'param_name'    => 's_item_height',
			    'type'          => 'textfield',
			    'heading'       => esc_html__( 'Height', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
			    'value'         => 'auto',
		    ];

		    /** Item Style. */
		    $params[] = [
			    'param_name'    => 's_item_style',
			    'type'          => 'css_editor',
			    'heading'       => esc_html__( 'Style', 'glider-wpbakery' ),
			    'group'         => esc_html__( 'Style', 'glider-wpbakery' ),
		    ];

		    /** Item Font. */
		    $params[] = [
			    'param_name' => 's_item_font_container',
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
			    'param_name'    => 's_item_use_theme_fonts',
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
			    'param_name'    => 's_item_google_font',
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
				    'element' => 's_item_use_theme_fonts',
				    'value_not_equal_to' => 'yes'
			    ]
		    ];

	    } // END Style Tab.

	    /** Register 'child' Glider element. */
	    vc_map( [
		    'name'              => esc_html__( 'Glider SlideSet Slide', 'glider-wpbakery' ),
		    'base'              => 'mdp_glider_slidesetslide',
		    'content_element'   => true,
		    'description'       => esc_html__('Single element of slideset, You can place your images, HTML content or Video.', 'glider-wpbakery'),
		    'as_child'          => ['only' => 'mdp_glider_slideset'],
		    'icon'              => 'icon-mdp-glider-slidesetslide',
		    'params'            => $params,
	    ] );

    }

} // END Class wpbGliderSlideSet

/**
 * "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality.
 **/
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_mdp_glider_slideset extends WPBakeryShortCodesContainer { }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_mdp_glider_slidesetslide extends WPBakeryShortCode { }
}

/** Run. */
new wpbGliderSlideSet();
