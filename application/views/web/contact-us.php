<?php 
  $profile = $this->db->query("select * from profile");                
   $row = $profile->row();
?>



<!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Contact US</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="#">Home</a></li>
									<li><a href="#">contact us</a></li>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

        <!--Banner Wrap End-->
<!--Content Wrap Start-->
    	<div class="kf_content_wrap">
    		<div class="kf_location_wrap">
				
				    <?php   
				    echo $row->MAP_LOCATION;	
				    ?>
				
    		</div>
    		<section>
    			<div class="container">
    				<div class="row">
    					<div class="contct_wrap">
    						<form id="contact_form">
		    					<div class="col-md-12">
		    						
		    						<div class="row">
		    							<div class="col-md-6">
		    								<div class="contact_des">
		    									<div class="inputs_des">
		    										<span> Select Course </span>
		    										<select class="form-control get_year_web" name="course_id" required="">
                                					    <?php
                                					    $get_course=$this->db->get('courses')->result();
                                					    foreach($get_course as $row){
                                					        
                                					        echo'<option value="'.$row->id.'">'.$row->course_name.'</option>';
                                					    }
                                					    ?>
                                					</select>
		    										
		    										
		    									</div>

		    									<div class="inputs_des">
		    										<span> D.O.B </span>
		    										<input type="date" class="form-control" name="dob" placeholder="Enter B.O.B .">
		    									</div>

		    									<div class="inputs_des">
		    										<span><i class="fa fa-file-text-o"></i> Enrollment No</span>
		    										<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No.">
		    									</div>
		    									<button name="status" value="admit_card">Submit</button>
		    								</div>
		    							</div>
		    							<div class="col-md-6">
		    								<div class="inputs_des">
		    									
		    								</div>
		    							</div>
		    						</div>
		    					</div>
		    					
		    				</form>
	    				</div>
    				</div>
    			</div>
    		</section>
    	</div>



    	
    	
    	