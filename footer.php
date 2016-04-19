<?php
/**
 * The template for displaying the footer.
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

<a class="back-top fa-angle-up"></a>
		
<?php wp_footer(); ?>

</body>
</html>
