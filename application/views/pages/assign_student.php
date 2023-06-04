
<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form  id="select_student" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              
              <div class="profile-info-row">
                <div class="profile-info-name"> SELECT ENROLL </div>
                <div class="profile-info-value">
                  	<!--<select class="col-sm-12 col-xs-12  get_course selectpicker" id="get_course_by_enrollment" data-live-search="true" name="get_enroll_id" required="">-->
    				<select class="col-sm-12 col-xs-12 get_course get_enroll_id selectpicker" data-live-search="true" id="get_course_by_enrollment" name="enrollment_no" required="required">
    					<option value="">--Select--</option>
    					<?
    						$students = $this->db->query("SELECT * FROM students")->result();
    						foreach($students as $students_list){
    						
    							echo '<option value="'.$students_list->enrollment_no.'">'.$students_list->enrollment_no.' ( '.$students_list->name.' ) </option>';
    						}
    					?>
    				</select>
    			</div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> COURSE NAME </div>
                <div class="profile-info-value">
                  	<select class="col-sm-12 col-xs-12 append_course get_course_type course" name="course_id" required="required">
                        <option value="">SELECT COURSE</option>
                    </select> 
    			</div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> SELECT YEAR </div>
                <div class="profile-info-value">
                    <select class="col-sm-12 col-xs-12 year course_type selectpicker" data-live-search="true" name="year">
    				</select>
    				
                </div>
              </div>
              
              
              
                <div class="profile-info-name">  </div>
                  
                </div>
                
                
                
                
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                GET ADD 
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

<div class="box box-success">
	<div class="box-header"><h3>Assign student</h3></div>
	<div class="box-body">
		<form id="select_student"  class="form-inline">
			<div class="form-group">
				<label>Select Course</label>
				<select class="form-control course get_year" name="course_id" required="">
					<option value="">--Select--</option>
					<?
					/*
						$course = $this->db->query("SELECT * FROM courses")->result();
						foreach($course as $c){
						
							echo '<option value="'.$c->id.'">'.$c->course_name.' </option>';
						}
						*/
					?>
				</select>
			</div><br><br>
			<div class="course_type">
			    
			</div>
		
			<div class="form-group">
				<button class="btn btn-success" type="submit" ><i class="fa fa-plus"></i> Go</button>
			</div>
		</form>
	</div>
	
	--->
	
	
	
	
	
	
	
	<br>
	<div class="box-footer">
		<table class="table table-bordered" id="show_student">
			<thead>
				<tr>
					<th>#</th>
					<th>Student Name</th>
					<th>Mobile</th>
					<th>Course</th>
					<th>Subject</th>
					<th>Type</th>
					<th>Session</th>
					<th>DOA</th>
					<th>Enrollment no.</th>
					<th>Center Name</th>
					<th>Exam Date</th>
					<th>Status </th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</div>
</div>


