<?php
/**
 * The template for displaying blog posts index page (use this instead of relying on index.php).
 * 
 * This will be the front (home) page of the website if Front page displays = Your latest posts in Settings -> Reading Settings.
 * Or blog posts index page when Front page displays = A static page = Posts page in Settings -> Reading Settings.
 */

get_header(); ?>

<main role="main" class="wrap wrap-mobile">

	<div class="col">

		<div class="col-item col-item-7-10">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="col">
				<div class="col-item col-item-full">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="content-header">
							<h2 class="content-header__title"><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							<?php if ( get_post_type() == 'post' ) { ?>
								<div class="content-header__meta">
									<?php malinky_posted_on(); ?>
								</div><!-- .content-header__meta -->
							<?php } ?>
						</header><!-- .content-header -->

						<div class="content-summary">
							<?php the_excerpt(); ?>
						</div><!-- .content-summary -->

						<footer class="content-footer">
							<?php malinky_entry_footer(); ?>
						</footer><!-- .content-footer -->
						
					</article><!-- #post-## -->

				</div>
			</div>	

		<?php endwhile; //end loop.

		malinky_paging_nav(); ?>

		</div><!--
			
		--><div class="col-item col-item-3-10">
		
			<?php get_sidebar(); ?>

		</div>

	</div><!-- .col -->

</main><!-- .main -->

<?php get_footer(); ?>								