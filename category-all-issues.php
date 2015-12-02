<?php
/**
 * Display older issues. These are only categories. No posts on this page, therefore no loop.
 *
 * @package scientific_2016
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

	<?php ?>
	<header class="page-header">
	    <?php
	    scientific_2016_the_archive_title( '<h1 class="page-title">', '</h1>' );
	    the_archive_description( '<div class="taxonomy-description">', '</div>' );
	    ?>
	</header><!-- .page-header -->

	<?php
	scientific_2016_display_latest_issues( -1, true );
	?>
	<a class="issues-archive" alt="issues archive" href="http://www.sciam.co.il/archive/archives/category/main/previous-issues">
	    <?php _e( 'issues archive', 'scientific-2016' ) ?>
	</a>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
