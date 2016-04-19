<?php
/* ------------------------------------------------------------------------ *
 * Taxonomies
 * ------------------------------------------------------------------------ */

function malinky_register_taxonomies()
{

	/* -------------------------------- *
	 * Pinboard Taxonomy
	 * -------------------------------- */

	$singular  = 'Pinboard Tag';
	$plural    = 'Pinboard Tags';

	$args = array(
		'label'		=> $plural,
	    'labels' 	=> array(
	        'name' 							=> $plural,
	        'singular_name' 				=> $singular,
	        'menu_name'						=> 'Categories',
	       	'all_items' 					=> sprintf( 'All %s', $plural ),
	        'edit_item' 					=> sprintf( 'Edit %s', $singular ),
			'view_item' 					=> sprintf( 'View %s', $singular ),	
	        'update_item' 					=> sprintf( 'Update %s', $singular ),				           	
	        'add_new_item' 					=> sprintf( 'Add New %s', $singular ),
	        'new_item_name' 				=> sprintf( 'New %s Name',  $singular ),
			'parent_item' 					=> sprintf( 'Parent %s', $singular ),
	        'parent_item_colon' 			=> sprintf( 'Parent %s:', $singular ),
	        'search_items' 					=> sprintf( 'Search %s', $plural ),
	        'popular_items' 				=> sprintf( 'Popular %s', $plural ),
	        'separate_items_with_commas' 	=> sprintf( 'Seperate %s with commas', $plural ),
	        'add_or_remove_items' 			=> sprintf( 'Add or remove %s', $plural ),
	        'choose_from_most_used' 		=> sprintf( 'Choose from the most used %s', $plural ),
	        'not_found' 					=> sprintf( 'No %s found', $plural ),
		),
		'public'			=> false,
		'show_ui' 			=> true, /* Optional as defaults public */
		'show_in_nav_menus'	=> false, /* Optional as defaults public */
		'show_tagcloud'		=> false, /* Optional as defaults show_ui */
		'meta_box_cb'		=> NULL,
		'show_admin_column' => true,
		'hierarchical'		=> false,
	    'update_count_callback' => '_update_generic_term_count',
		'query_var'			=> false, /* ?groundcare-category=term */
	    'capabilities'			=> array(
	    	'manage_terms' 		=> 'manage_categories',
	    	'edit_terms' 		=> 'manage_categories',
	    	'delete_terms' 		=> 'manage_categories',
	    	'assign_terms' 		=> 'edit_posts'
	   )
	   /* 'sort'				=> '' */
    );

	register_taxonomy( 'mal-pinboard-tags', array( 'attachment', 'mal-facts', 'mal-testimonials', 'mal-news' ), $args );

}
