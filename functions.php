<?php
/**
 * Functions
 */


/* ------------------------------------------------------------------------ *
 * Theme Setup
 * Init
 * Front End Scripts
 * Widgets
 * Login Screen
 * Wordpress Setup Actions and Filters
 * Template Function
 * Template Tags
 * CHECK
 * ------------------------------------------------------------------------ */


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
		 * These aren't added but if they are can also be removed from an action.
		 * remove_action('wp_head', 'feed_links', 2);
		 * remove_action('wp_head', 'feed_links_extra', 3);
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
		 * @link http://codex.wordpress.org/Function_Reference/add_image_size
		 */
		//add_image_size( $name, $width, $height, $crop );

		
		/* -------------------------------- *
		 * Other Section
		 * -------------------------------- */

		/**
		 * Register theme navigations. This uses a main navigation and footer in two locations.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_nav_menu
		 */
		register_nav_menus( array(
			'primary_navigation' 	=> __( 'Primary Navigation', 'malinky' ),
			'footer_navigation' => __( 'Footer Navigation', 'malinky' ),
		) );

	}

}

add_action( 'after_setup_theme', 'malinky_setup' );




/* ------------------------------------------------------------------------ *
 * Init
 * ------------------------------------------------------------------------ */

/*function malinky_init() {}
add_action( 'init', 'malinky_init' );*/





/* ------------------------------------------------------------------------ *
 * Front End Scripts Local
 * ------------------------------------------------------------------------ */

/**
 * Enqueue frontend scripts
 */
function malinky_scripts()
{

	/**
	 * Load WP jQuery and jQuery migrate in the footer.
	 */
	if ( ! is_admin() ) {

		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate' );

		wp_register_script( 'jquery',
							'/wp-includes/js/jquery/jquery.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'jquery' );

		wp_register_script( 'jquery-migrate',
							'/wp-includes/js/jquery/jquery-migrate.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'jquery-migrate' );

	}


	/**
	 * Stylesheet which includes normalize.
	 */
	wp_enqueue_style( 'malinky-style', get_stylesheet_uri() );


	/**
	 * Dashicons font.
	 *
	 * @link https://developer.wordpress.org/resource/dashicons
	 */
	wp_enqueue_style( 'dashicons' );


	/**
	 * Font awesome font.
	 *
	 * @link http://fortawesome.github.io/Font-Awesome/
	 */		
	wp_register_style( 'malinky-font-awesome',
					   '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css',
						false,
						NULL
	);
	wp_enqueue_style( 'malinky-font-awesome' );


	/* -------------------------------- *
	 * Local
	 * -------------------------------- */


	/**
	 * Modernizr which includes html5shiv.
	 *
	 * @link http://modernizr.com/
	 * @link https://github.com/aFarkas/html5shiv
	 */
	wp_register_script( 'malinky-modernizr-js',
						get_template_directory_uri() . '/js/modernizr-2.8.3.js',
						false,
						NULL
	);
	wp_enqueue_script( 'malinky-modernizr-js' );


	/*
	 * Malinky Media related javascript and jQuery.
	 */
	wp_register_script( 'malinky-main-js',
						get_template_directory_uri() . '/js/main.js',
						array( 'jquery' ),
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-main-js' );


	/**
	 * Retina.
	 *
	 * @link http://imulus.github.io/retinajs/
	 */
	wp_register_script( 'malinky-retina-js',
						get_template_directory_uri() . '/js/retina.js',
						false,
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-retina-js' );


	/**
	 * Google Map Set Up.
	 *
	 * @link https://developers.google.com/maps/documentation/javascript/
	 */
	wp_register_script( 'malinky-googlemap-js',
						get_template_directory_uri() . '/js/googlemap.js',
						false,
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-googlemap-js' );


	/**
	 * Load Google maps API.
	 * Uses malinky_initialize function which is in googlemap.js.
	 * Remember to set API Key.
	 *
	 * @link https://developers.google.com/maps/documentation/javascript/tutorial
	 */		
	wp_register_script( 'malinky-googlemap-api-js',
					   'https://maps.googleapis.com/maps/api/js?key=AIzaSyAAJgPDU4N6eWSgDP_D5t9wGWKw-2qP3ig&callback=malinky_initialize',
						false,
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-googlemap-api-js' );


	/**
	 * Load contact validation scripts.
	 */
	if ( is_page( 'contact' ) ) {

		wp_register_script( 'malinky-validate-js',
							get_template_directory_uri() . '/js/jquery.validate.min.js',
							false,
							NULL,
							true
		);
		wp_register_script( 'malinky-contact',
							get_template_directory_uri() . '/js/contact-validate.min.js',
							array( 'plaay-validate-js' ),
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-contact' );

	}


	/* -------------------------------- *
	 * Dev
	 * -------------------------------- */

	/*
	 * googlemap.js, main.js, owlslider-setup.js, retina.js
	 */
	wp_register_script( 'malinky-scripts-min-js',
						get_template_directory_uri() . '/dev/js/scripts.min.js',
						array( 'jquery' ),
						NULL,
						true
	);
	wp_enqueue_script( 'malinky-scripts-min-js' );

}

add_action( 'wp_enqueue_scripts', 'malinky_scripts' );





/* ------------------------------------------------------------------------ *
 * Widgets
 * ------------------------------------------------------------------------ */

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function malinky_widgets_init()
{

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'malinky' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'malinky' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

}

add_action( 'widgets_init', 'malinky_widgets_init' );





/* ------------------------------------------------------------------------ *
 * Login Screen
 * ------------------------------------------------------------------------ */

/**
 * Change login screen logo url.
 *
 * @return string
 */
function malinky_login_logo_url()
{
	return esc_url ( site_url( '', 'http' ) );
}

add_filter( 'login_headerurl', 'malinky_login_logo_url' );


/**
 * Remove shake on login.
 */
function malinky_login_shake()
{
    remove_action( 'login_head', 'wp_shake_js', 12 );
}

add_action( 'login_head', 'malinky_login_shake' );


/**
 * Style login logo and page.
 */
function malinky_login_screen()
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

add_action( 'login_enqueue_scripts', 'malinky_login_screen' );





/* ------------------------------------------------------------------------ *
 * Wordpress Setup Actions and Filters
 * ------------------------------------------------------------------------ */

remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link. xmlrpc.php
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);


/**
 * Add page slug to body class. Credit: Starkers Wordpress Theme.
 */
function malinky_add_slug_to_body_class($classes)
{

    global $post;

    if ( is_home() ) {

        $key = array_search( 'blog', $classes );

        if ( $key > -1 ) {

            unset( $classes[$key] );

        }

    } elseif ( is_page() ) {

        $classes[] = sanitize_html_class( $post->post_name );

    } elseif ( is_singular() ) {

        $classes[] = sanitize_html_class( $post->post_name );
    }

    return $classes;

}

add_filter( 'body_class', 'malinky_add_slug_to_body_class' ); // Add slug to body class (Starkers build)


/**
 * Remove wp_head() injected recent comment styles.
 */
function malinky_remove_recent_comments_style()
{

    global $wp_widget_factory;

    remove_action( 'wp_head',
    				array(
        				$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        				'recent_comments_style'
        			)
    );

}

add_action('widgets_init', 'malinky_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()


/**
 * CHECK
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
function malinky_tree()
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
function malinky_truncate_words( $text, $length )
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

if ( ! function_exists( 'malinky_posted_on' ) )
{
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function malinky_posted_on()
	{

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( 'Posted on %s', 'post date', 'malinky' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( 'by %s', 'post author', 'malinky' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

	}

}


if ( ! function_exists( 'malinky_entry_footer' ) )
{

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function malinky_entry_footer()
	{
		// Hide category and tag text for pages.
		if ( 'post' == get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'malinky' ) );
			if ( $categories_list && malinky_categorized_blog() ) {
				printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'malinky' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'malinky' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'malinky' ) . '</span>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( __( 'Leave a comment', 'malinky' ), __( '1 Comment', 'malinky' ), __( '% Comments', 'malinky' ) );
			echo '</span>';
		}

		edit_post_link( __( ' | Edit', 'malinky' ), '<span class="edit-link">', '</span>' );

	}

}


if ( ! function_exists( 'malinky_post_nav' ) )
{

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function malinky_post_nav()
	{

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) return; ?>

		<nav class="navigation post-navigation" role="navigation">
			<div class="nav-links">
				<?php
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'malinky' ) );
					next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'malinky' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php

	}

}


if ( ! function_exists( 'malinky_paging_nav' ) )
{

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function malinky_paging_nav()
	{

		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'malinky' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'malinky' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php

	}

}





/* ------------------------------------------------------------------------ *
 * CHECK
 * ------------------------------------------------------------------------ */

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