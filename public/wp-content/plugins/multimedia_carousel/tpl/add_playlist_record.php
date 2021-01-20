<script>
jQuery(document).ready(function() {


 	jQuery('#upload_img_button_multimedia_carousel').click(function(event) {
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
			jQuery('#img').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_thumb_button_multimedia_carousel').click(function(event) {
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
			jQuery('#data_bottom_thumb').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});



	jQuery('#upload_largeimg_button_multimedia_carousel').click(function(event) {
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
			jQuery('#data_large_image').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});



	jQuery('#upload_video_button_multimedia_carousel').click(function(event) {
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
			jQuery('#data_video_selfhosted').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_audio_button_multimedia_carousel').click(function(event) {
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
			jQuery('#data_audio').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});



});
</script>

<div class="wrap">
	<div id="lbg_logo">
			<h2><?php esc_html_e( 'Playlist for showcase:' , 'multimedia-carousel' );?> <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - <?php esc_html_e( 'ID' , 'multimedia-carousel' );?> #<?php echo strip_tags($_SESSION['xid'])?></span> - <?php esc_html_e( 'Add New' , 'multimedia-carousel' );?></h2>
 	</div>

    <form method="POST" enctype="multipart/form-data" id="form-add-playlist-record">
	    <input name="carouselid" id="carouselid" type="hidden" value="<?php echo strip_tags($_SESSION['xid'])?>" />
		<table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="left" valign="middle" width="25%">&nbsp;</td>
		    <td align="left" valign="middle" width="77%"><a href="?page=multimedia_carousel_Playlist" style="padding-left:25%;"><?php esc_html_e( 'Back to Playlist' , 'multimedia-carousel' );?></a></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="middle" class="row-title"><?php esc_html_e( 'Set It First' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="setitfirst" type="checkbox" id="setitfirst" value="1" checked="checked" />
		      <label for="setitfirst"></label></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image' , 'multimedia-carousel' );?> </td>
		    <td width="77%" align="left" valign="top"><input name="img" type="text" id="img" size="60" value="<?php echo (array_key_exists('img', $_POST))?stripslashes($_POST['img']):''?>" /> <input name="upload_img_button_multimedia_carousel" type="button" id="upload_img_button_multimedia_carousel" value="Upload Image" />
	        <br />
	        <?php esc_html_e( 'Enter an URL or upload an image' , 'multimedia-carousel' );?></td>
		  </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image Title' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="title" type="text" size="60" id="title" value="<?php echo (array_key_exists('title', $_POST))?stripslashes($_POST['title']):''?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image description' , 'multimedia-carousel' );?><br />
	        <i style="font-weight:normal;">- Only for "Classic" carousel version -</i></td>
		    <td align="left" valign="top">
	        <textarea name="desc" id="desc" cols="45" rows="5"><?php echo (array_key_exists('desc', $_POST))?stripslashes($_POST['desc']):''?></textarea></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Link For The Image' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="data-link" type="text" size="60" id="data-link" value="<?php echo (array_key_exists('data-link', $_POST))?stripslashes($_POST['data-link']):''?>"/></td>
	      </tr>
        <tr>
  		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Link Target' , 'multimedia-carousel' );?></td>
  		    <td align="left" valign="top"><select name="data-target" id="data-target">
                <option value="" <?php echo ((array_key_exists('data-target', $_POST) && $_POST['data-target']=='')?'selected="selected"':'')?>>select...</option>
  		      <option value="_blank" <?php echo ((array_key_exists('data-target', $_POST) && $_POST['data-target']=='_blank')?'selected="selected"':'')?>>_blank</option>
  		      <option value="_self" <?php echo ((array_key_exists('data-target', $_POST) && $_POST['data-target']=='_self')?'selected="selected"':'')?>>_self</option>

  	        </select></td>
  	      </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Preview Thumb' , 'multimedia-carousel' );?><br />
<i style="font-weight:normal;"><?php esc_html_e( '- Only for "Perspective" carousel version -' , 'multimedia-carousel' );?></i></td>
            <td align="left" valign="top"><input name="data_bottom_thumb" type="text" id="data_bottom_thumb" size="100" value="<?php echo (array_key_exists('data_bottom_thumb', $_POST))?stripslashes($_POST['data_bottom_thumb']):''?>" /><input name="upload_thumb_button_multimedia_carousel" type="button" id="upload_thumb_button_multimedia_carousel" value="Upload Image" /></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="top"><?php esc_html_e( 'Recommended size: 79px x 79px' , 'multimedia-carousel' );?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top"><span class="regGray"><?php esc_html_e( 'Options for LightBox' , 'multimedia-carousel' );?></span></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Large Image' , 'multimedia-carousel' );?></td>
            <td align="left" valign="top"><input name="data_large_image" type="text" id="data_large_image" size="100" value="<?php echo (array_key_exists('data_large_image', $_POST))?stripslashes($_POST['data_large_image']):''?>" /><input name="upload_largeimg_button_multimedia_carousel" type="button" id="upload_largeimg_button_multimedia_carousel" value="Upload Image" /><br />
<?php esc_html_e( 'Enter an URL or upload an image' , 'multimedia-carousel' );?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'YouTube Video ID' , 'multimedia-carousel' );?></td>
            <td align="left" valign="top"><input name="data-video-youtube" type="text" size="60" id="data-video-youtube" value="<?php echo (array_key_exists('data-video-youtube', $_POST))?stripslashes($_POST['data-video-youtube']):''?>"/></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Vimeo Video ID' , 'multimedia-carousel' );?></td>
            <td align="left" valign="top"><input name="data-video-vimeo" type="text" size="60" id="data-video-vimeo" value="<?php echo (array_key_exists('data-video-vimeo', $_POST))?stripslashes($_POST['data-video-vimeo']):''?>"/></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Self Hosted/Third Party Hosted Video' , 'multimedia-carousel' );?></td>
            <td align="left" valign="middle"><input name="data_video_selfhosted" type="text" id="data_video_selfhosted" size="100" value="<?php echo (array_key_exists('data_video_selfhosted', $_POST))?stripslashes($_POST['data_video_selfhosted']):''?>" />
              <input name="upload_video_button_multimedia_carousel" type="button" id="upload_video_button_multimedia_carousel" value="Upload Video" />
              <br />
              <?php esc_html_e( 'Enter an URL or upload a .mp4 file' , 'multimedia-carousel' );?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Audio File' , 'multimedia-carousel' );?></td>
            <td align="left" valign="middle"><input name="data_audio" type="text" id="data_audio" size="100" value="<?php echo (array_key_exists('data_audio', $_POST))?stripslashes($_POST['data_audio']):''?>" />
              <input name="upload_audio_button_multimedia_carousel" type="button" id="upload_audio_button_multimedia_carousel" value="Upload Audio" />
              <br />
              <?php esc_html_e( 'Enter an URL or upload a .mp3 file' , 'multimedia-carousel' );?></td>
          </tr>
		  <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
		  <tr>
		    <td colspan="2" align="left" valign="middle">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle"><input name="Submit" id="Submit" type="submit" class="button-primary" value="Add Record"></td>
		  </tr>
		</table>
  </form>






</div>
