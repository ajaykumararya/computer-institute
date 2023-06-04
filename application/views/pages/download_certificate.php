  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<?
echo '<br><div class="ContentHolder"><div class="container">';
// if(@$_POST['status']=='result')
// {
    $student=$this->db->query("SELECT * FROM students where id = '".@$this->uri->segment(3)."' ")->row();
    if(!isset($student)){
        redirect('admin/dashboard');
    }
    $result = $this->db->query("SELECT * FROM student_certificate where enrollment_no = '".@$student->enrollment_no."' ")->row();
    
    // die(var_dump($result->obt_marks ,$result->max_marks));
	$course=$this->db->query("SELECT * FROM courses where id = '".@$student->course_id."' ")->row();
// 	$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".@$result->id."' and year = '".@$result->year."'");
//         								    //print_r($marks);
//         									$rows = $marks->num_rows()+1;
//         									$i=1;
//         									$ttl=0;
//         									$tot=0;
//         									$tot_practical=0;
//         									$tot_marks=0;
//         									$grand_ttl=0;
//         									$grand_total=0;
        									
//         									foreach($marks->result() as $mm){    
        									    
//         										$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm->subject_id."'")->row();
//         										$total_marks= @$sub->max_marks + @$sub->practical_max_marks;
//         										$ob_marks=@$mm->marks + @$mm->practical_marks;
        									
//         										$ttl+=$mm->marks;
//         										$tot+=$sub->max_marks;
//         										$tot_practical+=$sub->practical_max_marks;
//         										$tot_marks+=$mm->practical_marks;
//         										$grand_ttl+=$ob_marks;
//         										$grand_total+=$total_marks;
        										
//         										$i++;
//         									}
// 	$results=$result->row();
// 	$result_array=$result->result();
// 	if($result->num_rows() > 0)
// 	{
	   // if($results->year==1){
	   //     $year_name='FIRST YEAR';
	   // }elseif($results->year==2){
	   //     $year_name='SECOND YEAR';
	   // }
	   // elseif($results->year==3){
	   //     $year_name='THIRD YEAR';
	   // }elseif($results->year==4){
	   //     $year_name='FOURTH YEAR';
	   // }elseif($results->year==5){
	   //     $year_name='FIFTH YEAR';
	   // }else{
	   //     $year_name='';
	   // }
// 		$__R = $result->row(); 
// 		die(var_dump($__R));
// 		$course = $this->db->query("SELECT * FROM courses where id = '".$__R->course_id."'")->row();
// 		 $course_id=$__R->course_id;
// 	        	$enrollment_no=$__R->enrollment_no;
// 		$stu = $this->db->query("SELECT * FROM students s left join  session_year se on se.id=s.session where s.dob = '".$_POST['dob']."' AND s.enrollment_no = '".$__R->enrollment_no."' ");
	    //echo $stu->num_rows();
// 		if($stu->num_rows() > 0)
// 		{
// 			$__S = $stu->row();
    
            //print_r($__S);

// 			$institute = $this->db->query("SELECT * FROM centers where id = '".$__S->center_id."'")->row();
			
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
			    <div class="col-md-12" id="content">
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: 500px;z-index:1">
					    <!--<img src="<?php echo base_url('img/');  ?>0001.jpg" style="position: absolute;z-index:-1;width:100%;height:100%;left: 0;">-->
					      	    <img src="<?php echo base_url('uploads/');  ?>CERTIFICATE.jpg" alt="<?php echo base_url('img/');  ?>MARKSHEET.jpg" style="position: absolute;z-index:-1;width:100%;height:75%;left: 0;"> 
					       <!--<img src="<?php echo base_url('uploads/'. $__S->photo) ?>" class="pull-right" style="width: 100px;height: 120px;margin-right:80px;margin-top:155px;">-->
				<div class="row" style="padding-top:380px;">
				   
	            </div>
	            <br>
	            
	            <br>
	            <h4 class="text-center"><b></b></h4>
	            <br>
	            <br>
	            <h4 class="text-center"><b></b></h4>
	             <table style="width:100%;margin-left:70px;font-size:24px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                               <b>This is to certify that &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><?php echo @$student->name;?>
                                        </u></b> 
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
                            <tr>
	                           
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	                 <table style="width:100%;margin-left:70px;font-size:24px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                               <b>Son / Daughter of &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><?php echo @$student->father;?>
                                        </u></b> 
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	               <table style="width:100%;margin-left:72px;font-size:24px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                               <b>appeared in  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><?php echo @$course->course_name;?>
                                        </u></b> 
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	               <table style="width:100%;margin-left:70px;font-size:24px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                               <b>Examination of the Council held in  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><?php echo date('F-Y',strtotime(@$result->timestamp));?>
                                        </u></b> 
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	               <table style="width:100%;margin-left:70px;font-size:24px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                               <b>and has been declared  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >PASS
                                        </u></b> 
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	                <?php
	                            $grand_ttl=0;
	                            $grand_total=0;
	                            
	                            if(empty($this->uri->segment(3))){
	                              $division=''; 
	                              
	                            }elseif(!isset($result->obt_marks) && !isset($result->max_marks)){
	                                $division=''; 
	                                $grand_ttl=0;
	                                 $grand_total=0;
	                                   //die(var_dump($result->obt_marks ,$result->max_marks)); 
	                                }else{
	                               
	                                $grand_ttl=@$result->obt_marks;
	                                $grand_total=@$result->max_marks;
					            $x=($grand_ttl/$grand_total)*100;
					           // echo $x;
					       
					        if($x<33 ){
					            $division='FAILED' ;
					        }
					        elseif($x>=33 && $x<45){
					            $division='PASSED WITH THIRD DIVISION' ;
					            
					        }
					        elseif($x>=45 && $x<60){
					            $division='PASSED WITH SECOND DIVISION' ;
					            
					        }
					        elseif($x>=60 && $x<75){
					            $division='PASSED WITH FIRST DIVISION' ;
					           
					        }elseif($x>=75){
					            $division='PASSED WITH HOUNOURS ' ;
					            
					        }
	                            }
	                        ?>
	               <table style="width:100%;margin-left:70px;font-size:24px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                              <b>He / She is</b> <b>scored  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><?php echo @$grand_ttl;?>
                                        </u></b> <b>&nbsp;marks out of &nbsp;</b><u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><b><?php echo @$grand_total;?></b>
                                        </u>
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	              
	               <table style="width:100%;margin-left:70px;font-size:20px;">
	                    <tbody>
	                       <tr>
	                           <td>
	                               <b>marks and is placed in   &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><?php echo $division;?>
                                        </u></b> &nbsp;<br><b>Division</b>
	                           </td>
                                <td>
                                    <b>
                                         
                                    </b>
                                </td>
                            </tr> 
	                        
	                    </tbody>				      
	               </table>     
	               <!--<div class="row">-->
	               
			
					        
					 </div>   
					    
			    </div>
			    <div class="col-md-12">
			        			    </div>
			</div>
			<!--<br>-->
			<div class="box-footer">
						<!--<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>-->
						<!--<button class="btn btn-default float-center" onclick="CreatePDFfromHTML()"><i class="fa fa-print"></i> Print</button>-->
						<a href="<?php echo site_url('printbill/print_certificate/'.$this->uri->segment(3).' ') ?>" target="_blank" class="btn btn-success pull-right">
                                                    <i class="fa fa-download "> Generate PDF </i>
                                                </a>
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
		
			
					
				</div>
			<?
// 		}
// 		else
// 		{
// 			//echo '<script>alert("Date of birth not matched.");location.href="get_result.php"</script>';
// 			echo '<script>alert("Date of birth not matched.");</script>';
// 		}
// 	}
	
// }

echo '</div></div>';
?>
<br>
	<script src="<?php echo base_url();?>/assets/js/jquery-2.1.4.min.js"></script>
	
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript">
function CreatePDFfromHTML() {
    // alert();
    var HTML_Width = $("#content").width();
    var HTML_Height = $("#content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("preview.pdf");
        // $("#content").hide();
    });
}

</script>
