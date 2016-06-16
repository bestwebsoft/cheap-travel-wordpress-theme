<?php /**
 * The template for displaying search forms in cheap-travel
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */ ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search" name="s" id="s" placeholder="<?php echo __( 'Enter to search', 'cheap-travel' ) . '&nbsp;.&nbsp;.&nbsp;.'; ?>" value="<?php the_search_query(); ?>" />
	<button type="submit" value="" class="genericon genericon-search"></button>
	<div class="cheap-travel-clear"></div>
</form><!-- END .search-form -->
