<?php
/**
 * GlowFab - Material Theme Customizer.
 *
 * @package GlowFab_-_Material
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function glowfab_material_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
  
  // Custom Header Background Color
  $wp_customize->add_setting( 'header_color', array(
    'default' => '',
    'type' => 'theme_mod',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'header_color', array(
        'label' => __( 'Header Background Color', 'glowfab_material' ),
        'section' => 'colors',
      )
    )
  );
  
  // Custom MDL Drawer Buttons Color
  $wp_customize->add_setting( 'mdl_drawer_button_color', array(
    'default' => 'ffffff',
    'type' => 'theme_mod',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport' => 'postMessage',
  ));
  $wp_customize->add_control(
    new WP_Customize_Color_Control(
      $wp_customize,
      'mdl_drawer_button_color', array(
        'label' => __( 'MDL Header Buttons Color', 'glowfab_material' ),
        'section' => 'colors',
      )
    )
  );
  
  // Posts Default Featured Image Section to the Customizer
  $wp_customize->add_section( 'glowfab_material_featured_image-option', array(
    'title' => __( 'Posts Default Featured Image', 'glowfab_material' ),
    'capability' => 'edit_theme_options',
    'description' => __( 'Customize Posts Default (fallback) Featured Image', 'glowfab_material' ),
  ));
  
  // Posts Default Featured Image Settings to the Customizer
  $wp_customize->add_setting( 'default_fallback_featured_image',
    array(
      'default' => get_template_directory_uri() . '/assets/imgs/fallback_featured_image-1600x420.jpg',
      'type' => 'theme_mod',
      'transport' => 'refresh',
    )
  );
  $wp_customize->add_control( 
    new WP_Customize_Image_Control(
      $wp_customize,
      'default_fallback_featured_image',
      array(
        'label' => __( 'Default Featured Image', 'glowfab_material'),
        'description' => __( 'Recommended Size: 1200x280px (W x H)', 'glowfab_material'),
        'section' => 'glowfab_material_featured_image-option'
      )
    )
  );
  
  
  // Add section to the Customizer
  $wp_customize->add_section( 'glowfab_material-options', array(
    'title' => __( 'Sidebar Position', 'glowfab_material' ),
    'capability' => 'edit_theme_options',
    'description' => __( 'Change the sidebar position', 'glowfab_material' ),
  ));

  // Create sidebar layout setting
  $wp_customize->add_setting( 'layout_setting',
    array(
      'default' => 'no-sidebar',
      'type' => 'theme_mod',
      'sanitize_callback' => 'glowfab_material_sanitize_layout',
      'transport' => 'postMessage'
    )
  );
  $wp_customize->add_control( 'layout_control',
    array(
      'settings' => 'layout_setting',
      'type' => 'radio',
      'label' => __( 'Sidebar position', 'glowfab_material' ),
      'choices' => array(
        'no-sidebar' => __( 'No Sidebar (default)', 'glowfab_material' ),
        'sidebar-left' => __( 'Left Sidebar', 'glowfab_material' ),
        'sidebar-right' => __( 'Right Sidebar', 'glowfab_material' )
      ),
      'section' => 'glowfab_material-options',
    )
  );
  
}
add_action( 'customize_register', 'glowfab_material_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function glowfab_material_customize_preview_js() {
	wp_enqueue_script( 'glowfab_material_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'glowfab_material_customize_preview_js' );


/**
 * Injecting Custom CSS to Head
 */

function glowfab_material_customizer_header_color_css() {
  $header_color = get_theme_mod('header_color');

  ?>
  <style type="text/css">
    .site-header, .mdl-layout__header--transparent.mdl-layout__header--transparent {
      background-color: <?php echo $header_color; ?>
    }
  </style>
  <?php
}
add_action( 'wp_head', 'glowfab_material_customizer_header_color_css' );


function glowfab_material_customizer_featured_image_css() {
  $glowfab_material_fallback_featured_image = get_theme_mod('default_fallback_featured_image');

  ?>
  <style type="text/css">
    .default_fallback_featured_image {
      background-image: url(<?php echo $glowfab_material_fallback_featured_image; ?>);
    }
  </style>
  <?php
}
add_action( 'wp_head', 'glowfab_material_customizer_featured_image_css' );


/**
 * Sanitize layout options
 */

function glowfab_material_sanitize_layout( $value ) {
  if ( !in_array( $value, array( 'sidebar-left', 'sidebar-right', 'no-sidebar' ) ) ) {
    $value = 'no-sidebar';
  }
  return $value;
}

