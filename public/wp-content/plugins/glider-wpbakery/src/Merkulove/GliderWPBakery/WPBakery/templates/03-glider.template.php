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
	$template['name']           = esc_html__( 'Glider – Clients slide-set', 'glider-wpbakery' );
	$template['content']        = <<<CONTENT

[vc_row][vc_column][mdp_glider_slideset medium="3" gutter="mdp-grid-large" vertical_align="center" animation="scale" duration="250" autoplay="true" autoplay_interval="3000" pause_on_hover="true" show_navigation="true" dotnav_size="12px" dotnav_color="rgba(221,221,221,0.7)"][mdp_glider_slidesetslide slide_name="01"]<img class="alignnone size-medium wp-image-173" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_01-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="02"]<img class="alignnone size-medium wp-image-172" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_02-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="03"]<img class="alignnone size-medium wp-image-171" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_03-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="04"]<img class="alignnone size-medium wp-image-170" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_04-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="05"]<img class="alignnone size-medium wp-image-169" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_05-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="06"]<img class="alignnone size-medium wp-image-168" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_06-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="07"]<img class="alignnone size-medium wp-image-167" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_07-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="08"]<img class="alignnone size-medium wp-image-166" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_08-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="09"]<img class="alignnone size-medium wp-image-165" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/DELICIOUS_logo_set_09-300x300.png" alt="" width="300" height="300" />[/mdp_glider_slidesetslide][/mdp_glider_slideset][/vc_column][/vc_row]           

CONTENT;
	array_unshift( $data, $template );
	return $data;
} );
