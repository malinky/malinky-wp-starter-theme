<?php
/**
 * The template part for displaying lists of posts when no post_format() is set.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="content-header">
		<h1 class="content-header__title"><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if ( get_post_type() == 'post' ) { ?>
			<div class="content-header__meta">
				<?php malinky_posted_on(); ?>
			</div><!-- .content-header__meta -->
		<?php } ?>
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