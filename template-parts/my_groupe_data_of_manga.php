<div>
      <?php
            $data = get_field('data_manga');
            if($data) :
                  $content = "";
                  foreach($data as $key => $value){
                        if(is_array($value)){
                              $content = $content . "<div class='container_data data_". $key."'><h4 class='title_data'>" . $key . "</h4><ul>";
                              if( have_rows($key)) :
                                    while(have_rows($key)) : the_row();
                                          $sub_value = get_sub_field('synonym');
                                          $content = $content . "<li>". $sub_value . "</li>";
                                          
                                    endwhile;
                                    $content = $content . "</ul>";
                              else: 
                              endif;
                        } else if($value != ''){
                              $content = $content . "<div class='container_data data_". $key ."'><h4 class='title_data'>". $key ."</h4><h6 class='responce_data'>" . $value ."</h6></div>";
                        }
                  }
                  echo $content;
            ?>
      <?php endif; ?>
</div>