<?php
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


/**
 * Get a term_id, name or slug from the category taxonomy
 *
 * @param int $post_id 	ID of post or current post if blank.
 * @param str $return 	Value to return either term_id, name or slug.
 * @return int
 */
function malinky_get_the_category( $post_id = '', $return = 'slug' )
{

	$return_values = array( 'term_id', 'name', 'slug' );

	if ( ! in_array( $return, $return_values ) ) return;

	if ( ! $post_id || ! is_numeric( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}

	$malinky_get_the_category = get_the_category( $post_id );
	
	if ( is_array( $malinky_get_the_category ) && ! empty( $malinky_get_the_category ) ) {
		return $malinky_get_the_category[0]->$return;
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
			esc_html( get_the_date( 'jS F Y') )
		);

		if ( $show_date_only ) return $posted_time;
		
		$posted_string = 'Posted on ' . $posted_time;

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

		$author = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span itemprop="author">' . esc_html( get_the_author() ) . '</span></a>';

		if ( ! $show_author )
			return '<span class="content-header__meta__date">' . $posted_string . $updated_string . '</span>';

		return '<span class="content-header__meta__date">' . $posted_string .'</span><span class="byline"> by ' . $author . '</span>';

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
					$categories = sprintf( '<span class="content-footer__cat-link">Posted in %1$s</span> ', $categories_list );
				}
			}

			if ( $show_tags ) {
				$tags_list = get_the_tag_list( '', ', ' );
				if ( $tags_list ) {
					$tags = sprintf( '<span class="content-footer__tag-link">Tagged as %1$s</span> ', $tags_list );
				}
			}

		}

		if ( $show_edit_link ) {
			$edit_link = sprintf( '<span class="content-footer__edit-link"><a href="%1$s">Edit</a></span>', esc_url( get_edit_post_link() ) );
		}

		return apply_filters( 'malinky_content_footer', $categories . $tags . $edit_link );

	}

}


if ( ! function_exists( 'malinky_content_microdata_footer' ) ) {

	/**
	 * Cretae author, published and updated tags for use microdata.
	 * Use on pages that wouldn't naturally or don't show any of the above.
	 * For example a single might show the posted date but hide the updated when using malinky_content_meta().
	 */
	function malinky_content_microdata_footer( $author = true, $published = true, $updated = true )
	{

		$malinky_microdata = '';

		if ( $author )
			$malinky_microdata .= '<meta itemprop="author" content="' . esc_attr( get_the_author() ) . '" />';

		if ( $published )
			$malinky_microdata .= '<meta itemprop="datePublished" content="' . esc_attr( get_the_date( 'c' ) ) . '" />';

		if ( $updated )
			$malinky_microdata .= '<meta itemprop="dateModified" content="' . esc_attr( get_the_modified_date( 'c' ) ) . '" />';

		return $malinky_microdata;
	
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
				<?php previous_post_link( '%link', 'Previous Post', true ); ?>
			</div><!--

			--><div class="col-item col-item-half col-item--align-right post-pagination__link post-pagination__link--newer">
				<?php next_post_link( '%link', 'Next Post', true ); ?>
			</div>

		</nav><!-- .post-pagination -->
		
	<?php }

}


if ( ! function_exists( 'malinky_page_pagination' ) ) {

	/**
	 * Display navigation to next/previous pages.
	 */
	function malinky_page_pagination()
	{

		global $post;

		$getPages = get_pages('child_of='.$post->post_parent);
		
		$pageCount = count($getPages);
		
		for($p=0; $p < $pageCount; $p++) {
		  	// get the array key for our entry
			if ($post->ID == $getPages[$p]->ID) break;
		}
		
		// assign our prev key
		$prevKey = $p-1;
		$lastKey = $pageCount-1;

		// if there isn't a value assigned for the previous key, go all the way to the end
		if (isset($getPages[$prevKey])) {
			$anchorName = $getPages[$prevKey]->post_title;
			$prevOutput = '<a href="'.get_permalink($getPages[$prevKey]->ID).'" title="'.esc_attr( $anchorName ).'" class="button">';
		} else {
			$anchorName = $getPages[$lastKey]->post_title;		
			$prevOutput = '<a href="'.get_permalink($getPages[$lastKey]->ID).'" title="'.esc_attr( $anchorName ).'" class="button">';
		} 
		
		// determine if we have a link and assign some anchor text
		if (!empty($prevOutput)) {
			$prevOutput .= $anchorName;
			$prevOutput .= '</a>';
		}	

		// assign our next key
		$nextKey = $p+1;
		
		// if there isn't a value assigned for the previous key, go all the way to the end
		if (isset($getPages[$nextKey])) {
			$anchorName = $getPages[$nextKey]->post_title;
			$nextOutput = '<a href="'.get_permalink($getPages[$nextKey]->ID).'" title="'.$anchorName.'" class="button">';
		} else {
			$anchorName = $getPages[0]->post_title;		
			$nextOutput = '<a href="'.get_permalink($getPages[0]->ID).'" title="'.esc_attr( $anchorName ).'" class="button">';
		}
		
		// determine if we have a link and assign some anchor text
		if (!empty($nextOutput)) {
			$nextOutput .= $anchorName;
			$nextOutput .= '</a>';
		} ?>

		<nav class="col col--gutterless page-pagination" role="navigation">

			<div class="col-item col-item-full col-item-half--medium col-item-half--large col-item-half--xlarge page-pagination__link page-pagination__link--older">
				<?php echo $prevOutput; ?>
			</div><!--

			--><div class="col-item col-item-full col-item-half--medium col-item-half--large col-item-half--xlarge col-item--align-right page-pagination__link page-pagination__link--newer">
				<?php echo $nextOutput; ?>
			</div>

		</nav><!-- .page-pagination -->
		
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
			$title = sprintf( __( 'Category Archives: %s', 'malinky' ), single_cat_title( '', false ) );
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


if ( ! function_exists( 'malinky_acf_image_array_field' ) ) {

	/**
	 * Output an field from an ACF image_array.
	 * Defaults to the alt tag.
	 * If the alt is empty use a defauly of the site name
	 *
	 * @param string $malinky_acf_field_name ACF field name.
	 * @param string $field field to output from the ACF image_array.
	 * @param string $$field2 field to output from the ACF image_array, for sizes array.
	 * @return str
	 */
	function malinky_acf_image_array_field( $malinky_acf_field_name, $field = 'alt', $field2 = '' )
	{
		$malinky_acf_hero_shot = get_field( $malinky_acf_field_name );
	
		if ( ! $malinky_acf_hero_shot ) {
			$malinky_acf_hero_shot = get_sub_field( $malinky_acf_field_name );
		}

		if ( ! $malinky_acf_hero_shot ) return;
		
		if ( $field == 'alt' ) {
			//No alt tag set.
			if ( $malinky_acf_hero_shot[ $field ] == '' ) {
				return get_bloginfo( 'name' );
			}
		}

		if ( $field2 ) {
			return $malinky_acf_hero_shot[ $field ][ $field2 ];
		} else {
			return $malinky_acf_hero_shot[ $field ];
		}
	}

}


if ( ! function_exists( 'malinky_awp_image' ) ) {

	/**
	 * Output image based on the attachment id, size and return value.
	 * If the attachment size doesn't exist in wordpress returns the original.
	 *
	 * @param int 		$attachment_id 		The attachment id
	 * @param string 	$attachment_size 	The attachment image_size to output
	 * @param string 	$return 			Either url, width or height.
	 * @return str
	 */
	function malinky_wp_image( $attachment_id, $attachment_size = '', $return = 'url' )
	{
		$malinky_attachment = wp_get_attachment_image_src( $attachment_id, $attachment_size );
		
		if ( $malinky_attachment ) {
			switch ( $return ) {
				case 'url':
					return $malinky_attachment[0];
					break;
				case 'width':
					return $malinky_attachment[1];
					break;				
				case 'height':
					return $malinky_attachment[2];
					break;
			}
		}
	}

}


if ( ! function_exists( 'malinky_content_footer_filter' ) ) {

	/**
	 * Filter output of categories.
	 */
	function malinky_content_footer_filter( $output ) {
		return str_replace( 'Posted ', ', ', $output );
	}

	add_filter( 'malinky_content_footer', 'malinky_content_footer_filter' );

}