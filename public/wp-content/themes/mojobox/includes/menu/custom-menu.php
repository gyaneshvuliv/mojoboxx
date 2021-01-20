<?php

class ET_Globax_Custom_Menu {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'globax_enovathemes_scm_add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'globax_enovathemes_scm_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'globax_enovathemes_scm_edit_walker'), 10, 2 );

	} // end constructor
	
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function globax_enovathemes_scm_add_custom_nav_fields( $menu_item ) {
	
	    $menu_item->icon          = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	    $menu_item->backimg       = get_post_meta( $menu_item->ID, '_menu_item_backimg', true );
	    $menu_item->megamenu      = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
	    $menu_item->megamenucol   = get_post_meta( $menu_item->ID, '_menu_item_megamenucol', true );
	    $menu_item->megamenuwidth = get_post_meta( $menu_item->ID, '_menu_item_megamenuwidth', true );
	    $menu_item->lcolor        = get_post_meta( $menu_item->ID, '_menu_item_lcolor', true );
	    $menu_item->ltext         = get_post_meta( $menu_item->ID, '_menu_item_ltext', true );

	    $menu_item->button          = get_post_meta( $menu_item->ID, '_menu_item_button', true );
	    $menu_item->buttonradius    = get_post_meta( $menu_item->ID, '_menu_item_buttonradius', true );
	    $menu_item->buttontext      = get_post_meta( $menu_item->ID, '_menu_item_buttontext', true );
	    $menu_item->buttonback      = get_post_meta( $menu_item->ID, '_menu_item_buttonback', true );
	    $menu_item->buttonborder    = get_post_meta( $menu_item->ID, '_menu_item_buttonborder', true );
	    $menu_item->buttontexthov   = get_post_meta( $menu_item->ID, '_menu_item_buttontexthov', true );
	    $menu_item->buttonbackhov   = get_post_meta( $menu_item->ID, '_menu_item_buttonbackhov', true );
	    $menu_item->buttonborderhov = get_post_meta( $menu_item->ID, '_menu_item_buttonborderhov', true );

	    return $menu_item;
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function globax_enovathemes_scm_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent

		if (isset($_REQUEST['menu-item-icon']) && is_array( $_REQUEST['menu-item-icon']) ) {
	        $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_icon', $icon_value );
	    }

	    if (isset($_REQUEST['menu-item-megamenu']) && is_array( $_REQUEST['menu-item-megamenu']) ) {
	        $megamenu_value = $_REQUEST['menu-item-megamenu'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value );
	    }
		
	    if (isset($_REQUEST['menu-item-megamenucol']) && is_array( $_REQUEST['menu-item-megamenucol']) ) {
	        $megamenucol_value = $_REQUEST['menu-item-megamenucol'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenucol', $megamenucol_value );
	    }

	    if (isset($_REQUEST['menu-item-megamenuwidth']) && is_array( $_REQUEST['menu-item-megamenuwidth']) ) {
	        $megamenuwidth_value = $_REQUEST['menu-item-megamenuwidth'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_megamenuwidth', $megamenuwidth_value );
	    }

	    if (isset($_REQUEST['menu-item-backimg']) && is_array( $_REQUEST['menu-item-backimg']) ) {
	        $backimg_value = $_REQUEST['menu-item-backimg'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_backimg', $backimg_value );
	    }

	    if (isset($_REQUEST['menu-item-lcolor']) && is_array( $_REQUEST['menu-item-lcolor']) ) {
	        $lcolor_value = $_REQUEST['menu-item-lcolor'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_lcolor', $lcolor_value );
	    }

	    if (isset($_REQUEST['menu-item-ltext']) && is_array( $_REQUEST['menu-item-ltext']) ) {
	        $ltext_value = $_REQUEST['menu-item-ltext'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_ltext', $ltext_value );
	    }

	    if (isset($_REQUEST['menu-item-button']) && is_array( $_REQUEST['menu-item-button']) ) {
	        $button_value = $_REQUEST['menu-item-button'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_button', $button_value );
	    }

	    if (isset($_REQUEST['menu-item-buttonradius']) && is_array( $_REQUEST['menu-item-buttonradius']) ) {
	        $buttonradius_value = $_REQUEST['menu-item-buttonradius'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttonradius', $buttonradius_value );
	    }

	    if (isset($_REQUEST['menu-item-buttontext']) && is_array( $_REQUEST['menu-item-buttontext']) ) {
	        $buttontext_value = $_REQUEST['menu-item-buttontext'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttontext', $buttontext_value );
	    }

	    if (isset($_REQUEST['menu-item-buttonback']) && is_array( $_REQUEST['menu-item-buttonback']) ) {
	        $buttonback_value = $_REQUEST['menu-item-buttonback'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttonback', $buttonback_value );
	    }

	    if (isset($_REQUEST['menu-item-buttonborder']) && is_array( $_REQUEST['menu-item-buttonborder']) ) {
	        $buttonborder_value = $_REQUEST['menu-item-buttonborder'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttonborder', $buttonborder_value );
	    }

	    if (isset($_REQUEST['menu-item-buttontexthov']) && is_array( $_REQUEST['menu-item-buttontexthov']) ) {
	        $buttontexthov_value = $_REQUEST['menu-item-buttontexthov'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttontexthov', $buttontexthov_value );
	    }

	    if (isset($_REQUEST['menu-item-buttonbackhov']) && is_array( $_REQUEST['menu-item-buttonbackhov']) ) {
	        $buttonbackhov_value = $_REQUEST['menu-item-buttonbackhov'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttonbackhov', $buttonbackhov_value );
	    }

	    if (isset($_REQUEST['menu-item-buttonborderhov']) && is_array( $_REQUEST['menu-item-buttonborderhov']) ) {
	        $buttonborderhov_value = $_REQUEST['menu-item-buttonborderhov'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_item_buttonborderhov', $buttonborderhov_value );
	    }
	    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function globax_enovathemes_scm_edit_walker($walker,$menu_id) {
	
	    return 'Walker_Nav_Menu_Edit_Custom';
	    
	}

}

// instantiate plugin's class
$GLOBALS['custom_menu'] = new ET_Globax_Custom_Menu();

include_once( get_template_directory() .'/includes/menu/edit_custom_walker.php' );
include_once( get_template_directory() .'/includes/menu/custom_walker.php' );