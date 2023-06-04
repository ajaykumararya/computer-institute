
        <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3> BORD OF ADVISORY MEMBER </h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Our teacher</a></li>
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
    		<section class="edu2_teachers_page">
    			<div class="container">
    				<div class="row" id="more_teacher">
    				        <?php 
                                 $member=$this->db->query('select * from member_list where MEMBER_STATUS=1 LIMIT 12 OFFSET 0')->result();
                                 foreach($member as $row){
                             ?>
    					<div class="col-lg-3 col-md-4 col-sm-6">
    						
							<div class="edu2_faculty_des"  style="font-size: 12px;font-weight: 900;line-height: 18px;" >
										<figure><img style="height: 190px;width: 100%;" src="<?php echo base_url('uploads/').$row->MEMBER_PHOTO?>" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2" style="margin-top:43px;height: 130px;">
											<h6><a href="#"><?php echo $row->MEMBER_NAME?></a></h6>
											<strong><?php echo $row->MEMBER_POST?></strong>
											<p><?php echo $row->MEMBER_ABOUT_US?></p>
										</div>
									</div>
							
    					</div>
    				<?php
    				    }
    				?>

    	
    					
    				</div>
    				<div class="col-md-12">
    						<div class="loadmore">
    							<a href="#" class="btn-3 load-teacher">load more</a>
    						</div>
    					</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End--><!--NEWS LETTERS START-->