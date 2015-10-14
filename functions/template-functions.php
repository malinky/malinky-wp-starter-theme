<?php
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


/**
 * Move archive/category count (1) inline as they sit underneath due to links in the sidebar being display: block;
 * @param  str $links The output string of links
 * @return str
 */
function malinky_post_count_inline( $links )
{
	$links = preg_replace('/<\/a>.*\(([0-9]+)\)/', ' <span class="cat-count">($1)</span></a>', $links);
	return $links;
}

/*add_filter( 'get_archives_link', 'malinky_post_count_inline' );
add_filter( 'wp_list_categories', 'malinky_post_count_inline' );*/