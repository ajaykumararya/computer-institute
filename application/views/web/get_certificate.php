<?

echo '<br><div class="ContentHolder"><div class="container">';
if(@$_POST['status']=='enrollment_verification')
{
    
    // echo $_POST['dob'];
    // exit;
    
    $get = $this->db->query("SELECT *,r.status as status,st.id as student_id,r.year as year,c.type as ctype, r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,c.course_name,c.duration FROM `results` r  left join courses c on c.id=r.course_id left join students st on st.enrollment_no=r.enrollment_no   where st.enrollment_no = '".$_POST['enrollment_no']."' AND st.dob = '".$_POST['dob']."'  AND st.pay_status = 1  AND r.status = 1");
  // print_r($get->num_rows());
   $check = $get->num_rows();
    if($check > 0)
    {
        $g = $get->row();
        echo '<script>location.href="'.site_url('printbill/print_certificate/'.AJ_ENCODE($g->student_id).' ').'";</script>';
    }
    else
    {
        echo '<div class="alert alert-danger">Sorry Please Contact to Administration</div>';
    }
}
?>
<div class="col-md-6 col-md-offset-3" id="form">
	<div class="box box-success">
		<div class="box-header"><h3>GET CERTIFICATE </h3></div>
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