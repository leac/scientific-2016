<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package scientific_2016
 */
?>

<section class="no-results not-found">
    <div class="page-content">
	<h2><?php esc_html_e( 'Nothing Found', 'scientific-2016' ); ?></h2>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    	<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'scientific-2016' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'scientific-2016' ); ?><span><?php esc_html_e( 'try phisics :)', 'scientific-2016' ); ?></span></p>
	    <?php get_search_form(); ?>

	<?php else : ?>

    	<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'scientific-2016' ); ?></p>
	    <?php get_search_form(); ?>

	<?php endif; ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
