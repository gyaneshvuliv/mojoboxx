<?php

globax_enovathemes_global_variables();
$product_container   	      = (isset($GLOBALS['globax_enovathemes']['product-container']) && $GLOBALS['globax_enovathemes']['product-container']) ? $GLOBALS['globax_enovathemes']['product-container'] : "boxed";
$product_sidebar              = (isset($GLOBALS['globax_enovathemes']['product-sidebar']) && $GLOBALS['globax_enovathemes']['product-sidebar']) ? $GLOBALS['globax_enovathemes']['product-sidebar'] : "none";
$product_post_size   	      = (isset($GLOBALS['globax_enovathemes']['product-post-size']) && $GLOBALS['globax_enovathemes']['product-post-size']) ? $GLOBALS['globax_enovathemes']['product-post-size'] : "medium";
$product_post_layout          = (isset($GLOBALS['globax_enovathemes']['product-post-layout']) && $GLOBALS['globax_enovathemes']['product-post-layout']) ? $GLOBALS['globax_enovathemes']['product-post-layout'] : "product-with-details";

$product_animation_effect     = (isset($GLOBALS['globax_enovathemes']['product-animation-effect']) && $GLOBALS['globax_enovathemes']['product-animation-effect']) ? $GLOBALS['globax_enovathemes']['product-animation-effect'] : "none";
$product_navigation           = (isset($GLOBALS['globax_enovathemes']['product-navigation']) && $GLOBALS['globax_enovathemes']['product-navigation']) ? $GLOBALS['globax_enovathemes']['product-navigation'] : "pagination";

$product_quick_view       = (isset($GLOBALS['globax_enovathemes']['product-quick-view']) && $GLOBALS['globax_enovathemes']['product-quick-view'] == 1) ? "true" : "false";
$product_image_effect     = (isset($GLOBALS['globax_enovathemes']['product-image-effect']) && !empty($GLOBALS['globax_enovathemes']['product-image-effect'])) ? $GLOBALS['globax_enovathemes']['product-image-effect'] : "overlay-none";

$thumb_size             = 'globax_384X384';
$post_img_attr          = array();
$post_img_sizes         = '100vw';
$post_img_default_size  = $post_img_sizes;

if ($product_post_layout == "grid") {
	switch ($product_post_size) {
	    case 'small' :
        	$thumb_size            = 'globax_588X588';
			$post_img_default_size = '588px';
			$post_img_1024_size    = '588px';
			$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 384px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;
            break;
        case 'medium':
			$thumb_size            = ($product_container == "wide") ? 'globax_640X640' : 'globax_588X588';
			$post_img_default_size = ($product_container == "wide") ? '640px' : '588px';
			$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 588px, (max-width: 1023px) 384px, (max-width: 1279px) 384px, '.$post_img_default_size;
            break;
        case 'large':
			$thumb_size            = ($product_sidebar != "none") ? 'globax_588X588' : (($product_container == "wide") ? 'globax_960X600' : 'globax_588X588');
			$post_img_default_size = ($product_sidebar != "none") ? '588px' : (($product_container == "wide") ? '960px' : '588px');
			$post_img_1024_size    = ($product_sidebar != "none") ? '384px' : '588px';
			$post_img_sizes        = '(max-width: 319px) 92vw, (max-width: 479px) 384px, (max-width: 767px) 384px, (max-width: 1023px) 384px, (max-width: 1279px) '.$post_img_1024_size.', '.$post_img_default_size;
            break;
	}
}
?>
<?php if (have_posts()): ?>
	<ul id="loop-product" data-navigation="<?php echo esc_attr($product_navigation); ?>" class="loop-posts loop-product product-loop <?php echo esc_attr($product_image_effect); ?> effect-<?php echo esc_attr($product_animation_effect); ?> nav-<?php echo esc_attr($product_navigation); ?> et-item-set et-clearfix">
		<?php while (have_posts()) : the_post(); ?>
			<?php do_action( 'woocommerce_shop_loop' ); ?>
			<?php
				global $product;

				if ( empty( $product ) || ! $product->is_visible() ) {
					return;
				}
				
			?>
			<li class="grid-sizer"></li>
			<li <?php post_class('et-item product post') ?> id="post-<?php the_ID(); ?>" >

				<?php

					if (has_post_thumbnail()){

						if ( '' != the_title_attribute( 'echo=0' ) ){
							$post_img_attr['alt'] = the_title_attribute( 'echo=0' );
						}

						$post_img_original = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), "full" );
						$post_img_282  = get_the_post_thumbnail_url(get_the_ID(),'globax_282X282');
						$post_img_384  = get_the_post_thumbnail_url(get_the_ID(),'globax_384X384');
						$post_img_588  = get_the_post_thumbnail_url(get_the_ID(),'globax_588X588');
						$post_img_640  = get_the_post_thumbnail_url(get_the_ID(),'globax_640X400');
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

						if (strpos($post_img_960, '960x')) {
							$post_img_srcset .= ', '.$post_img_960.' 960w';
						}

						if (empty($post_img_srcset)) {
							$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
							$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
						}

						if ($product_post_layout == "masonry1" || $product_post_layout == "masonry2") {
							$thumb_size = 'full';
						}

						if (empty($post_img_srcset) || $product_post_layout == "masonry1" || $product_post_layout == "masonry2") {
							$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
							$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
						}

						$post_img_attr['srcset'] = $post_img_srcset;
						$post_img_attr['sizes']  = $post_img_sizes;
						
						
					}

				?>

				<div class="post-inner et-item-inner et-clearfix">
					<?php if (defined('YITH_WCWL')): ?>
						<?php  echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
					<?php endif ?>
					<?php $stock_status = $product->get_stock_status(); ?>
					<?php if ($stock_status == "outofstock"): ?>
						<div class="product-status outofstock"><span><?php echo esc_html__( 'Out of stock', 'globax' ) ?></span></div>
					<?php else: ?>
						<?php if ( $product->is_on_sale() ) : ?>
							<div class="product-status onsale"><span><?php echo esc_html__( 'Sale!', 'globax' ) ?></span></div>
						<?php endif;?>
					<?php endif ?>
					<div class="post-image post-media overlay-hover">

						<?php if (class_exists('YITH_WCQV_Frontend')): ?>

	                        <?php if (get_option('yith-wcqv-enable') == 'yes'): ?>

	                            <?php
	                                global $product;
	                                echo '<a href="#" class="button yith-wcqv-button product-single-button product-quick-view size-medium" data-product_id="' . $product->get_id() . '" title="'.esc_attr__("Product quick view", 'globax').'">' . esc_html__("Quick view", 'globax') . '</a>';
	                            ?>
	                        <?php endif ?>
	                    <?php endif ?>

						<?php if ($product_image_effect != "overlay-none"): ?>
							<?php echo globax_enovathemes_product_image_overlay(get_the_ID()); ?>
							<div class="image-container visible">
								<div class="image-loading"></div>
								<div class="image-preloader"></div>
							    <?php if (has_post_thumbnail()): ?>
							   		<?php echo wp_get_attachment_image(get_post_thumbnail_id( get_the_ID() ), $thumb_size,false,$post_img_attr); ?>
								<?php else: ?>
							   		<?php echo wc_placeholder_img($thumb_size); ?>
								<?php endif ?>
							</div>
						<?php else: ?>
							<a href="<?php the_permalink(); ?>" >
								<div class="product-image-gallery">
									<div class="image-container visible">
										<div class="image-loading"></div>
										<div class="image-preloader"></div>
										<?php if (has_post_thumbnail()): ?>
									   		<?php echo wp_get_attachment_image(get_post_thumbnail_id( get_the_ID() ), $thumb_size,false,$post_img_attr); ?>
										<?php else: ?>
									   		<?php echo wc_placeholder_img($thumb_size); ?>
										<?php endif ?>
									</div>
									<?php $product_gallery_ids = $product->get_gallery_image_ids(); ?>
									<?php if (is_array($product_gallery_ids) && !empty($product_gallery_ids)): ?>
										<?php foreach ($product_gallery_ids as $image_id): ?>
											<?php

												$post_img_original = wp_get_attachment_image_src( $image_id, "full" );
												$post_img_282  = wp_get_attachment_image_src($image_id,'globax_282X282');
												$post_img_384  = wp_get_attachment_image_src($image_id,'globax_384X384');
												$post_img_588  = wp_get_attachment_image_src($image_id,'globax_588X588');
												$post_img_640  = wp_get_attachment_image_src($image_id,'globax_640X400');
												$post_img_960  = wp_get_attachment_image_src($image_id,'globax_960X600');

												$post_img_srcset = "";

												if (strpos($post_img_282[0], '282x')) {
													$post_img_srcset .= $post_img_282[0].' 282w';
												}

												if (strpos($post_img_384[0], '384x')) {
													$post_img_srcset .= ', '.$post_img_384[0].' 384w';
												}

												if (strpos($post_img_588[0], '588x')) {
													$post_img_srcset .= ', '.$post_img_588[0].' 588w';
												}

												if (strpos($post_img_640[0], '640x')) {

													$post_img_srcset .= ', '.$post_img_640[0].' 640w';
												}

												if (strpos($post_img_960[0], '960x')) {
													$post_img_srcset .= ', '.$post_img_960[0].' 960w';
												}

												if ($product_post_layout == "masonry1" || $product_post_layout == "masonry2") {
													$thumb_size = 'full';
												}

												if (empty($post_img_srcset) || $product_post_layout == "masonry1" || $product_post_layout == "masonry2") {
													$post_img_srcset = $post_img_original[0].' '.$post_img_original[1].'w';
													$post_img_sizes  = '(max-width: 479px) 92vw, '.$post_img_original[1].'px';
												}

												$post_img_attr['srcset'] = $post_img_srcset;
												$post_img_attr['sizes']  = $post_img_sizes;
											?>
								            <?php echo wp_get_attachment_image($image_id,$thumb_size,false,$post_img_attr); ?>
										<?php endforeach ?>
									<?php endif ?>
								</div>
							</a>
						<?php endif ?>
					</div>
					<div class="post-body et-clearfix">
						<div class="post-body-inner-wrap">
							<div class="post-body-inner">
								<h4 class="post-title et-clearfix">
	        						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr__("Go to", 'globax').' '.the_title_attribute( 'echo=0' ); ?>"><?php the_title(); ?></a>
									<!-- Rating -->
									<?php 
										if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ) {
											$rating = $product->get_average_rating();
											$count  = 0;
											$html = 0 < $rating ? '<span class="star-rating">' . wc_get_star_rating_html( $rating, $count ) . '</span>' : '';
											echo apply_filters( 'woocommerce_product_get_rating_html', $html, $rating, $count );
										}
									?>
								</h4>
								<?php if ( $price_html = $product->get_price_html() ) : ?>
									<span class="price stylish-dash"><?php echo html_entity_decode($price_html); ?></span>
								<?php endif; ?>
								<!-- Add to cart -->
								<?php
									$product_type  = "simple";
									if($product->is_type( 'variable' )) {
										$product_type = "variable";
									} elseif ($product->is_type( 'grouped' )) {
										$product_type = "grouped";
									} elseif ($product->is_type( 'external' )) {
										$product_type = "external";
									}
									$product_class = 'button add_to_cart_button product-loop-button stylish-button';
									if(get_option( 'woocommerce_enable_ajax_add_to_cart' ) === "yes" && $product_type == "simple" && $product->get_stock_status() != "outofstock"){
										$product_class .=' ajax_add_to_cart';
									}

									echo apply_filters( 'woocommerce_loop_add_to_cart_link',
										sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" data-product_type="%s" data-product_status="%s" class="%s" title="%s" >%s</a>',
											esc_url( $product->add_to_cart_url() ),
											esc_attr( isset( $quantity ) ? $quantity : 1 ),
											esc_attr( $product->get_id() ),
											esc_attr( $product->get_sku() ),
											esc_attr( $product_type ),
											esc_attr( $product->get_stock_status() ),
											esc_attr( $product_class ),
											esc_html( $product->add_to_cart_text() ),
											esc_html( $product->add_to_cart_text() )
										),
									$product );
								?>
								<?php
									if(get_option( 'woocommerce_enable_ajax_add_to_cart' ) === "yes"){
										echo '<div class="ajax-add-to-cart-loading"><div class="circle-loader"><div class="checkmark draw"></div></div></div>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</li>
		<?php endwhile; ?>
	</ul>
<?php endif ?>