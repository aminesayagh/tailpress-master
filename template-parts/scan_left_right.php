<?php
      echo '<div class="">';
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking = get_field('raking', $id_scan);

      $args_left = array(
            'post_type' => 'scan',
            'category_name' => $category_scan[0]->name,
            'posts_per_page' => 1,
            'meta_query' => array(
                  array(
                        'key' => 'raking',
                        'value' => $raking - 1,
                        'type' => 'numeric',
                        // 'compare' => '=='
                  ),
            )
      );

      $my_query = new WP_Query($args_left);

      if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            echo '<a href="' . the_permalink() . '" class="left_scan">'. the_title() .'</a>';
      endwhile;
      endif;

      $args_right = array(
            'post_type' => 'scan',
            'category_name' => $category_scan[0]->name,
            'posts_per_page' => 1,
            'meta_query' => array(
                  array(
                        'key' => 'raking',
                        'value' => $raking + 1,
                        'type' => 'numeric',
                        // 'compare' => '=='
                  ),
            )
      );

      $my_query = new WP_Query($args_right);

      if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            echo '<a href=';
            echo the_permalink();
            echo 'class="right_scan">';
            echo the_title();
            echo '</a>';
      endwhile;
      endif;
      echo '</div>'
?>