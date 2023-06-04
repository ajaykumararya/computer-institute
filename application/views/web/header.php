
<!DOCTYPE html>
<html lang="en">
	

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
	<link href="<?php echo base_url('webassets/'); ?>css/bootstrap.min.css" rel="stylesheet">
	<!-- Full Calender CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/fullcalendar.css" rel="stylesheet">
	<!-- Owl Carousel CSS -->
	
	<!-- Pretty Photo CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/prettyPhoto.css" rel="stylesheet">
	<!-- Bx-Slider StyleSheet CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/jquery.bxslider.css" rel="stylesheet"> 
	<!-- Font Awesome StyleSheet CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/font-awesome.min.css" rel="stylesheet">
    <!-- DL Menu CSS -->
    <link href="<?php echo base_url('webassets/'); ?>js/dl-menu/component.css" rel="stylesheet">
	<link href="<?php echo base_url('webassets/'); ?>svg/style.css" rel="stylesheet">
	<!-- Widget CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/widget.css" rel="stylesheet">
	<!-- Typography CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/typography.css" rel="stylesheet">
	<!-- Shortcodes CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
	<link href="<?php echo base_url('webassets/'); ?>style.css" rel="stylesheet">
	<!-- Color CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/color.css" rel="stylesheet">
	<!-- Responsive CSS -->
	<link href="<?php echo base_url('webassets/'); ?>css/responsive.css" rel="stylesheet">
	<!-- SELECT MENU -
	<link href="<?php //echo base_url('webassets/'); ?>css/selectric.css" rel="stylesheet">
	<!-- SIDE MENU -->
	<link rel="stylesheet" href="<?php echo base_url('webassets/'); ?>css/jquery.sidr.dark.css">
	
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
    .icon-bar{
        z-index:99999;
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
                        <form id="register-form" >
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
                    <h2>Login</h2>
                    <!--FORM FIELD START-->
                    <div class="form">
                    <form id="login_web" >
                        <div class="input-container">
                            <input type="text" placeholder="Mobile No." name="user_id">
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
    
    
    <!----
	<div id="sidr">
		<div class="logo_wrap">
			<a href="#"><img src="<?php //echo base_url('uploads/').@$logo->SS_HEADER_LOGO; ?>" alt=""></a>
		</div>
		<div class="clearfix clear"></div>
		
		<div class="kf-sidebar">
			
			<div class="widget widget-archive ">
				<h2>IMPORTANT LINKS</h2>
				<ul class="sidebar_archive_des">
					
					<?php 
                       // $links=$this->db->get('important_link');
                        // foreach($links->result() as $row){
                    ?>
					<li><a href="<?php //echo $row->LINK_URL;?>"><?php //echo $row->LINK_NAME;?></a></li>
					<?php
                        // }
					?>
					
				</ul>
			</div>
		

			
		</div>
	</div>
	---->
	
	
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
                            <li>
    					        <a href="<?php echo site_url('enrollment-verification/'); ?>">Online Verification <i class="fa fa-file"></i></a>
    					    </li>
    						</ul>	    					
	    					<ul class="top_nav">
	    					    
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


    <!----------- start header image ----------------------->
        <div >
    		<div class="logo_wrap">
    			<a  href="<?php echo site_url(); ?>">
    			    <img id="logo_wrap_image" style="width: 100%;" src="<?php echo base_url('uploads/').@$logo->SS_HOME_BANNER1; ?>" alt="">
    			</a>
    		</div>
    		<div class="clearfix clear"></div>
    	</div>


<!------------ end header image ----------------------->        
<style>
    #logo_wrap_image{
        height: 225px;
    }
    @media (max-width: 600px) {
    	#logo_wrap_image{
    		height: 80px;
    	}
    }
</style>        	
        	
        	
        	
	    	<!--kode navigation start-->
    		<div class="kode_navigation">
    			<div id="mobile-header">
                	<a id="responsive-menu-button" href="#sidr-main"><i class="fa fa-bars"></i></a>
                </div>
    			<div class="container" style="width:100%;">
    				<div class="row">
    					<div class="col-md-2" >
    						<div class="logo_wrap">
    							<a href="<?php  echo site_url(); ?>">
    							    <img id="logo_wrap"  src="<?php echo base_url('uploads/').@$logo->SS_HEADER_LOGO; ?>" alt="">
    							</a>
    						</div>
    					</div>
    					<div class="col-md-10" style="padding: 23px;">
    						<!--kode nav_2 start-->
    						<div class="nav_2" id="navigation">
    							<ul>
    								<li> <a href="<?php echo site_url(); ?>">Home </a></li>
                                    <?php echo $menu_ul; ?>
		                            
		                            
		                            
    							</ul>
    							<!--DL Menu Start-->
					            <div id="kode-responsive-navigation" class="dl-menuwrapper">
					                <button class="dl-trigger">Open Menu</button>
					                <ul class="dl-menu">
										<?php //echo $menu_ul; ?>
										<?php
										$menu = $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `parent_id` = 0 order by position asc ")->result();
										foreach($menu as $menu_list){
										    
										       
										    $count_parent =    $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `parent_id` = '".$menu_list->id."' ")->num_rows();
										    if($count_parent > 0){
										        $parent =    $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `parent_id` = '".$menu_list->id."' order by position asc ")->result();
										        
										        $menu='';
										        
										        foreach($parent as $parent_list){
										            $menu.= '<li><a href="'.str_replace("&","and",$parent_list->ext_url_link).'">'.$parent_list->menu.'</a></li>';
										        }
										        
										        echo '
    										            <li class="menu-item kode-parent-menu"><a href="'.str_replace("&","and",$menu_list->ext_url_link).'">'.$menu_list->menu.'</a>
                					                        <ul class="dl-submenu">
                					                           '.$menu.'
                					                        </ul>
                					                    </li>
										        ';
										    }else{
										        echo '<li><a href="'.str_replace("&","and",$menu_list->ext_url_link).'">'.$menu_list->menu.'</a></li>';
										    }     
										       
										       
										        
										    
										}
										
										?>
										
										
					                    <!---
					                    <li class="menu-item kode-parent-menu"><a href="#">Blog</a>
					                        <ul class="dl-submenu">
					                            <li><a href="our-blog.html">our Blog</a></li>
			                                    <li><a href="blog-2-column.html">blog 2 column</a></li>
			                                    <li><a href="blog-3-column.html">blog 3 column</a></li>
			                                    <li><a href="blog-left-sidebar.html">blog with left sidebar</a></li>
			                                    <li><a href="blog-right-sidebar.html">blog with right sidebar</a></li>
			                                    <li><a href="blog-detail.html">blog-detail</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Course</a>
					                        <ul class="dl-submenu">
					                            <li><a href="our-courses.html">Our Course</a></li>
			                                    <li><a href="courses-list.html">Course List</a></li>
			                                	<li><a href="courses-detail.html">Course Detail</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Teacher</a>
					                        <ul class="dl-submenu">
					                            <li><a href="our-teacher.html">Our Teacher</a></li>
			                                    <li><a href="our-teacher-details.html">our teacher details</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Gallery</a>
					                        <ul class="dl-submenu">
					                            <li><a href="gallery-masonary-2col.html">Masonary 2 Col </a></li>
			                                	<li><a href="gallery-masonary.html">Masonary 3 Col </a></li>
			                                	<li><a href="gallery-masonary-4col.html">Masonary 4 Col </a></li>
			                                    <li><a href="filterable-gallery.html">Simple gallery</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">404 Page</a>
					                        <ul class="dl-submenu">
					                            <li><a href="404.html">404 Page</a></li>
					                        </ul>
					                    </li>
					                    <li class="menu-item kode-parent-menu"><a href="#">Contact US</a>
					                        <ul class="dl-submenu">
					                            <li><a href="contactus.html">Contact Us 1</a></li>
			                                    <li><a href="contactus-2.html">Contact Us 2</a></li>
					                        </ul>
					                    </li>
					                   ---> 
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

<style>
    /* 
 * 	Core Owl Carousel CSS File
 *	v1.3.3
 */

/* clearfix */

.kf_edu2_heading2{
    background:linear-gradient(45deg, #4a12a5, transparent);
}
.kode_navigation{
    border-top: 1px solid;
}

.owl-carousel .owl-wrapper:after {
	content: ".";
	display: block;
	clear: both;
	visibility: hidden;
	line-height: 0;
	height: 0;
}
/* display none until init */
.owl-carousel{
	display: none;
	position: relative;
	width: 100%;
	-ms-touch-action: pan-y;
	float:left;
}
.owl-carousel .owl-wrapper{
	display: none;
	position: relative;
	-webkit-transform: translate3d(0px, 0px, 0px);
}
.owl-carousel .owl-wrapper-outer{
	overflow: hidden;
	position: relative;
	width: 100%;
	height:300px;
}
.owl-carousel .owl-wrapper-outer.autoHeight{
	-webkit-transition: height 500ms ease-in-out;
	-moz-transition: height 500ms ease-in-out;
	-ms-transition: height 500ms ease-in-out;
	-o-transition: height 500ms ease-in-out;
	transition: height 500ms ease-in-out;
}
	
.owl-carousel .owl-item{
	float: left;
}
.owl-controls .owl-page,
.owl-controls .owl-buttons div{
	cursor: pointer;
}
.owl-controls {
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
	-webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}

/* mouse grab icon */
.grabbing { 
    cursor:url(grabbing.html) 8 8, move;
}

/* fix */
.owl-carousel  .owl-wrapper,
.owl-carousel  .owl-item{
	-webkit-backface-visibility: hidden;
	-moz-backface-visibility:    hidden;
	-ms-backface-visibility:     hidden;
  -webkit-transform: translate3d(0,0,0);
  -moz-transform: translate3d(0,0,0);
  -ms-transform: translate3d(0,0,0);
}


/*	Owl Carouse Control Style*/

.owl-theme .owl-controls{
	margin-top: 0px;
	text-align: center;
}

/* Styling Next and Prev buttons */

.owl-theme .owl-controls .owl-buttons div{
	color: #FFF;
	display: inline-block;
	zoom: 1;
	*display: inline;/*IE7 life-saver */
	margin: 5px;
	padding: 3px 10px;
	font-size: 12px;
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;
	background: #869791;
	filter: Alpha(Opacity=50);/*IE7 fix*/
	opacity: 0.5;
}
/* Clickable class fix problem with hover on touch devices */
/* Use it for non-touch hover action */
.owl-theme .owl-controls.clickable .owl-buttons div:hover{
	filter: Alpha(Opacity=100);/*IE7 fix*/
	opacity: 1;
	text-decoration: none;
}

/* Styling Pagination*/

.owl-theme .owl-controls .owl-page{
	display: inline-block;
	zoom: 1;
	*display: inline;/*IE7 life-saver */
}
.owl-theme .owl-controls .owl-page span{
    background: #333333; 
    border-radius: 0;
    display: block;
    height: 5px;
    margin: 0 4px;
    width: 30px;
}

/* If PaginationNumbers is true */

.owl-theme .owl-controls .owl-page span.owl-numbers{
	height: auto;
	width: auto;
	color: #FFF;
	padding: 2px 10px;
	font-size: 12px;
	-webkit-border-radius: 30px;
	-moz-border-radius: 30px;
	border-radius: 30px;
}

/* preloading images */
.owl-item.loading{
	min-height: 150px;
	background: url(AjaxLoader.html) no-repeat center center
}


.dl-menu.dl-subview li.dl-subview,
.dl-menu.dl-subview li.dl-subview .dl-submenu,
.dl-menu.dl-subview li.dl-subviewopen,
.dl-menu.dl-subview li.dl-subviewopen > .dl-submenu,
.dl-menu.dl-subview li.dl-subviewopen > .dl-submenu > li {
	display: block;
	background:black;
}
.nav_2 ul li a{
	display: block;
	color: #ffffff;
	font-size: 14px;
	text-transform:uppercase;
	font-weight: bold;
	padding:10px  10px;
	position: relative;
	z-index: 2;
}
.nav_2 ul li:hover > ul {
    opacity: 1;
    top: 100%;
    visibility: visible;
    background: cornflowerblue;
}
.sidr {
	display: none;
	position: fixed;
	top: 0;
	height: 100%;
	z-index: 999999;
	width: 350px;
	overflow-x: none;
	overflow-y: auto;
	font-size: 15px;
	background: #e79800;
	color: #fff;
	padding:30px;
}    
.nav_2{
	float: left;
	width: 100%;
	background:<?php echo $header_2nd->CS_COLOR;  ?>;
	padding:0px;
}
.dl-menuwrapper ul{
	background-color:<?php echo $header_2nd->CS_COLOR;  ?>;

}
.dl-menu.dl-subview li.dl-subview, .dl-menu.dl-subview li.dl-subview .dl-submenu, .dl-menu.dl-subview li.dl-subviewopen, .dl-menu.dl-subview li.dl-subviewopen > .dl-submenu, .dl-menu.dl-subview li.dl-subviewopen > .dl-submenu > li {
    display: block;
    background: <?php echo $header_2nd->CS_COLOR;  ?>;
}
.nav_2 .dl-menuwrapper button{
	margin-top:11px;
}

#logo_wrap{
    height:100px;
}

@media (max-width: 600px) {
	#logo_wrap{
		 height: 72px;
	}
}

.kf_cur_catg_des.color-1:hover {
	background-color: burlywood;
}


</style>
