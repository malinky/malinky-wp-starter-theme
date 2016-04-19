<?php
/* ------------------------------------------------------------------------ *
 * Setup Actions and Filters
 * ------------------------------------------------------------------------ */

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/*
 * Remove Google sitelink search jsonld that is added by Wordpress SEO.
 */
add_filter('disable_wpseo_json_ld_search', '__return_true');

/*
 * Disable contact form 7 styles.
 */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

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
add_filter( 'body_class', 'malinky_add_slug_to_body_class' );

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
		return '<span class="content-summary__more-link">Read More</span>';
	}
}

/**
 * Remove hentry from post class as mircodata is used instead of microformats.
 */
function malinky_remove_hentry( $classes )
{
    $classes = array_diff( $classes, array( 'hentry' ) );
    return $classes; 
}
add_filter( 'post_class','malinky_remove_hentry' );

/**
 * Remove the image dimensions from images added in a ACF wysiwyg.
 */
function malinky_wysiwyg_image_dimensions ( $html )
{
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
add_filter( 'acf_the_content', 'malinky_wysiwyg_image_dimensions', 10 );