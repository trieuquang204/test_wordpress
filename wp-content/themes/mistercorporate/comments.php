<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

			<h3>
			<?php
				comments_number( __( '0 REPLY', 'mistercorporate' ), __( '1 REPLY', 'mistercorporate' ), __( '% REPLIES', 'mistercorporate' ) ); ?> <?php esc_attr_e( 'TO', 'mistercorporate' ); ?> <?php the_title();
			?>
			</h3>


		<?php paginate_comments_links(); ?>

		<ul class="comment-list nsCommentUlClass">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 32,
					'callback'	  => 'mistercorporate_comm'
				) );
			?>
		</ul><!-- .comment-list -->

		<?php paginate_comments_links(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_attr_e( 'Comments are closed.', 'mistercorporate' ); ?></p>
	<?php endif; ?>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields =  array(

		  'author' =>
		    '<p class="firstLetAccaRow">' . __( 'Full Name:', 'mistercorporate' ) . ' ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '</p><input id="author" name="author" type="text" maxlength="245" value="' . esc_attr( $commenter['comment_author'] ) .
		    '" size="30"' . $aria_req . ' />',

		  'email' =>
		    '<p class="firstLetAccaRow">' . __( 'Email Address:', 'mistercorporate' ) . ' ' .
		    ( $req ? '<span class="required">*</span>' : '' ) .
		    '</p><input id="email" name="email" type="text" maxlength="100" value="' . esc_attr(  $commenter['comment_author_email'] ) .
		    '" size="30"' . $aria_req . ' />',

		  'url' =>
		    '<p class="firstLetAccaRow">' . __( 'Website:', 'mistercorporate' ) . '</p>' .
		    '<input id="url" name="url" type="text" maxlength="200" value="' . esc_attr( $commenter['comment_author_url'] ) .
		    '" size="30" />',
		);

		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'fields'			 =>  $fields,
			'class_submit'		 => 'btn btn-default contactPageSend',
			'label_submit'		 => __( 'SEND COMMENT', 'mistercorporate' ),
			'comment_field'		 => '<p class="firstLetAccaRow">' . _x( 'Comment:', 'Comment label', 'mistercorporate' ) . '</p><textarea id="comment" name="comment" rows="8" cols="45" aria-required="true"></textarea>'
		) );
	?>

</div><!-- .comments-area -->
