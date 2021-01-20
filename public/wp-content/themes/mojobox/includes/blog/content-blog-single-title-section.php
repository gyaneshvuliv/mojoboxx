<?php
	globax_enovathemes_global_variables();
	$blog_single_sidebar = (isset($GLOBALS['globax_enovathemes']['blog-single-sidebar']) && $GLOBALS['globax_enovathemes']['blog-single-sidebar']) ? $GLOBALS['globax_enovathemes']['blog-single-sidebar'] : "right";
	$post_img_attr       = array();
?>
<?php

	$values 		   = get_post_custom( get_the_ID() );
    $audio_mp3         = isset( $values['audio_mp3'][0] ) ? $values["audio_mp3"][0] : "";
    $audio_ogg         = isset( $values['audio_ogg'][0] ) ? $values["audio_ogg"][0] : "";
    $audio_embed       = isset( $values['audio_embed'][0] ) ? $values["audio_embed"][0] : "";
    $video_mp4         = isset( $values['video_mp4'][0] ) ? $values["video_mp4"][0] : "";
    $video_ogv         = isset( $values['video_ogv'][0] ) ? $values["video_ogv"][0] : "";
    $video_webm        = isset( $values['video_webm'][0] ) ? $values["video_webm"][0] : "";
    $video_embed       = isset( $values['video_embed'][0] ) ? $values["video_embed"][0] : "";
    $video_poster      = isset( $values['video_poster'][0] ) ? $values["video_poster"][0] : "";
    $link_url          = isset( $values['link_url'][0] ) ? $values["link_url"][0] : "";
    $status_author     = isset( $values['status_author'][0] ) ? $values["status_author"][0] : "";
    $quote_author      = isset( $values['quote_author'][0] ) ? $values["quote_author"][0] : "";
    $featured_media    = isset( $values['featured_media'][0] ) ? $values["featured_media"][0] : "false";
    $post_format       = get_post_format(get_the_ID());

    $post_audio_class  = "";

    if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
    	$post_audio_class = "embed-audio";
	} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
    	$post_audio_class = "self-audio";
	}

?>
<?php

if (has_post_thumbnail()){

	if ( '' != the_title_attribute( 'echo=0' ) ){
		$post_img_attr['alt'] = the_title_attribute( 'echo=0' );
	}

	$thumbnail_size    = 'globax_1200X640';
	$post_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
	$post_img_384      = get_the_post_thumbnail_url(get_the_ID(),'globax_384X288');
	$post_img_1200     = get_the_post_thumbnail_url(get_the_ID(),'globax_1200X640');
	$post_img_870      = get_the_post_thumbnail_url(get_the_ID(),'globax_870X440');

	$post_img_default_size = '1200px';

	$post_img_srcset = "";
	$post_img_sizes  = '(max-width: 479px) 92vw, (max-width: 767px) 384px, '.$post_img_default_size.'px';

	if (strpos($post_img_384, '384x')) {
		$post_img_srcset .= $post_img_384.' 384w, ';
	}

	if (strpos($post_img_870, '870x')) {
		$post_img_srcset .= $post_img_870.' 870w, ';
	}

	if (strpos($post_img_1200, '1200x')) {
		$post_img_srcset .= $post_img_1200.' 1200w, ';
	}

	if (empty($post_img_srcset)) {
		$thumbnail_size = 'full';
	}

	$post_img_srcset .= $post_img_original[0].' '.$post_img_original[1].'w';

	$post_img_attr['srcset'] = $post_img_srcset;
	$post_img_attr['sizes']  = $post_img_sizes;
}

$title_section_class = 'shrink';

if ($post_format == "0" || $post_format == 'chat') {
	if (has_post_thumbnail() && $featured_media == "false"){
		$title_section_class = "";
	}
}

if ($post_format == "gallery") {
	$images = get_post_meta(get_the_ID(), 'vdw_gallery_id', true);
	if (!empty($images) && $featured_media == "false"){
		$title_section_class = "";
	}
}

if ($post_format == "video") {
	if (!empty($video_mp4) || !empty($video_ogv) || !empty($video_webm) || !empty($video_embed)){
		$title_section_class = "";
	}
}

if ($post_format == "audio") {
	if (!empty($audio_embed) || !empty($audio_ogg) || !empty($audio_mp3)){
		$title_section_class = "";
	}
}

?>

<div class="post-title-section <?php echo esc_attr($title_section_class); ?>">
	<div class="post-meta et-clearfix">
		<div class="post-date-inline"><?php echo get_the_date(); ?></div>
		<?php if ('' != get_the_category_list()): ?>
			<div class="post-category"><?php echo get_the_category_list(', '); ?></div>
		<?php endif ?>
	</div>
	<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
		<h2 class="post-title entry-title">
			<?php the_title(); ?>
		</h2>
	<?php endif ?>
	<?php globax_enovathemes_post_nav('post',get_the_ID()); ?>
</div>
<?php if ($post_format == "0" || $post_format == 'chat'): ?>
	<?php if (has_post_thumbnail() && $featured_media == "false"): ?>
		<?php 
			$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
			$image_class = ($image_data[1] >= 1200) ? "true" : "false";
		?>
		<div class="post-image post-media decoration-<?php echo esc_attr($image_class); ?>">
			<?php echo get_the_post_thumbnail( get_the_ID(), $thumbnail_size ,$post_img_attr); ?>
		</div>
	<?php endif ?>
<?php elseif($post_format == "gallery"): ?>
	<?php $images = get_post_meta(get_the_ID(), 'vdw_gallery_id', true); ?>
    <?php if (!empty($images) && $featured_media == "false"): ?>
    	<?php
    		if ( '' != the_title_attribute( 'echo=0' ) ){
				$post_img_attr['alt'] = the_title_attribute( 'echo=0' );
			}
    	?>
    	<div class="post-gallery post-media">
    		<div class="gallery-inner">
	            <ul class="slides">
	                <?php foreach ($images as $image): ?>

	                	<?php
							$post_img_original = wp_get_attachment_image_src( $image, "full" );
							$post_img_480      = wp_get_attachment_image_src( $image, 'globax_384X288');

							$post_img_srcset = '';
							$post_img_sizes  = '(max-width: 479px) 92vw, (max-width: 767px) 480px, '.$post_img_original[1].'px';

							if (strpos($post_img_480[0], '480x')) {
								$post_img_srcset .= $post_img_480[0].' 480w, ';
							}

							$post_img_srcset .= $post_img_original[0].' '.$post_img_original[1].'w';

							$post_img_attr['srcset'] = $post_img_srcset;
							$post_img_attr['sizes']  = $post_img_sizes;
							
	                	?>

	                	<li>
	                	<div class="image-container">
	                		<?php echo wp_get_attachment_image($image, $thumbnail_size,false,$post_img_attr); ?>
	                	</div>
	                	</li>
	                <?php endforeach; ?>
	            </ul>
            </div>
        </div>
    <?php else: ?>
        <?php if (has_post_thumbnail() && $featured_media == "false"): ?>
        	<div class="post-image post-media">
            	<?php echo get_the_post_thumbnail( get_the_ID(), $thumbnail_size ,$post_img_attr); ?>
        	</div>
        <?php endif ?>
    <?php endif ?>
<?php elseif($post_format == "video"): ?>
	<?php if (!empty($video_mp4) || !empty($video_ogv) || !empty($video_webm) || !empty($video_embed)): ?>
		<div class="post-video post-media">
			<?php
				if(!empty($video_embed) && empty($video_mp4) && empty($video_ogv) && empty($video_webm)) {
					echo "<div class='post-video-embed'><div class='flex-mod'>";
						echo wp_kses($video_embed,wp_kses_allowed_html('post'));
					echo "</div></div>";
				} elseif((!empty($video_mp4) || !empty($video_ogv) || !empty($video_webm))) {
					echo do_shortcode('[video mp4="'.$video_mp4.'" ogv="'.$video_ogv.'" webm="'.$video_webm.'" poster="'.$video_poster.'"][/video]');
				}
			?>
		</div>
	<?php endif; ?>
<?php elseif($post_format == "audio"): ?>
	<div class="post-audio post-media">
		<?php 
			if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
				echo "<div class='post-audio-embed'>".$audio_embed."</div>";
			} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
				echo do_shortcode('[audio mp3="'.$audio_mp3.'" ogg="'.$audio_ogg.'"][/audio]'); 
			}
		?>
	</div>
<?php endif ?>