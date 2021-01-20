<?php
	globax_enovathemes_global_variables();

    $project_single_gallery_animation_effect     = (isset($GLOBALS['globax_enovathemes']['project-single-gallery-animation-effect']) && !empty($GLOBALS['globax_enovathemes']['project-single-gallery-animation-effect'])) ? $GLOBALS['globax_enovathemes']['project-single-gallery-animation-effect'] : "none";
	$lazy_class = ($project_single_gallery_animation_effect == "none") ? "lazy lazy-load" : "";
    $project_post_layout             = (isset($GLOBALS['globax_enovathemes']['project-post-layout']) && $GLOBALS['globax_enovathemes']['project-post-layout']) ? $GLOBALS['globax_enovathemes']['project-post-layout'] : "project-with-details";

?>
<div id="single-project-page" class="single-project-page">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class() ?> id="project-<?php the_ID(); ?>">

				<?php

					$values      = get_post_custom( get_the_ID() );
				    $layout      = isset( $values['layout'][0] ) ? esc_attr( $values["layout"][0] ) : "sidebar";
    				$format      = isset( $values['format'] ) ? esc_attr( $values["format"][0] ) : "gallery";
					$audio_mp3   = isset( $values['audio_mp3'][0] ) ? $values["audio_mp3"][0] : "";
					$audio_ogg   = isset( $values['audio_ogg'][0] ) ? $values["audio_ogg"][0] : "";
					$audio_embed = isset( $values['audio_embed'][0] ) ? $values["audio_embed"][0] : "";
    				$gallery_wide_active = isset( $values['gallery_wide_active'] ) ? esc_attr( $values["gallery_wide_active"][0] ) : "false";
					$gallery_type        = isset( $values['gallery_type'][0] ) ? esc_attr( $values["gallery_type"][0] ) : "grid";

				    $post_audio_class  = "";

				    if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
				    	$post_audio_class = "embed-audio";
					} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
				    	$post_audio_class = "self-audio";
					}

					
					$project_media_class = "container";

					if ($format == "gallery" && $gallery_type != "carousel_thumb" && $gallery_wide_active == "true") {
						$project_media_class = "container-full";
					}

				?>

				<div class="post-inner <?php echo $post_audio_class; ?> et-clearfix">
					<?php if ($layout == "sidebar"): ?>
						<div class="container">
							<div class="project-title-section et-clearfix">
								<?php if ( '' != get_the_title() ): ?>
									<h2 class="post-title">
										<?php the_title(); ?>
									</h2>
								<?php endif ?>
								<div class="project-single-navigation">
									<?php
						                $prev_post = get_adjacent_post(false,'', true);
						                $next_post = get_adjacent_post(false,'', false);
									?>
					              	<?php if(!empty($prev_post)) {echo '<a class="project-prev" rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' .esc_html__('Previous project', 'enovathemes-addons') .'"></a>'; } ?>
					              	<?php echo '<a class="project-all" href="' . get_post_type_archive_link( 'project' ) . '"></a>'; ?>
					              	<?php if(!empty($next_post)) {echo '<a class="project-next" rel="next" href="' . get_permalink($next_post->ID) . '" title="' .esc_html__('Next project', 'enovathemes-addons') .'"></a>'; } ?>
								</div>
							</div>
							<div class="et-clearfix"></div>
							<div class="project-media <?php echo $lazy_class; ?>">
								<?php include(ENOVATHEMES_ADDONS.'project/content-project-single-media.php'); ?>
							</div>
							<div class="project-details">
								<?php include(ENOVATHEMES_ADDONS.'project/content-project-single-details.php'); ?>
							</div>
						</div>
					<?php elseif($layout == "wide"): ?>
						<div class="project-title-section container et-clearfix">
							<?php if ( '' != get_the_title() ): ?>
								<h2 class="post-title">
									<?php the_title(); ?>
								</h2>
							<?php endif ?>
							<div class="project-single-navigation">
								<?php
					                $prev_post = get_adjacent_post(false, '', true);
					                $next_post = get_adjacent_post(false, '', false);	
								?>
				              	<?php if(!empty($prev_post)) {echo '<a class="project-prev" rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '"></a>'; } ?>
				              	<?php echo '<a class="project-all" href="' . get_post_type_archive_link( 'project' ) . '"></a>'; ?>
				              	<?php if(!empty($next_post)) {echo '<a class="project-next" rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '"></a>'; } ?>
							</div>
						</div>
						<div class="et-clearfix"></div>
						<div class="project-media <?php echo $project_media_class; ?> <?php echo $lazy_class; ?>">
							<?php include(ENOVATHEMES_ADDONS.'project/content-project-single-media.php'); ?>
						</div>
						<div class="project-details container et-clearfix">
							<?php include(ENOVATHEMES_ADDONS.'project/content-project-single-details.php'); ?>
						</div>
					<?php else: ?>
						<?php the_content(); ?>
					<?php endif ?>
				</div>
			</article>
			<?php if (isset($GLOBALS['globax_enovathemes']['project-related-projects']) && $GLOBALS['globax_enovathemes']['project-related-projects'] == 1): ?>
				
				<?php

					$project_post_layout  	      = (isset($GLOBALS['globax_enovathemes']['project-post-layout']) && !empty($GLOBALS['globax_enovathemes']['project-post-layout'])) ? $GLOBALS['globax_enovathemes']['project-post-layout'] : "project-with-details";
					$project_image_effect         = "overlay-fade";
					$project_image_effect_details = (isset($GLOBALS['globax_enovathemes']['project-image-effect-details']) && !empty($GLOBALS['globax_enovathemes']['project-image-effect-details'])) ? $GLOBALS['globax_enovathemes']['project-image-effect-details'] : "overlay-fade";
					$project_image_effect_caption = (isset($GLOBALS['globax_enovathemes']['project-image-effect-caption']) && !empty($GLOBALS['globax_enovathemes']['project-image-effect-caption'])) ? $GLOBALS['globax_enovathemes']['project-image-effect-caption'] : "caption-up";
					$project_image_effect_overlay = (isset($GLOBALS['globax_enovathemes']['project-image-effect-overlay']) && !empty($GLOBALS['globax_enovathemes']['project-image-effect-overlay'])) ? $GLOBALS['globax_enovathemes']['project-image-effect-overlay'] : "overlay-fade";

					switch ($project_post_layout) {
						case 'project-with-details':
							$project_image_effect = $project_image_effect_details;
							break;
						case 'project-with-caption':
							$project_image_effect = $project_image_effect_caption;
							break;
						case 'project-with-overlay':
							$project_image_effect = $project_image_effect_overlay;
							break;
					}

				?>

				<?php $terms = get_the_terms( $post->ID , 'project-tag'); ?>
				<?php if ($terms): ?>

					<?php

						$tagids = array();
						foreach($terms as $tag) {$tagids[] = $tag->term_id;}

						$args = array(
							'post_type' => 'project',
							'tax_query' => array(
					            array(
					                'taxonomy' => 'project-tag',
					                'field'    => 'id',
					                'terms'    => $tagids,
					                'operator' => 'IN'
					             )
					        ),
							'posts_per_page'      => 5000,
							'ignore_sticky_posts' => 1,
							'orderby'             => 'date',
							'post__not_in'        => array($post->ID)
						);

					    $related_posts = new WP_Query($args);

					?>

					<?php if ($related_posts->have_posts()): ?>
						<div class="related-projects-wrapper et-clearfix project-layout <?php echo $project_post_layout; ?>">
							<div class="container">
								<h3 class="related-projects-title stylish-dash"><?php echo esc_html__("Related projects", 'enovathemes-addons'); ?></h3>
								<div id="related-projects" data-columns="3" class="owl-carousel related-projects <?php echo $project_image_effect; ?> et-clearfix">
									<?php while($related_posts->have_posts()) : $related_posts->the_post(); ?>

										<?php

											$values 		     = get_post_custom( get_the_ID() );
										    $project_link        = isset( $values['project_link'][0] ) ? $values["project_link"][0] : "";
										    $project_link_active = isset( $values['project_link_active'][0] ) ? $values["project_link_active"][0] : "false";
											$project_content_direction = isset( $values['project_content_direction'] ) ? esc_attr( $values['project_content_direction'][0] ) : "";

											$stylish_class = 'post';

											if ($project_post_layout == "project-with-overlay-alt") {
												$stylish_class = 'post stylish-hover';
												$stylish_class .= ' '.$project_content_direction;
											}

										?>

										<article <?php post_class($stylish_class); ?> id="project-<?php the_ID(); ?>">
											<?php

												if (has_post_thumbnail()){

													if ( '' != get_the_title() ){
														$post_img_attr['alt'] = esc_html(get_the_title());
													}

													$thumb_size        = 'globax_588X440';
													$post_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
													$post_img_588      = get_the_post_thumbnail_url(get_the_ID(),'globax_588X440');

													$post_img_srcset = "";
									                $post_img_sizes  = '(max-width: 479px) 92vw, 588px';

													if (strpos($post_img_588, '588x')) {
														$post_img_srcset .= $post_img_588.' 588w';
													} else {
														$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
														$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
													}

													$post_img_attr['srcset'] = $post_img_srcset;
													$post_img_attr['sizes']  = $post_img_sizes;
												}
											?>
											<div class="post-inner et-item-inner et-clearfix">
												<?php if (has_post_thumbnail()): ?>
													<div class="post-image overlay-hover post-media">
														<?php if (
														$project_image_effect == "image-move-up" || 
														$project_image_effect == "image-move-down" || 
														$project_image_effect == "image-move-left" || 
														$project_image_effect == "image-move-right"|| 
														$project_image_effect == "overlay-flip-hor"||
														$project_image_effect == "overlay-flip-ver"
														): ?>
															<?php if ($project_post_layout != "project-with-overlay-alt"): ?>
																<?php echo globax_enovathemes_project_image_overlay(get_the_ID(),$project_post_layout); ?>
															<?php endif ?>
															<div class="image-container">
																<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
															</div>
														<?php elseif($project_image_effect == "transform"): ?>
															<?php

																$project_link_output = get_the_permalink();

																if ($project_link_active == "true" && !empty($project_link)){
																	$project_link_output = $project_link;
																}
																
															?>
															<a href="<?php echo $project_link_output; ?>">
																<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
															</a>
														<?php else: ?>
															<?php if ($project_post_layout != "project-with-overlay-alt"): ?>
																<?php echo globax_enovathemes_project_image_overlay(get_the_ID(),$project_post_layout); ?>
															<?php endif ?>
															<div class="image-container">
																<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ,$post_img_attr); ?>
															</div>
														<?php endif ?>
													</div>
							        			<?php endif ?>
							        			<?php if ($project_post_layout == "project-with-details" || $project_post_layout == "project-with-caption"): ?>
							        				<div class="post-body et-clearfix">
														<div class="post-body-inner-wrap">
															<div class="post-body-inner">
																<div class="stylish-box-wrapper">
																	<div class="stylish-box">
																		<?php if ($project_post_layout == "project-with-details") : ?>
																			<div class="project-category stylish-dash">
																				<?php echo get_the_term_list( $post->ID, 'project-category', '', ', ', '' ); ?>
																			</div>
																		<?php endif ?>
																		<?php if ( '' != get_the_title() ): ?>
																			<h4 class="post-title">
																				<?php if ($project_link_active == "true"): ?>
																					<?php if (!empty($project_link)): ?>
																						<a href="<?php echo $project_link; ?>" target="_blank" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>" rel="bookmark">
																							<?php the_title(); ?>
																						</a>
																					<?php else: ?>
																						<a href="<?php the_permalink(); ?>" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>" rel="bookmark">
																							<?php the_title(); ?>
																						</a>
																					<?php endif ?>
																				<?php else: ?>
																					<a href="<?php the_permalink(); ?>" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>" rel="bookmark">
																						<?php the_title(); ?>
																					</a>	
																				<?php endif ?>
																			</h4>
																		<?php endif ?>
																	</div>
																	<div class="stylish-box">
																		<?php if ($project_link_active == "true"): ?>
																			<?php if (!empty($project_link)): ?>
																				<a class="stylish-button et-button small project-detail-button" href="<?php echo $project_link; ?>" target="_blank" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>" rel="bookmark">
																					<?php echo esc_html__("Details", 'enovathemes-addons'); ?>
																				</a>
																			<?php else: ?>
																				<a class="stylish-button et-button small project-detail-button" href="<?php the_permalink(); ?>" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>" rel="bookmark">
																					<?php echo esc_html__("Details", 'enovathemes-addons'); ?>
																				</a>
																			<?php endif ?>
																		<?php else: ?>
																			<a class="stylish-button et-button small project-detail-button" href="<?php the_permalink(); ?>" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>" rel="bookmark">
																				<?php echo esc_html__("Details", 'enovathemes-addons'); ?>
																			</a>	
																		<?php endif ?>
																	</div>
																</div>
															</div>
														</div>
													</div>
							        			<?php endif ?>
							        			<?php if ($project_post_layout == "project-with-overlay-alt"): ?>
							        				<?php 

							    						$project_link_url = get_the_permalink();

							    						if ($project_link_active == "true" && !empty($project_link)) {
							    							$project_link_url = $project_link;
							    						}
							    					
							    					?>

							        				<a href="<?php echo esc_url($project_link_url); ?>" class="stylish-line-box">

							        					
							        					<div class="stylish-line-wrapper">
								        					<div href="<?php echo esc_url($project_link); ?>" class="stylish-line" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>">
								        						<span class="stylish-line-ghost">
								        							<span class="stylish-line-ghost-before"></span>
									        						<span class="stylish-line-ghost-middle"></span>
									        						<span class="stylish-line-ghost-after"></span>
								        						</span>
																<div class="project-category stylish-subtitle">
																	<?php echo strip_tags(get_the_term_list( $post->ID, 'project-category', '', ', ', '' )); ?>
																</div>
																<?php if ( '' != get_the_title() ): ?>
																	<h4 class="post-title stylish-title"><?php the_title(); ?></h4>
																<?php endif ?>
															</div>
														</div>
							        				</a>

							        			<?php endif ?>
											</div>
										</article>
											
									<?php endwhile; ?>

									<?php wp_reset_postdata(); ?>
								</div>
							</div>
						</div>
					<?php endif ?>
				<?php endif ?>
			<?php endif ?>
		<?php endwhile; ?>
	<?php else : ?>
		<div class="container">
			<?php globax_enovathemes_not_found('project'); ?>
		</div>
	<?php endif; ?>
</div>