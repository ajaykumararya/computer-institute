<style>
    


.kf_inr_banner {
    display: block;
   /* padding: 60px
    min-height: 290px; */
    background: url(<?php echo base_url(); ?>background-mage/inner-banner-bg.jpg) no-repeat center top / cover;
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
								<h3>Courses Details</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Courses Details</a></li>
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
    	
    		    <?php 
    		        $course = $this->db->query(' select *,courses.id as id,brand.id as brand_id from courses left join brand on brand.id=courses.category where brand.id  = "'.$this->uri->segment(2).'"')->result();
    		       
    		    ?>
    		    
    		    <!--ABOUT UNIVERSITY START-->
    		<section>
    		    <?php
    		         $course_detail =    $this->db->query("SELECT * FROM `brand` WHERE `id` = '".@$this->uri->segment(2)."' ")->row();
    		    
					  
					    $image = '<img src="'.base_url('uploads/').@$course_detail->brand_image.'" alt=""/>';  
					 
					?>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="abt_univ_wrap">
								<!-- HEADING 1 START-->
								<div class="kf_edu2_heading1">
									<!--<h5>About Us</h5>-->
									<h3><?php  echo @$course_detail->brand_name;  ?></h3>
								</div>
								<!-- HEADING 1 END-->

								<div class="abt_univ_des">

									 <?php  echo @$course_detail->description;  ?>

								</div>
    						</div>
    					</div>

    					<div class="col-md-6">
    						<div class="abt_univ_thumb">
    							
    								<?php echo @$image ?>
    							
    						</div>
    					</div>

    				</div>
    			</div>
    		</section>
    		<!--ABOUT UNIVERSITY END-->
    		
    		
    		<section>    
    			<div class="container">
	 				<div class="row">
	 					<div class="col-md-12">

	 						<!-- COURSES DETAIL WRAP START -->
	 						<div class="kf_courses_detail_wrap">
	 							
	 							<!-- COURSES DETAIL TABS WRAP START -->
	 							<div class="kf_courses_tabs">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" role="tablist">
									<!-- Tab panes -->
									<div class="tab-content">

										<div role="tabpanel" class="tab-pane active" id="coursedetails">

											<!-- COURSES DETAIL DES START -->
											<div class="kf_courses_detail_des">
												<!--<div class="course_heading">-->
												<!--	<h3>Course Details</h3>-->
												<!--</div>-->
											 <!--   <p>-->
											 <!--   <?php //echo @$course->description?>-->
											    
											 <!--   </p>											-->
											</div>
											<!-- COURSES DETAIL DES END -->

											<!-- STUDY TABLE WRAP START -->
											<div class="study_table_wrap" style="overflow-x: scroll;">
												<h6>Study Options</h6>
												<!--  TABLE  START -->
												<table class="table table-bordered">
													<thead>
														<tr>
															<th>Course Name</th>
															<th>COURSE CODE</th>
															<th>MIN. QUAL.</th>
															<th>DURATION</th>
														</tr>
													</thead>
													<tbody>
													    <?php
													    foreach($course as $course_list){
													         $type=$course_list->type;
                                            		        if($type==1){
                                            		            $duration=$course_list->duration.'months';
                                            		        }else{
                                            		            $duration=$course_list->years.'years';
                                            		        }
													    
													      echo '
													            <tr>
        															<td style="color:black;font-weight: 600;">'.@$course_list->course_name.'</td>
        															<td style="font-weight: 400;color: black;">'.@$course_list->course_code.'</td>
        															<td style="font-weight: 400;color: black;">'.@$course_list->MIN_QUALIFICATION.'</td>
        															<td style="font-weight: 400;color: black;">'.@$duration.' </td>
        														</tr>
        													      ';  
													        
													    }
													    
													    ?>
													    
														
													</tbody>
												</table>
											</div>
											
										</div>

										
									</div>
	 							</div>
	 							
	 						</div>
	 						<!-- COURSES DETAIL WRAP END -->
	 					</div>
	 				</div>
	 			</div>
	 		</section>
    	</div>