<?php
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
			'title' => 'Text Twice Margin',
    		'selector' => 'p, h1, h2, h3, h4, h5, h6',
    		'classes' => 'twice-margin'
		),
		array(
			'title' => 'Text Triple Margin',
    		'selector' => 'p, h1, h2, h3, h4, h5, h6',
    		'classes' => 'triple-margin'
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
		),	
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
