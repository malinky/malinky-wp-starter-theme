<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<!-- Use latest ie engine --> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Mobile viewport -->    
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="<?php echo esc_url( site_url( 'favicon.ico' ) ); ?>" />
	<link href="<?php echo esc_url( site_url( 'apple-touch-icon-precomposed.png' ) ); ?>" rel="apple-touch-icon-precomposed">

	<!-- Google Fonts -->

	<!-- Meta -->
	<meta name="description" content="">
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!--https://github.com/scottjehl/Respond-->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
	<![endif]-->

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
				<a href="" class="mobile-navigation-image-font mobile-navigation-navicon"></a>
			</div><!--
			--><div class="col-item col-item-6-10 col-item--align-right">
	    		<a href="" target="_blank" class="mobile-navigation-image"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/graphics/mobile_facebook.png" data-at2x="<?php echo get_stylesheet_directory_uri(); ?>/img/graphics/mobile_facebook@2x.png" alt="" /></a>   		    		
	    		<a href="" target="_blank" class="mobile-navigation-image-font mobile-navigation-email"></a>
	    		<a href="" target="_blank" class="mobile-navigation-image-font mobile-navigation-phone"></a>
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