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
    //based on: http://tympanus.net/codrops/2015/01/08/inspiration-text-input-effects
    (function () {
	// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
	if (!String.prototype.trim) {
	    (function () {
		// Make sure we trim BOM and NBSP
		var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
		String.prototype.trim = function () {
		    return this.replace(rtrim, '');
		};
	    })();
	}

	[].slice.call(document.querySelectorAll('.comment-form input , .comment-form textarea')).forEach(function (inputEl) {
	    // in case the input is already filled..
	    if (inputEl.value.trim() !== '') {
		classie.add(inputEl.parentNode, 'input--filled');
	    }

	    // events:
	    inputEl.addEventListener('focus', onInputFocus);
	    inputEl.addEventListener('blur', onInputBlur);
	});

	function onInputFocus(ev) {
	    classie.add(ev.target.parentNode, 'input--filled');
	}

	function onInputBlur(ev) {
	    if (ev.target.value.trim() === '') {
		classie.remove(ev.target.parentNode, 'input--filled');
	    }
	}
    })();
</script>
</body>
</html>
