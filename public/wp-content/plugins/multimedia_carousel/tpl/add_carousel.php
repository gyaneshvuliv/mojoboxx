<div class="wrap">
	<div id="lbg_logo">
			<h2><?php esc_html_e( 'Manage Carousels - Add New Carousel' , 'multimedia-carousel' );?></h2>
 	</div>

    <form method="POST" enctype="multipart/form-data" id="form-add-playlist-record">
		<table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="left" valign="middle" width="25%">&nbsp;</td>
		    <td align="left" valign="middle" width="77%"><a href="?page=multimedia_carousel_Manage_Carousels" style="padding-left:25%;"><?php esc_html_e( 'Back to Manage Carousels' , 'multimedia-carousel' );?></a></td>
		  </tr>
		  <tr>
		    <td width="25%" align="right" valign="middle" class="row-title"><?php esc_html_e( 'Name*' , 'multimedia-carousel' );?></td>
		    <td width="77%" align="left" valign="top"><input name="name" type="text" id="name" size="80" value="<?php echo (array_key_exists('name', $_POST))?$_POST['name']:''?>" /></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="left" valign="middle"><?php esc_html_e( '*Required fields' , 'multimedia-carousel' );?></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle"><input name="Submit" id="Submit" type="submit" class="button-primary" value="Add New"></td>
		  </tr>
		</table>
  </form>



</div>
