<?php
      $id_scan = get_the_ID();

      $raking_scan = get_field('raking', $id_scan);

      if($raking_scan){
            echo '<span class="flex flex-row items-center space-x-0">';
            echo '<h6>#<h6><h5>';
            echo $raking_scan + 1;
            echo '</h5>';
            echo '</span>';
      }
?>