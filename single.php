<?php
/**
 * The template for displaying all single posts
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
get_header(); ?>
	<section class="cheap-travel-contents col-lg-8 col-md-12">
		<?php while ( have_posts() ) {
			the_post(); ?>
			<article id="cheap-travel-post-<?php the_ID(); ?>" <?php post_class( 'cheap-travel-post' ); ?>>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="cheap-travel-content-image">
						<?php do_action( 'cheap_travel_post_thumbnail' ); ?>
					</div> <!-- END .cheap-travel-content-image -->
				<?php } /* END has_post_thumbnail() */ ?>
				<header class="cheap-travel-page-header">
					<?php if ( has_post_format( 'link' ) ) {
						$content   = get_the_content();
						$linktoend = stristr( $content, 'http' );
						$afterlink = stristr( $linktoend, '>' );
						if ( ! strlen( $afterlink ) == 0 ) {
							$linkurl = substr( $linktoend, 0, - ( strlen( $afterlink ) + 1 ) );
						} else {
							$linkurl = $linktoend;
						} ?>
						<h3 class="cheap-travel-title">
							<a href="<?php echo $linkurl; ?>" target="_blank" rel="bookmark" title="<?php echo __( 'Permalink to', 'cheap-travel' ) . '&nbsp;';
							the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
					<?php } else { ?>
						<h3 class="cheap-travel-title"><?php the_title(); ?></h3>
					<?php } ?>
				</header><!-- END .cheap-travel-page-header -->
				<div id="cheap-travel-article-content" class="cheap-travel-content">
					<?php the_content( '' );
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'cheap-travel' ) . ':' . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>&nbsp;',
						'link_after'  => '&nbsp;</span>',
					) ); ?>
					<div class="cheap-travel-clear"></div>
					<footer class="cheap-travel-tags cheap-travel-single-tags">
						<?php cheap_travel_entry_meta();
						edit_post_link( __( 'Edit', 'cheap-travel' ), '<span class="cheap-travel-edit-link">', '</span>' );
						$content = $post->post_content;
						if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {
							$content = explode( $matches[0], $content, 2 );
							if ( ! empty( $matches[1] ) ) { ?>
								<a class="cheap-travel-read-more" href="<?php the_permalink() ?>"><?php _e( 'View more', 'cheap-travel' ) ?> &nbsp;&#062;</a>
							<?php }
						} ?>
					</footer> <!-- END .cheap-travel-tags -->
					<div class="cheap-travel-clear"></div>
					<small class="cheap-travel-top-link"><a href="#page"><?php _e( 'Top', 'cheap-travel' ); ?></a></small>
				</div> <!-- END .cheap-travel-content -->
			</article> <!-- END #cheap-travel-post -->
			<nav class="cheap-travel-navigation single-navigation">
				<div class="cheap-travel-next-post-link">
					<?php next_post_link( '%link', __( 'Next post', 'cheap-travel' ) ); ?>
				</div> <!-- END .cheap-travel-next-posts-link -->
				<div class="cheap-travel-previous-post-link">
					<?php previous_post_link( '%link', __( 'Previous post', 'cheap-travel' ) ); ?>
				</div> <!-- END .cheap-travel-previous-posts-link -->
			</nav> <!-- END .cheap-travel-navigation -->
			<div class="cheap-travel-clear"></div>
			<?php comments_template();
		} ?> <!-- END while -->
	</section> <!-- END .cheap-travel-contents -->
<?php get_sidebar();
get_footer();
