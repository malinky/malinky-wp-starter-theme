<div class="col col--align-center">
	<div class="col-item col-item-8-10--large col-item-8-10--xlarge">
        <?php if ( get_sub_field( 'heading' ) != '' ) { ?>
            <h2 id="<?php echo esc_attr( get_sub_field( 'link' ) ); ?>" class="col--align-center"><?php echo esc_attr( get_sub_field( 'heading' ) ); ?></h2>
        <?php } ?>
		<?php if ( get_sub_field( 'content' ) != '' ) { ?>
			<?php the_sub_field( 'content' ); ?>
		<?php } ?>
	</div>
</div>