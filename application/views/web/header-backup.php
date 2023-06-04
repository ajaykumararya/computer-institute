<!DOCTYPE html>
<html lang="en">
	
<!-- Mirrored from kodeforest.net/html/uoe/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Nov 2021 08:11:51 GMT -->
<head>
    <?php
//     header("Cache-Control: no-cache, must-revalidate");
// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// header("Content-Type: application/xml; charset=utf-8");

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$logo=$this->db->get('site_setting')->row();
$profile=$this->db->get('profile')->row();
?>	
	
	<meta name="description" content="Welcome to <?php echo $profile->ORG_NAME; ?> " />
    <meta name="keywords" content="Welcome to <?php echo $profile->ORG_NAME; ?>" />
    <meta name="author" content="<?php echo $profile->ORG_NAME; ?>" />
    
    <!-- Page Title -->
    <title> <?php echo $profile->ORG_NAME; ?> </title>
    
    <!-- Favicon and Touch Icons -->
    <link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="shortcut icon" type="image/png">
    <link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon">
    <link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon" sizes="72x72">
    <link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon" sizes="114x114">
    <link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon" sizes="144x144">
	
	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url('webassets/')?>css/bootstrap.min.css" rel="stylesheet">
	<!-- Full Calender CSS -->
	<link href="<?php echo base_url('webassets/')?>css/fullcalendar.css" rel="stylesheet">
	<!-- Owl Carousel CSS -->
	<link href="<?php echo base_url('webassets/')?>css/owl.carousel.css" rel="stylesheet">
	<!-- Pretty Photo CSS -->
	<link href="<?php echo base_url('webassets/')?>css/prettyPhoto.css" rel="stylesheet">
	<!-- Bx-Slider StyleSheet CSS -->
	<link href="<?php echo base_url('webassets/')?>css/jquery.bxslider.css" rel="stylesheet"> 
	<!-- Font Awesome StyleSheet CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
	<!--<link href="<?php echo base_url('websitecss/'); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
	<!--<link href="<?php echo base_url('webassets/')?>css/font-awesome.min.css" rel="stylesheet">-->
    <!-- DL Menu CSS -->
    <link href="<?php echo base_url('webassets/')?>js/dl-menu/component.css" rel="stylesheet">
	<link href="<?php echo base_url('webassets/')?>svg/style.css" rel="stylesheet">
	<!-- Widget CSS -->
	<link href="<?php echo base_url('webassets/')?>css/widget.css" rel="stylesheet">
	<!-- Typography CSS -->
	<link href="<?php echo base_url('webassets/')?>css/typography.css" rel="stylesheet">
	<!-- Shortcodes CSS -->
	<link href="<?php echo base_url('webassets/')?>css/shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
	<link href="<?php echo base_url('webassets/')?>style.css" rel="stylesheet">
	<!-- Color CSS -->
	<link href="<?php echo base_url('webassets/')?>css/color.css" rel="stylesheet">
	<!-- Responsive CSS -->
	<link href="<?php echo base_url('webassets/')?>css/responsive.css" rel="stylesheet">
	<!-- SELECT MENU -->
	<link href="<?php echo base_url('webassets/')?>css/selectric.css" rel="stylesheet">
	<!-- SIDE MENU -->
	<link rel="stylesheet" href="<?php echo base_url('webassets/')?>css/jquery.sidr.dark.css">
	
<!---------------------- start color setting ----------------------------->
    <?php 
    $header_top_color = $this->db->get_where('color_setting',['CS_ID'=>1])->row();
    $header_2nd = $this->db->get_where('color_setting',['CS_ID'=>2])->row();
    $header_3nd = $this->db->get_where('color_setting',['CS_ID'=>3])->row();
    $header_4nd = $this->db->get_where('color_setting',['CS_ID'=>4])->row();
    $header_6nd = $this->db->get_where('color_setting',['CS_ID'=>6])->row();
    $header_7nd = $this->db->get_where('color_setting',['CS_ID'=>7])->row();
    $header_8nd = $this->db->get_where('color_setting',['CS_ID'=>8])->row();
    $header_9nd = $this->db->get_where('color_setting',['CS_ID'=>9])->row();
    $header_10nd = $this->db->get_where('color_setting',['CS_ID'=>10])->row();
    $header_11nd = $this->db->get_where('color_setting',['CS_ID'=>11])->row();
    $header_12nd = $this->db->get_where('color_setting',['CS_ID'=>12])->row();
    $header_13nd = $this->db->get_where('color_setting',['CS_ID'=>13])->row();
    $header_14nd = $this->db->get_where('color_setting',['CS_ID'=>14])->row();
    ?>

<style>
    .top_bar_2{
         background-color:<?php echo $header_top_color->CS_CODE;  ?>;
    }
    .kode_navigation{
        background-color:<?php echo $header_2nd->CS_CODE;  ?>;
    }
    .kf_course_outerwrap{
        background-color:<?php echo $header_3nd->CS_CODE;  ?>;
    }
    
    .query-form{
        background:<?php echo $header_3nd->CS_BACKGROUN_HOVER; ?>;
    }
    .about-us{
        background-color:<?php echo $header_4nd->CS_CODE;  ?>;
    }
    .our-courses{
         background-color:<?php echo $header_6nd->CS_CODE;  ?>;
    }
    .kode-gallery-section{
        background:<?php echo $header_7nd->CS_CODE;  ?>;
    }
    
    .edu2_counter_wrap{
	    background-color:<?php echo $header_8nd->CS_CODE;  ?> ;

    }
    .faculty-member-bg{
        background-color:<?php echo $header_9nd->CS_CODE;  ?> ;
    }
    .edu2_new_wrap{
    	background-color:<?php echo $header_10nd->CS_CODE;  ?> ;
    	
    }
    .our-testimonials{
        background-color:<?php echo $header_11nd->CS_CODE;  ?> ;
    }
    .main-footer{
	    background-color:<?php echo $header_12nd->CS_CODE;  ?>;

    }
    .edu2_copyright_wrap{
        background-color:<?php echo $header_13nd->CS_CODE;  ?> ;
    }
    .kf_edu2_heading1{
        background:<?php echo $header_14nd->CS_COLOR; ?>;
    }
    .kf_edu2_heading2{
        background:<?php echo $header_14nd->CS_COLOR; ?>;
	  
    }
    .kf_edu2_heading2 h3{
        background:<?php echo $header_14nd->CS_BACKGROUN_HOVER; ?>;
	  
    }
    .kf_edu2_heading4{
        background:<?php echo $header_14nd->CS_FONT_HOVER; ?>;
	  
    }
</style>


<!------------------ end color setting -------------------------------------->
	
	

</head>

<body>
    <script>

    var get_loc='<?php echo base_url(); ?>get_ajax/';
    var base_loc='<?php echo base_url(); ?>';

    var post_loc='<?php echo base_url(); ?>post_ajax/';
     var payment='<?php echo base_url(); ?>razorpay/';
    var site_loc='<?php echo base_url(); ?>welcome/';
    var post_url = '<?php echo base_url(); ?>';
    

    var js_loc='<?php echo base_url(); ?>/assets/';    

     var post_web='<?php echo base_url(); ?>post_ajax/';
     var web_loc='<?php echo base_url(); ?>web_ajax/';
   

   //alert(type);



    </script>

    
	<!--KF KODE WRAPPER WRAP START-->
    <div class="kode_wrapper">
    <!-- register Modal -->
    <div class="modal fade" id="reg-box" tabindex="-1" role="dialog">
        <div class="modal-dialog">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-content">
            	<!--SIGNIN AS USER START-->
                <div class="user-box">
                	<h2>Sign up as a User</h2>
                    <!--FORM FIELD START-->
                    <div class="form">
                        <form id="register" >
                            <input type="hidden" name="type" value="3">
                        <div class="input-container">
                            <input type="text" name="name" placeholder="Enter Name" required="required">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="input-container">
                            <input type="text" name="mobile" placeholder="Enter Mobile No." required="required">
                            <i class="fa fa-user"></i>
                        </div>
                        <!--<div class="input-container">-->
                          	<!--<input type="number"  name="mobile" placeholder="Enter  No." required="required">-->
                        <!--    <i class="fa fa-unlock"></i>-->
                        <!--</div>-->
                        <div class="input-container">
                            <!--<input type="text" placeholder="E-mail">-->
                            <input type="text" class="form-control" name="email" placeholder="Enter Email" required="required">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        
                        <div class="input-container">
                            <!--<input type="password" placeholder="Password">-->
                            	<input type="text" class="form-control" name="address" placeholder="Address" required="required">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="input-container">
                            	<!--<input type="text" class="form-control" name="address" required="required">-->
                            <input type="password" placeholder="Password" name="new_password">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="input-container">
                            <input type="password" placeholder="Confirm Password" name="password">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="input-container">
                            <label>
                                <span class="radio">
                                    <input type="checkbox" name="foo" value="1" checked>
                                    <span class="radio-value" aria-hidden="true"></span>
                                </span>
                                <span>Remember me</span>
                            </label>
                        </div>
                        <div class="input-container">
                            <button type="submit" class="btn-style">Sign Up</button>
                        </div>
                    </div>
                    </form>
                    <!--FORM FIELD END-->
                    <!--OPTION START-->
                    
                    <!--<div class="option">-->
                    <!--    <h5>Or Using</h5>-->
                    <!--</div>-->
                    
                    <!--OPTION END-->
                    <!--OPTION START-->
                    
                    <!--<div class="social-login">-->
                    <!--    <a href="<?php echo base_url('webassets/')?>#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>-->
                    <!--    <a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>-->
                    <!--</div>-->
                    
                    <!--OPTION END-->
                </div>
                <!--SIGNIN AS USER END-->
                <!--<div class="user-box-footer">-->
                <!--    Already have an account? <a href="#">Sign In</a>-->
                <!--</div>-->
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- register Modal end-->
    
    <!-- SIGNIN MODEL START -->
    <div class="modal fade" id="signin-box" tabindex="-1" role="dialog">
        <div class="modal-dialog">
        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-content">
                <div class="user-box">
                    <h2>Sign In</h2>
                    <!--FORM FIELD START-->
                    <div class="form">
                    <form id="login_web" >
                        <div class="input-container">
                            <input type="text" placeholder="E-mail" name="user_id">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="input-container">
                            <input type="password" placeholder="Password" name="password">
                            <i class="fa fa-unlock"></i>
                        </div>
                        <div class="input-container">
                            <label>
                                <span class="radio">
                                    <input type="checkbox" name="foo" value="1" checked>
                                    <span class="radio-value" aria-hidden="true"></span>
                                </span>
                                <span>Remember me</span>
                            </label>
                        </div>
                        <div class="input-container">
                            <button type="submit" class="btn-style">Sign In</button>
                        </div>
                    </form>
                    </div>
                    <!--FORM FIELD END-->
                    <!--OPTION START-->
                    
                    <!--<div class="option">-->
                    <!--    <h5>Or Using</h5>-->
                    <!--</div>-->
                    
                    <!--OPTION END-->
                    <!--OPTION START-->
                    
                    <!--<div class="social-login">-->
                    <!--    <a href="#" class="google"><i class="fa fa-google-plus"></i>Google Account</a>-->
                    <!--    <a href="#" class="facebook"><i class="fa fa-facebook"></i>Facebook Account</a>-->
                    <!--</div>-->
                    
                    <!--OPTION END-->
                
                </div>
                <!--<div class="user-box-footer">-->
                <!--    <p>Don't have an account?<br><a href="#">Sign up as a User</a></p>-->
                <!--</div>-->
                
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- SIGNIN MODEL END -->
    <?php 
        $logo=$this->db->get('site_setting')->row();
    ?>
	
    	<!--HEADER START-->
    	<header id="header_2">
    		<!--kode top bar start-->
    		<div class="top_bar_2">
	    		<div class="container">
	    			<div class="row">
	    				<div class="col-md-5">
	    					<div class="pull-left">
	    						<em class="contct_2"><i class="fa fa-phone"></i> Call Us : <?php echo $profile->ORG_PHONE;?></em>
	    					</div>
	    				</div>
	    				<div class="col-md-7">
    				
    						<ul class="login_wrap">
    						<?php
                                if(!empty($_SESSION['userid'])){
                                ?>
                                <li><a href="<?php echo site_url('student-registration'); ?>" > Dashboard <i class="fa fa-dashboard"></i>  </a></li>
                                <li><a href="<?php echo site_url('logout'); ?>" > Logout <i class="fa fa-lock"></i>  </a></li>
                                <?php
                                    
                                }else{
                                    
                                
                            ?>
    						
    							<li><a href="#" data-toggle="modal" data-target="#reg-box"> Register <i class="fa fa-user"></i></a></li>
    							<li><a href="#" data-toggle="modal" data-target="#signin-box"> Sign In <i class="fa fa-sign-in"></i></a></li>
    						<?php
                                }
                            ?>
    						</ul>	    					
	    					<ul class="top_nav">
	    					    <li>
	    					        <a href="<?php echo site_url('enrollment-verification/'); ?>">Online Verification <i class="fa fa-file"></i></a>
	    					    </li>
	    					    <li>
	    					        <a href="<?php echo site_url('admin/'); ?>">Branch Login <span class="fa fa-lock"></span></a>
	    					    </li>
	    					    <li>
	    					        <a href="<?php echo site_url('franchise-registration'); ?>" >Branch Enquiry<span class="fa fa-lock"></span></a> 
	    					    </li>
            
	    					   <!--<li> -->
	    						 <!--<a href="<?php echo site_url('enrollment-verification/'); ?>">Online Verification</a></li>-->
	    						
	    					</ul>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
    		<!--kode top bar end-->
<!----------- start header image ----------------------->
        <div id="sidr">
    		<div class="logo_wrap">
    			<a  href="<?php echo site_url(); ?>"><img style="width: 100%;height: 150px;" src="<?php echo base_url('uploads/').@$logo->SS_HOME_BANNER1; ?>" alt=""></a>
    		</div>
    		<div class="clearfix clear"></div>
    	</div>


<!------------ end header image ----------------------->
<!------------ start menu bar --------------------------->
        <div class="kode_navigation">
    			<div id="mobile-header">
                	<a id="responsive-menu-button" href="#sidr-main"><i class="fa fa-bars"></i></a>
                </div>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2">
    						<div class="logo_wrap">
    							<a href="#"><img src="extra-images/logo_2.png" alt=""></a>
    						</div>
    					</div>
    					<div class="col-md-10">
    						<!--kode nav_2 start-->
    						<div class="nav_2" id="navigation">
    							<ul>
    								<li><a href="index.html">home</a></li>
									<li><a href="aboutus.html">About Us</a></li>
		                            <li><a href="#">Event</a>
		                            	<ul>
		                                    <li><a href="our-event.html">our Event</a></li>
		                                    <li><a href="event-list.html">Event List</a></li>
		                                    <li><a href="event-detail.html">Event Detail</a></li>
		                                </ul>
		                            </li>
		                            <li><a href="#">Blog</a>
		                            	<ul>
		                                    <li><a href="our-blog.html">our Blog</a></li>
		                                    <li><a href="blog-2-column.html">blog 2 column</a></li>
		                                    <li><a href="blog-3-column.html">blog 3 column</a></li>
		                                    <li><a href="blog-left-sidebar.html">blog with left sidebar</a></li>
		                                    <li><a href="blog-right-sidebar.html">blog with right sidebar</a></li>
		                                    <li><a href="blog-detail.html">blog-detail</a></li>
		                                </ul>
		                            </li>
		                            <li><a href="#">Course</a>
		                            	<ul>
		                                	<li><a href="our-courses.html">Our Course</a></li>
		                                    <li><a href="courses-list.html">Course List</a></li>
		                                	<li><a href="courses-detail.html">Course Detail</a></li>
		                                </ul>
		                            </li>
		                            <li><a href="#">Teacher</a>
		                            	<ul>
		                                	<li><a href="our-teacher.html">Our Teacher</a></li>
		                                    <li><a href="our-teacher-details.html">our teacher details</a></li>
		                                </ul>
		                            </li>
		                            <li><a href="#">Gallery</a>
		                            	<ul>
		                                	<li><a href="gallery-masonary-2col.html">Masonary 2 Col </a></li>
		                                	<li><a href="gallery-masonary.html">Masonary 3 Col </a></li>
		                                	<li><a href="gallery-masonary-4col.html">Masonary 4 Col </a></li>
		                                    <li><a href="filterable-gallery.html">Simple gallery</a></li>
		                                </ul>
		                            </li>
									<li><a href="#">Pages</a>
		                            	<ul>
		                                    <li><a href="404.html">404 Page</a></li>
		                                </ul>
		                            </li>
									<li><a href="#">Contact US</a>
		                            	<ul>
		                                    <li><a href="contactus.html">Contact Us 1</a></li>
		                                    <li><a href="contactus-2.html">Contact Us 2</a></li>
		                                </ul>
		                            </li>
		                            <li><a id="simple-menu" href="#sidr"><i class="fa fa-bars"></i></a></li>
    							</ul>
    							<!--DL Menu Start-->
					            <div id="kode-responsive-navigation" class="dl-menuwrapper">
					                <button class="dl-trigger">Open Menu</button>
					                <ul class="dl-menu">
										<li><a href="index.html">home</a></li>
										<li><a href="about-us.html">about us</a></li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Event</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                           <li><a href="our-event.html">our Event</a></li>
			                                    <li><a href="event-list.html">Event List</a></li>
			                                    <li><a href="event-detail.html">Event Detail</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Blog</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                            <li><a href="our-blog.html">our Blog</a></li>
			                                    <li><a href="blog-2-column.html">blog 2 column</a></li>
			                                    <li><a href="blog-3-column.html">blog 3 column</a></li>
			                                    <li><a href="blog-left-sidebar.html">blog with left sidebar</a></li>
			                                    <li><a href="blog-right-sidebar.html">blog with right sidebar</a></li>
			                                    <li><a href="blog-detail.html">blog-detail</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Course</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                            <li><a href="our-courses.html">Our Course</a></li>
			                                    <li><a href="courses-list.html">Course List</a></li>
			                                	<li><a href="courses-detail.html">Course Detail</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Teacher</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                            <li><a href="our-teacher.html">Our Teacher</a></li>
			                                    <li><a href="our-teacher-details.html">our teacher details</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Gallery</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                            <li><a href="gallery-masonary-2col.html">Masonary 2 Col </a></li>
			                                	<li><a href="gallery-masonary.html">Masonary 3 Col </a></li>
			                                	<li><a href="gallery-masonary-4col.html">Masonary 4 Col </a></li>
			                                    <li><a href="filterable-gallery.html">Simple gallery</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">404 Page</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                            <li><a href="404.html">404 Page</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Contact US</a>
					                        <ul class="dl-submenu"><li class="dl-back"><a href="#">back</a></li>
					                            <li><a href="contactus.html">Contact Us 1</a></li>
			                                    <li><a href="contactus-2.html">Contact Us 2</a></li>
					                        </ul>
					                    </li>
					                </ul>
					            </div>
					            <!--DL Menu END-->
    						</div>
    						<!--kode nav_2 end-->
    					</div>
    				</div>
    			</div>
    		</div>




<!----------- end menu bar ----------------------------->
        
        
        	
        	
        	
        	
	    	<!--kode navigation start-->
    		<div class="kode_navigation" >
    			<div id="mobile-header">
                	<a id="responsive-menu-button" href="#sidr-main"><i class="fa fa-bars"></i></a>
                </div>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-2">
    						<div class="logo_wrap">
    							<a style="height: 110px;" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('uploads/').@$logo->SS_HEADER_LOGO; ?>" alt=""></a>
    						</div>
    					</div>
    					<div class="col-md-10">
    						<!--kode nav_2 start-->
    						<div class="nav_2" id="navigation">
    							<ul>
    								<li><a href="<?php echo base_url();?>">home</a></li>
									<li><a href="<?php echo base_url('about-us');?>">About Us</a></li>
		                            <li><a href="#">Event</a>
		                            	<ul>
		                                    <li><a href="<?php echo base_url('events');?>">our Event</a></li>
		                                    <!--<li><a href="event-list.html">Event List</a></li>-->
		                                    <!--<li><a href="event-detail.html">Event Detail</a></li>-->
		                                </ul>
		                            </li>
		                            <li><a href="#">Blog</a>
		                            	<ul>
		                                    <li><a href="<?php echo base_url('blogs');?>">our Blog</a></li>
		                                    <!--<li><a href="blog-2-column.html">blog 2 column</a></li>-->
		                                    <!--<li><a href="blog-3-column.html">blog 3 column</a></li>-->
		                                    <!--<li><a href="blog-left-sidebar.html">blog with left sidebar</a></li>-->
		                                    <!--<li><a href="blog-right-sidebar.html">blog with right sidebar</a></li>-->
		                                    <!--<li><a href="blog-detail.html">blog-detail</a></li>-->
		                                </ul>
		                            </li>
		                            <li><a href="#">Course</a>
		                            	<ul>
		                                	<li><a href="<?php echo base_url('our-course');?>">Our Course</a></li>
		                                 <!--   <li><a href="courses-list.html">Course List</a></li>-->
		                                	<!--<li><a href="courses-detail.html">Course Detail</a></li>-->
		                                </ul>
		                            </li>
		                            <li><a href="#">Teacher</a>
		                            	<ul>
		                                	<li><a href="<?php echo base_url('our-teacher');?>">Our Teacher</a></li>
		                                    <!--<li><a href="our-teacher-details.html">our teacher details</a></li>-->
		                                </ul>
		                            </li>
		                            <li><a href="#">Gallery</a>
		                            	<ul>
		                                	<li><a href="<?php echo base_url('gallery');?>">Gallery </a></li>
		                                	<!--<li><a href="gallery-masonary.html">Masonary 3 Col </a></li>-->
		                                	<!--<li><a href="gallery-masonary-4col.html">Masonary 4 Col </a></li>-->
		                                 <!--   <li><a href="filterable-gallery.html">Simple gallery</a></li>-->
		                                </ul>
		                            </li>
									<!--<li><a href="#">Pages</a>-->
		       <!--                     	<ul>-->
		       <!--                             <li><a href="404.html">404 Page</a></li>-->
		       <!--                         </ul>-->
		       <!--                     </li>-->
									<li><a href="#">Contact US</a>
		                            	<ul>
		                                    <li><a href="<?php echo base_url('contact');?>">Contact Us </a></li>
		                                    <!--<li><a href="contactus-2.html">Contact Us 2</a></li>-->
		                                </ul>
		                            </li>
		                       
                                    <?php
                                        if(!empty($_SESSION['userid'])){
                                     ?>
                            		  <li class="dropdown">
                            			  <a href=""> DASHBOARD   </a>
                                            <ul >
                                               
                                                 
                                                <?php
                                                    if(@$_SESSION['type']==4){
                                                    $check=$this->db->get_where('students',['user_id'=>$_SESSION['userid']]);
                                                    if($check->num_rows()>0){
                                                        
                                                    
                                                ?>
                                                <li class="dropdown"> <a href="<?php echo site_url('form-download'); ?>">Print Registration</a></li>
                                                <li class="dropdown"> <a href="<?php echo site_url('student-id'); ?>">Student ID</a></li>
                                                <li class="dropdown"><a href="<?php echo site_url('admit-card'); ?>">Admit Card </a></li>
                                                 <li class="dropdown"><a href="<?php echo site_url('get-result'); ?>">Exam Result </a></li>
                                            <?php 
                                                
                                                $enrollment_no=$check->row('enrollment_no');
                                                $check2=$this->db->get_where('student_certificate',['enrollment_no'=>@$enrollment_no]);
                                                if($check2->num_rows()>0){
                                                    $r=$check2->row();
                                                    $id=$r->certiicate_id;
                                            ?>
                                                 <li class="dropdown"><a href="<?php echo site_url('get-certificate/').$id ?>">Certificate  </a></li>
                                                    <?php
                                                }
                                                    }else{
                                                    ?>
                                                <li class="dropdown"><a href="<?php echo site_url('student-registration'); ?>">Apply Registration </a></li>
                                                  
                                                    <?php
                                                    }
                                                }
                                                ?>
                                                <li><a href="<?php echo site_url('logout'); ?>"> Logout </a></li>
                                            </ul>
                            	        </li>
                            	   <?php
                                        }
                                    ?>
	       
		                            <?php
                                      if(@$_SESSION['type']==4){
                                     ?>
                                     <!--<li> <a href="<?php echo site_url('franchise-registration'); ?>">Franchise Registration</a></li>-->
          
                                    <?php
                                      }
                                    ?>
		                           
    							</ul>
    							<!--DL Menu Start-->
					            <div id="kode-responsive-navigation" class="dl-menuwrapper">
					                <button class="dl-trigger">Open Menu</button>
					                <ul class="dl-menu">
										<li><a href="<?php echo base_url();?>">home</a></li>
									<li><a href="<?php echo base_url('about-us');?>">About Us</a></li>
		                            <li ><a href="<?php echo base_url('events');?>">Event</a>
		                            
		                            </li>
					                    <li class="menu-item kode-parent-menu"><a href="<?php echo base_url('blogs');?>">Blog</a>
					                        
					                    </li>
					                    <li ><a href="<?php echo base_url('our-course');?>">Course</a>
					                      
					                    </li>
					                    <li ><a href="<?php echo base_url('our-teacher');?>">Teacher</a>
					                        
					                    </li>
					                    <li ><a href="<?php echo base_url('gallery');?>">Gallery</a>
					                     
					                    </li>
					                   
					                    <li ><a href="<?php echo base_url('contact');?>">Contact US</a>
					                        
					                    </li>
					                </ul>
					            </div>
					            <!--DL Menu END-->
    						</div>
    						<!--kode nav_2 end-->
    					</div>
    				</div>
    			</div>
    		</div>
    		<!--kode navigation end-->
		</header>
		<!--HEADER END-->