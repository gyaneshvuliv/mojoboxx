<?php if(is_active_sidebar('shop-single-widgets')): ?>
	<div class='shop-single-widgets widget-area'>  
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('shop-single-widgets');} ?>
	</div>
<?php endif ?>	
