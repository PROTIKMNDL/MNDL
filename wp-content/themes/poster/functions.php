<?php

/**
 * poster functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package poster
 */

if ( ! function_exists( 'poster_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function poster_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on poster, use a find and replace
	 * to change 'poster' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'poster', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	//WooCommerce Support
	add_theme_support( 'woocommerce' );
	add_theme_support('bbpress');
// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 220, 260, true);
	add_image_size( 'poster-featured-image', 180, 200, true );
	add_image_size( 'poster-random-image', 180, 200, true );
	add_image_size( 'poster-singlethumb', 230, 300, true );
		if(get_theme_mod('poster_woo_zoom')=='enable'){ add_theme_support( 'wc-product-gallery-zoom' );}
	if(get_theme_mod('republicpro_woolightbox')!=='disable'){ add_theme_support( 'wc-product-gallery-lightbox' );}
	if(get_theme_mod('poster_woo_slider')=='enable'){ add_theme_support( 'wc-product-gallery-slider' );}
	add_theme_support( 'custom-logo', array(
   'height'      => 90,
   'width'       => 400,
   'header-text' => array( 'site-title', 'site-description' ),
   'flex-width' => true,
   'flex-height' => true,
) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'poster' ),
		'mobile' => esc_html__( 'Mobile Menu', 'poster' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
      /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css') );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'poster_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // poster_setup
add_action( 'after_setup_theme', 'poster_setup' );
 function poster_search_form( $form ) {
	$form = '<div class="input-group"><form role="search" method="get" id="searchform" class="searchform" action="' .esc_url(home_url( '/' )). '" >
	<div><label class="screen-reader-text" for="s">' . _x( 'Search for:','Label','poster' ) . '</label>
	<input type="text" class="input-group-field" placeholder="'. esc_attr_x( 'Search..','Placeholder','poster' ) .'" value="' . get_search_query() . '" name="s" id="s" />
	<button type="submit" id="searchsubmit" class="input-group-button button"><i class="fa fa-search"></i></button>
	</div>
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'poster_search_form' );

//jetpack related posts
function poster_more_related_posts( $options ) {
    $options['size'] = 6;
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'poster_more_related_posts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function poster_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'poster_content_width', 640 );
}
add_action( 'after_setup_theme', 'poster_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function poster_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'poster' ),
		'id'            => 'sidebar-1',
		'description'   => __('Sidebar widget for all pages included Post, Pages','poster'),
		'before_widget' => '<aside id="sidebarid %1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Widget', 'poster' ),
		'id'            => 'post-widget-1',
		'description'   => __('This will aside post content and show widgets ','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Below Top Navigation', 'poster' ),
		'id'            => 'below-navi',
		'description'   => __('This widget show just above content and below main navigation','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
register_sidebar( array(
		'name'          => esc_html__( 'Post and Pages footer', 'poster' ),
		'id'            => 'content-end',
		'description'   => __('After post content and above comment','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'poster' ),
		'id'            => 'footer-1',
		'description'   => __('Footer widget area first from left','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'poster' ),
		'id'            => 'footer-2',
		'description'   => __('Footer widget area Second from left','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'poster' ),
		'id'            => 'footer-3',
		'description'   => __('Footer widget area Third from left','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'poster' ),
		'id'            => 'footer-4',
		'description'   => __('Footer widget area fourth from left','poster'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'poster_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function poster_scripts() {
	wp_enqueue_style( 'poster-style', get_stylesheet_uri() );
	wp_enqueue_script( 'poster-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'poster-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
     
   wp_enqueue_script( 'foundation-core', get_template_directory_uri() . '/foundation/js/foundation.core.js', false, null, true);
   wp_enqueue_style('poster-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('poster_body_font', 'Open Sans') ).':100,300,400,700' );
   wp_enqueue_style('poster-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('poster_title_font', 'Open Sans') ).':100,300,400,700' );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/foundation/js/foundation.min.js', false, null, true);
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/foundation/css/foundation.min.css' );
	wp_enqueue_style( 'poster-customcss', get_template_directory_uri() . '/css/custom.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'poster_scripts' );

function poster_custom_customize_enqueue() {
	wp_enqueue_style( 'poster-customizer-css', get_template_directory_uri() . '/css/customizer-css.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'poster_custom_customize_enqueue' );


function poster_footerscript() {
    wp_enqueue_script(
        'poster-loadscripts',
        get_template_directory_uri() . '/js/loadscripts.js',
        array('jquery'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'poster_footerscript',10);


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Custom function and codes
 */
require get_template_directory() . '/inc/custom-function.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/metaboxpage.php';
require get_template_directory() . '/inc/metaboxsingle.php';
require get_template_directory() . '/inc/metaboxproduct.php';