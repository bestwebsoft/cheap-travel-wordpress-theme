<?php
/**
 * The Footer Sidebar
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
if ( ! is_active_sidebar( 'cheap_travel_footer_sidebar' ) ) {
	return;
} ?>
<div id="cheap_travel_footer_sidebar">
	<div class="cheap-travel-footer-sidebar container">
		<section class="cheap-travel-footer-sidebar-content col-lg-12">
			<?php dynamic_sidebar( 'cheap_travel_footer_sidebar' ); ?>
		</section> <!-- END .cheap-travel-footer-sidebar-content -->
	</div> <!-- END .cheap-travel-footer-sidebar -->
</div> <!-- END #cheap_travel_footer_sidebar -->
<div class="cheap-travel-clear"></div>
