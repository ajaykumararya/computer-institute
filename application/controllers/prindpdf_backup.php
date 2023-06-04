<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printpdf extends CI_Controller {

public function __construct()
{
parent::__construct();
$this->load->library('pdf');
}

public function index()
{
    $this->load->library('pdf');

	
 

// define some HTML content with style
$html = <<<EOF
   <style>
body  {
  background-image: url("uploads/MARKSHEET.jpg");
  
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



} 

?>