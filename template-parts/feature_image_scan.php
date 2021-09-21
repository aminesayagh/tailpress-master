<?php

      $id_scan = get_the_ID();

      $terms = the_terms($id_scan, 'category');

      var_dump($terms);

      $manga_relative = get_posts(array(
            'post_type' => 'manga',
            'post_title' => $terms,
      ));

      

?>