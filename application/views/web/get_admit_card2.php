<?

echo '<br><div class="ContentHolder"><div class="container">';
if(isset($_POST['enrollment_no']))
{

 	$admit = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."'");
 	$admit_num=$admit->num_rows();
 	$stu = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'");
 	$stu_num=$stu->num_rows();
//  	die(var_dump($stu_num,$admit_num));
//  	die(var_dump("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."'","SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'"));
 	if($stu_num>0 && $admit_num>0)
 	{
 		$s = $stu->row();
 		$a = $admit->row();
 		$c = $this->db->query("SELECT * FROM centers where id = '".$s->center_id."'")->row();
	$course = $this->db->query("SELECT * FROM courses where id = '".$s->course_id."'")->row();
		?>
		<div class="col-md-6 col-md-offset-3">
			<div class="box box-default">
				<div class="box-header"><h5>Admit Card</h5></div>
				<div class="box-body" id="printableArea">
					<table class="table table-bordered">
						<tbody>
								<tr><th>Institute Name</th> <td><?=@$c->institute_name?></td></tr>
							<tr><th>Enrollment No.</th> <td><?=$s->enrollment_no?></td></tr>
							<tr><th>Roll No.</th> <td><?=$a->roll_no?></td></tr>
							<tr><th>Student Name</th> <td><?=$s->name?></td></tr>
							<tr><th>Father Name</th> <td><?=$s->father?></td></tr>
							<tr><th>Mother Name</th> <td><?=$s->mother?></td></tr>
							<tr><th>Course</th> <td><?=$course->course_name?></td></tr>
						</tbody>
					</table>
				</div>
				<div class="box-footer">
					<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
				</div>
			</div>
		</div>
		<br>
		<?
	}
	else
	{
	    
		echo '<script>alert("Enrollment or date of birth not matched.");location.href="welcome/get_admit_card"</script>';
	}
}
else
{
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-danger">
		<div class="box-header"><h3>Admit Card</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Registration No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Registration No.">
				</div>
				<div class="form-group">
					<label>Date of birth</label>
					<input type="date" class="form-control" name="dob" placeholder="Enter B.O.B .">
				</div>
				<div class="form-group">
					<button class="btn btn-danger" type="submit" name="status" value="admit_card">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?
}
echo '</div></div>';

?>
<br><br>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>