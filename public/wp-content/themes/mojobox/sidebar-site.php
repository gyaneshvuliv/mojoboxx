<?php if(is_active_sidebar('sidebar-widgets')): ?>
	<div class='sidebar-widgets widget-area'>  
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('sidebar-widgets');} ?>
	</div>
<?php endif ?>	
