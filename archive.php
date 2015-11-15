<?php
	/**
	 * The template for displaying archive pages.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package scientific_2016
	 */
	get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
			if ( have_posts() ) :

				if ( cat_is_ancestor_of( ALL_ISSUES_CATEGORY_ID, get_query_var( 'cat' ) ) ) {
					// issues categories have a special layout
					get_template_part( 'category-one-issue' );
				}
				else {
					$content_type = Scientific2016ContentType::Articles;
					if ( is_tag( ARTICLES_TAG_SLUG ) ) {
						$content_type = Scientific2016ContentType::Articles;
					}elseif(  is_tag(FAST_SCIENCE_TAG_SLUG)){
						$content_type = Scientific2016ContentType::Fast_science;
					}elseif(  is_tag(COLUMNS_OPINIONS_TAG_SLUG)){
						$content_type = Scientific2016ContentType::Opinions;
					}
					set_query_var( 'content_type', $content_type );
					?>

					<header class="page-header">
						<?php
						scientific_2016_the_archive_title( '<h1 class="page-title ' . scientific_2016_get_archive_title_class() . '">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );
						?>

					<?php endwhile; ?>

					<?php the_posts_navigation(); ?>
				<?php } ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
