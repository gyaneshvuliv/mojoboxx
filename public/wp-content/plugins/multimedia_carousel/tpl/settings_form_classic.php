<style type="text/css">
.regb {font-weight:bold;
}
</style>
<div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="30%">&nbsp;</td>
		    <td align="left" valign="top" width="85%">&nbsp;</td>
	      </tr>
		  <tr>
		    <td colspan="2" align="left" valign="top" class="row-title" style="font-style:italic;"><?php esc_html_e( 'General Settings' , 'multimedia-carousel' );?></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title" width="30%"><?php esc_html_e( 'Carousel Name' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top" width="85%"><input name="name" type="text" size="40" id="name" value="<?php echo esc_attr($_SESSION['xname']);?>"/></td>
	      </tr>
<tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Skin' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><select name="skin" id="skin">
              <option value="black" <?php echo (($_POST['skin']=='black')?'selected="selected"':'')?>>black</option>
              <option value="white" <?php echo (($_POST['skin']=='white')?'selected="selected"':'')?>>white</option>
            </select></td>
   		  </tr>
		  <tr>
            <td width="30%" align="right" valign="top" class="row-title"><?php esc_html_e( 'Carousel Width' , 'multimedia-carousel' );?></td>
		    <td width="85%" align="left" valign="top"><input name="width" type="text" size="25" id="width" value="<?php echo esc_attr($_POST['width']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Carousel Height' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="height" type="text" size="25" id="height" value="<?php echo esc_attr($_POST['height']);?>"/>
		      px</td>
	    </tr>
		<tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Width 100%' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="width100Proc" id="width100Proc">
              <option value="true" <?php echo (($_POST['width100Proc']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['width100Proc']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
			<tr>
			<td align="right" valign="top" class="row-title"><?php esc_html_e( 'Center Plugin' , 'multimedia-carousel' );?></td>
			<td align="left" valign="middle"><select name="centerPlugin" id="centerPlugin">
						<option value="true" <?php echo (($_POST['centerPlugin']=='true')?'selected="selected"':'')?>>true</option>
						<option value="false" <?php echo (($_POST['centerPlugin']=='false')?'selected="selected"':'')?>>false</option>
					</select></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="row-title"><?php esc_html_e( 'Carousel Loading Delay' , 'multimedia-carousel' );?></td>
			<td align="left" valign="middle"><input name="delay" type="text" size="25" id="delay" value="<?php echo esc_attr($_POST['delay']);?>"/> seconds</td>
			</tr>
		<tr>
		<tr>
            <td width="30%" align="right" valign="top" class="row-title"><?php esc_html_e( 'Image Width' , 'multimedia-carousel' );?></td>
		    <td width="85%" align="left" valign="top"><input name="imageWidth" type="text" size="25" id="imageWidth" value="<?php echo esc_attr($_POST['imageWidth']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Image Height' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="imageHeight" type="text" size="25" id="imageHeight" value="<?php echo esc_attr($_POST['imageHeight']);?>"/>
		      px</td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Responsive' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="responsive" id="responsive">
              <option value="true" <?php echo (($_POST['responsive']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['responsive']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Responsive Relative To Browser' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="responsiveRelativeToBrowser" id="responsiveRelativeToBrowser">
              <option value="true" <?php echo (($_POST['responsiveRelativeToBrowser']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['responsiveRelativeToBrowser']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Auto Play' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="autoPlay" type="text" size="25" id="autoPlay" value="<?php echo esc_attr($_POST['autoPlay']);?>"/> seconds</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Number Of Thumbs Per Screen' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="numberOfThumbsPerScreen" type="text" size="25" id="numberOfThumbsPerScreen" value="<?php echo esc_attr($_POST['numberOfThumbsPerScreen']);?>"/>
	        <i><?php esc_html_e( 'If you set it to 0, it will be calculated automatically. You can set a fixed number, for example 3' , 'multimedia-carousel' );?></i></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Item Padding' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="itemPadding" type="text" size="25" id="itemPadding" value="<?php echo esc_attr($_POST['itemPadding']);?>"/> px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Item Background Color OFF State' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><em>
	        <input name="itemBackgroundColorOFF" type="text" size="25" id="itemBackgroundColorOFF" value="<?php echo strip_tags($_POST['itemBackgroundColorOFF']);?>" style="background-color:#<?php echo strip_tags($_POST['itemBackgroundColorOFF']);?>" />
          <?php esc_html_e( 'click to' , 'multimedia-carousel' );?>
          <script>
jQuery('#itemBackgroundColorOFF').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script>
          <?php esc_html_e( 'select the color or just write: transparent' , 'multimedia-carousel' );?></em></td>
	    </tr>
		<tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Item Background Color ON State' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><em>
	        <input name="itemBackgroundColorON" type="text" size="25" id="itemBackgroundColorON" value="<?php echo strip_tags($_POST['itemBackgroundColorON']);?>" style="background-color:#<?php echo strip_tags($_POST['itemBackgroundColorON']);?>" />
              <script>
jQuery('#itemBackgroundColorON').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
                </script>
            <?php esc_html_e( 'click to select the color or just write: transparent' , 'multimedia-carousel' );?></em></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Title Color OFF' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top">
	        <input name="titleColorOFF" type="text" size="25" id="titleColorOFF" value="<?php echo strip_tags($_POST['titleColorOFF']);?>" style="background-color:#<?php echo strip_tags($_POST['titleColorOFF']);?>" />
            <script>
jQuery('#titleColorOFF').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
                </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Title Color ON' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top">
	        <input name="titleColorON" type="text" size="25" id="titleColorON" value="<?php echo strip_tags($_POST['titleColorON']);?>" style="background-color:#<?php echo strip_tags($_POST['titleColorON']);?>" />
            <script>
jQuery('#titleColorON').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
                </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Title Font Size' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="titleFontSize" type="text" size="25" id="titleFontSize" value="<?php echo esc_attr($_POST['titleFontSize']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Title Margin Top' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="titleMarginTop" type="text" size="25" id="titleMarginTop" value="<?php echo esc_attr($_POST['titleMarginTop']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Description Color OFF' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top">
	        <input name="descColorOFF" type="text" size="25" id="descColorOFF" value="<?php echo strip_tags($_POST['descColorOFF']);?>" style="background-color:#<?php echo strip_tags($_POST['descColorOFF']);?>" />
            <script>
jQuery('#descColorOFF').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>

		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Description Color ON' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="descColorON" type="text" size="25" id="descColorON" value="<?php echo strip_tags($_POST['descColorON']);?>" style="background-color:#<?php echo strip_tags($_POST['descColorON']);?>" />
              <script>
jQuery('#descColorON').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
                </script></td>
	      </tr>
<tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Description Font Size' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="descFontSize" type="text" size="25" id="descFontSize" value="<?php echo esc_attr($_POST['descFontSize']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Description Margin Top' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="descMarginTop" type="text" size="25" id="descMarginTop" value="<?php echo esc_attr($_POST['descMarginTop']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Target Window For Link' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="target" id="target">
		      <option value="_blank" <?php echo (($_POST['target']=='_blank')?'selected="selected"':'')?>>_blank</option>
		      <option value="_self" <?php echo (($_POST['target']=='_self')?'selected="selected"':'')?>>_self</option>
            </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Enable Touch Screen' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="enableTouchScreen" id="enableTouchScreen">
              <option value="true" <?php echo (($_POST['enableTouchScreen']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['enableTouchScreen']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'LightBox Window Width Divider' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="lightbox_width_divider" type="text" size="25" id="lightbox_width_divider" value="<?php echo esc_attr($_POST['lightbox_width_divider']);?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'LightBox Window Height Divider' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="lightbox_height_divider" type="text" size="25" id="lightbox_height_divider" value="<?php echo esc_attr($_POST['lightbox_height_divider']);?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	    </tr>
		  <tr>
		    <td colspan="2" align="right" valign="top" class="row-title"><hr style="border:1px solid #CCC; border-collapse:collapse;" /></td>
    	  </tr>
        <tr>
            <td colspan="2" align="left" valign="top" class="row-title" style="font-style:italic;"><?php esc_html_e( 'Controllers Settings' , 'multimedia-carousel' );?></td>
        </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Navigation Arrows' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showNavArrows" id="showNavArrows">
              <option value="true" <?php echo (($_POST['showNavArrows']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showNavArrows']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
         <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Navigation Arrows On Init' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showOnInitNavArrows" id="showOnInitNavArrows">
              <option value="true" <?php echo (($_POST['showOnInitNavArrows']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showOnInitNavArrows']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
         <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Auto Hide Navigation Arrows' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="autoHideNavArrows" id="autoHideNavArrows">
              <option value="true" <?php echo (($_POST['autoHideNavArrows']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['autoHideNavArrows']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Bottom Navigation' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showBottomNav" id="autoPlay">
              <option value="true" <?php echo (($_POST['showBottomNav']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showBottomNav']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Bottom Navigation On Init' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showOnInitBottomNav" id="showOnInitBottomNav">
              <option value="true" <?php echo (($_POST['showOnInitBottomNav']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showOnInitBottomNav']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Auto Hide Bottom Navigation' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="autoHideBottomNav" id="autoHideBottomNav">
              <option value="true" <?php echo (($_POST['autoHideBottomNav']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['autoHideBottomNav']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Bottom Navigation Margin Bottom' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="bottomNavMarginBottom" type="text" size="15" id="bottomNavMarginBottom" value="<?php echo esc_attr($_POST['bottomNavMarginBottom']);?>"/>
		      px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Bottom Navigation Position' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="bottomNavPosition" id="bottomNavPosition">
              <option value="left" <?php echo (($_POST['bottomNavPosition']=='left')?'selected="selected"':'')?>>left</option>
              <option value="center" <?php echo (($_POST['bottomNavPosition']=='center')?'selected="selected"':'')?>>center</option>
              <option value="right" <?php echo (($_POST['bottomNavPosition']=='right')?'selected="selected"':'')?>>right</option>
            </select></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>

      </table>
</div>

<div style="text-align:center; padding:20px 0px 20px 0px;"><input name="Submit" type="submit" id="Submit" class="button-primary" value="Update Settings"></div>
