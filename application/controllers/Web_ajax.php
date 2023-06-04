<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata"); 
ob_start();            
class Web_ajax extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        ini_set('display_errors', 1);
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('json_ouput_helper');
        $this->load->helper('common_helper');
        $this->load->helper('dashboard_helper');
        $this->load->model('Authentication_model');
        $this->load->model('Common_model');
        $this->load->database('default');
        setlocale(LC_MONETARY, 'en_IN');
    }
      public function get_category()
    {

                    $response = get_category_by_brand($_POST['brandid']);
                    json_output(200, $response);

    }
      public function get_state()   
    {

                    $response = get_city($_POST['stateid']);
                    json_output(200, $response);

    }
    public function get_sub_category()
    {
        $response = get_sub_category($_POST['catid']);
        json_output(200, $response);
    } 
    public function login_web()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            // $check_auth_client_web = $this->Authentication_model->check_auth_client_web();
            // if ($check_auth_client_web == true) {
                $params = $_REQUEST;
                $username = $_POST['user_id'];
                $password = $_POST['password'];
                // $password = $_POST['password'];
                //$type = $_POST['login_type'];
                $status =  get_user_type($_POST['user_id'],$password); 
                // die(var_dump($status));
                if ($status =='3') {
                    $type = '3';
                    
                }elseif($status =='4'){
                    $type = '4';   
                }else{
                    $type='5';
                }
                //echo $type;
                
                $response = $this->Common_model->login_web($username, $password, $type);
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                        // insert_activity_history(1,0);
                    }
            // }
        }
    }
     public function logout()
  {
    // die('jfkdfj');
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method != 'POST') {
        json_output(400, array('status' => 400, 'message' => 'Bad request.'));
    } 
    $this->session->sess_destroy();
    json_output(200, array('status' => 200, 'message' => 'ok.'));
    
 }
    public function get_product()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            
                    $response = get_product($_POST['product_id']);
                    json_output(200, $response);
        }
    }
	// add registration
        function registration_form()
		{
		    
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));
			return;
		} 
// 		$checkCap = $this->checkReacaptcha($_POST['g-recaptcha-response']);
// 		if (!$checkCap) {
// 		    json_output(400,array('status' => 420,'message' => 'Recaptcha Verification Failed.'));
// 		    return;
// 		}
	$database = 'user_registration';

	$data = array(

					'name' => $_POST['name'],
					'mobile' => $_POST['mobile'],
					'address' => $_POST['address'],
					'email' => $_POST['email'],
					'type' => $_POST['type'],
					'password_view' => $_POST['password'],
					'password' => md5($_POST['password']),
			        // 'registration_ip' => $this->ip,

				);
			
        $check = $this->db->query("SELECT * FROM `user_registration` WHERE (`mobile` LIKE '".$_POST['mobile']."' OR `email` LIKE '".$_POST['email']."') AND type LIKE '".$_POST['type']."'")->num_rows();
	//	$check=$this->db->get_where('user_registration',['email'=>$_POST['email'],'mobile'=>$_POST['mobile'],'type'=>1])->num_rows();

		if($check > 0){
            json_output(400,array('status' => 420,'message' => 'Email or mobile is already registered.'));
		}elseif($_POST['new_password']!=$_POST['password']){
		    json_output(400,array('status' => 420,'message' => 'password is not matched'));
	    }else{
		    $this->db->insert($database,$data);
            $insert_id=$this->db->insert_id();
            // $_SESSION['userid']=$insert_id;
            // $_SESSION['type']=$_POST['type'];
            $this->session->set_userdata([
                
                    'userid' => $insert_id,
                    'type' => $this->input->post('type',true)
                
                ]);
		    $response=array('status' => 200,'message' => 'signup successfully');
            json_output(200,$response);
		}
	}
// 	get year web
    public function get_year_web()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } 
        // else {
            // $check_auth_client = $this->Authentication_model->check_auth_client();
            // if ($check_auth_client == true) {
                // $response = $this->Authentication_model->auth();
                // if ($response['status'] == 200) {
                    
                    $response = '';
                    // if(empty($_POST['result_id'])){
                    $get_type = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
                    if($get_type->type==2){
                        // $get = $this->db->query("SELECT * FROM courses where course_id = '".$_POST['course_id']."'")->row();
                        $years=$get_type->years;
        // 			foreach($get as $g){
        			
        				$response.= '
        				
        				<div class="form-group ">
        				<label>Select Year</label>
        						<select class="form-control "  course_id="'.$_POST['course_id'].'"  name="year">
				                        <option>SELECT YEAR</option>';
                            
                                       
                                          for($i=1; $i<=$years;$i++){
                                              if($i==1){
                                                  $st='st year';
                                                  
                                              }elseif($i==2){
                                                  $st='nd year';
                                              }elseif($i==3){
                                                  $st='rd year';
                                              }else{
                                                  $st='th year';
                                              }
                                              $year=$i.$st;
                                        
                              $response.= '     <option value="'.$i.'">"'.$year.'"</option>';
                                     
                                          }
                                    
		                	$response.='	</select></div>';
        						  
        						  //  
        				// 			<label>'.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->max_marks.'] | [Min Marks: '.$g->min_marks.']</span>
        				// 			<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'" required>
        						
        						
        				// ';
        				// if( $g->practical ==2){
        				// 	$response.= '	  <div class="form-group col-md-3">
        				// 			<label> '.$g->subject_name.'&nbsp; Practical </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
        				// 			<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" required>
        				// 		</div>';  
        				// 		}elseif( $g->practical ==1){
        				// 		    	$response.= '	  <div class="form-group col-md-3">
        				// 			<label>Practical '.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
        				// 			<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" required>
        				// 		</div>';
        				// 		}
        			}
                    // }
        			
        //             }else{
        //                 $get_result = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."'")->result();
        //                 $result=$this->db->get_where('results',['id'=>$_POST['result_id']])->row();
                    
        // 			foreach($get_result as $g){
        // 			     //   $subject_id=$g->
        // 			        $marks=$this->db->get_where('marks_table',['subject_id'=>@$g->id,'result_id'=>@$_POST['result_id']])->row();
                        
        //                 	$response.= '
        // 						<div class="form-group col-md-3">
        // 							<label>'.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->max_marks.'] | [Min Marks: '.$g->min_marks.']</span>
        // 							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'" value="'.@$marks->marks.'" required>
        // 						</div>
        // 				';
        // 					if( $g->practical ==2){
        // 					$response.= '	  <div class="form-group col-md-3">
        // 							<label> '.$g->subject_name.'&nbsp; Practical </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
        // 							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" value="'.@$marks->practical_marks.'" required>
        // 						</div>';  
        // 						}elseif( $g->practical ==1){
        // 						    	$response.= '	  <div class="form-group col-md-3">
        // 							<label>Practical '.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
        // 							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" value="'.@$marks->practical_marks.'" required>
        // 						</div>';
        // 						}
        // 			}
        			
        // 			$response.= '<div class="form-group col-md-3">
        // 				<label>Result</label>
        // 				<input type="text" class="form-control" name="result" value="'.@$result->result.'"placeholder="Enter Result">
        // 			</div>
        // 			<div class="form-group col-md-12">
        // 			    <label>QR Code</label>
        // 			    <input type="file" name="qr" class="form-control" >
        // 			</div>
        // 			<div class="form-group col-md-12">
        // 				<button class="btn btn-primary" type="submit" name="status" value="create_result">Submit</button>
        // 			</div>
        // 			';
                        
        //             }
                    
                    //$response = get_all_states();
                    
                    json_output(200, $response);
                // } else if ($response['status'] == 303) {
                //     $this->Common_model->logout();
                //     $this->session->sess_destroy();
                //     json_output(401, $response);
                // }
            // }
        // }
    }
    // load more courses
    function load_more_courses()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$m=date('m');
		$year=date('Y');
		$offset=$_POST['offset'];
// 		$row = $this->db->query(" SELECT * FROM `gallery_name` WHERE `id` = '".$_POST['id']."' ")->row(); 
// 		$id=@$row->id;
// 		select * from courses  LIMIT 9 OFFSET 0
        $query="select *,courses.id as id from courses left join brand on category=brand.id LIMIT 9 OFFSET $offset ";
// 		$query = "SELECT * FROM `participaints` as p left join (select user_id, count(user_id) votes FROM votes where month(timestamp)=$m and year(timestamp)=$year GROUP BY user_id) vt on vt.user_id = p.user_id where month(p.livedate)=$m and year(p.livedate)=$year and p.pay_status=1 ORDER by votes desc LIMIT 12 OFFSET $offset";
// 		$que=$this->db->query("select * from participaints where month(livedate)=$m and pay_status=1 LIMIT 12 OFFSET $offset")->result();
        $que=$this->db->query($query)->result();
// 		die(var_dump($que));
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no more courses'));
		    return;
		}

	}
	
	
	
	function load_more_courses_by_category()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$m=date('m');
		$year=date('Y');
		$offset=$_POST['offset'];
        $query="select *,courses.id as id from courses left join brand on brand.id=courses.category where where category='".$_POST['categoryid']."' LIMIT 9 OFFSET $offset ";
        $que=$this->db->query($query)->result();
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no more courses'));
		    return;
		}

	}
	
	
	function load_more_gallery()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$offset=$_POST['offset'];
        $query="select * from blogs where PAGE_NAME = 3 and BLOG_STATUS = 1 LIMIT 12 OFFSET $offset ";
        $que=$this->db->query($query)->result();
// 		die(var_dump($que));
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no more photos'));
		    return;
		}

	}
	function load_more_teacher()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$offset=$_POST['offset'];
        $query="select * from member_list where MEMBER_STATUS = 1 LIMIT 12 OFFSET $offset ";
        $que=$this->db->query($query)->result();
// 		die(var_dump($que));
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no more teachers data availble'));
		    return;
		}

	}
	function load_more_events()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$offset=$_POST['offset'];
        $query="select * from blogs where PAGE_NAME = 2 and BLOG_STATUS =1 LIMIT 4 OFFSET $offset ";
        $que=$this->db->query($query)->result();
// 		die(var_dump($que));
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no more event data availble'));
		    return;
		}

	}
	function load_more_blogs()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$offset=$_POST['offset'];
        $query="select * from blogs where PAGE_NAME = 1 and BLOG_STATUS =1 LIMIT 12 OFFSET $offset ";
        $que=$this->db->query($query)->result();
// 		die(var_dump($que));
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no more blogs data availble'));
		    return;
		}

	}
// 	search courses
function search_course()
		{
		$method = $_SERVER['REQUEST_METHOD'];
    	if($method != 'POST'){
    		json_output(400,array('status' => 400,'message' => 'Bad request.'));
    	} 
		$id=$_POST['category'];
		$course=$_POST['course_name'];
        $query="select * from courses where  category LIKE '".$id."' and course_name = '%".$course."%' ";
        $que=$this->db->query($query)->row();
// 		die(var_dump($que));
        $response = $que;
                    json_output(200, $response);
		if (empty($que)){
		    json_output(400,array('status' => 420,'message' => 'no  course  availble'));
		    return;
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
										'PERSON_MOBILE' => $_POST['mobile'],

										'PERSON_COMMENT' => $_POST['message'], 

									);

							// $this->db->where('CONTACT_ID',$_POST['enquiryid']);

							$this->db->insert($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					

			

		

	}
	function add_feedback()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} 
		

						$database = 'feedback';
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

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                    }

						$data = array(

										'FB_PER_NAME' => $_POST['name'],

										'FB_PERSON_IMAGE' => $upload_nm,
										'FB_TITLE' => $_POST['subject'],
										'FB_STATUS' => 1,

										'FB_COMMENT' => $_POST['message'], 

									);

							// $this->db->where('CONTACT_ID',$_POST['enquiryid']);

							$this->db->insert($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					

			

		

	}
	// add enquiry web
		function subscription()
		{

		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){

			json_output(400,array('status' => 400,'message' => 'Bad request.'));

		} 
		

						$database = 'subscription';

						$data = array(

										'email' => $_POST['email'],

								// 		'PERSON_EMAIL' => $_POST['email'],
								// 		'PERSON_SUBJECT' => $_POST['subject'],

								// 		'PERSON_COMMENT' => $_POST['message'], 

									);

							// $this->db->where('CONTACT_ID',$_POST['enquiryid']);

							$this->db->insert($database,$data);


							$response=array('status' => 200,'message' => 'ok');

			        	//}

			        json_output(200,$response);

					

			

		

	}

    public function registration()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
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

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                    }
	   
	               $data = array(
                       'name' => $_POST['name'],
                       'mobile' => $_POST['txtContactNo'],
                       'email' => $_POST['email'],
                        'address' => $_POST['address'],
                        'dob' => $_POST['dob'],
                    //    'pincode' => $_POST['pincode'],
                    //    'profile_pic' =>		$upload_nm,
                        'password' => $_POST['txtContactNo'],
						'user_id' => $_POST['email'],
						'father_name'=>$_POST['father_name'],
						'mother_name'=>$_POST['mother_name'],
						'gender'=>$_POST['gender'],
						'category' => $_POST['category'],
						'city' =>$_POST['city'],
						'appearing_school_name' =>$_POST['appearing_school'],
						'apprearing_disctrict' =>$_POST['appearing_district_'],
						'appearing_city' =>$_POST['appearing_city'],
						'enroll_for' =>$_POST['enroll_for'],
						'course' =>$_POST['course'],
						'exam_type' => $_POST['exam_type'],
					   'status'=>1,
					   
                       
                       'date'=>date('Y-m-d H:i:s'),
                   );
                    if ($_FILES['image']['name']) {
						$arr1 = array(
										 'profile_pic' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									);
					}
                
                $arr3 = array_merge($arr1,$data);	   
                   	//print_r($arr3);
				$this->db->insert('user_registration',$arr3);
				
			
				
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
              if ($response['message'] == "ok") {
            }
    }
    
    
    
    
	public function form_submit()
    {
		// die('fjdkjfd');
	 if (!isset($_SESSION['userid'])) {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
        $data['cartitems']=$this->cart->contents();
        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // die;
		$this->db->trans_begin();
		foreach($data['cartitems'] as $item) {
			$form = array(
				'USER_ID' => $_SESSION['userid'],
				// 'NAME'=>$_POST['name'],
				// 'EMAIL' => $_POST['email'],
				// 'MOBILE'=>$_POST['phone'],
				// 'ADDRES'=>$_POST['address'],
				// 'city'=>$_POST['city'],
				// 'state'=>$_POST['state'],
				// 'country'=>$_POST['country'],
				// 'PINCODE'=>$_POST['pincode'],
				'ORDER_TT'=>date('Y-m-d H:i:s'),
				'ORDER_STATUS'=>0,
				'PRODUCT_ID'=> $item['id'],
				'QTY'=> $item['qty'],
				'PRODUCT_PRICE'=> $item['subtotal'],
			);
			$this->db->insert('orderlist',$form);
			// redirect('website/cart_list');
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
      public function center_login()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
			  
      $username = $_POST['username'];
      $password = $_POST['password'];
        // die(var_dump($username,$password));  
      $login = $this->db->query("SELECT * FROM centers where username = '".$username."' AND password = '".$password."' AND status = 1");
    //  die(var_dump($login->row()));
      if($login->row())
      {
        $row = $login->row();
        $rand = rand(111111,999999);
        $_SESSION['center']['id'] = $row->id;
        
        $_SESSION['center']['session_id'] = $rand;
        $_SESSION['center']['login'] = TRUE;
        // die(var_dump($_SESSION['center']['login']));
        // $con->query("INSERT INTO `check_session` ( `user_id`, `session_id`) VALUES ('".$row['id']."', '".$rand."')");
        $data=array(
                'user_id' => $row->id,
                    'session_id' => $rand,
            );
        // die(var_dump("INSERT INTO `check_session` ( `user_id`, `session_id`) VALUES ('".$row['id']."', '".$rand."')"));
        $this->db->insert('check_session',$data);
        // die(var_dump($data));
        redirect('/test/center/');
        // echo '<script>location.href="center/"</script>';
        	

      }
    //   else
    //   {
        // echo '<script>alert("Invalid Login");location.href="center_login.php"</script>';
        
    //   }
				
                $response['status'] = 200;
                $response['message'] = 'ok';
                json_output($response['status'], $response);
              if ($response['message'] == "ok") {
            }
    }
    // center_registration
    public function center_registration()
    {
        // die('here');
        
        $this->load->library('form_validation');
        $this->load->helper(['form','array']);
        
        $config = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,  
            'encrypt_name' => true,
            'max_size' => 2048
        );
        
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        }
			        /*$banner=$_FILES['image']['name']; 
                    if($banner!=''){
                        $file_size = $_FILES['image']['size'];
                        $expbanner=explode('.',$banner);
                    	$allowed_format = array('jpg','jpeg','png');	
                    	if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    		$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    		$full_file_name = uniqid().".".end($expbanner);		

                    		$uploadfile = $uploaddir.$full_file_name;

                    		$upload_nm=$full_file_name;

                			@move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                    }*/
                    
                     $six_digit_random_number = random_int(100000, 999999);
                    // $centerid = time();
                    $profile=$this->db->get('profile')->row();
                    $prefix=$profile->CENTER_PREFIX;
                    $time=time();
                    
                    //$six_digit = random_int(100000, 999999);
                            
                    $centeridx = $prefix.'-'.$time;
                    $centerid =  preg_replace('/\s+/', '', $centeridx);
                    
	               $data = array(
                        
                       'center_number' => $centerid,
                       'name' => $_POST['name'],
                        'institute_name' => $_POST['institute_name'],
						'center_full_address' => $_POST['center_full_address'],
						'state_id'=>$_POST['state_id'],
						'city_id'=>$_POST['district_id'],
						'city_name'=>$_POST['city_name'],
						'pincode' =>$_POST['pincode'],
						'contact_number' =>$_POST['contact_number'],
						'email_id' =>$_POST['email_id'],
						'username' => $centerid,
						'whatsapp_number' => $_POST['whatsapp_number'],
					    'status'=>0,
						'password'=>md5($_POST['password']),
						'center_password'=>$_POST['password'],
						//'password' => md5($_POST['reception']), //pankaj sir code
					    //'center_password' => $_POST['reception'], // pankaj sir code
                       
				// 		'no_of_class_room'=>$_POST['no_of_class_room'],
                        // 'dob' => $_POST['dob'],
                        // 'pan_number' => $_POST['pan_number'],
                        // 'image' =>$upload_nm,
                        // 'aadhar_number' => $_POST['aadhar_number'],
				// 		'no_of_computer_operator'=>$_POST['computer_lab'],
				// 		'total_computer' => $_POST['total_computer'],
				// 		'space_of_computer_center' =>$_POST['seat_capacity'],
				// 		'qualification_of_center_head' =>$_POST['qualification_of_center_head'],
				// 		'staff_room' =>$_POST['staff_room'],
				// 		'water_supply' => $_POST['water_supply'],
				// 		'toilet' => $_POST['toilet'],
				// 		'reception' => $_POST['reception'],
				// 		'frenchisee_id' => $_SESSION['userid'],
					   // 'first_aid'=>$_POST['first_aid'],
                    //   'date'=>date('Y-m-d H:i:s'),
                   );
                   
                   if(!empty($_FILES['image']['name'])){
			            $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('image')) {
                           $data['image'] = $this->upload->data('file_name');
                        } 
			        }
			        
			        if(!empty($_FILES['id_proof_image']['name'])){
			            $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('id_proof_image')) {
                           $data['id_proof_image'] = $this->upload->data('file_name');
                        } 
			        }
			        
			        if(!empty($_FILES['pan_card_image']['name'])){
			            $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('pan_card_image')) {
                           $data['pan_card_image'] = $this->upload->data('file_name');
                        } 
			        }
                   
                    /*if ($_FILES['image']['name']) {
						$arr1 = array(
										 'image' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									);
					}
                
                $arr3 = array_merge($arr1,$data);	   
                   	//print_r($arr3);*/
                
                            
			 //   $payuform = '<';

                $check_num =    $this->db->query("SELECT * FROM `centers` WHERE `contact_number` LIKE '".$_POST['contact_number']."' AND `email_id` LIKE '".$_POST['email_id']."' ")->num_rows();

			    if($check_num > 0){
			       $response['status'] = 200;
                    $response['message'] = 'Fail'; 
			    }else{
			    
    				$this->db->insert('centers',$data);
    			    $insert_id = $this->db->insert_id();
    			    $this->load->model('Paymentsetting_model','paymentM');
    			    if($this->paymentM->few_setting('active_payment') == 'yes'){
        			    
        				$this->load->library('pum');
                        $pum = $this->pum->init(PAYU_SALT,PAYU_KEY);
                        $return_url = base_url('payu/frenschise_response');
                        $form = $pum->add_field('email',$data['email_id'])
                                    ->add_field('firstname',$data['name'])
                                    ->add_field('phone',$data['contact_number'])
                                    ->add_field('udf1',$insert_id)
                                    ->add_field('amount',$this->paymentM->few_setting('center_fee'))
                                    ->add_field('surl',$return_url)
                                    ->add_field('furl',$return_url)
                                    ->submit_pum_ajax();
                        $response['FORM'] = $form;
    			    }
                	$center = array(
    				                'USER_NAME' => $centerid,
    				                'ADMIN_PASSWORD' => md5($six_digit_random_number),
    				                'PASSWORD_VIEW' => $six_digit_random_number,  
    				                'ADMIN_STATUS' => 0,
    				                'COMPANY_HRM_TYPE' =>2, 
    				                'COMPANY_ID' => 2,
    				                'INSTITUTE_CENTER_ID' => $insert_id,
    				                );
    				
    				$this->db->insert('admin_login',$center);
    				
    				/*---------- start send email ---------------------*/
                   	    $code =  $this->db->get('profile')->result();
                         $ORG_NAME = $code[0]->ORG_NAME; 
                   	   
                   	    $to = $_POST['email_id'];
                        $subject = "VERIFICATION OTP ";
                        $txt = "DEAR CUSTOMER YOUR REGISTERED FOR '".$ORG_NAME."' IS SUCCESS. PLZ CONNECT WITH CENTER TO ACTIVATE THIS  USERNAME '".$_POST['email_id']."' AND  PASSWORD IS '".$six_digit_random_number."' ";
                        $headers = $_POST['email_id'];
                       
                        mail($to,$subject,$txt,$headers);
                   	    
                   	    // if(!$mail->Send()) {
                         
                        //   $MAIL = $mail->ErrorInfo;
                          
                        // } else {
                           $MAIL = 'Message has been sent.'; 
                        // }
                   	   
                   	/*------------- end send email ----------------------*/
                    $response['status'] = 200;
                    $response['message'] = 'ok';
                    $response['MAIL'] = $MAIL;
                    
                    
			    }


				
                
                json_output($response['status'], $response);
              if ($response['message'] == "ok") {
            }
    }
// student registration
    function student_registration(){
        $this->load->library('form_validation');
        $this->load->helper(['form','array']);
        $config = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'jpg|gif|png|jpeg',
            'overwrite'     => 1,  
            'encrypt_name' => true,
            'max_size' => 2048
        );
        $saveData  = [];
        $return = ['status' => false];
        if($post = $this->input->post()){
            $this->form_validation->set_rules('photo','','callback_file_check');
            $this->form_validation->set_rules('mother','Monther Name','required');
            // $this->form_validation->set_rules('mobile','Mobile','required|is_unique[students.mobile]',array('is_unique' => 'This Student is already Exists..'));
            // $this->form_validation->set_rules('Email','Email','required|is_unique[students.email]',array('is_unique' => 'This Student is already Exists..'));
            $login_detail =     $this->db->query("SELECT * FROM `user_registration` WHERE `id` = '".$_SESSION['userid']."' ")->row();
            $num =   $this->db->query("SELECT * FROM `students` WHERE `mobile` LIKE '".$login_detail->mobile."' OR `email` LIKE '".$login_detail->email."' ")->num_rows();
			if($num > 0){
			    $return['message'] = 'Student Already exists.';
			}
			else{
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
                    
                    
                    
                    
                    $saveData  = array(
                            'enrollment_no' => $centerid,
                           'name' => $_POST['name'],
                            'gender' => $_POST['gender'],
                            'father' => $_POST['father'],
                            'mother' => $_POST['mother'],
                            'photo' => element('photo',$imagedata,''),
                            'dob' => $_POST['dob'],
    						'mobile' => $login_detail->mobile,
    						'email'=>$login_detail->email,
    						'state'=>$_POST['state'],
    						'country'=>$_POST['country'],
    						'distric'=>$_POST['distric'],
    						'user_id' => $_SESSION['userid'],
    						'center_id' => $_POST['center_id'],
    						'marks' =>$_POST['marks'],
    						'board' =>$_POST['board'],
    						'medium' =>$_POST['medium'],
    						'year' =>$_POST['yop'],
    						'course_id' =>$_POST['course'],
    						'center_id' => $_POST['center_id'],
    						'address' => $_POST['Address'],
    						'marrital_status'=>$_POST['marrital_status'],
    					   'status'=>1,
    					   'transection_id' =>$_POST['marks'],
    						'payment_status' =>0,
    						'city' =>$_POST['city'],
    						'pincode' =>$_POST['pincode'],
    						'highest_qualification' => $_POST['Qualification'],
    						'passing_year' => $_POST['yop'],
    					    'institute_name' => $_POST['board'],
    					    
    					    'tenth_marksheet' => element('tenth_marksheet',$imagedata,''),
    					    'twelve_marksheet' => element('twelve_marksheet',$imagedata,''),
    					    'graduation_marksheer' => element('graduation_marksheer',$imagedata,''),
    					    'graduation_degree' => element('graduation_degree',$imagedata,''),
    					    'aadhar' => element('aadhar',$imagedata,''),
    					   
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
    					    'signature' => element('signature',$imagedata,'')
                       );
                       
                        $this->db->insert('students',$saveData);
    			         $insert_id = $this->db->insert_id();
    		            
    		            $this->load->model('Paymentsetting_model','paymentM');
    			                $form = false;
    				    $response=array('status' => 200,'message' => 'ok');
        			    if($this->paymentM->few_setting('active_payment') == 'yes'){
            			    
            				$this->load->library('pum');
                            $pum = $this->pum->init(PAYU_SALT,PAYU_KEY);
                            $return_url = base_url('payu/student_response');
                            $form = $pum->add_field('email',$data['email_id'])
                                        ->add_field('firstname',$data['name'])
                                        ->add_field('phone',$data['contact_number'])
                                        ->add_field('udf1',$insert_id)
                                        ->add_field('amount',$this->paymentM->few_setting('student_fee'))
                                        ->add_field('surl',$return_url)
                                        ->add_field('furl',$return_url)
                                        ->submit_pum_ajax();
        			    }
    			        
    			        $return = array('status' => true,'message' => 'Student  registered successfully.','FORM' => $form,'url' => base_url('student-registration'));
                }
                else
                    $return['message'] = validation_errors();
			}
            
        }
        echo json_encode($return);
    }
    
    
    
    
    
    
    public function student_registration_old()
    {
        
	
                    
                    $photo=$_FILES['photo']['name']; 
                    if($photo!=''){
                        	$file_size = $_FILES['photo']['size'];
                        		$file_size = $_FILES['photo']['size'];
                        	if ($file_size > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}

                        	$expbanner=explode('.',$photo);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				@move_uploaded_file($_FILES["photo"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}
                    }
/*----------------- start signature ------------------------------------- */                   
                    $banner2=$_FILES['image2']['name']; 
                    if($banner2!=''){
                        	$file_size2 = $_FILES['image2']['size'];
                        	if ($file_size2 > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}
                        	$expbanner2=explode('.',$banner2);
                    		$allowed_format2 = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner2)),$allowed_format2)){	
                    			$uploaddir2 = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	
                    			$full_file_name2 = uniqid().".".end($expbanner2);		
                    			$uploadfile2 = $uploaddir2.$full_file_name2;
                    			$upload_nm2=$full_file_name2;
                				@move_uploaded_file($_FILES["image2"]["tmp_name"] , $uploadfile2);
						}else{
							$upload_nm2 = '';
						}
                    }
/*------------------ end signature -----------------------------------------*/






/*------------------- start left thumb --------------------------------------
                $banner3=$_FILES['image3']['name']; 
                if($banner3!=''){
                    	$file_size3 = $_FILES['image3']['size'];
                    	if ($file_size3 > (2*1024*1024)) {
        							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
        							return;

						}
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
/*-------------------- end left thumb--------------------------------------- */

                   
                    $tenth_marksheet=$_FILES['tenth_marksheet']['name']; 
                    if($tenth_marksheet!=''){
                        	$file_size = $_FILES['tenth_marksheet']['size'];
                        	if ($file_size > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}
                        	$expbanner=explode('.',$tenth_marksheet);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_tm=$full_file_name;

                				@move_uploaded_file($_FILES["tenth_marksheet"]["tmp_name"] , $uploadfile);

						}else{

							$upload_tm = '';

						}
                    }
                       $twelve_marksheet=$_FILES['twelve_marksheet']['name']; 
                    if($tenth_marksheet!=''){
                        	$file_size = $_FILES['twelve_marksheet']['size'];
                        	if ($file_size > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}
                        	$expbanner=explode('.',$twelve_marksheet);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_twm=$full_file_name;

                				@move_uploaded_file($_FILES["twelve_marksheet"]["tmp_name"] , $uploadfile);

						}else{

							$upload_twm = '';

						}
                    }
                      $graduation_marksheer=$_FILES['graduation_marksheer']['name']; 
                    if($graduation_marksheer!=''){
                        	$file_size = $_FILES['graduation_marksheer']['size'];
                        	if ($file_size > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}
                        	$expbanner=explode('.',$graduation_marksheer);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_gm=$full_file_name;

                				@move_uploaded_file($_FILES["graduation_marksheer"]["tmp_name"] , $uploadfile);

						}else{

							$upload_gm = '';

						}
                    }
                    $aadhar=$_FILES['aadhar']['name']; 
                    if($aadhar!=''){
                        	$file_size = $_FILES['aadhar']['size'];
                        	if ($file_size > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}
                        	$expbanner=explode('.',$aadhar);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_ad=$full_file_name;

                				@move_uploaded_file($_FILES["aadhar"]["tmp_name"] , $uploadfile);

						}else{

							$upload_ad = '';

						}
                    }
                    $graduation_degree=$_FILES['graduation_degree']['name']; 
                    if($graduation_degree!=''){
                        	$file_size = $_FILES['graduation_degree']['size'];
                        	if ($file_size > (2*1024*1024)) {
            							json_output(400,array('status' => 420,'message' => 'image is too big and max size required 2mb'));
            							return;

							}
                        	$expbanner=explode('.',$graduation_degree);
                    		$allowed_format = array('jpg','jpeg','png');	
                    		if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_gd=$full_file_name;

                				@move_uploaded_file($_FILES["graduation_degree"]["tmp_name"] , $uploadfile);

						}else{

							$upload_gd = '';

						}
                    }
 /*   ----------------------------------------*/
    
    
                    $profile =  get_all_profile();
                    
                    $centeridx =$profile[0]->STUDENT_PREFIX.time();
	                
	                $centerid =  preg_replace('/\s+/', '', $centeridx);
	                
	                
	                $login_detail =     $this->db->query("SELECT * FROM `user_registration` WHERE `id` = '".$_SESSION['userid']."' ")->row();
	               
	               $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/temp/';
				    
				    $text = '   Enrollment no : '.$centerid.'
                                Student name : '.$_POST['name'].'
                                Father name : '.$_POST['father'].'
                                Course name 
                                Center name';
					
					
					$text1= trim(substr($text, 0,9));
					
					$folder = $_SERVER['DOCUMENT_ROOT'].'/temp/';
					$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
					$file_name = $folder.$file_name1;
					
				// 	QRcode::png($text,$file_name);
	               
	               $data = array(
                        'enrollment_no' => $centerid,
                    //   'enrollment_no' => $_POST['enrollment_no'],
                       'name' => $_POST['name'],
                        'gender' => $_POST['gender'],
                        'father' => $_POST['father'],
                        'mother' => $_POST['mother'],
                        //'photo' =>$upload_nm,
                        'dob' => $_POST['dob'],
						'mobile' => $login_detail->mobile,
						'email'=>$login_detail->email,
						'state'=>$_POST['state'],
						'country'=>$_POST['country'],
						'distric'=>$_POST['distric'],
						'user_id' => $_SESSION['userid'],
						'center_id' => $_POST['center_id'],
						'marks' =>$_POST['marks'],
						'board' =>$_POST['board'],
						'medium' =>$_POST['medium'],
						'year' =>$_POST['yop'],
				// 		'username' =>$_POST['phone_no'],
				// 		'password' =>$_POST['password'],
						'course_id' =>$_POST['course'],
						'center_id' => $_POST['center_id'],
						'address' => $_POST['Address'],
						'marrital_status'=>$_POST['marrital_status'],
					   'status'=>1,
					   'transection_id' =>$_POST['marks'],
						'payment_status' =>0,
				// 		'disability	' =>$_POST['disability'],
				// 		'ews' =>$_POST['ews'],
						'city' =>$_POST['city'],
						'pincode' =>$_POST['pincode'],
						'highest_qualification' => $_POST['Qualification'],
						'passing_year' => $_POST['yop'],
					    'institute_name' => $_POST['board'],
					   // 'tenth_marksheet' => $upload_tm,
					   // 'twelve_marksheet' => $upload_twm,
					   // 'graduation_marksheer' => $upload_gm,
					   // 'graduation_degree' => $upload_gd,
					   // 'aadhar' => $upload_ad,
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
					   // 'signature' => $upload_nm2,
					   // 'left_thumb' => $upload_nm3,
					    
					   
                       
                  
                   );
                
               
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
					
				
					
                    if ($_FILES['photo']['name']) {
						$arr9 = array(
										 'photo' => $upload_nm,
									);
					}else{
						$arr9 = array(
									    );
					}
					
                $arr8 = array_merge($arr1,$arr3,$arr4,$arr5,$arr6,$arr7,$data,$arr9);  
                //$arr8 = array_merge($data,$arr9);  
				 $num =   $this->db->query("SELECT * FROM `students` WHERE `mobile` LIKE '".$login_detail->mobile."' OR `email` LIKE '".$login_detail->email."' ")->num_rows();
			    if($num > 0){
			        json_output(400,array('status' => 420,'message' => 'Student already registered.'));
			     //   $response['message'] = 'ok';
			    }else{
			         //$response['status'] = 200;
                // $response['message'] = 'ok';
                // json_output($response['status'], $response);
			         $this->db->insert('students',$arr8);
			         $insert_id = $this->db->insert_id();
		            
		            $this->load->model('Paymentsetting_model','paymentM');
			                $form = false;
				    $response=array('status' => 200,'message' => 'ok');
    			    if($this->paymentM->few_setting('active_payment') == 'yes'){
        			    
        				$this->load->library('pum');
                        $pum = $this->pum->init(PAYU_SALT,PAYU_KEY);
                        $return_url = base_url('payu/student_response');
                        $form = $pum->add_field('email',$data['email_id'])
                                    ->add_field('firstname',$data['name'])
                                    ->add_field('phone',$data['contact_number'])
                                    ->add_field('udf1',$insert_id)
                                    ->add_field('amount',$this->paymentM->few_setting('student_fee'))
                                    ->add_field('surl',$return_url)
                                    ->add_field('furl',$return_url)
                                    ->submit_pum_ajax();
                        // $response['FORM'] = ;
    			    }
			        
			        json_output(200,array('status' => 200,'message' => 'Student  registered successfully.','FORM' => $form,'url' => base_url('student-registration')));
				   
				    
				    
				    
				    /*---------- start send email --------------------
               	    $code =  get_site_setting();
                    $ORG_NAME = $code[0]->ORG_NAME;
               	   
               	    $to = $_GET['email_id'];
                    $subject = "VERIFICATION OTP ";
                    $txt = "DEAR CUSTOMER YOUR REGISTERED FOR '".$ORG_NAME."' IS SUCCESS. PLZ CONNECT WITH CENTER TO ACTIVATE THIS  USERNAME '".$centerid."' AND  PASSWORD IS '".$six_digit_random_number."' ";
                    $headers = $_GET['email'];
                   
                    
                    mail($to,$subject,$txt,$headers);
               	   
               	----------- end send email ----------------------*/
				    
				    
				    
			    }
			
				
                //
            //   if ($response['message'] == "ok") {
            // }
    }
    
    
    
    public function get_course_type()
    {
                    $response = '';
                    $get_type = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
                    
                    if($get_type->type==2){
                        $years=$get_type->years;
                    	$response.= '
        				                <option value=" ">SELECT YEAR</option>';
                                          for($i=1; $i<=$years;$i++){
                                              if($i==1){
                                                  $st='st year';
                                              }elseif($i==2){
                                                  $st='nd year';
                                              }elseif($i==3){
                                                  $st='rd year';
                                              }else{
                                                  $st='th year';
                                              }
                                              $year=$i.$st;
                        $response.= '   <option value="'.$i.'">'.$year.'</option>';
                                          }
                    }
                    if($get_type->type==1){
                        $years=$get_type->duration;
        				$response.= '
        						                      <option value="">SELECT MONTHS</option>';
                                    $response.= '     <option value="">'.$years.' Months</option>';
                                   
        			}
                    
                    json_output(200, $response);
                
    }
    
    
    
    
    
    
    
}
?>