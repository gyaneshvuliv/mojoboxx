<?php

	globax_enovathemes_global_variables();

	$et_one_page_nav   = (isset($GLOBALS['globax_enovathemes']['one-page-navigation']) && !empty($GLOBALS['globax_enovathemes']['one-page-navigation'])) ? $GLOBALS['globax_enovathemes']['one-page-navigation'] : 'none';
	$header_class      = "header desk one-page-".$et_one_page_nav;
	$mob_header_class  = "header-mobile one-page-".$et_one_page_nav;
	$fullscreen_class  = "fullscreen-bar";
	$sidebar_class     = "sidebar-nav one-page-".$et_one_page_nav;
	$et_navigation     = "default";
	$et_transparent_header = "false";

	if (is_page()) {
		$values           = get_post_custom( get_the_ID() );
		$et_rev_slider    = (isset($values["rev_slider"][0])) ? $values["rev_slider"][0] : "";
    	$one_page         = isset( $values['one_page'][0] ) ? $values["one_page"][0] : "false";
    	$transparent_header = isset( $values['transparent_header'][0] ) ? $values["transparent_header"][0] : "false";

    	$et_transparent_header = $transparent_header;

		if (!empty($et_rev_slider)) {
			$header_class .= " slider-active";
		} else {
			$header_class .= " slider-inactive";
		}

		if ($one_page == 'true') {
			$header_class .= " one-page-active";
		}
	}

	// Quick Styles
		
		$et_transparent_header_blog    = (isset($GLOBALS['globax_enovathemes']['transparent-header-blog']) && $GLOBALS['globax_enovathemes']['transparent-header-blog'] == 1) ? "true" : "false";
		$et_transparent_header_project = (isset($GLOBALS['globax_enovathemes']['transparent-header-project']) && $GLOBALS['globax_enovathemes']['transparent-header-project'] == 1) ? "true" : "false";
		$et_transparent_header_product = (isset($GLOBALS['globax_enovathemes']['transparent-header-product']) && $GLOBALS['globax_enovathemes']['transparent-header-product'] == 1) ? "true" : "false";


		if (is_home() || is_singular( 'post' ) || is_category() || is_tag() || is_day() || is_month() || is_year() || is_search() || is_author() || is_404()) {
			$et_transparent_header = $et_transparent_header_blog;
		}

		if (is_post_type_archive('project') || is_tax('project-category') || is_tax('project-tag') || is_singular( 'project' )) {
			$et_transparent_header = $et_transparent_header_project;
		}

		if (class_exists('Woocommerce')) {
			if (is_shop() || is_product() || is_cart() || is_checkout() || is_account_page() || is_wc_endpoint_url()) {
				$et_transparent_header = $et_transparent_header_product;
			}
		}

		$et_boxed_header          = (isset($GLOBALS['globax_enovathemes']['boxed-header']) && $GLOBALS['globax_enovathemes']['boxed-header'] == 1) ? "true" : "false";
		$et_sticky_header         = (isset($GLOBALS['globax_enovathemes']['sticky-header']) && $GLOBALS['globax_enovathemes']['sticky-header'] == 1) ? "true" : "false";
		$et_full_header           = (isset($GLOBALS['globax_enovathemes']['full-header']) && $GLOBALS['globax_enovathemes']['full-header'] == 1) ? "true" : "false";
		$et_logo_position         = (isset($GLOBALS['globax_enovathemes']['logo-position']) && !empty($GLOBALS['globax_enovathemes']['logo-position'])) ? $GLOBALS['globax_enovathemes']['logo-position'] : "left";
		$et_menu_under_logo       = (isset($GLOBALS['globax_enovathemes']['menu-under-logo']) && $GLOBALS['globax_enovathemes']['menu-under-logo'] == 1) ? "true" : "false";
		$et_menu_under_logo_boxed = (isset($GLOBALS['globax_enovathemes']['menu-under-logo-boxed']) && $GLOBALS['globax_enovathemes']['menu-under-logo-boxed'] == 1) ? "true" : "false";
		$et_menu_under_logo_icons = (isset($GLOBALS['globax_enovathemes']['menu-under-logo-icons']) && $GLOBALS['globax_enovathemes']['menu-under-logo-icons'] == 1) ? "true" : "false";

		$et_header_under_slider = (isset($GLOBALS['globax_enovathemes']['header-under-slider']) && $GLOBALS['globax_enovathemes']['header-under-slider'] == 1) ? "true" : "false";

	// Logo

		$et_logo   = (isset($GLOBALS['globax_enovathemes']['logo']['url']) && !empty($GLOBALS['globax_enovathemes']['logo']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['logo']['url']) : "";
		$et_logo_w = (isset($GLOBALS['globax_enovathemes']['logo']['url']) && !empty($GLOBALS['globax_enovathemes']['logo']['url'])) ? $GLOBALS['globax_enovathemes']['logo']['width']: "";
		$et_logo_h = (isset($GLOBALS['globax_enovathemes']['logo']['url']) && !empty($GLOBALS['globax_enovathemes']['logo']['url'])) ? $GLOBALS['globax_enovathemes']['logo']['height'] : "";
		if (isset($GLOBALS['globax_enovathemes']['logo-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-retina']['url'])) 
		{$et_logo = esc_url($GLOBALS['globax_enovathemes']['logo-retina']['url']);}

		$et_transparent_logo   = (isset($GLOBALS['globax_enovathemes']['transparent-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['transparent-logo']['url']) : "";
		$et_transparent_logo_w = (isset($GLOBALS['globax_enovathemes']['transparent-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo']['url'])) ? $GLOBALS['globax_enovathemes']['transparent-logo']['width']: "";
		$et_transparent_logo_h = (isset($GLOBALS['globax_enovathemes']['transparent-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo']['url'])) ? $GLOBALS['globax_enovathemes']['transparent-logo']['height'] : "";
		if (isset($GLOBALS['globax_enovathemes']['transparent-logo-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo-retina']['url'])) 
		{$et_transparent_logo = esc_url($GLOBALS['globax_enovathemes']['transparent-logo-retina']['url']);}

		$et_mob_logo       = (isset($GLOBALS['globax_enovathemes']['logo-mobile']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-mobile']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['logo-mobile']['url']) : $et_logo;
		$et_mob_logo_w     = (isset($GLOBALS['globax_enovathemes']['logo-mobile']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-mobile']['url'])) ? $GLOBALS['globax_enovathemes']['logo-mobile']['width'] : $et_logo_w;
		$et_mob_logo_h     = (isset($GLOBALS['globax_enovathemes']['logo-mobile']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-mobile']['url'])) ? $GLOBALS['globax_enovathemes']['logo-mobile']['height'] : $et_logo_h;
		if (isset($GLOBALS['globax_enovathemes']['logo-mobile-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-mobile-retina']['url']))
		{$et_mob_logo = esc_url($GLOBALS['globax_enovathemes']['logo-mobile-retina']['url']);}

		$et_transparent_mob_logo       = (isset($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url']) : $et_mob_logo;
		$et_transparent_mob_logo_w     = (isset($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url'])) ? $GLOBALS['globax_enovathemes']['transparent-logo-mobile']['width'] : $et_mob_logo_w;
		$et_transparent_mob_logo_h     = (isset($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo-mobile']['url'])) ? $GLOBALS['globax_enovathemes']['transparent-logo-mobile']['height'] : $et_mob_logo_h;
		if (isset($GLOBALS['globax_enovathemes']['transparent-logo-mobile-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['transparent-logo-mobile-retina']['url']))
		{$et_transparent_mob_logo = esc_url($GLOBALS['globax_enovathemes']['transparent-logo-mobile-retina']['url']);}

		if ($et_transparent_header == "true") {
			$et_logo   = $et_transparent_logo;
			$et_logo_w = $et_transparent_logo_w;
			$et_logo_h = $et_transparent_logo_h;

			$et_mob_logo   = $et_transparent_mob_logo;
			$et_mob_logo_w = $et_transparent_mob_logo_w;
			$et_mob_logo_h = $et_transparent_mob_logo_h;
		}

		$et_logo_fixed   = (isset($GLOBALS['globax_enovathemes']['logo-fixed']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-fixed']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['logo-fixed']['url']) : $et_logo;
		$et_logo_fixed_w = (isset($GLOBALS['globax_enovathemes']['logo-fixed']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-fixed']['url'])) ? $GLOBALS['globax_enovathemes']['logo-fixed']['width']: $et_logo_w;
		$et_logo_fixed_h = (isset($GLOBALS['globax_enovathemes']['logo-fixed']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-fixed']['url'])) ? $GLOBALS['globax_enovathemes']['logo-fixed']['height'] : $et_logo_h;
		if (isset($GLOBALS['globax_enovathemes']['logo-fixed-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['logo-fixed-retina']['url'])) 
		{$et_logo_fixed = esc_url($GLOBALS['globax_enovathemes']['logo-fixed-retina']['url']);}
		
		
		
	// Header top

		$et_header_top               = (isset($GLOBALS['globax_enovathemes']['header-top']) && $GLOBALS['globax_enovathemes']['header-top'] == 1) ? "true" : "false";
		$et_mob_header_top           = (isset($GLOBALS['globax_enovathemes']['mob-header-top']) && $GLOBALS['globax_enovathemes']['mob-header-top'] == 1) ? "true" : "false";
		$et_header_top_social_links  = (isset($GLOBALS['globax_enovathemes']['header-top-social-links']) && $GLOBALS['globax_enovathemes']['header-top-social-links'] == 1) ? "true" : "false";
	
	// Header & Menu

		$et_no_logo                     = (isset($GLOBALS['globax_enovathemes']['no-logo']) && $GLOBALS['globax_enovathemes']['no-logo'] == 1) ? "true" : "false";
		$et_menu_position               = (isset($GLOBALS['globax_enovathemes']['menu-position']) && !empty($GLOBALS['globax_enovathemes']['menu-position'])) ? $GLOBALS['globax_enovathemes']['menu-position'] : "left";
		$et_border_box            	    = (isset($GLOBALS['globax_enovathemes']['border-box']) && $GLOBALS['globax_enovathemes']['border-box'] == 1) ? "true" : "false";
		$et_header_search            	= (isset($GLOBALS['globax_enovathemes']['header-search']) && $GLOBALS['globax_enovathemes']['header-search'] == 1) ? "true" : "false";
		$et_header_social_links         = (isset($GLOBALS['globax_enovathemes']['header-social-links']) && $GLOBALS['globax_enovathemes']['header-social-links'] == 1) ? "true" : "false";
		$et_header_shop_cart         	= (isset($GLOBALS['globax_enovathemes']['header-shop-cart']) && $GLOBALS['globax_enovathemes']['header-shop-cart'] == 1) ? "true" : "false";
		$et_language_switcher        	= (isset($GLOBALS['globax_enovathemes']['language-switcher']) && !empty($GLOBALS['globax_enovathemes']['language-switcher'])) ? "true" : "false";
		$et_header_menu_effect       	= (isset($GLOBALS['globax_enovathemes']['header-menu-effect']) && !empty($GLOBALS['globax_enovathemes']['header-menu-effect'])) ? $GLOBALS['globax_enovathemes']['header-menu-effect'] : "underline";
		$et_header_submenu_effect    	= (isset($GLOBALS['globax_enovathemes']['header-submenu-effect']) && !empty($GLOBALS['globax_enovathemes']['header-submenu-effect'])) ? $GLOBALS['globax_enovathemes']['header-submenu-effect'] : "ghost";
		$et_header_submenu_hover_effect = (isset($GLOBALS['globax_enovathemes']['header-submenu-hover-effect']) && !empty($GLOBALS['globax_enovathemes']['header-submenu-hover-effect'])) ? $GLOBALS['globax_enovathemes']['header-submenu-hover-effect'] : "none";
		$header_height                  = (isset($GLOBALS['globax_enovathemes']['header-height']) && $GLOBALS['globax_enovathemes']['header-height']) ? $GLOBALS['globax_enovathemes']['header-height'] : '80';
		$sticky_header_height           = (isset($GLOBALS['globax_enovathemes']['sticky-header-height']) && $GLOBALS['globax_enovathemes']['sticky-header-height']) ? $GLOBALS['globax_enovathemes']['sticky-header-height'] : $header_height;

		$element_wrap_start = '';
		$element_wrap_end   = '';

		if ($et_menu_position == "center" && $et_no_logo == "true") {
			$element_wrap_start = '<div class="header-elements-wrapper et-clearfix">';
			$element_wrap_end   = '</div>';
		}

	// Sidebar

		$et_sidebar 		 = (isset($GLOBALS['globax_enovathemes']['sidebar']) && $GLOBALS['globax_enovathemes']['sidebar'] == 1) ? "true" : "false";

	// Sidebar navigation

		$et_sidebar_navigation = (isset($GLOBALS['globax_enovathemes']['sidebar-navigation']) && $GLOBALS['globax_enovathemes']['sidebar-navigation'] == 1) ? "true" : "false";
	    $et_sidebar_logo       = (isset($GLOBALS['globax_enovathemes']['sidebar-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['sidebar-logo']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['sidebar-logo']['url']) : "";
		$et_sidebar_logo_w     = (isset($GLOBALS['globax_enovathemes']['sidebar-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['sidebar-logo']['url'])) ? $GLOBALS['globax_enovathemes']['sidebar-logo']['width']: "";
		$et_sidebar_logo_h     = (isset($GLOBALS['globax_enovathemes']['sidebar-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['sidebar-logo']['url'])) ? $GLOBALS['globax_enovathemes']['sidebar-logo']['height'] : "";
		if (isset($GLOBALS['globax_enovathemes']['sidebar-logo-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['sidebar-logo-retina']['url'])) 
		{$et_sidebar_logo      = esc_url($GLOBALS['globax_enovathemes']['sidebar-logo-retina']['url']);}

	    $et_sidebar_submenu_effect = (isset($GLOBALS['globax_enovathemes']['sidebar-submenu-effect']) && !empty($GLOBALS['globax_enovathemes']['sidebar-submenu-effect'])) ? $GLOBALS['globax_enovathemes']['sidebar-submenu-effect'] : "ghost";
	    $et_sidebar_position  	   = (isset($GLOBALS['globax_enovathemes']['sidebar-position']) && !empty($GLOBALS['globax_enovathemes']['sidebar-position'])) ? $GLOBALS['globax_enovathemes']['sidebar-position'] : "left";
	    $et_sidebar_alignment 	   = (isset($GLOBALS['globax_enovathemes']['sidebar-alignment']) && !empty($GLOBALS['globax_enovathemes']['sidebar-alignment'])) ? $GLOBALS['globax_enovathemes']['sidebar-alignment'] : "center";
	    $et_sidebar_menu_vertical  = (isset($GLOBALS['globax_enovathemes']['sidebar-menu-vertical']) && $GLOBALS['globax_enovathemes']['sidebar-menu-vertical'] == 1) ? "true" : "false";

	// Fullscreen navigation

		$et_fullscreen_navigation           = (isset($GLOBALS['globax_enovathemes']['fullscreen-navigation']) && $GLOBALS['globax_enovathemes']['fullscreen-navigation'] == 1) ? "true" : "false";
	    $et_fullscreen_transparent          = (isset($GLOBALS['globax_enovathemes']['fullscreen-transparent']) && $GLOBALS['globax_enovathemes']['fullscreen-transparent'] == 1) ? "true" : "false";
	    $et_fullscreen_sticky               = (isset($GLOBALS['globax_enovathemes']['fullscreen-sticky']) && $GLOBALS['globax_enovathemes']['fullscreen-sticky'] == 1) ? "true" : "false";
		$et_fullscreen_full_header          = (isset($GLOBALS['globax_enovathemes']['fullscreen-full-header']) && $GLOBALS['globax_enovathemes']['fullscreen-full-header'] == 1) ? "true" : "false";
		$et_fullscreen_logo_position        = (isset($GLOBALS['globax_enovathemes']['fullscreen-logo-position']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-logo-position'])) ? $GLOBALS['globax_enovathemes']['fullscreen-logo-position'] : "left";
		$et_fullscreen_search               = (isset($GLOBALS['globax_enovathemes']['fullscreen-search']) && $GLOBALS['globax_enovathemes']['fullscreen-search'] == 1) ? "true" : "false";
		$et_fullscreen_social_links         = (isset($GLOBALS['globax_enovathemes']['fullscreen-social-links']) && $GLOBALS['globax_enovathemes']['fullscreen-social-links'] == 1) ? "true" : "false";
		$et_fullscreen_language_switcher    = (isset($GLOBALS['globax_enovathemes']['fullscreen-language-switcher']) && $GLOBALS['globax_enovathemes']['fullscreen-language-switcher'] == 1) ? "true" : "false";
		$et_fullscreen_header_icons_version = (isset($GLOBALS['globax_enovathemes']['fullscreen-header-icons-version']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-header-icons-version'])) ? $GLOBALS['globax_enovathemes']['fullscreen-header-icons-version'] : "dark";
		$et_fullscreen_sticky_icons_version = (isset($GLOBALS['globax_enovathemes']['fullscreen-sticky-icons-version']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-sticky-icons-version'])) ? $GLOBALS['globax_enovathemes']['fullscreen-sticky-icons-version'] : $et_fullscreen_header_icons_version;
		$et_fullscreen_header_icons_size    = (isset($GLOBALS['globax_enovathemes']['fullscreen-header-icons-size']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-header-icons-size'])) ? $GLOBALS['globax_enovathemes']['fullscreen-header-icons-size'] : "medium";

		$et_fullscreen_logo   = (isset($GLOBALS['globax_enovathemes']['fullscreen-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-logo']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['fullscreen-logo']['url']) : "";
		$et_fullscreen_logo_w = (isset($GLOBALS['globax_enovathemes']['fullscreen-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-logo']['url'])) ? $GLOBALS['globax_enovathemes']['fullscreen-logo']['width']: "";
		$et_fullscreen_logo_h = (isset($GLOBALS['globax_enovathemes']['fullscreen-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-logo']['url'])) ? $GLOBALS['globax_enovathemes']['fullscreen-logo']['height'] : "";
		if (isset($GLOBALS['globax_enovathemes']['fullscreen-logo-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['fullscreen-logo-retina']['url'])) 
		{$et_fullscreen_logo = esc_url($GLOBALS['globax_enovathemes']['fullscreen-logo-retina']['url']);}

		if ($et_fullscreen_navigation == "true") {
	    	$et_navigation = "fullscreen";
	    }

		if ($et_sidebar_navigation == "true") {
	    	$et_navigation = "sidebar";
	    }

	    if ($et_sidebar_navigation == "false" && $et_fullscreen_navigation == "false") {
	    	$et_navigation = "default";
	    }

	// Mobile

		$et_mob_header_search        = (isset($GLOBALS['globax_enovathemes']['mob-header-search']) && $GLOBALS['globax_enovathemes']['mob-header-search'] == 1) ? "true" : "false";
		$et_mob_header_shop_cart     = (isset($GLOBALS['globax_enovathemes']['mob-header-shop-cart']) && $GLOBALS['globax_enovathemes']['mob-header-shop-cart'] == 1) ? "true" : "false";
		$et_mob_language_switcher    = (isset($GLOBALS['globax_enovathemes']['mob-language-switcher']) && !empty($GLOBALS['globax_enovathemes']['mob-language-switcher'])) ? "true" : "false";
		$et_mob_header_sidebar       = (isset($GLOBALS['globax_enovathemes']['mob-header-sidebar']) && $GLOBALS['globax_enovathemes']['mob-header-sidebar'] == 1) ? "true" : "false";

	$header_class .=" no-logo-".$et_no_logo;
	$header_class .=" border-box-".$et_border_box;
	$header_class .=" transparent-".$et_transparent_header;
	$header_class .=" boxed-".$et_boxed_header;
	$header_class .=" sticky-".$et_sticky_header;
	$header_class .=" full-".$et_full_header;
	$header_class .=" logopos-".$et_logo_position;
	$header_class .=" menupos-".$et_menu_position;
	$header_class .=" menu-under-logo-".$et_menu_under_logo;
	$header_class .=" menu-under-logo-boxed-".$et_menu_under_logo_boxed;
	$header_class .=" menu-under-logo-icons-".$et_menu_under_logo_icons;
	$header_class .=" header-under-slider-".$et_header_under_slider;
	$header_class .=" top-".$et_header_top;
	$header_class .=" sidebar-".$et_sidebar;
	$header_class .=" top-sl-".$et_header_top_social_links;
	$header_class .=" search-".$et_header_search;
	$header_class .=" social-links-".$et_header_social_links;
	$header_class .=" cart-".$et_header_shop_cart;
	$header_class .=" language-".$et_language_switcher;
	$header_class .=" effect-".$et_header_menu_effect;
	$header_class .=" subeffect-".$et_header_submenu_effect;
	$header_class .=" subeffect-hover-".$et_header_submenu_hover_effect;

	$mob_header_class .=" top-".$et_header_top;
	$mob_header_class .=" sidebar-".$et_sidebar;
	$mob_header_class .=" top-sl-".$et_header_top_social_links;
	$mob_header_class .=" transparent-".$et_transparent_header;
	$mob_header_class .=" no-logo-".$et_no_logo;

	$fullscreen_class .=" transparent-".$et_fullscreen_transparent;
	$fullscreen_class .=" sticky-".$et_fullscreen_sticky;
	$fullscreen_class .=" full-".$et_fullscreen_full_header;
	$fullscreen_class .=" logo-position-".$et_fullscreen_logo_position;
	$fullscreen_class .=" search-".$et_fullscreen_search;
	$fullscreen_class .=" social-".$et_fullscreen_social_links;
	$fullscreen_class .=" cart-".$et_header_shop_cart;
	$fullscreen_class .=" language-".$et_fullscreen_language_switcher;
	$fullscreen_class .=" iversion-".$et_fullscreen_header_icons_version;
	$fullscreen_class .=" isize-".$et_fullscreen_header_icons_size;
	$fullscreen_class .=" siversion-".$et_fullscreen_sticky_icons_version;

	$sidebar_class .=" position-".$et_sidebar_position;
	$sidebar_class .=" alignment-".$et_sidebar_alignment;
	$sidebar_class .=" vertical-".$et_sidebar_menu_vertical;
	$sidebar_class .=" subeffect-".$et_sidebar_submenu_effect;

	$mobarg_main = array( 
		'theme_location' => 'mobile-menu', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'mob-header-menu',
		'link_before'    => '<span class="mi"></span><span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-down"></span>'
	);

	$mobarg = array( 
		'theme_location' => 'header-menu', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'mob-header-menu',
		'link_before'    => '<span class="mi"></span><span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-down"></span>'
	);

	$mobarg_1 = array( 
		'theme_location' => 'header-menu-left', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'mob-header-menu',
		'link_before'    => '<span class="mi"></span><span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-down"></span>'
	);

	$mobarg_2 = array( 
		'theme_location' => 'header-menu-right', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'mob-header-menu',
		'link_before'    => '<span class="mi"></span><span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-down"></span>'
	);

	$toparg = array( 
		'theme_location' => 'top-menu', 
		'depth'          => 2, 
		'container'      => false, 
		'menu_id'        => 'header-top-menu',
		'link_before'    => '<span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-down"></span>',
		'walker'         => new et_scm_walker
	);

	if ($et_header_menu_effect == 'dottes') {
		$link_after = '</span><span class="dottes"></span><span class="mi fa fa-angle-down"></span>';
	} else {
		$link_after = '</span><span class="mi fa fa-angle-down"></span>';
	}

	$headerarg = array( 
		'theme_location' => 'header-menu', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'header-menu',
		'link_before'    => '<span class="txt">',
		'link_after'     => $link_after,
		'walker'         => new et_scm_walker
	);

	$headerarg_1 = array( 
		'theme_location' => 'header-menu-left', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'header-menu-left',
		'link_before'    => '<span class="txt">',
		'link_after'     => $link_after,
		'walker'         => new et_scm_walker
	);

	$headerarg_2 = array( 
		'theme_location' => 'header-menu-right', 
		'depth'          => 4, 
		'container'      => false, 
		'menu_id'        => 'header-menu-right',
		'link_before'    => '<span class="txt">',
		'link_after'     => $link_after,
		'walker'         => new et_scm_walker
	);

	$sidebararg = array( 
		'theme_location' => 'sidebar-menu', 
		'depth'          => 3, 
		'container'      => false, 
		'menu_id'        => 'sidebar-menu',
		'link_before'    => '<span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-right"></span>',
	);

	$fullscreenarg = array( 
		'theme_location' => 'fullscreen-menu', 
		'depth'          => 3, 
		'container'      => false, 
		'menu_id'        => 'fullscreen-menu',
		'link_before'    => '<span class="txt">',
		'link_after'     => '</span><span class="mi fa fa-angle-down"></span>',
	);

?>