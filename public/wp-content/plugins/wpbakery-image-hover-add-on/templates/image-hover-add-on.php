<?php
ob_start();
?>
<figure <?php echo WPBakery_Image_Hover_Addon::attributes( 'image-hover-add-on' ); ?>>
	<img <?php echo WPBakery_Image_Hover_Addon::attributes( 'image-hover-image' ); ?> />
	<figcaption <?php echo WPBakery_Image_Hover_Addon::attributes( 'image-hover-figcaption' ); ?>>
		<?php
		if ( '' !== $this->args['title'] ) {
			?>
			<<?php echo $this->args['title_tag']; ?> <?php echo WPBakery_Image_Hover_Addon::attributes( 'image-hover-figtitle' ); ?>><?php echo $this->args['title']; ?></<?php echo $this->args['title_tag']; ?>>
			<?php
		}
		?>
		<?php
		if ( '' !== $this->args['description'] ) {
			?>
			<p <?php echo WPBakery_Image_Hover_Addon::attributes( 'image-hover-figdescription' ); ?>><?php echo $this->args['description']; ?></p>
			<?php
		}
		?>
	</figcaption>
	<?php
	if ( '' !== $this->args['link_url'] ) {
		$link        = vc_build_link( $this->args['link_url'] );
		$link_target = trim( $link['target'] );
		$link        = $link['url'];
		?>
		<a href="<?php echo esc_attr( $link ); ?>"></a>
		<?php
	}
	?>
</figure>
<div class="fusion-clearfix"></div>
<?php
$html = ob_get_clean();
