<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
get_header(); ?>
	<section class="cheap-travel-contents col-lg-8 col-md-12">
		<article class="error-404 not-found">
			<header class="cheap-travel-page-header">
				<h3 class="cheap-travel-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'cheap-travel' ); ?></h3>
			</header> <!-- END .page-header -->
			<div id="cheap-travel-article-content" class="cheap-travel-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'cheap-travel' ); ?></p>
				<?php get_search_form(); ?>
			</div> <!-- END .cheap-travel-content -->
		</article> <!-- END .error-404 -->
	</section> <!-- END .cheap-travel-contents -->
<?php get_sidebar();
get_footer();
