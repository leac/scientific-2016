<?php
	scientific_2016_the_archive_title( '<h1 class="page-title">', '</h1>' );

	if ( isset( $issue_sub_categories ) ) {

		// show the issue posts by category
		foreach ( $issue_sub_categories as $issue_sub_category ) {
			//echo $issue_sub_category->cat_ID;

			// set the conent type for the different sub categories - articles, opinions and fast-science
			$content_type = scientific_2016_set_content_type_by_cat_slug( $issue_sub_category->slug );
			?>
			<section class="block block-<?php echo $content_type ?>">
				<?php
				$sub_cat_posts;
				// the first category's posts were already retrieved by WP, so just print them
				if ( strpos( urldecode( $issue_sub_category->slug ), ARTICLES_CAT_NAME ) > -1 ) {
					// use the main query, and assign it to $sub_cat_posts which is used by the other queries
					global $wp_query;
					$sub_cat_posts = $wp_query;
				}
				else {
					// get the posts of the sub category and print them
					$sub_cat_posts = new WP_Query( 'cat=' . $issue_sub_category->cat_ID . '&posts_per_page=-1&orderby=name' );
				}

				set_query_var( 'content_type', $content_type );

				scientific_2016_issue_posts( $sub_cat_posts, $issue_sub_category, $content_type );
				?>
			</section>
			<?php
		}
	}