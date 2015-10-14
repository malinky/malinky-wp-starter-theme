<?php
/*
 * Can only have one per page as id malinky-gallery-1 is hardcoded.
 */
$images 	= get_sub_field( 'gallery' );
$total 		= count( get_sub_field( 'gallery' ) );
$counter	= 0;
//shuffle( $images ); ?>
<h2 id="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" class="col--align-center"><?php echo esc_attr( get_sub_field( 'heading' ) ); ?></h2>
<div id="malinky-gallery-1" class="malinky-packery malinky-fade-in-long-delay malinky-gallery" itemscope itemtype="http://schema.org/ImageGallery">
<meta itemprop="about" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> Photo Gallery" />
<div class="malinky-packery__gutter"></div>
<?php foreach ( $images as $current_image => $image ) {
	$image_height_ratio = ( $image['sizes']['malinky_mini_thumbnail-height'] / $image['sizes']['malinky_mini_thumbnail-width'] ) * 100;
    $image_orientation = $image['height'] > $image['width'] ? 'malinky_portrait' : 'malinky_landscape'; ?>
	<div class="malinky-packery-item" itemscope itemtype="http://schema.org/ImageObject" data-image-index="<?php echo $counter; ?>">
		<a href="<?php echo esc_url( $image['sizes']['malinky_large'] ); ?>" class="malinky-photoswipe-image malinky-packery-item__inner" itemprop="contentUrl image" data-image-size-large="<?php echo esc_attr( $image['sizes']['malinky_large-width'] ); ?>x<?php echo esc_attr( $image['sizes']['malinky_large-height'] ); ?>" data-image-medium="<?php echo esc_url( $image['sizes']['malinky_medium'] ); ?>" data-image-size-medium="<?php echo esc_attr( $image['sizes']['malinky_medium-width'] ); ?>x<?php echo esc_attr( $image['sizes']['malinky_medium-height'] ); ?>" style="padding-bottom: <?php echo number_format( $image_height_ratio, 6 ); ?>%">
			<img data-original="<?php echo esc_url( $image['sizes']['malinky_mini_thumbnail'] ); ?>" data-original-malinky="<?php echo esc_attr( $image_orientation ); ?>" class="malinky-packery-item__inner__img lazy" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
		</a>
	</div>
	<?php $counter++;
} //end foreach ?>
</div>