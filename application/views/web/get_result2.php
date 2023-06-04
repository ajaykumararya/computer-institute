<?
// require_once 'includes/header.php';
echo '<br><div class="ContentHolder"><div class="container">';


if(@$_POST['enrollment_no']!= ''){
    
    $admit = $this->db->query("SELECT * FROM upload_result where enrollment_no = '".$_POST['enrollment_no']."'");

	if($admit->num_rows()>0)
	{
		$a = $admit->row();
    ?>
        
		<div class="container">
          <img src="<?php  echo base_url('uploads/'.$a->file)?>" alt="Snow" style="width:100%;">
        </div>
        
        <div class="col-md-6 col-md-offset-3">
    
        	<div class="box box-danger">
        		<div class="box-header"><h3>Click To Download </h3></div> 
        		<div class="box-body">
        			<a href="<?php echo site_url('welcome/download/'.$a->file);  ?>">
        			    <i class="btn btn-primary">Download</i> 
        		   </a>	
        			&nbsp;&nbsp;&nbsp;&nbsp;
        			
        			<a href="<?php echo site_url('get-certificate');  ?>"><i class="btn btn-primary arrow-left">Go Back</i></a>
        		</div>
        	</div>
        </div>
        
        <div class="col-md-6 col-md-offset-3">
    
        	<div class="box box-danger">
        		 
        		<div class="box-body">
        			
        		</div>
        	</div>
        </div>
        
        
        
        
        <?php
    
	}
	
	
    
}else{
?>
<div class="col-md-6 col-md-offset-3">
    
	<div class="box box-danger">
		<div class="box-header"><h3>Download Result</h3></div> 
		<div class="box-body">
			<form  method="post">
				<div class="form-group">
					<label>Roll No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Roll No.">
				</div>
				<!--<div class="form-group">-->
				<!--	<label>Date of birth</label>-->
				<!--	<input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No.">-->
				<!--</div>-->
				<div class="form-group">
					<button class="btn btn-danger" type="submit" name="status" value="get_certificate">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div> 
<br>
<?php    
}
?>




<?

echo '</div></div>';
// include 'includes/footer.php';
?>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>




<!-----------
<?

echo '<br><div class="ContentHolder"><div class="container">';
if(@$_POST['status']=='result')
{
	$result = $this->db->query("SELECT * FROM results where roll_no = '".$_POST['roll_no']."'");
	if($result->num_rows)
	{
		$__R = $result->row(); 
		$course = $this->db->query("SELECT * FROM courses where id = '".$__R['course_id']."'")->row();
		$stu = $this->db->query("SELECT * FROM students where dob = '".$_POST['dob']."' AND enrollment_no = '".$__R['enrollment_no']."' ");
		if($stu->num_rows)
		{
			$__S = $stu->row();
			$institute = $this->db->query("SELECT * FROM centers where id = '".$__S['center_id']."'")->row();
			?>
			<style>
			    .box-body table tbody tr th ,.box-body table tbody tr td {
			        text-align:left;
			        padding-left:10px;
			        
			    }
			</style>
				<div class="box box-default" style="">
					<div class="box-header"><h3>Result</h3></div> 
					<div class="box-body" id="printableArea" style="position:relative;padding-bottom: 227px;z-index:1">
					    <img src="0001.jpg" style="position: absolute;z-index:-1;width:100%;height:100%;left: 0;">
					    <div style="padding: 100px;margin-top: 283px;">
    						<table>
    							<tbody>
    								<tr><td rowspan="8"><img src="uploads/students/<?=$__S->photo?>" style="width: 100%;height: 200px"></td></tr>
    								<tr><th>Institute Name</th> <td> <?=$institute['institute_name']?></td></tr>
    								<tr><th>Registration No.</th> <td><?=$__S['enrollment_no']?></td></tr>
    								<tr><th>Roll No.</th> <td><?=$__R['roll_no']?></td></tr>
    									<tr><th>Course</th> <td><?=$course['course_name']?></td></tr>
    								<tr><th>Student Name</th> <td><?=ucwords($__S['name'])?></td></tr>
    								<tr><th>Father Name</th> <td><?=ucwords($__S['father'])?></td></tr>
    								<tr><th>Mother Name</th> <td><?=ucwords($__S['mother'])?></td></tr>
    							</tbody>
    						</table>
    						<table >
    							<tbody>
    								<tr>
    									<th>Subject Name</th>
    									<th>Max Marks</th>
    									<th>Min Marks</th>
    									<th>Obtain Marks</th>
    									<th>Result </th>
    								</tr>
    								<?
    									$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$__R['id']."'");
    									$rows = $marks->num_rows+1;
    									$i=1;
    									$ttl=0;
    									while($mm = $marks->row())
    									{
    										$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm['subject_id']."'")->row();
    										echo '
    												<tr>
    													<th>'.ucwords($sub['subject_name']).'</th>
    													<td>'.$sub['max_marks'].'</td>
    													<td>'.$sub['min_marks'].'</td>
    													<td>'.$mm['marks'].'</td>';
    													if($i==1)
    														echo '<td rowspan="'.$rows.'"><b>'.ucwords($__R['result']).'</b></td>';
    												echo '</tr>
    										';
    										$ttl+=$mm['marks'];
    										$i++;
    									}
    									echo '<tr><th>Total</th><td></td><td></td><td><b>'.$ttl.'</b></td></tr>';
    								?>
    							</tbody>
    						</table>
					    </div>
					</div>
					<div class="box-footer">
						<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>
			<?
		}
		else
		{
			
			
			echo '<script>alert("Date of birth not matched.");location.href="get-result"</script>';
		}
	}
	else
	{
		//echo '<script>alert("Roll no. not matched.");location.href="get_result.php"</script>';
	}
}
else
{
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-warning">
		<div class="box-header"><h3>Download Result</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Roll No.</label>
					<input type="text" class="form-control" name="roll_no" placeholder="Enter Roll No.">
				</div>
				<div class="form-group">
					<label>Date of birth</label>
					<input type="date" class="form-control" name="dob" placeholder="Enter D.O.B ">
				</div>
				<div class="form-group">
					<button class="btn btn-warning" type="submit" name="status" value="result">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?
}
echo '</div></div>';

?>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>



---->