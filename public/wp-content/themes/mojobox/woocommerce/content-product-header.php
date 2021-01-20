<?php
    globax_enovathemes_global_variables();
    $product_title                        = (isset($GLOBALS['globax_enovathemes']['product-title']) && $GLOBALS['globax_enovathemes']['product-title'] == 1) ? "true" : "false";
    $product_title_back_img_attachment    = (isset($GLOBALS['globax_enovathemes']['product-title-back']['background-attachment']) && $GLOBALS['globax_enovathemes']['product-title-back']['background-attachment']) ? $GLOBALS['globax_enovathemes']['product-title-back']['background-attachment'] : 'scroll';
    $product_title_parallax               = (isset($GLOBALS['globax_enovathemes']['product-title-parallax']) && $GLOBALS['globax_enovathemes']['product-title-parallax'] == 1) ? "true" : "false";
    $product_title_overlay               = (isset($GLOBALS['globax_enovathemes']['product-title-overlay']) && $GLOBALS['globax_enovathemes']['product-title-overlay'] == 1) ? "true" : "false";
    $product_title_opacity                = (isset($GLOBALS['globax_enovathemes']['page-title-opacity']) && $GLOBALS['globax_enovathemes']['page-title-opacity'] == 1) ? "true" : "false";
    $product_title_text                   = (isset($GLOBALS['globax_enovathemes']['product-title-text']) && $GLOBALS['globax_enovathemes']['product-title-text']) ? $GLOBALS['globax_enovathemes']['product-title-text'] : '';
    $product_subtitle_text                = (isset($GLOBALS['globax_enovathemes']['product-subtitle-text']) && $GLOBALS['globax_enovathemes']['product-subtitle-text']) ? $GLOBALS['globax_enovathemes']['product-subtitle-text'] : '';

    $product_breadcrumbs                  = (isset($GLOBALS['globax_enovathemes']['product-breadcrumbs']) && $GLOBALS['globax_enovathemes']['product-breadcrumbs'] == 1) ? "true" : "false";

    $page_title_text_align     = (isset($GLOBALS['globax_enovathemes']['page-title-text-align']) && !empty($GLOBALS['globax_enovathemes']['page-title-text-align']) ) ? 'page-title-text-align-'.$GLOBALS['globax_enovathemes']['page-title-text-align'] : 'page-title-text-align-left';
    $page_title_text_align_mob = (isset($GLOBALS['globax_enovathemes']['mob-page-title-text-align']) && !empty($GLOBALS['globax_enovathemes']['mob-page-title-text-align']) ) ? 'mob-page-title-text-align-'.$GLOBALS['globax_enovathemes']['mob-page-title-text-align'] : 'mob-page-title-text-align-left';
    $et_fullscreen_navigation  = (isset($GLOBALS['globax_enovathemes']['fullscreen-navigation']) && $GLOBALS['globax_enovathemes']['fullscreen-navigation'] == 1) ? "true" : "false";
    $et_sidebar_navigation     = (isset($GLOBALS['globax_enovathemes']['sidebar-navigation']) && $GLOBALS['globax_enovathemes']['sidebar-navigation'] == 1) ? "true" : "false";
    $et_header_under_slider    = (isset($GLOBALS['globax_enovathemes']['header-under-slider']) && $GLOBALS['globax_enovathemes']['header-under-slider'] == 1) ? "true" : "false";
    $slider_settings           = get_option('archive_slider_settings');
    $slider                    = isset($slider_settings["shop_slider_id"]) ? $slider_settings["shop_slider_id"] : "none";

    $et_navigation     = "default";

    if ($et_fullscreen_navigation == "true") {
        $et_navigation = "fullscreen";
    }

    if ($et_sidebar_navigation == "true") {
        $et_navigation = "sidebar";
    }

    if ($et_sidebar_navigation == "false" && $et_fullscreen_navigation == "false") {
        $et_navigation = "default";
    }

?>
<?php if(shortcode_exists("rev_slider") && $slider != "none" && is_shop()): ?>
    <?php echo(do_shortcode('[rev_slider '.$slider.']')); ?>
    <?php if ($et_header_under_slider == "true" && $et_navigation == "default"): ?>
        <div class="revolution-slider-active">
            <?php include(get_parent_theme_file_path('/includes/header/header-desk.php')); ?>
        </div>
    <?php endif ?>
<?php else: ?>
    <?php if ($product_title != "false"): ?>
        <header class="rich-header product-header <?php echo esc_attr($page_title_text_align); ?> <?php echo esc_attr($page_title_text_align_mob); ?> breadcrumbs-<?php echo esc_attr($product_breadcrumbs); ?>" data-opacity="<?php echo esc_attr($product_title_opacity); ?>" data-parallax="<?php echo esc_attr($product_title_parallax); ?>" data-overlay="<?php echo esc_attr($product_title_overlay); ?>" data-fixed="<?php echo esc_attr($product_title_parallax); ?>">
            <?php if ($product_title_parallax == "true"): ?>
                <div class="parallax-container">&nbsp;</div>
            <?php endif ?>
            <?php if ($product_title_back_img_attachment == "fixed"): ?>
                <div class="fixed-container">&nbsp;</div>
            <?php endif ?>
            <div class="container">
                <div class="rh-content et-clearfix">
                    <div class="rh-title">
                        <?php if (!empty($product_subtitle_text)): ?>
                            <p><?php echo esc_attr($product_subtitle_text); ?></p>
                            <div class="separator"></div>
                        <?php endif ?>
                        <?php if (is_product_category() || is_product_tag()): ?>
                            <h1><?php echo single_cat_title("", false); ?></h1>
                        <?php else: ?>
                            <?php
                                $wishlistpage    = "false";
                                $wishlistpage_id = get_option('yith_wcwl_wishlist_page_id');
                                if (defined('YITH_WCWL') && !empty($wishlistpage_id)) {
                                    $wishlistpage = (is_page(get_option('yith_wcwl_wishlist_page_id'))) ? "true" : "false"; 
                                }
                            ?>

                            <?php if ($wishlistpage == "true"): ?>
                                <?php $wishlist_title = (!empty(get_option('yith_wcwl_wishlist_title'))) ? get_option('yith_wcwl_wishlist_title') : esc_html__("Wishlist", 'globax'); ?>
                                <h1><?php echo esc_attr($wishlist_title); ?></h1>
                            <?php else: ?>
                                <?php if (!empty($product_title_text)): ?>
                                    <h1><?php echo esc_attr($product_title_text); ?></h1>
                                <?php else: ?>
                                    <h1><?php echo esc_html__("Product", 'globax'); ?></h1>
                                <?php endif ?>
                            <?php endif ?>
                        <?php endif; ?>                        
                    </div>
                </div>
            </div>
        </header>
        <?php if ($product_breadcrumbs == "true" && function_exists('enovathemes_addons_breadcrumbs')): ?>
            <div class="et-breadcrumbs"><div class="container"><?php enovathemes_addons_breadcrumbs(); ?></div></div>
        <?php endif ?>
    <?php endif ?>
<?php endif ?>