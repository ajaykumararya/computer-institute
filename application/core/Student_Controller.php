<?php
class Student_Controller extends MY_Controller{
    function __construct(){
        parent :: __construct();
    }
    
    
    function student_data($center_id){
        $this->load->library('form_validation');
        $this->load->helper(['form','array']);
        $config = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,  
            'encrypt_name' => true,
            'max_size' => 2048
        );
        $saveData  = [];
        $status = false;
        $message = 'Something Went Wrong';
        $return = ['status' => false];
        if($post = $this->input->post()){
            
            $this->form_validation->set_rules('photo','','callback_file_check');
            $this->form_validation->set_rules('mother','Monther Name','required');
            
                if(!$this->input->post('enrollment_no') ){
                    $this->form_validation->set_rules('email','Email','required|is_unique[students.email]');
                    $this->form_validation->set_rules('phone_no','Mobile','required|is_unique[students.mobile]');
                }
         
                if($this->form_validation->run()){
                    
                    $this->load->library('upload', $config);
                    $imagedata = [];
                    foreach($_FILES as $key => $name){
                        $_FILES['images']['name']= $_FILES[$key]['name'];
                        $_FILES['images']['type']= $_FILES[$key]['type'];
                        $_FILES['images']['tmp_name']= $_FILES[$key]['tmp_name'];
                        $_FILES['images']['error']= $_FILES[$key]['error'];
                        $_FILES['images']['size']= $_FILES[$key]['size'];
                        $this->upload->initialize($config);
                        $indexKey = $key == 'image2' ? 'signature' : $key;
                        if ($this->upload->do_upload($key)) {
                           $imagedata[$indexKey] = $this->upload->data('file_name');
                        } 
                    }
                    $profile =  get_all_profile();
                        
                    $centeridx =$profile[0]->STUDENT_PREFIX.time();
                    
                    $centerid =  preg_replace('/\s+/', '', $centeridx);
                    
                    $data1 = array(
                			'name' => $_POST['name'],
							'mobile' => $_POST['phone_no'],
							'address' => $_POST['Address'],
							'email' => $_POST['email'],
							'type' => 3,
							'password_view' => $_POST['password'],
							'password' => md5($_POST['password']),
						);
								
                        $check = $this->db->query("SELECT * FROM `user_registration` WHERE `mobile` LIKE '".$_POST['phone_no']."' OR `email` LIKE '".$_POST['email']."' AND type LIKE '3'");
					
						$insert_id = 0;
						if($check->num_rows() > 0){
						    $check_row=$check->row();
	                        $insert_id=$check_row->id;
	                        $data4=array(
	                            'password_view' => $_POST['password'],
						        'password' => md5($_POST['password']),
	                            );
	                      //  return;
	                      $this->db->where('id',$insert_id);
	                      $this->db->update('user_registration',$data4);
						
						    $userid = $insert_id;
						}else{
						    $this->db->insert('user_registration',$data1);
						    $userid = $this->db->insert_id();
						}  
                    
                    
                    
                    $saveData  = array(
                            'enrollment_no' => isset($_POST['enrollment_no']) ? $_POST['enrollment_no'] : $centerid,
                           'name' => $_POST['name'],
                            'gender' => $_POST['gender'],
                            'father' => $_POST['father'],
                            'mother' => $_POST['mother'],
                            'photo' => element('photo',$imagedata,''),
                            'dob' => $_POST['dob'],
    						'mobile' => $_POST['phone_no'],
    						'email'=>$_POST['email'],
    						'state'=>$_POST['state'],
    						'country'=>$_POST['country'],
    						'distric'=>$_POST['district'],
    						'user_id' => $userid,
    						'center_id' => issetData('center_id'),
    						'marks' =>issetData('marks'),
    						'board' =>issetData('board'),
    						'medium' =>issetData('medium'),
    						'year' =>issetData('yop'),
    						'course_id' =>issetData('course'),
    						'center_id' => issetData('center_id'),
    						'address' => issetData('Address'),
    						'marrital_status'=>issetData('marrital_status'),
    					   'status'=>1,
    					   'transection_id' =>issetData('marks'),
    						'payment_status' =>0,
    						'city' =>issetData('city'),
    						'pincode' =>issetData('pincode'),
    						'highest_qualification' => issetData('Qualification'),
    						'passing_year' => issetData('yop'),
    					    'institute_name' => issetData('board'),
    					    
    					    'tenth_marksheet' => element('tenth_marksheet',$imagedata,''),
    					    'twelve_marksheet' => element('twelve_marksheet',$imagedata,''),
    					    'graduation_marksheer' => element('graduation_marksheer',$imagedata,''),
    					    'graduation_degree' => element('graduation_degree',$imagedata,''),
    					    'aadhar' => element('aadhar',$imagedata,''),
    					   
    					    'blood_group' => issetData('blood_group'),
    					    'nationality' => issetData('nationality'),
    					    'addmission_date' => issetData('admission_date'),
    					    'reg_no' => issetData('reg_no'),
    					    'Batch' => issetData('Batch'),
    					    'session' => issetData('Session'),
    					    'occupation'=>issetData('Occupation'),
    					    'mother_tongue'=>issetData('mother_tongue'),
    					    'religion'=> issetData('religion'),
    					    'community'=> issetData('community'),
    					    'religion'=> issetData('religion'),
    					    'subject'=> issetData('subject'),
    					    'signature' => element('signature',$imagedata,''),
    					    'vip' => issetData('vip',0,0)
                       );
                       if($this->input->post('enrollment_no') ){
                			$num = 	$this->db->query("SELECT * FROM `students` WHERE `enrollment_no` LIKE '".$_POST['enrollment_no']."'")->num_rows();
                			if($num > 0){
                			        if($_POST['studentid']!= ''){
                			            $this->db->where('id',$_POST['studentid']);
                			            $this->db->update('students',$saveData);
                			            $message = 'updated';
                			            $status = true;
                			        }
                			    //
                			}
                       }
                       else{
                            $this->db->insert('students',$saveData);
        			        $insert_id = $this->db->insert_id();
        			        $message = 'Registered Successfully.';
                       }
		                $form = false;
    			        $return = array('status' => $status,'message' => $message,'FORM' => $form,'url' => base_url('student-registration'));
                }
                else
                    $return['message'] = validation_errors('<div class="alert alert-danger">','</div>');
			
            
        }
        return ($return);
    }
}

?>