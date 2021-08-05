<div>
      <!-- reference : https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/ -->
      <form method="post" class="h-auto">
            <button class="flex flex-row items-center px-4 py-2 space-x-2 " name="buttonThanks" style=''>
                  <span style="color: #fff">
                        <?php
                              $value = (int) get_field('thank', false, false);
                              if(isset($_POST['buttonThanks'])) {
                                    if(!$value) {
                                          $value = 0;
                                    }
                                    if($_COOKIE['like'] == 0){
                                          $value++;
                                          setcookie('like', '1', time() + 365*24*3600, null, null, false, true);
                                    } else {
                                          $value--;
                                          setcookie('like', '0', time() + 365*24*3600, null, null, false, true);
                                    }
                                    update_field('thank', $value);
                              }
                              echo $value;
                        ?>
                  </span>
                  <div class="flex">
                        <svg version="1.1" style="width: 14px; fill: #FFF; margin-right: 5px;" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" xml:space="preserve"><path d="M24.85,10.126c2.018-4.783,6.628-8.125,11.99-8.125c7.223,0,12.425,6.179,13.079,13.543 c0,0,0.353,1.828-0.424,5.119c-1.058,4.482-3.545,8.464-6.898,11.503L24.85,48L7.402,32.165c-3.353-3.038-5.84-7.021-6.898-11.503 c-0.777-3.291-0.424-5.119-0.424-5.119C0.734,8.179,5.936,2,13.159,2C18.522,2,22.832,5.343,24.85,10.126z"></path></svg>
                  </div>
                  <span style="color: #fff">
                        Thanks!
                  </span>
            </button>
      </form>
</div>