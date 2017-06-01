<?php
/**
 * GlowFab Theme Customizer.
 *
 * @package GlowFab
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function glowfab_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Create header background color setting
	$wp_customize->add_setting( 'header_color', array(
		'default' => '000000',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_color', array(
				'label' => __( 'Header Background Color', 'glowfab' ),
				'section' => 'colors',
			)
		)
	);
	
	// Footer background color settings
	$wp_customize->add_setting( 'footer_color', array(
		'default' => '000000',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_color', array(
				'label' => __( 'Footer Background Color', 'glowfab' ),
				'section' => 'colors',
			)
		)
	);
	
	// Footer text color settings
	$wp_customize->add_setting( 'footer_text_color', array(
		'default' => 'FFFFFF',
		'type' => 'theme_mod',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color', array(
				'label' => __( 'Footer Text Color', 'glowfab' ),
				'section' => 'colors',
			)
		)
	);

	// Add section to the Customizer
	$wp_customize->add_section( 'glowfab-options', array(
		'title' => __( 'Sidebar Position', 'glowfab' ),
		'capability' => 'edit_theme_options',
		'description' => __( 'Change the sidebar position', 'glowfab' ),
	));

	// Create sidebar layout setting
	$wp_customize->add_setting(	'layout_setting',
		array(
			'default' => 'no-sidebar',
			'type' => 'theme_mod',
			'sanitize_callback' => 'glowfab_sanitize_layout',
			'transport' => 'postMessage'
		)
	);
	$wp_customize->add_control(	'layout_control',
		array(
			'settings' => 'layout_setting',
			'type' => 'radio',
			'label' => __( 'Sidebar position', 'glowfab' ),
			'choices' => array(
				'no-sidebar' => __( 'No Sidebar (default)', 'glowfab' ),
				'sidebar-left' => __( 'Left Sidebar', 'glowfab' ),
				'sidebar-right' => __( 'Right Sidebar', 'glowfab' )
			),
			'section' => 'glowfab-options',
		)
	);
}
add_action( 'customize_register', 'glowfab_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function glowfab_customize_preview_js() {
	wp_enqueue_script( 'glowfab_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'glowfab_customize_preview_js' );


/**
 * Sanitize layout options
 */

function glowfab_sanitize_layout( $value ) {
	if ( !in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) ) {
		$value = 'no-sidebar';
	}
	return $value;
}

/**
 * Inject Customizer CSS when appropriate
 */

function glowfab_customizer_css() {
	$header_color = get_theme_mod('header_color');

	?>
	<style type="text/css">
		.site-header {
			background-color: <?php echo $header_color; ?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'glowfab_customizer_css' );


function glowfab_customizer_css_footer() {
	$footer_color = get_theme_mod('footer_color');

	?>
	<style type="text/css">
		.site-footer {
			background-color: <?php echo $footer_color; ?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'glowfab_customizer_css_footer' );

function glowfab_customizer_css_footer_text() {
	$footer_text_color = get_theme_mod('footer_text_color');

	?>
	<style type="text/css">
		.site-footer {
			color: <?php echo $footer_text_color; ?>
		}
		.site-footer a {
			color: <?php echo $footer_text_color; ?>
		}
		.site-footer .footer-title {
			color: <?php echo $footer_text_color; ?>
		}
	</style>
	<?php
}
add_action( 'wp_head', 'glowfab_customizer_css_footer_text' );

