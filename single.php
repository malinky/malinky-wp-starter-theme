<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

<main role="main" class="wrap wrap-mobile">

	<div class="col">

		<div class="col-item col-item-7-10">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="col">
				<div class="col-item col-item-full">
					<?php get_template_part( 'content', 'single' ); ?>
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

<?php get_footer(); ?>