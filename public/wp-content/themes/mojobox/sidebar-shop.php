<?php if(is_active_sidebar('shop-widgets')): ?>
	<div class='shop-widgets widget-area'>  
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('shop-widgets');} ?>
	</div>
<?php endif ?>	
