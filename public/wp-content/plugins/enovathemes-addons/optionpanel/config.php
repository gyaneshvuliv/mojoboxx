<?php

if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = "globax_enovathemes";
$theme    = wp_get_theme();

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => $theme->get( 'Name' ),
    'display_version'      => $theme->get( 'Version' ),
    'menu_type'            => 'submenu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__('Theme Settings', 'enovathemes-addons'),
    'page_title'           => esc_html__('Theme Settings', 'enovathemes-addons'),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    'admin_bar'            => true,
    'admin_bar_icon'       => '',
    'admin_bar_priority'   => 50,
    'global_variable'      => 'globax_enovathemes',
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => true,
    'page_priority'        => null,
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => '',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'enovathemes',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true
);

Redux::setArgs( $opt_name, $args );

if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}

$inc = 123;

/* General
---------------*/
	
    Redux::setSection( $opt_name, array(
		'title'      => esc_html__('General', 'enovathemes-addons'),
		'id'         => esc_html__('sec_general', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-wrench',
	    'fields' => array(
	    	array(
				'id'       =>'disable-gutenberg',
				'type'     => 'switch',
				'title'    => esc_html__('Disable gutenberg', 'enovathemes-addons'),
				'subtitle' => esc_html__('By default WordPress comes with new block editor "Gutenberg". If you want classic editor or Visual Composer, make sure this option is active', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'disable-gutenberg-type',
				'type'     => 'checkbox',
				'title'    => esc_html__('Choose post types to disable Gutenberg', 'enovathemes-addons'),
				'options'  => array(
			        'post' => esc_html__('Posts', 'enovathemes-addons'),
			        'page' => esc_html__('Pages', 'enovathemes-addons'),
			        'project' => esc_html__('Projects', 'enovathemes-addons'),
			        'product' => esc_html__('Products', 'enovathemes-addons'),
			    ),
			    'default' => array(
			        'post' => '0', 
			        'page' => '1', 
			        'project' => '0',
			        'product' => '0'
    			),
			    'required' => array('disable-gutenberg','equals',1)
			),
	    	array(
				'id'       =>'combine-scripts',
				'type'     => 'switch',
				'title'    => esc_html__('Combine theme scripts', 'enovathemes-addons'),
				'subtitle' => esc_html__('By default all theme scripts are enqueued separately. This is done to make possible scripts dequeuing if the user needs so. If this option is active theme loads the combined version of scripts, where all the scripts of the theme are combined in one file called controller-combined.js. With this option active user can no longer dequeue scripts, but combined scripts show better performance and higher level of speed.', 'enovathemes-addons'),
				"default"  => 1
			),
	    	array(
				'id'       =>'disable-defaults',
				'type'     => 'switch',
				'class'    => 'hidden-field',
				'title'    => esc_html__('Turn off default styling', 'enovathemes-addons'),
				"default"  => 0
			),
	    	array(
				'id'       =>'responsive-image',
				'type'     => 'switch',
				'title'    => esc_html__('Turn off responsive images with source set attribute', 'enovathemes-addons'),
				'subtitle' => esc_html__('Modern browsers use srcset attribute to deliver the most relevant image size depending on the current device. If you want to load the exact size of the image that you uploaded check this option', 'enovathemes-addons'),
				"default"  => 0
			),
	    	array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Colors', 'enovathemes-addons')
			),
			array(
				'id'       =>'link-color',
				'type'     => 'link_color',
				'active'   => false,
				'visisted' => false,
				'title'    => esc_html__('Links general colors', 'enovathemes-addons'),
				'default'  => array(
					'regular' => '#fd8c40',
					'hover'   => '#212121'
				),
			),
			array(
				'id'       =>'main-color',
				'type'     => 'color',
				'title'    => esc_html__('Main color', 'enovathemes-addons'),
				'default'  => '#fd8c40'
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Layout settings', 'enovathemes-addons')
			),
	    	array(
				'id'        =>'layout',
				'type'      => 'radio',
				'title'     => esc_html__('Layout', 'enovathemes-addons'), 
				'subtitle'  => esc_html__('Boxed layout allows you to display the whole website in the box. (works on screens larger than 1200px wide). Make sure "Sidebar menu" option is inactive (from Theme Settings >> Navigations >> Sidebar menu)', 'enovathemes-addons'), 
				'options'   => array(
					'wide'  => esc_html__('Wide', 'enovathemes-addons'), 
					'boxed' => esc_html__('Boxed', 'enovathemes-addons'),
					'frame' => esc_html__('Frame', 'enovathemes-addons')
				),
				'default' => 'wide',
			),
			array(
				'id'       =>'frame-width-mob',
				'type'     => 'slider',
				'title'    => esc_html__('Frame width on mobile', 'enovathemes-addons'),
				'subtitle' => esc_html__('Starts on devices smaller than 1023px wide', 'enovathemes-addons'),
				'min'      =>'5', 
				'max'      =>'50', 
				'step'     =>'1',
				'default'  => '20',
				'required' => array('layout','equals','frame')
			),
			array(
				'id'       =>'frame-width',
				'type'     => 'slider',
				'title'    => esc_html__('Frame width', 'enovathemes-addons'),
				'min'      =>'5', 
				'max'      =>'50', 
				'step'     =>'1',
				'default'  => '20',
				'required' => array('layout','equals','frame')
			),
			array(
				'id'       =>'frame-color',
				'type'     => 'color',
				'title'    => esc_html__('Frame color', 'enovathemes-addons'), 
				'default'  => '#ffffff',
				'required' => array('layout','equals','frame')
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Footer settings', 'enovathemes-addons')
			),
			array(
				'id'   => 'warning-info-'.$inc++,
				'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('Important! First you must', 'enovathemes-addons').' <a href="'.esc_url(home_url('/')).'wp-admin/post-new.php?post_type=footer">'.esc_html__("create a footer", "enovathemes-addons").'</a>'
			),
			array(
				'id'       =>'footer-sticky',
				'type'     => 'switch',
				'title'    => esc_html__('Sticky footer', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('One page navigation settings', 'enovathemes-addons')
			),
			array(
				'id'        =>'one-page-navigation',
				'type'      => 'select',
				'title'     => esc_html__('One page navigation', 'enovathemes-addons'),
				'subtitle'  => 'Use "Side Bullets" navigation to separate header menu and one page navigation (more about one page navigation find in help file).', 
				'options'   => array(
					"top"   => "Header menu",
					"sidebar"   => "Sidebar menu",
					"side"  => "Side Bullets"
				),
				'default' => "top"
			),
			array(
				'id'       =>'one-page-speed',
				'type'     => 'slider',
				'title'    => esc_html__('One page scroll speed in ms', 'enovathemes-addons'),
				'min'      =>'500', 
				'max'      =>'1500', 
				'step'     =>'100',
				'default'  => '800'
			),
			array(
				'id'      =>'one-page-hash',
				'type'    => 'switch', 
				'title'   => esc_html__('One page layout hash', 'enovathemes-addons'),
				'subtitle'=> esc_html__("Toggle one page layout hash. In browsers that support the history object, update the url's hash when clicking on the links ", 'enovathemes-addons'),
				"default" => 0,
			),
			array(
				'id'       =>'one-page-filter',
				'type'     => 'text',
				'title'    => esc_html__('One page menu filter (if one page navigation is top menu)', 'enovathemes-addons'),
				'subtitle'=> esc_html__("Exclude links from one page menu by entering comma-separated menu items' ids", 'enovathemes-addons'),
			),
			array(
				'id'       =>'one-page-back-color',
				'type'     => 'color',
				'title'    => esc_html__('One page bullets background colors', 'enovathemes-addons'),
				'default'  => '#f5f5f5',
				'required' => array('one-page-navigation','equals','side')
			),
			array(
				'id'      =>'one-page-back-shadow',
				'type'    => 'switch', 
				'title'   => esc_html__('One page bullets background shadow', 'enovathemes-addons'),
				"default" => 0,
				'required' => array('one-page-navigation','equals','side')
			),
			array(
				'id'       =>'one-page-color',
				'type'     => 'link_color',
				'active'   => false,
				'visisted' => false,
				'title'    => esc_html__('One page bullets colors', 'enovathemes-addons'),
				'default'  => array(
					'regular' => '#212121',
					'hover'   => '#fd8c40'
				),
				'required' => array('one-page-navigation','equals','side')
			),
			array(
				'id'       =>'one-page-tooltip-color',
				'type'     => 'color',
				'title'    => esc_html__('One page bullets tooltip color', 'enovathemes-addons'),
				'default'  => '#ffffff',
				'required' => array('one-page-navigation','equals','side')
			),
			array(
				'id'       =>'one-page-tooltip-back-color',
				'type'     => 'color',
				'title'    => esc_html__('One page bullets background tooltip color', 'enovathemes-addons'),
				'default'  => '#212121',
				'required' => array('one-page-navigation','equals','side')
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Google API settings', 'enovathemes-addons')
			),
			array(
				'id'       =>'google-map-api',
				'type'     => 'text',
				'title'    => esc_html__("Google map API Key", 'enovathemes-addons'),
				'subtitle' => 'More about google map api settings find <a target="_blank" href="http://enovathemes.com/knowledgebase/google-map-options/">here</a>'
			),
	    	array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Site background settings', 'enovathemes-addons')
			),
			array(
				'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('Important! If you want to add background image/color select the "Boxed" site layout option from Theme Settings', 'enovathemes-addons')
			),
	    	array(
				'id'       =>'site-background',
				'type'     => 'background',
				'title'    => esc_html__('Site background options', 'enovathemes-addons'), 
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Under construction page settins', 'enovathemes-addons')
			),
			array(
				'id'       =>'under-construction',
				'type'     => 'switch',
				'title'    => esc_html__('Under construction', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have "Under construction" page', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
				'id'       =>'under-construction-back',
				'type'     => 'background',
				'title'    => esc_html__('Under construction page background', 'enovathemes-addons'),
			    'required' => array('under-construction','equals',1) 
			),
			array(
				'id'       =>'under-construction-logo',
				'type'     => 'media', 
				'url'      => false,
				'title'    => esc_html__('Under construction page logo upload', 'enovathemes-addons'),
			    'required' => array('under-construction','equals',1)
			),
			array(
				'id'       =>'under-construction-logo-retina',
				'type'     => 'media', 
				'url'      => false,
				'title'    => esc_html__('Under construction page retina logo upload', 'enovathemes-addons'),
			    'required' => array('under-construction','equals',1)
			),
			array(
				'id'       =>'under-construction-slogan',
				'type'     => 'editor',
				'title'    => esc_html__('Under construction page message', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Add simple/html text to "Under construction" page', 'enovathemes-addons'), 
				'default'  => 'Site is under construction',
			    'required' => array('under-construction','equals',1)
			),
	    )
	));
	
/* CSS
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('CSS', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-star',
	    'fields'     => array(
	    	array(
	            'id'       => 'custom-css',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'class'    => 'hidden-field',
				'theme'    => 'monokai',
	            'title'    => esc_html__('Custom CSS Styles', 'enovathemes-addons'), 
	            'subtitle' => esc_html__('Enter custom css code here.', 'enovathemes-addons')
	        ),
	        array(
	            'id'       => 'custom-css-min-320',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 320px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-320',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 320px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-479',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 479px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-480',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 480px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-480-max-767',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 480px) and (max-width: 767px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-639',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 639px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-640',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 640px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-640-max-767',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 640px) and (max-width: 767px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-767',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 767px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-768',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 768px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-768-max-1023',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 768px) and (max-width: 1023px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-1023',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 1023px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1024',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1024px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1024-max-1279',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1024px) and (max-width: 1279px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-1279',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 1279px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1280',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1280px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1280-max-1367',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1280px) and (max-width: 1367px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1366',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1366px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1366-max-1599',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1366px) and (max-width: 1599px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-max-1599',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(max-width: 1599px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1600',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1600px)', 'enovathemes-addons'), 
	        ),
	        array(
	            'id'       => 'custom-css-min-1600-max-1919',
	            'type'     => 'ace_editor',
				'mode'     => 'css',
				'theme'    => 'monokai',
	            'title'    => esc_html__('(min-width: 1600px) and (max-width: 1919px)', 'enovathemes-addons'), 
	        ),
	    )
	));

/* Effects
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Effects', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-magic',
	    'fields' => array(
	    	array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Smooth page scroll', 'enovathemes-addons')
			),
			array(
				'id'       =>'smooth-scroll',
				'type'     => 'switch',
				'title'    => esc_html__('Smooth scroll', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have smooth scroll', 'enovathemes-addons'),
				"default"  => 0
			),
	    	array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Custom scroll settings', 'enovathemes-addons')
			),
			array(
				'id'       =>'custom-scroll',
				'type'     => 'switch',
				'title'    => esc_html__('Custom scroll', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have custom nice scroll', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
				'id'       =>'custom-scroll-cursorcolor',
				'type'     => 'color',
				'title'    => esc_html__('Custom scroll cursor color', 'enovathemes-addons'),
				'default'  => '#222222',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-railcolor',
				'type'     => 'color',
				'title'    => esc_html__('Custom scroll rail background color', 'enovathemes-addons'),
				'default'  => '#666666',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-cursoropacitymin',
				'type'     => 'slider',
				'title'    => esc_html__('Custom scroll cursor minimum opacity', 'enovathemes-addons'),
				'min'      =>'0', 
				'max'      =>'100', 
				'step'     =>'10',
				'default'  =>'100',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-cursoropacitymax',
				'type'     => 'slider',
				'title'    => esc_html__('Custom scroll cursor maximum opacity', 'enovathemes-addons'),
				'min'      =>'0', 
				'max'      =>'100', 
				'step'     =>'10',
				'default'  =>'100',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-cursorwidth',
				'type'     => 'slider',
				'title'    => esc_html__('Custom scroll cursor width', 'enovathemes-addons'),
				'min'      =>'5', 
				'max'      =>'40', 
				'step'     =>'1',
				'default'  =>'10',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-cursorborderradius',
				'type'     => 'slider',
				'title'    => esc_html__('Custom scroll cursor border radius', 'enovathemes-addons'),
				'min'      =>'0', 
				'max'      =>'40', 
				'step'     =>'1',
				'default'  =>'5',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-scrollspeed',
				'type'     => 'slider',
				'title'    => esc_html__('Custom scroll speed', 'enovathemes-addons'),
				'min'      =>'60', 
				'max'      =>'180', 
				'step'     =>'10',
				'default'  =>'60',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
				'id'       =>'custom-scroll-mousescrollstep',
				'type'     => 'slider',
				'title'    => esc_html__('Custom mousescroll step', 'enovathemes-addons'),
				'min'      =>'40', 
				'max'      =>'180', 
				'step'     =>'10',
				'default'  =>'40',
			    'required' => array('custom-scroll','equals',1)
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Custom site loading settings', 'enovathemes-addons')
			),
			array(
				'id'       =>'custom-loading',
				'type'     => 'switch',
				'title'    => esc_html__('Custom site loading', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have site loading', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
				'id'       =>'custom-loading-backcolor',
				'type'     => 'color',
				'title'    => esc_html__('Custom site loading background color', 'enovathemes-addons'),
				'default'  => '#212121',
			    'required' => array('custom-loading','equals',1)
			),
			array(
				'id'       =>'custom-loading-color',
				'type'     => 'color',
				'title'    => esc_html__('Custom site loading color', 'enovathemes-addons'),
				'default'  => '#fd8c40',
			    'required' => array('custom-loading','equals',1)
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Image preload settings', 'enovathemes-addons')
			),
	    	array(
				'id'       =>'img-preload',
				'type'     => 'switch',
				'title'    => esc_html__('Image preload', 'enovathemes-addons'),
				'subtitle' => esc_html__('Refers to loop/archive pages', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Move to top arrow settings', 'enovathemes-addons')
			),
			array(
				'id'       =>'mtt',
				'type'     => 'switch',
				'title'    => esc_html__('Move to top arrow', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle this option if you want to have move to top arrow', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'mtt-size',
				'type'     => 'slider',
				'title'    => esc_html__('Move to top arrow size', 'enovathemes-addons'),
				'min'      =>'32', 
				'max'      =>'150', 
				'step'     =>'1',
				'default'  =>'48',
				'required' => array('mtt','equals',1) 
			),
			array(
				'id'       =>'mtt-arrow-size',
				'type'     => 'slider',
				'title'    => esc_html__('Move to top icon size', 'enovathemes-addons'),
				'min'      =>'1', 
				'max'      =>'150', 
				'step'     =>'1',
				'default'  =>'32',
				'required' => array('mtt','equals',1)
			),
			array(
				'id'       =>'mtt-border-radius',
				'type'     => 'slider',
				'title'    => esc_html__('Move to top arrow border radius', 'enovathemes-addons'),
				'min'      =>'0', 
				'max'      =>'150', 
				'step'     =>'1',
				'default'  =>'150',
				'required' => array('mtt','equals',1)
			),
			array(
				'id'       =>'mtt-color',
				'type'     => 'link_color',
				'active'   => false,
				'visisted' => false,
				'title'    => esc_html__('Move to top arrow icon colors', 'enovathemes-addons'),
				'default'  => array(
					'regular' => '#ffffff',
					'hover'   => '#ffffff'
				),
				'required' => array('mtt','equals',1)
			),
			array(
				'id'       =>'mtt-back-color',
				'type'     => 'link_color',
				'active'   => false,
				'visisted' => false,
				'title'    => esc_html__('Move to top arrow background colors', 'enovathemes-addons'),
				'default'  => array(
					'regular' => '#151515',
					'hover'   => '#fd8c40'
				),
				'required' => array('mtt','equals',1)
			),
	    )
	));

/* Page title section
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Page title section', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-photo',
	    'fields' => array(
	    	array(
				'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('Important! Styling options you can adjust for each page separatly. Find styling options from each page edit screen, under the main editor. For Blog / Projects / Shop / page title section options visit corresponding sections.', 'enovathemes-addons')
			),
	    	array(
				'id'       =>'page-title-height',
				'type'     => 'slider',
				'title'    => esc_html__('Page title section height', 'enovathemes-addons'),
				'subtitle' => esc_html__('Set the title section height for non-slider pages.', 'enovathemes-addons'), 
				'min'      =>'64', 
				'max'      =>'500', 
				'step'     =>'1',
				'default'  =>'380'
			),
			array(
				'id'       =>'page-title-opacity',
				'type'     => 'switch',
				'title'    => esc_html__('Page title content opacity when scrolling', 'enovathemes-addons'),
				'subtitle' => esc_html__('Activate, if you want to add dynamic opacity to the page title section"', 'enovathemes-addons'),
				"default"  => 0
			),
			array(
				'id'       =>'page-title-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Page title typography', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Configure page title typography options', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => true,
				'color'          => false,
				'text-align'     => false,
				'default' => array(
			        'font-weight'    => '700', 
			        'font-family'    => 'Montserrat', 
			        'font-size'      => '72px',
			        'line-height'    => '88px',
			        'letter-spacing' => '4px',
			        'text-transform' => 'uppercase'
			    )
			),
			array(
				'id'       =>'page-subtitle-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Page subtitle typography', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Configure page subtitle typography options', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => true,
				'color'          => false,
				'text-align'     => false,
				'default'     => array(
			        'font-weight' => '400', 
			        'font-family' => 'Roboto', 
			        'font-size'   => '14px',
			        'line-height' => '24px',
			        'letter-spacing' => '1.5px',
			        'text-transform' => 'uppercase'
			    )
			),
			array(
				'id'       =>'page-title-text-align',
				'type'     => 'select',
				'title'    => esc_html__('Page title/subtitle alignment', 'enovathemes-addons'),
				'subtitle' => esc_html__('Choose page title/subtile text alignment', 'enovathemes-addons'),
				'description' => esc_html__('*Information on RTL (Right-To-Left Language Support): If your page breadcrumbs are active, it is strongly recommended to set page title section text alignment the same value both on desktop and mobile (scroll down and see mobile corrections).', 'enovathemes-addons'),
				'options'  => array(
					'left'   =>'Left',
					'right'  =>'Right',
					'center' =>'Center'
				),
				'default'  => 'left'
			),
			array(
				'id'       =>'page-breadcrumbs',
				'type'     => 'switch',
				'title'    => esc_html__('Page breadcrumbs', 'enovathemes-addons'),
				'subtitle' => esc_html__('Toggle breadcrumbs on page title sections', 'enovathemes-addons'),
				"default"  => 1
			),
			array(
				'id'       =>'page-breadcrumbs-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Page breadcrumbs typography', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Configure breadcrumbs typography options', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => true,
				'color'          => false,
				'text-align'     => false,
				'default'     => array(
			        'font-weight' 	 => '500', 
			        'font-family' 	 => 'Montserrat', 
			        'font-size'   	 => '16px',
			        'line-height' 	 => '26px',
			        'letter-spacing' => '0px',
			        'text-transform' => 'none'
			    ),
			    'required' => array('page-breadcrumbs','equals',1)
			),
			array(
			    'id'   => 'info-'.$inc++,
			    'type' => 'info',
			    'desc' => esc_html__('Mobile corrections', 'enovathemes-addons')
			),
	    	array(
				'id'       =>'mob-page-title-height',
				'type'     => 'slider',
				'title'    => esc_html__('Page title section height', 'enovathemes-addons'),
				'subtitle' => esc_html__('Set the title section height for non-slider pages.', 'enovathemes-addons'), 
				'min'      =>'64', 
				'max'      =>'500', 
				'step'     =>'1',
				'default'  => '250'
			),
			array(
				'id'       =>'mob-page-title-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Page title typography', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Configure page title typography options', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => false,
				'subsets'        => false,
				'all_styles'     => false,
				'font-family'    => false,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => true,
				'color'          => false,
				'text-align'     => false,
				'default'     => array(
			        'font-size'   	 => '32px',
			        'line-height' 	 => '40px',
			        'letter-spacing' => '1px',
			    )
			),
			array(
				'id'       =>'mob-page-subtitle-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Page subtitle typography', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Configure page subtitle typography options', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => false,
				'subsets'        => false,
				'all_styles'     => false,
				'font-family'    => false,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => true,
				'color'          => false,
				'text-align'     => false,
			),
			array(
				'id'       =>'mob-page-title-text-align',
				'type'     => 'select',
				'title'    => esc_html__('Page title/subtitle alignment', 'enovathemes-addons'),
				'subtitle' => esc_html__('Choose page title/subtile text alignment', 'enovathemes-addons'),
				'options'  => array(
					'left'   =>'Left',
					'right'  =>'Right',
					'center' =>'Center'
				),
				'default'  => 'left'
			),
			array(
				'id'       =>'mob-page-breadcrumbs-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Page breadcrumbs typography', 'enovathemes-addons'), 
				'subtitle' => esc_html__('Configure breadcrumbs typography options', 'enovathemes-addons'),
				'units'          => 'px',
				'google'         => false,
				'subsets'        => false,
				'all_styles'     => false,
				'font-family'    => false,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => true,
				'color'          => false,
				'text-align'     => false,
			)
	    )
	));

/* Header & Menu
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Navigations', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-website',
	    'fields' => array(
	    	array(
				'id'   => 'warning-info-'.$inc++,
				'class'=> 'warning-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => esc_html__('If you want to quickly import one of the 35 header styles, please visit the', 'enovathemes-addons').' <a href="'.esc_url(home_url('/')).'wp-admin/themes.php?page=quick_styles_settings">'.esc_html__("quick styles", "enovathemes-addons").'</a>'
			),
	    )
	));

	

	/* Header top
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Header top', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
				array(
					'id'      =>'header-top',
					'type'    => 'switch', 
					'title'   => esc_html__('Header top section', 'enovathemes-addons'),
					"default" => 0,
				),
				array(
					'id'      =>'mob-header-top',
					'type'    => 'switch', 
					'title'   => esc_html__('Mobile header top', 'enovathemes-addons'),
					"default" => 0,
					'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-height',
					'type'     => 'slider',
					'title'    => esc_html__('Header top height', 'enovathemes-addons'),
					'min'      =>'32', 
					'max'      =>'500', 
					'step'     =>'1',
					'default'  => '56',
					'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header top background color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#212121',
				        'alpha'     => 1
				    ),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header top border bottom color', 'enovathemes-addons'),
			    	'required' => array('header-top','equals',1) 
				),
				array(
					'id'      =>'header-top-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header top menu colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#BDBDBD',
				        'hover'    => '#ffffff',
				    ),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'      =>'header-top-submenu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header top submenu colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#BDBDBD',
				        'hover'    => '#ffffff',
				    ),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'      =>'header-top-submenu-back',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header top submenu background colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#212121',
				        'hover'    => '#fd8c40',
				    ),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-menu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Header top menu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust header top menu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'font-family'    => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'default'   => array(
				        'font-weight' 	 => '600', 
				        'font-family' 	 => 'Montserrat', 
				        'font-size'   	 => '14px',
				        'letter-spacing' => '0.5px',
				        'text-transform' => 'none'
				    ),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-slogan',
					'type'     => 'textarea',
					'title'    => esc_html__('Header top slogan', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Add simple/html text to header top section', 'enovathemes-addons'),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'      =>'header-top-social-links',
					'type'    => 'switch', 
					'title'   => esc_html__('Header social links', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Make sure you added social links from Theme Settings >> Social', 'enovathemes-addons'),
					"default" => 1,
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'      =>'header-top-social-links-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header top social links colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#BDBDBD',
				        'hover'    => '#ffffff',
				    ),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-button-url',
					'type'     => 'text',
					'title'    => esc_html__('Header top button url', 'enovathemes-addons'),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-button-text',
					'type'     => 'text',
					'title'    => esc_html__('Header top button text', 'enovathemes-addons'),
			    	'required' => array('header-top','equals',1) 
				),
				array(
					'id'       =>'header-top-button-text-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Header top button text color', 'enovathemes-addons'), 
					'default'  => array(
						'regular' => '#212121',
						'hover'   => '#ffffff'
					),
			    	'required' => array('header-top','equals',1)
				),
				array(
					'id'       =>'header-top-button-back-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Header top button background color', 'enovathemes-addons'), 
					'default'  => array(
						'regular' => '#ffffff',
						'hover'   => '#fd8c40'
					),
			    	'required' => array('header-top','equals',1)
				),
			)
		));

	/* Logo upload
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Logo upload', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
				    'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
				    'desc' => esc_html__('Upload .jpg, .png or .gif image that will be your logo.', 'enovathemes-addons')
				),
				array(
					'id'       =>'logo',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Header logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'logo-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Header retina logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'logo-pos-hor',
					'type'     => 'slider',
					'title'    => esc_html__('Header logo position correction horizontal', 'enovathemes-addons'),
					'subtitle' => esc_html__('Offset from left', 'enovathemes-addons'),
					'min'      =>'-200', 
					'max'      =>'200', 
					'step'     =>'1'
				),
				array(
					'id'       =>'logo-pos-ver',
					'type'     => 'slider',
					'title'    => esc_html__('Header logo position correction vertical', 'enovathemes-addons'),
					'subtitle' => esc_html__('Offset from top', 'enovathemes-addons'),
					'min'      =>'-200', 
					'max'      =>'200', 
					'step'     =>'1'
				),
				array(
					'id'       =>'transparent-logo',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Transparent logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'transparent-logo-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Transparent retina logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'logo-fixed',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Sticky header logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'logo-fixed-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Sticky header retina logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'logo-mobile',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Mobile logo upload', 'enovathemes-addons'),
				),

				array(
					'id'       =>'logo-mobile-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Mobile retina logo upload', 'enovathemes-addons'),
				),
				array(
					'id'       =>'transparent-logo-mobile',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Transparent mobile logo upload', 'enovathemes-addons'),
					'description' => esc_html__('When transparent desktop header is set the mobile version will automatically inherit logo from this option', 'enovathemes-addons'),
				),

				array(
					'id'       =>'transparent-logo-mobile-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Transparent mobile retina logo upload', 'enovathemes-addons'),
					'description' => esc_html__('When transparent desktop header is set the mobile version will automatically inherit logo from this option', 'enovathemes-addons'),

				)
		    )
		));


	/* Standard header
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Standard header', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
					'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
					'desc' => esc_html__('Important! If you want to use "Standard header" make sure "Fullscreen menu" and "Sidebar menu" options are inactive', 'enovathemes-addons')
				),
		    	array(
					'id'   => 'quick-styles-info',
					'type' => 'info',
					'desc' => esc_html__('Header variations', 'enovathemes-addons')
				),
				array(
					'id'       =>'boxed-header',
					'type'     => 'switch',
					'title'    => esc_html__('Boxed header', 'enovathemes-addons'),
					'subtitle' => esc_html__('Similar to "Transparent header" option. If you want to make boxed transparent header do not activate both "Boxed header" and "Transparent header", activate only Boxed header" and make sure to set transparent background color to header from the options below (Find the option: "Header background color").', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'sticky-header',
					'type'     => 'switch',
					'title'    => esc_html__('Sticky header', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle on this option and scroll down and find sticky header options', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'full-header',
					'type'     => 'switch',
					'title'    => esc_html__('Full width header', 'enovathemes-addons'),
					'subtitle' => esc_html__('This option does not work with "Header boxed" or "Boxed layout" options active', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'logo-position',
					'type'     => 'select',
					'title'    => esc_html__('Logo position', 'enovathemes-addons'),
					'subtitle' => esc_html__('Align the logo to the left/right/center. If your "Menu under logo" option is not active, logo is centered between 2 menu parts (left menu part and right menu part). When you select "Logo center" option, make sure you have 2 menus created and assigned to the left/right locations.', 'enovathemes-addons'),
					'options'  => array(
						"left"   => "Left",
						"right"  => "Right",
						"center" => "Center"
					),
					'default' => "left"
				),
				array(
					'id'       =>'no-logo',
					'type'     => 'switch',
					'title'    => esc_html__('No logo', 'enovathemes-addons'),
					'subtitle' => esc_html__('Header without logo', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'menu-position',
					'type'     => 'select',
					'title'    => esc_html__('Menu position', 'enovathemes-addons'),
					'subtitle' => esc_html__('Align the menu to the left/right/center.', 'enovathemes-addons'),
					'options'  => array(
						"left"   => "Left",
						"right"  => "Right",
						"center" => "Center"
					),
					'default' => "left",
					'required' => array('no-logo','equals',1)
				),
				array(
					'id'       =>'menu-under-logo',
					'type'     => 'switch',
					'title'    => esc_html__('Menu under logo', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make menu 100% width and put under the logo', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'menu-under-logo-boxed',
					'type'     => 'switch',
					'title'    => esc_html__('Boxed menu under logo', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make menu aligned with main container. Make sure "Menu under logo" option is active', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('menu-under-logo','equals',1)
				),
				array(
					'id'       =>'menu-under-logo-boxed-radius',
					'type'     => 'slider',
					'title'    => esc_html__('Boxed menu under logo border radius', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'0',
					'required' => array(array('menu-under-logo-boxed','equals',1),array('menu-under-logo','equals',1))
				),
				array(
					'id'       =>'menu-under-logo-icons',
					'type'     => 'switch',
					'title'    => esc_html__('Boxed menu under logo icons top', 'enovathemes-addons'),
					'subtitle' => esc_html__('Place the header icons in top of the menu near logo. Make sure "Menu under logo", "Boxed menu under logo" optiona are active and "Logo position" is set to "Center"', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array(array('menu-under-logo','equals',1),array('menu-under-logo-boxed','equals',1),array('logo-position','equals','center'))
				),
				array(
					'id'       =>'header-under-slider',
					'type'     => 'switch',
					'title'    => esc_html__('Header under slider', 'enovathemes-addons'),
					'subtitle' => esc_html__('On all pages, that have revolution slider the header will be located under the slider. For all other pages without slider the header will be placed at the top of the page.', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'border-box',
					'type'     => 'switch',
					'title'    => esc_html__('Boxed borders for header', 'enovathemes-addons'),
					'subtitle' => esc_html__('This option aligns your header borders with the main container width', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'   => 'header-main-info',
					'type' => 'info',
					'desc' => esc_html__('Menu & Header options', 'enovathemes-addons')
				),

				array(
					'id'       =>'header-height',
					'type'     => 'slider',
					'title'    => esc_html__('Header height', 'enovathemes-addons'),
					'min'      =>'60', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'96'
				),

				array(
					'id'      =>'header-search',
					'type'    => 'switch', 
					'title'   => esc_html__('Header search', 'enovathemes-addons'),
					"default" => 1,
				),

				array(
					'id'       =>'header-search-back-default',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Non modal header search background color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
				    'required' => array('header-search','equals',1)

				),

				array(
					'id'       =>'header-search-border-default',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Non modal header search border color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#e0e0e0',
				        'alpha'     => 1
				    ),
				    'required' => array('header-search','equals',1)
				),

				array(
					'id'       =>'header-search-text-default',
					'type'     => 'color',
					'title'    => esc_html__('Non modal header search text color', 'enovathemes-addons'),
					'default'   => '#757575',
				    'required' => array('header-search','equals',1)
				),

				array(
					'id'       => 'header-search-back',
					'type'     => 'color',
					'title'    => esc_html__('Modal header search background color', 'enovathemes-addons'),
					'default'  => '#f5f5f5',
				    'required' => array('header-search','equals',1)
				),

				array(
					'id'       => 'header-search-color',
					'type'     => 'color',
					'title'    => esc_html__('Modal header search color', 'enovathemes-addons'),
					'default'  => '#616161',
				    'required' => array('header-search','equals',1)
				),

				array(
					'id'       =>'header-search-back-opacity',
					'type'     => 'slider',
					'title'    => esc_html__('Modal header search background transparency', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'10', 
					'step'     =>'1',
					'default'  =>'10',
				    'required' => array('header-search','equals',1)
				),
				array(
					'id'      =>'header-social-links',
					'type'    => 'switch', 
					'title'   => esc_html__('Header social links', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Make sure you added social links from Theme Settings >> Social', 'enovathemes-addons'),
					"default" => 0
				),
				array(
					'id'      =>'header-social-links-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header social links colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#BDBDBD',
				        'hover'    => '#fd8c40',
				    ),
			    	'required' => array('header-social-links','equals',1)
				),
				array(
					'id'      =>'header-social-links-border-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header social links border colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array('header-social-links','equals',1)
				),
				array(
					'id'      =>'header-social-links-back-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header social links background colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array('header-social-links','equals',1)
				),
				array(
					'id'       =>'header-social-links-border-width',
					'type'     => 'slider',
					'title'    => esc_html__('Header social links border width', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'5', 
					'step'     =>'1',
					'default'  =>'0',
					'required' => array('header-social-links','equals',1)
				),
				array(
					'id'       =>'header-social-links-border-radius',
					'type'     => 'slider',
					'title'    => esc_html__('Header social links border radius', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'50', 
					'step'     =>'1',
					'default'  =>'0',
					'required' => array('header-social-links','equals',1)
				),
				array(
					'id'       =>'header-button-url',
					'type'     => 'text',
					'title'    => esc_html__('Header button url', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make sure your logo position is NOT set to "Center"', 'enovathemes-addons'),
					'required' => array(array('logo-position','!=','center'),array('menu-under-logo','equals',1))
				),
				array(
					'id'       =>'header-button-text',
					'type'     => 'text',
					'title'    => esc_html__('Header button text', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make sure your logo position is NOT set to "Center"', 'enovathemes-addons'),
					'required' => array(array('logo-position','!=','center'),array('menu-under-logo','equals',1))
				),
				array(
					'id'       =>'header-button-icon',
					'type'     => 'text',
					'title'    => esc_html__('Header button icon', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make sure your logo position is NOT set to "Center". Paste "Fontawesome" icon name here if you want to add icon to your button', 'enovathemes-addons'),
					'required' => array(array('logo-position','!=','center'),array('menu-under-logo','equals',1))
				),
				array(
					'id'       =>'header-button-text-color',
					'type'     => 'link_color',
					'active'   => false,
					'active'   => false,
					'visisted'   => false,
					'title'    => esc_html__('Header button text color', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Make sure your logo position is NOT set to "Center"', 'enovathemes-addons'),
					'default'  => array(
						'regular' => '#ffffff',
						'hover'   => '#ffffff'
					),
					'required' => array(array('logo-position','!=','center'),array('menu-under-logo','equals',1))
				),
				array(
					'id'       =>'header-button-back-color',
					'type'     => 'link_color',
					'active'   => false,
					'visisted'   => false,
					'title'    => esc_html__('Header button background color', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Make sure your logo position is NOT set to "Center"', 'enovathemes-addons'),
					'default'  => array(
						'regular' => '#fd8c40',
						'hover'   => '#212121'
					),
					'required' => array(array('logo-position','!=','center'),array('menu-under-logo','equals',1))
				),
				array(
					'id'       =>'header-slogan',
					'type'     => 'textarea',
					'title'    => esc_html__('Header slogan', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make sure your logo position is NOT set to "Center"', 'enovathemes-addons'),
					'required' => array(array('logo-position','!=','center'),array('menu-under-logo','equals',1))
				),
				array(
					'id'      =>'header-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Choose icons color', 'enovathemes-addons'),
					'default' => "#b6b6b6"
				),
				array(
					'id'       =>'cart-bubble-text-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header shopping cart bubble text color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => '1'
				    ) 
				),
				array(
					'id'       => 'cart-bubble-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header shopping cart bubble background color', 'enovathemes-addons'),
					'default'  => array(
						'color' => '#fd8c40',
						'alpha'   => '1', 
						),
				),

				array(
					'id'       =>'header-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header background color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    )
				),
				
				array(
					'id'       =>'header-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header border bottom color', 'enovathemes-addons'), 
				),
				array(
					'id'       =>'menu-height',
					'type'     => 'slider',
					'title'    => esc_html__('Header menu area height', 'enovathemes-addons'),
					'subtitle' => esc_html__('Separate menu area height. This option is availble only with "Menu under logo" option active (check in header quick styles)', 'enovathemes-addons'), 
					'min'      =>'36', 
					'max'      =>'500', 
					'step'     =>'1',
					'default'  => '64',
					'required' => array('menu-under-logo','equals',1)
				),
				array(
					'id'       =>'menu-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Menu background color', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Separate menu area background color. This option is availble only with "Menu under logo" option active (check in header quick styles)', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
				    'required' => array('menu-under-logo','equals',1)
				),
				array(
					'id'       =>'menu-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Menu border top color', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Separate menu area border top color. This option is availble only with "Menu under logo" option active (check in header quick styles)', 'enovathemes-addons'), 
				    'required' => array('menu-under-logo','equals',1)
				),

				array(
					'id'       =>'header-menu-m',
					'type'     => 'slider',
					'title'    => esc_html__('Set menu margin in px for desktop under 1600px wide', 'enovathemes-addons'),
					'min'      =>'-10', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'40'
				),
				array(
					'id'       =>'header-menu-m-1600',
					'type'     => 'slider',
					'title'    => esc_html__('Set menu margin in px for desktop over 1600px wide', 'enovathemes-addons'),
					'min'      =>'-10', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'40'
				),
				array(
					'id'       =>'header-menu-separator',
					'type'     => 'switch',
					'title'    => esc_html__('Menu items separator', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'header-menu-separator-height',
					'type'     => 'slider',
					'title'    => esc_html__('Menu items separator height', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'16',
					'required' => array('header-menu-separator','equals',1)
				),
				array(
					'id'      =>'header-menu-separator-color',
					'type'    => 'color_rgba', 
					'title'   => esc_html__('Menu items separator color', 'enovathemes-addons'),
					'default'  => array(
				        'color'  => '#e0e0e0',
				        'alpha'  => '1',
				    ),
				    'required' => array('header-menu-separator','equals',1)
				),   
				array(
					'id'      =>'header-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header menu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#212121',
				        'hover'    => '#fd8c40',
				    )
				),
				array(
					'id'       =>'header-menu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Menu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust menu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'default'     => array(
				        'font-weight'    => '700', 
				        'font-family'    => 'Montserrat', 
				        'font-size'      => '12px',
						'letter-spacing' => '1px',
						'text-transform' => 'uppercase',
				    )
				),
				array(
					'id'      =>'header-menu-effect',
					'type'     => 'select',
					'title'    => esc_html__('Choose menu effect version', 'enovathemes-addons'),
					'options'  => array(
						"underline" => "Underline",
						"overline"  => "Overline",
						"outline"   => "Outline",
						"fill"      => "Fill",
						"box"       => "Box",
						"dottes"    => "Dottes"
					),
					'default' => "underline"
				),

				array(
					'id'       =>'header-menu-effect-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header menu effect color', 'enovathemes-addons'),
					'default'  => array(
						'color' => '#fd8c40',
						'alpha'   => '1', 
					),
				),

				array(
					'id'       =>'header-submenu-back-color',
					'type'     => 'color',
					'title'    => esc_html__('Header submenu background color', 'enovathemes-addons'), 
					'default'  => '#ffffff',
				),
				array(
					'id'       =>'header-submenu-border-color',
					'type'     => 'color',
					'title'    => esc_html__('Header submenu top border color', 'enovathemes-addons'), 
					'default'  => '#fd8c40',
				),
				array(
					'id'       =>'header-submenu-shadow',
					'type'     => 'switch',
					'title'    => esc_html__('Header submenu background shadow', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'      =>'header-submenu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header submenu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#616161',
				        'hover'    => '#212121',
				    )
				),

				array(
					'id'       =>'header-submenu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Submenu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust submenu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'letter-spacing' => false,
					'color'          => false,
					'text-align'     => false,
					'default'     => array(
				        'font-weight'    => '500', 
				        'font-family'    => 'Roboto', 
				        'font-size'      => '16px', 
				        'line-height'    => '26px'
				    )
				),

				array(
					'id'      =>'header-submenu-hover-effect',
					'type'     => 'select',
					'title'    => esc_html__('Choose submenu hover effect', 'enovathemes-addons'),
					'options'  => array(
						"none" => "None",
						"line" => "Line",
						"fill"  => "Fill",
						"outline"   => "Outline",
					),
					'default' => "none"
				),

				array(
					'id'       =>'header-submenu-effect-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header submenu hover effect color', 'enovathemes-addons'), 
					'default'  => array(
						'color' => '#fd8c40',
						'alpha' => '1'
					),
				),

				array(
					'id'       =>'header-submenu-effect',
					'type'     => 'select',
					'title'    => esc_html__('Choose submenu effect', 'enovathemes-addons'),
					'options'  => array(
						'ghost' =>'Ghost',
						'fade'  =>'Fade',
					),
					'default'  => 'ghost'
				),

				array(
				    'id'   => 'header-info-sticky',
				    'type' => 'info',
				    'desc' => esc_html__('Sticky header options', 'enovathemes-addons'),
				    'required' => array('sticky-header','equals',1)
				),

				array(
					'id'       =>'sticky-header-height',
					'type'     => 'slider',
					'title'    => esc_html__('Header height', 'enovathemes-addons'),
					'subtitle' => esc_html__('This option do not work with "Header under slider" option active', 'enovathemes-addons'),
					'min'      =>'60', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'96',
					'required' => array('sticky-header','equals',1)
				),
				
				array(
					'id'       =>'sticky-language-switcher-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Language switcher background color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'       =>'sticky-language-switcher-back-hov-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Language switcher hover background color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'       =>'sticky-language-switcher-text-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Language switcher text color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'      =>'sticky-header-menu-separator-color',
					'type'    => 'color_rgba', 
					'title'   => esc_html__('Menu items separator color', 'enovathemes-addons'),
				    'required' => array(array('sticky-header','equals',1),array('header-menu-separator','equals',1)),
				),
				array(
					'id'       =>'sticky-header-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Choose icons color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'       =>'sticky-header-social-links-color',
					'type'     => 'link_color', 
					'title'    => esc_html__('Header social links colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('header-social-links','equals',1),array('sticky-header','equals',1))
				),
				array(
					'id'       =>'sticky-header-social-links-border-color',
					'type'     => 'link_color', 
					'title'    => esc_html__('Header social links border colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('header-social-links','equals',1),array('sticky-header','equals',1))
				),
				array(
					'id'       =>'sticky-header-social-links-back-color',
					'type'     => 'link_color', 
					'title'    => esc_html__('Header social links background colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('header-social-links','equals',1),array('sticky-header','equals',1))
				),
				array(
					'id'       =>'sticky-cart-bubble-text-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header shopping cart bubble text color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'       => 'sticky-cart-bubble-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header shopping cart bubble background color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'       =>'sticky-header-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header background color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1) 
				),
				array(
					'id'       =>'sticky-header-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header border bottom color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1) 
				),
				array(
					'id'       =>'sticky-menu-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Menu background color', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Separate menu area background color. This option is availble only with "Menu under logo" option active (check in header quick styles)', 'enovathemes-addons'),
					'required' => array(array('menu-under-logo','equals',1),array('sticky-header','equals',1))
				),
				array(
					'id'       =>'sticky-menu-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Menu border top color', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Separate menu area border top color. This option is availble only with "Menu under logo" option active (check in header quick styles)', 'enovathemes-addons'),
					'required' => array(array('menu-under-logo','equals',1),array('sticky-header','equals',1))
				),
				array(
					'id'      =>'sticky-header-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header menu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'required' => array('sticky-header','equals',1)
				),
				array(
					'id'       =>'sticky-header-menu-effect-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header menu effect color', 'enovathemes-addons'),
					'required' => array('sticky-header','equals',1)
				)
		    )
		));
	
	/* Transparent
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Transparent header', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
				    'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
				    'desc' => esc_html__('Enable transparent header. You can controll the header style from each page edit screen with "Page extended options" under main editor. From there you can choose header style version "Normal"/"Transparent". Here you can adjust transparent header quick styles and choose header style version for Blog, Projects and Shop', 'enovathemes-addons')
				),
				array(
					'id'       =>'transparent-header-blog',
					'type'     => 'switch',
					'title'    => esc_html__('Transparent header blog', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'transparent-header-project',
					'type'     => 'switch',
					'title'    => esc_html__('Transparent header project', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'transparent-header-shop',
					'type'     => 'switch',
					'title'    => esc_html__('Transparent header shop', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'transparent-header-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header background color', 'enovathemes-addons'), 
					'default'  => array(
						'color' => '#ffffff',
						'alpha' => '0'
					),
				),
				array(
					'id'      =>'transparent-header-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Header menu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
						'regular' => '#ffffff',
						'hover' => '#ffffff'
					),
				),
				array(
					'id'       =>'transparent-header-menu-effect-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Header menu effect color', 'enovathemes-addons'),
					'default'  => array(
						'color' => '#ffffff',
						'alpha' => '1'
					),
				),
				array(
					'id'      =>'transparent-header-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Choose icons color', 'enovathemes-addons'),
					'default' => '#ffffff'
				),
		    )
		));

	/* Minicart
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Woocommerce mini cart', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
					'id'      =>'header-shop-cart',
					'type'    => 'switch', 
					'title'   => esc_html__('Toggle shopping cart in header', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Available with WooCommerce installed and active', 'enovathemes-addons'),
					"default" => 0
				),
				array(
					'id'      =>'mob-header-shop-cart',
					'type'    => 'switch', 
					'title'   => esc_html__('Toggle shopping cart in mobile header', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Available with WooCommerce installed and active', 'enovathemes-addons'),
					"default" => 0,
					'required' => array('header-shop-cart','equals',1)
				),
				array(
					'id'       =>'header-shop-cart-back-color',
					'type'     => 'color',
					'title'    => esc_html__('Header shopping cart background color', 'enovathemes-addons'), 
					'default'  => '#ffffff',
			    	'required' => array('header-shop-cart','equals',1)
				),
				array(
					'id'       =>'header-shop-cart-text-color',
					'type'     => 'color',
					'title'    => esc_html__('Header shopping cart text color', 'enovathemes-addons'), 
					'default'  => '#616161',
			    	'required' => array('header-shop-cart','equals',1)
				),
				array(
					'id'       =>'header-shop-cart-title-color',
					'type'     => 'color',
					'title'    => esc_html__('Header shopping cart product title color', 'enovathemes-addons'), 
					'default'  => '#212121',
			    	'required' => array('header-shop-cart','equals',1)
				),
				array(
					'id'       => 'header-shop-cart-button-back',
					'type'     => 'link_color',
					'title'    => esc_html__('Product button background color regular/hover', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
						'regular' => '#ffffff',
						'hover'   => '#fd8c40', 
					),
					'required' => array('header-shop-cart','equals',1)
				),
				array(
					'id'       =>'header-shop-cart-button-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Product button text color regular/hover', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#616161',
						'hover'    => '#ffffff'
					),
					'required' => array('header-shop-cart','equals',1)
				),
				array(
					'id'       =>'header-shop-cart-button-border-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Product button border regular/hover', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#e0e0e0',
						'hover'    => '#fd8c40'
					),
					'required' => array('header-shop-cart','equals',1)
				),
				
		    )
		));

	/* Megamenu
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Megamenu', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(

				array(
					'id'       =>'megamenu-top-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Megamenu top level items typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust megamenu top level items typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => true,
					'text-align'     => false,
					'font-size'      => true,
					'font-family'    => true,
					'font-style'     => false,
					'default'     => array(
				        'font-weight'    => '700', 
				        'font-family'    => 'Montserrat', 
				        'font-size'      => '12px', 
				        'letter-spacing' => '1px',
				        'text-transform' => 'uppercase',
				        'color'          => '#212121'
				    )
				),
				array(
					'id'       =>'megamenu-top-border',
					'type'     => 'color',
					'title'    => esc_html__('Megamenu top level items border bottom', 'enovathemes-addons'), 
					'default'  => '#e0e0e0'
				),
				array(
					'id'      =>'megamenu_links',
					'type'    => 'link_color', 
					'title'   => esc_html__('Megamenu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#616161',
				        'hover'    => '#ffffff',
				    )
				),
			)
		));

	/* Mobile header
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Mobile header', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
					'id'       =>'mob-header-height',
					'type'     => 'slider',
					'title'    => esc_html__('Header height', 'enovathemes-addons'),
					'min'      =>'60', 
					'max'      =>'250', 
					'step'     =>'10',
					'default'  =>'80'
				),
				array(
					'id'      =>'mob-header-search',
					'type'    => 'switch', 
					'title'   => esc_html__('Mobile header search', 'enovathemes-addons'),
					"default" => 1,
				),
				array(
					'id'      =>'mob-header-sidebar',
					'type'    => 'switch', 
					'title'   => esc_html__('Sidebar toggle', 'enovathemes-addons'),
					"default" => 0,
					'subtitle'=> esc_html__('Available with active Sidebar (not the Sidebar navigation)', 'enovathemes-addons'),
				),
				array(
					'id'      =>'mob-header-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Icons color', 'enovathemes-addons'),
					'default' => "#bdbdbd"
				),
				array(
					'id'      =>'transparent-mob-header-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Transparent icons color', 'enovathemes-addons'),
					'description' => esc_html__('When transparent desktop header is set the mobile version will automatically inherit style from this option', 'enovathemes-addons'),
					'default' => "#ffffff"
				),
				array(
					'id'       =>'mob-header-logo-back-color',
					'type'     => 'color',
					'title'    => esc_html__('Mobile header background color', 'enovathemes-addons'), 
					'default'  => '#ffffff'
				),
				array(
					'id'       =>'transparent-mob-header-logo-back-color',
					'type'     => 'color',
					'title'    => esc_html__('Transparent mobile header background color', 'enovathemes-addons'), 
					'description' => esc_html__('When transparent desktop header is set the mobile version will automatically inherit style from this option', 'enovathemes-addons'),
					'default' => "transparent"
				),
				array(
					'id'       =>'mob-header-back-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Mobile navigation background color regular/hover', 'enovathemes-addons'), 
					'active'   => false,
					'visisted' => false,
					'default'   => array(
				        'regular'   => '#ffffff',
				        'hover'     => '#f5f5f5',
				    )
				),
				array(
					'id'      =>'mob-header-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Mobile navigation text color regular/hover', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#424242',
				        'hover'    => '#212121',
				    )
				),
				array(
					'id'       =>'mob-header-menu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Menu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust menu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'default'     => array(
				        'font-weight'    => '700', 
				        'font-family'    => 'Montserrat', 
				        'font-size'      => '12px',
				        'letter-spacing' => '1px',
				    )
				),
		    )
		));

	/* Language switcher
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Custom language switcher', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(

		    	array(
					'id'      =>'language-switcher',
					'type'    => 'switch', 
					'title'   => esc_html__('Toggle custom language switcher', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Available with WPML installed and active', 'enovathemes-addons'),
					"default" => 0
				),

				array(
					'id'      =>'mob-language-switcher',
					'type'    => 'switch', 
					'title'   => esc_html__('Toggle custom language switcher on mobile', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Available with WPML installed and active', 'enovathemes-addons'),
					"default" => 0,
			    	'required' => array('language-switcher','equals',1)
				),

				array(
					'id'       =>'language-switcher-width',
					'type'     => 'dimensions',
					'title'    => esc_html__('Set width of dropdown list of languagies in px', 'enovathemes-addons'),
					'subtitle' => esc_html__('WPML Language switch has different content, so list width will vary with the content. Make sure you have WPML Plugin installed and active', 'enovathemes-addons'),
					'height'   => false,
					'units'    => 'px',
					"default" => array(
				        'width' => '164', 
				    ),
			    	'required' => array('language-switcher','equals',1)
				),

				array(
					'id'       =>'language-switcher-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Language switcher background color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#f5f5f5',
				        'alpha'     => 1
				    ),
			    	'required' => array('language-switcher','equals',1)
				),

				array(
					'id'       =>'language-switcher-back-hov-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Language switcher hover background color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#fd8c40',
				        'alpha'     => 1
				    ),
			    	'required' => array('language-switcher','equals',1) 
				),

				array(
					'id'       =>'language-switcher-text-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Language switcher text color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#424242',
				        'hover'    => '#ffffff',
				    ),
			    	'required' => array('language-switcher','equals',1)
				),

				array(
					'id'       =>'language-switcher-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Language switcher font size', 'enovathemes-addons'), 
					'units'          => 'px',
					'google'         => false,
					'subsets'        => false,
					'all_styles'     => false,
					'text-transform' => false,
					'font-family'    => false,
					'font-weight'    => false,
					'font-style'     => false,
					'letter-spacing' => false,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'font-size'      => true,
			    	'required' => array('language-switcher','equals',1)
				)
			)
		));

	/* Sidebar menu
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Sidebar menu', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
					'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
					'desc' => esc_html__('Important! If you want to use "Sidebar menu" make sure "Fullscreen menu" and "Layout Boxed"/"Layout Frame" (from Theme Settings >> General >> "Layout") options are inactive', 'enovathemes-addons')
				),
				array(
					'id'      =>'sidebar-navigation',
					'type'    => 'switch', 
					'title'   => esc_html__('Sidebar navigation', 'enovathemes-addons'),
					"default" => 0,
				),
				array(
					'id'       =>'sidebar-logo',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Sidebar logo upload', 'enovathemes-addons'),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-logo-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Sidebar retina logo upload', 'enovathemes-addons'),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-logo-margin',
					'type'     => 'spacing',
					'mode'     => 'margin',
					'units'    => array('px'),
					'right' => false,
					'left' => false, 
					'title'    => esc_html__('Sidebar logo margin top/bottom', 'enovathemes-addons'),
					'default' => array(
				        'margin-top'     => '48px', 
				        'margin-bottom'  => '48px',
				        'units'          => 'px', 
				    ),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-position',
					'type'     => 'select',
					'title'    => esc_html__('Sidebar postion', 'enovathemes-addons'),
					'options'   => array(
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
					),
					'default' => 'left',
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-alignment',
					'type'     => 'select',
					'title'    => esc_html__('Sidebar content alignment', 'enovathemes-addons'),
					'options'   => array(
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
						'center' => esc_html__('Center', 'enovathemes-addons'),
					),
					'default' => 'left',
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       => 'sidebar-back',
					'type'     => 'color',
					'title'    => esc_html__('Sidebar background color', 'enovathemes-addons'),
					'default'  => '#ffffff',
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       => 'sidebar-back-img',
					'type'     => 'background',
					'title'    => esc_html__('Sidebar background image', 'enovathemes-addons'),
					'background-color' => false,
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'      =>'sidebar-menu-vertical',
					'type'    => 'switch', 
					'title'   => esc_html__('Sidebar menu vertical alignment middle', 'enovathemes-addons'),
					"default" => 1,
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-menu-margin',
					'type'     => 'spacing',
					'units'    => array('px'),
					'mode'     => 'margin',
					'right' => false,
					'left' => false, 
					'title'    => esc_html__('Sidebar menu margin top/bottom', 'enovathemes-addons'),
					'default' => array(
				        'margin-top'     => '0px', 
				        'margin-bottom'  => '0px',
				        'units'          => 'px', 
				    ),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'      =>'sidebar-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Sidebar menu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#757575',
				        'hover'    => '#fd8c40',
				    ),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-menu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Sidebar menu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust menu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'default'     => array(
				        'font-weight'    => '700', 
				        'font-family'    => 'Montserrat', 
				        'font-size'      => '16px',
				        'letter-spacing' => '0.5px',
				    ),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-menu-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Sidebar menu border color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#e0e0e0',
				        'alpha'     => 1
				    ),
			    	'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-submenu-effect',
					'type'     => 'select',
					'title'    => esc_html__('Choose submenu effect (works only for desktop)', 'enovathemes-addons'),
					'options'  => array(
						'ghost' =>'Ghost',
						'fade'  =>'Fade',
					),
					'default'  => 'ghost',
					'required' => array('sidebar-navigation','equals',1)
				),
				array(
					'id'       =>'sidebar-copyright',
					'type'     => 'editor',
					'title'    => esc_html__('Sidebar copyright', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Add simple/html text or any shortcode to "Sidebar copyright"', 'enovathemes-addons'), 
					'default'  => 'Created by Enovathemes',
			    	'required' => array('sidebar-navigation','equals',1)
				)
			)
		));

	/* Fullscreen menu
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Fullscreen menu', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
		    	array(
					'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
					'desc' => esc_html__('Important! If you want to use "Fullscreen menu" make sure "Sidebar menu" option is inactive', 'enovathemes-addons')
				),
				array(
					'id'      =>'fullscreen-navigation',
					'type'    => 'switch', 
					'title'   => esc_html__('Fullscreen menu', 'enovathemes-addons'),
					"default" => 0,
				),
				array(
					'id'       =>'fullscreen-transparent',
					'type'     => 'switch',
					'title'    => esc_html__('Fullscreen header bar transparent header', 'enovathemes-addons'),
					'subtitle' => esc_html__('Fullscreen header bar transparent header position, not the transparent header bar background color. To make header bar background color transparent set transparent background color to header bar from the options below (Find the option: "Fullscreen header bar background color").', 'enovathemes-addons'),
					"default"  => 0,
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-sticky',
					'type'     => 'switch',
					'title'    => esc_html__('Sticky fullscreen bar', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle this option if you want your fullscreen header bar to be sticky', 'enovathemes-addons'),
					"default"  => 0,
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-full-header',
					'type'     => 'switch',
					'title'    => esc_html__('Full width header', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle this option if you want your fullscreen header bar to be full width', 'enovathemes-addons'),
					"default"  => 0,
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-logo-position',
					'type'     => 'select',
					'title'    => esc_html__('Logo postion', 'enovathemes-addons'),
					'subtitle' => esc_html__('Align the logo in fullscreen header bar', 'enovathemes-addons'),
					'options'   => array(
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
						'center' => esc_html__('Center', 'enovathemes-addons'),
					),
					'default' => 'left',
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-height',
					'type'     => 'slider',
					'title'    => esc_html__('Fullscreen header bar height', 'enovathemes-addons'),
					'min'      =>'60', 
					'max'      =>'250', 
					'step'     =>'10',
					'default'  =>'96',
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'      =>'fullscreen-search',
					'type'    => 'switch', 
					'title'   => esc_html__('Fullscreen search', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Activate this option and check "Modal header search background color" and "Modal header search background opacity" options in "Standard header" section', 'enovathemes-addons'),
					"default" => 0,
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'      =>'fullscreen-social-links',
					'type'    => 'switch', 
					'title'   => esc_html__('Fullscreen bar social links', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Make sure you added social links from Theme Settings >> Social', 'enovathemes-addons'),
					"default" => 0,
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'      =>'fullscreen-social-links-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Fullscreen bar social links colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#ffffff',
				        'hover'    => '#fd8c40',
				    ),
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1))
				),
				array(
					'id'      =>'fullscreen-social-links-border-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Fullscreen bar social links border colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1))
				),
				array(
					'id'      =>'fullscreen-social-links-back-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Fullscreen bar social links background colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1))
				),
				array(
					'id'       =>'fullscreen-social-links-border-width',
					'type'     => 'slider',
					'title'    => esc_html__('Fullscreen bar social links border width', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'5', 
					'step'     =>'1',
					'default'  =>'0',
					'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1))
				),
				array(
					'id'       =>'fullscreen-social-links-border-radius',
					'type'     => 'slider',
					'title'    => esc_html__('Fullscreen bar social links border radius', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'50', 
					'step'     =>'1',
					'default'  =>'0',
					'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1))
				),
				array(
					'id'      =>'fullscreen-language-switcher',
					'type'    => 'switch', 
					'title'   => esc_html__('Toggle custom enovathemes language switcher in fullscreen header bar', 'enovathemes-addons'),
					'subtitle'=> esc_html__('Available with WPML installed and active. For styling options, please check "Standard header" section', 'enovathemes-addons'),
					"default" => 0,
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1))
				),
				array(
					'id'      =>'fullscreen-header-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Choose icons color', 'enovathemes-addons'),
					'default' => "#ffffff",
			    	'required' => array(array('fullscreen-navigation','equals',1))
				),
				array(
					'id'      =>'fullscreen-header-icons-size',
					'type'     => 'select',
					'title'    => esc_html__('Choose icons size', 'enovathemes-addons'),
					'options'  => array(
						"small"  => "Small",
						"medium" => "Medium",
						"large"  => "Large"
					),
					'default' => "medium",
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Fullscreen header bar background color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 0
				    ),
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Fullscreen header bar border bottom color', 'enovathemes-addons'),
			    	'required' => array('fullscreen-navigation','equals',1) 
				),
				array(
				    'id'   => 'fullscreen-info-menu',
				    'type' => 'info',
				    'desc' => esc_html__('Fullscreen menu options', 'enovathemes-addons'),
				    'required' => array('fullscreen-navigation','equals',1) 
				),
				array(
					'id'      =>'fullscreen-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Fullscreen menu links color', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#ffffff',
				        'hover'    => '#ffffff',
				    ),
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-menu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Fullscreen menu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust menu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'default'     => array(
				        'font-weight'    => '700', 
				        'font-family'    => 'Montserrat', 
				        'font-size'      => '28px',
				        'text-transform' => 'uppercase',
				        'letter-spacing' => '2px'
				    ),
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-menu-effect-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Fullscreen menu effect color', 'enovathemes-addons'),
					'default'  => array(
						'color' => '#fd8c40',
						'alpha'   => '1', 
					),
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-logo',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Fullscreen modal logo upload', 'enovathemes-addons'),
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-logo-retina',
					'type'     => 'media', 
					'url'      => false,
					'title'    => esc_html__('Fullscreen modal retina logo upload', 'enovathemes-addons'),
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       => 'fullscreen-back',
					'type'     => 'color',
					'title'    => esc_html__('Fullscreen menu modal background color', 'enovathemes-addons'),
					'default'  => '#000000',
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
					'id'       =>'fullscreen-opacity',
					'type'     => 'slider',
					'title'    => esc_html__('Fullscreen menu modal background transparency', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'10', 
					'step'     =>'1',
					'default'  =>'9',
			    	'required' => array('fullscreen-navigation','equals',1)
				),
				array(
				    'id'   => 'fullscreen-info-sticky',
				    'type' => 'info',
				    'desc' => esc_html__('Sticky fullscreen bar options', 'enovathemes-addons'),
				    'required' => array('fullscreen-sticky','equals',1)
				),
				array(
					'id'       =>'fullscreen-sticky-height',
					'type'     => 'slider',
					'title'    => esc_html__('Sticky fullscreen header bar height', 'enovathemes-addons'),
					'min'      =>'60', 
					'max'      =>'250', 
					'step'     =>'10',
					'default'  =>'90',
			    	'required' => array(array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),
				array(
					'id'      =>'fullscreen-sticky-icons-color',
					'type'     => 'color',
					'title'    => esc_html__('Choose sticky fullscreen header bar icons color', 'enovathemes-addons'),
					'default' => "#b6b6b6",
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),

				array(
					'id'      =>'fullscreen-sticky-social-links-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Sticky fullscreen bar social links colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),
				array(
					'id'      =>'fullscreen-sticky-social-links-border-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Sticky fullscreen bar social links border colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),
				array(
					'id'      =>'fullscreen-sticky-social-links-back-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Sticky fullscreen bar social links background colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
			    	'required' => array(array('fullscreen-social-links','equals',1),array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),
				array(
					'id'       =>'fullscreen-sticky-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Sticky fullscreen header bar background color', 'enovathemes-addons'),
			    	'required' => array(array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),
				array(
					'id'       =>'fullscreen-sticky-border-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Sticky fullscreen header bar border bottom color', 'enovathemes-addons'),
			    	'required' => array(array('fullscreen-navigation','equals',1),array('fullscreen-sticky','equals',1))
				),
			)
		));

	/* Footer menu
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Footer menu', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields' => array(
				array(
					'id'      =>'footer-menu-color',
					'type'    => 'link_color', 
					'title'   => esc_html__('Footer menu colors', 'enovathemes-addons'),
					'active'   => false,
					'visited'  => false,
					'default'  => array(
				        'regular'  => '#BDBDBD',
				        'hover'    => '#ffffff',
				    ),
				),
				array(
					'id'       =>'footer-menu-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Footer menu typography', 'enovathemes-addons'), 
					'subtitle' => esc_html__('Adjust footer menu typography', 'enovathemes-addons'),
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'text-transform' => true,
					'font-family'    => true,
					'letter-spacing' => true,
					'line-height'    => false,
					'color'          => false,
					'text-align'     => false,
					'default'   => array(
				        'font-weight' 	 => '600', 
				        'font-family' 	 => 'Montserrat', 
				        'font-size'   	 => '16px',
				        'letter-spacing' => '0.5px',
				        'text-transform' => ''
				    ),
				),
			)
		));

/* Typography
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Typography', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-font',
	    'fields'     => array(
	    	array(
				'id'       =>'main-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Main typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => true,
				'font-style'     => false,
				'font-weight'    => true,
				'color'          => true,
				'text-align'     => false,
				'font-family'    => true,
				'all_styles'     => true,
				'default'     => array(
					'font-family'    => 'Roboto',
			        'font-size'      => '16px', 
			        'font-weight'    => '400', 
			        'line-height'    => '28px', 
			        'letter-spacing' => '0.5px', 
			        'color'          => '#616161',
			    )
			),

			array(
				'id'       =>'headings-typo',
				'type'     => 'typography',
				'title'    => esc_html__('Headings typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => true,
				'letter-spacing' => true,
				'line-height'    => false,
				'font-style'     => false, 
				'font-size'      => false,
				'font-weight'    => true,
				'color'          => true,
				'text-align'     => false,
				'font-family'    => true,
				'all_styles'     => true,
				'default'     => array(
					'font-family'    => 'Montserrat',
			        'font-weight'    => '700', 
			        'letter-spacing' => '0',
			        'color'          => '#212121'
			    )
			),

			array(
				'id'       =>'h1-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H1 typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false, 
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '48px',
			        'line-height' => '56px'
			    )
			),

			array(
				'id'       =>'h2-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H2 typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false, 
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '40px',
			        'line-height' => '48px'
			    )
			),

			array(
				'id'       =>'h3-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H3 typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false, 
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '32px',
			        'line-height' => '40px'
			    )
			),

			array(
				'id'       =>'h4-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H4 typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false, 
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '24px',
			        'line-height' => '32px'
			    )
			),

			array(
				'id'       =>'h5-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H5 typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false, 
				'font-size'      => true,
				'font-weight'    => false,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '20px',
			        'line-height' => '28px'
			    )
			),

			array(
				'id'       =>'h6-typo',
				'type'     => 'typography',
				'title'    => esc_html__('H6 typography', 'enovathemes-addons'), 
				'units'          => 'px',
				'google'         => true,
				'subsets'        => true,
				'all_styles'     => true,
				'text-transform' => false,
				'letter-spacing' => false,
				'line-height'    => true,
				'font-style'     => false, 
				'font-weight'    => false, 
				'font-size'      => true,
				'color'          => false,
				'text-align'     => false,
				'font-family'    => false,
				'default'     => array(
			        'font-size'   => '16px',
			        'line-height' => '24px'
			    )
			),
        )
	));

/* Social
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Social', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-group',
	    'fields'     => array(

			array(
				'id'      =>'tweets-consumer-key',
				'type'     => 'text',
				'title'    => esc_html__('Recent tweets consumer key', 'enovathemes-addons'),
				'default'  => ''
			),

			array(
				'id'      =>'tweets-consumer-secret',
				'type'     => 'text',
				'title'    => esc_html__('Recent tweets consumer secret', 'enovathemes-addons'),
				'subtitle' => esc_html__('Enter your consumer key here', 'enovathemes-addons'),
				'default'  => ''
			),

			array(
				'id'      =>'tweets-access-token',
				'type'     => 'text',
				'title'    => esc_html__('Recent tweets access token', 'enovathemes-addons'),
				'subtitle' => esc_html__('Enter your access token here', 'enovathemes-addons'),
				'default'  => ''
			),

			array(
				'id'      =>'tweets-access-token-secret',
				'type'     => 'text',
				'title'    => esc_html__('Recent tweets access token secret', 'enovathemes-addons'),
				'subtitle' => esc_html__('Enter your access token secret here', 'enovathemes-addons'),
				'default'  => ''
			),

			array(
				'id'      =>'social-facebook',
				'type'     => 'text',
				'title'    => esc_html__('Facebook URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-twitter',
				'type'     => 'text',
				'title'    => esc_html__('Twitter URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-googleplus',
				'type'     => 'text',
				'title'    => esc_html__('Google Plus URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-vk',
				'type'     => 'text',
				'title'    => esc_html__('VK URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-youtube',
				'type'     => 'text',
				'title'    => esc_html__('Yotube URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-vimeo',
				'type'     => 'text',
				'title'    => esc_html__('Vimeo URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-linkedin',
				'type'     => 'text',
				'title'    => esc_html__('LinkedIn URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-pinterest',
				'type'     => 'text',
				'title'    => esc_html__('Pinterest URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-tripadvisor',
				'type'     => 'text',
				'title'    => esc_html__('Tripadviser URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-instagram',
				'type'     => 'text',
				'title'    => esc_html__('Instagram URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-apple',
				'type'     => 'text',
				'title'    => esc_html__('Apple URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-dribbble',
				'type'     => 'text',
				'title'    => esc_html__('Dribbble URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-android',
				'type'     => 'text',
				'title'    => esc_html__('Android URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-behance',
				'type'     => 'text',
				'title'    => esc_html__('Behance URL', 'enovathemes-addons'),
				'validate' => 'url',
				'default'  => ''
			),

			array(
				'id'      =>'social-email',
				'type'     => 'text',
				'title'    => esc_html__('Email URL', 'enovathemes-addons'),
				'default'  => ''
			)
		)
	));

/* Sidebar
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Sidebar', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-view-mode',
	    'fields' => array(
			array(
				'id'      =>'sidebar',
				'type'    => 'switch', 
				'title'   => esc_html__('Sidebar', 'enovathemes-addons'),
				"default" => 0,
			),
			array(
				'id'       =>'sidebar-padding',
				'type'     => 'spacing',
				'mode'     => 'padding',
				'units'    => array('px'),
				'title'    => esc_html__('Sidebar padding', 'enovathemes-addons'),
				'default' => array(
			        'padding-top'     => '48px', 
			        'padding-bottom'  => '48px',
			        'padding-left'    => '32px',
			        'padding-right'   => '32px',
			        'units'           => 'px', 
			    ),
			    'required' => array('sidebar','equals',1)
			),
			array(
				'id'       =>'sidebar-width',
				'type'     => 'slider',
				'title'    => esc_html__('Sidebar width', 'enovathemes-addons'),
				'min'      =>'240', 
				'max'      =>'480', 
				'step'     =>'1',
				'default'  =>'400',
			    'required' => array('sidebar','equals',1)
			),
			array(
				'id'      =>'sidebar-align',
				'type'     => 'select',
				'title'    => esc_html__('Choose sidebar alignment', 'enovathemes-addons'),
				'options'  => array(
					"left"  => "Left",
					"right" => "Right"
				),
				'default' => "right",
			    'required' => array('sidebar','equals',1)
			),
			array(
				'id'       =>'sidebar-background-color',
				'type'     => 'color',
				'title'    => esc_html__('Sidebar background color', 'enovathemes-addons'), 
				'default'  => '#212121',
			    'required' => array('sidebar','equals',1)
			),
		)
	));

/* Forms
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Forms', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-tasks'
	));

	/* General forms
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('General styles', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields'     => array(
				array(
					'id'       =>'form-text-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields text colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'  => array(
				        'regular' => '#616161',
				        'hover'   => '#424242',
				    )
				),
				array(
					'id'       =>'form-back-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields background colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'   => array(
				        'regular' => '#ffffff',
				        'hover'   => '#ffffff',
				    ) 
				),
				array(
					'id'       =>'form-border-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields border colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'   => array(
				        'regular' => '#e0e0e0',
				        'hover'   => '#bdbdbd',
				    ) 
				),
				array(
					'id'       =>'form-button-typo',
					'type'     => 'typography',
					'title'    => esc_html__('Button typography', 'enovathemes-addons'), 
					'units'          => 'px',
					'google'         => true,
					'subsets'        => true,
					'all_styles'     => true,
					'font-weight'    => true,
					'font-size'      => false,
					'font-family'    => true,
					'letter-spacing' => true,
					'text-transform' => true,
					'line-height'    => false,
					'font-style'     => false,
					'color'          => false,
					'text-align'     => false,
					'text-transform' => false,
					'word-spacing'   => false,
					'default'     => array(
						'font-weight'    => '700',
						'font-family'    => 'Montserrat',
						'letter-spacing' => '0.5px',
				    )
				),
				array(
					'id'      =>'form-button-radius',
					'type'     => 'slider',
					'title'    => esc_html__('Button border radius', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'250', 
					'step'     =>'1',
					'default'  =>'0'
				),
				array(
					'id'      =>'form-button-size',
					'type'     => 'select',
					'title'    => esc_html__('Button size', 'enovathemes-addons'),
					'options'  => array(
						'small'      => 'Small', 
						'medium'     => 'Medium', 
						'large'      => 'Large',
					),
					'default' => "medium"
				),
				array(
					'id'       => 'form-button-back',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button background colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#fd8c40',
						'hover'    => '#212121'
					)
				),
				array(
					'id'       =>'form-button-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button text colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#ffffff',
						'hover'    => '#ffffff'
					)
				),
				array(
					'id'      =>'form-button-width',
					'type'     => 'slider',
					'title'    => esc_html__('Button border width', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'10', 
					'step'     =>'1',
					'default'  =>'0'
				),
				array(
					'id'       =>'form-button-border-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button border colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '',
						'hover'    => ''
					)
				),
				
		    )
		));
	
	/* Footer forms
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Footer styles', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields'     => array(
				array(
					'id'       =>'footer-form-text-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields text colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'  => array(
				        'regular' => '#9e9e9e',
				        'hover'   => '#616161',
				    )
				),
				array(
					'id'       =>'footer-form-back-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields background colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'   => array(
				        'regular' => '#ffffff',
				        'hover'   => '#ffffff',
				    ) 
				),
				array(
					'id'       =>'footer-form-border-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields border colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'   => array(
				        'regular' => '#ffffff',
				        'hover'   => '#ffffff',
				    ) 
				),
				array(
					'id'       => 'footer-form-button-back',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button background colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#fd8c40',
						'hover'    => '#ffffff'
					)
				),
				array(
					'id'       =>'footer-form-button-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button text colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#ffffff',
						'hover'    => '#212121'
					)
				),
				array(
					'id'       =>'footer-form-button-border-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button border colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '',
						'hover'    => ''
					)
				),
				
		    )
		));

	/* Sidebar forms
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Sidebar styles', 'enovathemes-addons'),
		    'subsection' => true,
		    'fields'     => array(
				array(
					'id'       =>'sidebar-form-text-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields text colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'  => array(
				        'regular' => '#9e9e9e',
				        'hover'   => '#616161',
				    )
				),
				array(
					'id'       =>'sidebar-form-back-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields background colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'   => array(
				        'regular' => '#ffffff',
				        'hover'   => '#ffffff',
				    ) 
				),
				array(
					'id'       =>'sidebar-form-border-color',
					'type'     => 'link_color',
					'title'    => esc_html__('Forms fields border colors', 'enovathemes-addons'),
					'visited'  => false,
					'active'    => false,
					'default'   => array(
				        'regular' => '#ffffff',
				        'hover'   => '#ffffff',
				    ) 
				),
				array(
					'id'       => 'sidebar-form-button-back',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button background colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#fd8c40',
						'hover'    => '#ffffff'
					)
				),
				array(
					'id'       =>'sidebar-form-button-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button text colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '#ffffff',
						'hover'    => '#212121'
					)
				),
				array(
					'id'       =>'sidebar-form-button-border-color',
					'type'     => 'link_color',
					'active'   => false,
					'visited'  => false,
					'title'    => esc_html__('Button border colors', 'enovathemes-addons'),
					'default'  => array(
						'regular'  => '',
						'hover'    => ''
					)
				),
				
		    )
		));

/* Widgets
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Widgets styling', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-cogs',
	    'fields'     => array(
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Sidebar widgets styling', 'enovathemes-addons')
			),
	    	array(
				'id'       =>'sidebar-widgets-text-color',
				'type'     => 'color',
				'title'    => esc_html__('Widgets text color', 'enovathemes-addons'),
				'default'  => '#bdbdbd'
			),
			array(
				'id'       =>'sidebar-widgets-title-color',
				'type'     => 'color',
				'title'    => esc_html__('Widgets titles color', 'enovathemes-addons'),
				'default'  => '#ffffff'
			),
	    	array(
				'id'       =>'sidebar-widgets-link-color',
				'type'     => 'link_color',
				'active'   => false,
				'visited'  => false,
					'title'    => esc_html__('Widgets link colors', 'enovathemes-addons'),
				'default'  => array(
					'regular' => '#bdbdbd',
					'hover'   => '#ffffff'
				)
			),
			array(
			    'id'   => 'info_normal_'.$inc++,
					'class'=> 'info-normal',
			    'type' => 'info',
			    'desc' => esc_html__('Footer widgets styling', 'enovathemes-addons')
			),
	    	array(
				'id'       =>'footer-widgets-text-color',
				'type'     => 'color',
				'title'    => esc_html__('Widgets text color', 'enovathemes-addons'),
				'default'  => '#bdbdbd'
			),
			array(
				'id'       =>'footer-widgets-title-color',
				'type'     => 'color',
				'title'    => esc_html__('Widgets titles color', 'enovathemes-addons'),
				'default'  => '#ffffff'
			),
	    	array(
				'id'       =>'footer-widgets-link-color',
				'type'     => 'link_color',
				'active'   => false,
				'visited'  => false,
					'title'    => esc_html__('Widgets link colors', 'enovathemes-addons'),
				'default'  => array(
					'regular' => '#bdbdbd',
					'hover'   => '#ffffff'
				)
			),
	    )
	));

/* Blog
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Blog', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-pencil'
	));

	/* Blog title section
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Blog title section', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       =>'blog-title',
					'type'     => 'switch',
					'title'    => esc_html__('Blog title section', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle blog title section fot non-slider blogs.', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'      =>'blog-title-text',
					'type'     => 'text',
					'title'    => esc_html__('Blog title', 'enovathemes-addons'),
					'default'  => '',
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'      =>'blog-subtitle-text',
					'type'     => 'text',
					'title'    => esc_html__('Blog subtitle', 'enovathemes-addons'),
					'default'  => '',
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       => 'blog-title-back',
					'type'     => 'background',
					'title'    => esc_html__('Blog title section background options', 'enovathemes-addons'),
					'default'  => array(
						'background-image' => '',
						'background-repeat'=> 'no-repeat',
						'background-attachment'=> 'inherit',
						'background-size'=> 'inherit',
						'background-repeat'=> 'left top',
						'background-color' => '#fd8c40'
					),
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       =>'blog-title-parallax',
					'type'     => 'switch',
					'title'    => esc_html__('Blog title section parallax', 'enovathemes-addons'),
					'subtitle' => esc_html__('Works with background image set, and "Background attachment" option set to "Cover"', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       =>'blog-title-overlay',
					'type'     => 'switch',
					'title'    => esc_html__('Blog title section overlay', 'enovathemes-addons'),
					"default"  => 1,
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       =>'blog-title-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Blog title color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#212121',
				        'alpha'     => 1
				    ),
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       =>'blog-title-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Blog title background color', 'enovathemes-addons'),
					'default'  => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       =>'blog-subtitle-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Blog subtitle color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
					'required' => array('blog-title','equals',1)
				),
				array(
					'id'       =>'blog-subtitle-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Blog subtitle background color', 'enovathemes-addons'),
					'required' => array('blog-title','equals',1),
					'default'  => array(
				        'color'     => '',
				        'alpha'     => 0
				    )
				),
				array(
					'id'       =>'blog-breadcrumbs',
					'type'     => 'switch',
					'title'    => esc_html__('Breadcrumbs', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle blog-breadcrumbs on blog title sections', 'enovathemes-addons'),
					"default"  => 1,
					'required' => array('blog-title','equals',1)
				),
			)
		));

	/* Blog loop layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Blog loop layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       =>'blog-padding',
					'type'     => 'spacing',
					'mode'     => 'padding',
					'units'    => array('px'),
					'title'    => esc_html__('Blog area padding', 'enovathemes-addons'),
					'default' => array(
				        'padding-top'     => '96px', 
				        'padding-bottom'  => '96px',
				        'padding-left'    => '0px',
				        'padding-right'   => '0px',
				        'units'           => 'px', 
				    )
				),
				array(
					'id'        =>'blog-container',
					'type'      => 'radio',
					'title'     => esc_html__('Blog container', 'enovathemes-addons'), 
					'subtitle'  => esc_html__('Boxed container allows you to display posts aligned with the main container. Full container allows to display your posts in wide area. (Wide container does not work with sidebar enabled). Important! Wide container works only for desktop', 'enovathemes-addons'), 
					'options'   => array(
						'wide'  => esc_html__('Wide', 'enovathemes-addons'), 
						'boxed' => esc_html__('Boxed', 'enovathemes-addons'),
					),
					'default' => 'boxed',
				),
				array(
					'id'        =>'blog-sidebar',
					'type'      => 'select',
					'title'     => esc_html__('Blog sidebar position', 'enovathemes-addons'), 
					'options'   => array(
						'none'  => esc_html__('None', 'enovathemes-addons'), 
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
					),
					'default' => 'none',
				),
				array(
					'id'       =>'blog-navigation',
					'type'     => 'select',
					'title'    => esc_html__('Blog navigation', 'enovathemes-addons'),
					'subtitle' => esc_html__('Blog navigation', 'enovathemes-addons'),
					'options'  => array(
						'pagination'=>'Pagination',
						'loadmore'  =>'AJAX load more',
						'scroll'    =>'AJAX infinite scroll loading'
					),
					'default'  => 'pagination'
				),
				array(
					'id'       =>'blog-navigation-alignment',
					'type'     => 'select',
					'title'    => esc_html__('Blog navigation alignment', 'enovathemes-addons'),
					'subtitle' => esc_html__('Blog navigation alignment', 'enovathemes-addons'),
					'options'  => array(
						'left'=>'Left',
						'center'  =>'Center',
						'right'    =>'Right'
					),
					'default'  => 'center',
				),
			)
		));

	/* Blog loop post layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Blog loop post layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'blog-post-layout',
					'type'     => 'image_select',
					'title'    => esc_html__('Blog post layout', 'enovathemes-addons'),
					'width'    => '140', 
					'height'   => '140',
					'options'  => array(
						'grid' => array(
							'alt'   => 'Grid', 
							'title' => 'Grid', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'grid.png'
						),
						'masonry1' => array(
							'alt'   => 'Masonry 1', 
							'title' => 'Masonry 1', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'masonry1.png'
						),
						'masonry2' => array(
							'alt'   => 'Masonry 2', 
							'title' => 'Masonry 2', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'masonry2.png'
						),
						'list' => array(
							'alt'   => 'List', 
							'title' => 'List', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'list.png'
						),
						'full' => array(
							'alt'   => 'Full', 
							'title' => 'Full', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'full.png'
						),
					),
					'default' => 'grid'
				),
				array(
					'id'       =>'blog-reset-post-size',
					'type'     => 'switch',
					'title'    => esc_html__('Reset posts sizes to original', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle this option if you want to reset posts sizes in your Masonry2 layout', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('blog-post-layout','equals','masonry2')
				),
				array(
					'id'        =>'blog-post-size',
					'type'      => 'select',
					'title'     => esc_html__('Blog post size', 'enovathemes-addons'), 
					'options'   => array(
						'small'  => esc_html__('Small (1/4 - 25%)', 'enovathemes-addons'), 
						'medium' => esc_html__('Medium (1/3 - 33%)', 'enovathemes-addons'),
						'large'  => esc_html__('Large (1/2 - 50%)', 'enovathemes-addons'),
					),
					'default' => 'medium',
					'required' => array('blog-post-layout','equals',array('grid','masonry1','masonry2'))
				),
				array(
					'id'      =>'blog-animation-effect',
					'type'     => 'select',
					'title'    => esc_html__('Blog post animation effect', 'enovathemes-addons'),
					'options'  => array(
						"none"    => "None",
						"fadeIn"  => "Fade In",
						"moveUp"  => "Move Up",
					),
					'default' => "none"
				),
				array(
					'id'      =>'blog-image-effect',
					'type'     => 'select',
					'title'    => esc_html__('Blog hover effect', 'enovathemes-addons'),
					'options'  => array(
						"overlay-fade"               => "Overlay fade",
						"overlay-fade-zoom"          => "Overlay fade with image zoom",
						"overlay-fade-zoom-extreme"  => "Overlay fade with extreme image zoom",
						"overlay-move"               => "Overlay move fluid",
						"overlay-scale-in"           => "Overlay scale in",
					),
					'default' => "overlay-fade"
				),
				array(
					'id'       =>'blog-post-excerpt',
					'type'     => 'slider',
					'title'    => esc_html__('Blog post excerpt length', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'500', 
					'step'     =>'1',
					'default'  => '104'
				),
				array(
					'id'       =>'blog-post-title-min-height',
					'type'     => 'slider',
					'title'    => esc_html__('Blog post title minimum height', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'500', 
					'step'     =>'1',
					'default'  => '0'
				),
			)
		));

	/* Blog single layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Blog single layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'        =>'blog-single-sidebar',
					'type'      => 'select',
					'title'     => esc_html__('Blog single post sidebar position', 'enovathemes-addons'), 
					'options'   => array(
						'none'  => esc_html__('None', 'enovathemes-addons'), 
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
					),
					'default' => 'right',
				),
				array(
					'id'       =>'blog-single-social',
					'type'     => 'switch',
					'title'    => esc_html__('Blog single post social share', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'blog-related-posts',
					'type'     => 'switch',
					'title'    => esc_html__('Related posts', 'enovathemes-addons'),
					"default"  => 1
				),
			)
		));

/* Project
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Project', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-folder-close'
	));

	/* Project title section
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Project title section', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       =>'project-title',
					'type'     => 'switch',
					'title'    => esc_html__('Project title section', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle project title section fot non-slider projects.', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'      =>'project-title-text',
					'type'     => 'text',
					'title'    => esc_html__('Project title', 'enovathemes-addons'),
					'default'  => '',
					'required' => array('project-title','equals',1)
				),
				array(
					'id'      =>'project-subtitle-text',
					'type'     => 'text',
					'title'    => esc_html__('Project subtitle', 'enovathemes-addons'),
					'default'  => '',
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       => 'project-title-back',
					'type'     => 'background',
					'title'    => esc_html__('Project title section background options', 'enovathemes-addons'),
					'default'  => array(
						'background-image' => '',
						'background-repeat'=> 'no-repeat',
						'background-attachment'=> 'inherit',
						'background-size'=> 'inherit',
						'background-repeat'=> 'left top',
						'background-color' => '#fd8c40'
					),
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       =>'project-title-parallax',
					'type'     => 'switch',
					'title'    => esc_html__('Project title section parallax', 'enovathemes-addons'),
					'subtitle' => esc_html__('Works with background image set, and "Background attachment" option set to "Cover"', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       =>'project-title-overlay',
					'type'     => 'switch',
					'title'    => esc_html__('Project title section overlay', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       =>'project-title-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Project title section title color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#212121',
				        'alpha'     => 1
				    ),
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       =>'project-title-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Project title section title background color', 'enovathemes-addons'),
					'default'  => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       =>'project-subtitle-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Project title section subtitle color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
					'required' => array('project-title','equals',1)
				),
				array(
					'id'       =>'project-subtitle-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Project title section subtitle background color', 'enovathemes-addons'),
					'required' => array('project-title','equals',1),
					'default'  => array(
				        'color'     => '',
				        'alpha'     => 0
				    )
				),
				array(
					'id'       =>'project-breadcrumbs',
					'type'     => 'switch',
					'title'    => esc_html__('Breadcrumbs', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle breadcrumbs on project title sections', 'enovathemes-addons'),
					"default"  => 1,
					'required' => array('project-title','equals',1)
				),
			)
		));
	
	/* Project loop layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Project loop layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       =>'project-padding',
					'type'     => 'spacing',
					'mode'     => 'padding',
					'units'    => array('px'),
					'title'    => esc_html__('Project area padding', 'enovathemes-addons'),
					'default' => array(
				        'padding-top'     => '96px', 
				        'padding-bottom'  => '96px',
				        'padding-left'    => '0px',
				        'padding-right'   => '0px',
				        'units'           => 'px', 
				    )
				),
				array(
					'id'        =>'project-container',
					'type'      => 'radio',
					'title'     => esc_html__('Project container', 'enovathemes-addons'), 
					'subtitle'  => esc_html__('Boxed container allows you to display projects aligned with the main container. Full container allows to display your projects in wide area. Important! Wide container works only for desktop', 'enovathemes-addons'), 
					'options'   => array(
						'wide'  => esc_html__('Wide', 'enovathemes-addons'), 
						'boxed' => esc_html__('Boxed', 'enovathemes-addons'),
					),
					'default' => 'boxed',
				),
				array(
					'id'       =>'project-filter',
					'type'     => 'switch',
					'title'    => esc_html__('Project AJAX filter', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle this option if you want to have AJAX powered filter for your projects', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'       =>'project-per-page',
					'type'     => 'slider',
					'title'    => esc_html__('Projects per page', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'999', 
					'step'     =>'1',
					'default'  => '9'
				),
				array(
					'id'       =>'project-navigation',
					'type'     => 'select',
					'title'    => esc_html__('Project navigation', 'enovathemes-addons'),
					'subtitle' => esc_html__('Project navigation', 'enovathemes-addons'),
					'options'  => array(
						'pagination'=>'Pagination',
						'loadmore'  =>'AJAX load more',
						'scroll'    =>'AJAX infinite scroll loading'
					),
					'default'  => 'pagination'
				),
				array(
					'id'       =>'project-navigation-alignment',
					'type'     => 'select',
					'title'    => esc_html__('Project navigation alignment', 'enovathemes-addons'),
					'subtitle' => esc_html__('Project navigation alignment', 'enovathemes-addons'),
					'options'  => array(
						'left'=>'Left',
						'center'  =>'Center',
						'right'    =>'Right'
					),
					'default'  => 'center',
				),
			)
		));
	
	/* Project loop item layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Project loop item layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       => 'project-post-layout',
					'type'     => 'image_select',
					'title'    => esc_html__('Project layout', 'enovathemes-addons'),
					'width'    => '140', 
					'height'   => '140',
					'options'  => array(
						'project-with-details' => array(
							'alt'   => 'Project with details', 
							'title' => 'Project with details', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'project_post_layout_1.png'
						),
						'project-with-caption' => array(
							'alt'   => 'Project with caption', 
							'title' => 'Project with caption', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'project_post_layout_2.png'
						),
						'project-with-overlay' => array(
							'alt'   => 'Project with overlay', 
							'title' => 'Project with overlay', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'project_post_layout_3.png'
						),
						'project-with-overlay-alt' => array(
							'alt'   => 'Project alternative', 
							'title' => 'Project alternative', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'project_post_layout_4.png'
						)
					),
					'default' => 'project-with-details'
				),
				array(
					'id'        =>'project-post-size',
					'type'      => 'select',
					'title'     => esc_html__('Project size', 'enovathemes-addons'), 
					'options'   => array(
						'small'  => esc_html__('Small (1/4 - 25%)', 'enovathemes-addons'), 
						'medium' => esc_html__('Medium (1/3 - 33%)', 'enovathemes-addons'),
						'large'  => esc_html__('Large (1/2 - 50%)', 'enovathemes-addons'),
					),
					'default' => 'medium',
				),
				array(
					'id'      =>'project-post-layout-type',
					'type'     => 'select',
					'title'    => esc_html__('Project layout type', 'enovathemes-addons'),
					'options'  => array(
						"grid"    => "Grid",
						"masonry2"  => "Masonry",
					),
					'default' => "grid"
				),
				array(
					'id'       =>'project-reset-post-size',
					'type'     => 'switch',
					'title'    => esc_html__('Reset projects sizes to original', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle this option if you want to reset projects sizes in your Masonry layout', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('project-post-layout-type','equals','masonry2')
				),
				array(
					'id'      =>'project-animation-effect',
					'type'     => 'select',
					'title'    => esc_html__('Project animation effect', 'enovathemes-addons'),
					'options'  => array(
						"none"    => "None",
						"fadeIn"  => "Fade In",
						"moveUp"  => "Move Up",
					),
					'default' => "none"
				),
				array(
					'id'       =>'project-gap',
					'type'     => 'switch',
					'title'    => esc_html__('Project gap', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'      =>'project-image-effect-details',
					'type'     => 'select',
					'title'    => esc_html__('Project hover effect', 'enovathemes-addons'),
					'options'  => array(
						"overlay-fade"               => "Overlay fade",
						"overlay-fade-zoom"          => "Overlay fade with image zoom",
						"overlay-fade-zoom-extreme"  => "Overlay fade with extreme image zoom",
						"overlay-scale-in"           => "Overlay scale in",
					),
					'default' => "overlay-fade",
					'required' => array('project-post-layout','equals','project-with-details')
				),
				array(
					'id'      =>'project-image-effect-caption',
					'type'     => 'select',
					'title'    => esc_html__('Project hover effect', 'enovathemes-addons'),
					'options'  => array(
						"caption-up"                 => "Caption up",
						"caption-up-image"           => "Caption up & image up",
						"caption-up-image-2"         => "Caption up & image up 2"
					),
					'default' => "overlay-fade",
					'required' => array('project-post-layout','equals','project-with-caption')
				),
				array(
					'id'      =>'project-image-effect-overlay',
					'type'     => 'select',
					'title'    => esc_html__('Project hover effect', 'enovathemes-addons'),
					'options'  => array(
						"overlay-fade"  			=> "Overlay fade",
						"overlay-fade-zoom"  		=> "Overlay fade with image zoom",
						"overlay-fade-zoom-extreme" => "Overlay fade with extreme image zoom",
						"overlay-move-up"  		    => "Overlay move up",
						"overlay-move-down"  		=> "Overlay move down",
						"overlay-move-left"  	    => "Overlay move left",
						"overlay-move-right"  		=> "Overlay move right",
						"image-move-up"  		    => "Image move up",
						"image-move-down"           => "Image move down",
						"image-move-left"           => "Image move left",
						"image-move-right"          => "Image move right",
						"overlay-image-move-up"     => "Overlay & image move up",
						"overlay-image-move-down"   => "Overlay & image move down",
						"overlay-image-move-left"   => "Overlay & image move left",
						"overlay-image-move-right"  => "Overlay & image move right",
						"overlay-move"              => "Overlay move fluid",
						"overlay-scale-in"          => "Overlay scale in",
						"overlay-flip-hor"          => "Overlay flip horizontal",
						"overlay-flip-ver"          => "Overlay flip vertical",
						"transform"                 => "Transform",

					),
					'default' => "overlay-fade",
					'required' => array('project-post-layout','equals','project-with-overlay')
				),
			)
		));

	/* Project single layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Project single layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'      =>'project-single-gallery-animation-effect',
					'type'     => 'select',
					'title'    => esc_html__('Single project gallery grid/masonry layout animation effect', 'enovathemes-addons'),
					'options'  => array(
						"none"    => "None",
						"fadeIn"  => "Fade In",
						"moveUp"  => "Move Up",
					),
					'default' => "none"
				),
				array(
					'id'      =>'project-single-gallery-hover-effect',
					'type'     => 'select',
					'title'    => esc_html__('Single project gallery grid/masonry hover effect', 'enovathemes-addons'),
					'options'  => array(
						"none"      => "None",
						"transform" => "Transform",
						"overlay-fade-zoom"  		=> "Image zoom",
						"overlay-fade-zoom-extreme" => "Extreme image zoom",
						"zoom-out"   => "Image zoom out",
					),
					'default' => "none"
				),
				array(
					'id'       =>'project-single-social',
					'type'     => 'switch',
					'title'    => esc_html__('Single project social share', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'       =>'project-related-projects',
					'type'     => 'switch',
					'title'    => esc_html__('Related projects', 'enovathemes-addons'),
					"default"  => 1
				),
			)
		));

	/* Project slug
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Project slug', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
					'desc' => esc_html__("Important! Don't forget to update/resave permalinks after the slug change", "enovathemes-addons")
				),
				array(
					'id'       =>'project-slug',
					'type'     => 'text',
					'title'    => esc_html__("Project slug", 'enovathemes-addons'),
					'default'  => 'project'
				),
				array(
					'id'       =>'project-cat-slug',
					'type'     => 'text',
					'title'    => esc_html__("Project category slug", 'enovathemes-addons'),
					'default'  => 'project-category'
				),
				array(
					'id'       =>'project-tag-slug',
					'type'     => 'text',
					'title'    => esc_html__("Project tag slug", 'enovathemes-addons'),
					'default'  => 'project-tag'
				),
			)
		));

/* Woo Commerce
---------------*/

	Redux::setSection( $opt_name, array(
		'title'      => esc_html__('Shop', 'enovathemes-addons'),
		'icon_class' => 'icon-small',
	    'icon'       => 'el-icon-shopping-cart',
	));

	/* Shop title section
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Shop title section', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       =>'product-title',
					'type'     => 'switch',
					'title'    => esc_html__('Shop title section', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle product title section fot non-slider products.', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'      =>'product-title-text',
					'type'     => 'text',
					'title'    => esc_html__('Product title', 'enovathemes-addons'),
					'default'  => '',
					'required' => array('product-title','equals',1)
				),
				array(
					'id'      =>'product-subtitle-text',
					'type'     => 'text',
					'title'    => esc_html__('Product subtitle', 'enovathemes-addons'),
					'default'  => '',
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       => 'product-title-back',
					'type'     => 'background',
					'title'    => esc_html__('Shop title section background options', 'enovathemes-addons'),
					'default'  => array(
						'background-image' => '',
						'background-repeat'=> 'no-repeat',
						'background-attachment'=> 'inherit',
						'background-size'=> 'inherit',
						'background-repeat'=> 'left top',
						'background-color' => '#fd8c40'
					),
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       =>'product-title-parallax',
					'type'     => 'switch',
					'title'    => esc_html__('Shop title section parallax', 'enovathemes-addons'),
					'subtitle' => esc_html__('Works with background image set, and "Background attachment" option set to "Cover"', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       =>'product-title-overlay',
					'type'     => 'switch',
					'title'    => esc_html__('Product title section overlay', 'enovathemes-addons'),
					"default"  => 0,
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       =>'product-title-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Shop title section title color', 'enovathemes-addons'),
					'default'   => array(
				        'color'     => '#212121',
				        'alpha'     => 1
				    ),
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       =>'product-title-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Shop title section title background color', 'enovathemes-addons'),
					'default'  => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       =>'product-subtitle-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Shop title section subtitle color', 'enovathemes-addons'), 
					'default'   => array(
				        'color'     => '#ffffff',
				        'alpha'     => 1
				    ),
					'required' => array('product-title','equals',1)
				),
				array(
					'id'       =>'product-subtitle-back-color',
					'type'     => 'color_rgba',
					'title'    => esc_html__('Shop title section subtitle background color', 'enovathemes-addons'),
					'required' => array('product-title','equals',1),
					'default'  => array(
				        'color'     => '',
				        'alpha'     => 0
				    )
				),
				array(
					'id'       =>'product-breadcrumbs',
					'type'     => 'switch',
					'title'    => esc_html__('Breadcrumbs', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle breadcrumbs on product title sections', 'enovathemes-addons'),
					"default"  => 1,
					'required' => array('product-title','equals',1)
				),
			)
		));

	/* Shop loop layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Shop loop layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'       =>'product-padding',
					'type'     => 'spacing',
					'mode'     => 'padding',
					'units'    => array('px'),
					'title'    => esc_html__('Shop area padding', 'enovathemes-addons'),
					'default' => array(
				        'padding-top'     => '96px', 
				        'padding-bottom'  => '96px',
				        'padding-left'    => '0px',
				        'padding-right'   => '0px',
				        'units'           => 'px', 
				    )
				),
				array(
					'id'        =>'product-container',
					'type'      => 'radio',
					'title'     => esc_html__('Shop container', 'enovathemes-addons'), 
					'subtitle'  => esc_html__('Boxed container allows you to display posts aligned with the main container. Full container allows to display your posts in wide area. (Wide container does not work with sidebar enabled). Important! Wide container works only for desktop', 'enovathemes-addons'), 
					'options'   => array(
						'wide'  => esc_html__('Wide', 'enovathemes-addons'), 
						'boxed' => esc_html__('Boxed', 'enovathemes-addons'),
					),
					'default' => 'boxed',
				),
				array(
					'id'        =>'product-sidebar',
					'type'      => 'select',
					'title'     => esc_html__('Shop sidebar position', 'enovathemes-addons'), 
					'options'   => array(
						'none'  => esc_html__('None', 'enovathemes-addons'), 
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
					),
					'default' => 'none',
				),
				array(
					'id'       =>'product-filter',
					'type'     => 'switch',
					'title'    => esc_html__('Shop AJAX filter', 'enovathemes-addons'),
					'subtitle' => esc_html__('Toggle this option if you want to have AJAX powered filter for your products', 'enovathemes-addons'),
					'subtitle' => esc_html__('Make sure the products display option is set to "Products" (go to Appearance >> Customize >> Woocommerce)', 'enovathemes-addons'),
					"default"  => 0
				),
				array(
					'id'       =>'product-per-page',
					'type'     => 'slider',
					'title'    => esc_html__('Products per page', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'999', 
					'step'     =>'1',
					'default'  => '9'
				),
				array(
					'id'       =>'product-navigation',
					'type'     => 'select',
					'title'    => esc_html__('Shop navigation', 'enovathemes-addons'),
					'subtitle' => esc_html__('Shop navigation', 'enovathemes-addons'),
					'options'  => array(
						'pagination'=>'Pagination',
						'loadmore'  =>'AJAX load more',
						'scroll'    =>'AJAX infinite scroll loading'
					),
					'default'  => 'pagination'
				),
				array(
					'id'       =>'product-navigation-alignment',
					'type'     => 'select',
					'title'    => esc_html__('Shop navigation alignment', 'enovathemes-addons'),
					'subtitle' => esc_html__('Shop navigation alignment', 'enovathemes-addons'),
					'options'  => array(
						'left'=>'Left',
						'center'  =>'Center',
						'right'    =>'Right'
					),
					'default'  => 'center',
				),
			)
		));

	/* Shop loop product layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Shop loop product layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(

				array(
					'id'       => 'product-post-layout',
					'type'     => 'image_select',
					'title'    => esc_html__('Product layout', 'enovathemes-addons'),
					'width'    => '140', 
					'height'   => '140',
					'options'  => array(
						'grid' => array(
							'alt'   => 'Grid', 
							'title' => 'Grid', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'grid.png'
						),
						'masonry1' => array(
							'alt'   => 'Masonry', 
							'title' => 'Masonry', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'masonry1.png'
						)
					),
					'default' => 'grid'
				),
				array(
					'id'        =>'product-post-size',
					'type'      => 'select',
					'title'     => esc_html__('Product size', 'enovathemes-addons'), 
					'options'   => array(
						'small'  => esc_html__('Small (1/4 - 25%)', 'enovathemes-addons'), 
						'medium' => esc_html__('Medium (1/3 - 33%)', 'enovathemes-addons'),
						'large'  => esc_html__('Large (1/2 - 50%)', 'enovathemes-addons'),
					),
					'default' => 'medium',
				),
				array(
					'id'        =>'product-category-post-size',
					'type'      => 'select',
					'title'     => esc_html__('Product category size', 'enovathemes-addons'), 
					'subtitle'  => esc_html__('Make sure you have set the "Shop page display" to "Show categories"/"Show both" from the Woocommerce settings >> Product >> Display', 'enovathemes-addons'), 
					'options'   => array(
						'small'  => esc_html__('Small (1/4 - 25%)', 'enovathemes-addons'), 
						'medium' => esc_html__('Medium (1/3 - 33%)', 'enovathemes-addons'),
						'large'  => esc_html__('Large (1/2 - 50%)', 'enovathemes-addons'),
					),
					'default' => 'small',
				),
				array(
					'id'      =>'product-animation-effect',
					'type'     => 'select',
					'title'    => esc_html__('Product animation effect', 'enovathemes-addons'),
					'options'  => array(
						"none"    => "None",
						"fadeIn"  => "Fade In",
						"moveUp"  => "Move Up",
					),
					'default' => "none"
				),
				array(
					'id'      =>'product-image-effect',
					'type'     => 'select',
					'title'    => esc_html__('Product hover effect', 'enovathemes-addons'),
					'options'  => array(
						"overlay-none"               => "None",
						"overlay-fade"               => "Overlay fade",
						"overlay-fade-zoom"          => "Overlay fade with image zoom",
						"overlay-fade-zoom-extreme"  => "Overlay fade with extreme image zoom",
						"overlay-move"               => "Overlay move fluid",
						"overlay-scale-in"           => "Overlay scale in",
					),
					'default' => "overlay-none"
				),
				array(
					'id'       =>'product-quick-modal-width',
					'type'     => 'slider',
					'title'    => esc_html__('Product quick look modal width', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'1200', 
					'step'     =>'1',
					'default'  =>'1200'
				),
				array(
					'id'       =>'product-quick-modal-height',
					'type'     => 'slider',
					'title'    => esc_html__('Product quick look modal height', 'enovathemes-addons'),
					'min'      =>'0', 
					'max'      =>'1200', 
					'step'     =>'1',
					'default'  =>'585'
				),
			)
		));

	/* Shop single layout
	---------------*/

		Redux::setSection( $opt_name, array(
			'title'      => esc_html__('Shop single layout', 'enovathemes-addons'),
			'subsection' => true,
			'fields' => array(
				array(
					'id'        =>'product-single-sidebar',
					'type'      => 'select',
					'title'     => esc_html__('Shop sidebar position', 'enovathemes-addons'), 
					'options'   => array(
						'none'  => esc_html__('None', 'enovathemes-addons'), 
						'left'  => esc_html__('Left', 'enovathemes-addons'), 
						'right' => esc_html__('Right', 'enovathemes-addons'),
					),
					'default' => 'none',
				),
				array(
					'id'   => 'warning-info-'.$inc++,
					'class'=> 'warning-info',
					'type' => 'info',
					'style' => 'warning',
				    'desc'  => esc_html__('Sidebar and "Single product layout center mode" are not compatible, please either select sidebar with another product layout or use "Single product layout center mode" without sidebar', 'enovathemes-addons'), 
					'required' => array(array('product-single-sidebar','!=','none'),array('product-single-post-layout','equals','single-product-center-mode'))
				),
				array(
					'id'       => 'product-single-post-layout',
					'type'     => 'image_select',
					'title'    => esc_html__('Single product layout', 'enovathemes-addons'),
					'width'    => '140', 
					'height'   => '140',
					'options'  => array(
						'single-product-tabs-under' => array(
							'alt'   => 'Single product layout horizonal thumbnails', 
							'title' => 'Single product layout horizonal thumbnails', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'product_post_layout_1.png'
						),
						'single-product-tabs-inside' => array(
							'alt'   => 'Single product layout vertical thumbnails', 
							'title' => 'Single product layout vertical thumbnails', 
							'img'   => ENOVATHEMES_ADDONS_IMG.'product_post_layout_2.png'
						)
					),
					'default' => 'single-product-tabs-under'
				),
				array(
					'id'       =>'product-image-original',
					'type'     => 'switch',
					'title'    => esc_html__('Use original image size?', 'enovathemes-addons'),
					'subtitle' => esc_html__('Activate this option if you want to original image size in the single product page, otherwise images will be cropped', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'       =>'product-single-social',
					'type'     => 'switch',
					'title'    => esc_html__('Social share', 'enovathemes-addons'),
					"default"  => 1
				),
				array(
					'id'       =>'product-related-products',
					'type'     => 'switch',
					'title'    => esc_html__('Related products', 'enovathemes-addons'),
					"default"  => 1
				),
			)
		));
?>