 <section class="inner-header divider parallax layer-overlay overlay-white-5" data-bg-img="<?php echo base_url('webcss/'); ?>images/bg/b1.jpg">
      <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h2 class="title text-center">TEAM MEMBERS</h2>
              <ol class="breadcrumb text-center text-white mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">TEAM MEMBERS</a></li>
                
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
            <!-- End banner Area -->  

<!-- Start Align Area -->
            <div class="whole-wrap">
                <div class="container">
                    <div class="section-top-border">
                       <!--  <h3 class="mb-30">Left Aligned</h3> -->
                        <?php
                        $number=1;
                        foreach ($members_list as $member) {
                        //$number = 20;
                        if ($number % 2 == 0) {
                         echo '<div class="row">
                            <div class="col-md-3">
                               <a href="'.base_url('uploads/'.$member->MEMBER_PHOTO.'').'" class="img-pop-up"><div class="single-gallery-image" style="background: url('.base_url('uploads/'.$member->MEMBER_PHOTO.'').');"></div></a>
                            </div>
                            <div class="col-md-9 mt-sm-20 text-left">
                                <p><a style="background-color:blue;padding:5px;border-radius:5px;color:white;text-transform: uppercase;" class="text-white" href="javascript:void(0);"><b> <i class="fa fa-phone text-white"></i> MEMBER NAME:</b> '.$member->MEMBER_NAME.'</a></p>
                                <p><a style="background-color:blue;padding:5px;border-radius:5px;color:white;text-transform: uppercase;" href="https://api.whatsapp.com/send?phone='.$member->MEMBER_CONTACT.'&text=urlencodedtext"><b> <i class="fa fa-whatsapp text-white"></i> CONTACT:</b> '.$member->MEMBER_CONTACT.'</a></p>
                                <p>'.$member->MEMBER_ABOUT_US.'</p>
                            </div>
                        </div>';
                        }else{
                            echo '<div class="row">
                            
                            <div  class="col-md-9 mt-sm-20 text-right">
                                <p><a style="background-color:blue;padding:5px;border-radius:5px;color:white;text-transform: uppercase;" class="text-white"  href="javascript:void(0);"><b> <i class="fa fa-phone text-white"></i> MEMBER NAME:</b> '.$member->MEMBER_NAME.'</a></p>
                                <p><a style="background-color:blue;padding:5px;border-radius:5px;" href="https://api.whatsapp.com/send?phone='.$member->MEMBER_CONTACT.'" class="text-white"><b> <i class="fa fa-whatsapp text-white"></i> CONTACT:</b> '.$member->MEMBER_CONTACT.'</a></p>
                                <p class="justify-content-center">'.$member->MEMBER_ABOUT_US.'</p>
                            </div>
                            <div class="col-md-3">
                                <a href="'.base_url('uploads/'.$member->MEMBER_PHOTO.'').'" class="img-pop-up"><div class="single-gallery-image" style="background: url('.base_url('uploads/'.$member->MEMBER_PHOTO.'').');"></div></a>

                            </div>
                        </div>';
                        }
                        
                        $number= $number+1;
                        }
                        ?>
                        
                    </div>
                   
                    
                </div>
            </div>
            <!-- End Align Area -->            