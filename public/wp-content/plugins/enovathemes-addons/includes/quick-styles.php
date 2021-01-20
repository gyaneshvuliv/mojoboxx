<?php

global $page_styles_n,$gallery_styles_n;

add_action( 'admin_menu', 'add_quick_styles_settings' );
function add_quick_styles_settings(){
	add_submenu_page(
		'themes.php',
		esc_html__( 'Quick Styles', 'enovathemes-addons'),
		esc_html__( 'Quick Styles', 'enovathemes-addons'),
		'administrator',
		'quick_styles_settings',
		'render_quick_styles_settings'
	);
}

function render_quick_styles_settings(){	
?>
	<div class="quick-styles-container wrap">
		<?php settings_errors(); ?>

		<?php

		$theme_tabs = array(
			'header_quick_styles'     	  => esc_html__('Header','enovathemes-addons'),
		);

		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'header_quick_styles';

        ?>

        <h2 class="nav-tab-wrapper">
			<?php foreach ($theme_tabs as $tab => $value): ?>
           		<a href="?post_type=qs&page=quick_styles_settings&tab=<?php echo $tab; ?>" class="nav-tab <?php echo $active_tab == $tab ? 'nav-tab-active' : ''; ?>"><?php echo $value; ?></a>
			<?php endforeach; ?>
        </h2>

		<form class="quick-styles-settings" method="post" action="options.php">
			<?php
				if( $active_tab == 'header_quick_styles' ) {
					echo '<div class="header_quick_styles quick_style_section">';
		            	settings_fields( 'header_quick_styles' );
						do_settings_sections( 'header_quick_styles' );
					echo '</div>';
		        }
				submit_button();
			?>
		</form>
	</div>
<?php }

add_action('admin_init', 'quick_styles_settings_sections');
function quick_styles_settings_sections() {

	$quick_styles_group = array(
		array(
			'section_slug' => 'header_quick_styles', 
			'section_title' => esc_html__('Header quick styles', 'enovathemes-addons'), 
			'section_fields' => array(
				array(
					'field-id'          => 'header_style',
					'field-title'       => '',
					'field-description' => esc_html__('Choose header quick styles here and edit header styles from Theme Settings >> "Header & Menu"', 'enovathemes-addons')
				),
			)
		),
		array(
			'section_slug' => 'page_title_quick_styles', 
			'section_title' => esc_html__('Page title section quick styles', 'enovathemes-addons'), 
			'section_fields' => array(
				array(
					'field-id'          => 'page_style',
					'field-title'       => esc_html__('Page title section quick styles:', 'enovathemes-addons'),
					'field-description' => esc_html__('Choose page title section quick styles here and edit page title section styles from Theme Settings >> "Page title section". Also you can adjust styling of each page individually from the page edit screen with page extended options found under the main editor. For Blog, Events, Gallery, Shop you can adjust page title sections from theme options panel >> Blog/Event/Gallery,Woocommerce >> Page title section', 'enovathemes-addons')
				),
			)
		)
	);

	foreach ($quick_styles_group as $option_group){

		add_settings_section( 
	        $option_group['section_slug'],
	        $option_group['section_title'],
	        $option_group['section_slug'].'_callback',
	        $option_group['section_slug']
	    );

	    register_setting(  
	        $option_group['section_slug'],  
	        $option_group['section_slug']  
	    );

	    foreach ($option_group['section_fields'] as $option_field) {

			add_settings_field(	
				$option_field['field-id'],
				$option_field['field-title'],
				$option_field['field-id'].'_callback',
				$option_group['section_slug'],
				$option_group['section_slug'],
				array($option_field['field-description'])
			);
		}
	}
}

function config_quick_styles_callback (){
	echo '<p>'.esc_html__('Check this option and save only once.', 'enovathemes-addons').'</p>';
}

function header_quick_styles_callback (){
	echo "";
}

/*	Header quick styles fields
-------------------------------*/

	function header_style_callback($args) {

		$settings = get_option('header_quick_styles');

		if(!isset($settings['header_style'])) {
			$settings['header_style'] = '1';
		}

		$output = "";

		$header_styles = array(

			'1'  => array('Static header logo left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header1.png'),
			'2'  => array('Static header logo right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header2.png'),
			'3'  => array('Static header logo center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header3.png'),
			'4'  => array('Static header with top bar',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header4.png'),

			'5'  => array('Transparent header logo left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header5.png'),
			'6'  => array('Transparent header logo right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header6.png'),
			'7'  => array('Transparent header logo center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header7.png'),
			'8'  => array('Transparent header no logo  menu left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header8.png'),
			'9'  => array('Transparent header no logo  menu right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header9.png'),
			'10' => array('Transparent header no logo  menu center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header10.png'),
			'11' => array('Transparent header with top bar',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header11.png'),

			'12'  => array('Menu under logo and logo left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header12.png'),
			'13'  => array('Menu under logo and logo right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header13.png'),
			'14'  => array('Menu under logo and logo center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header14.png'),
			'15'  => array('Menu under logo with top bar',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header15.png'),
			'16'  => array('Boxed Menu under logo',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header16.png'),

			'17'  => array('Header under slider logo left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header17.png'),
			'18'  => array('Header under slider logo right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header18.png'),
			'19'  => array('Header under slider logo center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header19.png'),
			'20'  => array('Header under slider no logo',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header20.png'),

			'21' => array('Fullscreen menu logo left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header21.png'),
			'22' => array('Fullscreen menu logo right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header22.png'),
			'23' => array('Fullscreen menu logo center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header23.png'),
			'24' => array('Fullscreen menu no logo',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header24.png'),

			'25' => array('Sidebar menu from left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header25.png'),
			'26' => array('Sidebar menu from right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header26.png'),
			'27' => array('Sidebar menu dark',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header27.png'),
			'28' => array('Sidebar menu colorful',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header28.png'),

			'29'  => array('Boxed header logo left',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header29.png'),
			'30'  => array('Boxed header logo right',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header30.png'),
			'31'  => array('Boxed header logo center',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header31.png'),
			'32'  => array('Boxed header top bar',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header32.png'),
			'33'  => array('Boxed header menu under logo',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header33.png'),
			'34'  => array('Dark Static header',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header34.png'),
			'35'  => array('Colorful Static header',ENOVATHEMES_ADDONS_IMG.'quick_styles/header/header35.png'),
		);

		$output .= '<div class="quick-styles-option-group" id="header_style">';
			foreach ($header_styles as $style_n => $style_value) {
				$output .= '<div id="header_style_'.$style_n.'" class="quick-styles-option" >';
					$output .= '<label>';
						$output .= '<div class="img-wrapper">';
							$output .= '<img src="'.$style_value[1].'">';
						$output .= '</div>';
						$output .= '<div class="quick-styles-option-body">';
							$output .= '<input type="radio" value="'.$style_n.'" '.checked( $settings['header_style'], $style_n, false) . ' id="header_quick_styles[header_style]" name="header_quick_styles[header_style]" >';
							$output .= '<h3 class="quick-style-option-title">'.$style_value[0].'</h3>';
						$output .= '</div>';
					$output .= '</label>';
				$output .= '</div>';
			}
		$output .= '</div>';
		$output .= '<p class="post-notice">'.$args[0].'</p>';
		echo $output;
	     
	}

/*	Header quick styles on save hook
-------------------------------*/

	function enovathemes_addons_header_quick_styles_pre_update( $new_value, $old_value ) {
		
		if ( ! class_exists( 'Redux' ) ) {
		    return;
		}

		global $globax_enovathemes;

		switch ($new_value['header_style']) {

			// Static header logo left

				case '1':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Static header logo right

				case '2':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','right');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','left');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Static header logo center

				case '3':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','center');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',0);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',0);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Static header with top bar

				case '4':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',1);

						Redux::setOption('globax_enovathemes','header-top-height','56');
						Redux::setOption('globax_enovathemes','header-top-back-color',array(
							'color'=>'#212121',
							'alpha'=>1
						));
						Redux::setOption('globax_enovathemes','header-top-border-color',array(
							'color'=>'#212121',
							'alpha'=>0
						));
						Redux::setOption('globax_enovathemes','header-top-menu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-submenu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));
						Redux::setOption('globax_enovathemes','header-top-submenu-back',array(
							'regular'  => '#212121',
					        'hover'    => '#fd8c40',
						));
						Redux::setOption('globax_enovathemes','header-top-menu-typo',array(
							'font-weight' 	 => '600', 
					        'font-family' 	 => 'Montserrat', 
					        'font-size'   	 => '14px',
					        'letter-spacing' => '0.5px',
					        'text-transform' => 'none'
						));
						Redux::setOption('globax_enovathemes', 'header-top-social-links',1);
						Redux::setOption('globax_enovathemes','header-top-social-links-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-button-url','//enovathemes.com/globax');
						Redux::setOption('globax_enovathemes','header-top-button-text','Purchase now');

						Redux::setOption('globax_enovathemes','header-top-button-text-color',array(
							'regular'=>'#212121',
							'hover'=>'#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-top-button-back-color',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40'
						));
						Redux::setOption('globax_enovathemes','header-top-slogan','<div class="et-el-icon extra-small" style="color:#fd8c40"><span class="el-icon fas fa-map-marker-alt animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Intersection 10 Hudson Yards</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Email: index@globax.com</span>');

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header logo left

				case '5':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header logo right

				case '6':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','right');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header logo center

				case '7':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','-1');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo_center.png',
							'width' => '240',
							'height'=> '160'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo_center_retina.png',
							'width' => '480',
							'height'=> '320'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','center');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','32');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','32');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header no logo menu left

				case '8':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',1);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',1);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','24');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','32');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','outline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','outline');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header no logo menu right

				case '9':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',1);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',1);
						Redux::setOption('globax_enovathemes','menu-position','right');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','24');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','32');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','outline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','outline');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header no logo menu center

				case '10':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',1);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',1);
						Redux::setOption('globax_enovathemes','menu-position','center');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','24');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','32');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','outline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','outline');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Transparent header with top bar

				case '11':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',1);

						Redux::setOption('globax_enovathemes','header-top-height','56');
						Redux::setOption('globax_enovathemes','header-top-back-color',array(
							'color'=>'#212121',
							'alpha'=>1
						));
						Redux::setOption('globax_enovathemes','header-top-border-color',array(
							'color'=>'#212121',
							'alpha'=>0
						));
						Redux::setOption('globax_enovathemes','header-top-menu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-submenu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));
						Redux::setOption('globax_enovathemes','header-top-submenu-back',array(
							'regular'  => '#212121',
					        'hover'    => '#fd8c40',
						));
						Redux::setOption('globax_enovathemes','header-top-menu-typo',array(
							'font-weight' 	 => '600', 
					        'font-family' 	 => 'Montserrat', 
					        'font-size'   	 => '14px',
					        'letter-spacing' => '0.5px',
					        'text-transform' => 'none'
						));
						Redux::setOption('globax_enovathemes', 'header-top-social-links',1);
						Redux::setOption('globax_enovathemes','header-top-social-links-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-button-url','//enovathemes.com/globax');
						Redux::setOption('globax_enovathemes','header-top-button-text','Purchase now');

						Redux::setOption('globax_enovathemes','header-top-button-text-color',array(
							'regular'=>'#212121',
							'hover'=>'#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-top-button-back-color',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40'
						));
						Redux::setOption('globax_enovathemes','header-top-slogan','<div class="et-el-icon extra-small" style="color:#fd8c40"><span class="el-icon fas fa-map-marker-alt animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Intersection 10 Hudson Yards</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Email: index@globax.com</span>');

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','transparent-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','transparent-logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',1);
						Redux::setOption('globax_enovathemes','transparent-header-project',1);
						Redux::setOption('globax_enovathemes','transparent-header-shop',1);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');


						Redux::setOption('globax_enovathemes','transparent-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','transparent-header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));

							Redux::setOption('globax_enovathemes','transparent-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','transparent-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','transparent');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Menu under logo and logo left

				case '12':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);
						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','//enovathemes.com/globax/contact-us');
							Redux::setOption('globax_enovathemes','header-button-text','Request a quote');
							Redux::setOption('globax_enovathemes','header-button-icon','far fa-envelope');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#212121',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','0');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','0');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','fill');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

							Redux::setOption('globax_enovathemes','header-slogan','<div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Email: index@globax.com</span>');

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Menu under logo and logo right

				case '13':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','right');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);
						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','//enovathemes.com/globax/contact-us');
							Redux::setOption('globax_enovathemes','header-button-text','Request a quote');
							Redux::setOption('globax_enovathemes','header-button-icon','far fa-envelope');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#212121',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','0');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','0');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','fill');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

							Redux::setOption('globax_enovathemes','header-slogan','<div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Email: index@globax.com</span>');

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Menu under logo and logo center

				case '14':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','center');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);
						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',0);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',1);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#212121',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','0');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','0');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','fill');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

							Redux::setOption('globax_enovathemes','header-slogan','');

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Menu under logo with top bar

				case '15':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',1);

						Redux::setOption('globax_enovathemes','header-top-height','56');
						Redux::setOption('globax_enovathemes','header-top-back-color',array(
							'color'=>'#212121',
							'alpha'=>1
						));
						Redux::setOption('globax_enovathemes','header-top-border-color',array(
							'color'=>'#212121',
							'alpha'=>0
						));
						Redux::setOption('globax_enovathemes','header-top-menu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-submenu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));
						Redux::setOption('globax_enovathemes','header-top-submenu-back',array(
							'regular'  => '#212121',
					        'hover'    => '#fd8c40',
						));
						Redux::setOption('globax_enovathemes','header-top-menu-typo',array(
							'font-weight' 	 => '600', 
					        'font-family' 	 => 'Montserrat', 
					        'font-size'   	 => '14px',
					        'letter-spacing' => '0.5px',
					        'text-transform' => 'none'
						));
						Redux::setOption('globax_enovathemes', 'header-top-social-links',1);
						Redux::setOption('globax_enovathemes','header-top-social-links-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-button-url','//enovathemes.com/globax');
						Redux::setOption('globax_enovathemes','header-top-button-text','Purchase now');

						Redux::setOption('globax_enovathemes','header-top-button-text-color',array(
							'regular'=>'#212121',
							'hover'=>'#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-top-button-back-color',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40'
						));
						Redux::setOption('globax_enovathemes','header-top-slogan','<div class="et-el-icon extra-small" style="color:#fd8c40"><span class="el-icon fas fa-map-marker-alt animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Intersection 10 Hudson Yards</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Email: index@globax.com</span>');

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);
						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','//enovathemes.com/globax/contact-us');
							Redux::setOption('globax_enovathemes','header-button-text','Request a quote');
							Redux::setOption('globax_enovathemes','header-button-icon','far fa-envelope');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','0');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','0');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#424242',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','fill');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#eeeeee',
								'alpha'   => '1', 
							));

							Redux::setOption('globax_enovathemes','header-slogan','<div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Email: index@globax.com</span>');

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#eeeeee',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Boxed Menu under logo

				case '16':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);
						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','88');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','//enovathemes.com/globax/contact-us');
							Redux::setOption('globax_enovathemes','header-button-text','Request a quote');
							Redux::setOption('globax_enovathemes','header-button-icon','far fa-envelope');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#212121',
								'hover'   => '#fd8c40'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','3');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','3');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','box');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

							Redux::setOption('globax_enovathemes','header-slogan','<div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small full" style="background-color:#fd8c40;color:#ffffff"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#616161;font-size:16px;line-height:24px">Email: index@globax.com</span>');

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#e0e0e0');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Header under slider logo left

				case '17':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',1);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Header under slider logo right

				case '18':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','right');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',1);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',1);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','left');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Header under slider logo center

				case '19':

					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-dark-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','center');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',1);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',0);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',0);
						Redux::setOption('globax_enovathemes','sidebar-padding',array(
					        'padding-top'     => '48px', 
					        'padding-bottom'  => '48px',
					        'padding-left'    => '32px',
					        'padding-right'   => '32px',
					        'units'           => 'px', 
					    ));

						Redux::setOption('globax_enovathemes','sidebar-width','400');
						Redux::setOption('globax_enovathemes','sidebar-align','right');
						Redux::setOption('globax_enovathemes','sidebar-background-color','#212121');

				break;

			// Header under slider no logo

				case '20':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',1);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#212121'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#ffffff'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#212121',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Fullscreen menu logo left

				case '21':

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '400',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color', '#ffffff');

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',1);
						Redux::setOption('globax_enovathemes','fullscreen-transparent',1);
						Redux::setOption('globax_enovathemes','fullscreen-sticky',0);
						Redux::setOption('globax_enovathemes','fullscreen-full-header',0);
						Redux::setOption('globax_enovathemes','fullscreen-logo-position','left');
						Redux::setOption('globax_enovathemes','fullscreen-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-search',0);
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-size','medium');
						Redux::setOption('globax_enovathemes','fullscreen-social-links',1);
						Redux::setOption('globax_enovathemes','fullscreen-language-switcher',0);

						Redux::setOption('globax_enovathemes','fullscreen-social-links-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-width','');
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-radius','');
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-color','#ffffff');

						Redux::setOption('globax_enovathemes','fullscreen-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => '0'
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '32px',
					        'text-transform' => 'uppercase',
					        'letter-spacing' => '2px'
						));
						Redux::setOption('globax_enovathemes','fullscreen-menu-effect-color',array(
							'color' => '#fd8c40',
							'alpha'   => '1', 
						));

						Redux::setOption('globax_enovathemes','fullscreen-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','fullscreen-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','fullscreen-back','#000000');
						Redux::setOption('globax_enovathemes','fullscreen-opacity','9');

						Redux::setOption('globax_enovathemes','fullscreen-sticky-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-color',array(
					        'regular'  => '#bdbdbd',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',0);

				break;

			// Fullscreen menu logo right

				case '22':

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '400',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color', '#ffffff');

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',1);
						Redux::setOption('globax_enovathemes','fullscreen-transparent',1);
						Redux::setOption('globax_enovathemes','fullscreen-sticky',0);
						Redux::setOption('globax_enovathemes','fullscreen-full-header',0);
						Redux::setOption('globax_enovathemes','fullscreen-logo-position','right');
						Redux::setOption('globax_enovathemes','fullscreen-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-search',0);
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-size','medium');
						Redux::setOption('globax_enovathemes','fullscreen-social-links',1);
						Redux::setOption('globax_enovathemes','fullscreen-language-switcher',0);

						Redux::setOption('globax_enovathemes','fullscreen-social-links-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-width','');
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-radius','');
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-color','#ffffff');

						Redux::setOption('globax_enovathemes','fullscreen-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => '0'
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '32px',
					        'text-transform' => 'uppercase',
					        'letter-spacing' => '2px'
						));
						Redux::setOption('globax_enovathemes','fullscreen-menu-effect-color',array(
							'color' => '#fd8c40',
							'alpha'   => '1', 
						));

						Redux::setOption('globax_enovathemes','fullscreen-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','fullscreen-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','fullscreen-back','#000000');
						Redux::setOption('globax_enovathemes','fullscreen-opacity','9');

						Redux::setOption('globax_enovathemes','fullscreen-sticky-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-color',array(
					        'regular'  => '#bdbdbd',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',0);

				break;

			// Fullscreen menu logo center

				case '23':

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '400',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color', '#ffffff');

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',1);
						Redux::setOption('globax_enovathemes','fullscreen-transparent',1);
						Redux::setOption('globax_enovathemes','fullscreen-sticky',0);
						Redux::setOption('globax_enovathemes','fullscreen-full-header',0);
						Redux::setOption('globax_enovathemes','fullscreen-logo-position','center');
						Redux::setOption('globax_enovathemes','fullscreen-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-search',0);
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-size','large');
						Redux::setOption('globax_enovathemes','fullscreen-social-links',0);
						Redux::setOption('globax_enovathemes','fullscreen-language-switcher',0);

						Redux::setOption('globax_enovathemes','fullscreen-social-links-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-width','');
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-radius','');
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-color','#ffffff');

						Redux::setOption('globax_enovathemes','fullscreen-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => '0'
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '32px',
					        'text-transform' => 'uppercase',
					        'letter-spacing' => '2px'
						));
						Redux::setOption('globax_enovathemes','fullscreen-menu-effect-color',array(
							'color' => '#fd8c40',
							'alpha'   => '1', 
						));

						Redux::setOption('globax_enovathemes','fullscreen-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','fullscreen-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','fullscreen-back','#000000');
						Redux::setOption('globax_enovathemes','fullscreen-opacity','9');

						Redux::setOption('globax_enovathemes','fullscreen-sticky-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-color',array(
					        'regular'  => '#bdbdbd',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',0);

				break;

			// Fullscreen menu no logo

				case '24':

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => '',
							'width' => '',
							'height'=> ''
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color', '#ffffff');

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',1);
						Redux::setOption('globax_enovathemes','fullscreen-transparent',1);
						Redux::setOption('globax_enovathemes','fullscreen-sticky',0);
						Redux::setOption('globax_enovathemes','fullscreen-full-header',0);
						Redux::setOption('globax_enovathemes','fullscreen-logo-position','left');
						Redux::setOption('globax_enovathemes','fullscreen-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-search',0);
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-size','medium');
						Redux::setOption('globax_enovathemes','fullscreen-social-links',1);
						Redux::setOption('globax_enovathemes','fullscreen-language-switcher',0);

						Redux::setOption('globax_enovathemes','fullscreen-social-links-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-width','');
						Redux::setOption('globax_enovathemes','fullscreen-social-links-border-radius','');
						Redux::setOption('globax_enovathemes','fullscreen-header-icons-color','#ffffff');

						Redux::setOption('globax_enovathemes','fullscreen-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => '0'
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '32px',
					        'text-transform' => 'uppercase',
					        'letter-spacing' => '2px'
						));
						Redux::setOption('globax_enovathemes','fullscreen-menu-effect-color',array(
							'color' => '#fd8c40',
							'alpha'   => '1', 
						));

						Redux::setOption('globax_enovathemes','fullscreen-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','fullscreen-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-fullscreen-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','fullscreen-back','#000000');
						Redux::setOption('globax_enovathemes','fullscreen-opacity','9');

						Redux::setOption('globax_enovathemes','fullscreen-sticky-height','96');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-color',array(
					        'regular'  => '#bdbdbd',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-border-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-social-links-back-color',array(
					        'regular'  => '',
					        'hover'    => '',
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','fullscreen-sticky-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
					    ));

					/*	Sidebar
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar',0);

				break;

			// Sidebar menu from left

				case '25':

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',1);

						Redux::setOption('globax_enovathemes','sidebar-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','sidebar-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','sidebar-logo-margin',array(
					        'margin-top'     => '48px', 
					        'margin-bottom'  => '48px'
					    ));
						Redux::setOption('globax_enovathemes','sidebar-position','left');
						Redux::setOption('globax_enovathemes','sidebar-alignment','left');
						Redux::setOption('globax_enovathemes','sidebar-back','#ffffff');
						Redux::setOption('globax_enovathemes','sidebar-back-img',array(
							'background-image' => '',
							'background-repeat' => 'no-repeat',
							'background-size' => 'inherit',
							'background-attachment' => 'inherit',
							'background-position' => 'left top',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-vertical',1);
						Redux::setOption('globax_enovathemes','sidebar-menu-margin',array(
							'margin-top'     => '24', 
					        'margin-bottom'  => '0'
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','sidebar-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat',
					        'font-size'      => '16px',
					        'letter-spacing' => '0.5px',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-border-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','sidebar-copyright','<div id="et-social-links-1" class="et-social-links social-links et-clearfix  styling-original-false"><a class="et-icon-google" href="https://googleplus.com" target="_self"></a><a class="et-icon-facebook" href="https://facebook.com" target="_self"></a><a class="et-icon-twitter" href="https://twitter.com" target="_self"></a><a class="et-icon-linkedin" href="https://linkedin.com" target="_self"></a></div>');
						Redux::setOption('globax_enovathemes','sidebar-submenu-effect','ghost');

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Sidebar menu from right

				case '26':

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',1);

						Redux::setOption('globax_enovathemes','sidebar-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','sidebar-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','sidebar-logo-margin',array(
					        'margin-top'     => '48px', 
					        'margin-bottom'  => '48px'
					    ));
						Redux::setOption('globax_enovathemes','sidebar-position','right');
						Redux::setOption('globax_enovathemes','sidebar-alignment','right');
						Redux::setOption('globax_enovathemes','sidebar-back','#ffffff');
						Redux::setOption('globax_enovathemes','sidebar-back-img',array(
							'background-image' => '',
							'background-repeat' => 'no-repeat',
							'background-size' => 'inherit',
							'background-attachment' => 'inherit',
							'background-position' => 'left top',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-vertical',1);
						Redux::setOption('globax_enovathemes','sidebar-menu-margin',array(
							'margin-top'     => '24', 
					        'margin-bottom'  => '0'
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','sidebar-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat',
					        'font-size'      => '16px',
					        'letter-spacing' => '0.5px',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-border-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','sidebar-copyright','<div id="et-social-links-1" class="et-social-links social-links et-clearfix  styling-original-false"><a class="et-icon-google" href="https://googleplus.com" target="_self"></a><a class="et-icon-facebook" href="https://facebook.com" target="_self"></a><a class="et-icon-twitter" href="https://twitter.com" target="_self"></a><a class="et-icon-linkedin" href="https://linkedin.com" target="_self"></a></div>');
						Redux::setOption('globax_enovathemes','sidebar-submenu-effect','ghost');

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Sidebar menu dark

				case '27':

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',1);

						Redux::setOption('globax_enovathemes','sidebar-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar-white.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','sidebar-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar-white-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','sidebar-logo-margin',array(
					        'margin-top'     => '48px', 
					        'margin-bottom'  => '48px'
					    ));
						Redux::setOption('globax_enovathemes','sidebar-position','left');
						Redux::setOption('globax_enovathemes','sidebar-alignment','left');
						Redux::setOption('globax_enovathemes','sidebar-back','#212121');
						Redux::setOption('globax_enovathemes','sidebar-back-img',array(
							'background-image' => '',
							'background-repeat' => 'no-repeat',
							'background-size' => 'inherit',
							'background-attachment' => 'inherit',
							'background-position' => 'left top',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-vertical',1);
						Redux::setOption('globax_enovathemes','sidebar-menu-margin',array(
							'margin-top'     => '24', 
					        'margin-bottom'  => '0'
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#fd8c40',
					    ));
						Redux::setOption('globax_enovathemes','sidebar-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat',
					        'font-size'      => '16px',
					        'letter-spacing' => '0.5px',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-border-color',array(
					        'color'     => '#212121',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','sidebar-copyright','<div id="et-social-links-1" class="et-social-links social-links et-clearfix  styling-original-false"><a class="et-icon-google" href="https://googleplus.com" target="_self"></a><a class="et-icon-facebook" href="https://facebook.com" target="_self"></a><a class="et-icon-twitter" href="https://twitter.com" target="_self"></a><a class="et-icon-linkedin" href="https://linkedin.com" target="_self"></a></div>');
						Redux::setOption('globax_enovathemes','sidebar-submenu-effect','ghost');

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Sidebar menu colorful

				case '28':

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',1);

						Redux::setOption('globax_enovathemes','sidebar-logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar-dark.png',
							'width' => '100',
							'height'=> '200'
						));
						Redux::setOption('globax_enovathemes','sidebar-logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-sidebar-dark-retina.png',
							'width' => '200',
							'height'=> '400'
						));

						Redux::setOption('globax_enovathemes','sidebar-logo-margin',array(
					        'margin-top'     => '48px', 
					        'margin-bottom'  => '48px'
					    ));
						Redux::setOption('globax_enovathemes','sidebar-position','left');
						Redux::setOption('globax_enovathemes','sidebar-alignment','left');
						Redux::setOption('globax_enovathemes','sidebar-back','#fd8c40');
						Redux::setOption('globax_enovathemes','sidebar-back-img',array(
							'background-image' => '',
							'background-repeat' => 'no-repeat',
							'background-size' => 'inherit',
							'background-attachment' => 'inherit',
							'background-position' => 'left top',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-vertical',1);
						Redux::setOption('globax_enovathemes','sidebar-menu-margin',array(
							'margin-top'     => '24', 
					        'margin-bottom'  => '0'
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-color',array(
					        'regular'  => '#ffffff',
					        'hover'    => '#212121',
					    ));
						Redux::setOption('globax_enovathemes','sidebar-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat',
					        'font-size'      => '16px',
					        'letter-spacing' => '0.5px',
						));
						Redux::setOption('globax_enovathemes','sidebar-menu-border-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','sidebar-copyright','<div id="et-social-links-1" class="et-social-links social-links et-clearfix  styling-original-false"><a class="et-icon-google" href="https://googleplus.com" target="_self"></a><a class="et-icon-facebook" href="https://facebook.com" target="_self"></a><a class="et-icon-twitter" href="https://twitter.com" target="_self"></a><a class="et-icon-linkedin" href="https://linkedin.com" target="_self"></a></div>');
						Redux::setOption('globax_enovathemes','sidebar-submenu-effect','ghost');

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Boxed header logo left

				case '29':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','-24');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',1);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','line');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Boxed header logo right

				case '30':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','24');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',1);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','right');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','line');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Boxed header logo center

				case '31':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',1);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','center');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','line');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Boxed header top bar

				case '32':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',1);

						Redux::setOption('globax_enovathemes','header-top-height','56');
						Redux::setOption('globax_enovathemes','header-top-back-color',array(
							'color'=>'#212121',
							'alpha'=>1
						));
						Redux::setOption('globax_enovathemes','header-top-border-color',array(
							'color'=>'#212121',
							'alpha'=>0
						));
						Redux::setOption('globax_enovathemes','header-top-menu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-submenu-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));
						Redux::setOption('globax_enovathemes','header-top-submenu-back',array(
							'regular'  => '#212121',
					        'hover'    => '#fd8c40',
						));
						Redux::setOption('globax_enovathemes','header-top-menu-typo',array(
							'font-weight' 	 => '600', 
					        'font-family' 	 => 'Montserrat', 
					        'font-size'   	 => '14px',
					        'letter-spacing' => '0.5px',
					        'text-transform' => 'none'
						));
						Redux::setOption('globax_enovathemes', 'header-top-social-links',1);
						Redux::setOption('globax_enovathemes','header-top-social-links-color',array(
							'regular'  => '#BDBDBD',
					        'hover'    => '#ffffff',
						));

						Redux::setOption('globax_enovathemes','header-top-button-url','//enovathemes.com/globax');
						Redux::setOption('globax_enovathemes','header-top-button-text','Purchase now');

						Redux::setOption('globax_enovathemes','header-top-button-text-color',array(
							'regular'=>'#212121',
							'hover'=>'#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-top-button-back-color',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40'
						));
						Redux::setOption('globax_enovathemes','header-top-slogan','<div class="et-el-icon extra-small" style="color:#fd8c40"><span class="el-icon fas fa-map-marker-alt animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Intersection 10 Hudson Yards</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small " style="color:#fd8c40"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:4px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Email: index@globax.com</span>');

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','-24');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',1);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#bdbdbd');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#e0e0e0',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','overline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','line');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#bdbdbd');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#bdbdbd',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#212121',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Boxed header menu under logo

				case '33':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full-retina.png',
							'width' => '240',
							'height'=> '96'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-full.png',
							'width' => '480',
							'height'=> '192'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-dark.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina-dark.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',1);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',1);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',0);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#BDBDBD',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','//enovathemes.com/globax/contact-us');
							Redux::setOption('globax_enovathemes','header-button-text','Request a quote');
							Redux::setOption('globax_enovathemes','header-button-icon','far fa-envelope');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#212121',
								'hover'   => '#ffffff'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#ffffff',
								'hover'   => '#212121'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#212121',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','0');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','0');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','fill');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

							Redux::setOption('globax_enovathemes','header-slogan','<div class="et-el-icon extra-small full" style="background-color:#ffffff;color:#212121"><span class="el-icon fas fa-phone animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Tel: +511 654 856</span><span class="et-gap-inline et-clearfix" style="width:32px">&nbsp;</span><div class="et-el-icon extra-small full" style="background-color:#ffffff;color:#212121"><span class="el-icon far fa-envelope-open animate-false"></span></div><span class="et-gap-inline et-clearfix" style="width:8px"></span><span style="color:#ffffff;font-size:16px;line-height:24px">Email: index@globax.com</span>');

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','line');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#ffffff',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#212121',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',0);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#bdbdbd');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Dark Static header

				case '34':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#212121'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#fd8c40',
								'hover'   => '#ffffff'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#212121',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','40');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','40');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','underline');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#212121',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#fd8c40',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#fd8c40',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#212121');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

			// Colorful Static header

				case '35':
				
					/*	Header top
					---------------------*/

						Redux::setOption('globax_enovathemes','header-top',0);

					/*	Logo upload
					---------------------*/

						Redux::setOption('globax_enovathemes','logo-pos-hor','0');
						Redux::setOption('globax_enovathemes','logo-pos-ver','0');

						Redux::setOption('globax_enovathemes','logo',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-alt.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-alt-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-fixed',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-alt.png',
							'width' => '120',
							'height'=> '35'
						));
						Redux::setOption('globax_enovathemes','logo-fixed-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-white-alt-retina.png',
							'width' => '240',
							'height'=> '70'
						));
						Redux::setOption('globax_enovathemes','logo-mobile',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile.png',
							'width' => '100',
							'height'=> '50'
						));
						Redux::setOption('globax_enovathemes','logo-mobile-retina',array(
							'url'   => 'https://enovathemes.com/globax/wp-content/uploads/logo-mobile-retina.png',
							'width' => '200',
							'height'=> '100'
						));

					/*	Standard header
					---------------------*/

						Redux::setOption('globax_enovathemes','transparent-header-blog',0);
						Redux::setOption('globax_enovathemes','transparent-header-project',0);
						Redux::setOption('globax_enovathemes','transparent-header-shop',0);
						Redux::setOption('globax_enovathemes','boxed-header',0);
						Redux::setOption('globax_enovathemes','sticky-header',1);
						Redux::setOption('globax_enovathemes','full-header',0);
						Redux::setOption('globax_enovathemes','logo-position','left');
						Redux::setOption('globax_enovathemes','no-logo',0);
						Redux::setOption('globax_enovathemes','menu-position','left');
						Redux::setOption('globax_enovathemes','menu-under-logo',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-boxed-radius',0);
						Redux::setOption('globax_enovathemes','menu-under-logo-icons',0);
						Redux::setOption('globax_enovathemes','header-under-slider',0);
						Redux::setOption('globax_enovathemes','border-box',0);

						Redux::setOption('globax_enovathemes','header-height','96');
						Redux::setOption('globax_enovathemes','menu-height','64');
						Redux::setOption('globax_enovathemes','header-back-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','header-border-color',array(
					        'color'     => '',
					        'alpha'     => ''
						));
						Redux::setOption('globax_enovathemes','header-icons-color','#ffffff');

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','cart-bubble-back-color',array(
								'color' => '#212121',
								'alpha'   => '1' 
							));

						/*	Search
						---------------------*/

							Redux::setOption('globax_enovathemes','header-search',1);
							Redux::setOption('globax_enovathemes','header-search-back-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-border-default',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','header-search-text-default','#616161');
							Redux::setOption('globax_enovathemes','header-search-back','#f5f5f5');
							Redux::setOption('globax_enovathemes','header-search-color','#616161');
							Redux::setOption('globax_enovathemes','header-search-back-opacity','10');

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','header-social-links',0);
							Redux::setOption('globax_enovathemes','header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','header-social-links-border-width','0');
							Redux::setOption('globax_enovathemes','header-social-links-border-radius','0');

						/*	Header button
						---------------------*/

							Redux::setOption('globax_enovathemes','header-button-url','');
							Redux::setOption('globax_enovathemes','header-button-text','');
							Redux::setOption('globax_enovathemes','header-button-icon','');
							Redux::setOption('globax_enovathemes','header-button-text-color',array(
								'regular' => '#ffffff',
								'hover'   => '#212121'
							));
							Redux::setOption('globax_enovathemes','header-button-back-color',array(
								'regular' => '#212121',
								'hover'   => '#ffffff'
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','menu-back-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
							Redux::setOption('globax_enovathemes','header-menu-m','3');
							Redux::setOption('globax_enovathemes','header-menu-m-1600','3');
							Redux::setOption('globax_enovathemes','header-menu-separator',0);
							Redux::setOption('globax_enovathemes','header-menu-separator-height','16');
							Redux::setOption('globax_enovathemes','header-menu-separator-color',array(
						        'color'  => '#e0e0e0',
						        'alpha'  => '1',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-typo',array(
						        'font-weight'    => '700', 
						        'font-family'    => 'Montserrat', 
						        'font-size'      => '12px',
								'letter-spacing' => '1px',
								'text-transform' => 'uppercase',
						    ));
							Redux::setOption('globax_enovathemes','header-menu-effect','box');
							Redux::setOption('globax_enovathemes','header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

						/*	Header submenu
						---------------------*/

							Redux::setOption('globax_enovathemes','header-submenu-shadow',1);
							Redux::setOption('globax_enovathemes','header-submenu-back-color','#ffffff');
							Redux::setOption('globax_enovathemes','header-submenu-border-color','#fd8c40');
							Redux::setOption('globax_enovathemes','header-submenu-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-typo',array(
						        'font-weight'    => '500', 
						        'font-family'    => 'Roboto', 
						        'font-size'      => '16px', 
						        'line-height'    => '24px'
						    ));
							Redux::setOption('globax_enovathemes','header-submenu-hover-effect','fill');
							Redux::setOption('globax_enovathemes','header-submenu-effect-color',array(
								'color' => '#fd8c40',
								'alpha' => '1'
							));
							Redux::setOption('globax_enovathemes','header-submenu-effect','ghost');

					/*	Sticky header
					---------------------*/

						Redux::setOption('globax_enovathemes','sticky-header-height','96');
						Redux::setOption('globax_enovathemes','sticky-header-back-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
						));
						Redux::setOption('globax_enovathemes','sticky-header-border-color',array(
					        'color'     => '',
					        'alpha'     => 0
						));
						Redux::setOption('globax_enovathemes','sticky-header-icons-color','#ffffff');

						/*	Language switcher
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-color',array(
						        'color'     => '#f5f5f5',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-back-hov-color',array(
						        'color'     => '#fd8c40',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-language-switcher-text-color',array(
						        'regular'  => '#616161',
						        'hover'    => '#ffffff',
						    ));

						/*	Social links
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-header-social-links-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-border-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-social-links-back-color',array(
						        'regular'  => '',
						        'hover'    => '',
						    ));

						/*	Shopping cart
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-cart-bubble-text-color',array(
						        'color'     => '#ffffff',
						        'alpha'     => '1'
						    ));
							Redux::setOption('globax_enovathemes','sticky-cart-bubble-back-color',array(
								'color' => '#212121',
								'alpha'   => '1' 
							));

						/*	Header menu
						---------------------*/

							Redux::setOption('globax_enovathemes','sticky-menu-back-color',array(
						        'color'     => '',
						        'alpha'     => 1
						    ));
							Redux::setOption('globax_enovathemes','sticky-menu-border-color',array(
						        'color'     => '',
						        'alpha'     => 0
						    ));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-separator-color',array(
							    'color'  => '',
							    'alpha'  => '',
							));
						    Redux::setOption('globax_enovathemes','sticky-header-menu-color',array(
						        'regular'  => '#ffffff',
						        'hover'    => '#212121',
						    ));
							Redux::setOption('globax_enovathemes','sticky-header-menu-effect-color',array(
								'color' => '#ffffff',
								'alpha'   => '1', 
							));

					/*	Shopping cart
					---------------------*/

						Redux::setOption('globax_enovathemes','header-shop-cart',1);
						Redux::setOption('globax_enovathemes','mob-header-shop-cart',1);
						Redux::setOption('globax_enovathemes','header-shop-cart-back-color','#ffffff');
						Redux::setOption('globax_enovathemes','header-shop-cart-text-color','#616161');
						Redux::setOption('globax_enovathemes','header-shop-cart-title-color','#212121');
						Redux::setOption('globax_enovathemes','header-shop-cart-button-back',array(
							'regular' => '#ffffff',
							'hover'   => '#fd8c40', 
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-color',array(
							'regular'  => '#616161',
							'hover'    => '#ffffff'
						));
						Redux::setOption('globax_enovathemes','header-shop-cart-button-border-color',array(
							'regular'  => '#e0e0e0',
							'hover'    => '#fd8c40'
						));

					/*	Megamenu
					---------------------*/

						Redux::setOption('globax_enovathemes','megamenu-top-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px', 
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
					        'color'          => '#212121'
						));
						Redux::setOption('globax_enovathemes','megamenu-top-border','#e0e0e0');

						Redux::setOption('globax_enovathemes','megamenu_links',array(
							'regular' => '#616161',
					        'hover'   => '#ffffff',
						));

					/*	Mobile header
					---------------------*/

						Redux::setOption('globax_enovathemes','mob-header-height','80');
						Redux::setOption('globax_enovathemes','mob-header-search',1);
						Redux::setOption('globax_enovathemes','mob-header-sidebar',0);
						Redux::setOption('globax_enovathemes','mob-header-icons-color','#ffffff');
						Redux::setOption('globax_enovathemes','mob-header-logo-back-color','#212121');
						Redux::setOption('globax_enovathemes','mob-header-back-color',array(
					        'regular'   => '#ffffff',
					        'hover'     => '#f5f5f5',
					    ));
						Redux::setOption('globax_enovathemes','mob-header-menu-color',array(
							'regular'=>'#424242',
							'hover'=>'#212121'
						));
						Redux::setOption('globax_enovathemes','mob-header-menu-typo',array(
							'font-weight'    => '700', 
					        'font-family'    => 'Montserrat', 
					        'font-size'      => '12px',
					        'letter-spacing' => '1px',
					        'text-transform' => 'uppercase',
						));

					/*	Language switcher
					---------------------*/

						Redux::setOption('globax_enovathemes','language-switcher',0);
						Redux::setOption('globax_enovathemes','mob-language-switcher',0);
						Redux::setOption('globax_enovathemes','language-switcher-width','164px');
						Redux::setOption('globax_enovathemes','language-switcher-back-color',array(
					        'color'     => '#f5f5f5',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-back-hov-color',array(
					        'color'     => '#fd8c40',
					        'alpha'     => 1
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-text-color',array(
					        'regular'  => '#616161',
					        'hover'    => '#ffffff',
					    ));
						Redux::setOption('globax_enovathemes','language-switcher-typo',array('font-size'=>''));

					/*	Sidebar navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','sidebar-navigation',0);

					/*	Fullscreen navigation
					---------------------*/

						Redux::setOption('globax_enovathemes','fullscreen-navigation',0);

				break;

		}

		return $new_value;
	}

	function enovathemes_addons_header_quick_styles_init() {
		add_filter( 'pre_update_option_header_quick_styles', 'enovathemes_addons_header_quick_styles_pre_update', 10, 2 );
	}

	add_action( 'init', 'enovathemes_addons_header_quick_styles_init' );
?>