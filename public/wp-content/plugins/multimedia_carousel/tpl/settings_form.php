	<div id="lbg_logo">
			<h2><?php esc_html_e( 'Carousel Settings for carousel:' , 'multimedia-carousel' );?> <span style="color:#FF0000; font-weight:bold;"><?php echo esc_html($_SESSION['xname'])?> - <?php esc_html_e( 'ID' , 'multimedia-carousel' );?> #<?php echo esc_html($_SESSION['xid'])?></span></h2>
 	</div>

    <div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="javascript: void(0);" onclick="showDialogPreview(<?php echo strip_tags($_SESSION['xid'])?>)"><?php esc_html_e( 'Preview' , 'multimedia-carousel' );?></a></div>

    <div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

    <div style="padding:30px;">
    	<p><strong><?php esc_html_e( 'Please FIRST set carousel type' , 'multimedia-carousel' );?></strong></p>
		<table class="wp-list-table widefat fixed pages" cellspacing="0">
              <tr>
                <td align="right" valign="top" class="row-title" width="15%"><?php esc_html_e( 'Type' , 'multimedia-carousel' );?></td>
                <td align="left" valign="top" width="85%"><select name="type" id="type" onchange="jQuery('#Submit').click()">
              <option value="classic" <?php echo (($_POST['type']=='classic')?'selected="selected"':'')?>>classic</option>
              <option value="perspective" <?php echo (($_POST['type']=='perspective')?'selected="selected"':'')?>>perspective</option>
            </select></td>
              </tr>
        </table>
    </div>
