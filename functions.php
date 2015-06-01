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
 * Template Functions
 * MCE
 * Settings Plugin
 * Contact Form Plugin
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
			'main_navigation' 	=> __( 'Main Navigation', 'malinky' ),
			'mobile_navigation' 	=> __( 'Mobile Navigation', 'malinky' ),
			'footer_navigation' => __( 'Footer Navigation', 'malinky' ),
		) );

		/**
		 * Include server side device detection.
		 *
		 * @link http://mobiledetect.net/
		 * @link https://github.com/serbanghita/Mobile-Detect/
		 */
		if ( ! is_admin() ) {

			if ( WP_ENV == 'local' ) {

			    require_once(ABSPATH . '../malinky-includes/Mobile_Detect.php');

			} elseif ( WP_ENV == 'dev' ) {

			    require_once(ABSPATH . '../../../malinky-includes/Mobile_Detect.php');    

			} else {

			    require_once(ABSPATH . '../../malinky-includes/Mobile_Detect.php');

			}

			global $malinky_mobile_detect;
			$malinky_mobile_detect = new Mobile_Detect();

			function malinky_is_phone()
			{
				global $malinky_mobile_detect;
				if ( $malinky_mobile_detect->isMobile() && ! $malinky_mobile_detect->isTablet() )
					return true;
			}

			function malinky_is_phone_tablet()
			{
				global $malinky_mobile_detect;
				if ( $malinky_mobile_detect->isMobile() || $malinky_mobile_detect->isTablet() )
					return true;
			}	

			function malinky_is_phone_computer()
			{
				global $malinky_mobile_detect;
				if ( ! $malinky_mobile_detect->isTablet() )
					return true;
			}						

			function malinky_is_tablet()
			{
				global $malinky_mobile_detect;
				if ( $malinky_mobile_detect->isTablet() )
					return true;
			}

			function malinky_is_tablet_computer()
			{
				global $malinky_mobile_detect;
				if ( $malinky_mobile_detect->isTablet() || ! $malinky_mobile_detect->isMobile() )
					return true;
			}			

			function malinky_is_computer()
			{
				global $malinky_mobile_detect;
				if ( ! $malinky_mobile_detect->isMobile() && ! $malinky_mobile_detect->isTablet() )
					return true;
			}	

		}

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


	if ( WP_ENV == 'local' ) {

		/* -------------------------------- *
		 * Local
		 * -------------------------------- */

		/**
		 * Stylesheet which includes normalize.
		 */
		wp_enqueue_style( 'malinky-style', get_stylesheet_uri() );


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

	}


	if ( WP_ENV == 'dev' || WP_ENV == 'prod' ) {

		/* -------------------------------- *
		 * Dev && Prod
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
		 * googlemap.js, main.js, owl-carousel.js, owl-carousel-setup.js
		 */
		wp_register_script( 'malinky-scripts-min-js',
							get_template_directory_uri() . '/js/scripts.min.js',
							array( 'jquery' ),
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-scripts-min-js' );

	}


	/* -------------------------------- *
	 * Google Maps Local && Dev && Prod
	 * -------------------------------- */

	/**
	 * Google Map Set Up.
	 * If there are settings in admin.
	 * Localize them and then they are directly available as json in googlemap.js.
	 */
	$google_map_settings = get_option( '_000004_google_map_settings' );

		/*
		 * Check it exists (isn't false) then if on the correct page.
		 */
		if ( ! empty ( $google_map_settings['google_map_page'] ) && is_page( $google_map_settings['google_map_page'] ) ) {

			/* --------------- *
			 * Local
			 * No API Key
			 * --------------- */
			if ( WP_ENV == 'local' ) {

				/**
				 * Google Map Set Up.
				 * 
				 * Settings can be accessed from googlemap.js with google_map_settings.SETTING_KEY
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/
				 */
				wp_register_script( 'malinky-googlemap-js',
									get_template_directory_uri() . '/js/googlemap.js',
									false,
									NULL,
									true
				);
				wp_localize_script( 'malinky-googlemap-js', 'google_map_settings', $google_map_settings );
				wp_enqueue_script( 'malinky-googlemap-js' );


				/**
				 * Load Google maps API without key.
				 * Uses malinky_initialize function which is in googlemap.js.
				 * Remember to set API Key.
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/tutorial
				 */
				wp_register_script( 'malinky-googlemap-api-js', 
									'https://maps.googleapis.com/maps/api/js?callback=malinky_initialize', 
									false, 
									NULL, 
									true
				);

			}


			/* --------------- *
			 * Dev && Prod
			 * API Key
			 * --------------- */

			if ( WP_ENV == 'dev' || WP_ENV == 'prod' ) {

				/**
				 * Google Map Set Up.
				 * 
				 * Settings can be accessed from googlemap.js with google_map_settings.SETTING_KEY
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/
				 */
				wp_register_script( 'malinky-googlemap-min-js',
									get_template_directory_uri() . '/js/googlemap.min.js',
									false,
									NULL,
									true
				);
				wp_localize_script( 'malinky-googlemap-min-js', 'google_map_settings', $google_map_settings );
				wp_enqueue_script( 'malinky-googlemap-min-js' );


				/*
				 * Get my default API Key if one isn't set.
				 */
				$google_map_settings['api_key'] == '' ? 'AIzaSyBC4B2o5cX8GuFyKrh1CpwtdVz7-j5ccOg' : $google_map_settings['api_key'];

				/**
				 * Load Google maps API without key.
				 * Uses malinky_initialize function which is in googlemap.js.
				 * Remember to set API Key.
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/tutorial
				 */
				wp_register_script( 'malinky-googlemap-api-js', 
							'https://maps.googleapis.com/maps/api/js?key=' . $google_map_settings['api_key'] . '&callback=malinky_initialize', 
							false, 
							NULL, 
							true
				);

			}

			wp_enqueue_script( 'malinky-googlemap-api-js' );

		}

}

add_action( 'wp_enqueue_scripts', 'malinky_scripts' );


/**
 * Filter to amend the script tags that are loaded.
 * Currently adding async to the Google Map script tag.
 */
function malinky_javascript_loader( $tag, $handle, $src )
{
	
	if ( is_admin() ) return $tag;

	if ( $handle == 'malinky-googlemap-api-js' ) {
		$tag = str_replace('src=', 'async src=', $tag);
	}

	return $tag;

}

add_filter( 'script_loader_tag', 'malinky_javascript_loader', 10, 3 );





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
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
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
	return esc_url ( home_url( '', 'http' ) );
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
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/mobile.png);
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
            background-image: url(<?php echo get_template_directory_uri(); ?>/img/mobile.png);
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
        body.login .button-primary:hover,
        body.login .button-primary:focus,
        body.login .button-primary:active {
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
		body.login #nav a:hover,
		body.login #nav a:focus,
		body.login #nav a:active {
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
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

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


/**
 * Remove hentry from post class for pages.
 */
function malinky_remove_hentry( $classes )
{
    if ( is_page() ) {
        $classes = array_diff( $classes, array( 'hentry' ) );
    }
    return $classes;
}

add_filter( 'post_class','malinky_remove_hentry' );





/* ------------------------------------------------------------------------ *
 * Template Tags
 * ------------------------------------------------------------------------ */

/**
 * Get all page names (page_title).
 *
 * @param str $default Add a default option if page names are to be used in a dropdown.
 * @return array
 */
function malinky_get_page_names( $default )
{

	$malinky_all_pages = '';
	$malinky_page_titles = '';
	
	$args = array(
		'hierarchical' => 0
	);

	if ( $default )
		$malinky_page_titles[] = $default;

	$malinky_all_pages = get_pages( $args );
	foreach ( $malinky_all_pages as $key => $value ) {
		$malinky_page_titles[] = $malinky_all_pages[$key]->post_title;
	}

	return $malinky_page_titles;

}


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
 * Get a page ID from the slug.
 *
 * @param string $post_slug
 * @return int
 */
function malinky_id_by_slug( $post_slug )
{
    $post = get_page_by_path( $post_slug );
    if ( $post ) {
        return $post->ID;
    } else {
        return null;
    }
}


if ( ! function_exists( 'malinky_acf_image_array' ) ) {

	/**
	 * Output an image URL from ACF that is added as an image_array.
	 * Check for get_field and get_sub_field.
	 *
	 * @param string $malinky_acf_field_name ACF field name
	 * @param string $image_size image_size to output
	 * @return str
	 */
	function malinky_acf_image_array( $malinky_acf_field_name, $image_size = '' )
	{
		$malinky_acf_hero_shot = get_field( $malinky_acf_field_name );
		
		if ( ! $malinky_acf_hero_shot ) {
			$malinky_acf_hero_shot = get_sub_field( $malinky_acf_field_name );
		}

		if ( ! $malinky_acf_hero_shot ) return;

		if ( $image_size ) {
			$malinky_acf_hero_shot = $malinky_acf_hero_shot['sizes'][ $image_size ];
		} else {
			$malinky_acf_hero_shot = $malinky_acf_hero_shot['url'];
		}
		
		return $malinky_acf_hero_shot;
	}

}


if ( ! function_exists( 'malinky_image_url' ) ) {

	/**
	 * Output an image URL based on the attachment id and size.
	 *
	 * @param string $attachment_id The attachment id
	 * @param string $attachment_size The attachment image_size to output
	 * @return str
	 */
	function malinky_image_url( $attachment_id, $attachment_size )
	{
		$malinky_attachment = wp_get_attachment_image_src( $attachment_id, $attachment_size );
		if ($malinky_attachment) return $malinky_attachment[0];
	}

}


if ( ! function_exists( 'malinky_truncate_words' ) ) {

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


if ( ! function_exists( 'malinky_content_meta' ) ) {
	/**
	 * Posted and updated dates and author name / link.
	 *
	 * @param bool $show_author Set to false to hide author details.
	 */
	function malinky_content_meta( $show_updated = true, $show_author = true, $show_date_only = false )
	{

		$posted_time = '';
		$updated_string = '';
		$author = '';

		$posted_time = sprintf( 
			'<time class="content-header__meta__date--published" datetime="%1$s" itemprop="datePublished">%2$s</time>', 
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'F Y') )
		);

		if ( $show_date_only ) return $posted_time;
		
		$posted_string = 'Completed in ' . $posted_time;

		if ( $show_updated ) {
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {

				$updated_time = sprintf( 
					'<time class="content-header__meta__date--updated" datetime="%1$s" itemprop="dateModified">%2$s</time>', 
					esc_attr( get_the_modified_date( 'c' ) ),
					esc_html( get_the_modified_date() )
				);

				$updated_string = ', Updated on ' . $updated_time;

			}
		}

		$author = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>';

		if ( ! $show_author )
			return '<span class="content-header__meta__date">' . $posted_string . $updated_string . '</span>';

		return '<span class="content-header__meta__date">' . $posted_string . $updated_string . '</span><span class="byline"> by ' . $author . '</span>';

	}

}


if ( ! function_exists( 'malinky_content_footer' ) ) {

	/**
	 * Post categories, tags and edit link.
	 */
	function malinky_content_footer( $show_categories = true, $show_tags = true , $show_edit_link = true )
	{

		$categories = '';
		$tags = '';
		$edit_link = '';

		//Only show for posts.
		if ( get_post_type() == 'post' ) {

			if ( $show_categories ) {
				$categories_list = get_the_category_list( ', ' );
				if ( $categories_list ) {
					$categories = sprintf( '<span class="content-footer__cat-link">Posted in %1$s</span>. ', $categories_list );
				}
			}

			if ( $show_tags ) {
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ) {
					$tags = sprintf( '<span class="content-footer__tag-link">Tagged as %1$s</span>. ', $tags_list );
				}
			}

		}

		if ( $show_edit_link ) {
			$edit_link = sprintf( '<span class="content-footer__edit-link"><a href="%1$s">Edit</a></span>', esc_url( get_edit_post_link() ) );
		}

		return $categories . $tags . $edit_link;

	}

}


if ( ! function_exists( 'malinky_content_hatom_footer' ) ) {

	/**
	 * Cretae author, published and updated tags for use in htaom feed in google structured data.
	 * Stops errors and warnings being generated.
	 * Use on pages that wouldn't naturally show any of the above.
	 * Set to display: none;
	 */
	function malinky_content_hatom_footer( $author = true, $published = true, $updated = true )
	{

		$malinky_hatom = '';

		if ( $author )
			$malinky_hatom .= '<span class="vcard author"><span class="fn">' . esc_html( get_bloginfo( 'name') ) . '</span></span>';

		if ( $published )
			$malinky_hatom .= '<span class="date published">' . esc_html ( get_the_date('c') ) . '</span>';

		if ( $updated )
			$malinky_hatom .= '<span class="date updated">' . esc_html ( get_the_modified_date('c') ) . '</span>';

		return '<span style="display: none">' . $malinky_hatom . '</span>';
	
	}

}


if ( ! function_exists( 'malinky_posts_pagination' ) ) {

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function malinky_posts_pagination()
	{

		global $wp_query;

		//Return if only 1 page
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		} ?>

		<nav class="col col--gutterless posts-pagination" role="navigation">

			<div class="col-item col-item-half posts-pagination__link posts-pagination__link--newer">
				<?php if ( get_previous_posts_link() ) { ?>
						<?php previous_posts_link( 'Newer Posts' ); ?>
				<?php } ?>			
			</div><!--

			--><div class="col-item col-item-half col-item--align-right posts-pagination__link posts-pagination__link--older">
				<?php if ( get_next_posts_link() ) { ?>
						<?php next_posts_link( 'Older Posts' ); ?>
				<?php } ?>
			</div>

		</nav><!-- .posts-pagination -->

	<?php }

}


if ( ! function_exists( 'malinky_post_pagination' ) ) {

	/**
	 * Display navigation to next/previous post when applicable.
	 * This is amended from the master in malinky wordpress starter theme.
	 * It now only searches current single category and uses a ACF field for the link text if available.
	 */
	function malinky_post_pagination()
	{

		//Return if no navigation.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( true, '', true );
		$next     = get_adjacent_post( true, '', false );

		if ( ! $next && ! $previous ) return;

		if ( $previous ) {
			$previous_title = get_field( 'title', $previous->ID ) != '' ? get_field( 'title', $previous->ID ) : '%title';
		} else {
			$previous_title = '%title';
		}

		if ( $next ) {
			$next_title = get_field( 'title', $next->ID ) != '' ? get_field( 'title', $next->ID ) : '%title';
		} else {
			$next_title = '%title';
		}
		
		?>

		<nav class="col col--gutterless post-pagination" role="navigation">

			<div class="col-item col-item-half post-pagination__link post-pagination__link--older">
				<?php previous_post_link( '%link', $previous_title, true ); ?>
			</div><!--

			--><div class="col-item col-item-half col-item--align-right post-pagination__link post-pagination__link--newer">
				<?php next_post_link( '%link', $next_title, true ); ?>
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
			$title = sprintf( __( '%s', 'malinky' ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( '%s Projects', 'malinky' ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s', 'malinky' ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( '%s Projects', 'malinky' ), get_the_date( _x( 'Y', 'yearly archives date format', 'malinky' ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( '%s Projects', 'malinky' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'malinky' ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( '%s Projects', 'malinky' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'malinky' ) ) );
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
			$title = sprintf( __( '%s', 'malinky' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			//$title = sprintf( __( '%1$s: %2$s', 'malinky' ), $tax->labels->singular_name, single_term_title( '', false ) );
			/* translators: 1: Current taxonomy term */
			$title = sprintf( __( '%1$s', 'malinky' ), single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'malinky' );
		}

		$title = ucwords( $title );

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
	function malinky_archive_description( $before = '', $after = '', $is_cpt = false , $cpt = '')
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

		if ( $is_cpt ) {
			$obj = get_post_type_object( $cpt );
			echo $obj->description;
		}
		

	}

}


if ( ! function_exists( 'malinky_static_page_for_posts' ) ) {

	/**
	 * Show title or content from the blog home when set as a static page, usually in home.php template.
	 *
	 * @param str $return The data to return either 'title' or 'description'
	 *
	 * @return str
	 */
	function malinky_static_page_for_posts( $return = 'title' )
	{

		global $post;

		$return_content = '';
		$blog_home_id = get_option( 'page_for_posts' );
		
		if ( $blog_home_id ) {

		    $post = get_page( $blog_home_id );
		    setup_postdata( $post );

		    $return_content = $return == 'description' ? get_the_content() : get_the_title();
		    
		    rewind_posts();

		    return $return_content;

		}

	}

}





/* ------------------------------------------------------------------------ *
 * Template Functions
 * ------------------------------------------------------------------------ */

if ( ! function_exists( 'malinky_is_blog_page' ) ) {

	/**
	 * Check if current page is the blog home page, archive or single.
	 * Archive includes category, tag, date, author pages.
	 * The function excludes CPT to just use native blog/posts.
	 *
	 * @param bool $single Whether to include is_single()
	 *
	 * @return bool
	 */
	function malinky_is_blog_page( $single = true )
	{

	    global $post;

	    $post_type = get_post_type($post);

	    if ( ! $single ) 
	    	return ( ( is_home() || is_archive() ) && ( $post_type == 'post' ) );

	    return ( ( is_home() || is_archive() || is_single() ) && ( $post_type == 'post' ) );

	}

}


if ( ! function_exists( 'malinky_cpt_menu_item_classes' ) ) {

	/**
	 * Add current_page_parent class to Custom Post Type menu items.
	 * Works on a CPT archive, single or custom taxonomy and multiple CPT at once.
	 * Custom taxonomy must be in the CPT.
	 *
	 * Removes current_page_parent class when on one of the above from the Posts page that has been set set in Settings->Reading.
	 *
	 * Thanks to https://gist.github.com/jjeaton/5522014 for a start.
	 *
	 * @param array  $classes CSS classes for the menu item
	 * @param object $item    WP_Post object for current menu item
	 */
	function malinky_cpt_menu_item_classes( $classes, $item )
	{

		/*
		 * Get array of all custom post types, not builtin.
		 */
		$custom_post_types = get_post_types( array( '_builtin' => false ) );

		if ( get_query_var( 'post_type' ) || get_query_var( 'taxonomy' ) ) {
			/*
			 * Remove current_page_parent from the Posts page that has been set in Settings->Reading.
			 * Comparison is done on the post ID.
			 */
			if( $item->object_id == get_option( 'page_for_posts' ) ) {
				$classes = array_diff( $classes, array( 'current_page_parent' ) );
			}

		}

		if ( get_query_var( 'post_type' ) ) {

			/*
			 * Add current_page_parent.
			 * Where the $item->object (which is the post type of the menu item) is in $custom_post_types.
			 * And where $item->object is equal to the current post type.
			 */
			if ( in_array( $item->object, $custom_post_types ) && $item->object == get_query_var( 'post_type' ) ) {
				$classes[] = 'current_page_parent';
			}

		}

		if ( get_query_var( 'taxonomy' ) ) {

			/*
			 * Add current_page_parent.
			 * First where the $item->object (which is the post type of the menu item) is a custom post type.
			 * Then if the current taxonomy is attached to the found custom post type.
			 */		
			if ( $post_type_object = get_post_type_object( $item->object ) ) {
				if ( in_array( get_query_var( 'taxonomy' ), $post_type_object->taxonomies ) ) {
					$classes[] = 'current_page_parent';
				}
			}

		}

		return $classes;

	}

	add_filter( 'nav_menu_css_class', 'malinky_cpt_menu_item_classes', 10, 2 );

}





/* ------------------------------------------------------------------------ *
 * Tiny MCE
 * ------------------------------------------------------------------------ */

/**
 * Callback function to insert 'styleselect' into the $buttons array.
 */
function malinky_mce_insert_formats_dropdown( $buttons )
{

	array_unshift( $buttons, 'styleselect' );
	return $buttons;

}

add_filter('mce_buttons_2', 'malinky_mce_insert_formats_dropdown');


/**
 * Callback function to filter the MCE settings and insert formats into the new dropdown.
 */
function malinky_mce_insert_formats( $init_array )
{  

	$style_formats = array(  
		array(  
			'title' => 'Heading 1 Style',
    		'block' => 'p',
    		'classes' => 'heading-1'
		),
		array(  
			'title' => 'Heading 2 Style',
    		'block' => 'p',
    		'classes' => 'heading-2'
		),
		array(  
			'title' => 'Heading 3 Style',
    		'block' => 'p',
    		'classes' => 'heading-3'
		),
		array(  
			'title' => 'Heading 4 Style',
    		'block' => 'p',
    		'classes' => 'heading-4'
		),
		array(  
			'title' => 'Heading 5 Style',
    		'block' => 'p',
    		'classes' => 'heading-5'
		),						
		array(  
			'title' => 'Heading 6 Style',
    		'block' => 'p',
    		'classes' => 'heading-6'
		),
		array(
			'title' => 'Text No Margin',
    		'selector' => 'p, h1, h2, h3, h4, h5, h6',
    		'classes' => 'no-margin'
		),
		array(
			'title' => 'List',
    		'selector' => 'ul, ol',
    		'classes' => 'list-content'
		),
		array(
			'title' => 'List 2 Column',
    		'selector' => 'ul, ol',
    		'classes' => 'list-two-column'
		)							
	);

	/*
	 * Insert the array, JSON ENCODED, into 'style_formats'.
	 */
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;
  
} 

add_filter( 'tiny_mce_before_init', 'malinky_mce_insert_formats' );


/**
 * Add the above formats to the quicktag buttons in the Text/HTML editor.
 */ 
function malinky_mce_quicktags()
{

    if ( wp_script_is( 'quicktags' ) ) { ?>

	    <script type="text/javascript">
		    QTags.addButton( 'mm_heading1', 'mm_heading1', '<p class="heading-1">', '</p>', '', 'Heading 1 Style' );
		    QTags.addButton( 'mm_heading2', 'mm_heading2', '<p class="heading-2">', '</p>', '', 'Heading 2 Style' );
		    QTags.addButton( 'mm_heading3', 'mm_heading3', '<p class="heading-3">', '</p>', '', 'Heading 3 Style' );
		    QTags.addButton( 'mm_heading4', 'mm_heading4', '<p class="heading-4">', '</p>', '', 'Heading 4 Style' );
		    QTags.addButton( 'mm_heading5', 'mm_heading5', '<p class="heading-5">', '</p>', '', 'Heading 5 Style' );
		    QTags.addButton( 'mm_heading6', 'mm_heading6', '<p class="heading-6">', '</p>', '', 'Heading 6 Style' );
	    </script>

	<?php
    }

}

add_action( 'admin_print_footer_scripts', 'malinky_mce_quicktags' );





/* ------------------------------------------------------------------------ *
 * Settings Plugin
 * ------------------------------------------------------------------------ */

if ( class_exists( 'Malinky_Settings_Plugin' ) ) {

	global $settings_object;

	$master_args = array(
		0 => array(
			'malinky_settings_page_title' 			=> 'Site Settings',
			'malinky_settings_menu_title' 			=> 'Site Settings',
			'malinky_settings_page_parent_slug'		=> 'options-general.php',
			'malinky_settings_page_tabs'			=> array(),
			'malinky_settings_capability' 			=> 'manage_options',
			'malinky_settings_sections' 			=> array(
				array(
					'section_title' 	=> 'Contact Information',
					'section_intro' 	=> '',
				),
				array(
					'section_title' 	=> 'Contact Form Settings',
					'section_intro' 	=> '',
				),
				array(
					'section_title' 	=> 'Google Analytics Setting',
					'section_intro' 	=> '',
				),
				array(
					'section_title' 	=> 'Google Map Settings',
					'section_intro' 	=> '',
				)				
			),
			'malinky_settings_fields' 			=> array(
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Address',
					'option_field_type' 		=> 'editor_field',
					'option_field_type_options' => array(
					),
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),			
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Email Address',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(
						'email'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Phone Number',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(
						'phone'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Mobile Number',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(
						'phone'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Facebook Account',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(
						'url'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Twitter Account',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(
						'url'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Information',
					'option_title' 				=> 'Google Plus Account',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Information',
					'option_validation' 		=> array(
						'url'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),											
				array(
					'option_group_name' 		=> 'Contact Form Settings',
					'option_title' 				=> 'Contact Form Page',
					'option_field_type' 		=> 'select_field',
					'option_field_type_options' => malinky_get_page_names( 'Disabled' ),
					'option_section' 			=> 'Contact Form Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> 'Select the page that the [malinky-contact-form] shortcode has been added to.',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Form Settings',
					'option_title' 				=> 'Contacted Message',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),
					'option_section' 			=> 'Contact Form Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> 'If left blank will display: Thanks for contacting us, we will be in touch as soon as possible.',
					'option_default'			=> array(
						''
					)
				),								
				array(
					'option_group_name' 		=> 'Contact Form Settings',
					'option_title' 				=> 'Email Address',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Form Settings',
					'option_validation' 		=> array(
						'email'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Form Settings',
					'option_title' 				=> 'Email Password',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Form Settings',
					'option_validation' 		=> array(),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Form Settings',
					'option_title' 				=> 'Email Host',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Form Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Contact Form Settings',
					'option_title' 				=> 'Email Port',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Contact Form Settings',
					'option_validation' 		=> array(
						'numbers'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> '',
					'option_title' 				=> 'Google Analytics',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Google Analytics Setting',
					'option_validation' 		=> array(
						'googleua'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'Google Map Page',
					'option_field_type' 		=> 'select_field',
					'option_field_type_options' => malinky_get_page_names( 'Disabled' ),
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> 'Select the page that the [malinky-contact-form] shortcode has been added to.',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'API Key',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> 'Leave blank to use Malinky Media\'s API Key.',
					'option_default'			=> array(
						''
					)
				),				
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'Lat',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'Long',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(
						'text'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'Zoom',
					'option_field_type' 		=> 'text_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(
						'numbers'
					),
					'option_placeholder'		=> '',
					'option_description'		=> '14 is the recommended default.',
					'option_default'			=> array(
						'14'
					)
				),
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'Show Address Label',
					'option_field_type' 		=> 'checkbox_field',
					'option_field_type_options' => array(
					),			
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				),
				array(
					'option_group_name' 		=> 'Google Map Settings',
					'option_title' 				=> 'Address Label',
					'option_field_type' 		=> 'editor_field',
					'option_field_type_options' => array(
					),
					'option_section' 			=> 'Google Map Settings',
					'option_validation' 		=> array(),
					'option_placeholder'		=> '',
					'option_description'		=> '',
					'option_default'			=> array(
						''
					)
				)
			)
		)
	);

	foreach ($master_args as $k => $v) {
		$settings_object = 'malinky_settings_plugin_' . $k;
		$settings_object = new Malinky_Settings_Plugin($master_args[$k]);
	}

	//echo $settings_object->malinky_settings_get_option_functions($settings_object->all_option_names);
	//print_r($settings_object->all_option_names);

}


/**
 * Shortcode to display Google Map.
 */
function malinky_google_map_shortcode()
{

	$google_map_settings = get_option( '_000004_google_map_settings' );
	
	/*
	 * Check it exists (isn't false) then if on the correct page.
	 */
	if ( ! empty( $google_map_settings['google_map_page'] ) && is_page( $google_map_settings['google_map_page'] ) ) {

		ob_start(); ?>

		<div id="map-canvas"></div>

		<?php return ob_get_clean();

	}
		
}

add_shortcode( 'malinky-google-map', 'malinky_google_map_shortcode' );





/* ------------------------------------------------------------------------ *
 * Contact Form Plugin
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to display the contact form.
 */
function malinky_contact_form_shortcode()
{

	global $malinky_error_messages;

	$name 		= isset( $_POST['malinky_name'] ) ? $_POST['malinky_name'] : '';
	$company	= isset( $_POST['malinky_company'] ) ? $_POST['malinky_company'] : '';
	$email 		= isset( $_POST['malinky_email'] ) ? $_POST['malinky_email'] : '';
	$phone 		= isset( $_POST['malinky_phone'] ) ? $_POST['malinky_phone'] : '';	
	$message 	= isset( $_POST['malinky_message'] ) ? $_POST['malinky_message'] : '';

	$contact_form_page = get_option( '_000002_contact_form_settings' );

	/*
	 * Check it exists (isn't false) then if on the correct page.
	 */
	if ( ! empty( $contact_form_page['contact_form_page'] ) && is_page( $contact_form_page['contact_form_page'] ) ) {

		ob_start(); ?>

		<div class="col contact-form">
			<div class="col-item col-item-full">

				<?php if ( isset( $_GET['contact'] ) && $_GET['contact'] == 'success' ) { ?>
					
					<?php
					$contact_form_page = get_option( '_000002_contact_form_settings' );
					?>

					<div class="box success">
						<?php echo empty( $contact_form_page['contacted_message'] ) ? 'Thanks for contacting us, we will be in touch as soon as possible.' : $contact_form_page['contacted_message']; ?>
					</div>

				<?php } ?>

				<form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" role="form">

					<label for="malinky_name">Name*</label>
					<input type="text" name="malinky_name" id="malinky_name" placeholder="" value="<?php echo esc_attr( wp_unslash( $name ) ); ?>" required>
					<?php if (isset($malinky_error_messages['name_error'][0])) echo '<p class="box error">' . $malinky_error_messages['name_error'][0] . '</p>'; ?>

					<label for="malinky_company">Company</label>
					<input type="text" name="malinky_company" id="malinky_company" placeholder="" value="<?php echo esc_attr( wp_unslash( $company ) ); ?>">

					<label for="malinky_email">Email*</label>
					<input type="email" name="malinky_email" id="malinky_email" placeholder="" value="<?php echo esc_attr( wp_unslash( $email ) ); ?>" required>
					<?php if (isset($malinky_error_messages['email_error'][0])) echo '<p class="box error">' . $malinky_error_messages['email_error'][0] . '</p>'; ?>
					
					<label for="malinky_phone">Phone</label>
					<input type="tel" name="malinky_phone" id="malinky_phone" value="<?php echo esc_attr( wp_unslash( $phone ) ); ?>">
					<?php if (isset($malinky_error_messages['phone_error'][0])) echo '<p class="box error">' . $malinky_error_messages['phone_error'][0] . '</p>'; ?>

					<label for="malinky_message">Message*</label>
					<textarea name="malinky_message" id="malinky_message" rows="10" cols="30" required><?php echo esc_textarea( wp_unslash( $message ) ); ?></textarea>
					<?php if (isset($malinky_error_messages['message_error'][0])) echo '<p class="box error">' . $malinky_error_messages['message_error'][0] . '</p>'; ?>
					<?php wp_nonce_field( 'malinky_process_contact_form', 'malinky_process_contact_form_nonce' ); ?>
					
					<input type="submit" value="Submit" name="submit_contact" class="alignright">

				</form>

			</div>
		</div>

		<?php return ob_get_clean();

	}

}

add_shortcode( 'malinky-contact-form', 'malinky_contact_form_shortcode' );


/**
 * Called from header.php to check if on the selected contact form page for form processing.
 */
function malinky_contact_form_header()
{

	$contact_form_page = get_option( '_000002_contact_form_settings' );
	
	/*
	 * Check it exists (isn't false) then if on the correct page.
	 */
	if ( ! empty( $contact_form_page['contact_form_page'] ) && is_page( $contact_form_page['contact_form_page'] ) ) {

		$error_messages 	= array();
		$name 				= isset( $_POST['malinky_name'] ) ? $_POST['malinky_name'] : '';
		$company			= isset( $_POST['malinky_company'] ) ? $_POST['malinky_company'] : '';
		$email 				= isset( $_POST['malinky_email'] ) ? $_POST['malinky_email'] : '';
		$phone 				= isset( $_POST['malinky_phone'] ) ? $_POST['malinky_phone'] : '';	
		$message 			= isset( $_POST['malinky_message'] ) ? $_POST['malinky_message'] : '';

		if ( ! empty( $_POST['submit_contact'] ) ) {	
			$errors = malinky_contact_form_process( $name, $company, $email, $phone, $message );
			if ( is_wp_error( $errors ) ) {
				global $malinky_error_messages;
				$malinky_error_messages = $errors->errors;
			} else {
				$success = $errors;
			}
		}

	}

}


/**
 * Process the contact form and error checking.
 * 
 * @param string $name 
 * @param string $company
 * @param string $phone
 * @param string $email  
 * @param string $message     
 * @return void
 */
function malinky_contact_form_process( $name, $company, $email, $phone, $message )
{

	//check form submit and nonce
	if ( ( empty($_POST['submit_contact'] ) ) || ( ! isset( $_POST['malinky_process_contact_form_nonce'] ) ) || ( ! wp_verify_nonce( $_POST['malinky_process_contact_form_nonce'], 'malinky_process_contact_form' ) ) )
		wp_die( __( 'There was a fatal error with your form submission' ) );

	$errors = new WP_Error();
	$contact_error_messages = malinky_contact_form_error_messages();

	$sanitized_name 		= sanitize_text_field( $name );
	$sanitized_company 		= sanitize_text_field( $company );
	$sanitized_email 		= sanitize_email( $email );	
	$sanitized_phone 		= sanitize_text_field( $phone );	
	$sanitized_message 		= sanitize_text_field( $message );			

	//check the first_name
	if ( $sanitized_name == '' ) {
		$errors->add( 'name_error', __( $contact_error_messages['name_error'] ) );
	}

	//check the email
	if ( $sanitized_email == '' ) {
		$errors->add( 'email_error', __( $contact_error_messages['email_error'] ) );
	} elseif ( ! is_email( $sanitized_email ) ) {
		$errors->add('email_error', __( $contact_error_messages['email_error'] ) );
	}

	//check the phone
	if ( $sanitized_phone != '' ) {
		if ( ! preg_match( '/[0-9 ]+$/', $sanitized_phone ) ) {		
			$errors->add( 'phone_error', __( $contact_error_messages['phone_error_2'] ) );
		}
	}		

	//check the message
	if ( $sanitized_message == '' ) {
		$errors->add( 'message_error', __( $contact_error_messages['message_error'] ) );
	}

	//if validation errors
	if ( $errors->get_error_code() )
		return $errors;

	//send registration email
	malinky_contact_form_email( $sanitized_name, $sanitized_company, $sanitized_email, $sanitized_phone, $sanitized_message );

	global $post;
	wp_safe_redirect( $post->post_name . '?contact=success', 303 );

}


/**
 * Contact form errors.
 */
function malinky_contact_form_error_messages()
{

	return array(
		'name_error'		=> 'Please enter your name.',
		'email_error'		=> 'Please enter a valid email address.',		
		'phone_error'		=> 'Please enter your phone number.',
		'phone_error_2'		=> 'Please enter a valid phone number.',
		'message_error'		=> 'Please enter a message.',
	);

}


/**
 * Send the contact form email.
 * 
 * @param string $sanitized_name  
 * @param string $sanitized_company  
 * @param string $sanitized_email  
 * @param string $sanitized_phone
 * @param string $sanitized_message      
 * @return void   
 */
function malinky_contact_form_email( $sanitized_name, $sanitized_company, $sanitized_email, $sanitized_phone, $sanitized_message )
{

	include_once( ABSPATH . WPINC . '/class-phpmailer.php' );

	$email_settings = get_option( '_000002_contact_form_settings' );

	if ( ! $email_settings ) return;
	
	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host 		= $email_settings['email_host'];
	$mail->SMTPAuth   	= true;
	$mail->Port       	= $email_settings['email_port'];
	$mail->Username   	= $email_settings['email_address'];
	$mail->Password   	= $email_settings['email_password'];
	$mail->SMTPSecure 	= 'ssl';	

	$mail->AddAddress( get_option( 'admin_email' ), get_bloginfo( 'name' ) );

	$mail->SetFrom( get_option( 'admin_email' ), get_bloginfo( 'name' ) );

	$mail->IsHTML(true);

	$mail->Subject 	= get_bloginfo( 'name' ) . ' Contact Form Message';
	$mail->Body    	= '<p>Name: ' . $sanitized_name . '</p>';
	$mail->Body    .= '<p>Company: ' . $sanitized_email . '</p>';
	$mail->Body    .= '<p>Email: ' . $sanitized_email . '</p>';
	$mail->Body    .= '<p>Phone: ' . $sanitized_phone . '</p>';
	$mail->Body    .= '<p>Message: ' . $sanitized_message . '</p>';			

	if( ! $mail->Send() ) {
		error_log( $mail->ErrorInfo, 0 );
    }

}