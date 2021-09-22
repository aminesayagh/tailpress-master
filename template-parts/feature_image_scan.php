<?php

      $id_scan = get_the_ID();
      
      $post_type = get_post_type($id_scan);

      if($post_type == 'manga'){
            $terms = get_the_terms($id_scan, 'category');
      
            $relative_manga = get_page_by_title($terms[0]->name, 'OBJECT', 'manga');
      
            
            $cover_manga = get_field('image_manga', $relative_manga->ID );
            // var_dump($cover_manga);
      
            if( ! empty($cover_manga) ){
                  
                  echo '<div class="cover_img">';
                  echo '<img src="'. ($cover_manga) .'" alt="'. $relative_manga->name .'-cover">';
                  echo '</div>';
            }
      }



?>