<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GlowFab
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<div class="footer-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div><!-- .footer-title -->
		</div><!-- .site-info -->
		<div class="theme-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'glowfab' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'glowfab' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'glowfab' ), 'GlowFab', '<a href="https://marufsarker.github.io" rel="designer">Abu Md. Maruf Sarker</a>' ); ?>
		</div><!-- .theme-info -->
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
