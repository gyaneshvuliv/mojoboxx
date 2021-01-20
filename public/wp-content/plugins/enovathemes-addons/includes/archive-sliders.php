<?php 

add_action( 'admin_menu', 'archive_slider_settings' );
function archive_slider_settings(){
	add_submenu_page(
		'themes.php',
		esc_html__( 'Archive slider', 'enovathemes-addons'),
		esc_html__( 'Archive slider', 'enovathemes-addons'),
		'administrator',
		'archive_slider_settings',
		'render_archive_slider_settings'
	);
}

function render_archive_slider_settings(){	
?>
	<div class="quick-styles-container wrap">
		<?php settings_errors(); ?>
		<form class="enovathemes-archive-slider-settings" method="post" action="options.php">
			<?php
				settings_fields( 'archive_slider_settings' );
				do_settings_sections( 'archive_slider_settings' );
				submit_button();
			?>
		</form>
	</div>
<?php }

function archive_slider_default_settings(){
	$defaults = array(
		'blog_slider_id'    => 'none',
		'project_slider_id' => 'none',
		'shop_slider_id'    => 'none',
	);
	return apply_filters( 'archive_slider_default_settings', $defaults );
}

function initialize_archive_slider_settings (){

	if( false == get_option( 'archive_slider_settings' ) ) {	
		add_option( 'archive_slider_settings', apply_filters( 'archive_slider_default_settings', archive_slider_default_settings() ) );
	}

	add_settings_section( 
        'archive_slider_settings_section',
        esc_html__( 'Chose archive slider', 'enovathemes-addons'),
        'archive_slider_settings_callback',
        'archive_slider_settings'
    );

	add_settings_field(	
		'blog_slider_id',
		esc_html__( 'Blog slider:', 'enovathemes-addons'),
		'blog_slider_id_callback',
		'archive_slider_settings',
		'archive_slider_settings_section',
		array(esc_html__('Choose blog slider', 'enovathemes-addons'))
	);

	add_settings_field(	
		'project_slider_id',
		esc_html__( 'Project slider:', 'enovathemes-addons'),
		'project_slider_id_callback',
		'archive_slider_settings',
		'archive_slider_settings_section',
		array(esc_html__('Choose project slider', 'enovathemes-addons'))
	);

	add_settings_field(	
		'shop_slider_id',
		esc_html__( 'Shop slider:', 'enovathemes-addons'),
		'shop_slider_id_callback',
		'archive_slider_settings',
		'archive_slider_settings_section',
		array(esc_html__('Choose shop slider', 'enovathemes-addons'))
	);

	register_setting(  
        'archive_slider_settings',  
        'archive_slider_settings'  
    );
	
}
add_action( 'admin_init', 'initialize_archive_slider_settings' );

function archive_slider_settings_callback() {  
    echo '<hr>';  
}

function blog_slider_id_callback($args) {

	$settings = get_option('archive_slider_settings');

	if(!isset($settings['blog_slider_id'])) {
		$settings['blog_slider_id'] = "none";
	}

	if(shortcode_exists("rev_slider")){
        echo '<select id="archive_slider_settings[blog_slider_id]" name="archive_slider_settings[blog_slider_id]" >';
            $slider = new RevSlider();
            $revolution_sliders = $slider->getArrSliders();
            echo "<option value='none'>".esc_html__('--- Revolution Sliders ---', 'enovathemes-addons')."</option>";
            foreach ( $revolution_sliders as $revolution_slider ) {
               $checked="";
               $alias = $revolution_slider->getAlias();
               $title = $revolution_slider->getTitle();
               echo '<option value="'.$alias.'" '.selected( $settings['blog_slider_id'], $alias, false).'>'.$title.'</option>';
            }
        echo '</select>';
    }
}

function project_slider_id_callback($args) {

	$settings = get_option('archive_slider_settings');

	if(!isset($settings['project_slider_id'])) {
		$settings['project_slider_id'] = "none";
	}

	if(shortcode_exists("rev_slider")){
        echo '<select id="archive_slider_settings[project_slider_id]" name="archive_slider_settings[project_slider_id]" >';
            $slider = new RevSlider();
            $revolution_sliders = $slider->getArrSliders();
            echo "<option value='none'>".esc_html__('--- Revolution Sliders ---', 'enovathemes-addons')."</option>";
            foreach ( $revolution_sliders as $revolution_slider ) {
               $checked="";
               $alias = $revolution_slider->getAlias();
               $title = $revolution_slider->getTitle();
               echo '<option value="'.$alias.'" '.selected( $settings['project_slider_id'], $alias, false).'>'.$title.'</option>';
            }
        echo '</select>';
    }
}

function shop_slider_id_callback($args) {

	$settings = get_option('archive_slider_settings');

	if(!isset($settings['shop_slider_id'])) {
		$settings['shop_slider_id'] = "none";
	}

	if(shortcode_exists("rev_slider")){
        echo '<select id="archive_slider_settings[shop_slider_id]" name="archive_slider_settings[shop_slider_id]" >';
            $slider = new RevSlider();
            $revolution_sliders = $slider->getArrSliders();
            echo "<option value='none'>".esc_html__('--- Revolution Sliders ---', 'enovathemes-addons')."</option>";
            foreach ( $revolution_sliders as $revolution_slider ) {
               $checked="";
               $alias = $revolution_slider->getAlias();
               $title = $revolution_slider->getTitle();
               echo '<option value="'.$alias.'" '.selected( $settings['shop_slider_id'], $alias, false).'>'.$title.'</option>';
            }
        echo '</select>';
    }
}
?>