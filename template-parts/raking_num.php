<?php
      $id_scan = get_the_ID();

      $raking_scan = get_field('raking', $id_scan);

      if($raking_scan){
            echo '<span class="flex flex-row items-center space-x-0 raking_scan">';
            echo '<h6>#<h6><h5>';
            if($raking_scan >= 1000 ) {
                  echo $raking_scan + 1;
            } else if($raking_scan >= 100 && $raking_scan < 1000) {
                  echo '0' .( $raking_scan + 1);
            } else if($raking_scan >= 10 && $raking_scna < 100) {
                  echo '00' .( $raking_scan + 1);
            } else if($raking_scan < 10){
                  echo '000' .( $raking_scan + 1);
            }
            echo '</h5>';
            echo '</span>';
      }
?>
<style>
      .raking_scan h5, .raking_scan h6{
            color: #FFFFFF !important;
      }
</style>