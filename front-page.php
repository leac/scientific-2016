<?php
/**
 * The template file of the front page.
 *
 * Dynamic Front Page: Sometimes called the integrated model,
 * the dynamic site design features a static front page plus blog,
 * however the front page is dynamic.
 * It may feature a combination of static and blog content (Page and posts).
 *
 * @link https://codex.wordpress.org/Creating_a_Static_Front_Page#Adding_custom_query_loops_to_front-page.php
 *
 * @package scientific_2016
 */
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

	<?php
	/*	 * *********** Block Newest Post  *************** */

	if ( have_posts() ) :
	    set_query_var( 'section_type', Scientific2016ContentType::Newest ); // set scetion_type, to be used in content-front-page.php
	    ?>

    	<section class="block block-newest-posts clear">

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

		    <?php
		    get_template_part( 'template-parts/content', 'front-page-newest' );
		    ?>

		<?php endwhile; ?>

    	</section>

	<?php endif; ?>


	<?php
	/*	 * *********** Block Articles  *************** */
	scientific_2016_display_front_page_posts( Scientific2016ContentType::Articles );
	?>

	<?php
	/*	 * *********** Block Fast Science  *************** */
	scientific_2016_display_front_page_posts( Scientific2016ContentType::Fast_science );
	?>

	<?php
	/*	 * *********** Block Fast Science  *************** */
	scientific_2016_display_front_page_posts( Scientific2016ContentType::Opinions );
	?>

	<?php /*	 * *********** Block Latest Isuues  *************** */ ?>
	<section class = "block block-latest-issues">

	    <header class = "block-title-plain">
		<a href="<?php echo get_category_link( ALL_ISSUES_CATEGORY_ID ); ?> "><?php _e( 'Older issues', 'scientific-2016' ) ?></a>
	    </header>
	    <div class="issues-wrapper clear">
		<?php scientific_2016_display_latest_issues( 3, false );
		?>
		<a class="more-issues" href="<?php echo get_category_link( ALL_ISSUES_CATEGORY_ID ); ?> ">
		    <?php _e( 'Older issues', 'scientific-2016' ) ?>
		</a>
	    </div>
	</section>
	<?php
	/*	 * *********** Block % most read  *************** */
	get_sidebar();
	?>


    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>
