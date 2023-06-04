<?php
if(!empty($this->uri->segment(3))){
$row=$this->db->query("SELECT * FROM `centers` LEFT JOIN admin_login ON admin_login.INSTITUTE_CENTER_ID=centers.id where id='".$this->uri->segment(3)."' ")->row();
}
?>

<br>
<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading"><h3>Franchisee Form</h3></div>
		<div class="panel-body">
			<form id="center_registration"  enctype="multipart/form-data">
			    <input type="hidden" name="center_id" value="<?php echo @$this->uri->segment(3)?>">
			    <input type="hidden" name="center_number" value="<?php echo @$row->center_number;?>">
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Institute Owner Name</label>
					<input type="text" name="name" value="<?php echo @$row->name?>" class="form-control" placeholder="Enter Institute Owner Name" required>
				</div>
				
				<div class="form-group col-lg-8 col-xs-12 col-sm-12">
					<label>Institute Name</label>
					<input type="text" name="institute_name" class="form-control" value="<?php echo @$row->institute_name?>" placeholder="Enter Institute Name" required>
				</div>
				
				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
				<!--	<label>Mobile Number</label>-->
				<!--	<input type="number" name="contact_number" value="<?php echo @$row->contact_number?>" class="form-control" placeholder="Enter Mobile Number" required>-->
				<!--</div>-->
				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
				<!--	<label>Email Id</label>-->
				<!--	<input type="text" name="email_id" value="<?php echo @$row->email_id?>" class="form-control" placeholder="Enter Email Id" required>-->
				<!--</div>-->
				
				
				
				
				
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
					<label>Institite Full Address</label>
					<textarea class="form-control" name="center_full_address" value="" placeholder="Institite Full Address" required><?php echo @$row->center_full_address;?></textarea>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select State </label>
					<select name="state_id" id="state" class="form-control state">
					<!--<select class="form-control get_city" id="state" name="state_id" required="">-->
						<option value="">--Select--</option>
						<?php
							$state = $this->db->get('state');
							foreach($state->result() as $state)
							{
							    if(@$state->STATE_ID==@$row->state_id){
								echo '<option value="'.$state->STATE_ID.'" selected>'.$state->STATE_NAME.'</option>';
							    }else{
							        	echo '<option value="'.$state->STATE_ID.'">'.$state->STATE_NAME.'</option>';
							    }
							}
						?>
					</select>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Select Distric  <span id="load"></span></label>
					
					<select name="district_id" id="city" class="form-control city">	
					
						<option value="">--Select--</option>
					    <?php
					       $district =  $this->db->query("SELECT * FROM `district` WHERE `STATE_ID` = '".$row->state_id."' ");
					      //print_r($district);
					        foreach($district->result() as $dist_list){
					           if(@$row->city_id == $dist_list->DISTRICT_ID){
					               echo '<option value="'.$dist_list->DISTRICT_ID.'" selected="selected"> '.$dist_list->DISTRICT_NAME.' </option>';
					           }else{
					               echo '<option value="'.$dist_list->DISTRICT_ID.'"> '.$dist_list->DISTRICT_NAME.' </option>';
					           }
					            
					        }
					    ?>
					</select>
					<!--</select>-->
				</div>
				
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>City <span id="load"></span></label>
					<input type="text" name="city_name" value="<?php echo @$row->city_name?>" class="form-control" required="required">	
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Pincode <span id="load"></span></label>
					<input type="text" name="pincode" value="<?php echo @$row->pincode?>" class="form-control" required="required">	
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Whatsapp Number</label>
					<input type="number" name="whatsapp_number" value="<?php echo @$row->whatsapp_number?>" class="form-control" placeholder="Enter Whatsapp Number" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Contact Number</label>
					<input type="number" name="contact_number" value="<?php echo @$row->contact_number?>" class="form-control" placeholder="Enter Contact Number" required>
				</div>
				
				<div class="form-group col-lg-6 col-xs-12 col-sm-12">
					<label>E-Mail ID</label>
					<input type="email" name="email_id" value="<?php echo @$row->email_id	?>" class="form-control" placeholder="Enter E-Mail ID" required>
				</div>
					
				<div class="form-group col-lg-6 col-xs-12 col-sm-12">
					<label>Password</label>
					<input type="text" name="password" value="<?php echo @$row->PASSWORD_VIEW?>" class="form-control" placeholder="Enter Password" required>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Owner Photo</label>
					<input type="file" name="image" class="form-control">
					<img src="<?=base_url('uploads/'.@$row->image)?>" width=200>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Id Proof Image</label>
					<input type="file" name="id_proof_image" class="form-control">
					<img src="<?=base_url('uploads/'.@$row->id_proof_image)?>" width=200>
				</div>
				
				<div class="form-group col-lg-4 col-xs-12 col-sm-12">
					<label>Pan Card Image</label>
					<input type="file" name="pan_card_image" class="form-control">
					<img src="<?=base_url('uploads/'.@$row->pan_card_image)?>" width=200>
				</div>
				
				
				<?php if(0){ ?>
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Pan Number</label>-->
    				<!--	<input type="text" name="pan_number" value="<?php echo @$row->pan_number?>" class="form-control" placeholder="Enter Pan Number" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Aadhar Number</label>-->
    				<!--	<input type="number" name="aadhar_number" value="<?php echo @$row->aadhar_number?>" class="form-control" placeholder="Enter Aadhar Number" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label> Computer Lab</label>-->
    				<!--	<input type="number" name="computer_lab" value="<?php echo @$row->no_of_computer_operator	?>" class="form-control" placeholder="Enter Number of computer operators" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label> Theory Room( Area in sq. ) </label>-->
    				<!--	<input type="number" name="seat_capacity" value="<?php echo @$row->space_of_computer_center?>" class="form-control" placeholder="Enter Seat Capacity" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Number of class rooms</label>-->
    				<!--	<input type="number" name="no_of_class_room" value="<?php echo @$row->no_of_class_room?>" class="form-control" placeholder="Enter Number of class rooms" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Total Computers</label>-->
    				<!--	<input type="number" name="total_computer" value="<?php echo @$row->total_computer;?>" class="form-control" placeholder="Enter Total Computers" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Practical Room/Lab Room </label>-->
    				<!--	<input type="number" name="space_of_computer_center" value="<?php echo @$row->total_computer?>" class="form-control" placeholder="Enter Space of  Computer Center" required>-->
    				<!--</div>-->
    				
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Qualification of institute head</label>-->
    				<!--	<input type="text" name="qualification_of_center_head" value="<?php echo @$row->qualification_of_center_head?>" class="form-control" placeholder="Enter Qualification of institute head" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Reception</label>-->
    				<!--	<input type="text" name="reception" class="form-control" value="<?php echo @$row->reception?>" placeholder="Enter Reception" required>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Staff Room</label>-->
    				<!--	<input type="radio" name="staff_room" value="yes" <?=@$row->staff_room == 'yes' ? 'checked' : ''?>>-->
    				<!--	<label>Yes </label>-->
    				<!--	<input type="radio" name="staff_room" value="no" <?=@$row->staff_room == 'no' ? 'checked' : ''?>>-->
    				<!--	<label>No </label>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Water Supply</label>-->
    				<!--	<label>Yes <input type="radio" name="water_supply" <?=@$row->water_supply == 'yes' ? 'checked' : ''?> value="yes" ></label>-->
    				<!--	<label>No <input type="radio" name="water_supply" <?=@$row->water_supply == 'no' ? 'checked' : ''?> value="no" ></label>-->
    					
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Toilet</label>-->
    				<!--	<label>Yes <input type="radio" name="toilet" value="yes" <?=@$row->toilet == 'yes' ? 'checked' : ''?>></label>-->
    				<!--	<label>No <input type="radio" name="toilet" value="no" <?=@$row->toilet == 'no' ? 'checked' : ''?>></label>-->
    				<!--</div>-->
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>First Aid</label>-->
    				<!--	<label>Yes <input type="radio" name="first_aid" value="yes" <?=@$row->first_aid == 'yes' ? 'checked' : ''?>></label>-->
    				<!--	<label>No <input type="radio" name="first_aid" value="no" <?=@$row->first_aid == 'no' ? 'checked' : ''?>></label>-->
    				<!--</div>-->
    				
    				
    				<!--<div class="form-group col-lg-4 col-xs-12 col-sm-12">-->
    				<!--	<label>Date of birth</label>-->
    				<!--	<input type="date" name="dob" class="form-control" value="<?php echo date('Y-m-d',strtotime(@$row->dob));?>" placeholder="Enter Center Owner Name" required>-->
    				<!--</div>-->
				<?php } 
				/*?>
				
				<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="padding: 2rem;">
                        <?php
                           
                            $course_id = $this->db->get("courses")->result_array();
                            foreach($course_id as $rowCourse){
                             $cShowCourse =  json_decode(@$row->center_course_show);
                           
                        ?>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" name="courseName[]" type="checkbox" id="" value="<?php echo $rowCourse['id'] ?>">
                          <label class="form-check-label" for=""><?php echo $rowCourse['course_name'] ?></label>
                        </div>
                        <?php } ?>
                        
                    </div>
                  </div>
                </div>
						<?php
						*/
						?>
				<div class="form-group col-lg-12 col-xs-12 col-sm-12">
				    <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-bottom: 5px;">Show Course</button>-->
					<button class="btn btn-info col-lg-12 col-xs-12 col-sm-12" type="submit" name="status" value="insert">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>