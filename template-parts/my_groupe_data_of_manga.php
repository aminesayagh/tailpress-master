

<?php
      $data = get_field('data_manga');
      if( $data ) {
            echo '<section class="data_manga_section">';
            foreach( $data as $key => $value) {
                  if($value !== '') {
                        echo '<div class="container_data data"'. $key .'>';
                        echo '<h4 class="title_data">'. $key .'</h4>';
                        if(is_array($value)){
                              echo '<ul class="data_repeater">';
                              foreach($value as $sub_key => $sub_value){
                                    echo '<li>';
                                    echo $sub_value;
                                    echo '</li>';
                              }
                              echo '</ul>';
                        } else if (is_string($value)){
                              echo '<h6 class="responce_data">'. $value .'</h6>';
                        }
                        echo '</div>';
                  }
            }
      }
?>
