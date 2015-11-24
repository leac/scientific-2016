<?php
/**
 * Template Name: Author Page
 * Tutorials:
 * https://premium.wpmudev.org/blog/creating-a-customizable-post-list-template-with-advanced-custom-fields/
 * http://www.advancedcustomfields.com/resources/query-posts-custom-fields/
 *
 * @package scientific_2016
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>


			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
