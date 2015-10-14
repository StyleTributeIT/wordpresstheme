<?php

/**
 * ST only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'st_setup' ) ) :
/**
 * ST setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since ST 1.0
 */
function st_setup() {
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 300, true ); // default thumbnail size

	add_image_size( 'post', 940, 400, true );
	add_image_size( 'banner', 940, 300, true );

	register_nav_menus( array(
		'main' => __( 'Main menu', 'st' ),
		'secondary' => __( 'Secondary menu', 'st' ),
		'social' => __( 'Social links', 'st' ),
	) );
}
endif; // st_setup
add_action( 'after_setup_theme', 'st_setup' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since ST 1.0
 */
function st_scripts() {
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.css', array(), '3.3.1' );

	// Load our main stylesheet.
	wp_enqueue_style( 'st-style', get_stylesheet_uri(), array( 'bootstrap' ) );

	wp_enqueue_script( 'st-script', get_template_directory_uri() . '/js/contrib/jquery.horizontalNav.min.js', array( 'jquery' ), '20140107' );

	wp_enqueue_script( 'st-main', get_template_directory_uri() . '/js/custom/main.js', array( 'jquery' ), '20141123' );
}
add_action( 'wp_enqueue_scripts', 'st_scripts' );

/**
 * Register our sidebars and widgetized areas.
 */
function st_widgets_init() {
	register_sidebar( array(
		'name' => 'Region front',
		'id' => 'region_front',
		'before_widget' => '<div class="region region-front clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="block-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Magento',
		'id' => 'magento',
		'before_widget' => '<div class="region region-magento clearfix">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
	register_sidebar( array(
		'name' => 'Page bottom',
		'id' => 'page_bottom',
		'before_widget' => '<div class="region region-page-bottom clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="block clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="sidebar-title">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer',
		'before_widget' => '<div class="block site-info col-md-3">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'st_widgets_init' );

if ( ! function_exists( 'st_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function st_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'st' ),
		'next_text' => __( 'Next &rarr;', 'st' ),
	) );

	if ( $links ) :
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'st' ); ?></h2>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div>
	</nav>
	<?php
	endif;
}
endif;

if ( ! function_exists( 'st_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function st_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'st' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'st' ) );
			else :
				previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', 'st' ) );
				next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', 'st' ) );
			endif;
			?>
		</div>
	</nav>
	<?php
}
endif;

/**
 * Filters
 */
/**
 * Extend the default WordPress post classes.
 */
function st_post_classes( $classes ) {
	global $post;
	if (get_post_type( $post ) == 'page') {
		$classes[] = 'col-md-12';
	}
	elseif (get_post_type( $post ) == 'post') {
		if ( is_single($post)) {
			$classes[] = 'col-md-12';
		}
		else {
			$classes[] = 'col-md-4';
		}
	}

	return $classes;
}
add_filter( 'post_class', 'st_post_classes' );

/**
 * Extend the default WordPress images sizes.
 */
function st_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'post' => __('Post'),
	) );
}
add_filter( 'image_size_names_choose', 'st_custom_sizes' );

function st_archive_extend_links($links) {
	$links = preg_replace('/(<a[^>]*>)(.*?)(<\/a>)/i', '$1<span>$2</span>$3', $links);
	return $links;
}
add_filter('get_archives_link', 'st_archive_extend_links');

function rp4wp_medium_thumbnail_size( $thumb_size ) {
	return 'medium';
}
add_filter( 'rp4wp_thumbnail_size', 'rp4wp_medium_thumbnail_size' );

add_filter( 'rp4wp_append_content', '__return_false' );


function show_magento_products_by_tag($content)
{
    $tagEndText = 'magento end show';
    if(strpos($content,$tagEndText) !== false) {
        echo preg_replace('/' . $tagEndText . '.*/','',str_replace(array("\n","\r"),'',$content));
    }
}

function show_content_without_magento_products($content)
{
    echo preg_replace('/.+magento end show/','',str_replace(array("\n","\r"),'', $content));
}

function subscribe_form_action()
{
    return 'https://styletribute.com/newsletter/subscriber/new/';
}
