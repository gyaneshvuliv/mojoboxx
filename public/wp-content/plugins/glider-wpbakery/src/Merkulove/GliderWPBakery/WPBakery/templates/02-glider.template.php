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
	$template['name']           = esc_html__( 'Glider – Testimonials slide-set', 'glider-wpbakery' );
	$template['content']        = <<<CONTENT

[vc_row][vc_column][mdp_glider_slideset large="2" gutter="mdp-grid-large" vertical_align="flex-start" duration="400"][mdp_glider_slidesetslide slide_name="01" s_item_style=".vc_custom_1584084128304{border-radius: 15px !important;}"]</p>
<div style="box-shadow: 0 5px 15px rgba(0,0,0,.08); border-radius: 15px; padding: 48px 40px 40px 40px;">
<div style="width: 80px; height: 4px; background: #0073ff; display: block;"></div>
<h6 style="text-align: left;">Lisa-Marie Foreman</h6>
<p style="text-align: left;">I just wanted to let you know that I had one of the best dinners of my life last night…. at your restaurant!!</p>
<div class="glider-stars" style="display: inline-flex; text-align: left; height: 16px;"><i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i></div>
</div>
<p>[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="02"]</p>
<div style="box-shadow: 0 5px 15px rgba(0,0,0,.08); border-radius: 15px; padding: 48px 40px 40px 40px;">
<div style="width: 80px; height: 4px; background: #0073ff; display: block;"></div>
<h6 style="text-align: left;">Sasha Blevins</h6>
<p style="text-align: left;">Thank you for dinner last night. It was amazing!! I have to say it’s the best meal I have had in quite some time.</p>
<div class="glider-stars" style="display: inline-flex; text-align: left; height: 16px;"><i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i></div>
</div>
<p>[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="03"]</p>
<div style="box-shadow: 0 5px 15px rgba(0,0,0,.08); border-radius: 15px; padding: 48px 40px 40px 40px;">
<div style="width: 80px; height: 4px; background: #0073ff; display: block;"></div>
<h6 style="text-align: left;">Ellesha Simmonds</h6>
<p style="text-align: left;">To Our Friends at The French Gourmet, You will definitely be seeing more of me eating at your establishment.</p>
<div class="glider-stars" style="display: inline-flex; text-align: left; height: 16px;"><i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i></div>
</div>
<p>[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="04"]</p>
<div style="box-shadow: 0 5px 15px rgba(0,0,0,.08); border-radius: 15px; padding: 48px 40px 40px 40px;">
<div style="width: 80px; height: 4px; background: #0073ff; display: block;"></div>
<h6 style="text-align: left;">Rudra Beach</h6>
<p style="text-align: left;">As expected, the food was delicious and our servers were so friendly and helpful – we loved them!</p>
<div class="glider-stars" style="display: inline-flex; text-align: left; height: 16px;"><i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i></div>
</div>
<p>[/mdp_glider_slidesetslide][mdp_glider_slidesetslide slide_name="05"]</p>
<div style="box-shadow: 0 5px 15px rgba(0,0,0,.08); border-radius: 15px; padding: 48px 40px 40px 40px;">
<div style="width: 80px; height: 4px; background: #0073ff; display: block;"></div>
<h6 style="text-align: left;">Lisa-Marie Foreman</h6>
<p style="text-align: left;">I just wanted to let you know that I had one of the best dinners of my life last night…. at your restaurant!!</p>
<div class="glider-stars" style="display: inline-flex; text-align: left; height: 16px;"><i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i><br />
<i class="fas fa-star" style="font-size: 12px; color: orange; margin-right: 10px;"></i></div>
</div>
<p>[/mdp_glider_slidesetslide][/mdp_glider_slideset][/vc_column][/vc_row]

CONTENT;
	array_unshift( $data, $template );
	return $data;
} );
