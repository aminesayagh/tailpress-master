<?php
	$favorite = array($_COOKIE['my_favorites_mangas']);
      $args = array('post_type' => 'manga', 'post__in' => $favorite);
      echo var_dump($favorite);
      $my_query = new WP_Query($args);
      if( $my_query->have_posts() ) {while( $my_query->have_posts() ) : $my_query->the_post();
            echo the_permalink();
            echo the_title();
      endwhile;
      } else {
      }
      
?>