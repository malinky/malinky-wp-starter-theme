<?php
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
		'id'            => 'sidebar',
		'description'   => __( 'Main sidebar that appears on the left.', 'malinky' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar Mobile', 'malinky' ),
		'id'            => 'sidebar-mobile',
		'description'   => __( 'Mobile sidebar that appears as a toggle option.', 'malinky' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}

add_action( 'widgets_init', 'malinky_widgets_init' );
