<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

<?php
$logo=$this->db->get('site_setting')->row();
$profile=$this->db->get('profile')->row();
?>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

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


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-starter.css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/reset.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/fonts.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/magnific-popup.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/iconmoon.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('websitecss/'); ?>assets/css/custom.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url('websitecss/'); ?>assets/css/simple.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://jainsanskriti.com/webasset/vendor/owl.carousel.css">
<link rel="stylesheet" href="https://jainsanskriti.com/webasset/vendor/owl.theme.css">


<script type="text/javascript" src="https://jainsanskriti.com/webassets/js/ba-owl.carousel.js"></script>
<script type="text/javascript" src="https://jainsanskriti.com/webassets/js/bb-wow.min.js"></script>
<script type="text/javascript" src="https://jainsanskriti.com/webassets/js/bd-jquery.lazy.min.js"></script>
<script type="text/javascript" src="https://jainsanskriti.com/webassets/js/be-mmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/matchHeight-min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/counterup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/magnific-popup.min.html"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/modernizr.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>assets/js/custom.js"></script>
<script type="text/javascript" src="https://jainsanskriti.com/webassets/resources/fancybox/bc-jquery.fancybox.min.js"></script>

<script src="<?php echo base_url('websitecss/'); ?>ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.html"></script>
<script type="text/javascript" src="<?php echo base_url('websitecss/'); ?>js/jquery.marquee.html"></script>

        
    
</head>

<body>
    <!-- top header -->



<header> 
  <!-- Start Header top Bar -->
  <div class="header-top" style="background-color:#FB0000;">
    <div class="container clearfix">
      <ul class="follow-us hidden-xs">
          <?php 
            $profile=$this->db->get('profile')->row();
          ?>
        <li><a href="<?php echo @$profile->twitter?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="<?php echo @$profile->facebook?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
        <li><a href="<?php echo @$profile->google?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
        <li><a href="<?php echo @$profile->youtube?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
      </ul>
      <div class="right-block clearfix">
      	<a href="<?php echo site_url('enrollment-verification/'); ?>" class="login1">Online Verification <span class="fa fa-search-minus "></span></a>
        <a href="<?php echo site_url('admin/'); ?>" class="login1">Branch Login <span class="fa fa-lock"></span></a>
        <a href="<?php echo site_url('franchise-registration'); ?>" class="login1">Branch Enquiry<span class="fa fa-lock"></span></a>
        <a href="#" class="login1">Student Enquiry<span class="fa fa-lock"></span></a>
      </div>
    </div>
  </div>
  <!-- End Header top Bar --> 
  <!-- Start Header Middle -->

<div class="container header-middle" style="padding-top:0px">
    <div class="row"  style="padding-top:0px">
        <?php 
        $logo=$this->db->get('site_setting')->row();
        ?>
    <span class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('uploads/').@$logo->SS_HEADER_LOGO; ?>" class="img-responsive" alt=""></a>
        </span>
    
    </div>
  </div>
  <!-- End Header Middle --> 
  <!-- Start Navigation -->

  
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="nav navbar-nav">
          <li> <a href="<?php echo site_url(); ?>">Home </a></li>
          
         
          <?php echo $menu_ul; ?>
          
        <?php
            if(empty($_SESSION['userid'])){
         ?>
        
        <li class="dropdown">
		    <a href="">LOGIN/SIGNUP </a>
            <ul class="dropdown-menu" style="display: none;">
                
                <li class="dropdown"> <a href="<?php echo site_url('signup'); ?>">Signup</a></li>
                <li class="dropdown"> <a href="<?php echo site_url('login'); ?>">Login</a></li>
            </ul>
		</li>
        <?php
            }else{
        ?>
            <li class="dropdown">
			    <a href=""> DASHBOARD   </a>
                <ul class="dropdown-menu" style="right: auto; display: none;">
                   
                     
                    <?php
                   
                    
                    
                    if(@$_SESSION['type']==4){
                        $check=$this->db->get_where('students',['user_id'=>$_SESSION['userid']])->num_rows();
                        if($check>0){
                            
                        
                        ?>
                    <li class="dropdown"> <a href="<?php echo site_url('form-download'); ?>">Print Registration</a></li>
                    <li class="dropdown"> <a href="<?php echo site_url('student-id'); ?>">Student ID</a></li>
                        <?php
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
            if(@$_SESSION['type']==5){
          ?>
          <li> <a href="<?php echo site_url('franchise-registration'); ?>">Franchise Registration</a></li>
          
          <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navigation --> 
  
  
  
  
  
  <!-- End Navigation --> 
  
  
  
  
  <!-- End Navigation --> 
</header>

<!-- End Header -->





<style>
    .inner-banner2.blog{
        
        min-height:156px;
        padding:30px 0;
        background: url(<?php echo base_url('img/') ?>inner-banner-bg.jpg) no-repeat center top / cover;

        
    }
    .LogoBg{
        background:url(<?php echo base_url('img/') ?>tp-logo.jpg) top center no-repeat #fff;
    }
</style>









































<script src="<?php echo base_url(); ?>" type="text/javascript"></script>


<script>

    var get_loc='<?php echo base_url(); ?>get_ajax/';

    var post_loc='<?php echo base_url(); ?>post_ajax/';
     var payment='<?php echo base_url(); ?>razorpay/';
    var site_loc='<?php echo base_url(); ?>welcome/';
    var post_url = '<?php echo base_url(); ?>';
    

    var js_loc='<?php echo base_url(); ?>/assets/';    

     var post_web='<?php echo base_url(); ?>post_ajax/';
     var web_loc='<?php echo base_url(); ?>web_ajax/';
   

   //alert(type);



    </script>

        
        <div id="wrapper" class="clearfix">


            

<style>
    .menuzord-menu > li > a {
    padding: 8px 12px;
    border-radius: 30px;
}




</style>

<?php 
$header_top_color = $this->db->get_where('color_setting',['CS_ID'=>1])->row();
$header_2nd = $this->db->get_where('color_setting',['CS_ID'=>2])->row();
$header_3nd = $this->db->get_where('color_setting',['CS_ID'=>3])->row();
$header_4nd = $this->db->get_where('color_setting',['CS_ID'=>4])->row();
$header_5nd = $this->db->get_where('color_setting',['CS_ID'=>5])->row();
?>
<style>
    .bg-theme-colored2{
        background-color:<?php echo $header_top_color->CS_CODE;  ?>;
    }
    .text-header-top-color{
        color:<?php echo $header_top_color->CS_COLOR; ?>;
    }
    .bg-theme-header2{
        background-color:<?php echo $header_2nd->CS_CODE;  ?>;
    }
    .text-header2-color{
        color:<?php echo $header_2nd->CS_COLOR; ?>;
    }
    .bg-theme-header3{
        background-color:<?php echo $header_3nd->CS_CODE;  ?>;
    }
    .text-header3-color{
        color:<?php echo $header_3nd->CS_COLOR; ?>;
    }
    
    .bg-theme-header3-background{
        background-color:<?php echo $header_4nd->CS_CODE;  ?>;
    }
    .text-header3-color{
        color:<?php echo $header_4nd->CS_COLOR; ?>;
    }
    .menuzord-menu > li > a {
      color: <?php echo $header_3nd->CS_COLOR; ?>;
      font-size: 13px;
      background-color:<?php echo $header_3nd->CS_CODE;  ?>;
    }
    
    @media only screen and (max-width: 600px) {
      body {
       // background-color: lightblue;
      }
    }
    
    
    
    .marquee li a {
        color: <?php echo $header_4nd->CS_COLOR; ?>;
        font-size: 20px;
    }
    
</style>
<style>
    .menuzord .menuzord-menu > li.active > a, .menuzord .menuzord-menu > li:hover > a, .menuzord .menuzord-menu ul.dropdown li:hover > a {
    background: <?php echo $header_3nd->CS_BACKGROUN_HOVER;  ?>;
    border-radius: 0px;
    color: <?php echo $header_3nd->CS_FONT_HOVER; ?>;
}
</style>

