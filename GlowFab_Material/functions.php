<?php
/**
 * GlowFab - Material functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GlowFab_-_Material
 */

if ( ! function_exists( 'glowfab_material_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function glowfab_material_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on GlowFab - Material, use a find and replace
	 * to change 'glowfab_material' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'glowfab_material', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'glowfab_material' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'glowfab_material_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
  
  
  /*====================
  * Add Author Links
  * ====================*/
  function add_to_author_profile( $contactmethods ) {

    $contactmethods['profession'] = 'Profession Name';
    $contactmethods['rss_url'] = 'RSS URL (full link)';
    $contactmethods['google_profile'] = 'Google Profile URL (full link)';
    $contactmethods['twitter_profile'] = 'Twitter Profile URL (full link)';
    $contactmethods['facebook_profile'] = 'Facebook Profile URL (full link)';
    $contactmethods['linkedin_profile'] = 'Linkedin Profile URL (full link)';

    return $contactmethods;
  }
  add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);
  
  
}
endif;
add_action( 'after_setup_theme', 'glowfab_material_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function glowfab_material_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'glowfab_material_content_width', 640 );
}
add_action( 'after_setup_theme', 'glowfab_material_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function glowfab_material_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'glowfab_material' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'glowfab_material_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function glowfab_material_scripts() {
	//	Custom Web Fonts Integration
	wp_enqueue_style( 'glowfab_material-local-fonts', get_template_directory_uri() . '/assets/fonts/custom-fonts.css' );
	wp_enqueue_style( 'glowfab_material-fontawesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'glowfab_material-mdl-ico', '//fonts.googleapis.com/icon?family=Material+Icons' );
	
	//	Material Design Lite
	wp_enqueue_style( 'glowfab_material-mdl-css', get_template_directory_uri() . '/assets/material-design-lite/dist/material.min.css' );
	wp_enqueue_script( 'glowfab_material-mdl-js', get_template_directory_uri() . '/assets/material-design-lite/dist/material.min.js' );
	
	wp_enqueue_style( 'glowfab_material-style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'glowfab_material-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );

	wp_enqueue_script( 'glowfab_material-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'glowfab_material_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
