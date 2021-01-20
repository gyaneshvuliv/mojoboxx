<?php

vc_disable_frontend();

vc_remove_param('vc_section', 'full_width');
vc_remove_param('vc_row', 'full_width');
vc_remove_param('vc_row_inner', 'gap');
vc_remove_param('vc_row', 'gap');
vc_remove_param('vc_row', 'parallax');
vc_remove_param('vc_row', 'parallax_image');
vc_remove_param('vc_row', 'video_bg');
vc_remove_param('vc_row', 'video_bg_url');
vc_remove_param('vc_row', 'video_bg_parallax');
vc_remove_param('vc_row', 'parallax_speed_bg');
vc_remove_param('vc_row', 'parallax_speed_video');

vc_add_param('vc_row', array(
	'type'       => 'dropdown',
	'heading'    => esc_html__( 'Row stretch', 'globax' ),
	'param_name' => 'full_width',
	'value'      => array(
		esc_html__( 'No stretching', 'globax' )           => 'stretch_no',
		esc_html__( 'Stretch row', 'globax' )             => 'stretch_row',
		esc_html__( 'Stretch row and content', 'globax' ) => 'stretch_row_content',
	),
	'weight' => 1,
	'description' => esc_html__( '"No stretching" alignes the row with the main theme container, "Stretch row" makes the row full width, but keeps the content of the row aligned with theme main theme container, "Stretch row and content" makes the row and content full width', 'globax' )
));


vc_add_param('vc_row', array(
	'type'       => 'dropdown',
	'heading'    => esc_html__( 'Columns gap', 'globax' ),
	'param_name' => 'gap',
	'weight'     => 1,
	'value'      => array(
		esc_html__('0px', 'globax')    => '0', 
		esc_html__('2px', 'globax')    => '2', 
		esc_html__('4px', 'globax')    => '4', 
		esc_html__('8px', 'globax')    => '8', 
		esc_html__('16px', 'globax')   => '16', 
		esc_html__('24px', 'globax')   => '24', 
		esc_html__('32px', 'globax')   => '32', 
		esc_html__('40px', 'globax')   => '40', 
		esc_html__('48px', 'globax')   => '48', 
		esc_html__('56px', 'globax')   => '56', 
		esc_html__('64px', 'globax')   => '64', 
		esc_html__('72px', 'globax')   => '72', 
		esc_html__('80px', 'globax')   => '80', 
	),
	'std' => '24'
));

vc_add_param('vc_row_inner', array(
	'type'       => 'dropdown',
	'heading'    => esc_html__( 'Columns gap', 'globax' ),
	'param_name' => 'gap',
	'weight'     => 1,
	'value'      => array(
		esc_html__('0px', 'globax')    => '0', 
		esc_html__('2px', 'globax')    => '2', 
		esc_html__('4px', 'globax')    => '4', 
		esc_html__('8px', 'globax')    => '8', 
		esc_html__('16px', 'globax')   => '16', 
		esc_html__('24px', 'globax')   => '24', 
		esc_html__('32px', 'globax')   => '32', 
		esc_html__('40px', 'globax')   => '40', 
		esc_html__('48px', 'globax')   => '48', 
		esc_html__('56px', 'globax')   => '56', 
		esc_html__('64px', 'globax')   => '64', 
		esc_html__('72px', 'globax')   => '72', 
		esc_html__('80px', 'globax')   => '80', 
	),
));

vc_add_param('vc_row', array(
	'type'       => 'checkbox',
	'heading'    => esc_html__( 'Parallax', 'globax' ),
	'param_name' => 'parallax',
	'group'      => esc_html__('Parallax','globax'),
));

vc_add_param('vc_row', array(
	'type'       => 'attach_image',
	'group'      => esc_html__('Parallax','globax'),
	'heading'    => esc_html__( 'Parallax image', 'globax' ),
	'param_name' => 'parallax_image',
	'dependency' => Array('element' => 'parallax', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'textfield',
	'group'      => esc_html__('Parallax','globax'),
	'heading'    => esc_html__( 'Parallax speed', 'globax' ),
	'param_name' => 'parallax_speed_bg',
	'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','globax'),
	'dependency' => Array('element' => 'parallax', 'value' => 'true'),
	'default'    => '1.5'
));

vc_add_param('vc_row', array(
	'type'       => 'checkbox',
	'heading'    => esc_html__( 'Video background', 'globax' ),
	'param_name' => 'video_bg',
	'group'      => esc_html__('Video','globax'),
));

vc_add_param('vc_row', array(
	'type'       => 'textfield',
	'group'      => esc_html__('Video','globax'),
	'heading'    => esc_html__( 'Video background mp4 file url', 'globax' ),
	'param_name' => 'video_bg_mp4',
	'dependency' => Array('element' => 'video_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'textfield',
	'group'      => esc_html__('Video','globax'),
	'heading'    => esc_html__( 'Video background webm file url', 'globax' ),
	'param_name' => 'video_bg_webm',
	'dependency' => Array('element' => 'video_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'textfield',
	'group'      => esc_html__('Video','globax'),
	'heading'    => esc_html__( 'Video background ogv file url', 'globax' ),
	'param_name' => 'video_bg_ogv',
	'dependency' => Array('element' => 'video_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'attach_image',
	'group'      => esc_html__('Video','globax'),
	'heading'    => esc_html__( 'Video overlay', 'globax' ),
	'param_name' => 'video_overlay',
	'dependency' => Array('element' => 'video_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'attach_image',
	'group'      => esc_html__('Video','globax'),
	'heading'    => esc_html__( 'Video placeholder', 'globax' ),
	'param_name' => 'video_placeholder',
	'dependency' => Array('element' => 'video_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'checkbox',
	'heading'    => esc_html__( 'Video parallax', 'globax' ),
	'param_name' => 'video_bg_parallax',
	'group'      => esc_html__('Video','globax'),
	'dependency' => Array(
		'element' => 'video_bg', 'value' => 'true',

	)
));

vc_add_param('vc_row', array(
	'type'       => 'textfield',
	'group'      => esc_html__('Video','globax'),
	'heading'    => esc_html__( 'Video background parallax speed', 'globax' ),
	'param_name' => 'parallax_speed_video',
	'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','globax'),
	'dependency' => Array(
		'element' => 'video_bg_parallax', 'value' => 'true',
	),
	'default'    => '1.5'
));

vc_add_param('vc_row', array(
	'type'       => 'checkbox',
	'heading'    => esc_html__( 'Fixed background', 'globax' ),
	'group'      => esc_html__('Fixed','globax'),
	'param_name' => 'fixed_bg',
));

vc_add_param('vc_row', array(
	'type'       => 'attach_image',
	'heading'    => esc_html__( 'Fixed background image', 'globax' ),
	'group'      => esc_html__('Fixed','globax'),
	'param_name' => 'fixed_bg_image',
	'dependency' => Array('element' => 'fixed_bg', 'value' => 'true')
));


vc_add_param('vc_row', array(
	'type'       => 'checkbox',
	'heading'    => esc_html__( 'Animated background', 'globax' ),
	'group'      => esc_html__('Animated','globax'),
	'param_name' => 'animated_bg',
));

vc_add_param('vc_row', array(
	'type'       => 'dropdown',
	'heading'    => esc_html__( 'Animated background direction', 'globax' ),
	'group'      => esc_html__('Animated','globax'),
	'param_name' => 'animated_bg_dir',
	'value'     => array(
		esc_html__('Horizontal','globax')  => 'horizontal',
		esc_html__('Vertical','globax')  => 'vertical',
	),
	'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'textfield',
	'heading'    => esc_html__( 'Animated background speed in ms (default is 35000)', 'globax' ),
	'group'      => esc_html__('Animated','globax'),
	'param_name' => 'animated_bg_speed',
	'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
));

vc_add_param('vc_row', array(
	'type'       => 'attach_image',
	'heading'    => esc_html__( 'Animated background image', 'globax' ),
	'group'      => esc_html__('Animated','globax'),
	'param_name' => 'animated_bg_image',
	'dependency' => Array('element' => 'animated_bg', 'value' => 'true')
));

$animation_delay_values = array();

for ($i=0; $i <= 1000; $i = $i + 50) { 
	$animation_delay_values[$i.esc_html__('ms', 'globax')] = $i;
}

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'heading'    => esc_html__( 'Animation delay in ms (example 300)', 'globax' ),
	'param_name' => 'animation_delay',
	'weight'     => 1,
	'value'      => $animation_delay_values
));

vc_remove_param('vc_column', 'parallax');
vc_remove_param('vc_column', 'parallax_image');
vc_remove_param('vc_column', 'video_bg');
vc_remove_param('vc_column', 'video_bg_url');
vc_remove_param('vc_column', 'video_bg_parallax');
vc_remove_param('vc_column', 'parallax_speed_bg');
vc_remove_param('vc_column', 'parallax_speed_video');

vc_add_param('vc_column', array(
	'type'       => 'checkbox',
	'heading'    => esc_html__( 'Parallax', 'globax' ),
	'param_name' => 'parallax',
	'group'      => esc_html__('Parallax','globax'),
));

vc_add_param('vc_column', array(
	'type'       => 'attach_image',
	'group'      => esc_html__('Parallax','globax'),
	'heading'    => esc_html__( 'Parallax image', 'globax' ),
	'param_name' => 'parallax_image',
	'dependency' => Array('element' => 'parallax', 'value' => 'true')
));

vc_add_param('vc_column', array(
	'type'       => 'textfield',
	'group'      => esc_html__('Parallax','globax'),
	'heading'    => esc_html__( 'Parallax speed', 'globax' ),
	'param_name' => 'parallax_speed_bg',
	'description'=> esc_html__('Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)','globax'),
	'dependency' => Array('element' => 'parallax', 'value' => 'true'),
	'default'    => '1.5'
));

$responsive_padding_array = array(
	esc_html__('inherit', 'globax')  => '', 
	esc_html__('0', 'globax')        => '0', 
	esc_html__('5%', 'globax')       => '5%', 
	esc_html__('10%', 'globax')      => '10%', 
	esc_html__('15%', 'globax')      => '15%', 
	esc_html__('20%', 'globax')      => '20%', 
	esc_html__('25%', 'globax')      => '25%', 
	esc_html__('30%', 'globax')      => '30%', 
	esc_html__('35%', 'globax')      => '35%', 
	esc_html__('40%', 'globax')      => '40%', 
	esc_html__('45%', 'globax')      => '45%', 
	esc_html__('50%', 'globax')      => '50%' 
);

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_section_heading',
	'heading'    => esc_html__( 'Responsive padding', 'globax' ),
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'responsive_padding_heading',
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Under 480px wide', 'globax' ),
	'param_name' => 'under480_start',
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'under480_padding_left',
	'value'      => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'under480_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'under480_end',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Over 480px and under 768px wide', 'globax' ),
	'param_name' => 'over480_under_768_start',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'over480_under_768_padding_left',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'over480_under_768_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'over480_under_768_end',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Over 768px and under 1024px wide', 'globax' ),
	'param_name' => 'over768_under_1024_start',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'over768_under_1024_padding_left',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'over768_under_1024_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'over768_under_1024_end',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Over 1024px and under 1280px wide', 'globax' ),
	'param_name' => 'over1024_under_1280_start',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'over1024_under_1280_padding_left',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'over1024_under_1280_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'over1024_under_1280_end',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Over 1280px and under 1366px wide', 'globax' ),
	'param_name' => 'over1280_under_1366_start',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'over1280_under_1366_padding_left',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'over1280_under_1366_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'over1280_under_1366_end',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Over 1366px and under 1600px wide', 'globax' ),
	'param_name' => 'over1366_under_1600_start',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'over1366_under_1600_padding_left',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'over1366_under_1600_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'over1366_under_1600_end',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_start',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Over 1600px and under 1920 wide', 'globax' ),
	'param_name' => 'over1600_start',
	'default'    => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Left', 'globax' ),
	'param_name' => 'over1600_padding_left',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'dropdown',
	'group'      => esc_html__('Responsive Options','globax'),
	'heading'    => esc_html__( 'Right', 'globax' ),
	'param_name' => 'over1600_padding_right',
	'value'     => $responsive_padding_array,
	'std'        => ''
));

vc_add_param('vc_column', array(
	'type'       => 'column_ui_title_block_end',
	'group'      => esc_html__('Responsive Options','globax'),
	'param_name' => 'over1600_end',
	'default'    => ''
));

vc_add_param('vc_custom_heading', array(
	'param_name'=>'mobile_font_size',
	'type'      => 'dropdown',
	'group'     => esc_html__('Responsive title typography', 'globax'), 
	'heading'   => esc_html__('Title font size mobile', 'globax'), 
	'value'     => array(
		esc_html__('inherit', 'globax')  => 'inherit', 
		esc_html__('14px', 'globax')  => '14px', 
		esc_html__('16px', 'globax')  => '16px', 
		esc_html__('18px', 'globax')  => '18px', 
		esc_html__('20px', 'globax')  => '20px', 
		esc_html__('24px', 'globax')  => '24px', 
		esc_html__('32px', 'globax')  => '32px', 
		esc_html__('40px', 'globax')  => '40px', 
		esc_html__('48px', 'globax')  => '48px', 
		esc_html__('56px', 'globax')  => '56px', 
		esc_html__('64px', 'globax')  => '64px', 
		esc_html__('72px', 'globax')  => '72px', 
	),
));

vc_add_param('vc_custom_heading', array(
	'param_name'=>'tablet_font_size',
	'type'      => 'dropdown',
	'group'     => esc_html__('Responsive title typography', 'globax'), 
	'heading'   => esc_html__('Title font size tablet', 'globax'), 
	'value'     => array(
		esc_html__('inherit', 'globax')  => 'inherit', 
		esc_html__('14px', 'globax')  => '14px', 
		esc_html__('16px', 'globax')  => '16px', 
		esc_html__('18px', 'globax')  => '18px', 
		esc_html__('20px', 'globax')  => '20px', 
		esc_html__('24px', 'globax')  => '24px', 
		esc_html__('32px', 'globax')  => '32px', 
		esc_html__('40px', 'globax')  => '40px', 
		esc_html__('48px', 'globax')  => '48px', 
		esc_html__('56px', 'globax')  => '56px', 
		esc_html__('64px', 'globax')  => '64px', 
		esc_html__('72px', 'globax')  => '72px', 
	),
));

function globax_enovathemes_remove_woocommerce() {
    if (class_exists('Woocommerce')) {
        vc_remove_element( 'recent_products' );
		vc_remove_element( 'featured_products' );
		vc_remove_element( 'product' );
		vc_remove_element( 'products' );
		vc_remove_element( 'product_category' );
		vc_remove_element( 'product_categories' );
		vc_remove_element( 'sale_products' );
		vc_remove_element( 'best_selling_products' );
		vc_remove_element( 'top_rated_products' );
		vc_remove_element( 'related_products' );
		vc_remove_element( 'product_attribute' );
    }
}
add_action( 'vc_build_admin_page', 'globax_enovathemes_remove_woocommerce', 11 );
add_action( 'vc_load_shortcode', 'globax_enovathemes_remove_woocommerce', 11 );

if (defined( 'ENOVATHEMES_ADDONS' ) && file_exists( get_template_directory() . '/plugins/enovathemes-addons.zip' ) ) {
	add_action( 'init', 'globax_enovathemes_integrateVC');
    function globax_enovathemes_integrateVC() {

    	$animation_delay_values = array();

		for ($i=0; $i <= 1000; $i = $i + 50) { 
			$animation_delay_values[$i.esc_html__('ms', 'globax')] = $i;
		}

    	$order_by_values = array(
			esc_html__( 'Date', 'globax' ) => 'date',
			esc_html__( 'ID', 'globax' ) => 'ID',
			esc_html__( 'Author', 'globax' ) => 'author',
			esc_html__( 'Title', 'globax' ) => 'title',
			esc_html__( 'Modified', 'globax' ) => 'modified',
			esc_html__( 'Random', 'globax' ) => 'rand',
			esc_html__( 'Comment count', 'globax' ) => 'comment_count',
			esc_html__( 'Menu order', 'globax' ) => 'menu_order',
		);

		$order_way_values = array(
			esc_html__( 'Descending', 'globax' ) => 'DESC',
			esc_html__( 'Ascending', 'globax' ) => 'ASC',
		);

		$operator_values = array(
			esc_html__( 'IN', 'globax' ) => 'IN',
			esc_html__( 'NOT IN', 'globax' ) => 'NOT IN',
			esc_html__( 'AND', 'globax' ) => 'AND',
		);

		$animation_values = array(
			esc_html__('None', 'globax')     => 'none',
			esc_html__('Fade In', 'globax')  => 'fadeIn',
			esc_html__('Move Up', 'globax')  => 'moveUp',
		);

		$size_values_box = array(
			esc_html__('Small (1/4 - 25%)', 'globax')        => 'small', 
			esc_html__('Medium (1/3 - 33%)', 'globax')       => 'medium',
			esc_html__('Large (1/2 - 50%)', 'globax')        => 'large'
		);

		$size_values_default = array(
			esc_html__('Small', 'globax')        => 'small', 
			esc_html__('Medium', 'globax')       => 'medium',
			esc_html__('Large', 'globax')        => 'large'
		);

		$size_values_extra = array(
			esc_html__('Extra small', 'globax')  => 'extra-small', 
			esc_html__('Small', 'globax')        => 'small', 
			esc_html__('Medium', 'globax')       => 'medium',
			esc_html__('Large', 'globax')        => 'large',
			esc_html__('Extra large', 'globax')  => 'large-x',
			esc_html__('Extra Extra large', 'globax')  => 'large-xx'
		);

		$font_weight_values = array(
			'100'  => '100', 
			'200'  => '200', 
			'300'  => '300', 
			'400'  => '400', 
			'500'  => '500', 
			'600'  => '600', 
			'700'  => '700', 
			'800'  => '800', 
			'900'  => '900',
		);

		$align_values = array(
			esc_html__('Left','globax')   => 'left', 
			esc_html__('Right','globax')  => 'right', 
			esc_html__('Center','globax') => 'center'
		);

		$logic_values = array(
			esc_html__('False','globax')   => 'false', 
			esc_html__('True','globax')  => 'true', 
		);

		$animation_type_values = array(
			esc_html__('None', 'globax')       => 'none',
			esc_html__('Sequential','globax')  => 'sequential',
			esc_html__('Random','globax')      => 'random'
		);

		$image_size_values = array(
			'full'      => 'full',
			'thumbnail' => 'thumbnail',
			'globax_1200X640' => 'globax_1200X640',
			'globax_960X600'  => 'globax_960X600',
			'globax_870X440'  => 'globax_870X440',
			'globax_870X530'  => 'globax_870X530',
			'globax_640X400'  => 'globax_640X400',
			'globax_588X588'  => 'globax_588X588',
			'globax_588X440'  => 'globax_588X440',
			'globax_480X320'  => 'globax_480X320',
			'globax_384X384'  => 'globax_384X384',
			'globax_384X288'  => 'globax_384X288',
			'globax_282X282'  => 'globax_282X282',
			'globax_282X212'  => 'globax_282X212'
		);

		$image_overlay_values = array(
			esc_html__('Overlay none','globax') 						 => 'overlay-none',
			esc_html__('Overlay fade','globax') 						 => 'overlay-fade',
			esc_html__('Overlay fade with image zoom','globax')         => 'overlay-fade-zoom',
			esc_html__('Overlay fade with extreme image zoom','globax') => 'overlay-fade-zoom-extreme',
			esc_html__('Overlay move fluid','globax')                   => 'overlay-move',
			esc_html__('Overlay scale in','globax')                     => 'overlay-scale-in',
			esc_html__('Transform','globax')                            => 'transform'
		);

		$image_caption_values = array(
			esc_html__('Caption up','globax') => 'caption-up',
		);

		$layout_type_values = array(
			esc_html__('Grid', 'globax')     => 'grid', 
			esc_html__('Carousel', 'globax') => 'carousel', 
		);

		$gap_values = array();

		for ($i=0; $i <= 80; $i = $i + 2) { 
			$gap_values[$i.esc_html__('px', 'globax')] = $i;
		}

		$social_links_array = array(
			'youtube',
			'vk',
			'tripadvisor',
			'google',
			'facebook',
			'instagram',
			'twitter',
			'vimeo',
			'dribbble',
			'behance',
			'apple',
			'android',
			'skype',
			'linkedin',
			'pinterest',
			'email'
		);

		/* track
		---------------*/

	    	vc_map(array(
				'name'                    => esc_html__('Track','globax'),
				'description'             => esc_html__('Use this element to show tracking form','globax'),
				'category'                => esc_html__('Enovathemes','globax'),
				'base'                    => 'et_track',
				'class'                   => 'et_track',
				'icon'                    => 'et_track',
				'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Destination email','globax'),
						'param_name' => 'recipient_email',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form fields background color','globax'),
						'param_name' => 'field_back_color',
						'value'      => '#ffffff'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form fields border color','globax'),
						'param_name' => 'field_border_color',
						'value'      => '#e0e0e0'
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form fields text color','globax'),
						'param_name' => 'field_text_color',
						'value'      => '#616161'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form button background color','globax'),
						'param_name' => 'button_back_color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form button text color','globax'),
						'param_name' => 'button_text_color',
						'value'      => '#ffffff'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form button background color hover','globax'),
						'param_name' => 'button_back_color_hover',
						'value'      => '#212121'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Form button text color hover','globax'),
						'param_name' => 'button_text_color_hover',
						'value'      => '#ffffff'
					),
				)
			));

		/* blockquote
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Blockquote','globax'),
	    		'description'             => esc_html__('Insert blockquote','globax'),
	    		'base'                    => 'et_blockquote',
	    		'icon'                    => 'et_blockquote',
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload person image','globax'),
						'param_name' => 'src',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Subtitle','globax'),
						'param_name' => 'subtitle',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Quote','globax'),
						'param_name' => 'quote',
						'value'      => ''
					),
	    		)
	    	));

	    /* highlight_title
		---------------*/

			for ($i=1; $i <= 5 ; $i++) { 
				vc_add_param('et_typeit', array(
					'type'       => 'textfield',
					'heading'    => 'String #'.$i,
					'param_name' => 'string_'.$i,
					'value'      => ''
				));
			}

			vc_map(array(
	    		'name'                    => esc_html__('Highlight title','globax'),
	    		'description'             => esc_html__('Insert highlight title','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_highlight_title',
	    		'class'                   => 'et_highlight_title',
	    		'icon'                    => 'et_highlight_title',
	    		'params'                  => array(
	    			array(
						'param_name'=>'type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title type', 'globax'), 
						'value'     => array(
							esc_html__('H1', 'globax')  => 'h1', 
							esc_html__('H2', 'globax')  => 'h2', 
							esc_html__('H3', 'globax')  => 'h3', 
							esc_html__('H4', 'globax')  => 'h4', 
							esc_html__('H5', 'globax')  => 'h5', 
							esc_html__('H6', 'globax')  => 'h6', 
							esc_html__('p', 'globax')   => 'p', 
							esc_html__('div', 'globax')   => 'div', 
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size mobile', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size tablet', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Font weight (without any string)', 'globax'),
						'value'     => $font_weight_values,
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#9a9a9a'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Line color','globax'),
						'param_name' => 'line_color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					),
	    		)
	    	));

		/* animated_title
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Animated title','globax'),
	    		'description'             => esc_html__('Insert animated title','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_animated_title',
	    		'class'                   => 'et_animated_title',
	    		'icon'                    => 'et_animated_title',
	    		'params'                  => array(
	    			array(
						'param_name'=>'type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title type', 'globax'), 
						'value'     => array(
							esc_html__('H1', 'globax')  => 'h1', 
							esc_html__('H2', 'globax')  => 'h2', 
							esc_html__('H3', 'globax')  => 'h3', 
							esc_html__('H4', 'globax')  => 'h4', 
							esc_html__('H5', 'globax')  => 'h5', 
							esc_html__('H6', 'globax')  => 'h6', 
							esc_html__('p', 'globax')   => 'p', 
							esc_html__('div', 'globax')   => 'div', 
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size mobile', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size tablet', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Font weight (without any string)', 'globax'),
						'value'     => $font_weight_values,
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#212121'
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Title','globax'),
						'description'=> esc_html__('Do not use & in the text. If you want to highlight/style a separate word, wrap it inside the span like this <span class="highlight" style="color: #fd8c40;">globax</span>. Use color styling option only','globax'),
						'param_name' => 'content',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					),
					array(
						'type'       => 'dropdown',
						'group'      => esc_html__('Animation','globax'),
						'heading'    => esc_html__('Animation type','globax'),
						'param_name' => 'animation_type',
						'value'     => array(
							esc_html__('Curtain left', 'globax')  		  => 'curtain-left', 
							esc_html__('Curtain right', 'globax')  		  => 'curtain-right', 
							esc_html__('Curtain top', 'globax')  		  => 'curtain-top', 
							esc_html__('Curtain bottom', 'globax')  	  => 'curtain-bottom', 
							esc_html__('Line appear left', 'globax')      => 'line-appear', 
							esc_html__('Letter fly-in direct', 'globax')  => 'letter-direct', 
							esc_html__('Letter fly-in angle', 'globax')   => 'letter-angle', 
							esc_html__('Words fly-in direct', 'globax')  => 'words-direct', 
							esc_html__('Words fly-in angle', 'globax')  => 'words-angle', 
						),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Line/Curtain Color','globax'),
						'group'      => esc_html__('Animation','globax'),
						'param_name' => 'element_color',
						'value'      => '#fd8c40',
						'dependency' => Array(
							'element' => 'animation_type', 'value' => array('curtain-left','curtain-right','curtain-top','curtain-bottom','line-appear'),
						)
					),
					array(
						'type'       => 'textfield',
						'group'      => esc_html__('Animation','globax'),
						'heading'    => esc_html__('Start delay in ms (enter only integer number)','globax'),
						'param_name' => 'start_delay',
						'value'      => '0'
					),
	    		)
	    	));
		
		/* braket text block
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Animated braket text block','globax'),
	    		'description'             => esc_html__('Insert animated braket text block','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_braket',
	    		'class'                   => 'et_braket',
	    		'icon'                    => 'et_braket',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Sub-title','globax'),
						'param_name' => 'sub_title',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Sub-title color','globax'),
						'param_name' => 'sub_title_color',
						'value'      => '#9a9a9a'
					),
	    			array(
						'param_name'=>'title_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title type', 'globax'), 
						'value'     => array(
							esc_html__('H1', 'globax')  => 'h1', 
							esc_html__('H2', 'globax')  => 'h2', 
							esc_html__('H3', 'globax')  => 'h3', 
							esc_html__('H4', 'globax')  => 'h4', 
							esc_html__('H5', 'globax')  => 'h5', 
							esc_html__('H6', 'globax')  => 'h6', 
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Title color','globax'),
						'param_name' => 'title_color',
						'value'      => '#212121'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size mobile', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size tablet', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px',  
						),
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font weight (without any string)', 'globax'),
						'value'     => $font_weight_values,
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'textarea_html',
						'heading'    => esc_html__('Content','globax'),
						'param_name' => 'content',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button link','globax'),
						'param_name' => 'button_link',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button text','globax'),
						'param_name' => 'button_text',
						'value'      => ''
					),
					array(
						'type'       => 'dropdown',
						'heading'      => esc_html__('Align','globax'),
						'param_name' => 'align',
						'value'     => array(
							esc_html__('Left', 'globax')  => 'left', 
							esc_html__('Right', 'globax') => 'right'
						),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Braket color','globax'),
						'param_name' => 'braket_color',
						'value'      => '#fd8c40',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Start delay in ms (enter only integer number)','globax'),
						'param_name' => 'start_delay',
						'value'      => '0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					),
	    		)
	    	));

		/* braket_simple
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Braket text block simple','globax'),
	    		'description'             => esc_html__('Insert simple braket text block','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_braket_simple',
	    		'class'                   => 'et_braket_simple',
	    		'icon'                    => 'et_braket_simple',
	    		'params'                  => array(
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Text','globax'),
						'param_name' => 'text',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Text color','globax'),
						'param_name' => 'color',
						'value'      => '#616161'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Text font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Text font size mobile', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Text font size tablet', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Text font weight (without any string)', 'globax'),
						'value'     => $font_weight_values,
						'std' => '400'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Text line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Text letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Braket color','globax'),
						'param_name' => 'braket_color',
						'value'      => '#fd8c40',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					),
	    		)
	    	));

	    /* ghost title
		---------------*/

			vc_map(array(
	    		'name'                    => 'Ghost tiltle',
	    		'description'             => esc_html__('Insert ghost title','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_ghost_title',
	    		'class'                   => 'et_ghost_title',
	    		'icon'                    => 'et_ghost_title',
		    	'content_element'         => true,
	    		"as_parent"               => array('except' => 'vc_section'),
				"js_view"                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'      => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size mobile', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
							esc_html__('80px', 'globax')  => '80px', 
							esc_html__('88px', 'globax')  => '88px', 
							esc_html__('96px', 'globax')  => '96px', 
							esc_html__('104px', 'globax')  => '104px', 
							esc_html__('112px', 'globax')  => '112px', 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size tablet', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
							esc_html__('80px', 'globax')  => '80px', 
							esc_html__('88px', 'globax')  => '88px', 
							esc_html__('96px', 'globax')  => '96px', 
							esc_html__('104px', 'globax')  => '104px', 
							esc_html__('112px', 'globax')  => '112px', 
						),
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Font weight (without any string)', 'globax'),
						'value'     => $font_weight_values,
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => 'rgba(0,0,0,0.3)'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Horizontal offset (without any string)','globax'),
						'param_name' => 'horizontal_offset',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Vertical offset (without any string)','globax'),
						'param_name' => 'vertical_offset',
						'value'      => ''
					),
	    		)
	    	));

		/* typeit
		---------------*/

			for ($i=1; $i <= 5 ; $i++) { 
				vc_add_param('et_typeit', array(
					'type'       => 'textfield',
					'heading'    => 'String #'.$i,
					'param_name' => 'string_'.$i,
					'value'      => ''
				));
			}

			vc_map(array(
	    		'name'                    => esc_html__('Typeit','globax'),
	    		'description'             => esc_html__('Insert animate typewrite','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_typeit',
	    		'class'                   => 'et_typeit',
	    		'icon'                    => 'et_typeit',
	    		'params'                  => array(
	    			array(
						'param_name'=>'type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Typeit type', 'globax'), 
						'group'      => esc_html__('Typography','globax'),
						'value'     => array(
							esc_html__('H1', 'globax')  => 'h1', 
							esc_html__('H2', 'globax')  => 'h2', 
							esc_html__('H3', 'globax')  => 'h3', 
							esc_html__('H4', 'globax')  => 'h4', 
							esc_html__('H5', 'globax')  => 'h5', 
							esc_html__('H6', 'globax')  => 'h6', 
							esc_html__('p', 'globax')   => 'p', 
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Font size (without any string)','globax'),
						'group'      => esc_html__('Typography','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size mobile', 'globax'), 
						'group'      => esc_html__('Typography','globax'),
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px' 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size tablet', 'globax'), 
						'group'      => esc_html__('Typography','globax'),
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px' 
						),
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Font weight (without any string)', 'globax'),
						'group'     => esc_html__('Typography','globax'), 
						'value'     => $font_weight_values,
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'group'      => esc_html__('Typography','globax'),
						'heading'    => esc_html__('Line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'group'      => esc_html__('Typography','globax'),
						'heading'    => esc_html__('Letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#fd8c40'
					),
					array(
						'param_name'=>'align',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Text align', 'globax'), 
						'value'     => $align_values
					),
					array(
						'param_name'=>'autostart',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Autostart', 'globax'), 
						'value'     => $logic_values
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Start delay in ms','globax'),
						'param_name' => 'start_delay',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Main title','globax'),
						'param_name' => 'main_title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					),
	    		)
	    	));

		/* separator
		---------------*/

	    	vc_map(array(
				'name'                    => esc_html__('Separator','globax'),
				'description'             => esc_html__('Use this element to separate content','globax'),
				'category'                => esc_html__('Enovathemes','globax'),
				'base'                    => 'et_separator',
				'class'                   => 'et_separator',
				'icon'                    => 'et_separator',
				'params'                  => array(
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Type','globax'),
						'param_name' => 'type',
						'value'      => array(
							esc_html__('solid','globax')  => 'solid',
							esc_html__('dotted','globax') => 'dotted',
							esc_html__('dashed','globax') => 'dashed',
						)
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#e0e0e0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap from top (without any string)','globax'),
						'param_name' => 'top',
						'value'      => '24'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap from bottom (without any string)','globax'),
						'param_name' => 'bottom',
						'value'      => '24'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Width (without any string, if you want 100% leave blank)','globax'),
						'param_name' => 'width',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Height (without any string, if you want 1px leave blank)','globax'),
						'param_name' => 'height',
						'value'      => ''
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Align','globax'),
						'param_name' => 'align',
						'value'      => $align_values
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Animate','globax'),
						'param_name' => 'animate',
						'value'      => $logic_values
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Animation delay','globax'),
						'param_name' => 'start_delay',
						'value'      => '',
						'dependency' => Array('element' => 'animate', 'value' => 'true')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Extra class','globax'),
						'param_name' => 'class',
						'value'      => ''
					),
				)
			));

	    /* separator icon
		---------------*/

	    	vc_map(array(
				'name'                    => esc_html__('Icon separator','globax'),
				'description'             => esc_html__('Use this element to separate content','globax'),
				'category'                => esc_html__('Enovathemes','globax'),
				'base'                    => 'et_separator_icon',
				'class'                   => 'et_separator_icon',
				'icon'                    => 'et_separator_icon',
				'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
						'param_name'=>'icon_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Icon size', 'globax'), 
						'value'     => $size_values_default
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Separator color','globax'),
						'param_name' => 'color_sep',
						'value'      => '#e0e0e0'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'param_name' => 'color_icon',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap from top (without any string)','globax'),
						'param_name' => 'top',
						'value'      => '24'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap from bottom (without any string)','globax'),
						'param_name' => 'bottom',
						'value'      => '24'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Separator width (without any string)','globax'),
						'param_name' => 'width',
						'value'      => '120'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Height (without any string, if you want 1px leave blank)','globax'),
						'param_name' => 'height',
						'value'      => '1'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Align','globax'),
						'param_name' => 'align',
						'value'      => $align_values
					),
				)
			));

		/* separator decorative
		---------------*/

	    	vc_map(array(
				'name'                    => esc_html__('Dottes separator','globax'),
				'description'             => esc_html__('Use this element to separate content','globax'),
				'category'                => esc_html__('Enovathemes','globax'),
				'base'                    => 'et_separator_dottes',
				'class'                   => 'et_separator_dottes',
				'icon'                    => 'et_separator_dottes',
				'params'                  => array(
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#e0e0e0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap from top (without any string)','globax'),
						'param_name' => 'top',
						'value'      => '24'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap from bottom (without any string)','globax'),
						'param_name' => 'bottom',
						'value'      => '24'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Align','globax'),
						'param_name' => 'align',
						'value'      => $align_values
					),
				)
			));

		/* gap
		---------------*/

	    	vc_map(array(
	    		'name'                    => esc_html__('Gap','globax'),
	    		'description'             => esc_html__('Insert space','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_gap',
	    		'class'                   => 'et_gap',
	    		'icon'                    => 'et_gap',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap size (without any string)','globax'),
						'param_name' => 'height',
						'value'      => '32'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens under 320px', 'globax'),
						'param_name' => 'hide320',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens under 479px', 'globax'),
						'param_name' => 'hide479',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens from 480px under 767px', 'globax'),
						'param_name' => 'hide480_767',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens under 639px', 'globax'),
						'param_name' => 'hide639',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens from 640px under 767px', 'globax'),
						'param_name' => 'hide640_767',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens under 767px', 'globax'),
						'param_name' => 'hide767',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens over 768px', 'globax'),
						'param_name' => 'hide768',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens from 768px under 1023px', 'globax'),
						'param_name' => 'hide768_1023',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens under 1023px', 'globax'),
						'param_name' => 'hide1023',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens over 1024px', 'globax'),
						'param_name' => 'hide1024',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens from 1024px under 1279px', 'globax'),
						'param_name' => 'hide1024_1279',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens under 1279px', 'globax'),
						'param_name' => 'hide1279',
						'value'      => '',
					),
					array(
	    				'type'       => 'checkbox',
						'group'      => esc_html__('Responsive visibility', 'globax'),
						'heading'    => esc_html__('hide for screens over 1280px', 'globax'),
						'param_name' => 'hide1280',
						'value'      => '',
					),
	    		)
	    	));

	    	vc_map(array(
	    		'name'                    => esc_html__('Gap inline','globax'),
	    		'description'             => esc_html__('Insert horizontal space','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_gap_inline',
	    		'class'                   => 'et_gap_inline',
	    		'icon'                    => 'et_gap_inline',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Gap size (without any string)','globax'),
						'param_name' => 'width',
						'value'      => '32'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => ''
					)
	    		)
	    	));

	    /* popup
		---------------*/

	    	vc_map(array(
	    		'name'                    => esc_html__('Popup message','globax'),
	    		'description'             => esc_html__('Insert popup message with icon','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_popup',
	    		'class'                   => 'et_popup',
	    		'icon'                    => 'et_popup',
	    		'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
						'param_name'=>'icon_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Icon size', 'globax'), 
						'value'     => $size_values_default
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Message', 'globax'),
						'param_name' => 'message',
						'value'      => 'Your popup message goes here',
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Message width (without any string)', 'globax'),
						'param_name' => 'message_width',
						'value'      => '320',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color', 'globax'),
						'param_name' => 'icon_color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Popup color', 'globax'),
						'param_name' => 'popup_color',
						'value'      => '#212121'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Direction', 'globax'),
						'param_name' => 'direction',
						'value'      => array(
							esc_html__('Left', 'globax')   => 'left',
							esc_html__('Right', 'globax')  => 'right',
							esc_html__('Top', 'globax')    => 'top',
							esc_html__('Bottom', 'globax') => 'bottom'
						)
					)
	    		)
	    	));

	    /* alert
		---------------*/

	    	vc_map(array(
	    		'name'                    => esc_html__('Alert','globax'),
	    		'description'             => esc_html__('Insert alert','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_alert',
	    		'class'                   => 'et_alert',
	    		'icon'                    => 'et_alert',
	    		'params'                  => array(
	    			array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Message type','globax'),
						'param_name' => 'type',
						'value'      => array(
							esc_html__('Note','globax')        => 'note',
							esc_html__('Success','globax')     => 'success',
							esc_html__('Warning','globax')     => 'warning',
							esc_html__('Error','globax')       => 'error',
							esc_html__('Information','globax') => 'information'
						)
					),
					array(
						'type'       => 'textarea',
						'param_name' => 'content',
						'value'      => 'Alert message content goes here'
					)
	    		)
	    	));

	    /* nav menu
		---------------*/

			$menus = get_registered_nav_menus();

	    	vc_map(array(
	    		'name'                    => esc_html__('Navigation menu','globax'), 'description'             => esc_html__('Insert navigation menu','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_menu',
	    		'class'                   => 'et_menu',
	    		'icon'                    => 'et_menu',
	    		'params'                  => array(
	    			array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Menu name','globax'),
						'param_name' => 'menu',
						'value'      => array_flip($menus),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu container','globax'),
						'param_name' => 'container',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu container class','globax'),
						'param_name' => 'container_class',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu container id','globax'),
						'param_name' => 'container_id',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu class','globax'),
						'param_name' => 'menu_class',
						'value'      => 'menu',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu id','globax'),
						'param_name' => 'menu_id',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu before','globax'),
						'param_name' => 'menu_before',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu after','globax'),
						'param_name' => 'menu_after',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu link before','globax'),
						'param_name' => 'menu_link_before',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Menu link after','globax'),
						'param_name' => 'menu_link_after',
						'value'      => '',
					)
	    		)
	    	));

	    /* social icons
		---------------*/

			foreach ($social_links_array as $social) {
				vc_add_param('et_social_icons', array(
					'type'       => 'textfield',
					'heading'    => ucfirst($social).' link',
					'param_name' => $social,
					'value'      => '',
					'weight' => 1
				));
			}

	    	vc_map(array(
				'name'                    => esc_html__('Social icons','globax'),
				'description'             => esc_html__('Use this element to add social service icons','globax'),
				'category'                => esc_html__('Enovathemes','globax'),
				'base'                    => 'et_social_icons',
				'class'                   => 'et_social_icons',
				'icon'                    => 'et_social_icons',
				'params'                  => array(
					array(
						'param_name'=>'target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						)
					),
					array(
						'param_name'=>'styling_original',
						'type'      => 'dropdown',
						'group'     => esc_html__('Styling','globax'), 
						'heading'   => esc_html__('Original styling', 'globax'), 
						'value'     => $logic_values
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color regular','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_color_reg',
						'value'      => '#616161',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color hover','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_color_hov',
						'value'      => '#212121',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color regular','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_back_color_reg',
						'value'      => '',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color hover','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_back_color_hov',
						'value'      => '',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color regular','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_border_color_reg',
						'value'      => '',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color hover','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_border_color_hov',
						'value'      => '',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border radius (without any string)','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_border_radius',
						'value'      => '0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border width (without any string)','globax'),
						'group'     => esc_html__('Styling','globax'), 
						'param_name' => 'icon_border_width',
						'value'      => '0',
						'dependency' => Array('element' => 'styling_original', 'value' => 'false')
					)
				)
			));

		/* social share
		---------------*/

	    	vc_map(array(
				'name'                    => esc_html__('Social share','globax'),
				'description'             => esc_html__('Use this element to add social share','globax'),
				'category'                => esc_html__('Enovathemes','globax'),
				'base'                    => 'et_social_share',
				'class'                   => 'et_social_share',
				'icon'                    => 'et_social_share',
				'params'                  => array(
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color regular','globax'),
						'param_name' => 'icon_color_reg',
						'value'      => '#616161'
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color hover','globax'),
						'param_name' => 'icon_color_hov',
						'value'      => '#fd8c40'
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color regular','globax'),
						'param_name' => 'icon_back_color_reg',
						'value'      => ''
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color hover','globax'),
						'param_name' => 'icon_back_color_hov',
						'value'      => ''
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color regular','globax'),
						'param_name' => 'icon_border_color_reg',
						'value'      => ''
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color hover','globax'),
						'param_name' => 'icon_border_color_hov',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border radius (without any string)','globax'),
						'param_name' => 'icon_border_radius',
						'value'      => '0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border width (without any string)','globax'),
						'param_name' => 'icon_border_width',
						'value'      => '0'
					)
				)
			));
    	
	    /* tweets
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Tweets','globax'),
	    		'description'             => esc_html__('Insert recent tweets','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_tweets',
	    		'class'                   => 'et_tweets',
	    		'icon'                    => 'et_tweets',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Enter the twitter ID','globax'),
						'param_name' => 'twitter_id',
						'value'      => ''
					),
					array(
						'param_name'=>'count',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Number of tweets', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5',
							'6'  => '6',
							'7'  => '7',
							'8'  => '8',
							'9'  => '9',
							'10'  => '10'
						)
					),
					array(
	    				'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'param_name' => 'icon_color',
						'value'      => '#fd8c40',
					),
					array(
	    				'type'       => 'colorpicker',
						'heading'    => esc_html__('Text color','globax'),
						'param_name' => 'text_color',
						'value'      => '',
					)
	    		)
	    	));

		/* mailchimp
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Mailchimp','globax'),
	    		'description'             => esc_html__('Insert mailchimp subscribe','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_mailchimp',
	    		'class'                   => 'et_mailchimp',
	    		'icon'                    => 'et_mailchimp',
	    		'params'                  => array(
	    			array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Align to the center', 'globax'),
						'param_name' => 'center',
						'value'      => '',
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Action','globax'),
						'param_name' => 'action',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Name','globax'),
						'param_name' => 'name',
						'value'      => '',
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Email field placeholder text','globax'),
						'param_name' => 'email_placeholder',
						'value'      => esc_html__('Enter your email','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button placeholder text','globax'),
						'param_name' => 'button_placeholder',
						'value'      => esc_html__('Subscribe','globax'),
					),
	    		)
	    	));

	    /* icon
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Icon','globax'),
	    		'description'             => esc_html__('Insert icon','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_icon',
	    		'class'                   => 'et_icon',
	    		'icon'                    => 'et_icon',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
	    			array(
						'param_name'=>'icon_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $size_values_extra,
						'std'       => 'medium'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'param_name' => 'icon_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color','globax'),
						'param_name' => 'icon_back_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color','globax'),
						'param_name' => 'icon_border_color',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border radius (without any string)','globax'),
						'param_name' => 'icon_border_radius',
						'value'      => '0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border width (without any string)','globax'),
						'param_name' => 'icon_border_width',
						'value'      => '0'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Animate','globax'),
						'param_name' => 'animate',
						'value'      => array(
							esc_html__('false','globax')  => 'false',
							esc_html__('true','globax')   => 'true'
						)
					),
	    		)
	    	));
	
		/* icon list
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Icon list','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'description'             => esc_html__('Insert icon list','globax'),
	    		'base'                    => 'et_icon_list',
	    		'class'                   => 'et_icon_list',
	    		'icon'                    => 'et_icon_list',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
	    			array(
						'param_name'=>'icon_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $size_values_default,
						'std'       => 'small'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'param_name' => 'icon_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color','globax'),
						'param_name' => 'icon_back_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color','globax'),
						'param_name' => 'icon_border_color',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border radius (without any string)','globax'),
						'param_name' => 'icon_border_radius',
						'value'      => '0'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border width (without any string)','globax'),
						'param_name' => 'icon_border_width',
						'value'      => '0'
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('List items','globax'),
						'param_name' => 'content',
						'value'      => '',
						'description' => esc_html__('Use line break (press Enter) to separate between items','globax'),
					),
	    		)
	    	));
	
	    /* button
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Button','globax'),
	    		'description'             => esc_html__('Insert button','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_button',
	    		'class'                   => 'et_button',
	    		'icon'                    => 'et_button',
	    		'params'                  => array(

	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button text','globax'),
						'param_name' => 'button_text',
						'value'      => '',
					),

					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button link','globax'),
						'param_name' => 'button_link',
						'value'      => '',
					),
					array(
						'param_name'=>'target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						)
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Open link in modal window?', 'globax'),
						'param_name' => 'button_link_modal',
						'value'      => '',
					),
	    			array(
						'param_name'=>'button_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Button size', 'globax'), 
						'value'     => $size_values_default,
						'std'       => 'medium'
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button font size (without any string)','globax'),
						'group'      => esc_html__('Typography','globax'),
						'param_name' => 'button_font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'button_font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Button font weight (without any string)', 'globax'),
						'group'      => esc_html__('Typography','globax'),
						'value'     => array(
							'100'  => '100', 
							'200'  => '200', 
							'300'  => '300', 
							'400'  => '400', 
							'500'  => '500', 
							'600'  => '600', 
							'700'   => '700', 
							'800'   => '800', 
							'900'   => '900',
						),
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button letter spacing (without any string)','globax'),
						'group'      => esc_html__('Typography','globax'),
						'param_name' => 'button_letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Theme button','globax'),
						'description'=> esc_html__('If you want to use theme core button with predefined styling toggle this checkbox','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'theme_button',
						'value'      => $logic_values
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button background color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_back_color',
						'value'      => '',
						'dependency' => Array('element' => 'theme_button', 'value' => 'false')
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button border color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_border_color',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button border radius (without any string)','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_border_radius',
						'value'      => '0',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button border width (without any string)','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_border_width',
						'value'      => '0',
						'dependency' => Array('element' => 'theme_button', 'value' => 'false')
					),

					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Button shadow ?', 'globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_shadow',
						'value'      => '',
						'dependency' => Array('element' => 'theme_button', 'value' => 'false')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),

					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Icon position','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_position',
						'value'      => array(
							esc_html__('Left','globax')  => 'left',
							esc_html__('Right','globax')  => 'right',
						)
					),

					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color hover','globax'),
						'group'      => esc_html__('Hover','globax'),
						'param_name' => 'button_color_hover',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button background color hover','globax'),
						'group'      => esc_html__('Hover','globax'),
						'param_name' => 'button_back_color_hover',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button border color hover','globax'),
						'group'      => esc_html__('Hover','globax'),
						'param_name' => 'button_border_color_hover',
						'value'      => '',
						'dependency' => Array('element' => 'theme_button', 'value' => 'false')
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Hover animation','globax'),
						'group'      => esc_html__('Hover','globax'),
						'param_name' => 'animate_hover',
						'value'      => array(
							esc_html__('None','globax')  => 'none',
							esc_html__('Fill','globax')  => 'fill',
							esc_html__('Glint','globax') => 'glint',
							esc_html__('Scale','globax') => 'scale',
						),
						'dependency' => Array('element' => 'theme_button', 'value' => 'false')
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Click animation','globax'),
						'group'      => esc_html__('Click','globax'),
						'param_name' => 'animate_click',
						'value'      => array(
							esc_html__('None','globax')  => 'none',
							esc_html__('Material','globax')  => 'material',
						),
						'dependency' => Array('element' => 'theme_button', 'value' => 'false')
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Smooth Click animation','globax'),
						'group'      => esc_html__('Click','globax'),
						'param_name' => 'click_smooth',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => '',
					),
	    		)
	    	));
	
		/* line-button
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Line button','globax'),
	    		'description'             => esc_html__('Insert line button','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_line_button',
	    		'class'                   => 'et_line_button',
	    		'icon'                    => 'et_line_button',
	    		'params'                  => array(

	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button text','globax'),
						'param_name' => 'button_text',
						'value'      => '',
					),

					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button link','globax'),
						'param_name' => 'button_link',
						'value'      => '',
					),
					array(
						'param_name'=>'target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						)
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Open link in modal window?', 'globax'),
						'param_name' => 'button_link_modal',
						'value'      => '',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button line color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_line_color',
						'value'      => '',
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Smooth Click animation','globax'),
						'group'      => esc_html__('Click','globax'),
						'param_name' => 'click_smooth',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => '',
					),
	    		)
	    	));

	    /* inline button
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Inline button','globax'),
	    		'description'             => esc_html__('Insert button','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_inline_button',
	    		'class'                   => 'et_inline_button',
	    		'icon'                    => 'et_inline_button',
	    		'params'                  => array(

	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button text','globax'),
						'param_name' => 'button_text',
						'value'      => '',
					),

					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button link','globax'),
						'param_name' => 'button_link',
						'value'      => '',
					),
					array(
						'param_name'=>'target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						)
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Open link in modal window?', 'globax'),
						'param_name' => 'button_link_modal',
						'value'      => '',
					),
	    			
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color hover','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'button_color_hover',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Icon position','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_position',
						'value'      => array(
							esc_html__('Left','globax')  => 'left',
							esc_html__('Right','globax')  => 'right',
						)
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Smooth Click animation','globax'),
						'group'      => esc_html__('Click','globax'),
						'param_name' => 'click_smooth',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Custom class','globax'),
						'param_name' => 'custom_class',
						'value'      => '',
					),
	    		)
	    	));

	    /* carousel
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Carousel','globax'),
	    		'description'             => esc_html__('Insert carousel with any content you want','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_carousel',
	    		'class'                   => 'et_carousel',
	    		'icon'                    => 'et_carousel',
	    		'is_container'            => true,
		    	'content_element'         => true,
	    		'js_view'                 => 'VcColumnView',
	    		'as_parent'               => array('only' => 'et_carousel_item'),
	    		'params'                  => array(
					array(
						'param_name'=>'item_column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5',
							'6'  => '6',
							'7'  => '7',
							'8'  => '8',
							'9'  => '9',
							'10' => '10'
						)
					),
					array(
						'param_name'=>'item_gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Gap', 'globax'), 
						'value'     => $gap_values
					),
					array(
						'param_name'=>'navigation_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Navigation type', 'globax'), 
						'value'     => array(
							esc_html__('Only arrows','globax')  => 'only-arrows',
							esc_html__('Only dottes','globax')  => 'only-dottes',
							esc_html__('Both arrows and dottes','globax')  => 'both'
						)
					),
					array(
						'param_name'=>'autoplay',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Autoplay', 'globax'), 
						'value'     => $logic_values
					),
	    		)
	    	));

	    	vc_map(array(
	    		'name'                    => 'Carousel item',
	    		'description'             => esc_html__('Insert carousel item','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_carousel_item',
	    		'class'                   => 'et_carousel_item',
	    		'icon'                    => 'et_carousel_item',
		    	'content_element'         => true,
	    		'as_child'               => array('only' => 'et_carousel'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
				"js_view"                 => 'VcColumnView',
	    		'params'                  => array()
	    	));

	    /* image
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Image','globax'),
	    		'description'             => esc_html__('Insert single image','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_image',
	    		'class'                   => 'et_image',
	    		'icon'                    => 'et_image',
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => '',
					),
	    			array(
						'param_name'=>'size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $image_size_values
					),
	    			array(
	    				'type'       => 'dropdown',
						'heading'    => esc_html__('Caption', 'globax'),
						'param_name' => 'caption',
						'value'      => $logic_values,
						'description'=> esc_html__('Check this option if you want to have caption on image. Make sure Title is not empty', 'globax'),
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Link to','globax'),
						'param_name' => 'link',
						'value'      => array(
							esc_html__('None','globax')       => 'none',
							esc_html__('Attachment','globax') => 'attach',
							esc_html__('Lightbox','globax')   => 'lightbox',
							esc_html__('Custom','globax')     => 'custom',
						)
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Modal', 'globax'),
						'param_name' => 'modal',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to open the link content in modal box.', 'globax'),
						'dependency' => Array('element' => 'link', 'value' => 'custom')
					),
					array(
						'param_name'=>'link_target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Link target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						),
						'dependency' => Array('element' => 'link', 'value' => 'custom')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Image custom link','globax'),
						'param_name' => 'custom_link',
						'value'      => '',
						'dependency' => Array('element' => 'link', 'value' => 'custom')
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Hover','globax'),
						'param_name' => 'overlay',
						'value'      => $image_overlay_values,
						'dependency' => Array(
							'element' => 'link', 'value' => array('attach','lightbox','custom'),
							'element' => 'caption', 'value' => 'false'
						)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Hover','globax'),
						'param_name' => 'overlay_caption',
						'value'      => $image_caption_values,
						'dependency' => Array(
							'element' => 'link', 'value' => array('attach','lightbox','custom'),
							'element' => 'caption', 'value' => 'true'
						)
					),
					array(
						'param_name'=>'alignment',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Alignment', 'globax'),
						'value'     => array(
							esc_html__('None','globax')   => 'none', 
							esc_html__('Left','globax')   => 'left', 
							esc_html__('Right','globax')  => 'right', 
							esc_html__('Center','globax') => 'center'
						)
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Parallax','globax'),
						'group'      => esc_html__('Transform','globax'),
						'param_name' => 'parallax',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Parallax X coordinate','globax'),
						'group'      => esc_html__('Transform','globax'),
						'param_name' => 'parallax_x',
						'value'      => '0',
						'dependency' => Array(
							'element' => 'parallax', 'value' => 'true'
						)
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Parallax Y coordinate','globax'),
						'group'      => esc_html__('Transform','globax'),
						'param_name' => 'parallax_y',
						'value'      => '0',
						'dependency' => Array(
							'element' => 'parallax', 'value' => 'true'
						)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Parallax speed radtio','globax'),
						'group'      => esc_html__('Transform','globax'),
						'description'=> esc_html__('The more the value is the slower the parallax effect is','globax'),
						'param_name' => 'parallax_speed',
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5',
							'6'  => '6',
							'7'  => '7',
							'8'  => '8',
							'9'  => '9',
							'10' => '10',
							'11' => '11',
							'12' => '12',
							'13' => '13',
							'14' => '14',
							'15' => '15',
							'16' => '16',
							'17' => '17',
							'18' => '18',
							'19' => '19',
							'20' => '20'
						),
						'dependency' => Array(
							'element' => 'parallax', 'value' => 'true'
						)
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Curtain effect','globax'),
						'group'      => esc_html__('Curtain effect','globax'),
						'param_name' => 'curtain',
						'value'      => ''
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Curtain direction','globax'),
						'group'      => esc_html__('Curtain effect','globax'),
						'param_name' => 'curtain_direction',
						'value'      => array(
							esc_html__('Left to Right','globax') => 'left',
							esc_html__('Right to Left','globax') => 'right',
							esc_html__('Top to bottom','globax') => 'top',
							esc_html__('Bottom to top','globax') => 'bottom',
						),
						'dependency' => Array(
							'element' => 'curtain', 'value' => 'true'
						)
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Curtain color','globax'),
						'group'      => esc_html__('Curtain effect','globax'),
						'param_name' => 'curtain_color',
						'value'      => '#fd8c40',
						'dependency' => Array(
							'element' => 'curtain', 'value' => 'true'
						)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__( 'Animation delay in ms (example 300)', 'globax' ),
						'group'      => esc_html__('Curtain effect','globax'),
						'param_name' => 'curtain_animation_delay',
						'value'      => $animation_delay_values,
						'dependency' => Array(
							'element' => 'curtain', 'value' => 'true'
						)
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Image preloader','globax'),
						'param_name' => 'preloader',
						'value'      => ''
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Image decoration','globax'),
						'param_name' => 'decoration',
						'value'      => ''
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Image decoration size','globax'),
						'param_name' => 'decoration_size',
						'value'      => array(
							esc_html__('Small','globax') => 'small',
							esc_html__('Large','globax') => 'large'
						),
						'dependency' => Array(
							'element' => 'decoration', 'value' => 'true'
						)
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Extra class','globax'),
						'param_name' => 'class',
						'value'      => ''
					)
	    		)
	    	));
	
		/* gallery
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Simple gallery','globax'),
	    		'description'             => esc_html__('Insert image gallery','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_gallery',
	    		'class'                   => 'et_gallery',
	    		'icon'                    => 'et_gallery',
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_images',
						'heading'    => esc_html__('Upload images','globax'),
						'param_name' => 'gallery_images',
					),
					array(
	    				'type'       => 'dropdown',
						'heading'    => esc_html__('Gallery type', 'globax'),
						'param_name' => 'gallery_type',
						'value'      => array(
							esc_html__('Grid/Masonry','globax') => 'grid',
							esc_html__('Carousel','globax')     => 'carousel',
						)
					),
	    			array(
						'param_name'=>'gallery_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $image_size_values,
						'dependency' => Array(
							'element' => 'gallery_type', 'value' => array('grid','carousel'),
						)
					),
	    			array(
	    				'type'       => 'dropdown',
						'heading'    => esc_html__('Caption', 'globax'),
						'param_name' => 'gallery_caption',
						'value'      => $logic_values,
						'description'=> esc_html__('Check this option if you want to have caption on image', 'globax'),
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Link to','globax'),
						'param_name' => 'gallery_link',
						'value'      => array(
							esc_html__('None','globax')       => 'none',
							esc_html__('Attachment','globax') => 'attach',
							esc_html__('Lightbox','globax')   => 'lightbox',
						)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Hover','globax'),
						'param_name' => 'gallery_overlay',
						'value'      => $image_overlay_values,
						'dependency' => Array(
							'element' => 'gallery_link', 'value' => array('attach','lightbox'),
							'element' => 'gallery_caption', 'value' => 'false'
						)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Hover','globax'),
						'param_name' => 'gallery_overlay_caption',
						'value'      => $image_caption_values,
						'dependency' => Array(
							'element' => 'gallery_link', 'value' => array('attach','lightbox'),
							'element' => 'gallery_caption','value' => 'true'
						)
					),
					array(
						'param_name'=>'gallery_animation_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Animation type', 'globax'), 
						'value'     => array(
							esc_html__('Sequential','globax')  => 'sequential',
							esc_html__('Random','globax')      => 'random'
						),
						'dependency' => Array(
							'element' => 'gallery_type', 'value' => array('grid','justified'),
						)
					),
	    			array(
						'param_name'=>'gallery_animation_effect',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Animation effect', 'globax'),
						'value'     => $animation_values,
						'dependency' => Array(
							'element' => 'gallery_type', 'value' => array('grid','justified'),
						)
					),
					array(
						'param_name'=>'gallery_column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5',
							'6'  => '6',
							'7'  => '7',
							'8'  => '8',
							'9'  => '9',
							'10' => '10'
						),
						'dependency' => Array(
							'element' => 'gallery_type', 'value' => array('grid','carousel'),
						)
					),
					array(
						'param_name'=>'gallery_gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Gap', 'globax'), 
						'value'     => $gap_values
					),
	    		)
	    	));
	
		/* image slider
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Image slider','globax'),
	    		'description'             => esc_html__('Insert image slider','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_image_slider',
	    		'class'                   => 'et_image_slider',
	    		'icon'                    => 'et_image_slider',
	    		'js_view'                 => '',
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_images',
						'heading'    => esc_html__('Upload images','globax'),
						'param_name' => 'slider_images',
					),
	    			array(
						'param_name'=>'slider_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Image Size', 'globax'), 
						'value'     => $image_size_values
					),
					array(
						'param_name'=>'slider_column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5',
							'6'  => '6'
						)
					),
					array(
						'param_name'=>'slider_gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Gap', 'globax'), 
						'value'     => $gap_values,
						'dependency' => Array('element' => 'slider_column', 'value' => array('2','3','4','5','6'))
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Include thumbnails', 'globax'),
						'param_name' => 'slider_thumbnails',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to have slider thumbnails', 'globax'),
						'dependency' => Array('element' => 'slider_column', 'value' => '1')
					)
	    		)
	    	));

		/* image with content
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Image with content','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'description'             => esc_html__('Insert single image with content on hover','globax'),
	    		'base'                    => 'et_image_content',
	    		'class'                   => 'et_image_content',
	    		'icon'                    => 'et_image',
	    		'content_element'         => true,
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
	    		"js_view"                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
	    			array(
						'param_name'=>'size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $image_size_values
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Overlay','globax'),
						'param_name' => 'overlay',
						'value'      => array(
							esc_html__('Overlay fade','globax') 						 => 'overlay-fade',
							esc_html__('Overlay fade with image zoom','globax')         => 'overlay-fade-zoom',
							esc_html__('Overlay fade with extreme image zoom','globax') => 'overlay-fade-zoom-extreme',
							esc_html__('Overlay move up','globax')    				     => 'overlay-move-up',
							esc_html__('Overlay move down','globax')  				     => 'overlay-move-down',
							esc_html__('Overlay move left','globax')  				     => 'overlay-move-left',
							esc_html__('Overlay move right','globax') 				     => 'overlay-move-right',
							esc_html__('Image move up','globax')      				     => 'image-move-up',
							esc_html__('Image move down','globax')    				     => 'image-move-down',
							esc_html__('Image move left','globax')    				     => 'image-move-left',
							esc_html__('Image move right','globax')   				     => 'image-move-right',
							esc_html__('Overlay and image move up','globax')            => 'overlay-image-move-up',
							esc_html__('Overlay and image move down','globax')          => 'overlay-image-move-down',
							esc_html__('Overlay and image move left','globax')          => 'overlay-image-move-left',
							esc_html__('Overlay and image move right','globax')         => 'overlay-image-move-right',
							esc_html__('Overlay move fluid','globax')                   => 'overlay-move',
							esc_html__('Overlay scale in','globax')                     => 'overlay-scale-in',
							esc_html__('Overlay flip horizontal','globax')        	     => 'overlay-flip-hor',
							esc_html__('Overlay flip vertical','globax')          	     => 'overlay-flip-ver',
						),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Overlay color','globax'),
						'param_name' => 'color',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Image link','globax'),
						'param_name' => 'link',
						'value'      => '',
					),
					array(
						'param_name'=>'link_target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Link target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						),
						'dependency' => Array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Text align','globax'),
						'param_name' => 'align',
						'value'      => $align_values
					),
	    		)
	    	));

		/* image with content alt
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Image with content alternative','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'description'             => esc_html__('Insert single image service box','globax'),
	    		'base'                    => 'et_image_content_alt',
	    		'class'                   => 'et_image_content_alt',
	    		'icon'                    => 'et_image',
	    		'content_element'         => true,
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
	    		"js_view"                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
	    			array(
						'param_name'=>'size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $image_size_values
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Overlay color','globax'),
						'param_name' => 'color',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Image link','globax'),
						'param_name' => 'link',
						'value'      => '',
					),
					array(
						'param_name'=>'link_target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Link target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						),
						'dependency' => Array('element' => 'link', 'not_empty' => true)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Text align','globax'),
						'param_name' => 'align',
						'value'      => $align_values
					),
	    		)
	    	));

		/* youtube
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Youtube','globax'),
	    		'description'             => esc_html__('Insert youtube videos','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_youtube',
	    		'class'                   => 'et_youtube',
	    		'icon'                    => 'et_youtube',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Video ID','globax'),
						'param_name' => 'id',
						'value'      => '',
						'description' => esc_html__('For example https://www.youtube.com/watch?v=KDOLHClNTOI (Use video id after watch?v=)','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Width optional (without any string)','globax'),
						'param_name' => 'width',
						'value'      => ''
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Modal','globax'),
						'param_name' => 'modal',
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload modal image','globax'),
						'param_name' => 'src',
						'value'      => '',
						'dependency' => Array('element' => 'modal', 'value' => 'true')
					),
					array(
						'param_name'=>'size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Modal image size', 'globax'), 
						'value'     => $image_size_values,
						'dependency' => Array('element' => 'modal', 'value' => 'true')
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Custom modal video player image','globax'),
						'param_name' => 'player_image',
						'value'      => '',
						'dependency' => Array('element' => 'modal', 'value' => 'true')
					)
	    		)
	    	));

		/* vimeo
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Vimeo','globax'),
	    		'description'             => esc_html__('Insert vimeo videos','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_vimeo',
	    		'class'                   => 'et_vimeo',
	    		'icon'                    => 'et_vimeo',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Video ID','globax'),
						'param_name' => 'id',
						'value'      => '',
						'description' => esc_html__('For example http://vimeo.com/5121526 (Use video id after last /','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Width optional (without any string)','globax'),
						'param_name' => 'width',
						'value'      => ''
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Modal','globax'),
						'param_name' => 'modal',
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload modal image','globax'),
						'param_name' => 'src',
						'value'      => '',
						'dependency' => Array('element' => 'modal', 'value' => 'true')
					),
					array(
						'param_name'=>'size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Modal image size', 'globax'), 
						'value'     => $image_size_values,
						'dependency' => Array('element' => 'modal', 'value' => 'true')
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Custom modal video player image','globax'),
						'param_name' => 'player_image',
						'value'      => '',
						'dependency' => Array('element' => 'modal', 'value' => 'true')
					)
	    		)
	    	));

		/* soundcloud
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Soundcloud', 'globax'),
	    		'description'             => esc_html__('Insert soundcloud audio','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_soundcloud',
	    		'class'                   => 'et_soundcloud',
	    		'icon'                    => 'et_soundcloud',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Url','globax'),
						'param_name' => 'url',
						'value'      => '',
						'description' => esc_html__('For example api.soundcloud.com/tracks/151325062','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Width (optional)','globax'),
						'param_name' => 'width',
						'value'      => '100%'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Height (optional)','globax'),
						'param_name' => 'height',
						'value'      => '166'
					)
	    		)
	    	));

		/* googlemap
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Google map','globax'),
	    		'description'             => esc_html__('Inser google map','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_gmap',
	    		'class'                   => 'et_gmap',
	    		'icon'                    => 'et_gmap',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Google map zoom level (from 1 to 19 without any string)','globax'),
						'param_name' => 'zoom',
						'value'      => '18'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Type','globax'),
						'param_name' => 'type',
						'value'      => array(
							esc_html__('Roadmap','globax')    => 'roadmap',
							esc_html__('Satellite','globax')  => 'satellite',
							esc_html__('Black','globax')      => 'black',
							esc_html__('Grey','globax')      => 'grey',
						)
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Width','globax'),
						'param_name' => 'width',
						'value'      => '100%'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Height','globax'),
						'param_name' => 'height',
						'value'      => '480px'
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload custom marker','globax'),
						'param_name' => 'marker',
						'value'      => ''
					),
					array(
	    				'type'       => 'dropdown',
						'heading'    => esc_html__('Animate marker','globax'),
						'param_name' => 'animate',
						'value'      => array('false'=>'false','true'=>'true')
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('X coordinate','globax'),
						'group'       => esc_html__('Location 1','globax'),
						'param_name'  => 'x_coords_1',
						'value'       => '',
						'description' => esc_html__('Use latitude coordinate for example 53.339381','globax'),
					),
	    			array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Y coordinate','globax'),
						'group'       => esc_html__('Location 1','globax'),
						'param_name'  => 'y_coords_1',
						'value'       => '',
						'description' => esc_html__('Use longitude coordinate for example -6.260405','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'group'       => esc_html__('Location 1','globax'),
						'param_name' => 'title_1',
						'value'      => ''
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Image','globax'),
						'group'       => esc_html__('Location 1','globax'),
						'param_name' => 'image_1',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'group'       => esc_html__('Location 1','globax'),
						'param_name' => 'content_1',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('X coordinate','globax'),
						'group'       => esc_html__('Location 2','globax'),
						'param_name'  => 'x_coords_2',
						'value'       => '',
						'description' => esc_html__('Use latitude coordinate for example 53.339381','globax'),
					),
	    			array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Y coordinate','globax'),
						'group'       => esc_html__('Location 2','globax'),
						'param_name'  => 'y_coords_2',
						'value'       => '',
						'description' => esc_html__('Use longitude coordinate for example -6.260405','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'group'       => esc_html__('Location 2','globax'),
						'param_name' => 'title_2',
						'value'      => ''
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Image','globax'),
						'group'       => esc_html__('Location 2','globax'),
						'param_name' => 'image_2',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'group'       => esc_html__('Location 2','globax'),
						'param_name' => 'content_2',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('X coordinate','globax'),
						'group'       => esc_html__('Location 3','globax'),
						'param_name'  => 'x_coords_3',
						'value'       => '',
						'description' => esc_html__('Use latitude coordinate for example 53.339381','globax'),
					),
	    			array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Y coordinate','globax'),
						'group'       => esc_html__('Location 3','globax'),
						'param_name'  => 'y_coords_3',
						'value'       => '',
						'description' => esc_html__('Use longitude coordinate for example -6.260405','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'group'       => esc_html__('Location 3','globax'),
						'param_name' => 'title_3',
						'value'      => ''
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Image','globax'),
						'group'       => esc_html__('Location 3','globax'),
						'param_name' => 'image_3',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'group'       => esc_html__('Location 3','globax'),
						'param_name' => 'content_3',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('X coordinate','globax'),
						'group'       => esc_html__('Location 4','globax'),
						'param_name'  => 'x_coords_4',
						'value'       => '',
						'description' => esc_html__('Use latitude coordinate for example 53.339381','globax'),
					),
	    			array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Y coordinate','globax'),
						'group'       => esc_html__('Location 4','globax'),
						'param_name'  => 'y_coords_4',
						'value'       => '',
						'description' => esc_html__('Use longitude coordinate for example -6.260405','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'group'       => esc_html__('Location 4','globax'),
						'param_name' => 'title_4',
						'value'      => ''
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Image','globax'),
						'group'       => esc_html__('Location 4','globax'),
						'param_name' => 'image_4',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'group'       => esc_html__('Location 4','globax'),
						'param_name' => 'content_4',
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('X coordinate','globax'),
						'group'       => esc_html__('Location 5','globax'),
						'param_name'  => 'x_coords_5',
						'value'       => '',
						'description' => esc_html__('Use latitude coordinate for example 53.339381','globax'),
					),
	    			array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Y coordinate','globax'),
						'group'       => esc_html__('Location 5','globax'),
						'param_name'  => 'y_coords_5',
						'value'       => '',
						'description' => esc_html__('Use longitude coordinate for example -6.260405','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'group'       => esc_html__('Location 5','globax'),
						'param_name' => 'title_5',
						'value'      => ''
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Image','globax'),
						'group'       => esc_html__('Location 5','globax'),
						'param_name' => 'image_5',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'group'       => esc_html__('Location 5','globax'),
						'param_name' => 'content_5',
					),
	    		)
	    	));

		/* counter
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Counter','globax'),
	    		'description'             => esc_html__('Insert number counter','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_counter',
	    		'class'                   => 'et_counter',
	    		'icon'                    => 'et_counter',
	    		'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Number','globax'),
						'param_name' => 'number',
						'value'      => '',
						'description' => esc_html__('Insert an integer value to count to','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Number prefix','globax'),
						'param_name' => 'number_prefix',
						'value'      => '',
						'description' => esc_html__('Insert any prefix you want %,$, etc.','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '56',
					),
					array(
						'param_name'=>'font_weight',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Font weight (without any string)', 'globax'), 
						'value'     => array(
							'100'  => '100', 
							'200'  => '200', 
							'300'  => '300', 
							'400'  => '400', 
							'500'  => '500', 
							'600'  => '600', 
							'700'   => '700', 
							'800'   => '800', 
							'900'   => '900',
						),
						'std' => '700'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => '56'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#fd8c40'
					)
	    		)
	    	));

		/* progress
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Progress','globax'),
	    		'description'             => esc_html__('Insert progress bar','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_progress',
	    		'class'                   => 'et_progress',
	    		'icon'                    => 'et_progress',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Percentage','globax'),
						'param_name' => 'percentage',
						'value'      => '',
						'description' => esc_html__('Only integer value, without any string','globax'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Bar Color','globax'),
						'param_name' => 'bar_color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Track Color','globax'),
						'param_name' => 'track_color',
						'value'      => '#e0e0e0'
					)
	    		)
	    	));

		/* circle progress
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Circle progress','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'description'             => esc_html__('Insert circle progress','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_circle_progress',
	    		'class'                   => 'et_circle_progress',
	    		'icon'                    => 'et_circle_progress',
	    		'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Percentage','globax'),
						'param_name' => 'percentage',
						'value'      => '',
						'description' => esc_html__('Only integer value, without any string','globax'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Bar Color','globax'),
						'param_name' => 'bar_color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Track Color','globax'),
						'param_name' => 'track_color',
						'value'      => '#e0e0e0'
					)
	    		)
	    	));

		/* timer
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Timer','globax'),
	    		'description'             => esc_html__('Insert timer','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_timer',
	    		'class'                   => 'et_timer',
	    		'icon'                    => 'et_timer',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('End date to count to','globax'),
						'param_name' => 'enddate',
						'value'      => '',
						'description' => esc_html__('Use format : June 7, 2025 15:03:25','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Days label','globax'),
						'param_name' => 'days',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Hours label','globax'),
						'param_name' => 'hours',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Minutes label','globax'),
						'param_name' => 'minutes',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Seconds label','globax'),
						'param_name' => 'seconds',
						'value'      => ''
					),
	    		)
	    	));

		/* accordion
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Accordion','globax'),
	    		'description'             => esc_html__('Insert accordion','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_accordion',
	    		'class'                   => 'et_accordion',
	    		'icon'                    => 'et_accordion',
	    		'as_parent'               => array('only' => 'et_accordion_item'),
	    		'content_element'         => true,
	    		'is_container'            => true,
	    		'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Collapsible','globax'),
						'param_name' => 'collapsible',
						'value'      => $logic_values
					),
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Accordion item','globax'),
	    		'base'                    => 'et_accordion_item',
	    		'icon'                    => 'et_accordion_item',
	    		'as_child'                => array('only' => 'et_accordion'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
	    		'content_element'         => true,
				"js_view"                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Open','globax'),
						'param_name' => 'open',
						'value'      => $logic_values
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
	    		)
	    	));

		/* tab
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Tab','globax'),
	    		'description'             => esc_html__('Insert tab','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_tab',
	    		'class'                   => 'et_tab',
	    		'icon'                    => 'et_tab',
	    		'as_parent'               => array('only' => 'et_tab_item'),
	    		'content_element'         => true,
	    		'is_container'            => true,
	    		'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Type','globax'),
						'param_name' => 'type',
						'value'      => array(
							esc_html__('Horizontal','globax')  => 'horizontal',
							esc_html__('Vertical','globax')  => 'vertical',
						)
					),
					array(
						'type'       => 'checkbox',
						'heading'    => esc_html__('Tabs center','globax'),
						'param_name' => 'center',
					),
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Tab item','globax'),
	    		'base'                    => 'et_tab_item',
	    		'icon'                    => 'et_tab_item',
	    		'as_child'                => array('only' => 'et_tab'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
				"js_view"                 => 'VcColumnView',
	    		'content_element'         => true,
	    		'params'                  => array(
	    			array(
						'type'       => 'dropdown',
						
						'heading'    => esc_html__('Active','globax'),
						'param_name' => 'active',
						'value'      => array(
							'false' => 'false',
							'true'  => 'true'
						)
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
	    		)
	    	));

		/* timeline
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Timeline','globax'),
	    		'description'             => esc_html__('Insert timeline','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_timeline',
	    		'class'                   => 'et_timeline',
	    		'icon'                    => 'et_timeline',
	    		'as_parent'               => array('only' => 'et_timeline_item'),
	    		'content_element'         => true,
	    		'is_container'            => true,
	    		'js_view'                 => 'VcColumnView',
	    		'params'                  => ''
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Timeline item','globax'),
	    		'base'                    => 'et_timeline_item',
	    		'icon'                    => 'et_timeline_item',
	    		'as_child'                => array('only' => 'et_timeline'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
	    		'content_element'         => true,
				"js_view"                 => 'VcColumnView',
	    		'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
	    		)
	    	));

		/* process
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Process','globax'),
	    		'description'             => esc_html__('Insert step-by-step process','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_process',
	    		'class'                   => 'et_process',
	    		'icon'                    => 'et_process',
	    		'as_parent'               => array('only' => 'et_process_item'),
	    		'content_element'         => true,
	    		'is_container'            => true,
	    		'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'param_name'=>'columns',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'2'  => '2',
							'3'  => '3',
							'4'  => '4'
						)
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Color','globax'),
						'param_name' => 'color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Animate','globax'),
						'param_name' => 'animate',
						'value'      => $logic_values
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Animation effect','globax'),
						'param_name' => 'animate_effect',
						'value'      => $animation_values,
						'dependency' => Array('element' => 'animate', 'value' => "true")
					)
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Process item','globax'),
	    		'base'                    => 'et_process_item',
	    		'icon'                    => 'et_process_item',
	    		'as_child'                => array('only' => 'et_process'),
	    		'content_element'         => true,
	    		'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
	    		)
	    	));

		/* person
		---------------*/

			foreach ($social_links_array as $social) {

				if($social != 'tripadvisor') {

					vc_add_param('et_person', array(
						'type'       => 'textfield',
						'heading'    => ucfirst($social).' link',
						'param_name' => $social,
						'value'      => '',
						'weight'     => 0
					));

				}
			}

			vc_map(array(
	    		'name'                    => esc_html__('Person','globax'),
	    		'description'             => esc_html__('Insert person','globax'),
	    		'base'                    => 'et_person',
	    		'icon'                    => 'et_person',
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Subtitle','globax'),
						'param_name' => 'subtitle',
						'value'      => ''
					)
	    		)
	    	));

	    /* person alt
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Person alternative','globax'),
	    		'description'             => esc_html__('Insert person','globax'),
	    		'base'                    => 'et_person_alt',
	    		'icon'                    => 'et_person',
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Email','globax'),
						'param_name' => 'email',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'param_name' => 'text',
						'value'      => ''
					),
	    		)
	    	));

		/* testimonial
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Testimonial','globax'),
	    		'description'             => esc_html__('Insert testimonials','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_testimonial',
	    		'class'                   => 'et_testimonial',
	    		'icon'                    => 'et_testimonial',
	    		'content_element'         => true,
				'is_container'            => true,
	    		'as_parent'               => array('only' => 'et_testimonial_item'),
				'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
					array(
						'param_name'=>'navigation_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Navigation type', 'globax'), 
						'value'     => array(
							esc_html__('Only arrows','globax')  => 'only-arrows',
							esc_html__('Only dottes','globax')  => 'only-dottes',
							esc_html__('Both arrows and dottes','globax')  => 'both'
						),
					),
					array(
						'param_name'=>'column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
						)
					),
					array(
						'param_name'=>'gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Gap', 'globax'), 
						'value'     => $gap_values
					),
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Testimonial','globax'),
	    		'base'                    => 'et_testimonial_item',
	    		'icon'                    => 'et_testimonial_item',
	    		'as_child'                => array('only' => 'et_testimonial'),
	    		'content_element'         => true,
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Sub title','globax'),
						'param_name' => 'subtitle',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'param_name' => 'text',
					),
	    		)
	    	));

	    	vc_map(array(
	    		'name'                    => esc_html__('Testimonial alternative','globax'),
	    		'description'             => esc_html__('Insert testimonials','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_testimonial_alt',
	    		'class'                   => 'et_testimonial_alt',
	    		'icon'                    => 'et_testimonial',
	    		'content_element'         => true,
				'is_container'            => true,
	    		'as_parent'               => array('only' => 'et_testimonial_alt_item'),
				'js_view'                 => 'VcColumnView',
	    		'params'                  => ''
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Testimonial','globax'),
	    		'base'                    => 'et_testimonial_alt_item',
	    		'icon'                    => 'et_testimonial_item',
	    		'as_child'                => array('only' => 'et_testimonial_alt'),
	    		'content_element'         => true,
	    		'params'                  => array(
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'subtitle',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('Content','globax'),
						'param_name' => 'text',
					),
	    		)
	    	));

		/* clients
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Clients','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'description'             => esc_html__('Insert clients','globax'),
	    		'base'                    => 'et_client',
	    		'class'                   => 'et_client',
	    		'icon'                    => 'et_client',
	    		'content_element'         => true,
				'is_container'            => true,
	    		'as_parent'               => array('only' => 'et_client_item'),
				'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
	    			array(
						'param_name'=>'layout',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Layout', 'globax'), 
						'value'     => $layout_type_values
					),
					array(
						'param_name'=>'column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5',
							'6'  => '6',
							'7'  => '7',
							'8'  => '8',
							'9'  => '9',
							'10' => '10'
						)
					),
					array(
						'param_name'=>'gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Gap', 'globax'), 
						'value'     => $gap_values
					),
					array(
	    				'type'       => 'colorpicker',
						'heading'    => esc_html__('Client box background color','globax'),
						'param_name' => 'box_back',
						'value'      => '',
					),
					array(
	    				'type'       => 'colorpicker',
						'heading'    => esc_html__('Client box border color','globax'),
						'param_name' => 'box_border',
						'value'      => '',
					),
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Client','globax'),
	    		'base'                    => 'et_client_item',
	    		'icon'                    => 'et_client_item',
	    		'as_child'                => array('only' => 'et_client'),
	    		'content_element'         => true,
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Link','globax'),
						'param_name' => 'link',
						'value'      => ''
					),
					array(
						'param_name'=>'link_target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Link target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						)
					),
	    		)
	    	));

		/* tagline
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Tagline','globax'),
	    		'description'             => esc_html__('Insert tagline (call to action block with button)','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_tagline',
	    		'class'                   => 'et_tagline',
	    		'icon'                    => 'et_tagline',
	    		'js_view'                 => '',
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => 'Call to action title',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Tagline title color','globax'),
						'param_name' => 'title_color',
						'value'      => '#ffffff'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Tagline background color','globax'),
						'param_name' => 'back_color',
						'value'      => '#fd8c40'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button text','globax'),
						'group'      => esc_html__('Button','globax'),
						'param_name' => 'button_text',
						'value'      => 'Read more',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button link','globax'),
						'group'      => esc_html__('Button','globax'),
						'param_name' => 'button_link',
						'value'      => '#link',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color','globax'),
						'group'      => esc_html__('Button','globax'),
						'param_name' => 'button_color',
						'value'      => '#212121'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button background color','globax'),
						'group'      => esc_html__('Button','globax'),
						'param_name' => 'button_back_color',
						'value'      => '#ffffff'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button color hover','globax'),
						'group'      => esc_html__('Button','globax'),
						'param_name' => 'button_color_hover',
						'value'      => '#212121'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Button background color hover','globax'),
						'group'      => esc_html__('Button','globax'),
						'param_name' => 'button_back_color_hover',
						'value'      => '#ffffff'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon prefix','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_prefix',
						'value'      => '',
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax')
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax')
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'group'      => esc_html__('Icon','globax'),
						'param_name' => 'icon_color',
						'value'      => '#ffffff'
					),
	    		)
	    	));

		/* pricing table
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Pricing table','globax'),
	    		'description'             => esc_html__('Insert pricing table','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_pricing',
	    		'class'                   => 'et_pricing',
	    		'icon'                    => 'et_pricing',
	    		'content_element'         => true,
				'is_container'            => true,
				'as_parent'               => array('only' => 'et_pricing_item'),
				'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
					array(
						'param_name'=>'column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
							'5'  => '5'
						)
					),
					array(
						'param_name'=>'gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Columns gap', 'globax'), 
						'value'     => $gap_values,
						'std'       => '0'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Highlight color','globax'),
						'param_name' => 'highlight_color',
						'value'      => '#fd8c40'
					)
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Pricing table column','globax'),
	    		'base'                    => 'et_pricing_item',
	    		'icon'                    => 'et_pricing_item',
	    		'as_child'                => array('only' => 'et_pricing'),
	    		'content_element'         => true,
	    		'params'                  => array(
	    			array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Highlight', 'globax'),
						'param_name' => 'highlight',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Label','globax'),
						'param_name' => 'label',
						'value'      => ''
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Currency','globax'),
						'param_name' => 'currency',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Price','globax'),
						'param_name' => 'price',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Plan','globax'),
						'param_name' => 'plan',
						'value'      => ''
					),
					array(
						'type'       => 'textarea',
						'heading'    => esc_html__('List items','globax'),
						'param_name' => 'content',
						'value'      => '',
						'description' => esc_html__('Use line break (press Enter) to separate between items','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button text','globax'),
						'param_name' => 'button_text',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Button link','globax'),
						'param_name' => 'button_link',
						'value'      => ''
					),
					array(
						'param_name'=>'target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						)
					),
	    		)
	    	));
	
		/* banner
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Popup banner','globax'),
	    		'description'             => esc_html__('Insert popup banner (if you want to have the popup in entire site, put the banner inside footer)','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_banner',
	    		'class'                   => 'et_banner',
	    		'icon'                    => 'et_banner',
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
				"js_view"                 => 'VcColumnView',
	    		"content_element"         => true,
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Unique title','globax'),
						'param_name' => 'title',
						'value'      => '',
					),
	    			array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Visible on mobile', 'globax'),
						'param_name' => 'visible_mob',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to display banner on mobile', 'globax'),
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Visible on tablet', 'globax'),
						'param_name' => 'visible_tablet',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to display tablet on mobile', 'globax'),
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Use cookie', 'globax'),
						'param_name' => 'cookie',
						'value'      => '',
						'description'=> esc_html__('Toggle this option if you want to display your banner onces per visit session', 'globax'),
					),
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Delay in ms','globax'),
						'param_name' => 'delay',
						'value'      => '3000',
					),
					array(
						'param_name'=>'effect',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Effect', 'globax'),
						'value'     => array(
							esc_html__('Fade in and scale', 'globax') => 'fade-in-scale', 
							esc_html__('Slide in right', 'globax')  	 => 'slide-in-right', 
							esc_html__('Slide in bottom', 'globax')   => 'slide-in-bottom', 
							esc_html__('3d flip horizontal', 'globax')=> 'flip-horizonatal',
							esc_html__('3d flip vertical', 'globax')  => 'flip-vertical'
						)
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Width in px','globax'),
						'param_name' => 'width',
						'value'      => '720',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Height in px','globax'),
						'param_name' => 'height',
						'value'      => '400',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Background color','globax'),
						'param_name' => 'back_color',
						'value'      => '#ffffff'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Border color','globax'),
						'param_name' => 'border_color',
						'value'      => ''
					),
					array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Background image','globax'),
						'param_name' => 'back_img',
					),
	    		)
	    	));

		/* announcement
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Announcement','globax'),
	    		'description'             => esc_html__('Insert announcement','globax'),
	    		'base'                    => 'et_announcement',
	    		'icon'                    => 'et_announcement',
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
				"js_view"                 => 'VcColumnView',
	    		"content_element"         => true,
	    		'params'                  => array(
	    			array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => ''
					),
					array(
						'heading'    => esc_html__('Icon prefix','globax'),
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax'),
						'type'       => 'textfield',
						'param_name' => 'icon_prefix',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Title color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'title_color',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Background color','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'back_color',
					),
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Background image','globax'),
						'group'      => esc_html__('Styling','globax'),
						'param_name' => 'back_img',
					),
	    		)
	    	));

		/* icon boxes
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Icon boxes classic','globax'),
	    		'description'             => esc_html__('Insert icon boxes','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_content_box',
	    		'class'                   => 'et_content_box',
	    		'icon'                    => 'et_content_box',
	    		'content_element'         => true,
				'is_container'            => true,
				'as_parent'               => array('only' => 'et_box_item'),
				'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
					array(
						'param_name'=>'column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
						)
					),
					array(
						'param_name'=>'gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box gap', 'globax'), 
						'value'     => $gap_values,
						'std'       => '40'
					),
					array(
						'param_name'=>'animation_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box animation type', 'globax'), 
						'value'     => $animation_type_values
					),
	    			array(
						'param_name'=>'animation_effect',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box animation effect', 'globax'),
						'value'     => $animation_values,
						'dependency' => Array('element' => 'animation_type', 'value' => array('sequential','random'))
					),
					array(
						'param_name'=>'icon_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box icon size', 'globax'), 
						'group'     => esc_html__('Box icon', 'globax'), 
						'value'     => $size_values_default,
						'std'       => 'medium'
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border radius (without any string)','globax'),
						'param_name' => 'icon_border_radius',
						'group'     => esc_html__('Box icon', 'globax'), 
						'value'      => ''
					),
					array(
						'param_name'=>'icon_position',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box icon position', 'globax'),
						'group'     => esc_html__('Box icon', 'globax'), 
						'value'     => array(
							esc_html__('Top','globax')  => 'top',
							esc_html__('Left','globax')  => 'left',
							esc_html__('Right','globax')  => 'right',
						),
					),
					array(
						'param_name'=>'icon_alignment',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box icon alignment', 'globax'),
						'group'     => esc_html__('Box icon', 'globax'), 
						'value'     => $align_values,
						'dependency' => Array(
							'element' => 'icon_position', 'value' => 'top',
						)
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Hover animation','globax'),
						'group'     => esc_html__('Box icon', 'globax'), 
						'param_name' => 'animate_hover',
						'value'      => array(
							esc_html__('None','globax')  => 'none',
							esc_html__('Icon scale down','globax')  => 'scale',
							esc_html__('Icon scale out','globax')  => 'scale-out',
							esc_html__('Icon fill background','globax')  => 'fill',
							esc_html__('Icon glint','globax')  => 'glint',
							esc_html__('Icon move','globax')  => 'icon-move',
						)
					),
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Icon box','globax'),
	    		'base'                    => 'et_box_item',
	    		'icon'                    => 'et_box_item',
	    		'as_child'                => array('only' => 'et_content_box'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
				"js_view"                 => 'VcColumnView',
	    		"content_element"         => true,
	    		'params'                  => array(
	    			array(
						'heading'    => esc_html__('Icon prefix','globax'),
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax'),
						'type'       => 'textfield',
						'param_name' => 'icon_prefix',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax'),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon link','globax'),
						'param_name' => 'icon_link',
						'value'      => '',
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'param_name' => 'icon_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color','globax'),
						'param_name' => 'icon_back_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color','globax'),
						'param_name' => 'icon_border_color',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon border width (without any string)','globax'),
						'param_name' => 'icon_border_width',
						'value'      => ''
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Box icon shadow', 'globax'),
						'param_name' => 'icon_shadow',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to have shadow on icon (make sure you have background or border color set)', 'globax'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color hover','globax'),
						'group'    => esc_html__('Icon hover','globax'),
						'param_name' => 'icon_color_hover',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon background color hover','globax'),
						'group'    => esc_html__('Icon hover','globax'),
						'param_name' => 'icon_back_color_hover',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon border color hover','globax'),
						'group'    => esc_html__('Icon hover','globax'),
						'param_name' => 'icon_border_color_hover',
						'value'      => ''
					),
	    		)
	    	));

		/* icon boxes alt
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Icon boxes alternative','globax'),
	    		'description'             => esc_html__('Insert icon boxes','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_content_box_alt',
	    		'class'                   => 'et_content_box_alt',
	    		'icon'                    => 'et_content_box_alt',
	    		'content_element'         => true,
				'is_container'            => true,
				'as_parent'               => array('only' => 'et_box_item_alt'),
				'js_view'                 => 'VcColumnView',
	    		'params'                  => array(
					array(
						'param_name'=>'column',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Column', 'globax'), 
						'value'     => array(
							'1'  => '1',
							'2'  => '2',
							'3'  => '3',
							'4'  => '4',
						)
					),
					array(
						'param_name'=>'gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box gap', 'globax'), 
						'value'     => $gap_values,
						'std'       => '40'
					),
					array(
						'param_name'=>'animation_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box animation type', 'globax'), 
						'value'     => $animation_type_values
					),
	    			array(
						'param_name'=>'animation_effect',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Box animation effect', 'globax'),
						'value'     => $animation_values,
						'dependency' => Array('element' => 'animation_type', 'value' => array('sequential','random'))
					),
					array(
						'param_name'=>'hover_animation',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Hover animation', 'globax'),
						'value'     => array(
							esc_html__('Icon','globax')  => 'icon',
							esc_html__('Box','globax')   => 'box',
						),
					),
	    		)
	    	));

			vc_map(array(
	    		'name'                    => esc_html__('Icon box','globax'),
	    		'base'                    => 'et_box_item_alt',
	    		'icon'                    => 'et_box_item_alt',
	    		'as_child'                => array('only' => 'et_content_box_alt'),
	    		"as_parent"               => array('except' => 'vc_row, vc_section'),
				"js_view"                 => 'VcColumnView',
	    		"content_element"         => true,
	    		'params'                  => array(
	    			array(
						'heading'    => esc_html__('Icon prefix','globax'),
						'description'=> esc_html__('If you want to use custom icons, you need to paste here the icon prefix, but if you want to use Fontawesome icons, leave this option blank','globax'),
						'type'       => 'textfield',
						'param_name' => 'icon_prefix',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Icon name','globax'),
						'param_name' => 'icon_name',
						'value'      => '',
						'description'=> esc_html__('Add icon name, for example fa-gear. Make sure you did not forget about icon prefix option','globax'),
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Icon color','globax'),
						'param_name' => 'icon_color',
						'value'      => ''
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => esc_html__('Box background color','globax'),
						'param_name' => 'box_back_color',
						'value'      => ''
					)
	    		)
	    	));

		/* stylish box
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Image stylish box with link','globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'description'             => esc_html__('Insert image stylish box with link','globax'),
	    		'base'                    => 'et_stylish_box',
	    		'class'                   => 'et_stylish_box',
	    		'icon'                    => 'et_stylish_box',
	    		'params'                  => array(
	    			array(
						'type'       => 'attach_image',
						'heading'    => esc_html__('Upload image','globax'),
						'param_name' => 'src',
					),
	    			array(
						'param_name'=>'size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Size', 'globax'), 
						'value'     => $image_size_values
					),
					array(
						'type'       => 'dropdown',
						'heading'    => esc_html__('Stylsih title position','globax'),
						'param_name' => 'braket',
						'value'      => array(
							esc_html__('Left','globax') => 'left',
							esc_html__('Right','globax') => 'right',
							esc_html__('Top','globax') => 'top',
							esc_html__('Bottom','globax') => 'bottom',
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Sub title','globax'),
						'param_name' => 'subtitle',
						'value'      => '',
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Title','globax'),
						'param_name' => 'title',
						'value'      => '',
					),
					array(
						'param_name'=>'type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title type', 'globax'), 
						'value'     => array(
							esc_html__('H1', 'globax')  => 'h1', 
							esc_html__('H2', 'globax')  => 'h2', 
							esc_html__('H3', 'globax')  => 'h3', 
							esc_html__('H4', 'globax')  => 'h4', 
							esc_html__('H5', 'globax')  => 'h5', 
							esc_html__('H6', 'globax')  => 'h6', 
							esc_html__('p', 'globax')   => 'p', 
							esc_html__('div', 'globax')   => 'div', 
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Font size (without any string)','globax'),
						'param_name' => 'font_size',
						'value'      => '',
					),
					array(
						'param_name'=>'mobile_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size mobile', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'param_name'=>'tablet_font_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Title font size tablet', 'globax'), 
						'value'     => array(
							esc_html__('inherit', 'globax')  => 'inherit', 
							esc_html__('14px', 'globax')  => '14px', 
							esc_html__('16px', 'globax')  => '16px', 
							esc_html__('18px', 'globax')  => '18px', 
							esc_html__('20px', 'globax')  => '20px', 
							esc_html__('24px', 'globax')  => '24px', 
							esc_html__('32px', 'globax')  => '32px', 
							esc_html__('40px', 'globax')  => '40px', 
							esc_html__('48px', 'globax')  => '48px', 
							esc_html__('56px', 'globax')  => '56px', 
							esc_html__('64px', 'globax')  => '64px', 
							esc_html__('72px', 'globax')  => '72px', 
						),
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Line height (without any string)','globax'),
						'param_name' => 'line_height',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Letter spacing (without any string)','globax'),
						'param_name' => 'letter_spacing',
						'value'      => ''
					),
					array(
						'type'       => 'textfield',
						'heading'    => esc_html__('Image link','globax'),
						'param_name' => 'link',
						'value'      => '',
					),
					array(
						'param_name'=>'link_target',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Link target', 'globax'), 
						'value'     => array(
							'_self'  => '_self',
							'_blank' => '_blank' 
						),
						'dependency' => Array('element' => 'link', 'not_empty' => true)
					)
	    		)
	    	));

		/* recent projects
		---------------*/

			$project_categories = array(
				esc_html__('All','globax')  => 'all',
			);

			$args = array(
			    'orderby'           => 'name', 
			    'order'             => 'ASC',
			    'hide_empty'        => true, 
			    'exclude'           => array(), 
			    'exclude_tree'      => array(), 
			    'number'            => '', 
			    'fields'            => 'all', 
			    'slug'              => '', 
			    'parent'            => '',
			    'hierarchical'      => false, 
			    'child_of'          => 0, 
			    'get'               => '', 
			    'name__like'        => '',
			    'description__like' => '',
			    'pad_counts'        => false, 
			    'offset'            => '', 
			    'search'            => '', 
			    'cache_domain'      => 'core'
			);
			$tax_terms = get_terms('project-category');

			if (count($tax_terms) != 0){
            	foreach(get_terms('project-category',$args) as $filter_term){
        			$filter_count    = $filter_term->count;
        			$filter_children = get_term_children( $filter_term->term_id, 'project-category' );
        			if(is_array($filter_children) && !empty($filter_children)) {
        				foreach ($filter_children as $filter_child) {
        					$filter_child_obj = get_term($filter_child, 'project-category');
        					$filter_count = $filter_count + $filter_child_obj->count;
        				}
        			}

        			$project_categories[$filter_term->name] = $filter_term->slug;
	            }
			}


			vc_map(array(
	    		'name'                    => esc_html__('Recent projects', 'globax'),
	    		'description'             => esc_html__('Use this element to insert recent projects', 'globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_recent_projects',
	    		'class'                   => 'et_recent_projects',
	    		'icon'                    => 'et_recent_projects',
	    		'params'                  => array(
	    			array(
						'param_name'=>'project_container',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Project container', 'globax'), 
						'value'     => array(
							esc_html__('Boxed', 'globax')     => 'boxed', 
							esc_html__('Wide', 'globax')  => 'wide', 
						)
					),
	    			array(
						'param_name'=>'project_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Project layout type', 'globax'), 
						'value'     => array(
							esc_html__('Grid', 'globax')     => 'grid', 
							esc_html__('Masonry', 'globax')  => 'masonry2', 
							esc_html__('Carousel', 'globax') => 'carousel',
						)
					),
					array(
						'param_name'=>'gap',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Projects gap', 'globax'), 
						'value'     => $gap_values,
						'std'       => '24',
					),
	    			array(
						'param_name'=>'project_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Project size', 'globax'), 
						'value'     => $size_values_box
					),
					array(
						'param_name' => 'project_layout',
						'type'       => 'dropdown',
						'heading'    => esc_html__('Project layout', 'globax'),
						'value'      => array(
							esc_html__('Project with details', 'globax') => 'project-with-details',
							esc_html__('Project with caption', 'globax') => 'project-with-caption',
							esc_html__('Project with overlay', 'globax') => 'project-with-overlay',
							esc_html__('Project with overlay alternative', 'globax') => 'project-with-overlay-alt',
						)
					),
					array(
						'param_name'=>'project_animation_effect',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Project animation effect', 'globax'),
						'value'     => $animation_values,
						'dependency' => Array(
							'element' => 'project_type', 'value' => array('grid','masonry2'),
						)
					),
					array(
						'param_name'=>'project_limit',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Limit projects to certain projects?', 'globax'), 
						'value'     => $logic_values,
						'dependency' => Array('element' => 'project_type', 'value' => array('grid','masonry2'))
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Projects', 'globax' ),
						'value' => '',
						'param_name' => 'project_filter_slugs',
						'save_always' => true,
						'description' => esc_html__( "Enter comma separated projects' slugs if you want to show certain projects", 'globax' ),
						'dependency' => Array('element' => 'project_limit', 'value' => 'true')
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Project number', 'globax'),
						'param_name' => 'project_number',
						'value'      => '6',
						'dependency' => Array(
							'element' => 'project_limit', 'value' => 'false'
						)
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Category', 'globax' ),
						'value' => '',
						'param_name' => 'category',
						'save_always' => true,
						'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						'dependency' => Array('element' => 'project_limit', 'value' => 'false')
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Operator', 'globax' ),
						'param_name' => 'operator',
						'value' => $operator_values,
						'save_always' => true,
						'description' => esc_html__( 'Select filter operator', 'globax' ),
						'dependency' => Array('element' => 'category', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'globax' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'save_always' => true,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Sort order', 'globax' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'save_always' => true,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Project filter', 'globax'),
						'param_name' => 'project_filter',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to have project filter', 'globax'),
						'dependency' => Array(
							'element' => 'project_type', 'value' => array('grid','masonry2'),
							'element' => 'category', 'not_empty' => false,
							'element' => 'project_limit', 'value' => 'false'
						)
					),
					array(
	    				'type'       => 'checkbox',
						'heading'    => esc_html__('Children categories', 'globax'),
						'param_name' => 'children_categories',
						'value'      => '',
						'description'=> esc_html__('Check this option if you want to have project filter with children categories of given parent category (only one)', 'globax'),
						'dependency' => Array(
							'element' => 'project_type', 'value' => array('grid','masonry2'),
							'element' => 'category', 'not_empty' => false,
							'element' => 'project_limit', 'value' => 'false'
						)
					),
					array(
						'param_name'=>'default_filter',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Define default filter', 'globax'), 
						'value'     => $project_categories,
						'dependency' => Array('element' => 'project_filter', 'value' => 'true')
					),
	    		)
	    	));

    	/* recent posts
		---------------*/

			vc_map(array(
	    		'name'                    => esc_html__('Recent posts', 'globax'),
	    		'description'             => esc_html__('Use this element to insert recent posts', 'globax'),
	    		'category'                => esc_html__('Enovathemes','globax'),
	    		'base'                    => 'et_recent_posts',
	    		'class'                   => 'et_recent_posts',
	    		'icon'                    => 'et_recent_posts',
	    		'params'                  => array(
	    			array(
						'param_name'=>'post_type',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Post layout type', 'globax'), 
						'value'     => array(
							esc_html__('Grid', 'globax') => 'grid',
							esc_html__('Masonry 1', 'globax') => 'masonry1',
							esc_html__('Masonry 2', 'globax') => 'masonry2',
							esc_html__('List', 'globax') => 'list',
							esc_html__('Carousel', 'globax') => 'carousel',
						)
					),
	    			array(
						'param_name'=>'post_size',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Post size', 'globax'), 
						'value'     => $size_values_box,
						'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1','masonry2','carousel'))
					),
					array(
						'param_name'=>'post_animation_effect',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Post animation effect', 'globax'),
						'value'     => $animation_values,
						'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1','masonry2'))
					),
					array(
						'param_name' =>'post_excerpt',
						'type'       => 'textfield',
						'heading'    => esc_html__('Post excerpt length', 'globax'),
						'value'      => ''
					),
					array(
						'param_name'=>'post_filter',
						'type'      => 'dropdown',
						'heading'   => esc_html__('Limit posts to certain posts?', 'globax'), 
						'value'     => $logic_values
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Posts', 'globax' ),
						'value' => '',
						'param_name' => 'post_filter_slugs',
						'save_always' => true,
						'description' => esc_html__( 'Enter comma separated post slugs if you want to show certain posts', 'globax' ),
						'dependency' => Array('element' => 'post_filter', 'value' => 'true')
					),
					array(
	    				'type'       => 'textfield',
						'heading'    => esc_html__('Post number', 'globax'),
						'param_name' => 'post_number',
						'value'      => '6',
						'dependency' => Array('element' => 'post_filter', 'value' => 'false')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Category', 'globax' ),
						'value' => '',
						'param_name' => 'post_cat',
						'save_always' => true,
						'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						'dependency' => Array('element' => 'post_filter', 'value' => 'false')
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Operator', 'globax' ),
						'param_name' => 'operator',
						'value' => $operator_values,
						'save_always' => true,
						'description' => esc_html__( 'Select filter operator', 'globax' ),
						'dependency' => Array('element' => 'post_cat', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'globax' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'save_always' => true,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved posts. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Sort order', 'globax' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'save_always' => true,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					),
	    		)
	    	));

		if (class_exists('Woocommerce')){

			$cat_args = array(
				'orderby'    => 'name',
			    'order'      => 'asc',
			    'hide_empty' => false
			);

			$category_values = array();
			$category_list   = get_terms( 'product_cat', $cat_args );
			if( !empty($category_list) ){

			    foreach ($category_list as $category) {
			    	if ($category->parent) {
			    		$category_values[' - '.$category->name] = $category->slug;
			    	} else {
			    		$category_values[$category->name] = $category->slug;
			    	}
			    }
			}

			$attributes_tax = wc_get_attribute_taxonomies();
			$attributes = array();
			foreach ( $attributes_tax as $attribute ) {
				$attributes[ $attribute->attribute_label ] = $attribute->attribute_name;
			}

		    /* woocommerce cart
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Woocommerce AJAX cart','globax'),
		    		'description'             => esc_html__('Insert AJAX add to cart','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_cart',
		    		'class'                   => 'et_cart',
		    		'icon'                    => 'et_cart',
		    	));

		    /* woocommerce recent products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Recent products','globax'),
		    		'description'             => esc_html__('Lists recent products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_recent_products',
		    		'class'                   => 'et_recent_products',
		    		'icon'                    => 'et_recent_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Operator', 'globax' ),
							'param_name' => 'operator',
							'value' => $operator_values,
							'save_always' => true,
							'description' => esc_html__( 'Select filter operator', 'globax' ),
							'dependency' => Array('element' => 'category', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
		    				'type'       => 'checkbox',
							'heading'    => esc_html__('Product filter', 'globax'),
							'param_name' => 'product_filter',
							'value'      => '',
							'description'=> esc_html__('Check this option if you want to have project filter', 'globax'),
							'dependency' => Array(
								'element' => 'post_type', 'value' => array('grid','masonry1'),
							)
						)
	    			)
		    	));

		    /* woocommerce featured products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Featured products','globax'),
		    		'description'             => esc_html__('Lists featured products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_featured_products',
		    		'class'                   => 'et_featured_products',
		    		'icon'                    => 'et_featured_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Operator', 'globax' ),
							'param_name' => 'operator',
							'value' => $operator_values,
							'save_always' => true,
							'description' => esc_html__( 'Select filter operator', 'globax' ),
							'dependency' => Array('element' => 'category', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));

		    /* woocommerce sale products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Sale products','globax'),
		    		'description'             => esc_html__('Lists sale products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_sale_products',
		    		'class'                   => 'et_sale_products',
		    		'icon'                    => 'et_sale_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Operator', 'globax' ),
							'param_name' => 'operator',
							'value' => $operator_values,
							'save_always' => true,
							'description' => esc_html__( 'Select filter operator', 'globax' ),
							'dependency' => Array('element' => 'category', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));

		    /* woocommerce best selling products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Best selling products','globax'),
		    		'description'             => esc_html__('Lists best selling products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_best_selling_products',
		    		'class'                   => 'et_best_selling_products',
		    		'icon'                    => 'et_best_selling_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Operator', 'globax' ),
							'param_name' => 'operator',
							'value' => $operator_values,
							'save_always' => true,
							'description' => esc_html__( 'Select filter operator', 'globax' ),
							'dependency' => Array('element' => 'category', 'not_empty' => true)
						),
	    			)
		    	));

		    /* woocommerce top rated products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Top rated products','globax'),
		    		'description'             => esc_html__('Lists top rated products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_top_rated_products',
		    		'class'                   => 'et_top_rated_products',
		    		'icon'                    => 'et_top_rated_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Operator', 'globax' ),
							'param_name' => 'operator',
							'value' => $operator_values,
							'save_always' => true,
							'description' => esc_html__( 'Select filter operator', 'globax' ),
							'dependency' => Array('element' => 'category', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));
		
		    /* woocommerce attribute product
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Attribute products','globax'),
		    		'description'             => esc_html__('List attribute products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_attribute_products',
		    		'class'                   => 'et_attribute_products',
		    		'icon'                    => 'et_attribute_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Operator', 'globax' ),
							'param_name' => 'operator',
							'value' => $operator_values,
							'save_always' => true,
							'description' => esc_html__( 'Select filter operator', 'globax' ),
							'dependency' => Array('element' => 'category', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Attribute', 'globax' ),
							'param_name' => 'attribute',
							'value' => $attributes,
							'save_always' => true,
							'description' => esc_html__( 'List of product taxonomy attribute', 'globax' ),
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Filter', 'globax' ),
							'value' => '',
							'param_name' => 'filter',
							'save_always' => true,
							'description' => esc_html__( 'Taxonomy values', 'globax' ),
						),
	    			)
		    	));
		
		    /* woocommerce related products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Related products','globax'),
		    		'description'             => esc_html__('Lists related products','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_related_products',
		    		'class'                   => 'et_related_products',
		    		'icon'                    => 'et_related_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));
		
		    /* woocommerce product
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Product','globax'),
		    		'description'             => esc_html__('Show a single product by ID','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_product',
		    		'class'                   => 'et_product',
		    		'icon'                    => 'et_product',
		    		'params'                  => array(
		    			array(
							'type'        => 'textfield',
							'heading'     => esc_html__( 'Select identificator', 'globax' ),
							'param_name'  => 'id',
							'description' => esc_html__( 'Input product ID', 'globax' ),
						)
	    			)
		    	));
		
		    /* woocommerce products
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Products','globax'),
		    		'description'             => esc_html__('Show multiple products by ID','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_products',
		    		'class'                   => 'et_products',
		    		'icon'                    => 'et_products',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Products', 'globax' ),
							'value' => '',
							'param_name' => 'ids',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated products ids', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));
		
		    /* woocommerce category
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Product category','globax'),
		    		'description'             => esc_html__('Show multiple products in a category','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_product_category',
		    		'class'                   => 'et_product_category',
		    		'icon'                    => 'et_product_category',
		    		'params'                  => array(
		    			array(
							'param_name'=>'post_type',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product layout type', 'globax'), 
							'value'     => array(
								esc_html__('Grid', 'globax')     => 'grid', 
								esc_html__('Masonry', 'globax')  => 'masonry1', 
								esc_html__('Carousel', 'globax') => 'carousel',
							)
						),
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
		    			array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Per page', 'globax' ),
							'value' => 12,
							'save_always' => true,
							'param_name' => "per_page",
							'description' => esc_html__( 'The "per_page" shortcode determines how many products to show on the page', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Category', 'globax' ),
							'value' => $category_values,
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Product category list', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));
		
		    /* woocommerce categories loop
			---------------*/

		    	vc_map(array(
		    		'name'                    => esc_html__('Product categories','globax'),
		    		'description'             => esc_html__('Display product categories loop','globax'),
		    		'category'                => array(esc_html__('WooCommerce','globax'),esc_html__('Enovathemes','globax')),
		    		'base'                    => 'et_product_categories',
		    		'class'                   => 'et_product_categories',
		    		'icon'                    => 'et_product_categories',
		    		'params'                  => array(
						array(
							'param_name'=>'product_animation_effect',
							'type'      => 'dropdown',
							'heading'   => esc_html__('Product animation effect', 'globax'),
							'value'     => $animation_values,
							'dependency' => Array('element' => 'post_type', 'value' => array('grid','masonry1'))
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Columns', 'globax' ),
							'value'     => $size_values_box,
							'param_name' => 'post_size',
							'save_always' => true
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__( 'Categories', 'globax' ),
							'value' => '',
							'param_name' => 'category',
							'save_always' => true,
							'description' => esc_html__( 'Enter comma separated categories slugs if you want to show certain categories', 'globax' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Order by', 'globax' ),
							'param_name' => 'orderby',
							'value' => $order_by_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__( 'Sort order', 'globax' ),
							'param_name' => 'order',
							'value' => $order_way_values,
							'save_always' => true,
							'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'globax' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
						),
	    			)
		    	));
		}
	}


	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

		class WPBakeryShortCode_et_Ghost_Title extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Carousel extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Carousel_Item extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Accordion extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Accordion_Item extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Tab extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Tab_Item extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Timeline extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Timeline_Item extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Process extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Testimonial extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Testimonial_Alt extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Client extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Pricing extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Content_Box extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Box_Item extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Content_Box_Alt extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Box_Item_Alt extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Banner extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Announcement extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Image_Content extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Image_Content_Alt extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Split_Screen extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Split_Screen_Left extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Split_Screen_Right extends WPBakeryShortCodesContainer {}
		class WPBakeryShortCode_et_Split_Screen_Content extends WPBakeryShortCodesContainer {}
	}

	if ( class_exists( 'WPBakeryShortCode' ) ) {
		class WPBakeryShortCode_et_Process_Item extends WPBakeryShortCode {}
		class WPBakeryShortCode_et_Client_Item extends WPBakeryShortCode {}
		class WPBakeryShortCode_et_Pricing_Item extends WPBakeryShortCode {}
		class WPBakeryShortCode_et_Testimonial_Item extends WPBakeryShortCode {}
		class WPBakeryShortCode_et_Testimonial_Item_Alt extends WPBakeryShortCode {}
	}

}

?>