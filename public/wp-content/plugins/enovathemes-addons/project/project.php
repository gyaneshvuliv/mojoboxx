<?php
	function enovathemes_addons_project() {

		global $globax_enovathemes;
		$slug = (isset($GLOBALS['globax_enovathemes']['project-slug']) && !empty($GLOBALS['globax_enovathemes']['project-slug'])) ? esc_attr($GLOBALS['globax_enovathemes']['project-slug']) : 'project';

		$labels = array(
			'name'               => esc_html__('Projects', 'enovathemes-addons'),
			'singular_name'      => esc_html__('Project', 'enovathemes-addons'),
			'add_new'            => esc_html__('Add new', 'enovathemes-addons'),
			'add_new_item'       => esc_html__('Add new project', 'enovathemes-addons'),
			'edit_item'          => esc_html__('Edit project', 'enovathemes-addons'),
			'new_item'           => esc_html__('New project', 'enovathemes-addons'),
			'all_items'          => esc_html__('All projects', 'enovathemes-addons'),
			'view_item'          => esc_html__('View project', 'enovathemes-addons'),
			'search_items'       => esc_html__('Search projects', 'enovathemes-addons'),
			'not_found'          => esc_html__('No projects found', 'enovathemes-addons'),
			'not_found_in_trash' => esc_html__('No projects found in trash', 'enovathemes-addons'), 
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__('Project', 'enovathemes-addons')
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true, 
			'show_in_menu'       => true, 
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $slug,'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => true, 
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-portfolio',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt'),
		);

		register_post_type( 'project', $args );
	}

	add_action( 'init', 'enovathemes_addons_project' );

	function enovathemes_addons_project_taxonomies() {

		global $globax_enovathemes;
		$category_slug = (isset($GLOBALS['globax_enovathemes']['project-cat-slug']) && !empty($GLOBALS['globax_enovathemes']['project-cat-slug'])) ? esc_attr($GLOBALS['globax_enovathemes']['project-cat-slug']) : 'project-category';
		$tag_slug      = (isset($GLOBALS['globax_enovathemes']['project-tag-slug']) && !empty($GLOBALS['globax_enovathemes']['project-tag-slug'])) ? esc_attr($GLOBALS['globax_enovathemes']['project-tag-slug']) : 'project-tag';

		register_taxonomy('project-category', 'project', array(
			'hierarchical' => true,
			'labels' => array(
				'name' 				=> esc_html__( 'Category', 'enovathemes-addons' ),
				'singular_name' 	=> esc_html__( 'Category', 'enovathemes-addons' ),
				'search_items' 		=> esc_html__( 'Search category', 'enovathemes-addons' ),
				'all_items' 		=> esc_html__( 'All categories', 'enovathemes-addons' ),
				'parent_item' 		=> esc_html__( 'Parent category', 'enovathemes-addons' ),
				'parent_item_colon' => esc_html__( 'Parent category', 'enovathemes-addons' ),
				'edit_item' 		=> esc_html__( 'Edit category', 'enovathemes-addons' ),
				'update_item' 		=> esc_html__( 'Update category', 'enovathemes-addons' ),
				'add_new_item' 		=> esc_html__( 'Add new category', 'enovathemes-addons' ),
				'new_item_name' 	=> esc_html__( 'New category', 'enovathemes-addons' ),
				'menu_name' 		=> esc_html__( 'Categories', 'enovathemes-addons' ),
			),
			'rewrite' => array(
				'slug' 		   => $category_slug,
				'with_front'   => true,
				'hierarchical' => true
			),
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true
		));

		register_taxonomy('project-tag', 'project', array(
			'hierarchical' => false,
			'labels' => array(
				'name' 				=> esc_html__( 'Projects tags', 'enovathemes-addons' ),
				'singular_name' 	=> esc_html__( 'Projects tag', 'enovathemes-addons' ),
				'search_items' 		=> esc_html__( 'Search project tags', 'enovathemes-addons' ),
				'all_items' 		=> esc_html__( 'All project tags', 'enovathemes-addons' ),
				'parent_item' 		=> esc_html__( 'Parent project tags', 'enovathemes-addons' ),
				'parent_item_colon' => esc_html__( 'Parent project tag:', 'enovathemes-addons' ),
				'edit_item' 		=> esc_html__( 'Edit project tag', 'enovathemes-addons' ),
				'update_item' 		=> esc_html__( 'Update project tag', 'enovathemes-addons' ),
				'add_new_item'	    => esc_html__( 'Add new project tag', 'enovathemes-addons' ),
				'new_item_name' 	=> esc_html__( 'New project tag', 'enovathemes-addons' ),
				'menu_name' 		=> esc_html__( 'Tags', 'enovathemes-addons' ),
			),
			'rewrite' 		   => array(
				'slug' 		   => $tag_slug,
				'with_front'   => true,
				'hierarchical' => false
			),
		));

	}
	add_action( 'init', 'enovathemes_addons_project_taxonomies', 0 );

	add_filter("manage_edit-project_columns", "enovathemes_addons_project_edit_columns");

	function enovathemes_addons_project_edit_columns($columns){
		$columns['cb']             = "<input type=\"checkbox\" />";
		$columns['image']          = esc_html__("Thumbnail", 'enovathemes-addons');
		$columns['title']          = esc_html__("Title", 'enovathemes-addons');
		$columns['project-tags']   = esc_html__("Tags", 'enovathemes-addons');
		$columns['layout']         = esc_html__("Layout", 'enovathemes-addons');
		$columns['format']         = esc_html__("Format", 'enovathemes-addons');
		$columns['additional']     = esc_html__("Additional", 'enovathemes-addons');

		unset($columns['comments']);
		return $columns;
	}

	add_action("manage_project_posts_custom_column", "enovathemes_addons_project_custom_columns");

	function enovathemes_addons_project_custom_columns($column){
		global $post;
		$values              = get_post_custom();
		$format              = isset($values["format"][0]) ? $values["format"][0] : "gallery";
		$gallery_type        = isset( $values['gallery_type'][0] ) ? esc_attr( $values["gallery_type"][0] ) : "grid";
		$gallery_columns     = isset( $values['gallery_columns'][0] ) ? esc_attr( $values["gallery_columns"][0] ) : "1";
		$layout              = isset( $values['layout'][0] ) ? esc_attr( $values["layout"][0] ) : "sidebar";
	    $gallery_wide_active = isset( $values['gallery_wide_active'] ) ? esc_attr( $values["gallery_wide_active"][0] ) : "false";

	    if ($gallery_columns == 1) {
	    	$gallery_columns = $gallery_columns.esc_html__(' column','enovathemes-addons');
	    } else {
			$gallery_columns = $gallery_columns.esc_html__(' columns','enovathemes-addons');
	    }

		switch ($column){

			case "project-tags":

				$terms = get_the_terms( $post->ID, 'project-tag' );

				if ( !empty( $terms ) ) {
					$out = array();
					foreach ( $terms as $term ) {
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'project-tag' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'project-tag', 'display' ) )
						);
					}

					echo join( ', ', $out );

				} else {
					echo esc_html__("No tags", 'enovathemes-addons');
				}
				
			break;

			case "image":

				if (has_post_thumbnail()){
					echo '<a href="'.get_edit_post_link($post->ID).'">'.get_the_post_thumbnail($post->ID,'thumbnail').'</a>';
				}
				
			break;

			case "layout":
				if ($layout == "wide") {
					if ($gallery_wide_active == "true") {
						echo '<div class="custom-meta-ind layout">'.$layout.'</div><div class="custom-meta-ind layout-wide">'.esc_html__('100% width', 'enovathemes-addons').'</div>';
					} else {
						echo '<div class="custom-meta-ind layout">'.$layout.'</div>';
					}
			    } else {
			    	echo '<div class="custom-meta-ind layout">'.$layout.'</div>';
			    }
			break;

			case "format":


				if ($layout == "custom") {
						
						echo "--";
				} else {

					switch ($format) {
						case 'gallery':
							echo '<span class="post-state-format post-format-icon post-format-gallery"></span>';
							break;
						case 'audio':
							echo '<span class="post-state-format post-format-icon post-format-audio"></span>';
							break;
						case 'video':
							echo '<span class="post-state-format post-format-icon post-format-video"></span>';
							break;
					}

				}
				
			break;

			case "additional":
				if ($format == "gallery") {

					if ($layout == "custom") {
						
						echo "--";

					} else {

						switch ($gallery_type) {
							case 'grid':
								echo '<div class="custom-meta-ind gallery_type">'.esc_html__('Grid','enovathemes-addons').'</div><div class="custom-meta-ind gallery_columns">'.$gallery_columns.'</div>';
								break;
							case 'carousel_thumb':
								echo '<div class="custom-meta-ind gallery_type">'.esc_html__('Carousel + thumbs','enovathemes-addons').'</div>';
								break;
							case 'carousel':
								echo '<div class="custom-meta-ind gallery_type">'.esc_html__('Carousel','enovathemes-addons').'</div><div class="custom-meta-ind gallery_columns">'.$gallery_columns.'</div>';
								break;
							case 'masonry':
								echo '<div class="custom-meta-ind gallery_type">'.esc_html__('Masonry','enovathemes-addons').'</div><div class="custom-meta-ind gallery_columns">'.$gallery_columns.'</div>';
								break;
							default:
								echo '<div class="custom-meta-ind gallery_type">'.esc_html__('None','enovathemes-addons').'</div>';
							break;
						}

					}
				} else {
					echo "--";
				}
			break;
			
		}
	}
?>