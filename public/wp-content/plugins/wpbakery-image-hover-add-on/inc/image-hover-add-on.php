<?php
if ( ! class_exists( 'WPB_Image_Hover_Add_On' ) ) {
	/**
	 * Element class.
	 *
	 * @package image-hover
	 * @since 1.0
	 */
	class WPB_Image_Hover_Add_On {

		/**
		 * An array of the shortcode arguments.
		 *
		 * @access protected
		 * @since 1.0
		 * @var array
		 */
		protected $args;

		/**
		 * Constructor.
		 *
		 * @since 1.0
		 * @access public
		 */
		public function __construct() {

			add_filter( 'wpb_attr_image-hover-add-on', array( $this, 'attr' ) );
			add_filter( 'wpb_attr_image-hover-image', array( $this, 'attr_image' ) );
			add_filter( 'wpb_attr_image-hover-figcaption', array( $this, 'attr_image_caption' ) );
			add_filter( 'wpb_attr_image-hover-figtitle', array( $this, 'attr_image_title' ) );
			add_filter( 'wpb_attr_image-hover-figdescription', array( $this, 'attr_image_description' ) );

			add_shortcode( 'wpb_image_hover_add_on', array( $this, 'render' ) );
		}

		/**
		 * Render the shortcode.
		 *
		 * @access public
		 * @since 1.0
		 * @param  array  $args    Shortcode paramters.
		 * @param  string $content Content between shortcode.
		 * @return string          HTML output.
		 */
		public function render( $args, $content = '' ) {
			global $wpb_library, $wpb_settings;

			$defaults = shortcode_atts(
				array(
					'image'                 => '',
					'image_retina'          => '',
					'hover_style'           => 'fade',
					'background_color'      => '#135796',
					'width'                 => '320px',
					'title'                 => esc_attr__( 'Your title goes here', 'image-hover' ),
					'title_tag'             => 'h3',
					'title_color'           => '',
					'title_font_size'       => '28px',
					'description'           => esc_attr__( 'Your description text goes here. You can edit the text from the element settings.', 'image-hover' ),
					'description_color'     => '',
					'description_font_size' => '16px',
					'link_url'              => '',
					'hide_on_mobile'        => '',
					'class'                 => '',
					'id'                    => '',
				),
				$args
			);

			$defaults = apply_filters( 'wpb_image_hover_default_args', $defaults, $args );

			$this->args = $defaults;

			$html = '';

			if ( '' !== locate_template( 'templates/image-hover-add-on.php' ) ) {
				include locate_template( 'templates/image-hover-add-on.php', false );
			} else {
				include WPB_IMAGE_HOVER_PLUGIN_DIR . 'templates/image-hover-add-on.php';
			}

			return $html;
		}

		/**
		 * Builds the attributes array.
		 *
		 * @access public
		 * @since 1.0
		 * @return array
		 */
		public function attr() {
			$attr = array(
				'class' => 'fb-image-hover',
				'style' => '',
			);

			$attr['class'] .= ' image-hover-' . $this->args['hover_style'];
			$attr['class'] .= ' imagehover-' . $this->args['hover_style'];
			$attr['style'] .= 'background-color:' . $this->args['background_color'] . ';';
			$attr['style'] .= '--background-color:' . $this->args['background_color'] . ';';

			if ( $this->args['class'] ) {
				$attr['class'] .= ' ' . $this->args['class'];
			}

			if ( $this->args['id'] ) {
				$attr['id'] = $this->args['id'];
			}

			return $attr;
		}

		/**
		 * Builds the attributes array.
		 *
		 * @access public
		 * @since 1.0
		 * @return array
		 */
		public function attr_image_caption() {
			$attr = array(
				'class' => 'image-hover-img-caption',
				'style' => '',
			);

			$attr['style'] .= 'background-color: ' . $this->args['background_color'] . ';';

			if ( false !== strpos( $this->args['description'], '<img' ) ) {
				$attr['style'] .= 'padding: 0px;';
			}

			return $attr;
		}

		/**
		 * Builds the attributes array.
		 *
		 * @access public
		 * @since 1.0
		 * @return array
		 */
		public function attr_image() {
			$attr = array(
				'class' => 'image-hover-img',
			);

			$image = wp_get_attachment_image_src( $this->args['image'], 'full' );
			$image = $image[0];

			$image_retina = wp_get_attachment_image_src( $this->args['image_retina'], 'full' );
			$image_retina = $image_retina[0];

			$attr['src'] = $image;

			if ( isset( $this->args['image_retina'] ) && '' !== $this->args['image_retina'] ) {
				$attr['srcset']  = $image . ' 1x, ';
				$attr['srcset'] .= $image_retina . ' 2x ';
			}

			$attr['style'] = 'width:' . WPBakery_Image_Hover_Addon::validate_shortcode_attr_value( $this->args['width'], 'px' ) . ';';

			return $attr;
		}

		/**
		 * Builds the attributes array.
		 *
		 * @access public
		 * @since 1.0
		 * @return array
		 */
		public function attr_image_title() {
			$attr = array(
				'class' => 'image-hover-figtitle',
				'style' => '',
			);

			$attr['style'] .= 'font-size:' . WPBakery_Image_Hover_Addon::validate_shortcode_attr_value( $this->args['title_font_size'], 'px' ) . ';';
			$attr['style'] .= 'color:' . $this->args['title_color'] . ' !important;';

			return $attr;
		}

		/**
		 * Builds the attributes array.
		 *
		 * @access public
		 * @since 1.0
		 * @return array
		 */
		public function attr_image_description() {
			$attr = array(
				'class' => 'image-hover-figdescription',
				'style' => '',
			);

			$attr['style'] .= 'font-size:' . WPBakery_Image_Hover_Addon::validate_shortcode_attr_value( $this->args['description_font_size'], 'px' ) . ';';
			$attr['style'] .= 'color:' . $this->args['description_color'] . ' !important;';

			return $attr;
		}
	}

	new WPB_Image_Hover_Add_On();
} // End if().

$all_styles = array(
	'Fade'             => array(
		'fade'          => __( 'Fade', 'image-hover' ),
		'fade-in-up'    => __( 'Fade in up', 'image-hover' ),
		'fade-in-down'  => __( 'Fade in down', 'image-hover' ),
		'fade-in-left'  => __( 'Fade in left', 'image-hover' ),
		'fade-in-right' => __( 'Fade in right', 'image-hover' ),
	),
	'Push'             => array(
		'push-up'    => __( 'Push up', 'image-hover' ),
		'push-down'  => __( 'Push down', 'image-hover' ),
		'push-left'  => __( 'Push left', 'image-hover' ),
		'push-right' => __( 'Push right', 'image-hover' ),
	),
	'Slide'            => array(
		'slide-up'           => __( 'Slide up', 'image-hover' ),
		'slide-down'         => __( 'Slide down', 'image-hover' ),
		'slide-left'         => __( 'Slide left', 'image-hover' ),
		'slide-right'        => __( 'Slide right', 'image-hover' ),
		'slide-top-left'     => __( 'Slide top left', 'image-hover' ),
		'slide-top-right'    => __( 'Slide top right', 'image-hover' ),
		'slide-bottom-left'  => __( 'Slide bottom left', 'image-hover' ),
		'slide-bottom-right' => __( 'Slide bottom right', 'image-hover' ),
	),
	'Reveal'           => array(
		'reveal-up'           => __( 'Reveal up', 'image-hover' ),
		'reveal-down'         => __( 'Reveal down', 'image-hover' ),
		'reveal-left'         => __( 'Reveal left', 'image-hover' ),
		'reveal-right'        => __( 'Reveal right', 'image-hover' ),
		'reveal-top-left'     => __( 'Reveal top left', 'image-hover' ),
		'reveal-top-right'    => __( 'Reveal top right', 'image-hover' ),
		'reveal-bottom-left'  => __( 'Reveal bottom left', 'image-hover' ),
		'reveal-bottom-right' => __( 'Reveal bottom right', 'image-hover' ),
	),
	'Hinge'            => array(
		'hinge-up'    => __( 'Hinge up', 'image-hover' ),
		'hinge-down'  => __( 'Hinge down', 'image-hover' ),
		'hinge-left'  => __( 'Hinge left', 'image-hover' ),
		'hinge-right' => __( 'Hinge right', 'image-hover' ),
	),
	'Flip'             => array(
		'flip-horiz'  => __( 'Flip horizontal', 'image-hover' ),
		'flip-vert'   => __( 'Flip vertical', 'image-hover' ),
		'flip-diag-1' => __( 'Flip diagonal 1', 'image-hover' ),
		'flip-diag-2' => __( 'Flip diagonal 2', 'image-hover' ),
	),
	'Shutter out'      => array(
		'shutter-out-horiz'  => __( 'Shutter out horizontal', 'image-hover' ),
		'shutter-out-vert'   => __( 'Shutter out vertical', 'image-hover' ),
		'shutter-out-diag-1' => __( 'Shutter out diagonal 1', 'image-hover' ),
		'shutter-out-diag-2' => __( 'Shutter out diagonal 2', 'image-hover' ),
	),
	'Shutter in'       => array(
		'shutter-in-horiz'      => __( 'Shutter in horizontal', 'image-hover' ),
		'shutter-in-vert'       => __( 'Shutter in vertical', 'image-hover' ),
		'shutter-in-out-horiz'  => __( 'Shutter in out horizontal', 'image-hover' ),
		'shutter-in-out-vert'   => __( 'Shutter in out vertical', 'image-hover' ),
		'shutter-in-out-diag-1' => __( 'Shutter in out diagonal 1', 'image-hover' ),
		'shutter-in-out-diag-2' => __( 'Shutter in out diagonal 2', 'image-hover' ),
	),
	'Fold'             => array(
		'fold-up'    => __( 'Fold up', 'image-hover' ),
		'fold-down'  => __( 'Fold down', 'image-hover' ),
		'fold-left'  => __( 'Fold left', 'image-hover' ),
		'fold-right' => __( 'Fold right', 'image-hover' ),
	),
	'Zoom'             => array(
		'zoom-in'             => __( 'Zoom in', 'image-hover' ),
		'zoom-out'            => __( 'Zoom out', 'image-hover' ),
		'zoom-out-up'         => __( 'Zoom out up', 'image-hover' ),
		'zoom-out-down'       => __( 'Zoom out down', 'image-hover' ),
		'zoom-out-left'       => __( 'Zoom out left', 'image-hover' ),
		'zoom-out-right'      => __( 'Zoom out right', 'image-hover' ),
		'zoom-out-flip-horiz' => __( 'Zoom out flip horizontal', 'image-hover' ),
		'zoom-out-flip-vert'  => __( 'Zoom out flip vertical', 'image-hover' ),
	),
	'Blur'             => array(
		'blur' => __( 'Blur', 'image-hover' ),
	),
	'Blocks'           => array(
		'blocks-rotate-left'       => __( 'Blocks rotate left', 'image-hover' ),
		'blocks-rotate-right'      => __( 'Blocks rotate right', 'image-hover' ),
		'blocks-rotate-in-left'    => __( 'Blocks rotate in left', 'image-hover' ),
		'blocks-rotate-in-right'   => __( 'Blocks rotate in right', 'image-hover' ),
		'blocks-in'                => __( 'Blocks in', 'image-hover' ),
		'blocks-out'               => __( 'Blocks out', 'image-hover' ),
		'blocks-float-up'          => __( 'Blocks float up', 'image-hover' ),
		'blocks-float-down'        => __( 'Blocks float down', 'image-hover' ),
		'blocks-float-left'        => __( 'Blocks float left', 'image-hover' ),
		'blocks-float-right'       => __( 'Blocks float right', 'image-hover' ),
		'blocks-zoom-top-left'     => __( 'Blocks zoom top left', 'image-hover' ),
		'blocks-zoom-top-right'    => __( 'Blocks zoom top right', 'image-hover' ),
		'blocks-zoom-bottom-left'  => __( 'Blocks zoom bottom left', 'image-hover' ),
		'blocks-zoom-bottom-right' => __( 'Blocks zoom bottom right', 'image-hover' ),
	),
	'Strip Shutter'    => array(
		'strip-shutter-up'    => __( 'Strip shutter up', 'image-hover' ),
		'strip-shutter-down'  => __( 'Strip shutter down', 'image-hover' ),
		'strip-shutter-left'  => __( 'Strip shutter left', 'image-hover' ),
		'strip-shutter-right' => __( 'Strip shutter right', 'image-hover' ),
	),
	'Strip Horizontal' => array(
		'strip-horiz-up'           => __( 'Strip horizontal up', 'image-hover' ),
		'strip-horiz-down'         => __( 'Strip horizontal down', 'image-hover' ),
		'strip-horiz-top-left'     => __( 'Strip horizontal top left', 'image-hover' ),
		'strip-horiz-top-right'    => __( 'Strip horizontal top right', 'image-hover' ),
		'strip-horiz-bottom-left'  => __( 'Strip horizontal bottom left', 'image-hover' ),
		'strip-horiz-bottom-right' => __( 'Strip horizontal bottom right', 'image-hover' ),
	),
	'Strip Vertical'   => array(
		'strip-vert-left'         => __( 'Strip vertical left', 'image-hover' ),
		'strip-vert-right'        => __( 'Strip vertical right', 'image-hover' ),
		'strip-vert-top-left'     => __( 'Strip vertical top left', 'image-hover' ),
		'strip-vert-top-right'    => __( 'Strip vertical top right', 'image-hover' ),
		'strip-vert-bottom-left'  => __( 'Strip vertical bottom left', 'image-hover' ),
		'strip-vert-bottom-right' => __( 'Strip vertical bottom right', 'image-hover' ),
	),
	'Pixel'            => array(
		'pixel-up'           => __( 'Pixel up', 'image-hover' ),
		'pixel-down'         => __( 'Pixel down', 'image-hover' ),
		'pixel-left'         => __( 'Pixel left', 'image-hover' ),
		'pixel-right'        => __( 'Pixel right', 'image-hover' ),
		'pixel-top-left'     => __( 'Pixel top left', 'image-hover' ),
		'pixel-top-right'    => __( 'Pixel top right', 'image-hover' ),
		'pixel-bottom-left'  => __( 'Pixel bottom left', 'image-hover' ),
		'pixel-bottom-right' => __( 'Pixel bottom right', 'image-hover' ),
	),
	'Pivot in'         => array(
		'pivot-in-top-left'     => __( 'Pivot in top left', 'image-hover' ),
		'pivot-in-top-right'    => __( 'Pivot in top right', 'image-hover' ),
		'pivot-in-bottom-left'  => __( 'Pivot in bottom left', 'image-hover' ),
		'pivot-in-bottom-right' => __( 'Pivot in bottom right', 'image-hover' ),
	),
	'Pivot out'        => array(
		'pivot-out-top-left'     => __( 'Pivot out top left', 'image-hover' ),
		'pivot-out-top-right'    => __( 'Pivot out top right', 'image-hover' ),
		'pivot-out-bottom-left'  => __( 'Pivot out bottom left', 'image-hover' ),
		'pivot-out-bottom-right' => __( 'Pivot out bottom right', 'image-hover' ),
	),
	'Throw in'         => array(
		'throw-in-up'    => __( 'Throw in up', 'image-hover' ),
		'throw-in-down'  => __( 'Throw in down', 'image-hover' ),
		'throw-in-left'  => __( 'Throw in left', 'image-hover' ),
		'throw-in-right' => __( 'Throw in right', 'image-hover' ),
	),
	'Throw out'        => array(
		'throw-out-up'    => __( 'Throw out up', 'image-hover' ),
		'throw-out-down'  => __( 'Throw out down', 'image-hover' ),
		'throw-out-left'  => __( 'Throw out left', 'image-hover' ),
		'throw-out-right' => __( 'Throw out right', 'image-hover' ),
	),
	'Blinds'           => array(
		'blinds-horiz' => __( 'Blinds horizontal', 'image-hover' ),
		'blinds-vert'  => __( 'Blinds vertical', 'image-hover' ),
		'blinds-up'    => __( 'Blinds up', 'image-hover' ),
		'blinds-down'  => __( 'Blinds down', 'image-hover' ),
		'blinds-left'  => __( 'Blinds left', 'image-hover' ),
		'blinds-right' => __( 'Blinds right', 'image-hover' ),
	),
	'Border reveal'    => array(
		'border-reveal-vert'         => __( 'Border reveal vertical', 'image-hover' ),
		'border-reveal-horiz'        => __( 'Border reveal horizontal', 'image-hover' ),
		'border-reveal-corners-1'    => __( 'Border reveal corners 1', 'image-hover' ),
		'border-reveal-corners-2'    => __( 'Border reveal corners 2', 'image-hover' ),
		'border-reveal-top-left'     => __( 'Border reveal top left', 'image-hover' ),
		'border-reveal-top-right'    => __( 'Border reveal top right', 'image-hover' ),
		'border-reveal-bottom-left'  => __( 'Border reveal bottom left', 'image-hover' ),
		'border-reveal-bottom-right' => __( 'Border reveal bottom right', 'image-hover' ),
		'border-reveal-cc-1'         => __( 'Border reveal draw 1', 'image-hover' ),
		'border-reveal-ccc-1'        => __( 'Border reveal draw 2', 'image-hover' ),
		'border-reveal-cc-2'         => __( 'Border reveal all style-1', 'image-hover' ),
		'border-reveal-ccc-2'        => __( 'Border reveal all style-2', 'image-hover' ),
		'border-reveal-cc-3'         => __( 'Border reveal all style-3', 'image-hover' ),
		'border-reveal-ccc-3'        => __( 'Border reveal all style-4', 'image-hover' ),
	),
	'Zoom and rotate'  => array(
		'image-zoom-center'  => __( 'Image zoom center', 'image-hover' ),
		'image-zoom-out'     => __( 'Image zoom out', 'image-hover' ),
		'image-rotate-left'  => __( 'Image rotate left', 'image-hover' ),
		'image-rotate-right' => __( 'Image rotate right', 'image-hover' ),
	),
	'Book open'        => array(
		'book-open-horiz' => __( 'Book open horizontal', 'image-hover' ),
		'book-open-vert'  => __( 'Book open vertical', 'image-hover' ),
		'book-open-up'    => __( 'Book open up', 'image-hover' ),
		'book-open-down'  => __( 'Book open down', 'image-hover' ),
		'book-open-left'  => __( 'Book open left', 'image-hover' ),
		'book-open-right' => __( 'Book open right', 'image-hover' ),
	),
	'Circle'           => array(
		'circle-up'           => __( 'Circle up', 'image-hover' ),
		'circle-down'         => __( 'Circle down', 'image-hover' ),
		'circle-left'         => __( 'Circle left', 'image-hover' ),
		'circle-right'        => __( 'Circle right', 'image-hover' ),
		'circle-top-left'     => __( 'Circle top left', 'image-hover' ),
		'circle-top-right'    => __( 'Circle top right', 'image-hover' ),
		'circle-bottom-left'  => __( 'Circle bottom left', 'image-hover' ),
		'circle-bottom-right' => __( 'Circle bottom right', 'image-hover' ),
	),
	'Shift'            => array(
		'shift-top-left'     => __( 'Shift top left', 'image-hover' ),
		'shift-top-right'    => __( 'Shift top right', 'image-hover' ),
		'shift-bottom-left'  => __( 'Shift bottom left', 'image-hover' ),
		'shift-bottom-right' => __( 'Shift bottom right', 'image-hover' ),
	),
	'Bounce'           => array(
		'bounce-in'        => __( 'Bounce in', 'image-hover' ),
		'bounce-in-up'     => __( 'Bounce in up', 'image-hover' ),
		'bounce-in-down'   => __( 'Bounce in down', 'image-hover' ),
		'bounce-in-left'   => __( 'Bounce in left', 'image-hover' ),
		'bounce-in-right'  => __( 'Bounce in right', 'image-hover' ),
		'bounce-out'       => __( 'Bounce out', 'image-hover' ),
		'bounce-out-up'    => __( 'Bounce out up', 'image-hover' ),
		'bounce-out-down'  => __( 'Bounce out down', 'image-hover' ),
		'bounce-out-left'  => __( 'Bounce out left', 'image-hover' ),
		'bounce-out-right' => __( 'Bounce out right', 'image-hover' ),
	),
	'Fall away'        => array(
		'fall-away-horiz' => __( 'Fall away horizontal', 'image-hover' ),
		'fall-away-vert'  => __( 'Fall away vertical', 'image-hover' ),
		'fall-away-cc'    => __( 'Fall away 1', 'image-hover' ),
		'fall-away-ccc'   => __( 'Fall away 2', 'image-hover' ),
	),
	'Modal slide'      => array(
		'modal-slide-up'    => __( 'Modal slide up', 'image-hover' ),
		'modal-slide-down'  => __( 'Modal slide down', 'image-hover' ),
		'modal-slide-left'  => __( 'Modal slide left', 'image-hover' ),
		'modal-slide-right' => __( 'Modal slide right', 'image-hover' ),
	),
	'Modal hinge'      => array(
		'modal-hinge-up'    => __( 'Modal hinge up', 'image-hover' ),
		'modal-hinge-down'  => __( 'Modal hinge down', 'image-hover' ),
		'modal-hinge-left'  => __( 'Modal hinge left', 'image-hover' ),
		'modal-hinge-right' => __( 'Modal hinge right', 'image-hover' ),
	),
	'Lightspeed'       => array(
		'lightspeed-in-left'   => __( 'Lightspeed in left', 'image-hover' ),
		'lightspeed-in-right'  => __( 'Lightspeed in right', 'image-hover' ),
		'lightspeed-out-left'  => __( 'Lightspeed out left', 'image-hover' ),
		'lightspeed-out-right' => __( 'Lightspeed out right', 'image-hover' ),
	),
	'Gradient'         => array(
		'grad-radial-in'    => __( 'Gradient radial in', 'image-hover' ),
		'grad-radial-out'   => __( 'Gradient radial out', 'image-hover' ),
		'grad-up'           => __( 'Gradient up', 'image-hover' ),
		'grad-down'         => __( 'Gradient down', 'image-hover' ),
		'grad-left'         => __( 'Gradient left', 'image-hover' ),
		'grad-right'        => __( 'Gradient right', 'image-hover' ),
		'grad-top-left'     => __( 'Gradient top left', 'image-hover' ),
		'grad-top-right'    => __( 'Gradient top right', 'image-hover' ),
		'grad-bottom-left'  => __( 'Gradient bottom left', 'image-hover' ),
		'grad-bottom-right' => __( 'Gradient bottom right', 'image-hover' ),
	),
	'Parallax'         => array(
		'parallax-up'    => __( 'Parallax up', 'image-hover' ),
		'parallax-down'  => __( 'Parallax down', 'image-hover' ),
		'parallax-left'  => __( 'Parallax left', 'image-hover' ),
		'parallax-right' => __( 'Parallax right', 'image-hover' ),
	),
	'Stack'            => array(
		'stack-up'           => __( 'Stack up', 'image-hover' ),
		'stack-down'         => __( 'Stack down', 'image-hover' ),
		'stack-left'         => __( 'Stack left', 'image-hover' ),
		'stack-right'        => __( 'Stack right', 'image-hover' ),
		'stack-top-left'     => __( 'Stack top left', 'image-hover' ),
		'stack-top-right'    => __( 'Stack top right', 'image-hover' ),
		'stack-bottom-left'  => __( 'Stack bottom left', 'image-hover' ),
		'stack-bottom-right' => __( 'Stack bottom right', 'image-hover' ),
	),
	'Cube'             => array(
		'cube-up'    => __( 'Cube up', 'image-hover' ),
		'cube-down'  => __( 'Cube down', 'image-hover' ),
		'cube-left'  => __( 'Cube left', 'image-hover' ),
		'cube-right' => __( 'Cube right', 'image-hover' ),
	),
	'Dive'             => array(
		'dive'     => __( 'Dive center', 'image-hover' ),
		'dive-cc'  => __( 'Dive left', 'image-hover' ),
		'dive-ccc' => __( 'Dive right', 'image-hover' ),
	),
	'Switch'           => array(
		'switch-up'    => __( 'Switch up', 'image-hover' ),
		'switch-down'  => __( 'Switch down', 'image-hover' ),
		'switch-left'  => __( 'Switch left', 'image-hover' ),
		'switch-right' => __( 'Switch right', 'image-hover' ),
	),
	'Flash'            => array(
		'flash-top-left'     => __( 'Flash top left', 'image-hover' ),
		'flash-top-right'    => __( 'Flash top right', 'image-hover' ),
		'flash-bottom-left'  => __( 'Flash bottom left', 'image-hover' ),
		'flash-bottom-right' => __( 'Flash bottom right', 'image-hover' ),
	),
);

$settings = array(
	'name'            => 'Image Hover Add-on',
	'base'            => 'wpb_image_hover_add_on',
	'class'           => '',
	'icon'            => 'vc_wpb_image_hover_add_on dashicons dashicons-format-gallery',
	'category'        => 'InfiWebs',
	'description'     => __( 'Add 200+ different image hover styles.', 'image-hover' ),
	'content_element' => true,
	'controls'        => 'full',
	'params'          => array(
		array(
			'type'        => 'iw_select',
			'heading'     => esc_attr__( 'Hover Style', 'image-hover' ),
			'description' => __( 'Select the hover style you want to use for this image.', 'image-hover' ),
			'param_name'  => 'hover_style',
			'admin_label' => true,
			'default'     => 'fade',
			'styles'      => $all_styles,
			'value'       => '',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_attr__( 'Image', 'image-hover' ),
			'description' => esc_attr__( 'Upload or select the image.', 'image-hover' ),
			'param_name'  => 'image',
		),
		array(
			'type'        => 'attach_image',
			'heading'     => esc_attr__( 'Retina Image', 'image-hover' ),
			'description' => esc_attr__( 'Upload or select the image to be used on retina devices.', 'image-hover' ),
			'param_name'  => 'image_retina',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_attr__( 'Background Color', 'image-hover' ),
			'param_name'  => 'background_color',
			'value'       => '#135796',
			'description' => esc_attr__( 'Controls the background color on hover.', 'image-hover' ),
		),
		array(
			'type'        => 'iw_number',
			'heading'     => esc_attr__( 'Image Width', 'image-hover' ),
			'description' => esc_attr__( 'Select the css width for the image. Height will change in the proportion automatically. ( In Pixel ).', 'image-hover' ),
			'param_name'  => 'width',
			'value'       => '320',
			'min'         => '50',
			'max'         => '2000',
			'step'        => '1',
		),
		array(
			'type'        => 'vc_link',
			'heading'     => esc_attr__( 'Link URL', 'image-hover' ),
			'param_name'  => 'link_url',
			'value'       => '',
			'description' => esc_attr__( 'Enter the external url or select existing page to link to.', 'image-hover' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_attr__( 'Title Text', 'image-hover' ),
			'description' => esc_attr__( 'Title text to be displayed on hover.', 'image-hover' ),
			'value'       => esc_attr__( 'Your title goes here', 'image-hover' ),
			'placeholder' => true,
			'admin_label' => true,
			'param_name'  => 'title',
			'group'       => 'Title',
		),
		array(
			'type'        => 'dropdown',
			'heading'     => esc_attr__( 'Title Tag', 'image-hover' ),
			'description' => esc_attr__( 'Choose the HTML tag for title, H1-H6, Div or Span.', 'image-hover' ),
			'param_name'  => 'title_tag',
			'value'       => array(
				'H1'   => 'h1',
				'H2'   => 'h2',
				'H3'   => 'h3',
				'H4'   => 'h4',
				'H5'   => 'h5',
				'H6'   => 'h6',
				'Div'  => 'div',
				'Span' => 'span',
			),
			'default'     => 'h3',
			'group'       => 'Title',
		),
		array(
			'type'        => 'iw_number',
			'heading'     => esc_attr__( 'Title Font Size', 'image-hover' ),
			'description' => esc_attr__( 'Select the font size for title text. ( In Pixel. )', 'image-hover' ),
			'param_name'  => 'title_font_size',
			'value'       => '28',
			'min'         => '12',
			'max'         => '100',
			'step'        => '1',
			'group'       => 'Title',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_attr__( 'Title Color', 'image-hover' ),
			'param_name'  => 'title_color',
			'value'       => '',
			'description' => esc_attr__( 'Controls the text color for title text.', 'image-hover' ),
			'group'       => 'Title',
		),
		array(
			'type'        => 'textarea',
			'heading'     => esc_attr__( 'Description Text', 'image-hover' ),
			'description' => esc_attr__( 'Description text to be displayed on hover.', 'image-hover' ),
			'value'       => esc_attr__( 'Your description text goes here. You can edit the text from the element settings.', 'image-hover' ),
			'placeholder' => true,
			'param_name'  => 'description',
			'group'       => 'Description',
		),
		array(
			'type'        => 'iw_number',
			'heading'     => esc_attr__( 'Description Font Size', 'image-hover' ),
			'description' => esc_attr__( 'Select the font size for description text. ( In Pixel. )', 'image-hover' ),
			'param_name'  => 'description_font_size',
			'value'       => '16',
			'min'         => '10',
			'max'         => '100',
			'step'        => '1',
			'group'       => 'Description',
		),
		array(
			'type'        => 'colorpicker',
			'heading'     => esc_attr__( 'Description Color', 'image-hover' ),
			'param_name'  => 'description_color',
			'value'       => '',
			'description' => esc_attr__( 'Controls the text color for description text.', 'image-hover' ),
			'group'       => 'Description',
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_attr__( 'CSS Class', 'image-hover' ),
			'param_name'  => 'class',
			'value'       => '',
			'description' => esc_attr__( 'Add a class to the wrapping HTML element.', 'image-hover' ),
		),
		array(
			'type'        => 'textfield',
			'heading'     => esc_attr__( 'CSS ID', 'image-hover' ),
			'param_name'  => 'id',
			'value'       => '',
			'description' => esc_attr__( 'Add an ID to the wrapping HTML element.', 'image-hover' ),
		),
	),
);

if ( function_exists( 'vc_map' ) ) {
	vc_map( $settings );
}

if ( function_exists( 'add_shortcode_param' ) ) {
	if ( defined( 'WPB_VC_VERSION' ) && version_compare( '5.0', WPB_VC_VERSION, '>=' ) ) {
		add_shortcode_param( 'iw_number', 'iw_number_render_param' );
		add_shortcode_param( 'iw_select', 'iw_select_render_param' );
	}
}

if ( function_exists( 'vc_add_shortcode_param' ) ) {
	vc_add_shortcode_param( 'iw_number', 'iw_number_render_param' );
	vc_add_shortcode_param( 'iw_select', 'iw_select_render_param' );
}

// Function to generate param type "number".
if ( ! function_exists( 'iw_number_render_param' ) ) {
	/**
	 * Add custom param.
	 *
	 * @access public
	 * @since 1.0
	 * @param array  $settings Number field settings.
	 * @param string $value    Number field value.
	 * @return string Number field output.
	 */
	function iw_number_render_param( $settings, $value ) {
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$min        = isset( $settings['min'] ) ? $settings['min'] : '';
		$max        = isset( $settings['max'] ) ? $settings['max'] : '';
		$suffix     = isset( $settings['suffix'] ) ? $settings['suffix'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';
		$output     = '<input type="number" min="' . $min . '" max="' . $max . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" style="max-width:100px; margin-right: 10px;" />' . $suffix;
		return $output;
	}
}

// Function to generate param type "select".
if ( ! function_exists( 'iw_select_render_param' ) ) {
	/**
	 * Add custom param.
	 *
	 * @access public
	 * @since 1.0
	 * @param array  $settings Select field settings.
	 * @param string $value    Select field value.
	 * @return string Select field output.
	 */
	function iw_select_render_param( $settings, $value ) {
		$param_name = isset( $settings['param_name'] ) ? $settings['param_name'] : '';
		$type       = isset( $settings['type'] ) ? $settings['type'] : '';
		$styles     = isset( $settings['styles'] ) ? $settings['styles'] : '';
		$class      = isset( $settings['class'] ) ? $settings['class'] : '';

		$output = '<select class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" data-value="' . $value . '" style="margin-top: 5px;">';

		foreach ( $styles as $style_category => $style ) {
			$output .= '<optgroup label="' . $style_category . '">';

			foreach ( $style as $style_value => $style_name ) {
				$selected = ( $value === $style_value ) ? 'selected="true"' : '';
				$output  .= '<option ' . $selected . ' value="' . $style_value . '" >' . $style_name . '</option>';
			}

			$output .= '</optgroup>';
		}

		$output .= '</select>';

		return $output;
	}
}
