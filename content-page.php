<?php
/**
 * The template part for displaying all pages in page.php.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="content-header">
		<h1 class="content-header__title"><?php the_title(); ?></h1>
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
		<?php edit_post_link( __( 'Edit', 'malinky' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .content-footer -->

</article><!-- #post-## -->