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
			<!-- Optional address information and structured data -->
			<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				<?php while ( have_rows( 'malinky_settings_contact_address', 'option' ) ) : the_row(); ?>
					<span itemprop="streetAddress"><?php echo esc_html( get_sub_field( 'address' ) ); ?></span>
				<?php endwhile; ?>
	            <span itemprop="addressRegion"><?php echo esc_html( get_field( 'malinky_settings_contact_county', 'option' ) ); ?></span>
	            <span itemprop="postalCode"><?php echo esc_html( get_field( 'malinky_settings_contact_postcode', 'option' ) ); ?></span>
	        </div>
			<p itemprop="telephone">
				<a href="tel:+44<?php echo esc_html( str_replace( ' ', '', get_field( 'malinky_settings_contact_phone_number', 'option' ) ) ); ?>">
					<?php the_field( 'malinky_settings_contact_phone_number', 'option' ) ?>
				</a>
			</p>
			<p itemprop="email">
				<a href="mailto:<?php the_field( 'malinky_settings_contact_email_address', 'option' ) ?>">
					<?php the_field( 'malinky_settings_contact_email_address', 'option' ) ?>
				</a>
			</p>
		</div>
	</div>
</footer><!-- .main-footer -->

<a class="back-top fa-angle-up"></a>
		
<?php wp_footer(); ?>

</body>
</html>
