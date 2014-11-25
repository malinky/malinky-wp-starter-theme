<?php
/**
 * Malinky Media functions
 *
 * @package Malinky Media
 */


/* ------------------------------------------------------------------------ *
 * Theme Setup
 * Front End Scripts
 * Widgets
 * Login Screen
 * Wordpress Setup
 * Template Function
 * Template Tags
 * CHECK
 * ------------------------------------------------------------------------ */


/* ------------------------------------------------------------------------ *
 * Theme Setup
 * ------------------------------------------------------------------------ */

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
		 *
		 * @link http://codex.wordpress.org/Function_Reference/load_theme_textdomain
		 */
		load_theme_textdomain( 'malinky-media', get_template_directory() . '/languages' );


		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );


		/*
		 * Enable support for Post Thumbnails.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );


		/*
		 * Featured image size.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
		 */
		//set_post_thumbnail_size( $width, $height, $crop );
		

		/*
		 * Additional image sizes.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		//add_image_size( $name, $width, $height, $crop );

		
		/*
		 * Register theme navigations. This uses a main navigation and footer in two locations.
		 *
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
endif;

add_action( 'after_setup_theme', 'malinky_media_setup' );





/* ------------------------------------------------------------------------ *
 * Front End Scripts
 * ------------------------------------------------------------------------ */

/**
 * Enqueue frontend scripts
 */
function malinky_media_scripts()
{

	/*
	 * Stylesheet which includes normalize.
	 */
	wp_enqueue_style( 'malinky-media-style', get_stylesheet_uri() );


	/*
	 * Dashicons font.
	 */
	wp_enqueue_style( 'dashicons' );


	/*
	 * Load google jQuery.
	 */
	/*if ( ! is_admin() ) {

        wp_deregister_script( 'jquery' );
        wp_register_script( 'malinky-media-jquery',
        					'http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
        					FALSE,
        					'1.11.0',
        					TRUE
        );
        wp_enqueue_script( 'malinky-media-jquery' );

    }*/

	wp_enqueue_script( 'jquery', '', '', '', true );

	/*
	 * Modernizr which includes html5shiv.
	 *
	 * @link http://modernizr.com/
	 * @link https://github.com/aFarkas/html5shiv
	 */
	wp_register_script( 'malinky-media-modernizr-js',
						get_template_directory_uri() . '/js/modernizr-2.8.3.js',
						'',
						NULL
	);
	wp_enqueue_script( 'malinky-media-modernizr-js' );


	wp_register_script( 'malinky-media-main-js',
						get_template_directory_uri() . '/js/main.js',
						array( 'malinky-media-jquery' ),
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-media-main-js' );


	/*
	 * Retina.
	 *
	 * @link http://imulus.github.io/retinajs/
	 */
	wp_register_script( 'malinky-media-retina-js',
						get_template_directory_uri() . '/js/retina.js',
						'',
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-media-retina-js' );


	/*
	 * Load contact validation scripts.
	 */
	if ( is_page( 'contact' ) ) {

		wp_register_script( 'malinky-media-validate-js',
							get_template_directory_uri() . '/js/jquery.validate.min.js',
							'',
							NULL,
							true
		);
		wp_register_script( 'malinky-media-contact',
							get_template_directory_uri() . '/js/contact-validate.min.js',
							array( 'plaay-validate-js' ),
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-media-contact' );

	}


	//wp_enqueue_script( 'malinky-media-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );


	//wp_enqueue_script( 'malinky-media-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );


	/*if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}*/

}

add_action( 'wp_enqueue_scripts', 'malinky_media_scripts' );





/* ------------------------------------------------------------------------ *
 * Widgets
 * ------------------------------------------------------------------------ */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function malinky_media_widgets_init()
{
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





/* ------------------------------------------------------------------------ *
 * Login Screen
 * ------------------------------------------------------------------------ */

/**
 * Change login screen logo url.
 *
 * @return string
 */
function malinky_media_login_logo_url()
{
	return esc_url ( site_url( '', 'http' ) );
}

add_filter( 'login_headerurl', 'malinky_media_login_logo_url' );


/**
 * Remove shake on login.
 */
function malinky_media_login_shake()
{
    remove_action( 'login_head', 'wp_shake_js', 12 );
}

add_action( 'login_head', 'malinky_media_login_shake' );


/**
 * Style login logo and page.
 */
function malinky_media_login_screen()
{ ?>
    <style type="text/css">
    	body.login {
    		background: #FFFFFF url(<?php echo esc_url( site_url( 'img/graphics/nav_bkg.png', 'https' ) ); ?>) repeat;
    	}
        body.login div#login h1 a {
            background-image: url(<?php echo esc_url( site_url( 'img/graphics/logo@2x.png', 'https' ) ); ?>);
            background-size: 255px;
            width: auto;
        }
        .login h1 a {
        	background-size: auto;
        }
        html.ie8 body.login div#login h1 a {
            background-image: url(<?php echo esc_url( site_url( 'img/graphics/logo.png', 'https' ) ); ?>);
        }
        .wp-core-ui .button.button-large {
        	height: auto;
        	line-height: normal;
		    padding: 10px;
        }        
        .wp-core-ui .button-primary {
		    width: auto;
		    height: auto;
		    display: inline-block;
		    padding: 10px;
		    background: #9e4381;
		    border: none;
		    color: #FFFFFF;
		    -webkit-border-radius: 5px;
		    -moz-border-radius: 5px;
		    border-radius: 5px;
		    font-weight: normal;   
		    line-height: normal;
		    margin-left: 4px;
		    text-shadow: none;
		    box-shadow: none;
		    font-size: 1.076923em;		
        }
        .wp-core-ui .button-primary:hover {
    		background: #852b68;
    		text-shadow: none;
        }        
        .login #nav {
        	text-shadow: none;
			padding: 26px 24px;
			background: #FFFFFF;
			border: 1px solid #e5e5e5;
			/*-webkit-box-shadow: rgba(200,200,200,.7) 0 4px 10px -1px;
			box-shadow: rgba(200,200,200,.7) 0 4px 10px -1px;*/
			-webkit-box-shadow: none;
			box-shadow: none;
			text-align: center;
		}
		.login #nav a {
		    width: auto;
		    height: auto;
		    display: block;
		    padding: 10px;
		    background: #9e4381;
		    border: none;
		    color: #FFFFFF !important;
		    -webkit-border-radius: 5px;
		    -moz-border-radius: 5px;
		    border-radius: 5px;
		    font-weight: normal;   
		    line-height: normal;
		    margin-left: 0px;
		    text-decoration: none;
		    font-size: 1.076923em;		    
		}
		.login #nav a:hover {
			color: #FFFFFF !important;
			/*background: #2072a1;*/
			background: #852b68;
			text-shadow: none;
		}
		.login #nav a:first-child {
			/*background: #f49316;*/
			background: #9e4381;
		}
		.login #nav a:first-child:hover {
			/*background: #e48306;*/
			background: #852b68;
		}
		.mobile #login #nav,
		.mobile #login #backtoblog {
			margin-left: 0;
		}
	
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'malinky_media_login_screen' );





/* ------------------------------------------------------------------------ *
 * Wordpress Setup
 * ------------------------------------------------------------------------ */

/**
 * Remove generator tag.
 *
 * @return string   
 */
function malinky_media_remove_version()
{
	return '';
}

add_filter( 'the_generator', 'malinky_media_remove_version' );


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}


/**
 * Hide admin bar for logged in users.
 */
show_admin_bar( false );





/* ------------------------------------------------------------------------ *
 * Template Functions
 * ------------------------------------------------------------------------ */

/**
 * Climb to parent page and return slug.
 *
 * @return string
 */
function malinky_media_tree()
{
	$parent_post_name = '';
  	if( is_page() ) {
  		global $post;
      	/* Get an array of Ancestors and Parents if they exist */
  		$parents = get_post_ancestors( $post->ID );
      	/* Get the top Level page->ID count base 1, array base 0 so -1 */ 
  		$id = ( $parents ) ? $parents[count( $parents )-1]: $post->ID;
     	/* Get the parent and set the $parent_post_name with the page slug (post_name) */
  		$parent = get_page( $id );
  		$parent_post_name = $parent->post_name;
	}
	return $parent_post_name;
}


/**
 * Truncate a string.
 *
 * @param string $text
 * @param int $length
 * @return string
 */
function malinky_media_truncate_words( $text, $length )
{
   $length = abs( ( int) $length );
   if( strlen( $text ) > $length ) {
      $text = preg_replace( "/^(.{1,$length})(\s.*|$)/s", '\\1...', $text );
   }
   return $text;
}





/* ------------------------------------------------------------------------ *
 * Template Tags
 * ------------------------------------------------------------------------ */





/* ------------------------------------------------------------------------ *
 * CHECK
 * ------------------------------------------------------------------------ */

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