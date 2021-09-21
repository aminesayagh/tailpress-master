<?php

      $id_scan = get_the_ID();
      $terms = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => false,
      ) );

      var_dump($id_scan);

      $manga_relative = get_posts(array(
            'post_type' => 'manga',
            'post_title' => $scan_category,
      ))


?>