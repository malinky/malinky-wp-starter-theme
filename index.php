<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 */

get_header(); ?>

<main role="main" class="wrap">

	<div class="col">

		<div class="col-item col-item-7-10">
			
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post();

				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				?>
				<div class="col">
					<div class="col-item col-item-full">
						<?php get_template_part( 'content', get_post_format() ); ?>
					</div>
				</div>	

			<?php endwhile;

			malinky_paging_nav();

		else : ?>

			<div class="col">
				<div class="col-item col-item-full">
					<?php get_template_part( 'content', 'none' ); ?>
				</div>
			</div>				

		<?php endif; ?>
		
		</div><!--
	
		--><div class="col-item col-item-3-10">
		
			<?php get_sidebar(); ?>

		</div>

	</div><!-- .col -->

</main><!-- .main -->

<?php get_footer(); ?>