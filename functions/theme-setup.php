<?php
/* ------------------------------------------------------------------------ *
 * Theme Setup
 * ------------------------------------------------------------------------ */

if ( ! function_exists( 'malinky_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function malinky_setup() {

		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Malinky Media, use a find and replace.
		 * to change 'malinky' to the name of your theme in all the template files.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/load_theme_textdomain
		 */
		load_theme_textdomain( 'malinky', get_template_directory() . '/languages' );


		/* -------------------------------- *
		 * Theme Support Section
		 * -------------------------------- */

		/**
		 * Enable support for Post Formats. A Child Theme overwrites these if redefined.
		 * Create different templates to display each of these content types.
		 *
		 * @link http://codex.wordpress.org/Post_Formats
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );


		/**
		 * Enable support for Post Thumbnails. Is actually called Featured Image which can be attached to a post/page.
		 *
		 * @link http://codex.wordpress.org/Post_Thumbnails
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );


		/**
		 * Enable support for Custom Background. This is then added to Appearance menu.
 		 *
		 * @link http://codex.wordpress.org/Custom_Backgrounds
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Background
		 */
		add_theme_support( 'custom-background' );


		/**
		 * Enable support for Custom Header. This is then added to Appearance menu.
 		 *
		 * @link http://codex.wordpress.org/Custom_Headers
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
		 */
		add_theme_support( 'custom-header' );


		/**
		 * Add RSS feed links.
 		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
		 */
		//add_theme_support( 'automatic-feed-links' );


		/**
		 * Enable support for HTML5 markup.
		 */
		add_theme_support( 'html5', array(
			'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
		) );

		/**
		 * Enable support for Title Tag. Don't understand this fully so disabled.
		 */
		//add_theme_support( 'title-tag' );


		/* -------------------------------- *
		 * Image Sizes Section
		 * -------------------------------- */

		/**
		 * Featured image size.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		 */
		//set_post_thumbnail_size( $width, $height, $crop );
	

		/**
		 * Additional image sizes.
		 *
		 * The original main_header_image should be uploaded at 2200x889.
		 * All main_header_image_ variants are used for standard headers and headers as a bkg with the overlay.
		 * They are then adjusted either in main.js with enquire.js or in header.php inlined css.
		 *
		 * The original packery images should be uploaded at 2000x1467 or 2000x3000.
		 * Packery images swapped out in main.js on high density screens.
		 * For thumbnails malinky_mini_thumbnail and malinky_thumbnail (retina).
		 *
		 * Barber images uploaded at 800x800.
		 * For thumbnails malinky_mini_thumbnail and malinky_thumbnail (retina).
		 * 
		 * @link http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		add_image_size( 'main_header_image_tablet', 2048, 1117, true );
		add_image_size( 'main_header_image_phone', 1472, 803, true );
		add_image_size( 'main_header_image_computer', 990, 540, true );
		add_image_size( 'malinky_mini_thumbnail', 300 );
		add_image_size( 'malinky_thumbnail', 600 );
        add_image_size( 'malinky_medium', 1024 );
        add_image_size( 'malinky_large', 1600 );		
		
		/* -------------------------------- *
		 * Other Section
		 * -------------------------------- */

		/**
		 * Register theme navigations. This uses a main navigation and footer in two locations.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
		 */
		register_nav_menus( array(
			'main_navigation' 	=> __( 'Main Navigation', 'malinky' ),
			'mobile_navigation' 	=> __( 'Mobile Navigation', 'malinky' ),
			'footer_navigation' => __( 'Footer Navigation', 'malinky' )
		) );

	}

}

add_action( 'after_setup_theme', 'malinky_setup' );
