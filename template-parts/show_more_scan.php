<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking_scan = get_field('raking', $id_scan);
      $link_category_scan = 'https://shinobyboy.co/manga/'. $category_scan;
      
      if( $raking_scan ){
            echo '<div class="relative selector_more_chapter">';
            
            echo '<div name="other_chapter" class="title_selector_more_chapter">';
            echo '<h5 class="main_title">' . get_the_title($id_scan) . '</h5>';
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
                  echo '<h5 style="color: #fff" class="elem_selector_more_chapter">';
                  echo '<a href=';
                  echo the_permalink();
                  echo '>';
                  echo the_title();
                  echo '</a>';
                  echo '</h5>';
            endwhile;
            endif;
            echo '</div>';
            
            echo '</div>';
            
            wp_reset_postdata();
            
            
            echo '</div>';
      }
?>
<style>
      .content_selector{
            max-heigth: 80vh;
            
      }
      .elem_selector_more_chapter{
            padding: 12px 20px !important;
            background-color: #000 !important;
            
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