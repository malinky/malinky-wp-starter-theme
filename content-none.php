<?php
/**
 * The template part for no posts to display in archives.php, index.php and search.php
 */
?>
<article>

	<header class="content-header">
		<h1 class="content-header__title">Nothing Found</h1>
	</header><!-- .content-header -->

	<div class="content-main">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'malinky' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php } elseif ( is_search() ) { ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'malinky' ); ?></p>
			<?php get_search_form(); ?>

		<?php } else { ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'malinky' ); ?></p>
			<?php get_search_form(); ?>

		<?php } ?>

	</div><!-- .content-main -->

</article>
