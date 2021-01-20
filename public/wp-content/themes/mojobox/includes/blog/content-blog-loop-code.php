<?php
	globax_enovathemes_global_variables();
	$blog_post_excerpt 	       = (isset($GLOBALS['globax_enovathemes']['blog-post-excerpt']) && $GLOBALS['globax_enovathemes']['blog-post-excerpt']) ? $GLOBALS['globax_enovathemes']['blog-post-excerpt'] : 0;
	$blog_post_layout  	       = (isset($GLOBALS['globax_enovathemes']['blog-post-layout']) && $GLOBALS['globax_enovathemes']['blog-post-layout']) ? $GLOBALS['globax_enovathemes']['blog-post-layout'] : "grid";
    $blog_container   	       = (isset($GLOBALS['globax_enovathemes']['blog-container']) && $GLOBALS['globax_enovathemes']['blog-container']) ? $GLOBALS['globax_enovathemes']['blog-container'] : "boxed";
    $blog_sidebar     	       = (isset($GLOBALS['globax_enovathemes']['blog-sidebar']) && $GLOBALS['globax_enovathemes']['blog-sidebar']) ? $GLOBALS['globax_enovathemes']['blog-sidebar'] : "right";
    $blog_post_size   	       = (isset($GLOBALS['globax_enovathemes']['blog-post-size']) && $GLOBALS['globax_enovathemes']['blog-post-size']) ? $GLOBALS['globax_enovathemes']['blog-post-size'] : "medium";
	$blog_animation_effect     = (isset($GLOBALS['globax_enovathemes']['blog-animation-effect']) && $GLOBALS['globax_enovathemes']['blog-animation-effect']) ? $GLOBALS['globax_enovathemes']['blog-animation-effect'] : "none";
	$blog_button_back          = (isset($GLOBALS['globax_enovathemes']['blog-button-back']['from']) && $GLOBALS['globax_enovathemes']['blog-button-back']['from']) ? $GLOBALS['globax_enovathemes']['blog-button-back']['from'] : "";
	$blog_image_effect         = (isset($GLOBALS['globax_enovathemes']['blog-image-effect']) && $GLOBALS['globax_enovathemes']['blog-image-effect']) ? $GLOBALS['globax_enovathemes']['blog-image-effect'] : "overlay-fade";
	
	$blog_navigation           = (isset($GLOBALS['globax_enovathemes']['blog-navigation']) && $GLOBALS['globax_enovathemes']['blog-navigation']) ? $GLOBALS['globax_enovathemes']['blog-navigation'] : "pagination";
	$blog_navigation_alignment = (isset($GLOBALS['globax_enovathemes']['blog-navigation-alignment']) && $GLOBALS['globax_enovathemes']['blog-navigation-alignment']) ? $GLOBALS['globax_enovathemes']['blog-navigation-alignment'] : "center";

    $thumb_size      = 'globax_588X440';
	$post_img_attr   = array();
	$post_img_sizes  = '100vw';
	$post_img_default_size  = $post_img_sizes;

    if ($blog_post_layout == "list") {
    	$thumb_size            = 'globax_588X588';
		$post_img_default_size = '150px';
		$post_img_1024_size    = '150px';
		$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 150px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;
    	$blog_image_effect = "overlay-hover";
    } elseif ($blog_post_layout == "full") {
		$thumb_size            = 'globax_870X530';
		$post_img_default_size = '870px';
		$post_img_1024_size    = '870px';
		$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 870px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;
    }  elseif ($blog_post_layout == "grid") {

        switch ($blog_post_size) {
            case 'small' :
            	$thumb_size            = 'globax_588X440';
				$post_img_default_size = '588px';
				$post_img_1024_size    = '588px';
				$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 384px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;
                break;
            case 'medium':
				$thumb_size            = ($blog_container == "wide") ? 'globax_640X440' : 'globax_588X440';
				$post_img_default_size = ($blog_container == "wide") ? '640px' : '588px';
				$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 384px, (max-width: 1279px) 384px, '.$post_img_default_size;
                break;
            case 'large':
				$thumb_size            = ($blog_sidebar != "none") ? 'globax_588X440' : (($blog_container == "wide") ? 'globax_960X600' : 'globax_588X440');
				$post_img_default_size = ($blog_sidebar != "none") ? '588px' : (($blog_container == "wide") ? '960px' : '588px');
				$post_img_1024_size    = ($blog_sidebar != "none") ? '384px' : '588px';
				$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 384px, (max-width: 1023px) 384px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;
                break;
        }
    }

?>
<div id="loop-posts" class="loop-posts <?php echo esc_attr($blog_image_effect); ?> effect-<?php echo esc_attr($blog_animation_effect); ?> nav-<?php echo esc_attr($blog_navigation); ?> et-item-set et-clearfix">
	<?php if (have_posts()) : ?>
		<?php if ($blog_post_layout != "list" && $blog_post_layout != "full"): ?>
			<div class="grid-sizer"></div>
		<?php endif ?>
		<?php while (have_posts()) : the_post(); ?>

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
			    $featured_media    = isset( $values['featured_media'][0] ) ? $values["featured_media"][0] : "true";
			    $post_format       = get_post_format(get_the_ID());
				$post_width        = isset( $values['post_width'] ) ? esc_attr( $values['post_width'][0] ) : "";

				if (empty($post_width) || !isset($post_width)) {
					switch ($blog_post_size) {
						case 'small':
							$post_width = '25';
							break;
						case 'medium':
							$post_width = '30';
							break;
						case 'large':
							$post_width = '50';
							break;
					}
				}
			
			    $post_audio_class  = "";

			    if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
			    	$post_audio_class = "embed-audio";
				} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
			    	$post_audio_class = "self-audio";
				}


				if (has_post_thumbnail()){

					if ( '' != the_title_attribute( 'echo=0' ) ){
						$post_img_attr['alt'] = the_title_attribute( 'echo=0' );
					}

					$post_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
					$post_img_282  = get_the_post_thumbnail_url(get_the_ID(),'globax_282X212');
					$post_img_384  = get_the_post_thumbnail_url(get_the_ID(),'globax_384X288');
					$post_img_588  = get_the_post_thumbnail_url(get_the_ID(),'globax_588X440');
					$post_img_640  = get_the_post_thumbnail_url(get_the_ID(),'globax_640X400');
					$post_img_870  = get_the_post_thumbnail_url(get_the_ID(),'globax_870X440');
					$post_img_960  = get_the_post_thumbnail_url(get_the_ID(),'globax_960X600');

					$post_img_srcset = "";

					if (strpos($post_img_282, '282x')) {
						$post_img_srcset .= $post_img_282.' 282w';
					}

					if (strpos($post_img_384, '384x')) {
						$post_img_srcset .= ', '.$post_img_384.' 384w';
					}

					if (strpos($post_img_588, '588x')) {
						$post_img_srcset .= ', '.$post_img_588.' 588w';
					}

					if (strpos($post_img_640, '640x')) {

						$post_img_srcset .= ', '.$post_img_640.' 640w';
					}

					if (strpos($post_img_870, '870x')) {
						$post_img_srcset .= ', '.$post_img_870.' 870w';
					}

					if (strpos($post_img_960, '960x')) {
						$post_img_srcset .= ', '.$post_img_960.' 960w';
					}

					if ($blog_post_layout == "masonry1" || $blog_post_layout == "masonry2") {
						$thumb_size = 'full';
					}

					if (empty($post_img_srcset) || $blog_post_layout == "masonry1" || $blog_post_layout == "masonry2") {
						$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
						$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
					}

					$post_img_attr['srcset'] = $post_img_srcset;
					$post_img_attr['sizes']  = $post_img_sizes;
					
				}

			?>

			<article <?php post_class('et-item') ?> data-width="<?php echo esc_attr($post_width); ?>" id="post-<?php the_ID(); ?>">

				<div class="post-inner et-item-inner <?php echo esc_attr($post_audio_class); ?> et-clearfix">

					<?php if ($blog_post_layout == "full"): ?>
						<?php if ($post_format == "0" || $post_format == 'chat'): ?>
							<?php if (has_post_thumbnail()): ?>
								<div class="post-image overlay-hover post-media">
									<?php if (is_sticky(get_the_ID())): ?>
										<span class="post-sticky"><?php echo esc_html__("Sticky post", "globax"); ?></span>
									<?php endif ?>
									<?php echo globax_enovathemes_post_image_overlay(get_the_ID()); ?>
									<div class="image-container">
										<div class="image-loading"></div>
										<div class="image-preloader"></div>
										<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
									</div>
								</div>
		        			<?php endif ?>
						<?php elseif($post_format == "gallery"): ?>
							<?php $images = get_post_meta(get_the_ID(), 'vdw_gallery_id', true); ?>
						    <?php if (!empty($images)): ?>
						    	<?php
						    		if ( '' != the_title_attribute( 'echo=0' ) ){
										$post_img_attr['alt'] = the_title_attribute( 'echo=0' );
									}
						    	?>
						    	<div class="post-gallery post-media overlay-hover">
						    		<div class="gallery-inner">
							    		<?php if (is_sticky(get_the_ID())): ?>
											<span class="post-sticky"><?php echo esc_html__("Sticky post", "globax"); ?></span>
										<?php endif ?>
							            <ul class="slides">
							                <?php foreach ($images as $image): ?>

							                	<?php

							                		$post_img_original = wp_get_attachment_image_src( $image , "full" );
													$post_img_282  = get_the_post_thumbnail_url($image,'globax_282X212');
													$post_img_384  = get_the_post_thumbnail_url($image,'globax_384X288');
													$post_img_588  = get_the_post_thumbnail_url($image,'globax_588X440');
													$post_img_640  = get_the_post_thumbnail_url($image,'globax_640X400');
													$post_img_870  = get_the_post_thumbnail_url($image,'globax_870X440');
													$post_img_960  = get_the_post_thumbnail_url($image,'globax_960X600');

													$post_img_srcset = '';

													if (strpos($post_img_282[0], '282x')) {
														$post_img_srcset .= $post_img_282[0].' 282w';
													}

													if (strpos($post_img_384[0], '384x')) {
														$post_img_srcset .= ', '.$post_img_384[0].' 384w';
													}

													if (strpos($post_img_588[0], '588x')) {
														$post_img_srcset .= ', '.$post_img_480[0].' 588w';
													}

													if (strpos($post_img_640[0], '640x')) {

														$post_img_srcset .= ', '.$post_img_640[0].' 640w';
													}


													if (strpos($post_img_870[0], '870x')) {
														$post_img_srcset .= ', '.$post_img_870[0].' 870w';
													}

													if (strpos($post_img_960[0], '960x')) {
														$post_img_srcset .= ', '.$post_img_960[0].' 960w';
													}

													if (empty($post_img_srcset)) {
														$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
														$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
													}

													$post_img_attr['srcset'] = $post_img_srcset;
													$post_img_attr['sizes']  = $post_img_sizes;
							                	?>

							                	<li>
							                	<div class="image-container">
							                		<div class="image-loading"></div>
													<div class="image-preloader"></div>
							                		<?php echo wp_get_attachment_image($image, $thumb_size,false,$post_img_attr); ?>
							                	</div>
							                	</li>
							                <?php endforeach; ?>
							            </ul>
							        </div>
					            </div>
						    <?php else: ?>
					            <?php if (has_post_thumbnail()): ?>
					            	<div class="post-image overlay-hover post-media">
					            		<?php if (is_sticky(get_the_ID())): ?>
											<span class="post-sticky"><?php echo esc_html__("Sticky post", "globax"); ?></span>
										<?php endif ?>
					            		<?php echo globax_enovathemes_post_image_overlay(get_the_ID()); ?>
					            		<div class="image-container">
											<div class="image-loading"></div>
											<div class="image-preloader"></div>
											<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
										</div>
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
							<div class="post-audio media">
								<?php 
									if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
										echo "<div class='post-audio-embed'>".$audio_embed."</div>";
									} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
										echo do_shortcode('[audio mp3="'.$audio_mp3.'" ogg="'.$audio_ogg.'"][/audio]'); 
									}
								?>
							</div>
						<?php endif ?>
					<?php else: ?>
						<?php if (has_post_thumbnail()): ?>
							<?php if ($blog_post_layout == "masonry2"): ?>
								<div class="post-image-wrapper">
									<div class="post-image overlay-hover post-media">
										<?php if (is_sticky(get_the_ID())): ?>
											<span class="post-sticky"><?php echo esc_html__("Sticky post", "globax"); ?></span>
										<?php endif ?>
										<div class="image-container">
											<div class="image-loading"></div>
											<div class="image-preloader"></div>
											<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
										</div>
										<div class="post-image-body">
											<div class="post-image-body-inner-wrap">
												<div class="post-image-body-inner">
													<div class="post-inner-content">
														<div class="post-meta et-clearfix">
															<?php if ('' != get_the_category_list()): ?>
																<div class="post-category"><?php echo get_the_category_list(', '); ?></div>
															<?php endif ?>
															<div class="post-date-inline"><?php echo get_the_date('F Y'); ?></div>
														</div>
														<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
															<h4 class="post-title entry-title">
																<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
																	<?php the_title(); ?>
																</a>
															</h4>
														<?php endif ?>
													</div>
												</div>
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" class="post-read-more stylish-button"><?php echo esc_html__("Read more", 'globax'); ?><span class="screen-reader-text"> <?php the_title();?></span></a>
											</div>
										</div>
									</div>
								</div>
							<?php else: ?>
								<div class="post-image-wrapper">
									<div class="post-image overlay-hover post-media">
										<?php if (is_sticky(get_the_ID())): ?>
											<span class="post-sticky"><?php echo esc_html__("Sticky post", "globax"); ?></span>
										<?php endif ?>
										<?php if ($blog_post_layout != "list"): ?>
											<?php echo globax_enovathemes_post_image_overlay(get_the_ID()); ?>
										<?php endif ?>
										<div class="image-container">
											<div class="image-loading"></div>
											<div class="image-preloader"></div>
											<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
										</div>
									</div>
								</div>
							<?php endif ?>
							
	        			<?php endif ?>
					<?php endif ?>
					<?php if ($blog_post_layout != "masonry2"): ?>
						<div class="post-body et-clearfix">
							<div class="post-body-inner-wrap">
								<div class="post-body-inner">
									<?php if (!has_post_thumbnail() && $blog_post_layout == "grid"): ?>
										<?php if (is_sticky(get_the_ID())): ?>
											<span class="post-sticky"><?php echo esc_html__("Sticky post", "globax"); ?></span>
										<?php endif ?>
									<?php endif ?>
									<?php if ($blog_post_layout == "full"): ?>
										<?php if ($post_format == "aside"): ?>
											<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
												<h4 class="post-title entry-title">
													<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
														<?php the_title(); ?>
													</a>
												</h4>
											<?php endif ?>
											<?php if ( '' != get_the_content() ): ?>
												<div class="post-excerpt">
												<?php

													the_content(); 
													$defaults = array(
														'before'           => '<div id="page-links">',
														'after'            => '</div>',
														'link_before'      => '',
														'link_after'       => '',
														'next_or_number'   => 'next',
														'separator'        => ' ',
														'nextpagelink'     => esc_html__( 'Continue reading', 'globax' ),
														'previouspagelink' => esc_html__( 'Go back' , 'globax'),
														'pagelink'         => '%',
														'echo'             => 1
													);
													wp_link_pages($defaults);

												?>
												</div>
											<?php endif ?>
										<?php elseif($post_format == "quote"): ?>
											<?php if ( '' != get_the_content() ): ?>
												<div class="post-excerpt">
												<?php

													the_content(); 
													$defaults = array(
														'before'           => '<div id="page-links">',
														'after'            => '</div>',
														'link_before'      => '',
														'link_after'       => '',
														'next_or_number'   => 'next',
														'separator'        => ' ',
														'nextpagelink'     => esc_html__( 'Continue reading', 'globax' ),
														'previouspagelink' => esc_html__( 'Go back' , 'globax'),
														'pagelink'         => '%',
														'echo'             => 1
													);
													wp_link_pages($defaults);

												?>
												</div>
											<?php endif ?>
											<?php if (!empty($quote_author)): ?>
												<div class="post-quote-auther"><?php echo esc_attr($quote_author); ?></div>
											<?php endif ?>
										<?php elseif($post_format == "status"): ?>
											<?php if ( '' != get_the_content() ): ?>
												<div class="post-excerpt">
												<?php

													the_content(); 
													$defaults = array(
														'before'           => '<div id="page-links">',
														'after'            => '</div>',
														'link_before'      => '',
														'link_after'       => '',
														'next_or_number'   => 'next',
														'separator'        => ' ',
														'nextpagelink'     => esc_html__( 'Continue reading', 'globax' ),
														'previouspagelink' => esc_html__( 'Go back' , 'globax'),
														'pagelink'         => '%',
														'echo'             => 1
													);
													wp_link_pages($defaults);

												?>
												</div>
											<?php endif ?>
											<?php if (!empty($status_author)): ?>
												<div class="post-status-auther"><?php echo esc_attr($status_author); ?></div>
											<?php endif ?>
										<?php elseif($post_format == "link"): ?>
											<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
												<h4 class="post-title entry-title">
													<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
														<?php the_title(); ?>
													</a>
												</h4>
											<?php endif ?>
											<a class="post-link" href="<?php echo esc_url($link_url); ?>" target="_blank" ><?php echo esc_url($link_url); ?></a>
										<?php else: ?>
											<div class="post-meta et-clearfix">
												<?php if ('' != get_the_category_list()): ?>
													<div class="post-category"><?php echo get_the_category_list(esc_html__( ', ', 'globax' )); ?></div>
												<?php endif ?>
												<div class="post-date-inline"><?php echo get_the_date('F Y'); ?></div>
											</div>
											<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
												<h4 class="post-title entry-title">
													<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
														<?php the_title(); ?>
													</a>
												</h4>
											<?php endif ?>
											<?php if ( '' != get_the_excerpt() && !empty($blog_post_excerpt)): ?>
												<div class="post-excerpt"><?php echo globax_enovathemes_excerpt($blog_post_excerpt); ?></div>
											<?php endif ?>
											<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" class="post-read-more stylish-button"><?php echo esc_html__("Read more", 'globax'); ?></a>
										<?php endif ?>
									<?php else: ?>
										<?php if ($blog_post_layout == "grid" || $blog_post_layout == "masonry1" || $blog_post_layout == "list"): ?>
											<div class="post-meta et-clearfix">
												<?php if ('' != get_the_category_list()): ?>
													<div class="post-category"><?php echo get_the_category_list(', '); ?></div>
												<?php endif ?>
												<div class="post-date-inline"><?php echo get_the_date('F Y'); ?></div>
											</div>
										<?php endif ?>
										<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
											<h4 class="post-title entry-title">
												<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
													<?php the_title(); ?>
												</a>
											</h4>
										<?php endif ?>
										<?php if ( '' != get_the_excerpt() && !empty($blog_post_excerpt)): ?>
											<div class="post-excerpt"><?php echo globax_enovathemes_excerpt($blog_post_excerpt); ?></div>
										<?php endif ?>

										<?php
											$button_class = "small";

											if ($blog_post_layout == "full" || $blog_post_layout == "list") {
												$button_class = "medium";
											}

										?>

										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" class="post-read-more et-button <?php echo esc_attr($button_class); ?> stylish-button"><?php echo esc_html__("Read more", 'globax'); ?><span class="screen-reader-text"> <?php the_title();?></span></a>
									<?php endif ?>
								</div>
							</div>
						</div>
					<?php endif ?>
				</div>
			</article>
		<?php endwhile; ?>

	<?php else : ?>

	<?php globax_enovathemes_not_found('post'); ?>

	<?php endif; ?>
</div>
<div class="navigation-wraper">
	<?php if ($blog_navigation == 'pagination'): ?>
		<?php globax_enovathemes_post_nav_num('post',$blog_navigation_alignment); ?>
	<?php elseif($blog_navigation == 'loadmore'): ?>
		<div class="ajax-container <?php echo esc_attr($blog_navigation_alignment); ?>">
			<div id="post-ajax-loader" class="et-ajax-loader"><?php echo esc_html__("Load more", "globax"); ?></div>
			<div id="post-ajax-error" class="et-ajax-error"><?php echo esc_html__("Something went wrong, please try again later or contact the site administrator", "globax"); ?></div>
		</div>
	<?php else: ?>
		<div class="ajax-container <?php echo esc_attr($blog_navigation_alignment); ?>">
			<div id="post-ajax-loading" class="et-ajax-loading"></div>
			<div id="post-ajax-loading-status" class="et-ajax-loading-status"></div>
			<div id="post-ajax-error" class="et-ajax-error"><?php echo esc_html__("Something went wrong, please try again later or contact the site administrator", "globax"); ?></div>
		</div>
	<?php endif ?>
</div>