<?php
/**
 * Template Name: Full Width
 *
 * The template for displaying full width pages. Template chosen from admin.
 *
 * @package Malinky Media
 */

get_header(); ?>

<!-- <main> in header() -->

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="col">
			<div class="col-item col-item-full">
				<?php get_template_part( 'partials/pages/content', 'page' ); ?>
			</div>
		</div>

	<?php endwhile; //end loop. ?>

</main><!-- #main -->
	
<?php get_footer();
