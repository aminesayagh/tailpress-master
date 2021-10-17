<?php
      $id_scan = get_the_ID();
$content = apply_filters( 'the_content', get_the_content() );
echo $content;
?>