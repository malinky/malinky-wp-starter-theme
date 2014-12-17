<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Use latest IE engine --> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Mobile viewport -->    
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Icons for mobile for touch home screens and bookmarks. Remember to upload favicon.ico too! -->

    <!-- Chrome and Android (192 x 192) -->
    <meta name="application-name" content="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
    <link rel="icon" sizes="192x192" href="<?php esc_url( site_url( 'chrome-touch-icon-192x192.png' ) ); ?>">

    <!-- Safari on iOS (152 x 152) -->
    <meta name="apple-mobile-web-app-title" content="<?php echo esc_attr( bloginfo( 'name' ) ); ?>">
    <link rel="apple-touch-icon" href="<?php esc_url( site_url( 'apple-touch-icon.png' ) ); ?>">

    <!-- IE on Win8 (144 x 144 + tile color) -->
    <meta name="msapplication-TileImage" content="<?php esc_url( site_url( 'ms-touch-icon-144x144-precomposed.png' ) ); ?>">
    <meta name="msapplication-TileColor" content="#3372DF">

	<!-- Google Fonts -->

	<!-- Meta -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<header class="main-header" role="banner">

	<!-- Main Navigation Desktop -->
	<div class="wrap-full main-navigation-bar main-navigation-bar--bkg">
		<div class="wrap">

		<div id="main-navigation-id" class="col">
			<div class="col-item col-item-full">
				<nav class="main-navigation" role="navigation">
					<?php
			        $args = array(
			            'theme_location'    => 'primary_navigation',
			            'container'   		=> 'false'
			        );
			        ?>
					<?php wp_nav_menu( $args ); ?>
				</nav><!-- .main-navigation -->
			</div>
		</div><!-- .col -->

		</div><!-- .wrap -->
	</div><!-- .wrap-full -->

	<!-- Main Navigation Desktop Fixed -->
	<div class="wrap-full wrap-full--full-fixed main-navigation-bar main-navigation-bar--bkg">
		<div class="wrap">

			<div id="main-navigation-fixed-id" class="col">
				<div class="col-item col-item-full">
					<nav class="main-navigation main-navigation--fixed" role="navigation">
						<?php
				        $args = array(
				            'theme_location'    => 'primary_navigation',
				            'container'   		=> 'false'
				        );
				        ?>
						<?php wp_nav_menu( $args ); ?>
					</nav><!-- .main-navigation -->
				</div>
			</div><!-- .col -->	

		</div><!-- .wrap -->
	</div><!-- .nav-wrap-full -->

	<!-- Main Navigation Mobile -->
	<div class="wrap-full mobile-navigation-bar">

		<div id="mobile-navigation-id" class="col col--gutterless">
			<div class="col-item col-item-4-10">
				<a href="" id="mobile-navigation-navicon" class="image-font"><span class="image-font__sizing image-font__dashicons dashicons-menu"></span></a>
			</div><!--
			--><div class="col-item col-item-6-10 col-item--align-right">
	    		<a href="" target="_blank" class="image-font"><span class="image-font__sizing image-font__dashicons dashicons-email"></span></a>
	    		<a href="" target="_blank" class="image-font"><span class="image-font__sizing image-font__fontawesome fa-phone"></span></a>
	  		</div>
			<div class="col-item col-item-full">
				<nav class="mobile-navigation" role="navigation">
					<?php
			        $args = array(
			            'theme_location'    => 'primary_navigation',
			            'container'   		=> 'false',
			        );
			        ?>
					<?php wp_nav_menu( $args ); ?>
				</nav><!-- .main-navigation -->
			</div>
		</div><!-- .col -->

	</div><!-- .wrap-full -->

</header><!-- .main-header -->