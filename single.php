<?php
	/**
	 * The template for displaying all single posts.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package scientific_2016
	 */
	get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'single' ); ?>

				<?php //the_post_navigation(); ?>

				<section class="fb-comments-wrapper">
					<?php /* Add facebook commnets box */ ?>
					<?php
					if ( function_exists( 'fbcommentshortcode' ) ) { // run the shortcode only if the function associated with it exists
						echo do_shortcode( '[fbcomments]' );
					}
					?>
				</section>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>

				<?php
				scientific_2016_related_posts_section();
				?>

			<?php endwhile; // End of the loop.  ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
