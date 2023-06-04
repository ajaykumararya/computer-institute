<!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Events List</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Event</a></li>
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
    		<section class="our_event_page">
    			<div class="container">
    				<div class="row" id="more_events">

	    				<!-- HEADING 2 START-->
						<div class="col-md-12">
							<div class="kf_edu2_heading2">
								<h3>Latest News & Event</h3>
							</div>
						</div>
						<!-- HEADING 2 END-->
                    <?php
                    $blogs=$this->db->query('select * from blogs where PAGE_NAME = 2 and BLOG_STATUS =1 LIMIT 4 OFFSET 0');
                    $blog = $blogs->result();
                    $blog_num = $blogs->num_rows();
                    
					       
		             foreach($blog as $row){
					     $date=$row->BLOG_TT;
                         $convert_date = strtotime($date);
                         $month = date('M',$convert_date);
                        $day = date('d',$convert_date);
                        $date = date('d-F-Y',$convert_date);

	        
                    ?>
    					<!-- EDU2 NEW DES START-->
						<div class="col-md-6">
							<div class="edu2_event_wrap">
							    
								<div class="edu2_event_des">
									<h4><?php echo $month?></h4>
									<p><?php echo $row->BLOG_TITLE;?></p>
									<ul class="post-option">
											<!--<li>By<a href="#">Admin</a>03/12/2015</li>-->
											<!--<li>21<a href="#">Comments</a></li>-->
									</ul>
									<a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>
									<span><?php echo $day?></span>
								</div>
									
								<figure><img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt=""/>
									<figcaption><a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>"><i class="fa fa-plus"></i></a></figcaption>
								</figure>
							</div>
						</div>
						<!-- EDU2 NEW DES END-->

						<!-- EDU2 NEW DES START-->
						<!--<div class="col-md-6">-->
						<!--	<div class="edu2_event_wrap side_change">-->
						<!--		<div class="edu2_event_des">-->
						<!--			<h4><?php echo $month?></h4>-->
						<!--			<p><?php echo $row->BLOG_TITLE;?></p>-->
						<!--			<ul class="post-option">-->
											<!--<li>By<a href="#">Admin</a>03/12/2015</li>-->
											<!--<li>21<a href="#">Comments</a></li>-->
						<!--			</ul>-->
						<!--			<a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>-->
						<!--			<span><?php echo $day?></span>-->
						<!--		</div>-->
									
						<!--			<figure><img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt=""/>-->
						<!--			<figcaption><a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>"><i class="fa fa-plus"></i></a></figcaption>-->
						<!--		</figure>-->
						<!--	</div>-->
						<!--</div>-->
					<?php
		             }
		            ?>
				
						<!--<div class="col-md-12">-->
							<!--KF_PAGINATION_WRAP START-->
						<!--	<div class="kf_edu_pagination_wrap">-->
						<!--		<ul class="pagination">-->
						<!--			<li>-->
						<!--				<a href="#" aria-label="Previous">-->
						<!--				<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>-->
						<!--				</a>-->
						<!--			</li>-->
						<!--			<li class="active"><a href="#">1</a></li>-->
						<!--			<li><a href="#">2</a></li>-->
						<!--			<li><a href="#">3</a></li>-->
						<!--			<li><a href="#">4</a></li>-->
						<!--			<li><a href="#">5</a></li>-->
						<!--			<li>-->
						<!--				<a href="#" aria-label="Next">-->
						<!--				<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>-->
						<!--				</a>-->
						<!--			</li>-->
						<!--		</ul>-->
						<!--	</div>-->
							<!--KF_PAGINATION_WRAP END-->
						<!--</div>-->

    				</div>
    				<div class="loadmore" style="padding-top:30px;">
    							<a href="#" class="btn-3 load-events">load more</a>
    						</div>
    			</div>
    		</section>
    	</div>
        <!--Content Wrap End-->