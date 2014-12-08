<?php
/**
 * The template for displaying search result pages.
 */

get_header(); ?>

	<main role="main" class="wrap">

	<?php if ( have_posts() ) : ?>

		<div class="col">
			<div class="col-item col-item-full">
				<header class="content-header">
					<h1 class="content-header__title"><?php printf( __( 'Search Results for: %s', 'malinky' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .content-header -->
			</div>
		</div>		

		<?php while ( have_posts() ) : the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			?>
			<div class="col">
				<div class="col-item col-item-full">
					<?php get_template_part( 'content', 'search' ); ?>
				</div>
			</div>				

		<?php endwhile; //end loop.

		malinky_paging_nav();

	else : ?>

		<div class="col">
			<div class="col-item col-item-full">
				<?php get_template_part( 'content', 'none' ); ?>
			</div>
		</div>				

	<?php endif; ?>

	</main><!-- .main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
