<?php

	/**
	 * scientific_2016 functions and definitions.
	 *
	 * @link https://codex.wordpress.org/Functions_File_Explained
	 *
	 * @package scientific_2016
	 */
	if ( ! function_exists( 'scientific_2016_setup' ) ) :

		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 */
		function scientific_2016_setup(){
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 * If you're building a theme based on scientific_2016, use a find and replace
			 * to change 'scientific-2016' to the name of your theme in all the template files.
			 */
			load_theme_textdomain( 'scientific-2016', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );
			add_image_size( 'scientific-2016-full_width', 1600, 585, true );
			add_image_size( 'scientific-2016-full_width_half', 800, 292.5, true );
			add_image_size( 'scientific-2016-articles_size', 390, 390, true );
			add_image_size( 'scientific-2016-fast_science_size', 216, 216, true );
			add_image_size( 'scientific-2016-opinions_size', 388, 255, true );

			// This theme uses wp_nav_menu() in one location.
			register_nav_menus( array(
				'primary' => esc_html__( 'Primary Menu', 'scientific-2016' ),
			) );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

			/*
			 * Enable support for Post Formats.
			 * See https://developer.wordpress.org/themes/functionality/post-formats/
			 */
			add_theme_support( 'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
			) );

			// Set up the WordPress core custom background feature.
			add_theme_support( 'custom-background', apply_filters( 'scientific_2016_custom_background_args', array(
				'default-color' => 'ffffff',
				'default-image' => '',
			) ) );

			// add constants
			define( 'ARTICLES_TAG_SLUG', 'articles' );
			define( 'FAST_SCIENCE_TAG_SLUG', 'fast_science' );
			define( 'COLUMNS_OPINIONS_TAG_SLUG', 'columns_and_opinions' );
			define( 'ALL_ISSUES_CATEGORY_ID', 13 );
			define( 'ARTICLES_CAT_NAME', 'articles' );
			define( 'OPINIONS_CAT_NAME', 'opinions' );
			define( 'FAST_SCIENCE_CAT_NAME', 'quick-science' );
		}

	endif; // scientific_2016_setup
	add_action( 'after_setup_theme', 'scientific_2016_setup' );

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function scientific_2016_content_width(){
		$GLOBALS['content_width'] = apply_filters( 'scientific_2016_content_width', 640 );
	}

	add_action( 'after_setup_theme', 'scientific_2016_content_width', 0 );

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function scientific_2016_widgets_init(){
		register_sidebar( array(
			'name' => esc_html__( 'Sidebar Front Page', 'scientific-2016' ),
			'id' => 'sidebar-front-page',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="block widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="block-title-plain">',
			'after_title' => '</h2>',
		) );
		register_sidebar( array(
			'name' => esc_html__( 'Sidebar Footer', 'scientific-2016' ),
			'id' => 'sidebar-footer',
			'description' => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		) );
	}

	add_action( 'widgets_init', 'scientific_2016_widgets_init' );

	/**
	 * Enqueue scripts and styles.
	 */
	function scientific_2016_scripts(){
		wp_enqueue_style( 'scientific-2016-style', get_stylesheet_uri() );

		wp_enqueue_style( 'scientific-2016-style-960-and-more', get_template_directory_uri() . '/style_960.css' );

		wp_enqueue_style( 'scientific-2016-object-fit', get_template_directory_uri() . '/objectfit/polyfill.object-fit.min.css' );

		wp_enqueue_script( 'scientific-2016-object-fit-js', get_template_directory_uri() . '/objectfit/polyfill.object-fit.min.js', array( 'jquery' ), '20120206', true );

		wp_enqueue_script( 'scientific-2016-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

		wp_enqueue_script( 'scientific-2016-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

		wp_enqueue_script( 'scientific-2016-script', get_template_directory_uri() . '/js/scientific-2016.js', array( 'jquery' ), '0.5', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'scientific_2016_scripts' );

	/**
	 * Implement the Custom Header feature.
	 */
	require get_template_directory() . '/inc/custom-header.php';

	/**
	 * Custom template tags for this theme.
	 */
	require get_template_directory() . '/inc/template-tags.php';

	/**
	 * Custom functions that act independently of the theme templates.
	 */
	require get_template_directory() . '/inc/extras.php';

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';

	/**
	 * Load Jetpack compatibility file.
	 */
	require get_template_directory() . '/inc/jetpack.php';

	/**
	 * Load Andavnced Custom Fields usage file.
	 */
	require get_template_directory() . '/inc/custom-fields.php';

	/**
	 * Load Front page Block displayer.
	 */
	require get_template_directory() . '/inc/front-page-blocks.php';

	/**
	 * Load Archive helper functions.
	 */
	require get_template_directory() . '/inc/archive-helper.php';
