<?php include(get_parent_theme_file_path('/includes/header/header-opt.php')); ?>
<header data-stickyheight="<?php echo esc_attr($sticky_header_height); ?>" class="<?php echo esc_attr($header_class); ?>">
	<div class="header-content">
		<?php include(get_parent_theme_file_path('/includes/header/header-top.php')); ?>
		<div class="header-body">
			<div class="header-search-modal">
				<div class="container">
					<?php get_search_form(); ?>
				</div>
			</div>
			<?php if ($et_logo_position == "center"): ?>
				<?php if ($et_menu_under_logo == "true"): ?>
					<div class="container et-clearfix">
						<?php if ($et_menu_under_logo_boxed == "true" && $et_menu_under_logo_icons == "true"): ?>
							<?php if ($et_header_social_links == "true"): ?>
								<div class="header-social-links menu-header-social-links et-clearfix">
									<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
								</div>
							<?php endif ?>
						<?php endif ?>
						<?php include(get_parent_theme_file_path('/includes/header/header-logo.php')); ?>
						<?php if ($et_menu_under_logo_boxed == "true" && $et_menu_under_logo_icons == "true"): ?>
							<div class="menu-header-icons et-clearfix">
								<?php if ($et_sidebar == "true"): ?>
									<div class="sidebar-toggle et-icon-menu"></div>
								<?php endif ?>
								<?php if ($et_header_search == "true"): ?>
									<div class="search-toggle"></div>
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
							                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
						            	</div>
									</div>
								<?php endif ?>
								<?php endif ?>
							</div>
						<?php endif ?>
					</div>
					<div class="under-logo et-clearfix">
						<div class="container et-clearfix">
							<?php if(has_nav_menu("header-menu")): ?>
								<nav class="header-menu desk-menu et-clearfix">
									<?php wp_nav_menu($headerarg); ?>
								</nav>
							<?php endif; ?>
							<?php if ($et_menu_under_logo_icons == "false"): ?>
								<?php if (function_exists('icl_object_id')): ?>
									<?php if ($et_language_switcher == "true"): ?>
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
								                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
							            	</div>
										</div>
									<?php endif ?>
								<?php endif ?>
								<?php if ($et_header_search == "true"): ?>
									<div class="search-toggle"></div>
								<?php endif ?>
								<?php if ($et_header_social_links == "true"): ?>
									<div class="header-social-links menu-header-social-links et-clearfix">
										<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
									</div>
								<?php endif ?>
								<?php if ($et_sidebar == "true"): ?>
									<div class="sidebar-toggle et-icon-menu"></div>
								<?php endif ?>
							<?php endif ?>
						</div>
					</div>
				<?php else: ?>
					<div class="container et-clearfix">
						<div class="left-part et-clearfix">
							<?php if(has_nav_menu("header-menu-left")): ?>
								<nav class="header-menu header-menu-left desk-menu et-clearfix">
									<?php wp_nav_menu($headerarg_1); ?>
								</nav>
							<?php endif; ?>
							<?php if ($et_header_social_links == "true"): ?>
								<div class="header-social-links menu-header-social-links et-clearfix">
									<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
								</div>
							<?php endif ?>
						</div>
						<?php include(get_parent_theme_file_path('/includes/header/header-logo.php')); ?>
						<div class="right-part et-clearfix">

							<?php if ($et_full_header == 'true'): ?>

								<?php if ($et_sidebar == "true"): ?>
									<div class="sidebar-toggle et-icon-menu"></div>
								<?php endif ?>

								<?php if ($et_header_search == "true"): ?>
									<div class="search-toggle"></div>
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
								                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
							            	</div>
										</div>
									<?php endif ?>
								<?php endif ?>

								<?php if (function_exists('icl_object_id')): ?>
									<?php if ($et_language_switcher == "true"): ?>
										<div class="language-switcher et-clearfix">
											<?php do_action('icl_language_selector'); ?>
										</div>
									<?php endif ?>
								<?php endif ?>

								<?php if(has_nav_menu("header-menu-right")): ?>
									<nav class="header-menu header-menu-right desk-menu et-clearfix">
										<?php wp_nav_menu($headerarg_2); ?>
									</nav>
								<?php endif; ?>

							<?php else: ?>
								<?php if(has_nav_menu("header-menu-right")): ?>
									<nav class="header-menu header-menu-right desk-menu et-clearfix">
										<?php wp_nav_menu($headerarg_2); ?>
									</nav>
								<?php endif; ?>
								<?php if (function_exists('icl_object_id')): ?>
									<?php if ($et_language_switcher == "true"): ?>
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
								                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
							            	</div>
										</div>
									<?php endif ?>
								<?php endif ?>
								<?php if ($et_header_search == "true"): ?>
									<div class="search-toggle"></div>
								<?php endif ?>
								<?php if ($et_sidebar == "true"): ?>
									<div class="sidebar-toggle et-icon-menu"></div>
								<?php endif ?>
							<?php endif ?>

							
						</div>
					</div>
				<?php endif ?>
			<?php else: ?>
				<?php if ($et_menu_under_logo == "true"): ?>
					<div class="container et-clearfix">
						<div class="logo-area et-clearfix">
							<?php include(get_parent_theme_file_path('/includes/header/header-logo.php')); ?>
							<?php if(isset($GLOBALS['globax_enovathemes']["header-button-url"]) && !empty($GLOBALS['globax_enovathemes']["header-button-url"])): ?>
								<a class="header-button" href="<?php echo esc_url($GLOBALS['globax_enovathemes']["header-button-url"]); ?>">
									<?php if(isset($GLOBALS['globax_enovathemes']["header-button-icon"]) && !empty($GLOBALS['globax_enovathemes']["header-button-icon"])): ?>
										<span class="<?php echo esc_attr($GLOBALS['globax_enovathemes']["header-button-icon"]); ?>"></span>
									<?php endif; ?>
									<?php echo esc_attr($GLOBALS['globax_enovathemes']["header-button-text"]); ?>
								</a>
							<?php endif; ?>
							<?php if ($et_header_search == "true"): ?>
								<div class="header-search"><?php get_search_form(); ?></div>
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
							                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
						            	</div>
									</div>
								<?php endif ?>
							<?php endif ?>
							<?php if ($et_header_social_links == "true"): ?>
								<div class="header-social-links menu-header-social-links et-clearfix">
									<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
								</div>
							<?php endif ?>
							<?php if(isset($GLOBALS['globax_enovathemes']["header-slogan"]) && !empty($GLOBALS['globax_enovathemes']["header-slogan"])): ?>
								<div class="header-slogan et-clearfix">
									<?php echo do_shortcode(wp_kses($GLOBALS['globax_enovathemes']["header-slogan"], wp_kses_allowed_html( 'post' ))); ?>
								</div>
							<?php endif ?>
						</div>
					</div>
					<div class="under-logo et-clearfix">
						<div class="container et-clearfix">

							<?php if(has_nav_menu("header-menu")): ?>
								<nav class="header-menu desk-menu et-clearfix">
									<?php wp_nav_menu($headerarg); ?>
								</nav>
							<?php endif; ?>
							<?php if (function_exists('icl_object_id')): ?>
								<?php if ($et_language_switcher == "true"): ?>
									<div class="language-switcher et-clearfix">
										<?php do_action('icl_language_selector'); ?>
									</div>
								<?php endif ?>
							<?php endif ?>
							<?php if ($et_sidebar == "true"): ?>
								<div class="sidebar-toggle et-icon-menu"></div>
							<?php endif ?>
						</div>
					</div>
				<?php else: ?>
					<div class="container et-clearfix">
						<?php include(get_parent_theme_file_path('/includes/header/header-logo.php')); ?>

						<?php if ($et_menu_position == "center" && $et_no_logo == "true"): ?>

							<?php if(has_nav_menu("header-menu")): ?>
								<nav class="header-menu desk-menu et-clearfix">
									<?php wp_nav_menu($headerarg); ?>
								</nav>
							<?php endif; ?>

							<div class="header-elements-wrapper et-clearfix">
								<?php if ($et_sidebar == "true"): ?>
									<div class="sidebar-toggle et-icon-menu"></div>
								<?php endif ?>
								<?php if ($et_header_social_links == "true"): ?>
									<div class="header-social-links menu-header-social-links et-clearfix">
										<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
									</div>
								<?php endif ?>
								<?php if ($et_header_search == "true"): ?>
									<div class="search-toggle">
									</div>
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
								                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
							            	</div>
										</div>
									<?php endif ?>
								<?php endif ?>
								<?php if (function_exists('icl_object_id')): ?>
									<?php if ($et_language_switcher == "true"): ?>
										<div class="language-switcher et-clearfix">
											<?php do_action('icl_language_selector'); ?>
										</div>
									<?php endif ?>
								<?php endif ?>
							</div>

						<?php else: ?>

							<?php if ($et_sidebar == "true"): ?>
								<div class="sidebar-toggle et-icon-menu"></div>
							<?php endif ?>
							<?php if ($et_header_social_links == "true"): ?>
								<div class="header-social-links menu-header-social-links et-clearfix">
									<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
								</div>
							<?php endif ?>
							<?php if ($et_header_search == "true"): ?>
								<div class="search-toggle">
								</div>
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
							                <?php echo globax_enovathemes_get_the_widget( 'WC_Widget_Cart', 'title=Cart' ); ?>
						            	</div>
									</div>
								<?php endif ?>
							<?php endif ?>
							<?php if (function_exists('icl_object_id')): ?>
								<?php if ($et_language_switcher == "true"): ?>
									<div class="language-switcher et-clearfix">
										<?php do_action('icl_language_selector'); ?>
									</div>
								<?php endif ?>
							<?php endif ?>

							<?php if(has_nav_menu("header-menu")): ?>
								<nav class="header-menu desk-menu et-clearfix">
									<?php wp_nav_menu($headerarg); ?>
								</nav>
							<?php endif; ?>

						<?php endif ?>

						
						
					</div>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
</header>