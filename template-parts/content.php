<?php
	/**
	 * Template part for displaying posts.
	 *
	 * @link https://codex.wordpress.org/Template_Hierarchy
	 *
	 * @package scientific_2016
	 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( isset( $content_type ) ) {
				scientific_2016_show_post_attached_image( $content_type );
				scientific_2016_show_tags();
			}
		?>
	</header>
	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php
		if ( isset( $content_type ) && $content_type != Scientific2016ContentType::Fast_science ) {
			do_action( 'mop_acf_post_authors', scientific_2016_get_author_info_type( $content_type ) );
		}
	?>

	<div class="entry-content">
		<?php if ( is_archive() || is_search() || (is_page() && is_page( '9085' )) ) { ?>
				<?php
				if ( has_excerpt() ) {
					?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
					<?php
				}
			}
			else {
				?>
				<?php
				the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'scientific-2016' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
				?>
			<?php } ?>


		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scientific-2016' ),
				'after' => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<!--	<footer class="entry-footer">-->
	<?php //scientific_2016_entry_footer();      ?>
	<!--	</footer> .entry-footer -->
</article><!-- #post-## -->
