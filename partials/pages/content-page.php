<?php
/**
 * The template part for a page.
 *
 * @package Malinky Media
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/ItemPage">

	<h1 class="col--align-center" itemprop="name"><?php echo esc_html( bloginfo( 'name' ) ); ?></h1>

	<?php if (get_the_content()) { ?>
		<div class="col">
			<div class="col-item">
				<span itemprop="mainContentOfPage">
					<?php the_content(); ?>
				</span>
			</div>
		</div>
	<?php } ?>

	<?php if ( have_rows( 'blocks' ) ) { ?>
		<div class="col">
			<div class="col-item">
				<?php get_template_part( 'partials/flexible/content', 'flexible-content' ); ?>
			</div>
		</div>
	<?php } ?>

</article>
