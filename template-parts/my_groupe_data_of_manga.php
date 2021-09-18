<div>
      <?php
            $data = get_field('data_manga');
            if($data) :
                  $content = "";
                  foreach($data as $key => $value){
                        if(is_array($value)){
                              $content = $content . "<div class='container_data data_". $key."'><h4 class='title_data'>" . $key . "</h4><ul>";
                              foreach($value as $subValue){
                                    $content = $content . "<li>". $subValue . "</li>";
                              }
                        $content = $content . "</ul>";
                        }else if($value != ''){
                              $content = $content . "<div class='container_data data_". $key ."'><h4 class='title_data'>". $key ."</h4><h6 class='responce_data'>" . $value ."</h6></div>";
                        }
                  }
                  echo $content;
            ?>
      <?php endif; ?>
</div>