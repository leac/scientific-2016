<?php
	/**
	 * Template part for displaying posts.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package scientific_2016
	 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>



    <header class="entry-header">

		<?php scientific_2016_show_post_attached_image( $section_type ) ?>
		<?php scientific_2016_show_tags(); ?>

    </header><!-- .entry-header -->

	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php
		/* author info appears in all blocks except fast_science */
		if ( $section_type != Scientific2016ContentType::Fast_science ) {
			?>
			<section class="post-authors-wrapper">
				<?php
				do_action( 'mop_acf_post_authors', scientific_2016_get_author_info_type( $section_type ) );
				?>
			</section>
		<?php } ?>

	<?php if ( has_excerpt() ) { ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php } ?>

</article><!-- #post-## -->
