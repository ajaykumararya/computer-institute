

        <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>Blog </h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">Blog </a></li>
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
    				
    		<!--BLOG 3 PAGE START-->
    		<section>
    			<div class="container">
    				<div class="row" id="more_blogs">
    			<?php
                    $blogs=$this->db->query('select * from blogs where PAGE_NAME = 1 and BLOG_STATUS =1 LIMIT 12 OFFSET 0');
                    $blog = $blogs->result();
                    $blog_num = $blogs->num_rows();
                    
					       
		             foreach($blog as $row){
					     $date=$row->BLOG_TT;
                         $convert_date = strtotime($date);
                         $month = date('M',$convert_date);
                        $day = date('d',$convert_date);
                        $date = date('d-F-Y',$convert_date);

	        
                    ?>
    					<div class="col-md-4">
    						<!--BLOG 3 WRAP START-->
    						<div class="blog_3_wrap">
    							<!--BLOG 3 SIDE BAR START-->
    							<ul class="blog_3_sidebar">
    								<li>
										<a href="#">
											<?php echo $day; ?>
											<span><?php echo $month; ?></span>
										</a>
									</li>
								
    							</ul>
    							<div class="blog_3_des">
									<figure>
										<img src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt=""/>
										<figcaption><a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>"><i class="fa fa-search-plus"></i></a></figcaption>
									</figure>
									<h5><?php echo $row->BLOG_TITLE;?></h5>
									<p> <?php echo $row->BLOG_DESC;?></p>
									<a class="readmore" href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>">
										read more
										<i class="fa fa-long-arrow-right"></i>
									</a>
								</div>
								<!--BLOG 3 DES END-->
    						</div>
    						<!--BLOG 3 WRAP END-->
    					</div>
    				<?php
		             }
		            ?>

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-2.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Back to school with course of University</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-3.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Reaserch works of students about to be start</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-4.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Reaserch works of students about to be start</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-5.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Back to school with course of University</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-6.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Back to school with course of University</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-7.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Reaserch works of students about to be start</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-8.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Back to school with course of University</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    				<!--	<div class="col-md-4">-->
    						<!--BLOG 3 WRAP START-->
    				<!--		<div class="blog_3_wrap">-->
    							<!--BLOG 3 SIDE BAR START-->
    				<!--			<ul class="blog_3_sidebar">-->
    				<!--				<li>-->
								<!--		<a href="#">-->
								<!--			14-->
								<!--			<span>nov</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-comments-o"></i>-->
								<!--			<span>69</span>-->
								<!--		</a>-->
								<!--	</li>-->
								<!--	<li>-->
								<!--		<a href="#">-->
								<!--			<i class="fa fa-thumbs-o-up"></i>-->
								<!--			<span>101</span>-->
								<!--		</a>-->
								<!--	</li>-->
    				<!--			</ul>-->
    							<!--BLOG 3 SIDE BAR END-->
    							<!--BLOG 3 DES START-->
								<!--<div class="blog_3_des">-->
								<!--	<figure>-->
								<!--		<img src="extra-images/blog3-9.jpg" alt=""/>-->
								<!--		<figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
								<!--	</figure>-->
								<!--	<ul>-->
								<!--		<li><a href="#">Jonathan Doe</a>1 week ago</li>-->
								<!--		<li><a href="#"><i class="fa fa-link"></i></a>169</li>-->
								<!--	</ul>-->
								<!--	<h5>Reaserch works of students about to be start</h5>-->
								<!--	<p>Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. </p>-->
								<!--	<a class="readmore" href="#">-->
								<!--		read more-->
								<!--		<i class="fa fa-long-arrow-right"></i>-->
								<!--	</a>-->
								<!--</div>-->
								<!--BLOG 3 DES END-->
    				<!--		</div>-->
    						<!--BLOG 3 WRAP END-->
    				<!--	</div>-->

    			<!--		<div class="col-md-12">-->
	 						<!--KF_PAGINATION_WRAP START-->
							<!--<div class="kf_edu_pagination_wrap">-->
							<!--	<ul class="pagination">-->
							<!--		<li>-->
							<!--			<a href="#" aria-label="Previous">-->
							<!--			<span aria-hidden="true"><i class="fa fa-angle-left"></i>PREV</span>-->
							<!--			</a>-->
							<!--		</li>-->
							<!--		<li class="active"><a href="#">1</a></li>-->
							<!--		<li><a href="#">2</a></li>-->
							<!--		<li><a href="#">3</a></li>-->
							<!--		<li><a href="#">4</a></li>-->
							<!--		<li><a href="#">5</a></li>-->
							<!--		<li>-->
							<!--			<a href="#" aria-label="Next">-->
							<!--			<span aria-hidden="true">Next<i class="fa fa-angle-right"></i></span>-->
							<!--			</a>-->
							<!--		</li>-->
							<!--	</ul>-->
							<!--</div>-->
							<!--KF_PAGINATION_WRAP END-->
 						<!--</div>-->

    				</div>
    				<div class="loadmore" style="padding-top:30px;">
    							<a href="#" class="btn-3 load-blogs">load more</a>
    						</div>
    			</div>
			</section>
			<!--BLOG 3 PAGE END-->
    	</div>