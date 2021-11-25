<?php
       $favorite_manga_array = explode( ',',$_COOKIE['my_favorites_mangas']);
	$mangas_titles = [];
	foreach ($favorite_manga_array as $manga){
		$title_of_manga = get_the_title($manga);
		array_push($mangas_titles, $title_of_manga);
	}
      echo var_dump($mangas_titles);
?>