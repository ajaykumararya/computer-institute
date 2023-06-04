<br>
<?php
if(@$_SESSION['type']==4){
    redirect('home');
}
?>
<br><br>
<div class="container" style="padding-top:40px">
	<div class="panel panel-info">
		<div class="panel-heading"><h3>Franchisee Form</h3></div>
		<div class="panel-body">
			<form id="center_registration"  enctype="multipart/form-data">
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Institute Owner Name</label>
					<input type="text" name="name" class="form-control" placeholder="Enter Institute Owner Name" required>
				</div>
				
				<div class="form-group col-lg-8 col-xs-12 col-sm-12">
					<label>Institute Name</label>
					<input type="text" name="institute_name" class="form-control" placeholder="Enter Institute Name" required>
				</div>
				
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Whatsapp Number</label>
					<input type="number" name="whatsapp_number" value="<?php echo @$row->whatsapp_number?>" class="form-control" placeholder="Enter Whatsapp Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Contact Number</label>
					<input type="number" name="contact_number" class="form-control" placeholder="Enter Mobile Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Email Id</label>
					<input type="text" name="email_id" class="form-control" placeholder="Enter Email Id" required>
				</div>
				
				
				
				
				
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<label>Institite Full Address</label>
					<textarea class="form-control" name="center_full_address" placeholder="Institite Full Address" required></textarea>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select State </label>
					<select name="state_id" id="state" class="form-control state">
					<!--<select class="form-control get_city" id="state" name="state_id" required="">-->
						<option value="">--Select--</option>
						<?php
							$state = $this->db->get('state');
							foreach($state->result() as $row)
							{
								echo '<option value="'.$row->STATE_ID.'">'.$row->STATE_NAME.'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select Distric <span id="load"></span></label>
					<!--<select class="form-control list" name="city_id" required="">-->
					<select name="district_id" id="city" class="form-control city">	
					<!--<select class="form-control city" id="city" name="district_id" required="">-->
						<option value="">--Select--</option>
					
					</select>
					<!--</select>-->
				</div>
				
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>City <span id="load"></span></label>
					<input type="text" name="city_name" class="form-control" placeholder="Enter your City" required="required">	
				</div>
				<div class="form-group col-lg-6 col-xs-12 col-sm-12">
					<label>Pincode <span id="load"></span></label>
					<input type="text" name="pincode" class="form-control" placeholder="Enter PinCode" required="required">	
				</div>
				<div class="form-group col-lg-6 col-xs-12 col-sm-12">
					<label>Password</label>
					<input type="text" name="password" class="form-control" placeholder="Enter Password" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Owner Photo</label>
					<input type="file" name="image" class="form-control" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Id Proof Image</label>
					<input type="file" name="id_proof_image" class="form-control" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Pan Card Image</label>
					<input type="file" name="pan_card_image" class="form-control" required>
				</div>
				
				<?php if(0){ ?>
				<!--
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Date of birth</label>
					<input type="date" name="dob" class="form-control" placeholder="Enter Center Owner Name" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Pan Number</label>
					<input type="text" name="pan_number" class="form-control" placeholder="Enter Pan Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Aadhar Number</label>
					<input type="number" name="aadhar_number" class="form-control" placeholder="Enter Aadhar Number" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label> Computer lab</label>
					<input type="number" name="computer_lab" class="form-control" placeholder="Enter Number of computer operators" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label> Theory Room( Area in sq. ) </label>
					<input type="number" name="seat_capacity" class="form-control" placeholder="Enter Seat Capacity" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Number of class rooms</label>
					<input type="number" name="no_of_class_room" class="form-control" placeholder="Enter Number of class rooms" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Total Computers</label>
					<input type="number" name="total_computer" class="form-control" placeholder="Enter Total Computers" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Practical Room/Lab Room</label>
					<input type="number" name="space_of_computer_center" class="form-control" placeholder="Enter Space of  Computer Center" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Whatsapp Number</label>
					<input type="number" name="whatsapp_number" class="form-control" placeholder="Enter Whatsapp Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Contact Number</label>
					<input type="number" name="contact_number" class="form-control" placeholder="Enter Contact Number" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>E-Mail ID</label>
					<input type="email" name="email_id" class="form-control" placeholder="Enter E-Mail ID" required>
				</div>
			
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Qualification of institute head</label>
					<input type="text" name="qualification_of_center_head" class="form-control" placeholder="Enter Qualification of institute head" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Reception</label>
					<input type="text" name="reception" class="form-control" placeholder="Enter Reception" required>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Staff Room</label>
					<select name="staff_room"  class="form-control ">
						<option value="">--Select--</option>
						<option value="yes">yes</option>
						<option value="no">no</option>
						
					</select>
				
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Water Supply</label>
						<select name="water_supply"  class="form-control ">
						<option value="">--Select--</option>
						<option value="yes">yes</option>
						<option value="no">no</option>
					</select>
					
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Toilet</label>
					<select name="toilet"  class="form-control ">
						<option value="">--Select--</option>
						
						<option value="yes">yes</option>
						<option value="no">no</option>
					</select>
				</div>
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>First Aid</label>
					<select name="first_aid"  class="form-control ">
						<option value="">--Select--</option>
						<option value="yes">yes</option>
						<option value="no">no</option>
					</select>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
    				<label>Username</label>
    				<input type="radio" id="html" name="fav_language" value="HTML">
                    <label for="html">HTML</label><br>
                    <input type="radio" id="css" name="fav_language" value="CSS">
                    <label for="css">CSS</label><br>
                    <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                    <label for="javascript">JavaScript</label>
				</div>
				
				
				<div class="form-group col-md-12">
					<div class="col-sm-6">
					    <label>Captcha</label>
						<p><img class="" src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
					</div>
					<div class="col-sm-3">
						<label>Enter Captcha Code</label>
						<input class="form-control" type="text" size="6" maxlength="5" name="captcha" value="">
					</div>
				</div>
				---->
				<?php } ?>
						
						
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<button class="btn btn-info col-lg-12 col-xs-12 col-sm-12" type="submit" name="status" value="insert">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>