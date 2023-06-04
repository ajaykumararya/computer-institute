<script src="<?php echo base_url();?>/assets/js/jquery-2.1.4.min.js"></script>


<div class="col-md-6 col-md-offset-3" id="form">
	<div class="box box-success">
		<div class="box-header"><h3> GET MARKSHEET </h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Enrollment No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No.">
				</div>
				<div class="form-group">
					<label>D.O.B </label>
					<input type="text" class="form-control" name="dob" placeholder="dd-mm-yyyy  ">
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit" name="status" value="enrollment_verification">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?

echo '<br><div class="ContentHolder"><div class="container">';
if(@$_POST['status']=='enrollment_verification')
{
    
    //echo $_POST['dob'];
    
    $get = $this->db->query("SELECT *,students.enrollment_no as student_enrollment_no, results.id as resultid, results.roll_no as student_rollno, results.year as exam_year   FROM `results` LEFT JOIN students ON students.enrollment_no=results.enrollment_no WHERE students.enrollment_no='".$_POST['enrollment_no']."' AND students.dob='".date("Y-m-d", strtotime($_POST['dob']) )."' ");
  // print_r($get->num_rows());
   $check = $get->num_rows();
    if($check > 0)
    {
        $g = $get->result();
        //echo '<script>location.href="'.site_url('printpdf/print_marksheet/'.$g->RESULT_ID.' ').'";</script>';
        $i=1;
        foreach($g as $g_list){
        ?>  
        
        
            <table>
                    <tr>
                        <th>Sr.No</th>
                        <th>Enrollment No</th>
                        <th>Rollno</th>
                        <th> Year </th>
                        <th>Print Marksheet </th>
                    </tr>
                    
                    <tr>
                        <td><?php echo $i ?></td>
                        <td> <?php echo $g_list->student_enrollment_no;  ?></td>
                        <td> <?php echo $g_list->student_rollno;  ?></td>
                        <td> <?php echo $g_list->exam_year; ?>  </td>
                        <td><a href="<?php echo site_url('printpdf/print_marksheet/'.AJ_ENCODE($g_list->resultid).' '); ?>"><i class="fa fa-print fa fa-primary"> Print Marksheet </i></a></td>
                    </tr>
            
            </table>        
        
    
        <?php
            $i = $i+1;
         }
    }
    

}
echo '</div></div>';
 
?>
<br><br><br><br>


<script type="text/javascript">
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>