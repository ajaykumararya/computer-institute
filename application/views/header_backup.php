<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="hi">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title><?php echo $title; ?> | UMA GLASS</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
     <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/to-do.css">    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style-responsive.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/chart-master/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/lineicons/style.css">
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend_assets/css/backend.css" type="text/css"> -->
   <style>
.paginate_button {
    padding: 0.5rem 0.95rem;
    margin-left: -1px;
  border: 1px solid lightgrey;
      text-decoration: none!important;

}
.paginate_button.current {
    z-index: 1;
    color: white;
    background: #e20f0f;
    border-color: #e20f0f;
    
}
tr:nth-child(even) {
  background-color: #f2f2f2;
}
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
div::-webkit-scrollbar {
width: 12px;
}
::-webkit-scrollbar {
  width: 8px;   // for vertical scroll bar
  height: 8px;  // for horizontal scroll bar
}
.nicescroll-cursors {
  -webkit-transition: width 0.15s ease-in-out;
  -moz-transition: width 0.15s ease-in-out;
  -ms-transition: width 0.15s ease-in-out;
  -o-transition: width 0.15s ease-in-out;
  transition: width 0.15s ease-in-out;
}
.nicescroll-cursors:hover,
.nicescroll-cursors:active  {
  width: 18px !important;
}
// for Firefox add this class as well
.thin_scroll{
  scrollbar-width: thin; // auto | thin | none | <length>;
}
div::-webkit-scrollbar-track {
-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
border-radius: 10px;
}
</style> 
    <script src="<?php echo base_url(); ?>assets/theme_assets/js/jquery-3.2.1.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/library/sweetalert2.all.js"></script>
    
   <script>
    var get_loc='<?php echo base_url(); ?>get_ajax/';
    var post_loc='<?php echo base_url(); ?>post_ajax/';
    var base_loc='<?php echo base_url(); ?>admin/';
    var branch_loc='<?php echo base_url(); ?>branch/';
    var js_loc='<?php echo base_url(); ?>/assets/';    
    var loginid='<?php echo $this->session->userdata('loginid'); ?>';
    var token='<?php echo $this->session->userdata('token'); ?>';
    var type='<?php echo $this->session->userdata('type'); ?>';
    var crsftoken='<?php echo $this->security->get_csrf_token_name(); ?>';
    var crsfharsh='<?php echo $this->security->get_csrf_hash(); ?>';
    var stage = '<?php echo $this->uri->segment(3); ?>';
    var projecttempid = '<?php echo $this->uri->segment(3); ?>';
    var is_active  = '<?php echo $this->session->userdata('is_active'); ?>';
   
   //alert(type);

    </script>
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/backend.js"></script>
    
    

    
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg no-print">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="logo"><b>DASHBOARD</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <!-- <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <!-- <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="index.html#">See all messages</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout logoutside" href="javascript:void(0);" >Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
       <aside class="no-print">
          <div id="sidebar"  class="nav-collapse no-print ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                 <!--  <p class="centered"><a href="profile.html"><img  src="<?php echo base_url(); ?>assets/img/LOGO-1.jpg" class="img" width="60"></a></p> -->
                  <!-- <h5 class="centered">UMA GLASS</h5> -->
                    
                   
                  <li class="mt">
                      <a class="<?php if($linkactive=="dashboard") { echo " active"; } ?>" href="<?php echo site_url('admin/dashboard'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>

                      </a>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_size" || $linkactive=="create_user") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>MASTER SETTING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_size" ) { echo " active"; } ?>">
                            <a  href="<?php echo site_url('admin/create_size'); ?>"><i class="fa fa-angle-right"></i> CREATE SIZE
                            
                            </a>
                            
                          </li>
                         
                         <li class="<?php if($linkactive=="create_user") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_user'); ?>"><i class="fa fa-angle-right"></i> CREATE USER </a></li>
                      </ul>
                  </li>
                   <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_shipping" || $linkactive=="list_shipping") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>SHIPPING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_shipping" ) { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_shipping'); ?>"><i class="fa fa-angle-right"></i> CREATE SHIPPING</a></li>
                         
                         <li class="<?php if($linkactive=="shipping_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/shipping_list'); ?>"><i class="fa fa-angle-right"></i> SHIPPING LIST </a></li>

                         <li class="<?php if($linkactive=="shipping_status") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/shipping_status'); ?>"><i class="fa fa-angle-right"></i> SHIPPING STATUS </a></li>
                      </ul>
                  </li>
                   <!-- <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_export" || $linkactive=="create_user") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>EXPORT</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_size" ) { echo " active"; } ?>">
                            <a  href="<?php echo site_url('admin/create_size'); ?>"><i class="fa fa-angle-right"></i> CREATE EXPORT
                            
                            </a>
                            
                          </li>
                         
                         <li class="<?php if($linkactive=="create_user") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_user'); ?>"><i class="fa fa-angle-right"></i> LIST EXPORT </a></li>
                      </ul>
                  </li> -->
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_courier" || $linkactive=="list_courier") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>COURIER</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_courier" ) { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_courier'); ?>"><i class="fa fa-angle-right"></i> CREATE COURIER</a></li>
                         
                         <li class="<?php if($linkactive=="courier_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/courier_list'); ?>"><i class="fa fa-angle-right"></i> COURIER LIST </a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_labour" || $linkactive=="labour_attendance" || $linkactive=="labour_report") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>LABOUR</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_labour" ) { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_labour'); ?>"><i class="fa fa-angle-right"></i> CREATE LABOUR</a>
                          </li>
                         
                         <li class="<?php if($linkactive=="labour_attendance") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/labour_attendance'); ?>"><i class="fa fa-angle-right"></i> ATTENDANCE </a></li>

                         <li class="<?php if($linkactive=="labour_report") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/labour_report'); ?>"><i class="fa fa-angle-right"></i> REPORT </a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                    <a class="<?php if($linkactive=="blower_list" || $linkactive=="factory_list" || $linkactive=="adda_list" || $linkactive=="adda_factory_report" || $linkactive=="adda_blower_report") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span> ADDA</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          
                          <li class="<?php if($linkactive=="blower_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/blower_list/'); ?>"><i class="fa fa-angle-right"></i> Blower List </a></li>
                          <li class="<?php if($linkactive=="factory_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/factory_list'); ?>"><i class="fa fa-angle-right"></i> Factory List </a></li>
                          <li class="<?php if($linkactive=="adda_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/adda_list'); ?>"><i class="fa fa-angle-right"></i> Received List </a></li>
                          <li class="<?php if($linkactive=="adda_factory_report") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/adda_factory_report'); ?>"><i class="fa fa-angle-right"></i> Factory Report </a></li>
                          <li class="<?php if($linkactive=="adda_blower_report") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/adda_blower_report'); ?>"><i class="fa fa-angle-right"></i> Blower Report </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="die_order_complete_list" || $linkactive=="die_report_list" || $linkactive=="create_die_order" || $linkactive=="assign_die_order" || $linkactive=="die_list" || $linkactive=="purchase_die") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>DIE PURCHASE</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="purchase_die") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/purchase_die'); ?>"><i class="fa fa-angle-right"></i> Purchase Die</a></li>

                          <li class="<?php if($linkactive=="create_die_order") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_die_order'); ?>"><i class="fa fa-angle-right"></i> Create Die Order </a></li>

                          <li class="<?php if($linkactive=="die_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/die_list'); ?>"><i class="fa fa-angle-right"></i>  Die List </a></li>
                          <li class="<?php if($linkactive=="assign_die_order") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/assign_die_order'); ?>"><i class="fa fa-angle-right"></i> Pending Order </a></li>
                          <li class="<?php if($linkactive=="die_order_complete_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/die_order_complete_list'); ?>"><i class="fa fa-angle-right"></i> Order Completed</a></li>
                          <li class="<?php if($linkactive=="die_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/die_report_list'); ?>"><i class="fa fa-angle-right"></i> Report </a></li>
                          <li class="<?php if($linkactive=="outwards_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/outwards_report_list'); ?>"><i class="fa fa-angle-right"></i>Outwards Report </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_sample_project" || $linkactive=="list_sample_project" || $linkactive=="project_sample_completed" || $linkactive=="project_sample_cancelled") { echo " active"; } ?>"  href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>SAMPLING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_sample_project") { echo " active"; } ?>"><a  href="<?php echo ''.site_url('admin/create_sample_project/').time().''; ?>">Create Project</a></li>
                          <li class="<?php if($linkactive=="list_sample_project") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/list_sample_project'); ?>">Project List</a></li>
                          <li class="<?php if($linkactive=="project_completed") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/project_sample_completed'); ?>">Project Completed</a></li>
                          <li class="<?php if($linkactive=="project_sample_cancelled") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/project_sample_cancelled'); ?>">Cancelled Project</a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="purchase_sample" || $linkactive=="purchase_stock" || $linkactive=="sampling_out") { echo " active"; } ?>"  href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>PURCHASE SAMPLING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                         
                          <li class="<?php if($linkactive=="purchase_sample") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/purchase_sample'); ?>">Purchase Sample</a></li>
                          <li class="<?php if($linkactive=="purchase_stock") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/purchase_stock'); ?>">Purchase Stock</a></li>
                          <li class="<?php if($linkactive=="sampling_out") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/sampling_out'); ?>">Sampling Out</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_project" || $linkactive=="list_project" || $linkactive=="project_completed" || $linkactive=="project_cancelled") { echo " active"; } ?>"  href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>PROJECT</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_project") { echo " active"; } ?>"><a  href="<?php echo ''.site_url('admin/create_project/').time().''; ?>">Create Project</a></li>
                          <li class="<?php if($linkactive=="list_project") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/list_project'); ?>">Project List</a></li>
                          <li class="<?php if($linkactive=="project_completed") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/project_completed'); ?>">Project Completed</a></li>
                          <li class="<?php if($linkactive=="project_cancelled") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/project_cancelled'); ?>">Project Cancelled</a></li>
                      </ul>
                  </li>

                 
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="create_thekedar" || $linkactive=="list_thekedar") { echo " active"; } ?>"  href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span>THEKEDAR</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="create_thekedar") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/create_thekedar'); ?>">Create Thekedar</a></li>
                          <li class="<?php if($linkactive=="list_thekedar") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/list_thekedar'); ?>">Thekedar List</a></li>
                         
                      </ul>
                  </li>
                   <li class="sub-menu">
                      <a class="<?php if($linkactive=="stock" || $linkactive=="stock_die") { echo " active"; } ?>"  href="javascript:;" >
                          <i class="fa fa-bar-chart-o"></i>
                          <span>STOCK</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="stock") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/stock '); ?>">Project Wise</a></li>
                          <li class="<?php if($linkactive=="stock_die") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/stock_die'); ?>">Die Wise</a></li>
                         
                      </ul>
                  </li>
                   
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="production_order_list" || $linkactive=="production_report_list" ) { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span> PRODUCTION</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                              
                          <li class="<?php if($linkactive=="production_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/production_order_list'); ?>"><i class="fa fa-angle-right"></i> Order List </a></li>
                          <li class="<?php if($linkactive=="production_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/production_report_list'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="chakka_order_list" || $linkactive=="chakka_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span> CHAKKA </span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="chakka_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/chakka_order_list/2'); ?>"><i class="fa fa-angle-right"></i> Order List </a></li>
                          <li class="<?php if($linkactive=="chakka_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/chakka_report_list/2'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="grinding_order_list" || $linkactive=="grinding_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span> GRINDING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          
                          <li class="<?php if($linkactive=="grinding_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/grinding_order_list/3'); ?>"><i class="fa fa-angle-right"></i> Order List </a></li>
                          <li class="<?php if($linkactive=="grinding_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/grinding_report_list/3'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="polish_order_list" || $linkactive=="polish_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span> POLISH</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="polish_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/polish_order_list/4'); ?>"><i class="fa fa-angle-right"></i> Order List </a></li>
                          <li class="<?php if($linkactive=="polish_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/polish_report_list/4'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="sorting_order_list" || $linkactive=="sorting_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span> SHORTING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="sorting_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/sorting_order_list/5'); ?>"><i class="fa fa-angle-right"></i> Order List </a></li>
                          <li class="<?php if($linkactive=="sorting_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/sorting_report_list/5'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="coloring_order_list" || $linkactive=="coloring_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span> COLORING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="coloring_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/coloring_order_list/6'); ?>"><i class="fa fa-angle-right"></i> Order List </a></li>
                          <li class="<?php if($linkactive=="coloring_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/coloring_report_list/6'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="silver_order_list" || $linkactive=="silver_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span> SILVER</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="silver_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/silver_order_list/7'); ?>"><i class="fa fa-angle-right"></i>Pending Order List </a></li>
                          <li class="<?php if($linkactive=="silver_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/silver_report_list/7'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="send_cutting_order" || $linkactive=="cutting_order_list" || $linkactive=="cutting_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span> CUTTING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="cutting_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/cutting_order_list/9'); ?>"><i class="fa fa-angle-right"></i> Pending Order List </a></li>
                          <li class="<?php if($linkactive=="cutting_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/cutting_report_list/9'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>

                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="send_paking_order" || $linkactive=="packing_order_list" || $linkactive=="packing_report_list") { echo " active"; } ?>" href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span> PACKING</span>
                          <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li class="<?php if($linkactive=="packing_order_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/packing_order_list/8'); ?>"><i class="fa fa-angle-right"></i> Pending Order List </a></li>
                          <li class="<?php if($linkactive=="packing_report_list") { echo " active"; } ?>"><a  href="<?php echo site_url('admin/packing_report_list/8'); ?>"><i class="fa fa-angle-right"></i> Report List </a></li>
                         
                      </ul>
                  </li>
                  
                  
                  
                  <li class="sub-menu">
                      <a class="<?php if($linkactive=="comp_profile" || $linkactive=="update_password") { echo " active"; } ?>" href="javascript:;" >
                            <i class="fa fa-setting"> SETTING </i>
                            
                            <i class="fa fa-arrow-down pull-right"></i>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo site_url('admin/dashboard'); ?>">Company Profile</a></li>
                          <li><a  href="<?php echo site_url('admin/update_password'); ?>" class="nav-link ">Update <i class="fa fa-<?php if($linkactive=="update_password") { echo "arrow-left blink_me"; } ?> pull-right bbtn btn-primary btn-xs"></i></a></li>
                          
                      </ul>
                  </li>
                  <li class="sub">
                      <a class="<?php if($linkactive=="activity") { echo " active"; } ?>" href="<?php echo site_url('admin/activity'); ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>ACTIVITY HISTORY</span>
                      </a>
                  </li>
                  <li class="sub">
                      <a  href="javascript:;">
                          <i class="fa fa-dashboard logoutside"></i>
                          <span>LOGOUT</span>
                      </a>
                  </li>
                   <li class="mt">
                      <div id="google_translate_element"></div>
                    </li>
                  

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
           <section class="wrapper site-min-height">
            <h3 class=" no-print"><i class="fa fa-angle-right"></i> <?php echo $title; ?></h3>
            <div class="row mt scroll-up">
              <div class="col-lg-12">
            
     <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en' }, 'google_translate_element');
        }
    </script>
     <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
     <style>
        .goog-te-gadget .goog-te-combo {
            margin: 4px 0;
            margin-bottom: 12px;
            font-family: "Roboto", sans-serif;
        }
        #google_translate_element {
            float: left;
            margin-top: -5px;
            margin-right: 10px;
            height: 29px;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .goog-te-gadget span{
            display:none !Important;
        }
        #google_translate_element{
            float:unset !important;
            margin-top: 4px;
            margin-right:0px !important;
        }
        .goog-te-combo{
            height:25px;
            margin: 0px 0 !important;
        }
        @media only screen and (max-width: 768px) {
          .cent {
            text-align: center !important;
          }
        }
        .p1-0 {
            padding: 0;
        }
        .navbar-nav a{
            margin: 5px !important;
            padding: 15px !important;
        }
    </style>

<style>
@media print{
   .noprint{
       display:none;
       border-left: 1px solid white;
   }  
    div {
        border: solid white !important;
        
        border-left: 1px solid white;
        
    }
   .scroll-left{
    margin-left: -250px;

   }
   .scroll-up{
    margin-top: -100px;
   }
}
.blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
</style>        

      
    