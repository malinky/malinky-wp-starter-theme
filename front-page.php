<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<!-- Owl Carousel -->
<!--
<div class="wrap-full wrap-mobile">
	<div id="owl-carousel-id" class="owl-carousel owl-theme">
		<div><img src="" /></div>
		<div><img src="" /></div>	
	</div>
</div>
-->

<!-- Owl Carousel 2 -->
<!--
<div class="wrap-full wrap-mobile">
	<div id="owl-carousel-id">
		<?php //if ( have_rows( 'carousel_images' ) ) : ?>
			<?php //while ( have_rows( 'carousel_images' ) ) : the_row(); ?>
				<div>
					<img src="<?php //echo esc_url( wp_get_attachment_url( get_sub_field( 'image' ) ) ); ?>" alt="<?php //echo esc_attr( bloginfo( 'name' ) ); ?> Carousel" />
				</div>
			<?php //endwhile; ?>
		<?php //endif; ?>	
	</div>
</div>
-->

<main role="main" class="wrap wrap-mobile">

	<div class="col">

		<div class="col-item col-item-7-10">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="col">
				<div class="col-item col-item-full">
					<?php get_template_part( 'content', 'page' ); ?>
				</div>
			</div>

		<?php endwhile; //end loop. ?>

		</div><!--
	
		--><div class="col-item col-item-3-10">
		
			<?php get_sidebar(); ?>

		</div>

	</div><!-- .col -->
	

</main><!-- #main -->
	
<?php get_footer(); ?>
