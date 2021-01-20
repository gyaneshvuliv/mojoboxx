<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $parallax_speed_bg
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_mp4
 * @var $video_bg_webm
 * @var $video_bg_ogv
 * @var $video_bg_parallax
 * @var $video_overlay
 * @var $video_placeholder
 * @var $parallax_speed_video
 * @var animated_bg
 * @var animated_bg_dir
 * @var animated_bg_speed
 * @var animated_bg_image
 * @var fixed_bg
 * @var fixed_bg_image
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = '';
$full_height = '';
$full_width = '';
$equal_height = '';
$flex_row = '';
$columns_placement = '';
$content_placement = '';

$css = '';
$el_id = '';
$css_animation = '';
$disable_element = '';
$output = $after_output = '';

$video_bg_mp4 = '';
$video_bg_webm = '';
$video_bg_ogv = '';
$video_bg = '';
$video_bg_parallax = '';
$fixed_bg = '';
$fixed_bg_image = '';
$parallax = '';
$parallax_image = '';
$parallax_speed_bg = '1.5';
$parallax_speed_video = '';
$animated_bg = '';
$animated_bg_dir = '';
$animated_bg_speed = '';
$animated_bg_image = '';

$before_row_content = '';
$after_row_content  = '';
$row_background       = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {

	if ('stretch_row' == $full_width) {
		$before_row_content = '<div class="vc-container et-clearfix">';
		$after_row_content  = '</div>';
	}

	if ('stretch_no' == $full_width) {
		$css_classes[] = 'vc-container';
	}

	if ('stretch_row_content' == $full_width) {
		$css_classes[] = 'vc_row-no-padding vc-container-wide';
	}
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && (!empty( $video_bg_mp4 ) || !empty( $video_bg_webm ) || !empty($video_bg_ogv)));

$parallax_speed = $parallax_speed_bg;

if ( $has_video_bg ) {

	$css_classes[] = 'vc-video-bg';

	$parallax       = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;

	$row_background = '<video class="video-container" autoplay preload="auto" loop="loop" muted="muted" poster="'.GLOBAX_ENOVATHEMES_IMAGES.'/transparent.png">';
		if ($video_bg_mp4){
	    	$row_background .= '<source type="video/mp4" src="'.esc_url($video_bg_mp4).'"/>';
		}
	    if ($video_bg_webm){
	    	$row_background .= '<source type="video/webm" src="'.esc_url($video_bg_webm).'"/>';
	    }
	    if ($video_bg_ogv){
	    	$row_background .= '<source type="video/ogg" src="'.esc_url($video_bg_ogv).'"/>';
	    }
	$row_background .= '</video>';

	if ( ! empty( $video_overlay ) ) {
		$video_overlay_id = preg_replace( '/[^\d]/', '', $video_overlay );
		$video_overlay_src = wp_get_attachment_image_src( $video_overlay_id, 'full' );
		if ( ! empty( $video_overlay_src[0] ) ) {
			$video_overlay_src = $video_overlay_src[0];
		}

		$row_background .= '<div class="video-container-overlay" style="background-image:url('.$video_overlay_src.');"></div>';
	}

	if ( ! empty( $video_placeholder ) ) {
		$video_placeholder_id = preg_replace( '/[^\d]/', '', $video_placeholder );
		$video_placeholder_src = wp_get_attachment_image_src( $video_placeholder_id, 'full' );
		if ( ! empty( $video_placeholder_src[0] ) ) {
			$video_placeholder_src = $video_placeholder_src[0];
		}

		$row_background .= '<div class="video-container-placeholder" style="background-image:url('.$video_placeholder_src.');"></div>';
	}

}

if ( $fixed_bg == "true" ) {
	$css_classes[] = 'vc-fixed-bg';

	if ( ! empty( $fixed_bg_image ) ) {
		$fixed_bg_image_id = preg_replace( '/[^\d]/', '', $fixed_bg_image );
		$fixed_bg_image_src = wp_get_attachment_image_src( $fixed_bg_image_id, 'full' );
		if ( ! empty( $fixed_bg_image_src[0] ) ) {
			$fixed_bg_image_src = $fixed_bg_image_src[0];
		}
	}

	$row_background = '<div class="fixed-container" style="background-image:url('.$fixed_bg_image_src.');"></div>';
}

if ( $animated_bg == "true" ) {

	if (empty($animated_bg_speed)) {
		$animated_bg_speed = 35000;
	}

	if (empty($animated_bg_dir)) {
		$animated_bg_dir = 'horizontal';
	}

	$css_classes[] = 'vc-animated-bg';

	$wrapper_attributes[] = 'data-animatedbg-speed="' . esc_attr( $animated_bg_speed ) . '"';
	$wrapper_attributes[] = 'data-animatedbg-dir="' . esc_attr( $animated_bg_dir ) . '"';

	if ( ! empty( $animated_bg_image ) ) {
		$animated_bg_image_id = preg_replace( '/[^\d]/', '', $animated_bg_image );
		$animated_bg_image_src = wp_get_attachment_image_src( $animated_bg_image, 'full' );
		$row_background = '<div class="animated-container" data-img-width="'.$animated_bg_image_src[1].'" data-img-height="'.$animated_bg_image_src[2].'" style="background-image:url('.$animated_bg_image_src[0].');"></div>';
	}

}

if ($parallax == "true") {

	if (empty($parallax_speed)) {
		$parallax_speed = 1.5;
	}

	$wrapper_attributes[] = 'data-parallax-speed="' . esc_attr( $parallax_speed ) . '"';

	if ( $has_video_bg ) {

		$css_classes[] = 'vc-parallax vc-video-parallax';

		$row_background = '<video class="video-container" autoplay preload="auto" loop="loop" muted="muted" poster="'.GLOBAX_ENOVATHEMES_IMAGES.'/transparent.png">';
			if ($video_bg_mp4){
		    	$row_background .= '<source type="video/mp4" src="'.esc_url($video_bg_mp4).'"/>';
			}
		    if ($video_bg_webm){
		    	$row_background .= '<source type="video/webm" src="'.esc_url($video_bg_webm).'"/>';
		    }
		    if ($video_bg_ogv){
		    	$row_background .= '<source type="video/ogg" src="'.esc_url($video_bg_ogv).'"/>';
		    }
		$row_background .= '</video>';

		if ( ! empty( $video_overlay ) ) {
			$video_overlay_id = preg_replace( '/[^\d]/', '', $video_overlay );
			$video_overlay_src = wp_get_attachment_image_src( $video_overlay_id, 'full' );
			if ( ! empty( $video_overlay_src[0] ) ) {
				$video_overlay_src = $video_overlay_src[0];
			}

			$row_background .= '<div class="video-container-overlay" style="background-image:url('.$video_overlay_src.');"></div>';
		}

		if ( ! empty( $video_placeholder ) ) {
			$video_placeholder_id = preg_replace( '/[^\d]/', '', $video_placeholder );
			$video_placeholder_src = wp_get_attachment_image_src( $video_placeholder_id, 'full' );
			if ( ! empty( $video_placeholder_src[0] ) ) {
				$video_placeholder_src = $video_placeholder_src[0];
			}

			$row_background .= '<div class="video-container-placeholder" style="background-image:url('.$video_placeholder_src.');"></div>';
		}

	}else{

		if ( ! empty( $parallax_image ) ) {
			$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
			$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
			if ( ! empty( $parallax_image_src[0] ) ) {
				$parallax_image_src = $parallax_image_src[0];
			}
		}

		$css_classes[] = 'vc-parallax';

		$row_background = '<div class="parallax-container" style="background-image:url('.$parallax_image_src.');"></div>';
	}


}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	$output .= $before_row_content;
		$output .= wpb_js_remove_wpautop( $content );
	$output .= $after_row_content;
	$output .= $row_background;
$output .= '</div>';
$output .= $after_output;
echo html_entity_decode($output);
