<?php

      $terms = get_terms( array(
            'taxonomy' => 'category',
            'hide_empty' => false,
      ) );

      var_dump($terms);

      $manga_relative = get_posts(array(
            'post_type' => 'manga',
            'post_title' => $scan_category,
      ))


?>