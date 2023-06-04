
<style>
    .cert-head:after {
        width: 100%;
        height: 1px;
        position: absolute;
        top: 10px;
        left: 0px;
        background: #d8d8d8;
        content: "";
    }
    .grey-box01 {
        background: #eaeaea;
        float: left;
        width: 100%;
        padding: 20px;
        padding-bottom: 10px;
        margin-bottom: 30px;
        -webkit-box-shadow: 2px 2px 5px 0px rgb(50 50 50 / 75%);
        -moz-box-shadow: 2px 2px 5px 0px rgba(50, 50, 50, 0.75);
        box-shadow: 2px 2px 5px 0px rgb(50 50 50 / 75%);
    }
    .grey-box01 h4 {
        background: #fff;
        color: #5a740a;
        font-size: 17px;
        padding: 10px 10px;
        margin-bottom: 20px;
        text-transform: uppercase;
        border-left: 3px solid #eb6557;
        -webkit-box-shadow: 2px 2px 5px 0px rgb(50 50 50 / 75%);
        -moz-box-shadow: 2px 2px 5px 0px rgba(50, 50, 50, 0.75);
        box-shadow: 2px 2px 5px 0px rgb(50 50 50 / 75%);
    }
    .grey-box01 p span {
        color: #133687;
        font-size: 16px;
        font-weight: bold;
    }
    .grey-box01 p {
        font-size: 15px;
        color: #666;
        border-bottom: 1px solid #e1e1e2;
      /*  padding-bottom: 10px; */
        margin-bottom: 10px;
        font-weight: 600;
    }
    .cert-head{
            padding: 10px;
    }
    
</style>



<!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3 style="padding-top: 20px;"> CONTACT US </h3></h3>
                        	</div>
                           <!--
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php //echo base_url();?>">Home</a></li>
									<li><a href="#"><?php   //echo @$row->title; ?></a></li>
								</ul>
							</div>
							-->
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>





<!--Start main-content -->
 <div class="main-content">

    <!-- Section: inner-header -->

    
    <!-- Section: Have Any Question -->
    <section class="divider" style="margin-bottom: 20px;background: beige;padding: 12px;">
      <div class="container pt-60 pb-60">
        <div class="section-title mb-60">
          <div class="row">
            <div class="col-md-12">
              <div class="esc-heading small-border text-center">
                <h3>Have any Questions?</h3>
              </div>
            </div>
          </div>
        </div>
         <?php 

                     $profile = $this->db->query("select * from profile");                

                      $row = $profile->row();
              ?>
        <div class="section-content">
          <div class="row">
            <div class="col-sm-12 col-md-4">
              <div class="contact-info text-center">
                <i class="fa fa-phone font-36 mb-10 text-theme-colored"></i>
                <h4>Call Us</h4>
                <h6 class="text-gray">Phone: <?php echo $row->ORG_PHONE; ?></h6>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="contact-info text-center">
                <i class="fa fa-map-marker font-36 mb-10 text-theme-colored"></i>
                <h4>Address</h4>
                <h6 class="text-gray"><?php echo $row->ORG_ADDRESS; ?></h6>
              </div>
            </div>
            <div class="col-sm-12 col-md-4">
              <div class="contact-info text-center">
                <i class="fa fa-envelope font-36 mb-10 text-theme-colored"></i>
                <h4>Email</h4>
                <h6 class="text-gray"><?php echo $row->ORG_EMAIL; ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    
    <section class="form-wrapper padding-lg" style="padding: 0px;">
      <div class="container" style="width: 100%;">
          <div class="cert-head grey-box01"><h3>FOUNDER AND MANAGING DIRECTOR</h3></div>
            <div class="container" style="width: 100%;">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="grey-box01">
                            <p><span>Name</span><br> <?php echo $row->OWNER_NAME; ?> </p>
                            <p><span>Email</span><br><?php echo $row->ORG_EMAIL; ?></p>
                            <p><span>Mobile</span><br>+91-<?php echo $row->ORG_PHONE; ?></p>
                            </div>
                        </div>  
                    </div>
                </div>
                
                <div class="cert-head grey-box01"><h3>DIRECTOR</h3></div>
                <div class="container" style="width: 100%;">
                    <div class="row">
                        <?php
                        $chairman = $this->db->get('chairman')->result();
                        foreach($chairman as $chairman_list){
                         ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="grey-box01">
                                    <h4><?php echo $chairman_list->CHAIRMAN_TITLE; ?> </h4>
                                    <p><span>Name</span><br> <?php echo $chairman_list->CHAIRMAN_NAME; ?>  </p>
                                    <p><span>Email</span><br><?php echo $chairman_list->CHAIRMAN_EMAIL; ?> </p>
                                    <p><span>Mobile</span><br><?php echo $chairman_list->CHAIRMAN_CONTACT; ?> </p>
                                </div>
                            </div>
                         
                         <?php
                        }    
                        ?>
                          
                    </div>
                </div>
                <div class="cert-head grey-box01"><h3>STATE OFFICE</h3></div>
                
                <div class="container" style="width: 100%;">
                    <div class="row">
                        
                        <?php  
                          $state_office =   $this->db->query("SELECT * FROM `state_office` LEFT JOIN state ON state.STATE_ID=state_office.SO_STATE_ID LEFT JOIN district ON district.DISTRICT_ID=state_office.SO_DISTRICT_ID ORDER BY state_office.SO_STATE_ID")->result();
                        foreach($state_office as $state_office_list){
                            ?>
                            
                            <div class="col-sm-6 col-md-4">
                                <div class="grey-box01">
                                    <h4> <?php echo $state_office_list->STATE_NAME; ?> </h4>
                                    <p><span>Name</span><br> <?php echo $state_office_list->SO_NAME; ?></p>
                                    <p><span>Email</span><br> <?php echo $state_office_list->SO_EMAIL;  ?> </p>
                                    <p><span>Mobile</span><br> <?php echo $state_office_list->SO_MOBILE; ?> </p>
                                    <p><span>City</span><br><?php echo $state_office_list->DISTRICT_NAME; ?></p>
                                    <p><span>Address</span><br> <?php echo $state_office_list->SO_ADDRESS; ?> </p>
                               </div>
                            </div>
                            
                            <?php
                        }
                        ?>
                        
                        
                        
                    </div>
                </div>

</section>
    
    
    
    <!-- Section Contact -->
    <section id="contact" class="divider bg-lighter" style="padding: 0px;">
      <div class="container-fluid pt-0 pb-0">
        <div class="section-content">
          <div class="row">
            <div class="col-sm-12 col-md-6" style="background: aquamarine;">
              <div class="contact-wrapper">
                <h3 class="line-bottom mt-0 mb-20" style="background: antiquewhite;padding: 10px;text-align:center;">ENQUIRY FORM </h3>
                

                <!-- Contact Form -->
                <form id="contact_form"  action="add_enquiry" method="post">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="form_name">Name <small>*</small></label>
                        <input name="name" class="form-control" type="text" placeholder="Enter Name" required="" style="border: 1px solid;">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="form_email">Email <small>*</small></label>
                        <input name="email" class="form-control required email" type="email" placeholder="Enter Email"  style="border: 1px solid;">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="form_name">Subject <small>*</small></label>
                        <input name="subject" class="form-control required" type="text" placeholder="Enter Subject"  style="border: 1px solid;">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="form_phone">Phone</label>
                        <input name="mobile" class="form-control" type="text" placeholder="Enter Phone" style="border: 1px solid;">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="form_name">Message</label>
                    <textarea name="message" class="form-control required" rows="5" placeholder="Enter Message"  style="border: 1px solid;"></textarea>
                  </div>
                  <div class="form-group">
                    <input name="form_botcheck" class="form-control" type="hidden" value="" />
                    <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-loading-text="Please wait...">Send your message</button>
                    <button type="reset" class="btn btn-default btn-flat btn-theme-colored">Reset</button>
                  </div>
                </form>
                <!-- Contact Form Validation-->
                <script type="text/javascript">
                  $("#contact_form").validate({
                    submitHandler: function(form) {
                      var form_btn = $(form).find('button[type="submit"]');
                      var form_result_div = '#form-result';
                      $(form_result_div).remove();
                      form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                      var form_btn_old_msg = form_btn.html();
                      form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                      $(form).ajaxSubmit({
                        dataType:  'json',
                        success: function(data) {
                          if( data.status == 'true' ) {
                            $(form).find('.form-control').val('');
                          }
                          form_btn.prop('disabled', false).html(form_btn_old_msg);
                          $(form_result_div).html(data.message).fadeIn('slow');
                          setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                        }
                      });
                    }
                  });
                </script>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 bg-img-center bg-img-cover p-0" data-bg-img="images/bg/bg1.jpg">

              <!-- Google Map HTML Codes -->
              <?php echo $row->MAP_LOCATION; ?>
             
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content