<?php
/**
 * The template part for displaying ACF flexible content.
 *
 * @package Malinky Media
 */

if ( have_rows( 'blocks' ) ) :

    while ( have_rows( 'blocks' ) ) : the_row();

        switch ( get_row_layout() ) {

			case 'text_block':

        		include 'content-flexible-content-text-block.php';

			break;       

            case 'shortcode_block':

                echo do_shortcode( get_sub_field( 'shortcode' ) );

            break;
            
        }

    endwhile;

else :

endif;
