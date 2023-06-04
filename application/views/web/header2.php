<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

<script src="{{webcss/css/utility-classes.css)}}" defer></script>



<?php
$logo=$this->db->get('site_setting')->row();
$profile=$this->db->get('profile')->row();
?>

<!-- Meta Tags -->
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<meta name="description" content="Welcome to GGSRDN" />
<meta name="keywords" content="Welcome to GGSRDN" />
<meta name="author" content="GGSRDN" />

<!-- Page Title -->
<title> <?php echo $title; ?></title>

<!-- Favicon and Touch Icons -->
<link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="shortcut icon" type="image/png">
<link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon">
<link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon" sizes="72x72">
<link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon" sizes="114x114">
<link href="<?php echo base_url('uploads/'.@$logo->SS_FAVICON); ?>" rel="apple-touch-icon" sizes="144x144">

<!-- Stylesheet -->
<link href="<?php echo base_url(); ?>webcss/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>webcss/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>webcss/css/animate.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>webcss/css/css-plugin-collections.css" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link href="<?php echo base_url(); ?>webcss/css/menuzord-megamenu.css" rel="stylesheet"/>
<link id="menuzord-menu-skins" href="<?php echo base_url(); ?>webcss/css/menuzord-skins/menuzord-rounded-boxed.css" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="<?php echo base_url(); ?>webcss/css/style-main.css" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="<?php echo base_url(); ?>webcss/css/preloader.css" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="<?php echo base_url(); ?>webcss/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="<?php echo base_url(); ?>webcss/css/responsive.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>webcss/css/custom.css" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="<?php //echo base_url(); ?>webcss/css/style.css" rel="stylesheet" type="text/css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Revolution Slider 5.x CSS settings -->
<link  href="<?php echo base_url(); ?>webcss/js/revolution-slider/css/settings.css" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url(); ?>webcss/js/revolution-slider/css/layers.css" rel="stylesheet" type="text/css"/>
<link  href="<?php echo base_url(); ?>webcss/js/revolution-slider/css/navigation.css" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="<?php echo base_url(); ?>webcss/css/colors/theme-skin-color-set1.css" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="<?php echo base_url(); ?>webcss/js/jquery-2.2.4.min.js"></script>
<script src="<?php echo base_url(); ?>webcss/js/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>webcss/js/bootstrap.min.js"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="<?php echo base_url(); ?>webcss/js/jquery-plugin-collection.js"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="<?php echo base_url(); ?>webcss/js/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url(); ?>webcss/js/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="<?php echo base_url(); ?>webcss/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="<?php echo base_url(); ?>webcss/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->



<!-- custom css -->
<link href="<?php echo base_url(); ?>webcss/css/custom.css" rel="Stylesheet" type="text/css" />
<script>
document.onkeydown = function(e) {
    if (e.ctrlKey && e.keyCode === 85) {
      return false;
    }
  };
    /** TO DISABLE SCREEN CAPTURE **/
document.addEventListener('keyup', (e) => {
    if (e.key == 'PrintScreen') {
        navigator.clipboard.writeText('');
       // alert('Screenshots disabled!');
    }
});

/** TO DISABLE PRINTS WHIT CTRL+P **/
document.addEventListener('keydown', (e) => {
    if (e.ctrlKey && e.key == 'p') {
       // alert('This section is not allowed to print or export to PDF');
        e.cancelBubble = true;
        e.preventDefault();
        e.stopImmediatePropagation();
    }
});

/*
function click (e) {
  if (!e)
    e = window.event;
  if ((e.type && e.type == "contextmenu") || (e.button && e.button == 2) || (e.which && e.which == 3)) {
    if (window.opera)
      window.alert("");
    return false;
  }
}
if (document.layers)
  document.captureEvents(Event.MOUSEDOWN);
document.onmousedown = click;
document.oncontextmenu = click;
*/

</script>
    <style>
    @media print {
        html, body {
           display: none;  /* hide whole page */
        }
    }
        .owl-nav {
            display: none;
        }

        .newticker {
            background: red;
        }

            .newticker li {
                float: left;
                display: inline;
                color: white;
            }

        .newticker li a {
            color: white;
            font-size: 20px;
        }
        
        
                
                
    </style>
    
</head>

<body class="">

    

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['ctl00'];
if (!theForm) {
    theForm = document.ctl00;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<script src="<?php echo base_url(); ?>" type="text/javascript"></script>


<script src="<?php echo base_url(); ?>" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function WebForm_OnSubmit() {
if (typeof(ValidatorOnSubmit) == "function" && ValidatorOnSubmit() == false) return false;
return true;
}
//]]>
</script>
<script>

    var get_loc='<?php echo base_url(); ?>get_ajax/';

    var post_loc='<?php echo base_url(); ?>post_ajax/';
    var payment='<?php echo base_url(); ?>razorpay/';

    var site_loc='<?php echo base_url(); ?>welcome/';

    

    var js_loc='<?php echo base_url(); ?>/assets/';    

     var post_web='<?php echo base_url(); ?>post_ajax/';
     var web_loc='<?php echo base_url(); ?>web_ajax/';
   

   //alert(type);



    </script>

<div>

  <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="CA0B0334" />
</div>
        
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
<header id="header" class="header">
    <div class="header-top  sm-text-center" style="background:<?php echo $header_top_color->CS_CODE; ?>;color:<?php echo $header_top_color->CS_COLOR; ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-3 ">
                    <div class="widget text-white">
                        <ul class="list-inline xs-text-center text-white">
                            
                            <li class="m-0 pl-10 pr-10">
                                <a class="text-header-top-color"><i class="fa fa-envelope-o mr-5"></i><?php echo $profile->ORG_EMAIL;?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <ul class="list-inline sm-pull-none sm-text-center text-right text-header-top-color mb-sm-20 mt-10">

                    
                         <?php
                        if(isset($_SESSION['userid'])){
                           ?>
                           <li class="m-0 pl-10 text-header-top-color"> <a href="<?php echo site_url('logout'); ?>"    >LOG OUT
                            </a>  </li>
                           <?php
                        }else{
                         ?>
                         
                         
                      <li class="m-0 pl-10 text-header-top-color">  <a href="javasctipt:void(0);" class="text-header-top-color" data-toggle="modal" data-target="#customer_login"   > <i class="fa fa-user mr-5" ></i> LOGIN/SIGUP| 
                           </a>  </li>
                           
                        <?php
                        }
                        if($profile->APP_URL!= ''){
                         ?>
                          <li class="m-0 pl-10 text-header-top-color">  <a href="<?php echo $profile->APP_URL; ?>" class="text-header-top-color"  > <i class="fa fa-download mr-5" ></i> DOWNLOAD APP 
                           </a>  </li>
                         <?php
                        }
                        ?>
                       
                       
                       
<!---

                        <li class="m-0 pl-10"><a href="<?php echo base_url(); ?>" target="_blank" class="text-white-green"><i class="fa fa-graduation-cap mr-5"></i>Alumni |</a> </li>
                        <li class="m-0 pl-0 pr-10">
                            <a href="<?php echo base_url(); ?>" target="_blank" class="text-white-green"><i class="fa fa-user mr-5"></i>Student Login |</a>
                        </li>
                        
                        <li class="m-0 pl-0 pr-10">
                            <a href="<?php echo base_url(); ?>"  class="text-white-green"><i class="fa fa-file-text-o mr-5"></i>Apply for Migration |</a>
                        </li>
                         <li class="m-0 pl-0 pr-10">

                            <a href="<?php echo base_url(); ?>"class="text-white-green"><span class="blinking-white"><i class="fa fa-file-text-o mr-5"></i>MD MS and MDS Admissions</span> </a>
                        </li>
                        <li class="m-0 pl-0 pr-10">
                            <a href="<?php echo base_url(); ?>" class="text-white-green"><span class="blinking-white"><i class="fa fa-file-text-o mr-5"></i>Vacancies </span> </a>
                        </li>
                      <li class="m-0 pl-0 pr-10">
                            <a href="<?php echo base_url(); ?>"  class="text-white-green" target="_blank">| <i class="fa fa-file-text-o mr-5"></i>Journal </a>
                        </li>

---->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle p-0 bg-theme-header2 xs-text-center">
        <div class="container pt-0 pb-0">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 pt-10 pb-10">
                    <a class="menuzord-brand pull-left flip sm-pull-center" href="<?php echo base_url();?>">
                        <img src="<?php echo base_url('uploads/').$logo->SS_HEADER_LOGO; ?>" alt=""></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 pt-20 pb-20">
                    <div class="row">
                        
                        <div class="col-xs-12 col-sm-5 col-md-4 col-xs-6">
                            <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                            <!--
                                <i class="pe-7s-headphones text-theme-colored2 font-48 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                                <a class="font-12 text-gray text-uppercase "><span class="blinking"> Enquiry</span></a>
                                <h5 class="font-13 text-black m-0"><?php echo $profile->ORG_PHONE;?></h5>
                                
                                <a href="<?php //echo base_url(); ?>webcss/http://administration.adeshuniversity.ac.in/Assets/pdf/Disclaimer AU.pdf" target="_blank"><i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                    Disclaimer</a>
                                -->     
                            </div>
                             
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3 col-xs-6">
                            
                            <div class="widget no-border sm-text-center mt-10 mb-10 m-0">
                            <!--
                                <i class="fa fa-mobile text-theme-colored2 font-48 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                                <a class="font-12 text-gray text-uppercase">Mobile  </a>
                                <h5 class="font-13 text-black m-0"><?php //echo $profile->ORG_PHONE;?> </h5>
                            -->
                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-5 col-xs-12">
                            <div class="widget no-border sm-text-center mt-10 mb-10 m-0"> 
                                <i class="fa fa fa-headphones text-header2-color font-48 mt-0 mr-15 mr-sm-0 sm-display-block pull-left flip sm-pull-none"></i>
                                <a class="font-12 text-header2-color text-uppercase"><span class="blinking text-header2-color"> Enquiry</span></a>
                                <h5 class="font-13 text-header2-color m-0">Mobile: <?php echo $profile->ORG_PHONE;?><br />
                                    Whats App:<?php echo $profile->ORG_ALT_PHONE;?> </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .indicator{
            visibility:hidden;
        }
    </style>
    
    
    <div class="header-nav">
        <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-header3">
            <div class="container">
                <nav id="menuzord" class="menuzord default menuzord-responsive bg-theme-header3">
                    <ul class="menuzord-menu">
                        
                        <li class="active"><a href="<?php echo site_url(); ?>">Home</a>
                        </li>
                        <li class=""><a href="">FRANCHIESE</a>
                             <ul class="dropdown">
                                    <li><a href="<?php echo site_url('welcome/franchisee_registration'); ?>"> FRANCHISE REGISTRATION ONLINE</a></li>
                                    <li><a href="<?php echo site_url(); ?>"> COMPUTER CENTER LIST</a></li>
                                    <li><a href="<?php echo site_url('welcome/center_login'); ?>"> CENTER LOGIN</a></li>
                            </ul>
                        </li>
                          
                        <li class=""><a href="">STUDENT</a>
                             <ul class="dropdown">
                                    <li><a href="<?php echo site_url('welcome/student_form'); ?>"> Student Registration</a></li>
                                    <!--<li><a href="<?php echo site_url(); ?>"> COMPUTER CENTER LIST</a></li>-->
                                    <!--<li><a href="<?php echo site_url('welcome/center_login'); ?>"> CENTER LOGIN</a></li>-->
                            </ul>
                        </li>
                        <?php
                        // die('hello');
                        $menu =$this->db->query(" SELECT * FROM `menu` where MENU_STATUS=0 ORDER BY MENU_ORDER ASC ")->result();
                        // echo "<pre>";
                        // print_r($menu);
                        // die;
                        if (!empty($menu)) {
                        foreach ($menu as  $row) {
                        $id=$row->id;
                        $checkURl = $this->db->query("SELECT count(*) as count FROM submenu WHERE menu = '".$id."' AND MENU_STATUS=0")->result();             
                        $flag = false;
                        if ($checkURl[0]->count <= 0) {
                            $menu_url = $this->db->query("SELECT * FROM `link_page` WHERE menu='".$id."' and submenu=0")->row();
                            $flag = true;
                            if (@$menu_url->has_url != 0) {
                                $url = @$menu_url->url_address;
                            } else if(@$menu_url->pagename != 0) {
                                $url = base_url('page-name/') . @$menu_url->pagename;
                            } else {
                                $url = ''.site_url().'';
                            }
                        } else {
                            $flag = false;
                            $url = ''.site_url().'';
                        }
                       
                     ?>
                        <li><a href="<?php if($flag) echo $url; else echo ''.site_url().''; ?>"><?php echo $row->menu_name; ?></a>
                            <ul class="dropdown">
                              <?php
                              $submenu=   $this->db->query("SELECT link_page.has_url, link_page.url_address, link_page.pagename,link_page.subsubmenu as subsub_id, submenu.id as submenu_id, submenu.submenu as submenu_name FROM link_page INNER JOIN submenu on submenu.id = link_page.submenu WHERE link_page.menu ='".$id."'")->result();
                                    // echo "<pre>";
                                    // print_r($id);
                                    // die;
                                if(!empty($submenu)) {
                                  foreach ($submenu as $row1) {
                                  $submenuid=$row1->submenu_id;
                                //   echo "<pre>";
                                //   print_r($row1->subsub_id == 0);
                                    //   die;
                                    if ($row1->has_url == 1 && $row1->subsub_id == 0) {
                                        $url = $row1->url_address;
                                    } else if($row1->pagename != 0 && $row1->subsub_id == 0) {
                                        $url = base_url('page-name/') . $row1->pagename;
                                    } else {
                                        $url = ''.site_url().'';
                                    }
                                 ?>
                                <li><a href="<?php echo $url; ?>"><?php echo $row1->submenu_name; ?></a>
                                <?php if ($row1->subsub_id != 0) { ?>
                                    <ul class="dropdown">
                                    <?php
                     $subsubmenu=   $this->db->query("SELECT link_page.has_url, link_page.url_address, link_page.pagename,subsubmenu.id as subsub_id, subsubmenu.subsubmenu as  subsubmenu_name FROM link_page LEFT JOIN subsubmenu on subsubmenu.id = link_page.subsubmenu WHERE link_page.menu = '".$id."' and                       link_page.submenu='".$submenuid."'")->result();
                                    if (!empty($subsubmenu)) {
                                        // print_r($subsubmenu);
                                    foreach ($subsubmenu as $row2) {
                                    if (@$row2->has_url == 1 ) {
                                        $url = $row2->url_address;
                                    } else if(@$row2->pagename != 0 ) {
                                        $url = base_url('page-name/') . @$row2->pagename;
                                    } else {
                                        $url = ''.site_url().'';
                                    }

                                 ?>
                                <li><a href="<?php echo @$url; ?>"><?php echo @$row2->subsubmenu_name; ?></a>
                                <?php } }?>
                                    
                                    </ul>
                                <?php } ?>
                                </li>
                             
                             
                               
                            <?php } } ?>
                            </ul>
                        </li>
                      
                    <?php } } ?>
                    <!--
                    <li><a href="<?php echo site_url('product-listing'); ?>">PRODUCTS</a></li>
                   
                    <li><a href="<?php echo site_url('cart-list'); ?>">CART LIST </a></li>
                    -->
                    <?php
                    if(isset($_SESSION['userid'])){
                    ?>
                    <li><a href="<?php echo site_url('download-history'); ?>">DOWNLOAD HISTORY </a></li>
                    <?php
                    }
                    
                   $fixed_menu =  $this->db->get_where('fixed_menu',['FM_STATUS'=>1])->result();
                    foreach($fixed_menu as $fixed_menu_list){
                    ?>
                    <li><a href="<?php echo site_url($fixed_menu_list->PAGE_URL); ?>"><?php echo  $fixed_menu_list->FM_NAME; ?> </a></li>
                    <?php
                    }
                    ?>
                    
                    
                    
                    
                    
                    
                    </ul>
                    <!--
                    <div class="pull-right sm-pull-none mb-sm-15">
                       
                        
                    </div>
                    --->    
                </nav>
            </div>
        </div>
    </div>
</header>


<div id="customer_login" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">STUDENT LOGIN</h4>
      </div>
      <form id="login_web">
        <div class="modal-body">
            <div class="panel-body form-horizontal">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 ">Email Id</label>
                        <div class="col-sm-8">
                             <input name="user_id" type="text" id="txtName" class="form-control" required="required">
                              <span id="RequiredFieldValidator7" style="color:Red;display:none;">Required</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 "> Whats App No. </label>
                        <div class="col-sm-8">
                            <input name="password" type="text" id="txtRegistrationNo" class="form-control" required="required">
                            <span id="RequiredFieldValidator12" style="color:Red;display:none;">Required</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer">
       <a href="<?php echo base_url('member-registration'); ?>"> <button type="button" class="btn btn-success pull-left" > SIGN UP </button></a>
        <button type="submit" class="btn btn-success" > Login </button>
      </div>
      </form>
    </div>

  </div>
</div>


