<?php
/**
 * Template Name: Full Width
 *
 * The template for displaying full width pages. Template chosen from admin.
 */

get_header(); ?>

<main role="main" class="wrap wrap-mobile">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="col">
			<div class="col-item col-item-full">
				<?php get_template_part( 'content', 'page' ); ?>
			</div>
		</div>

		<?php if ( comments_open() || get_comments_number() ) { ?>
			<div class="col">
				<div class="col-item col-item-full">
					<?php comments_template(); ?>
				</div>
			</div>					
		<?php }

	endwhile; //end loop. ?>

</main><!-- #main -->
	
<?php get_footer(); ?>