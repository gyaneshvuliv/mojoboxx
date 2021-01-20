<?php

	add_action('widgets_init', 'enovathemes_addons_register_flickr_widget');
	function enovathemes_addons_register_flickr_widget(){
		register_widget( 'Enovathemes_Addons_WP_Widget_Photos_From_Flickr' );
	}

	class  Enovathemes_Addons_WP_Widget_Photos_From_Flickr extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'photos_from_flickr',
				esc_html__('* Photos from flickr', 'enovathemes-addons'),
				array( 'description' => esc_html__('Display photos from flickr', 'enovathemes-addons'))
			);
		}

		public function widget( $args, $instance ) {

			extract($args);

			$title          = apply_filters( 'widget_title', $instance['title'] );
			$flickr_id      = isset($instance['flickr_id']) ? esc_attr($instance['flickr_id']) : "";
			$columns_mob    = isset($instance['columns_mob']) ? esc_attr($instance['columns_mob']) : "";
			$columns_tablet = isset($instance['columns_tablet']) ? esc_attr($instance['columns_tablet']) : "";
			$columns_desk   = isset($instance['columns_desk']) ? esc_attr($instance['columns_desk']) : "";
			$photos_number  = (isset($instance['photos_number']) && is_numeric($instance['photos_number'])) ? esc_attr($instance['photos_number']) : "6";
			
			$output = "";

			echo $before_widget;
			
				if ( ! empty( $title ) ){echo $before_title . $title . $after_title;}
			
				$output .='<div class="photos_from_flickr columns-mob-'.esc_attr($columns_mob).' columns-tablet-'.esc_attr($columns_tablet).' columns-desk-'.esc_attr($columns_desk).' et-clearfix">';
					$output .='<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$photos_number.'&display=latest&size=s&layout=x&source=user&user='.$flickr_id.'"></script>';
				$output .='</div>';

			echo $output;

			echo $after_widget;
		}

	 	public function form( $instance ) {

	 		$defaults = array(
	 			'title'         => esc_html__('Photos from flickr', 'enovathemes-addons'),
	 			'photos_number' => '6',
	 			'flickr_id'     => '',
	 			'columns_mob'    => '1',
	 			'columns_tablet' => '1',
	 			'columns_desk'   => '1',
	 		);

	 		$instance = wp_parse_args((array) $instance, $defaults);

			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__( 'Title:', 'enovathemes-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php echo esc_html__( 'Flickr Username:', 'enovathemes-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text" value="<?php echo $instance['flickr_id']; ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'photos_number' ); ?>"><?php echo esc_html__( 'Number of photos to show:', 'enovathemes-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'photos_number' ); ?>" name="<?php echo $this->get_field_name( 'photos_number' ); ?>" type="text" value="<?php echo $instance['photos_number']; ?>" size="3" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'columns_mob' ); ?>"><?php echo esc_html__( 'Columns mobile:', 'enovathemes-addons' ); ?></label> 
				<select class="widefat" id="<?php echo $this->get_field_id( 'columns_mob' ); ?>" name="<?php echo $this->get_field_name( 'columns_mob' ); ?>" >
                	<?php for ($i=1; $i < 11; $i++) { ?>
                		<option value="<?php echo $i; ?>" <?php selected( $instance['columns_mob'], $i ); ?>><?php echo esc_html__($i,'enovathemes-addons'); ?></option>
                	<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'columns_tablet' ); ?>"><?php echo esc_html__( 'Columns tablet:', 'enovathemes-addons' ); ?></label> 
				<select class="widefat" id="<?php echo $this->get_field_id( 'columns_tablet' ); ?>" name="<?php echo $this->get_field_name( 'columns_tablet' ); ?>" >
                	<?php for ($i=1; $i < 11; $i++) { ?>
                		<option value="<?php echo $i; ?>" <?php selected( $instance['columns_tablet'], $i ); ?>><?php echo esc_html__($i,'enovathemes-addons'); ?></option>
                	<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'columns_desk' ); ?>"><?php echo esc_html__( 'Columns desktop:', 'enovathemes-addons' ); ?></label> 
				<select class="widefat" id="<?php echo $this->get_field_id( 'columns_desk' ); ?>" name="<?php echo $this->get_field_name( 'columns_desk' ); ?>" >
                	<?php for ($i=1; $i < 11; $i++) { ?>
                		<option value="<?php echo $i; ?>" <?php selected( $instance['columns_desk'], $i ); ?>><?php echo esc_html__($i,'enovathemes-addons'); ?></option>
                	<?php } ?>
				</select>
			</p>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title']         = strip_tags( $new_instance['title'] );
			$instance['photos_number'] = strip_tags( $new_instance['photos_number'] );
			$instance['flickr_id']     = strip_tags( $new_instance['flickr_id'] );
			$instance['columns_mob']    = strip_tags( $new_instance['columns_mob'] );
			$instance['columns_tablet'] = strip_tags( $new_instance['columns_tablet'] );
			$instance['columns_desk']   = strip_tags( $new_instance['columns_desk'] );
			return $instance;
		}
	}

?>