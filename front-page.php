<?php
/**
 * The template for displaying the home page.
 */

get_header(); ?>

<!-- <main> in header() -->

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="col">
            <div class="col-item">
                <?php get_template_part( 'partials/pages/content', 'page' ); ?>
            </div>
        </div>

    <?php endwhile; //end loop. ?>

</main><!-- #main -->
    
<?php get_footer(); ?>
