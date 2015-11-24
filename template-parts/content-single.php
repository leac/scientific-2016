<?php
	/**
	 * Template part for displaying single posts.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package scientific_2016
	 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header clear">
		<?php
			$section_type = Scientific2016ContentType::Single_article_top;
			scientific_2016_show_post_attached_image( $section_type )
		?>

		<div class="entry-top-wrapper">
			<div class="entry-meta">
				<?php scientific_2016_show_tags(); ?>
				<?php scientific_2016_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<section class="post-authors-wrapper">
				<?php
					do_action( 'mop_acf_post_authors', scientific_2016_get_author_info_type( $section_type ) );
				?>
			</section>
			<?php if ( has_excerpt() ) { ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				<?php } ?>
		</div>
    </header><!-- .entry-header -->

	<?php
		$entry_article_summary = scientific_2016_get_meta_field_value_only( 'summary' );
		if ( ! empty( $entry_article_summary ) ) {
			?>
			<div class="entry-article-summary">
				<?php echo $entry_article_summary ?>
			</div><!-- .entry-summary -->
		<?php } ?>


    <div class="entry-content separator-element">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scientific-2016' ),
				'after' => '</div>',
			) );
		?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
		<?php
			/* Good to Know (meta field) */
			scientific_2016_show_meta_field_with_label( 'goodtoknow' );
		?>

		<div class="about-authors">
			<h3 class="block-title-plain"><?php _e( 'About the Authors ', 'scientific-2016' ) ?></h3>
			<section class="our-authors-plugin">
				<?php
					$section_type = Scientific2016ContentType::Single_article_bottom;
					/* Author Info - name, image, description (meta field) */
					do_action( 'mop_acf_post_authors', scientific_2016_get_author_info_type( $section_type ) );
				?>
			</section>
		</div>
		<?php scientific_2016_show_meta_field_with_label( 'reading' ) ?>
		<?php
			/* Entry footer - Tags */
			scientific_2016_entry_footer();
		?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->

