<?php 
    globax_enovathemes_global_variables();

    $product_container            = (isset($GLOBALS['globax_enovathemes']['product-container']) && $GLOBALS['globax_enovathemes']['product-container']) ? $GLOBALS['globax_enovathemes']['product-container'] : "boxed";
    $product_post_size            = (isset($GLOBALS['globax_enovathemes']['product-post-size']) && $GLOBALS['globax_enovathemes']['product-post-size']) ? $GLOBALS['globax_enovathemes']['product-post-size'] : "medium";
    $product_category_post_size   = (isset($GLOBALS['globax_enovathemes']['product-category-post-size']) && $GLOBALS['globax_enovathemes']['product-category-post-size']) ? $GLOBALS['globax_enovathemes']['product-category-post-size'] : "medium";
    $product_post_layout          = (isset($GLOBALS['globax_enovathemes']['product-post-layout']) && $GLOBALS['globax_enovathemes']['product-post-layout']) ? $GLOBALS['globax_enovathemes']['product-post-layout'] : "product-with-details";
    $product_animation_effect     = (isset($GLOBALS['globax_enovathemes']['product-animation-effect']) && $GLOBALS['globax_enovathemes']['product-animation-effect']) ? $GLOBALS['globax_enovathemes']['product-animation-effect'] : "none";
    $product_sidebar              = (isset($GLOBALS['globax_enovathemes']['product-sidebar']) && $GLOBALS['globax_enovathemes']['product-sidebar']) ? $GLOBALS['globax_enovathemes']['product-sidebar'] : "none";

    $lazy_class   = ($product_animation_effect == "none") ? "lazy lazy-load" : "";

    $class = 'product-layout';
    $class .= ' product-container-'.$product_container;
    $class .= ' product-sidebar-'.$product_sidebar;
    $class .= ' post-size-'.$product_post_size;
    $class .= ' product-layout-'.$product_post_layout;
    $class .= ' '.$product_post_layout;
    $class .= ' category-post-size-'.$product_category_post_size;
?>
<?php get_header(); ?>
<?php get_template_part('/woocommerce/content-product-header'); ?>
<?php if (is_shop() || is_product_category() || is_product_tag()): ?>
    <div class="<?php echo esc_attr($class); ?> <?php echo esc_attr($lazy_class); ?>">
        <?php get_template_part('/woocommerce/content-product-loop'); ?>
    </div>
<?php endif ?>
<?php if (is_singular('product')): ?>
    <?php get_template_part('/woocommerce/content-product-single'); ?>
<?php endif ?>
<?php get_footer(); ?>