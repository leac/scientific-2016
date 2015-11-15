<?php

	function scientific_2016_get_archive_title_class(){
		$ret = '';
		if ( is_tag() ) {
			$tag = get_query_var( 'tag' );
			$ret = 'title-'.$tag;
		}
		return $ret;
	}
