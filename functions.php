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
 * Setup Actions and Filters
 * Template Tags
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
 * Front End Scripts
 * ------------------------------------------------------------------------ */

/**
 * Enqueue frontend scripts.
 */
function malinky_scripts()
{

	/* -------------------------------- *
	 * Local && Dev && Prod
	 * -------------------------------- */

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
							'/wp-includes/js/jquery/jquery-migrate.min.js',
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


	if ( is_page( 'contact-us' ) ) {

		/**
		 * Load Google maps API. (Script actually enqueued in Local/Dev/Prod below).
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
	
	}


	if ( WP_ENV == 'local' ) {

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
		 * Owl Carousel.
		 *
		 * @link http://owlgraphic.com/
		 */
		wp_register_script( 'malinky-owl-carousel-js',
							get_template_directory_uri() . '/js/owl-carousel.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-owl-carousel-js' );	


		/**
		 * Owl Carousel Setup.
		 *
		 * @link http://owlgraphic.com/
		 */
		wp_register_script( 'malinky-owl-carousel-setup-js',
							get_template_directory_uri() . '/js/owl-carousel-setup.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-owl-carousel-setup-js' );


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

	}


	if ( WP_ENV == 'dev' || WP_ENV == 'prod' ) {

		/* -------------------------------- *
		 * Dev and Prod
		 * -------------------------------- */

		/**
		 * Modernizr which includes html5shiv.
		 *
		 * @link http://modernizr.com/
		 * @link https://github.com/aFarkas/html5shiv
		 */
		wp_register_script( 'malinky-modernizr-min-js',
							get_template_directory_uri() . '/js/modernizr-2.8.3.min.js',
							false,
							NULL
		);
		wp_enqueue_script( 'malinky-modernizr-min-js' );


		/*
		 * googlemap.js, main.js, owl-carousel.js, owl-carousel-setup.js, retina.js
		 */
		wp_register_script( 'malinky-scripts-min-js',
							get_template_directory_uri() . '/js/scripts.min.js',
							array( 'jquery' ),
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-scripts-min-js' );

	}

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
        body.login div#login h1 a {
            background-image: url(<?php echo esc_url( site_url( 'img/graphics/logo.png', 'https' ) ); ?>);
            background-size: 255px;
            width: auto;
        }
        body.login form {
			border: 1px solid #e5e5e5;
			box-shadow: none;
        }
        body.login form .input {
        	background: none;
        }
        body.login h1 a {
        	background-size: auto;
        }
        html.lt-ie9 body.login div#login h1 a {
            background-image: url(<?php echo esc_url( site_url( 'img/graphics/logo.png', 'https' ) ); ?>);
        }
        body.login .button.button-large {
        	height: auto;
        	line-height: normal;
		    padding: 10px;
        }        
        body.login .button-primary {
		    width: auto;
		    height: auto;
		    display: inline-block;
		    background: #9e4381;
		    border: none;
		    border-radius: 0;
		    box-shadow: none;
        }
        body.login .button-primary:hover {
    		background: #852b68;
    		text-shadow: none;
    		box-shadow: none;
        }        
        body.login #nav {
        	text-shadow: none;
			padding: 26px 24px;
			background: #FFFFFF;
			border: 1px solid #e5e5e5;
			box-shadow: none;
			text-align: center;
		}
		body.login #nav a {
		    width: auto;
		    height: auto;
		    display: block;
		    padding: 10px;
		    background: #9e4381;
		    border: none;
		    color: #fff;
		    border-radius: none;
		}
		body.login #nav a:hover {
			color: #fff;
			background: #852b68;
    		text-shadow: none;
    		box-shadow: none;
		}
		body.login #login #backtoblog a:hover {
			color: #999;
		}
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'malinky_login_screen' );





/* ------------------------------------------------------------------------ *
 * Setup Actions and Filters
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


/**
 * Allow SVG into media uploader.
 */
function malinky_mime_types( $mimes )
{

	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
	
}

add_filter('upload_mimes', 'malinky_mime_types');


/**
 * Replace [...] from automatic excerpts.
 */
function malinky_excerpt( $more )
{

	return '...';

}

add_filter( 'excerpt_more', 'malinky_excerpt' );


if ( ! function_exists( 'malinky_read_more_text' ) )
{

	/**
	 * Return read more text for use in the_content and manually after the_excerpt().
	 */
	function malinky_read_more_text()
	{

		return '<span class="content-summary__more-link">Read More...</span>';

	}

}





/* ------------------------------------------------------------------------ *
 * Template Tags
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


if ( ! function_exists( 'malinky_truncate_words' ) )
{

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

}


if ( ! function_exists( 'malinky_content_meta' ) )
{
	/**
	 * Posted and updated dates and author name / link.
	 *
	 * @param bool $show_author Set to false to hide author details.
	 */
	function malinky_content_meta( $show_author = true )
	{

		$posted_time = '';
		$updated_string = '';
		$author = '';

		$posted_time = sprintf( 
			'<time class="content-header__meta__date--published" datetime="%1$s">%2$s</time>', 
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$posted_string = 'Posted on ' . $posted_time;

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {

			$updated_time = sprintf( 
				'<time class="content-header__meta__date--updated" datetime="%1$s">%2$s</time>', 
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$updated_string = ', Updated on ' . $updated_time;

		}

		$author = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';

		if ( ! $show_author )
			return '<span class="content-header__meta__date">' . $posted_string . $updated_string . '</span>';

		return '<span class="content-header__meta__date">' . $posted_string . $updated_string . '</span><span class="byline"> by ' . $author . '</span>';

	}

}


if ( ! function_exists( 'malinky_content_footer' ) )
{

	/**
	 * Post categories, tags and edit link.
	 */
	function malinky_content_footer()
	{

		$categories = '';
		$tags = '';

		//Only show for posts.
		if ( get_post_type() == 'post' ) {

			$categories_list = get_the_category_list( ', ' );
			if ( $categories_list ) {
				$categories = sprintf( '<span class="content-footer__cat-link">Posted in %1$s</span>', $categories_list );
			}

			$tags_list = get_the_tag_list( '', ', ' );
			if ( $tags_list ) {
				$tags = sprintf( '<span class="content-footer__tag-link">Tagged with %1$s</span>', $tags_list );
			}

		}

		$edit_link = sprintf('<span class="content-footer__edit-link"><a href="%1$s">Edit</a></span>', esc_url( get_edit_post_link() ) );

		return $categories . ' ' . $tags . ' ' . $edit_link;

	}

}


if ( ! function_exists( 'malinky_posts_pagination' ) )
{

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function malinky_posts_pagination()
	{

		//Return if only 1 page
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		} ?>

		<nav class="col posts-pagination" role="navigation">

			<div class="col-item col-item-half posts-pagination__link posts-pagination__link--older">
				<?php if ( get_next_posts_link() ) { ?>
						<?php next_posts_link( 'Older Posts' ); ?>
				<?php } ?>
			</div><!--

			--><div class="col-item col-item-half col-item--align-right posts-pagination__link posts-pagination__link--newer">
				<?php if ( get_previous_posts_link() ) { ?>
						<?php previous_posts_link( 'Newer Posts' ); ?>
				<?php } ?>			
			</div>

		</nav><!-- .posts-pagination -->

	<?php }

}


if ( ! function_exists( 'malinky_post_pagination' ) )
{

	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function malinky_post_pagination()
	{

		//Return if no navigation.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) return; ?>

		<nav class="col post-pagination" role="navigation">

			<div class="col-item col-item-half post-pagination__link post-pagination__link--older">
				<?php previous_post_link( '%link', '%title' ); ?>
			</div><!--

			--><div class="col-item col-item-half col-item--align-right post-pagination__link post-pagination__link--newer">
				<?php next_post_link( '%link', '%title' ); ?>
			</div>

		</nav><!-- .post-pagination -->
		
	<?php }

}


if ( ! function_exists( 'malinky_archive_title' ) ) {

	/**
	 * Shim for `the_archive_title()`.
	 *
	 * Display the archive title based on the queried object.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */
	function malinky_archive_title( $before = '', $after = '' )
	{

		if ( is_category() ) {
			$title = sprintf( __( 'Category: %s', 'malinky' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( 'Tag: %s', 'malinky' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s', 'malinky' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'malinky' ), get_the_date( _x( 'Y', 'yearly archives date format', 'malinky' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'malinky' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'malinky' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'malinky' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'malinky' ) ) );
		} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'malinky' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'malinky' );
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s', 'malinky' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'malinky' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'malinky' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @param string $title Archive title to be displayed.
		 */
		$title = apply_filters( 'get_the_archive_title', $title );

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}

	}

}


if ( ! function_exists( 'malinky_archive_description' ) ) {

	/**
	 * Shim for `the_archive_description()`.
	 *
	 * Display category, tag, or term description.
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 *
	 * @param string $before Optional. Content to prepend to the description. Default empty.
	 * @param string $after  Optional. Content to append to the description. Default empty.
	 */
	function malinky_archive_description( $before = '', $after = '' )
	{

		$description = apply_filters( 'get_the_archive_description', term_description() );

		if ( ! empty( $description ) ) {
			/**
			 * Filter the archive description.
			 *
			 * @see term_description()
			 *
			 * @param string $description Archive description to be displayed.
			 */
			echo $before . $description . $after;
		}

	}

}