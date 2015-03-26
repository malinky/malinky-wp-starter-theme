<?php
/**
 * The template for displaying all archive pages.
 *
 * This can be overwritten with author.php, category.php, taxonomy.php, date.php, tag.php.
 */

get_header(); ?>

<main role="main" class="wrap wrap-mobile">

	<div class="col">

		<div class="col-item col-item-7-10">
			
			<?php if ( have_posts() ) : ?>

				<div class="col">
					<div class="col-item col-item-full">
						<header class="content-introduction">
							<h1 class="content-introduction__title"><?php malinky_archive_title(); ?></h1>
							<p class="content-introduction__description"><?php malinky_archive_description(); ?></p>
						</header><!-- .content-header -->
					</div>
				</div>

				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col">
						<div class="col-item col-item-full malinky-ajax-paging-content">
							<?php get_template_part( 'content', get_post_format() ); ?>
						</div>
					</div>	

				<?php endwhile;

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