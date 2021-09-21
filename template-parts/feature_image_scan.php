<?php

      $id_scan = get_the_ID();

      $terms = get_the_terms($id_scan, 'category');

      // var_dump($terms[0]->name);
      // echo $terms[0];
      $relative_manga = get_page_by_title($terms[0]->name, 'OBJECT', 'manga');

      
      $cover_manga = get_field('image_manga', $relative_manga->ID );
      // var_dump($cover_manga);

      if( ! empty($cover_manga) ){

            echo '<div class="cover_img">';
            echo '<img src="'. esc_url($cover_manga['url']) .' alt="'. esc_attr($relative_manga->name) .'-cover">';
            echo '</div>';
      }


?>