<?php
/**
 * The template for displaying all archive pages.
 *
 * This can be overwritten with category.php, tag.php etc.
 */

get_header(); ?>

<main role="main" class="wrap">

	<div class="col">

		<div class="col-item col-item-7-10">
			
		<?php if ( have_posts() ) : ?>

			<div class="col">
				<div class="col-item col-item-full">
					<header class="content-header">
						<h1 class="content-header__title"><?php the_archive_title(); ?></h1>
						<p class="content-header__description"><?php the_archive_description(); ?></p>
					</header><!-- .content-header -->
				</div>
			</div>

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