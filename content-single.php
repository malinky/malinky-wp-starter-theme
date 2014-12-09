<?php
/**
 * The template part for displaying all single posts in single.php.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="content-header">
		<h1 class="content-header__title"><?php the_title(); ?></h1>
		<div class="content-header__meta">
			<?php malinky_posted_on(); ?>
		</div><!-- .content-header__meta -->
	</header><!-- .content-header -->

	<div class="content-main">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'malinky' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .content-main -->

	<footer class="content-footer">
		<?php malinky_entry_footer(); ?>
	</footer><!-- .content-footer -->

</article><!-- #post-## -->