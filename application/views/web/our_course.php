        <!--Banner Wrap Start-->
        <div class="kf_inr_banner padding_more">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Our Courses</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Our Courses</a></li>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                    
 					</div>
                </div>
            </div>
        </div>

        <!--Banner Wrap End-->

    	<!--Content Wrap Start-->
    	<!--search bar start-->
    	<div class="kf_content_wrap overflow_visible">
    		<div class="search_bar_outer_wrap">
	    		<div class="container">
	    			<div class="inr_pg_search_wrap">
		    			<form id="search_course">
		    				<div class="search_bar_des">
		    					<!--
		    					<input type="search" name="course_name" placeholder="Search Courses"/>
		    					-->
		    					 <select id="basic" name="category" style="height: 50px;">
		    					    <option>--select course category--</option>
		    					 <?php
	    					        $query=$this->db->query('select * from  brand  ');
                                    // $count_service = $query->num_rows();
                                    foreach($query->result() as $row){
                                ?>
                                    
                                    <option value="<?php echo $row->id;?>"><?php echo $row->brand_name;?></option>
                                 <?php
                                    }
                                ?>
                                </select>
		    					
		    				</div>
		    				<button type="submit">Search Now</button>
		    			</form>
		    		</div>
			    </div>
		    </div>
		    <!--search bar end-->
		    
		    

















<div class="kf_content_wrap bg-theme-header6-background">
			<!--COURSE OUTER WRAP START-->
			<div class="kf_course_outerwrap" >
				<div class="container">

					<div class="row">

						<div class="col-md-12">
							<div class="row">
								<!--COURSE CATEGORIES WRAP START-->
								<div class="kf_cur_catg_wrap">
									<!--COURSE CATEGORIES WRAP HEADING START-->
									<div class="col-md-12">
										<div class="kf_edu2_heading2" style="padding: 5px;border-bottom: 1px solid;">
											<h3>Course Categories</h3>
										</div>
									</div>
									<!--COURSE CATEGORIES WRAP HEADING END-->
                                <?php
                                    $b=$this->db->query('select * from brand LIMIT 6 OFFSET 0' )->result();
                                    foreach($b as $row){
                                ?>
									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-4" style="height:450px;">
										<div class="kf_cur_catg_des color-1" style="text-align: center;">
											
											<span style="height: 259px;">
											    <img src="<?php echo base_url('uploads/'.$row->brand_image.' '); ?>" >
											</span>
											
											
											
											<div class="kf_cur_catg_capstion">
												<h5><?php echo $row->brand_name;?></h5>
												<p><?php //echo $row->description;?></p>
											</div>
											<a href="<?php echo site_url('course-detail/'.$row->id.' '); ?>" style="background: navy;" class="btn-1">View-Detail</a>
										</div>
									</div>
								<?php
                                        
                                    }
                                ?>
								
                                    <div class="view-all">
                                	    <a class="btn-3 " href="<?php echo site_url(''); ?>/our-course">View All Categories</a>
                                    </div>
								</div>
								
								
								<!--COURSE CATEGORIES WRAP END-->
							</div>
						</div>

						
					</div>

				</div>
			</div>
			<!--COURSE OUTER WRAP END-->
			
			
			<!---
			
		        	<?php
					   // $welcome=$this->db->get('whyus')->row();
					   // $image=base_url('uploads/').$welcome->WHYUS_IMAGE;
					?>
			
			<section style="left: 0;
    
    top: 0;
    bottom: 0;
    background-image: url('<?php //echo $image ?>');
    background-size: cover;
    background-position: center;
    position: absolute; position: relative;
    background-color: #f8f8f8;">
			    
			   
				<div class="kf_intro_des_wrap">
					<
					<div class="col-md-9">
					
						<div class="kf_edu2_heading2">
							<h3><?php echo $welcome->WHYUS_TITLE;  ?></h3>
						</div>
					</div>
				
    				<?php 
                        // $query=$this->db->get('our_services');
                        // $count_service = $query->num_rows();
        
                        // foreach($query->result() as $row){
                    ?>
    					<div class="kf_intro_des">
    						<div class="kf_intro_des_caption">
    							<span><i class="icon-earth132"></i></span>
    							<h6><?php echo $row->title; ?></h6>
    							<p style="padding-bottom:20px"><?php // echo $row->description; ?></p>
    						
    						</div>
    						<br><br>
    					<div>
    						<figure >
    							<img src="<?php //echo base_url('uploads/').$row->image; ?>" alt=""/>
    							<figcaption><a href="#">Learn Courses Online</a></figcaption>
    						</figure>
    					</div>
    					</div>
    				<?php
                       // }
    				?>
				
				</div>
			</section>
			--->



			
