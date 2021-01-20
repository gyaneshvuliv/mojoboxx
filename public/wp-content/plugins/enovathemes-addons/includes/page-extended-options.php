<?php 

add_action("admin_init", "enovathemes_addons_add_page_meta_box");
function enovathemes_addons_add_page_meta_box(){

    add_meta_box(
        "post-options", 
        esc_html__("Page options", 'enovathemes-addons'),
        "enovathemes_addons_render_enovathemes_page_options", 
        "page",
        "normal", 
        "default"
    );

}

function enovathemes_addons_render_enovathemes_page_options($post) {

    global $globax_enovathemes;

    $values                            = get_post_custom( $post->ID );
    $blank                             = isset( $values['blank'][0] ) ? esc_attr( $values["blank"][0] ) : "false";
    $one_page                          = isset( $values['one_page'][0] ) ? esc_attr( $values["one_page"][0] ) : "false";
    $transparent_header                = isset( $values['transparent_header'][0] ) ? esc_attr( $values["transparent_header"][0] ) : "false";
    $rev_slider                        = isset( $values["rev_slider"][0] ) ? esc_attr( $values["rev_slider"][0] ) : "--";
    $title_section                     = isset( $values['title_section'] ) ? esc_attr( $values["title_section"][0] ) : 'true';
    $title_section_back_color          = isset( $values['title_section_back_color'] ) ? esc_attr( $values["title_section_back_color"][0] ) : '#fd8c40';
    $title_section_back_img            = isset( $values['title_section_back_img'] ) ? esc_url( $values["title_section_back_img"][0] ) : '';
    $title_section_back_img_repeat     = isset( $values['title_section_back_img_repeat'] ) ? esc_attr( $values["title_section_back_img_repeat"][0] ) : 'no-repeat';
    $title_section_back_img_position   = isset( $values['title_section_back_img_position'] ) ? esc_attr( $values["title_section_back_img_position"][0] ) : 'left top';
    $title_section_back_img_attachment = isset( $values['title_section_back_img_attachment'] ) ? esc_attr( $values["title_section_back_img_attachment"][0] ) : 'scroll';
    $title_section_back_img_size       = isset( $values['title_section_back_img_size'] ) ? esc_attr( $values["title_section_back_img_size"][0] ) : 'cover';
    $title_section_parallax            = isset( $values['title_section_parallax'][0] ) ? esc_attr( $values["title_section_parallax"][0] ) : 'false';
    $title_section_overlay             = isset( $values['title_section_overlay'][0] ) ? esc_attr( $values["title_section_overlay"][0] ) : 'true';

    $title_section_subtitle            = isset( $values['title_section_subtitle'] ) ? esc_attr( $values["title_section_subtitle"][0] ) : "";
    $title_section_title_color         = isset( $values['title_section_title_color'] ) ? esc_attr( $values["title_section_title_color"][0] ) : '#212121';
    $title_section_title_back_color    = isset( $values['title_section_title_back_color'] ) ? esc_attr( $values["title_section_title_back_color"][0] ) : '#ffffff';
    $title_section_subtitle_color      = isset( $values['title_section_subtitle_color'] ) ? esc_attr( $values["title_section_subtitle_color"][0] ) : '#ffffff';
    $title_section_subtitle_back_color = isset( $values['title_section_subtitle_back_color'] ) ? esc_attr( $values["title_section_subtitle_back_color"][0] ) : '';
    $breadcrumbs_text_color            = isset( $values['breadcrumbs_text_color'] ) ? esc_attr( $values["breadcrumbs_text_color"][0] ) : '#616161';
    $breadcrumbs_back_color            = isset( $values['breadcrumbs_back_color'] ) ? esc_attr( $values["breadcrumbs_back_color"][0] ) : '#ffffff';
    $breadcrumbs_separator_color       = isset( $values['breadcrumbs_separator_color'] ) ? esc_attr( $values["breadcrumbs_separator_color"][0] ) : '#fd8c40';

    wp_nonce_field( 'enovathemes_addons_page_meta_nonce', 'enovathemes_addons_page_meta_nonce' );

?>
    <br>

    <div class="post-section" id="post-section-page-options">
        <h3 class="post-section-title"><?php echo esc_html__("Layout options", 'enovathemes-addons'); ?></h3>
        <div class="post-sub-section et-clearfix" id="page-layout-subsection">
            <div class="post-option">
                <label><?php echo esc_html__('Blank page', 'enovathemes-addons'); ?></label>
                <input type="checkbox" name="blank" value="true" <?php checked( $blank, "true" ); ?> />
            </div>
            <div class="post-option">
                <label><?php echo esc_html__('Transparent header', 'enovathemes-addons'); ?></label>
                <input type="checkbox" name="transparent_header" value="true" <?php checked( $transparent_header, "true" ); ?> />
            </div>
            <div class="post-option">
                <label><?php echo esc_html__('One page layout', 'enovathemes-addons'); ?></label>
                <input type="checkbox" name="one_page" value="true" <?php checked( $one_page, "true" ); ?> />
            </div>
            <div class="post-option">
                <label>
                    <?php echo esc_html__('Choose revolution slider', 'enovathemes-addons'); ?>
                </label>
                <?php

                    if(shortcode_exists("rev_slider")){

                        echo '<select name="rev_slider" id="rev_slider">';
                            $slider = new RevSlider();
                            $revolution_sliders = $slider->getArrSliders();
                            echo "<option value=''>".esc_html__('--- Revolution Sliders ---', 'enovathemes-addons')."</option>";
                            foreach ( $revolution_sliders as $revolution_slider ) {
                               $checked="";
                               $alias = $revolution_slider->getAlias();
                               $title = $revolution_slider->getTitle();
                               if($alias==$rev_slider) $checked="selected";
                               echo "<option value='".$alias."' $checked>".$title."</option>";
                            }
                        echo '</select>';
                    }
                ?>
            </div> 
        </div>

        <h3 class="post-section-title"><?php echo esc_html__("Page title section options", 'enovathemes-addons'); ?></h3>
        <div class="post-sub-section et-clearfix" id="page-title-section-subsection">
            <div class="post-option">
                <label>
                    <input type="checkbox" name="title_section" value="true" <?php checked( $title_section, "true" ); ?> />
                    <?php echo esc_html__(' - Title section active', 'enovathemes-addons'); ?>
                </label>
            </div>
            <div class="page-title-section-group">
                <div class="post-option">
                    <label><?php echo esc_html__('Title section subtitle:', 'enovathemes-addons'); ?></label>
                    <input name="title_section_subtitle" value="<?php echo esc_attr($title_section_subtitle); ?>" />
                </div>

                <h4 class="post-subsection-title"><?php echo esc_html__('Title section background options:', 'enovathemes-addons'); ?></h4>
                <div class="post-title-section-background-options">
                    <div class="post-option">
                        <label><?php echo esc_html__('Background color:', 'enovathemes-addons'); ?></label>
                        <input name="title_section_back_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($title_section_back_color); ?>" />
                    </div>
                    <div class="post-option">
                        <label><?php echo esc_html__('Background image:', 'enovathemes-addons'); ?></label>
                        <div class="enovathemes-upload">
                            <input name="title_section_back_img" type="hidden" class="enovathemes-upload-path" value="<?php echo esc_url($title_section_back_img);?>"/> 
                            <input class="enovathemes-button-upload button" type="button" value="<?php echo esc_html__('Upload image', 'enovathemes-addons') ?>" />
                            <input class="enovathemes-button-remove button" type="button" value="<?php echo esc_html__('Remove image', 'enovathemes-addons') ?>" />
                            <br>
                            <img src='<?php echo esc_url($title_section_back_img); ?>' class='et-img-preview enovathemes-preview-upload'/>
                        </div>
                    </div>
                    <div class="post-option width25">
                        <label><?php echo esc_html__("Background image repeat", 'enovathemes-addons'); ?></label>
                        <select name="title_section_back_img_repeat">  
                            <option value="no-repeat" <?php selected( $title_section_back_img_repeat, 'no-repeat' ); ?>><?php echo esc_html__('no-repeat','enovathemes-addons'); ?></option>
                            <option value="repeat-x" <?php selected( $title_section_back_img_repeat, 'repeat-x' ); ?>><?php echo esc_html__('repeat-x','enovathemes-addons'); ?></option>
                            <option value="repeat-y" <?php selected( $title_section_back_img_repeat, 'repeat-y' ); ?>><?php echo esc_html__('repeat-y','enovathemes-addons'); ?></option>
                            <option value="repeat" <?php selected( $title_section_back_img_repeat, 'repeat' ); ?>><?php echo esc_html__('repeat','enovathemes-addons'); ?></option>
                        </select>
                        <label><?php echo esc_html__("Background image position", 'enovathemes-addons'); ?></label>
                        <select name="title_section_back_img_position">  
                            <option value="left top" <?php selected( $title_section_back_img_position, 'left top' ); ?>><?php echo esc_html__('left top','enovathemes-addons'); ?></option>
                            <option value="left center" <?php selected( $title_section_back_img_position, 'left center' ); ?>><?php echo esc_html__('left center','enovathemes-addons'); ?></option>
                            <option value="left bottom" <?php selected( $title_section_back_img_position, 'left bottom' ); ?>><?php echo esc_html__('left bottom','enovathemes-addons'); ?></option>
                            <option value="center top" <?php selected( $title_section_back_img_position, 'center top' ); ?>><?php echo esc_html__('center top','enovathemes-addons'); ?></option>
                            <option value="center center" <?php selected( $title_section_back_img_position, 'center center' ); ?>><?php echo esc_html__('center center','enovathemes-addons'); ?></option>
                            <option value="center bottom" <?php selected( $title_section_back_img_position, 'center bottom' ); ?>><?php echo esc_html__('center bottom','enovathemes-addons'); ?></option>
                            <option value="right top" <?php selected( $title_section_back_img_position, 'right top' ); ?>><?php echo esc_html__('right top','enovathemes-addons'); ?></option>
                            <option value="right center" <?php selected( $title_section_back_img_position, 'right center' ); ?>><?php echo esc_html__('right center','enovathemes-addons'); ?></option>
                            <option value="right bottom" <?php selected( $title_section_back_img_position, 'right bottom' ); ?>><?php echo esc_html__('right bottom','enovathemes-addons'); ?></option>
                        </select>
                    </div>
                    <div class="post-option width25">
                        <label><?php echo esc_html__("Background image attachment", 'enovathemes-addons'); ?></label>
                        <select name="title_section_back_img_attachment">  
                            <option value="scroll" <?php selected( $title_section_back_img_attachment, 'scroll' ); ?>><?php echo esc_html__('scroll','enovathemes-addons'); ?></option>
                            <option value="fixed" <?php selected( $title_section_back_img_attachment, 'fixed' ); ?>><?php echo esc_html__('fixed','enovathemes-addons'); ?></option>
                        </select>
                        <label><?php echo esc_html__("Background image size", 'enovathemes-addons'); ?></label>
                        <select name="title_section_back_img_size">  
                            <option value="auto" <?php selected( $title_section_back_img_size, 'auto' ); ?>><?php echo esc_html__('auto','enovathemes-addons'); ?></option>
                            <option value="cover" <?php selected( $title_section_back_img_size, 'cover' ); ?>><?php echo esc_html__('cover','enovathemes-addons'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="post-option">
                    <label>
                        <?php echo esc_html__('Title section parallax', 'enovathemes-addons'); ?>
                    </label>
                    <input type="checkbox" name="title_section_parallax" value="true" <?php checked( $title_section_parallax, "true" ); ?> />
                </div>

                <div class="post-option">
                    <label>
                        <?php echo esc_html__('Title section overlay', 'enovathemes-addons'); ?>
                    </label>
                    <input type="checkbox" name="title_section_overlay" value="true" <?php checked( $title_section_overlay, "true" ); ?> />
                </div>

                <div class="post-option">
                    <p class="post-notice"><?php echo esc_html__("Activate parallax effect on page title section (make sure 'Title section background image attachment' option is set to 'scroll' and 'Title section background image size' is set to 'cover'). Use images with a height greater than page title section (1:1.5 ratio)", 'enovathemes-addons'); ?></p>
                </div>

                <h4 class="post-subsection-title"><?php echo esc_html__('Title section "Title" & "Subtitle" styling:', 'enovathemes-addons'); ?></h4>
                <div class="post-option width25">
                    <label><?php echo esc_html__('Title color:', 'enovathemes-addons'); ?></label>
                    <input name="title_section_title_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($title_section_title_color); ?>" />
                    <label><?php echo esc_html__('Title background color:', 'enovathemes-addons'); ?></label>
                    <input name="title_section_title_back_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($title_section_title_back_color); ?>" />
                </div>
                <div class="post-option width25">
                    <label><?php echo esc_html__('Subtitle color:', 'enovathemes-addons'); ?></label>
                    <input name="title_section_subtitle_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($title_section_subtitle_color); ?>" />
                    <label><?php echo esc_html__('Subtitle background color:', 'enovathemes-addons'); ?></label>
                    <input name="title_section_subtitle_back_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($title_section_subtitle_back_color); ?>" />
                </div>
                <h4 class="post-subsection-title"><?php echo esc_html__('Title section "Breadcrumbs" styling:', 'enovathemes-addons'); ?></h4>
                <div class="post-option width16">
                    <label><?php echo esc_html__('Breadcrumbs color:', 'enovathemes-addons'); ?></label>
                    <input name="breadcrumbs_text_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($breadcrumbs_text_color); ?>" />
                    <label><?php echo esc_html__('Breadcrumbs background color:', 'enovathemes-addons'); ?></label>
                    <input name="breadcrumbs_back_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($breadcrumbs_back_color); ?>" />
                    <label><?php echo esc_html__('Breadcrumbs separator color:', 'enovathemes-addons'); ?></label>
                    <input name="breadcrumbs_separator_color" class="color-picker" data-alpha="true" value="<?php echo esc_attr($breadcrumbs_separator_color); ?>" />
                </div>
            </div>
        </div>
    </div>
<?php
}

add_action( 'save_post', 'enovathemes_addons_save_enovathemes_page_options' );  
function enovathemes_addons_save_enovathemes_page_options( $post_id )  
{  
    
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['enovathemes_addons_page_meta_nonce'] ) || !wp_verify_nonce( $_POST['enovathemes_addons_page_meta_nonce'], 'enovathemes_addons_page_meta_nonce' ) ) return;  
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;

    if( isset( $_POST['rev_slider'] ) ){update_post_meta($post_id, "rev_slider",$_POST["rev_slider"]);}
    
    $blank_checked = ( isset( $_POST['blank'] ) ) ? "true" : "false";
    update_post_meta($post_id, "blank", $blank_checked);

    $one_page_checked = ( isset( $_POST['one_page'] ) ) ? "true" : "false";
    update_post_meta($post_id, "one_page", $one_page_checked);

    $transparent_header_checked = ( isset( $_POST['transparent_header'] ) ) ? "true" : "false";
    update_post_meta($post_id, "transparent_header", $transparent_header_checked);

    $title_section_checked = ( isset( $_POST['title_section'] ) ) ? "true" : "false";
    update_post_meta($post_id, "title_section", $title_section_checked);
    
    if( isset( $_POST['title_section_back_color'] ) ){update_post_meta($post_id, "title_section_back_color",$_POST["title_section_back_color"]);}
    if( isset( $_POST['title_section_back_img'] ) ){update_post_meta($post_id, "title_section_back_img",$_POST["title_section_back_img"]);}
    if( isset( $_POST['title_section_back_img_repeat'] ) ){update_post_meta($post_id, "title_section_back_img_repeat",$_POST["title_section_back_img_repeat"]);}
    if( isset( $_POST['title_section_back_img_position'] ) ){update_post_meta($post_id, "title_section_back_img_position",$_POST["title_section_back_img_position"]);}
    if( isset( $_POST['title_section_back_img_attachment'] ) ){update_post_meta($post_id, "title_section_back_img_attachment",$_POST["title_section_back_img_attachment"]);}
    if( isset( $_POST['title_section_back_img_size'] ) ){update_post_meta($post_id, "title_section_back_img_size",$_POST["title_section_back_img_size"]);}
    
    $parallax_checked = ( isset( $_POST['title_section_parallax'] ) ) ? "true" : "false";
    update_post_meta($post_id, "title_section_parallax", $parallax_checked);

    $overlay_checked = ( isset( $_POST['title_section_overlay'] ) ) ? "true" : "false";
    update_post_meta($post_id, "title_section_overlay", $overlay_checked);

    if( isset( $_POST['title_section_subtitle'] ) ){update_post_meta($post_id, "title_section_subtitle",$_POST["title_section_subtitle"]);}
    if( isset( $_POST['title_section_title_color'] ) ){update_post_meta($post_id, "title_section_title_color",$_POST["title_section_title_color"]);}
    if( isset( $_POST['title_section_title_back_color'] ) ){update_post_meta($post_id, "title_section_title_back_color",$_POST["title_section_title_back_color"]);}
    if( isset( $_POST['title_section_subtitle_color'] ) ){update_post_meta($post_id, "title_section_subtitle_color",$_POST["title_section_subtitle_color"]);}
    if( isset( $_POST['title_section_subtitle_back_color'] ) ){update_post_meta($post_id, "title_section_subtitle_back_color",$_POST["title_section_subtitle_back_color"]);}
    if( isset( $_POST['breadcrumbs_text_color'] ) ){update_post_meta($post_id, "breadcrumbs_text_color",$_POST["breadcrumbs_text_color"]);}
    if( isset( $_POST['breadcrumbs_back_color'] ) ){update_post_meta($post_id, "breadcrumbs_back_color",$_POST["breadcrumbs_back_color"]);}
    if( isset( $_POST['breadcrumbs_separator_color'] ) ){update_post_meta($post_id, "breadcrumbs_separator_color",$_POST["breadcrumbs_separator_color"]);}
    
}

?>