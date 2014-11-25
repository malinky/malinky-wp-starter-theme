<?php
/**
 * Malinky Media functions and definitions
 *
 * @package Malinky Media
 * @since Twenty Fourteen 1.0
 */

/**
 * CHECK
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'malinky_media_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function malinky_media_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Malinky Media, use a find and replace
	 * to change 'malinky-media' to the name of your theme in all the template files
	 * @link http://codex.wordpress.org/Function_Reference/load_theme_textdomain
	 */
	load_theme_textdomain( 'malinky-media', get_template_directory() . '/languages' );

	/*
	 * Add default posts and comments RSS feed links to head.
	 */
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails.
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	/*
	 * Featured image size.
	 * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	 */
	//set_post_thumbnail_size( $width, $height, $crop );
	/*
	 * Additional image sizes.
	 * @link http://codex.wordpress.org/Function_Reference/add_image_size
	 */
	//add_image_size( $name, $width, $height, $crop );

	/*
	 * Register theme navigations. This uses a main navigation and footer in two locations.
	 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
	 */
	register_nav_menus( array(
		'main_navigation' 	=> __( 'Main Navigation', 'malinky-media' ),
		'footer_navigation' => __( 'Footer Navigation', 'malinky-media' ),
	) );

	/*
	 * CHECK
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * CHECK
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	/*
	 * CHECK
	 * Set up the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'malinky_media_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * CHECK
	 * This theme uses its own gallery styles.
	 */
	add_filter( 'use_default_gallery_style', '__return_false' );


}
endif; //malinky_media_setup

add_action( 'after_setup_theme', 'malinky_media_setup' );

/**
 * ------------------------
 * ENQUEUE FRONTEND SCRIPTS
 * ------------------------
 */
function malinky_media_scripts() {

	wp_enqueue_style( 'malinky-media-style', get_stylesheet_uri() );

	wp_enqueue_style( 'dashicons' );

	wp_register_script( 'malinky-main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), NULL, true );
	wp_enqueue_script( 'malinky-main-js' );

	wp_enqueue_script( 'malinky-media-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'malinky-media-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'malinky_media_scripts' );

/**
 * ----------------------------------
 * HIDE ADMIN BAR FOR LOGGED IN USERS
 * ----------------------------------
 */
show_admin_bar(false);









/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function malinky_media_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'malinky-media' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'malinky_media_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
