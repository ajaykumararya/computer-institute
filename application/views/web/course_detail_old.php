<?php
    $blog = $this->db->query(' select * from our_services where id  = "'.$this->uri->segment(2).'" and status=1')->row();
    // die(var_dump(' select * from our_services where id  = "'.$this->uri->segment(2).'" and status=1'));
?>    
<section class="inner-header divider parallax layer-overlay overlay-white-5" data-bg-img="<?php echo base_url('uploads/'.$blogs[0]->BLOG_IMAGE); ?>">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-center">BLOG</h2>
              <ol class="breadcrumb text-center text-white mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active text-silver-gray">BLOG</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
   
            <!-- End banner Area -->  
<div class="row">
<div class="col-md-8">
<section class="bg-silver-light">
      <div class="container">
        <!--<div class="section-title text-center">-->
        <!--  <div class="row">-->
        <!--    <div class="col-md-8 col-md-offset-2">-->
        <!--      <h2 class=" mt-0 line-height-1">Blogs  <span class="text-theme-colored2"></span> <i class="fa fa-calendar mb-10"></i></h2>-->
              
              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p> -->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
        <div class="section-content">
          <div class="row">
             
            <div class="col-sm-8 col-md-8 wow " >
              <div class="service-box">
                <div class="thumb">
                  <img class="" src="<?php echo base_url('uploads/').$blog->image ?>" style="width:750px; height:400px" alt="">
                </div>
                <div class="details"><br><br>
                  <h3 class="mb-15"><?php echo $blog->title ?></h3>
                  <p><?php echo $blog->description; ?></p>
                  <!--<a href="#" class="btn btn-theme-colored2"><?php echo $blog->BLOG_CATEGORY?></a>-->
                </div>
              </div>
            </div>
            
        
          </div>
        </div>
      </div>
    </section>
 </div>
    <div class="col-md-4">
        
<?php
 $blogs=$this->db->query('select * from our_services where status =  1 and id !="'.$this->uri->segment(2).'"');
$blog = $blogs->result();
$blog_num = $blogs->num_rows();
?>


<!-- courses section -->
    <div >
        <div class="container">
            <div class="">
                <!--<h3 class="title-main"> <?php echo  get_title_name('gallery_list')->BACK_END_TITLE; ?> </h3>-->
            </div>
            
            <?php
					       
		        foreach($blog as $row){
					  $date=$row->timestamp;
                $convert_date = strtotime($date);
                $month = date('F',$convert_date);
                $day = date('d',$convert_date);
                $date = date('d-F-Y',$convert_date);

	        ?>
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="blog-card-single">
                        <div class="grids5-info">
                            <img src="<?php echo base_url('uploads/').$row->image; ?>" alt="" class="img-fluid" />
                            
                        </div>
                        <div class="">
                            
                            <h4><a href="<?php echo base_url('blog-detail/').$row->id;?>"><?php echo $row->title; ?></a></h4>
                            <div class="top-content-border ">
                                <ul class="rating-list">
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                    <li><a href="#rate"><i class="fa fa-star" aria-hidden="true"></i>
                                        </a></li>
                                </ul>
                                <a class="btn btn-style btn-style-primary" href="<?php echo base_url('course-detail/').$row->id;?>">Know Details<i
                                        class="fa fa-arrow-right ml-2" aria-hidden="true"></i></a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                
                </div>
                <br>
            <?php } ?>
            
            
        </div>
    </div>




  
  
    <!-- <section class="w3l-homeblock1">-->
    <!--    <div class="w3-services-ab">-->
    <!--        <div class="container">-->
    <!--            <div class="w3-services-grids pb-sm-5 mb-sm-4">-->
    <!--                <div class="row w3-services-right-grid">-->
                        <!--<div class="col-xl-4">-->

                        <!--</div>-->
    <!--                    <div class="col-xl-8">-->
    <!--                        <div class="fea-gd-vv row">-->
                        <?php 
    // <!--                $num=2;-->
    // <!--                 $form_key2 = $this->db->get_where('blogs', array('PAGE_NAME' => $num));-->
    // <!--                 foreach ($form_key2->result() as $row2) {-->
               ?>
                                
    <!--                            <div class="col-md-6">-->
    <!--                                <div class=" align-items-center feature-gd ">-->
    <!--                                    <div class="icon">-->
                                            <!--<i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>-->
    <!--                                    <img style="height:150px;border-radius:100px;" src="<?php echo base_url('uploads/').$row2->BLOG_IMAGE; ?>" alt="" class="img-fluid" />-->
    <!--                                    </div>-->
    <!--                                    <div class="icon-info">-->
    <!--                                        <h5> <?php echo @$row2->BLOG_TITLE; ?> </h5>-->
    <!--                                        <p> <?php echo @$row2->BLOG_DESC; ?> </p>-->

    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
                                
                            <?php
    // <!--                         }
                        ?>
                                
                                
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
            </div>
    </div>

