<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking_scan = get_field('raking', $id_scan);
      $link_category_scan = 'https://shinobyboy.co/manga/'. $category_scan;
      
      if( $raking_scan ){
            echo '<div class="relative selector_more_chapter">';
            
            echo '<div name="other_chapter" class="title_selector_more_chapter">';
            echo '<div class="flex">';
            echo '<h5 class="main_title">';
            echo get_the_title($id_scan);
            echo '</h5>';
            echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M225.923,354.706c-8.098,0-16.195-3.092-22.369-9.263L9.27,151.157c-12.359-12.359-12.359-32.397,0-44.751
		c12.354-12.354,32.388-12.354,44.748,0l171.905,171.915l171.906-171.909c12.359-12.354,32.391-12.354,44.744,0
		c12.365,12.354,12.365,32.392,0,44.751L248.292,345.449C242.115,351.621,234.018,354.706,225.923,354.706z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
            echo '</div>';
            echo '</div>';
            $args = array(
                  'post_type' => 'scan', 
                  'category_name' => $category_scan[0]->name, 
                  'posts_per_page' => -1, 
                  'order' => 'DESC', 
                  'orderby' => 'meta_value', 
                  'meta_key' => 'raking', 
            );
            
            $my_query = new WP_Query( $args );
            echo '<div class="absolute hidden h-0 content_selector">';
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
                  echo '<a class="link_selector_more_chapter" href=';
                  echo the_permalink();
                  echo '>';
                  echo '<h5 style="color: #fff" class="elem_selector_more_chapter">';
                  echo the_title();
                  echo '</h5>';
                  echo '</a>';
            endwhile;
            endif;
            echo '</div>';
            echo '</div>';
            
            wp_reset_postdata();
            
            
            // echo '</div>';
      }
?>
<style>
      .content_selector{
            height: 70vh !important;
            overflow-y: scroll;
            border-radius: 6px;
            top: 3rem;
            background-color: #040613eb !important;
      }
      a:nth-child(1) .elem_selector_more_chapter{
            padding: 24px 20px !important;
      }
      .elem_selector_more_chapter{
            padding: 12px 20px !important;
      }
      @media (min-width: 1200px){
            .elem_selector_more_chapter{
                  width: 50vw !important
            }
            
      }
      @media (max-width: 1200px){
            .elem_selector_more_chapter{
                  width: 75vw !important
            }
      }
</style>
<script>
      let show = false;
      let selector_element = document.querySelector('.container_selector_more_chapter');
      selector_element.addEventListener('click', function(){
            if(show){
                  document.querySelector('.selector_more_chapter .content_selector').classList.add('hidden');
                  show = false
            } else {
                  document.querySelector('.selector_more_chapter .content_selector').classList.remove('hidden');
                  show = true;
            }
      })
</script>