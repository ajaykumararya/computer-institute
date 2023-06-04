
<div class="box box-primary">
	<div class="box-header"><h3>Create Result</h3></div>
	<div class="box-body">
		
<?php 
    $result=$this->db->get_where('results',['id'=>$this->uri->segment(3)])->row();
?>
		<!--<form action="" method="post" enctype="multipart/form-data">-->
		    <form  id="create_result"  enctype="multipart/form-data">
		        <input type="hidden" name="result_id" value="<?php echo $this->uri->segment(3)?>">
			<div class="form-group col-md-4">
				<label>Select Institute</label>
				<select class="form-control get_enroll selectpicker" data-live-search="true" name="center_id" required="">
					<option value="">-- SELECT CENTER -- </option>
					<?
						$center = $this->db->query("SELECT * FROM centers")->result();
						$center_select=$this->db->get_where('centers',['id'=>$result->center_id])->row();
				// 
				            foreach($center as $center_list){
                                if(@$center_select->id == @$center_list->id){
                                     echo '<option value="'.$center_list->id.'" '.$se.' selected="selected">'.$center_list->institute_name.'</option>';
                                } else {
                                    echo '<option value="'.$center_list->id.'" '.$se.'>'.$center_list->institute_name.' </option>';
                                }
                            }
				
					?>
				</select> 
			</div>
			<div class="form-group col-md-4">
				<label>Enrollment No.</label>
				<select class="form-control enroll selectpicker" id="get_course_by_enrollment" data-live-search="true" name="enrollment_no" required="">
					<option value="">--Select--</option>
					
					
				</select>
			</div>
			<!--<div class="form-group col-md-4">-->
			<!--	<label>Roll No. &nbsp;<span id="load"></span></label>-->
				
			<!--	<input id="roll" type="number" value="<?php echo @$result->roll_no;?>" class="form-control" name="roll_no" readonly="">-->
			<!--</div>-->
			<div class="form-group col-md-4">
				<label>Select Course</label>
				
				<select class="form-control get_year_with_course append_course selectpicker" data-live-search="true" name="course_id" required="required">
                        <option value="">SELECT COURSE</option>
                </select>
			</div>
			<div class="course_type" ></div>
			<div id="list" ></div>
		</form>

	</div>

</div>
