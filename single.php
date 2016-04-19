<?php
/**
 * The template for displaying all single posts.
 *
 * @package Malinky Media
 */

get_header(); ?>

<!-- <main> in header() -->

	<div class="col">

		<div class="col-item col-item-7-10">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="col">
				<div class="col-item col-item-full">
					<?php get_template_part( 'partials/posts/content', 'single' ); ?>
				</div>
			</div>

			<?php malinky_post_pagination(); ?>

		<?php endwhile; //end loop. ?>

		</div><!--
	
		--><div class="col-item col-item-3-10">
		
			<?php get_sidebar(); ?>

		</div>

	</div><!-- .col -->

</main><!-- .main -->

<?php get_footer();
