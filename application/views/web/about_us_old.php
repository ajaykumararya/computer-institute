<?php
$profile=$this->db->get('profile')->row();
?>
<?php
         $welcome_massage = $this->db->query("select * from whyus");                
          $row = $welcome_massage->row();

  ?>


<section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="<?php echo base_url('webpages/') ?>images/bg/bg6.jpg" style="background-image: url(&quot;images/bg/bg6.jpg&quot;); background-position: 50% 59px;">
      <div class="container pt-90 pb-50">
        <!-- Section Content -->
        <div class="section-content pt-100">
          <div class="row"> 
            <div class="col-md-12">
              <h3 class="title text-theme-colored">ABOUT US</h3>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: About -->
    <section class="bg-silver-light">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-6">

              <!-- <h2 class="text-uppercase font-weight-600 mt-0 font-28 line-bottom"><?php echo $row->WHYUS_TITLE; ?></h2> -->
              <h2 class="text-theme-colored font-weight-600 mt-0 font-28 text-uppercase"><?php echo $row->WHYUS_TITLE; ?></h2>
              <p><?php echo $row->WHYUS_DESC; ?></p>
              <a class="btn btn-theme-colored btn-flat btn-lg mt-10 mb-sm-30" href="#">Read More →</a>
            </div>
            <div class="col-md-6">
              <div class="owl-carousel-1col" data-nav="true">
             

                <div class="item">
                  <img style="height: 250px;" src="<?php echo base_url('uploads/').$row->WHYUS_IMAGE ?>" alt="">
                </div>
               

                <!-- <div class="item">
                  <img src="images/about/6.jpg" alt="">
                </div>
                <div class="item">
                  <img src="images/about/7.jpg" alt="">
                </div>
 -->              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: About  -->
    <section id="about">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8">
              <h3 class="line-bottom border-bottom mt-0">Upcoming Events</h3>
              <marquee behavior="alternate" direction="up" height=300 >          
              <?php 

                   

                    $nums=2;

                    $form_key = $this->db->get_where('blogs', array('PAGE_NAME' => $nums));

                    foreach ($form_key->result() as $row) {

          

              ?>
          

              <div class="event media sm-maxwidth400 border-bottom mt-5 mb-0 pt-10 pb-15">

                <div class="row">

                 <!--  <div class="col-xs-2 col-md-3 pr-0">

                    <div class="event-date text-center bg-theme-colored border-1px p-0 pt-10 pb-10 sm-custom-style">

                      <ul>

                        <li class="font-28 text-white font-weight-700">28</li>

                        <li class="font-18 text-white text-center text-uppercase">Feb</li>

                      </ul>

                    </div>

                  </div>
 -->
                  <div class="col-xs-12 pr-10 pl-10">

                    <div class="event-content mt-10 p-5 pb-0 pt-0">

                      <h5 class="media-heading font-16 font-weight-600"><a href="#">Event: <?php echo @$row->BLOG_TITLE; ?></a></h5>

                      <ul class="list-inline font-weight-600 text-gray-dimgray">

                        <li><?php echo @$row->BLOG_DESC; ?></li>

                      </ul>

                    </div>

                  </div>

                </div>

              </div>

              <?php } ?>
              </marquee>
              
            </div>
            
            <div class="col-xs-12 col-sm-6 col-md-4">
              <h3 class="text-uppercase line-bottom mt-sm-30 mt-0">Team <span class="text-theme-colored"> Members</span></h3>
              <marquee behavior="alternate" scrollamount="2" direction="up" height=300 >          
              <?php
              $member = $this->db->get('member_list')->result();
              foreach($member as $mem){
              ?>
              <div class="icon-box icon-box-effect mb-20 p-15 bg-light border-bottom-theme-color-3px">
                <a href="#" class="icon mb-0 mr-0 pull-left flip">
                  <img src="<?php echo base_url('uploads/'.@$mem->MEMBER_PHOTO.'');  ?>">
                </a>
                <div class="ml-80">
                  <h5 class="icon-box-title mt-15 mb-5"><strong><?php echo $mem->MEMBER_NAME; ?></strong></h5>
                  <p class="text-gray">.<?php echo $mem->MEMBER_ABOUT_US;  ?></p>
                </div>
              </div>
              <?php
              }
              ?>
              
            </marquee> 
            </div>
          </div>
        </div>
      </div>
    </section>

   
    
   

  </div>
  <!-- end main-content -->















