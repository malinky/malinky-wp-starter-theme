<?php
/**
 * The template for displaying blog posts index page (use this instead of relying on index.php).
 * 
 * This will be the front (home) page of the website if Front page displays = Your latest posts in Settings -> Reading Settings
 * Only if front-page.php doesn't exist as that takes precedence.
 *
 * Or set Front page displays = A static page. (Remember to remove front-page.php from theme).
 */

get_header(); ?>

<main role="main" class="wrap wrap-mobile">

	<div class="col">

		<div class="col-item col-item-7-10">

			<?php if ( have_posts() ) { ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col">
						<div class="col-item col-item-full">
							<?php get_template_part( 'content', get_post_format() ); ?>
						</div>
					</div>

				<?php endwhile; //end loop.

				malinky_posts_pagination();

			} else { ?>

					<div class="col">
						<div class="col-item col-item-full">
							<?php get_template_part( 'content', 'none' ); ?>
						</div>
					</div>				

			<?php } ?>

		</div><!--
			
		--><div class="col-item col-item-3-10">
		
			<?php get_sidebar(); ?>

		</div>

	</div><!-- .col -->

</main><!-- .main -->

<?php get_footer(); ?>								