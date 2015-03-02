<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Malinky Media
 */
?>

<footer class="main-footer wrap" role="contentinfo">

	<div class="col">
		<div class="col-item col-item-half main-footer__navigation">
			<nav class="footer-navigation" role="navigation">
				<?php
		        $args = array(
		            'theme_location'    => 'footer_navigation',
		            'container'   		=> 'false'
		        );
		        ?>
				<?php wp_nav_menu( $args ); ?>
			</nav><!-- .main_navigation -->
		</div><!--
		--><div class="col-item col-item-half col--align-right main-footer__copyright">
			<?php echo bloginfo( 'name' ); ?> &copy; <?php echo date('Y'); ?>
		</div>
	</div>

</footer><!-- .main-footer -->

<a class="back-top image-font__fontawesome fa-angle-up"></a>

<?php if ( WP_ENV == 'prod' ) { ?>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create',"<?php echo get_option( '_000003_google_analytics' ); ?>",'auto');ga('send','pageview');
</script>

<?php } ?>
		
<?php wp_footer(); ?>
	
</body>
</html>