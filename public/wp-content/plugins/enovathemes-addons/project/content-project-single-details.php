<?php
globax_enovathemes_global_variables();
$values 		      = get_post_custom( get_the_ID() );
$project_description  = isset( $values['project_description'][0] ) ? wp_kses( $values["project_description"][0],wp_kses_allowed_html('post')) : "";
$project_meta         = isset( $values['project_meta'][0] ) ? $values["project_meta"][0] : "";
$project_link         = isset( $values['project_link'][0] ) ? esc_url( $values["project_link"][0] ) : "";
$project_link_active  = isset( $values['project_link_active'][0] ) ? esc_attr( $values["project_link_active"][0] ) : "false";
$project_social_share = (isset($GLOBALS['globax_enovathemes']['project-single-social']) && $GLOBALS['globax_enovathemes']['project-single-social'] == 1) ? "true" : "false";
?>

<?php if (!empty($project_description)): ?>
	<div class="project-description">
		<h4 class="project-description-title stylish-dash">
			<?php echo esc_html__("Description", 'enovathemes-addons'); ?>
		</h4>	
		<?php echo $project_description; ?>
	</div>
<?php endif ?>
<?php if (!empty($project_meta)): ?>
	<div class="project-meta">
		<h4 class="project-meta-title stylish-dash">
			<?php echo esc_html__("Details", 'enovathemes-addons'); ?>
		</h4>	
		<ul>
			<li>
				<strong><?php echo esc_html__("Category:", 'enovathemes-addons'); ?></strong>
				<?php echo get_the_term_list( $post->ID, 'project-category', '', ', ', '' ); ?>
			</li>
			<?php
				$split = preg_split("/(\r?\n)+|(<br\s*\/?>\s*)+/",$project_meta);
				foreach($split as $haystack) {
		            echo  '<li>' . $haystack . '</li>';
		        }
			 ?>
			<?php if ($project_social_share == "true"): ?>
				<li>
					<strong><?php echo esc_html__("Share:", 'enovathemes-addons'); ?></strong>
					<?php if (function_exists('enovathemes_addons_post_social_share')): ?>
						<?php echo enovathemes_addons_post_social_share('project-social-share'); ?>
					<?php endif ?>
				</li>
			<?php endif ?>
		</ul>
		<?php if (!empty($project_link)): ?>
			<a href="<?php echo $project_link; ?>" class="project-link et-button stylish-button medium"><?php echo esc_html__('Launch project', 'enovathemes-addons'); ?></a>
		<?php endif ?>
	</div>
<?php endif ?>