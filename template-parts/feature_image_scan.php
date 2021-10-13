<?php
      $id_scan = get_the_ID();
      
      $post_type = get_post_type($id_scan);
      
      $title_manga = get_the_title($id_scan);
      
      echo var_dump($id_scan);
      echo var_dump($post_type);
      echo var_dump($title_manga);

      
      
      if($post_type == 'scan'){
            $terms = get_the_terms($id_scan, 'category');
            
            $relative_manga = get_page_by_title($terms[0]->name, 'OBJECT', 'manga');
            
            $cover_manga = get_field('image_manga', $relative_manga->ID );
      } else if ($post_type == 'manga') {
            $cover_manga = get_field('image_manga', $id_scan );
      }
      echo $cover_manga;
      if( ! empty($cover_manga) ){
            
            echo '<div class="cover_img">';
            echo '<img src="'. $cover_manga .'" alt="'. $title_manga .' cover">';
            echo '</div>';
      }
?>