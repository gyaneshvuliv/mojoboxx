<div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="20%">&nbsp;</td>
		    <td align="left" valign="top" width="80%">&nbsp;</td>
	      </tr>
		  <tr>
		    <td colspan="2" align="left" valign="top" class="row-title" style="font-style:italic;"><?php esc_html_e( 'General Settings' , 'multimedia-carousel' );?></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title" width="15%"><?php esc_html_e( 'Carousel Name' , 'multimedia-carousel' );?></td>
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
		    <td width="75%" align="left" valign="top"><input name="width" type="text" size="25" id="width" value="<?php echo esc_attr($_POST['width']);?>"/>
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
		    <td width="75%" align="left" valign="top"><input name="imageWidth" type="text" size="25" id="imageWidth" value="<?php echo esc_attr($_POST['imageWidth']);?>"/>
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
		    <td align="left" valign="middle"><input name="autoPlay" type="text" size="25" id="autoPlay" value="<?php echo esc_attr($_POST['autoPlay']);?>"/>
		    seconds</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Number Of Visible Items' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="numberOfVisibleItems" type="text" size="25" id="numberOfVisibleItems" value="<?php echo esc_attr($_POST['numberOfVisibleItems']);?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Elements Horizontal Spacing' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="elementsHorizontalSpacing" type="text" size="25" id="elementsHorizontalSpacing" value="<?php echo esc_attr($_POST['elementsHorizontalSpacing']);?>"/>
		    px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Elements Vertical Spacing' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="elementsVerticalSpacing" type="text" size="25" id="elementsVerticalSpacing" value="<?php echo esc_attr($_POST['elementsVerticalSpacing']);?>"/>
		    px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Vertical Adjustment' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="verticalAdjustment" type="text" size="25" id="verticalAdjustment" value="<?php echo esc_attr($_POST['verticalAdjustment']);?>"/>
		    px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Animation Time' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="animationTime" type="text" size="25" id="animationTime" value="<?php echo esc_attr($_POST['animationTime']);?>"/>
		    seconds</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Easing' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="easing" id="easing">
		      <option value="easeInQuad" <?php echo (($_POST['easing']=='easeInQuad')?'selected="selected"':'')?>>easeInQuad</option>
		      <option value="easeOutQuad" <?php echo (($_POST['easing']=='easeOutQuad')?'selected="selected"':'')?>>easeOutQuad</option>
              <option value="easeInOutQuad" <?php echo (($_POST['easing']=='easeInOutQuad')?'selected="selected"':'')?>>easeInOutQuad</option>
              <option value="easeInCubic" <?php echo (($_POST['easing']=='easeInCubic')?'selected="selected"':'')?>>easeInCubic</option>
              <option value="easeOutCubic" <?php echo (($_POST['easing']=='easeOutCubic')?'selected="selected"':'')?>>easeOutCubic</option>
              <option value="easeInOutCubic" <?php echo (($_POST['easing']=='easeInOutCubic')?'selected="selected"':'')?>>easeInOutCubic</option>
              <option value="easeInQuart" <?php echo (($_POST['easing']=='easeInQuart')?'selected="selected"':'')?>>easeInQuart</option>
              <option value="easeOutQuart" <?php echo (($_POST['easing']=='easeOutQuart')?'selected="selected"':'')?>>easeOutQuart</option>
              <option value="easeInOutQuart" <?php echo (($_POST['easing']=='easeInOutQuart')?'selected="selected"':'')?>>easeInOutQuart</option>
              <option value="easeInSine" <?php echo (($_POST['easing']=='easeInSine')?'selected="selected"':'')?>>easeInSine</option>
              <option value="easeOutSine" <?php echo (($_POST['easing']=='easeOutSine')?'selected="selected"':'')?>>easeOutSine</option>
              <option value="easeOutSine" <?php echo (($_POST['easing']=='easeOutSine')?'selected="selected"':'')?>>easeOutSine</option>
              <option value="easeInExpo" <?php echo (($_POST['easing']=='easeInExpo')?'selected="selected"':'')?>>easeInExpo</option>
              <option value="easeOutExpo" <?php echo (($_POST['easing']=='easeOutExpo')?'selected="selected"':'')?>>easeOutExpo</option>
              <option value="easeInOutExpo" <?php echo (($_POST['easing']=='easeInOutExpo')?'selected="selected"':'')?>>easeInOutExpo</option>
              <option value="easeInQuint" <?php echo (($_POST['easing']=='easeInQuint')?'selected="selected"':'')?>>easeInQuint</option>
              <option value="easeOutQuint" <?php echo (($_POST['easing']=='easeOutQuint')?'selected="selected"':'')?>>easeOutQuint</option>
              <option value="easeInOutQuint" <?php echo (($_POST['easing']=='easeInOutQuint')?'selected="selected"':'')?>>easeInOutQuint</option>
              <option value="easeInCirc" <?php echo (($_POST['easing']=='easeInCirc')?'selected="selected"':'')?>>easeInCirc</option>
              <option value="easeOutCirc" <?php echo (($_POST['easing']=='easeOutCirc')?'selected="selected"':'')?>>easeOutCirc</option>
              <option value="easeInOutCirc" <?php echo (($_POST['easing']=='easeInOutCirc')?'selected="selected"':'')?>>easeInOutCirc</option>
              <option value="easeInElastic" <?php echo (($_POST['easing']=='easeInElastic')?'selected="selected"':'')?>>easeInElastic</option>
              <option value="easeOutElastic" <?php echo (($_POST['easing']=='easeOutElastic')?'selected="selected"':'')?>>easeOutElastic</option>
              <option value="easeInOutElastic" <?php echo (($_POST['easing']=='easeInOutElastic')?'selected="selected"':'')?>>easeInOutElastic</option>
              <option value="easeInBack" <?php echo (($_POST['easing']=='easeInBack')?'selected="selected"':'')?>>easeInBack</option>
              <option value="easeOutBack" <?php echo (($_POST['easing']=='easeOutBack')?'selected="selected"':'')?>>easeOutBack</option>
              <option value="easeInOutBack" <?php echo (($_POST['easing']=='easeInOutBack')?'selected="selected"':'')?>>easeInOutBack</option>
              <option value="easeInBounce" <?php echo (($_POST['easing']=='easeInBounce')?'selected="selected"':'')?>>easeInBounce</option>
              <option value="easeOutBounce" <?php echo (($_POST['easing']=='easeOutBounce')?'selected="selected"':'')?>>easeOutBounce</option>
              <option value="easeInOutBounce" <?php echo (($_POST['easing']=='easeInOutBounce')?'selected="selected"':'')?>>easeInOutBounce</option>
              <option value="swing" <?php echo (($_POST['easing']=='swing')?'selected="selected"':'')?>>swing</option>
              <option value="linear" <?php echo (($_POST['easing']=='linear')?'selected="selected"':'')?>>linear</option>
	        </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Resize Images' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="resizeImages" id="resizeImages">
              <option value="true" <?php echo (($_POST['resizeImages']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['resizeImages']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
			<tr>
				<td align="right" valign="top" class="row-title"><?php esc_html_e( 'Active Item Optional Class' , 'multimedia-carousel' );?></td>
				<td align="left" valign="top"><input name="activeItemClass" type="text" size="25" id="activeItemClass" value="<?php echo esc_attr($_POST['activeItemClass']);?>"/>
				<em>You can insert here the name of a css class which you want for the active item. The class can be defined in your css files or in Appearance->Customize->Additional CSS</em></td>
			</tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Element Title' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showElementTitle" id="showElementTitle">
              <option value="true" <?php echo (($_POST['showElementTitle']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showElementTitle']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Title Color' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top">
	        <input name="titleColor" type="text" size="25" id="titleColor" value="<?php echo strip_tags($_POST['titleColor']);?>" style="background-color:#<?php echo strip_tags($_POST['titleColor']);?>" />
              <script>
jQuery('#titleColor').ColorPicker({
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
                </script>     </td>
	      </tr>
		  <tr>
	        <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Border Width' , 'multimedia-carousel' );?></td>
	        <td align="left" valign="top"><input name="border" type="text" size="15" id="border" value="<?php echo strip_tags($_POST['border']);?>"/> px</td>
        </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Border Color OFF State' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top">
	        <input name="borderColorOFF" type="text" size="25" id="borderColorOFF" value="<?php echo strip_tags($_POST['borderColorOFF']);?>" style="background-color:#<?php echo strip_tags($_POST['borderColorOFF']);?>" />
          <script>
jQuery('#borderColorOFF').ColorPicker({
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
          <em><?php esc_html_e( 'click to select the color or just write: transparent' , 'multimedia-carousel' );?></em></td>
	    </tr>
		<tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Border Color ON State' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><em>
	        <input name="borderColorON" type="text" size="25" id="borderColorON" value="<?php echo strip_tags($_POST['borderColorON']);?>" style="background-color:#<?php echo strip_tags($_POST['borderColorON']);?>" />
              <script>
jQuery('#borderColorON').ColorPicker({
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
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show All Controllers' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showAllControllers" id="showAllControllers">
              <option value="true" <?php echo (($_POST['showAllControllers']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showAllControllers']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
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
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Preview Thumbs' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showPreviewThumbs" id="showPreviewThumbs">
              <option value="true" <?php echo (($_POST['showPreviewThumbs']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showPreviewThumbs']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Next&amp;Prev Buttons Margin Top' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="nextPrevMarginTop" type="text" size="15" id="nextPrevMarginTop" value="<?php echo esc_attr($_POST['nextPrevMarginTop']);?>"/></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Play Movie Margin Top' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="playMovieMarginTop" type="text" size="15" id="playMovieMarginTop" value="<?php echo esc_attr($_POST['playMovieMarginTop']);?>"/></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Bottom Navigation Margin Bottom' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="bottomNavMarginBottom" type="text" size="15" id="bottomNavMarginBottom" value="<?php echo esc_attr($_POST['bottomNavMarginBottom']);?>"/></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	    </tr>
		  <tr>
		    <td colspan="2" align="right" valign="top" class="row-title"><hr style="border:1px solid #CCC; border-collapse:collapse;" /></td>
    	  </tr>
        <tr>
            <td colspan="2" align="left" valign="top" class="row-title" style="font-style:italic;"><?php esc_html_e( 'Circle Timer Settings' , 'multimedia-carousel' );?></td>
        </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Show Circle Timer' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><select name="showCircleTimer" id="showCircleTimer">
              <option value="true" <?php echo (($_POST['showCircleTimer']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['showCircleTimer']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Circle Radius' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="circleRadius" type="text" size="15" id="circleRadius" value="<?php echo esc_attr($_POST['circleRadius']);?>"/>
		    px</td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Circle Line Width' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="circleLineWidth" type="text" size="15" id="circleLineWidth" value="<?php echo esc_attr($_POST['circleLineWidth']);?>"/>
		    px</td>
	    </tr>
<tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Circle Color' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="circleColor" type="text" size="25" id="circleColor" value="<?php echo esc_attr($_POST['circleColor']);?>" style="background-color:#<?php echo esc_attr($_POST['circleColor']);?>" />
                <script>
jQuery('#circleColor').ColorPicker({
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
              </script>            </td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Circle Alpha' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#circleAlpha-slider-range-min" ).slider({
			range: "min",
			value: <?php echo esc_js($_POST['circleAlpha']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#circleAlpha" ).val(ui.value );
			}
		});
		jQuery( "#circleAlpha" ).val( jQuery( "#circleAlpha-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="circleAlpha-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="circleAlpha" type="text" size="10" id="circleAlpha" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Behind Circle Color' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="top"><input name="behindCircleColor" type="text" size="25" id="behindCircleColor" value="<?php echo esc_attr($_POST['behindCircleColor']);?>" style="background-color:#<?php echo esc_attr($_POST['behindCircleColor']);?>" />
                <script>
jQuery('#behindCircleColor').ColorPicker({
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
              </script>            </td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Behind Circle Alpha' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#behindCircleAlpha-slider-range-min" ).slider({
			range: "min",
			value: <?php echo esc_js($_POST['behindCircleAlpha']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#behindCircleAlpha" ).val(ui.value );
			}
		});
		jQuery( "#behindCircleAlpha" ).val( jQuery( "#behindCircleAlpha-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="behindCircleAlpha-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="behindCircleAlpha" type="text" size="10" id="behindCircleAlpha" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Circle Left Position Correction' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="circleLeftPositionCorrection" type="text" size="15" id="circleLeftPositionCorrection" value="<?php echo esc_attr($_POST['circleLeftPositionCorrection']);?>"/>
		    px</td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title"><?php esc_html_e( 'Circle Top Position Correction' , 'multimedia-carousel' );?></td>
		    <td align="left" valign="middle"><input name="circleTopPositionCorrection" type="text" size="15" id="circleTopPositionCorrection" value="<?php echo esc_attr($_POST['circleTopPositionCorrection']);?>"/>
		    px</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>

      </table>
</div>

<div style="text-align:center; padding:20px 0px 20px 0px;"><input name="Submit" type="submit" id="Submit" class="button-primary" value="Update Settings"></div>
