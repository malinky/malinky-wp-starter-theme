<?php
/* ------------------------------------------------------------------------ *
 * CPT
 * ------------------------------------------------------------------------ */

function malinky_register_cpt()
{

	/* -------------------------------- *
	 * Facts
	 * -------------------------------- */

	$singular  = 'Facts';
	$plural    = 'Facts';

	$args = array(
		'label'		=> $plural,
	    'labels' 	=> array(
			'name' 					=> $plural,
			'singular_name' 		=> $singular,
			'menu_name'             => $plural,
			'name_admin_bar'        => $singular,
			'all_items'             => sprintf( 'All %s', $plural ),
			'add_new' 				=> 'Add New',
			'add_new_item' 			=> sprintf('Add %s', $singular ),
			'edit_item' 			=> sprintf( 'Edit %s', $singular ),
			'new_item' 				=> sprintf( 'New %s', $singular ),
			'view_item' 			=> sprintf( 'View %s', $singular ),
			'search_items' 			=> sprintf( 'Search %s', $plural ),
			'not_found' 			=> sprintf( 'No %s found', $plural ),
			'not_found_in_trash' 	=> sprintf( 'No %s found in trash', $plural ),
			'parent_item_colon' 	=> sprintf( 'Parent %s', $singular )
		),
		'description' 	=> '',
		'public' 		=> false,
		'exclude_from_search' 	=> true, 	/* Optional as defaults to opposite of public */
		'publicly_queryable' 	=> false, 	/* Optional as defaults public */
		'show_ui' 				=> true, 	/* Optional as defaults public */
		'show_in_nav_menus' 	=> false, 	/* Optional as defaults public */
		'show_in_menu'			=> true, 	/* Optional as defaults show_ui */
		'show_in_admin_bar'		=> true, 	/* Optional as defaults show_in_menu */
		'menu_position'			=> 26,
		'menu_icon'				=> 'dashicons-testimonial',
		'capability_type'		=> 'post',
		'capabilities' => array(
			'edit_post' 			=> 'edit_post',
			'read_post' 			=> 'read_post',
			'delete_post' 			=> 'delete_post',
			'edit_posts' 			=> 'edit_posts',
			'edit_others_posts' 	=> 'edit_others_posts',
			'publish_posts' 		=> 'publish_posts',
			'read_private_posts'	=> 'read_private_posts'					
		),
		'map_meta_cap'	=> true,
		'hierarchical' 	=> false,
		'supports'		=> array( 'title', 'editor', 'custom-fields' ),
		/* 'register_meta_box_cb'	=> '', */
		'taxonomies' 	=> array(),
		'has_archive'	=> false, /* url for landing page of archive, same as first part of each $rewrite slug */
    	'rewrite' 		=> false,
    	'query_var'		=> false, /* ?groundcare-type=permalink */
    	'can_export'	=> true
    );

	register_post_type( 'mal-facts', $args );

}