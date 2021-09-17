<div>
      <p>test</p>
      <?php
            $data = get_field('data_manga');
            if($data) :
            ?>
                  <div class='container_data data_title'>
                        <h4 class='title_data'>Format</h4>
                        <h6 class='responce_data'><?php echo $data['format']?><h6>
                  </div>
                  
      <?php endif; ?>      
</div>