<?php
/**
 * The template part for displaying lists of posts when no post_format() is set.
 *
 * @package Malinky Media
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">

    <header class="content-header">
        <h3 class="content-header__title">
            <a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" itemprop="url">
                <span itemprop="name headline"><?php the_title(); ?></span>
            </a>
        </h3>
        <?php if ( get_post_type() == 'post' ) { ?>
            <div class="content-header__meta">
                <?php echo malinky_content_meta( false, false ); ?>
            </div><!-- .content-header__meta -->
        <?php } ?>
    </header><!-- .content-header -->

    <div class="content-summary" itemprop="about">
        <?php the_excerpt();
        printf( '<a href="%1$s" class="content-summary__more-link">%2$s</a>', esc_url( get_permalink() ), malinky_read_more_text() ); ?>
    </div><!-- .content-summary -->

    <?php echo malinky_content_microdata_footer( true, false, true ); ?>
    
    <div class="col">
        <div class="col-item">
            <hr />
        </div>
    </div>

</article>
