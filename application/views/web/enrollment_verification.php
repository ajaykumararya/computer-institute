<?

echo '<br><div class="ContentHolder"><div class="container">';
if(@$_POST['status']=='enrollment_verification')
{
    
    //echo $_POST['dob'];
    
    $get = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".date('Y-m-d',strtotime($_POST['dob']))."'  AND pay_status = 1");
  // print_r($get->num_rows());
   $check = $get->num_rows();
    if($check > 0)
    {
        $g = $get->row();
         $center = $this->db->query("SELECT * FROM centers where id = '".$g->center_id."'")->row();
         $course = $this->db->query("SELECT * FROM courses where id = '".$g->course_id."'")->row();
       //($center);
       
      // print_r($g->course_id);
        ?>
            <style>
                #form{display:none;}
            </style>
           <div class="box box-default">
               <div class="box-header"><h3>ENROLLMENT VERIFICATIION</h3></div>
               <div class="box-body" id="printableArea">
                    <table class="table table-bordered">
                        <tbody>
                            <tr><th colspan="2">Student ENROLLMENT Verification</th></tr>
                             <tr><th>Registration No </th><td><?php echo @$g->enrollment_no?></td></tr>
                             <tr><th>Student Name </th><td><?php echo @$g->name?></td></tr>
                             <tr><th>Father's Name </th><td><?php echo @$g->father?></td></tr>
                             <tr><th>Address  </th><td><?php echo @$g->address?></td></tr>
                             
                             <tr><th>Institute Name</th><td> ( <?php echo @$center->center_number?> )<?php echo @$center->institute_name?> </td></tr>
                            <?
                              
                              //print_r($g->photo);  
                                foreach($get->result() as $key => $value)
                                {
                                    if($key=='id' || $key=='timestamp' || $key=='password' || $key=='course_id' || $key=='center_id' || $key=='photo' || $key=='transection_id' || $key=='status')
                                        continue;
                                    //echo '<tr><th>'.ucwords(str_replace('_',' ',$key)).'</th> <td>'.$value.'</td></tr>';
                                    echo '<tr><th></th> <td></td></tr>';
                                }
                            ?>
                            <tr><th>Course</th><td><?php echo  @$course->course_name ?></td></tr>
                            <tr><th>Photo</th><td><img style="width:100px;height:120px;" src="<?php echo base_url(); ?>uploads/<?php echo  $g->photo ?>"></td></tr>
                        </tbody>
                    </table>
               </div>
               <div class="box-footer">
                   	<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
               </div>
           </div>
        <?
    }
    else
    {
        echo '<div class="alert alert-danger">Invalid Registration No. OR Date of birth!</div>';
    }
}
?>
<div class="col-md-6 col-md-offset-3" id="form">
	<div class="box box-success">
		<div class="box-header"><h3>Enrollment Verification</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Enrollment No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No.">
				</div>
				<div class="form-group">
					<label>Date of Birth</label>
					<input type="date" class="form-control" name="dob" placeholder="Enter D.O.B ">
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit" name="status" value="enrollment_verification">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?
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