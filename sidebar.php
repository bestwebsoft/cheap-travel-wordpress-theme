<?php
/**
 * The Sidebar
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
?>
<section class="cheap-travel-sidebar col-lg-4 col-md-12 col-sm-12">
	<?php if ( is_active_sidebar( 'cheap_travel_left_sidebar' ) ) {
		dynamic_sidebar( 'cheap_travel_left_sidebar' );
	} else { /* default widgets */
		$args = array(
			'before_widget' => '<aside class="cheap-travel-widget-left-sidebar col-lg-12 col-md-6 col-sm-6">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="cheap-travel-widget-title">',
			'after_title'   => '</h3>',
		);
		the_widget( 'WP_Widget_Search', false, $args );
		the_widget( 'WP_Widget_Categories', false, $args );
		the_widget( 'Cheap_Travel_Recent_Posts_Widget', false, $args );
		the_widget( 'WP_Widget_Archives', false, $args );
		the_widget( 'WP_Widget_Recent_Posts', false, $args );
		the_widget( 'WP_Widget_Recent_Comments', false, $args );
	} ?>
</section> <!-- END .cheap-travel-sidebar -->
