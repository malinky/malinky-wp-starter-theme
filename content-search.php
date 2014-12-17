<?php
/**
 * The template part for displaying a search result page in search.php.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="content-header">
		<h2 class="content-header__title"><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php if ( get_post_type() == 'post' ) { ?>
			<div class="content-header__meta">
				<?php echo malinky_content_meta(); ?>
			</div><!-- .content-header__meta -->
		<?php } ?>
	</header><!-- .content-header -->

	<div class="content-summary">
		<?php the_excerpt();
		printf( '<a href="%1$s" class="more-link">%2$s</a>', esc_url( get_permalink() ), malinky_read_more_text() ); ?>
	</div><!-- .content-summary -->

	<footer class="content-footer">
		<?php echo malinky_content_footer(); ?>
	</footer><!-- .content-footer -->
	
</article><!-- #post-## -->
