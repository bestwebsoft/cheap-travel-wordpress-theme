<?php
/**
 * Cheap Travel functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @subpackage Cheap Travel
 * @since      Cheap Travel 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640;
}

/* Set up theme defaults and registers support for various WordPress features. Note that this function is hooked into the after_setup_theme hook, which runs before the init hook. The init hook is too late for some features, such as indicating support post thumbnails. */
function cheap_travel_setup() {
	global $wp_version;
	/* replace to change 'cheap-travel' to the name of your theme in all template files. */
	load_theme_textdomain( 'cheap-travel', get_template_directory() . '/languages' );
	/* This theme styles the visual editor to resemble the theme style. */
	add_editor_style( 'css/editor-style.css' );
	/* Add RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );
	/* This feature allows themes to add document title tag to HTML <head>. */
	add_theme_support( 'title-tag' );
	/* add post-formats to post_type 'page' */
	add_post_type_support( 'page', 'post-formats' );
	/* Enable support for Post Thumbnails, and declare two sizes. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 640, 250, true );
	/* Register a new image size */
	add_image_size( 'cheap_travel_slide', 3000, 479, true );
	/* This theme uses wp_nav_menu() in two locations. */
	register_nav_menus( array(
		'primary' => __( 'Top primary menu', 'cheap-travel' ),
	) );
	/* Switch default core markup for search form, comment form, and comments to output valid HTML5. */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	/* Enable support for Post Formats.  See https:/*codex.wordpress.org/Post_Formats */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'chat', 'status' ) );
	/* This theme allows users to set a custom header. */
	$custom_header = array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 3000,
		'height'                 => 250,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '#495154',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => 'cheap_travel_header_style',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $custom_header );
	/* This theme allows users to set a custom background. */
	$defaults = array(
		'default-color'          => '#ececec',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $defaults );
	/* Add support for featured content. */
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'cheap_travel_get_featured_posts',
		'max_posts'               => 6,
	) );
	/* This theme uses its own gallery styles. */
	add_filter( 'use_default_gallery_style', '__return_false' );
}

/* Changing styles header */
function cheap_travel_header_style() {
	$text_color   = get_header_textcolor();
	$display_text = display_header_text();
	$header_image = get_header_image(); ?>
	<style type="text/css">
		<?php if ( 'blank' != $text_color ) { ?> /*If the user has set a custom color for the text use that */
			#cheap_travel_masthead .cheap-travel-home-link h1.cheap-travel-site-title,
			#cheap_travel_site_navigation div ul a {
				color: <?php echo '#' . $text_color; ?> !important;
			}
		<?php }

		if ( ! $display_text ) { ?> /* Display text or not */
			.cheap-travel-site-title,
			.cheap-travel-site-description {
				display: none;
			}
		<?php } ?>

		#cheap_travel_masthead {
			background: #ffffff url('<?php echo $header_image; ?>') no-repeat center center;
			background-size: cover;
		}
	</style>
<?php }

/* Сonclusion sidebar */
function cheap_travel_register_sidebar() {
	/* Right sidebar */
	register_sidebar(
		array(
			'name'          => __( 'Main Sidebar', 'cheap-travel' ),
			'id'            => 'cheap_travel_left_sidebar',
			'before_widget' => '<aside class="cheap-travel-widget-left-sidebar col-lg-12 col-md-6 col-sm-6">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="cheap-travel-widget-title">',
			'after_title'   => '</h3>',
		)
	);
	/* Footer sidebar */
	register_sidebar(
		array(
			'name'          => __( 'Footer Sidebar', 'cheap-travel' ),
			'id'            => 'cheap_travel_footer_sidebar',
			'before_widget' => '<aside class="cheap-travel-widget-footer-sidebar col-sm-4 col-xs-6">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="cheap-travel-widget-footer-title">',
			'after_title'   => '</h2>',
		)
	);
	register_widget( 'Cheap_Travel_Recent_Posts_Widget' );
}

/* SLider functions Adds metabox to the main column on the Post and Page edit screens. */
function cheap_travel_add_custom_box() {
	$screens = array( 'post', 'page' );
	foreach ( $screens as $screen ) {
		add_meta_box(
			'slider-section',
			__( 'Slider Settings', 'cheap-travel' ),
			'cheap_travel_slider_custom_box',
			$screen
		);
	}
}

/* Prints the box content. */
function cheap_travel_slider_custom_box( $post ) {
	/* Add an nonce field so we can check for it later. */
	wp_nonce_field( 'cheap_travel_slider_custom_box', 'cheap_travel_slider_custom_box_nonce' );
	/* Use get_post_meta() to retrieve an existing value
	from the database and use the value for the form. */
	$edited_post_id = $post->ID;
	$value          = get_post_meta( $edited_post_id, 'cheap_travel_add_to_slider', true ); ?>
	<input type="checkbox" id="cheap_travel_add_to_slider" name="cheap_travel_add_to_slider" value="1" <?php if ( true == $value ) { echo 'checked '; } ?>>
	<label for="cheap_travel_add_to_slider">
		<?php _e( 'Check if you want featured image of this post(page) to be shown in the slider.', 'cheap-travel' ) ?><br>
	</label>
<?php }

/* Prints HTML with meta information for the categories, tags. */
function cheap_travel_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="cheap-travel-sticky-post">%s</span>', __( 'Featured', 'cheap-travel' ) );
	}
	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="cheap-travel-entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="cheap-travel-icon"></span><span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'cheap-travel' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}
	if ( 'post' == get_post_type() ) {
		if ( is_singular() || is_multi_author() ) {
			printf( '<span class="cheap-travel-byline"><span class="cheap-travel-author vcard"><span class="cheap-travel-icon"></span><span class="screen-reader-text">%1$s </span><a class="cheap-travel-url fn n" href="%2$s">%3$s</a></span></span>',
				_x( 'Author', 'Used before post author name.', 'cheap-travel' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}
	}
	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="cheap-travel-entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="cheap-travel-entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'j M Y' ) ),
			get_the_date( 'j M Y' ),
			esc_attr( get_the_modified_date( 'j M Y' ) ),
			get_the_modified_date( 'j M Y' )
		);
		printf( '<span class="cheap-travel-posted-on"><span class="cheap-travel-icon"></span><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'cheap-travel' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
	if ( 'post' == get_post_type() ) {
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list ) {
			printf( '<span class="cheap-travel-cat-links"><span class="cheap-travel-icon"></span><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'cheap-travel' ),
				$categories_list
			);
		}
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			printf( '<span class="cheap-travel-tags-links"><span class="cheap-travel-icon"></span><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'cheap-travel' ),
				$tags_list
			);
		}
	}
	if ( is_attachment() && wp_attachment_is_image() ) {
		/* Retrieve attachment metadata. */
		$metadata = wp_get_attachment_metadata();
		printf( '<span class="cheap-travel-full-size-link"><span class="cheap-travel-icon"></span><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'cheap-travel' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="cheap-travel-comments-link">';
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'cheap-travel' ), get_the_title() ) );
		echo '</span>';
	}
}

/* When the post is saved, saves our custom data. */
function cheap_travel_slider_save_postdata( $post_id ) {
	/* We need to verify this came from the our screen and with proper authorization, because save_post can be triggered at other times. Check if our nonce is set.*/
	if ( ! isset( $_POST['cheap_travel_slider_custom_box_nonce'] ) ) {
		return $post_id;
	}
	/* If this is an autosave, our form has not been submitted, so we don't want to do anything. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	/* OK, its safe for us to save the data now.
	Update the meta field in the database. */
	update_post_meta( $post_id, 'cheap_travel_add_to_slider', isset( $_POST['cheap_travel_add_to_slider'] ) ? true : false );
}

/* Proper way to enqueue scripts and styles */
function cheap_travel_style_scripts() {
	/* Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use). */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' ); /* including css for  bootstrap*/
	wp_enqueue_style( 'formstyler', get_template_directory_uri() . '/css/jquery.formstyler.css' ); /* including css for Loads library for styling the form elements. */
	/* Add Genericons, used in the main stylesheet. */
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
	wp_enqueue_style( 'cheap-travel-styles', get_stylesheet_uri() ); /* including main style css  */
	wp_enqueue_script( 'cheap-travel-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) ); /* including main Scripts js  */
	wp_enqueue_script( 'cheap-travel-html5shiv', get_template_directory_uri() . '/js/html5shiv.js' ); /* including scripts for compatibility html5 with IE */
	wp_script_add_data( 'cheap-travel-html5shiv', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'cheap-travel-css3', get_template_directory_uri() . '/js/css3-mediaqueries.js' ); /* including scripts for compatibility html5 with IE */
	wp_script_add_data( 'cheap-travel-css3', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js' );
	/* including scripts for  bootstrap*/
	wp_enqueue_script( 'jquery-formstyler', get_template_directory_uri() . '/js/jquery.formstyler.js', array( 'jquery' ) ); /* including scripts for Loads library for styling the form elements. */
	$script_localization = array( /* array with elements to localize in scripts */
		'choose_file'           => __( 'Choose file', 'cheap-travel' ),
		'file_is_not_selected'  => __( 'No file chosen', 'cheap-travel' ),
		'cheap_travel_home_url' => esc_url( home_url() ),
	);
	wp_localize_script( 'cheap-travel-scripts', 'script_loc', $script_localization ); /* localization in scripts */
}

/* Adds slider to the frontpage */
function cheap_travel_carousel_slider() {
	if ( have_posts() ) {
		$query = new WP_Query(
			array(
				'posts_per_page'      => - 1,
				'post_type'           => 'any',
				'meta_key'            => 'cheap_travel_add_to_slider',
				'meta_value'          => true,
				'ignore_sticky_posts' => 1,
			)
		);
		/* The Loop */
		if ( $query->have_posts() ) { ?>
			<div id="carousel-example-generic" class="carousel slide cheap-travel-carousel" data-ride="cheap-travel-carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php $i = 0;
					while ( $i < $query->post_count ) { ?>
						<li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php if ( 0 == $i ) { echo 'active'; } ?>"></li>
						<?php $i ++;
					} ?>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<?php add_filter( 'excerpt_length', 'cheap_travel_slider_excerpt_length', 999 );
					add_filter( 'excerpt_more', 'cheap_travel_excerpt_slider_more' );
					while ( $query->have_posts() ) {
						$query->the_post(); ?>
						<div class="item<?php if ( ! empty( $query->current_post ) == 0 ) { echo ' active'; } ?>">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'cheap_travel_slide' ); ?></a>
							<div class="carousel-caption">
								<h1><?php the_title(); ?></h1>
								<div class="cheap-travel-slider-post-content">
									<?php the_excerpt(); ?>
								</div>
							</div>
						</div>
					<?php }
					remove_filter( 'excerpt_length', 'cheap_travel_slider_excerpt_length' );
					remove_filter( 'excerpt_more', 'cheap_travel_excerpt_slider_more' );
					wp_reset_postdata(); /* restore the global */ ?>
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only"><?php _e( 'Previous', 'cheap-travel' ); ?></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only"><?php _e( 'Next', 'cheap-travel' ); ?></span>
				</a>
			</div>
		<?php }
	}
} /* END slider */

/* Cuts of the post for the slider */
function cheap_travel_slider_excerpt_length( $length ) {
	return 18;
}

if ( ! is_admin() ) {
	/*  Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'View more' link. string 'Continue reading' link prepended with an ellipsis. */
	function cheap_travel_excerpt_slider_more( $more ) {
		return ' <a class="cheap-travel-slider-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Learn more', 'cheap-travel' ) . '&nbsp;<span class="genericon genericon-next"></span></a>';
	}
}

if ( ! is_admin() ) {
	/* Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'View more' link. return string 'Continue reading' link prepended with an ellipsis. */
	function cheap_travel_excerpt_more( $more ) {
		return ' <a class="cheap-travel-read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'View', 'cheap-travel' ) . '&nbsp;&#062; </a>';
	}
}

/* Display an optional post thumbnail. Wraps the post thumbnail in an anchor element on index views, or a div element when on single views. */
function cheap_travel_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	if ( is_singular() ) { ?>
		<div class="cheap-travel-post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .cheap-travel-post-thumbnail -->
	<?php } else { ?>
		<a class="cheap-travel-post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) ); ?>
		</a>
	<?php } /* End is_singular() */
}

/* Create a custom widget Cheap Travel Recent Posts */

class Cheap_Travel_Recent_Posts_Widget extends WP_Widget {
	function __construct() {
		/* Instantiate the parent object */
		parent::__construct( false, __( 'Cheap Travel Recent Posts', 'cheap-travel' ) );
	}

	function widget( $args, $instance ) {
		/* Widget output */
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Cheap Travel Recent Posts', 'cheap-travel' );
		$title = apply_filters( 'widget_title', $title );
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date    = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$widget_query = new WP_Query(
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				)
			)
		);
		/* place for my code ... */
		if ( $widget_query->have_posts() ) {
			add_filter( 'excerpt_length', 'cheap_travel_widget_excerpt_length', 1000 ); ?>
			<ul class="cheap-travel-custom-widget-ul">
				<?php while ( $widget_query->have_posts() ) {
					$widget_query->the_post(); ?>
					<li class="cheap-travel-custom-widget-li">
						<?php if ( $show_date ) { ?>
							<div class="cheap-travel-custom-date">
								<span class="cheap-travel-post-date-day"><?php echo get_the_time( 'j' ); ?></span>
								<span class="cheap-travel-post-date-month"><?php echo get_the_time( 'M' ); ?></span>
							</div>
						<?php } ?>
						<div class="cheap-travel-custom-widget-title">
							<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
						</div>
						<div class="cheap-travel-custom-widget-post-content">
							<?php the_excerpt(); ?>
						</div>
						<div class="cheap-travel-clear"></div>
					</li> <!-- .cheap-travel-custom-widget-li -->
				<?php } ?>
			</ul> <!-- .cheap-travel-custom-widget-ul -->
			<?php echo $args['after_widget'];
			remove_filter( 'excerpt_length', 'cheap_travel_widget_excerpt_length' );
			/* Reset the global $the_post as this query will have stomped on it */
			wp_reset_postdata();
		}
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		/* Save widget options */
		$instance              = $old_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		wp_cache_delete( 'Cheap_Travel_Recent_Posts_Widget', 'widget' );

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['Cheap_Travel_Recent_Posts_Widget'] ) ) {
			delete_option( 'Cheap_Travel_Recent_Posts_Widget' );
		}

		return $instance;
	}

	function form( $instance ) {
		/* Output admin widget options form */
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false; ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'cheap-travel' ) . ':'; ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php echo __( 'Number of posts to show', 'cheap-travel' ) . ':'; ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php echo __( 'Display post date', 'cheap-travel' ) . '?'; ?></label>
		</p>
	<?php }
}

/* Cuts of the post for the widget */
function cheap_travel_widget_excerpt_length( $length ) {
	return 7;
}

add_action( 'after_setup_theme', 'cheap_travel_setup' );
add_action( 'widgets_init', 'cheap_travel_register_sidebar' );
add_action( 'add_meta_boxes', 'cheap_travel_add_custom_box' );
add_action( 'save_post', 'cheap_travel_slider_save_postdata' );
add_action( 'wp_enqueue_scripts', 'cheap_travel_style_scripts' );
add_action( 'cheap_travel_carousel_slider', 'cheap_travel_carousel_slider' );
add_filter( 'excerpt_more', 'cheap_travel_excerpt_more' );
add_action( 'cheap_travel_post_thumbnail', 'cheap_travel_post_thumbnail' );
