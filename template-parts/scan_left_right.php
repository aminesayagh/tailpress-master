<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking = get_field('raking', $id_scan);

      $args = array(
            'post_type' => 'scan',
            'category_name' => $category_scan[0]->name,
            'posts_per_page' => 3,
            'meta_query' => array(
                  'relation' => 'AND',
                  array(
                        'key' => 'raking',
                        'value' => array ( $raking - 1, $raking + 1 ),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'
                  ),
                  array(
                        'key' => 'raking',
                        'value' => $raking,
                        'type' => 'numeric',
                        'compare' => '!=',
                  )
            )
      );

      $my_query = new WP_Query($args);

      if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            echo '<a href=' . the_permalink() . '>'. the_title() .'</a>';
      endwhile;
      endif;
?>