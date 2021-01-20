<div class="wrap">
	<div id="lbg_logo">
			<h2><?php esc_html_e( 'Playlist for slider:' , 'multimedia-carousel' );?> <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - <?php esc_html_e( 'ID' , 'multimedia-carousel' );?> #<?php echo strip_tags($_SESSION['xid'])?></span></h2>
 	</div>
  <div id="multimedia_carousel_updating_witness"><img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__))?>" /> <?php esc_html_e( 'Updating...' , 'multimedia-carousel' );?></div>
  <div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

<div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/add_icon.gif', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="?page=multimedia_carousel_Playlist&xmlf=add_playlist_record"><?php esc_html_e( 'Add new' , 'multimedia-carousel' );?></a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="javascript: void(0);" onclick="showDialogPreview(<?php echo strip_tags($_SESSION['xid'])?>)"><?php esc_html_e( 'Preview' , 'multimedia-carousel' );?></a></div>
<div style="text-align:left; padding:10px 0px 10px 14px;">#<?php esc_html_e( 'Initial Order' , 'multimedia-carousel' );?></div>


<ul id="multimedia_carousel_sortable">
	<?php foreach ( $result as $row )
	{
		$row=multimedia_carousel_unstrip_array($row); ?>
	<li class="ui-state-default cursor_move" id="<?php echo esc_attr($row['id'])?>">#<?php echo esc_html($row['ord'])?> ---  <img src="<?php echo esc_url($row['img'])?>" height="30" align="absmiddle" id="top_image_<?php echo esc_attr($row['id'])?>" /><div class="toogle-btn-closed" id="toogle-btn<?php echo esc_attr($row['ord'])?>" onclick="mytoggle('toggleable<?php echo esc_js($row['ord'])?>','toogle-btn<?php echo esc_js($row['ord'])?>');"></div><div class="options"><a href="javascript: void(0);" onclick="multimedia_carousel_delete_entire_record(<?php echo esc_js($row['id'])?>,<?php echo esc_js($row['ord'])?>);" style="color:#F00;"><?php esc_html_e( 'Delete' , 'multimedia-carousel' );?></a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="?page=multimedia_carousel_Playlist&amp;id=<?php echo strip_tags($_SESSION['xid'])?>&amp;name=<?php echo strip_tags($_SESSION['xname'])?>&amp;duplicate_id=<?php echo esc_attr($row['id'])?>"><?php esc_html_e( 'Duplicate' , 'multimedia-carousel' );?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div class="toggleable" id="toggleable<?php echo esc_attr($row['ord'])?>">
    <form method="POST" enctype="multipart/form-data" id="form-playlist-multimedia_carousel-<?php echo esc_attr($row['ord'])?>">
	    <input name="id" type="hidden" value="<?php echo esc_attr($row['id'])?>" />
        <input name="ord" type="hidden" value="<?php echo esc_attr($row['ord'])?>" />
		<table width="100%" cellspacing="0" class="wp-list-table widefat fixed pages" style="background-color:#FFFFFF;">
		  <tr>
		    <td align="left" valign="middle" width="25%"></td>
		    <td align="left" valign="middle" width="77%"></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle">&nbsp;</td>
		  </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image' , 'multimedia-carousel' );?></td>
            <td align="left" valign="middle"><input name="img" type="text" id="img" size="100" value="<?php echo stripslashes($row['img']);?>" />
              <input name="upload_img_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" type="button" id="upload_img_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" value="Change Image" />
              <br />
              <?php esc_html_e( 'Enter an URL or upload an image' , 'multimedia-carousel' );?></td>
            </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="middle"><img src="<?php echo esc_url($row['img'])?>" id="img_<?php echo esc_attr($row['ord'])?>" style="max-width:200px;" /></td>
          </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image Title' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="title" type="text" size="60" id="title" value="<?php echo stripslashes($row['title']);?>"/></td>
		    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image description' , 'multimedia-carousel' );?><br />
	        <i style="font-weight:normal;">- Only for 'Classic' carousel version -</i></td>
		    <td align="left" valign="top"><textarea name="desc" id="desc" cols="45" rows="5"><?php echo strip_tags($row['desc']);?></textarea></td>
		    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Link For The Image' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="data-link" type="text" size="60" id="data-link" value="<?php echo esc_attr($row['data-link']);?>"/></td>
		    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Link Target' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><select name="data-target" id="data-target">
              <option value="" <?php echo (($row['data-target']=='')?'selected="selected"':'')?>>select...</option>
		      <option value="_blank" <?php echo (($row['data-target']=='_blank')?'selected="selected"':'')?>>_blank</option>
		      <option value="_self" <?php echo (($row['data-target']=='_self')?'selected="selected"':'')?>>_self</option>

	        </select></td>
	      </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Preview Thumb' , 'multimedia-carousel' );?><br />
              <i style="font-weight:normal;">- Only for 'Perspective' carousel version -</i></td>
            <td align="left" valign="top"><input name="data_bottom_thumb" type="text" id="data_bottom_thumb" size="100" value="<?php echo stripslashes($row['data_bottom_thumb']);?>" /><input name="upload_thumb_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" type="button" id="upload_thumb_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" value="Change Image" /><br />
Recommended size: 79px x 79px</td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="middle"><?php if ($row['data_bottom_thumb']!='') { ?><img src="<?php echo esc_url($row['data_bottom_thumb'])?>" id="data_bottom_thumb_<?php echo esc_attr($row['ord'])?>" width="79" height="79" /><?php } ?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="top"><span class="regGray"><?php esc_html_e( 'Options for LightBox' , 'multimedia-carousel' );?></span></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Large Image' , 'multimedia-carousel' );?></td>
            <td align="left" valign="top"><input name="data_large_image" type="text" id="data_large_image" size="100" value="<?php echo stripslashes($row['data_large_image']);?>" /><input name="upload_largeimg_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" id="upload_largeimg_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" type="button" value="Change Image" /><br />
Enter an URL or upload an image</td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="top"><?php if ($row['data_large_image']!='') { ?><img src="<?php echo esc_url($row['data_large_image'])?>" id="data_large_image_<?php echo esc_attr($row['ord'])?>" style="max-width:200px;" /><?php } ?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'YouTube Video ID' , 'multimedia-carousel' );?></td>
            <td align="left" valign="top"><input name="data-video-youtube" type="text" size="60" id="data-video-youtube" value="<?php echo stripslashes($row['data-video-youtube']);?>"/></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Vimeo Video ID' , 'multimedia-carousel' );?></td>
            <td align="left" valign="top"><input name="data-video-vimeo" type="text" size="60" id="data-video-vimeo" value="<?php echo stripslashes($row['data-video-vimeo']);?>"/></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Self Hosted/Third Party Hosted Video' , 'multimedia-carousel' );?></td>
            <td align="left" valign="middle"><input name="data_video_selfhosted" type="text" id="data_video_selfhosted" size="100" value="<?php echo stripslashes($row['data_video_selfhosted']);?>" />
              <input name="upload_video_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" type="button" id="upload_video_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" value="Change Video" />
              <br />
              <?php esc_html_e( 'Enter an URL or upload an .mp4 file' , 'multimedia-carousel' );?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Audio File' , 'multimedia-carousel' );?></td>
            <td align="left" valign="middle"><input name="data_audio" type="text" id="data_audio" size="100" value="<?php echo stripslashes($row['data_audio']);?>" />
              <input name="upload_audio_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" type="button" id="upload_audio_button_multimedia_carousel_<?php echo esc_attr($row['ord'])?>" value="Change Audio" />
              <br />
              <?php esc_html_e( 'Enter an URL or upload an .mp3 file' , 'multimedia-carousel' );?></td>
          </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>


		  <tr>
		    <td colspan="2" align="left" valign="middle">&nbsp;</td>
		    </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle"><input name="Submit<?php echo esc_attr($row['ord'])?>" id="Submit<?php echo esc_attr($row['ord'])?>" type="submit" class="button-primary" value="Update Playlist Record"></td>
		  </tr>
		</table>


        </form>
            <div id="ajax-message-<?php echo esc_attr($row['ord'])?>" class="ajax-message"></div>
    </div>
    </li>
	<?php } ?>
</ul>





</div>
