       <?php
             $blog = $this->db->get_where('blogs', array('BLOG_ID' => $this->uri->segment(2)))->row();
             if($blog->PAGE_NAME==2){
                 $title='Event';
             }elseif($blog->PAGE_NAME==1){
                 $title='blog';
             }
             					  $date=$blog->BLOG_TT;
                $convert_date = strtotime($date);
                $month = date('F',$convert_date);
                $day = date('d',$convert_date);
                $date = date('d-F-Y',$convert_date);

        ?>  
        <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3><?php echo $title;?> Detail</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#"><?php echo $title;?> Detail</a></li>
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
					<div class="row">
						<div class="col-md-12">

							<!--EVENT CONVOCATION OUTER Wrap START-->
							<div class="kf_convocation_outer_wrap">	
								<div class="convocation_slider">

									<div id="owl-demo-23" class="owl-carousel owl-theme">

										<div class="item"><figure><img src="<?php echo base_url('uploads/').$blog->BLOG_IMAGE ?>" alt=""/></figure></div>
										<!--<div class="item"><figure><img src="extra-images/event_detail2.jpg" alt=""/></figure></div>-->
										<!--<div class="item"><figure><img src="extra-images/event_detail3.jpg" alt=""/></figure></div>-->

									</div>
								</div>

								<!--EVENT CONVOCATION  Wrap START-->
								<div class="kf_convocation_wrap">
									<h4><span><?php $blog->BLOG_TITLE ?></span></h4>
									<ul class="convocation_timing">
										<li><i class="fa fa-calendar"></i><?php echo $date?></li>
										<!--<li><i class="fa fa-clock-o"></i>10:00 am - 04:00 pm</li>-->
									</ul>

									<!--EVENT CONVOCATION DES START-->
									<div class="kf_convocation_des">
										<!--<h5>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium</h5>-->
										<p><?php echo $blog->BLOG_DESC ?></p>

										<!--<h5>Convocation Day information</h5>-->
										<!--<p>Join our team for this event we will support you all the way, providing training and fundraising tips.</p>-->
										<!--<a href="#"><i class="fa fa-plus"></i>Google Calender</a>-->
										<!--<a href="#"><i class="fa fa-plus"></i>Local Expert</a>-->

										<!--EVENT CONVOCATION MAP  Wrap START-->
										<!--<div class="kf_convocation_map">-->
										<!--	<div id="map-canvas" class="map-canvas"></div>-->
										<!--	<a class="convocation_link" href="#">Details</a>-->
										<!--	<a class="convocation_link" href="#">Organizer</a>-->
										<!--	<a class="convocation_link" href="#">Venue</a>-->
										<!--</div>-->
										<!--EVENT CONVOCATION MAP  Wrap END-->

									</div>
									<!--EVENT CONVOCATION DES END-->

								</div>
								<!--EVENT CONVOCATION  Wrap END-->

								<!--EVENT SPEAKER Wrap START-->
								<!--<div class="kf_event_speakers">-->
								<!--	<div class="heading_5">-->
								<!--		<h4><span>Event</span> Speakers</h4>-->
								<!--	</div>-->
								<!--	<div class="row">-->
								<!--		<div class="col-md-4 col-sm-4">-->
								<!--			<div class="kf_event_speakers_des">-->
								<!--				<figure><img src="extra-images/event-sp.jpg" alt=""/></figure>-->
								<!--				<h5><a href="#">Jim Taylor</a></h5>-->
								<!--				<p>Speaker</p>-->
								<!--			</div>-->
								<!--		</div>-->

								<!--		<div class="col-md-4 col-sm-4">-->
								<!--			<div class="kf_event_speakers_des">-->
								<!--				<figure><img src="extra-images/event-sp2.jpg" alt=""/></figure>-->
								<!--				<h5><a href="#">Alberta Doe</a></h5>-->
								<!--				<p>Speaker</p>-->
								<!--			</div>-->
								<!--		</div>-->

								<!--		<div class="col-md-4 col-sm-4">-->
								<!--			<div class="kf_event_speakers_des">-->
								<!--				<figure><img src="extra-images/event-sp3.jpg" alt=""/></figure>-->
								<!--				<h5><a href="#">Jim Taylor</a></h5>-->
								<!--				<p>Speaker</p>-->
								<!--			</div>-->
								<!--		</div>-->
								<!--	</div>-->
								<!--</div>-->
								<!--EVENT SPEAKER Wrap End-->

								<!--EVENT GALLERY Wrap STAT-->
								<!--<div class="kf_event_gallery">-->
								<!--	<div class="heading_5">-->
								<!--		<h4><span>Event</span> Gallery</h4>-->
								<!--	</div>-->
								<!--	<ul class="event_gallery_des">-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery1.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery2.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery3.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery4.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery5.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery6.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery7.jpg" alt=""/></a></li>-->
								<!--		<li><a href="#"><img src="extra-images/event_gallery8.jpg" alt=""/></a></li>-->
								<!--	</ul>-->
								<!--	<a class="event_link next" href="#">NEXT EVENT<i class="fa fa-angle-right"></i></a>-->
								<!--	<a class="event_link prev" href="#"><i class="fa fa-angle-left"></i>PREVIOUS EVENT</a>-->
								<!--</div>-->
								<!--EVENT GALLERY Wrap End-->

							</div>
							<!--EVENT CONVOCATION OUTER Wrap END-->

						</div>

						<!--KF_EDU_SIDEBAR_WRAP START-->
    					<!--<div class="col-md-4">-->
    					<!--	<div class="kf-sidebar">-->

    							<!--KF_SIDEBAR_SEARCH_WRAP START-->
    					<!--		<div class="widget widget-search">-->
         <!--                       	<h2>Search Course</h2>-->
    					<!--			<form>-->
    					<!--				<input type="search" placeholder="Keyword...">-->
    					<!--			</form>-->
    					<!--		</div>-->
    							<!--KF_SIDEBAR_SEARCH_WRAP END-->

    							<!--KF_SIDEBAR_ARCHIVE_WRAP START-->
    					<!--		<div class="widget widget-archive ">-->
    					<!--			<h2>Archives</h2>-->
    					<!--			<ul class="sidebar_archive_des">-->
    					<!--				<li>-->
    					<!--					<a href="#"><i class="fa fa-angle-right"></i>January</a>-->
    					<!--				</li>-->
    					<!--				<li>-->
    					<!--					<a href="#"><i class="fa fa-angle-right"></i>February</a>-->
    					<!--				</li>-->
    					<!--				<li>-->
    					<!--					<a href="#"><i class="fa fa-angle-right"></i>March</a>-->
    					<!--				</li>-->
    					<!--				<li>-->
    					<!--					<a href="#"><i class="fa fa-angle-right"></i>April</a>-->
    					<!--				</li>-->
    					<!--				<li>-->
    					<!--					<a href="#"><i class="fa fa-angle-right"></i>May</a>-->
    					<!--				</li>-->
    					<!--			</ul>-->
    					<!--		</div>-->
    							<!--KF_SIDEBAR_ARCHIVE_WRAP END-->


    							<!--KF SIDEBAR RECENT POST WRAP START-->
    					<!--		<div class="widget widget-recent-posts">-->
    					<!--			<h2>Recent Posts</h2>-->
    					<!--			<ul class="sidebar_rpost_des">-->
                                    	<!--LIST ITEM START-->
         <!--                          		<li>-->
         <!--                                   <figure>-->
         <!--                                   	<img src="extra-images/archive-1.jpg" alt="">-->
         <!--                                       <figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
         <!--                                   </figure>-->
         <!--                                   <div class="kode-text">-->
         <!--                                       <h6><a href="#">Lorem ipsum dolor sit amet sint occaecat cupidatat</a></h6>-->
         <!--                                       <span><i class="fa fa-clock-o"></i>10 Jan, 2016</span>-->
         <!--                                   </div>-->
    					<!--				</li>-->
                                        <!--LIST ITEM START-->
										<!--LIST ITEM START-->
         <!--                          		<li>-->
         <!--                                   <figure>-->
         <!--                                   	<img src="extra-images/archive-2.jpg" alt="">-->
         <!--                                       <figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
         <!--                                   </figure>-->
         <!--                                   <div class="kode-text">-->
         <!--                                       <h6><a href="#">Lorem ipsum dolor sit amet sint occaecat cupidatat</a></h6>-->
         <!--                                       <span><i class="fa fa-clock-o"></i>10 Jan, 2016</span>-->
         <!--                                   </div>-->
    					<!--				</li>-->
                                        <!--LIST ITEM START-->
                                        <!--LIST ITEM START-->
         <!--                          		<li>-->
         <!--                                   <figure>-->
         <!--                                   	<img src="extra-images/archive-3.jpg" alt="">-->
         <!--                                       <figcaption><a href="#"><i class="fa fa-search-plus"></i></a></figcaption>-->
         <!--                                   </figure>-->
         <!--                                   <div class="kode-text">-->
         <!--                                       <h6><a href="#">Lorem ipsum dolor sit amet sint occaecat cupidatat</a></h6>-->
         <!--                                       <span><i class="fa fa-clock-o"></i>10 Jan, 2016</span>-->
         <!--                                   </div>-->
    					<!--				</li>-->
                                        <!--LIST ITEM START-->
    					<!--			</ul>-->
    					<!--		</div>-->
    							<!--KF SIDEBAR RECENT POST WRAP END-->

    							<!--KF EDU SIDEBAR COURSES CATEGORieS WRAP START-->
	    				<!--		<div class="widget widget-categories">-->
	    				<!--			<h2>categories</h2>-->
									<!--<ul>-->
									<!--	<li><a href="#"><i class="fa fa-caret-right"></i>Business &amp; Economics</a></li>-->
									<!--	<li><a href="#"><i class="fa fa-caret-right"></i>Politics &amp; History</a></li>-->
									<!--	<li><a href="#"><i class="fa fa-caret-right"></i>Medical Sciences &amp; Health</a></li>-->
									<!--	<li><a href="#"><i class="fa fa-caret-right"></i>Fine Arts</a></li>-->
									<!--	<li><a href="#"><i class="fa fa-caret-right"></i>Tourism &amp; Culture</a></li>-->
									<!--	<li><a href="#"><i class="fa fa-caret-right"></i>Sports</a></li>-->
									<!--</ul>-->
	    				<!--		</div>-->
	    						<!--KF EDU SIDEBAR COURSES CATEGORieS WRAP END-->

	    						<!--KF SIDE BAR COURSES LIST WRAP START WRAP START-->
	    				<!--		<div class="widget widget-courses-list">-->
	    				<!--			<h2>Latest Courses</h2>-->
	    				<!--			<ul>-->
	    				<!--				<li>-->
         <!--                               	<figure>-->
         <!--                                   	<img src="extra-images/courseslist1.jpg" alt=""/>-->
	    				<!--						<a href="#">View Detail</a>-->
	    				<!--					</figure>-->
	    				<!--				</li>-->

	    				<!--				<li>-->
         <!--                               	<figure>-->
         <!--                                   	<img src="extra-images/courseslist2.jpg" alt=""/>-->
	    				<!--						<a href="#">View Detail</a>-->
	    				<!--					</figure>-->
	    				<!--				</li>-->

	    				<!--				<li>-->
         <!--                               	<figure>-->
         <!--                                   	<img src="extra-images/courseslist3.jpg" alt=""/>-->
	    				<!--						<a href="#">View Detail</a>-->
	    				<!--					</figure>-->
	    				<!--				</li>-->

	    				<!--				<li>-->
         <!--                               	<figure>-->
         <!--                                   	<img src="extra-images/courseslist4.jpg" alt=""/>-->
	    				<!--						<a href="#">View Detail</a>-->
	    				<!--					</figure>-->
	    				<!--				</li>-->

	    				<!--				<li>-->
         <!--                               	<figure>-->
         <!--                                   	<img src="extra-images/courseslist5.jpg" alt=""/>-->
	    				<!--						<a href="#">View Detail</a>-->
	    				<!--					</figure>-->
	    				<!--				</li>-->

	    				<!--				<li>-->
         <!--                               	<figure>-->
         <!--                                   	<img src="extra-images/courseslist6.jpg" alt=""/>-->
	    				<!--						<a href="#">View Detail</a>-->
	    				<!--					</figure>-->
	    				<!--				</li>-->
	    				<!--			</ul>-->
	    				<!--		</div>-->
	    						<!--KF SIDE BAR COURSES LIST WRAP START WRAP END-->

	    						<!--KF SIDE BAR TAG CLOUD WRAP START-->
	    				<!--		<div class="widget widget-tag-cloud">-->
	    				<!--			<h2>Tags Cloud</h2>-->
	    				<!--			<ul>-->
	    				<!--				<li><a href="#">Science</a></li>-->
	    				<!--				<li><a href="#">Development</a></li>-->
	    				<!--				<li><a href="#">Fine Arts</a></li>-->
	    				<!--				<li><a href="#">Research</a></li>-->
	    				<!--				<li><a href="#">Admissions</a></li>-->
	    				<!--				<li><a href="#">PHD</a></li>-->
	    				<!--				<li><a href="#">History &amp; Politics</a></li>-->
	    				<!--				<li><a href="#">Sports</a></li>-->
	    				<!--			</ul>-->

	    				<!--		</div>-->
	    						<!--KF SIDE BAR TAG CLOUD WRAP END-->

    					<!--	</div>-->
    					<!--</div>-->
						<!--KF EDU SIDEBAR WRAP END-->

					</div>
				</div>
    		</section>
    	</div>