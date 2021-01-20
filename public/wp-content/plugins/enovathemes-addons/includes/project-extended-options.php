<?php

function enovathemes_addons_project_layout_context( $post ) {
    
    do_meta_boxes( null, 'enovathemes_addons_project-metabox-holder', $post );
}
add_action( 'edit_form_after_title', 'enovathemes_addons_project_layout_context' ); 

add_action("admin_init", "enovathemes_addons_add_project_meta_box");
function enovathemes_addons_add_project_meta_box(){

    add_meta_box(
        "enovathemes-project-image-width", 
        esc_html__("Project custom width", 'enovathemes-addons'),
        "enovathemes_addons_render_project_width", 
        "project",
        "side", 
        "low"
    );

    add_meta_box(
        "enovathemes-project-content-direction", 
        esc_html__("Project custom content direction", 'enovathemes-addons'),
        "enovathemes_addons_render_project_content_direction", 
        "project",
        "side", 
        "low"
    );

    add_meta_box(
        "enovathemes-project-layout", 
        esc_html__("Project layout", 'enovathemes-addons'),
        "enovathemes_addons_render_project_layout", 
        "project",
        'enovathemes_addons_project-metabox-holder'
    );

    add_meta_box(
        "enovathemes-project-details", 
        esc_html__("Project extended options", 'enovathemes-addons'),
        "enovathemes_addons_render_project_options", 
        "project",
        "normal", 
        "high"
    );

}

function enovathemes_addons_render_project_layout($post) {

    global $post;

    $values = get_post_custom( $post->ID );
    $layout = isset( $values['layout'] ) ? esc_attr( $values["layout"][0] ) : "";
    wp_nonce_field( 'enovathemes_addons_project_meta_nonce', 'enovathemes_addons_project_meta_nonce' );

?>
    
    <div class="post-section" id="post-section-project-layout">
        <fieldset class="post-sub-section et-clearfix">
            <div class="post-option" id="project-sidebar">
                <label for="project-layout-sidebar">
                    <input type="radio" id="project-layout-sidebar" name="layout" value="sidebar" checked <?php checked( $layout, "sidebar" ); ?> />
                    <img src="<?php echo ENOVATHEMES_ADDONS_IMG.'project_layout_sidebar.png'; ?>" />
                    <span><?php echo esc_html__("Sidebar", 'enovathemes-addons'); ?></span>
                </label>
            </div>
            <div class="post-option" id="project-wide">
                <label for="project-layout-wide">
                    <input type="radio" id="project-layout-wide" name="layout" value="wide" <?php checked( $layout, "wide" ); ?> /> 
                    <img src="<?php echo ENOVATHEMES_ADDONS_IMG.'project_layout_wide.png'; ?>" />
                    <span><?php echo esc_html__("Wide", 'enovathemes-addons'); ?></span>
                </label>
            </div>
            <div class="post-option" id="project-custom">
                <label for="project-layout-custom">
                    <input type="radio" id="project-layout-custom" name="layout" value="custom" <?php checked( $layout, "custom" ); ?> /> 
                    <img src="<?php echo ENOVATHEMES_ADDONS_IMG.'project_layout_custom.png'; ?>" />
                    <span><?php echo esc_html__("Custom", 'enovathemes-addons'); ?></span>
                </label>
            </div>
        </fieldset>
        <div class="post-sub-section" id="project-layout-description">
            <p class="post-notice" id="project-sidebar-description"><?php echo esc_html__('Use "Project extended options" to add project data, editor is not available for this layout', 'enovathemes-addons'); ?></p>
            <p class="post-notice" id="project-wide-description"><?php echo esc_html__('Use "Project extended options" to add project data, editor is not available for this layout', 'enovathemes-addons'); ?></p>
            <p class="post-notice" id="project-custom-description"><?php echo esc_html__('Use "Editor" to create project custom layout, "Project extended options" are not available for this layout', 'enovathemes-addons'); ?></p>
        </div>
    </div>

<?php   
}

function enovathemes_addons_render_project_width($post) {

    global $post, $globax_enovathemes;

    $values = get_post_custom( $post->ID );
    $project_width = isset( $values['project_width'] ) ? esc_attr( $values['project_width'][0] ) : "";

    $project_post_size        = (isset($GLOBALS['globax_enovathemes']['project-post-size']) && $GLOBALS['globax_enovathemes']['project-post-size']) ? $GLOBALS['globax_enovathemes']['project-post-size'] : "medium";
    $project_post_layout      = (isset($GLOBALS['globax_enovathemes']['project-post-layout']) && $GLOBALS['globax_enovathemes']['project-post-layout']) ? $GLOBALS['globax_enovathemes']['project-post-layout'] : "project-with-details";
    $project_post_layout_type = (isset($GLOBALS['globax_enovathemes']['project-post-layout-type']) && $GLOBALS['globax_enovathemes']['project-post-layout-type']) ? $GLOBALS['globax_enovathemes']['project-post-layout-type'] : "grid";

    $project_width_set = array();

    switch ($project_post_size) {
        case 'small':
            $project_width_set = array('25','50','75');
            break;
        case 'medium':
            $project_width_set = array('30','60');
            break;
        case 'large':
            $project_width_set = array('50','50');
            break;
    }

?>

    <div class="project-width">
        <?php if ($project_post_layout_type == 'masonry2'): ?>
            <p class="post-notice"><?php echo esc_html__('Your project layout in "Project archive/loop" page is set to "Masonry". If you want to adjust each project width individually use "Custom project width" option below', 'enovathemes-addons'); ?></p>
            <select class="project_width" id="project_width" name="project_width">  
                <?php foreach ($project_width_set as $width): ?>
                    <option value="<?php echo $width; ?>" <?php selected( $project_width, $width ); ?>><?php echo $width.'%'; ?></option>
                <?php endforeach ?>
            </select>
        <?php else: ?>
            <p class="post-notice"><?php echo esc_html__('Your project layout in "Project archive/loop" page is set to "Grid". If you want to adjust each project width individually switch to the "Masonry layout"', 'enovathemes-addons'); ?></p>
        <?php endif ?>
    </div>

<?php   
}

function enovathemes_addons_render_project_content_direction($post) {

    global $post, $globax_enovathemes;

    $values = get_post_custom( $post->ID );
    $project_content_direction = isset( $values['project_content_direction'] ) ? esc_attr( $values['project_content_direction'][0] ) : "";

    $project_post_layout = (isset($GLOBALS['globax_enovathemes']['project-post-layout']) && $GLOBALS['globax_enovathemes']['project-post-layout']) ? $GLOBALS['globax_enovathemes']['project-post-layout'] : "project-with-details";

?>

    <div class="project-direction">
        <?php if ($project_post_layout == 'project-with-overlay-alt'): ?>
            <p class="post-notice"><?php echo esc_html__('Your project layout in "Project archive/loop" page is set to "Project alternative". If you want to adjust each project content direction separately use "Custom project content direction" option below', 'enovathemes-addons'); ?></p>
            <select class="project_content_direction" id="project_content_direction" name="project_content_direction">  
                <option value="left" <?php selected( $project_content_direction, 'left' ); ?>><?php echo esc_html__("Left", 'enovathemes-addons'); ?></option>
                <option value="right" <?php selected( $project_content_direction, 'right' ); ?>><?php echo esc_html__("Right", 'enovathemes-addons'); ?></option>
                <option value="top" <?php selected( $project_content_direction, 'top' ); ?>><?php echo esc_html__("Top", 'enovathemes-addons'); ?></option>
                <option value="bottom" <?php selected( $project_content_direction, 'bottom' ); ?>><?php echo esc_html__("Bottom", 'enovathemes-addons'); ?></option>
            </select>
        <?php else: ?>
            <p class="post-notice"><?php echo esc_html__('No content direction option is available, if you want to adjust each content direction separately, you should switch to "Project alternative" layout in "Project archive/loop" page from theme settings', 'enovathemes-addons'); ?></p>
        <?php endif ?>
    </div>

<?php   
}

function enovathemes_addons_render_project_options($post) {

    global $post;

    $values              = get_post_custom( $post->ID );
    $project_description = isset( $values['project_description'] ) ? esc_html( $values["project_description"][0] ) : "";
    $project_meta        = isset( $values['project_meta'] ) ? esc_attr( $values["project_meta"][0] ) : "";
    $project_link        = isset( $values['project_link'] ) ? esc_url( $values["project_link"][0] ) : "";
    $project_link_active = isset( $values['project_link_active'] ) ? esc_attr( $values["project_link_active"][0] ) : "false";
    $format              = isset( $values['format'] ) ? esc_attr( $values["format"][0] ) : "gallery";
    $audio_mp3           = isset( $values['audio_mp3'] ) ? esc_url( $values["audio_mp3"][0] ) : "";
    $audio_ogg           = isset( $values['audio_ogg'] ) ? esc_url( $values["audio_ogg"][0] ) : "";
    $audio_embed         = isset( $values['audio_embed'] ) ? $values["audio_embed"][0] : "";
    $video_mp4           = isset( $values['video_mp4'] ) ? esc_url( $values["video_mp4"][0] ) : "";
    $video_ogv           = isset( $values['video_ogv'] ) ? esc_url( $values["video_ogv"][0] ) : "";
    $video_webm          = isset( $values['video_webm'] ) ? esc_url( $values["video_webm"][0] ) : "";
    $video_embed         = isset( $values['video_embed'] ) ? $values["video_embed"][0] : "";
    $video_poster        = isset( $values['video_poster'] ) ? esc_attr( $values["video_poster"][0] ) : "";
    $gallery_type        = isset( $values['gallery_type'] ) ? esc_attr( $values["gallery_type"][0] ) : "grid";
    $gallery_wide_active = isset( $values['gallery_wide_active'] ) ? esc_attr( $values["gallery_wide_active"][0] ) : "false";
    $gallery_columns     = isset( $values['gallery_columns'] ) ? esc_attr( $values["gallery_columns"][0] ) : "1";
    $gallery_gap         = isset( $values['gallery_gap'] ) ? esc_attr( $values["gallery_gap"][0] ) : "0";
?>

    <div class="post-section" id="post-section-project-details">
        <h3 class="post-section-title"><?php echo esc_html__("Project details", 'enovathemes-addons'); ?></h3>
        <div class="post-sub-section et-clearfix">
            
            <div id="project-description-option" class="post-option width50">
                <label for="project_description"><?php echo esc_html__('Enter project description here (Basic HTML is allowed):', 'enovathemes-addons'); ?></label>
                <textarea name="project_description" id="project_description" ><?php echo $project_description;?></textarea>
            </div>

            <div id="project-meta-option" class="post-option width50">
                <label for="project_meta"><?php echo esc_html__('Enter project details here (Basic HTML is allowed):', 'enovathemes-addons'); ?></label>
                <div>
                    <textarea name="project_meta" id="project_meta" ><?php echo $project_meta;?></textarea>
                    <p class="post-notice"><?php echo esc_html__('Use line break (press Enter) to separate between items', 'enovathemes-addons'); ?></p>
                </div>
            </div>

            <div class="et-clearfix"></div>

            <div class="post-option">
                <label for="project_link"><?php echo esc_html__('Enter project custom link here:', 'enovathemes-addons'); ?></label>
                <div class="custom-inner-styles">
                    <input type="text" name="project_link" id="project_link" value="<?php echo $project_link;?>">
                    <input type="checkbox" id="project_link_active" name="project_link_active" value="true" <?php checked( $project_link_active, "true" ); ?> />
                    <label for="project_link_active"><?php echo esc_html__(' - Skip single project page and use this link as project link', 'enovathemes-addons'); ?></label>
                    <p class="post-notice"><?php echo esc_html__('Check the checkbox if you want to use external link for your project instead of regular single project link', 'enovathemes-addons'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="post-section" id="post-section-project-format">
        <h3 class="post-section-title"><?php echo esc_html__("Project format", 'enovathemes-addons'); ?></h3>
        <div class="post-sub-section et-clearfix" id="project-format-subsection">
            <div class="select-project-format">
                <fieldset class="et-clearfix">
                    <div id="project-image" class="post-option">
                        <label for="format"><?php echo esc_html__("Gallery", 'enovathemes-addons'); ?></label>
                        <input type="radio" id="project-format-image" name="format" class="project-format-media" value="gallery" checked <?php checked( $format, "gallery" ); ?> />
                    </div>
                    <div id="project-video" class="post-option">
                        <label for="format"><?php echo esc_html__("Video", 'enovathemes-addons'); ?></label>
                        <input type="radio" id="project-format-video" name="format" class="project-format-media" value="video" <?php checked( $format, "video" ); ?> /> 
                    </div>
                    <div id="project-audio" class="post-option">
                        <label for="format"><?php echo esc_html__("Audio", 'enovathemes-addons'); ?></label>
                        <input type="radio" id="project-format-audio" name="format" class="project-format-media" value="audio" <?php checked( $format, "audio" ); ?> /> 
                    </div>
                </fieldset>
            </div>
            <div id="project-format-options">
                <div class="optional" id="format-audio">
                    <h4 class="post-subsection-title"><?php echo esc_html__("Audio project format options", 'enovathemes-addons'); ?></h4>
                    <div class="post-option">
                        <label for="audio_mp3"><?php echo esc_html__('Enter  MP3 audio file link here:', 'enovathemes-addons'); ?></label>
                        <input name="audio_mp3" id="project-audio-mp3" type="text" value="<?php echo esc_url($audio_mp3);?>"/>
                    </div>
                    <div class="post-option">
                        <label for="audio_ogg"><?php echo esc_html__('Enter  OGG audio file link here:', 'enovathemes-addons'); ?></label>
                        <input name="audio_ogg" id="project-audio-ogg" type="text" value="<?php echo esc_url($audio_ogg);?>"/>
                    </div>
                    <div class="post-option">
                        <label for="audio_embed"><?php echo esc_html__('Embed audio here:', 'enovathemes-addons'); ?></label>
                        <textarea name="audio_embed" id="project-audio-embed"><?php echo $audio_embed;?></textarea>
                    </div>
                </div>
                <div class="optional" id="format-video">
                    <h4 class="post-subsection-title"><?php echo esc_html__("Video project format options", 'enovathemes-addons'); ?></h4>
                    <div class="post-option">
                        <label for="video_mp4"><?php echo esc_html__('Enter  MP4 video file link here:', 'enovathemes-addons'); ?></label>
                        <input name="video_mp4" id="project-video-mp3" type="text" value="<?php echo esc_url($video_mp4);?>"/>
                    </div>
                    <div class="post-option">
                        <label for="video_ogv"><?php echo esc_html__('Enter  OGV video file link here:', 'enovathemes-addons'); ?></label>
                        <input name="video_ogv" id="project-video-ogv" type="text" value="<?php echo esc_url($video_ogv);?>"/>
                    </div>
                    <div class="post-option">
                        <label for="video_webm"><?php echo esc_html__('Enter  WEBM video file link here:', 'enovathemes-addons'); ?></label>
                        <input name="video_webm" id="project-video-webm" type="text" value="<?php echo esc_url($video_webm);?>"/>
                    </div>
                    <br>
                    <div class="post-option">
                        <label for="video_poster"><?php echo esc_html__('Video poster:', 'enovathemes-addons'); ?></label>
                        <div class="enovathemes-upload">
                            <input name="video_poster" id="project-video-poster" type="hidden" class="enovathemes-upload-path" value="<?php echo esc_url($video_poster);?>"/> 
                            <input class="enovathemes-button-upload button" type="button" value="<?php echo esc_html__('Upload video poster image', 'enovathemes-addons') ?>" />
                            <input class="enovathemes-button-remove button" type="button" value="<?php echo esc_html__('Remove video poster image', 'enovathemes-addons') ?>" />
                            <img src='<?php echo esc_url($video_poster); ?>' class='et-img-preview enovathemes-preview-upload'/>
                        </div>
                    </div>

                    <div class="post-option">
                        <label for="video_embed"><?php echo esc_html__('Embed video here:', 'enovathemes-addons'); ?></label>
                        <textarea name="video_embed" id="project-video-embed"><?php echo esc_attr($video_embed);?></textarea>
                    </div>
                </div>
                <div class="optional" id="format-gallery">
                    <h4 class="post-subsection-title"><?php echo esc_html__("Gallery project format options", 'enovathemes-addons'); ?></h4>
                    <div id="project-gallery" class="post-option">
                        <label><?php echo esc_html__("Gallery type", 'enovathemes-addons'); ?></label>
                        <div>
                        <select class="gallery_type" id="gallery_type" name="gallery_type">  
                            <option value="grid" <?php selected( $gallery_type, 'grid' ); ?>><?php echo esc_html__('Grid','enovathemes-addons'); ?></option>
                            <option value="masonry" <?php selected( $gallery_type, 'masonry' ); ?>><?php echo esc_html__('Masonry','enovathemes-addons'); ?></option>
                            <option value="carousel" <?php selected( $gallery_type, 'carousel' ); ?>><?php echo esc_html__('Carousel','enovathemes-addons'); ?></option>
                            <option value="carousel_thumb" <?php selected( $gallery_type, 'carousel_thumb' ); ?>><?php echo esc_html__('Carousel with thumbnails','enovathemes-addons'); ?></option>
                        </select>
                        <div id="gallery_wide_active_opt">
                            <input type="checkbox" id="gallery_wide_active" name="gallery_wide_active" value="true" <?php checked( $gallery_wide_active, "true" ); ?> />
                            <label for="gallery_wide_active"><?php echo esc_html__(' - Make gallery 100% wide (out of main container box)', 'enovathemes-addons'); ?></label>
                        </div>
                        </div>
                    </div>
                    <div id="project-columns" class="post-option">
                        <label><?php echo esc_html__("Gallery columns", 'enovathemes-addons'); ?></label>
                        <select id="gallery_columns" name="gallery_columns">  
                            <option value="1" <?php selected( $gallery_columns, '1' ); ?>><?php echo esc_html__('1','enovathemes-addons'); ?></option>
                            <option value="2" <?php selected( $gallery_columns, '2' ); ?>><?php echo esc_html__('2','enovathemes-addons'); ?></option>
                            <option value="3" <?php selected( $gallery_columns, '3' ); ?>><?php echo esc_html__('3','enovathemes-addons'); ?></option>
                            <option value="4" <?php selected( $gallery_columns, '4' ); ?>><?php echo esc_html__('4','enovathemes-addons'); ?></option>
                            <option value="5" <?php selected( $gallery_columns, '5' ); ?>><?php echo esc_html__('5','enovathemes-addons'); ?></option>
                        </select>
                    </div>
                    <div id="project-gap" class="post-option">
                        <label><?php echo esc_html__("Gallery gap", 'enovathemes-addons'); ?></label>
                        <select id="gallery_gap" name="gallery_gap">
                            <?php for ($i = 0; $i <= 24; $i++) { ?>
                                <option value="<?php echo $i; ?>" <?php selected( $gallery_gap, $i ); ?>><?php echo $i.esc_html__('px','enovathemes-addons'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="post-option">
                        <p class="post-notice">
                            <?php echo esc_html__('Use Gallery metabox (at the bottom of project format) to upload images for the gallery project format', 'enovathemes-addons'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php

}

add_action( 'save_post', 'enovathemes_addons_save_enovathemes_project_options' );  
function enovathemes_addons_save_enovathemes_project_options( $post_id )  
{  
    
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['enovathemes_addons_project_meta_nonce'] ) || !wp_verify_nonce( $_POST['enovathemes_addons_project_meta_nonce'], 'enovathemes_addons_project_meta_nonce' ) ) return;  
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;
    
    if( isset( $_POST['project_description'] ) ){update_post_meta($post_id, "project_description",$_POST["project_description"]);}
    if( isset( $_POST['project_meta'] ) ){update_post_meta($post_id, "project_meta",$_POST["project_meta"]);}
    if( isset( $_POST['project_link'] ) ){update_post_meta($post_id, "project_link",$_POST["project_link"]);}
    
    $project_link_active_checked = ( isset( $_POST['project_link_active'] ) ) ? "true" : "false";
    update_post_meta($post_id, "project_link_active", $project_link_active_checked);

    if( isset( $_POST['format'] ) ){update_post_meta($post_id, "format",$_POST["format"]);}
    if( isset( $_POST['layout'] ) ){update_post_meta($post_id, "layout",$_POST["layout"]);}
    if( isset( $_POST['project_width'] ) ){update_post_meta($post_id, 'project_width',$_POST['project_width']);}
    if( isset( $_POST['project_content_direction'] ) ){update_post_meta($post_id, 'project_content_direction',$_POST['project_content_direction']);}

    if( isset( $_POST['audio_mp3'] ) ){update_post_meta($post_id, "audio_mp3",$_POST["audio_mp3"]);}
    if( isset( $_POST['audio_ogg'] ) ){update_post_meta($post_id, "audio_ogg",$_POST["audio_ogg"]);}
    if( isset( $_POST['audio_embed'] ) ){update_post_meta($post_id, "audio_embed",$_POST["audio_embed"]);}
    if( isset( $_POST['video_mp4'] ) ){update_post_meta($post_id, "video_mp4",$_POST["video_mp4"]);}
    if( isset( $_POST['video_ogv'] ) ){update_post_meta($post_id, "video_ogv",$_POST["video_ogv"]);}
    if( isset( $_POST['video_webm'] ) ){update_post_meta($post_id, "video_webm",$_POST["video_webm"]);}
    if( isset( $_POST['video_embed'] ) ){update_post_meta($post_id, "video_embed",$_POST["video_embed"]);}
    if( isset( $_POST['video_poster'] ) ){update_post_meta($post_id, "video_poster",$_POST["video_poster"]);}

    if( isset( $_POST['gallery_type'] ) ){update_post_meta($post_id, "gallery_type",$_POST["gallery_type"]);}
    if( isset( $_POST['gallery_columns'] ) ){update_post_meta($post_id, "gallery_columns",$_POST["gallery_columns"]);}
    if( isset( $_POST['gallery_gap'] ) ){update_post_meta($post_id, "gallery_gap",$_POST["gallery_gap"]);}

    $gallery_wide_active_checked = ( isset( $_POST['gallery_wide_active'] ) ) ? "true" : "false";
    update_post_meta($post_id, "gallery_wide_active", $gallery_wide_active_checked);
}
?>