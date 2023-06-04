<?
echo '<br><div class="ContentHolder"><div class="container">';
if(@$_POST['status']=='result')
{
	$result = $this->db->query("SELECT * FROM results where roll_no = '".$_POST['roll_no']."'");
	if($result->num_rows() > 0)
	{
		$__R = $result->row(); 
// 		die(var_dump($__R));
		$course = $this->db->query("SELECT * FROM courses where id = '".$__R->course_id."'")->row();
		$stu = $this->db->query("SELECT * FROM students where dob = '".$_POST['dob']."' AND enrollment_no = '".$__R->enrollment_no."' ");
	    //echo $stu->num_rows();
		if($stu->num_rows() > 0)
		{
			$__S = $stu->row();
    
            //print_r($__S);

			$institute = $this->db->query("SELECT * FROM centers where id = '".$__S->center_id."'")->row();
			
			//print_r($institute);
			?>
			
			<div class="row">
			    <div class="col-md-12">
			         <div class="box-header"><h3>Result</h3></div> 
				    <center>	
					 
			        </center>
			    </div>
			    <div class="col-md-12">
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: 500px;z-index:1">
					    <img src="<?php echo base_url('img/');  ?>0001.jpg" style="position: absolute;z-index:-1;width:100%;height:100%;left: 0;">
					       
					       <img src="<?php echo base_url('uploads/'. $__S->photo) ?>" class="pull-right" style="width: 100px;height: 120px;margin-right:80px;margin-top:155px;">
					       <div class="row" style="padding-top:385px;">
					        <table style="width:100%;margin-left:225px;font-size:18px;">
    							<tbody>
    								
    								<tr><th>Institute Name</th> <td> <?=@$institute->institute_name?></td></tr>
    								<tr><th>Enrollment No.</th> <td><?=$__S->enrollment_no?></td></tr>
    								<tr><th>Roll No.</th> <td><?=$__R->roll_no?></td></tr>
    								<tr><th>Course</th> <td><?=@$course->course_name?></td></tr>
    								<tr><th>Student Name</th> <td><?=$__S->name?></td></tr>
    								<tr><th>Father Name</th> <td><?=$__S->father?></td></tr>
    								<tr><th>Mother Name</th> <td><?=$__S->mother?></td></tr>
    							</tbody>
    						</table>
					        </div>
					        
					        <div class="row">
					            <table style="width:60%;margin-left:210px;font-size:18px;" >
        							<tbody style="border:  1px solid;
">
        								<tr style="border: 1px solid;">
        									<th style="border: 1px solid;">Subject Name</th>
        									<th style="border: 1px solid;">Max Marks</th>
        									<th style="border: 1px solid;">Min Marks</th>
        									<th style="border: 1px solid;">Obtain Marks</th>
        									<th style="border: 1px solid;">Result </th>
        								</tr>
        								<?
        								    
        								
        									$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$__R->id."'");
        								    //print_r($marks);
        									$rows = $marks->num_rows()+1;
        									$i=1;
        									$ttl=0;
        									foreach($marks->result() as $mm){    
        									    
        										$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm->subject_id."'")->row();
        										echo '
        												<tr>
        													<th>'.@$sub->subject_name.'</th>
        													<td style="border: 1px solid;">'.@$sub->max_marks.'</td>
        													<td style="border: 1px solid;">'.@$sub->min_marks.'</td>
        													<td style="border: 1px solid;">'.@$mm->marks.'</td>';
        													
        													if($i==1)
        														echo '<td rowspan="'.$rows.'"><b>'.$__R->result.'</b></td>';
        												echo '
        												</tr>
        										';
        										$ttl+=$mm->marks;
        										$i++;
        									}
        									echo '<tr><th>Total</th><td style="border: 1px solid;"></td><td style="border: 1px solid;"></td><td style="border: 1px solid;"><b>'.$ttl.'</b></td></tr>';
        								?>
        							</tbody>
    						</table>

					        </div>
					        
					 </div>   
					    
			    </div>
			    <div class="col-md-12">
			        			    </div>
			</div>
			
			
			
			
			
			
			<style>
			    .box-body table tbody tr th ,.box-body table tbody tr td {
			        text-align:left;
			        padding-left:10px;
			        
			    }
			</style>
			
			
					<div class="box-footer">
						<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>
			<?
		}
		else
		{
			//echo '<script>alert("Date of birth not matched.");location.href="get_result.php"</script>';
			echo '<script>alert("Date of birth not matched.");</script>';
		}
	}
	else
	{
		echo '<script>alert("Roll no. not matched.");</script>';
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
					<input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No.">
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
<br>
<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
