<?php
	globax_enovathemes_global_variables();

    $project_single_gallery_animation_effect = (isset($GLOBALS['globax_enovathemes']['project-single-gallery-animation-effect']) && !empty($GLOBALS['globax_enovathemes']['project-single-gallery-animation-effect'])) ? $GLOBALS['globax_enovathemes']['project-single-gallery-animation-effect'] : "none";
    $project_single_gallery_hover_effect     = (isset($GLOBALS['globax_enovathemes']['project-single-gallery-hover-effect']) && !empty($GLOBALS['globax_enovathemes']['project-single-gallery-hover-effect'])) ? $GLOBALS['globax_enovathemes']['project-single-gallery-hover-effect'] : "none";
	
	$values 		     = get_post_custom( get_the_ID() );
	$gallery_type        = isset( $values['gallery_type'][0] ) ? esc_attr( $values["gallery_type"][0] ) : "grid";
	$gallery_columns     = isset( $values['gallery_columns'][0] ) ? esc_attr( $values["gallery_columns"][0] ) : "1";
	$layout              = isset( $values['layout'][0] ) ? esc_attr( $values["layout"][0] ) : "sidebar";
    $gallery_wide_active = isset( $values['gallery_wide_active'] ) ? esc_attr( $values["gallery_wide_active"][0] ) : "false";
	$post_img_attr       = array();
		
	if (has_post_thumbnail()){

		if ( '' != get_the_title() ){
			$post_img_attr['alt'] = esc_html(get_the_title());
		}
	}

	$class      = "";

	$class .= $gallery_type;

	if ($gallery_type == "grid" || $gallery_type == "masonry") {
		$class .= ' effect-'.$project_single_gallery_animation_effect;
		$class .= ' columns-'.$gallery_columns;
	} elseif($gallery_type == "carousel") {
		$class .= ' owl-carousel effect-none';
		$class .= ' columns-'.$gallery_columns;
		$project_single_gallery_hover_effect = "none";
	} else {
		$class .= ' effect-none';
		$project_single_gallery_hover_effect = "none";
	}

	$images = get_post_meta(get_the_ID(), 'vdw_gallery_id', true);

?>

<?php if (!empty($images)): ?>
	<div id="project-gallery" class="project-gallery <?php echo $project_single_gallery_hover_effect; ?> post-media project-gallery-<?php echo get_the_ID(); ?>">
		<ul id="project-gallery-set" data-columns="<?php echo $gallery_columns; ?>" class="slides et-clearfix et-item-set <?php echo $class; ?>">
			<?php foreach ($images as $image): ?>
				<li class="et-item">
					<?php

						$post_img_srcset   = "";
						$post_img_sizes    = "";

						$post_img_original = wp_get_attachment_image_src($image, "full");
						$post_img_1200     = wp_get_attachment_image_src($image,'globax_1200X640');
						$post_img_960      = wp_get_attachment_image_src($image,'globax_960X600');
						$post_img_870      = wp_get_attachment_image_src($image,'globax_870X440');
						$post_img_640      = get_the_post_thumbnail_url(get_the_ID(),'globax_640X400');
						$post_img_588      = wp_get_attachment_image_src($image,'globax_588X440');
						$post_img_588_2    = wp_get_attachment_image_src($image,'globax_588X588');

						$thumb_size            = ($layout == "sidebar") ? 'globax_870X440' : 'globax_1200X640';
						$post_img_default_size = ($layout == "sidebar") ? '870px' : '1200px';

						// Image settings Masonry
						if ($gallery_type == "masonry") {
						    $thumb_size      = 'full';
							$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
							$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';

						} else{

							switch ($gallery_columns) {
								case '1' :
									$thumb_size            = ($layout == "sidebar") ? 'globax_870X530' : 'globax_1200X640';
									$post_img_default_size = ($layout == "sidebar") ? '870px' : '1200px';
					                break;
					            case '2' :
									$thumb_size            = ($layout == "sidebar") ? 'globax_588X440' : (($gallery_wide_active == "true") ? 'globax_960X600' : 'globax_640X400');
									$post_img_default_size = ($layout == "sidebar") ? '588px' : (($gallery_wide_active == "true") ? '960px' : '640px');
					                break;
					            case '3':
									$thumb_size            = ($layout == "sidebar") ? 'globax_588X440' : (($gallery_wide_active == "true") ? 'globax_640X400' : 'globax_588X440');
									$post_img_default_size = ($layout == "sidebar") ? '588px' : (($gallery_wide_active == "true") ? '640px' : '588px');
					                break;
					            case '4':
									$thumb_size            = ($layout == "sidebar") ? 'globax_588X588' : (($gallery_wide_active == "true") ? 'globax_588X440' : 'globax_588X588');
									$post_img_default_size = '588px';
					                break;
					            case '5':
									$thumb_size            = ($layout == "sidebar") ? 'globax_588X588' : (($gallery_wide_active == "true") ? 'globax_588X440' : 'globax_588X588');
									$post_img_default_size = '588px';
					                break;
							}

							if ($gallery_type == "carousel_thumb") {
								$thumb_size            = ($layout == "sidebar") ? 'globax_870X530' : 'globax_1200X640';
								$post_img_default_size = ($layout == "sidebar") ? '870px' : '1200px';
							}

							$post_img_sizes = '(max-width: 319px) 92vw, (max-width: 479px) 588px, (max-width: 767px) 588px, (max-width: 1023px) '.$post_img_default_size.', (max-width: 1279px) '.$post_img_default_size.', '.$post_img_default_size;
							$check_image = "false";

							if (strpos($post_img_588[0], '588x')) {
								$check_image = "true";
								$post_img_srcset .= ', '.$post_img_588[0].' 588w';
							}

							if (strpos($post_img_588_2[0], '588x')) {
								$check_image = "true";
								$post_img_srcset .= ', '.$post_img_588_2[0].' 588w';
							}

							if ($check_image == "true" && strpos($post_img_640[0], '640x')) {
								$post_img_srcset .= ', '.$post_img_640[0].' 640w';
							}

							if ($check_image == "true" && strpos($post_img_870[0], '870x')) {
								$post_img_srcset .= ', '.$post_img_870[0].' 870w';
							}

							if ($check_image == "true" && strpos($post_img_960[0], '960x')) {
								$post_img_srcset .= ', '.$post_img_960[0].' 960w';
							}

							if ($check_image == "true" && strpos($post_img_1200[0], '1200x')) {
								$post_img_srcset .= ', '.$post_img_1200[0].' 1200w';
							}

							if (empty($post_img_srcset)) {
								$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
								$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
							}

						}

						$post_img_attr['srcset'] = $post_img_srcset;
						$post_img_attr['sizes']  = $post_img_sizes;

						$post_img_caption = wp_get_attachment_caption($image);

					?>
					<div class="et-item-inner overlay-hover">
						<div class="image-container">
	                		<a class="photoswip-project" title="<?php echo esc_attr($post_img_caption); ?>" data-size="<?php echo $post_img_original[1].'x'.$post_img_original[2]; ?>" href="<?php echo $post_img_original[0]; ?>">
	                			<?php echo wp_get_attachment_image($image, $thumb_size,false,$post_img_attr); ?>
	                		</a>
	                	</div>
                	</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<?php if ($gallery_type == "carousel_thumb"): ?>
		<div id="project-gallery-navigation" class="project-gallery-navigation gallery-navigation slick-thumbnail-navigation">
			<ul id="project-gallery-navigation-set" class="slides et-clearfix">
				<?php foreach ($images as $image): ?>
					<li>
						<div class="image-container">
	                		<?php echo wp_get_attachment_image($image, 'thumbnail',false,array()); ?>
	                	</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	<?php endif ?>
<?php else: ?>
	<?php 
		if (has_post_thumbnail()){

			$post_img_1200     = wp_get_attachment_image_src(get_the_ID(),'globax_1200X640');
			$post_img_960      = wp_get_attachment_image_src(get_the_ID(),'globax_960X600');
			$post_img_870      = wp_get_attachment_image_src(get_the_ID(),'globax_870X440');
			$post_img_588      = wp_get_attachment_image_src(get_the_ID(),'globax_588X588');
			$post_img_384      = wp_get_attachment_image_src(get_the_ID(),'globax_384X384');
			$post_img_282      = wp_get_attachment_image_src(get_the_ID(),'globax_282X282');
			$post_img_original = wp_get_attachment_image_src(get_the_ID(), "full");

			$post_img_srcset   = "";
			$post_img_sizes    = "";

			$thumb_size            = ($layout == "sidebar") ? 'globax_870X530' : 'globax_1200X640';
			$post_img_default_size = ($layout == "sidebar") ? '870px' : '1200px';
			$post_img_1024_size    = ($layout == "sidebar") ? '588px' : '960px';

			$post_img_sizes    = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 870px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;

			if (strpos($post_img_282, '282x')) {
				$post_img_srcset .= $post_img_282.' 282w';
			}

			if (strpos($post_img_384, '384x')) {
				$post_img_srcset .= ', '.$post_img_384.' 384w';
			}

			if (strpos($post_img_588, '588x')) {
				$post_img_srcset .= ', '.$post_img_588.' 588w';
			}

			if (strpos($post_img_870, '870x')) {
				$post_img_srcset .= ', '.$post_img_870.' 870w';
			}

			if (strpos($post_img_960, '960x')) {
				$post_img_srcset .= ', '.$post_img_960[0].' 960w';
			}

			if (strpos($post_img_1200, '1200x')) {
				$post_img_srcset .= ', '.$post_img_1200.' 1200w';
			}

			if (empty($post_img_srcset)) {
				$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
				$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original.'px';
			}

			$post_img_attr['srcset'] = $post_img_srcset;
			$post_img_attr['sizes']  = $post_img_sizes;

			echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr);
		}
	?>
<?php endif ?>
