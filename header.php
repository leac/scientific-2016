<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package scientific_2016
	 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
		<div id="page" class="hfeed site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'scientific-2016' ); ?></a>

			<header id="masthead" class="site-header" role="banner">
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title scientific-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title scientific-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
					<p class="site-description"><?php bloginfo( 'description' ); ?></p>

					<nav id="site-navigation" class="main-navigation" role="navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'scientific-2016' ); ?></button>
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
					</nav><!-- #site-navigation -->
				</div><!-- .site-branding -->

				<div class="left-header">
					<a class="ort-logo" href="http://www.ort.org.il"><?php _e( 'Ort site', 'scientific-2016' ) ?></a>
					<div class="popover_parent">
						<a href="javascript:void(0)" class="search-btn"><?php _e( '?', 'scientific-2016' ) ?></a>
						<?php get_search_form(); ?>
					</div>

					<?php
						//Show Simple share buttons widget:
//						if ( is_single() && function_exists( 'ssba_buttons' ) ) { // run the shortcode only if the function associated with it exists
//							echo do_shortcode( '[ssba]' );
//						}
					?>
<!--					<a href="<?php //comments_link(); ?>">
						Comments to this post
					</a>-->
				</div>

			</header><!-- #masthead -->


			<div id="content" class="site-content">
