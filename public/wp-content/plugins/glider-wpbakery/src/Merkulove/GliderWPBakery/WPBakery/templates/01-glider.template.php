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
	$template['name']           = esc_html__( 'Glider – Team slide-set', 'glider-wpbakery' );
	$template['content']        = <<<CONTENT

[vc_row][vc_column][mdp_glider_slideset gutter="mdp-grid-medium" vertical_align="flex-end" animation="slide-horizontal" duration="200" autoplay="true" autoplay_interval="8000" pause_on_hover="true" show_next_prev="true"][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584024867354{border-top-width: 1px !important;border-right-width: 1px !important;border-bottom-width: 1px !important;border-left-width: 1px !important;background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/senior-doctor-holding-digital-tablet-R8UQZSN.jpg?id=73) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-left-color: #f4f4f4 !important;border-left-style: solid !important;border-right-color: #f4f4f4 !important;border-right-style: solid !important;border-top-color: #f4f4f4 !important;border-top-style: solid !important;border-bottom-color: #f4f4f4 !important;border-bottom-style: solid !important;border-radius: 15px !important;}" slide_name="01"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Hamer</h6>
<p style="text-align: left;">Immunologist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027043652{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-smiling-mature-male-doctor-with-J2MWQDT.jpg?id=72) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="02"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Greenwood</h6>
<p style="text-align: left;">Pulmonologist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027095407{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-smiling-female-doctor-wearing-scrubs-YXSSUAT.jpg?id=71) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="03"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Meza</h6>
<p style="text-align: left;">Podiatrist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027031414{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-mature-male-doctor-wearing-white-coat-5TZ92CC.jpg?id=70) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="04"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Crossley</h6>
<p style="text-align: left;">Immunologist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027023726{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-mature-male-doctor-wearing-scrubs-K9GKHVB.jpg?id=69) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="05"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Thompson</h6>
<p style="text-align: left;">Ophthalmologist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027011069{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-female-doctor-wearing-scrubs-standing-KMWYYNP.jpg?id=68) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="06"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Whitehouse</h6>
<p style="text-align: left;">Podiatrist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027088355{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-candid-female-doctor-AX9WLBJ.jpg?id=67) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="07"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Prince</h6>
<p style="text-align: left;">Neonatologist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584027132974{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-an-obstetrician-P8BDE4Y.jpg?id=66) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="08"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Bradley</h6>
<p style="text-align: left;">Podiatrist</p>
</div>
[/mdp_glider_slidesetslide][mdp_glider_slidesetslide content_vertical_align="flex-end" s_item_height="500px" s_item_font_container="font_size:14px|line_height:.1em" s_item_style=".vc_custom_1584026980591{background-image: url(https://wpbakery.merkulov.design/wp-content/uploads/2020/03/portrait-of-beautiful-blonde-female-doctor-SMHVENP.png?id=49) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border: 1px solid #f4f4f4 !important;border-radius: 15px !important;}" slide_name="09"]
<div style="background: white; opacity: .95; padding: 16px 30px 30px 30px; border-radius: 0 0 12px 12px;">
<h6 style="text-align: left;">Dr. Meza</h6>
<p style="text-align: left;">Pulmonologist</p>
</div>
[/mdp_glider_slidesetslide][/mdp_glider_slideset][/vc_column][/vc_row]


CONTENT;
	array_unshift( $data, $template );
	return $data;
} );
