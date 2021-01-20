<?php

	function enovathemes_addons_footer() {

		$labels = array(
			'name'               => esc_html__('Footers', 'enovathemes-addons'),
			'singular_name'      => esc_html__('Footers', 'enovathemes-addons'),
			'add_new'            => esc_html__('Add new', 'enovathemes-addons'),
			'add_new_item'       => esc_html__('Add new footer', 'enovathemes-addons'),
			'edit_item'          => esc_html__('Edit footer', 'enovathemes-addons'),
			'new_item'           => esc_html__('New footer', 'enovathemes-addons'),
			'all_items'          => esc_html__('All footers', 'enovathemes-addons'),
			'view_item'          => esc_html__('View footer', 'enovathemes-addons'),
			'search_items'       => esc_html__('Search footer', 'enovathemes-addons'),
			'not_found'          => esc_html__('No footer found', 'enovathemes-addons'),
			'not_found_in_trash' => esc_html__('No footer found in trash', 'enovathemes-addons'), 
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Footers', 'enovathemes-addons')
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'exclude_from_search'=> true,
			'show_ui'            => true, 
			'show_in_menu'       => true, 
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'footer','with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => false, 
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-schedule',
			'supports'           => array( 'title', 'editor'),
		);

		register_post_type( 'footer', $args );
	}

	add_action( 'init', 'enovathemes_addons_footer' );


	add_filter("manage_edit-footer_columns", "enovathemes_addons_footer_edit_columns");
	function enovathemes_addons_footer_edit_columns($columns){
		$columns['cb']             = "<input type=\"checkbox\" />";
		$columns['title']          = esc_html__("Title", 'enovathemes-addons');
		$columns['active']         = esc_html__("Active footer", 'enovathemes-addons');

		unset($columns['comments']);
		return $columns;
	}

	add_action("manage_footer_posts_custom_column", "enovathemes_addons_footer_custom_columns");
	function enovathemes_addons_footer_custom_columns($column){
		global $post;
		
		$footer_settings   = get_option('footer_settings');
		$footer_id         = isset($footer_settings["footer_id"]) ? $footer_settings["footer_id"] : "none";


		switch ($column){
			case "active":
			if ($footer_id == $post->ID) {
				echo '<div class="custom-meta-ind active-footer">'.esc_html__("Active", 'enovathemes-addons').'</div>';
			}
			break;
		}
	}

	add_action( 'admin_menu', 'footer_settings' );
	function footer_settings(){
		add_submenu_page(
			'edit.php?post_type=footer',
			esc_html__( 'Chose footer', 'enovathemes-addons'),
			esc_html__( 'Chose footer', 'enovathemes-addons'),
			'administrator',
			'footer_settings',
			'render_footer_settings'
		);
	}

	function render_footer_settings(){	
	?>
		<?php settings_errors(); ?>
		<form class="enovathemes-footer-settings" method="post" action="options.php">
			<?php
				settings_fields( 'footer_settings' );
				do_settings_sections( 'footer_settings' );
				submit_button();
			?>
		</form>
	<?php }
	
	function footer_default_settings(){
		$defaults = array(
			'footer_id' => 'none',
		);
		return apply_filters( 'footer_default_settings', $defaults );
	}

	function initialize_footer_settings (){

		if( false == get_option( 'footer_settings' ) ) {	
			add_option( 'footer_settings', apply_filters( 'footer_default_settings', footer_default_settings() ) );
		}

		add_settings_section( 
	        'footer_settings_section',
	        esc_html__( 'Chose footer', 'enovathemes-addons'),
	        'footer_settings_callback',
	        'footer_settings'
	    );

		add_settings_field(	
			'footer_id',
			esc_html__( 'Footer name:', 'enovathemes-addons'),
			'footer_id_callback',
			'footer_settings',
			'footer_settings_section',
			array(esc_html__('Choose footer name, default is none', 'enovathemes-addons'))
		);

		register_setting(  
	        'footer_settings',  
	        'footer_settings'  
	    );
		
	}
	add_action( 'admin_init', 'initialize_footer_settings' );

	function footer_settings_callback() {  
	    echo '<hr>';  
	}

	function footer_id_callback($args) {

		$settings = get_option('footer_settings');

		if(!isset($settings['footer_id'])) {
			$settings['footer_id'] = "none";
		}

		$output = "";

		$output .= '<div id="footer-slug">';
			$output .= '<select id="footer_settings[footer_id]" name="footer_settings[footer_id]" >';
				
				global $post;

				$footer_query_opt = array( 
					'post_type'=> 'footer', 
					'orderby' => 'title',
					'order'   => 'ASC' 
				);

				$output .= '<option value="none">'.esc_html__('None', 'enovathemes-addons').'</option>';

				$et_footer = new WP_Query($footer_query_opt);

				if($et_footer->have_posts()){
					while ($et_footer->have_posts()) {
						$et_footer->the_post();
						$output .= '<option value="'.$post->ID.'"'.selected( $settings['footer_id'], $post->ID, false) . '>'.$post->post_title.'</option>';
					}
				}
				wp_reset_postdata();
			$output .= '</select>';
			$output .= '<p>'.$args[0].'</p>';
		$output .= '</div>';
		echo $output;
	     
	}
?>