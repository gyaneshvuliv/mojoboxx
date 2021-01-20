<?php $sidebar_menu_color_reg = (isset($GLOBALS['globax_enovathemes']['sidebar-menu-color']['regular']) && !empty($GLOBALS['globax_enovathemes']['sidebar-menu-color']['regular'])) ? $GLOBALS['globax_enovathemes']['sidebar-menu-color']['regular'] : '#777777'; ?>
<aside class="<?php echo esc_attr($sidebar_class); ?>" data-color="<?php echo esc_attr($sidebar_menu_color_reg); ?>">
	<div class="mobile-sidebar-nav-toggle et-icon-close"></div>
	<?php if (!empty($et_sidebar_logo)): ?>
		<div class="logo logo-sidebar">
			<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
				<img class="normal-logo" style="max-width:<?php echo esc_attr($et_sidebar_logo_w); ?>px;max-height:<?php echo esc_attr($et_sidebar_logo_h); ?>px;" src="<?php echo esc_url($et_sidebar_logo); ?>" alt="<?php bloginfo('name'); ?>">
			</a>
		</div>
	<?php endif ?>
	<?php if(has_nav_menu("sidebar-menu")): ?>
		<nav class="sidebar-menu et-clearfix">
			<?php wp_nav_menu($sidebararg); ?>
		</nav>
	<?php endif; ?>
	<div class="sidebar-nav-bottom">
		<?php if (isset($GLOBALS['globax_enovathemes']['sidebar-copyright']) && !empty($GLOBALS['globax_enovathemes']['sidebar-copyright'])): ?>
			<?php echo wp_kses(do_shortcode($GLOBALS['globax_enovathemes']['sidebar-copyright']),wp_kses_allowed_html('post')); ?>
		<?php endif ?>
	</div>
</aside>