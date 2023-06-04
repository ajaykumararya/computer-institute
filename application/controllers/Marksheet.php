<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marksheet extends CI_Controller {

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




function view(){
    
    $this->load->library('pdf');
    $result_id = AJ_DECODE($this->uri->segment(3));
    /*------------- start query -----------------------------*/
    $result = $this->db->query("SELECT *,results.id as resultid,admit_card.roll_no as rollno,results.year as result_year FROM results LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) where results.id = '".$result_id."'");
	$results=$result->row();
	$result_array=$result->result();
	
    $ResultYear = 0;
	if($results->result_year){
	    $ResultYear = $results->result_year;
	}else{
        $year_name='';
    }
    
    $__R = $results;
	$course = $this->db->query("SELECT * FROM courses where id = '".$__R->course_id."'")->row();
	
// 	exit($course->type);
    $year_name = (getDurationName($ResultYear,$course->type,true,true));
	if($course->type == 1){
	    $year_name = $course->duration .' MONTHS';
	}
	
	$course_id=$__R->course_id;
    $enrollment_no=$__R->enrollment_no;
	
	$stu = $this->db->query("SELECT *,s.id as student_id FROM students s left join  session_year se on se.id=s.session where  s.enrollment_no = '".$__R->enrollment_no."' ");
	$__S = $stu->row();
	
	
	//$__S->start-$__S->end
	$row1111 =$this->db->query('select *,s.name as name, s.dob as dateofbirth, s.pincode as student_pincode from students s left join  centers  c  on s.center_id=c.id	 left join courses co on co.id=s.course_id left join session_year se on se.id=s.batch left join session_year ses on ses.id=s.session left join state st on st.STATE_ID=s.state left join city ci on ci.id=s.city left join brand on brand.id=s.category left join batch_session on batch_session.BATCH_ID=s.Batch left join business_list on business_list.BUSSINESS_ID=s.occupation left join medium_list on medium_list.MEDIUM_ID=s.medium left join gender on gender.GENDER_ID= s.gender left join district on district.DISTRICT_ID= s.distric left join religion on religion.RELIGION_ID=s.religion left join marital_status on marital_status.MS_ID=s.marrital_status left join country on country.COUNTRY_ID=s.nationality left join blood_group on blood_group.BG_ID=s.blood_group left join languages on languages.id=s.mother_tongue  where s.id="'.@$__S->student_id.'"')->row();
   // echo '<pre>';
    // print_r($row1111);
    // exit;
	
	//$__S->start-$__S->end
	
// 	if($year_name != ''){
//         if($row1111->type == 3){
//             $year_name .= ' SEMESTER';
//         }
//         else if($course->type == 1){
//             $year_name .= ' Months';
//         }
//         else
//             $year_name .= ' YEAR';
//     }
	$start_year = ($__S->start + ($results->result_year - 1));
	
	$end_year = ($__S->end + ($results->result_year - 1));
	
	
	
	$institute = $this->db->query("SELECT * FROM centers where id = '".$__S->center_id."'")->row();
    $marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$result_id."'");
    // $a = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$enrollment_no."'")->row();
    
    $a = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$enrollment_no."' and year = '".$ResultYear."' ")->row();
    
     $photo='';
     $photo_url='';
     $photo_url.='uploads/'.$__S->photo;
     
     $photo='<img style="height:115px;width:50px;margin-left:520px;marin-top:1200px;" src="'.$photo_url.'">';

    $header_image= '';
   $header_image.='temp/'.$__R->qr_code;
   $qr_code='';
  $qr_code.=' <img  style="height:100px;" src="'.$header_image.'">';
    $logo ='';
                        
    $bill_list  = '';
    $bill_list .=          
	
	$rows = $marks->num_rows()+1;
	$i=1;
	$ttl=0;
	$tot=0;
	$tot_practical=0;
	$tot_marks=0;
	$grand_ttl=0;
	$grand_total=0;
	
	//print_r($marks->result());
	$date = '';
	foreach($marks->result() as $mm){
        $date = $mm->timestamp;								    
		$sub = $this->db->query("SELECT * FROM subjects where id = '".$mm->subject_id."'")->row();
		$total_marks= @$sub->max_marks + @$sub->practical_max_marks;
		$ob_marks=@$mm->marks + @$mm->practical_marks;
        
        $bill_list .= '   
        			<tr>
						    <th style="border: 1px solid;text-align:center;"><b>'.@$i.'</b></th>
							<th style="border: 1px solid;text-align:center;"><b>'.@$sub->subject_name.'</b></th>
							<td style="border: 1px solid;text-align:center;">'.@$sub->max_marks.'</td>
							<td style="border: 1px solid;text-align:center;">'.@$sub->min_marks.'</td>
							<td style="border: 1px solid;text-align:center;">'.@$mm->marks.'</td>
							
							
							<td style="border: 1px solid;text-align:center;">'.@$sub->practical_max_marks.'</td>
							<td style="border: 1px solid;text-align:center;">'.@$sub->practical_min_marks.'</td>
							<td style="border: 1px solid;text-align:center;">'.@$mm->practical_marks.'</td>
							<td style="border: 1px solid;text-align:center;">'.@$total_marks.'</td>
							<td style="border: 1px solid;text-align:center;">'.@$ob_marks.'</td>
				
							
					</tr>	';
					
		$ttl+=$mm->marks;
		$tot+=$sub->max_marks;
		$tot_practical+=$sub->practical_max_marks;
		$tot_marks+=$mm->practical_marks;
		$grand_ttl+=$ob_marks;
		$grand_total+=$total_marks;
		
		$i++;
	}
	$genDate = $this->db->where(['type_id' => $result_id,'type' => 'marksheet'])->get('gen_date');
    if($genDate->num_rows()){
        $date = $genDate->row()->date;
    }
    
    $date = date('d-m-Y',strtotime($date));
    
                                               
    $bill_list .= '<tr>
                        <td style="border: 1px solid ;" colspan="1">
                            
                        </td>
                        <td style="border: 1px solid ;font-weight:900;text-align:center;"> <b>GRAND TOTAL</b> </td>
                        <td style="border: 1px solid;text-align:center;"><b>'.$tot.'</b></td>
                        <td style="border: 1px solid ;text-align:center;"></td>
                        <td style="border: 1px solid;text-align:center;"><b>'.$ttl.'</b></td>
                        <td style="border: 1px solid;text-align:center;"><b>'.$tot_practical.'</b></td>
                        <td style="border: 1px solid;text-align:center;"></td>
                        <td style="border: 1px solid;text-align:center;"><b>'.$tot_marks.'</b></td>
                        <td style="border: 1px solid;text-align:center;"><b>'.$grand_total.'</b></td>
                        <td style="border: 1px solid;text-align:center;"><b>'.$grand_ttl.'  </b></td>
                    </tr>';  
    $division='';
            
    	     //  $x = 60;  
    	       $x=($grand_ttl/$grand_total)*100;  
    	        if($x>=80){
    	            $division.=' <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED GRADE A+  </b></h3>';
    	       }
    	       elseif($x>=70){
    	          $division.=' <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED GRADE A</b></h3>';
    	       }
    	       elseif($x>=60){
    	          $division.=   '<h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED GRADE B+</b></h3>';
    	       }
    	       elseif($x>=50){
    	             $division.='<h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED GRADE B</b></h3>';
    	     }
    	     elseif($x >= 40 )	 {
    	           $division.= '  <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : GRADE C </b></h3>';
    	      }
    	      else{
    	           $division.=' <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : FAILED  </b></h3>';
    	       }
    	  
    	       
    $result_list='';
    $padding_top=80;
    
    if(@$course->type==2 OR @$course->type==3){
   // $result_list .= 
	        	$cur_year=$__R->year;
	        	$pre_year=$cur_year-1;
	        	$get_marks=$this->db->query('select * from results where course_id="'.$course_id.'" and enrollment_no="'.$enrollment_no.'"')->result();
	            if($pre_year!=0){
	$__type  = $course->type == 2 ? 'YEAR' : 'SEMESTER';
	
	
	$result_list .=		
				    '<div class="" style="padding-left:10px;margin-top:10px;">
					  <table style="width:75%;margin-left:150px;font-size:10px;" >
        		    	<tbody style="border:  1px solid;">
        		    	    <tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" ><b>'.$__type.'</b></th>
        								    <th style="border: 1px solid;" ><b>MAXIMUM MARKS</b></th>
        								    <th style="border: 1px solid;" ><b>OBTAINED MARKS</b></th>
        					</tr>';
			            $result_list .=	
        			            $years=1;
        			            $out_of = 0;
        			            $obtained = 0;
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
                                								    <th style="border: 1px solid;text-align:center;" ><b>'.(numberToRomanRepresentation($row->year)).' '.$__type.'</b></th>
                                								    <th style="border: 1px solid;text-align:center;" ><b>'. $grand_totals.'</b></th>
                                								    <th style="border: 1px solid;text-align:center;" ><b>'. $grand_ttls.'</b></th>
                                								    
                                					            </tr>';
        				
        				
                    				        $out_of = $out_of + $grand_totals;
                    				        $obtained = $obtained + $grand_ttls;
        				                    $result_list .=		 $years++;
        				                }
        				
                                	    if($years==1){
                        			        $padding_top=50;
                        			    }elseif($years==3){
                        			        $padding_top=80;
                        			    }else{
                        			        $padding_top=70;
                        			    }
        				 
        			                }   
        			
        				
        					
                        			$result_list .='    
                        			            <tr>
                        			                <th style="text-align:center;"><b style="font-weight:900;font-size:12px;"> GRAND TOTAL</b> </th>
                        			                <th style="text-align:center;"><b style="font-weight:900;font-size:12px;"> '.$out_of.'</b></th>
                        			                <th style="text-align:center;"><b style="font-weight:900;font-size:12px;">'.$obtained.'</b></th>
                        			            </tr>
                        			
                        			</tbody>
                                        		       </table>
                                        		    </div>';
        	
				}}
			    

    
    
    
    /*------------ end query ------------------------------*/
    
   
    $dob = date('d-m-Y',strtotime($__S->dob));
    
// define some HTML content with style
$html = <<<EOF
    
    <title> $__S->name - MARKSHEET  </title>

   <style>
body  {
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
	table, td, th {
      border: 1px solid black;
    }
    table {
      width: 100%;
      border-collapse: collapse;
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
	.mtt-100{
	    margin-top:-180px;
	}
	.mt-110{
	    margin-top:150px;
	}
	table.hide-border,table.hide-border tbody,table.hide-border tbody tr,table.hide-border tbody tr th,table.hide-border tbody tr td{
	    border:0px solid none!important;
	}
</style>


</head>
<body>
    
    
   
   
        
            <div class="row " style="margin-top:-105px;" >
			    
			    <div class="col-md-12">
			        
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: ;z-index:1;height:650px;">
					  
					    	<div class="row" style="margin-top:372px;">
                        	   <table class="hide-border" style="width:94%;margin-left:26px;font-size:12px;">
                                    <tbody>
                                       <tr>
                                            <th width=25%><b class="uppercase">ENROLLMENT NO:</b></th><td> $__S->enrollment_no</td>
                                       </tr>
                                        <tr>
                                            <th><b class="uppercase">Roll NO:</b></th><td> $a->roll_no</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Student Name:</b></th><td> $__S->name</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Father Name:</b></th><td> $__S->father</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Mother Name:</b></th><td> $__S->mother</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Date of Birth:</b></th><td> $dob</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Course Name:</b></th><td colspan="2">$course->course_name <br/> ($year_name)</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Session:</b></th><td colspan="2"> $row1111->BATCH_NAME</td>
                                       </tr>
                                       <tr>
                                            <th><b class="uppercase">Center:</b></th><td colspan="2"> ($institute->center_number) $institute->institute_name</td>
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
					 
            				
                            
	               
	                        <br>
	                        <div class="row" style="margin-left:10px;padding-left:10px;max-height:250px;">
					            <table style="width:95%;padding-left:10px;font-size:10px;" >
        							<thead style="border:  1px solid;">
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
        							</thead>
        							<tbody>
        							$bill_list
        							</tbody>
        					    </table>
					        </div>
					        <br>
					        $division
					        $result_list
					        
    				 </div>
    				  
					<div style="position:absolute;z-index:2;left:4%;top:79%">
                       $qr_code
                    </div>   
                    <div style="position:absolute;z-index:2;right:8%;top:32%"><img style="height:97px;width:98px;" src="$photo_url"></div>
                    
                    <div class="date" style="position:absolute;bottom:10%;left:4%">
                        <b>ISSUE DATE :-  $date</b>
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
    $this->pdf->stream("$__S->enrollment_no.pdf", array('Attachment'=>0));
    //$this->pdf->stream("abc.pdf", array('Attachment'=>0));
    
            // 'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}
public function view_backup()
{
    $this->load->library('pdf');
    
    /*------------- start query -----------------------------*/
    $result = $this->db->query("SELECT *,results.id as resultid,admit_card.roll_no as rollno,results.year as result_year FROM results LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) where results.id = '".$this->uri->segment(3)."'");
	$results=$result->row();
	$result_array=$result->result();
    if($results->result_year==1){
        $year_name='FIRST YEAR';
    }elseif($results->result_year==2){
        $year_name='SECOND YEAR';
    }
    elseif($results->result_year==3){
        $year_name='THIRD YEAR';
    }elseif($results->result_year==4){ 
        $year_name='FOURTH YEAR';
    }elseif($results->year==5){
        $year_name='FIFTH YEAR';
    }else{
        $year_name='';
    }
	$__R = $result->row(); 
	$course = $this->db->query("SELECT * FROM courses where id = '".$__R->course_id."'")->row();
	$course_id=$__R->course_id;
    $enrollment_no=$__R->enrollment_no;
	$stu = $this->db->query("SELECT * FROM students s left join  session_year se on se.id=s.session where  s.enrollment_no = '".$__R->enrollment_no."' ");
	$__S = $stu->row();
	
	
	$start_year = ($__S->start + ($results->result_year - 1));
	
	$end_year = ($__S->end + ($results->result_year - 1));
	
	
	
	$institute = $this->db->query("SELECT * FROM centers where id = '".$__S->center_id."'")->row();
    $marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$this->uri->segment(3)."'");
     $photo='';
     $photo_url='';
     $photo_url.='uploads/'.$__S->photo;
     $photo='<img style="height:115px;width:50px;margin-left:520px;marin-top:1200px;" src="'.$photo_url.'">';

    $header_image= '';
   $header_image.='temp/'.$__R->qr_code;
   $qr_code='';
  $qr_code.=' <img  style="height:100px;" src="'.$header_image.'">';
    $logo ='';
                        
    $bill_list  = '';
    $bill_list .=          
	
	$rows = $marks->num_rows()+1;
	$i=1;
	$ttl=0;
	$tot=0;
	$tot_practical=0;
	$tot_marks=0;
	$grand_ttl=0;
	$grand_total=0;
	
	//print_r($marks->result());
	
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
     
    
                                               
    $bill_list .= '<tr>
                        <td style="border: 1px solid ;" colspan="1">
                            
                        </td>
                        <td style="border: 1px solid ;font-weight:900;"> <b>GRAND TOTAL</b> </td>
                        <td style="border: 1px solid;"><b>'.$tot.'</b></td>
                        <td style="border: 1px solid ;"></td>
                        <td style="border: 1px solid;"><b>'.$ttl.'</b></td>
                        <td style="border: 1px solid;"><b>'.$tot_practical.'</b></td>
                        <td style="border: 1px solid;"></td>
                        <td style="border: 1px solid;"><b>'.$tot_marks.'</b></td>
                        <td style="border: 1px solid;"><b>'.$grand_total.'</b></td>
                        <td style="border: 1px solid;"><b>'.$grand_ttl.'  </b></td>
                    </tr>';  
    $division='';
            
    	     //  $x = 60;  
    	       $x=($grand_ttl/$grand_total)*100;  
    	     if($x<33 )	 {
    	           $division.= '  <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : FAILED </b></h3>';
    	      }
    	      elseif($x>=33 && $x<45){
    	             $division.='<h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED WITH THIRD DIVISION</b></h3>';
    	     }
    	     elseif($x>=45 && $x<60){
    	          $division.=   '<h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED WITH SECOND DIVISION</b></h3>';
    	       }
    	       elseif($x>=60 && $x<75){
    	          $division.=' <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED WITH FIRST DIVISION</b></h3>';
    	       }elseif($x>=75){
    	            $division.=' <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED WITH HOUNOURS  </b></h3>';
    	       }else{
    	           $division.=' <h3 class="text-center" style="margin-top:-10px;"><b>RESULT : PASSED WITH HOUNOURS  </b></h3>';
    	       }
    	  
    	       
    $result_list='';
    $padding_top=80;
    
    if(@$course->type==2){
    //$result_list .= 
	        	$cur_year=$__R->year;
	        	$pre_year=$cur_year-1;
	        	$get_marks=$this->db->query('select * from results where course_id="'.$course_id.'" and enrollment_no="'.$enrollment_no.'"')->result();
	            if($pre_year!=0){
	
	
	
	$result_list .=		
				    '<div class="" style="padding-left:10px;margin-top:-10px;">
					  <table style="width:75%;margin-left:150px;font-size:10px;" >
        		    	<tbody style="border:  1px solid;">
        		    	    <tr style="border: 1px solid;">
        								    <th style="border: 1px solid;" ><b>YEAR</b></th>
        								    <th style="border: 1px solid;" ><b>MAXIMUM MARKS</b></th>
        								    <th style="border: 1px solid;" ><b>OBTAINED MARKS</b></th>
        					</tr>';
			            $result_list .=	
        			            $years=1;
        			            $out_of = 0;
        			            $obtained = 0;
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
        				
        				
                    				        $out_of = $out_of + $grand_totals;
                    				        $obtained = $obtained + $grand_ttls;
        				                    $result_list .=		 $years++;
        				                }
        				
                                	    if($years==1){
                        			        $padding_top=50;
                        			    }elseif($years==3){
                        			        $padding_top=80;
                        			    }else{
                        			        $padding_top=70;
                        			    }
        				 
        			                }   
        			
        				
        					
                        			$result_list .='    
                        			            <tr>
                        			                <th><b style="font-weight:900;"> GRAND TOTAL</b> </th>
                        			                <th><b style="font-weight:900;"> '.$out_of.'</b></th>
                        			                <th><b style="font-weight:900;">'.$obtained.'</b></th>
                        			            </tr>
                        			
                        			</tbody>
                                        		       </table>
                                        		    </div>';
        	
				}}
			    

    
    
    
    /*------------ end query ------------------------------*/
    
    
    
    
// define some HTML content with style
$html = <<<EOF
    
    <title> $__S->name - MARKSHEET  </title>

   <style>
body  {
/*
  background-image: url("background-mage/MARKSHEET.jpg");
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
	table, td, th {
      border: 1px solid black;
    }
    table {
      width: 100%;
      border-collapse: collapse;
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
	.mtt-100{
	    margin-top:-180px;
	}
	.mt-110{
	    margin-top:150px;
	}
</style>


</head>
<body>
    
    
   
   
        <img style="height:120px;width:115px;margin-left:520px;margin-top:110px;" src="$photo_url">
            <div class="row " style="margin-top:-105px;" >
			    
			    <div class="col-md-12">
			        
			        <div class="box-body" id="printableArea" style="position:relative;padding-bottom: ;z-index:1;height:650px;">
					  
					    	   
					 
            				<div class="row" style="padding-top:190px;">
            				   <table style="width:94%;margin-left:26px;font-size:12px;">
            	                    <tbody>
            	                       <tr> <td colspan="3" style="border: 1px solid transparent;background: transparent;">
            	                                <b>ROLL NO. :</b> $results->rollno
            	                            </td> 
            	                            <td style="border: 1px solid transparent;background: transparent;text-align:center;"> <b>ENROLLMENT NO: $__S->enrollment_no </b> </td> 
            	                            <td style="border: 1px solid transparent;background: transparent;"> 
            	                                &nbsp;&nbsp;&nbsp;&nbsp;
            	                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	                                <b>SESSION :</b> $start_year-$end_year</td>
            	                       </tr> 
            	                        
            	                    </tbody>				      
            	               </table>
            	            </div>
        	                
	                        <center style="margin-top:12px;">
	                            <h4 style="text-align:center;"><b style="font-size:13px;">$course->course_name</b></h4>
                                <h4 style="	margin-left:290px;"><b>$year_name</b></h4>
                            </center>
                            <div style="margin-left:20px;padding-left:12px;">
                                <div style="width:60%;float:left;font-size:12px;" >
                                    <b style="font-size:12px;">NAME. :</b> $__S->name
                                </div>
                                <div style="width:40%;float:left;font-size:12px;">
                                   <b style="font-size:12px;"> &nbsp;&nbsp; S/O,D/O :</b> $__S->father
                                </div>
                            </div>
                            <div style="margin-left:20px;padding-left:10px;padding-top:10px;font-size:12px;"><br>
                                <b style="font-size:12px;">INSTITUTE NAME : :</b>($institute->center_number) $institute->institute_name
                            </div>
                            
	               
	                        <br>
	                        <div class="row" style="margin-left:10px;padding-left:10px;max-height:250px;">
					            <table style="width:95%;padding-left:10px;font-size:10px;" >
        							<thead style="border:  1px solid;">
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
        							</thead>
        							<tbody>
        							$bill_list
        							</tbody>
        					    </table>
					        </div>
					        <br>
					        $division
					        $result_list
					        
    				 </div>
    				  
					<div style="width:50%;margin-left:40px;font-size:18px;  background:transparent">
                       $qr_code
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
    $this->pdf->stream("$__S->enrollment_no.pdf", array('Attachment'=>0));
    //$this->pdf->stream("abc.pdf", array('Attachment'=>0));
    
            // 'Attachment'=>0 for view and 'Attachment'=>1 for download file        
}













} 

?>