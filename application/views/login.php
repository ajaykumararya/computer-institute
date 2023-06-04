<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $title;  ?> </title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		   

		<script src="<?php echo base_url('static'); ?>/for_select/chosen.jquery.min.js"></script>

      	<script src="<?php echo base_url('static'); ?>/for_select/jquery.min.js"></script>
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php echo base_url();  ?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();  ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php echo base_url();  ?>assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php echo base_url();  ?>assets/css/ace.min.css" />
        <!--<script src="<?php echo base_url(); ?>assets/backend/post.js"></script>-->
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="<?php echo base_url();  ?>assets/css/ace-rtl.min.css" />
        <script>
            var login = '<?php echo site_url('login'); ?>';
            var welcome = '<?php echo site_url('welcome/'); ?>';
        </script>
		 <script>
		var get_loc='<?php echo base_url(); ?>get_ajax/';
		var post_loc='<?php echo base_url(); ?>post_ajax/';
        var base_loc='<?php echo base_url(); ?>admin/';
        var branch_loc='<?php echo base_url(); ?>branch/';
		var crsftoken='<?php echo $this->security->get_csrf_token_name(); ?>';
		var crsfharsh='<?php echo $this->security->get_csrf_hash(); ?>';
	</script>
	<style>
	    input[type=text],input[type=password]{
	        outline: none!important;
            border: none!important;
            border-radius: 40px!important;
            padding: 5px 15px!important;
            color: #fff!important;
            font-size: 18px!important;
            color: #03a9f4!important;
            box-shadow: inset -2px -2px 6px rgba(255,255,255,0.1)!important,
            inset 2px 2px 6px rgba(0,0,0,0.8)!important;
            background:#131419!important;
	       }
	</style>
	</head>

	<body class="login-layout" style="background-color: #4158D0;
background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<!-- <h1>
									<img style="width: 180px; height: 180px;" src="<?php echo base_url(); ?>/logo/splash_logo.png">
								</h1> -->
								<h4 class="white" id="id-company-text">  ADMIN LOGIN </h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div  class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main" style="background:black;">
											<h4 class="header white lighter bigger">
												<i class="ace-icon fa fa-user white"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6 white"></div>

											<form id="login">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="user_id" placeholder="Username" required="required"/>
															<i class="ace-icon fa fa-user red"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="password" placeholder="Password" required="required" />
															<i class="ace-icon fa fa-lock red"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline white">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Remember Me</span>
														</label>

														<button  type="submit"  class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span  class="bigger-110">Login</span>
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>


<!---
											<div class="social-or-login center">
												<span class="bigger-110">Or Login Using</span>
											</div>

											<div class="space-6"></div>

											<div class="social-login center">
												<a class="btn btn-primary">
													<i class="ace-icon fa fa-facebook"></i>
												</a>

												<a class="btn btn-info">
													<i class="ace-icon fa fa-twitter"></i>
												</a>

												<a class="btn btn-danger">
													<i class="ace-icon fa fa-google-plus"></i>
												</a>
											</div>

--->

										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#"  data-target="#forgot-box" class="forgot-password-link white">
													<i class="ace-icon fa fa-arrow-left  "></i>
													I forgot my password
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link white">
													I want to register
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Retrieve Password
											</h4>

											<div class="space-6"></div>
											<p>
												Enter your email and to receive instructions
											</p>

											<form id="password_reset">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" name="user_email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="ace-icon fa fa-lightbulb-o"></i>
															<span class="bigger-110">Send Me!</span>
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /.widget-main -->

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												Back to login
												<i class="ace-icon fa fa-arrow-right"></i>
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header white lighter bigger">
												<i class="ace-icon fa fa-users white"></i>
												New User Registration
											</h4>

											<div class="space-6"></div>
											<p> Enter your details to begin: </p>

											<form id="signup"  onSubmit = "return checkPassword(this)">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Your Name" name="cus_name"  required="required" />
															<i class="ace-icon fa fa-user red"></i>
														</span>
													</label>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" placeholder="Mobile Number/User Name" name="cus_phone"  required="required"/>
															<i class="ace-icon fa fa-ring"><img style="width: 15px;" src="<?php echo base_url(); ?>/logo/mobile_icon.png"></i>
														</span>
													</label>
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" name="cus_email"  required="required"/>
															<i class="ace-icon fa fa-envelope red"></i>
														</span>
													</label>

													

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Password" name="password" onkeyup="passmatch()" required="required" />
															<i class="ace-icon fa fa-key red"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" placeholder="Repeat password" onkeyup="passmatch()" name="repeat_password" required="required" />
															<i class="ace-icon fa fa-retweet red"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" class="ace" required="required" />
														<span class="lbl">
															I accept the
															<a href="#">User Agreement</a>
														</span>
													</label>

													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-success">
															<i class="ace-icon fa fa-refresh"></i>
															<span class="bigger-110">Reset</span>
														</button>

														<button type="submit" class="width-65 pull-right btn btn-success">
															<span class="bigger-110">Register</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" data-target="#login-box" class="back-to-login-link">
												<i class="ace-icon fa fa-arrow-left"></i>
												Back to login
											</a>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.signup-box -->
							</div><!-- /.position-relative -->
<!--
							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Dark</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Blur</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Light</a>
								&nbsp; &nbsp; &nbsp;
							</div>

-->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?php echo base_url();  ?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();  ?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');
				
				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');
				
				e.preventDefault();
			 });
			 
			});
		</script>
	</body>
</html>



<style type="text/css">
	

</style>

 <script src="<?php echo base_url(); ?>assets/backend_assets/js/get.js"></script>
 <script src="<?php echo base_url(); ?>assets/backend_assets/js/post.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
 <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>

<script> 
          
            // Function to check Whether both passwords 
            // is same or not. 
            function checkPassword(form) { 
                password = form.password.value; 
                repeat_password = form.repeat_password.value; 
  
                
                      
                // If Not same return False.     
            if (password != repeat_password) { 
                    alert ("\nPassword did not match: Please try again..."); 
                    return false; 
                } 
  
                // If same return True. 
                else{ 
                    alert ("\nPassword matched"); 
                    return true; 
                } 
            } 
        </script> 