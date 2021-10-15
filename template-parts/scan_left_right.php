<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking = get_field('raking', $id_scan);
      $category_for_link = preg_replace('/\s+/', '-', $category_scan[0]->name);

      $args_left = array(
            'post_type' => 'scan',
            'category_name' => $category_scan[0]->name,
            'posts_per_page' => 1,
            'meta_query' => array(
                  array(
                        'key' => 'raking',
                        'value' => $raking - 1,
                        'type' => 'numeric',
                  ),
            )
      );

      $my_query = new WP_Query($args_left);
      // echo '<div class="scan_navigation_container">';
      
      if( $my_query->have_posts() ) {while( $my_query->have_posts() ) : $my_query->the_post();
            echo '<a href=';
            echo the_permalink();
            echo ' class="left_scan">';
            echo the_title();
            echo '</a>';
      endwhile;
      } else {
            echo '<a class="left_scan" href="https://shinobyboy.co/manga/' . $category_for_link . '"></a>';
      }

      $args_right = array(
            'post_type' => 'scan',
            'category_name' => $category_scan[0]->name,
            'posts_per_page' => 1,
            'meta_query' => array(
                  array(
                        'key' => 'raking',
                        'value' => $raking + 1,
                        'type' => 'numeric',
                  ),
            )
      );

      $my_query = new WP_Query($args_right);

      if( $my_query->have_posts() ) { while( $my_query->have_posts() ) : $my_query->the_post();
            echo '<a href=';
            echo the_permalink();
            echo ' class="right_scan">';
            echo the_title();
            echo '</a>';
      endwhile;
      } else {
            echo '<a class="right_scan" href="https://shinobyboy.co/manga/' . $category_for_link . '"></a>';
      }
      // echo '</div>'
      // wp_reset_postdata();
?>