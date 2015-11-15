<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package scientific_2016
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function scientific_2016_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'scientific_2016_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function scientific_2016_jetpack_setup
add_action( 'after_setup_theme', 'scientific_2016_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function scientific_2016_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function scientific_2016_infinite_scroll_render
