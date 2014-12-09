<?php
/**
 * The template for displaying 404 pages.
 */

get_header(); ?>

<main role="main" class="wrap">

	<div class="col">

		<div class="col-item col-item-7-10">

			<header class="content-header">
				<h1 class="content-header__title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'malinky' ); ?></h1>
			</header><!-- .content-header -->

		</div><!--
	
		--><div class="col-item col-item-3-10">
		
			<?php get_sidebar(); ?>

		</div>

	</div><!-- .col -->

</main><!-- .main -->

<?php get_footer(); ?>