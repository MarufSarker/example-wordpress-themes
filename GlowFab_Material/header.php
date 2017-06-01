<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GlowFab_-_Material
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site mdl-layout mdl-js-layout mdl-layout--fixed-header <?php echo get_theme_mod( 'layout_setting', 'no-sidebar' ); ?>">
	
		
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'glowfab_material' ); ?></a>

	<?php if ( get_header_image() ) { ?>
	<header id="masthead" class="site-header mdl-layout__header mdl-layout__header--transparent" role="banner" style="background-image: url(<?php header_image(); ?>);">
	<?php } else { ?>
	<header id="masthead" class="site-header mdl-layout__header mdl-layout__header--transparent" role="banner">
	<?php } ?>
		
		<div class="site-branding mdl-layout__header-row">
			<?php if ( is_front_page() && is_home() ) { ?>
				<!-- Title -->
				<span class="site-title mdl-layout-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<?php } else { ?>
				<span class="site-title mdl-layout-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
			<?php } ?>
			
			<div class="mdl-layout-spacer"></div>

			<!-- search box -->
			<div class="android-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
				<form role="search" method="get" class="search-form" id="fixed-header-search-form">
					<label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-search-field">
						<i class="material-icons">search</i>
					</label>
					<div class="mdl-textfield__expandable-holder">
					  <input class="mdl-textfield__input" type="text" name="s" id="fixed-header-search-field">
					</div>
				</form>
		 	</div>

		</div><!-- .site-branding -->
	
	</header><!-- #masthead -->
	
	
	<!-- side navigation -->
	<div class="mdl-layout__drawer">
		<span class="mdl-layout-title"><?php bloginfo( 'name' ); ?></span>
		<nav class="mdl-navigation main-navigation" id="site-navigation" role="navigation">
		<?php
		/*
		 *
		 * http://wordpress-hackers.1065353.n5.nabble.com/wp-get-nav-menu-items-not-working-tp23967p23969.html
		 *
		 * */
		$slt_menu_locations = get_nav_menu_locations();
		$slt_hero_menu = $slt_menu_locations[ 'primary' ];
		$slt_hero_menu = wp_get_nav_menu_items( $slt_hero_menu );
		foreach($slt_hero_menu as $item)
		{
			echo '<a class="mdl-navigation__link" href="' . $item->url . '">' . $item->title . '</a>';
		}
		?>
		</nav>
	</div>

	<main class="mdl-layout mdl-layout__content">
		<div id="content" class="site-content page-content">
