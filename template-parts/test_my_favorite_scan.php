<?php
       $favorite_manga_array = explode( ',',$_COOKIE['my_favorites_mangas']);
	$mangas_titles = [];
	foreach ($favorite_manga_array as $manga){
		$title_of_manga = get_the_title($manga);
		array_push($mangas_titles, $title_of_manga);
	}
      $args = array(
            'post_type' => 'scan',
            'category_name' => $mangas_titles[0],
            'post_per_page' => 10,
      );

      echo var_dump($mangas_titles);
      $my_query = new WP_Query($args);
      if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            echo var_dump(the_title());
            echo 'coc';
            endwhile;
            endif;
            
            wp_reset_query();
?>