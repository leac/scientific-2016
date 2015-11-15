<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package scientific_2016
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-logos separator-element clear">
	<a class="scientific-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e( 'Scientific American', 'scientific-2016' ) ?></a>
	<a class="ort-logo" href="http://www.ort.org.il"><?php _e( 'Ort site', 'scientific-2016' ) ?></a>
    </div>
    <div class="footer-widgets">
	<?php dynamic_sidebar( 'sidebar-footer' ); ?>
    </div>

    <div class="site-info">
	<a class="separate" href="https://wordpress.org"><?php printf( __( 'Proudly powered by %s', 'scientific-2016' ), 'Wordpress' ); ?></a>
	<?php _e( 'Site built by:', 'scientific-2016' ) ?><a href="http://creative.ort.org.il/"><?php _e( 'Credits technology team', 'scientific-2016' ) ?></a>
	<a href="http://www.ort.org.il"><?php _e( 'Ort Israel', 'scientific-2016' ) ?></a>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
// Call polyfill to fit in images
	
    document.addEventListener('DOMContentLoaded', function () {
			objectFit.polyfill({
				selector: '.block-newest-posts .entry-header img1',
				fittype: 'cover'
			});
		});    
</script>
</body>
</html>
