
<?php
  $student =   $this->db->get_where('students',['id'=>@$this->uri->segment(3)])->row();

?>
<script>
// $(document).ready(function () {


 //window.onload = get_course_detail;
 
 
//alert('kk');
 window.onload = run_js_program;
// $( document ).ready(function() {
//     get_city_detail();
// });
   
function run_js_program(){
    
    get_course_detail();
    get_city_detail();
} 
 
 
 
function get_course_detail()
{    
 	var d = '<?php echo @$student->category; ?>';
	var sub_cat = '<?php echo @$student->course_id ?>';
	 //var d = $(this);
		if (d != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_category',
				data: 'brandid=' + d,
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
				// 	$('.ccategory option').remove();
					var str = '';
					str += "<option value=''>--Select Course--</option>";
					$.each(msg, function (index, element) {
						if(element.id == sub_cat){
						    str += "<option value='" + element.id + "' selected='selected'>" + element.course_name + "</option>";
						}else{
						    str += "<option value='" + element.id + "'>" + element.course_name + "</option>";
						}
					});
					
					//-------//alert(str);
					$('.ccategory').append(str);
					
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		}
}
   
    
//window.onload = get_city_detail;

function get_city_detail()
{ 
   
    
        var stateid = '<?php echo  @$student->state; ?>';
        //alert(stateid);
        var district = '<?php echo  @$student->distric; ?>';
    	
    	
    	
		if (stateid != '') {
			$.ajax({
				type: 'POST',
				url: get_loc + 'get_state',
				data: 'stateid=' + stateid,
				dataType: "json",
				headers: {
					'Client-Service': 'frontend-client',
					'Auth-Key': 'simplerestapi',
					'User-ID': loginid,
					'Authorization': token,
					'type': type
				},
				success: function (msg) {
				console.log(msg);
					var str = '';
					str += "<option value='0'>--Select District--</option>";
					$.each(msg, function (index, element) {
					    if(district == element.DISTRICT_ID){
					        str += "<option value='" + element.DISTRICT_ID + "' selected='selected'>" + element.DISTRICT_NAME + "</option>";
					    }else{
					        str += "<option value='" + element.DISTRICT_ID + "'>" + element.DISTRICT_NAME + "</option>";
					    }
					    
					});
					
					//alert(str);
					
					$('#district').append(str);
				},
				error: function (msg) {
					if (msg.responseJSON['status'] == 303) {
						location.href = base_loc;
					}
				}
			});
		} else {
			var str = '';
			str += "<option value=''>--Select District--</option>";
			$('.city').append(str);
		}
}
    
    
    
    
</script>
<script>

    
   
    
</script>


<div class="row">

        <div class="col-sm-12">
                    <div class="white-box">
                <?php
                
              $type = 'Add';
              $vip = 1;
              $getNumber = 0;
                if($this->uri->segment(3)!= '')
                {
                    $type = 'Update';
                    $admission_date = $student->addmission_date;
                 ?>
                    <form class="form-horizontal" method="post" id="update_student_registration" enctype="multipart/form-data">
                <?php
                }else{
                    $admission_date = date('Y-m-d');
                ?> 
                    <form class="form-horizontal" method="post" id="student_registration" enctype="multipart/form-data">
                <?php
                   $getNumber = (($this->input->get('type') == 'urgent') ? 1 : 2);
                    echo ($vip = $this->input->get('type')) ? '<input type="hidden" name="vip" value="'.$getNumber.'">' : '';
                }
                
                
                ?>
            
                
                    <input type="hidden" name="studentid" value="<?php echo @$student->id; ?>">
                    
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 ><?=$type?>  Student <?=($this->input->get('type') ? get_admission_type($getNumber) : '')?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                               
                                    <div class="form-group">
                                        <label class="col-md-12">Admission Date</label>
                                        <div class="col-md-10">
                                         <input type="date" class="form-control mydatepicker" name="admission_date" placeholder="Admission Date" value="<?php echo @$admission_date;?>"  required="">
                                        </div>
                                    </div>
                            
                                    <?php 
                                      if(@$student->enrollment_no!= '' ){
                                        ?>
                                        <div class="form-group">
                                            <label class="col-md-12">Enrollment number</label>
                                            <div class="col-md-10">
                                                <input type="hidden" class="form-control" name="enrollment_no" placeholder="Enrollment Number" required="" value="<?php echo @$student->enrollment_no; ?>">
                                            </div>
                                        </div>
                                        <?php   
                                      }
                                      
                                      
                                      if($_SESSION['type']==2){
                                          echo '<input type="hidden" name="center_id" value="'.$this->session->userdata('loginid').'" >';
                                      }else{
                                    ?>
                                    <div class="form-group ">
                        				<label class="col-md-12">Select Center Name</label>
                        			    <div class="col-md-10">
                        				    <select class="form-control get-center-courses" name="center_id" required="">
                        					<option value="">--Select--</option>
                        					<?php
                        						$course = $this->db->get('centers');
                        						foreach( $course->result() as $row)
                        						{
                        						     if(@$student->center_id == $row->id){
                        						    
                        							    echo '<option value="'.$row->id.'" selected>'.($row->institute_name).'</option>';
                        						     }else{
                        						         echo '<option value="'.$row->id.'">'.($row->institute_name).'</option>';
                        						     }
                        						     
                        						}
                        					?>
                        				</select>
                        				</div>
                                    </div>
                                    <?php
                                    }
                                
                                      
                                    if($this->session->userdata('type') == 1 AND false):
                                    ?>
                              
                             
                                    <div class="form-group">
                                        <label class="col-md-12">Course Category/ Academy</label>
                                        <div class="col-md-10">
                                            <select class="form-control get_category" id="Academic" name="Academic" required="">
                                                <option value=""> -- Select  Course Category/ Academy -- </option>
                                                   <?php
                                                   
                                                $brand = $this->db->get('brand')->result();
                                                foreach($brand as $brand_list){
                                                    if($student->category == $brand_list->id){
                                                        echo '<option value="'.$brand_list->id.'" selected="selected">'.$brand_list->brand_name.'</option>';
                                                    }else{
                                                        
                                                        echo '<option value="'.$brand_list->id.'">'.$brand_list->brand_name.'</option>';
                                                    }
                                                        
                                                }
                                    
                                        ?>
                                            </select>
                                        
                                        </div>
                                    </div>
                                    <?php
                                    endif;
                                    ?>
                                    <div class="form-group">
                                        <label class="col-md-12">Course</label>
                                        <div class="col-md-10">
                                            <select class="form-control ccategory get_sub_category" id="course" name="course" required="">
                                                <?php
                                                if($this->session->userdata('type') == 2):
                                                    echo $this->center_model->get_center_course_options($_SESSION['loginid'],@$student->course_id);
                                                    // $asignedCourses = $this->center_model->get_course($_SESSION['loginid']);
                                                    // $getCourse = $this->db->where_in('id',$asignedCourses)->get('courses');
                                                    // if($getCourse->num_rows()){
                                                    //     foreach($getCourse->result()  as $co)
                                                    //         echo '<option value="'.$co->id.'">'.$co->course_name.'</option>';
                                                    // }
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                              
                                    
                                
                                
                                    <div class="form-group">
                                            <!--before Name:- Select Batch-->
                                        <label class="col-md-12">Session  </label>
                                        <div class="col-md-10">
                                        <select class="form-control" name="Batch" required="">
                                              <option value="">Select Session </option>
                                              <?php 
                                            $batch_session=$this->db->get('batch_session')->result();
                                            foreach($batch_session as $row){
                                                if(@$student->Batch == $row->BATCH_ID){
                                                    ?>
                                                    <option value="<?php echo $row->BATCH_ID?>" selected="selected">
                                                         <?php echo $row->BATCH_NAME;?>
                                                         
                                                    </option>
                                                    <?php
                                                }else{
                                                    ?>
                                                     <option value="<?php echo $row->BATCH_ID?>"><?php echo $row->BATCH_NAME;?></option>
                                                    
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                             
                              <div class="form-group">
                                <label class="col-md-12">Name</label>
                                <div class="col-md-10">
                                 <input name="name" type="text" placeholder="Name of the candidate" class="form-control" value="<?php echo @$student->name; ?>" required="">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-md-12">Email-ID</label>
                                <div class="col-md-10">
                                 <input name="email" type="text" placeholder="Email-ID" class="form-control" value="<?php echo @$student->email; ?>">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-md-12">Mobile No</label>
                                <div class="col-md-10">
                                 <input name="phone_no" type="number" placeholder="Mobile No" class="form-control" value="<?php echo @$student->mobile; ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Date of Birth </label>
                                <div class="col-md-10">
                                 <input type="date" class="form-control mydatepicker" name="dob" placeholder="Date of Birth" required="" value="<?php echo @$student->dob; ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Mother Name</label>
                                <div class="col-md-10">
                                 <input type="text" class="form-control" name="mother" placeholder="Mother Name" required="" value="<?php echo @$student->mother; ?>">
                                </div>
                              </div>
                              
                              
                              </div>
                              <div class="col-sm-6 col-xs-12">
                                  
                              <div class="form-group">
                                <label class="col-md-12">Father Name</label>
                                <div class="col-md-10">
                                 <input type="text" class="form-control" name="father" placeholder="Father Name" required="" value="<?php echo @$student->father; ?>">
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-10">
                                 <input type="text" class="form-control" name="password" placeholder="Create Password" required="" value="<?php echo @$student->password; ?>">
                                </div>
                              </div>
                               
                              <div class="form-group">
                                <label class="col-md-12">Address for Communication</label>
                                <div class="col-md-10">
                                 <textarea name="Address" placeholder="Address for Communication" class="form-control" style="height: 110px; margin: 0px;" ><?php echo @$student->address; ?></textarea>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Pincode</label>
                                <div class="col-md-10">
                                 <input type="text" class="form-control" name="pincode" placeholder="Pincode" value="<?php echo @$student->pincode; ?>" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Country</label>
                                <div class="col-md-10">
                                 <select name="country" id="country" class="form-control">
                                    <option value=""> -- Select Country -- </option>
                                    <?php
                                    $country =  $this->db->get('country')->result();
                                    foreach($country as $country_list){
                                       if($country_list->COUNTRY_ID == @$student->country){
                                           echo '<option value="'.$country_list->COUNTRY_ID.'" selected="selected"> '.$country_list->COUNTRY_NAME.' </option>';
                                       }else{
                                           echo '<option value="'.$country_list->COUNTRY_ID.'"> '.$country_list->COUNTRY_NAME.' </option>';
                                       }
                                        
                                    
                                        
                                    }
                                    ?>
                                    
                                    
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">State</label>
                                <div class="col-md-10">
                                 <select name="state" id="state" class="form-control state">
                                    <option value="">Select State</option>
                                       <?php
                                        $state=$this->db->get('state')->result();
                                        foreach($state as $row){
                                             if(@$student->state == $row->STATE_ID){
                                             ?>
                                             <option value="<?php echo $row->STATE_ID;?>" selected="selected"><?php echo $row->STATE_NAME;?></option>
                                             <?php    
                                             }else{
                                            ?>
                                            <option value="<?php echo $row->STATE_ID;?>"><?php echo $row->STATE_NAME;?></option>
                                            <?php
                                             }
                                        }
                                        ?>
                                       </select>
                                </div>
                              </div>
                              <div class="form-group">
                              <label class="col-md-12">DISTRICT</label>
                              <div class="col-md-10">
                                    <select name="district" id="district" class="form-control city">
                                    <option value=""> -- Select City -- </option>
                          </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">CITY</label>
                                <div class="col-md-10">
                                 <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo @$student->city; ?>" required="">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Gender</label>
                                <div class="col-md-10">
                                <select class="form-control" name="gender" required="">
                                    <option value=""> -- Select Gender -- </option>
                                    <?php 
                                        $gender = $this->db->get('gender')->result();
                                        foreach($gender as $gender_list){
                                           if($gender_list->GENDER_ID == @$student->gender){
                                               echo '<option value="'.$gender_list->GENDER_ID.'" selected="selected"> '.$gender_list->GENDER_NAME.' </option>';
                                           }else{
                                               echo '<option value="'.$gender_list->GENDER_ID.'"> '.$gender_list->GENDER_NAME.' </option>';
                                           }
                                            
                                        
                                            
                                        }
                                    ?>
                                    
                                </select>
                                </div>
                              </div>
                              
                              
                              <?php if(0){ ?>
                              <!--<div class="form-group">
                                <label class="col-md-12">Session</label>
                                <div class="col-md-10">
                                 <select class="form-control" name="Session" required="">
                                    <option value="">Select Session</option>
                                    <?php 
                                    $session=$this->db->get('session_year')->result();
                                    foreach($session as $row){
                                        if(@$student->session == $row->id){
                                            ?>
                                            <option value="<?php echo $row->id?>" selected="selected">
                                                 <?php echo $row->start;?>-
                                                 <?php echo $row->end;?>
                                            </option>
                                            <?php
                                        }else{
                                            ?>
                                             <option value="<?php echo $row->id?>"><?php echo $row->start;?>-<?php echo $row->end;?></option>
                                            
                                            <?php
                                        }
                                    }
                                    ?>
                             </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-md-12">Parent Occupation</label>
                                <div class="col-md-10">
                                    <select name="Occupation" class="form-control">
                                        <option value=""> -- Select Occupation -- </option>
                                        <?php
                                        $business =  $this->db->get('business_list')->result();
                                        foreach($business as $business_list){
                                            if($business_list->BUSSINESS_ID == @$student->occupation ){
                                                echo '<option value="'.$business_list->BUSSINESS_ID.'" selected="selected">'.$business_list->BUSINESS_NAME.'</option>';
                                            }else{
                                                echo '<option value="'.$business_list->BUSSINESS_ID.'">'.$business_list->BUSINESS_NAME.'</option>';
                                            }
                                            
                                        
                                            
                                        }
                                        ?>
                                        
                                                         
                                    </select>
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="col-md-12">Medium</label>
                                <div class="col-md-10">
                                <select class="form-control" name="medium" required="">
                                    <option value=""> -- Select Medium -- </option>
                                    <?php  
                                    $medium = $this->db->get('medium_list')->result();
                                    foreach($medium as $medium_list){
                                        if($medium_list->MEDIUM_ID == @$student->medium){
                                            echo '<option value="'.$medium_list->MEDIUM_ID.'" selected="selected"> '.$medium_list->MEDIUM_NAME.' </option>';
                                        }else{
                                            echo '<option value="'.$medium_list->MEDIUM_ID.'"> '.$medium_list->MEDIUM_NAME.' </option>';
                                        }
                                    }
                                    ?>
                                    
                                   
                                </select>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="col-md-12">Martial Status</label>
                                <div class="col-md-10">
                                <select class="form-control" name="marrital_status" required="">
                                    <option value=""> -- Select Martial Status -- </option>
                                    <?php
                                    $married = $this->db->get('marital_status')->result();
                                    foreach($married as $married_list){
                                        if(@$student->marrital_status == $married_list->MS_ID){
                                            echo '<option value="'.$married_list->MS_ID.'" selected="selected">'.$married_list->MS_NAME.'</option>';
                                        }else{
                                            echo '<option value="'.$married_list->MS_ID.'">'.$married_list->MS_NAME.'</option>';
                                        }
                                        
                                    
                                        
                                    }
                                    ?>
                                   
                                </select>
                                </div>
                              </div>
                              
                              
                              <div class="form-group">
                                <label class="col-md-12">Nationality</label>
                                <div class="col-md-10">
                                <select class="form-control" name="nationality" required="">
                                    <option value=""> -- Select Nationality -- </option>
                                    <?php
                                    $nationality =  $this->db->get('nationality')->result();
                                    foreach($nationality as $nationality_list){
                                        if(@$student->nationality == $nationality_list->NATIONALITY_ID){
                                            echo '<option value="'.$nationality_list->NATIONALITY_ID.'" selected="selected"> '.$nationality_list->NATIONALITY_NAME.' </option>';
                                        }else{
                                            echo '<option value="'.$nationality_list->NATIONALITY_ID.'"> '.$nationality_list->NATIONALITY_NAME.' </option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                              </div>
                             
                              <div class="form-group">
                                <label class="col-md-12">Blood Group</label>
                                <div class="col-md-10">
                                <select class="form-control" name="blood_group" required="">
                                    <option value=""> -- Select Blood Group -- </option>
                                    <?php
                                        $blood = $this->db->get('blood_group')->result();
                                       
                                        foreach($blood as $blood_list)
                                        {
                                            if($blood_list->BG_ID == @$student->blood_group){
                                                echo '<option value="'.$blood_list->BG_ID.'" selected="selected">'.$blood_list->BG_NAME.'</option>'; 
                                            }else{
                                                echo '<option value="'.$blood_list->BG_ID.'" >'.$blood_list->BG_NAME.'</option>'; 
                                            }
                                           
                                        }
                                    ?>
                                                       
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Mother Tongue</label>
                                <div class="col-md-10">
                                <select class="form-control" name="mother_tongue" required="">
                                    <option value="">Select Mother Tongue</option>
                                    <?php  
                                    $languages = $this->db->get('languages')->result();
                                    foreach($languages as $language_list){
                                        if($language_list->id == @$student->mother_tongue){
                                            echo '<option value="'.$language_list->id.'" selected="selected"> '.$language_list->language.' </option>';
                                        }else{
                                            echo '<option value="'.$language_list->id.'"> '.$language_list->language.' </option>';
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Religion</label>
                                <div class="col-md-10">
                                <select class="form-control" name="religion" required="">
                                <option value="">Select Religion</option>
                                <?php
                                $religion = $this->db->get('religion')->result();
                                foreach($religion as $religion_list){
                                 if($religion_list->RELIGION_ID == @$student->religion){
                                     echo '<option value="'.$religion_list->RELIGION_ID.'" selected="selected">'.$religion_list->RELIGION_NAME.'</option>';
                                 }else{
                                     echo '<option value="'.$religion_list->RELIGION_ID.'">'.$religion_list->RELIGION_NAME.'</option>';
                                 }
                                    
                                }
                                ?>
                                
                                </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-md-12">Community</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="community" required="">
                                    <option value=""> -- Select Community -- </option>
                                        <?php
                                        $cast = $this->db->get('cast')->result();
                                        foreach($cast as $cast_list){
                                            if($cast_list->CAST_ID == @$student->community){
                                                echo '<option value="'.$cast_list->CAST_ID.'" selected="selected">'.$cast_list->CAST_NAME.'</option>';
                                            }else{
                                                echo '<option value="'.$cast_list->CAST_ID.'">'.$cast_list->CAST_NAME.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                              </div>
                              -->
                              <?php } ?>
                              
            
                             
                            </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th colspan="6" style="background-color: #dff7f5;">Educational Qualification</th>
                                        </tr>
                                        <tr>
                                            <th>Qualification</th>
                                            <th>Reg No.</th><th>Subject</th>
                                            <th>Name of the Board/University</th>
                                            <th>Year of Completion</th>
                                            <th>Percentage of Marks</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" placeholder="Qualification" name="Qualification" style="width:110px;" value="<?php echo @$student->highest_qualification; ?>"></td>
                                            <td><input type="text" placeholder="Reg No." name="reg_no" style="width:110px;" value="<?php echo @$student->reg_no; ?>"></td>
                                            <td><input type="text" placeholder="Subject" name="subject" style="width:110px;" autocomplete="off" value="<?php echo @$student->subject; ?>"></td>
                                            <td><input type="text" placeholder="Board/University" name="board" style="width:130px;" value="<?php echo @$student->board; ?>"></td>
                                            <td><input type="number" placeholder="Year of Completion" name="yop" style="width:100px;" value="<?php echo @$student->passing_year; ?>"></td>
                                            <td><input type="text" placeholder="Percentage of Marks" name="marks" style="width:120px;" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" value="<?php echo @$student->marks; ?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr style="background-color:#afdab4; color:#FFF;">
                                            <th colspan="3">Submit Documents </th>
                                            <th></th>
                                        </tr>
                                        <tr style="background-color:#cdd1e2; color:#FFF;">
                                            <th>Sr No</th>
                                            <th>Document Name</th>
                                            <th>Upload Document <span style="color:#F00;">(File Size must be less than 2MB)</span></th>
                                            <th>Uploaded</th>
                                        </tr>
                                        <tr>
                                            <td>1</td><td>Passport Size Photo Graph</td>
                                            <?php
                                            if(@$student->photo!= ''){
                                            ?>
                                            <td><input type="file" name="photo" > </td>
                                            <?php
                                            }else{
                                              ?>
                                              <td><input type="file" name="photo"  required="required"> </td>
                                              
                                              <?php
                                            }
                                            
                                            ?>
                                            
                                             
                                            
                                            <td><img style="height:60px;width:60px;" src="<?php echo base_url('uploads/'.@$student->photo.' '); ?>"></td> 
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>10th Mark sheet</td>
                                            <td><input type="file" name="tenth_marksheet" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>12th Mark sheet</td>
                                            <td><input type="file" name="twelve_marksheet" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Graduation Mark sheet</td>
                                            <td><input type="file" name="graduation_marksheer" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Other Degree</td>
                                            <td><input type="file" name="graduation_degree" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Upload Signature </td>
                                            <td><input type="file" name="image2" ></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Upload Aadhar Card</td>
                                            <td><input type="file" name="aadhar" ></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>                        
                            </div>
                        </div>
                        <div class="panel-footer">
                          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="register_now">Submit Admission</button>
                        </div>
                    </div>
                </form>
                
            </div>
            
        </div> </div>
    

























