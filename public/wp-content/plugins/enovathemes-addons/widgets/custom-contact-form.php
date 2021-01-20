<?php 
	
	add_action('widgets_init', 'enovathemes_addons_register_fast_contact_widget');
	function enovathemes_addons_register_fast_contact_widget(){
		register_widget( 'Enovathemes_Addons_WP_Widget_Fast_Contact' );
	} 

	class Enovathemes_Addons_WP_Widget_Fast_Contact extends WP_Widget {

		public function __construct() {
			parent::__construct(
				'fast_contact_widget',
				esc_html__('* Fast Contact Form', 'enovathemes-addons'),
				array( 'description' => esc_html__('Fast Contact Form widget', 'enovathemes-addons'))
			);
		}

		public function widget( $args, $instance ) {

			extract($args);

			$title 	      = apply_filters( 'widget_title', $instance['title'] );
			$submit_text  = isset($instance['submit_text']) ? esc_attr($instance['submit_text']) : esc_html__('Send', 'enovathemes-addons');

			echo $before_widget;

				if ( ! empty( $title ) ){echo $before_title . $title . $after_title;}

	            ?>

				<div class="enovathemes-contact-form">
					<form name="enovathemes-contact-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" class="enovathemes-contact-form" method="POST">

						<?php wp_nonce_field( "et_contact_form_action", "et_contact_form_nonce", false, true ); ?>

						<div>
							<span class="alert enovathemes-contact-form-name-valid warning"><?php echo esc_html__('Please enter your name.', 'enovathemes-addons'); ?></span>
							<input type="text" name="enovathemes_contact_form_name" class="enovathemes-contact-form-name" placeholder="<?php echo esc_html__('Your Name', 'enovathemes-addons'); ?>" value=""/>
						</div>

						<div>
							<span class="alert enovathemes-contact-form-email-valid warning"><?php echo esc_html__('Invalid or empty email.', 'enovathemes-addons'); ?></span>
							<input type="text" name="enovathemes_contact_form_email" class="enovathemes-contact-form-email" placeholder="<?php echo esc_html__('Your Email', 'enovathemes-addons'); ?>" value=""/> 
						</div>

						<div class="message-div">
							<span class="alert enovathemes-contact-form-msg-valid warning"><?php echo esc_html__('Please enter your message.', 'enovathemes-addons'); ?></span>
							<textarea name="enovathemes_contact_form_mgs" class="enovathemes-contact-form-mgs" placeholder="<?php echo esc_html__('Write your message.', 'enovathemes-addons'); ?>"></textarea>
						</div>
						<div class="send-div">
							<input type="hidden" name="action" value="enovathemes_contact_form">
							<input class="enovathemes-contact-form-submit" type="submit" value="<?php echo $submit_text; ?>" name="submit" id="enovathemes_contact_form_submit">
							<div class="sending"></div>
						</div>
		            	<div class="enovathemes-contact-form-submit-success alert success"><?php echo esc_html__('Your message successfully sent.', 'enovathemes-addons'); ?></div>
		            	<div class="enovathemes-contact-form-submit-error alert warning"><?php echo esc_html__('Something went wrong. Your message was not send.', 'enovathemes-addons'); ?></div>
		            </form>
        		</div>

			<?php echo $after_widget;
		}

	 	public function form( $instance ) {

	 		$defaults = array(
	 			'title'       => esc_html__('Fast contact', 'enovathemes-addons'),
	 			'submit_text' => esc_html__('Contact us', 'enovathemes-addons'),
	 		);

	 		$instance = wp_parse_args((array) $instance, $defaults);

			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__( 'Title:', 'enovathemes-addons' ); ?></label> 
				<input class="widefat" class="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('submit_text'); ?>"><?php echo esc_html__( 'Submit button text:', 'enovathemes-addons' ); ?></label>
				<input class="widefat" class="<?php echo $this->get_field_id('submit_text'); ?>" name="<?php echo $this->get_field_name('submit_text'); ?>" type="text" value="<?php echo $instance['submit_text']; ?>" />
			</p>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title']       = strip_tags( $new_instance['title'] );
			$instance['submit_text'] = strip_tags($new_instance['submit_text']);
			return $instance;
		}
	}
?>