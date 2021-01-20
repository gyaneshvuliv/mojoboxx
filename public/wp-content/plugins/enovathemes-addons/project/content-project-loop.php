<?php
	globax_enovathemes_global_variables();

	$project_container        = (isset($GLOBALS['globax_enovathemes']['project-container']) && !empty($GLOBALS['globax_enovathemes']['project-container'])) ? $GLOBALS['globax_enovathemes']['project-container'] : "boxed";
	$project_post_size        = (isset($GLOBALS['globax_enovathemes']['project-post-size']) && !empty($GLOBALS['globax_enovathemes']['project-post-size'])) ? $GLOBALS['globax_enovathemes']['project-post-size'] : "medium";
	$project_post_layout      = (isset($GLOBALS['globax_enovathemes']['project-post-layout']) && !empty($GLOBALS['globax_enovathemes']['project-post-layout'])) ? $GLOBALS['globax_enovathemes']['project-post-layout'] : "project-with-details";
	$project_animation_effect = (isset($GLOBALS['globax_enovathemes']['project-animation-effect']) && !empty($GLOBALS['globax_enovathemes']['project-animation-effect'])) ? $GLOBALS['globax_enovathemes']['project-animation-effect'] : "none";
	$project_gap              = (isset($GLOBALS['globax_enovathemes']['project-gap']) && $GLOBALS['globax_enovathemes']['project-gap'] == 1) ? "true" : "false";

	$lazy_class   = ($project_animation_effect == "none") ? "lazy lazy-load" : "";

	$class = 'project-layout';
	$class .= ' project-container-'.$project_container;
	$class .= ' post-size-'.$project_post_size;
	$class .= ' gap-'.$project_gap;
	$class .= ' '.$project_post_layout;

?>
<div id="et-content" class="content et-clearfix padding-false">
	<div class="<?php echo esc_attr($class); ?> <?php echo $lazy_class; ?>">
		<div class="container et-clearfix">
			<?php include(ENOVATHEMES_ADDONS.'project/content-project-loop-code.php'); ?>
		</div>
	</div>
</div>