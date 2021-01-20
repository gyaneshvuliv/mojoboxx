<?php get_header(); ?>
<?php
    globax_enovathemes_global_variables();
?>
<div id="et-content" class="content et-clearfix padding-false">
    <div class="tech-layout">
        <div class="container et-clearfix">
            <div class="message404 et-clearfix">
                <div class="message404-content">
                    <h1 class="error404-default-title">40<span class="transform-error">4</span></h1>
                    <h3 class="error404-default-subtitle"><?php echo esc_html__('Page not found','globax'); ?></h3>
                    <p class="error404-default-description"><?php echo esc_html__('The page you are looking for could not be found.','globax'); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="error404-button et-button medium" title="<?php echo esc_attr__('Go to home','globax'); ?>"><?php echo esc_html__('Homepage','globax'); ?></a>
                </div>
            </div> 
        </div>
    </div>
</div>
<?php get_footer(); ?>
