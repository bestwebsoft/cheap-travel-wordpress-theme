<?php
/**
 * The template for displaying archive pages
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
get_header(); ?>
<section class="cheap-travel-contents col-lg-8 col-md-12">
	<?php if ( have_posts() ) { ?>
		<div class="cheap-travel-content-header">
			<header class="cheap-travel-page-header">
				<?php the_archive_title( '<h3 class="cheap-travel-title">', '</h3>' );
				the_archive_description( '<div class="cheap-travel-article-content">', '</div>' ); ?>
			</header><!-- END .cheap-travel-page-header -->
			<div class="cheap-travel-clear"></div>
		</div>
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
						<h3 class="cheap-travel-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo __( 'Permalink to', 'cheap-travel' ) . '&nbsp;';
							the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>
					<?php } ?>
				</header><!-- END .cheap-travel-page-header -->
				<div id="cheap-travel-article-content" class="cheap-travel-content">
					<?php the_content(); ?>
					<div class="cheap-travel-clear"></div>
					<footer class="cheap-travel-tags">
						<?php cheap_travel_entry_meta();
						edit_post_link( __( 'Edit', 'cheap-travel' ), '<span class="cheap-travel-edit-link">', '</span>' ); ?>
					</footer> <!-- END .cheap-travel-tags -->
					<div class="cheap-travel-clear"></div>
					<small class="cheap-travel-top-link"><a href="#page"><?php _e( 'Top', 'cheap-travel' ); ?></a></small>
				</div> <!-- END .cheap-travel-content -->
			</article> <!-- END #cheap-travel-post -->
			<div class="cheap-travel-clear"></div>
			<!-- END while -->
		<?php }
		the_posts_pagination(
			array(
				'prev_text'          => '<span class="genericon genericon-previous"></span>',
				'next_text'          => '<span class="genericon genericon-next"></span>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">&nbsp;',
				'after_page_number'  => '&nbsp;</span>',
			)
		);
	} else { ?>
		<article class="cheap-travel-post">
			<header class="cheap-travel-page-header">
				<h3 class="cheap-travel-title"><?php _e( 'Nothing Found', 'cheap-travel' ); ?></h3>
			</header><!-- END .cheap-travel-page-header -->
			<div id="cheap-travel-article-content" class="cheap-travel-content">
				<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'cheap-travel' ); ?></p>
				<?php get_search_form(); ?>
			</div> <!-- END .cheap-travel-content -->
			<div class="cheap-travel-clear"></div>
		</article> <!-- END .cheap-travel-post -->
	<?php } /* END if have_posts() */ ?>
</section> <!-- END .cheap-travel-contents -->
<?php get_sidebar();
get_footer();
