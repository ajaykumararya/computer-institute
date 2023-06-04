<?php
$year = date('Y');
//print_r($this->session->userdata);
$wallet = 0;
 if($_SESSION['type'] == 1){
 
 
     $aproved_student = $this->db->query("SELECT * FROM `students` WHERE `pay_status`=1  ")->num_rows();
    
    $pending_student = $this->db->query("SELECT * FROM `students` WHERE `pay_status`=0  ")->num_rows();
    
    $cancell_student = $this->db->query("SELECT * FROM `students` WHERE `pay_status`=2 ")->num_rows();
	
	$total_student = $this->db->query("SELECT * FROM `students` ")->num_rows();
	
	$total_enquiry = $this->db->query("SELECT * FROM `enquiry` WHERE `user_id` LIKE '".$_SESSION['loginid']."' ")->num_rows();

 }else{
     $aproved_student = $this->db->query("SELECT * FROM `students` WHERE `center_id` LIKE '".$_SESSION['loginid']."' and `pay_status`=1  ")->num_rows();
    
    $pending_student = $this->db->query("SELECT * FROM `students` WHERE `center_id` LIKE '".$_SESSION['loginid']."' and `pay_status`=0 ")->num_rows();
    
    $cancell_student = $this->db->query("SELECT * FROM `students` WHERE `center_id` LIKE '".$_SESSION['loginid']."' and `pay_status`=2 ")->num_rows();
	
	$total_student = $this->db->query("SELECT * FROM `students` WHERE `center_id` LIKE '".$_SESSION['loginid']."' ")->num_rows();
	
	$total_enquiry = $this->db->query("SELECT * FROM `enquiry` WHERE `user_id` LIKE '".$_SESSION['loginid']."' ")->num_rows();
    $wallet = $this->center_model->get_wallet($_SESSION['loginid']);
 }
 
    	
	
	?>
<style type="text/css">
  .white-panels{
    height: 150px;
    margin-bottom: 5px;
  }
</style>


<br>


<div class="row">
    <div class="col-md-2 mb col-xs-6">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/add_student"><i class="fa fa-user-plus" style="font-size:100px;padding-left:30px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Add Student</h5>
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/download_admit_card"><i class="fa fa-id-card-o" style="font-size:100px;padding-left:20px;color:white"></i>
             <h5 style="padding-left:35px;color:white">Admit Card</h5>
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/approve_admission"><i class="fa fa-users" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">List Student</h5> 
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/create_course"><i class="fa fa-book" style="font-size:100px;padding-left:30px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Create Course</h5>
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/add_subject"><i class="fa fa-address-book-o" style="font-size:100px;padding-left:30px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Add Subjet</h5>
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/add_center"><i class="fa fa-institution" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Add Center</h5>
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/center_list"><i class="fa fa-institution" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">List Center</h5> 
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/brands"><i class="fa fa-list-ul" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Add Category</h5> 
             </a>    
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/list_brands"><i class="fa fa-list-alt" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">List Category</h5> 
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/all_results"><i class="fa fa-folder-open" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">List Results</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/print_result"><i class="fa fa-folder-open-o" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Print Results</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/notice_board"><i class="fa fa-envelope" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Notice Board</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/notice_list"><i class="fa fa-envelope-open" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Notice List</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/blog/3"><i class="fa fa-image" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Our Gallery</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/gallery_list"><i class="fa fa-file-photo-o" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">Gallery List</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/contact_form_list"><i class="fa fa-comments" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">For Enquiry</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    <div class="col-md-2 mb col-xs-6 ">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <a href="<?=base_url()?>admin/whyus"><i class="fa fa-desktop" style="font-size:100px;padding-left:25px;color:white"></i>
             <h5 style="padding-left:30px;color:white">About Us</h5>  
             </a>   
            </div><!-- darkblue panel --> 
    </div>
    
    
    
</div>

<!--<br>-->

<div class="row">
    
    
    <div class="row">
        
        <?php
        if($msg = $this->session->flashdata('msg'))
            echo '<div class="col-md-12">'.$msg.'</div>';
        
        ?>
        
        <div class="col-md-3 mb"> 
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style="background-color:transparent;padding:5px;color:white;text-align:left;" class="text-center">
                <h5><a style="color:white;" class="fa fa-user text-center" href="#"> Urgent STUDENTS </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $this->db->get_where('students',['vip' => 1])->num_rows(); ?> </h5> 
                  </div>
        
                    <div class="row col-md-12">
                        <a href="<?=base_url('admin/add_student?type=university')?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add</a>
                        <a href="<?=base_url('admin/list-other-students?type=university')?>" class="btn btn-info btn-xs"><i class="fa fa-list"></i> List</a>
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        <div class="col-md-3 mb"> 
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style="background-color:transparent;padding:5px;color:white;text-align:left;" class="text-center">
                <h5><a style="color:white;" class="fa fa-user text-center" href="#"> University STUDENTS </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $this->db->get_where('students',['vip' => 2])->num_rows(); ?> </h5> 
                  </div>
        
                    <div class="row col-md-12">
                        <a href="<?=base_url('admin/add_student?type=university')?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add</a>
                        <a href="<?=base_url('admin/list-other-students?type=university')?>" class="btn btn-info btn-xs"><i class="fa fa-list"></i> List</a>
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        <div class="col-md-3 mb"> 
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style="background-color:transparent;padding:5px;color:white;text-align:left;" class="text-center">
                <h5><a style="color:white;" class="fa fa-user text-center" href="#"> APPROVED STUDENTS </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $aproved_student; ?> </h5> 
                  </div>
        
                    <div class="row col-md-12">
                        <div class="progress progress-striped">
							<div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="<?php echo $aproved_student; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_student; ?>" style="width:<?php  echo ($aproved_student/$total_student)*100 ?>%">
                                <span class="sr-only" style="color:white;"><?php  echo ($aproved_student/$total_student)*100 ?>% Complete</span>
                            </div>
						</div>
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style="background-color:transparent;padding:5px;color:white;text-align:left;" class="text-center">
                <h5><a style="color:white;" class="fa fa-user" href="#"> PENDIG STUDNETS </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px; color:white"> <?php echo $pending_student; ?> </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped ">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $pending_student; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_student; ?>" style="width:<?php  echo ($pending_student/$total_student)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($pending_student/$total_student)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
        
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        
        <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style=" background-color:transparent;padding:5px;color:white;text-align:left;" class="text-center">
                <h5><a style="color:white;" class="fa fa-user" href="#"> CANCELL STUDENTS </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $cancell_student; ?>  </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $cancell_student; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_student; ?>" style="width:<?php  echo ($cancell_student/$total_student)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($cancell_student/$total_student)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
 
        
        
        
         <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style="background-color:transparent;padding:5px;color:white;" class="text-left">
                <h5><a style="color:white;" class="fa fa-user" href="#"> TOTAL STUDNETS </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $total_student; ?> </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="<?php echo $total_student; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_student; ?>" style="width:<?php  echo ($total_student/$total_student)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($total_student/$total_student)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        <div class="col-md-3 mb">
               <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
                 <div style=" background-color:transparent;padding:5px;color:white;" class="text-left">
                    <h5><a href="<?=base_url('admin/list_all_transaction')?>" style="color:white;" class="fa fa-money" > Collect Fee </a></h5>
                  </div>
                    <footer>
                      <div class="pull-center text-left" style="padding-left:5px;">
                        <h5 style="font-size: 20px;color:white"> <?php 
                        
                       
                            $get_collection_transaction = $this->center_model->get_collection_transaction();
                            if($get_collection_transaction->num_rows())
                                echo $get_collection_transaction->row()->total;
                            else
                                echo 0;
                        
                        
                        ?> <i class="fa fa-rupee"></i></h5>
                      </div>
                    
            
                    </footer>
                </div><!-- darkblue panel -->
            </div><!-- /col-md-4 -->
        <?php
        
        
         if($_SESSION['type'] == 2){
            
            ?>
            <div class="col-md-3 mb">
               <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
                 <div style=" background-color:transparent;padding:5px;color:white;" class="text-left">
                    <h5><a style="color:white;" class="fa fa-money" href="#"> Wallet </a></h5>
                  </div>
                    <footer>
                      <div class="pull-center text-left" style="padding-left:5px;">
                        <h5 style="font-size: 20px;color:white"> <?php echo $wallet ?> <i class="fa fa-rupee"></i></h5>
                      </div>
            
                        <div class="row col-md-12">
                             <button class="btn btn-primary btn-sm load-wallet-center">Load wallet</button> 
                        </div>
                    
            
                    </footer>
                </div><!-- darkblue panel -->
            </div><!-- /col-md-4 -->
            <?php
        }
        ?>
        
        <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style=" background-color:transparent;padding:5px;color:white;" class="text-left">
                <h5><a style="color:white;" class="fa fa-envelope" href="#"> TOTAL ENQUIRY </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $total_enquiry; ?> </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-pink" role="progressbar" aria-valuenow="<?php echo $total_enquiry; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_enquiry; ?>" style="width:<?php  echo ($total_enquiry/$total_enquiry)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($total_enquiry/$total_enquiry)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        
        
        <?php
       
            if($_SESSION['type'] == 1){
                ?>
        <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style=" background-color:transparent;padding:5px;color:white;" class="text-left">
                <h5><a style="color:white;" class="fa fa-institution" href="#"> TOTAL CENTER </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $total_centers =  $this->db->get('centers')->num_rows(); ?> </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $total_centers; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_centers; ?>" style="width:<?php  echo ($total_centers/$total_centers)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($total_centers/$total_centers)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style=" background-color:transparent;padding:5px;color:white;" class="text-left">
                <h5><a style="color:white;" class="fa fa-institution" href="#"> APPROVED CENTER </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo $approved_centers =  $this->db->get_where('centers',['status'=>1])->num_rows(); ?> </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-sucess" role="progressbar" aria-valuenow="<?php echo $total_centers; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_centers; ?>" style="width:<?php  echo ($approved_centers/$total_centers)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($approved_centers/$total_centers)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
                
        
                </footer>
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
        <div class="col-md-3 mb">
           <div class="white-panels pb" style="border-radius:10px;box-shadow:inset 0 0 10px white;padding:10px;background-image: linear-gradient(to right top, #5c040c, #60001d, #5c0033, #49004e, #050069);">
             <div style=" background-color:transparent;padding:5px;color:white;" class="text-left"> 
                <h5><a style="color:white;" class="fa fa-institution" href="#"> PENDING CENTER </a></h5>
              </div>
                <footer>
                  <div class="pull-center text-left" style="padding-left:5px;">
                    <h5 style="font-size: 20px;color:white"> <?php echo  $pending_centers = @$this->db->get_where('centers',['status'=>0])->num_rows(); ?> </h5>
                  </div>
        
                    <div class="row col-md-12">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="<?php echo $total_centers; ?>" aria-valuemin="0" aria-valuemax="<?php echo $total_centers; ?>" style="width:<?php  echo ($pending_centers/$total_centers)*100 ?>%">
                              <span class="sr-only" style="color:white;"><?php  echo ($pending_centers/$total_centers)*100 ?>% Complete</span>
                            </div>
                          </div> 
                    </div>
                
        
                </footer> 
            </div><!-- darkblue panel -->
        </div><!-- /col-md-4 -->
        
         <?php
            }
        ?>
        
        
               
          
  </div>
   
   
<?php

//$year = 2021;


$jan_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-01-01' AND '".$year."-01-31'")->num_rows();
$feb_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-02-01' AND '".$year."-02-28'")->num_rows();
$mar_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-03-01' AND '".$year."-03-31'")->num_rows();
$april_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-04-01' AND '".$year."-04-30'")->num_rows();
$may_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-05-01' AND '".$year."-05-31'")->num_rows();
$june_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-06-01' AND '".$year."-06-30'")->num_rows();
$july_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-07-01' AND '".$year."-07-31'")->num_rows();
$august_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-08-01' AND '".$year."-08-31'")->num_rows();
$sep_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-09-01' AND '".$year."-09-30'")->num_rows();
$oct_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-10-01' AND '".$year."-10-31'")->num_rows();
$nov_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-11-01' AND '".$year."-11-30'")->num_rows();
$dec_student = $this->db->query("SELECT *  FROM `students` WHERE `addmission_date` BETWEEN '".$year."-12-01' AND '".$year."-12-31'")->num_rows();


?>
   
   
   
   
   
   
   
   <script type="text/javascript">
   
   $(document).on('submit','.submit_fee',function(r){
        r.preventDefault();
        
        $.ajax({
            type : 'POST',
            url : '<?=base_url('Post_ajax/submit_fee')?>',
            data : $(this).serialize(),
            // dataType : 'json',
            success : function(r){
                if(r.status){
                    location.reload();
                }
            },
            error: function(a,v,c){
                console.log(a.responseText);
            }
        });
        
   })
   
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light1", // "light2", "dark1", "dark2"
	animationEnabled: false, // change to true		
	title:{
		text: "Student Admission Chart - <?php echo $year; ?>"
	},
	data: [
	{
		// Change type to "bar", "area", "spline", "pie",etc.
		type: "column",
		dataPoints: [
			{ label: "JAN",  y: <?php echo $jan_student; ?>  },
			{ label: "FEB", y: <?php echo $feb_student; ?>  },
			{ label: "MARCH", y: <?php echo $april_student; ?>  },
			{ label: "APRIL",  y: <?php echo $april_student; ?>  },
			{ label: "MAY",  y: <?php echo $may_student; ?>  },
			
			{ label: "JUNE",  y: <?php echo $june_student; ?>  },
			{ label: "JULY",  y: <?php echo $july_student; ?>  },
			{ label: "AUGUST",  y: <?php echo $august_student; ?>  },
			{ label: "SEPT",  y: <?php echo $sep_student; ?>  },
			{ label: "OCT",  y: <?php echo $oct_student; ?>  },
			{ label: "NOV",  y: <?php echo $nov_student; ?>  },
			{ label: "DEC",  y: <?php echo $dec_student; ?>  },
		]
	}
	]
});
chart.render();

}
</script>
   
 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>  
   
   
   
   
   
   
   
   

    
    
    
 </div>   
    
   