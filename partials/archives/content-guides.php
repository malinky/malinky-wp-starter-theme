<div class="col-item col-item-half--small col-item-third--medium col-item-third--large col-item-third--xlarge guides">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">

		<a href="<?php esc_url( the_permalink() ); ?>"><img src="<?php echo esc_url( malinky_acf_image_array( 'image', 'malinky_mini_thumbnail' ) ); ?>" class="guides__img" alt="<?php echo esc_attr( get_the_title() ); ?>" itemprop="image" /></a>

		<header class="content-header">
			<h5 class="content-header__title">
				<a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" itemprop="url">
					<span itemprop="name headline"><?php the_title(); ?></span>
				</a>
			</h5>
		</header><!-- .content-header -->

		<?php echo malinky_content_microdata_footer(); ?>

	</article>
</div>