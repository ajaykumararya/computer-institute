<?php
$logo=$this->db->get('site_setting')->row();
$profile=$this->db->get('profile')->row();

?>
<?php
$session =$this->db->get_where('add_counter_message',['COUNTER_ID'=>1])->row();

 $visit = $session->COUNTER_NUMBER + 1;
$this->db->where('COUNTER_ID',1);
$this->db->update('add_counter_message',['COUNTER_NUMBER' =>$visit ])
?>

 <?php 
$header_4nd = $this->db->get_where('color_setting',['CS_ID'=>4])->row();
$header_5nd = $this->db->get_where('color_setting',['CS_ID'=>5])->row();
$header_6nd = $this->db->get_where('color_setting',['CS_ID'=>6])->row();
$header_7nd = $this->db->get_where('color_setting',['CS_ID'=>7])->row();
$header_8nd = $this->db->get_where('color_setting',['CS_ID'=>8])->row();
$header_9nd = $this->db->get_where('color_setting',['CS_ID'=>9])->row();
$header_10nd = $this->db->get_where('color_setting',['CS_ID'=>10])->row();
$header_11nd = $this->db->get_where('color_setting',['CS_ID'=>11])->row();
?>
<style>
    .bg-theme-header4-background{
        background-color:<?php echo $header_4nd->CS_CODE;  ?>;
    }
    .text-header4-color{
        color:<?php echo $header_4nd->CS_COLOR; ?>;
    }
    .bg-theme-header5-background{
        background-color:<?php echo $header_5nd->CS_CODE;  ?>;
    }
    .text-header5-color{
        color:<?php echo $header_5nd->CS_COLOR; ?>;
    }
     .bg-theme-header6-background{
        background-color:<?php echo $header_6nd->CS_CODE;  ?>;
    }
    .text-header6-color{
        background-color:<?php echo $header_6nd->CS_COLOR; ?>;
    }

    
     .bg-theme-header7-background{
        background-color:<?php echo $header_7nd->CS_CODE;  ?>;
    }
    .text-header7-color{
        color:<?php echo $header_7nd->CS_COLOR; ?>;
    }
    
      .bg-theme-header8-background{
        background-color:<?php echo $header_8nd->CS_CODE;  ?>;
    }
    .text-header8-color{
        color:<?php echo $header_8nd->CS_COLOR; ?>;
    }
    
      .bg-theme-header9-background{
        background-color:<?php echo $header_9nd->CS_CODE;  ?>;
    }
    .text-header9-color{
        color:<?php echo $header_9nd->CS_COLOR; ?>;
    }
    
      .bg-theme-header10-background{
        background-color:<?php echo $header_10nd->CS_CODE;  ?>;
    }
    .text-header10-color{
        color:<?php echo $header_10nd->CS_COLOR; ?>;
    }
    
      .bg-theme-header11-background{
        background-color:<?php echo $header_11nd->CS_CODE;  ?>;
    }
    .text-header11-color{
        color:<?php echo $header_11nd->CS_COLOR; ?>;
    }

</style>

	<style>
	    .custome:before {
                        content: "";
                        left: 0;
                        width: 50%;
                        top: 0;
                        bottom: 0;
                        background-image: url(extra-images/bg-1.jpg);
                        background-size: cover;
                        background-position: center;
                        position: absolute;
        }
	</style>
	
	
<!-------------- start banner ------------------------------------------------------------>	

    <!-- #region Jssor Slider Begin -->
    <!-- Generator: Jssor Slider Composer -->
    <!-- Source: https://www.jssor.com/demos/full-width-slider.slider/=edit -->
    <script src="js/jssor.slider-28.1.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        window.jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:-1,d:1,ls:0.5},{b:0,d:1000,y:5,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:200,d:1000,y:25,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:400,d:1000,y:45,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:600,d:1000,y:65,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:800,d:1000,y:85,e:{y:6}}],
              [{b:-1,d:1,ls:0.5},{b:500,d:1000,y:195,e:{y:6}}],
              [{b:0,d:2000,y:30,e:{y:3}}],
              [{b:-1,d:1,rY:-15,tZ:100},{b:0,d:1500,y:30,o:1,e:{y:3}}],
              [{b:-1,d:1,rY:-15,tZ:-100},{b:0,d:1500,y:100,o:0.8,e:{y:3}}],
              [{b:500,d:1500,o:1}],
              [{b:0,d:1000,y:380,e:{y:6}}],
              [{b:300,d:1000,x:80,e:{x:6}}],
              [{b:300,d:1000,x:330,e:{x:6}}],
              [{b:-1,d:1,r:-110,sX:5,sY:5},{b:0,d:2000,o:1,r:-20,sX:1,sY:1,e:{o:6,r:6,sX:6,sY:6}}],
              [{b:0,d:600,x:150,o:0.5,e:{x:6}}],
              [{b:0,d:600,x:1140,o:0.6,e:{x:6}}],
              [{b:-1,d:1,sX:5,sY:5},{b:600,d:600,o:1,sX:1,sY:1,e:{sX:3,sY:3}}]
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $LazyLoading: 1,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 20,
                $SpacingY: 20
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1600;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic" rel="stylesheet" type="text/css" />
    <style>
        /* jssor slider loading skin spin css */
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }


        /*jssor slider bullet skin 132 css*/
        .jssorb132 {position:absolute;}
        .jssorb132 .i {position:absolute;cursor:pointer;}
        .jssorb132 .i .b {fill:#fff;fill-opacity:0.8;stroke:#000;stroke-width:1600;stroke-miterlimit:10;stroke-opacity:0.7;}
        .jssorb132 .i:hover .b {fill:#000;fill-opacity:.7;stroke:#fff;stroke-width:2000;stroke-opacity:0.8;}
        .jssorb132 .iav .b {fill:#000;stroke:#fff;stroke-width:2400;fill-opacity:0.8;stroke-opacity:1;}
        .jssorb132 .i.idn {opacity:0.3;}

        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
    <svg viewbox="0 0 0 0" width="0" height="0" style="display:block;position:relative;left:0px;top:0px;">
        <defs>
            <filter id="jssor_1_flt_1" x="-50%" y="-50%" width="200%" height="200%">
                <feGaussianBlur stddeviation="4"></feGaussianBlur>
            </filter>
            <radialGradient id="jssor_1_grd_2">
                <stop offset="0" stop-color="#fff"></stop>
                <stop offset="1" stop-color="#000"></stop>
            </radialGradient>
            <mask id="jssor_1_msk_3">
                <path fill="url(#jssor_1_grd_2)" d="M600,0L600,400L0,400L0,0Z" x="0" y="0" style="position:absolute;overflow:visible;"></path>
            </mask>
        </defs>
    </svg>
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:560px;overflow:hidden;">
            <?php 
                $query=$this->db->get('slider_details')->result();
                foreach ($query as $row ) {
                 
               ?>
            <div >
                <img data-u="image" style="opacity:0.8;" data-src="<?php echo base_url('uploads/').$row->slider_image;?>" />
                <div data-ts="flat" data-p="275" data-po="40% 50%" style="left:150px;top:40px;width:800px;height:300px;position:absolute;">
                    
               </div>
            </div>
            <?php
            }
            ?>
         
            
        </div>
        
        <a data-scale="0" href="https://www.jssor.com" style="display:none;position:absolute;">slider html</a>
        
        
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb132" style="position:absolute;bottom:24px;right:16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:12px;height:12px;">
                <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
        
        
    </div>
    <script type="text/javascript">jssor_1_slider_init();
    </script>

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<!--------------- end banner list -------------------------------------------------------->
	
	
	
	
	
<!--	
		<div class="edu2_main_bn_wrap">
			<div id="owl-demo-main" class="owl-carousel owl-theme">
			   <?php 
                $query=$this->db->get('slider_details')->result();
                foreach ($query as $row ) {
                 
               ?>
				<div class="item">
					<figure>
						<img style="height:300px;" src="<?php echo base_url('uploads/').$row->slider_image;?>" >
						<figcaption>
							<span><?php echo $row->title;?></span>
							<h2><?php echo $row->title;?></h2>
							<p><?php echo $row->discription1;?></p>
							<a href="#" class="btn-1">read more</a>
						</figcaption>
					</figure>
				</div>
			<?php
            }
            ?>
				
			</div>
		</div>
---->
<div class="row bg-theme-header4-background text-header4-color" style=" padding: 5px; box-sizing: border-box">

    <div class="col-xs-12">

        <marquee behavior="scroll" scrollamount="3" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
            <ul class="marquee">
                    <li><i class="fa fa-hand-o-right" aria-hidden="true"></i>
                    <?php
                    $news_letter = $this->db->get('news_letter_list')->result();
                    foreach($news_letter as $news_letter_list){
                    ?>
                        <a href="<?php 
                        
                        if($news_letter_list->NEWS_LINK!= ''){
                            echo $news_letter_list->NEWS_LINK;
                        }else{
                            echo 'javascript:void(0);';
                        }
                        
                        
                        ?>" class="text-header4-color" target="_blank"><?php echo $news_letter_list->NEWS_DESC; ?></a> &nbsp;|&nbsp; 
                    <?php
                    }
                    ?>
                    </li>
                    
                    
            </ul>
      </marquee>
    </div>
</div>




		<div class="kf_content_wrap bg-theme-header6-background">
			<!--COURSE OUTER WRAP START-->
			<div class="kf_course_outerwrap" >
				<div class="container">

					<div class="row">

						<div class="col-md-8">
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
                                    $b=$this->db->query('select * from brand LIMIT 4 OFFSET 0' )->result();
                                    foreach($b as $row){
                                ?>
									<!--COURSE CATEGORIES DES START-->
									<div class="col-md-6" style="height:450px;">
										<div class="kf_cur_catg_des color-1" style="text-align: center;">
											
											<span><img style="height: 210px;" src="<?php echo base_url('uploads/'.$row->brand_image.' '); ?>" ></span>
											
											
											  <span style="padding-top: 44px;padding-right: 3px;">
											    
											  </span>
											<div class="kf_cur_catg_capstion">
												<h5><?php echo $row->brand_name;?></h5>
											
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
<br><br>
						<div class="col-md-4">
							
			<div class="query-form text-header6-color" style="padding: 15px;">
             <div class="p-30 mt-0 bg-dark-transparent-2">
                <!--<h3 class="title-pattern mt-0" style="padding: 7px;background: black;margin-bottom: 5px;">-->
                    	<div class="kf_edu2_heading2">
									<h4>Query about Course</h4>
								</div>
                  <!--<span class="kf_edu2_heading1 text-header6-color">Query about <span class="text-header6-color">Course</span></span>-->
                <!--</h3>-->
              <!-- Appilication Form Start-->
            <form id="add_enquiry">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      
                         <input name="name" type="text"  class="form-control" placeholder="Enter Name" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-20">
                      <input name="email" type="text"  class="form-control" placeholder="Enter Email" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-20">
                      <input name="mobile" type="text" maxlength="10"  class="form-control" placeholder="Enter Phone" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
                     <div class="col-sm-12">
                    <div class="form-group mb-20">
                      
                            <input name="subject" type="text"  class="form-control" placeholder="Enter Subject" />
                         <span  style="color:Red;visibility:hidden;">Required</span>
                    </div>
                  </div>
               
                 
                  <div class="col-sm-12">
                    <div class="form-group">
                      <textarea name="message" rows="2" cols="20" id="txtMessage" class="form-control" placeholder="Enter Message">
                    </textarea>
                     <span  style="color:Red;visibility:hidden;">Required</span>
              
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group mb-0 mt-10">

                      
                   <input type="submit"  value="Submit"   class="btn btn-colored btn-theme-colored2 text-white btn-lg btn-block" />
                    </div>
                  </div>
                </div>
                </form>
            
              <!-- Application Form End-->

              </div>
           </div>
							<!-- EDU2 SEARCH WRAP END -->
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

            <!--ABOUT UNIVERSITY START-->
    		<section class="about-us bg-theme-header5-background">
    		    <?php
					    $welcome=$this->db->get('whyus')->row();
					    $image=base_url('uploads/').$welcome->WHYUS_IMAGE;
					?>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="abt_univ_wrap">
								<!-- HEADING 1 START-->
								<div class="">
									<h5>About Us </h5>
									<h3><?php echo $welcome->WHYUS_TITLE;  ?></h3>
								</div>
								<!-- HEADING 1 END-->

								<div class="abt_univ_des">
                                    <?php echo $welcome->WHYUS_DESC;  ?>
								

								</div>
    						</div>
    					</div>

    					<div class="col-md-6">
    						<div class="">
    							<figure>
    								<img src="<?php echo $image;?>" alt=""/>
    							</figure>
    						</div>
    					</div>

    				</div>
    			</div>
    		</section>
    		<!--ABOUT UNIVERSITY END-->





		
			<!--GALLERY SECTION START-->
			<section class="kode-gallery-section bg-theme-header7-background">
				<!-- HEADING 2 START-->
                <div class="col-md-12">
                    <div class="kf_edu2_heading2">
                        <h3 style="font-weight:900">Our Gallery</h3>
					</div>
                </div>
                <!-- HEADING 2 END-->
                <!-- EDU2 GALLERY WRAP START-->
                <div class="edu2_gallery_wrap gallery">
                 <?php
                    $blogs=$this->db->query('select * from blogs where PAGE_NAME = 3 and BLOG_STATUS = 1 LIMIT 8 OFFSET 0');
                    $blog = $blogs->result();
                    $blog_num = $blogs->num_rows();
                    ?>  
                    <!-- EDU2 GALLERY DES START-->
                    <div class="gallery3">
                    <?php
					       
        		        foreach($blog as $row){
        					  $date=$row->BLOG_TT;
                        $convert_date = strtotime($date);
                        $month = date('F',$convert_date);
                        $day = date('d',$convert_date);
                        $date = date('d-F-Y',$convert_date);

	                 ?>
                        <div class="filterable-item all 2 1 9 col-md-3 col-sm-4 col-xs-12 no_padding">
                            <div class="edu2_gallery_des">
                                <figure>
                                    <img alt="" style="height: 180px;" src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>">
                                    <figcaption>
                                        <a data-rel="prettyPhoto[gallery2]" href="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>"><i class="fa fa-eye"></i></a>
                                        <a href="#"><i class="fa fa-link"></i></a>
                                        <!--<h5>Lorem Ipsum Proin</h5>-->
                                        <!--<p>Convocation</p>-->
                                    </figcaption>
                                </figure>
                            </div>	
                        </div>
                    <?php
        		        }
        		    ?>
            
                    </div>
                    
                <!-- EDU2 GALLERY WRAP END-->
                </div>
                <div class="loadmore">
						<a href="<?php echo base_url('gallery');?>" class="btn-3 ">Load More</a>
					</div>
			</section>
			<!--GALLERY SECTION END-->
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
				
				</div>
			</section> 
			<!--COUNTER SECTION END-->

			<!-- FACULTY WRAP START-->
			<section class="faculty-member-bg bg-theme-header9-background">
				<div class="container">
					<div class="row">
						<!-- HEADING 1 START-->
						<div class="col-md-12">
							<div class="kf_edu2_heading2">
								<h3>Bord Of Advisory member</h3>
							</div>
						</div>
						<!-- HEADING 1 END-->

						<!-- FACULTY SLIDER WRAP START-->
						<div class="edu2_faculty_wrap">
							<div id="owl-demo-8" class="owl-carousel owl-theme" >
							<?php 
                                 $member=$this->db->query('select * from member_list where MEMBER_STATUS = 1 LIMIT 4 OFFSET 0')->result();
                                 foreach($member as $row){
                             ?>
								<div class="item">
									<!-- FACULTY DES START-->
									<div class="edu2_faculty_des" style="font-size: 12px;font-weight: 900;line-height: 18px;" >
										<figure><img style="height: 190px;width: 100%;" src="<?php echo base_url('uploads/').$row->MEMBER_PHOTO?>" alt=""/>
											<figcaption>
												<a href="#"><i class="fa fa-facebook"></i></a>
												<a href="#"><i class="fa fa-twitter"></i></a>
												<a href="#"><i class="fa fa-linkedin"></i></a>
												<a href="#"><i class="fa fa-google-plus"></i></a>
											</figcaption>
										</figure>
										<div class="edu2_faculty_des2" style="margin-top:-15px">
											<h6><a href="#"><?php echo $row->MEMBER_NAME?></a></h6>
											<strong><?php echo $row->MEMBER_POST?></strong>
											<p><?php echo $row->MEMBER_ABOUT_US?></p>
										</div>
									</div>
									<!-- FACULTY DES END-->
								</div>
							<?php
                                 }
                            ?>

							</div>
						</div>
						<br><br>
						    <div class="view-all" style="padding-top:40px;">
                                        	<a class="btn-3 " href="<?php echo base_url('our-teacher');?>">View All ADVISORY MEMBER</a>
                            </div>
						<!-- FACULTY SLIDER WRAP END-->
					</div>
				</div>
			</section>
			<!-- FACULTY WRAP START-->

			<!-- LATEST NEWS AND EVENT WRAP START-->
			<section class="edu2_new_wrap bg-theme-header10-background">
				<div class="container">
					<!-- HEADING 2 START-->
					<div class="col-md-12">
						<div class="kf_edu2_heading2">
							<h3>Latest  &amp; Event</h3>
						</div>
					</div>
					<!-- HEADING 2 END-->
					<div class="row">
						<!-- EDU2 NEW DES START-->
				<?php
                    // $blogs=$this->db->get_where('blogs',array('PAGE_NAME'=> 2,'BLOG_STATUS'=>1));
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
						<div class="col-md-6">
							<div class="edu2_new_des" style="border: 1px solid;padding: 10px;">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div class="edu2_event_des" style="padding: 10px;">
											<h4><?php echo $month?></h4>
											<p style="font-weight: 900;border-bottom: 1px solid;padding: 5px;background: blanchedalmond;"><?php echo $row->BLOG_TITLE;?></p>
											<ul class="post-option">
 												
											</ul>
											<a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>" class="readmore">read more<i class="fa fa-long-arrow-right"></i></a>
											<span><?php echo $day?></span>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 thumb">
										<figure>
										    <img style="height:150px;" src="<?php echo base_url('uploads/').$row->BLOG_IMAGE; ?>" alt=""/>
											<figcaption><a href="<?php echo base_url('blog-detail/').$row->BLOG_ID;?>"><i class="fa fa-plus"></i></a></figcaption>
										</figure>
									</div>
								</div>
							</div>
						</div>
				<?php
				    }
				?>
				
					</div>
				<div class="view-all " style="padding-top:20px;">
                                        	<a class="btn-3 " href="<?php echo base_url('events');?>">View All Events</a>
                 </div>
				</div>
			</section>
			<!-- LATEST NEWS AND EVENT WRAP END-->


			<!--TRAINING WRAP START-->
			<section class="" style="background:#08f36c">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="kf_edu2_training_des">
								<figure>
									<img src="<?php echo base_url('webassets/')?>extra-images/training-thumb.png" alt=""/>
								</figure>
							</div>
						</div>

						<div class="col-md-8">
							<div class="edu2_training_wrap">
								<h2> JOIN US ! </h2>
								<h3>Your Bright Future Is On Click Away</h3>
								<!--COUNTDOWN START-->
								<ul class="countdown">
									<li>
										<span class="days">1 Year </span>
										<p class="days_ref">Courses</p>
									</li>
									<li>
										<span class="hours">2 Years</span>
										<p class="hours_ref">Courses</p>
									</li>
									<li>
										<span class="minutes">3 Years</span>
										<p class="minutes_ref">Courses</p>
									</li>
									<li>
										<span class="seconds last">4 Years</span>
										<p class="seconds_ref">Courses</p>
									</li>
								</ul>
								<!--COUNTDOWN END-->
								<strong>It’s limited Seating! Hurry up</strong>
								<a href="#" data-toggle="modal" data-target="#reg-box" class="btn-1">REGISTER NOW</a>
							</div>

						</div>
					</div>
				</div>
			</section>

			<!--OUR TESTEMONIAL WRAP START-->
			<section class="our-testimonials" >
				<div class="container">
					<div class="row">
						
						<div class="col-md-12">
							<div class="kf_edu2_heading2">
								<h3>Our Testimonial</h3>
							</div>
						</div>
						
						<div class="edu2_testemonial_slider_wrap">
							<div id="owl-demo-9">
							<?php
							
							$feedback= $this->db->get('feedback')->result();
							
			    	        foreach($feedback as $row){
							?>
							<div class="item">
								<div class="edu_testemonial_wrap">
									<figure><img src="<?php echo base_url('uploads/').@$row->FB_PERSON_IMAGE; ?>" alt=""/></figure>
									<div class="kode-text">
										<p style="color:black"><?php echo $row->FB_COMMENT?></p>
										<a href="#"><?php echo @$row->FB_PER_NAME    ?><span>- <?php echo @$row->FB_TITLE ?></span></a>
									</div>
								</div>
							</div>
							<?php
							 }
							
							 ?>
							</div>
						</div>
					
					</div>
				</div>
			</section>
		</div>


<style>
    
    .new-list ul li span.news-date {
        float: left;
        width: 50px;
        height: auto;
        padding: 10px 0;
        text-align: center;
        color: #fff;
        background: #f08905;
    }
    .new-list ul li {
        padding: 10px 0;
        border-bottom: 1px dashed #555;
    }
    .new-list {
        padding: 10px;
    }
    .news-event {
        border: 1px solid #ddd;
    }
    .new-list ul li a {
        font-size: 13px;
        float: right;
        width: 80%;
    }
    a:link {
        text-decoration: none;
    }
</style>


<!--ABOUT UNIVERSITY START-->
    		<section class=" " style="padding: 10px 0px;">
    		    <?php
					    $welcome=$this->db->get('whyus')->row();
					    $image=base_url('uploads/').$welcome->WHYUS_IMAGE;
					?>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="abt_univ_wrap">
								<div class="abt_univ_des">
                                    
								<img src="<?php echo base_url('background-mage/');  ?>01.jpeg">

								</div>
    						</div>
    					</div>

    					<div class="col-md-6" >
    						<div  style="padding: 15px;">
                                 <div class="p-30 mt-0 bg-dark-transparent-2">
                                    <!--<h3 class="title-pattern mt-0" style="padding: 7px;background: black;margin-bottom: 5px;">-->
                                        	<div class="kf_edu2_heading2">
            									<h3> LETEST NEWS / EVENT</h3>
            								</div>
                                      
                                  <!-- Appilication Form Start-->
                                    <div class="new-list">
                                        <marquee direction="up" onMouseOver="this.stop()" onMouseOut="this.start()">
                                            <ul>
                                                <?php
                                                $notice_board =   $this->db->query("SELECT * FROM `notice_board` ORDER BY id DESC LIMIT 5")->result();
                                                foreach($notice_board as $notice_board_list){
                                                    echo '
                                                        <li class="clearfix"> 
                                                            <span class="news-date" style="width:100px;"> '.date('d',strtotime($notice_board_list->date)).' <small>, '.date('Y',strtotime($notice_board_list->date)).' </small> </span> 
                                                            <a href="#" style="padding: 15px;text-align: left;font-weight: 900;"> '.$notice_board_list->title.' </a> 
                                                        </li>
                                                    ';
                                                }
                                                ?>
                                                
                                                
                                              
                                                
                                            </ul>
                                        </marquee>
                                    </div>
                                
                                  <!-- Application Form End-->
                    
                                  </div>
                            </div>
    					</div>

    				</div>
    			</div>
    		</section>
    		<!--ABOUT UNIVERSITY END-->



<!--
<section>
     <div class="container">
         <div class="row">
             <div class="col-md-4">
                 <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/sakhaesociety&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                     
                 </iframe>
             </div>
             <div class="col-md-4">
               <iframe src="https://www.facebook.com/plugins/video.php?height=300&href=https%3A%2F%2Fwww.facebook.com%2Fsakhaesociety%2Fvideos%2F576568383510864%2F&show_text=false&width=357&t=0" width="357" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>     
             </div>
             <div class="col-md-4">
                 <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/sakhaesociety&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                     
                 </iframe>
                 
                 
                 
             </div>
         </div>
     </div>
 </section>
--->
	

