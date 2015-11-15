<?php
	/**
	 * The sidebar containing the main widget area.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package scientific_2016
	 */
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		return;
	}
?>

<div id="secondary" class="widget-area" role="complementary">
	<?php if ( is_front_page() ) { ?>
			<?php dynamic_sidebar( 'sidebar-front-page' ); ?>
    <section class = "block block-our-authors">
	    <header class = "block-title-plain">
		<a href=""><?php _e( 'Our authors', 'scientific-2016' ) ?></a>
	    </header>
	    <div class="our-authors-plugin">
		<?php
		/*		 * *********** Block % most read  *************** */
		do_action( 'mop_acf_our_authors_plugin' );
		?>
	    </div>

	</section>
		<?php } ?>
</div><!-- #secondary -->
