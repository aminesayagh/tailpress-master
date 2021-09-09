
<?php
function upload_image($url, $name) {
	include_once( ABSPATH . 'wp-admin/includes/image.php' );
	$imageurl = $url;
	$imagetype = end(explode('/', getimagesize($imageurl)['mime']));
	// $uniq_name = date('dmY').''.(int) microtime(true); 
	$filename = $name.'.'.$imagetype;

	$uploaddir = wp_upload_dir();
	$uploadfile = $uploaddir['path'] . '/' . $filename;
	$contents= file_get_contents($imageurl);
	$savefile = fopen($uploadfile, 'w');
	fwrite($savefile, $contents);
	fclose($savefile);

	$wp_filetype = wp_check_filetype(basename($filename), null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => $filename,
		'post_content' => '',
		'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $uploadfile );
	$imagenew = get_post( $attach_id );
	$fullsizepath = get_attached_file( $imagenew->ID );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	return $uploadfile;
}

add_action('wp_ajax_nopriv_get_scans_from_api', 'get_scans_from_api');
add_action('wp_ajax_get_scans_from_api', 'get_scans_from_api');

add_action('wp_ajax_nopriv_post_local_img_in_post', 'post_local_img_in_post');
add_action('wp_ajax_post_local_img_in_post', 'post_local_img_in_post');

function get_scans_from_api(){

	$current_page = ( ! empty($_POST['current_page']) ) ? $_POST['current_page'] :  1;
	$scans = [];
	
	$results = wp_remote_retrieve_body(wp_remote_get('https://shinobyboy-crudapi.herokuapp.com/api/scan/all?page='. $current_page .'&limit=1'));

	$results = json_decode($results);

	if( ! is_array($results) || empty( $results )){
		return false;
	}

	$scan = $results[0];
	

	$scan_slug = sanitize_title( $scan->name );

	$exisiting_scan = get_page_by_path($scan_slug, 'OBJECT', 'scan');

	if( $exisiting_scan === null ){
		// $content_scan = '<section class="container-scan">';
		// $i = 1;
		// foreach($scan->content as $img) {
		// 	$new_img = upload_image($img, $scan_slug.'-'.$i);
		// 	$content_scan = $content_scan . '<img class="img-scan" src="' . $new_img . '" alt="' . $post->post_name . '-' . $i .'"';
		// 	$i++;
		// }
		// $content_scan = $content_scan . '</section>';
		$inserted_scan = wp_insert_post([
			'post_name' => $scan_slug,
			'post_title' => $scan->name,
			'post_type' => 'scan',
			'post_status' => 'draft',
			'post_category' => $scan->category,
		]);

		if( is_wp_error( $inserted_scan )) {
			return;
		}

		wp_remote_post( admin_url('admin-ajax.php?action=post_local_img_in_post'), [
			'blocking' => false,
			'sskverify' => false,
			'body' => [
				'current_page' => $current_page,
				'inserted_scan' => $inserted_scan,
				'scan_content' => $scan->content
			]
		]);
	}

}

function post_local_img_in_post(){
	$current_page = ( ! empty($_POST['current_page']) ) ? $_POST['current_page'] :  1;
	
	$id_post = $_POST['inserted_scan'];

	$list_img = $_POST['scan_content'];

	$content_scan = '<section class="container-scan">';
	$i = 1;
	foreach($list_img as $img) {
            $new_img = upload_image($img);
            $content_scan = $content_scan . '<img class="img-scan" src="' . $new_img . '" alt="' . $post->post_name . '-' . $i .'"';
            $i++;
	}
	$content_scan = $content_scan . '</section>';

	wp_update_post([
		'ID' => $id_post,
		'status' => 'publish',
		'post_content' => $content_scan,
	]);
	
	if($current_page > 20 ){
		return;
	}
	$current_page = $current_page + 1;
	wp_remote_post( admin_url('admin-ajax.php?action=get_scans_from_api'), [
		'blocking' => false,
		'sskverify' => false,
		'body' => [
			'current_page' => $current_page
		]
	] );
}

// add_action('save_post', 'save_post_callback', 10 , 3);

// function save_post_callback($post_id, $post, $update ) {
// 	if( $update ) {
// 		return;
// 	}
// 	if( wp_is_post_revision( $post_id )){
// 		return;
// 	}

// 	if( defined( 'DOING_AUTOSAVE' ) and DOING_AUTOSAVE ) {
// 		return;
// 	}
// 	if( $post->post_type != 'scan'){
// 		return;
// 	}
	
// 	$list_img = $post->post_content;
// 	$list_img = expoled(" - ", $list_img);
// 	$content_scan = '<section class="container-scan">';
// 	$i = 1;
// 	foreach($list_img as $img) {
// 		$new_img = upload_image($img);
// 		$content_scan = $content_scan . '<img class="img-scan" src="' . $new_img . '" alt="' . $post->post_name . '-' . $i .'"';
// 		$i++;
// 	}
	
// 	$content_scan = $content_scan . '</section>';
	
	
// 	wp_update_post([
// 		'ID' => $post_ID,
// 		'post_content' => $content_scan,
// 		'post_status' => 'publish',
// 	]);
	
// 	echo 'coco';
// }