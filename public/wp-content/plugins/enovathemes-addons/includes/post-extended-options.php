<?php 

add_action("admin_init", "enovathemes_addons_enovathemes_add_post_meta_box");
function enovathemes_addons_enovathemes_add_post_meta_box(){

    add_meta_box(
        "enovathemes-post-format-options", 
        esc_html__("Post Format Options", 'enovathemes-addons'),
        "enovathemes_addons_render_enovathemes_post_options", 
        "post",
        "normal", 
        "high"
    );

    add_meta_box(
        "enovathemes-post-image-width", 
        esc_html__("Blog custom width", 'enovathemes-addons'),
        "enovathemes_addons_render_post_width", 
        "post",
        "side", 
        "low"
    );

}

function enovathemes_addons_render_enovathemes_post_options($post) {
    
    $values            = get_post_custom( $post->ID );
    $audio_mp3         = isset( $values['audio_mp3'] ) ? esc_url( $values["audio_mp3"][0] ) : "";
    $audio_ogg         = isset( $values['audio_ogg'] ) ? esc_url( $values["audio_ogg"][0] ) : "";
    $audio_embed       = isset( $values['audio_embed'] ) ? $values["audio_embed"][0] : "";
    $video_mp4         = isset( $values['video_mp4'] ) ? esc_url( $values["video_mp4"][0] ) : "";
    $video_ogv         = isset( $values['video_ogv'] ) ? esc_url( $values["video_ogv"][0] ) : "";
    $video_webm        = isset( $values['video_webm'] ) ? esc_url( $values["video_webm"][0] ) : "";
    $video_embed       = isset( $values['video_embed'] ) ? $values["video_embed"][0] : "";
    $video_poster      = isset( $values['video_poster'] ) ? esc_attr( $values["video_poster"][0] ) : "";
    $link_url          = isset( $values['link_url'] ) ? esc_url( $values["link_url"][0] ) : "";
    $status_author     = isset( $values['status_author'] ) ? esc_attr( $values["status_author"][0] ) : "";
    $quote_author      = isset( $values['quote_author'] ) ? esc_attr( $values["quote_author"][0] ) : "";
    $featured_media    = isset( $values['featured_media'] ) ? esc_attr( $values["featured_media"][0] ) : "false";

    wp_nonce_field( 'enovathemes_addons_enovathemes_post_meta_nonce', 'enovathemes_addons_enovathemes_post_meta_nonce' );

?>
    <div class="post-section" id="post-section-post-formats">
        <div class="post-sub-section" id="featured-media">
            <label for="post-featured-media">
                <input type="checkbox" id="post-featured-media" name="featured_media" value="true" <?php checked( $featured_media, "true" ); ?> />
                <?php echo esc_html__(' - Disable Featured Media in this post (Featured Image / Featured Gallery)', 'enovathemes-addons'); ?>
            </label>
        </div>
        <div class="post-sub-section optional" id="format-audio">
            <h4 class="post-section-title"><?php echo esc_html__("Audio post format options", 'enovathemes-addons'); ?></h4></br>
            <div class="post-option">
                <label for="audio_mp3"><?php echo esc_html__('Enter  MP3 audio file link here:', 'enovathemes-addons'); ?></label>
                <input name="audio_mp3" id="post-audio-mp3" type="text" value="<?php echo esc_url($audio_mp3);?>"/>
            </div>
            <div class="post-option">
                <label for="audio_ogg"><?php echo esc_html__('Enter  OGG audio file link here:', 'enovathemes-addons'); ?></label>
                <input name="audio_ogg" id="post-audio-ogg" type="text" value="<?php echo esc_url($audio_ogg);?>"/>
            </div>
            <div class="post-option">
                <label for="audio_embed"><?php echo esc_html__('Embed audio here:', 'enovathemes-addons'); ?></label>
                <textarea name="audio_embed" id="post-audio-embed"><?php echo $audio_embed;?></textarea>
            </div>
        </div>
        <div class="post-sub-section optional" id="format-video">
            <h4 class="post-section-title"><?php echo esc_html__("Video post format options", 'enovathemes-addons'); ?></h4></br>
            <div class="post-option">
                <label for="video_mp4"><?php echo esc_html__('Enter  MP4 video file link here:', 'enovathemes-addons'); ?></label>
                <input name="video_mp4" id="post-video-mp3" type="text" value="<?php echo esc_url($video_mp4);?>"/>
            </div>
            <div class="post-option">
                <label for="video_ogv"><?php echo esc_html__('Enter  OGV video file link here:', 'enovathemes-addons'); ?></label>
                <input name="video_ogv" id="post-video-ogv" type="text" value="<?php echo esc_url($video_ogv);?>"/>
            </div>
            <div class="post-option">
                <label for="video_webm"><?php echo esc_html__('Enter  WEBM video file link here:', 'enovathemes-addons'); ?></label>
                <input name="video_webm" id="post-video-webm" type="text" value="<?php echo esc_url($video_webm);?>"/>
            </div>
            <br>
            <div class="post-option">
                <label for="video_poster"><?php echo esc_html__('Video poster:', 'enovathemes-addons'); ?></label>
                <div class="enovathemes-upload">
                    <input name="video_poster" id="post-video-poster" type="hidden" class="enovathemes-upload-path" value="<?php echo esc_url($video_poster);?>"/> 
                    <input class="enovathemes-button-upload button" type="button" value="<?php echo esc_html__('Upload video poster image', 'enovathemes-addons') ?>" />
                    <input class="enovathemes-button-remove button" type="button" value="<?php echo esc_html__('Remove video poster image', 'enovathemes-addons') ?>" />
                    <img src='<?php echo esc_url($video_poster); ?>' class='et-img-preview enovathemes-preview-upload'/>
                </div>
            </div>

            <div class="post-option">
                <label for="video_embed"><?php echo esc_html__('Embed video here:', 'enovathemes-addons'); ?></label>
                <textarea name="video_embed" id="post-video-embed"><?php echo esc_attr($video_embed);?></textarea>
            </div>
        </div>
        <div class="post-sub-section optional" id="format-gallery">
            <h4 class="post-section-title"><?php echo esc_html__("Gallery post format options", 'enovathemes-addons'); ?></h4></br>
            <p class="post-notice"><?php echo esc_html__('Use Gallery metabox (at the bottom of post extended options) to upload images for the gallery post format', 'enovathemes-addons'); ?></p>
        </div>
        <div class="post-sub-section optional" id="format-link">
            <h4 class="post-section-title"><?php echo esc_html__("Link post format options", 'enovathemes-addons'); ?></h4></br>
            <div class="post-option">
                <label for="link_url"><?php echo esc_html__('Enter link URL here:', 'enovathemes-addons'); ?></label>
                <input name="link_url" id="post-link-url" type="text" value="<?php echo esc_url($link_url);?>"/>
            </div>
        </div>
        <div class="post-sub-section optional" id="format-status">
            <h4 class="post-section-title"><?php echo esc_html__("Status post format options", 'enovathemes-addons'); ?></h4></br>
            <div class="post-option">
                <label for="status_author"><?php echo esc_html__('Enter status author name here:', 'enovathemes-addons'); ?></label>
                <input name="status_author" id="post-status-author" type="text" value="<?php echo esc_attr($status_author);?>"/>
            </div>
        </div>
        <div class="post-sub-section optional" id="format-quote">
            <h4 class="post-section-title"><?php echo esc_html__("Quote post format options", 'enovathemes-addons'); ?></h4></br>
            <div class="post-option">
                <label for="quote_author"><?php echo esc_html__('Enter quote author name here:', 'enovathemes-addons'); ?></label>
                <input name="quote_author" id="post-quote-author" type="text" value="<?php echo esc_attr($quote_author);?>"/>
            </div>
        </div>
    </div>
<?php
}

function enovathemes_addons_render_post_width($post) {

    global $post, $globax_enovathemes;

    $values = get_post_custom( $post->ID );
    $post_width = isset( $values['post_width'] ) ? esc_attr( $values['post_width'][0] ) : "";

    $blog_post_size        = (isset($GLOBALS['globax_enovathemes']['blog-post-size']) && $GLOBALS['globax_enovathemes']['blog-post-size']) ? $GLOBALS['globax_enovathemes']['blog-post-size'] : "medium";
    $blog_post_layout      = (isset($GLOBALS['globax_enovathemes']['blog-post-layout']) && $GLOBALS['globax_enovathemes']['blog-post-layout']) ? $GLOBALS['globax_enovathemes']['blog-post-layout'] : "grid";

    $post_width_set = array();

    switch ($blog_post_size) {
        case 'small':
            $post_width_set = array('25','50','75');
            break;
        case 'medium':
            $post_width_set = array('30','60');
            break;
        case 'large':
            $post_width_set = array('50','50');
            break;
    }

?>

    <div class="post-width">
        <?php if ($blog_post_layout == 'masonry2'): ?>
            <p class="post-notice"><?php echo esc_html__('Your post layout in "Blog archive/loop" page is set to "Masonry 2". If you want to adjust each post width individually use "Custom post width" option below', 'enovathemes-addons'); ?></p>
            <select class="post_width" id="post_width" name="post_width">  
                <?php foreach ($post_width_set as $width): ?>
                    <option value="<?php echo $width; ?>" <?php selected( $post_width, $width ); ?>><?php echo $width.'%'; ?></option>
                <?php endforeach ?>
            </select>
        <?php else: ?>
            <p class="post-notice"><?php echo esc_html__('Your post layout in "Blog archive/loop" page is set to "'.strtoupper($blog_post_layout).'". If you want to adjust each post width individually switch to the "Masonry 2 layout"', 'enovathemes-addons'); ?></p>
        <?php endif ?>
    </div>

<?php   
}

add_action( 'save_post', 'enovathemes_addons_save_enovathemes_post_format_options' );  
function enovathemes_addons_save_enovathemes_post_format_options( $post_id )  
{  
    
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if( !isset( $_POST['enovathemes_addons_enovathemes_post_meta_nonce'] ) || !wp_verify_nonce( $_POST['enovathemes_addons_enovathemes_post_meta_nonce'], 'enovathemes_addons_enovathemes_post_meta_nonce' ) ) return;  
    if ( ! current_user_can( 'edit_page', $post_id ) ) return;

    if( isset( $_POST['audio_mp3'] ) ){update_post_meta($post_id, "audio_mp3",$_POST["audio_mp3"]);}
    if( isset( $_POST['audio_ogg'] ) ){update_post_meta($post_id, "audio_ogg",$_POST["audio_ogg"]);}
    if( isset( $_POST['audio_embed'] ) ){update_post_meta($post_id, "audio_embed",$_POST["audio_embed"]);}
    if( isset( $_POST['video_mp4'] ) ){update_post_meta($post_id, "video_mp4",$_POST["video_mp4"]);}
    if( isset( $_POST['video_ogv'] ) ){update_post_meta($post_id, "video_ogv",$_POST["video_ogv"]);}
    if( isset( $_POST['video_webm'] ) ){update_post_meta($post_id, "video_webm",$_POST["video_webm"]);}
    if( isset( $_POST['video_embed'] ) ){update_post_meta($post_id, "video_embed",$_POST["video_embed"]);}
    if( isset( $_POST['video_poster'] ) ){update_post_meta($post_id, "video_poster",$_POST["video_poster"]);}
    if( isset( $_POST['link_url'] ) ){update_post_meta($post_id, "link_url",$_POST["link_url"]);}
    if( isset( $_POST['status_author'] ) ){update_post_meta($post_id, "status_author",$_POST["status_author"]);}
    if( isset( $_POST['quote_author'] ) ){update_post_meta($post_id, "quote_author",$_POST["quote_author"]);}
    if( isset( $_POST['post_width'] ) ){update_post_meta($post_id, 'post_width',$_POST['post_width']);}

    $featured_media_checked = ( isset( $_POST['featured_media'] ) ) ? "true" : "false";
    update_post_meta($post_id, "featured_media", $featured_media_checked);
}

?>