<?php
	globax_enovathemes_global_variables();
	$project_post_layout  	      = (isset($GLOBALS['globax_enovathemes']['project-post-layout']) && !empty($GLOBALS['globax_enovathemes']['project-post-layout'])) ? $GLOBALS['globax_enovathemes']['project-post-layout'] : "project-with-details";
	$project_post_layout_type  	  = (isset($GLOBALS['globax_enovathemes']['project-post-layout-type']) && !empty($GLOBALS['globax_enovathemes']['project-post-layout-type'])) ? $GLOBALS['globax_enovathemes']['project-post-layout-type'] : "grid";
    $project_container   	      = (isset($GLOBALS['globax_enovathemes']['project-container']) && !empty($GLOBALS['globax_enovathemes']['project-container'])) ? $GLOBALS['globax_enovathemes']['project-container'] : "boxed";
    $project_post_size   	      = (isset($GLOBALS['globax_enovathemes']['project-post-size']) && !empty($GLOBALS['globax_enovathemes']['project-post-size'])) ? $GLOBALS['globax_enovathemes']['project-post-size'] : "medium";
	$project_animation_effect     = (isset($GLOBALS['globax_enovathemes']['project-animation-effect']) && !empty($GLOBALS['globax_enovathemes']['project-animation-effect'])) ? $GLOBALS['globax_enovathemes']['project-animation-effect'] : "none";
	$project_navigation           = (isset($GLOBALS['globax_enovathemes']['project-navigation']) && !empty($GLOBALS['globax_enovathemes']['project-navigation'])) ? $GLOBALS['globax_enovathemes']['project-navigation'] : "pagination";
	$project_navigation_alignment = (isset($GLOBALS['globax_enovathemes']['project-navigation-alignment']) && !empty($GLOBALS['globax_enovathemes']['project-navigation-alignment'])) ? $GLOBALS['globax_enovathemes']['project-navigation-alignment'] : "center";
	
	$project_image_effect         = "overlay-fade";
	$project_image_effect_details = (isset($GLOBALS['globax_enovathemes']['project-image-effect-details']) && !empty($GLOBALS['globax_enovathemes']['project-image-effect-details'])) ? $GLOBALS['globax_enovathemes']['project-image-effect-details'] : "overlay-fade";
	$project_image_effect_caption = (isset($GLOBALS['globax_enovathemes']['project-image-effect-caption']) && !empty($GLOBALS['globax_enovathemes']['project-image-effect-caption'])) ? $GLOBALS['globax_enovathemes']['project-image-effect-caption'] : "caption-up";
	$project_image_effect_overlay = (isset($GLOBALS['globax_enovathemes']['project-image-effect-overlay']) && !empty($GLOBALS['globax_enovathemes']['project-image-effect-overlay'])) ? $GLOBALS['globax_enovathemes']['project-image-effect-overlay'] : "overlay-fade";

	$link_before = '';
	$link_after  = '';

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

	$project_ajax_filter = (isset($GLOBALS['globax_enovathemes']['project-filter']) && $GLOBALS['globax_enovathemes']['project-filter'] == 1) ? "true" : "false";
	$projects_per_page   = (isset($GLOBALS['globax_enovathemes']['project-per-page']) && !empty($GLOBALS['globax_enovathemes']['project-per-page'])) ? $GLOBALS['globax_enovathemes']['project-per-page'] : get_option( 'posts_per_page' );
    $paged               = (get_query_var('page')) ? get_query_var('page') : 1;

    $thumb_size      = 'globax_588X440';
	$post_img_attr   = array();
	$post_img_sizes  = '100vw';
	$post_img_default_size  = $post_img_sizes;

    switch ($project_post_size) {
        case 'small' :
			$thumb_size            = 'globax_588X440';
			$post_img_default_size = '588px';
			$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) '.$post_img_default_size.', (max-width: 767px) '.$post_img_default_size.', (max-width: 1023px) '.$post_img_default_size.', (max-width: 1279px) '.$post_img_default_size.', '.$post_img_default_size;
            break;
        case 'medium':
			$thumb_size            = ($project_container == "wide") ? 'globax_640X400' : 'globax_588X440';
			$post_img_default_size = ($project_container == "wide") ? '640px' : '588px';
			$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) '.$post_img_default_size.', (max-width: 767px) '.$post_img_default_size.', (max-width: 1023px) '.$post_img_default_size.', (max-width: 1279px) '.$post_img_default_size.', '.$post_img_default_size;
            break;
        case 'large':
			$thumb_size            = ($project_container == "wide") ? 'globax_960X600' : 'globax_588X440';
			$post_img_default_size = ($project_container == "wide") ? '960px' : '588px';
			$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) '.$post_img_default_size.', (max-width: 767px) '.$post_img_default_size.', (max-width: 1023px) '.$post_img_default_size.', (max-width: 1279px) '.$post_img_default_size.', '.$post_img_default_size;
            break;
    }

?>
<?php if (have_posts()) : ?>
	<?php if ($project_ajax_filter == "true" && !is_tax()): ?>
		<?php
			$args = array(
			    'orderby'           => 'name', 
			    'order'             => 'ASC',
			    'hide_empty'        => true, 
			    'exclude'           => array(), 
			    'exclude_tree'      => array(), 
			    'number'            => '', 
			    'fields'            => 'all', 
			    'slug'              => '', 
			    'parent'            => '',
			    'hierarchical'      => false, 
			    'child_of'          => 0, 
			    'get'               => '', 
			    'name__like'        => '',
			    'description__like' => '',
			    'pad_counts'        => false, 
			    'offset'            => '', 
			    'search'            => '', 
			    'cache_domain'      => 'core'
			);
			$count_posts = wp_count_posts('project');
			$taxonomy  = 'project-category'; 
			$tax_terms = get_terms($taxonomy);
		?>
		<?php if (count($tax_terms) != 0): ?>

			<div id="project-filter" data-posts-per-page="<?php echo $projects_per_page; ?>" class="et-project-filter enovathemes-filter button-group filter-button-group">
		        <div class="container">
		            <span data-link="<?php echo get_post_type_archive_link( 'project' ); ?>"  class="first-filter active filter" data-filter="*" data-count="<?php echo $count_posts->publish ?>"><?php echo esc_html__('Show All', 'enovathemes-addons'); ?></span>
	            	<?php foreach(get_terms('project-category',$args) as $filter_term): ?>
	            		<?php
	            			$filter_count    = $filter_term->count;
	            			$filter_children = get_term_children( $filter_term->term_id, 'project-category' );
	            			if(is_array($filter_children) && !empty($filter_children)) {
	            				foreach ($filter_children as $filter_child) {
	            					$filter_child_obj = get_term($filter_child, 'project-category');
	            					$filter_count = $filter_count + $filter_child_obj->count;
	            				}
	            			}
	            		?>
		                <span data-link="<?php echo esc_url(get_term_link($filter_term, 'project-category')) ?>" class="filter" data-filter="<?php echo '.'.$filter_term->slug; ?>" data-count="<?php echo $filter_count; ?>"><?php echo $filter_term->name; ?></span>
		            <?php endforeach; ?>
		        </div>
		    </div>

		<?php endif; ?>
	<?php endif ?>
	<div id="loop-project" data-navigation="<?php echo $project_navigation; ?>" class="loop-posts loop-project <?php echo $project_image_effect; ?> effect-<?php echo $project_animation_effect; ?> nav-<?php echo $project_navigation; ?> et-item-set et-clearfix">
		<div class="grid-sizer"></div>
		<?php while (have_posts()) : the_post(); ?>

			<?php

				$values 		     = get_post_custom( get_the_ID() );
			    $project_link        = isset( $values['project_link'][0] ) ? $values["project_link"][0] : "";
			    $project_link_active = isset( $values['project_link_active'][0] ) ? $values["project_link_active"][0] : "false";
				$project_width       = isset( $values['project_width'] ) ? esc_attr( $values['project_width'][0] ) : "";
				$project_content_direction = isset( $values['project_content_direction'] ) ? esc_attr( $values['project_content_direction'][0] ) : "";

				if (empty($project_width)) {
					switch ($project_post_size) {
						case 'small':
							$project_width = '25';
							break;
						case 'medium':
							$project_width = '30';
							break;
						case 'large':
							$project_width = '50';
							break;
					}
				}

				$stylish_class = 'et-item post';

				if ($project_post_layout == "project-with-overlay-alt") {
					$stylish_class = 'et-item post stylish-hover';
					$stylish_class .= ' '.$project_content_direction;
				}

			?>

			<article <?php post_class($stylish_class) ?> data-width="<?php echo $project_width; ?>" id="post-<?php the_ID(); ?>">

				<?php

					if (has_post_thumbnail()){

						if ( '' != get_the_title() ){
							$post_img_attr['alt'] = esc_html(get_the_title());
						}

						$post_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
						$post_img_588  = get_the_post_thumbnail_url(get_the_ID(),'globax_588X440');
						$post_img_640  = get_the_post_thumbnail_url(get_the_ID(),'globax_640X400');
						$post_img_960  = get_the_post_thumbnail_url(get_the_ID(),'globax_960X600');

						$post_img_srcset = "";

						if (strpos($post_img_588, '588x')) {

							$post_img_srcset .= ', '.$post_img_588.' 588w';
						}

						if (strpos($post_img_640, '640x')) {

							$post_img_srcset .= ', '.$post_img_640.' 640w';
						}

						if (strpos($post_img_960, '960x')) {
							$post_img_srcset .= ', '.$post_img_960.' 960w';
						}

						if ($project_post_layout_type == "masonry2") {
							$thumb_size = 'full';
						}

						if (empty($post_img_srcset) || $project_post_layout_type == "masonry2") {
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
									<div class="image-loading"></div>
									<div class="image-preloader"></div>
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
									<div class="image-loading"></div>
									<div class="image-preloader"></div>
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

        				<a href="<?php echo esc_url($project_link_url); ?>" class="stylish-line-box" title="<?php echo esc_html__("Read more about", 'enovathemes-addons').' '.get_the_title(); ?>">

        					
        					<div class="stylish-line-wrapper">
	        					<div class="stylish-line">
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
	</div>
<?php else : ?>
	<?php globax_enovathemes_not_found('project'); ?>
<?php endif; ?>
<div class="navigation-wraper">
	<?php if ($project_navigation == 'pagination'): ?>
		<?php globax_enovathemes_post_nav_num('project',$project_navigation_alignment); ?>
	<?php elseif($project_navigation == 'loadmore'): ?>
		<div class="ajax-container <?php echo $project_navigation_alignment; ?>">
			<div id="project-ajax-loader" class="et-ajax-loader"><?php echo esc_html__("Load more", "globax"); ?></div>
			<div id="project-ajax-error" class="et-ajax-error"><?php echo esc_html__("Something went wrong, please try again later or contact the site administrator", "globax"); ?></div>
		</div>
	<?php else: ?>
		<div class="ajax-container <?php echo $project_navigation_alignment; ?>">
			<div id="project-ajax-scroll" class="et-ajax-scroll"></div>
			<div id="project-ajax-scroll-status" class="et-ajax-scroll-status"></div>
			<div id="project-ajax-error" class="et-ajax-error"><?php echo esc_html__("Something went wrong, please try again later or contact the site administrator", "globax"); ?></div>
		</div>
	<?php endif ?>
</div>