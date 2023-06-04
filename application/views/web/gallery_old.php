<?php
$blogs=$this->db->get_where('blogs',array('PAGE_NAME'=> 3,'BLOG_STATUS'=>1));
                $blog = $blogs->result();
                
                
?>                

<section class="inner-header divider parallax layer-overlay overlay-white-5" data-bg-img="<?php echo base_url('uploads/'.$blog[0]->BLOG_IMAGE.''); ?>">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-center">Gallery</h2>
              <ol class="breadcrumb text-center text-white mt-10">
                <li><a href="#">Home</a></li>
                
                <li class="active text-silver-gray">Galllery</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 

 <!--start gallary Section-->
    <section class="">
      <div class="container">
        <div class="section-title text-center mt-0">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h2 class="mt-0 line-height-1">Our <span class="text-theme-colored2">Gallery</span></h2>
            
             
            </div>
          </div>
        </div>
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Portfolio Filter -->
              <div class="portfolio-filter text-center">
                
                <!--
                <a href="#" class="active" data-filter="*">All</a>
                <a href="#branding" class="" data-filter=".branding">Catagory 1</a>
                <a href="#design" class="" data-filter=".design">Catagory 2</a>
                <a href="#photography" class="" data-filter=".photography">Catagory 3</a>
             -->
              </div>
              <!-- End Portfolio Filter -->
              
              <!-- Portfolio Gallery Grid -->
              <div class="gallery-isotope default-animation-effect grid-3 gutter-small clearfix" data-lightbox="gallery">
                <!-- Portfolio Item Start -->
                
                <?php
                
                $blog_num = $blogs->num_rows();
                if($blog_num > 0){
                       
				foreach($blog as $row){
                ?>
                
                <div class="gallery-item design">
                  <div class="thumb">
                    <img class="img-fullwidth" src="<?php echo base_url('uploads/').@$row->BLOG_IMAGE; ?>" alt="project">
                    <div class="overlay-shade bg-theme-colored2"></div>
                    <div class="icons-holder">
                      <div class="icons-holder-inner">
                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                          <a href="<?php echo base_url('uploads/').@$row->BLOG_IMAGE; ?>" data-lightbox-gallery="gallery" title="Your Title Here"><i class="fa fa-picture-o"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                 <!-- Portfolio Item End -->
                
                <?php
                }
                }
                ?>
               
                
                
                <!-- Portfolio Item End -->
              </div>
              <!-- End Portfolio Gallery Grid -->
            </div>
          </div>
        </div>
      </div>
    </section>




