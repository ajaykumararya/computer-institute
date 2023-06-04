<?php
$this->load->view('web/header');

$query=$this->db->query("select * from `page`  where page_menu_code='".@$this->uri->segment(2)."'");
$row=$query->row();

$query2 = $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `menu_code` LIKE '".@$this->uri->segment(2)."' ")->row();

?>

<!--
<div class="inner-banner2 blog" style="background: aqua;">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="content text-center">
          <h1 style="font-weight:900"><?php //echo $query2->menu;  //str_replace(" ","-","$query2->menu");   ?></h1>
          <p><?php  // echo @$row->title; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
--->

<!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3 style="padding-top: 20px;"><?php echo $query2->menu;  ?></h3>
                        	</div>
                           <!--
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php //echo base_url();?>">Home</a></li>
									<li><a href="#"><?php   //echo @$row->title; ?></a></li>
								</ul>
							</div>
							-->
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>







<?php
if($query2->PAGE_TYPE == 1){
?>

<section class="about LogoBg">
  <div class="container">
    <div class="row">
        <div class="col-md-12 left-block text-justify">
        <?php 
            echo @$row->description;
        ?>
        
        </div>
    <!--
      <div class="col-md-5 about-right"> <img src="images/who-we-are-img.jpg" class="img-responsive" alt=""> </div>
    -->
    </div>
  </div>
</section>


<?php
}else if($query2->PAGE_TYPE ==2){
?>
<!--Content Wrap Start-->
    	<div class="kf_content_wrap">
    				
    		<!--ABOUT UNIVERSITY START-->
    		<section>
    		    <?php
					  if(@$row->content_status == 1){
					      $image = @$row->page_file;
					  }else if(@$row->content_status ==2){
					      
					    $image = '<figure><img src="'.base_url('uploads/').@$row->page_file.'" alt=""/></figure>';  
					  }else{
					      
					  }  
					    
					?>
    			<div class="container">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="abt_univ_wrap">
								<!-- HEADING 1 START-->
								<div class="kf_edu2_heading1">
									<!--<h5>About Us</h5>-->
									<h3><?php  echo @$row->title;  ?></h3>
								</div>
								<!-- HEADING 1 END-->

								<div class="abt_univ_des">

									 <?php  echo @$row->description;  ?>

								</div>
    						</div>
    					</div>

    					<div class="col-md-6">
    						<div class="">
    							
    								<?php echo @$image ?>
    							
    						</div>
    					</div>

    				</div>
    			</div>
    		</section>
    		<!--ABOUT UNIVERSITY END-->
    	</div>	

<?php
}else{
?>
<!-- Bootstrap CSS -->
   
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Merriweather:ital,wght@0,400;1,300&family=Playfair+Display:ital,wght@0,600;1,400&display=swap" rel="stylesheet"> 

    <!-- *****************FONT AWESOME ************ -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<style>
    
        .info .cart_head h3{
            display: inline-block;
            font-size: 17px;
            font-weight: bolder;
        }
        .info p{
            text-align: justify;
            font-size: 15px;
        }

        .info ul li a{
            text-decoration: none;
        }
        .info ul li span{
            color: green;
        }
    
    </style>
   
<div class="info">
        <div class="container mt-5">
            <div class="row" style="padding-top: 20px;">
                <div class="col-md-12">
                    <div class="row">
                        
                        <?php
                        $fq = $this->db->query("SELECT * FROM `fquestion` WHERE `PAGE_MENU_CODE` LIKE '".@$this->uri->segment(2)."'")->result();
                        foreach($fq as $fq_list){
                        ?>
                            <div class="col-md-12" style="padding-top: 10px;padding-bottom: 30px;">
                                <div class="cart_head">
                                    <h3 style="padding-top: 20px;font-weight: 900;color: black;"><?php echo $fq_list->FQUESTION; ?> </h3>
                                </div>
                                <p class="d-block mb-5 " style="font-weight: 600;color: black;"><?php echo $fq_list->FANSWER; ?> </p>
                                <ul class="list-unstyled ">
                                    <li><a class="text-danger font-weight-bold" href="<?php echo site_url('uploads/'.$fq_list->UPLOAD_FILE.' '); ?>"><span><i class="fas fa-check"></i></span> <?php echo $fq_list->F_TITLE; ?></a></li>
                                </ul>
                                <div class="border border-mute my-5"></div>
                            </div>
                        
                        <?php
                        }
                        ?>
                        
                        
                        
    
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
}
?>


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
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class="icon-book236"></i></span>-->
					<!--	<h3 class="counter">11,223</h3>-->
					<!--	<h5>CLASSES COMPLETE</h5>-->
					<!--</div>-->
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class="icon-win5"></i></span>-->
					<!--	<h3 class="counter">282,673</h3>-->
					<!--	<h5>STUDENTS ENROLLED</h5>-->
					<!--</div>-->
					<!--EDU2 COUNTER DES END-->
					<!--EDU2 COUNTER DES START-->
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class="icon-user255"></i></span>-->
					<!--	<h3 class="counter">370</h3>-->
					<!--	<h5>CERTIFIED TEACHERS</h5>-->
					<!--</div>-->
					<!--EDU2 COUNTER DES END-->
				</div>
			</section>
			
					<!--<div class="edu2_counter_des">-->
					<!--	<span><i class=" fa <?php echo $counter_list->COUNTER_ICON_CODE; ?>"></i></span>-->
					<!--	<h3 class="counter"><?php echo $counter_list->COUNTER_NUMBER; ?></h3>-->
					<!--	<h5><?php echo $counter_list->COUNTER_TEXT; ?></h5>-->
					<!--</div>-->
				
			<!--COUNTER SECTION END-->


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


			<!-- FACULTY WRAP START-->
			
			<!-- FACULTY WRAP START-->
    	</div>
        <!--Content Wrap End-->








<?php
$this->load->view('web/footer');

?>