<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
get_header(); ?>
	<section class="cheap-travel-contents col-lg-8 col-md-12">
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post(); ?>
				<article id="cheap-travel-post-<?php the_ID(); ?>" <?php post_class( 'cheap-travel-post' ); ?>>
					<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
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
							<h3 class="cheap-travel-title">
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo __( 'Permalink to', 'cheap-travel' ) . '&nbsp;';
								the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h3>
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
						<footer class="cheap-travel-tags">
							<?php cheap_travel_entry_meta();
							edit_post_link( __( 'Edit', 'cheap-travel' ), '<span class="cheap-travel-edit-link">', '</span>' );
							$content = $post->post_content;
							if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {
								$content = explode( $matches[0], $content, 2 );
								if ( ! empty( $matches[1] ) ) { ?>
									<a class="cheap-travel-read-more" href="<?php the_permalink() ?>"><?php _e( 'View more', 'cheap-travel' ) ?> &nbsp;&#062;</a>
								<?php }
							} /* Outputs the processed value to the page */ ?>
						</footer> <!-- END .cheap-travel-tags -->
						<div class="cheap-travel-clear"></div>
						<small class="cheap-travel-top-link"><a href="#page"><?php _e( 'Top', 'cheap-travel' ); ?></a></small>
					</div> <!-- END .cheap-travel-content -->
				</article> <!-- END #cheap-travel-post -->
			<?php } /*  END while have_posts() */
			/* Previous/next page navigation. */
			the_posts_pagination( array(
				'prev_text'          => '<span class="genericon genericon-previous"></span>',
				'next_text'          => '<span class="genericon genericon-next"></span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">&nbsp;',
				'after_page_number'  => '&nbsp;</span>',
			) ); ?>
			<div class="cheap-travel-clear"></div>
		<?php } else { ?>
			<article class="cheap-travel-post">
				<header class="cheap-travel-page-header">
					<h3 class="cheap-travel-title"><?php _e( 'Nothing Found', 'cheap-travel' ); ?></h3>
				</header><!-- END .cheap-travel-page-header -->
				<div id="cheap-travel-article-content" class="cheap-travel-content">
					<!-- If no content, include the "No posts found" template. -->
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
						<p><?php printf( __( 'Ready to publish your first post?', 'cheap-travel' ) . ' <a href="%1$s">' . __( 'Get started here', 'cheap-travel' ) . '</a>', admin_url( 'post-new.php' ) ); ?></p>
					<?php } elseif ( is_search() ) { ?>
						<p><?php _e( 'Sorry, but nothing matches your search terms. Please try again using different keywords.', 'cheap-travel' ); ?></p>
						<?php get_search_form();
					} else { ?>
						<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'cheap-travel' ); ?></p>
						<?php get_search_form();
					} ?>
				</div> <!-- END .cheap-travel-content -->
			</article> <!-- END .cheap-travel-post -->
		<?php } /* END if have_posts() */ ?>
	</section> <!-- END .cheap-travel-contents -->
<?php get_sidebar();
get_footer();
