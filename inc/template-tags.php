<?php

	/**
	 * Class as enum, for determiing what part of the homepage is being displayed
	 */
	abstract class Scientific2016ContentType {

		const Newest = 'newest';
		const Articles = 'articles';
		const Fast_science = 'fast_science';
		const Opinions = 'columns_and_opinions';
		const Single_article_top = 'single_top';
		const Single_article_bottom = 'single_bottom';
		const Our_Authors = 'our_authors';

	}

	function scientific_2016_get_author_info_type( $section_type ){
		$scientific_2016_content_type_acf = array(
			Scientific2016ContentType::Newest => 'name',
			Scientific2016ContentType::Articles => 'name',
			Scientific2016ContentType::Fast_science => '',
			Scientific2016ContentType::Opinions => 'image , name',
			Scientific2016ContentType::Single_article_top => 'name',
			Scientific2016ContentType::Single_article_bottom => 'image , name, description',
			Scientific2016ContentType::Our_Authors => 'image , name, description'
		);
		$author_fields = $scientific_2016_content_type_acf[$section_type];

		return $author_fields;
	}

	/**
	 * Custom template tags for this theme.
	 *
	 * Eventually, some of the functionality here could be replaced by core features.
	 *
	 * @package scientific_2016
	 */
	if ( ! function_exists( 'scientific_2016_posted_on' ) ) :

		/**
		 * Prints HTML with meta information for the current post-date/time and author.
		 */
		function scientific_2016_posted_on(){
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
			);


			echo '<span class="posted-on">' . $time_string . '</span>'; // WPCS: XSS OK.
		}

	endif;

	if ( ! function_exists( 'scientific_2016_show_tags' ) ) :

		function scientific_2016_show_tags(){
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'scientific-2016' ) );
			$filtered_tags_list = scientific_2016_show_only_one_tag( $tags_list );
			if ( $filtered_tags_list ) {
				printf( '<span class="tags-links">' . esc_html( '%1$s' ) . '</span>', $filtered_tags_list ); // WPCS: XSS OK.
			}
		}

	endif;

	/**
	 * Only show one tag of a post. And some tags aren't supposed to appear at all
	 * @param type $tags_list
	 * @return string - tag name
	 */
	function scientific_2016_show_only_one_tag( $tags_list ){

		$tags_list_arr = explode( ',', $tags_list );

		$filtered_tags_list_arr = array_filter( $tags_list_arr, function($value) {
			// we never want to show the tags: articles, columns_and_opinions, fast_science
			if ( strstr( $value, ARTICLES_TAG_SLUG ) !== false ||
				strstr( $value, FAST_SCIENCE_TAG_SLUG ) !== false ||
				strstr( $value, COLUMNS_OPINIONS_TAG_SLUG ) !== false ) {
				return false;
			}
			return true;
		} );

		$filtered_tags_list_arr = array_values( $filtered_tags_list_arr ); // reset index after filtering out some tags
		$ret = count( $filtered_tags_list_arr ) >= 1 ? $filtered_tags_list_arr[0] : ''; // always retrun the first tag, or empty string if not tag exists
		return $ret;
	}

	if ( ! function_exists( 'scientific_2016_entry_footer' ) ) :

		/**
		 * Prints HTML with meta information for the categories, tags and comments.
		 */
		function scientific_2016_entry_footer(){
			// Hide category and tag text for pages.
			if ( 'post' === get_post_type() ) {
				/* Lea 2015/09 - don't show categories */

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', esc_html__( ', ', 'scientific-2016' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links separator-element">' . esc_html__( 'Tagged %1$s', 'scientific-2016' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
			}

			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link( esc_html__( 'Leave a comment', 'scientific-2016' ), esc_html__( '1 Comment', 'scientific-2016' ), esc_html__( '% Comments', 'scientific-2016' ) );
				echo '</span>';
			}

			edit_post_link( esc_html__( 'Edit', 'scientific-2016' ), '<span class="edit-link">', '</span>' );
		}

	endif;

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function scientific_2016_categorized_blog(){
		if ( false === ( $all_the_cool_cats = get_transient( 'scientific_2016_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields' => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number' => 2,
				) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'scientific_2016_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so scientific_2016_categorized_blog should return true.
			return true;
		}
		else {
			// This blog has only 1 category so scientific_2016_categorized_blog should return false.
			return false;
		}
	}

	/**
	 * Flush out the transients used in scientific_2016_categorized_blog.
	 */
	function scientific_2016_category_transient_flusher(){
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'scientific_2016_categories' );
	}

	add_action( 'edit_category', 'scientific_2016_category_transient_flusher' );
	add_action( 'save_post', 'scientific_2016_category_transient_flusher' );

	function scientific_2016_modify_query( $query ){
		/* In homepage, get sticky post, or - if no sticky post exists - get the newest post */
		if ( $query->is_home() && $query->is_main_query() ) {
			global $scientific_2016_sticky_exists;
			$scientific_2016_sticky_exists = count( get_option( 'sticky_posts' ) ) > 0 ? true : false;
			if ( $scientific_2016_sticky_exists ) {
				$query->set( 'posts_per_page', 1 );
				$query->set( 'post__in', array( get_option( 'sticky_posts' ), 'posts' ) );
				$query->set( 'ignore_sticky_posts', 0 );
			}
			else { // if no sticky, just get the latest post
				$query->set( 'posts_per_page', 1 );
			}
		}
		elseif ( is_category( ALL_ISSUES_CATEGORY_ID ) && $query->is_main_query() ) {
			/* don't get any posts. The easiest way to do that is to limit the post to this category alone.
			  Since it has none, none will be retieved. */
			$query->set( 'category__in', ALL_ISSUES_CATEGORY_ID );
		}
		elseif ( is_category() && $query->is_main_query() ) {
			$curr_cat = get_queried_object_id();
			$top_parent = scientific_2016_category_top_parent_id( $curr_cat );
			if ( $top_parent == ALL_ISSUES_CATEGORY_ID ) {
				/* In specific issues we have to get posts by subcategories.
				 * So get the subcategories of the specific issue, and set the cat as the articles subcategory,
				 * only in main query */

				$issue_sub_categories = get_categories( 'parent=' . $curr_cat );
				if ( count( $issue_sub_categories ) > 0 ) {
					set_query_var( 'issue_sub_categories', $issue_sub_categories );
					// get the ID of the articles category
					$article_sub_cat_arr = array_values( array_filter( $issue_sub_categories, function ($obj ) {
							if ( strpos( $obj->slug, ARTICLES_CAT_NAME ) > -1 ) {
								return true;
							}
						} ) );
					/* Only in articles sub category we want to set the cat on pre_get_posts.
					 * The other sub categories will have their own queries			 */
					if ( count( $article_sub_cat_arr ) > 0 ) {
						$query->set( 'category__in', $article_sub_cat_arr[0]->cat_ID );
						//$query->set( 'posts_per_page', 1 );
						set_query_var( 'first_issue_category', $article_sub_cat_arr[0] );
					}
				}
			}
		}
	}

	/**
	 * This hook is called after the query variable object is created, but before the actual query is run
	 */
	add_filter( 'pre_get_posts', 'scientific_2016_modify_query' );

	function scientific_2016_category_top_parent_id( $catid ){
		$catParent = 0;
		while ( $catid ) {
			$cat = get_category( $catid ); // get the object for the catid
			$catid = $cat->category_parent; // assign parent ID (if exists) to $catid
			// the while loop will continue whilst there is a $catid
			// when there is no longer a parent $catid will be NULL so we can assign our $catParent
			$catParent = $cat->cat_ID;
		}
		return $catParent;
	}

	/**
	 * Display the archive title based on the queried object.
	 *
	 * @see get_the_archive_title()
	 *
	 * @param string $before Optional. Content to prepend to the title. Default empty.
	 * @param string $after  Optional. Content to append to the title. Default empty.
	 */ function scientific_2016_the_archive_title( $before = '', $after = '' ){
		$title = scientific_2016_get_the_archive_title();

		if ( ! empty( $title ) ) {
			echo $before . $title . $after;
		}
	}

	/**
	 * Retrieve the archive title based on the queried object.
	 *
	 * @since 4.1.0
	 *
	 * @return string Archive title.
	 */
	function

	scientific_2016_get_the_archive_title(){
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		}
		elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		}
		elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		}
		elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
		}
		elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
		}
		elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
		}
		elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title' );
			}
			elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title' );
			}
		}
		elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s' ), post_type_archive_title( '', false ) );
		}
		elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s' ), $tax->labels->singular_name, single_term_title( '', false ) );
		}
		else {
			$title = __( 'Archives' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @since 4.1.0
		 *
		 * @param string $title Archive title to be displayed.
		 */
		return apply_filters( 'get_the_archive_title', $title );
	}

	/**
	 * Display the designed default avatat in options-discussion
	 */
	if ( ! function_exists( 'custom_avatar' ) ) {

		function scientific_2016_custom_avatar( $avatar_defaults ){
			$new_default_icon = get_bloginfo( 'template_directory' ) . '/images/new-avatar.png';
			$avatar_defaults[$new_default_icon] = 'My Custom Avatar';
			return $avatar_defaults;
		}

		add_filter( 'avatar_defaults', 'scientific_2016_custom_avatar' );
	}

	/**
	 * Add the "author" query var, for use on author page
	 * @param array $vars
	 * @return array $vars including new var
	 */
	function scientific_2016_add_query_vars_filter( $vars ){
		//$vars[] = "author_name";
		$vars[] = "group_id";
		$vars[] = "post_id";
		return $vars;
	}

	add_filter( 'query_vars', 'scientific_2016_add_query_vars_filter' );

	/**
	 * Return content_type according to category slug
	 * @param int $cat_slug
	 */
	function scientific_2016_set_content_type_by_cat_slug( $cat_slug ){
		$ret = '';
		if ( strpos( urldecode( $cat_slug ), ARTICLES_CAT_NAME ) > -1 ) {
			$ret = Scientific2016ContentType::Articles;
		}
		elseif ( strpos( urldecode( $cat_slug ), OPINIONS_CAT_NAME ) > -1 ) {
			$ret = Scientific2016ContentType::Opinions;
		}
		elseif ( strpos( urldecode( $cat_slug ), FAST_SCIENCE_CAT_NAME ) > -1 ) {
			$ret = Scientific2016ContentType::Fast_science;
		}
		return $ret;
	}

	/**
	 * Show posts in issue, by category
	 * @param object $query_obj - Wp_Query object with posts
	 * @param type $sub_cat_obj - the current sub category (articlse, fast science or opinions)
	 * @param object $content_type - category content type
	 */
	function scientific_2016_issue_posts( $query_obj, $sub_cat_obj, $content_type ){
		if ( $query_obj->have_posts() ) {
			?>
			<h2 class="title-<?php echo $content_type ?>"><?php echo $sub_cat_obj->name ?></h2>
			<div class="article-wrapper">
				<?php
				while ( $query_obj->have_posts() ) : $query_obj->the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;
				?>
			</div>
			<?php
		}
	}

	function scientific_2016_related_posts_section(){
		if ( function_exists( 'wp_related_posts' ) ) {
			?>
			<section class="more-articles">
				<?php
				$cat = get_the_category();
				if ( count( $cat ) > 0 ) {
					$content_type = scientific_2016_set_content_type_by_cat_slug( $cat[0]->slug );
					?>

					<header class="title-<?php echo $content_type ?>"><?php echo scientific_2016_related_posts_title( $content_type ) ?></header>

					<?php
				}
				wp_related_posts();
				?>

			</section>
			<?php
		}
	}

	/**
	 * Set title of related posts, by category
	 * @return title
	 */
	function scientific_2016_related_posts_title( $content_type ){
		$ret = '';

		switch ( $content_type ) {
			case Scientific2016ContentType::Articles:
				$ret .= __( 'articles', 'scientific-2016' ) . ' ' . _x( 'more', 'after noun', 'scientific-2016' );
				break;
			case Scientific2016ContentType::Fast_science:
				$ret .= _x( 'more', 'before noun', 'scientific-2016' ) . ' ' . __( 'fast science', 'scientific-2016' );
				break;
			case Scientific2016ContentType::Opinions:
				$ret .= _x( 'more', 'before noun', 'scientific-2016' ) . ' ' . __( 'opinions and columns', 'scientific-2016' );
				break;
			default:
				$ret .= __( 'articles', 'scientific-2016' ) . ' ' . _x( 'more', 'after noun', 'scientific-2016' );
				break;
		}
		return $ret;
	}
