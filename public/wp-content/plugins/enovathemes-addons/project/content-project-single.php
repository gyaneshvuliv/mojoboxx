<?php
	globax_enovathemes_global_variables();

	$values = get_post_custom( get_the_ID() );
	$layout = isset( $values['layout'][0] ) ? esc_attr( $values["layout"][0] ) : "sidebar";

	$class = 'project-layout-single';
	$class .= ' project-layout-'.$layout; 
?>
<div id="et-content" class="content et-clearfix padding-false">
	<div class="<?php echo esc_attr($class); ?>">
		<?php include(ENOVATHEMES_ADDONS.'project/content-project-single-code.php'); ?>
	</div>
</div>