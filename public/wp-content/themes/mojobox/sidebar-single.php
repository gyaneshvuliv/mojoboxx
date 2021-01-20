<?php if(is_active_sidebar('blog-single-widgets')): ?>
	<div class='blog-single-widgets widget-area'>  
		<?php if ( function_exists( 'dynamic_sidebar' )){dynamic_sidebar('blog-single-widgets');} ?>
	</div>
<?php endif ?>	
