<?php
/*
Plugin Name: Multimedia Carousel - Classic & Perspective versions
Description: Premium multimedia carousel
Version: 1.6.2
Author: Lambert Group
Author URI: https://1.envato.market/OZ5Zr
Text Domain: multimedia-carousel
*/

ini_set('display_errors', 0);
//$wpdb->show_errors();
$multimedia_carousel_path = trailingslashit(dirname(__FILE__));  //empty

//all the messages
$multimedia_carousel_messages = array(
		'version' => __( '<div class="error">Multimedia Carousel - Classic & Perspective versions plugin requires WordPress 3.0 or newer. <a href="https://codex.wordpress.org/Upgrading_WordPress">Please update!</a></div>' , 'multimedia-carousel' ),
		'empty_img' => __( 'Image - required' , 'multimedia-carousel' ),
		'empty_name' => __( 'Name - required' , 'multimedia-carousel' ),
		'invalid_request' => __( 'Invalid Request!' , 'multimedia-carousel' ),
		'generate_for_this_carousel' => __( 'You can start customizing this Carousel.' , 'multimedia-carousel' ),
		'data_saved' => __( 'Data Saved!' , 'multimedia-carousel' )
	);


global $wp_version;

if ( !version_compare($wp_version,"3.0",">=")) {
	die (__($multimedia_carousel_messages['version'], 'multimedia-carousel' ));
}




function multimedia_carousel_activate() {
	//db creation, create admin options etc.
	global $wpdb;


	$multimedia_carousel_collate = ' COLLATE utf8_general_ci';

	$sql0 = "CREATE TABLE `" . $wpdb->prefix . "multimedia_carousel_carousels` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
			`name` VARCHAR( 255 ) NOT NULL ,
			PRIMARY KEY ( `id` )
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql1 = "CREATE TABLE `" . $wpdb->prefix . "multimedia_carousel_settings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT 'perspective',
  `skin` varchar(255) NOT NULL DEFAULT 'white',
  `width` smallint(5) unsigned NOT NULL DEFAULT '1100',
  `height` smallint(5) unsigned NOT NULL DEFAULT '454',
  `width100Proc` varchar(8) NOT NULL DEFAULT 'false',
  `height100Proc` varchar(8) NOT NULL DEFAULT 'false',
	`centerPlugin` varchar(8) NOT NULL DEFAULT 'false',
  `autoPlay` smallint(5) unsigned NOT NULL DEFAULT '5',
  `target` varchar(8) NOT NULL DEFAULT '_blank',
  `showAllControllers` varchar(8) NOT NULL DEFAULT 'true',
  `showNavArrows` varchar(8) NOT NULL DEFAULT 'true',
  `showOnInitNavArrows` varchar(8) NOT NULL DEFAULT 'true',
  `autoHideNavArrows` varchar(8) NOT NULL DEFAULT 'true',
  `showBottomNav` varchar(8) NOT NULL DEFAULT 'true',
  `showOnInitBottomNav` varchar(8) NOT NULL DEFAULT 'true',
  `autoHideBottomNav` varchar(8) NOT NULL DEFAULT 'true',
  `showPreviewThumbs` varchar(8) NOT NULL DEFAULT 'true',
  `nextPrevMarginTop` smallint(5) NOT NULL DEFAULT '15',
  `playMovieMarginTop` smallint(5) NOT NULL DEFAULT '0',
  `enableTouchScreen` varchar(8) NOT NULL DEFAULT 'true',
  `responsive` varchar(8) NOT NULL DEFAULT 'true',
  `responsiveRelativeToBrowser` varchar(8) NOT NULL DEFAULT 'false',
  `border` smallint(5) unsigned NOT NULL DEFAULT '0',
  `borderColorOFF` varchar(12) NOT NULL DEFAULT 'transparent',
  `borderColorON` varchar(12) NOT NULL DEFAULT 'FF0000',
  `imageWidth` smallint(5) unsigned NOT NULL DEFAULT '452',
  `imageHeight` smallint(5) unsigned NOT NULL DEFAULT '302',
  `animationTime` float NOT NULL DEFAULT '0.8',
  `easing` varchar(12) NOT NULL DEFAULT 'easeOutQuad',
  `numberOfVisibleItems` smallint(5) unsigned NOT NULL DEFAULT '3',
  `elementsHorizontalSpacing` smallint(5) unsigned NOT NULL DEFAULT '120',
  `elementsVerticalSpacing` smallint(5) unsigned NOT NULL DEFAULT '20',
  `verticalAdjustment` smallint(5) NOT NULL DEFAULT '50',
  `bottomNavMarginBottom` smallint(5) NOT NULL DEFAULT '-10',
  `titleColor` varchar(8) NOT NULL DEFAULT '000000',
  `resizeImages` varchar(8) NOT NULL DEFAULT 'true',
  `showElementTitle` varchar(8) NOT NULL DEFAULT 'true',
  `showCircleTimer` varchar(8) NOT NULL DEFAULT 'true',
  `circleRadius` smallint(5) unsigned NOT NULL DEFAULT '10',
  `circleLineWidth` smallint(5) unsigned NOT NULL DEFAULT '4',
  `circleColor` varchar(8) NOT NULL DEFAULT 'ff0000',
  `circleAlpha` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColor` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlpha` smallint(5) unsigned NOT NULL DEFAULT '50',
  `circleLeftPositionCorrection` smallint(5) NOT NULL DEFAULT '3',
  `circleTopPositionCorrection` smallint(5) NOT NULL DEFAULT '3',
  `numberOfThumbsPerScreen` smallint(5) unsigned NOT NULL DEFAULT '2',
  `itemPadding` smallint(5) NOT NULL DEFAULT '7',
  `itemBackgroundColorOFF` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `itemBackgroundColorON` varchar(8) NOT NULL DEFAULT '000000',
  `titleColorOFF` varchar(8) NOT NULL DEFAULT '444444',
  `descColorOFF` varchar(8) NOT NULL DEFAULT '7e7e7e',
  `titleColorON` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `descColorON` varchar(8) NOT NULL DEFAULT 'ababab',
  `titleFontSize` smallint(5) unsigned NOT NULL DEFAULT '18',
  `descFontSize` smallint(5) unsigned NOT NULL DEFAULT '14',
  `titleMarginTop` smallint(5) unsigned NOT NULL DEFAULT '20',
  `descMarginTop` smallint(5) unsigned NOT NULL DEFAULT '8',
  `bottomNavPosition` varchar(8) NOT NULL DEFAULT 'right',
	`activeItemClass` varchar(255) DEFAULT '',
  `lightbox_width_divider` varchar(30) NOT NULL DEFAULT '2',
  `lightbox_height_divider` varchar(30) NOT NULL DEFAULT '2*9/16',
	`delay` float unsigned NOT NULL DEFAULT '0.5',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql2 = "CREATE TABLE `". $wpdb->prefix . "multimedia_carousel_playlist` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `carouselid` int(10) unsigned NOT NULL,
	  `img` text,
	  `title` text,
	  `desc` text,
	  `data-link` text,
	  `data_bottom_thumb` text,
	  `data_large_image` text,
	  `data-video-vimeo` varchar(255),
	  `data-video-youtube` varchar(255),
	  `data_audio` text,
	  `data_video_selfhosted` text,
	  `data-target` varchar(8),
	  `ord` int(10) unsigned NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";


	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql0.$multimedia_carousel_collate);
	dbDelta($sql1.$multimedia_carousel_collate);
	dbDelta($sql2.$multimedia_carousel_collate);


	//initialize the carousels table with the first carousel skin
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."multimedia_carousel_carousels;" );
	if (!$rows_count) {
		$wpdb->insert(
			$wpdb->prefix . "multimedia_carousel_carousels",
			array(
				'name' => 'First Carousel'
			),
			array(
				'%s'
			)
		);
	}

	// initialize the settings
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."multimedia_carousel_settings;" );
	if (!$rows_count) {
		multimedia_carousel_insert_settings_record(1);
	}


}


function multimedia_carousel_insert_settings_record($carousel_id) {
	global $wpdb;
	$wpdb->insert(
			$wpdb->prefix . "multimedia_carousel_settings",
			array(
				'width' => 1100,
				'skin' => 'white'
			),
			array(
				'%d',
				'%s'
			)
		);
}


function multimedia_carousel_init_sessions() {
	global $wpdb;
	if (is_admin()) {
		if (!session_id()) {
			session_start();

			//initialize the session
			if (!isset($_SESSION['xid'])) {
				$safe_sql="SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_carousels) LIMIT 0, 1";
				$row = $wpdb->get_row($safe_sql,ARRAY_A);
				$_SESSION['xid'] = $row['id'];
				$_SESSION['xname'] = $row['name'];
			}
		}
	}
}

function multimedia_carousel_end_sessions() {
		if (is_admin()) {
			session_destroy();
		}
}


function multimedia_carousel_load_styles() {
	global $wpdb;
	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/multimedia_carousel/i', $page)) {
			wp_enqueue_style('lbg-jquery-ui-custom_css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/pepper-grinder/jquery-ui.min.css');

			wp_enqueue_style('multimedia-carousel-css', plugins_url('css/styles.css', __FILE__));
			wp_enqueue_style('multimedia-carousel-colorpicker-css', plugins_url('css/colorpicker/colorpicker.css', __FILE__));

			wp_enqueue_style('thickbox');

		}
	} else if (!is_admin()) { //loads css in front-end
	    wp_enqueue_style('multimedia-carousel-classic-css', plugins_url('classic/css/multimedia_classic_carousel.css', __FILE__));
	    wp_enqueue_style('multimedia-carousel-perspective-css', plugins_url('perspective/css/multimedia_perspective_carousel.css', __FILE__));

		wp_enqueue_style('lbg-prettyPhoto-css', plugins_url('perspective/css/prettyPhoto.css', __FILE__));
	}
}

function multimedia_carousel_load_scripts() {
	global $is_IE;
	$page = (isset($_GET['page'])) ? $_GET['page'] : '';
	if(preg_match('/multimedia_carousel/i', $page)) {
			wp_enqueue_script('jquery');


			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');

			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-effects-transfer');

			wp_register_script('lbg-colorpicker', plugins_url('js/colorpicker/colorpicker.js', __FILE__));
			wp_enqueue_script('lbg-colorpicker');

			wp_register_script('lbg-admin-toggle', plugins_url('js/myToggle.js', __FILE__));
			wp_enqueue_script('lbg-admin-toggle');


			wp_enqueue_script('media-upload'); // before w.p 3.5
			wp_enqueue_media();// from w.p 3.5
			wp_enqueue_script('thickbox');

	} else if (!is_admin()) { //loads scripts in front-end

		wp_enqueue_script('jquery');

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-progressbar');
		wp_enqueue_script('jquery-effects-drop');

		wp_register_script('lbg-touchSwipe', plugins_url('classic/js/jquery.touchSwipe.min.js', __FILE__));
		wp_enqueue_script('lbg-touchSwipe');

		wp_register_script('lbg-multimedia_carousel_classic', plugins_url('classic\js\multimedia_classic_carousel.js', __FILE__));
		wp_enqueue_script('lbg-multimedia_carousel_classic');

		wp_register_script('lbg-multimedia_carousel_perspective', plugins_url('perspective\js\multimedia_perspective_carousel.js', __FILE__));
		wp_enqueue_script('lbg-multimedia_carousel_perspective');

		wp_register_script('lbg-prettyPhoto', plugins_url('perspective\js\jquery.prettyPhoto.js', __FILE__));
		wp_enqueue_script('lbg-prettyPhoto');

	}

}



// adds the menu pages
function multimedia_carousel_plugin_menu() {
	add_menu_page('MULTIMEDIA-CAROUSEL Admin Interface', 'MULTIMEDIA-CAROUSEL', 'edit_posts', 'multimedia_carousel', 'multimedia_carousel_overview_page',
	plugins_url('images/plg_icon.png', __FILE__));
	add_submenu_page( 'multimedia_carousel', 'MULTIMEDIA-CAROUSEL Overview', 'Overview', 'edit_posts', 'multimedia_carousel', 'multimedia_carousel_overview_page');
	add_submenu_page( 'multimedia_carousel', 'MULTIMEDIA-CAROUSEL Manage Carousels', 'Manage Carousels', 'edit_posts', 'multimedia_carousel_Manage_Carousels', 'multimedia_carousel_manage_carousels_page');
	add_submenu_page( 'multimedia_carousel', 'MULTIMEDIA-CAROUSEL Manage Carousels Add New', 'Add New', 'edit_posts', 'multimedia_carousel_Add_New', 'multimedia_carousel_manage_carousels_add_new_page');
	add_submenu_page( 'multimedia_carousel_Manage_Carousels', 'MULTIMEDIA-CAROUSEL Carousel Settings', 'Carousel Settings', 'edit_posts', 'multimedia_carousel_Settings', 'multimedia_carousel_settings_page');
	add_submenu_page( 'multimedia_carousel_Manage_Carousels', 'MULTIMEDIA-CAROUSEL Carousel Playlist', 'Playlist', 'edit_posts', 'multimedia_carousel_Playlist', 'multimedia_carousel_playlist_page');
	add_submenu_page( 'multimedia_carousel', 'MULTIMEDIA-CAROUSEL Help', 'Help', 'edit_posts', 'multimedia_carousel_Help', 'multimedia_carousel_help_page');
}


//HTML content for overview page
function multimedia_carousel_overview_page()
{
	global $multimedia_carousel_path;
	include_once($multimedia_carousel_path . 'tpl/overview.php');
}

//HTML content for Manage Banners
function multimedia_carousel_manage_carousels_page()
{
	global $wpdb;
	global $multimedia_carousel_messages;
	global $multimedia_carousel_path;

	//delete carousel
	if (isset($_GET['id'])) {




		//delete from wp_multimedia_carousel_carousels
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."multimedia_carousel_carousels WHERE id = %d",$_GET['id']));

		//delete from wp_multimedia_carousel_settings
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."multimedia_carousel_settings WHERE id = %d",$_GET['id']));


		//delete from wp_multimedia_carousel_playlist
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."multimedia_carousel_playlist WHERE carouselid = %d",$_GET['id']));

		//initialize the session
		$safe_sql="SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_carousels) ORDER BY id";
		$row = $wpdb->get_row($safe_sql,ARRAY_A);
		$row=multimedia_carousel_unstrip_array($row);
		if ($row['id']) {
			$_SESSION['xid']=$row['id'];
			$_SESSION['xname']=$row['name'];
		}
	}

	if (array_key_exists('duplicate_id', $_GET) && $_GET['duplicate_id']!='') {
			//carousels
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."multimedia_carousel_carousels ( `name` ) SELECT `name` FROM (".$wpdb->prefix ."multimedia_carousel_carousels) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);
			$carouselid=$wpdb->insert_id;

			//settings
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."multimedia_carousel_settings (`type`, `skin`, `width`, `height`, `width100Proc`, `height100Proc`, `centerPlugin`, `autoPlay`, `target`, `showAllControllers`, `showNavArrows`, `showOnInitNavArrows`, `autoHideNavArrows`, `showBottomNav`, `showOnInitBottomNav`, `autoHideBottomNav`, `showPreviewThumbs`, `nextPrevMarginTop`, `playMovieMarginTop`, `enableTouchScreen`, `responsive`, `responsiveRelativeToBrowser`, `border`, `borderColorOFF`, `borderColorON`, `imageWidth`, `imageHeight`, `animationTime`, `easing`, `numberOfVisibleItems`, `elementsHorizontalSpacing`, `elementsVerticalSpacing`, `verticalAdjustment`, `bottomNavMarginBottom`, `titleColor`, `resizeImages`, `showElementTitle`, `showCircleTimer`, `circleRadius`, `circleLineWidth`, `circleColor`, `circleAlpha`, `behindCircleColor`, `behindCircleAlpha`, `circleLeftPositionCorrection`, `circleTopPositionCorrection`, `numberOfThumbsPerScreen`, `itemPadding`, `itemBackgroundColorOFF`, `itemBackgroundColorON`, `titleColorOFF`, `descColorOFF`, `titleColorON`, `descColorON`, `titleFontSize`, `descFontSize`, `titleMarginTop`, `descMarginTop`, `bottomNavPosition`, `activeItemClass`, `lightbox_width_divider`, `lightbox_height_divider`, `delay` ) SELECT `type`, `skin`, `width`, `height`, `width100Proc`, `height100Proc`, `centerPlugin`, `autoPlay`, `target`, `showAllControllers`, `showNavArrows`, `showOnInitNavArrows`, `autoHideNavArrows`, `showBottomNav`, `showOnInitBottomNav`, `autoHideBottomNav`, `showPreviewThumbs`, `nextPrevMarginTop`, `playMovieMarginTop`, `enableTouchScreen`, `responsive`, `responsiveRelativeToBrowser`, `border`, `borderColorOFF`, `borderColorON`, `imageWidth`, `imageHeight`, `animationTime`, `easing`, `numberOfVisibleItems`, `elementsHorizontalSpacing`, `elementsVerticalSpacing`, `verticalAdjustment`, `bottomNavMarginBottom`, `titleColor`, `resizeImages`, `showElementTitle`, `showCircleTimer`, `circleRadius`, `circleLineWidth`, `circleColor`, `circleAlpha`, `behindCircleColor`, `behindCircleAlpha`, `circleLeftPositionCorrection`, `circleTopPositionCorrection`, `numberOfThumbsPerScreen`, `itemPadding`, `itemBackgroundColorOFF`, `itemBackgroundColorON`, `titleColorOFF`, `descColorOFF`, `titleColorON`, `descColorON`, `titleFontSize`, `descFontSize`, `titleMarginTop`, `descMarginTop`, `bottomNavPosition`, `activeItemClass`, `lightbox_width_divider`, `lightbox_height_divider`, `delay`  FROM (".$wpdb->prefix ."multimedia_carousel_settings) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);

			//playlist
			$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_playlist) WHERE carouselid = %d",$_GET['duplicate_id'] );
			$result = $wpdb->get_results($safe_sql,ARRAY_A);
			foreach ( $result as $row_playlist ) {
				$row_playlist=multimedia_carousel_unstrip_array($row_playlist);

				$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."multimedia_carousel_playlist ( `carouselid` ,`img` ,`title`,`desc` ,`data-link` ,`data_bottom_thumb` ,`data_large_image` ,`data-video-vimeo` ,`data-video-youtube` ,`data_audio` ,`data_video_selfhosted` ,`data-target` ,`ord` ) SELECT ".$carouselid." ,`img` ,`title`,`desc` ,`data-link` ,`data_bottom_thumb` ,`data_large_image` ,`data-video-vimeo` ,`data-video-youtube` ,`data_audio` ,`data_video_selfhosted` ,`data-target` ,`ord` FROM (".$wpdb->prefix ."multimedia_carousel_playlist) WHERE id = %d",$row_playlist['id'] );
				$wpdb->query($safe_sql);
				$photoid=$wpdb->insert_id;
			}

	}

	$safe_sql="SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_carousels) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	include_once($multimedia_carousel_path . 'tpl/carousels.php');

}


//HTML content for Manage Banners - Add New
function multimedia_carousel_manage_carousels_add_new_page()
{
	global $wpdb;
	global $multimedia_carousel_messages;
	global $multimedia_carousel_path;

	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add New') {
		$errors_arr=array();
		if (empty($_POST['name']))
			$errors_arr[]=$multimedia_carousel_messages['empty_name'];

		if (count($errors_arr)) {
				include_once($multimedia_carousel_path . 'tpl/add_carousel.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
		  	<?php } else { // no errors
					$wpdb->insert(
						$wpdb->prefix . "multimedia_carousel_carousels",
						array(
							'name' => sanitize_text_field($_POST['name'])
						),
						array(
							'%s'
						)
					);
					//insert default Carousel Settings for this new Carousel
					multimedia_carousel_insert_settings_record($wpdb->insert_id);
					?>
						<div class="wrap">
							<div id="lbg_logo">
								<h2><?php esc_html_e( 'Manage Carousels - Add New Carousel' , 'multimedia-carousel' );?></h2>
				 			</div>
							<div id="message" class="updated"><p><?php echo stripslashes($multimedia_carousel_messages['data_saved']);?></p><p><?php echo stripslashes($multimedia_carousel_messages['generate_for_this_carousel']);?></p></div>
							<div>
								<p>&raquo; <a href="?page=multimedia_carousel_Add_New"><?php esc_html_e( 'Add New (Carousel)' , 'multimedia-carousel' );?></a></p>
								<p>&raquo; <a href="?page=multimedia_carousel_Manage_Carousels"><?php esc_html_e( 'Back to Manage Carousels' , 'multimedia-carousel' );?></a></p>
							</div>
						</div>
		  	<?php }
	} else {
		include_once($multimedia_carousel_path . 'tpl/add_carousel.php');
	}

}


//HTML content for carouselsettings
function multimedia_carousel_settings_page()
{
	global $wpdb;
	global $multimedia_carousel_messages;
	global $multimedia_carousel_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Update Settings') {
		$_GET['xmlf']='';
		$except_arr=array('Submit','name','pll_ajax_backend');

			$wpdb->update(
				$wpdb->prefix .'multimedia_carousel_carousels',
				array(
				'name' => sanitize_text_field($_POST['name'])
				),
				array( 'id' => $_SESSION['xid'] )
			);
			$_SESSION['xname']=stripslashes($_POST['name']);


			foreach ($_POST as $key=>$val){
				if (in_array($key,$except_arr)) {
					unset($_POST[$key]);
				}
			}

			$wpdb->update(
				$wpdb->prefix .'multimedia_carousel_settings',
				$_POST,
				array( 'id' => $_SESSION['xid'] )
			);
			?>
			<div id="message" class="updated"><p><?php echo stripslashes($multimedia_carousel_messages['data_saved']);?></p></div>
	<?php

	}


	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_settings) WHERE id = %d",$_SESSION['xid'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=multimedia_carousel_unstrip_array($row);
	$_POST = $row;
	$_POST=multimedia_carousel_unstrip_array($_POST);

	echo '<div class="wrap"><form method="POST" enctype="multipart/form-data" name="carouselSettingsForm" id="carouselSettingsForm">';

	include_once($multimedia_carousel_path . 'tpl/settings_form.php');
	include_once($multimedia_carousel_path . 'tpl/settings_form_'.$row['type'].'.php');

	echo '</form></div>';
}

function multimedia_carousel_playlist_page()
{
	global $wpdb;
	global $multimedia_carousel_messages;
	global $multimedia_carousel_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	if (array_key_exists('xmlf', $_GET) && $_GET['xmlf']=='add_playlist_record') {
		if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add Record') {
			$errors_arr=array();
			if (empty($_POST['img']))
				 $errors_arr[]=$multimedia_carousel_messages['empty_img'];


		if (count($errors_arr)) {
			include_once($multimedia_carousel_path . 'tpl/add_playlist_record.php'); ?>
			<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	  	<?php } else { // no upload errors
				$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."multimedia_carousel_playlist WHERE carouselid = %d",$_SESSION['xid'] ) );

				$wpdb->insert(
					$wpdb->prefix . "multimedia_carousel_playlist",
					array(
						'carouselid' => sanitize_text_field($_POST['carouselid']),
						'img' => sanitize_text_field($_POST['img']),
						'data_bottom_thumb' => sanitize_text_field($_POST['data_bottom_thumb']),
						'data_large_image' => sanitize_text_field($_POST['data_large_image']),
						'data-video-youtube' => sanitize_text_field($_POST['data-video-youtube']),
						'data-video-vimeo' => sanitize_text_field($_POST['data-video-vimeo']),
						'data_video_selfhosted' => sanitize_text_field($_POST['data_video_selfhosted']),
						'data_audio' => sanitize_text_field($_POST['data_audio']),
						'title' => sanitize_text_field($_POST['title']),
						'desc' => sanitize_text_field($_POST['desc']),
						'data-link' => sanitize_text_field($_POST['data-link']),
						'data-target' => sanitize_text_field($_POST['data-target']),
						'ord' => $max_ord
					),
					array(
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d'
					)
				);

	  			if (isset($_POST['setitfirst'])) {
					$sql_arr=array();
					$ord_start=$max_ord;
					$ord_stop=1;
					$elem_id=$wpdb->insert_id;
					$ord_direction='+1';

					$sql_arr[]=$wpdb->prepare( "UPDATE ".$wpdb->prefix."multimedia_carousel_playlist SET ord=ord+1  WHERE carouselid = %d and ord>=".$ord_stop." and ord<".$ord_start, $_SESSION['xid']);
					$sql_arr[]=$wpdb->prepare( "UPDATE ".$wpdb->prefix."multimedia_carousel_playlist SET ord=%d WHERE id=%d",$ord_stop,$elem_id);

					foreach ($sql_arr as $sql)
						$wpdb->query($sql);
				}
				?>
					<div class="wrap">
						<div id="lbg_logo">
							<h2><?php esc_html_e( 'Playlist for Carousel:' , 'multimedia-carousel' );?> <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - <?php esc_html_e( 'ID' , 'multimedia-carousel' );?> #<?php echo strip_tags($_SESSION['xid'])?></span> - <?php esc_html_e( 'Add New' , 'multimedia-carousel' );?></h2>
			 			</div>
						<div id="message" class="updated"><p><?php echo stripslashes($multimedia_carousel_messages['data_saved']);?></p></div>
						<div>
							<p>&raquo; <a href="?page=multimedia_carousel_Playlist&xmlf=add_playlist_record"><?php esc_html_e( 'Add New' , 'multimedia-carousel' );?></a></p>
							<p>&raquo; <a href="?page=multimedia_carousel_Playlist"><?php esc_html_e( 'Back to Playlist' , 'multimedia-carousel' );?></a></p>
						</div>
					</div>
	  	<?php }
		} else {
			include_once($multimedia_carousel_path . 'tpl/add_playlist_record.php');
		}

	} else {
		if (array_key_exists('duplicate_id', $_GET) && $_GET['duplicate_id']!='') {
			$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."multimedia_carousel_playlist WHERE carouselid = %d",$_SESSION['xid'] ) );
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."multimedia_carousel_playlist ( `carouselid` ,`img` ,`title`,`desc` ,`data-link` ,`data_bottom_thumb` ,`data_large_image` ,`data-video-vimeo` ,`data-video-youtube` ,`data_audio` ,`data_video_selfhosted` ,`data-target` ,`ord`  ) SELECT `carouselid` ,`img` ,`title`,`desc` ,`data-link` ,`data_bottom_thumb` ,`data_large_image` ,`data-video-vimeo` ,`data-video-youtube` ,`data_audio` ,`data_video_selfhosted` ,`data-target` ,".$max_ord." FROM (".$wpdb->prefix ."multimedia_carousel_playlist) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);
			$lastID=$wpdb->insert_id;
			echo "<script>location.href='?page=multimedia_carousel_Playlist&id=".$_SESSION['xid']."&name=".$_SESSION['xname']."'</script>";

		}

		$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_playlist) WHERE carouselid = %d ORDER BY ord",$_SESSION['xid'] );
		$result = $wpdb->get_results($safe_sql,ARRAY_A);

		include_once($multimedia_carousel_path . 'tpl/playlist.php');
	}
}





function multimedia_carousel_help_page()
{
	global $multimedia_carousel_path;
	include_once($multimedia_carousel_path . 'tpl/help.php');
}

function multimedia_carousel_generate_preview_code($carouselID) {
	global $wpdb;

	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_settings) WHERE id = %d",$carouselID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=multimedia_carousel_unstrip_array($row);

	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."multimedia_carousel_playlist) WHERE carouselid = %d ORDER BY ord",$carouselID );
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	$playlist_str='';
	foreach ( $result as $row_playlist ) {

		$row_playlist=multimedia_carousel_unstrip_array($row_playlist);

		$img_over='';
		if ($row_playlist['img']!='') {
			if (strpos($row_playlist['img'], 'wp-content',9)===false)
				list($width, $height, $type, $attr) = getimagesize($row_playlist['img']);
			else
				list($width, $height, $type, $attr) = getimagesize( ABSPATH.substr($row_playlist['img'],strpos($row_playlist['img'], 'wp-content',9)) );
			$img_over='<img src="'.$row_playlist['img'].'" width="'.$width.'" height="'.$height.'" alt="'.$row_playlist['title'].'"  title="'.$row_playlist['title'].'" />';
		}

		$data_audio='';
		$data_video='';
		if ($row_playlist['data_audio']!='') {
			$data_audio=substr($row_playlist['data_audio'],0,strlen($row_playlist['data_audio'])-4);
		}
		if ($row_playlist['data_video_selfhosted']!='') {
			if (strpos($row_playlist['data_video_selfhosted'],'.webm')!=false)
				$data_video=substr($row_playlist['data_video_selfhosted'],0,strlen($row_playlist['data_video_selfhosted'])-5);
			else
				$data_video=substr($row_playlist['data_video_selfhosted'],0,strlen($row_playlist['data_video_selfhosted'])-4);
		}

switch ($row["type"]) {
		case 'classic':
			$playlist_str.='<li data-link="'.$row_playlist['data-link'].'" data-target="'.$row_playlist['data-target'].'" data-large-image="'.$row_playlist['data_large_image'].'" data-video-vimeo="'.$row_playlist['data-video-vimeo'].'" data-video-youtube="'.$row_playlist['data-video-youtube'].'" data-audio="'.$data_audio.'" data-video-selfhosted="'.$data_video.'" >'.$img_over.'<div class="titlez">'.$row_playlist['title'].'</div><div class="descz">'.$row_playlist['desc'].'</div></li>';
			break;
		case 'perspective':
			$playlist_str.='<li data-bottom-thumb="'.$row_playlist['data_bottom_thumb'].'" data-title="'.$row_playlist['title'].'" data-link="'.$row_playlist['data-link'].'" data-target="'.$row_playlist['data-target'].'" data-large-image="'.$row_playlist['data_large_image'].'" data-video-vimeo="'.$row_playlist['data-video-vimeo'].'" data-video-youtube="'.$row_playlist['data-video-youtube'].'" data-audio="'.$data_audio.'" data-video-selfhosted="'.$data_video.'" >'.$img_over.'</li>';
			break;
	}



	}


	$carousel_function='';
	$myxloader='';
	$list_name='';
	$the_parameters='';

switch ($row["type"]) {
		case 'classic':
			$carousel_function='multimedia_classic_carousel';
			$myxloader='<div class="myloader"></div>';
			$list_name='multimedia_classic_carousel_list';
			$the_parameters='skin:"'.$row["skin"].'",
				responsive:'.$row["responsive"].',
				responsiveRelativeToBrowser:'.$row["responsiveRelativeToBrowser"].',
				width:'.$row["width"].',
				height:'.$row["height"].',
				width100Proc:'.$row["width100Proc"].',
				height100Proc:false,
				centerPlugin:'.$row["centerPlugin"].',
				autoPlay:'.$row["autoPlay"].',
				numberOfThumbsPerScreen:'.$row["numberOfThumbsPerScreen"].',
				itemPadding:'.$row["itemPadding"].',
				showElementTitle:'.$row["showElementTitle"].',
				itemBackgroundColorOFF:"'.(($row["itemBackgroundColorOFF"]!='transparent')?'#':'').$row["itemBackgroundColorOFF"].'",
				itemBackgroundColorON:"'.(($row["itemBackgroundColorON"]!='transparent')?'#':'').$row["itemBackgroundColorON"].'",
				titleColorOFF:"#'.$row["titleColorOFF"].'",
				descColorOFF:"#'.$row["descColorOFF"].'",
				titleColorON:"#'.$row["titleColorON"].'",
				descColorON:"#'.$row["descColorON"].'",
				titleFontSize:'.$row["titleFontSize"].',
				descFontSize:'.$row["descFontSize"].',
				titleMarginTop:'.$row["titleMarginTop"].',
				descMarginTop:'.$row["descMarginTop"].',
				imageWidth:'.$row["imageWidth"].',
				imageHeight:'.$row["imageHeight"].',
				enableTouchScreen:'.$row["enableTouchScreen"].',
				target:"'.$row["target"].'",
				absUrl:"'.plugins_url("", __FILE__).'/perspective/",
				showNavArrows:'.$row["showNavArrows"].',
				showOnInitNavArrows:'.$row["showOnInitNavArrows"].',
				autoHideNavArrows:'.$row["autoHideNavArrows"].',
				showBottomNav:'.$row["showBottomNav"].',
				showOnInitBottomNav:'.$row["showOnInitBottomNav"].',
				autoHideBottomNav:'.$row["autoHideBottomNav"].',
				bottomNavMarginBottom:'.$row["bottomNavMarginBottom"].',
				bottomNavPosition:"'.$row["bottomNavPosition"].'"';
			break;
		case 'perspective':
			$carousel_function='multimedia_perspective_carousel';
			$myxloader='<div class="myloader"></div>';
			$list_name='multimedia_perspective_carousel_list';
			$the_parameters='skin:"'.$row["skin"].'",
				responsive:'.$row["responsive"].',
				responsiveRelativeToBrowser:'.$row["responsiveRelativeToBrowser"].',
				width:'.$row["width"].',
				height:'.$row["height"].',
				width100Proc:'.$row["width100Proc"].',
				height100Proc:false,
				centerPlugin:'.$row["centerPlugin"].',
				autoPlay:'.$row["autoPlay"].',
				numberOfVisibleItems:'.$row["numberOfVisibleItems"].',
				verticalAdjustment:'.$row["verticalAdjustment"].',
				elementsHorizontalSpacing:'.$row["elementsHorizontalSpacing"].',
				elementsVerticalSpacing:'.$row["elementsVerticalSpacing"].',
				animationTime:'.$row["animationTime"].',
				easing:"'.$row["easing"].'",
				resizeImages:'.$row["resizeImages"].',
				showElementTitle:'.$row["showElementTitle"].',
				titleColor:"#'.$row["titleColor"].'",
				imageWidth:'.$row["imageWidth"].',
				imageHeight:'.$row["imageHeight"].',
				border:'.$row["border"].',
				borderColorOFF:"'.(($row["borderColorOFF"]!='transparent')?'#':'').$row["borderColorOFF"].'",
				borderColorON:"'.(($row["borderColorON"]!='transparent')?'#':'').$row["borderColorON"].'",
				enableTouchScreen:'.$row["enableTouchScreen"].',
				target:"'.$row["target"].'",
				absUrl:"'.plugins_url("", __FILE__).'/perspective/",
				showAllControllers:'.$row["showAllControllers"].',
				showNavArrows:'.$row["showNavArrows"].',
				showOnInitNavArrows:'.$row["showOnInitNavArrows"].',
				autoHideNavArrows:'.$row["autoHideNavArrows"].',
				showBottomNav:'.$row["showBottomNav"].',
				showOnInitBottomNav:'.$row["showOnInitBottomNav"].',
				autoHideBottomNav:'.$row["autoHideBottomNav"].',
				showPreviewThumbs:'.$row["showPreviewThumbs"].',
				nextPrevMarginTop:'.$row["nextPrevMarginTop"].',
				playMovieMarginTop:'.$row["playMovieMarginTop"].',
				bottomNavMarginBottom:'.$row["bottomNavMarginBottom"].',
				circleLeftPositionCorrection:'.$row["circleLeftPositionCorrection"].',
				circleTopPositionCorrection:'.$row["circleTopPositionCorrection"].',
				showCircleTimer:'.$row["showCircleTimer"].',
				circleRadius:'.$row["circleRadius"].',
				circleLineWidth:'.$row["circleLineWidth"].',
				circleColor:"#'.$row["circleColor"].'",
				circleAlpha:'.$row["circleAlpha"].',
				behindCircleColor:"#'.$row["behindCircleColor"].'",
				behindCircleAlpha:'.$row["behindCircleAlpha"].',
				activeItemClass:"'.$row["activeItemClass"].'"';
			break;
	}



	$content='<script>
		jQuery(function() {
			setTimeout(function(){
			jQuery("#'.$carousel_function.'_'.$row["id"].'").'.$carousel_function.'({'.
				$the_parameters.
			'});
			}, '.($row["delay"]*1000).');
		});
	</script>
            <div id="'.$carousel_function.'_'.$row["id"].'">'.$myxloader.'<ul class="'.$list_name.'">'.$playlist_str.'</ul></div>';

	return str_replace("\r\n", '', $content);
}


function multimedia_carousel_shortcode($atts, $content=null) {
	global $wpdb;

	shortcode_atts( array('settings_id'=>''), $atts);
	if ($atts['settings_id']=='')
		$atts['settings_id']=1;

	return multimedia_carousel_generate_preview_code($atts['settings_id']);

}



register_activation_hook(__FILE__,"multimedia_carousel_activate"); //activate plugin and create the database
add_action('init', 'multimedia_carousel_init_sessions');	// initialize sessions
add_action('init', 'multimedia_carousel_load_styles');	// loads required styles
add_action('init', 'multimedia_carousel_load_scripts');			// loads required scripts
add_action('admin_menu', 'multimedia_carousel_plugin_menu'); // create menus
add_shortcode('multimedia_carousel', 'multimedia_carousel_shortcode');				// MULTIMEDIA-CAROUSEL shortcode

add_action('wp_logout','multimedia_carousel_end_sessions');
add_action('wp_login','multimedia_carousel_end_sessions');

/** OTHER FUNCTIONS **/

//stripslashes for an entire array
function multimedia_carousel_unstrip_array($array){
	if (is_array($array)) {
		foreach($array as &$val){
			if(is_array($val)){
				$val = unstrip_array($val);
			} else {
				$val = stripslashes($val);

			}
		}
	}
	return $array;
}


/* ajax update playlist record */

add_action('admin_head', 'multimedia_carousel_update_playlist_record_javascript');

function multimedia_carousel_update_playlist_record_javascript() {
	global $wpdb;
	//Set Your Nonce
	$multimedia_carousel_update_playlist_record_ajax_nonce = wp_create_nonce("multimedia_carousel_update_playlist_record-special-string");
	$multimedia_carousel_preview_record_ajax_nonce = wp_create_nonce("multimedia_carousel_preview_record-special-string");


	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/multimedia_carousel/i', $page)) {
?>




<script type="text/javascript" >

//delete the entire record
function multimedia_carousel_delete_entire_record (delete_id) {
	if (confirm('Are you sure?')) {
		jQuery("#multimedia_carousel_sortable").sortable('disable');
		jQuery("#"+delete_id).css("display","none");
		jQuery("#multimedia_carousel_updating_witness").css("display","block");
		var data = "action=multimedia_carousel_update_playlist_record&security=<?php echo esc_js($multimedia_carousel_update_playlist_record_ajax_nonce); ?>&updateType=multimedia_carousel_delete_entire_record&delete_id="+delete_id;
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#multimedia_carousel_sortable").sortable('enable');
			jQuery("#multimedia_carousel_updating_witness").css("display","none");
		});
	}
}



function multimedia_carousel_process_val(val,cssprop) {
	retVal=parseInt(val.substring(0, val.length-2));
	if (cssprop=="top")
		retVal=retVal-148;
	return retVal;
}


function showDialogPreview(theCarouselID) {  //load content and open dialog
	var data ="action=multimedia_carousel_preview_record&security=<?php echo esc_js($multimedia_carousel_preview_record_ajax_nonce); ?>&theCarouselID="+theCarouselID;

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		jQuery('#previewDialogIframe').attr('src','<?php echo plugins_url("tpl/preview.html", __FILE__)?>');
		jQuery("#previewDialog").dialog("open");
	});
}



jQuery(document).ready(function($) {
	/*PREVIEW DIALOG BOX*/
	jQuery( "#previewDialog" ).dialog({
	  minWidth:1200,
	  minHeight:500,
	  title:"Carousel Preview",
	  modal: true,
	  autoOpen:false,
	  hide: "fade",
	  resizable: false,
	  open: function() {
	  },
	  close: function() {
		jQuery('#previewDialogIframe').attr('src','');
	  }
	});

	/* THE PLAYLIST */
	if (jQuery('#multimedia_carousel_sortable').length) {
		jQuery( '#multimedia_carousel_sortable' ).sortable({
			placeholder: "ui-state-highlight",
			start: function(event, ui) {
	            ord_start = ui.item.prevAll().length + 1;
	        },
			update: function(event, ui) {
	        	jQuery("#multimedia_carousel_sortable").sortable('disable');
	        	jQuery("#multimedia_carousel_updating_witness").css("display","block");
				var ord_stop=ui.item.prevAll().length + 1;
				var elem_id=ui.item.attr("id");
				var data = "action=multimedia_carousel_update_playlist_record&security=<?php echo esc_js($multimedia_carousel_update_playlist_record_ajax_nonce); ?>&updateType=change_ord&ord_start="+ord_start+"&ord_stop="+ord_stop+"&elem_id="+elem_id;
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery("#multimedia_carousel_sortable").sortable('enable');
					jQuery("#multimedia_carousel_updating_witness").css("display","none");
				});
			}
		});
	}



	<?php
		$rows_count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM ". $wpdb->prefix . "multimedia_carousel_playlist WHERE carouselid = %d ORDER BY ord",$_SESSION['xid'] ) );
		for ($i=1;$i<=$rows_count;$i++) {
	?>

	jQuery('#upload_img_button_multimedia_carousel_<?php echo esc_js($i);?>').click(function(event) {
			var file_frame;
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery( this ).data( 'uploader_title' ),
				button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				document.forms["form-playlist-multimedia_carousel-"+<?php echo esc_js($i);?>].img.value=attachment.url;
				jQuery('#img_'+<?php echo esc_js($i);?>).attr('src',attachment.url);
			});
			// Finally, open the modal
			file_frame.open();
	});


	jQuery('#upload_thumb_button_multimedia_carousel_<?php echo esc_js($i);?>').click(function(event) {
			var file_frame;
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery( this ).data( 'uploader_title' ),
				button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				document.forms["form-playlist-multimedia_carousel-"+<?php echo esc_js($i);?>].data_bottom_thumb.value=attachment.url;
				jQuery('#data_bottom_thumb_'+<?php echo esc_js($i);?>).attr('src',attachment.url);
			});
			// Finally, open the modal
			file_frame.open();
	});


	jQuery('#upload_largeimg_button_multimedia_carousel_<?php echo esc_js($i);?>').click(function(event) {
			var file_frame;
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery( this ).data( 'uploader_title' ),
				button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				document.forms["form-playlist-multimedia_carousel-"+<?php echo esc_js($i);?>].data_large_image.value=attachment.url;
				jQuery('#data_large_image_'+<?php echo esc_js($i);?>).attr('src',attachment.url);
			});
			// Finally, open the modal
			file_frame.open();
	});


	jQuery('#upload_video_button_multimedia_carousel_<?php echo esc_js($i);?>').click(function(event) {
			var file_frame;
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery( this ).data( 'uploader_title' ),
				button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				document.forms["form-playlist-multimedia_carousel-"+<?php echo esc_js($i);?>].data_video_selfhosted.value=attachment.url;
			});
			// Finally, open the modal
			file_frame.open();
	});



	jQuery('#upload_audio_button_multimedia_carousel_<?php echo esc_js($i);?>').click(function(event) {
			var file_frame;
			event.preventDefault();
			// If the media frame already exists, reopen it.
			if ( file_frame ) {
				file_frame.open();
				return;
			}
			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: jQuery( this ).data( 'uploader_title' ),
				button: {
				text: jQuery( this ).data( 'uploader_button_text' ),
				},
				multiple: false // Set to true to allow multiple files to be selected
			});
			// When an image is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				// Do something with attachment.id and/or attachment.url here
				document.forms["form-playlist-multimedia_carousel-"+<?php echo esc_js($i);?>].data_audio.value=attachment.url;
			});
			// Finally, open the modal
			file_frame.open();
	});




	//submit
	jQuery("#form-playlist-multimedia_carousel-<?php echo esc_js($i);?>").submit(function(event) {

		/* stop form from submitting normally */
		event.preventDefault();

		//show loading image
		jQuery('#ajax-message-<?php echo esc_js($i);?>').html('<img src="<?php echo plugins_url('multimedia_carousel/images/ajax-loader.gif', dirname(__FILE__))?>" />');
		var data ="action=multimedia_carousel_update_playlist_record&security=<?php echo esc_js($multimedia_carousel_update_playlist_record_ajax_nonce); ?>&"+jQuery("#form-playlist-multimedia_carousel-<?php echo esc_js($i);?>").serialize();

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			var new_img = '';
			if (document.forms["form-playlist-multimedia_carousel-<?php echo esc_js($i);?>"].img.value!='')
				new_img=document.forms["form-playlist-multimedia_carousel-<?php echo esc_js($i);?>"].img.value;
			jQuery('#top_image_'+document.forms["form-playlist-multimedia_carousel-<?php echo esc_js($i);?>"].id.value).attr('src',new_img);
			jQuery('#ajax-message-<?php echo esc_js($i);?>').html(response);
		});
	});
	<?php } ?>

});
</script>
<?php
		}
	}
}

//multimedia_carousel_update_playlist_record is the action=multimedia_carousel_update_playlist_record

add_action('wp_ajax_multimedia_carousel_update_playlist_record', 'multimedia_carousel_update_playlist_record_callback');

function multimedia_carousel_update_playlist_record_callback() {

	check_ajax_referer( 'multimedia_carousel_update_playlist_record-special-string', 'security' ); //security=<?php echo $multimedia_carousel_update_playlist_record_ajax_nonce;
	global $wpdb;
	global $multimedia_carousel_messages;
	$errors_arr=array();
	//delete entire record
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='multimedia_carousel_delete_entire_record') {
		$delete_id=$_POST['delete_id'];
		$safe_sql=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."multimedia_carousel_playlist WHERE id = %d",$delete_id);
		$row = $wpdb->get_row($safe_sql, ARRAY_A);
		$row=multimedia_carousel_unstrip_array($row);

		//delete the entire record
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."multimedia_carousel_playlist WHERE id = %d",$delete_id));
		//update the order for the rest ord=ord-1 for > ord
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."multimedia_carousel_playlist SET ord=ord-1 WHERE carouselid = %d and  ord>".$row['ord'],$_SESSION['xid']));
	}

	//update elements order
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='change_ord') {
		$sql_arr=array();
		$ord_start=$_POST['ord_start'];
		$ord_stop=$_POST['ord_stop'];
		$elem_id=(int)$_POST['elem_id'];
		$ord_direction='+1';
		if ($ord_start<$ord_stop)
			$sql_arr[]=$wpdb->prepare( "UPDATE ".$wpdb->prefix."multimedia_carousel_playlist SET ord=ord-1  WHERE carouselid = %d and ord>".$ord_start." and ord<=".$ord_stop, $_SESSION['xid']);
		else
			$sql_arr[]=$wpdb->prepare( "UPDATE ".$wpdb->prefix."multimedia_carousel_playlist SET ord=ord+1  WHERE carouselid = %d and ord>=".$ord_stop." and ord<".$ord_start, $_SESSION['xid']);
		$sql_arr[]=$wpdb->prepare( "UPDATE ".$wpdb->prefix."multimedia_carousel_playlist SET ord=%d WHERE id=%d",$ord_stop,$elem_id);

		foreach ($sql_arr as $sql)
			$wpdb->query($sql);
	}


	//submit update
	$theid=isset($_POST['id'])?$_POST['id']:0;
	if($theid>0 && !count($errors_arr)) {
		//update playlist
		$wpdb->update(
			$wpdb->prefix .'multimedia_carousel_playlist',
				array(
				'img' => sanitize_text_field($_POST['img']),
				'title' => sanitize_text_field($_POST['title']),
				'desc' => sanitize_text_field($_POST['desc']),
				'data-link' => sanitize_text_field($_POST['data-link']),
				'data-target' => sanitize_text_field($_POST['data-target']),
				'data_bottom_thumb' => sanitize_text_field($_POST['data_bottom_thumb']),
				'data_large_image' => sanitize_text_field($_POST['data_large_image']),
				'data-video-youtube' => sanitize_text_field($_POST['data-video-youtube']),
				'data-video-vimeo' => sanitize_text_field($_POST['data-video-vimeo']),
				'data_video_selfhosted' => sanitize_text_field($_POST['data_video_selfhosted']),
				'data_audio' => sanitize_text_field($_POST['data_audio'])
				),
			array( 'id' => $theid )
		);



		?>
			<div id="message" class="updated"><p><?php echo stripslashes($multimedia_carousel_messages['data_saved']);?></p></div>
	<?php
	} else if (!isset($_POST['updateType'])) {
		$errors_arr[]=$multimedia_carousel_messages['invalid_request'];
	}

	if (count($errors_arr)) { ?>
		<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	<?php }

	die(); // this is required to return a proper result
}






add_action('wp_ajax_multimedia_carousel_preview_record', 'multimedia_carousel_preview_record_callback');

function multimedia_carousel_preview_record_callback() {
	check_ajax_referer( 'multimedia_carousel_preview_record-special-string', 'security' );
	global $wpdb;
	$safe_sql=$wpdb->prepare( "SELECT type FROM (".$wpdb->prefix ."multimedia_carousel_settings) WHERE id = %d",$_POST['theCarouselID'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=multimedia_carousel_unstrip_array($row);

	$aux_val='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
					<head>';
					switch ($row["type"]) {
						case 'classic':
							$aux_val.='<link href="'.plugins_url('classic/css/multimedia_classic_carousel.css', __FILE__).'" rel="stylesheet" type="text/css">';
							break;
						case 'perspective':
							$aux_val.='<link href="'.plugins_url('perspective/css/multimedia_perspective_carousel.css', __FILE__).'" rel="stylesheet" type="text/css">';
							break;
					}
					$aux_val.='
					<link href="'.plugins_url('perspective/css/prettyPhoto.css', __FILE__).'" rel="stylesheet" type="text/css">

					<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400italic" rel="stylesheet" type="text/css">
					<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet" type="text/css">

					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
					<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
					<script src="'.plugins_url('perspective/js/jquery.touchSwipe.min.js', __FILE__).'" type="text/javascript"></script>';
						switch ($row["type"]) {
							case 'classic':
								$aux_val.='<script src="'.plugins_url('classic/js/multimedia_classic_carousel.js', __FILE__).'" type="text/javascript"></script>';
								break;
							case 'perspective':
								$aux_val.='<script src="'.plugins_url('perspective/js/multimedia_perspective_carousel.js', __FILE__).'" type="text/javascript"></script>';
								break;
						}
					$aux_val.='<script src="'.plugins_url('perspective/js/jquery.prettyPhoto.js', __FILE__).'" type="text/javascript"></script>
					</head>
					<body style="padding:0px;margin:0px 0px 0px 0px;background:#CCCCCC;">';

	$aux_val.=multimedia_carousel_generate_preview_code($_POST['theCarouselID']);
	$aux_val.="</body>
				</html>";
	$filename=plugin_dir_path(__FILE__) . 'tpl/preview.html';
	$fp = fopen($filename, 'w+');
	$fwrite = fwrite($fp, $aux_val);

	echo $fwrite;

	die(); // this is required to return a proper result
}



?>
