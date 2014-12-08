<?php
/**
 * The template part for displaying search result pages in search.php.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="content-header">
		<h2 class="content-header__title"><a href="<?php esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
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
