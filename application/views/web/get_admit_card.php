<?

echo '<br><div class="ContentHolder"><div class="container">';

?>
<div class="col-md-6 col-md-offset-3" id="form">
	<div class="box box-success">
		<div class="box-header"><h3>GENERATE ADMIT CARD </h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Enrollment No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Enrollment No.">
				</div>
				<div class="form-group">
					<label>D.O.B </label>
					<input type="text" class="form-control" name="dob" placeholder="DD-MM-YYYY  ">
				</div>
				<div class="form-group">
					<button class="btn btn-success" type="submit" name="status" value="enrollment_verification">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?

if(@$_POST['status']=='enrollment_verification')
{
    
    //echo $_POST['enrollment_no'].'--'.$_POST['dob'].' ';
    
    $get = $this->db->query("SELECT ad.roll_no as student_roll_no, s.enrollment_no as student_enrollment_no, s.name as name ,ad.id as card_id,s.id as id,s.dob as dob,ad.year as course_year FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no where s.enrollment_no = '".$_POST['enrollment_no']."' AND s.dob='".date("Y-m-d", strtotime($_POST['dob']) )."'   AND s.pay_status = 1 ");
  // print_r($get->num_rows());
   $check = $get->num_rows();
    if($check > 0)
    {
        echo '<table>
                <tr>
                    <th>Sr.No</th>
                    <th>Enrollment No</th>
                    <th>Year</th>
                    <th>Rollno</th>
                </tr>';
       $g = $get->result();
       foreach($g as $result_list){
           echo '<tr>
                    <td></td>
                    <td>'.$result_list->student_enrollment_no.'</td>
                    <td>'.$result_list->course_year.'</td>
                    <td>'.$result_list->student_roll_no.' <a href="'.site_url('printbill/admit_card/'.$result_list->card_id.' ').'" target="_blank"><i class="fa fa-print pull-center">Print</i></a></td>
            </tr>';
            
       }
       echo '</table>
       ';
       
       // echo '<script>location.href="'.site_url('printbill/admit_card/'.$g->card_id.' ').'";</script>';
    }
    else
    {
        echo '<div class="alert alert-danger">Sorry Please Contact to Administration</div>';
    }
}

echo '<br><br><br><br>';




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