<?php 
$profile=$this->db->get('profile')->row();
$logo=$this->db->get('site_setting')->row();
$header_7nd = $this->db->get_where('color_setting',['CS_ID'=>6])->row();
$header_8nd = $this->db->get_where('color_setting',['CS_ID'=>7])->row();

$header_12nd = $this->db->get_where('color_setting',['CS_ID'=>12])->row();
$header_13nd = $this->db->get_where('color_setting',['CS_ID'=>13])->row();
?>
<!--EDU2 FOOTER WRAP START-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
/*
body {margin:0;height:2000px;}
*/
.icon-bar {
        position: fixed;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        
    }

    .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
       
    }


/*
@media only screen and (max-width: 600px) {
    .icon-bar {
        position: fixed;
        top: 90%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        width: 100%;
    }

    .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
        width: 10%;
        float: left;
    }
}

*/


.icon-bar a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}

.twitter {
  background: #55ACEE;
  color: white;
}

.google {
  background: #dd4b39;
  color: white;
}

.linkedin {
  background: #007bb5;
  color: white;
}

.youtube {
  background: #bb0000;
  color: white;
}

/*.content {*/
/*  margin-left: 75px;*/
/*  font-size: 30px;*/
/*}*/
</style>
<div class="icon-bar">
  <a href="<?php echo $profile->facebook; ?>" class="facebook"><i class="fa fa-facebook"></i></a> 
  <a href="<?php echo $profile->twitter; ?>" class="twitter"><i class="fa fa-twitter"></i></a> 
  <a href="<?php echo $profile->google; ?>" class="google"><i class="fa fa-google"></i></a> 
  <a href="<?php echo $profile->facebook; ?>" class="linkedin"><i class="fa fa-linkedin"></i></a>
  <a href="<?php echo $profile->youtube; ?>" class="youtube"><i class="fa fa-youtube"></i></a>
  <a  href='#' class="facebook"><i class="fa fa-inr"> </i></a>  
</div>



		<footer class="main-footer" style="background:<?php echo $header_12nd->CS_CODE; ?>">
			<!--EDU2 FOOTER CONTANT WRAP START-->
				<div class="container">
					<div class="row">
						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget widget-links">
								<h5>Information</h5>
								<ul>
								    <?php 
                                        $links=$this->db->get('important_link');
                                         foreach($links->result() as $row){
                                    ?>
									<li><a href="<?php echo $row->LINK_URL;?>"><?php echo $row->LINK_NAME;?></a></li>
									<?php
                                         }
									?>
								
                                    <!--<div id="sfc6awcwu3f4kmd6nhxmu9jt3tpeg49d9hc"></div><script type="text/javascript" src="https://counter9.stat.ovh/private/counter.js?c=6awcwu3f4kmd6nhxmu9jt3tpeg49d9hc&down=async" async></script><noscript><a href="https://www.freecounterstat.com" title="website counter code"><img src="https://counter9.stat.ovh/private/freecounterstat.php?c=6awcwu3f4kmd6nhxmu9jt3tpeg49d9hc" border="0" title="website counter code" alt="website counter code"></a></noscript>								-->
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget widget-links">
								<h5>Student Help</h5>
								<ul>
								<?php
                                    $link=$this->db->get('social_links')->result();
                                     $profile=$this->db->get('profile')->row();
                                     foreach($link as $row){
                                ?>
									<li><a href="<?php echo $row->LINK_URL;?>"><?php echo $row->LINK_NAME;?></a></li>
								<?php
                                    }
                                ?>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget wiget-instagram">
								<h5>Instagram</h5>
								<ul>
									<li><a href="#"><img src="<?php echo base_url('webassets/')?>extra-images/instagram-1.jpg" alt=""/></a></li>
									<li><a href="#"><img src="<?php echo base_url('webassets/')?>extra-images/instagram-2.jpg" alt=""/></a></li>
									<li><a href="#"><img src="<?php echo base_url('webassets/')?>extra-images/instagram-3.jpg" alt=""/></a></li>
									<li><a href="#"><img src="<?php echo base_url('webassets/')?>extra-images/instagram-4.jpg" alt=""/></a></li>
									<li><a href="#"><img src="<?php echo base_url('webassets/')?>extra-images/instagram-5.jpg" alt=""/></a></li>
									<li><a href="#"><img src="<?php echo base_url('webassets/')?>extra-images/instagram-6.jpg" alt=""/></a></li>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->

						<!--EDU2 FOOTER CONTANT DES START-->
						<div class="col-md-3">
							<div class="widget widget-contact">
								<h5>Contact</h5>
								<ul>
									<li style="font-weight:900"><?php echo $profile->ORG_ADDRESS;?></li>
									<li style="font-weight:900">Phone : <a href="#"  style="font-weight:900"><?php echo $profile->ORG_PHONE;?></a></li>
									<li style="font-weight:900"> Phone : <a href="#" style="font-weight:900"> <?php echo $profile->ORG_ALT_PHONE;?></a></li>
									<li style="font-weight:900">Email : <a href="#" style="font-weight:900"><?php echo $profile->ORG_EMAIL;?></a></li>
								</ul>
							</div>
						</div>
						<!--EDU2 FOOTER CONTANT DES END-->
					</div>
				</div>
		</footer>
		<!--FOOTER END-->
		<!--COPYRIGHTS START-->
		<div class="edu2_copyright_wrap" style="background:<?php echo $header_13nd->CS_CODE; ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="edu2_ft_logo_wrap">
							<a href="#"><img src="<?php echo base_url('uploads/'.$logo->SS_FAVICON.' ')?>" alt=""/></a>
						</div>
					</div>

					<div class="col-md-6">
						<div class="copyright_des">
							<span>&copy; All Rights reserved. <a href="#">@2022 <?php echo $profile->ORG_NAME;?></li> 
			</div>
		</div>
		<!--COPYRIGHTS START-->
    </div>
    <!--KF KODE WRAPPER WRAP END-->
	<!--Bootstrap core JavaScript-->
	<script src="<?php echo base_url('websitecss/'); ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url('webassets/')?>js/jquery.js"></script>
	<script src="<?php echo base_url('webassets/')?>js/bootstrap.min.js"></script>
	<!--<script src="<?php echo base_url('websitecss/'); ?>assets/js/bootstrap.min.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/backend_assets/js/web.js"></script>
	<!--Bx-Slider JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/jquery.bxslider.min.js"></script>
	<!--Owl Carousel JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/owl.carousel.min.js"></script>
	<!--Pretty Photo JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/jquery.prettyPhoto.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo base_url('webassets/')?>js/dl-menu/modernizr.custom.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo base_url('webassets/')?>js/dl-menu/jquery.dlmenu.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo base_url('webassets/')?>js/dl-menu/modernizr.custom.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo base_url('webassets/')?>js/dl-menu/jquery.dlmenu.js"></script>
	<!--Full Calender JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/moment.min.js"></script>
	<script src="<?php echo base_url('webassets/')?>js/fullcalendar.min.js"></script>
	<script src="<?php echo base_url('webassets/')?>js/jquery.downCount.js"></script>
	<!--Image Filterable JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/jquery-filterable.js"></script>
	<!--Accordian JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/jquery.accordion.js"></script>
	<!--Number Count (Waypoints) JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/waypoints-min.js"></script>
	<!--v ticker-->
	<script src="<?php echo base_url('webassets/')?>js/jquery.vticker.min.js"></script>
	<!--select menu-->
	<!--<script src="<?php echo base_url('webassets/')?>js/jquery.selectric.min.js"></script>-->
	<!--Side Menu-->
	<script src="<?php echo base_url('webassets/')?>js/jquery.sidr.min.js"></script>
	<!--Custom JavaScript-->
	<script src="<?php echo base_url('webassets/')?>js/custom.js"></script>

    
</body>

 <a href="https://api.whatsapp.com/send?phone=<?php echo $profile->ORG_PHONE;?>" target="_blank" style="">
	<img src="<?php //echo site_url(); ?>/img/whatsapplogo.png" class="wplogo pull-left">
</a>
 <style>
    .wplogo{
        height: 80px;
        width: 80px;
        position: fixed;
        z-index: 99;
        top: 85%;
        right:0;
        margin: 15px;
    }
</style>

  
  
  
  
  
  
 <div class="cover" align="center">
  <center><div class="loader"></div></center>
</div>
<style type="text/css">
  .cover
  {
    height: 100%; 
    width: 100%;
    position: fixed;
    z-index: 9089898989;
    background: rgba(0,0,0,0.4);
    top:0;
    left: 0;
    display: none;
    padding-top: 5%; text-align: center
  }
  .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-bottom: 16px solid blue;
  width: 50px;
  height: 50px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<!-- Mirrored from kodeforest.net/html/uoe/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 22 Nov 2021 08:15:19 GMT -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
/*
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61d6d8b1f7cf527e84d0bb1b/1fonjstth';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
*/
</script>
<!--End of Tawk.to Script-->
</html>
