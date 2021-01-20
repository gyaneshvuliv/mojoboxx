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

add_filter( 'vc_load_default_templates', function($data) {
	$template                   = [];
	$template['name']           = esc_html__( 'Glider - Fullscreen slider', 'glider-wpbakery' );
	$template['content']        = <<<CONTENT

[vc_row][vc_column][mdp_glider fullscreen_mode="true" autoplay="true" autoplay_interval="10000" show_next_prev="true"][mdp_gliderslide item_height="100%" item_font_container="color:%23ffffff" slide_name="01" item_style=".vc_custom_1584112789954{padding-top: 200px !important;padding-right: 200px !important;padding-bottom: 200px !important;padding-left: 200px !important;background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/slide_4.jpg?id=62) !important;}"]
<h3 style="text-transform: uppercase; color: white; font-size: 148px; line-height: 1;">Cardio Training</h3>
<button>Sign Up</button>[/mdp_gliderslide][mdp_gliderslide item_height="100%" item_font_container="color:%23ffffff" slide_name="02" item_style=".vc_custom_1584112804915{padding-top: 200px !important;padding-right: 200px !important;padding-bottom: 200px !important;padding-left: 200px !important;background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/slide_1.jpg?id=61) !important;}"]
<h3 style="text-transform: uppercase; color: white; font-size: 148px; line-height: 1;">Crossfit Training</h3>
<button>Sign Up</button>[/mdp_gliderslide][/mdp_glider][/vc_column][/vc_row]

CONTENT;
	array_unshift( $data, $template );
	return $data;
} );
