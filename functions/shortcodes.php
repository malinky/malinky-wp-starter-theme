<?php
/* ------------------------------------------------------------------------ *
 * Google Map Shortcode
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to display Google Map.
 *
 * [malinky-google-map 
 * show_heading	= Show heading pass a boolean of 1 or 0.
 * heading 		= Heading text to display.
 * ]
 */
add_shortcode( 'malinky-google-map', 'malinky_google_map_shortcode' );

function malinky_google_map_shortcode( $atts )
{

	$atts = shortcode_atts(
		array(
	        'show_heading' 	=> 1,
	        'heading' 		=> 'Find Us'
    	), 
		$atts, 
		'malinky-google-map'
	);

	$is_google_map_settings = get_field( 'malinky_settings_map_show_map', 'option' );
	
	/*
	 * Check google maps is turned on.
	 */
	if ( $is_google_map_settings ) {

		$google_map_settings_pages = get_field( 'malinky_settings_map_map_page', 'option' );

		/*
		 * Check if on the correct page.
		 */
		if ( is_page( $google_map_settings_pages ) ) {

			ob_start(); ?>

			<?php if ( (boolean) $atts[ 'show_heading' ] ) { ?>
				<h2 class="col--align-center"><?php echo esc_html( $atts[ 'heading' ] ); ?></h2>
			<?php } ?>

			<div id="malinky-map-canvas"></div>

			<?php return ob_get_clean();

		}

	}
		
}


/* ------------------------------------------------------------------------ *
 * Recent Posts Shortcode
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to display recent posts with optional category.
 *
 * [malinky-recent-posts 
 * category_slug 	= The category slug.
 * number_of_posts 	= Number of posts to display.
 * sidebar_mobile	= Is this the mobile sidebar. This alters the header.
 * orderby 			= Parameter to order by.
 * order 			= Order direction.
 * title 			= Title to display.
 * show_title 		= If to show a title, only applies to desktop.
 * ]
 */
add_shortcode( 'malinky-recent-posts', 'malinky_recent_posts' );

function malinky_recent_posts( $atts )
{

	$atts = shortcode_atts(
		array(
	        'category_slug' 	=> '',
	        'number_of_posts' 	=> 8,
	        'sidebar_mobile'	=> 0,
	        'orderby'			=> 'date', 
	        'order'				=> 'DESC',
	        'show_title'		=> 1,
	        'title'				=> malinky_get_the_category( '', 'name' )
    	),
		$atts,
		'malinky-recent-posts'
	);
	
	$args = array(
		'post_status'         	=> 'publish', 
		'ignore_sticky_posts' 	=> true, 
		'category_name'			=> $atts['category_slug'], 
		'posts_per_page'		=> $atts['number_of_posts'], 
        'orderby'				=> $atts['orderby'], 
        'order'					=> $atts['order'],
        'show_title'			=> $atts['show_title'],
        'title'					=> $atts['title'],
	);

	$malinky_recent_posts_wp_query = new WP_Query($args);

	if ( $malinky_recent_posts_wp_query->have_posts() ) { ?>

		<aside class="widget widget--recent-posts">
			<?php if ( (boolean) $atts[ 'sidebar_mobile' ] ) { ?>
				<a class="widget-title heading-3 collapsed" aria-expanded="false">
					<span><?php echo esc_html( $atts[ 'title' ] ); ?></span><!--
					--><span class="widget-title-toggle__bar"></span><!--
					--><span class="widget-title-toggle__bar"></span>
				</a>
			<?php } else { ?>
				<?php if ( (boolean) $atts[ 'show_title' ] ) { ?>
					<h3 class="widget-title"><?php echo esc_html( $atts[ 'title' ] ); ?></h3>
				<?php } ?>
			<?php } ?>
			<ul>
				<?php while ( $malinky_recent_posts_wp_query->have_posts() ) : $malinky_recent_posts_wp_query->the_post(); ?>
					<li><a href="<?php esc_url( the_permalink() ); ?>"><?php esc_html( the_title() ); ?></a></li>
				<?php endwhile; ?>
			</ul>
		</aside>
	
	<?php }

}


/* ------------------------------------------------------------------------ *
 * Phone Number Shortcode
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to phone number in a wysiwyg.
 *
 * [malinky-phone-number]
 */
add_shortcode( 'malinky-phone-number', 'malinky_phone_number' );

function malinky_phone_number()
{

	return get_field( 'malinky_settings_contact_phone_number', 'option' );

}


/* ------------------------------------------------------------------------ *
 * Email Shortcode
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to email in a wysiwyg.
 *
 * [malinky-email]
 */
add_shortcode( 'malinky-email', 'malinky_email' );

function malinky_email()
{

	return get_field( 'malinky_settings_contact_email_address', 'option' );

}


/* ------------------------------------------------------------------------ *
 * Display Font Awesome Icon With Link
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to display a font-awesome icon
 *
 * [malinky-font-awesome 
 * fa_icon 	= The category slug.
 * fa_link 	= Number of posts to display.
 * ]
 */
add_shortcode( 'malinky-font-awesome', 'malinky_font_awesome' );

function malinky_font_awesome( $atts )
{

	$atts = shortcode_atts(
		array(
	        'fa_icon' 		=> '',
	        'fa_link' 		=> '',
	        'fa_link_text' 	=> '',
    	),
		$atts,
		'malinky-font-awesome'
	);
	
	$output = '<span style="margin-right: 10px;">' . esc_html( $atts['fa_link_text'] ) . '</span><a href="' . esc_url( $atts['fa_link'] ) . '" class="image-font" target="_blank"><span class="image-font__fontawesome ' . esc_attr( $atts['fa_icon'] ) . '"></span></a>';

	return $output;

}


/* ------------------------------------------------------------------------ *
 * Output Packery Gallery
 * ------------------------------------------------------------------------ */

/**
 * Shortcode to display a packery gallery in a post
 *
 * [malinky-post-packery
 * ids = Comma seperated list of ids.
 * ]
 */
add_shortcode( 'malinky-post-packery', 'malinky_post_packery' );

function malinky_post_packery( $atts )
{

	$atts = shortcode_atts(
		array(
	        'ids' 	=> '',
    	),
		$atts,
		'malinky-post-packery'
	); 

	$attachmentIds = explode( ',', $atts['ids'] );

	foreach ( $attachmentIds as $id ) {
		$attachments[] = acf_get_attachment( $id );
	}

	ob_start(); ?>

	<div id="malinky-gallery-<?php echo rand(1, 100); ?>" class="malinky-gallery malinky-gallery--blog packery-container malinky-fade-in-long-delay<?php echo get_sub_field( 'column_spacing_type' ) == 'padding' || get_sub_field( 'column_spacing_type' ) == 'margin-bottom' ? ' col--' . esc_attr( get_sub_field( 'column_spacing_type' ) ) . '-' . esc_attr( get_sub_field( 'column_spacing_value' ) ) : ''; ?>" itemscope itemtype="http://schema.org/ImageGallery">
		<meta itemprop="about" content="<?php echo esc_attr( get_the_title() ); ?> Project Photos by Malinky Media" />
		<div class="packery-gutter"></div>
		<?php 
		$malinkyImageCount = 0;
		foreach ( $attachments as $key => $malinkyImage ) { ?>
			<div class="packery-item packery-item--half">
				<?php $malinkyImageSize = 'mm_projects_400'; ?>
				<div class="packery-image" itemscope itemtype="http://schema.org/ImageObject" data-image-index="<?php echo esc_attr( $malinkyImageCount ); ?>">
					<a href="<?php echo esc_url( $malinkyImage['url'] ); ?>" itemprop="contentUrl image" data-image-size-large="<?php echo esc_attr( $malinkyImage['width'] ); ?>x<?php echo esc_attr( $malinkyImage['height'] ); ?>" data-image-medium="<?php echo esc_url( $malinkyImage['sizes']['mm_projects_960'] ); ?>" data-image-size-medium="<?php echo esc_attr( $malinkyImage['sizes']['mm_projects_960-width'] ); ?>x<?php echo esc_attr( $malinkyImage['sizes']['mm_projects_960-height'] ); ?>" class="malinky-photoswipe-image">
						<img data-original="<?php echo esc_url( $malinkyImage['sizes']['mm_projects_400'] ); ?>" data-original-malinky="<?php echo esc_attr( $malinkyImageSize ); ?>" class="packery-image__img lazy" itemprop="thumbnail" />
						<span class="packery-image__expand"></span>
					</a>
				</div>
			</div>
			<?php $malinkyImageCount++; ?>
		<?php } ?>
	</div>

	<?php return ob_get_clean();

}