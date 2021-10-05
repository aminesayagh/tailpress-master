<?php
      $id_scan = get_the_ID();

      $category_scan = get_the_category($id_scan);
      $raking_scan = get_field('raking', $id_scan);
      $link_category_scan = 'https://shinobyboy.co/manga/'. $category_scan;
      
      if( $raking_scan ){
            echo '<div class="relative selector_more_chapter">';
            
            echo '<div name="other_chapter" class="title_selector_more_chapter">';
            echo '<div class="flex flex-row items-center flex-nowrap">';
            echo '<h5 class="main_title">';
            echo get_the_title($id_scan);
            echo '</h5>';
            echo '<span class="px-4 py-2 show_more_chapter">show more...</span>';
            echo '</div>';
            echo '</div>';
            $args = array(
                  'post_type' => 'scan', 
                  'category_name' => $category_scan[0]->name, 
                  'posts_per_page' => -1, 
                  'order' => 'DESC', 
                  'orderby' => 'meta_value_num', 
                  'meta_key' => 'raking', 
            );
            
            $my_query = new WP_Query( $args );
            echo '<div class="absolute z-20 hidden h-0 content_selector">';
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
                  echo '<a class="link_selector_more_chapter" href=';
                  echo the_permalink();
                  echo '>';
                  echo '<h5 class="elem_selector_more_chapter">';
                  echo the_title();
                  echo '</h5>';
                  echo '</a>';
            endwhile;
            endif;
            echo '</div>';
            echo '<div class="fixed z-10 screen_display"></div>';
            echo '</div>';
            
            wp_reset_postdata();
            
            
            // echo '</div>';
      }
?>
<style>
      .screen_display{
            height: 100vh;
            width: 100vw;
            top:0;
            left: 0;
      }
      .content_selector{
            height: 70vh !important;
            overflow-y: auto;
            border-radius: 6px;
            top: 3rem;
            background-color: #040613eb !important;
      }
      .show_more_chapter{
            color: #9ca3af !important;
      }
      a:nth-child(1) .elem_selector_more_chapter{
            padding-top: 24px !important;
      }
      a.link_selector_more_chapter h5{
            color: #D2D2D2 !important;
      }
      a.link_selector_more_chapter:visited h5{
            color: #787979 !important;
      }
      a.link_selector_more_chapter:active h5{
            color: #BF1736 !important;
      }
      .elem_selector_more_chapter{
            padding: 12px 20px !important;
            font-size: 1.1rem !important;
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
                  document.querySelector('.selector_more_chapter .screen_display').classList.add('hidden');
                  show = false
            } else {
                  document.querySelector('.selector_more_chapter .content_selector').classList.remove('hidden');
                  document.querySelector('.selector_more_chapter .screen_display').classList.remove('hidden');
                  show = true;
            }
      })
      document.addEventListener('keyup', (event) => {
            var name = event.key;
            if((name === 'Enter' || name ==='Escape') && show){
                  document.querySelector('.selector_more_chapter .content_selector').classList.add('hidden');
                  document.querySelector('.selector_more_chapter .screen_display').classList.add('hidden');

                  show = false
            }
      })
</script>
