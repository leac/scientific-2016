<?php
	/*
	 * Display blocks of posts on frnt page
	 */

	function scientific_2016_display_front_page_posts( $homepage_part ){
		// construct secondary query
		$posts_args = array(
			'post__not_in' => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1
		);
		switch ( $homepage_part ) {
			case Scientific2016ContentType::Articles:
				$posts_args['tag'] = ARTICLES_TAG_SLUG;
				$posts_args['posts_per_page'] = 3;
				break;
			case Scientific2016ContentType::Fast_science:
				$posts_args['tag'] = FAST_SCIENCE_TAG_SLUG;
				$posts_args['posts_per_page'] = 5;
				break;
			case Scientific2016ContentType::Opinions:
				$posts_args['tag'] = COLUMNS_OPINIONS_TAG_SLUG;
				$posts_args['posts_per_page'] = 3;
				break;
			default:
				$posts_args['posts_per_page'] = 3;
				break;
		}
		$frontpage_posts = new WP_Query( $posts_args );
		//Display output
		if ( $frontpage_posts->have_posts() ) {
			set_query_var( 'section_type', $homepage_part ); // set scetion_type, to be used in content-front-page.php
			?>
			<section class="block block-<?php echo $posts_args['tag'] ?>">

				<header class="block-title title-<?php echo $posts_args['tag'] ?>">
					<?php
					// Get term by name ''news'' in Tags taxonomy.
					$tag = get_term_by( 'slug', $posts_args['tag'], 'post_tag' );
					?>
					<a href="<?php echo get_tag_link( $tag->term_id ) ?>"><?php echo $tag->name ?> </a>
				</header>

				<div class="article-wrapper">
					<?php
					while ( $frontpage_posts->have_posts() ) : $frontpage_posts->the_post();

						get_template_part( 'template-parts/content', 'front-page' );
					endwhile;
					?>
				</div>

				<footer><a href="<?php echo get_tag_link( $tag->term_id ) ?>"><?php echo scientific_2016_get_tag_more_text( $tag->slug ) . ' ' . __( 'more', 'scientific-2016' );
					?> </a></footer>
			</section>
			<?php
		}
	}

	function scientific_2016_get_tag_more_text( $slug ){
		$ret='';
		switch ( $slug ) {
			case 'articles':
				$ret= __('articles', 'scientific-2016');
				break;
			case 'fast_science':
				$ret= __('fast ones', 'scientific-2016');
				break;
			case 'columns_and_opinions':
				$ret= __('columns', 'scientific-2016');
				break;
		}
		return $ret;
	}

	function scientific_2016_display_latest_issues( $max_num_of_issues = 5, $echo_year = false ){
		$current_issue_index = 1;

		$years = get_categories( 'orderby=slug&order=DESC&parent=' . ALL_ISSUES_CATEGORY_ID );
		?>
		<?php
		foreach ( $years as $year ) {
			if ( $echo_year ) {
				?>
				<h2><?php echo $year->cat_name ?></h2>
				<?php
			}
			$issues = get_categories( 'orderby=slug&order=DESC&parent=' . $year->cat_ID );
			foreach ( $issues as $issue ) {
				// need to break out of 2 loops. Use a variable
				if ( $current_issue_index <= $max_num_of_issues || $max_num_of_issues == -1 ) {
					$current_issue_index ++;
					scientific_2016_display_issue_cat( $issue );
				}
			}
		}
		?>
		<?php
	}

	function scientific_2016_display_issue_cat( $issue ){
		?>
		<header class="entry-header">
			<a href="<?php echo get_category_link( $issue->cat_ID ) ?>">
				<?php
				if ( function_exists( 'z_taxonomy_image' ) ) {
					/* Use z_taxonomy_image_url, because it doesn't break if the category doesn't have an image */
					$img_url = z_taxonomy_image_url( $issue->term_id );
					if ( ! empty( $img_url ) ) {
						?>
						<img src="<?php echo $img_url ?>" alt="">
						<?php
					}
				}
				?>
				<?php echo $issue->name ?>
			</a>
		</header>
		<?php
	}

	function scientific_2016_issue_posts( $query_obj, $sub_cat_obj ){
		if ( $query_obj->have_posts() ) {
			?>
			<h2><?php echo $sub_cat_obj->name ?></h2>
			<?php
			while ( $query_obj->have_posts() ) : $query_obj->the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile;
		}
	}
