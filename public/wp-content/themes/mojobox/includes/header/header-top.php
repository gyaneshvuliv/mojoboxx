<?php if ($et_header_top == "true"): ?>
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
			<?php if(has_nav_menu("top-menu")): ?>
				<nav class="header-top-menu et-clearfix">
					<?php wp_nav_menu($toparg); ?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>