<?

echo '<br><div class="ContentHolder"><div class="container">';
if(isset($_POST['enrollment_no']))
{

//  	$admit = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."'");
//  	$admit_num=$admit->num_rows();
 	$stu = $this->db->query("SELECT *,s.id as id FROM students s left join session_year se on s.batch=se.id left join courses c on c.id=s.course_id left join centers ce on ce.id=s.center_id  where s.enrollment_no = '".$_POST['enrollment_no']."' AND s.dob = '".$_POST['dob']."'");
 	$stu_num=$stu->num_rows();
//  	die(var_dump($stu_num,$admit_num));
//  	die(var_dump("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."'","SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."' AND dob = '".$_POST['dob']."'"));
 	if($stu_num>0)
 	{
 		$s = $stu->row();
//  		$a = $admit->row();
//  		$c = $this->db->query("SELECT * FROM centers where id = '".$s->center_id."'")->row();
// 	$course = $this->db->query("SELECT * FROM courses where id = '".$s->course_id."'")->row();
// // 	$subjects=$this->db->get_where('subjects',['course_id'=>$s->course_id])->result();
// 	$exam=$this->db->query("select *,a.id as exam_id,s.id as subject_id from Assign_exam_student a  left join exam_schedule e on e.id=a.exam_id left join subjects s on a.subject_id=s.id where a.student_id='".$s->id."'")->result();
		?>
		<div class="containter row" id="content">
		
			
	<link href="https://fonts.googleapis.com/css?family=Yatra+One&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Glegoo|Kalam&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
  	<link rel="icon" href="../icon.png" type="image/x-icon">
	<style>
		body {
		    /*	font-family: "Yatra One", cursive; */
		}

		.certificate {
			width: 800px;
			padding: 0px 50px;
			margin: 0 auto;
			line-height: 30px;
			background: url("transLogo.png") no-repeat center;
		}

		.certificate .header {
			width: 100%;
		}

		.center {
			text-align: center;
		}

		.relative {
			position: relative;
		}

		.floatLeft {
			display: inline-block;
			float: left;
			vertical-align: middle;
		}

		.floatRight {
			display: inline-block;
			float: right;
			vertical-align: middle;
		}

		.clear {
			clear: both;
		}

		.content,
		.footer {}

		.highlight {
			font-size: 18px;
			padding: 0px 25px;
			color: #ef472b;
		}

		.personPic {
			position: absolute;
			top: 50px;
			right: 0px;
			width: 100px;
			height: 130px;
		}

		.societyLogo {
			position: absolute;
			top: 55px;
			left: 0px;
			width: 120px;
			height: 120px;
		}

		.personPic img,
		.societyLogo img {
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
		.icard{
			width: 950px;
			margin: 0 auto;
			display: flex;
		}
		.icard .front, .icard .back {
			width: 49%;
    		margin: 0 10px;
    		justify-content: space-between;
    		border: 3px solid #065811;
		}
		.icard .back {
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 13px;
		}
		.approvedBy{
			font-size: 13px;
			display: flex;
			justify-content: space-around;
		}
		.logoContainer{
			font-size: 12px;
			height: 65px;
			/* display: flex;
			justify-content: space-around; */
		}
		
		.logoContainer .logo{
    		width: 60px;
    		margin: 4px 10px;
    		display: inline-block;
    		vertical-align: middle;
		}
		.logoContainer .logoName{
			width: 100%;
			float: right;
		/*	padding-right: 30px; */
			display: inline-block;
			vertical-align: middle;
			text-align: center;
		}
		.logoContainer .logo img,
		 .logoContainer .logoName img,
		  .officeAddress .ushaLogo .logo img{
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
		.officeAddress{    
    		background: #065811;
    		color: #fff;
    		width: 100%;
    		height: 90px;
		}
		
		.officeAddress .ushaLogo{
			background: #fff;
			width: 200px;
			margin-top: 3px;
			height: 38px;
			border-radius: 0px 25px 25px 0px;
			font-size: 22px;
			color: #005896;
		}
		.officeAddress .ushaLogo .logo {
            width: 59px;
            margin-top: 5px;
            margin-left: 10px;
		}
		
		.officeAddress .address{
			font-size: 11px;
			width: 215px;
			font-family: sans-serif;
		}
		.empData{
			width: 100%;
		}
		.empData .employeeData{
			width: calc(100% - 120px);
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 12px;
			line-height: 22px;
			
		}
		.empData .employeePhoto{
            width: 90px;
            height: 110px;
            padding: 5px 10px;
		}
		
		.empData .employeePhoto img{
			width: 100%;
			height: 100%;
			object-fit: contain;
		}
		.midBlock{
			display: inline-block;
			vertical-align: middle;
		}
		.signature{
			padding: 20px 0px 5px 0px;
			border-top: 3px solid #065811;
			display: flex;
			justify-content: space-around;
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 12px;
				}
		.center{
			text-align: center;
		}
		.uppercase{
			text-transform: uppercase;
		}
		.paddingTBSml{
			padding: 10px 10px;
		}
		
		.paddingSml{
			padding: 5px 10px;
		}
		.paddingTB{
			padding: 15px 10px;
		}
		.regionalAddress{
			border-top: 2px solid #065811;
			font-family: "Yatra One", cursive;
			color: red;
			text-align: center;
			position: relative;
		}
		
		.regionalAddress .label{
			top: -17px;
			position: absolute;
			left: 35%;
		
			padding: 5px 20px;
		}
	</style>


        <div class="icard">
		<div class="front">
			<div class="logoContainer">
				
				<div class="logoName">
					<img src="<?php echo base_url('img/');  ?>header_image.jpg" />
				</div>
			</div>
			<div class="empData"  style="">
				<div class="employeeData midBlock" >
					<div style="padding: 10px">
					     Name: <span class="uppercase"><?php echo @$s->name; ?></span> <br/>
						Father Name: <span class="uppercase"><?php echo @$s->father; ?></span> <br/>
						Course Name: <span class="uppercase"><?php echo @$s->course_name; ?> <br/>
						Batch: <span class="uppercase"><?php echo @$s->start; ?>-<?php echo @$s->end; ?></span> <br/>
						Enroll No: <?php echo  @$s->enrollment_no; ?> <br/>
						Branch: <span class="uppercase">
						    <?php echo @$s->institute_name; ?> 
						    </span> <br/>
					</div>
				</div>
				<div class="employeePhoto midBlock">
					<div style="width:150px; height:150px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="<?php echo base_url('uploads/').$s->photo?>" target="_blank"><img style="width:100px; height:100px;"class="img-responsive" src="<?php echo base_url('uploads/').$s->photo?>" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
				</div>
			</div>
			<div class="paddingTBSml"></div>
			<div class="signature">
				<div class="left">www.aiiteindia.com</div>
				<div class="right"> Authorised Signatory</div>
			</div>
		</div>
		<div class="back">
			<div class="paddingSml">Father / Husband Name: <span class="uppercase"><?php echo @$s->father; ?></span></div>
			<div class="paddingSml">Date Of Birth: <span class="uppercase"><?php echo date('d-m-Y', strtotime(@$s->dob)) ?></span></div>
			<div class="paddingSml">दुरभाष संख्या / Tel  <span class="uppercase">
			     <?php echo @$s->mobile; ?>
			    </span></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<div class="paddingTBSml"></div>
			<!--<div class="paddingTBSml"></div>-->
			<div class="regionalAddress">
				<div class="label">HEAD OFFICE</div><br>
				<div class="paddingTB"> <div class="left">www.aiiteindia.com</div>
				<div class="right"> Authorised Signatory</div></div>
			</div>
		</div>
	</div>
	<!--<div class="icard">-->
	<!--	<div class="front">-->
	<!--		<div class="logoContainer">-->
				
	<!--			<div class="logoName">-->
					<!--<img src="https://jantasangh.org.in/assets/images/logo.jpg" />-->
	<!--			</div>-->
				<!--
	<!--			<div class="logo">-->
	<!--				<img src="https://jantasangh.org.in/lic/assets/images/lic-logo.jpeg" />-->
	<!--			</div>-->
	<!--			-->-->
	<!--		</div>-->
	<!--		<div class="empData"  style="">-->
	<!--			<div class="employeeData midBlock" >-->
	<!--				<div style="padding: 10px">-->
	<!--					Father Name: <span class="uppercase"><?php echo @$s->father; ?></span> <br/>-->
	<!--					Course Name: <span class="uppercase"><?php echo @$s->course_name; ?> <br/>-->
	<!--					Batch: <span class="uppercase"><?php echo @$s->start; ?>-<?php echo @$s->end; ?></span> <br/>-->
	<!--					Enroll No: <?php echo  @$s->enrollment_no; ?> <br/>-->
	<!--					Branch: <span class="uppercase">-->
	<!--					    <?php echo @$s->institute_name; ?> -->
	<!--					    </span> <br/>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="employeePhoto midBlock">-->
					<!--<img style="height:150px; width:150px;" src="<?php echo base_url('uploads/'.@$s->photo.''); ?>" />-->
	<!--				<div style="width:150px; height:150px;" class="project-wrapper">-->
 <!--                                               <div class="project">-->
 <!--                                                   <div class="photo-wrapper">-->
 <!--                                                       <div class="photo">-->
 <!--                                                           <a class="fancybox"  href="<?php echo base_url('uploads/').$s->photo?>" target="_blank"><img style="width:100px; height:100px;"class="img-responsive" src="<?php echo base_url('uploads/').$s->photo?>" alt=""></a>-->
 <!--                                                       </div>-->
 <!--                                                       <div class="overlay"></div>-->
 <!--                                                   </div>-->
 <!--                                               </div>-->
 <!--                                           </div>-->
	<!--			</div>-->
	<!--		</div>-->
			
	<!--		<div class="signature">-->
	<!--			<div class="left">www.aiiteindia.com</div>-->
	<!--			<div class="right"> Authorised Signatory</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--	<div class="back">-->
	<!--		<div class="paddingSml">Father / Husband Name: <span class="uppercase"><?php echo @$s->father; ?></span></div>-->
	<!--		<div class="paddingSml">Date Of Birth: <span class="uppercase"><?php echo date('d-m-Y', strtotime(@$s->dob)) ?></span></div>-->
	<!--		<div class="paddingSml">दुरभाष संख्या / Tel  <span class="uppercase">-->
	<!--		     <?php echo @$s->mobile; ?>-->
	<!--		    </span></div>-->
	
			<!--<div class="paddingSml">पहचान चिन्ह /Identification Marks: <span class="uppercase">-->
			    
		
			<!--</span></div>-->
			
	<!--		<div class="paddingTBSml"></div>-->
	<!--		<div class="paddingTBSml"></div>-->
	<!--		<div class="paddingTBSml"></div>-->
	<!--		<div class="paddingTBSml"></div>-->
	<!--		<div class="paddingTBSml"></div>-->
	<!--		<div class="regionalAddress">-->
	<!--			<div class="label">HEAD OFFICE</div>-->
	<!--			<div class="paddingTB"> <div class="left">www.aiiteindia.com</div>-->
	<!--			<div class="right"> Authorised Signatory</div></div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</div>-->
			
</div>
		<div class="box-footer">
					<!--<button class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>-->
					<!--<button class="btn btn-default float-center" onclick="CreatePDFfromHTML()"><i class="fa fa-print"></i> Print</button>-->
					<a href="<?php echo base_url('generate-id-card/').$s->id;?>" target="_blank">		
		    	                    <button class="btn btn-default float-center" ><i class="fa fa-print"></i> Preview</button>
		            	</a>
				</div>
		<br>
		<?
	}
	else
	{
	    
		echo '<script>alert("Enrollment or date of birth not matched.");location.href="welcome/get_admit_card"</script>';
	}
}
else
{
?>
<div class="col-md-6 col-md-offset-3">
	<div class="box box-danger">
		<div class="box-header"><h3>Get Student ID</h3></div>
		<div class="box-body">
			<form action="" method="post">
				<div class="form-group">
					<label>Registration No.</label>
					<input type="text" class="form-control" name="enrollment_no" placeholder="Enter Registration No.">
				</div>
				<div class="form-group">
					<label>Date of birth</label>
					<input type="date" class="form-control" name="dob" placeholder="Enter B.O.B .">
				</div>
				<div class="form-group">
					<button class="btn btn-danger" type="submit" name="status" value="admit_card">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?
}
echo '</div></div>';

?>
<br><br>
<style>
			    .box-body table tbody tr th ,.box-body table tbody tr td {
			        text-align:left;
			        padding-left:10px;
			        
			    }
			</style>
	
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript">
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
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>