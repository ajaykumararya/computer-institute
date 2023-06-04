
<div class="box box-primary">
	<div class="box-header"><h3>Create Enquiry</h3></div>
	<div class="box-body">
		

		<form id="create_enquiry" enctype="multipart/form-data">
		    <div class="form-group col-md-4">
				<label>Name &nbsp;<span id="load"></span></label>
				
				<input id="roll" type="text" value="" class="form-control" name="name" >
			</div>
			<div class="form-group col-md-4">
				<label>Select Lead Source</label>
				<select class="form-control " name="lead_source" required="">
					<!--<select class="form-control" name="Source" required="">-->
                     <option value="">Select</option>
                     <option value="Emailer">Emailer</option><option value="Facebook">Facebook</option><option value="SMS">SMS</option><option value="Website">Website</option>                
                </select>
							<!--</select> -->
			</div>
			<div class="form-group col-md-4">
				<label>Email Id</label>
				<input id="roll" type="email" value="" class="form-control" name="email" >
			</div>
			
			<div class="form-group col-md-4">
				<label>Select Course</label>
				<select class="form-control " result_id=""  name="course_id" required="">
					<option value="">--Select--</option>
					<?php 
					    $course=$this->db->get('courses')->result();
					    foreach($course as $row){
					?>
					<option value="<?php echo $row->id;?>"><?php echo $row->course_name;?></option>
					<?php
					    }
					?>
				
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Mobile No.</label>
				<input id="roll" type="text" value="" class="form-control" name="mobile" >
			</div>
			
			<!--<div class="form-group col-md-4">-->
			<!--	<label>Select Batch</label>-->
			<!--	<select class="form-control get_subject" result_id=""  name="batch" required="">-->
			<!--		<option value="">--Select--</option>-->
				
			<!--	</select>-->
			<!--</div>-->
			<div class="form-group col-md-4">
				<label>Date Of Birth</label>
				<input id="roll" type="date" value="" class="form-control" name="dob" >
			</div>
			
			<div class="form-group col-md-4">
				<label>Select Session</label>
				<select class="form-control " result_id=""  name="session" required="">
					<option value="">--Select--</option>
					<?php
					    $session=$this->db->get('session_year')->result();
					    foreach($session as $row){
					?>
					    <option value="<?php echo $row->id?>"><?php echo $row->start.'-'. $row->end;?></option>
					<?php
					    }
					?>
				
				</select>
			</div>
				<div class="form-group col-md-4">
				<label>Enquiry Date</label>
				<input id="roll" type="date" value="" class="form-control" name="enquiry_date" >
			</div>
			
			<div class="form-group col-md-4">
				<label>Remarks</label>
					<textarea id="roll"  class="form-control" name="remarks" ></textarea>
			</div>
			<div class="form-group col-md-4">
				<label>Followup Date</label>
				<input id="roll" type="date" value="" class="form-control" name="followup_date" >
			</div>
			
			<!--<div id="list" ></div>-->
			<div class="form-group">
					<button class="btn btn-warning" type="submit" >Submit</button>
				</div>
			
		</form>

	</div>
	
</div>
