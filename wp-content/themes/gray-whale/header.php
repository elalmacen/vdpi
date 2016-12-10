<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package graywhale
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'graywhale' ); ?></a>
	<?php if( is_front_page() ) : ?>
		<?php $options = get_option('graywhale_theme_settings');?>
		
	<header id="masthead" class="frontpage-header"  role="banner">
		<div class="frontpage-image" <?php echo graywhale_header_image_background('frontpage'); ?> >&nbsp;</div>
		<div class="site-branding noborder hyphens">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
		<?php	if ( !empty( $options['frontpage_description'] ) ) : ?>

		<div class="frontpage-description justified">
			<?php echo $options['frontpage_description'] ?>
		</div>
		<?php endif; ?>
	</header>	
	<?php else : ?>
	<header id="masthead" class="interior-header" <?php echo graywhale_header_image_background(); ?> role="banner">
		<div class="site-branding noborder hyphens">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>	
	</header>
	<?php endif; ?>

	<div class="sticky-wrapper">
		<nav id="site-navigation" class="main-navigation noborder accentgradient" role="navigation">
			<?php wp_nav_menu( array( 	'theme_location' => 'primary',
												'container_class' => 'menu-full',
												'depth' => 2 ) ); ?>
			<div id="mobile-button" class="button-block genericon genericon-menu"></div>
		</nav><!-- #site-navigation -->
	</div>
	<div id="mobile-menu" class="noborder">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div><!-- #menu-block-->

	<div id="content" class="site-content">
		<div class="inner">
