<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package scientific_2016
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

	<section class="error-404 not-found">	  
	    <h1 class="error-404-title">
		<?php esc_html_e( '404', 'scientific-2016' ); ?>
	    </h1>
	    <div class="page-content">
		<p>
		    <span><?php esc_html_e( 'That page can&rsquo;t be found. ', 'scientific-2016' ); ?></span>
		    <span><?php esc_html_e( 'sorry we lost you.', 'scientific-2016' ); ?></span>
		</p>
		<p>
		    <?php esc_html_e( 'we&rsquo;re sure you&rsquo;ll find us again on', 'scientific-2016' ); ?>
		    <span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html_e( 'home page', 'scientific-2016' ); ?></a></span>
		</p>

	    </div><!-- .page-content -->
	</section><!-- .error-404 -->

    </main><!-- #main -->
</div><!-- #primary -->


