    
<?php
if(empty($_SESSION['userid'])){
    redirect('home');
}
        $row=$this->db->query('select *,s.id as sid,s.name as name from students s left join  centers  c  on s.center_id=c.id	 left join courses co on co.id=s.course_id left join session_year se on se.id=s.batch left join session_year ses on ses.id=s.session left join state st on st.STATE_ID=s.state left join city ci on ci.id=s.city  where s.id="'.@$_SESSION['userid'].'"')->row();
        // echo $row->id
        // die(var_dump($row));
//   $row =   $this->db->get_where('students',['id'=>@$_SESSION['userid']])->row();
if(empty($row)){
    redirect('home');
}
$logo=$this->db->get('site_setting')->row();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $title?></title>
    <style>
        .border-width, tr, td, th {
            border-width: 2px;
            border-color: black;
        }
        div.solid {
            border: 1px solid black;
            padding: 0px 30px 5px 30px;
            margin-top: 20px;
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
  </head>
  <body>
  
<div class="container solid" id="content">
    <div >
  <div >
      <br>
      
      <div class="logoName">
					<img src="<?php echo base_url('uploads/').$logo->SS_HOME_BANNER1; ?>" />
				</div>
    <h4 class="text-center"><b>Admission Details</b> </h4>
    <br>
    <div class="row">
        <table class="table table-bordered border-width">
            <tr>
                <th><b> 1. Admission Date</b></th>
                <th><b> 2. Academy </b> </th>
                <th><b> 3. Course</b></th>
                <th><b> 4. Batch</b></th>
                <th><b>5. Session</b>  </th>
            </tr>
            <tr>
                <td>  <?php echo @$row->addmission_date;?></td>
                <td>  <?php echo @$row->institute_name	;?> </td>
                <td>  <?php echo @$row->course_name;?></td>
                <td>  <?php echo @$row->start;?>-<?php echo @$row->end?></td>
                <td>  <?php echo @$row->start;?>-<?php echo @$row->end?></td>
            </tr>
            <tr>
                <th><b>6. Franchise</b></th>
                <th><b> 7. Student Name </b></th>
                <th><b> 8. Email-ID</b></th>
                <th><b> 9. Mobile No</b></th>
                <th> <b>10. Date of Birth</b> </th>
            </tr>
                <tr>
                <td>  <?php echo @$row->institute_name;?></td>
                <td>  <?php echo @$row->name;?> </td>
                <td>  <?php echo @$row->email;?></td>
                <td>  <?php echo @$row->mobile?></td>
                <td>  <?php echo date('d/m/Y',strtotime(@$row->dob));?></td>
            </tr>
            <tr>
                <th><b> 11. Mother Name</b></th>
                <th> <b>12. Father Name </b></th>
                <th> <b>13. Parent Occupation</b></th>
                <th><b> 14. Medium </b></th>
                <th><b>15. Address </b> </th>
            </tr>
                <tr>
                <td>  <?php echo @$row->mother;?></td>
                <td>  <?php echo @$row->father;?> </td>
                <td>  <?php echo @$row->occupation	;?></td>
                <td>  <?php echo @$row->medium?></td>
                <td>  <?php echo @$row->address;?></td>
            </tr>
            <tr>
                <th><b> 16. Pincode</b> </th>
                <th><b> 17. Country</b> </th>
                <th><b> 18. State</b></th>
                <th><b> 19. City</b> </th>
                <th><b> 20. Gender </b> </th>
            </tr>
                <tr>
                <td>  <?php echo @$row->pincode;?></td>
                <td>  <?php echo @$row->country;?> </td>
                <td>  <?php echo @$row->STATE_NAME	;?></td>
                <td>  <?php echo @$row->city_name?></td>
                <td>  <?php echo @$row->gender;?></td>
            </tr>
            <tr>
                <th> <b>21. Martial Status</b> </th>
                <th> <b>22. Nationality </b></th>
                <th><b> 23. Blood Group</b></th>
                <th><b> 24. Mother Tongue </b> </th>
                <th><b> 25. Religion  </b></th>
            </tr>
                <tr>
                <td>  <?php echo @$row->marrital_status;?></td>
                <td>  <?php echo @$row->nationality;?> </td>
                <td>  <?php echo @$row->blood_group	;?></td>
                <td>  <?php echo @$row->mother_tongue?></td>
                <td>  <?php echo @$row->religion;?></td>
            </tr>
            <tr>
                <th><b> 26. Community</b> </th>
                <th><b> 27. Place of Birth</b> </th>
                <th><b> 28. Physically Chanlanged </b></th>
                <th><b> 29. Occupation  </b></th>
                <th><b> 30. Status  </b></th>
            </tr>
                <tr>
                <td>  <?php echo @$row->community;?></td>
                <td>  <?php echo @$row->father;?> </td>
                <td>  <?php echo @$row->occupation	;?></td>
                <td>  <?php echo @$row->occupation?></td>
                <td>  <?php
                if($row->status==0){
                    echo 'APPROVE';
                    
                }
                // elseif($row->pay_status==0){
                //     echo 'COMPLETE';
                // }
                elseif($row->status==1){
                    echo 'CANCEL';
                    
                }
            ?>
                </td>
            </tr>
            
            
            
        </table>
        <h4 class=""><b>Educational Qualification</b> </h4>
        <br><br>
        <table class="table table-bordered border-width">
            <tr>
                <th> <b> Qualification</b></th>
                <th><b>  Reg No. </b></th>
                <th><b>  Subject</b></th>
                <th><b>  Board/University</b></th>
                <th> <b> Year of Completion</b></th>
                <th><b>Percentage of Marks</b></th>
            </tr>
            <tr>
                <td>  <?php echo @$row->highest_qualification;?></td>
                <td>  <?php echo @$row->reg_no	;?> </td>
                <td>  <?php echo @$row->subject;?></td>
                <td>  <?php echo @$row->board;?></td>
                <td>  <?php echo @$row->passing_year;?></td>
                <td>  <?php echo @$row->marks ;?> %</td>
            </tr>
            
        </table>
        <h4 class=""><b>Documents </b> </h4><br><br>
        <table class="table table-bordered border-width">
            <tr>
                <th> <b> Passport Size Photo Graph</b></th>
                <th><b>  10th Mark sheet</b> </th>
                <th> <b> 12th Mark sheet</b></th>
                <th> <b> Graduation Mark sheet</b></th>
                <th> <b> Graduation Degree</b></th>
                <!--<th>Percentage of Marks</th>-->
            </tr>
            <tr>
                <td> 
                     <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$row->tenth_marksheet?>" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="<?php echo base_url('uploads/').$row->photo?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                </td>
                <td>
                    <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$row->tenth_marksheet?>" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="<?php echo base_url('uploads/').$row->tenth_marksheet?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                      
                </td>
                <td> 
                          <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$row->twelve_marksheet?>" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="<?php echo base_url('uploads/').$row->twelve_marksheet?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                
                </td>
                <td> 
                         <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$row->graduation_marksheer?>" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="<?php echo base_url('uploads/').$row->graduation_marksheer?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>     
                
                
                </td>
                <td> 
                 <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$row->graduation_degree?>" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="<?php echo base_url('uploads/').$row->graduation_degree?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>     
                
                
                </td>
            </tr>
            
        </table>
            
    </div>
  </div>
  </div>
</div>
<div style="text-align: center;margin-top: 5px;">
    <a id="cmd" href="<?php echo base_url('printbill/admission_form/').$row->sid;?>"  class="btn btn-primary float-center"> Download</a>
  </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <script src="<?php echo base_url(); ?>assets/theme_assets/js/jquery-3.2.1.min.js"></script>

<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script type="text/javascript"> 
// var doc = new jsPDF();
// var specialElementHandlers = {
//     '#editor': function (element, renderer) {
//         return true;
//     }
// };

// $('#cmd').click(function () {
//     doc.fromHTML($('#content').html(), 15, 15, {
//         'width': 170,
//             'elementHandlers': specialElementHandlers
//     });
//     doc.save('sample-file.pdf');
// });

function CreatePDFfromHTML() {
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
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>