<?php
    globax_enovathemes_global_variables();
    $project_title                        = (isset($GLOBALS['globax_enovathemes']['project-title']) && $GLOBALS['globax_enovathemes']['project-title'] == 1) ? "true" : "false";
    $project_title_back_img_attachment    = (isset($GLOBALS['globax_enovathemes']['project-title-back']['background-attachment']) && $GLOBALS['globax_enovathemes']['project-title-back']['background-attachment']) ? $GLOBALS['globax_enovathemes']['project-title-back']['background-attachment'] : 'scroll';
    $project_title_parallax               = (isset($GLOBALS['globax_enovathemes']['project-title-parallax']) && $GLOBALS['globax_enovathemes']['project-title-parallax'] == 1) ? "true" : "false";
    $project_title_overlay               = (isset($GLOBALS['globax_enovathemes']['project-title-overlay']) && $GLOBALS['globax_enovathemes']['project-title-overlay'] == 1) ? "true" : "false";
    $project_title_opacity                = (isset($GLOBALS['globax_enovathemes']['page-title-opacity']) && $GLOBALS['globax_enovathemes']['page-title-opacity'] == 1) ? "true" : "false";
    $project_title_text                   = (isset($GLOBALS['globax_enovathemes']['project-title-text']) && $GLOBALS['globax_enovathemes']['project-title-text']) ? $GLOBALS['globax_enovathemes']['project-title-text'] : '';
    $project_subtitle_text                = (isset($GLOBALS['globax_enovathemes']['project-subtitle-text']) && $GLOBALS['globax_enovathemes']['project-subtitle-text']) ? $GLOBALS['globax_enovathemes']['project-subtitle-text'] : '';
    
    $project_breadcrumbs                  = (isset($GLOBALS['globax_enovathemes']['project-breadcrumbs']) && $GLOBALS['globax_enovathemes']['project-breadcrumbs'] == 1) ? "true" : "false";

    $page_title_text_align     = (isset($GLOBALS['globax_enovathemes']['page-title-text-align']) && !empty($GLOBALS['globax_enovathemes']['page-title-text-align']) ) ? 'page-title-text-align-'.$GLOBALS['globax_enovathemes']['page-title-text-align'] : 'page-title-text-align-left';
    $page_title_text_align_mob = (isset($GLOBALS['globax_enovathemes']['mob-page-title-text-align']) && !empty($GLOBALS['globax_enovathemes']['mob-page-title-text-align']) ) ? 'mob-page-title-text-align-'.$GLOBALS['globax_enovathemes']['mob-page-title-text-align'] : 'mob-page-title-text-align-center';
    $et_fullscreen_navigation  = (isset($GLOBALS['globax_enovathemes']['fullscreen-navigation']) && $GLOBALS['globax_enovathemes']['fullscreen-navigation'] == 1) ? "true" : "false";
    $et_sidebar_navigation     = (isset($GLOBALS['globax_enovathemes']['sidebar-navigation']) && $GLOBALS['globax_enovathemes']['sidebar-navigation'] == 1) ? "true" : "false";
    $et_header_under_slider    = (isset($GLOBALS['globax_enovathemes']['header-under-slider']) && $GLOBALS['globax_enovathemes']['header-under-slider'] == 1) ? "true" : "false";
    $slider_settings           = get_option('archive_slider_settings');
    $slider                    = isset($slider_settings["project_slider_id"]) ? $slider_settings["project_slider_id"] : "none";

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
<?php if(shortcode_exists("rev_slider") && $slider != "none" && is_post_type_archive('project')): ?>
    <?php echo(do_shortcode('[rev_slider '.$slider.']')); ?>
    <?php if ($et_header_under_slider == "true" && $et_navigation == "default"): ?>
        <div class="revolution-slider-active">
            <?php include(get_template_directory().'/includes/header/header-desk.php'); ?>
        </div>
    <?php endif ?>
<?php else: ?>
    <?php if ($project_title != "false"): ?>
        <header class="rich-header project-header <?php echo $page_title_text_align; ?> <?php echo $page_title_text_align_mob; ?> breadcrumbs-<?php echo esc_attr($project_breadcrumbs); ?>" data-opacity="<?php echo $project_title_opacity; ?>" data-parallax="<?php echo esc_attr($project_title_parallax); ?>" data-overlay="<?php echo esc_attr($project_title_overlay); ?>" data-fixed="<?php echo esc_attr($project_title_parallax); ?>">
            <?php if ($project_title_parallax == "true"): ?>
                <div class="parallax-container">&nbsp;</div>
            <?php endif ?>
            <?php if ($project_title_back_img_attachment == "fixed"): ?>
                <div class="fixed-container">&nbsp;</div>
            <?php endif ?>
            <div class="container">
                <div class="rh-content et-clearfix">
                    <div class="rh-title">
                        <?php if (!empty($project_subtitle_text)): ?>
                            <p><?php echo esc_attr($project_subtitle_text); ?></p>
                            <div class="separator"></div>
                        <?php endif ?> 
                        <?php if (is_tax('project-category') || is_tax('project-tag')): ?>
                            <h1><?php echo single_cat_title("", false); ?></h1>
                        <?php else: ?>
                            <?php if (!empty($project_title_text)): ?>
                                <h1><?php echo esc_attr($project_title_text); ?></h1>
                            <?php else: ?>
                                <h1><?php echo esc_html__("Projects", 'enovathemes-addons'); ?></h1>
                            <?php endif ?>
                        <?php endif; ?>  
                    </div>
                </div>
            </div>
        </header>
        <?php if ($project_breadcrumbs == "true" && function_exists('enovathemes_addons_breadcrumbs')): ?>
            <div class="et-breadcrumbs"><div class="container"><?php enovathemes_addons_breadcrumbs(); ?></div></div>
        <?php endif ?>
    <?php endif ?>
<?php endif ?>