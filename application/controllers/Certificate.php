<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends CI_Controller {

public function __construct()
{
parent::__construct();
    $this->load->library('pdf');
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



public function view_certificate(){
      $this->load->library('pdf');
      
      
    $cert_id =  (AJ_DECODE($this->uri->segment(3,0)));
    
    // exit($cert_id);
    // if(!is_int($cert_id)){
    //     show_error('Something Went Wrong.');
    // }
      $student=$this->db->query("SELECT * FROM students where id = '".$cert_id."' ")->row();
    $result = $this->db->query("SELECT * FROM student_certificate where enrollment_no = '".@$student->enrollment_no."' ")->row();
	$course=$this->db->query("SELECT * FROM courses where id = '".@$student->course_id."' ")->row();
	$institute = $this->db->query("SELECT * FROM centers where id = '".@$student->center_id."'")->row();
	
	if($course->type==2){
                    //   $duration=getDurationName$post->duration.'months';
            $year_name = getDurationName($course->years,$course->type,false);
      }else{
            $year_name = getDurationName($course->duration,$course->type,false);
      }
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
	                            
	                            if(empty($cert_id)){
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
				
					      	    
					  
				
	            
	            
	            
	                <h4 style="bottom:27%;position:absolute;right:10%;font-size:18px;">ENROLLMENT NO: $student->enrollment_no</h4>
	                <div class="row" style="width:95%;text-align:justify;justify-content: center;font-size:16px;">
	             
	                   
	                   
	                   <div style="position:absolute;left:5.5%;top:50%">


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
			<div style="background:transparent;position:absolute;left:17%;top:35%">
                        $qr_code
            </div>
            <div style="background:transparent;position:absolute;right:17%;top:35%">
                        $photo
            </div>
            
					    
	    </div>
			    <div style="position:absolute;bottom:16.5%;left:10%">
			        <b>Issue Date :-  $date1</b>
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


/*---------------- start print certificate ----------------------------------------*/
public function __backup_view_certificate(){
      $this->load->library('pdf');
      $student=$this->db->query("SELECT * FROM students where id = '".@$this->uri->segment(3)."' ")->row();
    $result = $this->db->query("SELECT * FROM student_certificate where enrollment_no = '".@$student->enrollment_no."' ")->row();
	$course=$this->db->query("SELECT * FROM courses where id = '".@$student->course_id."' ")->row();

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
                                            

//  $header_image=  base_url('uploads/').'CERTIFICATEIMAGE.png';
$header_image= '';
   $header_image.='temp/'.$result->qr_code;
   $qr_code='';
  $qr_code.=' <img  style="height:105px;" src="'.$header_image.'">';
 $logo ='';
//$date=date('F-Y',strtotime(@$result->timestamp));
$date = @$result->certificate_date;

$date_od_birth=date('d-m-Y',strtotime(@$student->dob));

// define some HTML content with style
$html = <<<EOF
    <title>$student->name -  CERTIFICATE </title>
   <style>
body  {
 /* background-image: url("background-mage/CERTIFICATE.jpg");
  */
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
				
					      	    
					  
				
	            
	            
	            
	                <h4 style="margin-left:-15px; margin-top:15px;font-size:14px;">ENROLLMENT NO: $student->enrollment_no</h4>
	                <div class="row" style="padding-top:835px;width:90%;text-align:justify;justify-content: center;margin-left:3%;font-size:16px;">
	             
	                   
	                   
	                   <div style="position:absolute;left:50%;margin-left:-456px;top:0px;width:912px;height:1292px;overflow:hidden;margin-top:190px;">


                            <div style="position:absolute;left:172.07px;top:267.92px;width:68%;line-height: 2.5;" class="cls_003">
                                <span class="cls_003">This is to certify that <b>$student->name </b>
                                                            S/D of  Smt <b>$student->mother</b> & Shri <b>$student->father</b>  Born On 
                                                        <b>$date_od_birth </b> 
                                                            appeared in   
                                                        <b>$course->course_name </b> 
                                                            Examination of the Council held in 
                                                        <b> $date </b> and has been declared  <b>PASS.</b>
                                                            He / She is scored 
                                                        <b> $grand_ttl </b> 
                                                            marks out of  
                                                        <b>$grand_total </b>
                                                            marks and is placed in  
                                                        <b> $division </b>
                                </span>
                            
                            </div>

                        </div>
	                   
	           
	             
	             
	               </div>
	              
					        
		    </div>   
			<div style="width:50%;margin-left:60px;font-size:18px; padding-top:700px; background:transparent">
                        $qr_code
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
   
   
    //$this->pdf->setPaper('A4','landscape');//landscape
    $this->pdf->render();
    $this->pdf->stream("$student->enrollment_no.pdf", array('Attachment'=>0));
    
    //'Attachment'=>0 for view and 'Attachment'=>1 for download file  
}






/*----------------- end print certificate ------------------------------------------*/








} 

?>