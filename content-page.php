<?php
/**
 * The template part for displaying a page in page.php.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="content-header">
		<h1 class="content-header__title"><?php the_title(); ?></h1>
	</header><!-- .content-header -->

	<div class="content-main">
		<?php the_content(); ?>
	</div><!-- .content-main -->

	<footer class="content-footer">
		<?php echo malinky_content_footer(); ?>
	</footer><!-- .content-footer -->

</article><!-- #post-## -->