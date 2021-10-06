<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking = get_field('raking', $id_scan);

      $my_query_left = new WP_Query(array(
            'post_type' => 'scan',
            'category_name' => $category_scan[0]->name,
            'posts_per_page' => 3,
            'meta_key' => 'raking',
            'meta_value' => array($raking - 1, $raking + 1),
            'meta_type' => 'numeric',
            'meta_compare' => 'BETWEEN',
      ))
?>