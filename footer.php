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

<script>
(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
ga('send', 'pageview');
</script>
		
<?php wp_footer(); ?>

</body>
</html>
