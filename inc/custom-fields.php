<?php

	/**
	 * Get the featured image in the correct size.
	 * @param type $section_type
	 */
	function scientific_2016_show_post_attached_image( $section_type ){
		switch ( $section_type ) {
			case Scientific2016ContentType::Newest:
			case Scientific2016ContentType::Single_article_top:
				$field_name = "featuredimage";
				$field = get_field_object( $field_name );
				if ( ! empty( $field ) && isset( $field['value']['sizes']['scientific-2016-full_width'] ) ) {
					?>
					<img src="<?php echo $field['value']['sizes']['scientific-2016-full_width']; ?>">
					<?php
				}
				break;
			default :
				echo scientific_2016_get_post_featured_image( $section_type );
				break;
		}
	}

	function scientific_2016_get_post_featured_image( $section_type ){
		$ret = '';
		if ( has_post_thumbnail() ) {
			$img_size = '';
			switch ( $section_type ) {
				case Scientific2016ContentType::Articles:
					$img_size = 'scientific-2016-articles_size';
					break;
				case Scientific2016ContentType::Fast_science:
					$img_size = 'scientific-2016-fast_science_size';
					break;
				case Scientific2016ContentType::Opinions:
					$img_size = 'scientific-2016-opinions_size';
					break;
				default :
					$img_size = 'scientific-2016-articles_size';
					break;
			}
			$ret = get_the_post_thumbnail( null, $img_size );
		}
		else {
			// use default image
			$ret = '<img src="' . get_template_directory_uri() . '/images/default_$size$.png" alt="' . __( 'default featured image', 'scientific-2016' ) . '">';
			// set specific size according to the section
			switch ( $section_type ) {
				case Scientific2016ContentType::Articles:
					$ret = str_replace( '$size$', '390', $ret );
					break;
				case Scientific2016ContentType::Fast_science:
					$ret = str_replace( '$size$', '216', $ret );
					break;
				case Scientific2016ContentType::Opinions:
					$ret = str_replace( '$size$', '388X255', $ret );
					break;
				default :
					$ret = str_replace( '$size$', '390', $ret );
					break;
			}
		}
		return $ret;
	}

	/**
	 * Print the meta field 'summary'
	 */
	function scientific_2016_get_meta_field_value_only( $field_name ){
		$the_field = get_field( $field_name );
		return $the_field;
	}

	/**
	 * Print the meta field 'summary'
	 */
	function scientific_2016_show_meta_field_with_label( $field_name ){
		$the_field_obj = get_field_object( $field_name );
		if ( ! empty( $the_field_obj['value'] ) ) {
			?>
			<div class="<?php echo htmlspecialchars( $field_name ) ?>">
				<h3><?php echo $the_field_obj['label'] ?></h3>
			<?php echo $the_field_obj['value']; ?>
			</div>
			<?php
		}
	}
