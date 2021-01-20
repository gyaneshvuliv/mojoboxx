<?php if ( post_password_required() ) {return;} ?>
<div id="comments" class="post-comments-area">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title stylish-dash"><?php printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'globax'), number_format_i18n( get_comments_number() )); ?></h3>

		<!-- cooment list start -->
		<div class="comment-list">
	        <?php

				function globax_enovathemes_comment( $comment, $args, $depth ) {

					$GLOBALS['comment'] = $comment;

					global $post;

					if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback'): ?>
						<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
							<div class="comment-body">
								<div class="comment-content">
									<?php echo esc_html__( 'Pingback:', 'globax'); ?> <?php comment_author_link(); ?> <?php edit_comment_link( esc_html__( 'Edit', 'globax' ), '<span class="edit-link">', '</span>' ); ?>
								</div>
							</div>
						<!-- </div> -->
					<?php else: ?>
						<?php globax_enovathemes_global_variables(); ?>
						<div <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
							<div class="comment-body">
								<?php if ( '0' == $comment->comment_approved ) : ?><p class="comment-awaiting-moderation"><?php esc_html__( 'Your comment is awaiting moderation.', 'globax'); ?></p><?php endif; ?>
								<?php if ("" !=  get_avatar($comment, 72)): ?>
									<div class="comment-gavatar"><?php echo get_avatar( $comment, 72 ); ?></div>
									<?php echo ( $comment->user_id === $post->post_author ) ? '<span class="post-author-ind">' . esc_html__( 'Post author', 'globax') . '</span>' : ''; ?>
								<?php endif ?>
								<div class="comment-content">
									<div class="comment-meta">
										<h5 class="comment-author stylish-dash"><?php printf( '<cite>%1$s</cite>', get_comment_author_link()); ?></h5>
										<div class="comment-date-time"><?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url( get_comment_link( $comment->comment_ID ) ), get_comment_time( 'c' ), sprintf( esc_html__( '%1$s at %2$s', 'globax'), get_comment_date(), get_comment_time() )); ?></div>
										<div class="replay"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => esc_html__( 'Reply', 'globax'), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
									</div>
									<div class="comment-text et-clearfix"><?php comment_text(); ?></div>
									<?php edit_comment_link( esc_html__( 'Edit', 'globax'), '<span class="edit-link">', '</span>' ); ?>
								</div>
							</div>
						<!-- </div> -->
					<?php endif; ?>
				<?php }

				wp_list_comments( array( 
					'callback' => 'globax_enovathemes_comment',
					'avatar_size' => 100,
					'short_ping'  => true,
					'style'       => 'div',
				) );

			?>
		</div>
		<!-- cooment list end -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

			<nav class="navigation comment-navigation" role="navigation">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'globax') ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'globax') ); ?></div>
			</nav>

		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<div class="container"><br><br><p><?php echo esc_html__( 'Comments are closed', 'globax'); ?></p></div>
		<?php endif; ?>

	<?php endif;?>

	<?php 

		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(
			'author' => '<p class="comment-form-author"><input class="enovathemes-placeholder" name="author" type="text" tabindex="1" placeholder="'.esc_attr__('Name *', 'globax').'" size="30" ' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email"><input class="enovathemes-placeholder" name="email" type="text" tabindex="2" placeholder="'.esc_attr__('E-Mail *', 'globax').'" size="30" ' . $aria_req . ' /></p>',
			'url' 	 => '<p class="comment-form-url"><input class="enovathemes-placeholder" name="url" type="text" tabindex="3" placeholder="'.esc_attr__('Website', 'globax').'" size="30" /></p>'
		);

		$comments_args = array(

			'comment_field'       => '<div class="et-clearfix"></div><p class="respond-textarea"><textarea id="comment" name="comment" aria-required="true" cols="58" rows="10" tabindex="4"></textarea></p>',
			'fields'              => $fields,
			'comment_notes_after' => '',
			'label_submit'        => esc_html__('Submit comment', 'globax')
		);

		comment_form($comments_args);

	?>

</div>