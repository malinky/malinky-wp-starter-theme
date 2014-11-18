<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Malinky Media
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function malinky_media_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'malinky_media_jetpack_setup' );
