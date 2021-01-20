<?php 
	$et_sidebar = array();

	for ($i=1; $i < 7; $i++) { 
		array_push($et_sidebar,'page-widgets-'.$i);
	}
?>
<?php foreach ($et_sidebar as $widget_area) { ?>
	<?php if(is_active_sidebar($widget_area)): ?>
		<div class='page-widgets widget-area'>  
			<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar($widget_area);} ?>
		</div>
	<?php endif ?>	
<?php } ?>