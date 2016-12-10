<?php
/**
 * graywhale functions and definitions
 *
 * @package graywhale
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'graywhale_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function graywhale_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on graywhale, use a find and replace
	 * to change 'graywhale' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'graywhale', get_template_directory() . '/languages' );

	add_editor_style( "editor.css" );
	add_editor_style( array( 'editor-style.css', graywhale_fonts_url() ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 400, 266, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'graywhale' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'status', 'image', 'video', 'audio', 'quote'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'graywhale_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	// Adds theme Support for Title Tags in 4.1+	
	add_theme_support( 'title-tag' );
}
endif; // graywhale_setup
add_action( 'after_setup_theme', 'graywhale_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function graywhale_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'graywhale' ),
		'id'            => 'sidebar-1',
		'description'   => __('This sidebar appears in the right-hand column of blog posts, etc.', 'graywhale'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'graywhale' ),
		'id'            => 'sidebar-6',
		'description'   => __('This sidebar appears when you publish a page with the "Page with Sidebar" template.', 'graywhale'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'First Footer Sidebar', 'graywhale' ),
		'id'            => 'sidebar-2',
		'description'   => __('Appears in the footer, in the farthest left position. We recommend only using one widget here.', 'graywhale'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Second Footer Sidebar', 'graywhale' ),
		'id'            => 'sidebar-3',
		'description'   => __('Appears in the footer, in the middle position. We recommend only using one widget here.', 'graywhale'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => __( 'Third Footer Sidebar', 'graywhale' ),
		'id'            => 'sidebar-4',
		'description'   => __('Appears in the footer, in the farthest right position. We recommend only using one widget here.', 'graywhale'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		register_sidebar( array(
		'name'          => __( 'Mobile Menu', 'graywhale' ),
		'id'            => 'sidebar-5',
		'description'   => __('Place a custom menu widget in this space to create a complete, functional mobile menu for the site.', 'graywhale'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'graywhale_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function graywhale_scripts() {
	wp_enqueue_style( 'graywhale-fonts', graywhale_fonts_url(), array(), null );
	wp_enqueue_style( 'graywhale-style', get_stylesheet_uri() );
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons.css' );

	wp_enqueue_script( 'jquery-graywhale-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );
	wp_enqueue_script( 'graywhale-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array( 'jquery' ), '2014', true );
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '2014', true );
	wp_enqueue_script( 'jquery-flowtype', get_template_directory_uri() . '/js/flowtype.js', array( 'jquery' ), '1.1', true );

	$jjnav = array();	
	if ( is_admin_bar_showing() ) {
		$jjnav['adminBar'] = true;
	}
	wp_localize_script('jquery-graywhale-navigation', 'jjOptions', $jjnav );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'graywhale_scripts' );

function graywhale_fonts_url() {
	$fonts_url = '';

 	$open_sans = _x( 'on', 'Open Sans font: on or off', 'beluga' ); //turn 'off' for languages with characters not supported by 'Open Sans'
	if ( 'off' !== $open_sans ) {
		$font_family = 'Open+Sans:400,300,600,700';
		$query_args = array( 'family' => urlencode( $font_family ),
									'subset' => urlencode( 'latin' ) );
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
