
        <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>about us</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">about us</a></li>
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
    				
    		<!--ABOUT UNIVERSITY START-->
    		<section>
    		    <?php
					    $welcome=$this->db->get('whyus')->row();
					    $image=base_url('uploads/').$welcome->WHYUS_IMAGE;
					?>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="abt_univ_wrap">
								<!-- HEADING 1 START-->
								<div class="kf_edu2_heading1">
									<h5>About Us</h5>
									<h3><?php echo $welcome->WHYUS_TITLE;  ?></h3>
								</div>
								<!-- HEADING 1 END-->

								<div class="abt_univ_des">

									 <?php echo $welcome->WHYUS_DESC;  ?>

								</div>
    						</div>
    					</div>

    					<div class="col-md-6">
    						<div class="abt_univ_thumb">
    							<figure>
    								<img src="<?php echo $image;?>" alt=""/>
    							</figure>
    						</div>
    					</div>

    				</div>
    			</div>
    		</section>
    		<!--ABOUT UNIVERSITY END-->

    		<!--COUNTER SECTION START-->
                
			<section class="edu2_counter_wrap">
				<div class="container">
					<!--EDU2 COUNTER DES START-->
				<?php
                    $counter =  $this->db->get('add_counter_message')->result();
                     foreach($counter as $counter_list){
                ?>
					<div class="edu2_counter_des">
						<span><i class="icon-group2"></i></span>
						<h3 class="counter"><?php echo $counter_list->COUNTER_NUMBER; ?></h3>
						<h5><?php echo $counter_list->COUNTER_TEXT; ?></h5>
					</div>
				<?php
				    }
				?>  
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class="icon-book236"></i></span>-->
					<!--	<h3 class="counter">11,223</h3>-->
					<!--	<h5>CLASSES COMPLETE</h5>-->
					<!--</div>-->
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class="icon-win5"></i></span>-->
					<!--	<h3 class="counter">282,673</h3>-->
					<!--	<h5>STUDENTS ENROLLED</h5>-->
					<!--</div>-->
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class="icon-user255"></i></span>-->
					<!--	<h3 class="counter">370</h3>-->
					<!--	<h5>CERTIFIED TEACHERS</h5>-->
					<!--</div>-->
					<!--EDU2 COUNTER DES END-->
				</div>
			</section>
			
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class=" fa <?php echo $counter_list->COUNTER_ICON_CODE; ?>"></i></span>-->
					<!--	<h3 class="counter"><?php echo $counter_list->COUNTER_NUMBER; ?></h3>-->
					<!--	<h5><?php echo $counter_list->COUNTER_TEXT; ?></h5>-->
					<!--</div>-->
				
			<!--COUNTER SECTION END-->

			<!--KF INTRO WRAP START-->
			<section class="abut-padiing">
				<div class="kf_intro_des_wrap aboutus_page">
					<div class="container">
						<div class="row">
							<!-- HEADING 2 START-->
							<div class="col-md-12">
								<div class="kf_edu2_heading2">
									<h3>our courses</h3>
								</div>
							</div>
							<!-- HEADING 2 END-->
                        <?php 
                                             $query=$this->db->get('our_services');
                                             $count_service = $query->num_rows();
                
                                             foreach($query->result() as $row){
                        ?>
							<div class="col-md-3 col-sm-6">
								<!-- INTERO DES START-->
								<div class="kf_intro_des">
									<div class="kf_intro_des_caption">
										<span><i class=" icon-earth132 "></i></span>
										<h6><?php echo $row->title; ?></h6>
										<p><?php echo $row->description; ?></p>
										<!--<a href="#">view more</a>-->
									</div>
								</div>
								<!-- INTERO DES END-->
							</div>
						<?php
						    }
						?>

							<!--<div class="col-md-3 col-sm-6">-->
								<!-- INTERO DES START-->
							<!--	<div class="kf_intro_des">-->
							<!--		<div class="kf_intro_des_caption">-->
							<!--			<span><i class=" icon-educational18"></i></span>-->
							<!--			<h6>Learn Courses Online</h6>-->
							<!--			<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris itae erat.</p>-->
							<!--			<a href="#">view more</a>-->
							<!--		</div>-->
							<!--	</div>-->
								<!-- INTERO DES END-->
							<!--</div>-->

							<!--<div class="col-md-3 col-sm-6">-->
								<!-- INTERO DES START-->
							<!--	<div class="kf_intro_des">-->
							<!--		<div class="kf_intro_des_caption">-->
							<!--			<span><i class="icon-teacher4"></i></span>-->
							<!--			<h6>Become a Instructor</h6>-->
							<!--			<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris itae erat.</p>-->
							<!--			<a href="#">view more</a>-->
							<!--		</div>-->
							<!--	</div>-->
								<!-- INTERO DES END-->
							<!--</div>-->

							<!--<div class="col-md-3 col-sm-6">-->
								<!-- INTERO DES START-->
							<!--	<div class="kf_intro_des">-->
							<!--		<div class="kf_intro_des_caption">-->
							<!--			<span><i class="fa fa-globe"></i></span>-->
							<!--			<h6>Social Media Management</h6>-->
							<!--			<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris itae erat.</p>-->
							<!--			<a href="#">view more</a>-->
							<!--		</div>-->
							<!--	</div>-->
								<!-- INTERO DES END-->
							<!--</div>-->
						</div>
					</div>
				</div>
			</section>
			<!--KF INTRO WRAP END-->

			<!--KF EDUCATION STUDENT SLIDER WRAP START-->
			<section class="edu_student_wrap_bg">
				<div class="container">
					<div class="student_slider_wrap">
						<div class="row">
							<div class="col-md-6">
								<ul class="bxslider">
								<?php
							              $feedback=$this->db->get_where('feedback',['FB_STATUS'=>1])->result();
							             foreach($feedback as $row){
							    
						       	?>
									<li>
										<!-- STUDENT SLIDER DES START-->
										<div class="student_slider_des">
											<!-- HEADING 1 START-->
											<div class="kf_edu2_heading1">
												<h3>What Our Students Says</h3>
											</div>
											<!-- HEADING 1 END-->
											<p><?php echo $row->FB_COMMENT?></p>
											<div class="std_name_des">
												<a href="#"><?php echo $row->FB_PER_NAME    ?></a>
												<small><?php echo $row->FB_TITLE    ?></small>
											</div>
										</div>
										<!-- STUDENT SLIDER DES END-->
									</li>
							    <?php
							     }
							    ?>

									<!--<li>-->
										<!-- STUDENT SLIDER DES START-->
									<!--	<div class="student_slider_des">-->
											<!-- HEADING 1 START-->
									<!--		<div class="kf_edu2_heading1">-->
									<!--			<h3>Waht Our Students Says</h3>-->
									<!--		</div>-->
											<!-- HEADING 1 END-->
									<!--		<p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>-->
									<!--		<div class="std_name_des">-->
									<!--			<a href="#">Roslin Miriyam</a>-->
									<!--			<small>Regular Student</small>-->
									<!--		</div>-->
									<!--	</div>-->
										<!-- STUDENT SLIDER DES END-->
									<!--</li>-->

									<!--<li>-->
										<!-- STUDENT SLIDER DES START-->
									<!--	<div class="student_slider_des">-->
											<!-- HEADING 1 START-->
									<!--		<div class="kf_edu2_heading1">-->
									<!--			<h3>Waht Our Students Says</h3>-->
									<!--		</div>-->
											<!-- HEADING 1 END-->
									<!--		<p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>-->
									<!--		<div class="std_name_des">-->
									<!--			<a href="#">Roslin Miriyam</a>-->
									<!--			<small>Regular Student</small>-->
									<!--		</div>-->
									<!--	</div>-->
										<!-- STUDENT SLIDER DES END-->
									<!--</li>-->

									<!--<li>-->
										<!-- STUDENT SLIDER DES START-->
									<!--	<div class="student_slider_des">-->
											<!-- HEADING 1 START-->
									<!--		<div class="kf_edu2_heading1">-->
									<!--			<h3>Waht Our Students Says</h3>-->
									<!--		</div>-->
											<!-- HEADING 1 END-->
									<!--		<p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>-->
									<!--		<div class="std_name_des">-->
									<!--			<a href="#">Roslin Miriyam</a>-->
									<!--			<small>Regular Student</small>-->
									<!--		</div>-->
									<!--	</div>-->
										<!-- STUDENT SLIDER DES END-->
									<!--</li>-->
								</ul>
							</div>

							<div class="col-md-6">
								<!-- STUDENT SLIDER THUMB DES START-->
								<div class="student_slider_thumb">
									<div class="row">
										<div id="bx-pager">
										<?php
							              $feedback=$this->db->get_where('feedback',['FB_STATUS'=>1])->result();
							             foreach($feedback as $row){
							    
						                	?>
											<div class="col-md-3 col-sm-2">
												<a data-slide-index="0" href="#"><img src="<?php echo base_url('uploads/').$row->FB_PERSON_IMAGE;?>" alt="#" /></a>
											</div>
										<?php
							             }
							            ?>

											<!--<div class="col-md-6 col-sm-3">-->
											<!--	<a data-slide-index="1" href="#"><img src="extra-images/student-2.jpg" alt="#" /></a>-->
											<!--</div>-->

											<!--<div class="col-md-6 col-sm-3">-->
											<!--	<a data-slide-index="2" href="#"><img src="extra-images/student-3.jpg" alt="#" /></a>-->
											<!--</div>-->
											<!--<div class="col-md-6 col-sm-3">-->
											<!--	<a data-slide-index="3" href="#"><img src="extra-images/student-4.jpg" alt="#" /></a>-->
											<!--</div>-->
										</div>
									</div>
								</div>
								<!-- STUDENT SLIDER THUMB DES END-->
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--KF EDUCATION STUDENT SLIDER WRAP END-->

			<!-- FACULTY WRAP START-->
			<section>
				<div class="container">
					<div class="row">
						<!-- HEADING 1 START-->
						<div class="col-md-12">
							<div class="kf_edu2_heading1">
								<h3>Faculty member</h3>
							</div>
						</div>
						<!-- HEADING 1 END-->

						<!-- FACULTY SLIDER WRAP START-->
						<div class="edu2_faculty_wrap">
							<div id="owl-demo-8" class="owl-carousel owl-theme">
							  <?php 
                                 $member=$this->db->get_where('member_list',['MEMBER_STATUS'=>1])->result();
                                 foreach($member as $row){
                             ?>
								<div class="item">
									 <!--FACULTY DES START-->
									<div class="edu2_faculty_des">
										<figure><img src="<?php echo base_url('uploads/').$row->MEMBER_PHOTO?>" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2">
											<h6><a href="#"><?php echo $row->MEMBER_NAME?></a></h6>
											<strong><?php echo $row->MEMBER_POST?></strong>
											<p><?php echo $row->MEMBER_ABOUT_US?></p>
										</div>
									</div>
									 <!--FACULTY DES END-->
								</div>
                            <?php
                                 }
                            ?>
								<!--<div class="item">-->
									<!-- FACULTY DES START-->
								<!--	<div class="edu2_faculty_des">-->
								<!--		<figure><img src="extra-images/faculty-mb2.jpg" alt=""/>-->
								<!--			<figcaption>-->
								<!--				<a href="#"><i class="fa fa-facebook"></i></a>-->
								<!--				<a href="#"><i class="fa fa-twitter"></i></a>-->
								<!--				<a href="#"><i class="fa fa-linkedin"></i></a>-->
								<!--				<a href="#"><i class="fa fa-google-plus"></i></a>-->
								<!--			</figcaption>-->
								<!--		</figure>-->
								<!--		<div class="edu2_faculty_des2">-->
								<!--			<h6><a href="#">Simon Grishaber</a></h6>-->
								<!--			<strong>Health Teacher</strong>-->
								<!--			<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>-->
								<!--		</div>-->
								<!--	</div>-->
									<!-- FACULTY DES END-->
								<!--</div>-->

								<!--<div class="item">-->
									<!-- FACULTY DES START-->
								<!--	<div class="edu2_faculty_des">-->
								<!--		<figure><img src="extra-images/faculty-mb3.jpg" alt=""/>-->
								<!--			<figcaption>-->
								<!--				<a href="#"><i class="fa fa-facebook"></i></a>-->
								<!--				<a href="#"><i class="fa fa-twitter"></i></a>-->
								<!--				<a href="#"><i class="fa fa-linkedin"></i></a>-->
								<!--				<a href="#"><i class="fa fa-google-plus"></i></a>-->
								<!--			</figcaption>-->
								<!--		</figure>-->
								<!--		<div class="edu2_faculty_des2">-->
								<!--			<h6><a href="#">Simon Grishaber</a></h6>-->
								<!--			<strong>Health Teacher</strong>-->
								<!--			<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>-->
								<!--		</div>-->
								<!--	</div>-->
									<!-- FACULTY DES END-->
								<!--</div>-->

								<!--<div class="item">-->
									<!-- FACULTY DES START-->
								<!--	<div class="edu2_faculty_des">-->
								<!--		<figure><img src="extra-images/faculty-mb4.jpg" alt=""/>-->
								<!--			<figcaption>-->
								<!--				<a href="#"><i class="fa fa-facebook"></i></a>-->
								<!--				<a href="#"><i class="fa fa-twitter"></i></a>-->
								<!--				<a href="#"><i class="fa fa-linkedin"></i></a>-->
								<!--				<a href="#"><i class="fa fa-google-plus"></i></a>-->
								<!--			</figcaption>-->
								<!--		</figure>-->
								<!--		<div class="edu2_faculty_des2">-->
								<!--			<h6><a href="#">Simon Grishaber</a></h6>-->
								<!--			<strong>Health Teacher</strong>-->
								<!--			<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>-->
								<!--		</div>-->
								<!--	</div>-->
									<!-- FACULTY DES END-->
								<!--</div>-->

								<!--<div class="item">-->
									<!-- FACULTY DES START-->
								<!--	<div class="edu2_faculty_des">-->
								<!--		<figure><img src="extra-images/faculty-mb1.jpg" alt=""/>-->
								<!--			<figcaption>-->
								<!--				<a href="#"><i class="fa fa-facebook"></i></a>-->
								<!--				<a href="#"><i class="fa fa-twitter"></i></a>-->
								<!--				<a href="#"><i class="fa fa-linkedin"></i></a>-->
								<!--				<a href="#"><i class="fa fa-google-plus"></i></a>-->
								<!--			</figcaption>-->
								<!--		</figure>-->
								<!--		<div class="edu2_faculty_des2">-->
								<!--			<h6><a href="#">Simon Grishaber</a></h6>-->
								<!--			<strong>Health Teacher</strong>-->
								<!--			<p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh...</p>-->
								<!--		</div>-->
								<!--	</div>-->
									<!-- FACULTY DES END-->
								<!--</div>-->
							</div>
						</div>
						<!-- FACULTY SLIDER WRAP END-->
					</div>
				</div>
			</section>
			<!-- FACULTY WRAP START-->
    	</div>
        <!--Content Wrap End-->