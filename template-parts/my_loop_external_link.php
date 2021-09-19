<?php
      $data = get_field('external_link');
      if( $data ) {
            echo '<section>';
            echo '<h3>External & Streaming links</h3>';
            foreach( $data as $value){
                  echo '<div class="link">';
                  echo '<a href='. $value['link'] .'><div>'. $value['text'] .'</div></a>';
                  echo '</div>';
            }
            echo '</section>';
      }
?>