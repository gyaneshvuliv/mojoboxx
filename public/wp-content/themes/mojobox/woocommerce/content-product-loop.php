<?php
	globax_enovathemes_global_variables();
    $product_container   	  = (isset($GLOBALS['globax_enovathemes']['product-container']) && $GLOBALS['globax_enovathemes']['product-container']) ? $GLOBALS['globax_enovathemes']['product-container'] : "boxed";
	$product_sidebar          = (isset($GLOBALS['globax_enovathemes']['product-sidebar']) && $GLOBALS['globax_enovathemes']['product-sidebar']) ? $GLOBALS['globax_enovathemes']['product-sidebar'] : "none";
?>
<div class="container et-clearfix">
	<?php if ($product_container == "wide" && $product_sidebar != "none"): ?>
		<p class='post-message warning'><?php echo esc_html__('"Wide" shop container does not work with active shop sidebar. Please either set "Shop sidebar position" to "None" or switch "Shop container" to "Boxed"', 'globax'); ?></p>
	<?php else: ?>
		<?php if ($product_sidebar == "left"): ?>
			<div class="product-sidebar et-clearfix">
				<?php get_sidebar('shop'); ?>
			</div>
			<div class="product-content et-clearfix">
				<?php include( 'content-before-product-content.php' ); ?>
				<?php include( 'content-product-loop-code.php' ); ?>
			</div>
		<?php elseif ($product_sidebar == "right"): ?>
			<div class="product-content et-clearfix">
				<?php include( 'content-before-product-content.php' ); ?>
				<?php include( 'content-product-loop-code.php' ); ?>
			</div>
			<div class="product-sidebar et-clearfix">
				<?php get_sidebar('shop'); ?>
			</div>
		<?php else: ?>
			<?php include( 'content-before-product-content.php' ); ?>
			<?php include( 'content-product-loop-code.php' ); ?>
		<?php endif ?>
	<?php endif ?>
</div>
