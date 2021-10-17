<?php
      $id_scan = get_the_ID();
      $post = get_post($id_scan);
$content = apply_filters( 'the_content', $post->post_content );

echo $content;
?>