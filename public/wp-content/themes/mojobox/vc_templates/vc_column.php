<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
	* Shortcode attributes
	* @var $atts
	* @var $el_id
	* @var $el_class
	* @var $width
	* @var $css
	* @var $offset
	* @var $content - shortcode content
	* @var $css_animation
	* @var $parallax
	* @var $parallax_image
	* @var $parallax_speed_bg
	* @var $fixed_bg
	* @var $fixed_bg_image
	* @var $under480_padding_left
	* @var $under480_padding_right
	* @var $over480_under_768_padding_left
	* @var $over480_under_768_padding_right
	* @var $over768_under_1024_padding_left
	* @var $over768_under_1024_padding_right
	* @var $over1024_under_1280_padding_left
	* @var $over1024_under_1280_padding_right
	* @var $over1280_under_1366_padding_left
	* @var $over1280_under_1366_padding_right
	* @var $over1366_under_1600_padding_left
	* @var $over1366_under_1600_padding_right
	* @var $over1600_padding_left
	* @var $over1600_padding_right
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column
 */

$el_class = $el_id = $width = $parallax_speed_bg = $css = $offset = $css_animation = '';
$output = '';

$parallax = '';
$parallax_image = '';
$parallax_speed_bg = '1.5';
$column_background = '';

$data_responsive_padding = '';

$under480_padding_left = '';
$under480_padding_right = '';

$over480_under_768_padding_left    = '';
$over480_under_768_padding_right   = '';

$over768_under_1024_padding_left   = '';
$over768_under_1024_padding_right  = '';

$over1024_under_1280_padding_left  = '';
$over1024_under_1280_padding_right = '';

$over1280_under_1366_padding_left  = '';
$over1280_under_1366_padding_right = '';

$over1366_under_1600_padding_left  = '';
$over1366_under_1600_padding_right = '';

$over1600_padding_left             = '';
$over1600_padding_right            = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (isset($under480_padding_left) && !empty($under480_padding_left) && $under480_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-under480-padding-left="'.$under480_padding_left.'" ';
}
if (isset($under480_padding_right) && !empty($under480_padding_right) && $under480_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-under480-padding-right="'.$under480_padding_right.'" ';
}
if (isset($over480_under_768_padding_left) && !empty($over480_under_768_padding_left) && $over480_under_768_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-over480-under-768-padding-left="'.$over480_under_768_padding_left.'" ';
}
if (isset($over480_under_768_padding_right) && !empty($over480_under_768_padding_right) && $over480_under_768_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-over480-under-768-padding-right="'.$over480_under_768_padding_right.'" ';
}
if (isset($over768_under_1024_padding_left) && !empty($over768_under_1024_padding_left) && $over768_under_1024_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-over768-under-1024-padding-left="'.$over768_under_1024_padding_left.'" ';
}
if (isset($over768_under_1024_padding_right) && !empty($over768_under_1024_padding_right) && $over768_under_1024_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-over768-under-1024-padding-right="'.$over768_under_1024_padding_right.'" ';
}
if (isset($over1024_under_1280_padding_left) && !empty($over1024_under_1280_padding_left) && $over1024_under_1280_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-over1024-under-1280-padding-left="'.$over1024_under_1280_padding_left.'" ';
}
if (isset($over1024_under_1280_padding_right) && !empty($over1024_under_1280_padding_right) && $over1024_under_1280_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-over1024-under-1280-padding-right="'.$over1024_under_1280_padding_right.'" ';
}
if (isset($over1280_under_1366_padding_left) && !empty($over1280_under_1366_padding_left) && $over1280_under_1366_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-over1280-under-1366-padding-left="'.$over1280_under_1366_padding_left.'" ';
}
if (isset($over1280_under_1366_padding_right) && !empty($over1280_under_1366_padding_right) && $over1280_under_1366_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-over1280-under-1366-padding-right="'.$over1280_under_1366_padding_right.'" ';
}
if (isset($over1366_under_1600_padding_left) && !empty($over1366_under_1600_padding_left) && $over1366_under_1600_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-over1366-under-1600-padding-left="'.$over1366_under_1600_padding_left.'" ';
}
if (isset($over1366_under_1600_padding_right) && !empty($over1366_under_1600_padding_right) && $over1366_under_1600_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-over1366-under-1600-padding-right="'.$over1366_under_1600_padding_right.'" ';
}
if (isset($over1600_padding_left) && !empty($over1600_padding_left) && $over1600_padding_left != 'inherit') {
	$data_responsive_padding .= 'data-over1600-padding-left="'.$over1600_padding_left.'" ';
}
if (isset($over1600_padding_right) && !empty($over1600_padding_right) && $over1600_padding_right != 'inherit') {
	$data_responsive_padding .= 'data-over1600-padding-right="'.$over1600_padding_right.'"';
}

wp_enqueue_script( 'wpb_composer_front_js' );

$width = wpb_translateColumnWidthToSpan( $width );
$width = vc_column_offset_class_merge( $offset, $width );

$css_classes = array(
	$this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation ),
	'wpb_column',
	'vc_column_container',
	$width,
);

if ( vc_shortcode_custom_css_has_property( $css, array(
		'border',
		'background',
	) ) || $parallax
) {
	$css_classes[] = 'vc_col-has-fill';
}

if (empty($parallax_speed_bg)) {
	$parallax_speed_bg = '1.5';
}

$parallax_speed = $parallax_speed_bg;

if (!isset($parallax_speed) || empty($parallax_speed)) {
	$parallax_speed = 0;
}

$wrapper_attributes[] = 'data-parallax-speed="' . esc_attr( $parallax_speed ) . '"';

if ($parallax == "true") {

	if (empty($parallax_speed)) {
		$parallax_speed = 1.5;
	}

	if ( ! empty( $parallax_image ) ) {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}

	$css_classes[] = 'vc-parallax';

	$column_background = '<div class="parallax-container" style="background-image:url('.$parallax_image_src.');"></div>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if (isset($animation_delay)) {
	$animation_delay = 'data-animation-delay="'.esc_attr($animation_delay).'"';
}

$output .= '<div '.$animation_delay.' ' . implode( ' ', $wrapper_attributes ) . '>';
	$output .= '<div class="vc_column-inner ' . esc_attr( trim( vc_shortcode_custom_css_class( $css ) ) ).'" '.$data_responsive_padding.'>';
		$output .= '<div class="wpb_wrapper">';
			$output .= wpb_js_remove_wpautop( $content );
		$output .= '</div>';
		$output .= $column_background;
	$output .= '</div>';
$output .= '</div>';

echo html_entity_decode($output);
