<?

if(@$_POST['status']=='result')
{
	$result = $this->db->query("SELECT * FROM results where enrollment_no = '".@$_POST['roll_no']."' and  year = '".@$_POST['year']."' and  course_id = '".@$_POST['course_id']."' ");
	$results=$result->row();
	$result_array=$result->result();
	if($result->num_rows() > 0)
	{
	    if($results->year==1){
	        $year_name='FIRST YEAR';
	    }elseif($results->year==2){
	        $year_name='SECOND YEAR';
	    }
	    elseif($results->year==3){
	        $year_name='THIRD YEAR';
	    }elseif($results->year==4){
	        $year_name='FOURTH YEAR';
	    }elseif($results->year==5){
	        $year_name='FIFTH YEAR';
	    }else{
	        $year_name='';
	    }
		$__R = $result->row(); 
// 		die(var_dump($__R));
		$course = $this->db->query("SELECT * FROM courses where id = '".$__R->course_id."'")->row();
		 $course_id=$__R->course_id;
	        	$enrollment_no=$__R->enrollment_no;
		$stu = $this->db->query("SELECT * FROM students s left join  session_year se on se.id=s.session where s.dob = '".$_POST['dob']."' AND s.enrollment_no = '".$__R->enrollment_no."' ");
	    //echo $stu->num_rows();
		if($stu->num_rows() > 0)
		{
			$__S = $stu->row();
    
            //print_r($__S);

			$institute = $this->db->query("SELECT * FROM centers where id = '".$__S->center_id."'")->row();
			
			//print_r($institute);
			?>
			
			<div class="row">
			 <!--   <div class="col-md-12">-->
			 <!--       <div class="logoName">-->
				<!--	<img src="<?php echo base_url('img/');  ?>header_image.jpg" />-->
				<!--</div>-->
			         <!--<div class="box-header"><h3>Result</h3></div> -->
				<!--    <center>	-->
					 
			 <!--       </center>-->
			 <!--   </div>-->
			    <div class="col-md-12">
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: 500px;z-index:1">
					    <!--<img src="<?php echo base_url('img/');  ?>0001.jpg" style="position: absolute;z-index:-1;width:100%;height:100%;left: 0;">-->
					      	    <img src="<?php echo base_url('uploads/');  ?>MARKSHEET.jpg" alt="<?php echo base_url('img/');  ?>MARKSHEET.jpg" style="position: absolute;z-index:-1;width:100%;height:auto;left: 0;"> 
					       <!--<img src="<?php echo base_url('uploads/'. $__S->photo) ?>" class="pull-right" style="width: 100px;height: 120px;margin-right:80px;margin-top:155px;">-->
				<div class="row" style="padding-top:450px;">
				   <table style="width:80%;margin-left:100px;font-size:18px;">
	                    <tbody>
	                       <tr><td><b>ROLL NO. :</b> <?=$__R->roll_no?></td> <td>  </td><td><b>ENROLLMENT NO. :</b> <?=$__S->enrollment_no?></td> <td><b>SESSION :</b> <?=$__S->start?>-<?=$__S->end?></td></tr> 
	                        
	                    </tbody>				      
	               </table>
	            </div>
	            <br>
	            <h4 class="text-center"><b>STATEMENT OF MARKS</b></h4>
	            <br>
	            <h4 class="text-center"><b><?=@$course->course_name?></b></h4>
	            <br>
	            <br>
	            <h4 class="text-center"><b><?=@$year_name?></b></h4>
	             <table style="width:80%;margin-left:86px;font-size:18px;">
	                    <tbody>
	                       <tr><td><b>NAME. :</b> <?=$__S->name?></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <td><b>S/O,D/O :</b> <?=$__S->father?></td></tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	                 <table style="width:80%;margin-left:86px;font-size:18px;">
	                    <tbody>
	                       <tr><td><b>INSTITUTE NAME : :</b>(<?=@$institute->center_number?>) <?=@$institute->institute_name?></td> </tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	               <!--<div class="row">-->
	               <div class="row" style="padding-left:10px;">
					            <table style="width:80%;margin-left:100px;font-size:14px;" >
        							<tbody style="border:  1px solid;
">
        								<tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" rowspan="2"><b>PAPER</b></th>
        									<th style="border: 1px solid;" rowspan="2"><b>SUBJECT NAME</b> </th>
        									
        									    <th style="border: 1px solid;" colspan="3" ><b>THEORY</b></th>
        									    
        									    
        									<th style="border: 1px solid;" colspan="3"><b>PRACTICAL</b></th>
        									<th style="border: 1px solid;" colspan="2"><b>TOTAL</b></th>
        									<!--<th style="border: 1px solid;">Max Marks</th>-->
        									<!--<th style="border: 1px solid;">Min Marks</th>-->
        									<!--<th style="border: 1px solid;">Obtain Marks</th>-->
        									<!--<th style="border: 1px solid;">Result </th>-->
        								</tr>
        								<tr style="border: 1px solid;">
        								    <th style="border: 1px solid;"><b>Max Marks</b></th>
        									<th style="border: 1px solid;"><b>Min Marks</b></th>
        									<th style="border: 1px solid;"><b>Obtain Marks</b></th>
        									<th style="border: 1px solid;"><b>Max Marks</b></th>
        									<th style="border: 1px solid;"><b>Min Marks</b></th>
        									<th style="border: 1px solid;"><b>Obtain Marks</b></th>
        									<th style="border: 1px solid;"><b>Max Marks</b></th>
        									<th style="border: 1px solid;"><b>Obtain Marks</b></th>
        								</tr>
        								
        								<?
        								    
        								
        									$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$__R->id."'");
        								    //print_r($marks);
        									$rows = $marks->num_rows()+1;
        									$i=1;
        									$ttl=0;
        									$tot=0;
        									$tot_practical=0;
        									$tot_marks=0;
        									$grand_ttl=0;
        									$grand_total=0;
        									
        									foreach($marks->result() as $mm){    
        									    
        										$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm->subject_id."'")->row();
        										$total_marks= @$sub->max_marks + @$sub->practical_max_marks;
        										$ob_marks=@$mm->marks + @$mm->practical_marks;
        										echo '
        												<tr>
        												    <th style="border: 1px solid;"><b>'.@$i.'</b></th>
        													<th style="border: 1px solid;"><b>'.@$sub->subject_name.'</b></th>
        													<td style="border: 1px solid;">'.@$sub->max_marks.'</td>
        													<td style="border: 1px solid;">'.@$sub->min_marks.'</td>
        													<td style="border: 1px solid;">'.@$mm->marks.'</td>
        													
        													
        													<td style="border: 1px solid;">'.@$sub->practical_max_marks.'</td>
        													<td style="border: 1px solid;">'.@$sub->practical_min_marks.'</td>
        													<td style="border: 1px solid;">'.@$mm->practical_marks.'</td>
        													<td style="border: 1px solid;">'.@$total_marks.'</td>
        													<td style="border: 1px solid;">'.@$ob_marks.'</td>
        										
        													
        													';
        													
        													
        													if($i==1)
        												// 		echo '<td rowspan="'.$rows.'"><b>'.$__R->result.'</b></td>';
        												echo '
        												</tr>
        										';
        										$ttl+=$mm->marks;
        										$tot+=$sub->max_marks;
        										$tot_practical+=$sub->practical_max_marks;
        										$tot_marks+=$mm->practical_marks;
        										$grand_ttl+=$ob_marks;
        										$grand_total+=$total_marks;
        										
        										$i++;
        									}
        									echo '<tr style="border: 1px solid;"><td style="border: 1px solid;"><b>GRAND TOTAL</b></th><td style="border: 1px solid;"></td><td style="border: 1px solid;"><b>'.$tot.'</b></td><td style="border: 1px solid;"></td><td style="border: 1px solid;"><b>'.$ttl.'</b></td><td style="border: 1px solid;"><b>'.$tot_practical.'</b></td><td style="border: 1px solid;"></td><td style="border: 1px solid;"><b>'.$tot_marks.'</b></td><td style="border: 1px solid;"><b>'.$grand_total.'</b></td><td style="border: 1px solid;"><b>'.$grand_ttl.'</b></td></tr>';
        								?>
        							</tbody>
    						</table>

					        </div>
					        <br>
						<?php
			if(@$course->type==2){
			   
	        	$cur_year=$__R->year;
	        	$pre_year=$cur_year-1;
	        	$get_marks=$this->db->query('select * from results where course_id="'.$course_id.'" and enrollment_no="'.$enrollment_no.'"')->result();
	        	
	       // 	die(var_dump($get_marks));
	       if($pre_year!=0){
			?>
				  <div class="row" style="padding-left:10px;">
					  <table style="width:80%;margin-left:100px;font-size:18px;" >
        		    	<tbody style="border:  1px solid;">
        		    	    <tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" ><b>YEAR</b></th>
        								    <th style="border: 1px solid;" ><b>MAXIMUM MARKS</b></th>
        								    <th style="border: 1px solid;" ><b>OBTAINED MARKS</b></th>
        					</tr>
        				<?php
        				// $years=0;
        				$years=1;
        				
        				    
        				    foreach($get_marks as $row){
        				        
        				    if($years<=$__R->year){
        				        // print_r($years);
        				        // do{
        				        // 
        				        $markss = $this->db->query("SELECT * FROM marks_table where result_id = '".$row->id."' and year ='".$years."'");
        								    // print_r("SELECT * FROM marks_table where result_id = '".$row->id."' and year ='".$years."'");
        									$rowss = $markss->num_rows()+1;
        									$is=1;
        									$ttls=0;
        									$tots=0;
        									$tot_practicals=0;
        									$tot_markss=0;
        									$grand_ttls=0;
        									$grand_totals=0;
        				        foreach($markss->result() as $mmm){  
        				            $subs = $this->db->query("SELECT * FROM subjects where id = '".$mmm->subject_id."'")->row();
        										$total_markss= @$subs->max_marks + @$subs->practical_max_marks;
        										$ob_markss=@$mmm->marks + @$mmm->practical_marks;
        				        
        				      
        				                      $ttls+=$mmm->marks;
        										$tots+=$sub->max_marks;
        										$tot_practicals+=$sub->practical_max_marks;
        										$tot_markss+=$mm->practical_marks;
        										$grand_ttls+=$ob_markss;
        										$grand_totals+=$total_markss;
        										
        				    }
        				    	
        				?>
        					<tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" ><b><?php echo $row->year;?></b></th>
        								    <th style="border: 1px solid;" ><b><?php echo $grand_totals;?></b></th>
        								    <th style="border: 1px solid;" ><b><?php echo $grand_ttls;?></b></th>
        								    
        					</tr>
        				<?php
        				 $years++;   }
        				 
        				    
        				}   
        				?>
        				
        					
        		    	 </tbody>
        		       </table>
        		    </div>
        	<?php
			}
			}
        	?>
					        <?php
					            $x=($grand_ttl/$grand_total)*100;
					           // echo $x;
					        ?>
					        <?php
					        if($x<33 ){
					            echo ' <h3 class="text-center"><b>RESULT : FAILED </b></h3>';
					        }
					        elseif($x>=33 && $x<45){
					            echo ' <h3 class="text-center"><b>RESULT : PASSED WITH THIRD DIVISION</b></h3>';
					        }
					        elseif($x>=45 && $x<60){
					            echo ' <h3 class="text-center"><b>RESULT : PASSED WITH SECOND DIVISION</b></h3>';
					        }
					        elseif($x>=60 && $x<75){
					           echo ' <h3 class="text-center"><b>RESULT : PASSED WITH FIRST DIVISION</b></h3>';
					        }elseif($x>=75){
					            echo ' <h3 class="text-center"><b>RESULT : PASSED WITH HOUNOURS  </b></h3>';
					        }
	                        ?>
	                         <div style="width:100%;margin-left:100px;font-size:18px; padding-top:110px;">
	                            <img src="<?php echo base_url('temp/').$__R->qr_code;  ?>">
	                        </div>
    					 <!--    <div class="row" style="padding-top:385px;"> -->
					     <!--   <table style="width:100%;margin-left:225px;font-size:18px;">-->
    						<!--	<tbody>-->
    								
    						<!--		<tr><th>Institute Name</th> <td> <?=@$institute->institute_name?></td></tr>-->
    						<!--		<tr><th>Enrollment No.</th> <td><?=$__S->enrollment_no?></td></tr>-->
    						<!--		<tr><th>Roll No.</th> <td><?=$__R->roll_no?></td></tr>-->
    						<!--		<tr><th>Course</th> <td><?=@$course->course_name?></td></tr>-->
    						<!--		<tr><th>Student Name</th> <td><?=$__S->name?></td></tr>-->
    						<!--		<tr><th>Father Name</th> <td><?=$__S->father?></td></tr>-->
    						<!--		<tr><th>Mother Name</th> <td><?=$__S->mother?></td></tr>-->
    						<!--	</tbody>-->
    						<!--</table>-->
					     <!--   </div>-->
					        
<!--					        <div class="row">-->
<!--					            <table style="width:60%;margin-left:210px;font-size:18px;" >-->
<!--        							<tbody style="border:  1px solid;">-->
<!--        								<tr style="border: 1px solid;">-->
<!--        									<th style="border: 1px solid;">Subject Name</th>-->
<!--        									<th style="border: 1px solid;">Max Marks</th>-->
<!--        									<th style="border: 1px solid;">Min Marks</th>-->
<!--        									<th style="border: 1px solid;">Obtain Marks</th>-->
<!--        									<th style="border: 1px solid;">Result </th>-->
<!--        								</tr>-->
        								<?
        								    
        								
        								// 	$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$__R->id."'");
        								//     //print_r($marks);
        								// 	$rows = $marks->num_rows()+1;
        								// 	$i=1;
        								// 	$ttl=0;
        								// 	$tot=0;
        								// 	foreach($marks->result() as $mm){    
        									    
        								// 		$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm->subject_id."'")->row();
        								// 		echo '
        								// 				<tr>
        								// 					<th>'.@$sub->subject_name.'</th>
        								// 					<td style="border: 1px solid;">'.@$sub->max_marks.'</td>
        								// 					<td style="border: 1px solid;">'.@$sub->min_marks.'</td>
        								// 					<td style="border: 1px solid;">'.@$mm->marks.'</td>';
        													
        								// 					if($i==1)
        								// 						echo '<td rowspan="'.$rows.'"><b>'.$__R->result.'</b></td>';
        								// 				echo '
        								// 				</tr>
        								// 		';
        								// 		$ttl+=$mm->marks;
        								// 		$tot+=$sub->max_marks;
        								// 		$i++;
        								// 	}
        								// 	echo '<tr><th>Total</th><td style="border: 1px solid;"></td><td style="border: 1px solid;"></td><td style="border: 1px solid;"><b>'.$ttl.'</b></td></tr>';
        								?>
        		<!--					</tbody>-->
    						<!--</table>-->

					     <!--   </div>-->
					        
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
			    	    .logoName{
			width: 100%;
			float: right;
		/*	padding-right: 30px; */
			display: inline-block;
			vertical-align: middle;
			text-align: center;
		}
		 .logoName img,
		  .officeAddress .ushaLogo .logo img{
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
			</style>
			
			
					<div class="box-footer">
						<!--<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>-->
						<a href="<?php echo base_url('generate-marksheet/').$results->id;?>" target="_blank">		
		    	                    <button class="btn btn-default float-center" ><i class="fa fa-print"></i> Preview</button>
		            	</a>
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
		<div class="box-header"><h3>Download Results</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Enrollment No.</label>
					<input type="text" class="form-control" name="roll_no" placeholder="Enter Roll No.">
				</div>
				<div class="form-group">
					<label>Select Course.</label>
					<select class="form-control get_year_web" name="course_id">
					    <?php
					    $get_course=$this->db->get('courses')->result();
					    foreach($get_course as $row){
					        
					        echo'<option value="'.$row->id.'">'.$row->course_name.'</option>';
					    }
					    ?>
					</select>
					<!--<input type="text" class="form-control" name="course_id" placeholder="Enter Roll No.">-->
				</div>
				<!--<div class="form-group">-->
				<!--	<label>Date of birth</label>-->
				<!--	<input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No.">-->
				<!--</div>-->
				<div class="course_type_web"></div>
				<div class="form-group">
					<label> D.O.B </label>
					<!--<select></select>-->
					<input type="date" class="form-control" name="dob" placeholder="Enter Enrollment No." value="<?php echo date('Y-m-d'); ?>">
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
