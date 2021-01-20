<?php
globax_enovathemes_global_variables();
$under_construction           = (isset($GLOBALS['globax_enovathemes']['under-construction']) && $GLOBALS['globax_enovathemes']['under-construction'] == 1) ? "true" : "false";
$et_under_construction_logo   = (isset($GLOBALS['globax_enovathemes']['under-construction-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['under-construction-logo']['url'])) ? esc_url($GLOBALS['globax_enovathemes']['under-construction-logo']['url']) : "";
$et_under_construction_logo_w = (isset($GLOBALS['globax_enovathemes']['under-construction-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['under-construction-logo']['url'])) ? $GLOBALS['globax_enovathemes']['under-construction-logo']['width']: "";
$et_under_construction_logo_h = (isset($GLOBALS['globax_enovathemes']['under-construction-logo']['url']) && !empty($GLOBALS['globax_enovathemes']['under-construction-logo']['url'])) ? $GLOBALS['globax_enovathemes']['under-construction-logo']['height'] : "";
if (isset($GLOBALS['globax_enovathemes']['under-construction-logo-retina']['url']) && !empty($GLOBALS['globax_enovathemes']['under-construction-logo-retina']['url'])) 
{$et_under_construction_logo  = esc_url($GLOBALS['globax_enovathemes']['under-construction-logo-retina']['url']);}
?>
<?php if ($under_construction == "true"): ?>
	<div class="under-construction">
		<div class="under-construction-content">
			<?php if (!empty($et_under_construction_logo)): ?>
				<div class="logo under-construction-logo">
					<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
						<img style="max-width:<?php echo esc_attr($et_under_construction_logo_w); ?>px;max-height:<?php echo esc_attr($et_under_construction_logo_h); ?>px;" src="<?php echo esc_url($et_under_construction_logo); ?>" alt="<?php bloginfo('name'); ?>">
					</a>
				</div>
			<?php endif ?>
			<?php if (isset($GLOBALS['globax_enovathemes']['under-construction-slogan']) && !empty($GLOBALS['globax_enovathemes']['under-construction-slogan'])): ?>
				<div class="under-construction-slogan et-clearfix">
					<?php echo do_shortcode(wp_kses($GLOBALS['globax_enovathemes']['under-construction-slogan'], wp_kses_allowed_html( 'post' ))); ?>
				</div>
			<?php endif ?>
		</div>
	</div>
<?php endif ?>