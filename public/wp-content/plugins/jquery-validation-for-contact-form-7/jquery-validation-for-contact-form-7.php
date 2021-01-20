<?php
/* 
Plugin Name: Jquery Validation For Contact Form 7
Plugin URI: http://dnesscarkey.com/jquery-validation/
Description: This plugin integrates jquery validation in contact form 7
Author: Dinesh Karki
Version: 4.5.2
Author URI: http://www.dineshkarki.com.np
*/

/*  Copyright 2012  Dinesh Karki  (email : dnesskarki@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_notices', 'wpa_notifications');
if (isset($_GET['wpa_hide_notifications']) == 1){
    update_option('wpa_hide_notifications','yes_13');
}
if (!function_exists('wpa_notifications')){
    function wpa_notifications(){
        if (get_option('wpa_hide_notifications') != 'yes_13'){
            if (!is_plugin_active('honeypot/wp-armour.php')){
                $wpa_supported_plugins   =  array(
                        'gravityforms.php' => 'Gravity Forms',
                        'bbpress.php'       => 'BBPress Forum',
                        'wp-contact-form-7.php'=> 'Contact Form 7',
                        'ninja-forms.php' => 'Ninja Forms',
                        'wpforms.php' => 'WP Forms',
                        'formidable.php' => 'Formidable Forms'
                );

                $active_plugins = get_option('active_plugins');
                foreach ($active_plugins as $key => $plugin) {
                    $pluginNameExplode = explode('/', $plugin);
                    $pluginnames[$pluginNameExplode[1]]       = $pluginNameExplode[1];
                }
                
                $supportedActivePlugins = array_intersect_key($wpa_supported_plugins, $pluginnames);

                if (!empty($supportedActivePlugins )){

                    if (get_option('users_can_register') == 1 ){
                        $supportedActivePlugins['wpregister'] = 'Registration';
                    }

                    if (get_option('default_comment_status') == 'open' ){
                        $supportedActivePlugins['wpcomments'] = 'Comments';
                    }
                    
                    $plugin_href = admin_url('plugin-install.php?tab=plugin-information&plugin=honeypot&TB_iframe=true&width=800&height=500');
                    $plugin_install_url = admin_url('plugin-install.php?s=WP+Armour&tab=search');

                     echo '<div class="notice updated" style="">
                            <br/>
                            <p>Are you getting Spam in <strong>'.join(", ",$supportedActivePlugins).'</strong> ? With <a class="thickbox" href="'.$plugin_href.'">WP Armour</a> plugin you can block spam without using Captcha or Akismet.</p>
                            <p style="font-weight:bold;">
                                <a href="'.$plugin_install_url.'">Install WP Armour</a> | 
                                <a class="thickbox" href="'.$plugin_href.'">View Details</a> | 
                                <a href="?wpa_hide_notifications=1">Hide Message</a></p><br/>
                     </div>';
                }
            }
        }
    }
}

$defaultOptionValues['jvcf7_show_label_error'] 			= "errorMsgshow";
$defaultOptionValues['jvcf7_invalid_field_design'] 		= "theme_1";

$optionValues = array();
foreach ($defaultOptionValues as $key=>$value){
	$optionValues[$key] = get_option($key);
	if (empty($optionValues[$key])){
		update_option($key, $value);
		$optionValues[$key] = $value;
	}
}

function jvcf7_validation_js(){
  	global $optionValues;
  	echo '<script>
  	jvcf7_invalid_field_design = "'.$optionValues["jvcf7_invalid_field_design"].'";
	jvcf7_show_label_error = "'.$optionValues["jvcf7_show_label_error"].'";
  	</script>';
  
	wp_enqueue_script('jvcf7_jquery_validate', plugins_url('jquery-validation-for-contact-form-7/js/jquery.validate.min.js'), array('jquery'), '4.5', true);
	wp_enqueue_script('jvcf7_validation_custom', plugins_url('jquery-validation-for-contact-form-7/js/jquery.jvcf7_validation.js'), '', '4.5', true);
	
	wp_register_style('jvcf7_style', plugins_url('jquery-validation-for-contact-form-7/css/jvcf7_validate.css'), '','4.5');
	wp_enqueue_style('jvcf7_style');	
}

function jvcf7_adminCsslibs(){
	wp_register_style('jvcf7_style', plugins_url('jquery-validation-for-contact-form-7/css/jvcf7_validate.css'));
    wp_enqueue_style('jvcf7_style');	
}

add_action('wp_enqueue_scripts', 'jvcf7_validation_js');
add_action("admin_print_styles", 'jvcf7_adminCsslibs');

include('plugin_interface.php');
?>