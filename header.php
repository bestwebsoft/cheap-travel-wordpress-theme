<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !( IE 7 ) & !( IE 8 )]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed cheap-travel-site">
	<header id="cheap_travel_masthead" class="cheap-travel-site-header navbar navbar-default">
		<div class="container-fluid container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#cheap_travel_navbar" aria-expanded="false">
					<span class="sr-only"><?php _e( 'Toggle navigation', 'cheap-travel' ); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="cheap-travel-home-link navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					<h1 class="cheap-travel-site-title"><?php bloginfo( 'name' ); ?></h1>
					<p class="cheap-travel-site-description lead"><?php bloginfo( 'description' ); ?> </p>
				</a> <!-- END .cheap-travel-home-link -->
			</div> <!-- END .navbar-header -->
			<div id="cheap_travel_navbar" class="cheap-travel-navbar collapse navbar-collapse">
				<nav id="cheap_travel_site_navigation" class="navigation cheap-travel-main-navigateon">
					<?php wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class'     => 'nav navbar-nav navbar-right',
					) ); ?>
				</nav> <!-- END #cheap_travel_site_navigation -->
			</div> <!-- END #cheap_travel_navbar -->
		</div> <!-- END .container-fluid -->
	</header> <!-- END #cheap_travel_masthead -->
	<div class="cheap-travel-clear"></div>
	<div id="main-content" class="custom-background">
		<!-- slider -->
		<div id="cheap-travel-carousel">
			<?php if ( is_front_page() ) {
				do_action( 'cheap_travel_carousel_slider' );
			} ?>
		</div> <!-- END #cheap-travel-carousel -->
		<div class="cheap-travel-clear"></div>
		<div class="cheap-travel-site-main container">
