  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<?

echo '<br><div class="ContentHolder"><div class="container">';


 	$admit = $this->db->query("SELECT * FROM admit_card where id = '".$this->uri->segment(2)."'");
 	$admit_num=$admit->num_rows();
 	$admit_row=$admit->row();
 	$stu = $this->db->query("SELECT *,s.id as id FROM students s left join session_year se on s.batch=se.id  where enrollment_no = '".$admit_row->enrollment_no."'");
 	$stu_num=$stu->num_rows();
//  	die(var_dump($stu_num,$admit_num));
//  	die(var_dump("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."'","SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'"));
//  	if($stu_num>0 && $admit_num>0)
//  	{
 		$s = $stu->row();
 		$a = $admit->row();
 		$c = $this->db->query("SELECT * FROM centers where id = '".$s->center_id."'")->row();
	$course = $this->db->query("SELECT * FROM courses where id = '".$s->course_id."'")->row();
// 	$subjects=$this->db->get_where('subjects',['course_id'=>$s->course_id])->result();
	$exam=$this->db->query("select *,a.type as type,a.id as exam_id,s.id as subject_id from Assign_exam_student a  left join exam_schedule e on e.id=a.exam_id left join subjects s on a.subject_id=s.id where a.student_id='".$s->id."'")->result();
		?>
		<div class="containter row" id="content">
		<div class="col-md-12">
			        <div class="logoName">
					<img src="<?php echo base_url('img/');  ?>header_image.jpg" />
				</div> 
			         <!--<div class="box-header"><h3>Result</h3></div> -->
				    <center>	
					 
			        </center>
			    </div>
		
			<div class="box box-default">
		<div class="box-header">
		    <h5 class="text-center">Admit Card</h5>
		    </div><br>		
				<!--<div class="box-body" id="printableArea">-->
					<!--<table class="table table-bordered">-->
					<!--	<tbody>-->
					<!--			<tr><th>Institute Name</th> <td><?=@$c->institute_name?></td></tr>-->
					<!--		<tr><th>Enrollment No.</th> <td><?=$s->enrollment_no?></td></tr>-->
					<!--		<tr><th>Roll No.</th> <td><?=$a->roll_no?></td></tr>-->
					<!--		<tr><th>Student Name</th> <td><?=$s->name?></td></tr>-->
					<!--		<tr><th>Father Name</th> <td><?=$s->father?></td></tr>-->
					<!--		<tr><th>Mother Name</th> <td><?=$s->mother?></td></tr>-->
					<!--		<tr><th>Course</th> <td><?=$course->course_name?></td></tr>-->
					<!--	</tbody>-->
					<!--</table>-->
				<!--</div>-->
				
					<div class="row box-body" style="padding-left:;">
					    <div class="col-md-9" >
					            <table style="width:100%;margin-left:40px;font-size:14px; text-align:center;" >
					                		<tbody style="border:  1px solid;">
					                		   <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Roll no :</b> </th>
            								        <td style="border: 1px solid; text-align:center;"><?php echo $a->roll_no;?></td>
            									    <th style="border: 1px solid; text-align:center;"><b>Enroll No :</b></th>
            									    <th style="border: 1px solid; text-align:center;"><?php echo $s->enrollment_no;?></th>
            									   
        								      </tr>
        								      <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Course :</b> </th>
            								        <td style="border: 1px solid; text-align:center;"><?php echo $course->course_name;?></td>
            									    <th style="border: 1px solid; text-align:center;"><b>Batch :</b></th>
            									    <th style="border: 1px solid; text-align:center;"><?php echo $s->start;?>-<?php echo $s->end;?></th>
            									   
        								      </tr>
        								      <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Student's Name :</b> </th>
            								        <td style="border: 1px solid; text-align:center;"><?php echo $s->name;?></td>
            									    <th style="border: 1px solid; text-align:center;"><b>DOB :</b></th>
            									    <th style="border: 1px solid; text-align:center;"><?php echo date('d/m/Y',strtotime($s->dob));?></th>
            									   
        								      </tr>
        								      <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Father's Name :</b> </th>
            								        <td style="border: 1px solid; text-align:center;"><?php echo $s->father;?></td>
            									    <th style="border: 1px solid; text-align:center;"><b>Mother's Name :</b></th>
            									    <th style="border: 1px solid; text-align:center;"><?php echo $s->mother;?></th>
            									   
        								      </tr>
        								      <tr style="border: 1px solid;">
        								         <td style="border: 1px solid; text-align:center;"><b>Examination Center :</b> </td> 
        								         <td style=" text-align:center;"><?php echo $c->institute_name;?> </td> 
        								      </tr>
					                		 </tbody>
					           </table>
					  </div>
					    <div class="col-md-3">
		                    <table style="width:50%;margin-left:40px; text-align:center;">
		                        <tbody>
		                            <tr>
		                                <td>
		                                    <div style="width:150px; height:150px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$s->photo?>" target="_blank"><img style="width:50%; height:50%;"class="img-responsive" src="<?php echo base_url('uploads/').$s->photo?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
		                </div>
				    </div>
			<br>
			<div class="row box-body" style="padding-left:;">
					    <div class="col-md-12" >
					            <table style="width:90%;margin-left:40px;font-size:14px; text-align:center;" >
					                		<tbody style="border:  1px solid;">
					                		   <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Sr. No :</b> </th>
            								        <th style="border: 1px solid; text-align:center;">Subject Code. No :</td>
            									    <th style="border: 1px solid; text-align:center;"><b>Subject Name :</b></th>
            									    <th style="border: 1px solid; text-align:center;">Date </th>
            									    <th style="border: 1px solid; text-align:center;">Start Time </th>
            									    <th style="border: 1px solid; text-align:center;">End Time </th>
            									   
        								      </tr>
        								      <?php 
        								                $i=1;
        								                foreach($exam as $row){
        								                    if($row->type==1){
        								                        $type='PRACTICAL';
        								                    }else{
        								                        $type='';
        								                    }
        								          ?>
        								      <tr style="border: 1px solid;">
        								          
            								        <td style="border: 1px solid; text-align:center;"><b><?php echo $i;?> </b> </td>
            								        <td style="border: 1px solid; text-align:center;"><?php echo $row->subject_id;?></td>
            									    <td style="border: 1px solid; text-align:center;"><b><?php echo $row->subject_name.' '.$type;?> </b></td>
            									    <td style="border: 1px solid; text-align:center;"><?php echo date('d/m/Y',strtotime($row->exam_date));?></td>
            									    <td style="border: 1px solid; text-align:center;"><?php echo $row->start_time;?></td>
            									    <td style="border: 1px solid; text-align:center;"><?php echo $row->end_time;?></td>
            									  
            									   
        								      </tr>
        								      <?php
            									    $i++;
        								                }
            									  ?>
        								      
					                		 </tbody>
					           </table>
					  </div>
			</div>
		
		
		
		
		<br>
		<div class="row box-body" style="padding-left:;">
					    <div class="col-md-12" >
					            <table style="width:80%;margin-left:40px;font-size:11px;" >
					                		<tbody>
					                		    <tr>
					                		        <td>
					                		            <b>NOTE :</b>
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td>
					                		            1. Please Check Name, Father & Mother Name etc. If you found any incorrect entry in this admit card, you can represent immediately.
					                		            Correction will not be entertained after completion of exam.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td>
					                		            2. Students should carefully fill the Roll Number, Subject Code etc.in the Answer book
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td>
					                		            3. Students should not write his/her name or any identity in any part of the Answer Book.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td>
					                		            4. Students will bring his/her Admit Card during the examination and must produce the same when asked for.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td>
					                		            5. Students should not bring any slip/book/scripts in the examination hall otherwise they will be booked under unfair means.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td>
					                		            
                                                            6. In case of loss of Admit Card, Duplicate Admit Card can be issued from the office of Controller of Examinations with the 
                                                            Payment of Rs 50/- with certified photograph.
					                		        </td>
					                		    </tr>
					                		 </tbody>
					           </table>
					      <!--<p><b>Note :</b></p>  -->
					   </div>
		</div>	
		<br>
		<div class="row box-body" style="padding-left:10px;">
					    <div class="col-md-12" >
					            <table style="width:100%;margin-left:75px;font-size:14px;" >
					                		<tbody>
					                		    <tr>
					                		        <td>
					                		            <b>Full Signature of candidate :</b>
					                		        </td>
					                		    
					                		    
					                		    
					                		        <td style="margin-left:275px;">
					                		            
                                                            <b>Controller of Examinations</b>
					                		        </td>
					                		    </tr>
					                		 </tbody>
					           </table>
					      <!--<p><b>Note :</b></p>  -->
					   </div>
		</div>	
		</div>
		</div>

		<div class="box-footer">
				
					<button class="btn btn-default float-center" onclick="CreatePDFfromHTML()"><i class="fa fa-print"></i> Print</button>
					
				</div>
		<br>
		<?php
// 	}
// 	else
// 	{
	    
// 		echo '<script>alert("admit card not created.");location.href="admin/download_admit_card"</script>';
// 	}


echo '</div></div>';

?>
<br><br>
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
    var top_left_margin = 1;
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
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>