<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printbill extends CI_Controller {

public function __construct()
{
parent::__construct();
    $this->load->library('pdf');
}



function center_certificate($id = 0){
    
    if($id == 0)
    {
        if($this->session->userdata('type') == 2 AND $this->session->userdata('is_active')){
            $id = $this->session->userdata('loginid');
        }
    }
    $get = $this->db->get_where('centers',['status' => 1,'id' => $id]);
    
    if($id AND $get->num_rows()):
        $row = $get->row(); 
        $photo = ('uploads/'.$row->image);
        $photo_url ='<img class="photo" src="'.$photo.'" alt="">';
        $date = date('d-m-Y',strtotime($row->timestamp));
        $content = '
                    <center><h3 class="title">'.$row->institute_name.'</h3></center>
                    <div class="">
                        <b>'.$row->name.'</b> , Situated At: Vill: <b>'. $row->center_full_address .'</b> Has been Recognized as Authorized Training center for conducting Computer Education Programmes Under Aaradhya Shiksha Foundation.
                    </div>
                </div>
        
        
        
        ';
        // exit($photo_url);
    // define some HTML content with style
    $html = <<<EOF
    
    <title>$row->name -Center-Certificate</title>
   <style>
body  {
  background-image: url("background-mage/today franchise certificate final.jpg");
  
    background-repeat: no-repeat;
    position:relative;
}
.photo{
    position:absolute;
    z-index:1;
    top:25%;
    right:8.9%;
    width:280px;
    height:360px
}.date{
    position:absolute;
    bottom:27.6%;
    left:14%;
    font-weight:700;
    font-size:3em;
}
.content{
    position:absolute;
    top:47%;
    font-size:4em;
    left:10%;
    width:80%;
}
h2.title{
    font-family:cursive;
}
.center-id{
    position:absolute;
    top:43%;
    right:8%;
    z-index:2;
    font-size:4em
}
</style>
</head>
<body>
    <div>
        <strong class="center-id">ID: <b>$row->center_number</b></strong>
        $photo_url
        <div class="content">
           $content
        </div>
        <strong class="date">$date</strong>
    </div>
</body>            
            
EOF;

// echo $html;
// exit;
    
    // output the HTML content
    //$pdf->writeHTML($html, true, false, true, false, '');
    
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    
    // add a page
    //$pdf->AddPage();
    //echo $html;

    $this->pdf->loadHtml($html);
    $customPaper = array(0,0,2300,1700);
    $this->pdf->set_paper($customPaper);
    // $this->pdf->setPaper('A4','portrait');//landscape
   
//   $this->pdf->add_info('h','f');
    // $this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream($row->name."-Center-Certificate.pdf", array('Attachment'=>0));
    
    else:
        echo 'Permission denied';
    endif;
}

public function index()
{
    $this->load->library('pdf');
    
    $header_image= 'background-mage/Admission.JPG';
// define some HTML content with style
$html = <<<EOF
   <style>
body  {
  background-image: url("background-mage/Admission.JPG");
  
    background-repeat: no-repeat;
  background-size: 1000px 600px;

}
</style>
</head>
<body>

</body>            
            
EOF;

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();
//echo $html;

    $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,570,570);
    //$this->pdf->set_paper($customPaper);
    $this->pdf->setPaper('A4','portrait');//landscape
   
   
    //$this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("abc.pdf", array('Attachment'=>0));
    
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}



public function generate_card()
{
    $this->load->library('pdf');
    
    if(empty($this->uri->segment(3))){
    redirect('admin/student_list');
    }
    $header_image= 'background-mage/ID-CARD.jpg';
   $stu = $this->db->query("SELECT *,s.id as id,s.name as student_name FROM students s left join session_year se on s.batch=se.id left join courses c on c.id=s.course_id left join centers ce on ce.id=s.center_id  left join blood_group on blood_group.BG_ID=s.blood_group  left join batch_session on batch_session.BATCH_ID=s.Batch  where s.id = '".@$this->uri->segment(3)."'");
 	$stu_num=$stu->num_rows();
 	$s = $stu->row();

    $date=date('d/m/Y',strtotime(@$s->dob));
    $start=$s->start;
    $end=$s->end;
    
    $photo= '';
    $photo.='uploads/'.$s->photo;
    $photo_url ='';
    $photo_url.='<img style="width:50px; height:50px;margin-left:-200px;margin-top:-10px;"class="img-responsive" src="'.$photo.'" alt=""></a>';
    
    
    $base_url = 'www.vhtecindia.com'; 
    
    
    $header_image= 'background-mage/download.png';
// define some HTML content with style
$html = <<<EOF
<title> ID CARD - $s->student_name </title>
   <style>
body  {
  background-image: url($header_image);
  
    background-repeat: no-repeat;
  background-size: 1000px 600px;

}
</style>
<style>


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
			width: 40%;
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
			height: 85px;
			/* display: flex;
			justify-content: space-around; */
		}
		
		.logoContainer .logo{
    		width: 100px;
    		margin: 4px 10px;
    		display: inline-block;
    		vertical-align: middle;
		}
		.logoContainer .logoName{
			width: 100%;
			float: right;
		
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
			font-size: 6px;
			width: 215px;
			font-family: sans-serif;
		}
		.empData{
			width: 100%;
		}
		.empData .employeeData{
			
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 11px;
			line-height: 20px;
			
		}
		.empData .employeePhoto{
            width: 100px;
            height: 10px;
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
		
		.regionalAddress{
			border-top: 2px solid #065811;
			font-family: "Yatra One", cursive;
			color: red;
			text-align: center;
			position: relative;
		}
		.regional{
			border-top: 2px solid #065811;
		
				padding: 20px 0px 5px 0px;
			
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 12px;

		
		}
		
		.regionalAddress .label{
			top: -5px;
			position: absolute;
			left: 35%;
		
			padding: 5px 20px;
		}
		 table, th, td {
          
          padding:-2px;
        }
        table{
            padding:0px;
        }
	</style>
</head>
<body>
    <div class="containter row" >
    	<div >
    		<div class="front" >
    			
    			<div class="empData"  >
    				<div class="employeeData midBlock"  >
    					<div style="padding-top: 15px; margin-left:35px;font-weight:900;">
    					
    					    <table style="margin-top:110px;width:58%;">
    					   
    					        <tr><td >Enroll No:</td><td>$s->enrollment_no</td></tr>
    					        <tr ><td >Name:</td><td><span class="uppercase"> $s->student_name  </span></td></tr>
    					        <tr><td >Father Name: </td><td><span class="uppercase">$s->father</span></td></tr>
    					        <tr><td >Course Name:</td><td><span class="uppercase">$s->course_name</td></tr>
    					        <tr><td >Batch:</th><td><span class="uppercase">$s->BATCH_NAME </span></td></tr>
    					        <tr><td >Branch:</td><td><span class="uppercase">$s->institute_name</span></td></tr>
    					        
    					    </table>
    					     
    					</div>
    				</div>
    				
    				<div class="employeePhoto midBlock">
    				<br>
    					<div style="width:190px; height:180px; margin-left:100px margin-top:200px" class="project-wrapper">
                                                    <div class="project">
                                                        <div class="photo-wrapper">
                                                            <div class="photo">
                                                              $photo_url
                                                            </div>
                                                            <div class="overlay"></div>
                                                        </div>
                                                    </div>
                                                </div>
    				</div>
    			</div>
    			
    			
    		</div>
    		
    		
    	</div>
			
    </div>
</body>            
            
EOF;

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();
//echo $html;

    $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,570,570);
    //$this->pdf->set_paper($customPaper);
    $this->pdf->setPaper('A4','portrait');//landscape
   
   
    //$this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
     $this->pdf->stream("ID-CARD-$s->enrollment_no.pdf", array('Attachment'=>0));
    
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}








public function admission_form()
{
    $this->load->library('pdf');
    
    if(empty($this->uri->segment(3))){
    redirect('admin/student_list');
    }
    $row=$this->db->query('select *,s.name as name, s.dob as dateofbirth, s.pincode as student_pincode from students s left join  centers  c  on s.center_id=c.id	 left join courses co on co.id=s.course_id left join session_year se on se.id=s.batch left join session_year ses on ses.id=s.session left join state st on st.STATE_ID=s.state left join city ci on ci.id=s.city left join brand on brand.id=s.category left join batch_session on batch_session.BATCH_ID=s.Batch left join business_list on business_list.BUSSINESS_ID=s.occupation left join medium_list on medium_list.MEDIUM_ID=s.medium left join gender on gender.GENDER_ID= s.gender left join district on district.DISTRICT_ID= s.distric left join religion on religion.RELIGION_ID=s.religion left join marital_status on marital_status.MS_ID=s.marrital_status left join country on country.COUNTRY_ID=s.nationality left join blood_group on blood_group.BG_ID=s.blood_group left join languages on languages.id=s.mother_tongue  where s.id="'.@$this->uri->segment(3).'"')->row();
    if(empty($row)){
       redirect('admin/student_list');
    }
    
    $date_of_birth = date("d-m-Y", strtotime($row->dateofbirth));
    
    
    
    $header_image= 'background-mage/Admission.JPG';
    
    if($row->status==0){
                    $status= 'CANCEL';
                    
                }
                
                elseif($row->status==1){
                    $status= 'APPROVE';
                    
                }
    $date=date('d/m/Y',strtotime(@$row->dob));
    $start=$row->start;
    $end=$row->end;
    
  
    
    $addmission_date = date('d-m-Y',strtotime(@$row->addmission_date));
    
    $tenth_url= '';
     $tenth_url.='uploads/'.$row->tenth_marksheet;
    
    
    $tenth ='';
    
    if($row->tenth_marksheet!=''){
         $tenth.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$tenth_url.'" alt=""></a>';
    }
   
   
    
    $photo= '';
    $photo.='uploads/'.$row->photo;
    
    $photo_url ='';
    $photo_url.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$photo.'" alt=""></a>';
    
    $twelve_url= '';
    
    
    
    
    $twelve ='';
    $twelve_url.='uploads/'.$row->twelve_marksheet;
    
    if($row->tenth_marksheet!=''){
        $twelve.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$tenth_url.'" alt=""></a>';
    }
    
    
    
    $graduation_url= '';
    $graduation_url.='uploads/'.$row->graduation_marksheer;
    $graduation ='';
    
    if($row->graduation_marksheer!=''){
         $graduation.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$graduation_url.'" alt=""></a>';
    }
   
    
        $graduation_degree_url= '';
    $graduation_degree_url.='uploads/'.$row->graduation_degree;
    $graduation_degree ='';
    
    if($row->graduation_degree!=''){
        $graduation_degree.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$graduation_degree_url.'" alt=""></a>';
    }
    
    
    
// define some HTML content with style
$html = <<<EOF
    <title>ADMISSION FORM- $row->name</title>
  <style>
body  {
  background-image: url("$header_image");
  
    background-repeat: no-repeat;
  background-size: 100px 600px;
}
</style>
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}
row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 11pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	/*
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
		text-align:center;
	}
	td.second {
		border: 2px dashed green;
	}
	*/
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
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
			height: 80px;
			object-fit: contain;
		}
		
table, td, th {
  border: 1px solid black;
  text-align:center;
}
table {
  width: 100%;
  border-collapse: collapse;
}		
</style>


</head>
<body>

            
  <div  style="margin-top:320px;">
    
     
  
    <div class="row">
        <table class="table " style="width:99%;font-size:11px;margin-left:4px;">
            <tr style=" text-align:center;">
                <th style="padding:5px;" ><b style="font-weight:900;font-size:14px;">  Admission Date</b></th>
                <th ><b style="font-weight:900;font-size:14px;">  Academy </b> </th>
                <th ><b style="font-weight:900;font-size:14px;">  Course</b></th>
                <th ><b style="font-weight:900;font-size:14px;">  Batch</b></th>
                <th ><b style="font-weight:900;font-size:14px;"> Session</b>  </th>
            </tr>
            <tr>
                <td > $addmission_date </td>
                <td >  $row->brand_name </td>
                <td > $row->course_name</td>
                <td > $row->BATCH_NAME </td>
                <td >  $start-$end</td>
            </tr>
            <tr style="border: 1px solid; text-align:center;padding:10px;">
                <th style="padding:5px;"><b style="font-weight:900;font-size:14px;">  Instiute Name </b></th>
                <th ><b style="font-weight:900;font-size:14px;">  Student Name </b></th>
                <th ><b style="font-weight:900;font-size:14px;">  Email-ID</b></th>
                <th ><b style="font-weight:900;font-size:14px;">  Mobile No</b></th>
                <th > <b style="font-weight:900;font-size:14px;"> Date of Birth</b> </th>
            </tr>
                <tr >
                <td > $row->institute_name</td>
                <td >  $row->name </td>
                <td >  $row->email</td>
                <td > $row->mobile</td>
                <td >  $date_of_birth </td>
            </tr>
            <tr style=" text-align:center;">
                <th style="padding:5px;"><b style="font-weight:900;font-size:14px;">  Mother Name</b></th>
                <th> <b style="font-weight:900;font-size:14px;"> Father Name </b></th>
                <th> <b style="font-weight:900;font-size:14px;"> Parent Occupation</b></th>
                <th><b style="font-weight:900;font-size:14px;">  Medium </b></th>
                <th><b style="font-weight:900;font-size:14px;"> Address </b> </th>
            </tr>
                <tr>
                <td >  $row->mother</td>
                <td >  $row->father </td>
                <td >  $row->BUSINESS_NAME	</td>
                <td >  $row->MEDIUM_NAME</td>
                <td > $row->address</td>
            </tr>
            <tr style=" text-align:center;">
                <th style="padding:5px;"><b style="font-weight:900;font-size:14px;">  Pincode</b> </th>
                <th><b style="font-weight:900;font-size:14px;">  Country</b> </th>
                <th><b style="font-weight:900;font-size:14px;">  State</b></th>
                <th><b style="font-weight:900;font-size:14px;">  City</b> </th>
                <th><b style="font-weight:900;font-size:14px;">  Gender </b> </th>
            </tr>
                <tr>
                <td >  $row->student_pincode</td>
                <td >  INDIA </td>
                <td> $row->STATE_NAME</td>
                <td >  $row->DISTRICT_NAME</td>
                <td >  $row->GENDER_NAME</td>
            </tr>
            <tr style=" text-align:center;">
                <th style="padding:5px;"> <b style="font-weight:900;font-size:14px;"> Martial Status</b> </th>
                <th> <b style="font-weight:900;font-size:14px;"> Nationality </b></th>
                <th><b style="font-weight:900;font-size:14px;">  Blood Group</b></th>
                <th><b style="font-weight:900;font-size:14px;">  Mother Tongue </b> </th>
                <th><b style="font-weight:900;font-size:14px;">  Religion  </b></th>
            </tr>
                <tr>
                <td >  $row->MS_NAME</td>
                <td >  INDIAN </td>
                <td >  $row->BG_NAME	</td>
                <td >  $row->language</td>
                <td >  $row->RELIGION_NAME</td>
            </tr>
            
            
            
            
        </table>
        <h4 class="" style="margin-left:4px;"><b>Educational Qualification</b> </h4>
        <table class="table table-bordered border-width" style="width:99%;font-size:11px; padding-top:10px;margin-left:4px;">
            <tr>
                <th style=" text-align:center;"> <b style="font-weight:900;font-size:14px;"> Qualification</b></th>
                <th style="padding:10px;"><b style="font-weight:900;font-size:14px;">  Reg No. </b></th>
                <th><b style="font-weight:900;font-size:14px;">  Subject</b></th>
                <th><b style="font-weight:900;font-size:14px;">  Board/University</b></th>
                <th> <b style="font-weight:900;font-size:14px;"> Year of Completion</b></th>
                <th><b style="font-weight:900;font-size:14px;">Percentage of Marks</b></th>
            </tr>
            <tr>
                <td >  $row->highest_qualification</td>
                <td >  $row->reg_no </td>
                <td > $row->subject</td>
                <td > $row->board</td>
                <td > $row->passing_year</td>
                <td> $row->marks%</td>
            </tr>
            
        </table>
        <h4 class="" style="margin-left:4px;"><b>Documents </b> </h4>
        <table class="table table-bordered border-width" style="width:99%;font-size:11px;margin-left:4px; padding-top:10px">
            <tr>
                <th style="padding:5px;"> <b style="font-weight:900;font-size:14px;"> Passport Size Photo Graph</b></th>
                <th><b style="font-weight:900;font-size:14px;">  10th Mark sheet</b> </th>
                <th> <b style="font-weight:900;font-size:14px;"> 12th Mark sheet</b></th>
                <th> <b style="font-weight:900;font-size:14px;"> Graduation Mark sheet</b></th>
                <th> <b style="font-weight:900;font-size:14px;"> Others Degree</b></th>
                
            </tr>
            <tr>
                <td style="border: 1px solid; "> 
                     <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            $photo_url
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                </td>
                <td style="border: 1px solid; ">
                    <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                          $tenth
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                      
                </td>
                <td style="border: 1px solid; "> 
                          <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                           $twelve
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                
                </td>
                <td style="border: 1px solid; "> 
                         <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                          $graduation
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>     
                
                
                </td>
                <td style="border: 1px solid; "> 
                 <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                           $graduation_degree
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







</body>            
            
EOF;

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();
//echo $html;

    $this->pdf->loadHtml($html);
            // $customPaper = array(0,0,570,570);
            //$this->pdf->set_paper($customPaper);
    $this->pdf->setPaper('A4','portrait');//landscape
   
   
            //$this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("$row->enrollment_no.pdf", array('Attachment'=>0));
    //$this->pdf->stream("abc.pdf", array('Attachment'=>0));
    
            //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}







public function demo_testing()
{
    $this->load->library('pdf');
    
    
    
    $profile=$this->db->get('profile')->row();
    
    $admit = $this->db->query("SELECT * FROM admit_card where id = '".$this->uri->segment(3)."'");
    $admit_num=$admit->num_rows();
    $admit_row=$admit->row();
    $stu = $this->db->query("SELECT *,s.id as id FROM students s left join session_year se on s.batch=se.id  LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch  where enrollment_no = '".$admit_row->enrollment_no."'");
    $stu_num=$stu->num_rows();
    if($stu_num>0 && $admit_num>0)
    {
        $s = $stu->row();
        $a = $this->db->query("SELECT * FROM admit_card where id = '".$this->uri->segment(3)."'")->row();
        $c = $this->db->query("SELECT * FROM centers where id = '".$s->center_id."'")->row();
        $course = $this->db->query("SELECT * FROM courses where id = '".$s->course_id."'")->row();
        if( @$course->course_name != ''){
            $course_name =  $course->course_name;
        }else{
            $course_name = 'Not Available';
        }
        $exam=$this->db->query("select *,a.type as type,a.id as exam_id,s.id as subject_id from Assign_exam_student a  left join exam_schedule e on e.id=a.exam_id left join subjects s on a.subject_id=s.id where a.student_id='".$s->id."'")->result();
    }
    $header_image= 'background-mage/ADMIT-CARD.jpg';
    $date=date('d/m/Y',strtotime($s->dob));
    $photo= '';
    $photo.='uploads/'.$s->photo;
    $logo ='';
    $logo .= '<img  style="height:115px;width:100px; margin-top:-60px;" class="img-responsive" src="'.$photo.'" alt="">';
    $bill_list  = '';
    
       $i=1;
    foreach($exam as $row){
        if($row->type==1){
            //$type='PRACTICAL';
             $type='';
        }else{
            $type='';
        }
        $bill_list .=  '<tr style="border: 1px solid;">';
        $bill_list .= ' 
        
        
	        <td style="border: 1px solid; text-align:center;"><b>'.$i .'</b> </td>
	        <td style="border: 1px solid; text-align:center;">'.$row->SUBJECT_CODE.'</td>
		    <td style="border: 1px solid; text-align:center;"><b>'.$row->subject_name.' </b></td>
		    <td style="border: 1px solid; text-align:center;">'.date('d/m/Y',strtotime($row->exam_date)).'</td>
		    <td style="border: 1px solid; text-align:center;">'. $row->start_time.'</td>
		    <td style="border: 1px solid; text-align:center;">'.$row->end_time.'</td>';
          $bill_list .= '  </tr>';
            $i++;
        }
        
    $link= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">';

    
    
    
    $header_image= 'background-mage/ADMIT-CARD.jpg';
// define some HTML content with style
$html = <<<EOF
    
   <style>
body  {
  background-image: url("$header_image");
  
    background-repeat: no-repeat;
  background-size: 1000px 600px;

}
</style>
<title>ADMIT CARD - $s->name </title>
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}
row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 11pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	/*
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	*/
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
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
			height: 80px;
			object-fit: contain;
		}
		
table, td, th {
  border: 1px solid black;
}
table {
  width: 100%;
  border-collapse: collapse;
}		
</style>



</head>
<body>


        <div class="containter row" style="margin-top:250px;">
    
         
   
		
	<div class="box box-default">
		
		<div class="row box-body">
			<div class="col-md-9" >
					    
	            <table style="width:100%;font-size:14px; text-align:center;" >
            		
                		   <tr >
    					        <th style="text-align:center;"><b>Roll no :</b> </th>
    					        <td style=" text-align:center;">$a->roll_no</td>
    						    <th style=" text-align:center;"><b>Enroll No :</b></th>
    						    <th style=" text-align:center;"> $s->enrollment_no</th>
    						           								       
    				      </tr>
    				      <tr >
    					        <th style=" text-align:center;"><b>Course :</b> </th>
    					        <td style=" text-align:center;"> $course_name</td>
    						    <th style="text-align:center;"><b>Batch :</b></th>
    						    <th style=" text-align:center;"> $s->start- $s->end</th>
    						   
    				      </tr>
    				      <tr >
    					        <th style=" text-align:center;"><b>Student's Name :</b> </th>
    					        <td style=" text-align:center;">$s->name</td>
    						    <th style=" text-align:center;"><b>DOB :</b></th>
    						    <th style="text-align:center;">$date</th>
    						   
    				      </tr>
    				      <tr >
    					        <th style=" text-align:center;"><b>Father's Name :</b> </th>
    					        <td style=" text-align:center;"> $s->father;</td>
    						    <th style=" text-align:center;"><b>Mother's Name :</b></th>
    						    <th style=" text-align:center;"> $s->mother</th>
    						   
    				      </tr>
    				      <tr >
    				         <td style=" text-align:center;"><b>Examination Center :</b> </td> 
    				         <td style=" text-align:center; "  colspan="3"> $c->institute_name </td> 
    
    				      </tr>
        		   
	           </table>
					  </div>
					    <div class="col-md-3" style="height:115px;margin-left: 500px;margin-top: -60px;">
		                     <table style="width:50%;margin-left:40px; text-align:center;">
		                        <tbody>
		                            <tr>
		                                <td style="border: 1px solid transparent; background: transparent;">
		                                    <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                           <a class="fancybox"  href="" target="_blank">
                                                            $logo
                                                            </a>
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
			<div class="row box-body" style="padding-left:0px;">
					    <div class="col-md-12" >
					            <table style="width:100%;font-size:11px; text-align:center;" >
					                		<thead style="border:  1px solid;">
					                		   <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Sr. No :</b> </th>
            								        <th style="border: 1px solid; text-align:center;">Subject Code. No :</td>
            									    <th style="border: 1px solid; text-align:center;"><b>Subject Name :</b></th>
            									    <th style="border: 1px solid; text-align:center;">Date </th>
            									    <th style="border: 1px solid; text-align:center;">Start Time </th>
            									    <th style="border: 1px solid; text-align:center;">End Time </th>
            									   
        								      </tr>
        								      </thead>
        								      <tbody>
        								        $bill_list
        								      </tdoby>
        								    
        								           
					           </table>
					  </div>
			</div>
		
		<div class="row box-body" style="margin-top:10px;">
					    <div class="col-md-12" >
					            <table style="width:80%;font-size:11px;" >
					                		<tbody>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            <b>NOTE :</b>
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            1. Please Check Name, Father & Mother Name etc. If you found any incorrect entry in this admit card, you can represent immediately.
					                		            Correction will not be entertained after completion of exam.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            2. Students should carefully fill the Roll Number, Subject Code etc.in the Answer book
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            3. Students should not write his/her name or any identity in any part of the Answer Book.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            4. Students will bring his/her Admit Card during the examination and must produce the same when asked for.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            5. Students should not bring any slip/book/scripts in the examination hall otherwise they will be booked under unfair means.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            
                                                            6. In case of loss of Admit Card, Duplicate Admit Card can be issued from the office of Controller of Examinations with the 
                                                            Payment of Rs 50/- with certified photograph.
					                		        </td>
					                		    </tr>
					                		 </tbody>
					           </table>
					      
					   </div>
		</div>
			
		</div>
		</div>


</body>            
            
EOF;



// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,570,570);
    //$this->pdf->set_paper($customPaper);
    $this->pdf->setPaper('A4','portrait');//landscape

    //$this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("abc.pdf", array('Attachment'=>0));
    
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}





public function admit_card()
{
    
    $this->load->library('pdf');
    
    $profile=$this->db->get('profile')->row();
    
    $admit = $this->db->query("SELECT * FROM admit_card  LEFT JOIN courses ON courses.id=admit_card.course_id where admit_card.id = '".$this->uri->segment(3)."'");
    $admit_num=$admit->num_rows();
    $admit_row=$admit->row();
    $stu = $this->db->query("SELECT *,s.id as id FROM students s left join session_year se on s.batch=se.id  LEFT JOIN batch_session ON batch_session.BATCH_ID=s.Batch where enrollment_no = '".$admit_row->enrollment_no."'");
    $stu_num=$stu->num_rows();
    if($stu_num>0 && $admit_num>0)
    {
        $s = $stu->row();
        $a = $this->db->query("SELECT * FROM admit_card where id = '".$this->uri->segment(3)."'")->row();
        $c = $this->db->query("SELECT * FROM centers where id = '".$s->center_id."'")->row();
        $course = $this->db->query("SELECT * FROM courses where id = '".$admit_row->course_id."'")->row();
        if( @$course->course_name != ''){
            $course_name =  $course->course_name;
        }else{
            $course_name = 'Not Available';
        }
        
        if( @$course->type == 1){
            $course_duration =  ''.$course->duration.' -Months';
        }
        else if( @$course->type == 3){
            $course_duration =  ''.$course->duration.' -Semesters';
        }else{
            $course_duration =  ''.$a->year.' -Year';
        }
        
        $subject = $this->db->select('s.id as course_id,s.SUBJECT_CODE,s.subject_name')
                            ->from('admit_card as a')
                            ->where('a.year',$a->year)
                            ->where('a.id',$this->uri->segment(3))
                            ->join('subjects as s','a.course_id = s.course_id AND s.year = a.year')
                            ->get();
       
        
    }
    $header_image= 'background-mage/ADMIT-CARD.jpg';
    $date=date('d/m/Y',strtotime($s->dob));
    $photo= '';
    $photo.='uploads/'.$s->photo;
    $logo ='';
    $logo .= '<img  style="height:115px;width:100px; margin-top:-80px;" class="img-responsive" src="'.$photo.'" alt="">';
    $bill_list  = '';
    
       $i=0;
   if($ttlRows = $subject->num_rows()){
    
        foreach($subject->result() as $row){
            $bill_list .=  '<tr style="border: 1px solid;">';
            $bill_list .= ' 
            //$time_in_12_hour_format  = date("g:i a", strtotime("13:30"));
            
    	        <td style="border: 1px solid; text-align:center;"><b>'.($i+1) .'</b> </td>
    	        <td style="border: 1px solid; text-align:center;">'.$row->SUBJECT_CODE.'</td>
    		    <td style="border: 1px solid; text-align:center;"><b>'.$row->subject_name.'</b></td>';
    		    if(!$i++)
    		        $bill_list .= '<td style="border: 1px solid; text-align:center;" rowspan="'.$ttlRows.'"><b>As Per Schedule.</b></td>';
              $bill_list .= '  </tr>';
            }
       }
        
    $link= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">';

    
    
    
    $header_image= 'background-mage/ADMIT-CARD.jpg';
// define some HTML content with style
$html = <<<EOF
        
        <title> ADMIT CARD - $s->name </title>

   <style>
body  {
  background-image: url("$header_image");
  
    background-repeat: no-repeat;
  background-size: 1000px 600px;

}
</style>
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}
row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 11pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	/*
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	*/
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
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
			height: 80px;
			object-fit: contain;
		}
		
table, td, th {
  border: 1px solid black;
}
table {
  width: 100%;
  border-collapse: collapse;
}		
</style>



</head>
<body>


        <div class="containter row" style="margin-top:250px;">
    
         
   
		
	<div class="box box-default">
		
		<div class="row box-body">
			<div class="col-md-9" >
					    
	            <table style="width:100%;font-size:14px; text-align:center;" >
            		
                		   <tr >
    					        <th style="text-align:center;"><b>Roll no :</b> </th>
    					        <td style=" text-align:center;">$a->roll_no</td>
    						    <th style=" text-align:center;"><b>Enroll No :</b></th>
    						    <th style=" text-align:center;"> $s->enrollment_no</th>
    						           								       
    				      </tr>
    				      <tr >
    					        <th style=" text-align:center;"><b>Course/Duration :</b> </th>
    					        <td style=" text-align:center;font-size:12px;"> $course_name /<b> $course_duration </b></td>
    						    <th style="text-align:center;"><b>Batch :</b></th>
    						    <th style=" text-align:center;"> $s->BATCH_NAME</th>
    						   
    				      </tr>
    				      <tr >
    					        <th style=" text-align:center;"><b>Student's Name :</b> </th>
    					        <td style=" text-align:center;">$s->name</td>
    						    <th style=" text-align:center;"><b>DOB :</b></th>
    						    <th style="text-align:center;">$date</th>
    						   
    				      </tr>
    				      <tr >
    					        <th style=" text-align:center;"><b>Father's Name :</b> </th>
    					        <td style=" text-align:center;"> $s->father</td>
    						    <th style=" text-align:center;"><b>Mother's Name :</b></th>
    						    <th style=" text-align:center;"> $s->mother</th>
    						   
    				      </tr>
    				      <tr >
    				         <td style=" text-align:center;"><b>Examination Center :</b> </td> 
    				         <td style=" text-align:center; "  colspan="3"> $c->institute_name </td> 
    
    				      </tr>
        		   
	           </table>
					  </div>
					    <div class="col-md-3" style="height:115px;margin-left: 500px;margin-top: -60px;">
		                     <table style="width:50%;margin-left:40px; text-align:center;">
		                        <tbody>
		                            <tr>
		                                <td style="border: 1px solid transparent; background: transparent;">
		                                    <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                           <a class="fancybox"  href="" target="_blank">
                                                            $logo
                                                            </a>
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
			<div class="row box-body" style="padding-left:0px;margin-top:-20px;">
					    <div class="col-md-12" >
					            <table style="width:100%;font-size:11px; text-align:center;" >
					                		<thead style="border:  1px solid;">
					                		   <tr style="border: 1px solid;">
            								        <th style="border: 1px solid; text-align:center;"><b>Sr. No :</b> </th>
            								        <th style="border: 1px solid; text-align:center;">Subject Code :</td>
            									    <th style="border: 1px solid; text-align:center;"><b>Subject Name :</b></th>
            									    <th style="border: 1px solid; text-align:center;"> Date & Time </th>
            									   
        								      </tr>
        								      </thead>
        								      <tbody>
        								        $bill_list
        								      </tdoby>
        								    
        								           
					           </table>
					  </div>
			</div>
		
		<div class="row box-body" style="margin-top:10px;">
					    <div class="col-md-12" >
					            <table style="width:80%;font-size:11px;" >
					                		<tbody>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            <b>NOTE :</b>
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            1. Please Check Name, Father & Mother Name etc. If you found any incorrect entry in this admit card, you can represent immediately.
					                		            Correction will not be entertained after completion of exam.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            2. Students should carefully fill the Roll Number, Subject Code etc.in the Answer book
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            3. Students should not write his/her name or any identity in any part of the Answer Book.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            4. Students will bring his/her Admit Card during the examination and must produce the same when asked for.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            5. Students should not bring any slip/book/scripts in the examination hall otherwise they will be booked under unfair means.
					                		        </td>
					                		    </tr>
					                		    <tr>
					                		        <td style="border: 1px solid transparent; background: transparent;">
					                		            
                                                            6. In case of loss of Admit Card, Duplicate Admit Card can be issued from the office of Controller of Examinations with the 
                                                            Payment of Rs 50/- with certified photograph.
					                		        </td>
					                		    </tr>
					                		 </tbody>
					           </table>
					      
					   </div>
		</div>
			
		</div>
		</div>


</body>            

EOF;

    try {
        $this->pdf->loadHtml($html);
        // $customPaper = array(0,0,570,570);
        // $this->pdf->set_paper($customPaper);
        $this->pdf->setPaper('A4','portrait');//landscape
        
        // $this->pdf->setPaper('A4','landscape');
        //landscape
        // echo $html;
        // die;
        
        $this->pdf->render();
        $this->pdf->stream("$s->enrollment_no.pdf", array('Attachment'=>0));
        //'Attachment'=>0 for view and 'Attachment'=>1 for download file 
    
        
    } catch(\Throwable $th) {
        print_r($th->__toString());die;
    }
}
public function result()
{
    $this->load->library('pdf');

		$result = $this->db->query("SELECT * FROM results where id = '".$this->uri->segment(3)."'");
		
	$results=$result->row();
	$result_array=$result->result();
	
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
// 		die(var_dump($__R);
// 		die(var_dump($__R));
		$course = $this->db->query("SELECT * FROM courses where id = '".$__R->course_id."'")->row();
		 $course_id=$__R->course_id;
	        	$enrollment_no=$__R->enrollment_no;
		$stu = $this->db->query("SELECT * FROM students s left join  session_year se on se.id=s.session where  s.enrollment_no = '".$__R->enrollment_no."' ");
	   // echo $stu->num_rows();
		
			$__S = $stu->row();
    
            //print_r($__S);

			$institute = $this->db->query("SELECT * FROM centers where id = '".$__S->center_id."'")->row();
    $marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$this->uri->segment(3)."'");
                                            

 $header_image= '';
 $logo ='';
                        
	                   
//  $logo .= '  <tr>
// 		                                <td>
// 		                                    <div style="width:150px; height:150px;" class="project-wrapper">
//                                                 <div class="project">
//                                                     <div class="photo-wrapper">
//                                                         <div class="photo">
//                                                             <a class="fancybox"  href=" '.base_url('uploads/').$s->photo.'" target="_blank"><img style="width:100%; height:100%;"class="img-responsive" src="'.base_url('uploads/').$s->photo.'" alt=""></a>
//                                                         </div>
//                                                         <div class="overlay"></div>
//                                                     </div>
//                                                 </div>
//                                             </div>
//                                         </td>
//                                     </tr>';


                                $bill_list  = '';
                                $bill_list .=          
                                        
                                            // die(var_dump("SELECT * FROM marks_table where result_id = '".$this->uri->segment(3)."'"));
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
                                $bill_list .= '   
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
        										
        													
        												</tr>	';
        										$ttl+=$mm->marks;
        										$tot+=$sub->max_marks;
        										$tot_practical+=$sub->practical_max_marks;
        										$tot_marks+=$mm->practical_marks;
        										$grand_ttl+=$ob_marks;
        										$grand_total+=$total_marks;
        										
        										$i++;
        									}
                                               
                                $bill_list .= '<tr><td><b>GRAND TOTAL</b></th><td ></td><td style="border: 1px solid;"><b>'.$tot.'</b></td><td></td><td style="border: 1px solid;"><b>'.$ttl.'</b></td><td style="border: 1px solid;"><b>'.$tot_practical.'</b></td><td style="border: 1px solid;"></td><td style="border: 1px solid;"><b>'.$tot_marks.'</b></td><td style="border: 1px solid;"><b>'.$grand_total.'</b></td><td style="border: 1px solid;"><b>'.$grand_ttl.'</b></td></tr>';  
// echo $bill_list;
$division='';
                         $x=($grand_ttl/$grand_total)*100;
					         
					        
					     if($x<33 )	 {
					           $division.= '  <h3 class="text-center"><b>RESULT : FAILED </b></h3>';
					      }
					      elseif($x>=33 && $x<45){
					             $division.='<h3 class="text-center"><b>RESULT : PASSED WITH THIRD DIVISION</b></h3>';
					     }
					     elseif($x>=45 && $x<60){
					            '<h3 class="text-center"><b>RESULT : PASSED WITH SECOND DIVISION</b></h3>';
					       }
					       elseif($x>=60 && $x<75){
					          $division.=' <h3 class="text-center"><b>RESULT : PASSED WITH FIRST DIVISION</b></h3>';
					       }elseif($x>=75){
					            $division.=' <h3 class="text-center"><b>RESULT : PASSED WITH HOUNOURS  </b></h3>';
					       }
$result_list='';
if(@$course->type==2){
$result_list .= 
	        	$cur_year=$__R->year;
	        	$pre_year=$cur_year-1;
	        	$get_marks=$this->db->query('select * from results where course_id="'.$course_id.'" and enrollment_no="'.$enrollment_no.'"')->result();
	            if($pre_year!=0){
	$result_list .=		
				    '<div class="" style="padding-left:10px;">
					  <table style="width:80%;margin-left:100px;font-size:10px;" >
        		    	<tbody style="border:  1px solid;">
        		    	    <tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" ><b>YEAR</b></th>
        								    <th style="border: 1px solid;" ><b>MAXIMUM MARKS</b></th>
        								    <th style="border: 1px solid;" ><b>OBTAINED MARKS</b></th>
        					</tr>';
        			$result_list .=	
        			                $years=1;
        				            foreach($get_marks as $row){
        			        	    if($years<=$__R->year){
        				            $markss = $this->db->query("SELECT * FROM marks_table where result_id = '".$row->id."' and year ='".$years."'");
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
        				    	
        				
        			$result_list .=		'<tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" ><b>'.$row->year.'</b></th>
        								    <th style="border: 1px solid;" ><b>'. $grand_totals.'</b></th>
        								    <th style="border: 1px solid;" ><b>'. $grand_ttls.'</b></th>
        								    
        					</tr>';
        				
        				$result_list .=		 $years++;
        				}
        				 
        			}   
        			
        				
        					
        			$result_list .='	    	 </tbody>
        		       </table>
        		    </div>';
        	
				}}
			    
 

// define some HTML content with style
$html = <<<EOF
<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- EXAMPLE OF CSS STYLE -->
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}

.row {
    --bs-gutter-x: 0.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>
body  {
  background-image: url("https://vhtecindia.com/uploads/MARKSHEET.jpg");
  margin-left :70px;
 background-repeat: no-repeat;
  background-size: 1000px 600px;
  position: absolute;z-index:-1;left: 0;
}
</style>
<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: black;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	h3 {
		color: black;
		font-family: times;
		font-size: 11pt;
		text-decoration: underline;
	}
	h4 {
		color: black;
		font-family: times;
		font-size: 8pt;
		text-align:none;
	
	
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
		 
</style>
	<style>
			    .box-body table tbody tr th ,.box-body table tbody tr td {
			        text-align:left;
			        padding-left:10px;
			        
			    }
		.logoName{
			width: 100%;
			float: right;
	
			display: inline-block;
			vertical-align: middle;
			text-align: center;
		}
		 .logoName img,
		  .officeAddress .ushaLogo .logo img{
			width: 100%;
			height: 60px;
			object-fit: contain;
		}
			</style>
			</head>
<body>
<div class="row" id="content" >
			    
			    <div class="col-md-12">
			        
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: ;z-index:1">
					  
					    	   
					 
				<div class="row" style="padding-top:190px;">
				   <table style="width:80%;margin-left:26px;font-size:10px;">
	                    <tbody>
	                       <tr><td colspan="3"><b>ROLL NO. :</b> $__R->roll_no</td> 
	                   <td><b>ENROLLMENT NO. :</b> $__S->enrollment_no</td> <td><b>SESSION :</b> $__S->start-$__S->end</td></tr> 
	                        
	                    </tbody>				      
	               </table>
	            </div>
	            <br>
	            <h4 style="	margin-left:270px;"><b>STATEMENT OF MARKS </b></h4>
	            
	            <h4 style="	margin-left:350px;"><b>$course->course_name</b></h4>
	            
	            
	            <h4 style="	margin-left:310px;"><b>$year_name</b></h4>
	            
	             <table style="width:80%;margin-left:26px;font-size:11px;">
	                    <tbody>
	                       <tr><td><b>NAME. :</b> $__S->name</td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <td><b>S/O,D/O :</b> $__S->father</td></tr> 
	                        
	                    </tbody>				      
	               </table>
	               
	                 <table style="width:80%;margin-left:26px;font-size:11px;">
	                    <tbody>
	                       <tr><td><b>INSTITUTE NAME : :</b>($institute->center_number) $institute->institute_name</td> </tr> 
	                        
	                    </tbody>				      
	               </table>
	               
	               <br>
	               <div class="row" style="padding-left:10px;">
					            <table style="width:80%;margin-left:46px;font-size:10px;" >
        							<tbody style="border:  1px solid;
">
        								<tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" rowspan="2"><b>PAPER</b></th>
        									<th style="border: 1px solid;" rowspan="2"><b>SUBJECT NAME</b> </th>
        									
        									    <th style="border: 1px solid;" colspan="3" ><b>THEORY</b></th>
        									    
        									    
        									<th style="border: 1px solid;" colspan="3"><b>PRACTICAL</b></th>
        									<th style="border: 1px solid;" colspan="2"><b>TOTAL</b></th>
        									
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
        							</tbody>
        							<tbody>
        							$bill_list
        							</tbody>
        								
        								
        								    
        								
        									
    						</table>

					        </div>
					        $division
					        $result_list
					       
	                        
					        
					        
					        
	                       
	                        <div style="width:100%;margin-left:100px;font-size:18px; padding-top:0px;">
	                            
	                        </div>
    					 
					        
					 </div>   
					    
			    </div>
			    <div class="col-md-12">
			       </div>
			</div>
			</body>
EOF;

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();

echo $html;
    // $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,570,570);
    //$this->pdf->set_paper($customPaper);
    // $this->pdf->setPaper('A4','portrait');//landscape
    //$this->pdf->setPaper('A4','landscape');//landscape
    // $this->pdf->render();
    // $this->pdf->stream("abc.pdf", array('Attachment'=>0));
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}

public function print_certificate(){
      $this->load->library('pdf');
      
      $student_id =  (AJ_DECODE($this->uri->segment(3)));
    
    // exit($student_id);
    // if(!is_int($student_id)){
    //     show_error('Something Went Wrong.');
    // }
      $student=$this->db->query("SELECT * FROM students where id = '".$student_id."' ")->row();
    $result = $this->db->query("SELECT * FROM student_certificate where enrollment_no = '".@$student->enrollment_no."' ")->row();
	$course=$this->db->query("SELECT * FROM courses where id = '".@$student->course_id."' ")->row();
	$institute = $this->db->query("SELECT * FROM centers where id = '".@$student->center_id."'")->row();
	
// 	1 for month 
// 2 for year
// 3 for semester
//   echo $course->type;
   
	if($course->type==2){
                    //   $duration=getDurationName$post->duration.'months';
        $year_name = getDurationName($course->years,$course->type,false);
  }else{
        $year_name = getDurationName($course->duration,$course->type,false);
  }
  
// 	echo '<pre>';
// 	print_r($course);
// 	exit;
// 	if($course->years==1){
//         $year_name='FIRST YEAR';
//     }elseif($course->years==2){
//         $year_name='SECOND YEAR';
//     }
//     elseif($course->years==3){
//         $year_name='THIRD YEAR';
//     }elseif($course->years==4){ 
//         $year_name='FOURTH YEAR';
//     }elseif($course->years==5){
//         $year_name='FIFTH YEAR';
//     }else{
//         $year_name= "$course->duration Month's";
//     }
    
    
    
	$qr = $this->db->query("SELECT * FROM results where enrollment_no = '".@$student->enrollment_no."' ")->row();
	
	
//       $result = $this->db->query("SELECT * FROM results where id = '".@$this->uri->segment(3)."' ")->row();
// 	$student=$this->db->query("SELECT * FROM students where enrollment_no = '".@$result->enrollment_no."' ")->row();
// 	$course=$this->db->query("SELECT * FROM courses where id = '".@$student->course_id."' ")->row();
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
					            $x=(@$grand_ttl/@$grand_total)*100;
					           // echo $x;
					       $division = '';
					       if($x>=80){
                	            $division.=' <b>RESULT : PASSED GRADE A+  </b>';
                	       }
                	       elseif($x>=70){
                	          $division.=' <b>RESULT : PASSED GRADE A</b>';
                	       }
                	       elseif($x>=60){
                	          $division.=   '<b>RESULT : PASSED GRADE B+</b>';
                	       }
                	       elseif($x>=50){
                	             $division.='<b>RESULT : PASSED GRADE B</b>';
                	     }
                	     elseif($x >= 40 )	 {
                	           $division.= '  <b>RESULT : GRADE C </b>';
                	      }
                	      else{
                	           $division.=' <b>RESULT : FAILED  </b>';
                	       }
	                            }
                                            
        //                 $division='';
        //                  $x=($grand_ttl/$grand_total)*100;
					         
					        
					   //  if($x<33 )	 {
					   //        $division.= '  <b>RESULT : FAILED </b>';
					   //   }
					   //   elseif($x>=33 && $x<45){
					   //          $division.='<b>RESULT : PASSED WITH THIRD DIVISION</b>';
					   //  }
					   //  elseif($x>=45 && $x<60){
					   //         '<b>RESULT : PASSED WITH SECOND DIVISION</b>';
					   //    }
					   //    elseif($x>=60 && $x<75){
					   //       $division.='<b>RESULT : PASSED WITH FIRST DIVISION</b>';
					   //    }elseif($x>=75){
					   //         $division.='<b>RESULT : PASSED WITH HOUNOURS  </b>';
					   //    }
//  $header_image=  base_url('uploads/').'CERTIFICATEIMAGE.png';
$header_image= '';

   $header_image.='temp/'.@$qr->qr_code;
   $qr_code='';
  //$qr_code.=$header_image;
  $qr_code.=' <img  style="height:105px;" src="'.$header_image.'">';

 $logo ='';

$date = @$result->certificate_date;

$mydate = $result->timestamp;

$genDate = $this->db->where(['type_id' => @$student->id,'type' => 'certificate'])->get('gen_date');
if($genDate->num_rows()){
    $mydate = $genDate->row()->date;
}

$date1 = date('d-m-Y',strtotime($mydate));
//$date=date('F-Y',strtotime(@$result->timestamp));
$photo_url = '';
     $photo_url .='uploads/'.@$student->photo;
     if(!file_exists($photo_url))
        $photo_url = 'uploads/_student_blank.png';
     $photo='<img style="height:105px;border:1px solid black" src="'.$photo_url.'">';
// exit($photo);
$date_od_birth=date('d-m-Y',strtotime(@$student->dob));

// define some HTML content with style
$html = <<<EOF
    <title>$student->name -  CERTIFICATE </title>
   <style>
body  {
  background-image: url("background-mage/cert-1.jpeg");
  
    background-repeat: no-repeat;
  background-size: 10px 10px;
}
</style>
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}

row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
		 
</style>

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
		#hello {
          text-decoration: underline;
          width:100px;;
          border-bottom :1px solid black
          background-color:blue
        }
			</style>
</head>
<body>
  	<div class="row">
			 
	    <div class="col-md-12" id="content">
	        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: ;z-index:1">
				
					      	    
					  
				
	            
	            
	            
	                <h4 style="bottom:30%;position:absolute;right:7%;font-size:18px;">ENROLLMENT NO: $student->enrollment_no</h4>
	                <div class="row" style="width:95%;text-align:justify;justify-content: center;font-size:16px;">
	             
	                   
	                   
	                   <div style="position:absolute;left:5.5%;top:45%">


                            <div style="line-height: 1;font-size:1.2em;line-height:1;justify-content: space-between;line-height:1.5" class="cls_003">
                                <span class="cls_003">This is to certify that <strong>$student->name </strong>
                                                            S/D of Shri <b>$student->father</b>  Born On 
                                                        <b>$date_od_birth </b> 
                                                            appeared in   
                                                        <b>$course->course_name </b> at <b>$institute->institute_name</b> of duration <b>$year_name</b>.
                                                            Examination of the Council held in 
                                                        <b> $date </b> and has been declared  <b>PASS.</b>
                                                            He / She is scored 
                                                        <b> $grand_ttl </b> 
                                                            marks out of  
                                                        <b>$grand_total </b>
                                                            marks and is placed in  
                                                        <b> $division </b>.
                                </span>
                            
                            </div>

                        </div>
	                   
	           
	             
	             
	               </div>
	              
					        
		    </div>   
			<div style="background:transparent;position:absolute;left:17%;top:30%">
                        $qr_code
            </div>
            <div style="background:transparent;position:absolute;right:17%;top:30%">
                        $photo
            </div>
            
					    
	    </div>
			    <div style="position:absolute;bottom:24%;left:6%">
			        <b>ISSUE DATE - $date1</b>
			    </div>
	</div>
			
</body>            
            
EOF;



// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();
// echo $html;

    $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,2700,2170);
    // $this->pdf->set_paper($customPaper);
    // $this->pdf->setPaper('A4','portrait');//landscape
   
   
    $this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("$student->enrollment_no.pdf", array('Attachment'=>0));
    
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file  
}


public function print_form()
{
    
    $this->load->library('pdf');
    if(empty($this->uri->segment(3))){
    redirect('admin/student_list');
    }
    $header_image= 'background-mage/Admission.JPG';
    $row=$this->db->query('select *,s.name as name from students s left join  centers  c  on s.center_id=c.id	 left join courses co on co.id=s.course_id left join session_year se on se.id=s.batch left join session_year ses on ses.id=s.session left join state st on st.STATE_ID=s.state left join city ci on ci.id=s.city  where s.id="'.@$this->uri->segment(3).'"')->row();
    if(empty($row)){
       redirect('admin/student_list');
    }
     
                if($row->status==0){
                    $status= 'CANCEL';
                    
                }
                
                elseif($row->status==1){
                    $status= 'APPROVE';
                    
                }
                $date=date('d/m/Y',strtotime(@$row->dob));
    $start=$row->start;
    $end=$row->end;
    $tenth_url= '';
    $tenth_url.='uploads/'.$row->tenth_marksheet;
    $tenth ='';
    $tenth.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$tenth_url.'" alt=""></a>';
    $photo= '';
    $photo.='uploads/'.$row->photo;
    $photo_url ='';
    $photo_url.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$photo.'" alt=""></a>';
    $twelve_url= '';
    $twelve_url.='uploads/'.$row->twelve_marksheet;
    $twelve ='';
    $twelve.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$tenth_url.'" alt=""></a>';
    $graduation_url= '';
    $graduation_url.='uploads/'.$row->graduation_marksheer;
    $graduation ='';
    $graduation.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$graduation_url.'" alt=""></a>';
        $graduation_degree_url= '';
    $graduation_degree_url.='uploads/'.$row->graduation_degree;
    $graduation_degree ='';
    $graduation_degree.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$graduation_degree_url.'" alt=""></a>';
// define some HTML content with styleprintbill/admit_card/4
$html = <<<EOF

<!-- EXAMPLE OF CSS STYLE -->

<style>
body  {
  background-image: url("$header_image");
  
    background-repeat: no-repeat;
  background-size: 100px 600px;

 
  

}
</style>
<style>

    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>
       
    </style>
<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	h4 {
		color: black;
		font-family: times;
		font-size: 18pt;
		text-decoration: underline;
	}
	
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 11pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
		.box-body table tbody tr th ,.box-body table tbody tr td {
	        text-align:left;
	        padding-left:10px;
			        
		}
		.logoName{
			width: 100%;
			float: right;
			display: inline-block;
			vertical-align: middle;
			text-align: center;
		}
		.logoName img,
		  .officeAddress .ushaLogo .logo img{
			width: 105%;
			height: 122px;
			object-fit: contain;
		}
</style>

  <div  style="margin-top:320px;">
    
     
  
    <div class="row">
        <table class="table " style="width:100%;font-size:11px;     
            ">
            <tr style=" text-align:center;">
                <th ><b> 1. Admission Date</b></th>
                <th ><b> 2. Academy </b> </th>
                <th ><b> 3. Course</b></th>
                <th ><b> 4. Batch</b></th>
                <th ><b>5. Session</b>  </th>
            </tr>
            <tr>
                <td style="border: 1px solid; ">  $row->addmission_date</td>
                <td style="border: 1px solid;">  $row->institute_name </td>
                <td style="border: 1px solid; "> $row->course_name</td>
                <td style="border: 1px solid; "> $start-$end </td>
                <td style="border: 1px solid; ">  $start-$end</td>
            </tr>
            <tr style="border: 1px solid; text-align:center;">
                <th ><b>6. Franchise</b></th>
                <th ><b> 7. Student Name </b></th>
                <th ><b> 8. Email-ID</b></th>
                <th ><b> 9. Mobile No</b></th>
                <th > <b>10. Date of Birth</b> </th>
            </tr>
                <tr >
                <td style="border: 1px solid; "> $row->institute_name</td>
                <td style="border: 1px solid; ">  $row->name </td>
                <td style="border: 1px solid; ">  $row->email</td>
                <td style="border: 1px solid; "> $row->mobile</td>
                <td style="border: 1px solid; ">  $date</td>
            </tr>
            <tr>
                <th><b> 11. Mother Name</b></th>
                <th> <b>12. Father Name </b></th>
                <th> <b>13. Parent Occupation</b></th>
                <th><b> 14. Medium </b></th>
                <th><b>15. Address </b> </th>
            </tr>
                <tr>
                <td style="border: 1px solid; ">  $row->mother</td>
                <td style="border: 1px solid; ">  $row->father </td>
                <td style="border: 1px solid; ">  $row->occupation	</td>
                <td style="border: 1px solid; ">  $row->medium</td>
                <td style="border: 1px solid; "> $row->address</td>
            </tr>
            <tr>
                <th><b> 16. Pincode</b> </th>
                <th><b> 17. Country</b> </th>
                <th><b> 18. State</b></th>
                <th><b> 19. City</b> </th>
                <th><b> 20. Gender </b> </th>
            </tr>
                <tr>
                <td style="border: 1px solid; ">  $row->pincode</td>
                <td style="border: 1px solid; ">  $row->country </td>
                <td style="border: 1px solid; "> $row->STATE_NAME</td>
                <td style="border: 1px solid; ">  $row->city_name</td>
                <td style="border: 1px solid; ">  $row->gender</td>
            </tr>
            <tr>
                <th> <b>21. Martial Status</b> </th>
                <th> <b>22. Nationality </b></th>
                <th><b> 23. Blood Group</b></th>
                <th><b> 24. Mother Tongue </b> </th>
                <th><b> 25. Religion  </b></th>
            </tr>
                <tr>
                <td style="border: 1px solid; ">  $row->marrital_status</td>
                <td style="border: 1px solid; ">  $row->nationality</td>
                <td style="border: 1px solid; ">  $row->blood_group	</td>
                <td style="border: 1px solid; ">  $row->mother_tongue</td>
                <td style="border: 1px solid; ">  $row->religion</td>
            </tr>
            <tr>
                <th><b> 26. Community</b> </th>
                <th><b> 27. Place of Birth</b> </th>
                <th><b> 28. Physically Chanlanged </b></th>
                <th><b> 29. Occupation  </b></th>
                <th><b> 30. Status  </b></th>
            </tr>
                <tr>
                <td style="border: 1px solid; "> $row->community</td>
                <td style="border: 1px solid; ">  $row->father</td>
                <td style="border: 1px solid; ">  $row->occupation</td>
                <td style="border: 1px solid; ">  $row->occupation</td>
                <td style="border: 1px solid; "> 
                    $status
                </td>
            </tr>
            
            
            
        </table>
        <h4 class=""><b>Educational Qualification</b> </h4>
        <table class="table table-bordered border-width" style="width:100%;font-size:11px; padding-top:10px">
            <tr>
                <th> <b> Qualification</b></th>
                <th><b>  Reg No. </b></th>
                <th><b>  Subject</b></th>
                <th><b>  Board/University</b></th>
                <th> <b> Year of Completion</b></th>
                <th><b>Percentage of Marks</b></th>
            </tr>
            <tr>
                <td style="border: 1px solid; ">  $row->highest_qualification</td>
                <td style="border: 1px solid; ">  $row->reg_no </td>
                <td style="border: 1px solid; "> $row->subject</td>
                <td style="border: 1px solid; "> $row->board</td>
                <td style="border: 1px solid; "> $row->passing_year</td>
                <td style="border: 1px solid; "> $row->marks%</td>
            </tr>
            
        </table>
        <h4 class=""><b>Documents </b> </h4>
        <table class="table table-bordered border-width" style="width:100%;font-size:11px; padding-top:10px">
            <tr>
                <th> <b> Passport Size Photo Graph</b></th>
                <th><b>  10th Mark sheet</b> </th>
                <th> <b> 12th Mark sheet</b></th>
                <th> <b> Graduation Mark sheet</b></th>
                <th> <b> Graduation Degree</b></th>
                
            </tr>
            <tr>
                <td style="border: 1px solid; "> 
                     <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            $photo_url
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                </td>
                <td style="border: 1px solid; ">
                    <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                          $tenth
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                      
                </td>
                <td style="border: 1px solid; "> 
                          <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                           $twelve
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>
                
                </td>
                <td style="border: 1px solid; "> 
                         <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                          $graduation
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>     
                
                
                </td>
                <td style="border: 1px solid; "> 
                 <div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                           $graduation_degree
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
EOF;

    try {
        $this->pdf->loadHtml($html);
        // $customPaper = array(0,0,570,570);
        // $this->pdf->set_paper($customPaper);
        $this->pdf->setPaper('A4','portrait');//landscape
        
        // $this->pdf->setPaper('A4','landscape');
        //landscape
        // echo $html;
        // die;
        $this->pdf->render();
        $this->pdf->stream("abc.pdf", array('Attachment'=>0));
        //'Attachment'=>0 for view and 'Attachment'=>1 for download file 
    } catch(\Throwable $th) {
        print_r($th->__toString());die;
    }
}
public function print_id()
{
    
    $this->load->library('pdf');
    if(empty($this->uri->segment(3))){
    redirect('admin/student_list');
    }
    $header_image= 'background-mage/ID-CARD.jpg';
   $stu = $this->db->query("SELECT *,s.id as id FROM students s left join session_year se on s.batch=se.id left join courses c on c.id=s.course_id left join centers ce on ce.id=s.center_id  where s.id = '".@$this->uri->segment(3)."'");
 	$stu_num=$stu->num_rows();
 	$s = $stu->row();

                $date=date('d/m/Y',strtotime(@$s->dob));
    $start=$s->start;
    $end=$s->end;
    
    $photo= '';
    $photo.='uploads/'.$s->photo;
    $photo_url ='';
    $photo_url.='<img style="width:50px; height:50px;"class="img-responsive" src="'.$photo.'" alt=""></a>';
    
// define some HTML content with styleprintbill/admit_card/4
$html = <<<EOF
<title>$s->name ID-Card</title>
<!-- EXAMPLE OF CSS STYLE -->



<style>
body  {
  background-image: url("$header_image");
  
    background-repeat: no-repeat;
}
</style>




	<style>
		

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
    		width: 100px;
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
			top: -5px;
			position: absolute;
			left: 35%;
		
			padding: 5px 20px;
		}
	</style>
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}
row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>

<style>

.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 11pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
	    font-size:9px;
	    font-weight:600
	/*	border: 2px solid blue;
		background-color: #ffffee;
		*/
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
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
			height: 80px;
			object-fit: contain;
		}
		p.b {
          word-break: keep-all;
        }
        p {
          width: 100px; 
         
        }
</style>
    <div >
    
        <table style="width:300px;position:absolute;top:32%;left:10%">
            <tr>
                <td width=30%><b>FATHER NAME</b></td>
                <td> $s->father </td>
                <td rowspan=2>$photo_url</td>
            </tr>
            <tr>
                <td><b>STUDENT NAME</b></td> 
                <td> $s->name </td>
            </tr>
            <tr  >
                <td ><b>COURSE NAME </b></td> 
                <td>
                <p class="b">$s->course_name</p>

                </td>
            </tr>
            <tr >
                <td ><b>BATCH </b></td> 
                <td > $start-$end</td></tr>
            <tr>
                <td><b>INSTITUTE </b></td> 
                <td> $s->institute_name </td>
            </tr>
        </table>
        
EOF;

    try {
        // echo $html;
        // die;
        $this->pdf->loadHtml($html);
        // $customPaper = array(0,0,570,570);
        // $this->pdf->set_paper($customPaper);
        // $this->pdf->setPaper('A4','portrait');//landscape
        
        $this->pdf->setPaper('A4','landscape');
        //landscape
        
        $this->pdf->render();
        $this->pdf->stream("abc.pdf", array('Attachment'=>0));
        //'Attachment'=>0 for view and 'Attachment'=>1 for download file 
    } catch(\Throwable $th) {
        print_r($th->__toString());die;
    }
}

public function certificate()
{
    $this->load->library('pdf');
    $result = $this->db->query("SELECT * FROM results where id = '".@$this->uri->segment(3)."' ")->row();
	$student=$this->db->query("SELECT * FROM students where enrollment_no = '".@$result->enrollment_no."' ")->row();
	$course=$this->db->query("SELECT * FROM courses where id = '".@$student->course_id."' ")->row();
	$marks = $this->db->query("SELECT * FROM marks_table where result_id = '".@$result->id."' and year = '".@$result->year."'");
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
        									
        										$ttl+=$mm->marks;
        										$tot+=$sub->max_marks;
        										$tot_practical+=$sub->practical_max_marks;
        										$tot_marks+=$mm->practical_marks;
        										$grand_ttl+=$ob_marks;
        										$grand_total+=$total_marks;
        										
        										$i++;
        									}
                                            
$division='';
                         $x=($grand_ttl/$grand_total)*100;
					         
					        
					     if($x<33 )	 {
					           $division.= '  <b>RESULT : FAILED </b>';
					      }
					      elseif($x>=33 && $x<45){
					             $division.='<b>RESULT : PASSED WITH THIRD DIVISION</b>';
					     }
					     elseif($x>=45 && $x<60){
					            '<b>RESULT : PASSED WITH SECOND DIVISION</b>';
					       }
					       elseif($x>=60 && $x<75){
					          $division.='<b>RESULT : PASSED WITH FIRST DIVISION</b>';
					       }elseif($x>=75){
					            $division.='<b>RESULT : PASSED WITH HOUNOURS  </b>';
					       }
//  $header_image=  base_url('uploads/').'CERTIFICATEIMAGE.png';
 $logo ='';
$date=date('F-Y',strtotime(@$result->timestamp));                            
// define some HTML content with style
$html = <<<EOF
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<!-- EXAMPLE OF CSS STYLE -->
<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}

row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    .col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}
.col-md-1{-ms-flex:0 0 8.333333%;flex:0 0 8.333333%;max-width:8.333333%}
.col-md-2{-ms-flex:0 0 16.666667%;flex:0 0 16.666667%;max-width:16.666667%}
.col-md-3{-ms-flex:0 0 25%;flex:0 0 25%;max-width:25%;}
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%}
.col-md-5{-ms-flex:0 0 41.666667%;flex:0 0 41.666667%;max-width:41.666667%}.col-md-6{-ms-flex:0 0 50%;flex:0 0 50%;max-width:50%}
.col-md-7{-ms-flex:0 0 58.333333%;flex:0 0 58.333333%;max-width:58.333333%}.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%}
.col-md-9{-ms-flex:0 0 75%;flex:0 0 75%;max-width:75%}.col-md-10{-ms-flex:0 0 83.333333%;flex:0 0 83.333333%;max-width:83.333333%}
.col-md-11{-ms-flex:0 0 91.666667%;flex:0 0 91.666667%;max-width:91.666667%}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%}
</style>
<style>
body  {
  background-image: url("uploads/CERTIFICATEIMAGE.png");
  margin-left :70px;
 background-repeat: no-repeat;
  background-size: 1000px 700px;
  position: absolute;z-index:-1;left: 0;
      line-height: 0.5;
}
.text-center {
    text-align: center!important;
}
.h5, h5 {
    font-size: 1.25rem;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.2;
}


	h1 {
		color: navy;
		font-family: times;
		font-size: 24pt;
		text-decoration: underline;
	}
	p.first {
		color: #003300;
		font-family: helvetica;
		font-size: 12pt;
	}
	p.first span {
		color: #006600;
		font-style: italic;
	}
	p#second {
		color: rgb(00,63,127);
		font-family: times;
		font-size: 12pt;
		text-align: justify;
	}
	p#second > span {
		background-color: #FFFFAA;
	}
	table.first {
		color: #003300;
		font-family: helvetica;
		font-size: 8pt;
		border-left: 3px solid red;
		border-right: 3px solid #FF00FF;
		border-top: 3px solid green;
		border-bottom: 3px solid blue;
		background-color: #ccffcc;
	}
	td {
		border: 2px solid blue;
		background-color: #ffffee;
	}
	td.second {
		border: 2px dashed green;
	}
	div.test {
		color: #CC0000;
		background-color: #FFFF66;
		font-family: helvetica;
		font-size: 10pt;
		border-style: solid solid solid solid;
		border-width: 2px 2px 2px 2px;
		border-color: green #FF00FF blue red;
		text-align: center;
	}
	.lowercase {
		text-transform: lowercase;
	}
	.uppercase {
		text-transform: uppercase;
	}
	.capitalize {
		text-transform: capitalize;
	}
		 
</style>

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
<body>
        	<div class="row">
			 
			    <div class="col-md-12" id="content">
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: 500px;z-index:1">
				
					      	    
					  
				<div class="row" style="padding-top:320px;">
				   
	            </div>
	            
	            <h4 class="text-center"><b></b></h4>
	            
	            <h4 class="text-center"><b></b></h4>
	             <table style="width:100%;margin-left:70px;font-size:14px;">
	                    <tbody>
	                       <tr style="border: 1px solid transparent">
	                           <td style="border: 1px solid transparent; background: transparent;">
	                               <b>This is to certify that &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >$student->name
                                        </u></b> 
	                           </td>
                                
                            </tr> 
                            
	                        
	                    </tbody>				      
	               </table>
	               <br>
	                 <table style="width:100%;margin-left:70px;font-size:14px;">
	                    <tbody>
	                       <tr>
	                           <td style="border: 1px solid transparent;background: transparent;">
	                               <b>Son / Daughter of &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    > $student->father
                                        </u></b> 
	                           </td>
                           
                            </tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	               <table style="width:100%;margin-left:72px;font-size:14px; ">
	                    <tbody>
	                       <tr>
	                           <td style="border: 1px solid transparent;background: transparent;">
	                               <b>appeared in  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >$course->course_name
                                        </u></b> 
	                           </td>
                                
                            </tr> 
	                        
	                    </tbody>				      
	               </table>
	               <br>
	               <table style="width:100%;margin-left:70px;font-size:14px;">
	                    <tbody>
	                       <tr>
	                           <td style="border: 1px solid transparent;background: transparent;">
	                               <b>Examination of the Council held in  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >$date
                                        </u></b> 
	                           </td>
                                
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	               <table style="width:100%;margin-left:70px;font-size:14px;">
	                    <tbody>
	                       <tr>
	                           <td style="border: 1px solid transparent;background: transparent;">
	                               <b>and has been declared  &nbsp;&nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >PASS
                                        </u></b> 
	                           </td>
                                
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	               <table style="width:100%;margin-left:70px;font-size:14px;">
	                    <tbody>
	                       <tr>
	                           <td style="border: 1px solid transparent;background: transparent;">
	                              <b>He / She is</b> <b>scored  &nbsp;& nbsp;&nbsp;
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >$grand_ttl
                                        </u></b> <b>&nbsp;marks out of &nbsp;</b><u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    ><b> $grand_total</b>
                                        </u>
	                           </td>
                                
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	               <table style="width:100%;margin-left:70px;font-size:14px;">
	                    <tbody>
	                       <tr>
	                           <td style="border: 1px solid transparent;background: transparent;">
	                              <b>marks and is placed in   &nbsp;&nbsp;&nbsp;</b> 
	                               <u style="text-decoration:underline;
                                                text-decoration-style: dotted;"
                                                    >$division
                                        </u>
	                           </td>
                                
                            </tr> 
	                        
	                    </tbody>				      
	               </table> 
	               <br>
	                      
	               
	                           
	               
	               
			
					        
					 </div>   
					    
			    </div>
			    <div class="col-md-12">
			        			    </div>
			</div>
			</body>
EOF;

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();

// echo $html;
    $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,570,570);
    //$this->pdf->set_paper($customPaper);
    $this->pdf->setPaper('A4','portrait');//landscape
    // $this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("abc.pdf", array('Attachment'=>0));
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}

public function demo_id()
{
   $this->load->library('pdf');
    if(empty($this->uri->segment(3))){
    redirect('admin/student_list');
    }
    $header_image= 'background-mage/ADMIT-CARD-BG.png';
   $stu = $this->db->query("SELECT *,s.id as id,s.name as student_name FROM students s left join session_year se on s.batch=se.id left join courses c on c.id=s.course_id left join centers ce on ce.id=s.center_id  left join blood_group on blood_group.BG_ID=s.blood_group  where s.id = '".@$this->uri->segment(3)."'");
 	$stu_num=$stu->num_rows();
 	$s = $stu->row();

    $date=date('d/m/Y',strtotime(@$s->dob));
    $start=$s->start;
    $end=$s->end;
    
    $photo= '';
    $photo.='uploads/'.$s->photo;
    $photo_url ='';
    $photo_url.='<img style="width:50px; height:50px;margin-left:-200px;margin-top:-20px;"class="img-responsive" src="'.$photo.'" alt=""></a>';
    
    
    $base_url = 'www.vhtecindia.com';                         
// define some HTML content with style
$html = <<<EOF
 
<!-- EXAMPLE OF CSS STYLE -->

 <title> ADMIT CARD - $s->student_name </title>

<style>
.container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
    width: 100%;
    padding-right: var(--bs-gutter-x,.75rem);
    padding-left: var(--bs-gutter-x,.75rem);
    margin-right: auto;
    margin-left: auto;
}

row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y) * -1);
    margin-right: calc(var(--bs-gutter-x)/ -2);
    margin-left: calc(var(--bs-gutter-x)/ -2);
}
    
<style>


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
			width: 40%;
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
			height: 85px;
			/* display: flex;
			justify-content: space-around; */
		}
		
		.logoContainer .logo{
    		width: 100px;
    		margin: 4px 10px;
    		display: inline-block;
    		vertical-align: middle;
		}
		.logoContainer .logoName{
			width: 100%;
			float: right;
		
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
			font-size: 6px;
			width: 215px;
			font-family: sans-serif;
		}
		.empData{
			width: 100%;
		}
		.empData .employeeData{
			
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 11px;
			line-height: 20px;
			
		}
		.empData .employeePhoto{
            width: 100px;
            height: 10px;
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
		
		.regionalAddress{
			border-top: 2px solid #065811;
			font-family: "Yatra One", cursive;
			color: red;
			text-align: center;
			position: relative;
		}
		.regional{
			border-top: 2px solid #065811;
		
				padding: 20px 0px 5px 0px;
			
			font-family: 'Quicksand', sans-serif;
			font-weight: bold;
			font-size: 12px;

		
		}
		
		.regionalAddress .label{
			top: -5px;
			position: absolute;
			left: 35%;
		
			padding: 5px 20px;
		}
		 table, th, td {
          
          padding:1px;
        }
        table{
            padding:0px;
        }
	</style>

		
<body>
    <div class="containter row" id="content">
    	<div class="icard">
    		<div class="front" >
    			<div class="logoContainer" style="border-bottom:2px solid;">
    				<div class="logoName">
    					<img src="$header_image">
    				</div>
    			</div>
    			<div class="empData"  >
    				<div class="employeeData midBlock"  >
    					<div style="padding-top: 15px; margin-left:5px;font-weight:900;">
    					
    					    <table >
    					   
    					        <tr><td >Name:</td><td><span class="uppercase"> $s->student_name  </span></td></tr>
    					        <tr><td >Father Name: </td><td><span class="uppercase">$s->father</span></td></tr>
    					        <tr><td >Blood Group :</td><td><span class="uppercase">$s->BG_NAME</span></td></tr>
    					        <tr><td >Course Name:</td><td><span class="uppercase">$s->course_name</td></tr>
    					        <tr><td >Batch:</th><td><span class="uppercase">$start-$end</span></td></tr>
    					        <tr><td >Enroll No:</td><td>$s->enrollment_no</td></tr>
    					        <tr><td >Branch:</td><td><span class="uppercase">$s->institute_name</span></td></tr>
    					        
    					    </table>
    					     
    					</div>
    				</div>
    				
    				<div class="employeePhoto midBlock">
    				<br>
    					<div style="width:190px; height:180px; margin-left:100px margin-top:200px" class="project-wrapper">
                                                    <div class="project">
                                                        <div class="photo-wrapper">
                                                            <div class="photo">
                                                              $photo_url
                                                            </div>
                                                            <div class="overlay"></div>
                                                        </div>
                                                    </div>
                                                </div>
    				</div>
    			</div>
    			
    			<div class="paddingTBSml"></div>
    			<div class="paddingTBSml"></div>
    			<div class="regional">
    			<br>
    				<div class="left" ><span class="right" style="text-align:left; margin-left:10px">$base_url</span>
    				<span class="right" style="text-align:right; margin-left:80px"> Authorised Signatory </span></div>
    			</div>
    		</div>
    		
    		
    	</div>
			
    </div>
</body>
EOF;

// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// add a page
//$pdf->AddPage();

// echo $html;
// die;
    $this->pdf->loadHtml($html);
    // $customPaper = array(0,0,570,570);
    //$this->pdf->set_paper($customPaper);
    // $this->pdf->setPaper('A4','portrait');//landscape
    $this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("abc.pdf", array('Attachment'=>0));
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}

} 

?>