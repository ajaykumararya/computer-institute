
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form  id="create_exam_schedule" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> SELECT COURSE </div>
                <div class="profile-info-value">
                  
                  	<select class="col-sm-12 col-xs-12 append_course get_year selectpicker" data-live-search="true"  name="course_id"  required="required">
    					<option value="">--Select--</option>
    					<?
    						$course = $this->db->query("SELECT * FROM courses")->result();
    						foreach($course as $c){
    						
    							echo '<option value="'.$c->id.'">'.$c->course_name.'</option>';
    						}
    					?>
    				</select>
    				
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> SELECT YEAR </div>
                <div class="profile-info-value">
                    <select class="col-sm-12 col-xs-12 course_type selectpicker" data-live-search="true" name="year" required="required">
    				</select>
                </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> EXAM DATE </div>
                <div class="profile-info-value">
                  <input type="date" class="col-sm-12 col-xs-12" name="exam_date" required="" placeholder="Enter Subject Name" required="required">
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> START TIME </div>
                <div class="profile-info-value">
                    <input type="time" min="0" class="col-sm-12 col-xs-12" name="start_time" required=""  placeholder="Enter Start Time" required="required"> 
               
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> END TIME </div>
                <div class="profile-info-value "  >
                    <input type="time" min="0" class="col-sm-12 col-xs-12" name="end_time" required="" placeholder="Enter End Time " required="required">
    				
                </div>
              </div>
              
                <div class="profile-info-name">  </div>
                  
                </div>
                
                
                
                
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                ADD 
                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>       
</div> 











<!--

<div class="box box-danger">
	<div class="box-header"><h3>Create Exam Schedule</h3></div>
	<div class="box-body">
		<form  id="create_exam_schedule" >
			<div class="form-group col-md-6">
				<label>Select Course</label>
				<select class="form-control get_duration get_year selectpicker" data-live-search="true"  name="course_id"  required="">
					<option value="">--Select--</option>
					<?
						$course = $this->db->query("SELECT * FROM courses")->result();
						foreach($course as $c){
						
							echo '<option value="'.$c->id.'">'.$c->course_name.'</option>';
						}
					?>
				</select>
			</div>
			<div class="course_type">
			    
			</div>
		
			<div class="form-group col-md-6">
				<label>Exam Date</label>
				<input type="date" class="form-control " name="exam_date" required="" placeholder="Enter Subject Name">
			</div>
		
			<div class="form-group col-md-6">
				<label>Start time</label>
				<input type="text" min="0" class="form-control" name="start_time" required="" placeholder="Enter Start Time">
			</div>
		
			<div class="form-group col-md-6">
				<label>End Time</label>
				<input type="text" min="0" class="form-control" name="end_time" required="" placeholder="Enter End Time ">
			</div>
			
			<div class="form-group col-md-12">
				<button class="btn btn-danger" type="submit"><i class="fa fa-plus"></i> Add</button>
			</div>
		</form>
		
	</div>
	
</div>

--->
