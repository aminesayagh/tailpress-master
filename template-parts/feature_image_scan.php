<?php
      $id_scan = get_the_ID();
      
      $post_type = get_post_type($id_scan);
      
      $title_manga = get_the_title($id_scan);
      if($post_type == 'scan'){
            $terms = get_the_terms($id_scan, 'category');
            $relative_manga = get_page_by_title($terms[0]->name, 'OBJECT', 'manga');
            $cover_manga = get_field('image_manga', $relative_manga->ID );
      } else if ($post_type == 'manga') {
            $cover_manga = get_field('image_manga', $id_scan );
      }
      if( ! empty($cover_manga) ){
            // echo '<div class="cover_img">';
            $link_scan = get_permalink($id_scan);
            echo '<a href="'. $link_scan .'">';
            echo '<img data="lazyloaded" src="'. $cover_manga .'" alt="'. $title_manga .' cover">';
            echo '</a>';
            // echo '</div>';
      }
      wp_reset_postdata();
?>