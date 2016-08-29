<?php
/**
 * The template for displaying image attachments
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
				<nav id="image-navigation" class="cheap-travel-navigation image-navigation">
					<div class="nav-links">
						<div class="cheap-travel-nav-previous">
							<?php previous_image_link( false, __( 'Previous Image', 'cheap-travel' ) ); ?>
						</div>
						<div class="cheap-travel-nav-next">
							<?php next_image_link( false, __( 'Next Image', 'cheap-travel' ) ); ?>
						</div>
					</div><!-- END .nav-links -->
				</nav><!-- END .image-navigation -->
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
					<div class="cheap-travel-entry-attachment">
						<?php /*  Filter the default Cheap Travel image attachment size.  $image_size Image size. Default 'large'. */
						$image_size = apply_filters( 'cheap_travel_attachment_size', 'large' );
						echo wp_get_attachment_image( get_the_ID(), $image_size );
						if ( has_excerpt() ) { ?>
							<div class="cheap-travel-entry-caption">
								<?php the_excerpt(); ?>
							</div><!-- END .cheap-travel-entry-caption -->
						<?php } ?>
					</div><!-- END .cheap-travel-entry-attachment -->
					<?php the_content();
					wp_link_pages(
						array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages', 'cheap-travel' ) . ':</span>',
							'after'       => '</div>',
							'link_before' => '<span>&nbsp;',
							'link_after'  => '&nbsp;</span>',
							'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'cheap-travel' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						)
					); ?>
					<div class="cheap-travel-clear"></div>
					<footer class="cheap-travel-tags cheap-travel-image-tags">
						<?php cheap_travel_entry_meta();
						edit_post_link( __( 'Edit', 'cheap-travel' ), '<span class="cheap-travel-edit-link">', '</span>' ); ?>
					</footer> <!-- END .cheap-travel-tags -->
					<div class="cheap-travel-clear"></div>
					<small class="cheap-travel-top-link"><a href="#page"><?php _e( 'Top', 'cheap-travel' ); ?></a></small>
				</div> <!-- END .cheap-travel-content -->
			</article> <!-- END #post-## -->
			<?php /* If comments are open or we have at least one comment, load up the comment template */
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			/* Previous/next post navigation. */
			the_post_navigation(
				array(
					'prev_text' => '<span class="meta-nav">' . _x( 'Published in', 'Parent post link', 'cheap-travel' ) . '</span><span class="post-title">%title</span>',
				)
			);
		} /* END End the loop. */
	} ?>
</section> <!-- END .cheap-travel-contents -->
<!-- sidebar -->
<?php get_sidebar();
get_footer();
