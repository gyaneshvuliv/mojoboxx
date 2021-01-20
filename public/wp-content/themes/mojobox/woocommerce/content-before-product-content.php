
<?php
	globax_enovathemes_global_variables();
	$product_ajax_filter = (isset($GLOBALS['globax_enovathemes']['product-filter']) && $GLOBALS['globax_enovathemes']['product-filter'] == 1) ? "true" : "false";
	$products_per_page   = (isset($GLOBALS['globax_enovathemes']['product-per-page']) && !empty($GLOBALS['globax_enovathemes']['product-per-page'])) ? $GLOBALS['globax_enovathemes']['product-per-page'] : get_option( 'posts_per_page' );
	$paged               = (get_query_var('page')) ? get_query_var('page') : 1;
?>
<?php if ($product_ajax_filter == "true" && (!is_product_category() && !is_product_tag() && !is_search()) && get_option( 'woocommerce_shop_page_display' ) != "subcategories" && get_option( 'woocommerce_shop_page_display' ) != "both"): ?>
	<?php do_action( 'woocommerce_archive_description' ); ?>
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
		$count_posts = wp_count_posts('product');
		$taxonomy  = 'product_cat'; 
		$tax_terms = get_terms($taxonomy);
	?>
	<?php if (count($tax_terms) != 0): ?>

		<div id="product-filter" data-posts-per-page="<?php echo esc_attr($products_per_page); ?>" class="et-product-filter enovathemes-filter button-group filter-button-group">
	        <div class="container">
	            <span data-link="<?php echo get_post_type_archive_link( 'product' ); ?>"  class="first-filter active filter" data-filter="*" data-count="<?php echo esc_attr($count_posts->publish); ?>"><?php echo esc_html__('Show All', 'globax'); ?></span>
            	<?php foreach(get_terms('product_cat',$args) as $filter_term): ?>
            		<?php
            			$filter_count    = $filter_term->count;
            			$filter_children = get_term_children( $filter_term->term_id, 'product_cat' );
            			if(is_array($filter_children) && !empty($filter_children)) {
            				foreach ($filter_children as $filter_child) {
            					$filter_child_obj = get_term($filter_child, 'product_cat');
            					$filter_count = $filter_count + $filter_child_obj->count;
            				}
            			}
            		?>
	                <span data-link="<?php echo esc_url(get_term_link($filter_term, 'product_cat')) ?>" class="filter" data-filter="<?php echo '.'.$filter_term->slug; ?>" data-count="<?php echo esc_attr($filter_count); ?>"><?php echo esc_html($filter_term->name); ?></span>
	            <?php endforeach; ?>
	        </div>
	    </div>
	<?php endif; ?>
<?php else: ?>
	<div class="before-loop-product et-clearfix"><?php do_action( 'woocommerce_before_shop_loop' ); ?></div>
	<?php do_action( 'woocommerce_archive_description' ); ?>
<?php endif ?>