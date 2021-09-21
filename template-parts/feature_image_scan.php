<?php

      $id_scan = get_the_ID();

      $terms = get_the_terms($id_scan, 'category');

      $relative_manga = get_page_by_title($terms, 'OBJECT', 'manga');

      

      var_dump($terms[0]->name);

      $cover_manga = get_field('image_manga', $relative_manga->ID );

      if( ! empty($cover_manga) ){

            echo '<div class="cover_img">';
            echo '<img src="'. esc_url($cover_manga['url']) .' alt="'. esc_attr($relative_manga) .'">';
            echo '</div>';
      }


?>