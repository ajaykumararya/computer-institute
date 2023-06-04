
        <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>filterable gallery</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">filterable gallery</a></li>
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
    				
    		<section>
    			<div class="container">
    				<div class="filterable_heading">
    					<h3>Filterable Gallery</h3>
    					<!-- Single button -->
    				</div>

    				<div class="row gallery" id="load_gallery">
    				    <?php
                            $blogs=$this->db->query("select * from blogs where PAGE_NAME = 3 and BLOG_STATUS = 1 LIMIT 12 OFFSET 0");
                            $blog = $blogs->result();
                            $blog_num = $blogs->num_rows();
                            foreach($blog as $row){
        					    $date=$row->BLOG_TT;
                                $convert_date = strtotime($date);
                                $month = date('F',$convert_date);
                                $day = date('d',$convert_date);
                                $date = date('d-F-Y',$convert_date);
                        ?> 
    					<div class="col-md-3 col-sm-6">
    						
    						<div class="filterable_thumb">
    							<figure>
    								<img style="height: 180px;" src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt=""/>
    								<figcaption><a href="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" data-rel="prettyPhoto[gallery2]"><i class="fa fa-plus"></i></a></figcaption>
    							</figure>
    						</div>
    						
    					</div>
    					<?php
                            }
                        ?>

    				
    				</div>
    				<div class="loadmore">
						<a href="#" class="btn-3 load-more-gallery">Load More</a>
					</div>
    			</div>
    		</section>
    			
    	</div>
        <!--Content Wrap End-->