<?php
$profile=$this->db->get('profile')->row();
$logo=$this->db->get('site_setting')->row();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-rtl.min.css" />
    <script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
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
    </style>
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
   <!--  <script src="<?php echo base_url(); ?>assets/backend_assets/js/backend.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/get.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/post.js"></script>
 -->
  </head>



    <body class="no-skin">
    <div id="navbar" class="navbar navbar-default          ace-save-state">
      <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header pull-left">
          <a href="<?php echo site_url('admin');  ?>" class="navbar-brand">
            <small>
              <i class="fa fa-user"></i>
              <?php echo $profile->ORG_NAME; ?>
            </small>
          </a>
        </div>
        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav">
            <li class="grey dropdown-modal">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-tasks"></i>
                <span class="badge badge-grey">4</span>
              </a>
              <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                  <i class="ace-icon fa fa-check"></i>
                  4 Tasks to complete
                </li>
                <li class="dropdown-content">
                  <ul class="dropdown-menu dropdown-navbar">
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Software Update</span>
                          <span class="pull-right">65%</span>
                        </div>
                        <div class="progress progress-mini">
                          <div style="width:65%" class="progress-bar"></div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Hardware Upgrade</span>
                          <span class="pull-right">35%</span>
                        </div>
                        <div class="progress progress-mini">
                          <div style="width:35%" class="progress-bar progress-bar-danger"></div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Unit Testing</span>
                          <span class="pull-right">15%</span>
                        </div>
                        <div class="progress progress-mini">
                          <div style="width:15%" class="progress-bar progress-bar-warning"></div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">Bug Fixes</span>
                          <span class="pull-right">90%</span>
                        </div>
                        <div class="progress progress-mini progress-striped active">
                          <div style="width:90%" class="progress-bar progress-bar-success"></div>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown-footer">
                  <a href="#">
                    See tasks with details
                    <i class="ace-icon fa fa-arrow-right"></i>
                  </a>
                </li>
              </ul>
            </li>
            <li class="purple dropdown-modal">
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                <span class="badge badge-important">8</span>
              </a>
              <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
                <li class="dropdown-header">
                  <i class="ace-icon fa fa-exclamation-triangle"></i>
                  8 Notifications
                </li>
                <li class="dropdown-content">
                  <ul class="dropdown-menu dropdown-navbar navbar-pink">
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">
                            <i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
                            New Comments
                          </span>
                          <span class="pull-right badge badge-info">+12</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="btn btn-xs btn-primary fa fa-user"></i>
                        Bob just signed up as an editor ...
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">
                            <i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
                            New Orders
                          </span>
                          <span class="pull-right badge badge-success">+8</span>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="clearfix">
                          <span class="pull-left">
                            <i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
                            Followers
                          </span>
                          <span class="pull-right badge badge-info">+11</span>
                        </div>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="dropdown-footer">

                  <a href="#">

                    See all notifications

                    <i class="ace-icon fa fa-arrow-right"></i>

                  </a>

                </li>

              </ul>

            </li>



            <li class="green dropdown-modal">

              <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>

                <span class="badge badge-success">5</span>

              </a>



              <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">

                <li class="dropdown-header">

                  <i class="ace-icon fa fa-envelope-o"></i>

                  5 Messages

                </li>



                <li class="dropdown-content">

                  <ul class="dropdown-menu dropdown-navbar">

                    <li>

                      <a href="#" class="clearfix">

                        <img src="assets/images/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />

                        <span class="msg-body">

                          <span class="msg-title">

                            <span class="blue">Alex:</span>

                            Ciao sociis natoque penatibus et auctor ...

                          </span>



                          <span class="msg-time">

                            <i class="ace-icon fa fa-clock-o"></i>

                            <span>a moment ago</span>

                          </span>

                        </span>

                      </a>

                    </li>



                    <li>

                      <a href="#" class="clearfix">

                        <img src="assets/images/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />

                        <span class="msg-body">

                          <span class="msg-title">

                            <span class="blue">Susan:</span>

                            Vestibulum id ligula porta felis euismod ...

                          </span>



                          <span class="msg-time">

                            <i class="ace-icon fa fa-clock-o"></i>

                            <span>20 minutes ago</span>

                          </span>

                        </span>

                      </a>

                    </li>



                    <li>

                      <a href="#" class="clearfix">

                        <img src="assets/images/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />

                        <span class="msg-body">

                          <span class="msg-title">

                            <span class="blue">Bob:</span>

                            Nullam quis risus eget urna mollis ornare ...

                          </span>



                          <span class="msg-time">

                            <i class="ace-icon fa fa-clock-o"></i>

                            <span>3:15 pm</span>

                          </span>

                        </span>

                      </a>

                    </li>



                    <li>

                      <a href="#" class="clearfix">

                        <img src="assets/images/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />

                        <span class="msg-body">

                          <span class="msg-title">

                            <span class="blue">Kate:</span>

                            Ciao sociis natoque eget urna mollis ornare ...

                          </span>



                          <span class="msg-time">

                            <i class="ace-icon fa fa-clock-o"></i>

                            <span>1:33 pm</span>

                          </span>

                        </span>

                      </a>

                    </li>



                    <li>

                      <a href="#" class="clearfix">

                        <img src="assets/images/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />

                        <span class="msg-body">

                          <span class="msg-title">

                            <span class="blue">Fred:</span>

                            Vestibulum id penatibus et auctor  ...

                          </span>



                          <span class="msg-time">

                            <i class="ace-icon fa fa-clock-o"></i>

                            <span>10:09 am</span>

                          </span>

                        </span>

                      </a>

                    </li>

                  </ul>

                </li>



                <li class="dropdown-footer">

                  <a href="inbox.html">

                    See all messages

                    <i class="ace-icon fa fa-arrow-right"></i>

                  </a>

                </li>

              </ul>

            </li>



            <li class="light-blue dropdown-modal">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                <img class="nav-user-photo" src="<?php echo base_url('uploads/').$logo->SS_HEADER_LOGO; ?>" alt="<?php echo $profile->ORG_NAME; ?>" />
                <span class="user-info">
                  <small>Welcome,</small>
                  <?php echo $profile->ORG_NAME; ?>
                </span>
                <i class="ace-icon fa fa-caret-down"></i>
              </a>
              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
                  <a href="#">
                    <i class="ace-icon fa fa-cog"></i>
                    Settings
                  </a>
                </li>
                <li>
                  <a href="profile.html">
                    <i class="ace-icon fa fa-user"></i>
                    Profile
                  </a>
                </li>
                <li class="divider"></li>
                <li>
                  <a href="#">
                    <i class="ace-icon fa fa-power-off"></i>
                    Logout
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- /.navbar-container -->
    </div>

    <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">

        try{ace.settings.loadState('main-container')}catch(e){}

      </script>



      <div id="sidebar" class="sidebar responsive ace-save-state">

        <script type="text/javascript">

          try{ace.settings.loadState('sidebar')}catch(e){}

        </script>



        <div class="sidebar-shortcuts" id="sidebar-shortcuts">

          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">

            <button class="btn btn-success">

              <i class="ace-icon fa fa-signal"></i>

            </button>



            <button class="btn btn-info">

              <i class="ace-icon fa fa-pencil"></i>

            </button>



            <button class="btn btn-warning">

              <i class="ace-icon fa fa-users"></i>

            </button>



            <button class="btn btn-danger">

              <i class="ace-icon fa fa-cogs"></i>

            </button>

          </div>



          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">

            <span class="btn btn-success"></span>



            <span class="btn btn-info"></span>



            <span class="btn btn-warning"></span>



            <span class="btn btn-danger"></span>

          </div>

        </div><!-- /.sidebar-shortcuts -->



        <ul class="nav nav-list">
            <li class="">
                <a href="<?php echo site_url('dashboard'); ?>">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>
                <b class="arrow"></b>
            </li>
            <li class="">
                <a href="<?php echo site_url(); ?>" target="_blank">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Click To Website </span>
                </a>
                <b class="arrow"></b>
            </li>
            <!--
            <li class="">
                <a href="<?php echo site_url('admin/new_orders');  ?>">
                  <i class="menu-icon fa fa-users"></i>
                 NEW USER REGIS. <span class="badge badge-grey"><?php //echo  count_orders_by_status(0); ?></span>
                </a>
    
                <b class="arrow"></b>
            </li>
            -->
             <li class="">
                <a href="<?php echo site_url('admin/new_users');  ?>">
                  <i class="menu-icon fa fa-users"></i>
                 NEW USER REGIS. <span class="badge badge-grey"><?php //echo  count_orders_by_status(0); ?></span>
                </a>
    
                <b class="arrow"></b>
            </li>
           
           
           <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                 BANNER
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
              <li class="">
                <a href="<?php echo site_url('admin/add_banner');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                 ADD BANNER
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/list_banner');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  LIST BANNER
                </a>

                <b class="arrow"></b>
              </li>
              
            </ul>
          </li>
          
          
            <?php
            if(get_title_name('brands')->BACK_END_SHOW_HIDE == 0){
            ?>
            <li class="<?php  if(@$linkactive== 'create_brands' || @$linkactive=='list_brands'){ echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                <?php 
                //print_r(get_title_name('brands'));
                echo  get_title_name('brands')->BACK_END_TITLE; 
                
                ?>
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php  if(@$linkactive== 'create_brands' || @$linkactive=='list_brands'){ echo 'active'; } ?>">
              <li class="">
                <a href="<?php echo site_url('admin/brands');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  ADD- <?php echo  get_title_name('brands')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
            
              <li class="">
                <a href="<?php echo site_url('admin/list_brands');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  LIST- <?php echo  get_title_name('brands')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
              
            </ul>
          </li> 
            <?php
            }
            ?>
            <?php
            if(get_title_name('category')->BACK_END_SHOW_HIDE == 0){
            ?>
          <li class="<?php  if(@$linkactive== 'create_category' || @$linkactive=='list_category'){ echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-cube"></i>
              <span class="menu-text">
                <?php echo  get_title_name('category')->BACK_END_TITLE; ?>
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu" <?php  if(@$linkactive== 'create_category' || @$linkactive=='list_category'){ echo 'active'; } ?> >
              <li class="">
                <a href="<?php echo site_url('admin/category');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  ADD- <?php echo  get_title_name('category')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/list_category');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  LIST- <?php echo  get_title_name('category')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
              
            </ul>
          </li>
          <?php
            }
            ?>
            <?php
            if(get_title_name('sub_category')->BACK_END_SHOW_HIDE == 0){
            ?>
          <li class="<?php  if(@$linkactive== 'list_sub_category' || @$linkactive=='sub_category'){ echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-cube"></i>
              <span class="menu-text">
                <?php echo  get_title_name('sub_category')->BACK_END_TITLE; ?>
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php  if(@$linkactive== 'list_sub_category' || @$linkactive=='sub_category'){ echo 'active'; } ?>" >
              <li class="">
                <a href="<?php echo site_url('admin/sub_category');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                ADD <?php echo  get_title_name('sub_category')->BACK_END_TITLE; ?>
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/list_sub_category');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  LIST <?php echo  get_title_name('sub_category')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
              
            </ul>
          </li>  
          <?php
            }
            ?>
            <?php
            if(get_title_name('product')->BACK_END_SHOW_HIDE == 0){
            ?>
          <li class="<?php  if(@$linkactive== 'list_product' || @$linkactive=='create_product'){ echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-cube"></i>
              <span class="menu-text">
                <?php echo  get_title_name('product')->BACK_END_TITLE; ?>
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php  if($linkactive== 'list_product' || $linkactive=='create_product'){ echo 'open'; } ?>">
              <li class="">
                <a href="<?php echo site_url('admin/product');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  ADD <?php echo  get_title_name('product')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/list_product');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  LIST <?php echo  get_title_name('product')->BACK_END_TITLE; ?>
                </a>

                <b class="arrow"></b>
              </li>
              
            </ul>
          </li>
          <?php
            }
            ?>
          <!-- <li class="">
            <a href="<?php echo site_url('user/labour');  ?>">
              <i class="menu-icon fa fa-user"></i>
              LABOUR
            </a>
            <b class="arrow"></b>
          </li> -->
         
		  <?php
            if(get_title_name('whyus')->BACK_END_SHOW_HIDE == 0){
            ?>
		  <li class="<?php if($linkactive == 'whyus'){echo 'active'; } ?>">
            <a href="<?php echo site_url('admin/whyus'); ?>" >
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                <?php echo  get_title_name('whyus')->BACK_END_TITLE; ?>
              </span>
            </a>
          </li>
          <li class="<?php if($linkactive == 'enquiry_list'){echo 'active'; } ?>">
            <a href="<?php echo site_url('admin/contact_form_list'); ?>" >
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                <?php echo  get_title_name('contact_form_list')->BACK_END_TITLE; ?>
              </span>
            </a>
          </li>
            <?php
            }
            ?>
            <?php
            if(get_title_name('our_causes')->BACK_END_SHOW_HIDE == 0){
            ?>
    		  <li class="<?php if($linkactive == 'our_causes'){echo 'active'; } ?>">
                <a href="<?php echo site_url('admin/our_causes'); ?>" >
                  <i class="menu-icon fa fa-user"></i>
                  <span class="menu-text">
                    <?php echo  get_title_name('our_causes')->BACK_END_TITLE; ?>
                  </span>
                </a>
              </li>
              
            <?php
            }
            ?>
            
            
		   <li class="<?php if($linkactive == 'member'){echo 'active'; } ?>">
            <a href="<?php echo site_url('admin/member'); ?>" >
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                MEMBER 
              </span>
            </a>
          </li>
             <li class="<?php if($linkactive == 'create_result' || $linkactive == 'get_result'){echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                 RESULT
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php if($linkactive == 'create_result' || $linkactive == 'get_result'){echo 'active'; } ?>">
              <li class="">
                <a href="<?php echo site_url('admin/create_result'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  CREATE RESULT
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/get_result'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  GET RESULT
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
        </li>
           <li class="<?php if($linkactive == 'menu' || $linkactive == 'fixed_menu'){echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                MENU
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php if($linkactive == 'menu' || $linkactive == 'fixed_menu' ){echo 'active'; } ?>">
                <li class="">
                    <a href="<?php echo site_url('admin/menu'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        ADD MENU
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('admin/list_menu'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        LIST MENU
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('admin/list_sub_menu'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        LIST SUB MENU
                    </a>
                    <b class="arrow"></b>
                </li>
                <!--
                <li class="">
                    <a href="<?php //echo site_url('admin/list_sub_sub_menu'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        LIST SUB SUB MENU
                    </a>
                    <b class="arrow"></b>
                </li>
                -->
                <li class="">
                    <a href="<?php echo site_url('admin/fixed_menu'); ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        FIXED PAGES
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('admin/page');  ?>">
                    <i class="menu-icon fa fa-caret-right"></i>
                     ADD PAGE
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('admin/page_list');  ?>">
                    <i class="menu-icon fa fa-caret-right"></i>
                     PAGE LIST
                    </a>
                    <b class="arrow"></b>
                </li>


              <li class="">

                <a href="<?php echo site_url('admin/slider_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                LIST SLIDER

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
		 
          <li class="<?php if($linkactive == 'slider_details' || $linkactive == 'slider_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                SLIDER

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'slider_details' || $linkactive == 'slider_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/slider_details'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  ADD SLIDER

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/slider_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                LIST SLIDER

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <!--add-vedio-->
          
           <li class="<?php if($linkactive == 'add_vedio' || $linkactive == 'list_vedio'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                VEDIO

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'add_vedio' || $linkactive == 'list_vedio'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/add_vedio'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  ADD VEDIO

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/list_vedio');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                LIST VEDIO

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            if(get_title_name('our_services')->BACK_END_SHOW_HIDE == 0){
            ?>
		   <li class=" <?php if($linkactive == 'our_services' || $linkactive == 'list_service'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('our_services')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'our_services' || $linkactive == 'list_service'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/our_services'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                   <?php echo  get_title_name('our_services')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/list_service');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('our_services')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
          }
          ?>
          <?php
            if(get_title_name('news')->BACK_END_SHOW_HIDE == 0){
            ?>
          <li class="<?php if($linkactive == 'news' || $linkactive == 'news_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('news')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'news' || $linkactive == 'news_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/news'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  <?php echo  get_title_name('news')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/news_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('news')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
        <!--
        <li class="">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                NOTICE BOARD

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu">

              <li class="">

                <a href="<?php echo site_url('admin/notice_board'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  NOTICE BOARD

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/notice_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                NOTICE LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
         --->
         <?php
            if(get_title_name('latest_news')->BACK_END_SHOW_HIDE == 0){
            ?>
		    <li class="<?php if($linkactive == 'latest_news' || $linkactive == 'latest_news_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('latest_news')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'latest_news' || $linkactive == 'latest_news_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/latest_news'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  <?php echo  get_title_name('latest_news')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/latest_news_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('latest_news')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
        <?php
            if(get_title_name('admission_notice')->BACK_END_SHOW_HIDE == 0){
            ?>
            
            <li class="<?php if($linkactive == 'admission_notice' || $linkactive == 'admission_notice_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('admission_notice')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'admission_notice' || $linkactive == 'admission_notice_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/admission_notice'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  <?php echo  get_title_name('admission_notice')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/admission_notice_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

               <?php echo  get_title_name('admission_notice')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
            <?php
            if(get_title_name('advance_notice')->BACK_END_SHOW_HIDE == 0){
            ?>
          <li class="<?php if($linkactive == 'advance_notice' || $linkactive == 'advance_notice_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('advance_notice')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'advance_notice' || $linkactive == 'advance_notice_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/advance_notice'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                 <?php echo  get_title_name('advance_notice')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>
            <?php
            }
            ?>
            <?php
            if(get_title_name('advance_notice')->BACK_END_SHOW_HIDE == 0){
            ?>
              <li class="">

                <a href="<?php echo site_url('admin/advance_notice_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('advance_notice')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
            <?php
            if(get_title_name('information_board')->BACK_END_SHOW_HIDE == 0){
            ?>
           <li class="<?php if($linkactive == 'information_board' || $linkactive == 'information_board_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('information_board')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'information_board' || $linkactive == 'information_board_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/information_board'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                 <?php echo  get_title_name('information_board')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/information_board_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('information_board')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
            <?php
            if(get_title_name('our_branches')->BACK_END_SHOW_HIDE == 0){
            ?>    
          <li class="<?php if($linkactive == 'our_branches' || $linkactive == 'our_branches_list'){echo 'open'; } ?>">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('our_branches')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu <?php if($linkactive == 'our_branches' || $linkactive == 'our_branches_list'){echo 'active'; } ?>">

              <li class="">

                <a href="<?php echo site_url('admin/our_branches'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                 <?php echo  get_title_name('our_branches')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/our_branches_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('our_branches')->BACK_END_TITLE; ?>  LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
        <?php
        }
        ?>
    
           <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                SETTING
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
                <li class="">
                    <a href="<?php echo site_url('admin/profile'); ?>">
                      <i class="menu-icon fa fa-caret-right"></i>
                      PROFILE
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('admin/site_setting');  ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        SITE SETTING
                    </a>
                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?php echo site_url('admin/color_setting');  ?>">
                        <i class="menu-icon fa fa-caret-right"></i>
                        COLOR SETTING
                    </a>
                    <b class="arrow"></b>
                </li>
            </ul>
          </li>
          
        
        <li class="<?php if($linkactive=="blog" || $linkactive=="blog_list") { echo " open"; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                <?php //echo  get_title_name('event_list')->BACK_END_TITLE; ?> BLOG
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php if($linkactive=="blog" || $linkactive=="blog_list") { echo " active"; } ?>">
              <li class="">
                <a href="<?php echo site_url('admin/blog/1'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <?php //echo  get_title_name('event_list')->BACK_END_TITLE; ?> ADD BLOG
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/blog_list');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                BLOG LIST
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
          </li>
        
        
          <?php
        if(get_title_name('event_list')->BACK_END_SHOW_HIDE == 0){
        ?>
        <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                <?php echo  get_title_name('event_list')->BACK_END_TITLE; ?>
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
              <li class="">
                <a href="<?php echo site_url('admin/blog/2'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <?php echo  get_title_name('event_list')->BACK_END_TITLE; ?>
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/event_list');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                EVENT LIST
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
          </li>
          <?php
            }
            ?>
          
          <?php
            if(get_title_name('examination_list')->BACK_END_SHOW_HIDE == 0){
            ?>
           <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                <?php echo  get_title_name('examination_list')->BACK_END_TITLE; ?>
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
              <li class="">
                <a href="<?php echo site_url('admin/blog/4'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  <?php echo  get_title_name('examination_list')->BACK_END_TITLE; ?>
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/examination_list');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                <?php echo  get_title_name('examination_list')->BACK_END_TITLE; ?> LIST
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
          </li>
          <?php
            }
            ?>
            <?php
            if(get_title_name('our_branches')->BACK_END_SHOW_HIDE == 0){
            ?>    
           <li class="">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('add_list')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu">

              <li class="">

                <a href="<?php echo site_url('admin/blog/5'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('add_list')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/add_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('add_list')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
            <?php
            if(get_title_name('student_corner_list')->BACK_END_SHOW_HIDE == 0){
            ?>
           <li class="">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                <?php echo  get_title_name('student_corner_list')->BACK_END_TITLE; ?>

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu">

              <li class="">

                <a href="<?php echo site_url('admin/blog/6'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  <?php echo  get_title_name('student_corner_list')->BACK_END_TITLE; ?>

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/student_corner_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                <?php echo  get_title_name('student_corner_list')->BACK_END_TITLE; ?> LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>
          <?php
            }
            ?>
          <li class="">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

                GALLERY

              </span>



              <b class="arrow fa fa-angle-down"></b>

            </a>

            <b class="arrow"></b>

            <ul class="submenu">

              <li class="">

                <a href="<?php echo site_url('admin/blog/3'); ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                  OUR GALLERY

                </a>



                <b class="arrow"></b>

              </li>

              <li class="">

                <a href="<?php echo site_url('admin/gallery_list');  ?>">

                  <i class="menu-icon fa fa-caret-right"></i>

                GALLERY LIST

                </a>

                <b class="arrow"></b>

              </li>

            </ul>

          </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                FLASH IMAGE
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
              <li class="">
                <a href="<?php echo site_url('admin/flash_image'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  FLASH IMAGE
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/flash_image_list');  ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                FLASH IMAGE LIST
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
        </li>
        <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                MARQUEE
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu">
              <li class="">
                <a href="<?php echo site_url('admin/add_marquee'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  ADD MESSAGE
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
        </li>
        <li class="<?php if($linkactive == 'manage_frontent' || $linkactive == 'manage_backend'){echo 'open'; } ?>">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-user"></i>
              <span class="menu-text">
                MANAGE
              </span>
              <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>
            <ul class="submenu <?php if($linkactive == 'manage_frontent' || $linkactive == 'manage_backend'){echo 'active'; } ?>">
              <li class="">
                <a href="<?php echo site_url('admin/manage_frontent'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  FRONT
                </a>
                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="<?php echo site_url('admin/manage_backend'); ?>">
                  <i class="menu-icon fa fa-caret-right"></i>
                  BACKEND
                </a>
                <b class="arrow"></b>
              </li>
            </ul>
        </li>


                         
          

          

          <li class="">

            <a href="#" class="dropdown-toggle">

              <i class="menu-icon fa fa-user"></i>

              <span class="menu-text">

              UPDATE-PASS.

              </span>

              </a> 

          </li>

          

          






         <?php
        if(get_title_name('center_admin_login')->BACK_END_SHOW_HIDE == 0){
        ?>
        <li class="">
            <a href="javascript:void(0);"  onclick="center_login()" >
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> <?php echo  get_title_name('center_admin_login')->BACK_END_TITLE; ?> </span>
            </a>
            <b class="arrow"></b>
        </li>

        <?php
        }
        ?>


          <li class="">

            <a href="javascript:void(0);" class="logoutside">

              <i class="menu-icon fa fa-lock logoutside"></i>

             LOGOUT

            </a>

            <b class="arrow"></b>

          </li>



        </ul><!-- /.nav-list -->



        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">

          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>

        </div>

      </div>



      <div class="main-content">

        <div class="main-content-inner">

          



          <div class="page-content">

            <div class="ace-settings-container" id="ace-settings-container">

              <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">

                <i class="ace-icon fa fa-cog bigger-130"></i>

              </div>



              <div class="ace-settings-box clearfix" id="ace-settings-box">

                <div class="pull-left width-50">

                  <div class="ace-settings-item">

                    <div class="pull-left">

                      <select id="skin-colorpicker" class="hide">

                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>

                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>

                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>

                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>

                      </select>

                    </div>

                    <span>&nbsp; Choose Skin</span>

                  </div>



                 

                </div><!-- /.pull-left -->



                <div class="pull-left width-50">

                  <div class="ace-settings-item">

                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />

                    <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>

                  </div>



                  <div class="ace-settings-item">

                    <input type="checkbox" class="ace ace-checkbox-2" checked="checked" id="ace-settings-compact" autocomplete="off" />

                    <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>

                  </div>



                  <div class="ace-settings-item">

                    <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />

                    <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>

                  </div>

                </div><!-- /.pull-left -->

              </div><!-- /.ace-settings-box -->

            </div><!-- /.ace-settings-container -->



            <div class="row">

              <div class="col-xs-12">

                <!-- PAGE CONTENT BEGINS -->



              