<?
//require_once 'includes/header.php';

if(@$_GET['action']=='del')
{
	$con->query("DELETE FROM results where id = '".$_GET['id']."'");
	$con->query("DELETE FROM marks_table where result_id = '".$_GET['id']."'");
	echo '<script>alert("Result Deleted.");location.href="create_admit_card.php"</script>';
}
?>
<div class="box box-primary">
	<div class="box-header"><h3>Create Result</h3></div>
	<div class="box-body">
		

		<form  id="add_result" enctype="multipart/form-data">
			<div class="form-group col-md-4">
				<label>Enrollment No.</label>
				<select class="form-control get_subject_list" name="enrollment_no" required="">
					<option value="">--Select--</option>
					<?
					$student = $this->db->query("SELECT * FROM students")->result();
					foreach($student as $stu){
					
						     $chk = $this->db->query("SELECT * FROM results where enrollment_no = '".$stu->enrollment_no."'");
						     if($chk->num_rows() > 0){
						         
						     }else{
						        echo '<option value="'.$stu->enrollment_no.'">'.$stu->enrollment_no.'</option>';
						     }
						         
						     }
					?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label>Roll No. &nbsp;<span id="load"></span></label>
				
				<input id="roll" type="number" class="form-control" name="roll_no" readonly="">
			</div>
			<div class="form-group col-md-4">
				<label> Course &nbsp;<span id="load"></span></label>
				<input type="hidden" name="course_id" id="course_id" value="">
				<input type="text" class="form-control" id="data" value="" readonly>
				<!--<select class="form-control get_subject" name="course_id" required="">
					<option value="">--Select--</option>
					<?
						$course = $this->db->query("SELECT * FROM courses")->result();
						foreach($course as $c){
					
							echo '<option value="'.$c->id.'" >'.$c->course_name.'</option>';
						}
					?>
				</select>-->
			</div>
			<div id="list"></div>
		</form>

	</div>
	<div class="box-footer">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Enrollment No.</th>
					<th>Roll No.</th>
					<th>Course Name</th>
					<th>Result</th>
					<th>Edit</th>
					<th>Delete</th>
					
				</tr>
			</thead>
			<tbody>
				<?
					$get = $this->db->query("SELECT * FROM results")->result();
				    
				    //print_r($get);
				    foreach($get as $g)
					{
						$c = $this->db->query("SELECT * FROM courses where id = '".$g->course_id."'")->row();
						echo '<tr>
									<td>'.$g->enrollment_no.'</td>
									<td>'.$g->roll_no.'</td>
									<td>'.$c->course_name.'</td>
									<td>'.$g->result.'</td>
									<td><a href="javascript:void(0);" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
									<td><a href="javascript:void(0);" onclick="remove_result('.$g->id.')" class="btn btn-danger "><i class="fa fa-trash"></i></a></td>
						</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
</div>
<?

?>
