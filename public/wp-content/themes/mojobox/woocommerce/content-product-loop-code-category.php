<?php

	globax_enovathemes_global_variables();

	$product_navigation           = (isset($GLOBALS['globax_enovathemes']['product-navigation']) && $GLOBALS['globax_enovathemes']['product-navigation']) ? $GLOBALS['globax_enovathemes']['product-navigation'] : "pagination";
	$product_categories           = false;
	$product_animation_effect     = (isset($GLOBALS['globax_enovathemes']['product-animation-effect']) && $GLOBALS['globax_enovathemes']['product-animation-effect']) ? $GLOBALS['globax_enovathemes']['product-animation-effect'] : "none";
	$product_image_effect         = (isset($GLOBALS['globax_enovathemes']['product-image-effect']) && !empty($GLOBALS['globax_enovathemes']['product-image-effect'])) ? $GLOBALS['globax_enovathemes']['product-image-effect'] : "overlay-none";
?>
<?php if (have_posts()) : ?>
	<?php if (get_option( 'woocommerce_category_archive_display' ) == "subcategories" || get_option( 'woocommerce_category_archive_display' ) == "both"): ?>
		<?php
			$term      = get_queried_object();
			$parent_id = empty( $term->term_id ) ? 0 : $term->term_id;
			$product_categories = get_categories( apply_filters( 'woocommerce_product_subcategories_args', array(
	            'parent'       => $parent_id,
	            'menu_order'   => 'ASC',
	            'hide_empty'   => 0,
	            'hierarchical' => 1,
	            'taxonomy'     => 'product_cat',
	            'pad_counts'   => 1,
	        ) ) );
			if ( apply_filters( 'woocommerce_product_subcategories_hide_empty', true ) ) {
	            $product_categories = wp_list_filter( $product_categories, array( 'count' => 0 ), 'NOT' );
	        }
		?>
	<?php endif ?>
	<?php if ($product_categories && $parent_id): ?>
		<ul id="loop-product-category" class="loop-posts loop-product product-loop loop-product-category <?php echo esc_attr($product_image_effect); ?> effect-<?php echo esc_attr($product_animation_effect); ?> nav-<?php echo esc_attr($product_navigation); ?> et-item-set et-clearfix">
			<li class="grid-sizer"></li>
			<?php woocommerce_output_product_categories(array('parent_id'=>$parent_id)); ?>
		</ul>
		<?php if (get_option( 'woocommerce_category_archive_display' ) == "both"): ?>
			<?php include( 'content-product-loop-code-list.php' ); ?>
		<?php endif ?>
	<?php else: ?>
		<?php include( 'content-product-loop-code-list.php' ); ?>
		<div class="navigation-wraper <?php echo ($product_sidebar == "none" && $product_container === "wide") ? 'container-full' : ''; ?>">
			<?php include( 'content-product-loop-navigation.php' ); ?>
		</div>
	<?php endif ?>
<?php elseif ( ! woocommerce_output_product_categories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
	<?php do_action( 'woocommerce_no_products_found' ); ?>
<?php endif; ?>