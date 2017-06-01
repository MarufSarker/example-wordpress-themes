<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GlowFab_-_Material
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'glowfab_material' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'glowfab_material' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'glowfab_material' ), 'GlowFab Material', '<a href="https://marufsarker.github.io/" rel="designer">Abu Md. Maruf Sarker</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
  </main><!-- .mdl-layout__content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
