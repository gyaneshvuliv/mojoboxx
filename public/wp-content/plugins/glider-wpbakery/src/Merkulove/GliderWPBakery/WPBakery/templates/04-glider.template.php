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
	$template['name']           = esc_html__( 'Glider – Contacts slider', 'glider-wpbakery' );
	$template['content']        = <<<CONTENT

[vc_row][vc_column][mdp_glider large="2" item_gutter="mdp-grid-large" center_mode="true" show_next_prev="true" icon_size="16px" icon_color="#0073ff"][mdp_gliderslide slide_name="01"]<img class="alignnone size-medium wp-image-65" style="border-radius: 8px;" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/office03-300x172.png" alt="" width="300" height="172" />

<strong>New Orleans</strong>
Louisiana, LA, 70112
2380 Big Indian
+ 8 000 504-552-0637
neworlean@email.com[/mdp_gliderslide][mdp_gliderslide slide_name="02"]<img class="alignnone size-medium wp-image-65" style="border-radius: 8px;" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/office03-300x172.png" alt="" width="300" height="172" />

<strong>Kernville</strong>
California, CA, 70112
2146 Carriage Court
+ 8 000 760-376-1360
rernville@email.com[/mdp_gliderslide][mdp_gliderslide slide_name="03"]<img class="alignnone size-medium wp-image-65" style="border-radius: 8px;" src="https://wpbakery.merkulov.design/wp-content/uploads/2020/03/office03-300x172.png" alt="" width="300" height="172" />

<strong>El Paso</strong>
Texas, TX, 79906
3249 Ward Road
+ 8 000 915-329-1413
elpaso@email.com[/mdp_gliderslide][/mdp_glider][/vc_column][/vc_row]

CONTENT;
	array_unshift( $data, $template );
	return $data;
} );
