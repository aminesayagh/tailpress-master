<?php setcookie('like', '0', time() + 365*24*3600, null, null, false, true);?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( ); ?>>

<?php do_action( 'tailpress_site_before' ); ?>

<?php
$results = wp_remote_retrieve_body(wp_remote_get('https://shinobyboy-crudapi.herokuapp.com/api/scan/all?page=1&limit=20'));

echo '<pre>';
print_r($results);
echo '</pre>';
die();

?>
<div id="page">

	<?php do_action( 'tailpress_header' ); ?>

	<header>
	</header>

	<div id="content">

		<?php do_action( 'tailpress_content_start' ); ?>

		<main>
