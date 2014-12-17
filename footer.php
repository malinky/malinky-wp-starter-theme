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
		<div class="col-item col-item-full main-footer__copyright">
			<?php echo bloginfo( 'name' ); ?> &copy; <?php echo date('Y'); ?>
		</div>
	</div>

</footer><!-- .main-footer -->

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

<!--https://github.com/scottjehl/Respond-->
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
<![endif]-->
	
</body>
</html>
