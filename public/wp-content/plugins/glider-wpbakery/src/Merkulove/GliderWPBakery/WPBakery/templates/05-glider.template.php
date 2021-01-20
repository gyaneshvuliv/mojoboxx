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
	$template['name']           = esc_html__( 'Glider – Portfolio slide-set', 'glider-wpbakery' );
	$template['content']        = <<<CONTENT

[vc_row][vc_column][mdp_glider_slideset gutter="mdp-grid-collapse" vertical_align="flex-end" duration="100" show_next_prev="true" icon_size="24px"][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="300px" s_item_style=".vc_custom_1584111075352{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/scott-webb-mslrSX69KvQ-unsplash.png?id=50) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" slide_name="01"]
<div style="color: white; font-size: 12px; opacity: 0; position: relative; margin-left: 20px;">Hyattsville, MD 20782</div>
<h6 style="background: #343352; color: white; padding: 2px 4px; display: inline-block; opacity: .9; margin: 0 20px 20px 20px;">The Glider Hall: Roof</h6>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="300px" s_item_style=".vc_custom_1584111081557{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/meric-dagli-0Rkm8EMMLG8-unsplash.png?id=51) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" slide_name="02"]
<div style="color: white; font-size: 12px; opacity: 0; position: relative; margin-left: 20px;">Greenfield, IN 46140</div>
<h6 style="background: #343352; color: white; padding: 2px 4px; display: inline-block; opacity: .9; margin: 0 20px 20px 20px;">The Glider Hall: North view</h6>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="300px" s_item_style=".vc_custom_1584111087866{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/scott-webb-68GdK1Aoc8g-unsplash.png?id=52) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" slide_name="03"]
<div style="color: white; font-size: 12px; opacity: 0; position: relative; margin-left: 20px;">Greenfield, IN 46140</div>
<h6 style="background: #343352; color: white; padding: 2px 4px; display: inline-block; opacity: .9; margin: 0 20px 20px 20px;">The Glider Hall: South view</h6>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="300px" s_item_style=".vc_custom_1584111094972{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/scott-webb-BdZ2usvdDgQ-unsplash.png?id=53) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" slide_name="04"]
<div style="color: white; font-size: 12px; opacity: 0; position: relative; margin-left: 20px;">Greenfield, IN 46140</div>
<h6 style="background: #343352; color: white; padding: 2px 4px; display: inline-block; opacity: .9; margin: 0 20px 20px 20px;">The Glider Hall: Facade detail</h6>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="300px" s_item_style=".vc_custom_1584111103445{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/scott-webb-E0f9iLMTuVQ-unsplash.png?id=54) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" slide_name="05"]
<div style="color: white; font-size: 12px; opacity: 0; position: relative; margin-left: 20px;">Greenfield, IN 46140</div>
<h6 style="background: #343352; color: white; padding: 2px 4px; display: inline-block; opacity: .9; margin: 0 20px 20px 20px;">The Glider Hall: Overview</h6>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="300px" s_item_style=".vc_custom_1584111114959{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/scott-webb-fMUIVein7Ng-unsplash.png?id=55) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" slide_name="06"]
<div style="color: white; font-size: 12px; opacity: 0; position: relative; margin-left: 20px;">Greenfield, IN 46140</div>
<h6 style="background: #343352; color: white; padding: 2px 4px; display: inline-block; opacity: .9; margin: 0 20px 20px 20px;">The Glider Hall: Roof</h6>
[/mdp_glider_slidesetslide][/mdp_glider_slideset][/vc_column][/vc_row]

CONTENT;
	array_unshift( $data, $template );
	return $data;
} );
