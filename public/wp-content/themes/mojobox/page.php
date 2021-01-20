<?php get_header(); ?>
<!-- content start -->
<div id="et-content" class='content et-clearfix padding-true'>
	<?php do_action('globax_enovathemes_before_page_container'); ?>
	<div class='container'>
		<?php while ( have_posts() ) : the_post(); ?>
			<!-- post start -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<section class="page-content et-clearfix">
					<?php the_content(); ?>
					<?php
						$defaults = array(
							'before'           => '<div class="et-clearfix"></div><div id="page-links">',
							'after'            => '</div>',
							'link_before'      => '',
							'link_after'       => '',
							'next_or_number'   => 'next',
							'separator'        => ' ',
							'nextpagelink'     => esc_html__( 'Continue reading', 'globax' ),
							'previouspagelink' => esc_html__( 'Go back' , 'globax'),
							'pagelink'         => '%',
							'echo'             => 1
						);
						wp_link_pages($defaults);
					?>
				</section>
			</div>
			<!-- post end -->
		<?php endwhile; ?>
		<?php do_action('globax_enovathemes_after_page_body'); ?>
	</div>
	<?php do_action('globax_enovathemes_after_page_container'); ?>
</div>
<!-- content end -->
<?php get_footer(); ?>