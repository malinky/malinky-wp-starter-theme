<?php
/**
 * The template part for displaying a single post in single.php.
 *
 * @package Malinky Media
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<header class="content-header">
		<h1 class="content-header__title no-margin" itemprop="name headline"><?php the_title(); ?></h1>
		<meta itemprop="url" content="<?php echo esc_url( get_permalink() ); ?>" />
		<div class="content-header__meta">
			<?php echo malinky_content_meta( false, false ); ?>
		</div><!-- .content-header__meta -->
	</header><!-- .content-header -->

	<div class="content-main">
		<span itemprop="articleBody">
			<?php the_content(); ?>
		</span>
	</div><!-- .content-main -->

	<?php echo malinky_content_microdata_footer( true, false, true ); ?>
	
	<div class="col">
		<div class="col-item">
			<hr />
		</div>
	</div>

</article>
