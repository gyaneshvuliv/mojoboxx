<?php

	globax_enovathemes_global_variables();

	$blog_single_sidebar          = (isset($GLOBALS['globax_enovathemes']['blog-single-sidebar']) && $GLOBALS['globax_enovathemes']['blog-single-sidebar']) ? $GLOBALS['globax_enovathemes']['blog-single-sidebar'] : "none";

	$class = 'blog-layout-single';
	$class .= ' blog-single-sidebar-'.$blog_single_sidebar;

?>
<div id="et-content" class="content et-clearfix padding-false">
	<div class="<?php echo esc_attr($class); ?>">
		<div class="container et-clearfix">
			<?php get_template_part( '/includes/blog/content-blog-single-title-section' ); ?>
			<?php if ($blog_single_sidebar == "left"): ?>
				<div class="blog-sidebar blog-sidebar-single et-clearfix">
					<?php get_sidebar('single'); ?>
				</div>
				<div class="blog-content blog-content-single et-clearfix">
					<?php get_template_part( '/includes/blog/content-blog-single-code' ); ?>
				</div>
			<?php elseif ($blog_single_sidebar == "right"): ?>
				<div class="blog-content blog-content-single et-clearfix">
					<?php get_template_part( '/includes/blog/content-blog-single-code' ); ?>
				</div>
				<div class="blog-sidebar blog-sidebar-single et-clearfix">
					<?php get_sidebar('single'); ?>
				</div>
			<?php else: ?>
				<?php get_template_part( '/includes/blog/content-blog-single-code' ); ?>
			<?php endif ?>
		</div>
	</div>
</div>