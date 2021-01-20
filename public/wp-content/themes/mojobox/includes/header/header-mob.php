<header class="<?php echo esc_attr($mob_header_class); ?>">
	<div class="header-content">
		<?php if ($et_mob_header_top == "true"): ?>
			<div class="header-top">
				<div class="container et-clearfix">
					<?php if (isset($GLOBALS['globax_enovathemes']['header-top-slogan']) && !empty($GLOBALS['globax_enovathemes']['header-top-slogan'])): ?>
						<div class="slogan et-clearfix">
							<?php echo do_shortcode(wp_kses($GLOBALS['globax_enovathemes']['header-top-slogan'], wp_kses_allowed_html( 'post' ))); ?>
						</div>
					<?php endif ?>
					<?php if(isset($GLOBALS['globax_enovathemes']["header-top-button-url"]) && !empty($GLOBALS['globax_enovathemes']["header-top-button-url"])): ?>
						<a class="top-button" href="<?php echo esc_url($GLOBALS['globax_enovathemes']["header-top-button-url"]); ?>"><?php echo esc_attr($GLOBALS['globax_enovathemes']["header-top-button-text"]); ?></a>
					<?php endif; ?>
					<?php if ($et_header_top_social_links == "true"): ?>
						<div class="header-social-links et-clearfix">
							<?php include(get_parent_theme_file_path('/includes/social-links.php')); ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="header-body">
			<div class="header-logo-area">
				<div class="container">
					<?php if (!empty($et_mob_logo)): ?>
						<div class="logo logo-desk">
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
								<img class="mobile-logo" style="max-width:<?php echo esc_attr($et_mob_logo_w); ?>px;max-height:<?php echo esc_attr($et_mob_logo_h); ?>px;" src="<?php echo esc_url($et_mob_logo); ?>" alt="<?php bloginfo('name'); ?>">
							</a>
						</div>
					<?php else: ?>
						<div class="logo-title">
							<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
								<?php echo get_bloginfo('name') ?>
							</a>
						</div>
					<?php endif ?>
					<?php if ($et_navigation == "sidebar"): ?>
						<div class="mob-sidebar-toggle"><span></span></div>
					<?php elseif ($et_navigation == "fullscreen"): ?>
						<div class="mob-fullscreen-toggle"><span></span></div>
					<?php else: ?>
						<div class="mob-menu-toggle"><span></span></div>
					<?php endif ?>
					<?php if ($et_sidebar == "true" && $et_mob_header_sidebar == "true"): ?>
						<div class="mob-site-sidebar-toggle"></div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</header>