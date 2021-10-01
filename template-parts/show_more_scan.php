<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking_scan = get_field('raking', $id_scan);
      $link_category_scan = 'https://shinobyboy.co/manga/'. $category_scan;
      
      if( $raking_scan ){
            echo '<div>';
            echo '<select name="other_chapter" class="other_chapter">';
            echo '<option default><a class="h-24" href="#">' . get_the_title($id_scan) . '</a></option>';
            echo '</select>';
            echo '</div>';
      }
?>