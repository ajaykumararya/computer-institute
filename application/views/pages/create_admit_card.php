
	
<?
    if($_SESSION['type']==1){
      $student = $this->db->query("SELECT * FROM students WHERE pay_status != 2")->result();
    }else{
        $center_no =   $this->db->query(" SELECT * FROM `admin_login` WHERE `ADMIN_ID` = '".$_SESSION['loginid']."' ")->row('USER_NAME');
        $center_id = $this->db->query(" SELECT * FROM `centers` WHERE `center_number` LIKE '".$center_no."' ")->row('id');    
    
	    $student = $this->db->query("SELECT * FROM students where center_id='".$center_id."' AND pay_status != 2")->result();
    }
?>
<?php
    
    $query=$this->db->get('admit_card')->result();
    $plan=$this->db->get_where('admit_card',['id'=>@$this->uri->segment(3)])->row();
    $student_by_id=$this->db->get_where('students',['enrollment_no'=>@$plan->enrollment_no])->row();
    
?>



<?php
if(!empty($this->uri->segment(3))){
    $get_course = $this->db->query("SELECT * FROM courses where id = '".$this->uri->segment(3)."'")->row();
}
?>






<div class="row">
  <div class="col-xs-12 col-sm-6">
    <div class="widget-box">
      <div class="widget-header">
        <h4 class="widget-title"> <?php echo $title; ?> </h4>
      </div>
      <div class="widget-body">
        <div class="widget-main">
          <form action="" id="create_admit_card" method="post" class="form-inline" enctype="multipart/form-data">
            <div class="profile-user-info profile-user-info-striped">
              <div class="profile-info-row">
                <div class="profile-info-name"> ENROLLMENT NO. </div>
                <div class="profile-info-value">
                  <?php
                  if($this->uri->segment(3)!= ''){
                      ?>
                      <input type="hidden" name="admit_card_id" value=" <?php echo $this->uri->segment(3); ?>">
                      <?php
                  }
                  ?>
                  <select class="col-sm-12 col-xs-12 get_course selectpicker" data-live-search="true" id="get_course_by_enrollment" name="enrollment_no" required="required">
					    <option value="">--SELECT ENROLLMENT--</option>
					
					    <?php
                            if ((!empty($this->uri->segment('3')))) {
                                foreach ($query as $row) {
                                  if (@$row->id == @$plan->id){
                                   echo '<option value="'.$row->enrollment_no.'" selected="selected">'.$row->enrollment_no.'('.@$student_by_id->name.')'.' </option>';
                                  }
                                }
                            }else{
                                 foreach($student AS $stu){
						            $chk = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$stu->enrollment_no."'");
						          //  if($chk->num_rows() > 1){
						          //  }else{
				 			           echo '<option value="'.$stu->enrollment_no.'">'.$stu->enrollment_no.'('.$stu->name.')'.'</option>';
						            //}
						    }
                       
					    }
					?>
				</select>
    				
    				
    				
    				
    				
    				
                </div>
              </div>
              
              
              
              <div class="profile-info-row">
                <div class="profile-info-name"> SELECT COURSE </div>
                <div class="profile-info-value ">
                    <select class="col-sm-12 col-xs-12 get_year_with_course append_course" name="course_id" required="required">
                        <option value="">SELECT COURSE</option>
                    </select>    
                </div>
              </div>
              <div class="profile-info-row">
                <div class="profile-info-name"> SELECT YEAR </div>
                    <div class="profile-info-value course_type">
                        	
                    </div>
              </div>
              
              <div class="profile-info-row">
                <div class="profile-info-name"> ENTER ROLL NO  </div>
                <div class="profile-info-value">
                  <input type="number" class="col-sm-12 col-xs-12" name="roll_no" placeholder="Enter Roll No." value="<?php echo @$plan->roll_no;?>"required="">    
                </div>
              </div>
              </div>
            <div class="form-actions center">
              <button type="submit" class="btn btn-sm btn-success">
                ADD CATEGORY
                <i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>       
</div>                   





<div class="row mt mb">
  <div class="col-md-12">
    <section class="task-panel tasks-widget">
      <div class="panel-heading">
        <div class="pull-left">
          <h5><i class="fa fa-tasks"></i> <?php echo $title; ?></h5>
        </div>
         
        <br>
      </div>
     
      <div class="panel-body">
        <div style="overflow-x:auto;">
        <table class="table table-bordered table-striped table-condensed" id="admit_card_list">
          <thead>
            <tr>
                <th>Sr No.</th>
                <th>Enrollment No.</th>
                <th>Name </th>
				<th>Roll No.</th>
				<th>Course Name</th>
				<th>Year</th>
				<!--<th>Action</th>-->
				<!--<th>Delete</th>-->
                <th>ACTION</th>
            </tr>
          </thead>
          <tbody>                            
          </tbody>
        </table>  
        
        </div>  
      </div>
    </section>
  </div><!--/col-md-12 -->
</div><!-- /row -->              
  

