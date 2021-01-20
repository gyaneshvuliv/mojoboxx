<?php
	globax_enovathemes_global_variables();
 	$blog_single_social  = (isset($GLOBALS['globax_enovathemes']['blog-single-social']) && $GLOBALS['globax_enovathemes']['blog-single-social'] == 1) ? "true" : "false";
 	$blog_related_posts  = (isset($GLOBALS['globax_enovathemes']['blog-related-posts']) && $GLOBALS['globax_enovathemes']['blog-related-posts'] == 1) ? "true" : "false";
	$post_img_attr       = array();
	$post_format         = get_post_format(get_the_ID());
	$values 		     = get_post_custom( get_the_ID() );
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
				    
?>
<div id="single-post-page" class="single-post-page format-<?php echo esc_attr($post_format); ?> featured-image-<?php echo esc_attr($featured_media); ?> social-links-<?php echo esc_attr($blog_single_social); ?>">
	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

				<?php
				
				    $post_audio_class  = "";

				    if(!empty($audio_embed) && empty($audio_ogg) && empty($audio_mp3)) {
				    	$post_audio_class = "embed-audio";
					} elseif (!empty($audio_ogg) || !empty($audio_mp3)) {
				    	$post_audio_class = "self-audio";
					}

				?>
				
				<div class="post-inner <?php echo esc_attr($post_audio_class); ?> et-clearfix">

					<div class="post-body et-clearfix">
						<div class="post-body-inner">
							<?php if ($post_format == "aside"): ?>
								<div class="format-container">
									<?php if ( '' != get_the_content() ): ?>
										<div class="post-excerpt">
											<?php
												the_content(sprintf(
													esc_html__( 'Continue reading %s', 'globax' ),
													the_title( '<span class="screen-reader-text">', '</span>', false )
												)); 
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
								</div>
							<?php elseif($post_format == "quote"): ?>
								<div class="format-container">
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
										<div class="post-quote-auther">- <?php echo esc_attr($quote_author); ?></div>
									<?php endif ?>
								</div>
							<?php elseif($post_format == "status"): ?>
								<div class="format-container">
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
										<div class="post-status-auther">- <?php echo esc_attr($status_author); ?></div>
									<?php endif ?>
								</div>
							<?php elseif($post_format == "link"): ?>
								<div class="format-container">
									<a class="post-link" href="<?php echo esc_url($link_url); ?>" target="_blank" ><?php echo esc_url($link_url); ?></a>
								</div>
							<?php else: ?>
								<?php if ( '' != get_the_content() ): ?>
									<div class="post-content et-clearfix">
										<?php the_content(); ?>
										<?php
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
							<?php endif ?>
							<?php if (has_tag()): ?>
								<div class="post-tags-single"><?php echo esc_html__("Tags:", 'globax'); ?> <?php the_tags('', ' ', ''); ?></div>
							<?php endif ?>
						</div>
						<?php if (function_exists('enovathemes_addons_post_social_share') && $blog_single_social == "true"): ?>
							<?php echo enovathemes_addons_post_social_share('post'); ?>
						<?php endif ?>
					</div>

				</div>

			</article>
			<?php if ($blog_related_posts == "true"): ?>
			<?php $terms = wp_get_post_tags(get_the_ID());?>
				<?php if ($terms): ?>

					<?php

						$tagids = array();
						foreach($terms as $tag) {$tagids[] = $tag->term_id;}

						$args = array(
							'post_type' => 'post',
							'tag__in'   => $tagids,
							'posts_per_page'      => 5000,
							'ignore_sticky_posts' => 1,
							'orderby'             => 'date',
							'post__not_in'        => array($post->ID)
						);

					    $related_posts = new WP_Query($args);

					?>

					<?php if ($related_posts->have_posts()): ?>
						<div class="related-posts-wrapper et-clearfix">
							<h3 class="related-posts-title stylish-dash"><?php echo esc_html__("Related posts", 'globax'); ?></h3>
							<div id="related-posts" data-columns="2" class="related-posts owl-carousel et-clearfix overlay-fade">
								<?php while($related_posts->have_posts()) : $related_posts->the_post(); ?>

									<article class="post format-<?php echo get_post_format(); ?> et-clearfix">
										<?php
											if (has_post_thumbnail()){

												if ( '' != the_title_attribute( 'echo=0' ) ){
													$post_img_attr['alt'] = the_title_attribute( 'echo=0' );
												}

												$post_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
												$post_img_588      = get_the_post_thumbnail_url(get_the_ID(),'globax_588X440');

												$post_img_srcset = "";
								                $post_img_sizes  = '(max-width: 479px) 92vw, 588px';

												if (strpos($post_img_588, '588x')) {
													$post_img_srcset .= $post_img_588.' 588w';
												} else {
													$post_img_srcset .= $post_img_original[0].' '.$post_img_original[1].'w';
													$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
												}

												$post_img_attr['srcset'] = $post_img_srcset;
												$post_img_attr['sizes']  = $post_img_sizes;
											}
										?>
										<div class="post-inner et-item-inner et-clearfix">
											<?php if (has_post_thumbnail()): ?>
												<div class="post-image overlay-hover post-media">
													<?php echo globax_enovathemes_post_image_overlay(get_the_ID()); ?>
													<?php echo get_the_post_thumbnail( get_the_ID(), 'globax_588X440' ,$post_img_attr); ?>
												</div>
											<?php endif ?>
											<div class="post-body et-clearfix">
												<div class="post-body-inner-wrap">
													<div class="post-body-inner">
														<div class="post-meta et-clearfix">
															<?php if ('' != get_the_category_list()): ?>
																<div class="post-category"><?php echo get_the_category_list(', '); ?></div>
															<?php endif ?>
															<div class="post-date-inline"><?php echo get_the_date('F Y'); ?></div>
														</div>
														<?php if ( '' != the_title_attribute( 'echo=0' ) ): ?>
															<h5 class="post-title">
																<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Read more about", 'globax').' '.the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
																	<?php the_title(); ?>
																</a>
															</h5>
														<?php endif ?>
													</div>
												</div>
											</div>
										</div>
									</article>
										
								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div>
						</div>
					<?php endif ?>
					
				<?php endif ?>
			<?php endif ?>
			<div class="post-comments-section">
				<?php comments_template(); ?>
			</div>
		<?php endwhile; ?>

	<?php else : ?>

		<?php globax_enovathemes_not_found('post'); ?>

	<?php endif; ?>
</div>