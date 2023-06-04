
<?php
  $student =   $this->db->get_where('students',['id'=>@$_SESSION['userid']])->row();

     



?>

<?php
if(!isset($_SESSION['userid'])){
    redirect('home');
}
        $row=$this->db->query('select *,s.name as name from students s left join  centers  c  on s.center_id=c.id	 left join courses co on co.id=s.course_id left join session_year se on se.id=s.batch left join session_year ses on ses.id=s.session left join state st on st.STATE_ID=s.state left join city ci on ci.id=s.city  where s.id="'.@$_SESSION['userid'].'"')->row();

    $num_row=$this->db->query('select *,s.name as name from students s left join  centers  c  on s.center_id=c.id	 left join courses co on co.id=s.course_id left join session_year se on se.id=s.batch left join session_year ses on ses.id=s.session left join state st on st.STATE_ID=s.state left join city ci on ci.id=s.city  where s.id="'.@$_SESSION['userid'].'"')->num_rows();
    
    $candidate =        $this->db->get_where('user_registration',['id'=>$_SESSION['userid']  ])->row();
    
//   $row =   $this->db->get_where('students',['id'=>@$_SESSION['userid']])->row();
if($num_row > 0){
    redirect('form-download');
}
?>


        <!--Banner Wrap Start-->
        <div class="kf_inr_banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    	<!--KF INR BANNER DES Wrap Start-->
                        <div class="kf_inr_ban_des">
                        	<div class="inr_banner_heading">
								<h3>STUDENT REGISTRATION FORM</h3>
                        	</div>
                           
                            <div class="kf_inr_breadcrumb">
								<ul>
									<li><a href="<?php echo base_url();?>">Home</a></li>
									<li><a href="#">STUDENT REGISTRATION</a></li>
								</ul>
							</div>
                        </div>
                        <!--KF INR BANNER DES Wrap End-->
                    </div>
                </div>
            </div>
        </div>

    	
    		




<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading"><h3>Student Form</h3></div>
		<div class="panel-body">
		    
		    
		    <form class="form-horizontal" method="post" id="student_registration" enctype="multipart/form-data">
                <input type="hidden" name="studentid" value="<?php echo @$student->id; ?>"
              <div class="row">
                <div class="col-sm-6 col-xs-12">
                   
                <div class="form-group">
                    <label class="col-md-12">Admission Date</label>
                    <div class="col-md-10">
                     <input type="date" style="border: solid 1px" class="form-control mydatepicker" name="admission_date" placeholder="Admission Date" value="<?php echo date('Y-m-d');?>" >
                    </div>
                  </div>
                 
                  
                  
                  <div class="form-group">
                    <label class="col-md-12">Course Category/ Academy</label>
                    <div class="col-md-10">
                    <select class="form-control get_category" style="border: solid 1px" id="Academic" name="Academic" required="">
                    <option value="">Course Category/ Academy </option>
                    <?php
                    $brand = $this->db->get('brand')->result();
                    foreach($brand as $brand_list){
                        echo '<option value="'.$brand_list->id.'">'.$brand_list->brand_name.'</option>';
                    }
                    ?>
                    </select>
                    
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Course </label>
                    <div class="col-md-10">
                        <select class="form-control ccategory " style="border: solid 1px" id="course" name="course" required="">
                   
                    
                    </select>
                    
                    </div>
                  </div>
                  
                 
                  <div class="form-group ">
                				<label class="col-md-12">Select Center Name</label>
                			    <div class="col-md-10">
                				    <select class="form-control" name="center_id" required="" style="border: solid 1px">
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
                  <div class="form-group">
                    <label class="col-md-12">Batch</label>
                    <div class="col-md-10">
                    <select class="form-control" name="Batch" required="" style="border: solid 1px">
                        <option value="">Select Batch </option>
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
                    <label class="col-md-12">Session</label>
                    <div class="col-md-10">
                     <select class="form-control" name="Session" required="" style="border: solid 1px">
                        <option value="">Select Session</option>
                        <?php 
                        $session=$this->db->get('session_year')->result();
                        foreach($session as $row){
                        ?>
                        <option value="<?php echo $row->id?>"><?php echo $row->start;?>-<?php echo $row->end;?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <label class="col-md-12">Name</label>
                    <div class="col-md-10">
                     <input name="name" type="text" style="border: solid 1px" placeholder="Name of the candidate" class="form-control" required="" value="<?php echo @$candidate->name;  ?>" readonly="readonly" >
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-md-12">Email-ID</label>
                    <div class="col-md-10">
                     <input name="email" type="text" style="border: solid 1px" placeholder="Email-ID" class="form-control" value="<?php echo @$candidate->email;  ?>" readonly="readonly" >
                    </div>
                  </div>
                   <div class="form-group">
                    <label class="col-md-12">Mobile No</label>
                    <div class="col-md-10">
                     <input name="phone_no" type="number" style="border: solid 1px" placeholder="Mobile No" class="form-control" value="<?php echo @$candidate->mobile;  ?>" readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Date of Birth</label>
                    <div class="col-md-10">
                     <input type="date" class="form-control mydatepicker" name="dob" placeholder="Date of Birth" required="" style="border: solid 1px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Mother Name</label>
                    <div class="col-md-10">
                     <input type="text" class="form-control" name="mother" placeholder="Mother Name" required="" style="border: solid 1px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Father Name</label>
                    <div class="col-md-10">
                     <input type="text" class="form-control" name="father" placeholder="Father Name" required="" style="border: solid 1px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Parent Occupation</label>
                    <div class="col-md-10">
                    <select name="Occupation" class="form-control" style="border: solid 1px">
                        <option value=""> -- Select Occupation -- </option>
                        <?php
                        $business =  $this->db->get('business_list')->result();
                        foreach($business as $business_list){
                            if($business_list->BUSSINESS_ID == $student->occupation ){
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
                    <select class="form-control" name="medium" required="" style="border: solid 1px">
                    <option value="">Medium</option>
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
                    <label class="col-md-12">Password</label>
                    <div class="col-md-10">
                     <input type="text" class="form-control" name="password" placeholder="Create Password" required="" value="<?php echo @$student->password; ?>" style="border: solid 1px">
                    </div>
                  </div>
                 
                  </div>
                  <div class="col-sm-6 col-xs-12">
                   
                  <div class="form-group">
                    <label class="col-md-12">Address for Communication</label>
                    <div class="col-md-10">
                     <textarea name="Address" placeholder="Address for Communication" class="form-control" style="height: 218px; margin: 0px; width: 100%;border: solid 1px" >
                         <?php echo @$student->address;  ?>
                     </textarea>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-12">Country</label>
                    <div class="col-md-10">
                     <select name="country" id="country" class="form-control" style="border: solid 1px">
                <option value=""> -- Select Country -- </option>
                <?php
                $country = $this->db->get('country')->result();
                foreach($country as $country_list){
                    echo '<option value="'.$country_list->COUNTRY_ID.'"> '.$country_list->COUNTRY_NAME.' </option>';
                }
                
                ?>
                
                
                </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">State</label>
                    <div class="col-md-10">
                     
                     
                     
                     <select name="state" id="state" class="form-control state" style="border: solid 1px">
                        <option value="">Select State</option>
                      <?php
                        $state=$this->db->get('state')->result();
                        foreach($state as $row){
                      ?>
                      <option value="<?php echo $row->STATE_ID;?>"><?php echo $row->STATE_NAME;?></option>
                      <?php
                        }
                      ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                  <label class="col-md-12">District</label>
                  <div class="col-md-10">
                    <select name="distric" id="city" class="form-control city" style="border: solid 1px">
                        <option value="">Select District</option>
              </select>
                  </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">City</label>
                    <div class="col-md-10">
                     <input type="text" class="form-control" name="city" placeholder="City" required="" style="border: solid 1px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Pincode</label>
                    <div class="col-md-10">
                     <input type="text" class="form-control" name="pincode" placeholder="Pincode" required="" style="border: solid 1px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Gender</label>
                    <div class="col-md-10">
                    <select class="form-control" name="gender" required="" style="border: solid 1px">
                    <option value="">Select Gender</option>
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
                  <div class="form-group">
                    <label class="col-md-12">Martial Status</label>
                    <div class="col-md-10">
                    <select class="form-control" name="marrital_status" required="" style="border: solid 1px">
                    <option value="">Select Martial Status</option>
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
                    <select class="form-control" name="nationality" required="" style="border: solid 1px">
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
                    <select class="form-control" name="blood_group" required="" style="border: solid 1px">
                    <option value="">Select Blood Group</option>
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
                    <select class="form-control" name="mother_tongue" required="" style="border: solid 1px">
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
                    <select class="form-control" name="religion" required="" style="border: solid 1px">
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
                    <select class="form-control" name="community" required="" style="border: solid 1px">
                    <option value="">Select Community</option>
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
                  
                  <!---
                  <div class="form-group">
                    <label class="col-md-12">Disability</label>
                    <div class="col-md-10">
                    	<select class="form-control " name="disability" required="required" style="border: solid 1px">
        				    <option value="Yes"> Yes  </option>
        				    <option value="No"> No  </option>
        				</select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-12">Ews</label>
                    <div class="col-md-10">
                    <select class="form-control " name="ews" required="required" style="border: solid 1px">
        				    <option value="Yes"> Yes  </option>
        				    <option value="No"> No  </option>
        				</select>
                    </div>
                  </div>
                  --->
                  
                  

                 
                </div>
                
                <div class="col-md-12" style=" overflow-x: scroll;">
                    
               
                    <table class="table table-bordered" style=" overflow-x: scroll;">
                        <tbody style=" overflow-x: scroll;"><tr><th colspan="6" style="background-color: #dff7f5;">Educational Qualification</th></tr>
                        <tr><th>Qualification</th><th>Reg No.</th><th>Subject</th><th>Name of the Board/University</th><th>Year of Completion</th><th>Percentage of Marks</th></tr>
                        <tr>
                        <td><input type="text" placeholder="Qualification" name="Qualification" style="width:110px;"></td>
                        <td><input type="text" placeholder="Reg No." name="reg_no" style="width:110px;"></td>
                        <td><input type="text" placeholder="Subject" name="subject" style="width:110px;" autocomplete="off"></td>
                        <td><input type="text" placeholder="Board/University" name="board" style="width:130px;"></td>
                        <td><input type="number" placeholder="Year of Completion" name="yop" style="width:100px;"></td>
                        <td><input type="text" placeholder="Percentage of Marks" maxlength="5" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" name="marks" style="width:120px;"></td>
                        </tr>
                        </tbody>
                    </table>
                 </div>
                
                <table class="table table-bordered">
                <tbody><tr style="background-color:#afdab4; color:#FFF;"><th colspan="3">Submit Documents </th></tr>
                    <tr style="background-color:#cdd1e2; color:#FFF;">
                        <th>Sr No</th>
                        <th>Document Name</th>
                        <th>Upload Document <span style="color:#F00;">(File Size must be less than 2MB)</span></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Passport Size Photo Graph</td>
                        <td><input type="file" name="photo" class="r_input" required="required"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>10th Mark sheet</td>
                        <td><input type="file" name="tenth_marksheet" class="r_input"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>12th Mark sheet</td>
                        <td><input type="file" name="twelve_marksheet" class="r_input"></td>
                    </tr>
                    
                    
                    <tr>
                        <td>4</td>
                        <td>Graduation Mark sheet</td>
                        <td><input type="file" name="graduation_marksheer" class="r_input"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Other Degree</td>
                        <td><input type="file" name="graduation_degree" class="r_input"></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Upload Signature </td>
                        <td><input type="file" name="image2" class="r_input"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Upload Aadhar Card</td>
                        <td><input type="file" name="aadhar" class="r_input"></td>
                    </tr>
                    <!-- 
                    <tr>
                        <td>8</td>
                        <td> Other Upload </td>
                        <td><input type="file" name="image3" class="r_input"></td>
                    </tr>
                    -->
                </tbody></table>                        

                <div class="box-footer">
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10" name="register_now">Submit Admission</button>
                </div>
                </div>
              </form>
		    
		</div>
	</div>
	<br>
	<br>
<!--</div>-->