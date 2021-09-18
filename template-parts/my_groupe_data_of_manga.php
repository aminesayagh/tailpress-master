<div>
      <?php
            $data = get_field('data_manga');
            if($data) :
                  $content = "";
                  foreach($data as $key => $value){
                        if(is_array($value)){
                              if( have_rows($value)) :
                                    $content = $content . "<div class='container_data data_". $key."'><h4 class='title_data'>" . $key . "</h4><ul>";
                                    while(have_rows($value)) : the_row();
                                          $sub_value = get_sub_field('sub_field');
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