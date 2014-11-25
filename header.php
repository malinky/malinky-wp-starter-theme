<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie10 lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
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

	<!-- Link -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<!--[if lt IE 7]>
    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<header class="main_header" role="banner">

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'malinky-media' ); ?></a>

	<div id="main_navigation_id" class="col main_navigation_bar">
		<div class="col_item col_item_full">
			<nav class="main_navigation" role="navigation">
				<?php
		        $args = array(
		            'theme_location'    => 'main_navigation',
		            'container'   		=> 'false'
		        );
		        ?>
				<?php wp_nav_menu( $args ); ?>
			</nav><!-- .main_navigation -->
		</div>
	</div><!-- .col -->

	<div id="mobile_navigation_id" class="col col--gutterless mobile_navigation_bar">
		<div class="col_item col_item_4_10">
			<a href="" class="mobile_navigation_navicon"></a>
		</div><!--
		--><div class="col_item col_item_6_10 mobile_navigation_icons">
    		<a href="" target="_blank" class="mobile_navigation_icon"><img src="<?php echo esc_url( site_url( 'img/graphics/mobile_facebook.png' ) ); ?>" data-at2x="<?php echo esc_url( site_url( 'img/graphics/mobile_facebook@2x.png' ) ); ?>" alt="" /></a>
    		<a href="" target="_blank" class="mobile_navigation_icon"><img src="<?php echo esc_url( site_url( 'img/graphics/mobile_twitter.png' ) ); ?>" data-at2x="<?php echo esc_url( site_url( 'img/graphics/mobile_twitter@2x.png' ) ); ?>" alt="" /></a>
    		<a href="" target="_blank" class="mobile_navigation_icon"><img src="<?php echo esc_url( site_url( 'img/graphics/mobile_googleplus.png' ) ); ?>" data-at2x="<?php echo esc_url( site_url( 'img/graphics/mobile_googleplus@2x.png' ) ); ?>" alt="" /></a>
  		</div>
		<div class="col_item col_item_full">
			<nav class="mobile_navigation" role="navigation">
				<?php
		        $args = array(
		            'theme_location'    => 'main_navigation',
		            'container'   		=> 'false',
		        );
		        ?>
				<?php wp_nav_menu( $args ); ?>
			</nav><!-- .main_navigation -->		
		</div>
	</div><!-- .col -->

</header><!-- .main_header -->

<div id="content" class="site-content">