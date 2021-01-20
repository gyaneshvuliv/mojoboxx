<header class="<?php echo esc_attr($fullscreen_class); ?>">
	<div class="header-search-modal">
		<div class="container">
			<?php get_search_form(); ?>
		</div>
	</div>
	<div class="container et-clearfix">
		<?php if (!empty($et_logo)): ?>
			<?php if ($et_fullscreen_logo_position == "center"): ?>
				<div class="logo logo-desk" style="margin-left:-<?php echo esc_attr($et_logo_w/2); ?>px;">
			<?php else: ?>
				<div class="logo logo-desk">
			<?php endif ?>
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
					<img class="normal-logo" style="max-width:<?php echo esc_attr($et_logo_w); ?>px;max-height:<?php echo esc_attr($et_logo_h); ?>px;" src="<?php echo esc_url($et_logo); ?>" alt="<?php bloginfo('name'); ?>">
					<img class="sticky-logo" style="max-width:<?php echo esc_attr($et_logo_fixed_w); ?>px;max-height:<?php echo esc_attr($et_logo_fixed_h); ?>px;margin-top:-<?php echo esc_attr($et_logo_fixed_h/2); ?>px;margin-left:-<?php echo esc_attr($et_logo_fixed_w/2); ?>px" src="<?php echo esc_url($et_logo_fixed); ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			</div>
		<?php endif ?>
		<div class="fullscreen-icons">
			<?php if (function_exists('icl_object_id')): ?>
				<?php if ($et_fullscreen_language_switcher == "true"): ?>
					<div class="language-switcher et-clearfix">
						<?php do_action('icl_language_selector'); ?>
					</div>
				<?php endif ?>
			<?php endif ?>
			<?php if ($et_header_shop_cart == "true"): ?>
				<?php if (class_exists('Woocommerce')): ?>
					<div class="desk-cart-wrap">
						<div class="cart-toggle"></div>
				        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr__('View your shopping cart', 'globax'); ?>">
			                <span class="cart-title"><?php echo esc_html__('Cart','globax'); ?></span>
			                <span class="cart-total"><?php echo html_entity_decode($GLOBALS['woocommerce']->cart->get_cart_total()); ?></span>
			                <span class="cart-info"><?php echo esc_attr($GLOBALS['woocommerce']->cart->cart_contents_count); ?></span>
			            </a>
				        <div class="woo-cart et-clearfix">
			                <?php
			                    if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
			                        echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' );
			                    } else {
			                        echo globax_enovathemes_get_the_widget( 'WooCommerce_Widget_Cart', 'title=Cart' );
			                    }
			                ?>
		            	</div>
					</div>
				<?php endif ?>
			<?php endif ?>
			<?php if ($et_fullscreen_search == "true"): ?>
				<div class="search-toggle"></div>
			<?php endif ?>
			<?php if ($et_fullscreen_social_links == "true"): ?>
				<div class="header-social-links menu-header-social-links et-clearfix">
					<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
				</div>
			<?php endif ?>
			<div class="fullscreen-toggle">
				<span></span>
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
</header>