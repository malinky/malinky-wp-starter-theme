<?php
/* ------------------------------------------------------------------------ *
 * Front End Scripts
 * ------------------------------------------------------------------------ */

/**
 * Enqueue frontend scripts.
 */
function malinky_scripts()
{

	/* -------------------------------- *
	 * Local && Dev && Prod
	 * -------------------------------- */

	/**
	 * Load WP jQuery and jQuery migrate in the footer.
	 */
	if ( ! is_admin() ) {

		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate' );

		wp_register_script( 'jquery',
							'/wp-includes/js/jquery/jquery.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'jquery' );

		wp_register_script( 'jquery-migrate',
							'/wp-includes/js/jquery/jquery-migrate.min.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'jquery-migrate' );

	}
	
	
	if ( WP_ENV == 'local' ) {

		/* -------------------------------- *
		 * Local
		 * -------------------------------- */

		/**
		 * Stylesheet which includes normalize.
		 */
		wp_enqueue_style( 'malinky-style', get_stylesheet_uri() );		


		/**
		 * Font awesome font.
		 *
		 * @link http://fortawesome.github.io/Font-Awesome/
		 */		
		wp_register_style( 'malinky-font-awesome', 
						   get_template_directory_uri() . '/node_modules/font-awesome/css/font-awesome.css',
						   false, 
						   NULL
		);
		wp_enqueue_style( 'malinky-font-awesome' );


		/**
		 * Images Loaded
		 *
		 * @link https://github.com/desandro/imagesloaded
		 */		
		wp_register_script( 'malinky-imagesloaded-js', 
						   	get_template_directory_uri() . '/js/imagesloaded.pkgd.js', 
						   	false, 
						   	NULL,
							true
		);
		wp_enqueue_script( 'malinky-imagesloaded-js' );


		/**
		 * Matchmedia polyfill
		 *
		 * @link https://github.com/paulirish/matchMedia.js
		 */		
		wp_register_script( 'malinky-matchmedia-js', 
						   	get_template_directory_uri() . '/js/matchMedia.js', 
						   	false, 
						   	NULL,
							true
		);
		wp_enqueue_script( 'malinky-matchmedia-js' );


		/**
		 * Matchmedia polyfill
		 *
		 * @link https://github.com/paulirish/matchMedia.js
		 */		
		wp_register_script( 'malinky-matchmedialistener-js', 
						   	get_template_directory_uri() . '/js/matchMedia.addListener.js', 
						   	false, 
						   	NULL,
							true
		);
		wp_enqueue_script( 'malinky-matchmedialistener-js' );


		/**
		 * Lazy Load
		 *
		 * @link http://www.appelsiini.net/projects/lazyload
		 */
		wp_register_script( 'malinky-lazyload-js',
							get_template_directory_uri() . '/node_modules/jquery-lazyload/jquery.lazyload.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-lazyload-js' );


		/**
		 * Packery
		 *
		 * @link http://packery.metafizzy.co/
		 */
		wp_register_script( 'malinky-packery-js',
							get_template_directory_uri() . '/js/packery.pkgd.min.js',
							false, 
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-packery-js' );


		/**
		 * Photoswipe.
		 *
		 * @link http://photoswipe.com/
		 */
		wp_register_script( 'malinky-gallery-photoswipe-js',
							get_template_directory_uri() . '/js/photoswipe.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-gallery-photoswipe-js' );	


		/**
		 * Photoswipe UI.
		 *
		 * @link http://photoswipe.com/
		 */
		wp_register_script( 'malinky-gallery-photoswipe-ui-js',
							get_template_directory_uri() . '/js/photoswipe-ui.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-gallery-photoswipe-ui-js' );


		/*
		 * Malinky Media related javascript and jQuery.
		 */
		wp_register_script( 'malinky-main-js',
							get_template_directory_uri() . '/js/main.js',
							false,
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-main-js' );

	}


	if ( WP_ENV == 'dev' || WP_ENV == 'prod' ) {

		/* -------------------------------- *
		 * Dev && Prod
		 * -------------------------------- */

		/*
		 * imagesloaded.pkgd.js
		 * matchMedia.js
		 * matchMedia.addListener.js
		 * jquery.lazyload.js
		 * packery.pkgd.min.js
		 * photoswipe.js
		 * photoswipe-ui.js
		 * main.js
		 */
		wp_register_script( 'malinky-scripts-min-js',
							get_template_directory_uri() . '/js/scripts.min.js',
							array( 'jquery' ),
							NULL,
							true
		);
		wp_enqueue_script( 'malinky-scripts-min-js' );

	}

	/* -------------------------------- *
	 * Google Maps Local && Dev && Prod
	 * -------------------------------- */

	/**
	 * Google Map Set Up.
	 * If there are settings in admin.
	 * Localize them and then they are directly available as json in googlemap.js.
	 */
	$is_google_map_settings = get_field( 'malinky_settings_map_show_map', 'option' );

	/*
	 * Check it exists (isn't false)
	 */
	if ( $is_google_map_settings ) {

		$google_map_settings_pages = get_field( 'malinky_settings_map_map_page', 'option' );

		/*
		 * Check if on the correct page.
		 */
		if ( is_page( $google_map_settings_pages ) ) {

			$google_map_settings[] = array(
				'lat' 					=> get_field( 'malinky_settings_map_latitude', 'option' ), 
				'long' 					=> get_field( 'malinky_settings_map_longitude', 'option' ),  
				'show_address_label' 	=> get_field( 'malinky_settings_map_show_address_label', 'option' ), 
				'address_name' 			=> get_bloginfo( 'name' ), 
				'address_label' 		=> get_field( 'malinky_settings_contact_address', 'option' ), 
				'key_contact' 			=> get_field( 'malinky_settings_contact_key_contact', 'option' ), 
				'phone_number' 			=> get_field( 'malinky_settings_contact_phone_number', 'option' ), 
				'mobile_number' 		=> get_field( 'malinky_settings_contact_mobile_number', 'option' ), 
				'email_address' 		=> get_field( 'malinky_settings_contact_email_address', 'option' ), 
				'fax_number' 			=> get_field( 'malinky_settings_contact_fax_number', 'option' )
			);

			$google_map_settings['zoom'] = get_field( 'malinky_settings_map_zoom', 'option' );
			$google_map_settings['api_key'] = get_field( 'malinky_settings_map_api_key', 'option' );
		

			/* --------------- *
			 * Local
			 * No API Key
			 * --------------- */

			if ( WP_ENV == 'local' ) {

				/**
				 * Google Map Set Up.
				 * 
				 * Settings can be accessed from googlemap.js with google_map_settings.SETTING_KEY
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/
				 */
				wp_register_script( 'malinky-googlemap-js',
									get_template_directory_uri() . '/js/googlemap.js',
									false,
									NULL,
									true
				);
				wp_localize_script( 'malinky-googlemap-js', 'google_map_settings', $google_map_settings );
				wp_enqueue_script( 'malinky-googlemap-js' );


				/**
				 * Load Google maps API without key.
				 * Uses malinky_initialize function which is in googlemap.js.
				 * Remember to set API Key.
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/tutorial
				 */
				wp_register_script( 'malinky-googlemap-api-js', 
									'https://maps.googleapis.com/maps/api/js?callback=malinky_initialize', 
									false, 
									NULL, 
									true
				);

			}


			/* --------------- *
			 * Dev && Prod
			 * API Key
			 * --------------- */

			if ( WP_ENV == 'dev' || WP_ENV == 'prod' ) {

				/**
				 * Google Map Set Up.
				 * 
				 * Settings can be accessed from googlemap.js with google_map_settings.SETTING_KEY
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/
				 */
				wp_register_script( 'malinky-googlemap-min-js',
									get_template_directory_uri() . '/js/googlemap.min.js',
									false,
									NULL,
									true
				);
				wp_localize_script( 'malinky-googlemap-min-js', 'google_map_settings', $google_map_settings );
				wp_enqueue_script( 'malinky-googlemap-min-js' );


				/*
				 * Get my default API Key if one isn't set.
				 */
				$google_map_settings['api_key'] == '' ? 'AIzaSyBC4B2o5cX8GuFyKrh1CpwtdVz7-j5ccOg' : $google_map_settings['api_key'];

				/**
				 * Load Google maps API without key.
				 * Uses malinky_initialize function which is in googlemap.js.
				 * Remember to set API Key.
				 *
				 * @link https://developers.google.com/maps/documentation/javascript/tutorial
				 */
				wp_register_script( 'malinky-googlemap-api-js', 
							'https://maps.googleapis.com/maps/api/js?key=' . $google_map_settings['api_key'] . '&callback=malinky_initialize', 
							false, 
							NULL, 
							true
				);

			}

			wp_enqueue_script( 'malinky-googlemap-api-js' );

		}	
	}
}

add_action( 'wp_enqueue_scripts', 'malinky_scripts' );


/**
 * Filter to amend the script tags that are loaded.
 * Can change to async for example.
 */
function malinky_javascript_loader( $tag, $handle, $src )
{

	$async_handles = array(
		'malinky-googlemap-min-js',
		'malinky-googlemap-api-js'
	);
	
	if ( is_admin() ) return $tag;

	if ( in_array( $handle, $async_handles ) ) {
		$tag = str_replace('src=', 'async src=', $tag);
	}

	return $tag;

}

add_filter( 'script_loader_tag', 'malinky_javascript_loader', 10, 3 );