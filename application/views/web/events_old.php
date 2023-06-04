<section class="inner-header divider parallax layer-overlay overlay-white-5" data-bg-img="<?php echo base_url('uploads/'.$blogs[0]->BLOG_IMAGE); ?>">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-center">EVENTS</h2>
              <ol class="breadcrumb text-center text-white mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active text-silver-gray">EVENTS</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
   
            <!-- End banner Area -->  


<section class="bg-silver-light">
      <div class="container">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class=" mt-0 line-height-1">Upcoming  <span class="text-theme-colored2">Events</span> <i class="fa fa-calendar mb-10"></i></h2>
              
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p> -->
            </div>
          </div>
        </div>
        <div class="section-content text-center">
          <div class="row">
             <?php
                           
                           foreach ($blogs as $blog_list) { 
                        echo'
            <div class="col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.3s;">
              <div class="service-box">
                <div class="thumb">
                  <img class="" src="'.base_url('uploads/'.$blog_list->BLOG_IMAGE.'').'" alt="">
                </div>
                <div class="details"><br><br>
                  <h3 class="mb-15">'.$blog_list->BLOG_TITLE.'</h3>
                  <p>'.$blog_list->BLOG_DESC.'</p>
                  <a href="#" class="btn btn-theme-colored2">'.$blog_list->BLOG_CATEGORY.'</a>
                </div>
              </div>
            </div>';
            }
          ?>
          </div>
        </div>
      </div>
    </section>

