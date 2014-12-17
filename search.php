<?php
/**
 * The template for displaying search result pages.
 */

get_header(); ?>

<main role="main" class="wrap wrap-mobile">

	<div class="col">

		<div class="col-item col-item-7-10">

			<?php if ( have_posts() ) : ?>

				<div class="col">
					<div class="col-item col-item-full">
						<header class="content-introduction">
							<h1 class="content-introduction__title"><?php printf( 'Search Results for: %s', get_search_query() ); ?></h1>
						</header><!-- .content-header -->
					</div>
				</div>

				<?php while ( have_posts() ) : the_post();

					?>
					<div class="col">
						<div class="col-item col-item-full">
							<?php get_template_part( 'content', 'search' ); ?>
						</div>
					</div>				

				<?php endwhile; //end loop.

				malinky_posts_pagination();

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