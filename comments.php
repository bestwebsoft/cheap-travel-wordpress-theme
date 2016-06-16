<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
} ?>
<article id="comments" class="cheap-travel-comments-area">
	<?php if ( have_comments() ) { ?>
		<h2 class="cheap-travel-comments-title">
			<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'cheap-travel' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?>
		</h2> <!-- END .cheap-travel-comments-title -->
		<ol class="cheap-travel-comment-list">
			<?php wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 55,
			) ); ?>
		</ol><!-- END .cheap-travel-comment-list -->
		<?php /* Are there comments to navigate through? */
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav class="cheap-travel-navigation comment-navigation" role="navigation">
				<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'cheap-travel' ); ?></h1>
				<div class="cheap-travel-nav-previous"><?php previous_comments_link( '&larr; ' . __( 'Older Comments', 'cheap-travel' ) ); ?></div>
				<div class="cheap-travel-nav-next"><?php next_comments_link( __( 'Newer Comments', 'cheap-travel' ) . ' &rarr;' ); ?></div>
			</nav><!-- END .cheap-travel-navigation -->
		<?php } /* Check for comment navigation */
		if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="cheap-travel-no-comments"><?php _e( 'Comments are closed.', 'cheap-travel' ); ?></p>
		<?php }
	} /* END have_comments() */
	comment_form(); ?>
</article><!-- END #cheap_travel_comments -->
