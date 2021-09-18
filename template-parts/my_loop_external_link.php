<?php
      $data = get_field('external_link');
      if( $data ) {
            echo '<section>';
            foreach( $data as $value){
                  echo '<div class="link">';
                  echo '<a href='. $value['link'] .'><div>'. $value['text'] .'</div></a>';
                  echo '</div>';
            }
            echo '</section>';
      }
?>
