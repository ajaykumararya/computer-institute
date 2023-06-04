<?php

defined('BASEPATH') OR exit('No direct script access allowed');

ob_start(); 

class Post_ajax extends MY_Controller {



	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see https://codeigniter.com/user_guide/general/urls.html

	 */

	 

	public function __construct()

	{

		parent::__construct();

		ini_set('display_errors', 1);

		$this->load->helper('url');

		date_default_timezone_set('Asia/Calcutta'); 

		$this->load->library('session');

		$this->load->helper('json_ouput_helper');

		$this->load->helper('common_helper');

	    $this->load->model('Authentication_model');

		$this->load->model('Common_model');

		$this->load->database('default');

		setlocale(LC_MONETARY, 'en_IN');

	}
	
	function submit_fee(){
	    if($post = $this->input->post()){
	        foreach($post as $index => $value){
	            $this->db->where('type',$index)->update('few_setting',['value' => $value]);
	        }
	        json_output(200,array('status' => 200,'message' => 'Setting Update Successfully...'));
	    } 
	    else
	        json_output(400,array('status' => 400,'message' => 'Bad request.'));
	}
	
	function whyus()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$banner=$_FILES['image']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['image']['size'];
                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
						
						
						
						$database = 'whyus';
						$data = array(

										'WHYUS_TITLE' => $_POST['title_name'], 

										'WHYUS_DESC' => $_POST['desc'], 

									//	'WHYUS_IMAGE' => $upload_nm, 

									);
									
					if ($_FILES['image']['name']) {
						$arr1 = array(
										 'WHYUS_IMAGE' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									    );
					}
					
					$arr3 = array_merge($arr1,$data);					
					
					//print_r($arr3);				
				    //	$result=check_data_exits($database);
                       $num = $this->db->get('whyus')->num_rows();
                       //$result =  $this->db->get('whyus',['WHYUS_ID'=>1])->row();
                        
						 if($num >0){

							$this->db->where('WHYUS_ID',1);

							$this->db->update($database,$arr3);

							$response=array('status' => 200,'message' => 'ok');						

						 }else{

						 	$this->db->insert($database,$arr3);

						 	$response=array('status' => 200,'message' => 'ok');

			         	}
				// 			$this->db->insert($database,$data);

				// 			$response=array('status' => 200,'message' => 'ok');

			        	

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}

	function update_profile()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/





						$database = 'profile';

						$data = array(

										'ORG_NAME' => $_POST['org_name'], 
										'ORG_EMAIL' => $_POST['email'], 
										'ORG_ALT_EMAIL' => $_POST['alt_email'], 
										'ORG_PHONE' => $_POST['phone'], 
										'ORG_ALT_PHONE' => $_POST['alt_phone'], 
										'ORG_ADDRESS' => $_POST['address'], 
										'MAP_LOCATION' => $_POST['google_map'], 
										'EMAIL_REDIRECTION' => $_POST['email_redirect'],
										'APP_URL'=> $_POST['app_url'],
                                        
                                        'STUDENT_PREFIX'=> $_POST['student_prefix'],
                                        'CENTER_PREFIX'=> $_POST['center_prefix'],
                                        'facebook' => $_POST['facebook'],
										'twitter'=> $_POST['twitter'],
                                        
                                        'youtube'=> $_POST['youtube'],
                                        'google'=> $_POST['google'],
										'OWNER_NAME' => $_POST['owner_name'],

									);

						

						

					   	$result=check_data_exits($database);

						if($result!= '0'){

							$this->db->where('PROFILE_ID',$result->PROFILE_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						}else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	function create_enquiry()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/





						$database = 'enquiry';

						$data = array(

										'source' => $_POST['lead_source'], 

										'name' => $_POST['name'], 

										'emailid' => $_POST['email'], 

										'course' => $_POST['course_id'], 

										'mobile' => $_POST['mobile'], 

										'dob' => $_POST['dob'], 

										'session' => $_POST['session'], 
                                        'type' => $_SESSION['type'], 
										'user_id' => $_SESSION['loginid'],
										'enquiry_date'=> $_POST['enquiry_date'],
                                        'remarks' => $_POST['remarks'],
                                        'followup' => $_POST['followup_date'],

										'status' => 0,


										

									);

						

						

					   	$result=check_data_exits($database);

				// 		if($result!= '0'){

				// 			$this->db->where('PROFILE_ID',$result->PROFILE_ID);

				// 			$this->db->update($database,$data);

				// 			$response=array('status' => 200,'message' => 'ok');						

				// 		}else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	// }

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
// 	create course
function create_course()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){
			       
			       
			       
			            $banner=$_FILES['image']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['image']['size'];
                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
			       
			       
			       
			        if(!empty(@$_POST['yearly_course'])){
	                     $year = @$_POST['yearly_course'];
	                     $month=0;
	                    }else{
	                        $year=0;
	                        $month=@$_POST['duration'];
	                    }
            	    $data=array(
            	    'course_name'=>@$_POST['course_name'],
            	    'duration'=>$month,
            	    'category'=>@$_POST['category'],
            	    'years'=>$year,
                    'type'=>@$_POST['yearly'],
                    'MIN_QUALIFICATION' => $_POST['min_qualification'],
            	        );
            	       // die(var_dump($data));
	                $database='courses';
	                
	                
	                				
					if ($_FILES['image']['name']) {
						$arr1 = array(
										 'image' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									    );
					}
					
					$arr3 = array_merge($arr1,$data);
	                
	                
	                
	               // $this->db->insert($database,$data);
	               if(empty($this->uri->segment(3))){
					   	$result=$this->db->get_where('courses',['course_name'=>$_POST['course_name']]);
					   //	die(var_dump($result));
						if($result->num_rows > '0'){
						}else{
							$this->db->insert($database,$arr3);
							$response=array('status' => 200,'message' => 'ok');
			        	}
	               }else{
	                   $this->db->where('id',$this->uri->segment(3));
	                   $this->db->update($database,$arr3);
	               }
			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}



	function update_feedback_status()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/





						$database = 'feedback';

						$fieldname = 'FEEDBACK_ID';

						$where = $_POST['feedbackid'];

						$result=check_data_exits_status_by_id($database,$fieldname,$where);

						if($result->FB_STATUS == '0'){

							$data = array(

											'FB_STATUS' => '1', 

										);

							$this->db->where($fieldname,$result->FEEDBACK_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						}else{

							$data = array(

											'FB_STATUS' => '0', 

										);

							$this->db->where($fieldname,$result->FEEDBACK_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}







	function blogsubmit()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$data = array(

										'BLOG_CATEGORY' => $_POST['category_name'],

										'BLOG_TITLE' => $_POST['title_name'], 

										'BLOG_DESC' => $_POST['desc'], 

										'BLOG_IMAGE' => $upload_nm,

										'PAGE_NAME' => $_POST['page_name'], 
                                        'BLOG_STATUS'=>1,

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function update_event()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$data = array(

										// 'BLOG_CATEGORY' => $_POST['category_name'],

										'BLOG_TITLE' => $_POST['updateeventtitle'], 

										'BLOG_DESC' => $_POST['updateeventdesc'], 

										'BLOG_IMAGE' => $upload_nm,

										'PAGE_NAME' => 2, 
                                        // 'BLOG_STATUS'=>1,

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('BLOG_ID',$_POST['updateeventid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function delete_event()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){







						$database = 'blogs';

					
							$this->db->where('BLOG_ID',$_POST['blogeventid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	function delete_result()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){







						$database = 'results';
						$database2 = 'marks_table';

					$this->db->trans_begin();
                            	$this->db->where('id',$_POST['result_id']);
							$this->db->delete($database);
								
							$this->db->where('result_id',$_POST['result_id']);
							$this->db->delete($database2);

                    
                            if ($this->db->trans_status() === FALSE)
                            {
                                    $this->db->trans_rollback();
                            }
                            else
                            {
                                    $this->db->trans_commit();
                            }
						
							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    // update gallery
    	function update_gallery()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$data = array(

										// 'BLOG_CATEGORY' => $_POST['category_name'],

										'BLOG_TITLE' => $_POST['updategallerytitle'], 

										'BLOG_DESC' => $_POST['updategallerydesc'], 

										'BLOG_IMAGE' => $upload_nm,

										'PAGE_NAME' => 3, 
                                        // 'BLOG_STATUS'=>1,

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('BLOG_ID',$_POST['updategalleryid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function delete_gallery()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){







						$database = 'blogs';

					
							$this->db->where('BLOG_ID',$_POST['deletegalleryid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    // exam
    	function update_exam()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$data = array(

										// 'BLOG_CATEGORY' => $_POST['category_name'],

										'BLOG_TITLE' => $_POST['updateexamtitle'], 

										'BLOG_DESC' => $_POST['updateexamdesc'], 

										'BLOG_IMAGE' => $upload_nm,

										'PAGE_NAME' => 4, 
                                        
                                        // 'BLOG_STATUS'=>1,

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('BLOG_ID',$_POST['updateexamid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    
    
    
    function delete_exam()
	{

/*
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
    		    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

*/


                    $get=$this->db->get_where('Assign_exam_student',['id'=>$_POST['deleteexamid']])->row();
                    $exam_date=$this->db->get_where('exam_schedule',['id'=>@$get->exam_id])->row();
                    if(!empty($get)){
                    
                        $student_id=$get->student_id;
                        $status=0;
                        $date=date('Y-m-d');
                        $exam_date=$exam_date->exam_date;
                    }
                    $database = 'Assign_exam_student';
                    $database2='students';
                        if($exam_date>=$date){

                            $this->db->trans_begin();   
					
							$this->db->where('id',$_POST['deleteexamid']);
							$this->db->delete($database);
							$data=array(
							    'exam_status'=>$status,
							    );
							$this->db->where('id',$student_id);
							$this->db->update($database2,$data);
							if ($this->db->trans_status() === FALSE)
                            {
                                 $this->db->trans_rollback();
                            }else{
                                 $this->db->trans_commit();
                            }



							$response=array('status' => 200,'message' => 'ok');
                            json_output(200,$response);
                            
                            
                            
                        }else{
                          json_output(200,array('status' => 200,'message' => 'exam done can not able for deletion'));
                        }
			        	// }

			        


/*

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}
*/
		

	}
        	function update_add()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$data = array(

										// 'BLOG_CATEGORY' => $_POST['category_name'],

										'BLOG_TITLE' => $_POST['updateaddtitle'], 

										'BLOG_DESC' => $_POST['updateadddesc'], 

										'BLOG_IMAGE' => $upload_nm,

										'PAGE_NAME' => 5, 
                                        
                                        // 'BLOG_STATUS'=>1,

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('BLOG_ID',$_POST['updateaddid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	
	function delete_add()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					$database = 'blogs';
							$this->db->where('BLOG_ID',$_POST['deleteaddid']);
							$this->db->update($database,$data);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


	function update_student()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$data = array(

										// 'BLOG_CATEGORY' => $_POST['category_name'],

										'BLOG_TITLE' => $_POST['updatestudenttitle'], 

										'BLOG_DESC' => $_POST['updatestudentdesc'], 

										'BLOG_IMAGE' => $upload_nm,

										'PAGE_NAME' => 6, 
                                        
                                        // 'BLOG_STATUS'=>1,

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('BLOG_ID',$_POST['updatestudentid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function delete_student()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){







						$database = 'blogs';

					
							$this->db->where('BLOG_ID',$_POST['deletestudentid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

function news()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'news';

						$data = array(

										

										'title' => $_POST['title_name'], 

										'description' => $_POST['desc'],
										'date' => $_POST['date'], 
										 

										//'image' => $upload_nm,
                    'status'=>1,

										 

									);

						
                    if ($_FILES['image']['name']) {
						$arr1 = array(
										 'image' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									    );
					}
					
					$arr3 = array_merge($arr1,$data);					

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$arr3);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// update news
	function update_news()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'news';

						$data = array(

										

										'title' => $_POST['news_title'], 

										'description' => $_POST['news_desc'],
										'date' => $_POST['news_date'], 
										 

										'image' => $upload_nm,
                    

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('id',$_POST['updatenewsid']);
							
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	// delete news
		function delete_news()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				

						$database = 'news';
						$this->db->where('id',$_POST['deletenewsid']);
							
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    	// update latest news
	function update_latest_news()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'latest_news';

						$data = array(

										

										'title' => $_POST['latest_news_title'], 

										'description' => $_POST['latest_news_desc'],
										// 'date' => $_POST['news_date'], 
										 

										'image' => $upload_nm,
                    

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('id',$_POST['updatelatestnewsid']);
							
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	// delete latest news
		function delete_latest_news()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				

						$database = 'latest_news';
						$this->db->where('id',$_POST['deletelatestnewsid']);
							
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  // updatea advance notice
  	// update latest news
	function update_advance_notice()

	{
    

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'advance_notice';

						$data = array(

										

										'title' => $_POST['advance_notice_title'], 

										'description' => $_POST['advance_notice_desc'],
										// 'date' => $_POST['news_date'], 
										 

										'image' => $upload_nm,
                    

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('id',$_POST['updateadvancenoticeid']);
							
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	// delete advance notice
		function delete_advance_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				

						$database = 'advance_notice';
						$this->db->where('id',$_POST['deleteadvancenoticeid']);
							
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	
	function notice_board()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'notice_board';

						$data = array(

										

										'title' => $_POST['title_name'], 
										'description' => $_POST['desc'],
										'date' => $_POST['date'], 
										'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  	// update notice
	function update_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'notice_board';

						$data = array(

										

										'title' => $_POST['notice_title'], 

										'description' => $_POST['notice_desc'],
										'date' => $_POST['notice_date'], 
										 

										'image' => $upload_nm,  
                    

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
							$this->db->where('id',$_POST['updatenoticeid']);
							
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	// delete notice
		function delete_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				

						$database = 'notice_board';
						$this->db->where('id',$_POST['deletenoticeid']);
							
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

    	function latest_news()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'latest_news';

						$data = array(

										

										'title' => $_POST['title_name'], 
										'description' => $_POST['desc'],
										// 'date' => $_POST['date'], 
										'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    function flash_image()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'flash_image';

						$data = array(

										

										'title' => $_POST['title_name'], 
										'description' => $_POST['desc'],
										// 'date' => $_POST['date'], 
										'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
     
        	function admission_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'admission_notice';

						$data = array(

										

										'link_name' => $_POST['title_name'], 
										'link_url' => $_POST['desc'],
										// 'date' => $_POST['date'], 
										// 'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    // update admission_notice
  function update_admission_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'admission_notice ';

						$data = array(

										

										'link_name' => $_POST['notice_name'], 
										'link_url' => $_POST['notice_url'],
											

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
              $this->db->where('id',$_POST['updateadmissionnoticeid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  // delete admission notice
  function delete_admission_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'admission_notice ';

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

              $this->db->where('id',$_POST['deleteadmissionnoticeid']);
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// update flash image
	 function update_flash_image()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'flash_image ';

						$data = array(

									'title' => $_POST['advance_notice_title'], 

										'description' => $_POST['advance_notice_desc'],
										// 'date' => $_POST['news_date'], 
										 

										'image' => $upload_nm,
                    				

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
              $this->db->where('id',$_POST['updateflashimageid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  // delete flash image
  function delete_flash_image()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'flash_image ';

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

              $this->db->where('id',$_POST['deleteflashimageid']);
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  function information_board()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'information_board ';

						$data = array(

										

										'link_name' => $_POST['title_name'], 
										'link_url' => $_POST['desc'],
										// 'date' => $_POST['date'], 
										// 'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  // update information board
  function update_information_board()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'information_board ';

						$data = array(

										

										'link_name' => $_POST['board_name'], 
										'link_url' => $_POST['board_url'],
											

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
              $this->db->where('id',$_POST['updateinformationboardid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  // delete information board
  function delete_information_board()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



				




						$database = 'information_board ';

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

              $this->db->where('id',$_POST['deleteinformationboardid']);
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	function advance_notice()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'advance_notice';

						$data = array(

										

										'title' => $_POST['title_name'], 
										'description' => $_POST['desc'],
										// 'date' => $_POST['date'], 
										'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
    function our_branches()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'our_branches';

						$data = array(

										

										'title' => $_POST['title_name'], 
										'description' => $_POST['desc'],
										'description' => $_POST['desc'],
                                        
										'url' => $_POST['url'], 
										'image' => $upload_nm,
                  						  'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
// update branches
  function update_branches()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'our_branches';

						$data = array(

										

										'title' => $_POST['branches_title'], 
										'description' => $_POST['branches_desc'],
										// 'description' => $_POST['desc'],
                                        
										'url' => $_POST['branches_url'], 
										'image' => $upload_nm,
                  						  // 'status'=>1,

										 

									);

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
              $this->db->where('id',$_POST['updatebranchesid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
  // delete branches
  function delete_branches()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



			




						$database = 'our_branches';

				
						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('WHYUS_ID',$result->WHYUS_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{
              $this->db->where('id',$_POST['deletebranchesid']);
							$this->db->update($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function publish_blog()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/





						$database = 'blogs';

						$fieldname = 'BLOG_ID';

						$where = $_POST['blogid'];

						$result=check_data_exits_status_by_id($database,$fieldname,$where);

						if($result->BLOG_STATUS == '0'){

							$data = array(

											'BLOG_STATUS' => '1', 

										);

							$this->db->where($fieldname,$result->BLOG_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						}else{

							$data = array(

											'BLOG_STATUS' => '0', 

										);

							$this->db->where($fieldname,$result->BLOG_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}







	function visiontitle()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/





						$database = 'vision';

						$data = array(

										'VISION_TITLE' => $_POST['title_name'],

										'VISION_DESCRIPTION' => $_POST['description'], 

									);

						

						

					 //  $result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('VISION_ID',$result->VISION_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function question_answer()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){


                    /*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

                    if ($upload_nm!= '') {
                         $data2 = array(  
                                    'UPLOAD_FILE' => $upload_nm,
                                    );
                    }else{
                        $data2 = array(
                                        );
                    }
               
						$database = 'fquestion';
						$data1 = array(
										'FQUESTION' => $_POST['title'],
										'FANSWER' => $_POST['desc'], 
                                        'PAGE_MENU_CODE' => $_POST['code'],
                                        'F_TITLE' => $_POST['pdf_title'],
                                    );

						 $data = array_merge($data1,$data2);

					 //  $result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('VISION_ID',$result->VISION_ID);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function publish_question()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/

						$database = 'fquestion';

						$fieldname = 'FQUESTION_ID';

						$where = $_POST['questionid'];

						$result=check_data_exits_status_by_id($database,$fieldname,$where);

						if($result->FSTATUS == '0'){

							$data = array(

											'FSTATUS' => '1', 

										);

							$this->db->where($fieldname,$result->FQUESTION_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						}else{

							$data = array(

											'FSTATUS' => '0', 

										);

							$this->db->where($fieldname,$result->FQUESTION_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function add_member()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'member_list';

						

						if ($_POST['district']!= '0') {

							$data = array(

										'MEMBER_NAME' => $_POST['member_name'], 

										'MEMBER_CONTACT' => $_POST['member_contact'], 

										'MEMBER_ADDRESS' => $_POST['member_address'],

										'MEMBER_POST' => $_POST['member_post'],

										'MEMBER_STATE' => $_POST['state'],

										'MEMBER_DISTRICT' => $_POST['district'],

										'MEMBER_PHOTO' => $upload_nm,

										'MEMBER_ABOUT_US' => $_POST['member_about_us'],

										//'MEMBER_STATUS' => '0', 

									);

						}else{

							$data = array(

										'MEMBER_NAME' => $_POST['member_name'], 

										'MEMBER_CONTACT' => $_POST['member_contact'], 

										'MEMBER_ADDRESS' => $_POST['member_address'],

										'MEMBER_POST' => $_POST['member_post'],

										

										'MEMBER_PHOTO' => $upload_nm,

										'MEMBER_ABOUT_US' => $_POST['member_about_us'],

										//'MEMBER_STATUS' => '0', 

									);

						}



						

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

						// 	$this->db->where('MEMBER_ID',$_POST['memberid']);

						// 	$this->db->update($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');						

						// }else{

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}



	function update_member()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

				

						$data = array(

										'MEMBER_NAME' => $_POST['member_name'], 

										'MEMBER_CONTACT' => $_POST['member_contact'], 

										'MEMBER_ADDRESS' => $_POST['member_address'],

										'MEMBER_POST' => $_POST['member_post'],

										'MEMBER_STATE' => $_POST['state'],

										'MEMBER_DISTRICT' => $_POST['district'],

										'MEMBER_PHOTO' => $upload_nm,

										'MEMBER_ABOUT_US' => $_POST['member_about_us'], 

									);

					

						$database = 'member_list';

						

						

						

					 //   	$result=check_data_exits($database);

						// if($result!= '0'){

							$this->db->where('MEMBER_ID',$_POST['memberid']);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						// }else{

						// 	$this->db->insert($database,$data);

						// 	$response=array('status' => 200,'message' => 'ok');

			   //      	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	function delete_member()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'member_list';

							

					$this->db->where('MEMBER_ID',$_POST['memberdeleteid']);

					$this->db->delete($database);

					$response=array('status' => 200,'message' => 'ok');

			        

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function publish_member()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

			              		

					/*-------------- image2 ------------------*/

						$database = 'member_list';

						$fieldname = 'MEMBER_ID';

						$where = $_POST['memberid'];

						$result=check_data_exits_status_by_id($database,$fieldname,$where);

						if($result->MEMBER_STATUS == '0'){

							$data = array(

											'MEMBER_STATUS' => '1', 

										);

							$this->db->where($fieldname,$result->MEMBER_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						}else{

							$data = array(

											'MEMBER_STATUS' => '0', 

										);

							$this->db->where($fieldname,$result->MEMBER_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function favicon()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image1']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image1']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image1"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'site_setting';

						$data = array(

										'SS_FAVICON' => $upload_nm, 

									);

						

						

					    	$result=check_data_exits($database);

						 if($result!= '0'){

							$this->db->where('SS_ID',$result->SS_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						 }else{

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			         	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}





	function header_logo()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image1']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image1']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image1"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'site_setting';

						$data = array(

										'SS_HEADER_LOGO' => $upload_nm, 

									);

						

						

					    $result=check_data_exits($database);

						 if($result!= '0'){

							$this->db->where('SS_ID',$result->SS_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						 }else{

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			         	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}



	function fotter_logo()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image1']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image1']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image1"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'site_setting';

						$data = array(

										'SS_FOOTER_LOGO' => $upload_nm, 

									);

						

						

					    $result=check_data_exits($database);

						 if($result!= '0'){

							$this->db->where('SS_ID',$result->SS_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						 }else{

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			         	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}



	function background_image()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image1']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image1']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image1"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

						$database = 'site_setting';

						if ($_POST['status'] == '1') {

							$data = array(

										'SS_HOME_BANNER1' => $upload_nm, 

									);

						}

						if ($_POST['status'] == '2') {

									$data = array(

										'SS_HOME_BANNER2' => $upload_nm, 

									);

						}

						

					    $result=check_data_exits($database);

						 if($result!= '0'){

							$this->db->where('SS_ID',$result->SS_ID);

							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');						

						 }else{

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			         	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}



	function social_link()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'social_links';

							$data = array(

										'LINK_NAME' => $_POST['link_name'], 

										'LINK_URL' => $_POST['link_url'], 

									);

					

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			        

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}



	function remove_social_links()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'social_links';
					$this->db->where('SOCIAL_LINK_ID',$_POST['linkid']);
					$this->db->delete($database);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	
	
	
	
	
	
	
	
	
	


	// update vision
		function update_vision()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'vision';

						$data = array(

										'VISION_TITLE' => $_POST['visiontitle'],

										'VISION_DESCRIPTION' => $_POST['visiondesc'], 

									);

							$this->db->where('VISION_ID',$_POST['visionid']);
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

	// end update vision



	function delete_vision()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'vision';

							

					$this->db->where('VISION_ID',$_POST['deletevision']);

					$this->db->delete($database);

					$response=array('status' => 200,'message' => 'ok');

			        

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}

function upload_certificate(){
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
                


                    $banner=$_FILES['image']['name']; 
                    $file_size = $_FILES['image']['size'];
                    $expbanner=explode('.',$banner);
                    $allowed_format = array('jpg','jpeg','png');
                     if(in_array(strtolower(end($expbanner)),$allowed_format) ){
                        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'; 
                        $full_file_name = uniqid().".".end($expbanner);     
                        $uploadfile = $uploaddir.$full_file_name;
                        $upload_nm=$full_file_name;
                        move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);    //for moving image
                        
                        
                    }


                $data1 = array(  

                               'member_id'=>$_POST['member_id'],
                                'certificate_name'=>$_POST['certificate_name'],
                                );

                if ($upload_nm!= '') {
                     $data2 = array(  
                                'file_document' => $upload_nm,
                                );
                }else{
                    $data2 = array(
                                    );
                }
               

                $data = array_merge($data1,$data2);
             
                $this->db->insert('file_upload',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }

	/*-------------update volunteer------------------------*/
	function update_volunteer()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['vol_image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['vol_image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["vol_image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

						$data = array(

										'VOL_NAME' => $_POST['volunteer_name'], 

										'VOL_EMAIL' => $_POST['vol_email'], 

										'VOL_PHONE' => $_POST['vol_num'],

										'VOL_MESSAGE' => $_POST['massage'],

										'image_url' => $upload_nm,

										 

									);

						$database = 'volunteer';
						$this->db->where('VOL_ID',$_POST['volunteerid']);
						$this->db->update($database,$data);
						$response=array('status' => 200,'message' => 'ok');						
				        json_output(200,$response);

						}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	//end update volunteer
	/*-------------delete volunteer------------------------*/
	function delete_volunteer()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					
						$database = 'volunteer';
						$this->db->where('VOL_ID',$_POST['deletevol']);
						$this->db->delete($database);
						$response=array('status' => 200,'message' => 'ok');						
				        json_output(200,$response);

						}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	//end delete volunteer 

	/*-------------delete member------------------------*/
	// function delete_member()

	// {

	// 	$method = $_SERVER['REQUEST_METHOD'];

	// 	if($method != 'POST'){

	// 		json_output(400,array('status' => 400,'message' => 'Bad request.'));

	// 	} else {

	// 		$check_auth_client = $this->Authentication_model->check_auth_client();

			

	// 		if($check_auth_client == true){

	// 		    $response = $this->Authentication_model->auth();

	// 		    if($response['status'] == 200){



					
	// 					$database = 'member_list';
	// 					$this->db->where('MEMBER_ID',$_POST['memberdeleteid']);
	// 					$this->db->delete($database);
	// 					$response=array('status' => 200,'message' => 'ok');						
	// 			        json_output(200,$response);

	// 					}else if($response['status'] == 303){

	// 					$this->Common_model->logout();

	// 					$this->session->sess_destroy();

	// 					json_output(401,$response);

	// 	        }

	// 		}

	// 	}

		

	// }
	//end delete member
		/*-------------update feedback------------------------*/
	function update_feedback()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
		$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				 $response = $this->Authentication_model->auth();
				if($response['status'] == 200){
							
					$data = array(

								'FB_PER_NAME' => $_POST['feedback_name'], 

								'FB_COMMENT' => $_POST['feedback_massage'], 

							);
					$database = 'feedback';
					$this->db->where('FEEDBACK_ID',$_POST['updatefeedbackid']);
					$this->db->update($database,$data);
					$response=array('status' => 200,'message' => 'ok');						
			        json_output(200,$response);

				}else if($response['status'] == 303){

				$this->Common_model->logout();

				$this->session->sess_destroy();

				json_output(401,$response);

		    }
		}
	}
}
	//end update feedback
	/*-------------delete feedback------------------------*/
	function delete_feedback()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){


                    //print_r($_POST);
					
						$database = 'feedback';
						$this->db->where('FEEDBACK_ID',$_POST['feedbackdeleteid']);
						$this->db->delete($database);
						
						
						$response=array('status' => 200,'message' => 'ok');						
				        json_output(200,$response);

						}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	
	
	
	
	
	
	
	
	
	
	
 
/*------------- start customer feedback ---------------------*/
public	function add_customer_feedback()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					$database = 'feedback';
					$data1 = array(
					            'FB_TITLE' => $_POST['feedback_title'],
					            'FB_PER_NAME' => $_POST['feedback_name'],
					            'FB_COMMENT' => $_POST['feedback_comment'],
					            );
					       
					      
				  
				    $banner=$_FILES['fileToUpload']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['fileToUpload']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						} 			
						if ($upload_nm!= '') {
                             $data2 = array(  
                                        'FB_PERSON_IMAGE' => $upload_nm,
                                        );
                        }else{
                            $data2 = array(
                                            );
                        }
                        $data = array_merge($data1,$data2);	
						
						$this->db->insert($database,$data);
				  
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}


/*------------- end custoem feedback ----------------------------*/


	
	
	
	
	
	
	
	
	
	
	
	//end delete volunteer
	// add slider details
function add_slider_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/

						$banner=$_FILES['slider_image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['slider_image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["slider_image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

					$database = 'slider_details';

						$data = array(

										// 'rs_id' => $_POST['slider_id'],

										'title' => $_POST['slider_title'], 

										'discription1' => $_POST['desc1'], 

										'slider_image' => $upload_nm,

										// 'discription2' => $_POST['desc2'],
										// 'button_label' => $_POST['button_label'], 

									);

					
	                        	$result=check_data_exits($database);

					
						

							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	
				// 			$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// end add slider details
	// update slider details
	function update_slider_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/

						$banner=$_FILES['slider_image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['slider_image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["slider_image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

					$database = 'slider_details';

						$data = array(

										// 'rs_id' => $_POST['slider_id'],

										'title' => $_POST['slider_title'], 

										'discription1' => $_POST['slider_desc1'], 

										//'slider_image' => $upload_nm,

										// 'discription2' => $_POST['slider_desc2'],
										// 'button_label' => $_POST['slider_button'], 

									);
                    
                    if ($_FILES['slider_image']['name']) {
						$arr2 = array(
										 'slider_image'=>$upload_nm,
									);
					}else{
						$arr2 = array(
									);
					}
                    
                    $arr3 = array_merge($arr2,$data);
					
							$this->db->where('id',$_POST['updatesliderid']);

							$this->db->update($database,$arr3);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// end update slider details
	// delete slider details
	function delete_slider_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){



					$database = 'slider_details';

							$this->db->where('id',$_POST['sliderdeleteid']);

							$this->db->delete($database);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}
	// end delete slider details
	// add service details
	function add_our_services(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/


						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

					$database = 'our_services';

						$data = array(

										// 'rs_id' => $_POST['slider_id'],

										'title' => $_POST['service_title'], 

										'description' => $_POST['service_description'], 

										'image' => $upload_nm,
                    'status'=>1,
                    'login_id'=>$_SESSION['loginid'],

										
									);

					
							$this->db->insert($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// end add slider details
	// update service details
	function update_service_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/

						$banner=$_FILES['slider_image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['slider_image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/demopanel2/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["slider_image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

					$database = 'slider_details';

						$data = array(

										// 'rs_id' => $_POST['slider_id'],

										'title' => $_POST['slider_title'], 

										'discription1' => $_POST['slider_desc1'], 

										'slider_image' => $upload_nm,

										// 'discription2' => $_POST['slider_desc2'],
										'button_label' => $_POST['slider_button'], 

									);

					
							$this->db->where('id',$_POST['updatesliderid']);

							$this->db->update($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						jsoan_output(401,$response);

		        }

			}

		}

		

	}
	// end update slider details
	// delete slider details
	function delete_service_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){



					$database = 'slider_details';

							$this->db->where('id',$_POST['sliderdeleteid']);

							$this->db->delete($database);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}
	// end delete slider details

	// update fquestion
		function update_question_answer()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						
						
					/*-------------- image -----------------*/
						$banner=$_FILES['image']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['image']['size'];
                        	$expbanner=explode('.',$banner);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name = uniqid().".".end($expbanner);		
                    			$uploadfile = $uploaddir.$full_file_name;
                    			$upload_nm=$full_file_name;
                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
						}else{
							$upload_nm = '';
						}                		
					/*-------------- image2 ------------------*/
                    if ($upload_nm!= '') {
                         $data2 = array(  
                                    'UPLOAD_FILE' => $upload_nm,
                                    );
                    }else{
                        $data2 = array(
                                        );
                    }
               
					$database = 'fquestion';
					$data1 = array(
									'FQUESTION' => $_POST['title'],
									'FANSWER' => $_POST['desc'], 
                                    'PAGE_MENU_CODE' => $_POST['code'],
                                    'F_TITLE' => $_POST['pdf_title'],
                                );

					$data = array_merge($data1,$data2);
				    $this->db->where('FQUESTION_ID',$_POST['updatefquestionid']);
					$this->db->update($database,$data);
					$response=array('status' => 200,'message' => 'ok','code'=>$_POST['code'] );

			        

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}
	//delete fquestion
		function delete_question_answer()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'fquestion';

						
							$this->db->where('FQUESTION_ID',$_POST['id']);

							$this->db->delete($database);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}
		
	// add enquiry web
		function add_enquiry()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} 
		

						$database = 'contact_us_form_list';

						$data = array(

										'PERSON_NAME' => $_POST['name'],

										'PERSON_EMAIL' => $_POST['email'],
										'PERSON_SUBJECT' => $_POST['subject'],

										'PERSON_COMMENT' => $_POST['comment'], 

									);

							// $this->db->where('CONTACT_ID',$_POST['enquiryid']);

							$this->db->insert($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					

			

		

	}
	//delete fquestion
		function delete_enquiry_answer()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'contact_us_form_list';

						
							$this->db->where('CONTACT_ID',$_POST['deleteenquiry']);

							$this->db->delete($database);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}
	// update cause details
	function update_cause_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

				

					$database = 'causes';

						$data1 = array(

										'causes' => $_POST['causes'],

										'cause_title' => $_POST['cause_title'], 

										'cause_desc' => $_POST['cause_description'], 

										//'image_url' => $upload_nm,

										'raised' => $_POST['raised'],

										'goal' => $_POST['goal'],

										'button_name' => $_POST['button_name'], 

									);

					        if ($upload_nm!= '') {
                                 $data2 = array(  
                                            'image_url' => $upload_nm,
                                            );
                            }else{
                                $data2 = array(
                                                );
                            }
                            $data = array_merge($data1,$data2);

					        
					        
							$this->db->where('id',$_POST['updatecausesid']);

							$this->db->update($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// end update cause details
		// delete cause details
	function delete_cause_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

			
				

					$database = 'causes';

					
							$this->db->where('id',$_POST['causesdeleteid']);

							$this->db->delete($database);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}
// add cause details
	
	function add_cause_details(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

				    

					$database = 'causes';

						$data1 = array(

										'causes' => $_POST['causes'],

										'cause_title' => $_POST['add_cause_title'], 

										'cause_desc' => $_POST['cause_desc'], 

										//'image_url' => $upload_nm,

										'raised' => $_POST['raise'],

										'goal' => $_POST['goal'],

										'button_name' => $_POST['button_name'], 

									);

					        if ($upload_nm!= '') {
                                 $data2 = array(  
                                            'image_url' => $upload_nm,
                                            );
                            }else{
                                $data2 = array(
                                                );
                            }
                            $data = array_merge($data1,$data2);

							$this->db->insert($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	// end update slider details
	// public function seller_form()
 //    {
 //        $method = $_SERVER['REQUEST_METHOD'];
 //        if ($method != 'POST') {
 //            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
 //        } else {
 //            $check_auth_client = $this->Authentication_model->check_auth_client();
 //            if ($check_auth_client == true) {
 //                $count = count($this->input->post('name'));
 //                for ($i=0; $i<$count; $i++)
 //                {
 //                   $json_data[] = array(
 //                       'title' => $this->input->post('name')[$i],
 //                       'input_type' => $this->input->post('type')[$i],
 //                       'description' => $this->input->post('holder_name')[$i]
 //                   );
 //                }
 //                $json_encode_data = json_encode($json_data);
 //                $data = array(
 //                   'seller_id' => $_SESSION['loginid'],
 //                   'form_desc' => $json_encode_data,
 //                   'button_type'=>$_POST['button_type'],
                   
 //                );
 //               $form_key= $this->db->get_where('form_fields_data', array('seller_id' => $_SESSION['loginid']));
 //                if($form_key->num_rows() > 0){
 //                     $this->db->where('seller_id', $_SESSION['loginid']);
 //                     $this->db->update('form_fields',$data);
 //                }else{
 //                $this->db->insert('form_fields',$data);
 //                }
 //                $response['status'] = 200;
 //                $response['message'] = 'ok';
 //                json_output($response['status'], $response);
 //                if ($response['message'] == "ok") {
 //                insert_activity_history(1,0);
 //                }
 //            }
 //        }
 //    }
	/*-------------------admin form------------*/
public function seller_form()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
           
     $count = count($this->input->post('name'));
   // print_r($this->input->post());
	   for ($i=0; $i<$count; $i++)
       {
           $json_data[] = array(
               'title' => $this->input->post('name')[$i],
               'input_type' => $this->input->post('type')[$i],
               'description' => $this->input->post('holder_name')[$i],
                'filesize' => @$this->input->post('fize_size')[$i],
               // 'fee' => $this->input->post('agent_form_fee')[$i]
           );
       }
      $json_encode_data = json_encode($json_data);

	

       $data = array(
           'seller_id' => $_SESSION['loginid'],
           'form_desc' => $json_encode_data,
           'button_type'=>$_POST['button_type'],
           'department'=>$_POST['department'],
           'form_menu'=>$_POST['form_menu'],
           'form_fee'=>$_POST['agent_form_fee'],
           'user_id'=>$_POST['user'],
           
       );
       
                $this->db->insert('form_fields_data',$data);
   
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                insert_activity_history(1,0);
                }
            }
        }
    }
	/*-------------------admin form------------*/
public function update_seller_form()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
           
     $count = count($this->input->post('name'));
   // print_r($this->input->post());
	   for ($i=0; $i<$count; $i++)
       {
           $json_data[] = array(
               'title' => $this->input->post('name')[$i],
               'input_type' => $this->input->post('type')[$i],
               'description' => $this->input->post('holder_name')[$i],
                'filesize' => $this->input->post('fize_size')[$i],
               // 'fee' => $this->input->post('agent_form_fee')[$i]
           );
       }
      //  die(var_dump($json_data));
      $json_encode_data = json_encode($json_data);

	

       $data = array(
           'seller_id' => $_SESSION['loginid'],
           'form_desc' => $json_encode_data,
        //    'button_type'=>$_POST['button_type'],
           // 'button_type'=>$_POST['button_type'],
           'form_menu'=>$_POST['form_menu'],
           'form_fee'=>$_POST['agent_form_fee'],
           
       );

				$this->db->where('id',$_POST['form_id']);
                $this->db->update('form_fields_data',$data);
   
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                insert_activity_history(1,0);
                }
            }
        }
    }
/*-------------------agent form fields------------*/
public function agent_form_fields()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
              // GETTING FILE SIZE
              $id=$_SESSION['form_id'];
			  $imgFileSize = [];
              $rs = $this->db->get_where('form_fields_data', array('id' => $id))->row();
			  if (!empty($rs)) {
				  $temp = json_decode($rs->form_desc);
				  foreach($temp as $k => $v) {
					  if($v->input_type == 'file') {
						  $imgFileSize[$v->title] = $v->filesize;
					  }
				  }
			  }
            //   die(var_dump($imgFileSize));            
            	//TODO GET AGENT VALUT VALUE

			   		   $user_id=$_SESSION['loginid'];
						//   die(var_dump($user_id));
			   		   // $form_name=$_SESSION['form_name'];

                      $wallet = $this->db->query("select * from my_wallet where login_id='". $user_id ."'"); 



                                          

                    $row = $wallet->row();

                    

                      if (isset($row))

                        {

                            $wallet_amount= $row->wallet_amount;

                              

                        }
      
                    $fee_amount=$_SESSION['form_fee'];
				   //TODO SUBTRACT V-F

                        $sub=$wallet_amount-$fee_amount;

				   if($sub < 0){

						// json_output(420,['status' => 420,'message' => 'Unsufficient amount on valut pleas']);

				   }else {
					


                   $print= $this->input->post();
                  //print_r($print); 
                   if (count($_FILES)) {
                   	foreach ($_FILES as $key => $file) {
                   	 	$image = $file['name'];
                   		if ($image != '') {
                   			$file_size = $file['size'];
							if ($file_size > $imgFileSize[$key]*1024) {
								$response['status'] = 400;
								$response['message'] = "$key image is too big, max size required $imgFileSize[$key]";
								return json_output($response['status'], $response);
							}
							$expbanner=explode('.',$image);
                   			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                			$full_file_name = uniqid().".".end($expbanner);		
                			$uploadfile = $uploaddir.$full_file_name;
                			$upload_nm=$full_file_name;
            				move_uploaded_file($file["tmp_name"] , $uploadfile);
            				$print[$key] = ['name' => $upload_nm, 'type' => 'file'];
                   		}
                   	}
                   }

                  $staus=0;
                   $json_encode_data = json_encode($print);
                   $data = array(
                       'seller_id' => $_SESSION['loginid'],
                       'description' => $json_encode_data,
                       'form_name'=> $_SESSION['form_name'],
                       'form_id'=> $_SESSION['form_id'],
                       'status'=> $staus,
                     
                       
                   );
                   $data1 = array(  
                                          'wallet_amount' => $sub,
                				);
                   $type=1;

                    $data2 = array(  
                      				'agent_id'=> $_SESSION['loginid'],
                     				'total'=> $sub,                    					
                     				'amount'=> $_SESSION['form_fee'],                    					
                      				'form_name'=> $_SESSION['form_name'],
                                    'form_fee' => $_SESSION['form_fee'],
                                    'date' => date('Y-m-d'),
                                    'tiimestamp'=> date("Y-m-d H:i:s"),
                                    'type'=>$type,
                                    'description'=> 'form filled by agent'
                				);
                 $this->db->trans_begin();

                $ye = $this->db->insert('agent_form_data',$data);      
                // die(var_dump($ye));
                $this->db->where('login_id',$_SESSION['loginid']);
				$this->db->update('my_wallet',$data1);
				// $this->db->where('agent_id',$_SESSION['loginid']);
				$this->db->insert('agent_wallet_transactions',$data2);
				if ($this->db->trans_status() === FALSE)

                    {

                         $this->db->trans_rollback();

                    }

                    else

                    {

                         $this->db->trans_commit();

                    }



                }
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                insert_activity_history(1,0);
                }
            }
        }
    }



	/*-------------------my wallet------------*/

public function add_my_wallet()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                   
            		$type=2;
            
            		$user_id=$_POST['agentid'];
                    $agent_wallet = $this->db->query("select * from my_wallet where login_id='". $user_id ."'")->row(); 

                    $flag = false;

                    if($agent_wallet instanceof stdClass )
                    {
						$amount=$agent_wallet->wallet_amount;
						$total=$_POST['wallet_balance']+$amount;
                    	$data1 = array(
                        'login_id' => $_POST['agentid'],
						'wallet_amount' =>$total,
                   		);	
                   		$flag = true;		
                    	
                    } else {
                    	$data1 = array(
                        'login_id' => $_POST['agentid'],
						'wallet_amount' =>$_POST['wallet_balance'],
                   		);	
                   		$flag = false;
                    }

                    $data2 = array(  
                      				'agent_id'=> $_POST['agentid'],
                     				'total'=> $data1['wallet_amount'],                    					
                     				'amount'=> $_POST['wallet_balance'],
                                    'type'=>$type,
                                    'description'=> 'recharge by admin',
                                    'date'=> date('Y-m-d'),
                                    'tiimestamp'=> date("Y-m-d H:i:s"),
                				);
                   $database = 'my_wallet';
                   // ***************
                    // $database2 = 'agent_wallet_transactions';
                   // $result=check_data_exits($database);

				$this->db->trans_begin(); 
				$this->db->insert('agent_wallet_transactions',$data2);
				if($flag){

					$this->db->where('login_id',$_POST['agentid']);

					$this->db->update($database,$data1);

				}else{

					$this->db->insert($database,$data1);

	        	} 
				if ($this->db->trans_status() === FALSE)

                {

                     $this->db->trans_rollback();

                }

                else

                {

                     $this->db->trans_commit();

                }
                   /******************/ 
				                   


                                          

				$response=array('status' => 200,'message' => 'ok');	
    

                // $this->db->insert('agent_wallet_transactions',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }

    protected function update_agent_wallet($agentid,$balance) {

    	$type=2;
        $agent_wallet = $this->db->query("select * from my_wallet where login_id='". $agentid ."'")->row(); 
        $flag = false;

        if($agent_wallet instanceof stdClass )
        {
			$amount=$agent_wallet->wallet_amount;
			$total=$balance+$amount;
        	$data1 = array(
            'login_id' => $agentid,
			'wallet_amount' =>$total,
       		);	
       		$flag = true;		
        	
        } else {
        	$data1 = array(
            'login_id' =>$agentid,
			'wallet_amount' =>$balance,
       		);	
       		$flag = false;
        }

        $data2 = array(  
          				'agent_id'=>$agentid,
         				'total'=> $data1['wallet_amount'],                    					
         				'amount'=> $balance,
                        'type'=>$type,
                        'description'=> 'recharge by admin',
                        'date'=> date('Y-m-d'),
                        'tiimestamp'=> date("Y-m-d H:i:s"),
    				);
       $database = 'my_wallet';
       // ***************
        // $database2 = 'agent_wallet_transactions';
       // $result=check_data_exits($database);

	$this->db->trans_begin(); 
	$this->db->insert('agent_wallet_transactions',$data2);
	if($flag){

		$this->db->where('login_id',$agentid);

		$this->db->update($database,$data1);

	}else{

		$this->db->insert($database,$data1);

	} 
	if ($this->db->trans_status() === FALSE)

    {

         $this->db->trans_rollback();

    }

    else

    {

         $this->db->trans_commit();

    }

    }
    /*-------------------add agent------------*/

public function add_agent()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                   $type=2;

                   $data = array(
                       'ADMIN_NAME' => $_POST['agent_name'],
                       'USER_NAME' => $_POST['user_name'],
                       'ADMIN_PASSWORD' => md5($_POST['password']),
                       'COMPANY_ID' => $_POST['department'],
						'PASSWORD_VIEW' => $_POST['password'],
                       'ADMIN_TYPE' => $type,

                     

                       

                   );

              $num = $this->db->get_where('admin_login',['USER_NAME'=>$_POST['user_name']])->num_rows();     
              if($num > 0){

              }else{
             
                $this->db->insert('admin_login',$data);
                $insert_id= $this->db->insert_id();
              if($insert_id!= ''){

              

                $content = '

                <div> <h1>Registration Successfull</h1> </div> <br>
                <div> <h4>here is your username and password</h4> </div> <br>
                <div> username:'.$data["USER_NAME"].'  <br> password:'.$_POST["password"].'</div>

                ';
                 $from_email = "halponlineup.co.in@gmail.com"; 
        		 $to_email = $_POST['user_name']; 
		  		// $otp=rand(10000,99999);
		         //Load email library 
		         $this->load->library('email'); 
		   		 $this->email->from($from_email, 'hii'); 
		         $this->email->to($to_email);
		         $this->email->set_mailtype('html');
		         $this->email->subject('Registration Success'); 
		         $this->email->message($content); 

		         if($this->email->send()) 
		         	  $this->session->set_flashdata("email_sent","Email sent successfully."); 
		         else 
		         	  $this->session->set_flashdata("email_sent","Error in sending Email.");
            }
          }
                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    		public function update_admin_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('admin_login',['ADMIN_ID'=>$_POST['checkid']])->row(); 
               if($profile->ADMIN_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'ADMIN_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('ADMIN_ID',$_POST['checkid']);
                $this->db->update('admin_login',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
    
    public function student_exam_date()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('students',['id'=>$_POST['student_id'],'enrollment_no'=>$_POST['enroll']])->row(); 
                if($profile->exam_status =='0'){
                    $status = 1;
                }
                $data = array(
                                'exam_status' => 1, 
                                );
                $data1 = array(
                                'exam_status' => 1, 
                                );
                $data2=array(
                    'student_id' => $_POST['student_id'], 
                    'enrollment_no' => $_POST['enroll'], 
                    'exam_id' => $_POST['exam_id'], 
                    'subject_id' => $_POST['subject_id'],
                    'center_id' => $_POST['center_id'],
                    'type' => $_POST['subject_type'],
                    'year' => $_POST['year'],
                );
                //$data = array_merge($data1,$data2);
                $this->db->trans_begin();
                $this->db->where('id',$_POST['student_id']);
                $this->db->update('students',$data);
                $this->db->where('id',$_POST['subject_id']);
                $this->db->update('subjects',$data1);
                
                
                $check=$this->db->query("select * from Assign_exam_student where student_id='".$_POST['student_id']."' and exam_id='".$_POST['exam_id']."' and subject_id='".$_POST['subject_id']."' and center_id='".$_POST['center_id']."' and type='".$_POST['subject_type']."' and year='".$_POST['year']."'  ")->num_rows();
                $check_student=$this->db->query("select * from Assign_exam_student where student_id='".$_POST['student_id']."'  and exam_id='".$_POST['exam_id']."' and center_id='".$_POST['center_id']."' and type='".$_POST['subject_type']."' and year='".$_POST['year']."'  ")->num_rows();
                if ($check>0) {
                         json_output(400, array('status' => 200, 'message' => 'exam date is assigned  for another suject.'));
                         return;
                }
                if ($check_student>0) {
                         json_output(400, array('status' => 200, 'message' => 'subject dates can not be same .'));
                         return;
                }
                $check_exam=$this->db->query("select * from Assign_exam_student where student_id='".$_POST['student_id']."'  and subject_id='".$_POST['subject_id']."' and type='".$_POST['subject_type']."'  ")->num_rows();
                if($check_exam<=0){
                    $this->db->insert('Assign_exam_student',$data2);
                }else{
                    $this->db->where('student_id',$_POST['student_id']);
                    $this->db->where('subject_id',$_POST['subject_id']);
                    $this->db->where('center_id',$_POST['center_id']);
                    $this->db->update('Assign_exam_student',$data2);
                }
                
                if ($this->db->trans_status() === FALSE)
                {
                        $this->db->trans_rollback();
                }else{
                        $this->db->trans_commit();
                }
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
    	public function student_update_exam_date()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('Assign_exam_student',['id'=>$_POST['exam_update_id']])->row(); 
                $check=$this->db->query("select * from Assign_exam_student where student_id='".$_POST['student_id']."' and exam_id='".$_POST['exam_id']."' and subject_id='".$_POST['subject_id']."' and center_id='".$_SESSION['loginid']."' ")->num_rows();
                    $check_student=$this->db->query("select * from Assign_exam_student where student_id='".$_POST['student_id']."'  and exam_id='".$_POST['exam_id']."' and center_id='".$_SESSION['loginid']."' ")->num_rows();
                if ($check>0) {
                         json_output(400, array('status' => 400, 'message' => 'exam date is assigned  for another suject.'));
                         return;
                     }
                     if ($check_student>0) {
                         json_output(400, array('status' => 400, 'message' => 'subject dates can not be same .'));
                         return;
                     }
                $data2=array(
                    'student_id' => $_POST['student_id'], 
                    'subject_id' => $_POST['subject_id'], 
                    'enrollment_no' => $_POST['enroll'], 
                    'exam_id' => $_POST['exam_id'], 
                    'center_id' => $_SESSION['loginid'],
                );
                //$data = array_merge($data1,$data2);
                $this->db->trans_begin();
                $this->db->where('id',$_POST['exam_update_id']);
                $this->db->update('Assign_exam_student',$data2);
            
                if ($this->db->trans_status() === FALSE)
                {
                        $this->db->trans_rollback();
                }
                else
                {
                        $this->db->trans_commit();
                }
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
			public function update_service_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('form_fields_data',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('form_fields_data',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
    /*-------------------add agent------------*/
     /*-------------------update agent------------*/

public function update_agent()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {

                   $data = array(

                       'ADMIN_NAME' => $_POST['agentname'],
                       'USER_NAME' => $_POST['agentusername'],
                       'ADMIN_PASSWORD' => md5($_POST['agentpass']),
						'PASSWORD_VIEW' => $_POST['agentpass'],
                       
                       'COMPANY_ID' => $_POST['dpt_name'],

                       'ADMIN_TYPE' => 2,

                     

                       

                   );
                   $this->db->where('ADMIN_ID',$_POST['agentid']);
					$this->db->update('admin_login',$data);

     

                
                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
     /*-------------------update agent------------*/

public function delete_agent()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
        $query=    $this->db->get_where('agent_form_data',array('seller_id'=>$_POST['deleteagentid']));
    
                if($query->num_rows()> 0){    
                }
                else{
                   $this->db->where('ADMIN_ID',$_POST['deleteagentid']);
					$this->db->delete('admin_login');
                }
     

                
                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    // public function delete_exam()

    // {

    //     $method = $_SERVER['REQUEST_METHOD'];

    //     if ($method != 'POST') {

    //         json_output(400, array('status' => 400, 'message' => 'Bad request.'));

    //     } else {

    //         $check_auth_client = $this->Authentication_model->check_auth_client();

    //         if ($check_auth_client == true) {
    //     $query=    $this->db->get_where('agent_form_data',array('seller_id'=>$_POST['de']));
    
    //             if($query->num_rows()> 0){    
    //             }
    //             else{
    //               $this->db->where('ADMIN_ID',$_POST['deleteagentid']);
				// 	$this->db->delete('admin_login');
    //             }
     

                
    //             $response['status'] = 200;

    //             $response['message'] = 'ok';

    //             json_output($response['status'], $response);

    //             if ($response['message'] == "ok") {

    //             insert_activity_history(1,0);

    //             }

    //         }

    //     }

    // }

public function add_document()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {

                    



            		$banner=$_FILES['document']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['document']['size'];
                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["document"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}

                   $type=$_SESSION['loginid'];

                   $data = array(
                   		'admin_id' => $type,
                       'agent_id' => $_POST['agent_id'],
                       'form_id' => $_POST['form_id'],
                       'forms_name' => $_POST['form_name'],
                       'date' =>date('Y-m-d'),

                       'document_name' => $_POST['document_name'],
                       'document' => $upload_nm,
                       );
					//    $status=1;
					   $data2=array(
						   'status'=> 1,
					   );
					  $this->db->trans_begin();
                $this->db->insert('document',$data);
								
                $this->db->where('seller_id',$_POST['agent_id']);
                $this->db->where('form_id',$_POST['formid']);
				$this->db->update('agent_form_data',$data2);
				if ($this->db->trans_status() === FALSE)

                    {

                         $this->db->trans_rollback();

                    }

                    else

                    {

                         $this->db->trans_commit();

                    }
					   

     


                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
/*------------ END OF GAME -------------------*/
/*-------------------add agent------------*/

public function add_plan()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'plan_id' => $_POST['plan_id'],
                       'plan_name' => $_POST['plan_name'],
                       'commision' => $_POST['commision'],
                  
                   );
                $this->db->insert('plan',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    // approve enquiry
    public function approve_enquiry()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'status' =>1,
                   );
                $this->db->where('id',$_POST['enquiryid']);
                $this->db->update('enquiry',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    // reject enquiry
    public function reject_enquiry()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'status' =>2,
                   );
                $this->db->where('id',$_POST['enquiryid']);
                $this->db->update('enquiry',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }

/*-------------------update plan------------*/

public function update_plan()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'plan_id' => $_POST['planid'],
                       'plan_name' => $_POST['planname'],
                       'commision' => $_POST['update_commision'],
                  
                   );
					$this->db->where('id',$_POST['plan_id']);
					$this->db->update('plan',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    // add comment
    

public function add_comment()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                      
                       'comment' => $_POST['comment'],
                  
                   );
					$this->db->where('form_id',$_POST['formid']);
					$this->db->where('seller_id',$_POST['agentid']);
					$this->db->update('agent_form_data',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    
    /*-------------------delete plan------------*/

public function delete_plan()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                  
					$this->db->where('id',$_POST['deleteplanid']);
					$this->db->delete('plan');

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    /*-------------------wallet request------------*/

public function wallet_request()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
              	$banner=$_FILES['reciept']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['reciept']['size'];
                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["reciept"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
              
            	$status=0;
                   $data = array(
                       'agent_id' => $_SESSION['loginid'],
                       'amount' => $_POST['amount'],
                       'date' => $_POST['req_date'],
                       'status' => $status,
                       'bank_name' => $_POST['bank_name'],
                       'transaction_id' => $_POST['trans'],
                       'receipt' => $upload_nm,
                  
                   );
                $this->db->insert('wallet_request',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
        /*-------------------add agent------------*/

public function approve_wallet_request()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
            	$status=1;
                   $data = array(
                       // 'agent_id' => $_SESSION['loginid'],
                       // 'amount' => $_POST['amount'],
                       'action_date' => date('Y-m-d'),
                       // 'amount' => $_POST['amount'],
                       // 'massage'=>$_POST['comment'],
                       'status' => $status,
                  
                   );
                      $user_id=$_POST['request_id'];
			   		   // $form_name=$_SESSION['form_name'];

                      $wallet = $this->db->query("select * from wallet_request where id='". $user_id ."'"); 
                       $row = $wallet->row();

                    

                      if (isset($row))

                        {

                            $wallet_balance= $row->amount;

                              

                        }
                     $agentid=   $_POST['agentrequest_id'];

				$this->db->where('id',$_POST['request_id']);

               $x=$this->db->update('wallet_request',$data);
                // die(var_dump($x));

                $this->update_agent_wallet($agentid,$wallet_balance);
                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    /*-------------------add agent------------*/

public function reject_wallet_request()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
            	$status=2;
                   $data = array(
                       // 'agent_id' => $_SESSION['loginid'],
                       // 'amount' => $_POST['amount'],
                       'action_date' => date('Y-m-d'),
                       // 'amount' => $_POST['amount'],
                       // 'massage'=>$_POST['comment'],
                       'status' => $status,
                  
                   );
				$this->db->where('id',$_POST['reject_id']);

                $this->db->update('wallet_request',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    public function cancel_wallet_request()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
            
            		// die(var_dump($_POST['rq_id']));
				$this->db->where('id',$_POST['rq_id']);

                $this->db->delete('wallet_request');

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
	// ADD ACCOUNT
	public function add_account()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
            	$status=0;
                   $data = array(
					   'login_id'=>$_SESSION['loginid'],
                       'bank_name' => $_POST['bank_name'],
                       'account' => $_POST['ac_no'],
                       'branch_name' => $_POST['branch_name'],
                       'ifsc' => $_POST['ifsc'],
					   'date'=>date('Y-m-d'),                  
                   );
                $this->db->insert('bank_account',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    } 
		// ADD VEDIO
	public function add_vedio()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
            	$status=0;
                   $data = array(
					   //'title'=>$_SESSION['loginid'],
                       'title' => $_POST['title'],
                       'video_url' => $_POST['url'],
                       'timestamp'=>date('Y-m-d H:i:s'),                  
                   );
                $this->db->insert('videos',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    // remove vedio
    public function remove_vedio_from_list() {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
       $id = $_POST['id'];
        
        

        $this->db->where('id',$id);
        $this->db->delete('videos');
        $response['status'] = 200;
        $response['message'] = 'ok';
        json_output($response['status'], $response);
    }
    	// ADD PDF
	public function add_pdf()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
              		$banner=$_FILES['pdf']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['pdf']['size'];
                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["pdf"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                   $data = array(
					            'agent_id'=>$_SESSION['loginid'],
                       'pdf_name' => $_POST['pdf_name'],
                       'pdf' => $upload_nm,
                       'timestamp'=>date('Y-m-d H:i:s'),                  
                   );
                $this->db->insert('pdf',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
	 	// ADD PDF
	public function add_link()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
              
                   $data = array(
					    'admin_id'=>$_SESSION['loginid'],
                       'title' => $_POST['title'],
                       'link' =>$_POST['url'],
                       'timestamp'=>date('Y-m-d H:i:s'),                  
                   );
                $this->db->insert('link',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
	 	// ADD PDF
	public function add_documents()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
              		$banner=$_FILES['document']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['document']['size'];
                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["document"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                   $data = array(
					            'admin_id'=>$_SESSION['loginid'],
                       'title' => $_POST['document_name'],
                       'descirption' => $_POST['desc'],
                       'document' => $upload_nm,
                       'timestamp'=>date('Y-m-d H:i:s'),                  
                   );
                $this->db->insert('documents',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
		/*-------------------add department------------*/

public function add_dpt()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'dpt_id' => $_POST['dpt_code'],
                       'dpt_name' => $_POST['dpt_name'],
                       'status' => 1,
                       'login_id' => $_SESSION['loginid'],
					   'timestamp' => date('Y-m-d'),
                  
                   );
                $this->db->insert('department',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }		
		public function update_dpt_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('department',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('department',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }	
// add_user
/*-------------------add user------------*/

public function add_user()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'ADMIN_NAME' => $_POST['br_name'],
                       'USER_NAME' => $_POST['br_u_name'],
                       'COMPANY_ID' => $_POST['br_code'],
                       
                       'ADMIN_TYPE' => 3,
                       'ADMIN_STATUS' => 1,
						'ADMIN_PASSWORD' => md5($_POST['br_pass']),
						'PASSWORD_VIEW' =>$_POST['br_pass'],
                    
					   'ADMIN_CREATED' => date('Y-m-d'),
                  
                   );
                $this->db->insert('admin_login',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    	public function update_user_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('admin_login',['ADMIN_ID'=>$_POST['checkid']])->row(); 
               if($profile->ADMIN_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'ADMIN_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('ADMIN_ID',$_POST['checkid']);
                $this->db->update('admin_login',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }	
    /*-------------------update user------------*/

public function update_user()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'ADMIN_NAME' => $_POST['user_name'],
                       'USER_NAME' => $_POST['user_user_name'],
                       'COMPANY_ID' => $_POST['user_dpt_name'],
                       
						'ADMIN_PASSWORD' => md5($_POST['user_password']),
                    
					   'ADMIN_CREATED' => date('Y-m-d'),
                  
                   );
                $this->db->where('ADMIN_ID',$_POST['updateuserid']);
                
                $this->db->delete('admin_login',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }

/*-------------------delete user------------*/

public function delete_user()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   
                $this->db->where('ADMIN_ID',$_POST['deleteuserid']);
                
                $this->db->delete('admin_login',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
				



// update department
/*-------------------update user------------*/

public function update_department()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'dpt_name' => $_POST['department'],
                       'dpt_id' => $_POST['code'],
                   
                  
                   );
                $this->db->where('id',$_POST['updatedepartmentid']);
                // die(var_dump($_POST['updatedepartmentid']));	
                $this->db->update('department',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
    public function add_service_comment()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                   $data = array(
                       'comment' => $_POST['comment'],
                      //  'dpt_id' => $_POST['code'],
                   
                  
                   );
                $this->db->where('id',$_POST['serviceid']);
                // die(var_dump($_POST['updatedepartmentid']));	
                $this->db->update('form_fields_data',$data);

                $response['status'] = 200;

                $response['message'] = 'ok';

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                insert_activity_history(1,0);

                }

            }

        }

    }
  	function update_our_services(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

				/*-------------- image -----------------*/


						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/

					$database = 'our_services';

						$data = array(

										// 'rs_id' => $_POST['slider_id'],

										'title' => $_POST['servicetitle'], 

										'description' => $_POST['service_dec'], 

										//'image' => $upload_nm,

										
									);
                            
                            
                            if ($_FILES['image']['name']) {
        						$arr1 = array(
        										 'image' => $upload_nm, 
        									);
        					}else{
        						$arr1 = array(
        									    );
        					}
        					
        					$arr3 = array_merge($arr1,$data);					

                            
					       $this->db->where('id',$_POST['service_id']); 
							$this->db->update($database,$arr3);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function delete_our_services(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

			
					$database = 'our_services';

			
					       $this->db->where('id',$_POST['delete_service_id']); 
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}  
    						function our_features()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){



					/*-------------- image -----------------*/

						$banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}                		

					/*-------------- image2 ------------------*/





						$database = 'our_features';

						$data = array(

										'image' => $upload_nm, 
										'title' => $_POST['title'],
										'desc' => $_POST['desc'],
										'login_id' => $_SESSION['loginid'],
								
								// 		'status' => 1,
									

									);

						

						

				// 	    $result=check_data_exits($database);

				// 		 if($result!= '0'){

				// 			$this->db->where('id',$result->id);

				// 			$this->db->update($database,$data);

				// 			$response=array('status' => 200,'message' => 'ok');						

				// 		 }else{

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			         //	}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function update_our_features(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

			
					$database = 'our_features';

						$data = array(

										// 'rs_id' => $_POST['slider_id'],
										'desc' => $_POST['featuresdesc'], 
                            
										'title' => $_POST['servicetitle'], 
                                        'login_id' => $_SESSION['loginid'],
									
										
									);

					       $this->db->where('id',$_POST['features_id']); 
							$this->db->update($database,$data);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function delete_our_features(){
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			  $response = $this->Authentication_model->auth();	
			   if($response['status'] == 200){

			
					$database = 'our_features';

			
					       $this->db->where('id',$_POST['delete_features_id']); 
							$this->db->delete($database);

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		public function update_news_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('news',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('news',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
	public function update_flash_image_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('flash_image',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('flash_image',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
    public function update_event_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('blogs',['BLOG_ID'=>$_POST['checkid']])->row(); 
               if($profile->BLOG_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'BLOG_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('BLOG_ID',$_POST['checkid']);
                $this->db->update('blogs',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
     public function update_gallery_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('blogs',['BLOG_ID'=>$_POST['checkid']])->row(); 
               if($profile->BLOG_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'BLOG_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('BLOG_ID',$_POST['checkid']);
                $this->db->update('blogs',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
     public function update_exam_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('blogs',['BLOG_ID'=>$_POST['checkid']])->row(); 
               if($profile->BLOG_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'BLOG_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('BLOG_ID',$_POST['checkid']);
                $this->db->update('blogs',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
     public function update_add_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('blogs',['BLOG_ID'=>$_POST['checkid']])->row(); 
               if($profile->BLOG_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'BLOG_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('BLOG_ID',$_POST['checkid']);
                $this->db->update('blogs',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
     public function update_student_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('blogs',['BLOG_ID'=>$_POST['checkid']])->row(); 
               if($profile->BLOG_STATUS =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'BLOG_STATUS' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('BLOG_ID',$_POST['checkid']);
                $this->db->update('blogs',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
		public function update_branches_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('our_branches',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('our_branches',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
    	public function update_latest_news_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('latest_news',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('latest_news',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
    	public function update_notice_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('notice_board',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('notice_board',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
	// advance notice status
	
		public function update_advance_notice_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('advance_notice',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('advance_notice',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
	// update information board

	
		public function update_information_board_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('information_board',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('information_board',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }
	// update ADMISSION NOTICE

	
		public function update_admission_notice_status()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
             
               $profile =  $this->db->get_where('admission_notice',['id'=>$_POST['checkid']])->row(); 
               if($profile->status =='1'){
                $status = 0;
               }else{
                $status = 1;
               }
                $data = array(
                                'status' => $status, 
                                );
                //$data = array_merge($data1,$data2);
                 $this->db->where('id',$_POST['checkid']);
                $this->db->update('admission_notice',$data);
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }

	function add_menu()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						//$database = 'menu';
					    
					    
					    
					    $six_digit_random_number = random_int(100000, 999999);
					    
						$database = 'front_cms_menu_items';
						
					    $page_name = str_replace(" ","-",$_POST['menu_name']);
					    
					    
					    $page_name = str_replace("&","and",$page_name);
					    
					    
					    if(!isset($_POST['external_url_link']) || empty($_POST['external_url_link'])) {
					   // if($this->input->post($_POST['external_url_link'])== ''){
					        $url = ''.base_url().''.$page_name.'/'.$six_digit_random_number.'';
					        
					        
					        $data1 = array(
								'menu' => $_POST['menu_name'],
								//'page_id' =>$_POST['page_name'], 
								'ext_url_link' => $url,
								//'menu_url' => $url,
								'menu_code' => $six_digit_random_number,
							);
					        
					    }else{
					        $url = $_POST['external_url_link'];
					        
					        $data1 = array(
								'menu' => $_POST['menu_name'],
								//'page_id' =>$_POST['page_name'], 
								'ext_url_link' => $url,
								//'menu_url' => $url,
								//'menu_code' => $six_digit_random_number,
							);
					        
					    }
					    
					    
					    
							
				        $banner=$_FILES['fileToUpload']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['fileToUpload']['size'];
							$expbanner=explode('.',$banner);
							$allowed_format = array('jpg','jpeg','png');	
							//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
							$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
							$full_file_name = uniqid().".".end($expbanner);		
							$uploadfile = $uploaddir.$full_file_name;
							$upload_nm=$full_file_name;
							move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);
						}else{

							$upload_nm = '';

						} 			
						if ($upload_nm!= '') {
                             $data2 = array(  
                                        'image_url' => $upload_nm,
                                        );
                        }else{
                            $data2 = array(
                                            );
                        }
                        $data = array_merge($data1,$data2);	
							
				 	   
									
					 	$this->db->insert($database,$data);
					 	$response=array('status' => 200,'message' => 'ok');
					 	
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


    function add_submenu()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'submenu';
						$database1 = 'subsubmenu';
						$database2 = 'link_page';
                                 $submenu_id=0;
						
                    	$subsubmenu_id=0;
						
							      

					
                 $this->db->trans_begin();
                            // die(var_dump($_POST));
                             if(!empty($_POST['submenu'])){
                                 $data = array(

										'menu' => $_POST['menu'],
										'submenu' => $_POST['submenu'],
										'login_id' =>$_SESSION['loginid'], 

										 

									);
                            
                                    $check = $this->db->get_where($database2,['menu'=>$_POST['menu'],'submenu'=>$_POST['submenu'],'subsubmenu'=>0 ]);
                                    $check_menu = $check->row();
                                    $check_menus = $check->num_rows();
                                    if($check_menus > 0){
                                        
                                        $this->db->where('id',$check_menu->id);
                                        $this->db->update($database,$data);
                                        
                                    }else{
                                        $this->db->insert($database,$data);
                                        $submenu_id= $this->db->insert_id();
                                    }
                            
                            
						        	
                                }
									//  die(var_dump($submenu_id));
                                
                                 
                             if(!empty($_POST['subsubmenu'])){
                                   $data1 = array(

										// 'menu' => $_POST['menu'],
										'subsubmenu' => $_POST['subsubmenu'],
										'login_id' =>$_SESSION['loginid'], 

										 

									);
                            
                                    $check = $this->db->get_where($database2,['menu'=>$_POST['menu'],'submenu'=>$_POST['submenu'],'subsubmenu'=>$_POST['subsubmenu'] ]);
                                    
                                    $check_menu = $check->row();
                                    $check_menus = $check->num_rows();
                                    
                                    if($check_menus > 0){
                                        
                                        $this->db->where('id',$check_menu->id);
                                        $this->db->update($database1,$data1);
                                    }
                                    else{
                                        $this->db->insert($database1,$data1);
                                        $subsubmenu_id= $this->db->insert_id();
                                    }
						 	
                               
                               
                                     
									//  die(var_dump($subsubmenu_id));
                                }
								
                                 
                            //  if(isset($_POST['subsubmenu'])){
                            //      $subsubmenu_id=0;
                            //        $data1 = array(

							// 			// 'menu' => $_POST['menu'],
							// 			'subsubmenu' => $_POST['subsubmenu'],
							// 			'login_id' =>$_SESSION['loginid'], 

										 

							// 		);

						 	// $this->db->insert($database1,$data1);
                            //          $subsubmenu_id= $this->db->insert_id();
                            //     }
                             if(isset($_POST['menu'])){
                                //  $subsubmenu_id=0;
                                   $data3 = array(

										'menu' => $_POST['menu'],
										'submenu' => $submenu_id,
										'subsubmenu' => $subsubmenu_id,
										'target_blank' => 
                                        isset($_POST['openlinkstatus']) ? $_POST['openlinkstatus'] : '',
										'has_url' => $_POST['ext_url_status'],
										'url_address' => isset($_POST['ext_url_link']) ? $_POST['ext_url_link'] : '',
										'pagename' => isset($_POST['page']) ? $_POST['page'] : '',
										'login_id' =>$_SESSION['loginid'], 

									);
                                    
                                    $check = $this->db->get_where($database2,['menu'=>$_POST['menu'],'submenu'=>0,'subsubmenu'=>0 ]);
                                    
                                    $check_menu = $check->row();
                                    $check_menus = $check->num_rows();
                                    
                                    if($check_menus > 0){
                                        $this->db->where('id',$check_menu->id);
                                        $this->db->update($database2,$data3);
                                    }else{
                                        $this->db->insert($database2,$data3);
                                    }
						 	        
                                    
                                    //  $subsubmenu_id= $this->db->insert_id();
                                }
						 	$response=array('status' => 200,'message' => 'ok');

			       	if ($this->db->trans_status() === FALSE)

                    {

                         $this->db->trans_rollback();

                    }

                    else

                    {

                         $this->db->trans_commit();

                    }

 

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
		function page_link()

	{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} else {

			$check_auth_client = $this->Authentication_model->check_auth_client();

			

			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();

			    if($response['status'] == 200){

						$database = 'link_page';

							$data = array(

										'menu' => $_POST['menu'],
										'submenu' => $_POST['submenu'],
										'pagename' => $_POST['page'],
										'login_id' =>$_SESSION['loginid'], 

										 

									);

					

						 	$this->db->insert($database,$data);

						 	$response=array('status' => 200,'message' => 'ok');

			        

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

		

	}
	
/*----------------------------- start pankaj ---------------------------------------------------*/	
	/*--------------- start master setting --------------*/
	public function add_brand()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			

				/*-------------start image --------------*/
						if(isset($_FILES['fileToUpload'])){
							$banner=$_FILES['fileToUpload']['name']; 
							if($banner!=''){
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
										
										if ($_FILES['fileToUpload']['name']) {
											$arr2 = array(
															 'brand_image'=>$upload_nm,
														);
										}else{
											$arr2 = array(
														);
										}

											$data=array(
												'brand_name'=>$_POST['brand_name'],
												'description'=>$_POST['content'],
												
											);
										$arr3 = array_merge($arr2,$data);
									
									    if($this->input->post('brandid')){
									        $this->db->where('id',$this->input->post('brandid'));
									        $this->db->update('brand',$arr3);
									        $response=array('status' => 200,'message' => 'ok');	
									    }else{
									        	$this->db->insert('brand',$arr3);
        										$insert_id = $this->db->insert_id();
        										if(!empty($insert_id)){
        											$response=array('status' => 200,'message' => 'ok');	
        
        										}else{
        											$response=array('status' => 200,'message' => 'Something wents wrong');	
        										}
									    }
									
									

									}
							}else{
								$data=array(
										'brand_name'=>$_POST['brand_name'],
										'description'=>$_POST['content'],
										
									);
								
								if($this->input->post('brandid')){
							        $this->db->where('id',$this->input->post('brandid'));
							        $this->db->update('brand',$data);
							        $response=array('status' => 200,'message' => 'ok');	
							    }else{
							        	$this->db->insert('brand',$data);
										$insert_id = $this->db->insert_id();
										if(!empty($insert_id)){
											$response=array('status' => 200,'message' => 'ok');	

										}else{
											$response=array('status' => 200,'message' => 'Something wents wrong');	
										}
							    }
							}
						}
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}

	public function add_category()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
					$check = check_category_name_exist($_POST['brand'],$_POST['category']);
						if($check){
							$response=array('status' => 200,'message' => 'Category Name Already Exist');	
						}else{

						
						if(isset($_FILES['fileToUpload'])){
							$banner=$_FILES['fileToUpload']['name']; 
							if($banner!=''){
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
									$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
									$full_file_name = uniqid().".".end($expbanner);		
									$uploadfile = $uploaddir.$full_file_name;
								
									$upload_nm=$full_file_name;
									move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
							
									if ($_FILES['fileToUpload']['name']) {
										$arr2 = array(
														 'CAT_IMAGE'=>$upload_nm,
													);
									}else{
										$arr2 = array(
													);
									}

									$data=array(
										'CATEGORY_NAME'=>$_POST['category'],
										'BRAND_ID'=>@$_POST['brand'],
										'CAT_IMAGE'=>$upload_nm,
                                        'LOGIN_ID'=>$_SESSION['loginid'],
									);
								
									$arr3 = array_merge($arr2,$data);	

									$this->db->insert('categorylist',$arr3);
									$insert_id = $this->db->insert_id();
									if(!empty($insert_id)){
										$response=array('status' => 200,'message' => 'ok');	

									}else{
										$response=array('status' => 200,'message' => 'Something wents wrong');	
									}
								}
							}else{
									$data=array(
										'CATEGORY_NAME'=>$_POST['category'],
										'BRAND_ID'=>@$_POST['brand'],
										'LOGIN_ID'=>$_SESSION['loginid'],
									);
									$this->db->insert('categorylist',$data);
									$insert_id = $this->db->insert_id();
									if(!empty($insert_id)){
										$response=array('status' => 200,'message' => 'ok');	

									}else{
										$response=array('status' => 200,'message' => 'Something wents wrong');	
									}
							}
						}
					}
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


	public function add_sub_category()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
					$check = check_sub_category_name_exist($_POST['brand'],$_POST['category'],$_POST['sub_cat_name']);
						if($check){
							$response=array('status' => 200,'message' => 'Sub Category Name Already Exist');	
						}else{

            				if(isset($_FILES['fileToUpload'])){
								$banner=$_FILES['fileToUpload']['name']; 
								if($banner!=''){
									$file_size = $_FILES['fileToUpload']['size'];
									$expbanner=explode('.',$banner);
									$allowed_format = array('jpg','jpeg','png');	
									if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
  
										if ($_FILES['fileToUpload']['name']) {
											$arr2 = array(
															 'IMAGE'=>$upload_nm,
														);
										}else{
											$arr2 = array(
														);
										}

					                    $data=array(
					                      'SUB_CAT_NAME'=>$_POST['sub_cat_name'],
					                      'CAT_ID'=>$_POST['category'],
					                      'BRAND_ID'=>$_POST['brand'],
					                      // 'IMAGE'=> $upload_nm,

					                    );
					                    $arr3 = array_merge($arr2,$data);
					                    $this->db->insert('sub_cat',$arr3);
					                    $insert_id = $this->db->insert_id();
					                  	if(!empty($insert_id)){
					                    	$response=array('status' => 200,'message' => 'ok');	

					                  	}else{
					                    	$response=array('status' => 200,'message' => 'Something wents wrong');	
					                  	}
					                }
				              	}else{
				              		 $data=array(
					                      'SUB_CAT_NAME'=>$_POST['sub_cat_name'],
					                      'CAT_ID'=>$_POST['category'],
					                      'BRAND_ID'=>$_POST['brand'],
					                      // 'IMAGE'=> $upload_nm,

					                    );
					                    $this->db->insert('sub_cat',$data);
					                    $insert_id = $this->db->insert_id();
					                  	if(!empty($insert_id)){
					                    	$response=array('status' => 200,'message' => 'ok');	

					                  	}else{
					                    	$response=array('status' => 200,'message' => 'Something wents wrong');	
					                  	}
				              	}
			            	}
					}
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


	public function update_assign_role()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
			    	$num = checkrole_exits1($_POST['role_name'],$_POST['userid']);
			    	if ($num > '0') {
			    		
						$res = checkrole_exits($_POST['role_name'],$_POST['userid']);
							if ($res->METHOD_STATUS == '1') {
							$status = '0';
								//echo "11";
							}else{
								$status = '1';
							}
							$data = array(
										'METHOD_NAME'=>$_POST['role_name'],
										'METHOD_STATUS'=>$status,
										'LOGIN_ID'=>$_POST['userid'], 

									);
							$this->db->where('PERMISSION_ID',$res->PERMISSION_ID);
							$this->db->update('permission',$data);
						$response=array('status' => 200,'message' => 'ok');			
					}else{
			    		$data = array(
										'METHOD_NAME'=>$_POST['role_name'],
										'METHOD_STATUS'=>'1',
										'LOGIN_ID'=>$_POST['userid'], 
									);
			    		$this->db->insert('permission',$data);
			    		$response=array('status' => 200,'message' => 'ok');	
			    	}
						
					
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}




/*--------------- end of master setting -----------------------*/

	public function add_product()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
						$check=check_product_type_exist($_POST['product_name']);
						if($check){
							$response=array('status' => 200,'message' => 'Property Name Already Exist');	
						}else{

							if(isset($_FILES['fileToUpload1'])){
								$banner1=$_FILES['fileToUpload1']['name']; 
								if($banner1!=''){
									$file_size1 = $_FILES['fileToUpload1']['size'];
									
									$expbanner1=explode('.',$banner1);
									$allowed_format1 = array('jpg','jpeg','png','pdf');	
									if(in_array(strtolower(end($expbanner1)),$allowed_format1)){	
										$uploaddir1 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name1 = uniqid().".".end($expbanner1);		
										$uploadfile1 = $uploaddir1.$full_file_name1;
									
										$upload_nm1=$full_file_name1;
										move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"] , $uploadfile1);	//for moving image 
									}
								}
							}



                    /*

							if(isset($_FILES['fileToUpload2'])){
								$banner2=$_FILES['fileToUpload2']['name']; 
								if($banner2!=''){
									$file_size2 = $_FILES['fileToUpload2']['size'];
									
									$expbanner2=explode('.',$banner2);
									$allowed_format2 = array('jpg','jpeg','png');	
									if(in_array(strtolower(end($expbanner2)),$allowed_format2)){	
										$uploaddir2 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name2 = uniqid().".".end($expbanner2);		
										$uploadfile = $uploaddir2.$full_file_name;
									
										$upload_nm2=$full_file_name2;
										move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"] , $uploadfile2);	//for moving image 
									}
								}
							}
							if(isset($_FILES['fileToUpload3'])){
								$banner3=$_FILES['fileToUpload3']['name']; 
								if($banner3!=''){
									$file_size3 = $_FILES['fileToUpload3']['size'];
									
									$expbanner3=explode('.',$banner3);
									$allowed_format3 = array('jpg','jpeg','png');	
									if(in_array(strtolower(end($expbanner3)),$allowed_format3)){	
										$uploaddi3r = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name3 = uniqid().".".end($expbanner3);		
										$uploadfile3 = $uploaddir3.$full_file_name3;
									
										$upload_nm3=$full_file_name3;
										move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"] , $uploadfile3);	//for moving image 
									}
								}
							}
							if(isset($_FILES['fileToUpload4'])){
								$banner4=$_FILES['fileToUpload4']['name']; 
								if($banner4!=''){
									$file_size4 = $_FILES['fileToUpload4']['size'];
									
									$expbanner4=explode('.',$banner4);
									$allowed_format4 = array('jpg','jpeg','png');	
									if(in_array(strtolower(end($expbanner4)),$allowed_format4)){	
										$uploaddir4 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name4 = uniqid().".".end($expbanner4);		
										$uploadfile4 = $uploaddir4.$full_file_name4;
									
										$upload_nm4=$full_file_name4;
										move_uploaded_file($_FILES["fileToUpload4"]["tmp_name"] , $uploadfile4);	//for moving image 
									}
								}
							}
							if(isset($_FILES['fileToUpload5'])){
								$banner5=$_FILES['fileToUpload5']['name']; 
								if($banner5!=''){
									$file_size5 = $_FILES['fileToUpload5']['size'];
									
									$expbanner5=explode('.',$banner5);
									$allowed_format5 = array('jpg','jpeg','png');	
									if(in_array(strtolower(end($expbanner5)),$allowed_format5)){	
										$uploaddir5 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name5 = uniqid().".".end($expbanner5);		
										$uploadfile5 = $uploaddir5.$full_file_name5;
									
										$upload_nm5=$full_file_name5;
										move_uploaded_file($_FILES["fileToUpload5"]["tmp_name"] , $uploadfile5);	//for moving image 
									}
								}
							}
		*/					
			 if ($_FILES['fileToUpload1']['name']) {
				 $a1 = array(
					 'IMG_1'=>$upload_nm1,
									);
			 }else{
				 $a1 = array(
									);
			 }

			 
/*
			 if ($_FILES['fileToUpload2']['name']) {
				 $a2 = array(
					 'IMG_2'=>$upload_nm2,
									);
			 }else{
				 $a2 = array(
									);
			 }
			 if ($_FILES['fileToUpload3']['name']) {
				 $a3 = array(
					 'IMG_3'=>$upload_nm3,
									);
			 }else{
				 $a3 = array(
									);
			 }
			 if ($_FILES['fileToUpload4']['name']) {
				 $a4 = array(
					 'IMG_4'=>$upload_nm4,
									);
			 }else{
				 $a4 = array(
									);
			 }

			 if ($_FILES['fileToUpload5']['name']) {
				 $a5 = array(
					 'IMG_5'=>$upload_nm5,
									);
			 }else{
				 $a5 = array(
									);
			 }
			 $a6 = array_merge($a1,$a2,$a3,$a4,$a5);
		*/	 
		

							$data=array(
								'PRODUCT_NAME'=>$_POST['product_name'],
								'PRODUCT_STATUS'=>1,
								'BRAND_ID' => $_POST['brand'],
								'CAT_ID' => $_POST['category'],
								'PRODUCT_SUB_CAT_ID' => $_POST['child_category'],
							);
		                    
		                    $a7 = array_merge($a1,$data);

							$this->db->insert('product',$a7);
							$insert_id = $this->db->insert_id();
						if(!empty($insert_id)){
            				//	$pincode = $this->input->post('pincode');
            				//	$pin = explode(',',$pincode);
            							
            				//	for($i = 0;$i < count($pin); $i++ ) {
            				//	    $data2 = array(
            				//					'P_ID' => $insert_id,
            				//					'PINCODE' => $pin[$i], 
            				//					);
            				//		$this->db->insert('delivery_pincodes',$data2);
				            // 	}

							$response=array('status' => 200,'message' => 'ok');	

						}
					}
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


	public function add_banner()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
					

            				if(isset($_FILES['fileToUpload'])){
								$banner=$_FILES['fileToUpload']['name']; 
								if($banner!=''){
									$file_size = $_FILES['fileToUpload']['size'];
									$expbanner=explode('.',$banner);
									$allowed_format = array('jpg','jpeg','png');	
									if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										//$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
  
										if ($_FILES['fileToUpload']['name']) {
											$arr2 = array(
														 'IMAGE_URL'=>$upload_nm,
														);
										}else{
											$arr2 = array(
														);
										}

					                    $data=array(
					                      'IMAGE_TITLE'=>$_POST['title'],
					                    );
					                    $arr3 = array_merge($arr2,$data);
					                    $this->db->insert('promotional_add',$arr3);
					                    $insert_id = $this->db->insert_id();
					                  	if(!empty($insert_id)){
					                    	$response=array('status' => 200,'message' => 'ok');	

					                  	}else{
					                    	$response=array('status' => 200,'message' => 'Something wents wrong');	
					                  	}
					                }
				              	}
			            	}
			            }
						
				
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


	/*------------- start add coupan ---------------------*/
    public function add_coupan()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
					
					$data = array(
								'COUPAN_TITLE' => $_POST['title'],
								'COUPAN_DISCOUNT' => $_POST['discount'],
								'COUPAN_VALID_DATE' => $_POST['validupto'],
								);
					$num = 	count_all_coupans($_POST['title']);
					if ($num > 0) {
						
						$response=array('status' => 200,'message' => 'Coupan  Added');
					}else{
						$this->db->insert('coupan',$data);
						$response=array('status' => 200,'message' => 'ok');
					}
					
            				
			     }
						
				
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}

/*------------- end add coupan -------------------------*/
	
	function add_page()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'page';
							$data = array(
										'title' => $_POST['title'],
										'description' => $_POST['content'],
										//'login_id' =>$_SESSION['loginid'],
										'page_menu_code' => $_POST['id'], 
									);
									// die(var_dump($data));
						 
						 $num = $this->db->query("SELECT * FROM `page` WHERE `page_menu_code` LIKE '".$_POST['id']."'")->num_rows();
						if($num > 0){
						    $this->db->where('page_menu_code',$_POST['id']);
						    $this->db->update($database,$data);
						}else{
						    $this->db->insert($database,$data);
						}
						
						
					    $menu_name = $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `menu_code` LIKE '".$_POST['id']."' ")->row('menu');
						
						$page_name = str_replace(" ","-",$menu_name);
						
						$url = ''.base_url().''.$page_name.'/'.$_POST['id'].'';
						$this->db->where('menu_code',$_POST['id']);
						$this->db->update('front_cms_menu_items',['ext_url_link'=> $url]);
						 
						 
						 
						 $response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
    
    
    
    
    
    
    function add_page2()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

				
				
				if($_POST['content_type'] == 1){
				    $database = 'page';
					$data = array(
									'title' => $_POST['title_name'], 
									'description' => $_POST['content'], 
									'page_file' => $_POST['video'],
									'page_menu_code' => $_POST['menu_code'], 
                                    'content_status'=>1,
                                   
								);
					//$this->db->insert($database,$data);
					    $num = $this->db->query("SELECT * FROM `page` WHERE `page_menu_code` LIKE '".$_POST['menu_code']."'")->num_rows();
						if($num > 0){
						    $this->db->where('page_menu_code',$_POST['menu_code']);
						    $this->db->update($database,$data);
						}else{
						    $this->db->insert($database,$data);
						}
						
						
						$menu_name = $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `menu_code` LIKE '".$_POST['menu_code']."' ")->row('menu');
						
						$page_name = str_replace(" ","-",$menu_name);
						
						$url = ''.base_url().''.$page_name.'/'.$_POST['menu_code'].'';
						$this->db->where('menu_code',$_POST['menu_code']);
						$this->db->update('front_cms_menu_items',['ext_url_link'=> $url]);
						
						
					$response=array('status' => 200,'message' => 'ok');
				}else{
				    
				
				
				
				/*-------------- image -----------------*/
						$banner=$_FILES['image']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['image']['size'];
                        	$expbanner=explode('.',$banner);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name = uniqid().".".end($expbanner);		
                    			$uploadfile = $uploaddir.$full_file_name;
                    			$upload_nm=$full_file_name;
                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
						}else{
							$upload_nm = '';
						}                		
					/*-------------- image2 ------------------*/

    					$database = 'page';
						$data = array(
									    
									    'title' => $_POST['title_name'], 
    									'description' => $_POST['content'], 
    									'page_menu_code' => $_POST['menu_code'],
									    'content_status'=>2,
                                    );
						
						if ($_FILES['image']['name']) {
    						$arr1 = array(
    										 'page_file' => $upload_nm,
    									);
    					}else{
    						$arr1 = array(
    									    );
    					}
					
					    $arr3 = array_merge($arr1,$data);
						
						$num = $this->db->query("SELECT * FROM `page` WHERE `page_menu_code` LIKE '".$_POST['menu_code']."'")->num_rows();
						if($num > 0){
						    $this->db->where('page_menu_code',$_POST['menu_code']);
						    $this->db->update($database,$arr3);
						}else{
						    $this->db->insert($database,$arr3);
						}
						
						
						$menu_name = $this->db->query("SELECT * FROM `front_cms_menu_items` WHERE `menu_code` LIKE '".$_POST['menu_code']."' ")->row('menu');
						
						$page_name = str_replace(" ","-",$menu_name);
						
						$url = ''.base_url().''.$page_name.'/'.$_POST['menu_code'].'';
						$this->db->where('menu_code',$_POST['menu_code']);
						$this->db->update('front_cms_menu_items',['ext_url_link'=> $url]);
						
						
						$response=array('status' => 200,'message' => 'ok');

				}



			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
    
    function add_page3()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

				
				                $banner=$_FILES['fileToUpload']['name']; 
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										@move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
										
										
								}
							    if ($_FILES['fileToUpload']['name']) {
									$arr2 = array(
													 'brand_image'=>$upload_nm,
												);
								}else{
									$arr2 = array(
												);
								}

								$data=array(
									'brand_name'=>$_POST['title_name'],
									'description'=>$_POST['content']
								);
								$arr3 = array_merge($arr2,$data);
							    
							   	$this->db->where('id',$this->input->post('categoryid'));
								$this->db->update('brand',$arr3);
				
				
				
				
			


			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
/*------------------------- end panaj -------------------------------------------------*/	
 
 
	/*--------------------- start add news letter services --------------------------------------------*/
	
	function add_news_letter_services()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						    $database = 'news_letter_list';
							$data = array(
										'NEWS_TITLE' => $_POST['title'], 
										'NEWS_DESC' => $_POST['desc'], 
										'NEWS_LINK' => $_POST['web_link'],
									
									);
        						$this->db->insert($database,$data);
    							
    							$response=array('status' => 200,'message' => 'ok');
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
	
	
	/*-------------------- end add news letter servies ------------------------------------------------*/
	

/*--------------------- start update news letter services --------------------------------------------*/
	
	function update_news_letter_services()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						    $database = 'news_letter_list';
							$data = array(
										'NEWS_TITLE' => $_POST['title'], 
										'NEWS_DESC' => $_POST['desc'], 
										'NEWS_LINK' => $_POST['web_link'],
									
									);
								$this->db->where('NEWS_ID',$_POST['news_letter_id']);	
        						$this->db->update($database,$data);
    							
    							$response=array('status' => 200,'message' => 'ok');
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
	
	
	/*-------------------- end update news letter servies ------------------------------------------------*/






	/*--------------------- start news letter --------------------------------------------*/
	
	function delete_news_letter_list()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						    $database = 'news_letter_list';
								$this->db->where('NEWS_ID',$_POST['serviceid']);	
        						$this->db->delete($database);
    							
    							$response=array('status' => 200,'message' => 'ok');
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}

	/*-------------------- end news letter ------------------------------------------------*/



    /*--------------------- start menu status  --------------------------------------------*/
	
	function update_menu_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						    $database = 'fixed_menu';
						        
						     $menulist =   $this->db->get_where($database,['FM_ID'=>$_POST['menuid']])->row();
						    if($menulist->FM_STATUS == 0){
						        $status = '1';
						    }else{
						         $status = '0';
						    }
						    $data = array(
						                    'FM_STATUS'=>$status,
						                );
						    
								$this->db->where('FM_ID',$_POST['menuid']);	
        						$this->db->update($database,$data);
    							
    							$response=array('status' => 200,'message' => 'ok');
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}

	/*-------------------- end menu status ------------------------------------------------*/
 
 
 /*-------------------- start brand name--------------------------------*/
    public function update_brand()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			
       
				/*-------------start image --------------*/
					
							    $banner=$_FILES['fileToUpload']['name']; 
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
										
										
								}
							    if ($_FILES['fileToUpload']['name']) {
									$arr2 = array(
													 'brand_image'=>$upload_nm,
												);
								}else{
									$arr2 = array(
												);
								}

								$data=array(
									'brand_name'=>$_POST['brand_name'],
									
								);
								$arr3 = array_merge($arr2,$data);
							    
							   	$this->db->where('id',$this->input->post('updatebrandid'));
								$this->db->update('brand',$arr3);
								$response=array('status' => 200,'message' => 'ok');	
						
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}
 
 
 
 /*----------------------- end brand name-----------------------------*/
 
 /*------------------- start remove brand ---------------------------------------*/
    function remove_brand()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'brand';
					$this->db->where('id',$_POST['linkid']);
					$this->db->delete($database);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
 
 
    function remove_occupation()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'business_list';
					$this->db->where('BUSSINESS_ID',$_POST['linkid']);
					$this->db->delete($database);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
 
 
 /*--------------------- end remove brand ---------------------------------------*/
 
 /*--------------------------- start update color setting -----------------------*/
  function update_color()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'color_setting';
					$this->db->where('CS_ID',$_POST['id']);
					$this->db->update($database,['CS_COLOR'=>$_POST['color_name']]);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
    
    
    function update_background_color()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'color_setting';
						
						
					$this->db->where('CS_ID',$_POST['id']);
                    $this->db->update($database,['CS_CODE'=>$_POST['color_name']]);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	function update_background_hover_color()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'color_setting';
					
					$this->db->where('CS_ID',$_POST['id']);
					$this->db->update($database,['CS_BACKGROUN_HOVER'=>$_POST['color_name']]);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	function update_hover_color()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'color_setting';
					
					$this->db->where('CS_ID',$_POST['id']);
					$this->db->update($database,['CS_FONT_HOVER'=>$_POST['color_name']]);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
 
 /*----------------  end update color setting ----------------------------*/
 


/*-------------------- start update category name--------------------------------*/
    public function update_category()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			
       
				/*-------------start image --------------*/
					
							$banner=$_FILES['fileToUpload']['name']; 
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
										
										
								}
							    if ($_FILES['fileToUpload']['name']) {
									$arr2 = array(
													 'CAT_IMAGE'=>$upload_nm,
												);
								}else{
									$arr2 = array(
												);
								}

								$data=array(
									'CATEGORY_NAME'=>$_POST['category_name'],
									
								);
								$arr3 = array_merge($arr2,$data);
							    
							   	$this->db->where('CAT_ID',$this->input->post('update_category_id'));
								$this->db->update('categorylist',$arr3);
								$response=array('status' => 200,'message' => 'ok');	
						
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}
 
 
 
 /*----------------------- end update category name-----------------------------*/
 
 /*------------------- start category  ---------------------------------------*/
    function remove_category()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'categorylist';
					$this->db->where('CAT_ID',$_POST['linkid']);
					$this->db->delete($database);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
 
 
 
 /*--------------------- end category ---------------------------------------*/







/*-------------------- start update sub category name--------------------------------*/
    public function update_sub_category()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			
       
				/*-------------start image --------------*/
					
							$banner=$_FILES['fileToUpload']['name']; 
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
										
										
								}
							    if ($_FILES['fileToUpload']['name']) {
									$arr2 = array(
													 'IMAGE'=>$upload_nm,
												);
								}else{
									$arr2 = array(
												);
								}

								$data=array(
									'SUB_CAT_NAME'=>$_POST['sub_category_name'],
									
								);
								$arr3 = array_merge($arr2,$data);
							    
							   	$this->db->where('SUB_CAT_ID',$this->input->post('update_sub_category_id'));
								$this->db->update('sub_cat',$arr3);
								$response=array('status' => 200,'message' => 'ok');	
						
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}
 
 
 
 /*----------------------- end update sub category name-----------------------------*/
 
 /*------------------- start sub category  ---------------------------------------*/
    function remove_sub_category()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'sub_cat';
					$this->db->where('SUB_CAT_ID',$_POST['linkid']);
					$this->db->delete($database);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
 
 
 
 /*--------------------- end sub category ---------------------------------------*/













/*-------------------- start update product name--------------------------------*/
    public function update_product_list()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			
       
				/*-------------start image --------------*/
					
							$banner=$_FILES['fileToUpload']['name']; 
								$file_size = $_FILES['fileToUpload']['size'];
								$expbanner=explode('.',$banner);
								$allowed_format = array('jpg','jpeg','png');	
								if(in_array(strtolower(end($expbanner)),$allowed_format)){	
										$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
										$full_file_name = uniqid().".".end($expbanner);		
										$uploadfile = $uploaddir.$full_file_name;
									
										$upload_nm=$full_file_name;
										move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);	//for moving image 		
										
										
								}
							    if ($_FILES['fileToUpload']['name']) {
									$arr2 = array(
													 'IMG_1'=>$upload_nm,
												);
								}else{
									$arr2 = array(
												);
								}

								$data=array(
									'PRODUCT_NAME'=>$_POST['product_name'],
									
								);
								$arr3 = array_merge($arr2,$data);
							    
							   	$this->db->where('PRODUCT_ID',$this->input->post('update_product_id'));
								$this->db->update('product',$arr3);
								$response=array('status' => 200,'message' => 'ok');	
						
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}
 
 
 
 /*----------------------- end update product name-----------------------------*/
 
 /*------------------- start remove product list   ---------------------------------------*/
    function remove_product()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'product';
					$this->db->where('PRODUCT_ID',$_POST['linkid']);
					$this->db->delete($database);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
 
 
 
 /*--------------------- end remove product list ---------------------------------------*/

/*---------------- start update frontend setting---------------------------------------*/

    function update_frontend()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'front_setting';
						
					
						
					$this->db->where('FB_ID',$_POST['id']);
					$this->db->update($database,['FB_ORDER'=>$_POST['order']]);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
    
    function show_hide_frontend()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'front_setting';
					
					$row = 	$this->db->get_where($database,['FB_ID'=>$_POST['id']])->row();
					if($row->FB_SHOW_HIDE == 0){
					    $status = 1;
					}else{
					    $status = 0;
					}	
					
					$arr = array(
					            'FB_SHOW_HIDE' => $status
					            );
					
					
					
					$this->db->where('FB_ID',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}




/*---------------------- end update frontend setting ----------------------------------*/


/*--------------------- start update backend setting ------------------------------------*/

    function update_back_end()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'backend_setting';
					
				// 	$row = 	$this->db->get_where($database,['BACK_END_ID'=>$_POST['id']])->row();
				// 	if($row->FB_SHOW_HIDE == 0){
				// 	    $status = 1;
				// 	}else{
				// 	    $status = 0;
				// 	}	
					
					$arr = array(
					            'BACK_END_TITLE' => $_POST['name'],
					            );
					
					
					
					$this->db->where('BACK_END_ID',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    
    function update_back_end_order()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'backend_setting';
					
				// 	$row = 	$this->db->get_where($database,['BACK_END_ID'=>$_POST['id']])->row();
				// 	if($row->FB_SHOW_HIDE == 0){
				// 	    $status = 1;
				// 	}else{
				// 	    $status = 0;
				// 	}	
					
					$arr = array(
					            'BACK_END_ORDER' => $_POST['order'],
					            );
					
					
					
					$this->db->where('BACK_END_ID',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    function update_back_end_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'backend_setting';
					
					$row = 	$this->db->get_where($database,['BACK_END_ID'=>$_POST['id']])->row();
					if($row->BACK_END_SHOW_HIDE == 0){
					    $status = 1;
					}else{
					    $status = 0;
					}	
					
					$arr = array(
					            'BACK_END_SHOW_HIDE' => $status,
					            );
					$this->db->where('BACK_END_ID',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}


/*----------------------- end update backend setting-------------------------------*/

/*------------------- start update menu ---------------------------------------------------------------------------------*/
    
    function update_menu_name()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'front_cms_menu_items';
					$arr = array(
					            'menu' => $_POST['name'],
					            );
					
					
					
					$this->db->where('id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    
    function update_menu_order()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'front_cms_menu_items';
					
					$arr = array(
					            'position' => $_POST['order'],
					            );
					
					
					
					$this->db->where('id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    function update_menu_backend_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'front_cms_menu_items';
					
					$row = 	$this->db->get_where($database,['id'=>$_POST['menuid']])->row();
					if($row->MENU_STATUS == 0){
					    $status = 1;
					}else{
					    $status = 0;
					}	
					
					$arr = array(
					            'MENU_STATUS' => $status,
					            );
					$this->db->where('id',$_POST['menuid']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    
    

/*---------------------- end update menu name ----------------------------------------------------------------------------*/


/*------------------- start update sub menu ---------------------------------------------------------------------------------*/
    
    function update_sub_menu_name()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'submenu';
					$arr = array(
					            'submenu' => $_POST['name'],
					            );
					
					$this->db->where('id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    
    function update_sub_menu_order()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'submenu';
					
					$arr = array(
					            'MENU_ORDER' => $_POST['order'],
					            );
					
					
					
					$this->db->where('id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    function update_sub_menu_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'submenu';
					
					$row = 	$this->db->get_where($database,['id'=>$_POST['id']])->row();
					if($row->BACK_END_SHOW_HIDE == 0){
					    $status = 1;
					}else{
					    $status = 0;
					}	
					
					$arr = array(
					            'MENU_STATUS' => $status,
					            );
					$this->db->where('id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}

    
    
    

/*---------------------- end update sub menu name ----------------------------------------------------------------------------*/
	function delete_page()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						$database = 'page';
							$this->db->where('id',$_POST['id']);
							$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
    
    
    
    
    
    function update_link_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'front_cms_menu_items';
					
					$arr = array(
					            'ext_url_link' => $_POST['link'],
					            );
					
					
					
					$this->db->where('id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}



    function remove_delete_banner_list()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						$database = 'promotional_add';
							$this->db->where('PROMOTION_ID',$_POST['id']);
							$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


public function save_position()
    {
        $menu = $this->input->post('data');
       
        $data = isset($_REQUEST['data'])? $_REQUEST['data'] : '';
       
        //print_r($data);
        

        parse_str($data, $arr);
        if (isset($arr['list'])) {
	        array_walk($arr['list'], function(&$val, $key){
	            //$this->m_menu->UpdatePosisiMenu(['menu_parent' => $val, 'updated' => date('Y-m-d H:i:s')], $key);

	        	// $x = array(
	        	// 			'' => , );

	        	$this->db->where('id',$key);
	        	$this->db->update('front_cms_menu_items',['parent_id'=>$val]);
	        	
	        	//$x = 'Parent ='.$val.'+ Child '.$key.' ,';
	        	//print_r($x);

	        });
	        $status['success'] = true;
	    }


        // if (!empty($menu)) {
        //     //adodb_pr($menu);
        //     $menu = $this->input->post('data');
            

        //     //print_r($menu);
        //     foreach ($menu as $k => $v) {
        //         if ($v == 'null') {
        //             $menu2[0][] = $k;
        //         } else {
        //             $menu2[$v][] = $k;
        //         }
        //     }
        //     $success = 0;
        //     if (!empty($menu2)) {
        //         foreach ($menu2 as $k => $v) {
        //             $i = 1;
        //             foreach ($v as $v2) {
        //                 $data['parent_id'] = $k;
        //                 $data['position'] = $i;
        //                 if ($this->db->update('menu', $data, 'id' . ' = ' . $v2)) {
        //                     $success++;
        //                 }
        //                 $i++;
        //             }
        //         }
        //     }
        // }
    }

    public function old_save_position()
    {
        if (isset($_POST['easymm'])) {
            $easymm = $_POST['easymm'];
            $this->update_position(0, $easymm);
        }
    }

    private function update_position($parent, $children)
    {
        $i = 1;
        print_r($children);
        foreach ($children as $k => $v) {
            $id = (int)$children[$k]['id'];
            $data[MENU_PARENT] = $parent;
            $data[MENU_POSITION] = $i;
            $this->db->update(MENU_TABLE, $data, MENU_ID . ' = ' . $id);
            if (isset($children[$k]['children'][0])) {
                $this->update_position($id, $children[$k]['children']);
            }
            $i++;
        }
    }


    public function UpdatePosisiMenu() {
        $data = isset($_REQUEST['data'])? $_REQUEST['data'] : '';
        $status = ['success' => false];
        parse_str($data, $arr);
        if (isset($arr['list'])) {
            array_walk($arr['list'], function(&$val, $key){
                
                $this->update_position(['menu_parent' => $val, 'updated' => date('Y-m-d H:i:s')], $key);
    
             
    
            });
            $status['success'] = true;
        }
        echo json_encode($status);
    }




    function delete_blog()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					$database = 'blogs';
							$this->db->where('BLOG_ID',$_POST['delete_blog_id']);
							$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


    
    function update_student_active_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					$database = 'students';
					
					   $student =  $this->db->get_where('students',['id'=>$_POST['studentid']])->row();
					    if($student->pay_status ==1){
					      $data= array(
					      
					           'pay_status' => 2,
					        );
					    }
					    elseif($student->pay_status ==0){
					       $data= array(
					      
					           'pay_status' => 2,
					         );
					    }elseif($student->pay_status ==2){
					       $data= array(
					      
					           'pay_status' => 1,
					         );
					    }
					
					
							$this->db->where('id',$_POST['studentid']);
							$this->db->update($database,$data);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
    
    // approve/cancel status
    function update_pending_student_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					$database = 'students';
					
					   $student =  $this->db->get_where('students',['id'=>$_POST['studentid']])->row();
					    if($student->pay_status ==0){
					      $data= array(
					      
					           'pay_status' => $_POST['studentstatus'],
					        );
					    }
					    
					
					
							$this->db->where('id',$_POST['studentid']);
							$this->db->update($database,$data);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
    
    function add_result()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
				
				        $st_enr =  $this->db->get_where('students',['enrollment_no'=>$_POST['enrollment_no'] ])->row();
				        // print_r($_POST);
                	$chk = $this->db->query("SELECT * FROM results where roll_no = '".$_POST['roll_no']."' OR enrollment_no = '".$_POST['enrollment_no']."'");
                	if(!($chk->num_rows))
                	{
                	    //$qr = photo_upload('qr','qr');
                	    
                	    
                	    
                	    $banner=$_FILES['qr']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['qr']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["qr"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}  
                	    
                	    
                	    
                	    
                	    
                	    
                	    
                	    
                		$this->db->query("INSERT INTO `results` (`id`, `timestamp`, `roll_no`, `course_id`, `result`, `enrollment_no`, `center_id`, `qr_code`) VALUES ('', CURRENT_TIMESTAMP, '".$_POST['roll_no']."', '".$_POST['course_id']."', '".$_POST['result']."', '".$_POST['enrollment_no']."', '".$st_enr->center_id."', '".$upload_nm."')");
                		$id = $this->db->insert_id();
                		
                		$sub = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."'")->result();
                		foreach($sub as $s){
                	
                			$this->db->query("INSERT INTO `marks_table` (`id`, `timestamp`, `result_id`, `marks`, `subject_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$id."', '".$_POST['course_id'].'_'.$s->id."', '".$s->id."')");
                		}
                 	
                	}
				
				
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
	function delete_certificate()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
			        $data=array(
			            'status'=>0,
			            );
					$this->db->trans_begin();
					$database = 'student_certificate';
					$this->db->where('enrollment_no',$_POST['enroll_no']);
					$this->db->delete($database);
					$this->db->where('enrollment_no',$_POST['enroll_no']);
					$this->db->update('results',$data);
					if ($this->db->trans_status() === FALSE)
                    {
                            $this->db->trans_rollback();
                    }
                    else
                    {
                            $this->db->trans_commit();
                    }
					
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	
	
	function test_result(){
	    $enrollment = 1234;
$name = 'ajay';
$father = 'father';
$course_name = 'BCA';

$center_name = 'center';
	$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/temp/';
    $text = 'Enrollment :'.$enrollment.'
            Student name :'.$name.'
            Father name :'.$father.'
            Course name :'.$course_name.'
            Center name :'.$center_name.'
        ';
	$text1= substr($text, 0,9);
	$folder = $SERVERFILEPATH;
	$file_name1 = $enrollment."-Qrcode" . rand(2,200) . ".png";
	$file_name = $folder.$file_name1;
	@QRcode::png($text,$file_name);
    $uploadfile = $SERVERFILEPATH.$file_name1;
			move_uploaded_file($file_name1, $uploadfile);
	}
	
	function remove_result()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					$this->db->trans_begin();
					$database = 'results';
					$this->db->where('id',$_POST['id']);
					$this->db->delete($database);
					$this->db->where('result_id',$_POST['id']);
					$this->db->delete('marks_table');
					if ($this->db->trans_status() === FALSE)
                    {
                            $this->db->trans_rollback();
                    }
                    else
                    {
                            $this->db->trans_commit();
                    }
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
// 	create result
	function create_result()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					if(empty($_POST['result_id'])){
	                    $chk = $this->db->query("SELECT * FROM results where enrollment_no = '".$_POST['enrollment_no']."'");
	                        if(empty($chk->num_rows))
                        	{
	 	
					$enr = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."'")->row();
					$cou = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
					$center = $this->db->query("SELECT * FROM centers where id = '".$_POST['center_id']."'")->row();
					$enrollment=$_POST['enrollment_no'];
					$name=$enr->name;
					$father=$enr->father;
					$course_name=$cou->course_name;
					$center_name=$center->institute_name;
					$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/temp/';
				    $text = 'Enrollment :'.$enrollment.'
				            Student name :'.$name.'
				            Father name :'.$father.'
				            Course name :'.$course_name.'
				            Center name :'.$center_name.'
				        ';
					$text1= substr($text, 0,9);
					$folder = $SERVERFILEPATH;
					$file_name1 = $enrollment."-Qrcode" . rand(2,200) . ".png";
					$file_name = $folder.$file_name1;
					@QRcode::png($text,$file_name);
				    $uploadfile = $SERVERFILEPATH.$file_name1;
							move_uploaded_file($file_name1, $uploadfile);
			
						if(empty($_POST['year'])){
						  $year= 0 ;
						}else{
						   $year =$_POST['year'];
						}
		$this->db->query("INSERT INTO `results` (`id`, `timestamp`, `roll_no`, `course_id`, `result`, `enrollment_no`, `center_id`,qr_code,year) VALUES (NULL, CURRENT_TIMESTAMP, '".$_POST['roll_no']."', '".$_POST['course_id']."', '".$_POST['result']."', '".$_POST['enrollment_no']."', '".$_POST['center_id']."', '".$file_name1."', '".$year."')");
		 $id = $this->db->insert_id();
		//$id = $con->insert_id;
	            	$sub = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' and year = '".$_POST['year']."'")->result();
		                $theory_marks=0;
		                $practic_marks=0;
        		        $max_t_marks=0;
        		        $max_p_marks=0;
        		        $max_marks=0;
        		        $obt_marks=0;
        		        $practical_marks=0;
        		        $marks=0;
        	            foreach($sub as $s){
        		    //echo $_POST[$s['course_id']..$s->id];
        		    if(empty($_POST[$s->course_id.'_'.$s->id.$s->id])){
        		        $practical_marks=0;
        		    }else{
        		        $practical_marks=$_POST[$s->course_id.'_'.$s->id.$s->id];
        		    }
        		    if(empty($_POST[$s->course_id.'_'.$s->id])){
        		        $marks=0;
        		    }else{
        		        $marks=$_POST[$s->course_id.'_'.$s->id];
        		    }
        		       
        		        $data = array(
        		                    
        		                        'result_id'=> $id,
        		                        'marks'=>  $marks,
        		                        'subject_id' => $s->id,
        		                        'practical_marks' => $practical_marks,
        		                        'year' => $year,
        		                        
        		                    );
        		      //print_r($data);  
        		      
        		      $this->db->insert('marks_table',$data);
        		        
        		        $practic_marks+=@$practical_marks;
        		        $theory_marks+=@$marks;
        		        $obt_marks=@$theory_marks+@$practic_marks;
        		        
        		        
        		        $max_t_marks+=@$s->max_marks;
        		        $max_p_marks+=@$s->practical_max_marks;
        		        $max_marks=@$max_t_marks+@$max_p_marks;
        		        $per=(@$obt_marks/@$max_marks)*100;
        		        if($per<=33){
        		            $division='fail';
        		        }else{
        		            $division='pass';
        		        }
        		               
        			//$this->db->query("INSERT INTO `marks_table` (`id`, `timestamp`, `result_id`, `marks`, `subject_id`) VALUES (NULL, CURRENT_TIMESTAMP, '".$id."', '".$_POST['course_id'].'_'.$s->id."', '".$s->id."')");
        		}
		             $data2=array(
        		          'result'=>$division,
        		          'percentage'=>$per,
        		          'max_marks'=>$max_marks,
        		          'obt_marks'=>$obt_marks,
        		         );
		             $this->db->where('id',$id);
		              $this->db->update('results',$data2);
		$response=array('status' => 200,'message' => 'Result successfully created');  
// 		echo '<script>alert("Result successfully create.");location.href="'.site_url('admin/create_result').'"</script>';
	}else{
	    $response=array('status' => 400,'message' => 'Result of this roll no already created');  
	   // echo '<script>alert("Result of this roll no already  created.");location.href="'.site_url('admin/create_result').'"</script>';
	}
}else{
    
					$enr = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."'")->row();
					$cou = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
					$center = $this->db->query("SELECT * FROM centers where id = '".$_POST['center_id']."'")->row();
    
                    $enrollment=$_POST['enrollment_no'];
					$name=$enr->name;
					$father=$enr->father;
					$course_name=$cou->course_name;
					$center_name=$center->institute_name;
					$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/temp/';
				    $text = 'Enrollment :'.$enrollment.'
				            Student name :'.$name.'
				            Father name :'.$father.'
				            Course name :'.$course_name.'
				            Center name :'.$center_name.'
				        ';
					$text1= substr($text, 0,9);
					$folder = $SERVERFILEPATH;
					$file_name1 = $enrollment."-Qrcode" . rand(2,200) . ".png";
					$file_name = $folder.$file_name1;
					@QRcode::png($text,$file_name);
				    $uploadfile = $SERVERFILEPATH.$file_name1;
							move_uploaded_file($file_name1, $uploadfile);
							if(empty($_POST['year'])){
						  $year= 0 ;
						}else{
						   $year =$_POST['year'];
						}
						
                        $data = array(
		                        'roll_no'=> $_POST['roll_no'],
		                        'course_id'=>  $_POST['course_id'],
		                        'result' => $_POST['result'],
		                        'enrollment_no' => $_POST['enrollment_no'],
		                        'center_id' => $_POST['center_id'],
		                        'qr_code'=>$file_name1,
		                        'year'=>$year,
		                        
		                    );
		                    $this->db->where('id',$_POST['result_id']);
	                    	$this->db->update('results',$data);
	                    	$sub = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' and year = '".@$_POST['year']."'")->result();
                            // $sub = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."'")->result();
                            $theory_marks=0;
	                	    $practic_marks=0;
		                    $max_t_marks=0;
		                    $max_p_marks=0;
		                    $max_marks=0;
		                    $obt_marks=0;
		                    foreach($sub as $s){
		    //echo $_POST[$s['course_id']..$s->id];
		                 if(empty($_POST[$s->course_id.'_'.$s->id.$s->id])){
		                         $practical_marks=0;
		                   }else{
		                           $practical_marks=$_POST[$s->course_id.'_'.$s->id.$s->id];
		                  }
		                  if(empty($_POST[$s->course_id.'_'.$s->id])){
        		                 $marks=0;
        		            }else{
        		                   $marks=$_POST[$s->course_id.'_'.$s->id];
        		             }
		                   $data2 = array(
		                        'result_id'=> $_POST['result_id'],
		                        'marks'=>  $_POST[$s->course_id.'_'.$s->id],
		                        'subject_id' => $s->id,
		                        'practical_marks' => $practical_marks,
		                        'year'=>$year,
		                        
		                    );
                    		$this->db->where('subject_id',$s->id);
                    		$this->db->where('result_id',$_POST['result_id']);
                    		$this->db->update('marks_table',$data2);
                    		        $practic_marks+=@$practical_marks;
                    		        $theory_marks+=@$marks;
                    		        $obt_marks=@$theory_marks+@$practic_marks;
                    		         $max_t_marks+=@$s->max_marks;
                    		        $max_p_marks+=@$s->practical_max_marks;
                    		        $max_marks=@$max_t_marks+@$max_p_marks;
                    		        $per=(@$obt_marks/@$max_marks)*100;
                    		        if($per<=33){
                    		            $division='fail';
                    		        }else{
                    		            $division='pass';
                    		        }
                    		 	$response=array('status' => 200,'message' => 'Result updated');     
		                  //  	echo '<script>alert("Result updated create.");location.href="'.site_url('admin/create_result/').$this->uri->segment(3).'"</script>';
}
                                $data3=array(
                    		          'result'=>$division,
                    		          'percentage'=>$per,
                    		          'max_marks'=>$max_marks,
                    		          'obt_marks'=>$obt_marks,
                    		          );
                    		          $this->db->where('id',$_POST['result_id']);
                    		          $this->db->update('results',$data3);
}
				
					
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	
	
	
	public function update_result(){
	    
	    $method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
				// 	$database = 'admit_card';
				// 	$this->db->where('id',$_POST['id']);
				// 	$this->db->delete($database);
				
				$total_marks = '0';
				
				$result =     $this->db->query("SELECT * FROM `marks_table` WHERE `result_id` LIKE '".$_POST['result_id']."'")->result();
				foreach($result as $result_list){
				               
				    $new_marks = 'marks_'.$result_list->id.'';
				    
				     $obtained_marks = $_POST[$new_marks];
				    
				    if($result_list->practical_marks > 0){
				        $data = array(
				                'marks' => 0,
				                'practical_marks' =>$obtained_marks, 
				        );
				    }else{
				        $data = array(
				                'marks' => $obtained_marks,
				                'practical_marks' =>0, 
				        );
				    }
				    
				    
				    
				    
				    $this->db->where('id',$result_list->id);
				    $this->db->update('marks_table',$data);
				    
				    $total_marks = $total_marks + $obtained_marks;
				    
				}
				
				$this->db->where('id',$_POST['result_id']);
				$this->db->update('results',['obt_marks'=>$total_marks]);	
					
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	    
	}
	
	
	
	
	
	function delete_admit_card()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					$database = 'admit_card';
					$this->db->where('id',$_POST['id']);
					$this->db->delete($database);
					
					
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	
	
	function upload_certificates()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
				
                	    
                	    $banner=$_FILES['fileToUpload']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['fileToUpload']['size'];
                        	$expbanner=explode('.',$banner);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name = uniqid().".".end($expbanner);		
                    			$uploadfile = $uploaddir.$full_file_name;
                    			$upload_nm=$full_file_name;
                				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);
						}else{
							$upload_nm = '';
						}  
            	    
                	   $data1 = array(
                	                   'enrollment_no' => $_POST['roll_no'],
                	                    ); 
                	   $data2 = array(
                	                   'file' => $upload_nm,
                	                    );
                	   
                	   $data = array_merge($data1,$data2);
				    
				        $this->db->insert('certificates',$data);
				    
				
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
	
	
	function delete_cerficate_list()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					$database = 'certificates';
					$this->db->where('id',$_POST['id']);
					$this->db->delete($database);
					
					
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	
	


	
    
    
    function add_subject_marks()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
				    	$chk = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' AND subject_name = '".$_POST['subject_name']."'");
				    
				    /*
				    	if(empty($_POST['practical_min_marks'])){
				    	    $practical_min_marks='';
				    	}else{
				    	    $practical_min_marks=$_POST['practical_min_marks'];
				    	}
				    	if(empty($_POST['practical_max_marks'])){
				    	    $practical_max_marks='';
				    	}else{
				    	    $practical_max_marks=$_POST['practical_max_marks'];
				    	}
                    */	
                    	
                    	if($_POST['practical'] == 0){
                    	    $theory_max = $_POST['max_marks'];
                    	    $theory_min = $_POST['min_marks'];
                    	    
                    	    $practical_max_marks = '0';
                    	    $practical_min_marks = '0';
                    	}else if($_POST['practical'] == 1){
                    	    $theory_max = '0';
                    	    $theory_min = '0';
                    	    
                    	    $practical_max_marks = $_POST['practical_max_marks'];
                    	    $practical_min_marks = $_POST['practical_min_marks'];
                    	}else{
                    	    $theory_max = $_POST['max_marks'];
                    	    $theory_min = $_POST['min_marks'];
                    	    
                    	    $practical_max_marks = $_POST['practical_max_marks'];
                    	    $practical_min_marks = $_POST['practical_min_marks'];
                    	}
                    	
                    	
                    	
                    	
                    	    $data = array(
                    	                'year' => $_POST['year'],
                    	                'course_id' =>$_POST['course_id'],
                    	                'subject_name' => $_POST['subject_name'],
                    	                'max_marks' => $theory_max,
                    	                'min_marks' => $theory_min,
                    	                'practical' => $_POST['practical'],
                    	                'practical_min_marks' => $practical_min_marks,
                    	                'practical_max_marks' => $practical_max_marks,
                    	                'SUBJECT_CODE' => $_POST['subject_code'],
                    	                );
                        /*
                    
                        if(!($chk->num_rows() > 1))
                    	{
                           
                    	}else{

                            
                    	    $data = array(
                    	                'year' => $_POST['year'],
                    	                'course_id' =>$_POST['course_id'],
                    	                'subject_name' => $_POST['subject_name'],
                    	               // 'max_marks' => $_POST['max_marks'],
                    	               // 'min_marks' => $_POST['min_marks'],
                    	                'max_marks' => $theory_max,
                    	                'min_marks' => $theory_min,
                    	                'practical' => $_POST['practical'],
                    	                'practical_min_marks' => $practical_min_marks,
                    	                'practical_max_marks' => $practical_max_marks,
                    	                'SUBJECT_CODE' => $_POST['subject_code'],
                    	                );
                        
                        
                        
                    	  
                    	}
					    
					    */
					
					
					    if($this->input->post('id')!= ''){
                            $this->db->where('id',$_POST['id']);
                	        $this->db->update('subjects',$data);
                    	    
                    	    $response=array('status' => 200,'message' => 'Already Exists');
                        }else{
                            $this->db->insert('subjects',$data);
            	            $response=array('status' => 200,'message' => 'ok');
                        }
					
					
					
					
				 	
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	


    function delete_subjects()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					
					
					    $this->db->where('id',$_POST['id']);
					    $this->db->delete('subjects');
				    	    
                    	    $response=array('status' => 200,'message' => 'ok');
                    	
					
				 	
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	function center_registration()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					
					
					$banner=$_FILES['image']['name']; 
					$upload_nm = 0;
                    if($banner!=''){
                        	$file_size = $_FILES['image']['size'];
                        	$expbanner=explode('.',$banner);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}
                    }
                    
                    
                    
                    $profile=$this->db->get('profile')->row();
                    $prefix=$profile->CENTER_PREFIX;
                    $time=time();
                    $centerid = $prefix.''.$time;
                    // die(var_dump($prefix,$time,$centerid));
	               $data = array(
                        
                       'center_number' => $centerid,
                       'name' => $_POST['name'],
                        'institute_name' => $_POST['institute_name'],
                        'dob' => $_POST['dob'],
                        'pan_number' => $_POST['pan_number'],
                        'image' =>$upload_nm,
                        'aadhar_number' => $_POST['aadhar_number'],
						'center_full_address' => $_POST['center_full_address'],
						'no_of_class_room'=>$_POST['no_of_class_room'],
						'state_id'=>$_POST['state_id'],
						'city_id'=>$_POST['district_id'],
						'city_name'=>$_POST['city_name'],
						'no_of_computer_operator'=>$_POST['computer_lab'],
						'total_computer' => $_POST['total_computer'],
						'space_of_computer_center' =>$_POST['seat_capacity'],
						'pincode' =>$_POST['pincode'],
						'contact_number' =>$_POST['contact_number'],
						'email_id' =>$_POST['email_id'],
						'qualification_of_center_head' =>$_POST['qualification_of_center_head'],
						'staff_room' =>$_POST['staff_room'],
						'water_supply' => $_POST['water_supply'],
						'toilet' => $_POST['toilet'],
						'reception' => $_POST['reception'],
						'whatsapp_number' => $_POST['whatsapp_number'],
						'username' => $centerid,
						'password' => md5($_POST['password']),
				// 		'frenchisee_id' => $_SESSION['userid'],
					   'status'=>1,
					   'first_aid'=>$_POST['first_aid'],
					   'center_password' => $_POST['password']
                       
                    //   'date'=>date('Y-m-d H:i:s'),
                   );
                    if ($upload_nm) {
						$arr1 = array(
										 'image' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									);
					}
                
                $arr3 = array_merge($arr1,$data);	   
                   	//print_r($arr3);
            if($_POST['center_id']==''){
				$this->db->insert('centers',$arr3);
				// die('inserted');
				$response['status'] = 200;
                $response['message'] = 'inserted';
                json_output($response['status'], $response);
            }else{
                // die('updated');
                // die(var_dump($_POST['center_number']));
                
                $data2 = array(
                        
                       'center_number' => $_POST['center_number'],
                       'name' => $_POST['name'],
                        'institute_name' => $_POST['institute_name'],
                        'dob' => $_POST['dob'],
                        'pan_number' => $_POST['pan_number'],
                        // 'image' =>$upload_nm,
                        'aadhar_number' => $_POST['aadhar_number'],
						'center_full_address' => $_POST['center_full_address'],
						'no_of_class_room'=>$_POST['no_of_class_room'],
						'state_id'=>$_POST['state_id'],
						'city_id'=>$_POST['district_id'],
						'city_name'=>$_POST['city_name'],
						'no_of_computer_operator'=>$_POST['computer_lab'],
						'total_computer' => $_POST['total_computer'],
						'space_of_computer_center' =>$_POST['seat_capacity'],
						'pincode' =>$_POST['pincode'],
						'contact_number' =>$_POST['contact_number'],
						'email_id' =>$_POST['email_id'],
						'qualification_of_center_head' =>$_POST['qualification_of_center_head'],
						'staff_room' =>$_POST['staff_room'],
						'water_supply' => $_POST['water_supply'],
						'toilet' => $_POST['toilet'],
						'reception' => $_POST['reception'],
						'username' => $centerid,
						'password' => md5($_POST['password']),
				// 		'frenchisee_id' => $_SESSION['userid'],
					   'status'=>1,
					   'first_aid'=>$_POST['first_aid'],
					   'center_password' => $_POST['password']
                       
                    //   'date'=>date('Y-m-d H:i:s'),
                   );
                   $arr4 = array_merge($arr1,$data2);
                $this->db->where('id',$_POST['center_id']);
                $this->db->update('centers',$arr4);
                
                
                $response['status'] = 200;
                $response['message'] = 'updated';
                json_output($response['status'], $response);
            }
				
			$center = array(
			                'USER_NAME' => $_POST['center_number'],
			                'PASSWORD_VIEW' => $_POST['password'],    
			                'ADMIN_PASSWORD' => md5($_POST['password']),
			                'ADMIN_STATUS' => 0,
			                'COMPANY_HRM_TYPE' =>2, 
			                'COMPANY_ID' => 2,
			                );
			if($_POST['center_id']==''){
			
				$this->db->insert('admin_login',$center);
			
			}else{
			
                $this->db->where('USER_NAME',$_POST['center_number']);
                $this->db->update('admin_login',$center);
             
            }
			
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}


    
  
    
    public function student_registration()
    {
        // die('here');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
                    
                /*----------------- start signature -------------------------------------*/                    
                    $banner2=$_FILES['image2']['name']; 
                    if($banner2!=''){
                        	$file_size2 = $_FILES['image2']['size'];
    //                     	if ($file_size2 > (2*1024*1024)) {
    //         							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
    //         							return;
				// 			}
                        	$expbanner2=explode('.',$banner2);
                    		$allowed_format2 = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner2)),$allowed_format2)){	
                    			$uploaddir2 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name2 = uniqid().".".end($expbanner2);		
                    			$uploadfile2 = $uploaddir2.$full_file_name2;
                    			$upload_nm2=$full_file_name2;
                				move_uploaded_file($_FILES["image2"]["tmp_name"] , $uploadfile2);
						}else{
							$upload_nm2 = '';
						}
                    }
                /*------------------ end signature -----------------------------------------*/
/*------------------- start left thumb --------------------------------------
                $banner3=$_FILES['image3']['name']; 
                if($banner3!=''){
                    	$file_size3 = $_FILES['image3']['size'];
    //                 	if ($file_size3 > (2*1024*1024)) {
    //     							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
    //     							return;

				// 		}
                    	$expbanner3=explode('.',$banner3);
                		$allowed_format3 = array('jpg','jpeg','png');	
                		if(in_array(strtolower(end($expbanner3)),$allowed_format3)){	
                			$uploaddir3 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                			$full_file_name3 = uniqid().".".end($expbanner3);		
                			$uploadfile3 = $uploaddir3.$full_file_name3;
                			$upload_nm3=$full_file_name3;
            				move_uploaded_file($_FILES["image3"]["tmp_name"] , $uploadfile3);
					}else{
						$upload_nm3 = '';
					}
                }
/*-------------------- end left thumb---------------------------------------*/
			        $photo=$_FILES['photo']['name']; 
                    if($photo!=''){
                        	$file_size = $_FILES['photo']['size'];
                        		$file_size = $_FILES['tenth_marksheet']['size'];
    //                     	if ($file_size > (2*1024*1024)) {
    //         							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
    //         							return;

				// 			}

                        	$expbanner=explode('.',$photo);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["photo"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                    }
                    $tenth_marksheet=$_FILES['tenth_marksheet']['name']; 
                    if($tenth_marksheet!=''){
                        	$file_size = $_FILES['tenth_marksheet']['size'];
    //                     	if ($file_size > (2*1024*1024)) {
    //         							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
    //         							return;

				// 			}
                        	$expbanner=explode('.',$tenth_marksheet);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_tm=$full_file_name;

                				move_uploaded_file($_FILES["tenth_marksheet"]["tmp_name"] , $uploadfile);

						}else{

							$upload_tm = '';

						}
                    }
                    
                    
                    $twelve_marksheet=$_FILES['twelve_marksheet']['name']; 
                    if($tenth_marksheet!=''){
                        	$file_size = $_FILES['twelve_marksheet']['size'];
    //                     	if ($file_size > (2*1024*1024)) {
    //         							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
    //         							return;

				// 			}
                        	$expbanner=explode('.',$twelve_marksheet);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_twm=$full_file_name;

                				move_uploaded_file($_FILES["twelve_marksheet"]["tmp_name"] , $uploadfile);

						}else{

							$upload_twm = '';

						}
                    }
                      $graduation_marksheer=$_FILES['graduation_marksheer']['name']; 
                    if($graduation_marksheer!=''){
                        	$file_size = $_FILES['graduation_marksheer']['size'];
                        	$expbanner=explode('.',$graduation_marksheer);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_gm=$full_file_name;

                				move_uploaded_file($_FILES["graduation_marksheer"]["tmp_name"] , $uploadfile);

						}else{

							$upload_gm = '';

						}
                    }
                    $aadhar=$_FILES['aadhar']['name']; 
                    if($aadhar!=''){
                        	$file_size = $_FILES['aadhar']['size'];
                        	$expbanner=explode('.',$aadhar);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_ad=$full_file_name;

                				move_uploaded_file($_FILES["aadhar"]["tmp_name"] , $uploadfile);

						}else{

							$upload_ad = '';

						}
                    }
                    $graduation_degree=$_FILES['graduation_degree']['name']; 
                    if($graduation_degree!=''){
                        	$file_size = $_FILES['graduation_degree']['size'];
                        	$expbanner=explode('.',$graduation_degree);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_gd=$full_file_name;

                				move_uploaded_file($_FILES["graduation_degree"]["tmp_name"] , $uploadfile);

						}else{

							$upload_gd = '';

						}
                    }
                    $profile=$this->db->get('profile')->row();
                    $prefix=$profile->STUDENT_PREFIX;
                    $time=time();
                    
                    $centeridx = $prefix.''.$time;
                    // $centerid = $prefix.time();
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
					    $check_row=$check->row();
						$insert_id = 0;
						if($check->num_rows() > 0){
	                      //  json_output(400,array('status' => 420,'message' => 'Email or mobile is already registered.'));
	                        $insert_id=$check_row->id;
	                        $data4=array(
	                            'password_view' => $_POST['password'],
						        'password' => md5($_POST['password']),
	                            );
	                      //  return;
	                      $this->db->where('id',$insert_id);
	                      $this->db->update('user_registration',$data4);
						
						    
						}else{
						    $this->db->insert('user_registration',$data1);
	
		                  //  json_output(200,$response);
						}  
					
					
					
					
					$data = array(
                    
                       'enrollment_no' => $centerid,
                       'name' => $_POST['name'],
                        'gender' => $_POST['gender'],
                        'father' => $_POST['father'],
                        'mother' => $_POST['mother'],
                        
                        'dob' => $_POST['dob'],
						'mobile' => $_POST['phone_no'],
						'email'=>$_POST['email'],
						'state'=>$_POST['state'],
						'country'=>$_POST['country'],
						'distric'=>$_POST['district'],
				// 		'exam_pass' => $_POST['exam_pass'],
						'center_id' => $_POST['center_id'],
						'marks' =>$_POST['marks'],
						'board' =>$_POST['board'],
						'medium' =>$_POST['medium'],
						'year' =>$_POST['yop'],
						'username' =>$_POST['phone_no'],
						'password' =>$_POST['password'],
						'course_id' =>$_POST['course'],
						'center_id' => $_POST['center_id'],
						'address' => $_POST['Address'],
						'marrital_status'=>$_POST['marrital_status'],
					    //'status'=>1,
					   'marks' =>$_POST['marks'],
					   'user_id' => $insert_id,
				 		'category' =>$_POST['Academic'],
				 		//'disability	' =>$_POST['year'],
						'pay_status' =>0,
						'city' =>$_POST['city'],
						'pincode' =>$_POST['pincode'],
						'highest_qualification' => $_POST['Qualification'],
						'passing_year' => $_POST['yop'],
					    'institute_name' => $_POST['board'],
					    'blood_group' => $_POST['blood_group'],
					    'nationality' => $_POST['nationality'],
					    'addmission_date' => $_POST['admission_date'],
					    'reg_no' => $_POST['reg_no'],
					    'Batch' => $_POST['Batch'],
					    'session' => $_POST['Session'],
					    'occupation'=>$_POST['Occupation'],
					    'mother_tongue'=>$_POST['mother_tongue'],
					    'religion'=>$_POST['religion'],
					    'community'=>$_POST['community'],
					    'religion'=>$_POST['religion'],
					    'subject'=>$_POST['subject'],
					    //'signature' => $upload_nm2,
					   // 'left_thumb' => $upload_nm3,
                       //'date'=>date('Y-m-d H:i:s'),
                   );
            
                    if ($_FILES['photo']['name']) {
						$arr9 = array(
										 'photo' => $upload_nm,
									);
					}else{
						$arr9 = array(
									    );
					}
                    if ($_FILES['image2']['name']) {
						$arr1 = array(
										 'signature' => $upload_nm2,
									);
					}else{
						$arr1 = array(
									    );
					}
					
					/*
					if ($_FILES['image3']['name']) {
						$arr2 = array(
										 'left_thumb' => $upload_nm3,
									);
					}else{
						$arr2 = array(
									    );
					}
					
					*/
					
					if ($_FILES['tenth_marksheet']['name']) {
						$arr3 = array(
										 'tenth_marksheet' => $upload_tm,
									);
					}else{
						$arr3 = array(
									    );
					}
					
					if ($_FILES['twelve_marksheet']['name']) {
						$arr4 = array(
										'twelve_marksheet' => $upload_twm,
									);
					}else{
						$arr4 = array(
									    );
					}
					
					if ($_FILES['graduation_marksheer']['name']) {
						$arr5 = array(
										'graduation_marksheer' => $upload_gm,
									);
					}else{
						$arr5 = array(
									    );
					}
					
					if ($_FILES['graduation_degree']['name']) {
						$arr6 = array(
									'graduation_degree' => $upload_gd,
									);
					}else{
						$arr6 = array(
									    );
					}
					
					if ($_FILES['aadhar']['name']) {
						$arr7 = array(
									'aadhar' => $upload_ad,  
									);
					}else{
						$arr7 = array(
									    );
					}
					
					
		        $arr8 = array_merge($arr1,$arr3,$arr4,$arr5,$arr6,$arr7,$data,$arr9);    
       
            

			    if($this->input->post('enrollment_no') ){
        			$num = 	$this->db->query("SELECT * FROM `students` WHERE `enrollment_no` LIKE '".$_POST['enrollment_no']."'")->num_rows();
        			if($num > 0){
        			        if($_POST['studentid']!= ''){
        			            $this->db->where('id',$_POST['studentid']);
        			            $this->db->update('students',$arr8);
        			            $response['message'] = 'updated';
        			        }
        			    //
        			}else{
        			    $this->db->insert('students',$arr8);
        			    		                $insert_id=$this->db->insert_id();
			                $this->load->model('Paymentsetting_model','paymentM');
			                
						    $response=array('status' => 200,'message' => 'ok');
            			    if($this->paymentM->few_setting('active_payment') == 'yes'){
                			    
                				$this->load->library('pum');
                                $pum = $this->pum->init(PAYU_SALT,PAYU_KEY);
                                $return_url = base_url('payu/center_add_student_response');
                                $form = $pum->add_field('email',$data['email'])
                                            ->add_field('firstname',$data['name'])
                                            ->add_field('phone',$data['mobile'])
                                            ->add_field('udf1',$insert_id)
                                            ->add_field('amount',$this->paymentM->few_setting('student_fee'))
                                            ->add_field('surl',$return_url)
                                            ->add_field('furl',$return_url)
                                            ->submit_pum_ajax();
                                $response['FORM'] = $form;
            			    }
        			    $response['message'] = 'ok';
        			}	
		        }else{
		              $student= $this->db->query('select * from students where email ="'.$_POST['email'].'" and name ="'.$_POST['name'].'" and mobile ="'.$_POST['phone_no'].'"');
		              //$this->db->get_where('students',['email'=> $_POST['enroll_no'],])->row();
		              $student_num_rows=$student->num_rows();
                        if($student_num_rows>0){
                            foreach($student->result() as $row){
                                $course=    $this->db->get_where('courses',['id'=> @$row->course_id])->row();
                                $course_type=$course->type;
                                if($course_type==1){
                                  $duration='1';
                                }else{
                                  $duration=(int)$course->years;
                                  
                                }
                                $check=$this->db->query('select * from results where enrollment_no="'.@$row->enrollment_no.'" and course_id="'.@$row->course_id.'" and result="pass"')->num_rows();
                                if($check!=$duration){
                                  json_output(400,array('status' => 420,'message' => ' course is not completed yet'));
                                  return;
                                }else{
                                $this->db->insert('students',$arr8);
                                $insert_id=$this->db->insert_id();
        			                $this->load->model('Paymentsetting_model','paymentM');
        			                
        						    $response=array('status' => 200,'message' => 'ok');
                    			    if($this->paymentM->few_setting('active_payment') == 'yes'){
                        			    
                        				$this->load->library('pum');
                                        $pum = $this->pum->init(PAYU_SALT,PAYU_KEY);
                                        $return_url = base_url('payu/center_add_student_response');
                                        $form = $pum->add_field('email',$data['email'])
                                                    ->add_field('firstname',$data['name'])
                                                    ->add_field('phone',$data['mobile'])
                                                    ->add_field('udf1',$insert_id)
                                                    ->add_field('amount',$this->paymentM->few_setting('student_fee'))
                                                    ->add_field('surl',$return_url)
                                                    ->add_field('furl',$return_url)
                                                    ->submit_pum_ajax();
                                        $response['FORM'] = $form;
                    			    }
    			                $response['message'] = 'ok';
                              }
                            }
                        }else{
			             $this->db->insert('students',$arr8);
			             $insert_id=$this->db->insert_id();
			                $this->load->model('Paymentsetting_model','paymentM');
			                
						    $response=array('status' => 200,'message' => 'ok');
            			    if($this->paymentM->few_setting('active_payment') == 'yes'){
                			    
                				$this->load->library('pum');
                                $pum = $this->pum->init(PAYU_SALT,PAYU_KEY);
                                $return_url = base_url('payu/center_add_student_response');
                                $form = $pum->add_field('email',$data['email'])
                                            ->add_field('firstname',$data['name'])
                                            ->add_field('phone',$data['mobile'])
                                            ->add_field('udf1',$insert_id)
                                            ->add_field('amount',$this->paymentM->few_setting('student_fee'))
                                            ->add_field('surl',$return_url)
                                            ->add_field('furl',$return_url)
                                            ->submit_pum_ajax();
                                $response['FORM'] = $form;
            			    }
			             $response['message'] = 'ok';
                        }
			}	
					    
				
                $response['status'] = 200;
                
                json_output($response['status'], $response);
              if ($response['message'] == "ok") {
            }
    }










/*------------- start student update --------------------------------*/
    public function update_student_registration()
    {
        // die('here');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
                    
                /*----------------- start signature -------------------------------------*/                    
                    $banner2=$_FILES['image2']['name']; 
                    if($banner2!=''){
                        	$file_size2 = $_FILES['image2']['size'];
                            	$expbanner2=explode('.',$banner2);
                    		$allowed_format2 = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner2)),$allowed_format2)){	
                    			$uploaddir2 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name2 = uniqid().".".end($expbanner2);		
                    			$uploadfile2 = $uploaddir2.$full_file_name2;
                    			$upload_nm2=$full_file_name2;
                				move_uploaded_file($_FILES["image2"]["tmp_name"] , $uploadfile2);
						}else{
							$upload_nm2 = '';
						}
                    }
                /*------------------ end signature -----------------------------------------*/
			        $photo=$_FILES['photo']['name']; 
                    if($photo!=''){
                        	$file_size = $_FILES['photo']['size'];
                        		$file_size = $_FILES['tenth_marksheet']['size'];
                        	$expbanner=explode('.',$photo);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["photo"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                    }
                    $tenth_marksheet=$_FILES['tenth_marksheet']['name']; 
                    if($tenth_marksheet!=''){
                        	$file_size = $_FILES['tenth_marksheet']['size'];
                        	$expbanner=explode('.',$tenth_marksheet);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_tm=$full_file_name;

                				move_uploaded_file($_FILES["tenth_marksheet"]["tmp_name"] , $uploadfile);

						}else{

							$upload_tm = '';

						}
                    }
                    
                    $twelve_marksheet=$_FILES['twelve_marksheet']['name']; 
                    if($tenth_marksheet!=''){
                        	$file_size = $_FILES['twelve_marksheet']['size'];
                        	$expbanner=explode('.',$twelve_marksheet);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_twm=$full_file_name;

                				move_uploaded_file($_FILES["twelve_marksheet"]["tmp_name"] , $uploadfile);

						}else{

							$upload_twm = '';

						}
                    }
                      $graduation_marksheer=$_FILES['graduation_marksheer']['name']; 
                    if($graduation_marksheer!=''){
                        	$file_size = $_FILES['graduation_marksheer']['size'];
                        	$expbanner=explode('.',$graduation_marksheer);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_gm=$full_file_name;

                				move_uploaded_file($_FILES["graduation_marksheer"]["tmp_name"] , $uploadfile);

						}else{

							$upload_gm = '';

						}
                    }
                    $aadhar=$_FILES['aadhar']['name']; 
                    if($aadhar!=''){
                        	$file_size = $_FILES['aadhar']['size'];
                        	$expbanner=explode('.',$aadhar);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_ad=$full_file_name;

                				move_uploaded_file($_FILES["aadhar"]["tmp_name"] , $uploadfile);

						}else{

							$upload_ad = '';

						}
                    }
                    $graduation_degree=$_FILES['graduation_degree']['name']; 
                    if($graduation_degree!=''){
                        	$file_size = $_FILES['graduation_degree']['size'];
                        	$expbanner=explode('.',$graduation_degree);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_gd=$full_file_name;

                				move_uploaded_file($_FILES["graduation_degree"]["tmp_name"] , $uploadfile);

						}else{

							$upload_gd = '';

						}
                    }
                    	  
					$data = array(
                                'name' => $_POST['name'],
                                'gender' => $_POST['gender'],
                                'father' => $_POST['father'],
                                'mother' => $_POST['mother'],
                                'dob' => $_POST['dob'],
        						'mobile' => $_POST['phone_no'],
        						'email'=>$_POST['email'],
        						'state'=>$_POST['state'],
        						'country'=>$_POST['country'],
        						'distric'=>$_POST['district'],
        						'center_id' => $_POST['center_id'],
        						'marks' =>$_POST['marks'],
        						'board' =>$_POST['board'],
        						'medium' =>$_POST['medium'],
        						'year' =>$_POST['yop'],
        						'username' =>$_POST['phone_no'],
        						'password' =>$_POST['password'],
        						'course_id' =>$_POST['course'],
        						'center_id' => $_POST['center_id'],
        						'address' => $_POST['Address'],
        						'marrital_status'=>$_POST['marrital_status'],
        					   'marks' =>$_POST['marks'],
        				 		'category' =>$_POST['Academic'],
        						'city' =>$_POST['city'],
        						'pincode' =>$_POST['pincode'],
        						'highest_qualification' => $_POST['Qualification'],
        						'passing_year' => $_POST['yop'],
        					    'institute_name' => $_POST['board'],
        					    'blood_group' => $_POST['blood_group'],
        					    'nationality' => $_POST['nationality'],
        					    'addmission_date' => $_POST['admission_date'],
        					    'reg_no' => $_POST['reg_no'],
        					    'Batch' => $_POST['Batch'],
        					    'session' => $_POST['Session'],
        					    'occupation'=>$_POST['Occupation'],
        					    'mother_tongue'=>$_POST['mother_tongue'],
        					    'religion'=>$_POST['religion'],
        					    'community'=>$_POST['community'],
        					    'religion'=>$_POST['religion'],
        					    'subject'=>$_POST['subject'],
        				   );
            
                    if ($_FILES['photo']['name']) {
						$arr9 = array(
										 'photo' => $upload_nm,
									);
					}else{
						$arr9 = array(
									    );
					}
                    if ($_FILES['image2']['name']) {
						$arr1 = array(
										 'signature' => $upload_nm2,
									);
					}else{
						$arr1 = array(
									    );
					}
					
					
					if ($_FILES['tenth_marksheet']['name']) {
						$arr3 = array(
										 'tenth_marksheet' => $upload_tm,
									);
					}else{
						$arr3 = array(
									    );
					}
					
					if ($_FILES['twelve_marksheet']['name']) {
						$arr4 = array(
										'twelve_marksheet' => $upload_twm,
									);
					}else{
						$arr4 = array(
									    );
					}
					
					if ($_FILES['graduation_marksheer']['name']) {
						$arr5 = array(
										'graduation_marksheer' => $upload_gm,
									);
					}else{
						$arr5 = array(
									    );
					}
					
					if ($_FILES['graduation_degree']['name']) {
						$arr6 = array(
									'graduation_degree' => $upload_gd,
									);
					}else{
						$arr6 = array(
									    );
					}
					
					if ($_FILES['aadhar']['name']) {
						$arr7 = array(
									'aadhar' => $upload_ad,  
									);
					}else{
						$arr7 = array(
									    );
					}
					
					
			    $arr8 = array_merge($arr1,$arr3,$arr4,$arr5,$arr6,$arr7,$data,$arr9);    
       
            

			    if($this->input->post('enrollment_no') ){
        			$num = 	$this->db->query("SELECT * FROM `students` WHERE `enrollment_no` LIKE '".$_POST['enrollment_no']."'")->num_rows();
        			if($num > 0){
        			        if($_POST['studentid']!= ''){
        			            $this->db->where('id',$_POST['studentid']);
        			            $this->db->update('students',$arr8);
        			            $response['message'] = 'updated';
        			        }
        			}else{
        			    $this->db->insert('students',$arr8);
        			    $response['message'] = 'ok';
        			}	
		        }else{
		              $response['message'] = 'ok';
			    }	
					    
				
                $response['status'] = 200;
                
                json_output($response['status'], $response);
              if ($response['message'] == "ok") {
            }
    }






/*---------------- end student update -------------------------------------*/






    public  function upload_result(){
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
               // $params = $_REQUEST;
                
                $banner=$_FILES['fileToUpload']['name']; 
                    	if($banner!=''){
                        	$file_size = $_FILES['fileToUpload']['size'];
                        	$expbanner=explode('.',$banner);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	
                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name = uniqid().".".end($expbanner);		
                    			$uploadfile = $uploaddir.$full_file_name;
                    			$upload_nm=$full_file_name;
                				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"] , $uploadfile);
						}else{
							$upload_nm = '';
						}  
            	    
                	   $data1 = array(
                	                   'enrollment_no' => $_POST['roll_no'],
                	                    ); 
                	   $data2 = array(
                	                   'file' => $upload_nm,
                	                    );
                	   
                	   $data = array_merge($data1,$data2);
				    
				        $this->db->insert('upload_result',$data);
             
               
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        insert_activity_history(1,0);
                    }
            }
        }
    }

	
	function delete_result_list()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					$database = 'upload_result';
					$this->db->where('id',$_POST['id']);
					$this->db->delete($database);
					
					
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	function create_exam_schedule()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
					$database = 'exam_schedule';
				// 	$this->db->where('id',$_POST['id']);
				if(empty($_POST['year'])){
    	            $year=0;
        	    }else{
        	        $year=$_POST['year'];
        	    }
				$data=array(
				    'course_id'=>$_POST['course_id'],
				    'exam_date'=>$_POST['exam_date'],
				    'start_time'=>$_POST['start_time'],
				    'end_time'=>$_POST['end_time'],
				    'center_id'=>$_SESSION['loginid'],
				    'type'=>$_SESSION['type'],
				    'year'=>$year,
				    );
				    $check=$this->db->query("select * from exam_schedule where exam_date='".$_POST['exam_date']."'and course_id='".$_POST['course_id']."' and year='".$_POST['year']."' ")->num_rows();
				    if($check>0){
				      
				        $response=array('status' => 200,'message' => 'Exam Date is already exists');
				    }else{
					    $this->db->insert($database,$data);
					    $response=array('status' => 200,'message' => 'ok');
				    }
					
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
	
	public function update_new_password()
	{
	$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

			    	//print_r($this->input->post());

					$data=array(
						'ADMIN_PASSWORD'=>md5($_POST['new_password']),
					);

				    $id = 1;
						$this->db->where('ADMIN_ID',$id);
						$this->db->update('admin_login', $data);	
				

					
					
					$response['status'] = 200;
                	$response['message'] = 'ok';  
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
// generate certificate
	function generate_student_certificate()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} 
		
                        $student=    $this->db->get_where('students',['enrollment_no'=> $_POST['enroll_no']])->row();
                        if(!empty($student)){
                          $course=    $this->db->get_where('courses',['id'=> $_POST['course_id']])->row();
                          
                          $course_type=$course->type;
                        
                          if($course_type==1){
                              $duration='1';
                          }else{
                              $duration=(int)$course->years;
                              
                          }
                          $check=$this->db->query('select * from results where enrollment_no="'.$_POST['enroll_no'].'" and course_id="'.$_POST['course_id'].'" and result="pass"')->num_rows();
                        //   $check=    $this->db->get_where('results',['enrollment_no'=> $_POST['enroll_no'],'course_id'=>$_POST['course_id'],])->num_rows();
                        //   die(var_dump($check,$duration));
                          if($check!=$duration){
                            //   die('here');
                              json_output(400,array('status' => 420,'message' => 'course is not completed yet'));
                              return;
                          }
                        }
                        // die('out');
						$database = 'student_certificate';
						if(!empty($_POST['enroll_no'])){
						$result=$this->db->query('select * from results where enrollment_no="'.$_POST['enroll_no'].'" and course_id="'.$_POST['course_id'].'" ')->result();
				// 		$result=    $this->db->get_where('results',['enrollment_no'=> $_POST['enroll_no']])->result();
				// 		die(var_dump($result));
						$max_marks=0;
						$obt_marks=0;
						foreach($result as $row){
						    $max_marks+=@$row->max_marks;
						    $obt_marks+=@$row->obt_marks;
						}
						}
                        
                /*------------------ start generate qrcode ------------------*/        
                    $enr = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enroll_no']."'")->row();
					$cou = $this->db->query("SELECT * FROM courses where id = '".@$_POST['course_id']."'")->row();
					$center = $this->db->query("SELECT * FROM centers where id = '".@$_POST['center_id']."'")->row();
					$enrollment=$_POST['enroll_no'];
					$name=$enr->name;
					$father=$enr->father;
					$course_name=$cou->course_name;
					$center_name=@$center->institute_name;
					$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/temp/';
				    $text = 'Enrollment :'.$enrollment.'
				            Student name :'.$name.'
				            Father name :'.$father.'
				            Course name :'.$course_name.'
				            Center name :'.$center_name.'
				        ';
					$text1= substr($text, 0,9);
					$folder = $SERVERFILEPATH;
					$file_name1 = $enrollment."-Qrcode" . rand(2,200) . ".png";
					$file_name = $folder.$file_name1;
					QRcode::png($text,$file_name);
				    $uploadfile = $SERVERFILEPATH.$file_name1;
							move_uploaded_file($file_name1, $uploadfile);
                        
                /*------------------------- end generate qrcode  ------------------------*/        
                        
                        
                        
                        //echo $file_name1;
                        
                        
						$data = array(

										'enrollment_no' => $_POST['enroll_no'],
										'result_id' => $_POST['result_id'],
										'max_marks' => @$max_marks,
										'obt_marks' => @$obt_marks, 
										'course_id' => $_POST['course_id'], 
										'center_id' => $_POST['center_id'], 
										'year' => $_POST['year'], 
										'qr_code' => $file_name1, 

									);
									$data2=array
									(
									    'status'=>1,
									);
						$this->db->trans_begin();
						$check=    $this->db->get_where('student_certificate',['enrollment_no'=> $_POST['enroll_no']])->num_rows();
						if($check<=0){
							$this->db->insert($database,$data);
							$this->db->where('enrollment_no',$_POST['enroll_no']);
							$this->db->update('results',$data2);
						}else{
						    $this->db->where('enrollment_no',$_POST['enroll_no']);
							$this->db->update($database,$data);
							$this->db->where('enrollment_no',$_POST['enroll_no']);
							$this->db->update('results',$data2);
						}
                        if ($this->db->trans_status() === FALSE)
                            {
                                    $this->db->trans_rollback();
                            }
                            else
                            {
                                    $this->db->trans_commit();
                            }

							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					

			

		

	}
	
/*------------ START CENTER ACTIVE - DEACTIVE --------------------------------*/
    function update_center_active_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					$database = 'centers';
					
					   $centers =  $this->db->get_where('centers',['id'=>$_POST['centerid']])->row();
					    if($centers->status ==1){
					      $data= array(
					           'status' => 0,
					        );
					    }else{
					       $data= array(
					           'status' => 1,
					         );
					    }
					
						$this->db->where('id',$_POST['centerid']);
						$this->db->update($database,$data);
						$response=array('status' => 200,'message' => 'ok');
			        
			            json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


/*-------------- END CENTER ACTIVE --- DEACTIVE ---------------------------------*/







/*--------------------- start menu page status  --------------------------------------------*/
	
	function update_menu_page_status()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						    $database = 'front_cms_menu_items';
						        
						  //   $menulist =   $this->db->get_where($database,['FM_ID'=>$_POST['menuid']])->row();
						  //  if($menulist->FM_STATUS == 0){
						  //      $status = '1';
						  //  }else{
						  //       $status = '0';
						  //  }
						    $data = array(
						                    'PAGE_TYPE'=>$_POST['status'],
						                );
						    
								$this->db->where('id',$_POST['menuid']);	
        						$this->db->update($database,$data);
    							
    							$response=array('status' => 200,'message' => 'ok');
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}

	/*-------------------- end menu page status ------------------------------------------------*/
 




/*--------------------- start menu page status  --------------------------------------------*/
	
	function add_courses()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						  /*
						    $database = 'front_cms_menu_items';
						    $data = array(
						                    'PAGE_TYPE'=>$_POST['status'],
						                );
						    
								$this->db->where('id',$_POST['menuid']);	
        						$this->db->update($database,$data);
    						*/	
    						
    		/*------------ start add courses ---------------------------------------*/
    		                	$banner=$_FILES['image']['name']; 
                    			if($banner!=''){
                    				$file_size = $_FILES['image']['size'];
                    				$expbanner=explode('.',$banner);
                    				$allowed_format = array('jpg','jpeg','png');	
                    				if(in_array(strtolower(end($expbanner)),$allowed_format)){	
                    						$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    						$full_file_name = uniqid().".".end($expbanner);		
                    						$uploadfile = $uploaddir.$full_file_name;
                    					
                    						$upload_nm=$full_file_name;
                    						move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);	//for moving image 		
                    						
                    						if ($_FILES['image']['name']) {
                    				
                    								$upload_nm =$full_file_name;
                    									
                    						}else{
                    							$upload_nm='';
                    						}
                    				}
                    			}
                            
                                if($_POST['yearly'] == 1){
                    		        $year=0;
                    		        $month=$_POST['duration'];
                    		    }else{
                    		        $year = $_POST['duration'];
                    		        $month=0;
                    		    }
                    		    
                            		    
                    		    $data=array(
                    				    'course_name'=>$_POST['course_name'],
                    				    'course_code' => $_POST['course_code'],
                    				    'duration'=>$month,
                    				    'category'=>$_POST['category'],
                    				    'years'=>$year,
                    			        'type'=>$_POST['yearly'],
                    			        'MIN_QUALIFICATION'=> $_POST['min_qualification'],
                    		        );
                                
                                
                                if ($_FILES['image']['name']) {
            						$arr1 = array(
            										 'image' => $upload_nm, 
            									);
            					}else{
            						$arr1 = array(
            									    );
            					}
                    					
            					$arr3 = array_merge($arr1,$data);
                                
                    		    if($this->input->post('course_id')){  
                    		     	$database='courses';
                    	           	$this->db->where('id',$_POST['course_id']);
                    	           	$this->db->update($database,$arr3);
                    		     	
                    		  	}else{
                    		  	 	$database='courses';
                    		     	$this->db->insert($database,$arr3);
                    	        }
	
    		
    		
    		/*--------- end courses -------------------------------------------------*/
    						
    						
    						
    							
    							
    							
    							
    							$response=array('status' => 200,'message' => 'ok');
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}

	/*-------------------- end menu page status ------------------------------------------------*/
	
	
	
/*----------- start delete course -----------------------------------*/
    function delete_course()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					        
					        $database = 'courses';
							$this->db->where('id',$_POST['course_id']);
							$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');
			        	//}
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}



/*------------- end delete course --------------------------------*/
	
/*----------- start occupation -----------------------------------*/
    public function add_occupation()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			

				/*-------------start image --------------*/
						
							
						$data=array(
								'BUSINESS_NAME'=>$_POST['name'],
							);
						
						if($this->input->post('businessid')){
						    $this->db->where('BUSSINESS_ID',$_POST['businessid']);
						     $this->db->update('business_list',$data);
						}else{
						    $this->db->insert('business_list',$data);
    						$insert_id = $this->db->insert_id();
    						if(!empty($insert_id)){
    							$response=array('status' => 200,'message' => 'ok');	
    
    						}else{
    							$response=array('status' => 200,'message' => 'Something wents wrong');	
    						}
						}
						
						
							
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


/*-------------- end occupation ------------------------------------*/



/*----------- start batch -----------------------------------*/
    public function add_batch()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			

				/*-------------start image --------------*/
						
							
						$data=array(
								'BATCH_NAME'=>$_POST['name'],
							);
						
						if($this->input->post('batchid')){
						    $this->db->where('BATCH_ID',$_POST['batchid']);
						     $this->db->update('batch_session',$data);
						}else{
						    $this->db->insert('batch_session',$data);
    						$insert_id = $this->db->insert_id();
    						if(!empty($insert_id)){
    							$response=array('status' => 200,'message' => 'ok');	
    
    						}else{
    							$response=array('status' => 200,'message' => 'Something wents wrong');	
    						}
						}
						
						
							
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


/*-------------- end batch ------------------------------------*/



/*----------- start remove batch -----------------------------------*/
    public function remove_batch()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
				$response = $this->Authentication_model->auth();
				if($response['status'] == 200){
			

				/*-------------start image --------------*/
						
							$database = 'batch_session';
        					$this->db->where('BATCH_ID',$_POST['linkid']);
        					$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');	
    			
				/*------------- end start image ---------------*/	
				}else{
					$response=array('status' => 200,'message' => 'Something wents wrong');	
				}
				json_output(200,$response);
			}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
			}
		}
	}


/*-------------- end remove batch ------------------------------------*/




function create_admit_card()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){

						 	
    						
    		/*------------ start add courses ---------------------------------------*/
    		 $st_enr =  $this->db->query("select * from students where enrollment_no='".@$_POST['enrollment_no' ]."' ")->row();
   	        $chk = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."' OR roll_no = '".$_POST['roll_no']."'")->num_rows();
	        $chk_course = $this->db->query("SELECT * FROM `admit_card` where course_id='".$_POST['course_id']."' and roll_no='".$_POST['roll_no']."' OR enrollment_no = '".$_POST['enrollment_no']."' and year='".@$_POST['year']."'")->num_rows();               	
	        
	        if(empty($_POST['admit_card_id'])){
            	if( empty($chk_course))
            	{
            	    if(empty($_POST['year'])){
            	        $year=0;
            	    }else{
            	        $year=$_POST['year'];
            	    }
            		
            		$data = array(
            		            'enrollment_no' => $_POST['enrollment_no'],
            		            'roll_no' => $_POST['roll_no'],
            		            'course_id' => $_POST['course_id'],
            		            'center_id' => $st_enr->center_id,
            		            'year' => $year,
            		            );
            		$this->db->insert('admit_card',$data);
            		
            		$response=array('status' => 200,'message' => 'Admit Card Generated Successfully');
            
                }else{
                     $response=array('status' => 200,'message' => 'this roll no already for this course  created');
            	    
            	}
        	}else{
        	    $id=$_POST['admit_card_id'];
        	    $data=array(
        	        'enrollment_no'=>$_POST['enrollment_no'],
        	        'roll_no'=>$_POST['roll_no'],
        	        'course_id'=>$_POST['course_id'],
        	        'center_id'=>$st_enr->center_id,
        	        );
        	       
        	    $this->db->where('id',$id);
        	    $this->db->update('admit_card',$data);
        	     
        	      
        	      $response=array('status' => 200,'message' => 'record updated successfully');
        	}
    		
    		
    		/*--------- end courses -------------------------------------------------*/
    						
    						
    						
    							
    							
    							
    							
    							
			                    json_output(200,$response);

					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


/*-------------- start about us slidder -------------------------------*/

function welcome_massage()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						
						
						$banner=$_FILES['image']['name'];
						$banner2=$_FILES['image2']['name'];
						$banner3=$_FILES['image3']['name'];
						$banner4=$_FILES['image4']['name'];
						
						if($banner!='' ){
                            $file_size = $_FILES['image']['size'];
                            $expbanner=explode('.',$banner);
                            $allowed_format = array('jpg','jpeg','png');    
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'; 
                            $full_file_name = uniqid().".".end($expbanner);     
                            $uploadfile = $uploaddir.$full_file_name;
                            $upload_nm=$full_file_name;
                            move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);
                        }else{
                            $upload_nm = '';
                        }
                                                
                        
                        
                        if($banner2!=''){
                            $file_size2 = $_FILES['image2']['size'];
                            $expbanner2=explode('.',$banner2);
                            $allowed_format = array('jpg','jpeg','png');    
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'; 
                            $full_file_name2 = uniqid().".".end($expbanner2);
                            $uploadfile2 = $uploaddir.$full_file_name2;
                            $upload_nm2=$full_file_name2;
                            move_uploaded_file($_FILES["image2"]["tmp_name"] , $uploadfile2);
                        }else{
                            $upload_nm2 = '';
                            
                        }
                        
                        
                        
                        
                        if($banner3!=''){
                            $file_size3 = $_FILES['image3']['size'];
                            $expbanner3=explode('.',$banner3);
                            $allowed_format = array('jpg','jpeg','png');    
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'; 
                            $full_file_name3 = uniqid().".".end($expbanner3);
                            $uploadfile3 = $uploaddir.$full_file_name3;
                            $upload_nm3=$full_file_name3;
                            move_uploaded_file($_FILES["image3"]["tmp_name"] , $uploadfile3);
                        }else{
                            $upload_nm3 = '';
                        }
                        
                        
                        if($banner4!=''){
                            $file_size4 = $_FILES['image4']['size'];
                            $expbanner4=explode('.',$banner4);
                            $allowed_format = array('jpg','jpeg','png');    
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'; 
                            $full_file_name4 = uniqid().".".end($expbanner4);
                            $uploadfile4 = $uploaddir.$full_file_name4;
                            $upload_nm4=$full_file_name4;
                            move_uploaded_file($_FILES["image4"]["tmp_name"] , $uploadfile4);
                        }else{
                            $upload_nm4 = '';
                        }

						
                    	
						
									
			/*------------------ START IMAGE ---------------------*/		
					
					
					
					if ($_FILES['image']['name']) {
						$arr1 = array(
										 'image' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									    );
					}
					
					if ($upload_nm2!= '') {
						$arr2 = array(
										 'IMAGE2' => $upload_nm2, 
									);
					}else{
						$arr2 = array(
									    );
					}
					
					if ($upload_nm3!= '') {
						$arr3 = array(
										 'IMAGE3' => $upload_nm3, 
									);
					}else{
						$arr3 = array(
									    );
					}
					
					if ($upload_nm4!= '') {
						$arr4 = array(
										 'IMAGE4' => $upload_nm4, 
									);
					}else{
						$arr4 = array(
									    );
					}
					
					
					
						$database = 'welcome_message';
						$data = array(

										'WM_TITLE' => $_POST['title_name'], 

										'WM_DES' => $_POST['content'], 

									//	'WHYUS_IMAGE' => $upload_nm, 

									);
						
					
					$arr5 = array_merge($arr1,$arr2,$arr3,$arr4,$data);					
					
					//print_r($arr5);				
				      // $num = $this->db->get('welcome_message')->num_rows();
                       //$result =  $this->db->get('whyus',['WHYUS_ID'=>1])->row();
                        $id = 1;
			//			 if($num >0){

				 			$this->db->where('WM_ID',$id);
				 			$this->db->update($database,$arr5);
                            
                            
                            //echo '1';
							$response=array('status' => 200,'message' => 'ok');						

				// 		 }else{

				// 		 	$this->db->insert($database,$arr5);

				// 		 	$response=array('status' => 200,'message' => 'ok');

			 //        	}
			 
			 
			 
				// 			$this->db->insert($database,$data);

				// 			$response=array('status' => 200,'message' => 'ok');

			        	

			        json_output(200,$response);

					}else if($response['status'] == 303){

						$this->Common_model->logout();

						$this->session->sess_destroy();

						json_output(401,$response);

		        }

			}

		}

	}


/*----------------- end about us slidder ------------------------------*/


/*--------------- add chairman --------------------------------------------------------------------------------------------------*/
    function add_chairman()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
				    	    $data = array(
                    	                'CHAIRMAN_NAME' => $_POST['name'],
                    	                'CHAIRMAN_EMAIL' =>$_POST['email'],
                    	                'CHAIRMAN_CONTACT' => $_POST['mobile'],
                    	                'CHAIRMAN_TITLE' => $_POST['title_name'],
                    	                );
                            $this->db->insert('chairman',$data);
                            
                    	    $insert_id= $this->db->insert_id();
                    	    if($insert_id != ''){
                    	        $response=array('status' => 200,'message' => 'ok');
                    	    }else{
                    	        $response=array('status' => 200,'message' => 'fail');
                    	    }
                    	    
                    
				 	
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}


/*------------------------- end chairman ---------------------------------------------------------------------------------------*/



/*--------------- add STATE OFFICE  --------------------------------------------------------------------------------------------------*/
    function add_state_office()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					
				    	    $data = array(
                    	                'SO_STATE_ID' => $_POST['stateid'],
                    	                'SO_DISTRICT_ID' =>$_POST['districtid'],
                    	                'SO_NAME' => $_POST['name'],
                    	                'SO_MOBILE' => $_POST['mobile'],
                    	                'SO_EMAIL' => $_POST['email'],
                    	                'SO_ADDRESS' => $_POST['address'],
                    	                );
                            $this->db->insert('state_office',$data);
                            
                    	    $insert_id= $this->db->insert_id();
                    	    if($insert_id != ''){
                    	        $response=array('status' => 200,'message' => 'ok');
                    	    }else{
                    	        $response=array('status' => 200,'message' => 'fail');
                    	    }
                    	    
                    
				 	
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}


/*------------------------- end STATE OFFICE  ---------------------------------------------------------------------------------------*/





    function delete_chairman()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					/*-------------- image -----------------*/
					/*-------------- image2 ------------------*/

    					$database = 'chairman';
						$fieldname = 'CHAIRMAN_ID';
						$whereid = $_POST['chairmanid'];
							$this->db->where($fieldname,$whereid);
							$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');						
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


    
    function remove_state_office()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					/*-------------- image -----------------*/
					/*-------------- image2 ------------------*/

    					$database = 'state_office';
						$fieldname = 'SO_ID';
						$whereid = $_POST['state_office_id'];
							$this->db->where($fieldname,$whereid);
							$this->db->delete($database);
							$response=array('status' => 200,'message' => 'ok');						
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}


    
    
    
    function update_certificate_date()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'student_certificate';
					
					$arr = array(
					            'certificate_date' => $_POST['link'],
					            );
					
					
					
					$this->db->where('result_id',$_POST['id']);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}
    
    
/*------------------ start update theme color ----------------------------------------------*/
    function update_theme_color()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){
			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
						$database = 'site_setting';
					
					$arr = array(
					            'THEME_COLOR' => $_POST['id'],
					            );
					
					
					
					$this->db->where('SS_ID',1);
					$this->db->update($database,$arr);
				 	$response=array('status' => 200,'message' => 'ok');
			        json_output(200,$response);
					}else if($response['status'] == 303){
					$this->Common_model->logout();
					$this->session->sess_destroy();
					json_output(401,$response);
		        }
			}
		}
	}


/*-------------------- end update theme color ----------------------------------------------*/
    
  function delete_center()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->Authentication_model->check_auth_client();
			if($check_auth_client == true){

			    $response = $this->Authentication_model->auth();
			    if($response['status'] == 200){
					/*-------------- image -----------------*/
					/*-------------- image2 ------------------*/


                    $num = $this->db->query("SELECT * FROM `students` WHERE `center_id` LIKE '".$_POST['centerid']."'")->num_rows();
                    if($num > 0){
                        
                    }else{
                        	$database = 'centers';
    				// 		$fieldname = 'id';
    				// 		$whereid = $_POST['centerid'];
    						$this->db->where('id',$_POST['centerid']);
    						$this->db->delete($database);
                    }

    				
						$response=array('status' => 200,'message' => 'ok');						
			        json_output(200,$response);
					}else if($response['status'] == 303){
						$this->Common_model->logout();
						$this->session->sess_destroy();
						json_output(401,$response);
		        }
			}
		}
	}
	
	
}

?>