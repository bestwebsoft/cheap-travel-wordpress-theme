<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
get_header(); ?>
	<section class="cheap-travel-contents col-lg-8 col-md-12">
		<?php while ( have_posts() ) {
			the_post(); ?>
			<article id="cheap-travel-post-<?php the_ID(); ?>" <?php post_class( 'cheap-travel-post' ); ?>>
				<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
					<div class="cheap-travel-content-image">
						<?php do_action( 'cheap_travel_post_thumbnail' ); ?>
					</div> <!-- END .cheap-travel-content_image -->
				<?php } /* END has_post_thumbnail() */ ?>
				<header class="cheap-travel-page-header">
					<?php the_title( '<h3 class="cheap-travel-title">', '</h3>' ); ?>
				</header><!-- END .cheap-travel-page-header -->
				<div id="cheap-travel-article-content" class="cheap-travel-content">
					<?php the_content();
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'cheap-travel' ) . ':</span>',
						'after'       => '</div>',
						'link_before' => '<span>&nbsp;',
						'link_after'  => '&nbsp;</span>',
					) ); ?>
					<div class="cheap-travel-clear"></div>
					<footer class="cheap-travel-tags cheap-travel-page-tags">
						<?php cheap_travel_entry_meta();
						edit_post_link( __( 'Edit', 'cheap-travel' ), '<span class="cheap-travel-edit-link">', '</span>' ); ?>
					</footer><!-- END .cheap-travel-tags -->
					<div class="cheap-travel-clear"></div>
					<small class="cheap-travel-top-link"><a href="#page"><?php _e( 'Top', 'cheap-travel' ); ?></a></small>
				</div> <!-- END .cheap-travel-content -->
				<div class="cheap-travel-clear"></div>
				<?php comments_template(); ?>
			</article> <!-- END .cheap-travel-post -->
			<!-- END the loop. -->
		<?php } ?>
	</section> <!-- END .cheap-travel-contents -->
<?php get_sidebar();
get_footer();
