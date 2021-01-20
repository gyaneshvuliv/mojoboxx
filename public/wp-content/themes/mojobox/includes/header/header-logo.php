<?php if (!empty($et_logo)): ?>
	<div class="logo logo-desk">
		<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
			<img class="normal-logo" style="max-width:<?php echo esc_attr($et_logo_w); ?>px;max-height:<?php echo esc_attr($et_logo_h); ?>px;" src="<?php echo esc_url($et_logo); ?>" alt="<?php bloginfo('name'); ?>">
			<img class="sticky-logo" style="max-width:<?php echo esc_attr($et_logo_fixed_w); ?>px;max-height:<?php echo esc_attr($et_logo_fixed_h); ?>px;margin-top:-<?php echo esc_attr($et_logo_fixed_h/2); ?>px;margin-left:-<?php echo esc_attr($et_logo_fixed_w/2); ?>px" src="<?php echo esc_url($et_logo_fixed); ?>" alt="<?php bloginfo('name'); ?>">
		</a>
	</div>
<?php else: ?>
	<div class="logo-title">
		<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
			<?php echo get_bloginfo('name') ?>
		</a>
	</div>
<?php endif ?>