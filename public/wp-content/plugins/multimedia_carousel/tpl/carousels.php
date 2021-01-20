<div class="wrap">
	<div id="lbg_logo">
			<h2><?php esc_html_e( 'Manage Carousels' , 'multimedia-carousel' );?></h2>
 	</div>
    <div><p><?php esc_html_e( 'From this section you can add multiple carousels.' , 'multimedia-carousel' );?></p>
    </div>

<div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

<div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/add_icon.gif', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="?page=multimedia_carousel_Add_New">Add new (Carousel)</a></div>

<table width="100%" class="widefat">

			<thead>
				<tr>
					<th scope="col" width="5%"><?php esc_html_e( 'ID' , 'multimedia-carousel' );?></th>
					<th scope="col" width="26%"><?php esc_html_e( 'Name' , 'multimedia-carousel' );?></th>
					<th scope="col" width="26%"><?php esc_html_e( 'Shortcode' , 'multimedia-carousel' );?></th>
					<th scope="col" width="36%"><?php esc_html_e( 'Actions' , 'multimedia-carousel' );?></th>
					<th scope="col" width="7%"><?php esc_html_e( 'Preview' , 'multimedia-carousel' );?></th>
				</tr>
			</thead>

<tbody>
<?php foreach ( $result as $row )
	{
		$row=multimedia_carousel_unstrip_array($row); ?>
							<tr class="alternate author-self status-publish" valign="top">
					<td><?php echo esc_html($row['id'])?></td>
					<td><?php echo esc_html($row['name'])?></td>
					<td>[multimedia_carousel settings_id='<?php echo esc_html($row['id'])?>']</td>
					<td>
						<a href="?page=multimedia_carousel_Settings&amp;id=<?php echo esc_attr($row['id'])?>&amp;name=<?php echo esc_attr($row['name'])?>"><?php esc_html_e( 'Carousel Settings' , 'multimedia-carousel' );?></a> &nbsp;&nbsp;|&nbsp;&nbsp;
						<a href="?page=multimedia_carousel_Playlist&amp;id=<?php echo esc_attr($row['id'])?>&amp;name=<?php echo esc_attr($row['name'])?>"><?php esc_html_e( 'Playlist' , 'multimedia-carousel' );?></a> &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="?page=multimedia_carousel_Manage_Carousels&id=<?php echo esc_attr($row['id'])?>" onclick="return confirm('Are you sure?')" style="color:#F00;">Delete</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="?page=multimedia_carousel_Manage_Carousels&amp;duplicate_id=<?php echo esc_attr($row['id'])?>"><?php esc_html_e( 'Duplicate' , 'multimedia-carousel' );?></a></td>
					<td align="center"><a href="javascript: void(0);" onclick="showDialogPreview(<?php echo esc_js($row['id'])?>)"><img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="preview" border="0" align="absmiddle" /></a></td>
	            </tr>
<?php } ?>
						</tbody>
		</table>





</div>
