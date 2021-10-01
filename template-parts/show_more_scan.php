<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking_scan = get_field('raking', $id_scan);
      $link_category_scan = 'https://shinobyboy.co/manga/'. $category_scan;
      
      if( $raking_scan ){
            echo '<div>';
            echo '<div name="other_chapter" class="other_chapter">';
            echo '<h5><a class="h-24" href="#">' . get_the_title($id_scan) . '</a></h5>';
            echo '</div>';
            echo '<div>';
            
            $args = array('post_type' => 'scan', 'category_name' => $category_scan, 'posts_per_page' => 20);
            
            $my_query = new WP_Query( $args );
            
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
                  echo '<h5><a href='. the_permalink() .'>';
                  the_title();
                  echo '</a></h5>';
            endwhile;
            endif;

            wp_reset_postdata();
            
            
            echo '</div>';
      }
?>