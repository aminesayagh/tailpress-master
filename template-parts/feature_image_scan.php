<?php

      $id_scan = get_the_ID();

      $terms = get_the_terms($id_scan, 'category');

      var_dump($terms[0]);

      $manga_relative = get_posts(array(
            'post_type' => 'manga',
            'post_title' => $terms,
      ));

      var_dump($manga_relative);



?>