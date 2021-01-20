<?php

$values 		     = get_post_custom( get_the_ID() );
$audio_mp3           = isset( $values['audio_mp3'][0] ) ? $values["audio_mp3"][0] : "";
$audio_ogg           = isset( $values['audio_ogg'][0] ) ? $values["audio_ogg"][0] : "";
$audio_embed         = isset( $values['audio_embed'][0] ) ? $values["audio_embed"][0] : "";
$video_mp4           = isset( $values['video_mp4'][0] ) ? $values["video_mp4"][0] : "";
$video_ogv           = isset( $values['video_ogv'][0] ) ? $values["video_ogv"][0] : "";
$video_webm          = isset( $values['video_webm'][0] ) ? $values["video_webm"][0] : "";
$video_embed         = isset( $values['video_embed'][0] ) ? $values["video_embed"][0] : "";
$video_poster        = isset( $values['video_poster'][0] ) ? $values["video_poster"][0] : "";
$format              = isset( $values['format'][0] ) ? esc_attr( $values["format"][0] ) : "gallery";

?>
<?php if ($format == "audio"): ?>
	<div class="post-audio media">
		<?php 
			if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
				echo "<div class='post-audio-embed'>".$audio_embed."</div>";
			} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
				echo do_shortcode('[audio mp3="'.$audio_mp3.'" ogg="'.$audio_ogg.'"][/audio]'); 
			}
		?>
	</div>
<?php elseif(($format == "video")): ?>
	<?php if (!empty($video_mp4) || !empty($video_ogv) || !empty($video_webm) || !empty($video_embed)): ?>
		<div class="post-video media">
			<?php
				if(!empty($video_embed) && empty($video_mp4) && empty($video_ogv) && empty($video_webm)) {
					echo "<div class='post-video-embed'><div class='flex-mod'>";
						echo $video_embed;
					echo "</div></div>";
				} elseif((!empty($video_mp4) || !empty($video_ogv) || !empty($video_webm))) {
					echo do_shortcode('[video mp4="'.$video_mp4.'" ogv="'.$video_ogv.'" webm="'.$video_webm.'" poster="'.$video_poster.'"][/video]');
				}
			?>
		</div>
	<?php endif; ?>
<?php elseif(($format == "gallery")): ?>
	<?php include(ENOVATHEMES_ADDONS.'project/content-project-single-gallery.php'); ?>
<?php endif ?>