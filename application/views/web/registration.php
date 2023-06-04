<?php



?>


<section class="divider">
      <div class="container pt-50 pb-70">
          
        <div class="row mt-10">
          <div class="col-md-12">
              
              
          <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Candidate Detail   
                <form id="register">               
                    <button type="button" class="btn btn-danger btn-xs pull-right" data-toggle="modal" data-target="#myModal" style="margin-right:10px;">Instructions</button></h4> </div>
                   
                    <div class="panel-body form-horizontal">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4">ADMISSION DATE</label>
                                <div class="col-sm-8">
                                    <input name="addmission_date" type="text" maxlength="10" id="txtDOJ" class="form-control" placeholder="dd-MM-yyyy" onkeyup="
                                                        var v = this.value;
                                                        if (v.match(/^\d{2}$/) !== null) {
                                                            this.value = v + '-';
                                                        } else if (v.match(/^\d{2}\-\d{2}$/) !== null) {
                                                            this.value = v + '-';
                                                        }" required="required">
                                    <span id="RequiredFieldValidator14" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 ">Student Name</label>
                                <div class="col-sm-8">
                                     <input name="name" type="text" id="txtName" class="form-control">
                                      <span id="RequiredFieldValidator7" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 ">Father's Name.</label>
                                <div class="col-sm-8">
                                    <input name="father_name" type="text" id="txtRegistrationNo" class="form-control" required="required">
                                    <span id="RequiredFieldValidator12" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-4">Mother's Name</label>
                                <div class="col-sm-8">
                                    <input name="mother_name" type="text" id="txtfatherName" class="form-control">
                                    <span id="RequiredFieldValidator13" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                            
                            
                        </div>
                        
                        <div class="col-sm-6">
                           
                            <div class="form-group">
                                <label class="col-sm-4">D.O.B</label>
                                <div class="col-sm-8">
                                    <input name="dob" type="text" maxlength="10" id="txtDOJ" class="form-control" placeholder="dd-MM-yyyy" onkeyup="
                                                        var v = this.value;
                                                        if (v.match(/^\d{2}$/) !== null) {
                                                            this.value = v + '-';
                                                        } else if (v.match(/^\d{2}\-\d{2}$/) !== null) {
                                                            this.value = v + '-';
                                                        }" required="required">
                                    <span id="RequiredFieldValidator14" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4">GENDER</label>
                                <div class="col-sm-8">
                                   <select name="gender" class="form-control" required="required">
                                    <option value="1">Male</option>
                                    <option value="2">Fe-Male</option>
                                   </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4">PHOTO</label>
                                <div class="col-sm-8">
                                   <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                           
                            
                            <div class="form-group">
                                <label class="col-sm-4">CATEGORY</label>
                                <div class="col-sm-8">
                                    <select name="category"  class="form-control" required="required">
                            		    		<option value="1">GENERAL</option>
                            		    		<option value="2">OBC</option>
                            		    		<option value="3">SC</option>
                                        		<option value="4">ST</option>
                        
                        	                </select>
                                    <span id="RequiredFieldValidator14" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                    <div id="MainPanel">
                        <div class="panel-heading" style="background-color:#F4F4F4;"><h4>School Detail <span style="color:red;">*</span> </h4></div>
                            <div class="panel-body form-horizontal">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-sm-4 ">APPERING SCHOOL <span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                           <input type="text" class="form-control" name="appearing_school" >
                                        <span id="RequiredFieldValidator3" style="color:Red;display:none;">Required</span>
                                    </div>
           
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 ">APPEARING STATE <span style="color:red;">*</span></label>
                              
                                     <div class="col-sm-8">
                                        <select class="form-control" name="appearing_city"  id="state">
                                        <?php  
                                        $state = get_all_states();
                                        foreach($state as $state_list){
                                            echo '<option value="'.$state_list->STATE_ID.'">'.$state_list->STATE_NAME.'</option>';
                                        }
                                        ?>
                                        </select>
                                        <span id="RequiredFieldValidator1" style="color:Red;display:none;">Required</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 ">APPEARING DISTRICT <span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="appearing_district " id="city" >
                                        </select>           
                                        <span id="RequiredFieldValidator11" style="color:Red;display:none;">Required</span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-4 ">SELECT COURSE <span style="color:red;">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="course"  >
                                            <?php
                                            $course  = $this->db->get('brand')->result();
                                            foreach($course as $course_list){
                                                echo '<option value="'.$course_list->id.'">'.$course_list->brand_name.'</option>';
                                            }
                                            ?>
                                            
                                        
                                        </select>           
                                        <span id="RequiredFieldValidator11" style="color:Red;display:none;">Required</span>
                                    </div>
                                </div>    
                        <div class="form-group">
                          <label class="col-sm-4 ">ENROLL FOR <span style="color:red;">*</span></label>
                           <div class="col-sm-8">
                                  
                                <select class="form-control" name="enroll_for" required="required">
                                    <option value="0">-- Select Enoll For---</option>
                                    <?php
                                    $enroll = $this->db->get('enroll_for')->result();
                                    foreach($enroll as $enroll_for){
                                        echo '<option value="'.$enroll_for->ENROLL_ID.'">'.$enroll_for->ENROLL_NAME.'</option>';
                                    }
                                    ?>
                                   
                                </select>
                            <span id="RequiredFieldValidator2" style="color:Red;display:none;">Required</span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 ">EXAM TYPE<span style="color:red;">*</span></label>
                           <div class="col-sm-8">
                                  
                                <select class="form-control" name="exam_type" required="required">
                                    <option value="0">-- Select Exam Type ---</option>
                                    <option value="1"> Off Line </option>
                                   <option value="2">Online</option>
                                </select>
                            <span id="RequiredFieldValidator2" style="color:Red;display:none;">Required</span>
                            </div>
                        </div>
                    </div>
                </div>
        

                <div class="panel-heading" style="background-color:#F4F4F4;"><h4>Other Detail</h4></div>
                    <div class="panel-body form-horizontal">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">WHATS No. <span style="color:red;">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input name="txtContactNo" type="text" maxlength="10" id="txtContactNo" class="form-control" placeholder="WILL BE PASSWORD"><br>
                                    <span id="RequiredFieldValidator9" style="color:Red;display:none;">Required</span>
                                    <span id="RegularExpressionValidator4" style="color:Red;display:none;">*10 characters required.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">ALTERNATE No.</label>
                                <div class="col-sm-8">
                                    <input name="alternate_no" type="text" maxlength="10" id="txtaltTelephoneNo" class="form-control"><br>
                                </div>
                            </div>
                            <div class="form-group">
             	                <label class="col-sm-4 control-label">Email <span style="color:red;">*</span></label>
                                  <div class="col-sm-8">
                                   <input name="email" type="text" id="txtEmail" class="form-control" required><br>
                                        <span id="RequiredFieldValidator8" style="color:Red;display:none;">Required</span>
                                      <span id="RegularExpressionValidator1" style="color:Red;display:none;">Enter Valid Email Address</span>
                                  </div>
                            </div>
                 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                               <label class="col-sm-4 control-label">Address <span style="color:red;">*</span></label>
                              <div class="col-sm-8">
                            	 <textarea name="address" rows="2" cols="20" id="txtCorresAddress" class="form-control"></textarea><br>
                                   <span id="RequiredFieldValidator18" style="color:Red;display:none;">Required</span>
                              </div>
                            </div>
                            <div class="form-group">
                                   <label class="col-sm-4 control-label"> STATE <span style="color:red;">*</span></label>
                                <div class="col-sm-8">
                                    <select name="district" class="form-control" id="residental_state">
                                        <?php  
                                        $state = get_all_states();
                                        foreach($state as $state_list){
                                            echo '<option value="'.$state_list->STATE_ID.'">'.$state_list->STATE_NAME.'</option>';
                                        }
                                        ?>
                                        
                                    
                                    </select>
                                    <span id="RequiredFieldValidator24" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                            <div class="form-group">
                                   <label class="col-sm-4 control-label"> DISTRICT <span style="color:red;">*</span></label>
                                <div class="col-sm-8">
                                    
                                    <select name="city" class="form-control" id="residental_district">
                                        
                                    </select>
                                    <span id="RequiredFieldValidator24" style="color:Red;display:none;">Required</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                     <input type="submit" name="btnSubmitRequest" value="Submit" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;btnSubmitRequest&quot;, &quot;&quot;, true, &quot;A&quot;, &quot;&quot;, false, false))" id="btnSubmitRequest" class="btn btn-success pull-right">
                </div>
                <br><br>
                <!-- Modal -->
            </form>
   
   
 
 
 
 
 
   
   
       
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">INSTRUCTIONS</h4>
      </div>
      <div class="modal-body">
        <p><strong>1.</strong>	Application should be accompanied by: </p>
            Telephone Nos. +91-164-5055208,5055008<br>
            FAX +91-164-5055255, 2742902<br></strong>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



        
    </div>
 </div>  
          </div>
          
        </div>
  
      </div>
    </section>