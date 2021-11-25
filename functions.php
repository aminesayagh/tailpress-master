<?php

/**
 * Enqueue scripts.
 */
function tailpress_enqueue_scripts() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'tailpress', tailpress_get_mix_compiled_asset_url( 'css/app.css' ), array(), $theme->get( 'Version' ) );
	wp_enqueue_script( 'tailpress', tailpress_get_mix_compiled_asset_url( 'js/app.js' ), array(), $theme->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_scripts' );

/**
 * Get mix compiled asset.
 *
 * @param string $path The path to the asset.
 *
 * @return string
 */
function tailpress_get_mix_compiled_asset_url( $path ) {
	$path                = '/' . $path;
	$stylesheet_dir_uri  = get_stylesheet_directory_uri();
	$stylesheet_dir_path = get_stylesheet_directory();

	if ( ! file_exists( $stylesheet_dir_path . '/mix-manifest.json' ) ) {
		return $stylesheet_dir_uri . $path;
	}

	$mix_file_path = file_get_contents( $stylesheet_dir_path . '/mix-manifest.json' );
	$manifest      = json_decode( $mix_file_path, true );
	$asset_path    = ! empty( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return $stylesheet_dir_uri . $asset_path;
}

/**
 * Get data from the tailpress.json file.
 *
 * @param mixed $key The key to retrieve.
 *
 * @return mixed|null
 */
function tailpress_get_data( $key = null ) {
	$config = json_decode( file_get_contents( get_stylesheet_directory() . '/tailpress.json' ), true );

	if ( $key === null ) {
		return filter_var_array( $config, FILTER_SANITIZE_STRING );
	}

	$option = filter_var( $config[ $key ], FILTER_SANITIZE_STRING );

	return $option ?? null;
}

/**
 * Theme setup.
 */
function tailpress_setup() {
	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	// Adding Thumbnail basic support.
	add_theme_support( 'post-thumbnails' );

	// Block editor.
	add_theme_support( 'align-wide' );

	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'editor-styles' );
	add_editor_style();

	$tailpress = tailpress_get_data();

	$colors = array_map(
		function ( $color, $hex ) {
			return array(
				'name'  => ucfirst( $color ),
				'slug'  => $color,
				'color' => $hex,
			);
		},
		array_keys( $tailpress['colors'] ),
		$tailpress['colors']
	);

	$font_sizes = array_map(
		function ( $size, $px ) {
			return array(
				'name' => ucfirst( $size ),
				'size' => $px,
				'slug' => $size,
			);
		},
		array_keys( $tailpress['fontSizes'] ),
		$tailpress['fontSizes']
	);

	add_theme_support( 'editor-color-palette', $colors );
	add_theme_support( 'editor-font-sizes', $font_sizes );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
	wp_deregister_script('heartbeat');
}

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The curren item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );

function wpc_elementor_shortcode_button_love() {
	get_template_part( 'template-parts/counter-thanks', 'counter_thanks' );
};

add_shortcode( 'my_button_counter', 'wpc_elementor_shortcode_button_love' );

function wpc_elementor_shortcode_groupe_data_of_manga() {
	get_template_part( 'template-parts/my_groupe_data_of_manga', 'my_groupe_data_of_manga');
};

add_shortcode( 'my_groupe_data_of_manga', 'wpc_elementor_shortcode_groupe_data_of_manga');

function wpc_elementor_shortcode_loop_external_link() {
	get_template_part('template-parts/my_loop_external_link', 'my_loop_external_link');
};

add_shortcode('my_loop_external_link', 'wpc_elementor_shortcode_loop_external_link');

function wpc_elementor_shortcode_feature_image_scan(){
	get_template_part('template-parts/feature_image_scan', 'feature_image_scan');
}

add_shortcode('feature_image_scan', 'wpc_elementor_shortcode_feature_image_scan');

function wpc_elementor_shortcode_go_back_button(){
	get_template_part('template-parts/go_back_button', 'go_back_button');
}

add_shortcode('go_back_button', 'wpc_elementor_shortcode_go_back_button');

function wpc_elementor_shortcode_show_more_scan(){
	get_template_part('template-parts/show_more_scan', 'show_more_scan');
}

add_shortcode('show_more_scan', 'wpc_elementor_shortcode_show_more_scan');

function wpc_elementor_shortcode_scan_left_right(){
	get_template_part('template-parts/scan_left_right', 'scan_left_right');
}

add_shortcode('scan_left_right', 'wpc_elementor_shortcode_scan_left_right');

function wpc_elementor_shortcode_raking_num(){
	get_template_part('template-parts/raking_num', 'raking_num');
}

add_shortcode('raking_num', 'wpc_elementor_shortcode_raking_num');

function wpc_elementor_shortcode_my_favorite_scan(){
	get_template_part('template-parts/test_my_favorite_scan', 'my_favorite_scan');
}

add_shortcode('my_favorite_scan', 'wpc_elementor_shortcode_my_favorite_scan');

add_action('elementor/query/query_scan_filter_by_title_manga', function( $query ) {
	// order by category imported from title or field data_manga, and meta_key raking
	$post_title = get_the_title();
	$data_manga = get_field('data_manga');
	$post_eng_title = $data_manga['english'];
	$query->set('category_name', $post_eng_title);
	$query->set('category_name', $post_title);
	$query->set('orderby', 'meta_value_num');
	$query->set('meta_key', 'raking');
	$query->set('order', 'DESC');
	wp_reset_query();
});

add_action('elementor/query/query_scan_raking', function ($query) {
	$query->set('post_type', 'scan');
	$array_order =  array('date' => 'DESC', 'raking', 'DESC' );
	$query->set('orderby', $array_order);
	wp_reset_query();
});

add_action('elementor/query/query_manga_popularity', function ($query){
	$query->set('post_type', 'mangas');
	$query->set('posts_per_page', 18);

	$query->set('order', 'ASC');
	$query->set('orderby', 'meta_value_num');
	$query->set('meta_key', 'popular_num');
	wp_reset_query();	
});

add_action('elementor/query/query_manga_rated', function ($query){
	$query->set('post_type', 'mangas');
	$query->set('posts_per_page', 18);
	$query->set('order', 'ASC');
	$query->set('orderby', 'meta_value_num');
	$query->set('meta_key', 'rated_num');
	wp_reset_query();
});

add_action('elementor/query/query_my_favorites_mangas', function($query){
      $favorite_array = explode( ',',$_COOKIE['my_favorites_mangas']);
	$query->set('post_type', 'mangas');
	// $query->set('posts_per_page', 18);
	$query->set('post__in', $favorite_array);
	wp_reset_query();
});

add_action('elementor/query/query_my_favorite_scan', function($query){
      $favorite_manga_array = explode( ',',$_COOKIE['my_favorites_mangas']);
	$mangas_titles = '';
	foreach ($favorite_manga_array as $manga){
		$title_of_manga = get_the_title($manga);
            $mangas_titles = $mangas_titles . ',' . $title_of_manga;
	}
	$query->set('post_type', 'scan');
	$query->set('category_name', $mangas_titles);
	
});