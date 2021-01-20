<?php globax_enovathemes_global_variables(); ?>
<?php if (is_shop()): ?>
	<?php include( 'content-product-loop-code-default.php' ); ?>
<?php endif ?>
<?php if (is_product_category()): ?>
	<?php include( 'content-product-loop-code-category.php' ); ?>
<?php endif ?>
<?php if (is_product_tag()): ?>
	<?php include( 'content-product-loop-code-default.php' ); ?>
<?php endif ?>



	
