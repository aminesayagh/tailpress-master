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

function wpc_elementor_shortcode() {
	get_template_part( 'template-parts/counter-thanks', 'counter_thanks' );
};

add_shortcode( 'my_button_counter', 'wpc_elementor_shortcode' );

 // MANGA IMPORT DATA



ass_action('wp_ajax_nopriv_get_manga_from_api', 'get_manga_from_api');
ass_action('wp_ajax_get_manga_from_api', 'get_manga_from_api');

function upload_image($url, $post_id) {
    $image = "";
    if($url != "") {
     
        $file = array();
        $file['name'] = $url;
        $file['tmp_name'] = download_url($url);
 
        if (is_wp_error($file['tmp_name'])) {
            @unlink($file['tmp_name']);
            var_dump( $file['tmp_name']->get_error_messages( ) );
        } else {
            $attachmentId = media_handle_sideload($file, $post_id);
             
            if ( is_wp_error($attachmentId) ) {
                @unlink($file['tmp_name']);
                var_dump( $attachmentId->get_error_messages( ) );
            } else {                
                $image = wp_get_attachment_url( $attachmentId );
            }
        }
    }
    return $image;
}


function get_manga_from_api() {

	// $file = get_stylesheet_directory() . '/report.txt';
	$current_page = ( ! empty($_POST['current_page']) ) ? $_POST['current_page'] : 1;
	$scans = [];

	$results = wp_remote_retrieve_body( wp_remote_get('https://shinobyboy-crudapi.herokuapp.com/api/scan/Attack%20on%20Titan?page=1&limit=20' ));
	// file_put_content($file, 'Current Page: '. $current_page. '\n\n', FILE_APPEND);
	
	$results = json_decode($results);

	if( ! is_array( $results ) || empty( $results ) ){
		return false;
	}

	$scans[] = $results;

	foreach( $scans[0] as $scan ){
		 
		$scan_slug = sanitize_title($scan->name);

		$scan_content = '<section class="container-images">';
		$i = 0;
		foreach( $scan->content as $img){
			$img_updated = upload_image($img, $scan_slug);
			$scan_content = $scan_content . '<img src="'. $img_updated . ' class="contain-image" alt="' . $scan_slug . '-' . $i . '">';
			$i++;
		}

		$scan_content = $scan_content . '</section>';

		$inserted_scan = wp_insert_post([
			'post_name' => $scan_slug,
			'post_title' => $scan_slug,
			'post_type' => 'scan',
			'post_status' => 'publish',
			'post_content' => $scan_content
		]);

		if( is_wp_error($inserted_scan) ) {
			continue;
		}

		// foreach( $fillable as $key => $name) {
		// 	update_field( $key , $scan->$name, $inserted_scan);
		// }
	}

	// $current_page = $current_page + 1;
	// wp_remote_post( admin_url('admin-ajax.php?action=get_manga_from_api'), [
	// 	'blocking' => false,
	// 	'sslverify' => false
	// ] );

	// 'https://shinobyboy-crudapi.herokuapp.com/api/scan/all?page=' '&limit=20'
}