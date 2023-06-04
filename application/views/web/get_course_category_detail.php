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
    		<!---
    		<div class="search_bar_outer_wrap">
	    		<div class="container">
	    			<div class="inr_pg_search_wrap">
		    			<form id="search_course">
		    				<div class="search_bar_des">
		    					
		    					<input type="search" name="course_name" placeholder="Search Courses Category"/>
		    					
		    					
		    				</div>
		    				
		    			</form>
		    		</div>
			    </div>
		    </div>
		    
		    --->
		    <!--search bar end-->
	 		<section>
	 			<div class="container">

	 				<div class="row" id="more_course">
	 			<?php 
                     $query=$this->db->query('select *,courses.id as id from courses left join brand on brand.id=courses.category where category="'.$this->uri->segment(2).'" ');
                     $count_service = $query->num_rows();

                     foreach($query->result() as $row){
                ?>
	 					<div class="col-md-4 col-sm-6">

	 						<!--EDU2 COLUM 3 Wrap Start-->
	 						<div class="edu2_col_3_wrap">
	 							<figure>
	 								<img src="<?php echo base_url('uploads/').@$row->brand_image; ?>" alt=""/>
	 								<figcaption><a href="<?php echo base_url('course-detail/').$row->id;?>"></a></figcaption>
	 							</figure>

	 							<!--EDU2 COLUM 3 Des Start-->
	 							<div class="edu2_col_3_des">
	 								<h6><a href="#"><?php echo $row->course_name; ?></h6>
	 								<p><?php echo @$row->description?> </p>
	 								<div class="video_link_wrap">
	 									<a href="#"><?php echo $row->brand_name;?></a>
	 									<!--<span><sup>$</sup>27</span>-->
	 								</div>

	 								<!--EDU2 COLUM 3 Ftr Start-->
		 							<div class="edu2_col_3_ftr">
		 								<!--<figure><img src="extra-images/col_3_des1.jpg" alt=""/></figure>-->
		 								<!--<a href="#">Thomas Van</a>-->
		 								<div class="rating">
										    <a href="<?php echo base_url('course-detail/').$row->id;?> " style="background: #e0e0ed;padding: 10px;border-radius: 5px;" class="btn-3">View-Detail</a>	
										</div>
		 							</div>
		 							<!--EDU2 COLUM 3 Ftr End-->
	 							</div>
	 							<!--EDU2 COLUM 3 Des End-->


	 						</div>
	 						<!--EDU2 COLUM 3 Wrap End-->

	 					</div>
	 		    <?php
                     }
	 		    ?>

	 					<!--<div class="col-md-12">-->
	 						<!--KF_PAGINATION_WRAP START-->
							<!--<div class="kf_edu_pagination_wrap">-->
									
							<!--</div>-->
							<!--KF_PAGINATION_WRAP END-->
 						<!--</div>-->

	 				</div>
	 				<!--
	 				<div class="loadmore">
					                	<a href="javascript:void(0);" class="btn-3 " onclick="load_courses_by_category()">Load More</a>
		                </div>
	 			    --->
	 			</div>
	 		</section>
        <!--Content Wrap End-->
  
        
