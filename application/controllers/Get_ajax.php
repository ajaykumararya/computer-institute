<?php

defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set("Asia/Kolkata"); 

ob_start();            

class Get_ajax extends CI_Controller
 
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
    function payfee_by_center(){
        $return = [];
        $this->form_validation->set_rules('amount','Amount','required|xss_clean|callback_checkwalletbalance');
        $this->form_validation->set_rules('course_id','Course','required|xss_clean');
        $this->form_validation->set_rules('enroll_id','Enrollment Number','required|xss_clean');
        if($return['status'] = $this->form_validation->run()){
            $transaction_id = time();
            $id = $_SESSION['loginid'];
            $amount = $this->input->post('amount');
            $data = [
                    'fee' => $amount,
                    'center_id' => $_SESSION['loginid'],
                    'enroll_no' => $this->input->post('enroll_id'),
                    'course_id' => $this->input->post('course_id'),
                    'year' => $this->input->post('duration'),
                    'time' => $transaction_id
                ];
                
            $this->db->insert('collect_fee',$data);
                $o_b = $this->center_model->open_balance($id);
        
                $ttl = $o_b -  $amount;
                
                $trans = [
                    'o_balance' => abs($o_b),
                    'c_balance' => $ttl,
                    'amount' => abs($amount),
                    'transaction_id' => $transaction_id,
                    'status' => 1,
                    'time' => $transaction_id,
                    'center_id' => $id,
                    'type' =>  'debit' ,
                    'response' => json_encode($data),
                    'via' => 'self'
                    ];
                    
                $this->center_model->add_transaction($trans);
                
                $this->center_model->update_wallet($id,$ttl);
            $return['message'] = '<div class="alert alert-success">Fees Submitted Successfully..</div>';
            $return['data'] = $_POST;
        }
        else{
            $return['message'] = validation_errors('<div class="alert alert-danger">','</div>');
        }
        echo json_encode($return);
    }
    function checkwalletbalance(){
        if($this->input->post('amount') > $this->center_model->get_wallet($_SESSION['loginid'])){
            $this->form_validation->set_message('checkwalletbalance','Your wallet balance is low..');
            return false;
        }
        
        extract($_POST);
        
        $getCourse = $this->db->get_where('courses',['id' => $course_id]);
        if($getCourse->num_rows()){
            $cRow  = $getCourse->row();
            // $data = $post;
            $fees = $cRow->fees; 
            $duration = empty($duration) ? $duration : 0;
            $ttalPA = ($fees  - $this->center_model->collect_fee_by_duration($enroll_id,$course_id));
            if($amount > $ttalPA){
                $this->form_validation->set_message('checkwalletbalance','You enter wrong amount..');
                return false;
            }
        }
        
        return true;
    }
    function get_fee_structer(){
         
            $return = ['status' => false];
        if($post= $this->input->post()){ 
            extract($post);
            $getCourse = $this->db->get_where('courses',['id' => $course_id]);
            if($getCourse->num_rows()){
                $cRow  = $getCourse->row();
                $data = $post;
                $data['fee'] = $cRow->fees; 
                $data['duration'] = empty($duration) ? $duration : 0;
                $data['course'] = $cRow;
                
                $data['collect_fee'] = $this->center_model->collect_fee_by_duration($enroll_id,$course_id,$duration);
                $data['total_collect_fee'] = $this->center_model->collect_fee_by_duration($enroll_id,$course_id);
                $return['html'] = $this->load->view('modules/student_fees',$data,true);
            }
            
        }
         echo json_encode($return);
    }

    public function login()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if (!$this->input->post()) {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {

                $params = $_REQUEST;

               $username = $_POST['user_id'];

               $password = md5($_POST['password']);
                
                
                 $type =  $this->db->query("SELECT * FROM `admin_login` WHERE `USER_NAME` LIKE '".$username."' ")->row('COMPANY_HRM_TYPE');
                
                //$type = 1;
                
                $response = $this->Common_model->login($username, $password, $type);
                // die(var_dump($_SESSION[loginid]));

                json_output($response['status'], $response);

                if ($response['message'] == "ok") {

                        insert_activity_history(1,0);

                    }

            }

        }

    }

    public function logoutside()

    {

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method != 'POST') {

            json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        } else {

            $check_auth_client = $this->Authentication_model->check_auth_client();



            if ($check_auth_client == true) {

                $response = $this->Authentication_model->auth();

                if ($response['status'] == 200) {

                    $response = $this->Common_model->logout();

                    $this->session->sess_destroy();

                    json_output(200, $response);

                    insert_activity_history(2,0);

                } else if ($response['status'] == 303) {

                    $this->Common_model->logout();

                    $this->session->sess_destroy();

                    json_output(401, $response);

                }

            }

        }

    }
      public function get_state()
    {

                    $response = get_city($_POST['stateid']);
                    json_output(200, $response);

    }

    public function get_states()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    $response = get_all_states();
                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    
    
 public function get_enroll()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    // die(var_dump($_POST['sub_id']));
                    $response = get_enroll($_POST['center_id']);


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }   
    
   
    


   public function get_submenu()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    // die(var_dump($_POST['sub_id']));
                    $response = get_submenu($_POST['sub_id']);


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    public function get_subsubmenu()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    // die(var_dump($_POST['sub_id']));
                    $response = get_subsubmenu($_POST['subsub_id']);


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }

    public function get_district()

    {

        // $method = $_SERVER['REQUEST_METHOD'];

        // if ($method != 'POST') {

        //     json_output(400, array('status' => 400, 'message' => 'Bad request.'));

        // } else {

        //     $check_auth_client = $this->Authentication_model->check_auth_client();

        //     if ($check_auth_client == true) {

        //         $response = $this->Authentication_model->auth();

        //         if ($response['status'] == 200) {

                    $response = get_district($_POST['stateid']);

                    json_output(200, $response);

        //         } else if ($response['status'] == 303) {

        //             $this->Common_model->logout();

        //             $this->session->sess_destroy();

        //             json_output(401, $response);

        //         }

        //     }

        // }

    }





    public function volunteer_request_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $status = $_POST['status'];

        $totalData = count_all_volunteer($status);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_volunteer($limit, $start, $order, $dir,$status);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  volunteer_search($limit, $start, $search, $order, $dir,$status);

            $totalFiltered =  volunteer_search_count($search,$status);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {

                if ($post->VOL_STATUS != '1') {

                    $status = '<b style="color:red;">Pending</b>';

                }else{

                    $status = 'Approved';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['VOL_NAME'] = $post->VOL_NAME;

                $nestedData['VOL_EMAIL'] = $post->VOL_EMAIL;

                $nestedData['VOL_PHONE'] = $post->VOL_PHONE;

                $nestedData['VOL_MESSAGE'] = $post->VOL_MESSAGE;

                $nestedData['STATUS'] = $status;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                            <li><a class="update_volunteer"  id="'.$post->VOL_ID.'" volunteerid="'.$post->VOL_ID.'" volunteer_name="'.$post->VOL_NAME.'" vol_email="'.$post->VOL_EMAIL.'" vol_num="'.$post->VOL_PHONE.'" massage="'.$post->VOL_MESSAGE.'" href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>

                            <li class="divider"></li>

                             <li><a class="delete_volunteer"  id="'.$post->VOL_ID.'" deletevol="'.$post->VOL_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';     
                // '<a class=" edit_measurement_model  mid="'.$post->VOL_ID.'" mname="'.$post->VOL_ID.'"" measureid="'.$post->VOL_ID.'"" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>';

                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }

    // vision
    public function vision_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_vision();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_vision($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  vision_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  vision_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {

                $nestedData['SR_NO'] = $i;

                $nestedData['VOL_NAME'] = $post->VISION_TITLE;

                $nestedData['VOL_EMAIL'] = $post->VISION_DESCRIPTION;

               

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                            <li><a class="update_vision"  id="'.$post->VISION_ID.'" visionid="'.$post->VISION_ID.'" visiontitle="'.$post->VISION_TITLE.'" visiondesc="'.$post->VISION_DESCRIPTION.'"  href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>

                            <li class="divider"></li>

                             <li><a class="delete_vision"  id="'.$post->VISION_ID.'" deletevision="'.$post->VISION_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';     
                // '<a class=" edit_measurement_model  mid="'.$post->VOL_ID.'" mname="'.$post->VOL_ID.'"" measureid="'.$post->VOL_ID.'"" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>';

                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }





    public function feedback_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $status = $_POST['status'];

        $totalData = count_all_feedback($status);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_feedback($limit, $start, $order, $dir,$status);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  feedback_search($limit, $start, $search, $order, $dir,$status);

            $totalFiltered =  feedback_search_count($search,$status);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {

                if ($post->FB_STATUS != '1') {

                    $status = '<b style="color:red;">Pending</b>';

                }else{

                    $status = '<b style="color:green;">Published</b>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['FB_PER_NAME'] = $post->FB_PER_NAME;

                $nestedData['FB_COMMENT'] = $post->FB_COMMENT;

               $nestedData['STATUS'] = $status;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                            <li><a class="delete_feedback" id="'.$post->FEEDBACK_ID.'" feedbackid="'.$post->FEEDBACK_ID.'"  href="javascript:void(0);"><i class="fa fa-upload"> Remove Feedback </i></a></li>

                           
                          </ul>

                        </div>                      

                    

                    

                    ';    

                // '

                //     <a class=" publish_feedback  id="'.$post->FEEDBACK_ID.'" feedbackid="'.$post->FEEDBACK_ID.'" " href="javascript:void(0);"><i class="fa fa-upload"> Click To Publish</i></a>

                   

                //     ';

                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }







    public function color_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BLOG_TITLE',
            2 => 'BLOG_TITLE',
            3 => 'BLOG_TITLE',
            4 => 'BLOG_TITLE',
            5 => 'BLOG_TITLE',
            6 => 'BLOG_TITLE',
            7 => 'BLOG_TITLE',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status = $_POST['status'];
        //$page_name = $_POST['page_name'];
        $totalData = count_all_color_setting();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_color_setting($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  color_setting_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  color_setting_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
               
               if($post->CS_HOVER_STATUS == 1){
                   $back_color = '<input type="text" id="hover_bc_'.$post->CS_ID.'" onchange="update_background_hover_color('.$post->CS_ID.')" value="'.$post->CS_BACKGROUN_HOVER.'"> ';
                   $font_color = '<input type="text" id="hover_font_'.$post->CS_ID.'" onchange="update_hover_color('.$post->CS_ID.')" value="'.$post->CS_FONT_HOVER.'"> ';
               }else{
                    $back_color = ' ';
                   $font_color = ' ';
               }
               
                $nestedData['SR_NO'] = $i;
                $nestedData['CS_NAME'] = @$post->CS_NAME;
                $nestedData['CS_CODE'] = '<input type="text" id="color_'.$post->CS_ID.'" onchange="update_background_color('.$post->CS_ID.')" value="'.$post->CS_CODE.'"> ';
                $nestedData['CS_COLOR'] = '<input type="text" id="font_'.$post->CS_ID.'" onchange="update_color('.$post->CS_ID.')" value="'.$post->CS_COLOR.'"> ';
				$nestedData['CS_BACKGROUN_HOVER'] = $back_color;
				$nestedData['CS_FONT_HOVER'] = $font_color;
			
                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }





    public function fquestion_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'FQUESTION',
            2 => 'FQUESTION',
            3 => 'FQUESTION',
            4 => 'FQUESTION',
            5 => 'FQUESTION',
            6 => 'FQUESTION',
            7 => 'FQUESTION',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = $_POST['status'];
        $code = $_POST['code'];
        $totalData = count_all_question($status,$code);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_question($limit, $start, $order, $dir,$status,$code);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  question_search($limit, $start, $search, $order, $dir,$status,$code);
            $totalFiltered =  question_search_count($search,$status,$code);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                if ($post->FSTATUS != '1') {
                    $status = '<b style="color:red;">Pending</b>';
                }else{
                    $status = '<b style="color:green;">Published</b>';
                }
                $nestedData['SR_NO'] = $i;
                $nestedData['FQUESTION'] = $post->FQUESTION;
                $nestedData['FANSWER'] = $post->FANSWER;
                $nestedData['FSTATUS'] = $status;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" publish_question  id="'.$post->FQUESTION_ID.'" questionid="'.$post->FQUESTION_ID.'" " href="javascript:void(0);"><i class="fa fa-upload"> Click To Publish</i></a></li>
                            <li class="divider"></li>
                             <li><a  href="'.site_url('admin/fquestion/'.$post->PAGE_MENU_CODE.'/'.$post->FQUESTION_ID.' ').'"><i class="fa fa-edit"> Update</i></a></li>
                            <li class="divider"></li>                             
                                <li><a class=" delete_fquestion"  id="'.$post->FQUESTION_ID.'" fquestiondeleteid="'.$post->FQUESTION_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



    public function member_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEMBER_NAME',

            2 => 'MEMBER_NAME',

            3 => 'MEMBER_NAME',

            4 => 'MEMBER_NAME',

            5 => 'MEMBER_NAME',

            6 => 'MEMBER_NAME',

            7 => 'MEMBER_NAME',

            8 => 'MEMBER_NAME',

            9 => 'MEMBER_NAME',

            10 => 'MEMBER_NAME',

            11 => 'MEMBER_NAME',

            12 => 'MEMBER_NAME',

            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $status = $_POST['status'];

        $totalData = count_all_member($status);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_member($limit, $start, $order, $dir,$status);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  member_search($limit, $start, $search, $order, $dir,$status);

            $totalFiltered =  member_search_count($search,$status);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {

                if ($post->MEMBER_STATUS != '1') {

                    $status = '<b style="color:red;">Pending</b>';

                }else{

                    $status = '<b style="color:green;">Published</b>';

                }



                 if ($post->MEMBER_PHOTO != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->MEMBER_PHOTO.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->MEMBER_PHOTO.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->MEMBER_PHOTO.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }









                $nestedData['SR_NO'] = $i;

                $nestedData['MEMBER_PHOTO'] = $image;

                $nestedData['MEMBER_NAME'] = $post->MEMBER_NAME;

                $nestedData['MEMBER_CONTACT'] = $post->MEMBER_CONTACT;

                $nestedData['MEMBER_ADDRESS'] = $post->MEMBER_ADDRESS;

                $nestedData['MEMBER_POST'] = $post->MEMBER_POST;

                $nestedData['MEMBER_STATE'] = $post->STATE_NAME;

                $nestedData['MEMBER_DISTRICT'] = $post->DISTRICT_NAME;

                $nestedData['MEMBER_ABOUT_US'] = $post->MEMBER_ABOUT_US;

                $nestedData['MEMBER_STATUS'] = $status;

                

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>
       

                          <ul class="dropdown-menu" role="menu">

                            <li><a class=" publish_member  id="'.$post->MEMBER_ID.'" memberid="'.$post->MEMBER_ID.'" " href="javascript:void(0);"><i class="fa fa-upload"> Publish</i></a></li>

                            <li class="divider"></li>

                             <li><a class=" update_member  id="'.$post->MEMBER_ID.'" memberid="'.$post->MEMBER_ID.'" member_name="'.$post->MEMBER_NAME.'" member_contact="'.$post->MEMBER_CONTACT.'" member_address="'.$post->MEMBER_ADDRESS.'" member_post="'.$post->MEMBER_POST.'" member_aboutus="'.$post->MEMBER_ABOUT_US.'" " href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class=" delete_member"  id="'.$post->MEMBER_ID.'" memberdeleteid="'.$post->MEMBER_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';    



               

                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }

public function subscriber_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEMBER_NAME',

        
        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $status = $_POST['status'];

        $totalData = count_all_subscriber($status);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_subscriber($limit, $start, $order, $dir,$status);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  subscriber_search($limit, $start, $search, $order, $dir,$status);

            $totalFiltered = subscriber_search_count($search,$status);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                
                 $nestedData['SR_NO'] = $i;

                $nestedData['EMAIL'] = $post->email;

            
    
                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }



    public function enquiry_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEMBER_NAME',

            2 => 'MEMBER_NAME',

            3 => 'MEMBER_NAME',

            4 => 'MEMBER_NAME',

            5 => 'MEMBER_NAME',

            6 => 'MEMBER_NAME',

            7 => 'MEMBER_NAME',

            8 => 'MEMBER_NAME',

            9 => 'MEMBER_NAME',

            10 => 'MEMBER_NAME',

            11 => 'MEMBER_NAME',

            12 => 'MEMBER_NAME',

        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = 'DESC';
        //$dir = $this->input->post('order')[0]['dir'];

        $status = $_POST['status'];

        $totalData = count_all_enquiry($status);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_enquiry($limit, $start, $order, $dir,$status);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  enquiry_search($limit, $start, $search, $order, $dir,$status);

            $totalFiltered = enquiry_search_count($search,$status);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                
                 $nestedData['SR_NO'] = $i;

                $nestedData['PERSON_NAME'] = $post->PERSON_NAME;

                $nestedData['PERSON_EMAIL'] = $post->PERSON_EMAIL;

                $nestedData['PERSON_SUBJECT'] = $post->PERSON_SUBJECT;

                $nestedData['PERSON_COMMENT'] = $post->PERSON_COMMENT;
                
                
                $nestedData['PERSON_MOBILE'] = $post->PERSON_MOBILE;
          /*     
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class="update_enquiry"  id="'.$post->CONTACT_ID.'" enquiryid="'.$post->CONTACT_ID.'" enquiry_name="'.$post->PERSON_NAME.'" enquiry_email="'.$post->PERSON_EMAIL.'" enquiry_subject="'.$post->PERSON_SUBJECT.'" enquiry_comment="'.$post->PERSON_COMMENT.'"  href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>
                            <li class="divider"></li>
                             <li><a class="delete_enquiry"  id="'.$post->CONTACT_ID.'" deleteenquiry="'.$post->CONTACT_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';

*/
                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // admit card lisst
    
    public function admit_card_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEMBER_NAME',

            2 => 'MEMBER_NAME',

            3 => 'MEMBER_NAME',

            4 => 'MEMBER_NAME',

            5 => 'MEMBER_NAME',

            6 => 'MEMBER_NAME',

            7 => 'MEMBER_NAME',

            8 => 'MEMBER_NAME',

            9 => 'MEMBER_NAME',

            10 => 'MEMBER_NAME',

            11 => 'MEMBER_NAME',

            12 => 'MEMBER_NAME',

        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        $status = $_POST['status'];

        $totalData = count_all_admit_card($status);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_admit_card($limit, $start, $order, $dir,$status);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  admit_card_search($limit, $start, $search, $order, $dir,$status);

            $totalFiltered = admit_card_search_count($search,$status);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                
                 $nestedData['SR_NO'] = $i;

                $nestedData['Enrollment'] = $post->enrollment_no;

                $nestedData['Name'] = $post->name;

                $nestedData['Roll'] = $post->roll_no;

                $nestedData['Course'] = $post->course_name;
                $nestedData['year'] = $post->year;
              
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class="update_enquiry"    href="'.base_url('admin/create_admit_card/').@$post->card_id.'"><i class="fa fa-upload"> Update</i></a></li>
                            <li class="divider"></li>
                             <li><a class="delete_enquiry" onclick="delete_admit_card('.$post->card_id.')"    href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';


                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // SLIDER LIST

    public function slider_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_slider_details();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_slider_details($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  slider_details_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  slider_details_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if ($post->slider_image != '') {

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->slider_image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->slider_image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->slider_image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['BLOG_IMAGE'] = $slider_image;
                $nestedData['BLOG_ID'] = $post->rs_id;

                $nestedData['BLOG_TITLE'] = $post->title;

                $nestedData['BLOG_DESC1'] = $post->discription1;
                // $nestedData['BLOG_DESC2'] = $post->discription2;

                // $nestedData['STATUS'] = $post->button_label;
                
                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class=" update_slider_detail"  id="'.$post->id.'" updatesliderid="'.$post->id.'"
                             slider_id="'.$post->rs_id.'" slider_title="'.$post->title.'" slider_desc1="'.$post->discription1.'" slider_desc2="'.$post->discription2.'" slider_button="'.$post->button_label.'" href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class=" delete_slider_detail"  id="'.$post->id.'" sliderdeleteid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // 

    public function cause_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_causes_details();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_causes_details($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  causes_details_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  causes_details_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if ($post->image_url != '') {

                    $image_url = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image_url.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image_url.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $image_url = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image_url.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['BLOG_IMAGE'] =$image_url;
                $nestedData['BLOG_ID'] = $post->causes;

                $nestedData['BLOG_TITLE'] = $post->cause_title;

                $nestedData['BLOG_DESC1'] = $post->cause_desc;
                $nestedData['BLOG_DESC2'] = $post->raised;
                $nestedData['BLOG_goal'] = $post->goal;

                $nestedData['STATUS'] = $post->button_name;
                
                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class=" update_causes_detail"  id="'.$post->id.'" updatecausesid="'.$post->id.'"
                             cause_title="'.$post->cause_title.'" causes="'.$post->causes.'" cause_desc="'.$post->cause_desc.'" raised="'.$post->raised.'" goal="'.$post->goal.'" button_name="'.$post->button_name.'" href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class=" delete_causes_detail"  id="'.$post->id.'" causesdeleteid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }

    //  public function slider_list()

    // {

    //     $columns = array(

    //         0 => 'SR_NO',

    //         1 => 'BLOG_TITLE',

    //         2 => 'BLOG_TITLE',

    //         3 => 'BLOG_TITLE',

    //         4 => 'BLOG_TITLE',

    //         5 => 'BLOG_TITLE',

    //         6 => 'BLOG_TITLE',

    //         7 => 'BLOG_TITLE',
    //         // 8 => 'BLOG_TITLE',
    //     );

    //     $limit = $this->input->post('length');

    //     $start = $this->input->post('start');

    //     $order = $columns[$this->input->post('order')[0]['column']];

    //     $dir = $this->input->post('order')[0]['dir'];

    //     // $status = $_POST['status'];

    //     // $page_name = $_POST['page_name'];

    //     $totalData = count_all_slider_details();

    //     $totalFiltered = $totalData;

    //     if (empty($this->input->post('search')['value'])) {

    //         $posts = all_slider_details($limit, $start, $order, $dir);

    //     } else {

    //         $search = $this->input->post('search')['value'];

    //         $posts =  slider_details_search($limit, $start, $search, $order, $dir);

    //         $totalFiltered =  slider_details_search_count($search);

    //     }

    //     $data = array();

    //     if (!empty($posts)) {

    //         $i = $start + 1;

    //         foreach ($posts as $post) {
    //              if ($post->slider_image != '') {

    //                 $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

    //                                             <div class="project">

    //                                                 <div class="photo-wrapper">

    //                                                     <div class="photo">

    //                                                         <a class="fancybox"  href="'.base_url('uploads/').$post->slider_image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->slider_image.'" alt=""></a>

    //                                                     </div>

    //                                                     <div class="overlay"></div>

    //                                                 </div>

    //                                             </div>

    //                                         </div>';

    //             }else{

    //                 $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

    //                                             <div class="project">

    //                                                 <div class="photo-wrapper">

    //                                                     <div class="photo">

    //                                                         <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->slider_image.'" alt=""></a>

    //                                                     </div>

    //                                                     <div class="overlay"></div>

    //                                                 </div>

    //                                             </div>

    //                                         </div>';

    //             }

    //             $nestedData['SR_NO'] = $i;

    //             $nestedData['BLOG_IMAGE'] = $slider_image;
    //             $nestedData['BLOG_ID'] = $post->rs_id;

    //             $nestedData['BLOG_TITLE'] = $post->title;

    //             $nestedData['BLOG_DESC1'] = $post->discription1;
    //             $nestedData['BLOG_DESC2'] = $post->discription2;

    //             $nestedData['STATUS'] = $post->button_label;
                
    //             $nestedData['ACTION'] = '

    //                     <div style="min-width:100px;" class="btn-group">

    //                       <button type="button" class="btn btn-theme03">Action</button>

    //                       <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

    //                         <span class="caret"></span>

    //                         <span class="sr-only">Toggle Dropdown</span>

    //                       </button>

    //                       <ul class="dropdown-menu" role="menu">

    //                          <li><a class=" update_slider_detail"  id="'.$post->id.'" updatesliderid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

    //                         <li class="divider"></li>                             

    //                             <li><a class=" delete_slider_detail"  id="'.$post->id.'" sliderdeleteid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

    //                       </ul>

    //                     </div>                      

                    

                    

    //                 ';

    //            }





                

    //             $i++;

    //             $data[] = $nestedData;

    //         }

        

    //     $json_data = array(

    //         "draw"            => intval($this->input->post('draw')),

    //         "recordsTotal"    => intval($totalData),

    //         "recordsFiltered" => intval($totalFiltered),

    //         "data"            => $data

    //     );

    //     echo json_encode($json_data);

    // }
    // END SLIDER LIST
    // agent wallet

    public function wallet_list()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',



            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        $agentid = 2;

        $totalData = count_all_wallet($agentid);



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_wallet($limit, $start, $order, $dir,$agentid);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  wallet_search($limit, $start, $search, $order, $dir,$agentid);



            $totalFiltered =  wallet_search_count($search,$agentid);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {



                $nestedData['SR_NO'] = $i;
                $nestedData['loginid'] = $post->ADMIN_ID;




                $nestedData['VOL_NAME'] = $post->ADMIN_NAME;



                $nestedData['VOL_EMAIL'] = '

                                                        <a href="javascript:;" class="add_wallet btn btn-success btn-sm pull-left " id="'.$post->ADMIN_ID .'" agentid="'.$post->ADMIN_ID .'">ADD WALLET</a>



                       ';  
                $nestedData['amt'] = $post->wallet_amount;

                       $nestedData['ACTION'] = '



                        <div style="min-width:100px;" class="btn-group">



                          <button type="button" class="btn btn-theme03">Action</button>



                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">



                            <span class="caret"></span>



                            <span class="sr-only">Toggle Dropdown</span>



                          </button>



                          <ul class="dropdown-menu" role="menu">



                            <li><a class="update_vision"  id="'.$post->ADMIN_ID .'" updateagentid="'.$post->ADMIN_ID .'"   href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>



                            <li class="divider"></li>



                             <li><a class="delete_vision"  id="'.$post->ADMIN_ID.'" deleteagentid="'.$post->ADMIN_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>



                          </ul>



                        </div>                      



                    



                    



                    ';     



               



         


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
        //AGENT  wallet REQUEST

    public function account_statement()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',



            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];


	      $from =  date("Y-m-d", strtotime($_POST['from']));
        $to =  date("Y-m-d", strtotime($_POST['to']));


       

        $totalData = count_all_account_statement($from,$to);



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_account_statement($limit, $start, $order, $dir,$from,$to);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  account_statement_search($limit, $start, $search, $order, $dir,$from,$to);



            $totalFiltered =  account_statement_search_count($search,$from,$to);



        }




        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {

             if ($post->status == '1') {

                  $status = '<b style="color:green;">APPROVED</b>';

                }elseif($post->status == '2'){

                    $status = '<b style="color:red;">REJECT</b>';

                }else{
                    $status = '<b style="color:blue;">pending</b>';

                }


                $nestedData['SR_NO'] = $i;
                $nestedData['name'] = $post->ADMIN_NAME;
                $nestedData['request'] = $post->date;
                $nestedData['ACTION'] = $post->action_date;
                $nestedData['transaction'] = $post->transaction_id;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['amount'] = $post->amount;
                $nestedData['massage'] =  $post->massage;
				if (!empty($post->receipt)) {
                
				 $nestedData['reciept'] =
				' <a href="'.base_url('download/').$post->receipt.'">download </a>';
				}else{
					 $nestedData['reciept'] =
					'<b style="color:red;">NOT AVAILABLE</b>';
				}

                $nestedData['status'] = $status;



         


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
        //AGENT  wallet REQUEST

    public function agent_wallet_request()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            // 8 => 'MEASUREMENT_NAME',



            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

       

        $totalData = count_all_agent_wallet_request();



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_agent_wallet_request($limit, $start, $order, $dir);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  agent_wallet_request_search($limit, $start, $search, $order, $dir);



            $totalFiltered =  agent_wallet_request_search_count($search);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {

             if ($post->status == '1') {

                  $status = '<b style="color:green;">APPROVED</b>';

                }elseif($post->status == '2'){

                    $status = '<b style="color:red;">REJECT</b>';

                }else{
                    $status = '<b style="color:blue;">pending</b>';

                }


                $nestedData['SR_NO'] = $i;
                $nestedData['name'] = $post->ADMIN_NAME;
                $nestedData['request'] = $post->date;
                $nestedData['transaction'] = $post->transaction_id;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['amount'] = $post->amount;
                $nestedData['massage'] =  $post->massage;
				if (!empty($post->receipt)) {
                
				 $nestedData['reciept'] =
				' <a href="'.base_url('download/').$post->receipt.'">download </a>';
				}else{
					 $nestedData['reciept'] =
					'<b style="color:red;">NOT AVAILABLE</b>';
				}

                $nestedData['status'] = $status;


$nestedData['ACTION'] = '



                        <div style="min-width:100px;" class="btn-group">



                          <button type="button" class="btn btn-theme03">Action</button>



                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">



                            <span class="caret"></span>



                            <span class="sr-only">Toggle Dropdown</span>



                          </button>



                          <ul class="dropdown-menu" role="menu">



                            <li><a class="approved" id="'.$post->id.'" request_id="'.$post->id.'" agentrequest_id="'.$post->agent_id.'" href="javascript:void(0);"><i class="fa fa-upload"> APPROVED</i></a></li>



                            <li class="divider"></li>



                             <li><a class="reject" reject_id="'.$post->id.'" data-agentid="'.$post->id.'" agentreject_id="'.$post->agent_id.'" href="javascript:void(0);"><i class="fa fa-edit"> REJECT</i></a></li>



                          </ul>



                        </div>                      



                    



                    



                    ';     


               



         


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
//  account statement


     //  wallet REQUEST

    public function wallet_request_list()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',



            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        $agentid = $_SESSION['loginid'];

        $totalData = count_all_wallet_request($agentid);



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_wallet_request($limit, $start, $order, $dir,$agentid);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  wallet_request_search($limit, $start, $search, $order, $dir,$agentid);



            $totalFiltered =  wallet_request_search_count($search,$agentid);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {

             if ($post->status != '0') {

                  $status = '<b style="color:green;">RECHARGE BY ADMIN</b>';

                }else{

                    $status = '<b style="color:red;">PENDING</b>';

                }


                $nestedData['SR_NO'] = $i;
                 $nestedData['request'] = $post->date;
                $nestedData['action_date'] = $post->action_date;
                $nestedData['bank_name'] = $post->bank_name;
                $nestedData['amount'] = $post->amount;
               
                $nestedData['massage'] = $post->massage;
                $nestedData['status'] = $status;
                    if($post->status == '0'){

                 $nestedData['ACTION'] = '

                                                        <a href="javascript:;" class="cancel_request btn btn-success btn-sm pull-left " id="'.$post->id .'" data-requestcancelid="'.$post->id .'">CANCEL REQUEST</a>



                       ';  
                   }else{

                             $nestedData['ACTION'] = '<b style="color:red;">ACTION TEKEN</b>';

                   }


               



         


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
    // agent wallet

    public function wallet_amount_list()



    {



        $columns = array(



            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            // 8 => 'MEASUREMENT_NAME',

        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        $agentid = $_SESSION['loginid'];

        $totalData = count_all_wallet_amount($agentid);



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_wallet_amount($limit, $start, $order, $dir,$agentid);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  wallet_amount_search($limit, $start, $search, $order, $dir,$agentid);



            $totalFiltered =  wallet_amount_search_count($search,$agentid);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;

            

            foreach ($posts as $post) {
                  if ($post->type != '1') {

                  $debit = '<b style="color:green;">CREDIT BY ADMIN</b>';

                }else{

                    $debit = '<b style="color:red;">DEBIT BY AGENT</b>';

                }

                //  if ($post->type != '1') {

                //     $debit = '<b style="color:green;">CREDIT BY ADMIN</b>';
                //     // $wallet = '<b style="color:green;">CREDIT BY ADMIN</b>';
                //     // $massage = '<b style="color:green;">CREDIT BY ADMIN</b>';

                // }else{

                //     $debit = '<b style="color:red;">DEBIT BY AGENT</b>';

                // }

                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->date;
                $nestedData['transaction'] = $post->form_fee;
                $nestedData['wallet'] = $post->total;
                $nestedData['debit'] = $debit;
                $nestedData['VOL_EMAIL'] =  $post->form_name;
                $nestedData['form_fee'] =  $post->form_fee;
                $nestedData['massage'] = $post->description;



                


                       
                // '<a class=" edit_measurement_model  mid="'.$post->VOL_ID.'" mname="'.$post->VOL_ID.'"" measureid="'.$post->VOL_ID.'"" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>';

               



     


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
    // wallet report between date to admin
    public function wallet_report_date()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status = $_POST['status'];
		 $from =  date("Y-m-d", strtotime($_POST['from']));
        $to =  date("Y-m-d", strtotime($_POST['to']));

        $totalData = count_all_wallet_report_date($from,$to);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_wallet_report_date($limit, $start, $order, $dir,$from,$to);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  wallet_report_date_search($limit, $start, $search, $order, $dir,$from,$to);
            $totalFiltered =  wallet_report_date_search_count($search,$from,$to);
       }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;        
            foreach ($posts as $post) {
                  if ($post->type != '1') {

                  $debit = '<b style="color:green;">CREDIT BY ADMIN</b>';

                }else{

                    $debit = '<b style="color:red;">DEBIT BY AGENT</b>';

                }
                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->date;
                $nestedData['agent_name'] = $post->ADMIN_NAME;
                $nestedData['transaction'] = $post->form_fee;
                $nestedData['wallet'] = $post->total;
                $nestedData['debit'] = $debit;
                $nestedData['VOL_EMAIL'] =  $post->form_name;
                $nestedData['form_fee'] =  $post->form_fee;
                $nestedData['massage'] = $post->description;
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );



        echo json_encode($json_data);



    }
	 public function wallet_report()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status = $_POST['status'];
	
        $totalData = count_all_wallet_report();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_wallet_report($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  wallet_report_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  wallet_report_search_count($search);
       }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;        
            foreach ($posts as $post) {
                  if ($post->type != '1') {

                  $debit = '<b style="color:green;">CREDIT BY ADMIN</b>';

                }else{

                    $debit = '<b style="color:red;">DEBIT BY AGENT</b>';

                }
                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->date;
                $nestedData['agent_name'] = $post->ADMIN_NAME;
                $nestedData['transaction'] = $post->form_fee;
                $nestedData['wallet'] = $post->total;
                $nestedData['debit'] = $debit;
                $nestedData['VOL_EMAIL'] =  $post->form_name;
                $nestedData['form_fee'] =  $post->form_fee;
                $nestedData['massage'] = $post->description;
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );



        echo json_encode($json_data);



    }
    // ALL RESULT
    function update_date(){
        if($post = $this->input->post()){
            unset($post['crsftoken']);
            $where = ['type' => $post['type'],'type_id' => $post['type_id']];
            $get = $this->db->where($where)->get('gen_date');
            if($get->num_rows())
                $this->db->where($where)->update('gen_date',$post);
            else
                $this->db->insert('gen_date',$post);
            echo json_encode(['status' => 'done']);
        }
    }
    public function result_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
        }
        $totalData = count_all_result($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_result($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  all_result_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  all_result_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $year=date('Y',strtotime(@$post->timestamp));
                
                if($post->COURSE_TYPE==2){ 
                    $duration = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->PASSING_YEAR.' Year </span>';
                    $course_timing = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->YEAR_DURATION.' Year </span>';
                    
                }
                elseif($post->COURSE_TYPE==3){ 
                    $duration = '<span class="label label-success arrowed-in arrowed-in-right  col-md-10" style="padding: 5px;">'.numberToRomanRepresentation($post->PASSING_YEAR).'-Semester </span>';
                    $course_timing = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->MONTH_DURATION.' Semesters </span>';
                }else{
                    $duration = '<span class="label label-success arrowed-in arrowed-in-right  col-md-10" style="padding: 5px;">'.$post->MONTH_DURATION.'-Months </span>';
                    $course_timing = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->MONTH_DURATION.' Months </span>';
                    
                }
                
                $course_code = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->COURSE_CODE.'  </span>'; 
                $enrollment = '<span class="label label-success arrowed-in arrowed-in-right  col-md-10" style="padding: 10px;">'.$post->ENROLLMENT_NO.' </span>';
                
                $nestedData['SR_NO'] = $i;
                $nestedData['STUDENT'] = $post->STUDENT_NAME.$enrollment.$duration;
                $nestedData['ROLL_NO'] = $post->ROLL_NO;
                $nestedData['COURSE'] = $post->COURSE_NAME.$course_code.$course_timing;
                $nestedData['YEAR'] = @$post->BATCH_NAME;
                $nestedData['SESSION'] = $post->CENTER_NUMBER;
                $nestedData['SUBJECT'] = $post->CENTER_NAME;
                $getDate = '';
                $genDate = $this->db->where(['type_id' => $post->RESULT_ID,'type' => 'marksheet'])->get('gen_date');
                if($genDate->num_rows()){
                    $getDate = $genDate->row()->date;
                }
                else{
                    $marks = $this->db->query("SELECT * FROM marks_table where result_id = '".$post->RESULT_ID."' LIMIT 1");
                    if($marks->num_rows()){
                        $getDate = $marks->row()->timestamp;
                    }
                }
                
                
                $nestedData['GENRATE_DATE'] = '<input type="date" class="update-date" data-type="marksheet" data-type_id="'.$post->RESULT_ID.'" value="'.date('Y-m-d',strtotime($getDate)).'">';
                $nestedData['ACTION'] = '<div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=""   href="'.base_url('admin/update_result/').$post->RESULT_ID.'"><i class="fa fa-upload"> Update</i></a></li>
                            <li class="divider"></li>
                                  <li><a class="delete_result" delete_result_id="'.$post->RESULT_ID.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                             <li class="divider"></li>
                                  <li><a class=""   href="'.base_url('printpdf/print_marksheet/').AJ_ENCODE($post->RESULT_ID).'" target="_blank" ><i class="fa fa-edit"> DOWNLOAD RESULT</i></a></li>
                          </ul>
                        </div>';     
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


     // add agent

    public function add_agent_list()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',


            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        $agentid = 2;

        $totalData = count_all_add_agent($agentid);



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_add_agent($limit, $start, $order, $dir,$agentid);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  add_agent_search($limit, $start, $search, $order, $dir,$agentid);



            $totalFiltered =  add_agent_search_count($search,$agentid);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {

                                 if($post->ADMIN_STATUS == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }


                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->ADMIN_NAME;
                $nestedData['VOL_EMAIL'] =  $post->USER_NAME;
                $nestedData['form_fee'] =   $post->PASSWORD_VIEW;
                $nestedData['dpt_name'] =   $post->dpt_name;
                  $nestedData['pay'] ='<label>
                    <input type="checkbox" data-id="'.$post->ADMIN_ID.'" class="checkitem change-admin"'.$checked.'/>
                      </label>'               
                   ;

                    
                $nestedData['ACTION'] = '



                        <div style="min-width:100px;" class="btn-group">



                          <button type="button" class="btn btn-theme03">Action</button>



                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">



                            <span class="caret"></span>



                            <span class="sr-only">Toggle Dropdown</span>



                          </button>



                          <ul class="dropdown-menu" role="menu">



                            <li><a class="update_agent" agentid="'.$post->ADMIN_ID.'" agentpass="'.$post->ADMIN_PASSWORD.'" agentname="'.$post->ADMIN_NAME.'" agentusername="'.$post->USER_NAME.'"  href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>



                            <li class="divider"></li>



                             <li><a class="delete_agent" deleteagentid="'.$post->ADMIN_ID.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>



                          </ul>



                        </div>                      



                    



                    



                    ';     

                


                       
                // '<a class=" edit_measurement_model  mid="'.$post->VOL_ID.'" mname="'.$post->VOL_ID.'"" measureid="'.$post->VOL_ID.'"" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>';

               



     


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
    // service list
      

    public function service_list()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',


            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        // $agentid = 2;

        $totalData = count_all_service_list();



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_service_list($limit, $start, $order, $dir);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  service_list_search($limit, $start, $search, $order, $dir);



            $totalFiltered =  service_list_search_count($search);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {

                                 if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }


                $nestedData['SR_NO'] = $i;
                // $nestedData['date'] = $post->ADMIN_NAME;
                $nestedData['NAME'] =  $post->form_menu;
                $nestedData['FEE'] =   $post->form_fee;
                $nestedData['DPT'] =   $post->dpt_name;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->form_id.'" class="checkitem change-service"'.$checked.'/>
                      </label>'               
                   ;
                 $nestedData['comment'] ='<a href="javascript:;" class="add_service_comment btn btn-success btn-sm pull-left " serviceid="'.$post->form_id .'">ADD COMMENT</a> '   
                   ;
                      

                


                       

               



     


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
    // service list user
      

    public function service_list_user()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',


            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        $agentid = $_SESSION['loginid'];

        $totalData = count_all_service_list_user($agentid);



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_service_list_user($limit, $start, $order, $dir,$agentid);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  service_list_user_search($limit, $start, $search, $order, $dir,$agentid);



            $totalFiltered =  service_list_user_search_count($search,$agentid   );



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {

                                 if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }


                $nestedData['SR_NO'] = $i;
                // $nestedData['date'] = $post->ADMIN_NAME;
                $nestedData['NAME'] =  $post->form_menu;
                $nestedData['FEE'] =   $post->form_fee;
                $nestedData['DPT'] =   $post->dpt_name;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->form_id.'" class="checkitem change-service"'.$checked.'/>
                      </label>'               
                   ;
                 $nestedData['comment'] ='<a href="javascript:;" class="add_service_comment btn btn-success btn-sm pull-left " serviceid="'.$post->form_id .'">ADD COMMENT</a> '   
                   ;
                      

                


                       

               



     


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
       // plan list

    public function plan_list()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',


            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        // $agentid = 2;

        $totalData = count_all_plan_list();



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_plan_list($limit, $start, $order, $dir);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  plan_list_search($limit, $start, $search, $order, $dir);



            $totalFiltered =  plan_list_search_count($search);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {



                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->plan_id;
                $nestedData['VOL_EMAIL'] =  $post->plan_name;
                $nestedData['form_fee'] =   $post->commision;
                    $nestedData['ACTION'] = '



                        <div style="min-width:100px;" class="btn-group">



                          <button type="button" class="btn btn-theme03">Action</button>



                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">



                            <span class="caret"></span>



                            <span class="sr-only">Toggle Dropdown</span>



                          </button>



                          <ul class="dropdown-menu" role="menu">



                            <li><a class="update_plan" plan_id="'.$post->id.'" planid="'.$post->plan_id.'" planname="'.$post->plan_name.'" update_commision="'.$post->commision.'"  href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>



                            <li class="divider"></li>



                             <li><a class="delete_plan" deleteplanid="'.$post->id.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>



                          </ul>



                        </div>                      



                    



                    



                    ';     


                


                       
                // '<a class=" edit_measurement_model  mid="'.$post->VOL_ID.'" mname="'.$post->VOL_ID.'"" measureid="'.$post->VOL_ID.'"" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>';

               



     


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
  // // UPLOAD  DOCUMENT

  //   public function upload_document_list()



  //   {



  //       $columns = array(



  //           0 => 'SR_NO',



  //           1 => 'MEASUREMENT_NAME',



  //           2 => 'MEASUREMENT_NAME',



  //           3 => 'MEASUREMENT_NAME',
  //           4 => 'MEASUREMENT_NAME',


            







  //       );



  //       $limit = $this->input->post('length');



  //       $start = $this->input->post('start');



  //       $order = $columns[$this->input->post('order')[0]['column']];



  //       $dir = $this->input->post('order')[0]['dir'];



  //       // $status = $_POST['status'];

  //       $agentid = 2;

  //       $totalData = count_all_upload_document($agentid);



  //       $totalFiltered = $totalData;



  //       if (empty($this->input->post('search')['value'])) {



  //           $posts = all_upload_document($limit, $start, $order, $dir,$agentid);



  //       } else {



  //           $search = $this->input->post('search')['value'];



  //           $posts =  upload_document_search($limit, $start, $search, $order, $dir,$agentid);



  //           $totalFiltered =  upload_document_search_count($search,$agentid);



  //       }



  //       $data = array();



  //       if (!empty($posts)) {



  //           $i = $start + 1;



  //           foreach ($posts as $post) {



  //               $nestedData['SR_NO'] = $i;
  //               $nestedData['date'] = $post->ADMIN_NAME;
  //               $nestedData['VOL_EMAIL'] =  $post->forms_name;
  //               $nestedData['form_fee'] =  '

  //                                                       <a href="javascript:;" class="add_document btn btn-success btn-sm pull-left " id="'.$post->ADMIN_ID .'" form_id="'.$post->form_id .'" form_name="'.$post->forms_name .'" agent_id="'.$post->agent_id .'">UPLOAD DOCUMENT</a>



  //                      ';  
  //                   $nestedData['ACTION'] = '



  //                       <div style="min-width:100px;" class="btn-group">



  //                         <button type="button" class="btn btn-theme03">Action</button>



  //                         <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">



  //                           <span class="caret"></span>



  //                           <span class="sr-only">Toggle Dropdown</span>



  //                         </button>



  //                         <ul class="dropdown-menu" role="menu">



  //                           <li><a class="update_documene"     href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>



  //                           <li class="divider"></li>



  //                            <li><a class="delete"    href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>



  //                         </ul>



  //                       </div>                      



                    



                    



  //                   ';     


                


                       
  //               // '<a class=" edit_measurement_model  mid="'.$post->VOL_ID.'" mname="'.$post->VOL_ID.'"" measureid="'.$post->VOL_ID.'"" href="javascript:void(0);"><i class="fa fa-pencil"></i></a>';

               



     


  //               $i++;



  //               $data[] = $nestedData;



  //           }



  //       }



  //       $json_data = array(



  //           "draw"            => intval($this->input->post('draw')),



  //           "recordsTotal"    => intval($totalData),



  //           "recordsFiltered" => intval($totalFiltered),



  //           "data"            => $data



  //       );



  //       echo json_encode($json_data);



  //   }
// SELLER FORM
public function seller_forms()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    

                 
                                $data2='';
                               $form_name=$_SESSION['form_name'];
                                $user_id=$_SESSION['loginid'];
                                $this->db->from('agent_form_data');
                                $this->db->join('document', 'document.form_id = agent_form_data.form_id','left');
                                $this->db->where('seller_id', $user_id);
                                $this->db->where('form_name', $form_name);                                
                                $this->db->select('agent_form_data.*,document.document,document.document_name');

                                $form_key = $this->db->get();

                                // $this->db->select('*');
                                // $this->db->from('form_fields_data');
                                // $this->db->where('form_menu', $form_name);
                                // $form_fields_data = $this->db->get();

                                // die(var_dump(json_decode($form_fields_data->row()->form_desc)));
                                // $form_key = $this->db->get_where('agent_form_data', array('seller_id' => $user_id,'form_name' => $form_name));
                                  foreach ($form_key->result() as $key ) {
                                      $data1 = json_decode($key->description);
                                      
                                      // echo'<pre>'; 
                                      //  $data=array();
                                      $data['content']='<tr>'; 
  
                                        foreach($data1 as $keys => $value) {
                                            if($value instanceof stdClass) {
                                                $temp =  json_decode(json_encode($value), true);  
                                                $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$temp['name'].'"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$temp['name'].'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                                </div>'; 
                                                $data['content'].=  '  <td> 
                                                  '. $blog_image.'
                                                    </td> '; 
                                                // die(var_dump($temp['name']));
                                            } else {
                                                $data['content'].=  '  <td> 
                                                  '. $value.'
                                              </td> ';
                                            }                
                                        } 
                                $data['content'].='<td><a href="'.base_url('download/').$key->document.'">'.$key->document_name.'</a></td>';
                                $data['content'].='<td><a href="'.base_url('admin/preview/').$key->id.'" class="btn btn-primary">Preview</a></td>';

                                        $data['content'].='</tr>';



                                           $data2.=$data['content'];
                                  }
                                    
                                  // print_r($data2);

                                 //  echo '<pre>';
  


                        $response['message']=$data2;


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
public function agent_forms()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    

                 
                                $data2='';
                                $form_name=$_SESSION['form'];
                                // die(var_dump($form_name));
                                // $user_id=$_SESSION['loginid'];
                                // $name = $this->db->query("select * from admin_login where ADMIN_ID='". $user_id ."'");
                                // $row = $name->row();
                                $this->db->select('*');
                                $this->db->from('agent_form_data');
                                // $this->db->join('admin_login', 'admin_login.ADMIN_ID = agent_form_data.seller_id');
                                $this->db->where('form_name', $form_name);
                                $form_key = $this->db->get();
                                // die(var_dump($form_key));
                                // $form_key = $this->db->get_where('agent_form_data', array('form_name' => $form_name));
                                  foreach ($form_key->result() as $key ) {
                                      $data1 = json_decode($key->description);
                                      // print_r($data1 );
                                      // echo'<pre>'; 
                                      //  $data=array();

                                      $data['content']='<tr>'; 
  
                                           foreach($data1 as $keys => $value) {
                                            if($value instanceof stdClass) {
                                                $temp =  json_decode(json_encode($value), true);  
                                                $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$temp['name'].'"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$temp['name'].'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                                </div>'; 
                                                $data['content'].=  '  <td> 
                                                  '. $blog_image.'
                                                    </td> '; 
                                                // die(var_dump($temp['name']));
                                            } else {
                                                $data['content'].=  '  <td> 
                                                  '. $value.'
                                              </td> ';
                                            }                
                                        } 
                                        $agent_id=$key->seller_id;
                                          $name = $this->db->query("select * from admin_login where ADMIN_ID='". $agent_id ."'");
                                $row = $name->row();
                                        $data['content'].='<td>'.$row->ADMIN_NAME.'</td>';
                                // $check_form = $this->db->get_where('agent_form_data',['form_id'=>$key->form_id])->num_rows();
                                // if($check_form > 0){
                                //     $data['content'].='<td></td>';
                                // }else{
                                //     $data['content'].='<td> <a href="javascript:;" class="add_document btn btn-success btn-sm pull-left " form_id="'.$key->form_id .'" agent_id="'.$key->seller_id .'" form_name="'.$key->form_name .'">ADD documemt</a></td>';
                                // }
                                
                                        
                                        
                                        $data['content'].='</tr>';


                                           $data2.=$data['content'];
                                  }
                                    
                                  // print_r($data2);

                                 //  echo '<pre>';
  


                        $response['message']=$data2;


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    // USER FORMS
    public function user_forms()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    

                 
                                $data2='';
                                $form_name=$_SESSION['form'];
                                // die(var_dump($form_name));
                                // $user_id=$_SESSION['loginid'];
                                // $name = $this->db->query("select * from admin_login where ADMIN_ID='". $user_id ."'");
                                // $row = $name->row();
                                $this->db->select('*');
                                $this->db->from('agent_form_data');
                                // $this->db->join('admin_login', 'admin_login.ADMIN_ID = agent_form_data.seller_id');
                                $this->db->where('form_name', $form_name);
                                $form_key = $this->db->get();
                                // die(var_dump($form_key));
                                // $form_key = $this->db->get_where('agent_form_data', array('form_name' => $form_name));
                                  foreach ($form_key->result() as $key ) {
                                      $data1 = json_decode($key->description);
                                      // print_r($data1 );
                                      // echo'<pre>'; 
                                      //  $data=array();

                                      $data['content']='<tr>'; 
  
                                           foreach($data1 as $keys => $value) {
                                            if($value instanceof stdClass) {
                                                $temp =  json_decode(json_encode($value), true);  
                                                $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$temp['name'].'"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$temp['name'].'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                                </div>'; 
                                                $data['content'].=  '  <td> 
                                                  '. $blog_image.'
                                                    </td> '; 
                                                // die(var_dump($temp['name']));
                                            } else {
                                                $data['content'].=  '  <td> 
                                                  '. $value.'
                                              </td> ';
                                            }                
                                        } 
                                        $agent_id=$key->seller_id;
                                          $name = $this->db->query("select * from admin_login where ADMIN_ID='". $agent_id ."'");
                                $row = $name->row();
                                        $data['content'].='<td>'.$row->ADMIN_NAME.'</td>';
                                $check_form = $this->db->get_where('agent_form_data',['form_id'=>$key->form_id])->num_rows();
                            //    die(var_dump($check_form));
							    if($check_form < 0){
                                    $data['content'].='<td></td>';
                                }else{
                                    $data['content'].='<td> <a href="javascript:;" class="add_document btn btn-success btn-sm pull-left " form_id="'.$key->form_id .'" agent_id="'.$key->seller_id .'" form_name="'.$key->form_name .'">ADD documemt</a></td>';
                                }
                                        $data['content'].='<td>'.$key->comment.'</td>';
                                    
                                    $data['content'].='<td> <a href="javascript:;" class="add_comment btn btn-success btn-sm pull-left " formid="'.$key->form_id .'" agentid="'.$key->seller_id .'" formname="'.$key->form_name .'">ADD COMMENT</a></td>';
                                        
                                        
                                        $data['content'].='</tr>';


                                           $data2.=$data['content'];
                                  }
                                    
                                  // print_r($data2);

                                 //  echo '<pre>';
  


                        $response['message']=$data2;


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }

 // bank detail list 
     public function bank_detail()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            8 => 'MEASUREMENT_NAME',

            9 => 'MEASUREMENT_NAME',

           10 => 'MEASUREMENT_NAME',

           );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];
        // $agentid=$_SESSION['loginid'];

        $totalData = count_all_bank_detail();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_bank_detail($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  bank_detail_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  bank_detail_search_count($search);

        }

        $data = array();







        if (!empty($posts)) {


            $i = $start + 1;



            foreach ($posts as $post) {

                $nestedData['SR_NO'] = $i;
                $nestedData['policy_no'] = $post->ADMIN_NAME;
                $nestedData['agent_name'] = $post->account;
                $nestedData['ifsc'] = $post->ifsc;
                $nestedData['holder_name'] = $post->branch_name;
                $nestedData['father_name'] = $post->bank_name;

         

                $i++;

                $data[] = $nestedData;

            }



        }



        $json_data = array(







            "draw"            => intval($this->input->post('draw')),







            "recordsTotal"    => intval($totalData),







            "recordsFiltered" => intval($totalFiltered),







            "data"            => $data







        );







        echo json_encode($json_data);







    }
 // download document list 
     public function download_document_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            8 => 'MEASUREMENT_NAME',

            9 => 'MEASUREMENT_NAME',

           10 => 'MEASUREMENT_NAME',

           );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];
        $agentid=$_SESSION['loginid'];

        $totalData = count_all_download_document_list($agentid);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_download_document_list($limit, $start, $order, $dir,$agentid);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  download_document_list_search($limit, $start, $search, $order, $dir,$agentid);

            $totalFiltered =  download_document_list_search_count($search,$agentid);

        }

        $data = array();







        if (!empty($posts)) {


            $i = $start + 1;



            foreach ($posts as $post) {

                $nestedData['SR_NO'] = $i;
                $nestedData['policy_no'] = $post->forms_name;
                $nestedData['agent_name'] = $post->document_name;
                $nestedData['ifsc'] = '<a href="'.base_url('download/').$post->document.'">'.$post->document_name.'</a>';
                // $nestedData['holder_name'] = $post->branch_name;
                // $nestedData['father_name'] = $post->bank_name;

         

                $i++;

                $data[] = $nestedData;

            }



        }



        $json_data = array(







            "draw"            => intval($this->input->post('draw')),







            "recordsTotal"    => intval($totalData),







            "recordsFiltered" => intval($totalFiltered),







            "data"            => $data







        );







        echo json_encode($json_data);







    }
// download form list 
     public function download_form_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            8 => 'MEASUREMENT_NAME',

            9 => 'MEASUREMENT_NAME',

           10 => 'MEASUREMENT_NAME',

           );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];
        $agentid=$_SESSION['loginid'];

        $totalData = count_all_download_form_list($agentid);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_download_form_list($limit, $start, $order, $dir,$agentid);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  download_form_list_search($limit, $start, $search, $order, $dir,$agentid);

            $totalFiltered =  download_form_list_search_count($search,$agentid);

        }

        $data = array();







        if (!empty($posts)) {


            $i = $start + 1;



            foreach ($posts as $post) {

                $nestedData['SR_NO'] = $i;
                $nestedData['policy_no'] = $post->form_name;
                $nestedData['ifsc'] = '<a href="'.base_url('admin/preview/').$post->id.'" class="btn btn-primary">Preview</a>';
              
         

                $i++;

                $data[] = $nestedData;

            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

       echo json_encode($json_data);

    }
    // download form  
     public function download_form()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            8 => 'MEASUREMENT_NAME',

            9 => 'MEASUREMENT_NAME',

           10 => 'MEASUREMENT_NAME',

           );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];
        $agentid=$_SESSION['loginid'];

        $totalData = count_all_download_form($agentid);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_download_form($limit, $start, $order, $dir,$agentid);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  download_form_search($limit, $start, $search, $order, $dir,$agentid);

            $totalFiltered =  download_form_search_count($search,$agentid);

        }

        $data = array();







        if (!empty($posts)) {


            $i = $start + 1;



            foreach ($posts as $post) {

                $nestedData['SR_NO'] = $i;
                $nestedData['policy_no'] = $post->form_name;
                $nestedData['ifsc'] = '<a href="'.base_url('admin/preview/').$post->form_id.'" class="btn btn-primary">Preview</a>';
              
         

                $i++;

                $data[] = $nestedData;

            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

       echo json_encode($json_data);

    }
// list department
// department 
     public function dpt_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $agentid =$_SESSION['loginid'];
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_department($agentid);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_department($limit, $start, $order, $dir,$agentid);
        } else {
            $search = $this->input->post('search')['value'];
          $posts =  department_search($limit, $start, $search, $order, $dir,$agentid);
            $totalFiltered =  department_search_count($search,$agentid);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                         if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->dpt_id;
                $nestedData['com_date'] = $post->dpt_name;
                // $nestedData['policy_no'] = $post->policy_no;
                // $nestedData['premium'] = $post->premium;
                $nestedData['pay'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-dpt"'.$checked.'/>
                      </label>'               
                   ;
                      $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                            <li><a class="update_dpt"  dpt_name="'.$post->dpt_name.'" dpt_id="'.$post->dpt_id.'" updatedepartmentid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-upload"> Update</i></a></li>

                      

                          </ul>

                        </div>                      

                    

                    

                    ';
                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
	// list user
	// user
     public function user()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        // $agentid =$_SESSION['loginid'];
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_user();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_user($limit, $start, $order, $dir);
        } else {
            $search = $this->input->user('search')['value'];
          $posts =  usersearch($limit, $start, $search, $order, $dir);
            $totalFiltered =  usersearch_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                         if($post->ADMIN_STATUS == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['date'] = $post->dpt_name;
                $nestedData['com_date'] = $post->ADMIN_NAME;
                $nestedData['policy_no'] = $post->USER_NAME;
                $nestedData['premium'] = $post->ADMIN_PASSWORD;
                $nestedData['pay'] ='<label>
                    <input type="checkbox" data-id="'.$post->ADMIN_ID.'" class="checkitem change-user"'.$checked.'/>
                      </label>'               
                   ;
                    $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                             <li><i class="fa fa-edit update_user" id="'.$post->ADMIN_ID.'" updateuserid="'.$post->ADMIN_ID.'" user_dpt_name="'.$post->dpt_name.'" user_user_name="'.$post->USER_NAME.'" user_name="'.$post->ADMIN_NAME.'"  user_password="'.$post->ADMIN_PASSWORD.'"> Update</i></a></li>
                           <li class="divider"></li>                             
                                <li><i class="fa fa-edit delete_user" id="'.$post->ADMIN_ID.'" deleteuserid="'.$post->ADMIN_ID.'"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';

                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
  // APPLY LIST
  	
     public function apply_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $agentid =$_SESSION['loginid'];
         $from =  date("Y-m-d", strtotime($_POST['from']));
        $to =  date("Y-m-d", strtotime($_POST['to']));
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_apply_list($agentid,$from,$to);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_apply_list($limit, $start, $order, $dir,$agentid,$from,$to);
        } else {
            $search = $this->input->apply('search')['value'];
          $posts =  apply_list_search($limit, $start, $search, $order, $dir,$agentid,$from,$to);
            $totalFiltered =  apply_list_search_count($search,$agentid,$from,$to);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                       

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['NAME'] = $post->ADMIN_NAME;
                $nestedData['FORM'] = $post->form_name;
            
                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }





// complete list

  	
     public function complete_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        // $agentid =$_SESSION['loginid'];
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_complete_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_complete_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->apply('search')['value'];
          $posts =  complete_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  complete_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                       

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['NAME'] = $post->ADMIN_NAME;
                $nestedData['FORM'] = $post->forms_name;
            
                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }





// complete list user

  	
     public function complete_list_user()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $agentid =$_SESSION['loginid'];
         $from =  date("Y-m-d", strtotime($_POST['from']));
        $to =  date("Y-m-d", strtotime($_POST['to']));
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_complete_list_user($agentid,$from,$to);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_complete_list_user($limit, $start, $order, $dir,$agentid,$from,$to);
        } else {
            $search = $this->input->apply('search')['value'];
          $posts =  complete_list_user_search($limit, $start, $search, $order, $dir,$agentid,$from,$to);
            $totalFiltered =  complete_list_user_search_count($search,$agentid);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                       

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['NAME'] = $post->ADMIN_NAME;
                $nestedData['FORM'] = $post->forms_name;
            
                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
 // report
  	
     public function report()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        // $agentid =$_SESSION['loginid'];
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_report_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_report_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->apply('search')['value'];
          $posts =  report_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  report_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                       

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['NAME'] = $post->ADMIN_NAME;
                $nestedData['FORM'] = $post->form_name;
            
                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    public function features_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
           10 => 'MEASUREMENT_NAME',
           );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        // $agentid =$_SESSION['loginid'];
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_features_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
           $posts = all_features_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->apply('search')['value'];
          $posts =  features_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  features_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                       

                                
                $nestedData['SR_NO'] = $i;
                $nestedData['NAME'] = $post->title;
               $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">


                             <li><a class="update_features"  features_id="'.$post->id.'" featurestitle="'.$post->title.'" featuresdesc="'.$post->desc.'"    href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_features"  delete_features_id="'.$post->id.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    '; 
            
                
                      
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
 public function get_user()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();

            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    

                    $response = get_user($_POST['user_id']);


                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
public function list_service()



    {



        $columns = array(



            0 => 'SR_NO',



            1 => 'MEASUREMENT_NAME',



            2 => 'MEASUREMENT_NAME',



            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',


            







        );



        $limit = $this->input->post('length');



        $start = $this->input->post('start');



        $order = $columns[$this->input->post('order')[0]['column']];



        $dir = $this->input->post('order')[0]['dir'];



        // $status = $_POST['status'];

        // $agentid = 2;

        $totalData = count_all_list_service();



        $totalFiltered = $totalData;



        if (empty($this->input->post('search')['value'])) {



            $posts = all_list_service($limit, $start, $order, $dir);



        } else {



            $search = $this->input->post('search')['value'];



            $posts =  list_service_search($limit, $start, $search, $order, $dir);



            $totalFiltered =  list_service_search_count($search);



        }



        $data = array();



        if (!empty($posts)) {



            $i = $start + 1;



            foreach ($posts as $post) {
                  if ($post->image != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                              


                $nestedData['SR_NO'] = $i;
                $nestedData['IMAGE'] = $image;
                $nestedData['NAME'] =  $post->title;
                $nestedData['DES'] =   $post->description;
                       $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">


                             <li><a class="update_service"  service_id="'.$post->id.'" servicetitle="'.$post->title.'" service_dec="'.$post->description.'"   href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_service"  delete_service_id="'.$post->id.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';    
     

                


                       

               



     


                $i++;



                $data[] = $nestedData;



            }



        }



        $json_data = array(



            "draw"            => intval($this->input->post('draw')),



            "recordsTotal"    => intval($totalData),



            "recordsFiltered" => intval($totalFiltered),



            "data"            => $data



        );



        echo json_encode($json_data);



    }
// news_list
 

    public function news_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_news_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_news_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  news_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  news_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                          if ($post->image != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['IMAGE'] = $image;
                $nestedData['TITLE'] = $post->title;

                $nestedData['DESCRITPION'] = $post->description;
                $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-news"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class=" update_news"  id="'.$post->id.'" updatenewsid="'.$post->id.'"
                             news_title="'.$post->title.'" news_desc="'.$post->description.'" news_date="'.$post->date.'" href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class=" delete_news"  id="'.$post->id.'" deletenewsid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
	// our branches
	    public function our_branches()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_branches_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_branches_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  branches_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  branches_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                          if ($post->image != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['IMAGE'] = $image;
                $nestedData['TITLE'] = $post->title;

                $nestedData['DESCRITPION'] = $post->description;
                $nestedData['DATE'] = $post->url;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-branches"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class=" update_branches"  id="'.$post->id.'" updatebranchesid="'.$post->id.'"
                             branches_title="'.$post->title.'" branches_desc="'.$post->description.'" branches_url="'.$post->url.'" href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class=" delete_branches"  id="'.$post->id.'" deletebranchesid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    //latest news_list
 

    public function latest_news_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_latest_news_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_latest_news_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  latest_news_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  latest_news_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                          if ($post->image != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['IMAGE'] = $image;
                $nestedData['TITLE'] = $post->title;

                $nestedData['DESCRITPION'] = $post->description;
                // $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-latest-news"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class="update_latest_news"  id="'.$post->id.'" updatelatestnewsid="'.$post->id.'"
                             latest_news_title="'.$post->title.'" latest_news_desc="'.$post->description.'"  href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_latest_news"  id="'.$post->id.'" deletelatestnewsid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // information board
   
 

    public function information_baord_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_information_board_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_information_board_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  information_board_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  information_board_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                            
                $nestedData['SR_NO'] = $i;

                $nestedData['LINK_NAME'] = $post->link_name;
                $nestedData['LINK_URL'] = $post->link_url;

                // $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-information-board"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class="update_information_board"  id="'.$post->id.'" updateinformationboardid="'.$post->id.'"
                             board_name="'.$post->link_name.'" board_url="'.$post->link_url.'"  href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_information_baord"  id="'.$post->id.'" deleteinformationboardid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
	  // ADMISSION NOTICE LIST
   
 

    public function admission_notice_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_admission_notice_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_admission_notice_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  admission_notice_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  admission_notice_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                            
                $nestedData['SR_NO'] = $i;

                $nestedData['LINK_NAME'] = $post->link_name;
                $nestedData['LINK_URL'] = $post->link_url;

                // $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-admission-notice"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class="update_admission_notice"  id="'.$post->id.'" updateadmissionnoticeid="'.$post->id.'"
                             notice_name="'.$post->link_name.'" notice_url="'.$post->link_url.'"  href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_admission_notice"  id="'.$post->id.'" deleteadmissionnoticeid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // advance notice list
    public function advance_notice_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_advance_notice_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_advance_notice_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  advance_notice_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  advance_notice_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                          if ($post->image != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['IMAGE'] = $image;
                $nestedData['TITLE'] = $post->title;

                $nestedData['DESCRITPION'] = $post->description;
                // $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-advance-notice"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class="update_advance_notice"  id="'.$post->id.'" updateadvancenoticeid="'.$post->id.'"
                             advance_notice_title="'.$post->title.'" advance_notice_desc="'.$post->description.'"  href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_advance_notice"  id="'.$post->id.'" deleteadvancenoticeid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // flash image
    public function flash_image_list()

    {

        $columns = array(

            0 => 'SR_NO',

            1 => 'MEASUREMENT_NAME',

            2 => 'MEASUREMENT_NAME',

            3 => 'MEASUREMENT_NAME',

            4 => 'MEASUREMENT_NAME',

            5 => 'MEASUREMENT_NAME',

            6 => 'MEASUREMENT_NAME',

            7 => 'MEASUREMENT_NAME',
            



        );

        $limit = $this->input->post('length');

        $start = $this->input->post('start');

        $order = $columns[$this->input->post('order')[0]['column']];

        $dir = $this->input->post('order')[0]['dir'];

        // $status = $_POST['status'];

        $totalData = count_all_flash_image_list();

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_flash_image_list($limit, $start, $order, $dir);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  flash_image_list_search($limit, $start, $search, $order, $dir);

            $totalFiltered =  flash_image_list_search_count($search);

        }

        $data = array();

        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }

                          if ($post->image != '') {

                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }else{

                    $slider_image = '<div style="width:50px; height:50px;" class="project-wrapper">

                                                <div class="project">

                                                    <div class="photo-wrapper">

                                                        <div class="photo">

                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>

                                                        </div>

                                                        <div class="overlay"></div>

                                                    </div>

                                                </div>

                                            </div>';

                }

                $nestedData['SR_NO'] = $i;

                $nestedData['IMAGE'] = $image;
                $nestedData['TITLE'] = $post->title;

                $nestedData['DESCRIPTION'] = $post->description;
                // $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-id="'.$post->id.'" class="checkitem change-flash-image"'.$checked.'/>
                      </label>'               
                   ;

                $nestedData['ACTION'] = '

                        <div style="min-width:100px;" class="btn-group">

                          <button type="button" class="btn btn-theme03">Action</button>

                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">

                            <span class="caret"></span>

                            <span class="sr-only">Toggle Dropdown</span>

                          </button>

                          <ul class="dropdown-menu" role="menu">

                             <li><a class="update_flash_image"  id="'.$post->id.'" updateflashimageid="'.$post->id.'"
                             flash_image_title="'.$post->title.'" flash_image_desc="'.$post->description.'"  href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>

                            <li class="divider"></li>                             

                                <li><a class="delete_flash_image"  id="'.$post->id.'" deleteflashimageid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>

                          </ul>

                        </div>                      

                    

                    

                    ';

               





                

                $i++;

                $data[] = $nestedData;

              
            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
    // notice board
    
 

    public function notice_board_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status = $_POST['status'];
        $totalData = count_all_notice_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_notice_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  notice_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  notice_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                          if($post->status == 1){
                                $checked = 'checked';
                                }else{
                                $checked = 'unchecked';
                                }
                          if (@$post->image != '') {
                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                <div class="project">
                                    <div class="photo-wrapper">
                                        <div class="photo">
                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>';
                }else{
                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }
                $nestedData['SR_NO'] = $i;
                $nestedData['IMAGE'] = @$image;
                $nestedData['TITLE'] = $post->title;
                $nestedData['DESCRITPION'] = $post->description;
                $nestedData['DATE'] = $post->date;
                  $nestedData['STATUS'] ='<label>
                    <input type="checkbox" data-noticeid="'.$post->id.'" class="checkitem change-notice"'.$checked.'/>
                      </label>'               
                   ;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                             <li><a class=" update_notice"  id="'.$post->id.'" updatenoticeid="'.$post->id.'"
                             notice_title="'.$post->title.'" notice_desc="'.$post->description.'" notice_date="'.$post->date.'" href="javascript:void(0);"><i class="fa fa-edit"> Update</i></a></li>
                            <li class="divider"></li>                             
                            <li><a class=" delete_notice"  id="'.$post->id.'" deletenoticeid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    

    public function all_page_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status = $_POST['status'];
        $totalData = count_all_page_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_page_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  page_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  page_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                         
                         
                         
                $nestedData['SR_NO'] = $post->id;
                $nestedData['IMAGE'] = $post->title;
                $nestedData['TITLE'] = $post->description;
               $nestedData['URL'] = ''.$_SERVER['SERVER_NAME'].'/page-name/'.$post->id.'';
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                             <li><a class=" "  id="'.$post->id.'" deletepageid="'.$post->id.'"  href="'.site_url('admin/page/'.$post->id).'"><i class="fa fa-edit"> Update </i></a></li>
                            <li class="divider"></li>
                            
                            <li><a class=" delete_page"  id="'.$post->id.'" deletepageid="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }








    
    
    
    /*---------------------------------- start pankaj ----------------------------------------------*/
    
       public function get_category()
    {

                    $response = get_category_by_brand($_POST['brandid']);
                    json_output(200, $response);

    }

    public function get_sub_category()
    {
        $response = get_sub_category($_POST['catid']);
        json_output(200, $response);
    } 



    public function new_order_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'SAMPLE_ID',
            2 => 'SAMPLE_ID',
            3 => 'SAMPLE_ID',
            4 => 'SAMPLE_ID',
            5 => 'SAMPLE_ID',
            6 => 'SAMPLE_ID',
            7 => 'SAMPLE_ID',
            8 => 'SAMPLE_ID',
            9 => 'SAMPLE_ID',
            10 => 'SAMPLE_ID',
            11 => 'SAMPLE_ID',
            12 => 'SAMPLE_ID',
           
      
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = 0;
        
        $totalData = count_all_new_order_history($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_new_order_history($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  purchase_new_order_history_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered = purchase_new_order_history_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;

            foreach ($posts as $post) {
                
                $nestedData['SR_NO'] = $i;
                $nestedData['ORDER_NO'] =  '100';
                $nestedData['NAME'] = $post->name;
                $nestedData['BRAND'] = $post->brand_name;
                $nestedData['CATEGORY'] = $post->CATEGORY_NAME;
                $nestedData['SUB_CATEGORY'] = $post->SUB_CAT_NAME;
                $nestedData['PRODUCT_NAME'] = $post->PRODUCT_NAME;
                $nestedData['ORDER'] = $post->QTY;
                $nestedData['ACTION'] = '<div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            
                                            
                                           <li><a  href="javascript:void(0);" class=" remove_inward_outward_record id="'.$post->ORDER_LIST_ID.'" sample_recordid="'.$post->ORDER_LIST_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                          </ul>
                                        </div>';

                        $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



    public function brand_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_brand_type($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_brand_type($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  brand_type_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = brand_type_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $nestedData['SR_NO'] = $i;
                $nestedData['BRAND_NAME'] = $post->brand_name;
                $nestedData['ACTION'] = '
                                        <div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                           <li><a  href="'.site_url('admin/update_brands/'.$post->id.' ').'"  "><i class="fa fa-pencil"></i>  Edit </a></li>
                                           <li><a  href="javascript:void(0);" class=" remove_brand  bid="'.$post->id.'"  remove_brand_id="'.$post->id.'"  "><i class="fa fa-remove"></i>  Remove </a></li>
                                          </ul>
                                        </div>
                                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    public function category_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
            4 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_category_type($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_category_type($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  category_type_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = category_type_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $nestedData['SR_NO'] = $i;
                $nestedData['BRAND_NAME'] = $post->brand_name;
                $nestedData['CATEGORY_NAME'] = $post->CATEGORY_NAME;
                $nestedData['ACTION'] = '
                                            <div style="min-width:100px;" class="btn-group">
                                              <button type="button" class="btn btn-theme03">Action</button>
                                              <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <ul class="dropdown-menu" role="menu">
                                                
                                               <li><a  href="javascript:void(0);" class=" update_category id="'.$post->CAT_ID.'" uc_id="'.$post->CAT_ID.'" category_name="'.$post->CATEGORY_NAME.'" "><i class="fa fa-pencil"></i>  Update </a></li>  
                                               <li><a  href="javascript:void(0);" class=" remove_category id="'.$post->CAT_ID.'" rc_id="'.$post->CAT_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                              </ul>
                                            </div>
                  
                   
                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    public function sub_category_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
            4 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_sub_category_type($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_sub_category_type($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  sub_category_type_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = sub_category_type_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $nestedData['SR_NO'] = $i;
                $nestedData['BRAND_NAME'] = $post->brand_name;
                $nestedData['CATEGORY_NAME'] = $post->CATEGORY_NAME;
                $nestedData['SUB_CATEGORY_NAME'] = $post->SUB_CAT_NAME;
                $nestedData['ACTION'] = '
                                            <div style="min-width:100px;" class="btn-group">
                                              <button type="button" class="btn btn-theme03">Action</button>
                                              <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <ul class="dropdown-menu" role="menu">
                                               <li><a  href="javascript:void(0);" class=" edit_sub_category_model id="'.$post->SUB_CAT_ID.'" sc_id="'.$post->SUB_CAT_ID.'" sc_name="'.$post->SUB_CAT_NAME.'" "><i class="fa fa-pencil"></i>  Update </a></li>  
                                               <li><a  href="javascript:void(0);" class=" remove_sub_category id="'.$post->SUB_CAT_ID.'" r_sc_id="'.$post->SUB_CAT_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                              </ul>
                                            </div>
                                        ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    public function product_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
            4 => 'BRAND_NAME',
            5 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_product_type($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_product_type($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  product_type_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = product_type_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $nestedData['SR_NO'] = $i;
                $nestedData['BRAND_NAME'] = $post->brand_name;
                $nestedData['CATEGORY_NAME'] = $post->CATEGORY_NAME;
                $nestedData['SUB_CATEGORY_NAME'] = $post->SUB_CAT_NAME;
                $nestedData['PRODUCT_NAME'] = $post->PRODUCT_NAME;
                $nestedData['ACTION'] = '
                
                                            <div style="min-width:100px;" class="btn-group">
                                              <button type="button" class="btn btn-theme03">Action</button>
                                              <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                              </button>
                                              <ul class="dropdown-menu" role="menu">
                                               <li><a  href="javascript:void(0);" class=" edit_product id="'.$post->PRODUCT_ID.'" product_id="'.$post->PRODUCT_ID.'" product_name="'.$post->PRODUCT_NAME.'" "><i class="fa fa-pencil"></i>  Update </a></li>  
                                               <li><a  href="javascript:void(0);" class=" remove_product id="'.$post->PRODUCT_ID.'" remove_product_id="'.$post->PRODUCT_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                              </ul>
                                            </div>
                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    public function delivered_order_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'SAMPLE_ID',
            2 => 'SAMPLE_ID',
            3 => 'SAMPLE_ID',
            4 => 'SAMPLE_ID',
            5 => 'SAMPLE_ID',
            6 => 'SAMPLE_ID',
            7 => 'SAMPLE_ID',
            8 => 'SAMPLE_ID',
            9 => 'SAMPLE_ID',
            10 => 'SAMPLE_ID',
            11 => 'SAMPLE_ID',
            12 => 'SAMPLE_ID',
           
      
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = 1;
        
        $totalData = count_all_new_order_history($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_new_order_history($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  purchase_new_order_history_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered = purchase_new_order_history_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;

            foreach ($posts as $post) {
                
                $nestedData['SR_NO'] = $i;
                $nestedData['ORDER_NO'] =  '100';
                $nestedData['NAME'] = $post->name;
                $nestedData['BRAND'] = $post->brand_name;
                $nestedData['CATEGORY'] = $post->CATEGORY_NAME;
                $nestedData['SUB_CATEGORY'] = $post->SUB_CAT_NAME;
                $nestedData['PRODUCT_NAME'] = $post->PRODUCT_NAME;
                $nestedData['ORDER'] = $post->QTY;
                $nestedData['ACTION'] = '<div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            
                                            
                                           <li><a  href="javascript:void(0);" class=" remove_inward_outward_record id="'.$post->ORDER_LIST_ID.'" sample_recordid="'.$post->ORDER_LIST_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                          </ul>
                                        </div>';

                        $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    public function pending_order_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'SAMPLE_ID',
            2 => 'SAMPLE_ID',
            3 => 'SAMPLE_ID',
            4 => 'SAMPLE_ID',
            5 => 'SAMPLE_ID',
            6 => 'SAMPLE_ID',
            7 => 'SAMPLE_ID',
            8 => 'SAMPLE_ID',
            9 => 'SAMPLE_ID',
            10 => 'SAMPLE_ID',
            11 => 'SAMPLE_ID',
            12 => 'SAMPLE_ID',
           
      
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = 0;
        
        $totalData = count_all_new_order_history($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_new_order_history($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  purchase_new_order_history_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered = purchase_new_order_history_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;

            foreach ($posts as $post) {
                
                $nestedData['SR_NO'] = $i;
                $nestedData['ORDER_NO'] =  '100';
                $nestedData['NAME'] = $post->name;
                $nestedData['BRAND'] = $post->brand_name;
                $nestedData['CATEGORY'] = $post->CATEGORY_NAME;
                $nestedData['SUB_CATEGORY'] = $post->SUB_CAT_NAME;
                $nestedData['PRODUCT_NAME'] = $post->PRODUCT_NAME;
                $nestedData['ORDER'] = $post->QTY;
                $nestedData['ACTION'] = '<div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            
                                            
                                           <li><a  href="javascript:void(0);" class=" remove_inward_outward_record id="'.$post->ORDER_LIST_ID.'" sample_recordid="'.$post->ORDER_LIST_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                          </ul>
                                        </div>';

                        $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function cancelled_order_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'SAMPLE_ID',
            2 => 'SAMPLE_ID',
            3 => 'SAMPLE_ID',
            4 => 'SAMPLE_ID',
            5 => 'SAMPLE_ID',
            6 => 'SAMPLE_ID',
            7 => 'SAMPLE_ID',
            8 => 'SAMPLE_ID',
            9 => 'SAMPLE_ID',
            10 => 'SAMPLE_ID',
            11 => 'SAMPLE_ID',
            12 => 'SAMPLE_ID',
           
      
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = 3;
        
        $totalData = count_all_new_order_history($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_new_order_history($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  purchase_new_order_history_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered = purchase_new_order_history_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;

            foreach ($posts as $post) {
                
                $nestedData['SR_NO'] = $i;
                $nestedData['ORDER_NO'] =  '100';
                $nestedData['NAME'] = $post->name;
                $nestedData['BRAND'] = $post->brand_name;
                $nestedData['CATEGORY'] = $post->CATEGORY_NAME;
                $nestedData['SUB_CATEGORY'] = $post->SUB_CAT_NAME;
                $nestedData['PRODUCT_NAME'] = $post->PRODUCT_NAME;
                $nestedData['ORDER'] = $post->QTY;
                $nestedData['ACTION'] = '<div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            
                                            
                                           <li><a  href="javascript:void(0);" class=" remove_inward_outward_record id="'.$post->ORDER_LIST_ID.'" sample_recordid="'.$post->ORDER_LIST_ID.'" "><i class="fa fa-trash-o"></i>  REMOVE </a></li>
                                          </ul>
                                        </div>';

                        $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    
    public function list_banners()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
            4 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '0';
        $totalData = count_all_banners($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_banners($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  banners_type_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered = banners_type_search_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {

                if ($post->IMAGE_URL != '') {
                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->IMAGE_URL.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->IMAGE_URL.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }else{
                    $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->IMAGE_URL.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }



                $nestedData['SR_NO'] = $i;
                $nestedData['IMAGE'] = $image;
                $nestedData['TITLE'] = $post->IMAGE_TITLE;
                $nestedData['ACTION'] = '<a class=" delete_banner_list id="'.$post->PROMOTION_ID.'" bannerid="'.$post->PROMOTION_ID.'"  " href="javascript:void(0);"><i class="fa fa-remove btn btn-danger"> Delete</i></a>';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

	    public function list_coupans()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
            4 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        $status = '0';
        $totalData = count_all_coupans_list($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_coupans_list($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  coupans_list_type_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered = coupans_list_type_search_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {

                


                $nestedData['SR_NO'] = $i;
                $nestedData['IMAGE'] = $post->COUPAN_TITLE;
                $nestedData['TITLE'] = $post->COUPAN_DISCOUNT;
                $nestedData['VALID_UO_TO'] = $post->COUPAN_VALID_DATE;
                $nestedData['ACTION'] = '';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    
    
    
    
/*------------------------- end pankaj ------------------------------------------------------*/


/*----------------- NEWS LETTER LIST  -----------------------------------------------------*/
    public function marquee_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status = $_POST['status'];
        // $agentid = 2;
        $totalData = count_all_news_letter_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_news_letter_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  news_letter_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  news_letter_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                  

                $nestedData['SR_NO'] = $i;
                $nestedData['MARQUEE_TITLE'] = $post->NEWS_TITLE;
                $nestedData['MARQUEE_DESC'] =  $post->NEWS_DESC;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                                                        
                            <li><a class="delete_news_letter"  delete_news_letter_id="'.$post->NEWS_ID.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                            <li><a class="update_news_letter"  update_news_letter_id="'.$post->NEWS_ID.'" update_news_letter_title="'.$post->NEWS_TITLE.'" update_news_letter_desc="'.$post->NEWS_DESC.'" update_news_letter_link="'.$post->NEWS_LINK.'"   href="javascript:void(0);"><i class="fa fa-edit"> Update  </i></a></li>
                          </ul>
                        </div>                      
                    ';    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

/*--------------- end of NEWS LETTER LIST ----------------------------------------------*/    
    
/*--------------------- start fixed menu list -----------------------------------------*/
public function fixed_menu_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_fixed_menu($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_fixed_menu($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  fixed_menu_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = fixed_menu_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                if($post->FM_STATUS == 1){
                    $check = 'checked';
                }else{
                    $check = '';
                }
                
                $nestedData['SR_NO'] = $i;
                $nestedData['MENU_NAME'] = $post->FM_NAME;
                $nestedData['ACTION'] = '<input type="checkbox" '.$check.' name="fixed_menu" onclick="update_fixed_menu('.$post->FM_ID.')" >
                                        
                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*------------------- end fixed menu list ---------------------------------------*/




/*--------------------- start FRONT SETTING  -----------------------------------------*/
public function front_setting_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_front_setting_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_front_setting_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  front_setting_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered = front_setting_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                if($post->FB_SHOW_HIDE == 1){
                    $check = '';
                }else{
                    $check = 'checked';
                }
                
                
                
                $nestedData['SR_NO'] = $i;
                $nestedData['FB_NAME'] = $post->FB_NAME;
                $nestedData['FB_ORDER'] = '<input type="text" style="width:50px" id="front_order_'.$post->FB_ID.'"  name="fixed_menu" onchange="update_frontend('.$post->FB_ID.')" value="'.$post->FB_ORDER.'" >';
                $nestedData['FB_SHOW_HIDE'] = '<input type="checkbox" '.$check.' name="fixed_menu" onclick="show_hide_frontend('.$post->FB_ID.')" >';                        
                    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*------------------- end FRONT SETTING list ---------------------------------------*/


/*--------------------- start  menu list -----------------------------------------*/
    public function menu_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_menu_list($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_menu_list($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  menu_list_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = menu_list_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                if($post->MENU_STATUS == 0){
                    $check = 'checked';
                }else{
                    $check = '';
                }
                // $menu_status = $this->db->query("SELECT * FROM `link_page` WHERE `menu` = '" . $post->id . "' AND `submenu` = 0 AND `subsubmenu` = 0")->row();
                $count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$post->id])->num_rows();
                
                if($count_menu > 0)
                {
                        $status = '';
                      
                        $page_type = '';    
                      
                      
                }else{
                 
                 if($post->PAGE_TYPE == 0){
                    /*
                    $status = '
                                <a href="'.site_url('admin/page/'.$post->menu_code.' ').'"><i class="fa fa-plus  btn btn-primary"> Update Content </i></a>
                                <input type="text" name="menu_link_status" id="menu_link_status_'.$post->id.'" onchange="update_link_status('.$post->id.')" value="'.$post->ext_url_link.'" >';
                    */
                 }else{
                      
                 }
                    $status = '';
                                    
                    if($post->PAGE_TYPE == 1){
                        $page_type =    '<select onchange="pick('.$post->id.',this.value)">
                                        <option value="1" selected="selected"> Type 1 </option>
                                        <option value="2"> Type 2 </option>
                                        <option value="3"> Type 3 </option>
                                    </select>';
                                    
                         $status = ' 
                                <a href="'.site_url('admin/page/'.$post->menu_code.' ').'"><i class="fa fa-plus  btn btn-primary"> Update Content </i></a>
                                
                                
                                <input type="text" name="menu_link_status" id="menu_link_status_'.$post->id.'" onchange="update_link_status('.$post->id.')" value="'.$post->ext_url_link.'" >';
                            
                                    
                    }else if($post->PAGE_TYPE == 2){
                        $page_type =    '<select onchange="pick('.$post->id.',this.value)">
                                        <option value="2" selected="selected"> Type 2 </option>
                                        <option value="1"> Type 1 </option>
                                        <option value="3"> Type 3 </option>
                                    </select>';
                                    
                         $status = '
                                <a href="'.site_url('admin/update_page_content/'.$post->menu_code.' ').'"><i class="fa fa-plus  btn btn-primary"> Update Content </i></a>
                                
                                
                                <input type="text" name="menu_link_status" id="menu_link_status_'.$post->id.'" onchange="update_link_status('.$post->id.')" value="'.$post->ext_url_link.'" >';
                            
                    }else if($post->PAGE_TYPE == 3){
                        $page_type =    '<select onchange="pick('.$post->id.',this.value)">
                                        <option value="3" selected="selected"> Type 3 </option>
                                        <option value="2" > Type 2 </option>
                                        <option value="1"> Type 1 </option>
                                    </select>';
                                    
                         $status = '
                                <a href="'.site_url('admin/fquestion/'.$post->menu_code.' ').'"><i class="fa fa-plus  btn btn-primary"> Update Content </i></a>
                                
                                
                                <input type="text" name="menu_link_status" id="menu_link_status_'.$post->id.'" onchange="update_link_status('.$post->id.')" value="'.$post->ext_url_link.'" >';
                            
                    }else{
                        $page_type =    '<select onchange="pick('.$post->id.',this.value)">
                                        <option value="0"> -- Select -- </option>
                                        <option value="1"> Type 1 </option>
                                        <option value="2" > Type 2 </option>
                                         <option value="3" > Type 3 </option>
                                        
                                    </select>';
                    }   
                    
                }
                
                
                
                
                
                
                $nestedData['SR_NO'] = $i;
                $nestedData['MENU_NAME'] = '<input type="text"  id="update_menu_'.$post->id.'"  onchange="update_menu_name('.$post->id.')" value="'.$post->menu.'" >';
                $nestedData['MENU_ORDER'] = '<input type="text" style="width:50px" id="update_menu_order_'.$post->id.'"  onchange="update_menu_order('.$post->id.')" value="'.$post->position.'" >';
                $nestedData['MENU_SHOW_HIDE'] = '<input type="checkbox" '.$check.' name="fixed_menu" onclick="update_menu_status('.$post->id.')" >';
                $nestedData['PAGE_TYPE'] = $page_type;
                $nestedData['ACTION'] = $status;
                                        
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    
    public function sub_menu_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_sub_menu_list($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_sub_menu_list($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  sub_menu_list_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = sub_menu_list_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                if($post->MENU_STATUS == 1){
                    $check = 'checked';
                }else{
                    $check = '';
                }
                
                $menu_status = $this->db->query("SELECT * FROM `link_page` WHERE `menu` = '" . $post->menu . "' AND `submenu` = '" . $post->id . "' AND `subsubmenu` = 0")->row();
              
                  if($menu_status->has_url!= 0){
                         $status = '<input type="text" name="sub_menu_link_status" id="sub_menu_link_status_'.$menu_status->id.'" onchange="update_sub_menu_link_status('.$menu_status->id.')" value="'.$menu_status->url_address.'" >';
                  }else{
                      $status = '';
                  }
                
                
                
                
                $nestedData['SR_NO'] = $i;
                $nestedData['MENU_NAME'] = '<input type="text"  id="update_sub_menu_name_'.$post->id.'"  name="fixed_menu" onchange="update_sub_menu_name('.$post->id.')" value="'.$post->submenu.'" >';
                $nestedData['MENU_ORDER'] = '<input type="text" style="width:50px" id="update_sub_menu_order_'.$post->id.'"  name="fixed_menu" onchange="update_sub_menu_order('.$post->id.')" value="'.$post->MENU_ORDER.'" >';
                $nestedData['MENU_SHOW_HIDE'] = '<input type="checkbox" '.$check.' name="fixed_menu" onclick="update_sub_menu_status('.$post->id.')" >';
                
                $nestedData['ACTION'] = $status;
                                        
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    
    public function sub_sub_menu_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_sub_sub_menu_list($company_id,$status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_sub_sub_menu_list($limit, $start, $order, $dir,$company_id,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  sub_sub_menu_list_search($limit, $start, $search, $order, $dir,$company_id,$status);
            $totalFiltered = sub_sub_menu_list_search_count($search,$company_id,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                if($post->MENU_STATUS == 1){
                    $check = 'checked';
                }else{
                    $check = '';
                }
                
                $nestedData['SR_NO'] = $i;
                $nestedData['MENU_NAME'] = '<input type="text"  id="menu_order_'.$post->id.'"  name="fixed_menu" onchange="update_menu_order('.$post->id.')" value="'.$post->menu_name.'" >';
                $nestedData['MENU_ORDER'] = '<input type="text" style="width:50px" id="menu_order_'.$post->id.'"  name="fixed_menu" onchange="update_menu_order('.$post->id.')" value="'.$post->MENU_ORDER.'" >';
                $nestedData['MENU_SHOW_HIDE'] = '<input type="checkbox" '.$check.' name="fixed_menu" onclick="show_hide_frontend('.$post->id.')" >';
                
                $nestedData['ACTION'] = '';
                                        
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

/*------------------- end  menu list ---------------------------------------*/

    public function list_blog()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BLOG_TITLE',
            2 => 'BLOG_TITLE',
            3 => 'BLOG_TITLE',
            4 => 'BLOG_TITLE',
            5 => 'BLOG_TITLE',
            6 => 'BLOG_TITLE',
            7 => 'BLOG_TITLE',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        //$status = $_POST['status'];
        $page_name = $_POST['page_name'];
        $totalData = count_all_blog($page_name);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_blog($limit, $start, $order, $dir,$page_name);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  blog_search($limit, $start, $search, $order, $dir,$page_name);
            $totalFiltered =  blog_search_count($search,$page_name);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                if ($post->BLOG_STATUS != '1') {
                    $status = '<b style="color:red;">Pending</b>';
                }else{
                    $status = '<b style="color:green;">Published</b>';
                }
                if ($post->BLOG_IMAGE != '') {
                    $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->BLOG_IMAGE.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->BLOG_IMAGE.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }else{
                    $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->BLOG_IMAGE.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }
                $nestedData['SR_NO'] = $i;
                $nestedData['BLOG_IMAGE'] = $blog_image;
                $nestedData['BLOG_TITLE'] = $post->BLOG_TITLE;
                $nestedData['BLOG_DESC'] = $post->BLOG_DESC;
                $nestedData['STATUS'] = $status;
               if ($page_name == '1') {
                   $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" publish_blog"  id="'.$post->BLOG_ID.'" blogid="'.$post->BLOG_ID.'" " href="javascript:void(0);"><i class="fa fa-upload"> Click To Publish</i></a></li>
                           
                            
                            <li class="divider"></li>                             
                                <li><a class=" delete_blog"  id="'.$post->BLOG_ID.'" blogdeleteid="'.$post->BLOG_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';
               }else if ($page_name == '2'){
                    $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" publish_blog"  id="'.$post->BLOG_ID.'" blogid="'.$post->BLOG_ID.'" " href="javascript:void(0);"><i class="fa fa-upload"> Click To Publish</i></a></li>
                           
                          
                            <li class="divider"></li>                             
                                <li><a class=" delete_blog"  id="'.$post->BLOG_ID.'" blogdeleteid="'.$post->BLOG_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    '; 
               }else{
                    $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" publish_blog"  id="'.$post->BLOG_ID.'" blogid="'.$post->BLOG_ID.'" " href="javascript:void(0);"><i class="fa fa-upload"> Click To Publish</i></a></li>
                            <li class="divider"></li>
                                                        
                                <li><a class=" delete_blog"  id="'.$post->BLOG_ID.'" blogdeleteid="'.$post->BLOG_ID.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                          </ul>
                        </div>                      
                    ';
               }
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


    
    
    
    public function course_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'COURSE_CATEGORY',
            2 => 'COURSE_CATEGORY',
            3 => 'COURSE_CATEGORY',
            4 => 'COURSE_CATEGORY',
            5 => 'COURSE_CATEGORY',
            6 => 'COURSE_CATEGORY',
            7 => 'COURSE_CATEGORY',
            8 => 'COURSE_CATEGORY',
            9 => 'COURSE_CATEGORY',
            10 => 'COURSE_CATEGORY',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = $_POST['status'];
        $page_name = 1;
        $totalData = count_all_course_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_course_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  course_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  course_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                // if ($post->BLOG_STATUS != '1') {
                //     $status = '<b style="color:red;">Pending</b>';
                // }else{
                //     $status = '<b style="color:green;">Published</b>';
                // }
                
                if ($post->image != '') {
                    $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }else{
                    $blog_image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  ><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                }
                
                if(@$post->type==1){
			        $type='monthly';
			        $duration=@$post->duration.' - MONTHS';
			    }elseif(@$post->type==2){
			        $type='yearly';
			        $duration=@$post->years.' - YEARS';
			    }
			    elseif(@$post->type==3){
			        $type='semesters';
			        $duration=@$post->duration.' - SEMESTERS';
			    }
                
                
                $nestedData['SR_NO'] = $i;
                $nestedData['IMAGE'] = $blog_image;
                $nestedData['COURSE_CATEGORY'] = $post->brand_name;
                $nestedData['COURSE_NAME'] = $post->course_name;
                $nestedData['COURSE_TYPE'] = $type;
                $nestedData['COURSE_DURATION'] = $duration;
                $nestedData['COURSE_CODE'] = $post->course_code;
                $nestedData['MIN_QUALIFICATION'] = $post->MIN_QUALIFICATION;
                $nestedData['FEES'] = $post->fees;
               
              
                   $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="'.site_url('admin/create_course/'.$post->id.' ').'"><i class="fa fa-upload"> Update </i></a></li>
                           
                            
                            <li class="divider"></li>                             
                            
                                <li><a class=" delete_course"  id="'.$post->id.'" delete_course_id="'.$post->id.'"  href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                            
                          </ul>
                        </div>                      
                    ';
              
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*--------------------- start BACKEND SETTING  -----------------------------------------*/
public function backend_setting_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_backend_setting_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_backend_setting_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  backend_setting_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered = backend_setting_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                if($post->BACK_END_SHOW_HIDE == 1){
                    $check = '';
                }else{
                    $check = 'checked';
                }
                
                
                
                $nestedData['SR_NO'] = $i;
                $nestedData['FB_NAME'] = '<input type="text"  id="back_end_name_'.$post->BACK_END_ID.'"  name="fixed_menu" onchange="update_back_end('.$post->BACK_END_ID.')" value="'.$post->BACK_END_TITLE.'" >';
                $nestedData['FB_ORDER'] = '<input type="text" style="width:50px" id="back_end_order_'.$post->BACK_END_ID.'"  name="fixed_menu" onchange="update_back_end_order('.$post->BACK_END_ID.')" value="'.$post->BACK_END_ORDER.'" >';
                $nestedData['FB_SHOW_HIDE'] = '<input type="checkbox" '.$check.' name="fixed_menu" onclick="show_hide_back_end('.$post->BACK_END_ID.')" >';                        
                    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*------------------- end BACKEND SETTING list ---------------------------------------*/


/*--------------------- start USER REGISTRATION SETTING  -----------------------------------------*/
public function new_user_registration_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
            3 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_new_user_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_new_user_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  new_user_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered = new_user_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                $state = get_state_by_id($post->district_state);
                $district = get_district_by_id($post->city);
                
                $app_state = get_state_by_id($post->apprearing_disctrict);
                $app_dis =  get_district_by_id($post->appearing_city);
                
                if($post->exam_type ==1){
                    $exam_type = 'OFF LINE';
                }elseif($post->exam_type == 1){
                     $exam_type = 'ON LINE';
                }else{
                     $exam_type = '';
                }
                
                $total_downloads = $this->db->query("SELECT COUNT(*) AS COUNT FROM `product_download_history` WHERE `USER_ID` = '".$post->USER_ID."' ")->row();
                
                $nestedData['SR_NO'] = $i;
                $nestedData['name'] = $post->name;
                $nestedData['email'] = $post->email;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['address'] = $post->address;
                $nestedData['dob'] = $post->dob;
                $nestedData['father_name'] = $post->father_name;
                $nestedData['mother_name'] = $post->mother_name;
                $nestedData['gender'] = $post->GENDER_NAME;
                $nestedData['category'] = $post->CAST_NAME;
                $nestedData['city'] = $district[0]->DISTRICT_NAME;
                $nestedData['appearing_school_name'] = $post->appearing_school_name;
                $nestedData['apprearing_disctrict'] = $app_state;
                $nestedData['appearing_city'] = $app_dis[0]->DISTRICT_NAME;
                $nestedData['enroll_for'] = $post->ENROLL_NAME;
                $nestedData['course'] = $post->brand_name;
                $nestedData['exam_type'] = $exam_type;
                $nestedData['registration_date'] = $post->date;
                $nestedData['total_downloads'] = $total_downloads->COUNT;
                $nestedData['action'] = '<i class="fa fa-eye">View Detail</i>';
                    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*------------------- end USER REGISTRATION list ---------------------------------------*/

function assign_course_input(){
    
    $center_id = $this->input->get_post('center_id');
    if(isset($_POST['status'])){
        if($_POST['status'] == 'update'){
            echo json_encode(['status' => $this->center_model->assign_course(isset($_POST['courseName']) ? $_POST['courseName'] : [],$center_id)]);
        }
    }
    else
        echo $this->load->view('modules/assign_course_input',['center_id' => $center_id ],true);
}
function load_wallet(){
    if($post= $this->input->post()){
        extract($post);
        
        $o_b = $this->center_model->open_balance($id);
        
        $transaction_id = time();
        $ttl = $o_b +  $amount;
        
        $trans = [
            'o_balance' => abs($o_b),
            'c_balance' => $ttl,
            'amount' => abs($amount),
            'transaction_id' => $transaction_id,
            'status' => 1,
            'time' => $transaction_id,
            'center_id' => $id,
            'type' => strpos($amount,'-') ? 'debit' : 'credit'
            ];
            
        $this->center_model->add_transaction($trans);
        
        $this->center_model->update_wallet($id,$ttl);
        
        echo json_encode(['status' => true,'amount' => $ttl]);
        
    }
}
function create_transaction($data = []){
    if($post = $this->input->post()){
        extract($post);
        $id = $_SESSION['loginid'];
        $row = $this->db->where('id',$id)->get('centers')->row();
        $dataTemp = [
            'firstname' => $row->name,
            'email'  => $row->email_id,
            'phone' => $row->contact_number,
            'amount' => $amount,
            'surl'  => $surl,
            'furl' => $furl,
            'udf1' => $id,
            'udf2' => $udf2,
            'productinfo' => $message
        ];
        $data = array_merge($data,$dataTemp);
    }
    echo json_encode(['form' => ['status' => true , 'html' => $this->genrate_payuform($data)]]); 
    
}

function genrate_payuform($data = []){
    $this->load->library('pum');
    $this->pum->init(config_item('payumoney_salt'),config_item('payumoney_key'));
    $this->pum->add_field($data);
    return $this->pum->submit_pum_ajax();
}

/*---------------------- START CENTER LIST ------------------------------------------------*/
    public function center_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
            18 => 'MEASUREMENT_NAME',
            19 => 'MEASUREMENT_NAME',
            20 => 'MEASUREMENT_NAME',
            21 => 'MEASUREMENT_NAME',
            22 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        $totalData = count_all_center_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_center_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  center_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  center_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                  
                  
                   $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                <div class="project">
                                    <div class="photo-wrapper">
                                        <div class="photo">
                                            <a class="fancybox"  href="'.base_url('uploads/').$post->image.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->image.'" alt=""></a>
                                        </div>
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                            </div>';
            
                    if($post->status ==1){
					      $status = '<b style="font-weight:900;color:green;">'.$post->name.' (ACTIVE)</b>';
					        
					    }else{
					       $status = '<b style="font-weight:900;color:red;">'.$post->name.' (IN-ACTIVE)</b>';
					    }

                $nestedData['SR_NO'] = $i;
                $nestedData['PHOTO'] = $image;
                $nestedData['OWNER_NAME'] =  $status;
                $nestedData['INSTITUTE_NAME'] =  $post->institute_name;
                $nestedData['DOB'] =  $post->dob;
                $nestedData['PANCARD'] =  $post->pan_number;
                $nestedData['AADHAR_CARD'] =  $post->aadhar_number;
                $nestedData['INSTITUTE_ADDRESS'] =  $post->center_full_address;
                $nestedData['STATE'] =  @$post->STATE_NAME;
                $nestedData['DISTRICT'] =  @$post->DISTRICT_NAME;
                $nestedData['CLASS_ROOMS'] =  $post->no_of_class_room;
                $nestedData['INSTITTUTE_HEAD'] =  $post->qualification_of_center_head;
                $nestedData['RECEPTION'] =  $post->reception;
                $nestedData['STAFF'] =  $post->staff_room;
                $nestedData['WATER_SUPPLY'] =  $post->water_supply;
                $nestedData['TOILET'] =  $post->toilet;
                $nestedData['PASSWORD'] =  @'<b style="font-weight:900;color:green;">'.$post->email_id.' ('.$post->center_password.')</b> '; 
                
                $nestedData['CITY_NAME'] =  $post->city_name;
                $nestedData['MOBILE'] =  $post->contact_number;
                $nestedData['EMAIL'] =  $post->email_id;
                $nestedData['SEAT_CAPACITY'] =  $post->space_of_computer_center;
                $nestedData['COMPUTER_LAB'] =  $post->no_of_computer_operator;
                $nestedData['FIRST_AID'] =  $post->first_aid;
                $nestedData['COURSE_BTN'] = '<button type="button" class="btn btn-primary btn-white btn-round assign-course" data-id="'.$post->id.'">Assign Courses</button>';
                $nestedData['WALLET_BTN'] = '<b class="wallet-balance">'.($post->wallet ? $post->wallet : 0).' <i class="fa fa-rupee"></i></b><br><button type="button" class="btn btn-primary btn-xs btn-white btn-round load-wallet" data-id="'.$post->id.'">Wallet</button>';
                
                 $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="'.site_url('admin/add_center/'.$post->id.'').'"   ><i class="fa fa-edit"> UPDATE</i></a></li>
                            <li class="divider"></li>
                            <li><a href="'.site_url('printbill/center_certificate/'.($post->id).'').'"   ><i class="fa fa-certificate"> Certificate</i></a></li>
                            <li><a  class=" update_center_status"  id="'.$post->id.'" centerid="'.$post->id.'"  href="javascript:void(0);"   ><i class="fa fa-edit"> ACTIVE/DEACTIVE </i></a></li>                            
                            <li><a class="delete_center" id="'.$post->id.'" DELETE_centerid="'.$post->id.'"  href="javascript:void(0);" ><i class="fa fa-close"> Remove</i></a></li>    
                          </ul>
                        </div>                      
                    ';    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

/*----------------------- END CENTER LIST --------------------------------------------------*/

/*---------------------------------------Show Student----------------------------------------*/ 
    public function show_student()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'FQUESTION',
            2 => 'FQUESTION',
            3 => 'FQUESTION',
            4 => 'FQUESTION',
            5 => 'FQUESTION',
            6 => 'FQUESTION',
            7 => 'FQUESTION',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        if(empty($_POST['year'])){
            $year=0;
        }else{
            $year=$_POST['year'];
        }
        
        
        //print_r($this->session->all_userdata());

        
        
        if($_SESSION['type'] == 1){
            $center = 'all';
            $type=$_SESSION['type'];
        }else{
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            $type=$_SESSION['type'];
        }
        $course = $_POST['course_id'];
        $courses=$this->db->get_where('courses',['id'=>$course])->row();
        $duration=$courses->duration;
        
        $dates=date('Y-m-d');
        $exam_date=$this->db->query('select * from exam_schedule where course_id="'.$course.'" and year="'.$year.'"  ')->result();
        $date=new DateTime('now');
        $date=$date->modify('-'.$duration.'months');
        $status=$date->format('Y-m-d');
        // die(var_dump($status));
        //echo 'courseid-'.$course.',centerid-'.$center.', type-'.$type.', year'.$year.'  ';
       
        $totalData = count_all_show_student($status,$course,$center,$type,$year);

        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {

            $posts = all_show_student($limit, $start, $order, $dir,$status,$course,$center,$type,$year);

        } else {

            $search = $this->input->post('search')['value'];

            $posts =  show_student_search($limit, $start, $search, $order, $dir,$status,$course,$center,$type,$year);

            $totalFiltered =  show_student_search_count($search,$status,$course,$center,$type,$year);

        }

        $data = array();
        // $content='<div><select id="student_exam_date" course_id="'.$course.'" student_id="'.$post->student_id.'">
        // <option> select date</option>
        // '; 
        // foreach($exam_date as $row) {
        //     $content .= "<option value='$row->id'  >$row->exam_date</option>";
        // }                   
        // $content.='</select></div>'; 
        
        //print_r($posts);
        
        
        if (!empty($posts)) {

            $i = $start + 1;

            foreach ($posts as $post) {
                $content='
                            <div>
                                <select id="student_exam_date" course_id="'.$course.'" student_id="'.$post->student_id.'" center_id="'.$post->center_id.'"  enroll="'.$post->enrollment_no.'" subject_id="'.$post->subject_id.'" year="'.$year.'">
                                    <option> select date</option>'; 
                                    foreach($exam_date as $row) {
                                        $content .= "<option value='$row->id'  >$row->exam_date</option>";
                                    }                   
                $content.='</select></div>';
                   $check=$this->db->query("select * from Assign_exam_student where student_id='".$post->student_id."'  and subject_id='".$post->subject_id."'  ");
                   $checks=$check->row();
                    if ($check->num_rows() >0) {
                        $type=$checks->type;
                        if($type==0){
                            $s_type='theory Exam Scheduled';
                        }else{
                            $s_type='practical Exam Scheduled';
                        }
                        if($check->num_rows()==1){
                            $status = '<b style="color:red;">'.$s_type.'</b>';
                        }else{
                            $status = '<b style="color:red;">Exam scheduled</b>';
                        }
                    }else{
    
                        $status = '<b style="color:green;">Pending</b>';
    
                    }



                $nestedData['SR_NO'] = $i;

                $nestedData['name'] = $post->student_name;

                $nestedData['mobile'] = $post->mobile;

                $nestedData['course'] = $post->course_name;
                if($post->practical==1){
                    $subject_type='PRACTICAL';
                }elseif($post->practical==0){
                    $subject_type='THEORY';
                }else{
                    $subject_type='both';
                }
                if($post->practical==2){
                    $nestedData['course_type'] = '<select name="type" id="'.$post->student_id.'_'.$post->subject_id.'_type">
                    <option value="0">theory</option>
                    <option value="1">practical</option>
                    </select>';
                }else{
                    $nestedData['course_type'] = '<input type="hidden" id="'.$post->student_id.'_'.$post->subject_id.'_type" value="'.$post->practical.'">'.$subject_type;
                }
                $nestedData['subject'] = $post->subject_name;
                $nestedData['session'] = ''.$post->start.' - '.$post->end.' ';;

                $nestedData['doa'] = $post->addmission_date;

                $nestedData['enroll_no'] = $post->enrollment_no;
                $nestedData['center'] = $post->institute_name;

                $nestedData['exam_date'] = $content;
                

                $nestedData['status'] = $status;

           
                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }



/*--------- start default show listing ---------------------------------------*/
    public function show_student2()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'FQUESTION',
            2 => 'FQUESTION',
            3 => 'FQUESTION',
            4 => 'FQUESTION',
            5 => 'FQUESTION',
            6 => 'FQUESTION',
            7 => 'FQUESTION',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        if(empty($_POST['year'])){
            $year=0;
        }else{
            $year=$_POST['year'];
        }
        if($_SESSION['type'] == 1){
            $center = 'all';
            $type=$_SESSION['type'];
        }else{
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            $type=$_SESSION['type'];
        }
        $course = $_POST['course_id'];
        $courses=$this->db->get_where('courses',['id'=>$course])->row();
        $duration=$courses->duration;
        
        $dates=date('Y-m-d');
        $exam_date=$this->db->query('select * from exam_schedule where course_id="'.$course.'" and year="'.$year.'"  ')->result();
        $date=new DateTime('now');
        $date=$date->modify('-'.$duration.'months');
        $status=$date->format('Y-m-d');
        $totalData = count_all_show_student2($status,$course,$center,$type,$year);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_show_student2($limit, $start, $order, $dir,$status,$course,$center,$type,$year);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  show_student_search2($limit, $start, $search, $order, $dir,$status,$course,$center,$type,$year);
            $totalFiltered =  show_student_search_count2($search,$status,$course,$center,$type,$year);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $content='
                            <div>
                                <select id="student_exam_date" course_id="'.$course.'" student_id="'.$post->student_id.'" center_id="'.$post->center_id.'"  enroll="'.$post->enrollment_no.'" subject_id="'.$post->subject_id.'" year="'.$year.'">
                                    <option> select date</option>'; 
                                    foreach($exam_date as $row) {
                                        $content .= "<option value='$row->id'  >$row->exam_date</option>";
                                    }                   
                $content.='</select></div>';
                   $check=$this->db->query("select * from Assign_exam_student where student_id='".$post->student_id."'  and subject_id='".$post->subject_id."'  ");
                   $checks=$check->row();
                    if ($check->num_rows() >0) {
                        $type=$checks->type;
                        if($type==0){
                            $s_type='theory Exam Scheduled';
                        }else{
                            $s_type='practical Exam Scheduled';
                        }
                        if($check->num_rows()==1){
                            $status = '<b style="color:red;">'.$s_type.'</b>';
                        }else{
                            $status = '<b style="color:red;">Exam scheduled</b>';
                        }
                    }else{
    
                        $status = '<b style="color:green;">Pending</b>';
    
                    }
                $nestedData['SR_NO'] = $i;
                $nestedData['name'] = $post->student_name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['course'] = $post->course_name;
                
                if($post->practical==1){
                    $subject_type='PRACTICAL';
                }elseif($post->practical==0){
                    $subject_type='theory';
                }else{
                    $subject_type='both';
                }
            if($post->practical==2){
                $nestedData['course_type'] = '<select name="type" id="'.$post->student_id.'_'.$post->subject_id.'_type">
                <option value="0">theory</option>
                <option value="1">practical</option>
                </select>';
            }else{
                $nestedData['course_type'] = '<input type="hidden" id="'.$post->student_id.'_'.$post->subject_id.'_type" value="'.$post->practical.'">'.$subject_type;
            }
                $nestedData['subject'] = $post->subject_name;
                $nestedData['session'] = $post->session;

                $nestedData['doa'] = $post->addmission_date;

                $nestedData['enroll_no'] = $post->enrollment_no;
                $nestedData['center'] = $post->institute_name;

                $nestedData['exam_date'] = $content;
                

                $nestedData['status'] = $status;

           
                $i++;

                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }



/*--------------- end deault listing -----------------------------------------------*/



    
    public function assign_exam_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'FQUESTION',
            2 => 'FQUESTION',
            3 => 'FQUESTION',
            4 => 'FQUESTION',
            5 => 'FQUESTION',
            6 => 'FQUESTION',
            7 => 'FQUESTION',
            8 => 'FQUESTION',
            9 => 'FQUESTION',
            10 => 'FQUESTION',
        );
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            $type=$_SESSION['type'];
        }
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = count_all_assign_exam_student($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_assign_exam_student($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  assign_exam__student_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  assign_exam__student_search_count($search,$center);
        }
        
       // print_r($posts);
        
        $dates=date('Y-m-d');
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                if($post->exam_date<=$dates){
                    $content='<b class="text-danger">exam held on '.date('d-m-Y',strtotime($post->exam_date)).'</b>';
                }else{
                $exam_date=$this->db->query('select * from exam_schedule where course_id="'.$post->course_id.'" and exam_date >= "'.$dates.'"')->result();
              $content='<div><select id="student_update_exam_date" course_id="'.$post->course_id.'" subject_id="'.$post->subject_id.'" student_id="'.$post->student_id.'" exam_id="'.$post->exam_id.'" enroll="'.$post->enrollment_no.'">
        <option> select date</option>
        '; 
        foreach($exam_date as $row) {
            if($row->exam_date==$post->exam_date){
            $content .= "<option value='$row->id'  selected>$row->exam_date</option>";
            }else{
                $content .= "<option value='$row->id'  >$row->exam_date</option>";
            }
        }                   
        $content.='</select></div>';
}

                $nestedData['SR_NO'] = $i;
                $nestedData['name'] = @$post->student_name;
                $nestedData['mobile'] = $post->mobile;
                $nestedData['course'] = $post->course_name;
                $nestedData['session'] = @$post->start.'-'.@$post->end;
                $nestedData['doa'] = $post->addmission_date;
                $nestedData['enroll_no'] = $post->enrollment_no;
                $nestedData['center'] = $post->institute_name;
                $nestedData['exam_date'] = $content;
                $nestedData['start_date'] = $post->start_time;
                $nestedData['end_date'] = $post->end_time;
                $nestedData['status'] =  '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class="delete_exam_date"  href="javascript:void(0); " deleteexamid="'.$post->exam_id.'" ><i class="fa fa-edit"> DELETE</i></a></li>
                          </ul>
                        </div>                      
                    ';               
                $i++;
                $data[] = $nestedData;

            }

        }

        $json_data = array(

            "draw"            => intval($this->input->post('draw')),

            "recordsTotal"    => intval($totalData),

            "recordsFiltered" => intval($totalFiltered),

            "data"            => $data

        );

        echo json_encode($json_data);

    }
/*---------------------- START SUTDENT LIST ------------------------------------------------*/

    public function student_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
        }
        
        
        $totalData = count_all_student_list($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_student_list($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  student_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  student_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                    if($post->status == 1){
                        $status = 'ACTIVE';
                    }else{
                        $status = 'CANCEL';
                    }
        
        
            $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->photo.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
            
            
            $image2 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->signature.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';

            
            $image3 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->left_thumb.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                
    
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['PHOTO'] = $image;
                $nestedData['SIG'] = $image2;
                $nestedData['LEFT_THUMB'] = $image3;
                
                $nestedData['ENTOLLMENT'] = $post->enrollment_no;
                $nestedData['STUDENT_NAME'] =  $post->student_name;
                $nestedData['GENDER'] =  $post->address;
                $nestedData['FATHER_NAME'] =  $post->father;
                $nestedData['MOTHER_NAME'] =  $post->mother;
                $nestedData['DOB'] =  $post->student_dob;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['EMAIL'] =  $post->email;
                $nestedData['STATE'] =  @$post->state;
                $nestedData['DISTRICT'] =  @$post->distric;
                $nestedData['EXAM_PASS'] =  $post->category;
                $nestedData['MARKS'] =  $post->disability;
                $nestedData['USER_NAME'] =  $post->username;
                $nestedData['COURSE_NAME'] =  $post->course_name;
                $nestedData['CENTER_NAME'] =  $post->institute_name;
                
                $nestedData['CITY'] =  $post->city;
                $nestedData['PINCODE'] =  $post->pincode;
                $nestedData['HIGHEST_QUALIFICATION'] =  $post->highest_qualification;
                $nestedData['PASSING_YEAR'] =  $post->passing_year;
                $nestedData['ADHAR_NUMBER'] =  $post->adhar_number;
                
                $nestedData['STATUS'] =  $status;
                $result=$this->db->get_where('results',['enrollment_no'=>$post->enrollment_no])->num_rows();
                $admit=$this->db->get_where('admit_card',['enrollment_no'=>$post->enrollment_no])->num_rows();
                if($result<0 or $admit <0){
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" update_student_status"  id="'.$post->id.'" studentid="'.$post->id.'" " href="javascript:void(0);"><i class="fa fa-user"> CANCEL ADDMISSION </i></a></li>
                            <li class="divider"></li>
                                                        
                                <li><a href="'.site_url('admin/add_student/'.$post->id.'').'"   ><i class="fa fa-edit"> UPDATE</i></a></li>
                            <li class="divider"></li>
                                                        
                                <li><a href="'.site_url('printbill/admission_form/'.$post->id.'').'"  target="_blank" ><i class="fa fa-edit"> DOWNLAOD  FORM</i></a></li>
                                <li class="divider"></li>
                                                        
                                <li><a href="'.site_url('printbill/generate_card/'.$post->id.'').'"  target="_blank" ><i class="fa fa-edit"> DOWNLAOD  ID CARD</i></a></li>
                          </ul>
                        </div>                      
                    '; 
                }else{
                       $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            
                            <li class="divider"></li>
                                                        
                                <li><a href="'.site_url('admin/add_student/'.$post->id.'').'"   ><i class="fa fa-edit"> UPDATE</i></a></li>
                            <li class="divider"></li>
                                                        
                                <li><a href="'.site_url('printbill/admission_form/'.$post->id.'').'"   target="_blank"><i class="fa fa-edit"> DOWNLAOD  FORM</i></a></li>
                                <li class="divider"></li>
                                                        
                                <li><a href="'.site_url('printbill/generate_card/'.$post->id.'').'"  target="_blank" ><i class="fa fa-edit"> DOWNLAOD  ID CARD</i></a></li>
                          </ul>
                        </div>                      
                    ';
                }
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }




    public function download_admit_card()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            // die(var_dump($center));
        }
        
        
        $totalData = count_download_admit_card($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_download_admit_card($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  download_admit_card_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  download_admit_card_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                    if($post->status == 1){
                        $status = 'ACTIVE';
                    }else{
                        $status = 'CANCEL';
                    }
        
        
            $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->photo.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
            
            
       
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['PHOTO'] = $image;
                $nestedData['ENTOLLMENT'] = $post->enrollment_no;
                $nestedData['STUDENT_NAME'] =  $post->name;
                $nestedData['COURSE'] =  ''.$post->course_name.' / <span class="label label-success arrowed-in arrowed-in-right"><i class="fa fa-calender"></i> '.(($post->type == 1) ? $post->duration .' Months'  : ($post->type == 3 ? $post->duration .' Semesters'  : $post->course_year .' Year ')).'</span>';
                $nestedData['SESSION'] =  $post->start.'-'.$post->end;
              
                $nestedData['FATHER_NAME'] =  $post->father;
                $nestedData['MOTHER_NAME'] =  $post->mother;
                $nestedData['DOB'] =  $post->dob;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['EMAIL'] =  $post->email;
                $nestedData['ADDRESS'] =  $post->address;
                
                $nestedData['CENTER_NAME'] =  $post->institute_name;
                
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            
                                            <li><a href="'.site_url('printbill/admit_card/'.$post->card_id.'').'"  target="_blank" ><i class="fa fa-edit"> DOWNLOAD</i></a></li>            
                                
                                
                          
                          </ul>
                        </div>                      
                    '; 
            
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    // student pending list
    public function student_pending_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            // die(var_dump($center));
        }
        
        
        $totalData = count_all_student_pending_list($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_student_pending_list($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  student_pending_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  student_pending_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                    if($post->pay_status == 0){
                        $status = 'PENDING';
                    }else{
                        $status = 'CANCEL';
                    }
        
        
            $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->photo.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
            
            
            $image2 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->signature.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->signature.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';

            
            $image3 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->left_thumb.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->left_thumb.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                
    
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['ENTOLLMENT'] = $post->enrollment_no.' '.get_admission_type($post->vip);
                $nestedData['STUDENT_NAME'] =  $post->student_name;
                $nestedData['GENDER'] =  $post->address;
                $nestedData['FATHER_NAME'] =  $post->father;
                $nestedData['MOTHER_NAME'] =  $post->mother;
                $nestedData['DOB'] =  $post->student_dob;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['EMAIL'] =  $post->email;
                $nestedData['STATE'] =  @$post->state;
                $nestedData['DISTRICT'] =  @$post->distric;
                $nestedData['EXAM_PASS'] =  $post->category;
                $nestedData['MARKS'] =  $post->disability;
                $nestedData['USER_NAME'] =  $post->username;
                $nestedData['COURSE_NAME'] =  $post->course_name;
                $nestedData['CENTER_NAME'] =  $post->institute_name;
                $nestedData['CITY'] =  $post->city;
                $nestedData['PINCODE'] =  $post->pincode;
                $nestedData['HIGHEST_QUALIFICATION'] =  $post->highest_qualification;
                $nestedData['PASSING_YEAR'] =  $post->passing_year;
                $nestedData['ADHAR_NUMBER'] =  $post->adhar_number;
                  $nestedData['PHOTO'] = $image;
                $nestedData['SIG'] = $image2;
                $nestedData['LEFT_THUMB'] = $image3;
                $nestedData['STATUS'] =  $status;
                
                if($_SESSION['type'] == 1){
                    $approve_status = '<li><a class=" update_pending_student_status"  id="'.$post->id.'" studentid="'.$post->id.'" studentstatus="1"  href="javascript:void(0);"><i class="fa fa-user"> APPROVE ADMISSION </i></a></li>
                           <li class="divider"></li>
                            <li><a class=" update_pending_student_status"  id="'.$post->id.'" studentid="'.$post->id.'" studentstatus="2"    href="javascript:void(0);"><i class="fa fa-user"> CANCEL ADMISSION </i></a></li>
                            <li class="divider"></li>';
                }else{
                    $approve_status = '';
                }
                
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            '.$approve_status.'
                            <li><a href="'.site_url('admin/add_student/'.$post->id.'').'"   ><i class="fa fa-edit"> UPDATE</i></a></li>
                          </ul>
                        </div>                      
                    ';               
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    // student approve list
    public function student_approve_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = 'DESC';
        //$dir = $this->input->post('order')[0]['dir'];
        
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            // die(var_dump($center));
        }
        
        
        $totalData = count_all_student_approve_list($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_student_approve_list($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  student_approve_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  student_approve_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                    if($post->pay_status == 1){
                        
                        $status = 'APPROVE';
                        $enrollment = '<b style="font-weight:900;color:green;">'.$post->enrollment_no.' <br>( '.date("d-m-Y", strtotime($post->addmission_date)) .'  )</b>';
                        $payment = '<span class="label label-success arrowed-in arrowed-in-right"><i class="fa fa-inr"></i> Paid</span>
                                    <span class="label label-success arrowed-in arrowed-in-right" style="margin-top: 2px;"><i class="fa fa-inr"></i> '.$post->BATCH_NAME.'</span>
                                    ';
                        
                    }else{
                        $status = 'CANCEL';
                         $enrollment = '<b style="font-weight:900;color:red;">'.$post->enrollment_no.' <br>( '.date("d-m-Y", strtotime($post->addmission_date)) .'  )</b>';
                         $payment = '<span class="label label-danger arrowed-in arrowed-in-right"><i class="fa fa-inr"></i> Pending</span>
                         <span class="label label-success arrowed-in arrowed-in-right"  style="margin-top: 2px;"><i class="fa fa-inr"></i> '.$post->BATCH_NAME.'</span>
                         ';
                        
                    }
        
        
            $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->photo.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
            
            
            $image2 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->signature.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->signature.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';

            
            $image3 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->left_thumb.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->left_thumb.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                
                $center_name = '<span class="label label-inverse" style="padding: 5px;">'.$post->institute_name.'  </span>
                                <span class="label label-inverse" style="padding: 5px;"> ( '.$post->center_number.' ) </span>
                ';
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['ENTOLLMENT'] = $enrollment.$center_name.' '.get_admission_type($post->vip);
                $nestedData['STUDENT_NAME'] =  $post->student_name.$payment;
                $nestedData['GENDER'] =  $post->address;
                $nestedData['FATHER_NAME'] =  $post->father;
                $nestedData['MOTHER_NAME'] =  $post->mother;
                $nestedData['DOB'] =   date("d-m-Y", strtotime($post->student_dob)) ;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['EMAIL'] =  $post->email;
                $nestedData['STATE'] =  @$post->STATE_NAME;
                $nestedData['DISTRICT'] =  @$post->DISTRICT_NAME;
                $nestedData['EXAM_PASS'] =  @$post->brand_name;
                $nestedData['MARKS'] =  $post->disability;
                $nestedData['USER_NAME'] =  $post->email;
                $nestedData['COURSE_NAME'] =  $post->course_name;
                $nestedData['CENTER_NAME'] =  $post->institute_name;
                
                $nestedData['CITY'] =  $post->city;
                $nestedData['PINCODE'] =  $post->pincode;
                $nestedData['HIGHEST_QUALIFICATION'] =  $post->highest_qualification;
                $nestedData['PASSING_YEAR'] =  $post->passing_year;
                $nestedData['ADHAR_NUMBER'] =  $post->adhar_number;
                 $nestedData['PHOTO'] = $image;
                $nestedData['SIG'] = $image2;
                $nestedData['LEFT_THUMB'] = $image3;
                
             
                $nestedData['STATUS'] =  $status;
                
                if($_SESSION['type'] == 1){
                    $approve_status = '<li><a class="update_student_status"  id="'.$post->id.'" studentid="'.$post->id.'" " href="javascript:void(0);"><i class="fa fa-user"> CANCEL ADMISSION </i></a></li>';
                }else{
                        
                   $approve_status = '';
                }
                
                
                
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            '.$approve_status.'
                            <li class="divider"></li>';
                            if($_SESSION['type'] == 1) 
                            $nestedData['ACTION'] .= '<li><a href="'.site_url('admin/add_student/'.$post->id.'').'"   ><i class="fa fa-edit"> UPDATE</i></a></li><li class="divider"></li>';
                   $nestedData['ACTION'] .= '
                            <li><a href="'.site_url('printbill/admission_form/'.$post->id.'').'"  target="_blank" ><i class="fa fa-edit"> DOWNLAOD  FORM</i></a></li>
                            <li class="divider"></li>
                            <li><a href="'.site_url('printbill/generate_card/'.$post->id.'').'"  target="_blank" ><i class="fa fa-edit"> DOWNLAOD  ID CARD</i></a></li>
                          </ul>
                        </div>                      
                    ';             
                    //generate_card
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
    // student cancel list
    public function student_cancel_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $centers = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row();
            $center=$centers->id;
            // die(var_dump($center));
        }
        
        
        $totalData = count_all_student_cancel_list($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_student_cancel_list($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  student_cancel_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  student_cancel_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                    if($post->pay_status == 2){
                        $status = 'CANCEL';
                    }else{
                        $status = '';
                    }
        
        
            $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->photo.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
            
            
            $image2 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->signature.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';

            
            $image3 = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->left_thumb.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->photo.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                
    
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['ENTOLLMENT'] = $post->enrollment_no;
                $nestedData['STUDENT_NAME'] =  $post->student_name;
                $nestedData['GENDER'] =  $post->address;
                $nestedData['FATHER_NAME'] =  $post->father;
                $nestedData['MOTHER_NAME'] =  $post->mother;
                $nestedData['DOB'] =  $post->student_dob;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['EMAIL'] =  $post->email;
                $nestedData['STATE'] =  @$post->STATE_NAME;
                $nestedData['DISTRICT'] =  @$post->DISTRICT_NAME;
                $nestedData['EXAM_PASS'] =  $post->brand_name;
                $nestedData['MARKS'] =  $post->disability;
                $nestedData['USER_NAME'] =  $post->username;
                $nestedData['COURSE_NAME'] =  $post->course_name;
                $nestedData['CENTER_NAME'] =  $post->institute_name;
                
                $nestedData['CITY'] =  $post->city;
                $nestedData['PINCODE'] =  $post->pincode;
                $nestedData['HIGHEST_QUALIFICATION'] =  $post->highest_qualification;
                $nestedData['PASSING_YEAR'] =  $post->passing_year;
                $nestedData['ADHAR_NUMBER'] =  $post->adhar_number;
                  $nestedData['PHOTO'] = $image;
                $nestedData['SIG'] = $image2;
                $nestedData['LEFT_THUMB'] = $image3;
                
              
                $nestedData['STATUS'] =  $status;
                
                
                if($_SESSION['type'] == 1){
                    $approve_status = '<li><a class=" update_student_status"  id="'.$post->id.'" studentid="'.$post->id.'" " href="javascript:void(0);"><i class="fa fa-user"> APPROVE ADMISSION </i></a></li>';
                }else{
                    $approve_status = '';    
                    
                }
                
                
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            '.$approve_status.'
                
                          </ul>
                        </div>                      
                    ';               
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
// generate certificate
    public function gererate_certificate_student()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
            18 => 'MEASUREMENT_NAME',
        );
        if($_SESSION['type'] == 1){
            // die('here');
            $center = 'all';
            $type=$_SESSION['type'];
        }else{
             $type=$_SESSION['type'];   
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
            
             $center = $_SESSION['loginid'];
        }
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status=$_POST['status'];  
        // die(var_dump($center));
        $totalData = count_all_generate_certificate_list($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_generate_certificate_list($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  generate_certificate_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  generate_certificate_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            $max_marks='';
            $obt_marks='';
           
           //print_r($posts);
            
            foreach ($posts as $post) {
                  
                  
                  if($post->status==0){
                      $status='<b class"text-info">PENDING</b>';
                  }elseif($post->status==1){
                      $status='<b class="text-success">CREATED </b>';
                  }else{
                      $status='<b class="text-danger">CANCEL</b>';
                  }  
                  if($post->ctype==1){
                      $duration=$post->duration.'months';
                  }
                  elseif($post->ctype==3){
                      $duration=$post->year.'semesters';
                  }else{
                      $duration=$post->year.'years';
                  }
                  
                
            
                if($_SESSION['type'] == 1){
                    
                  $certificate =   $this->db->query("SELECT * FROM `student_certificate` WHERE `result_id` LIKE '".$post->result_id."'")->row();
                    
                    
                    $update_certificate = '<input type="text" onkeyup="update_certificate_date('.$post->result_id.')"  id="certificate_'.$post->result_id.'" value="'.@$certificate->certificate_date.'">';
                }else{
                    $update_certificate = '';
                }
        
                $nestedData['SR_NO'] = $i;
                $nestedData['DATE'] = date('Y-m-d',strtotime($post->timestamp));
                $nestedData['NAME'] =  $post->name;
                $nestedData['ENROLLMENT'] =  $post->enrollment_no;
                $nestedData['COURSE'] =  $post->course_name;
                $nestedData['DURATION'] =  $duration.'---'.$post->result_id.' ';
                $nestedData['YEAR'] =  getDurationName($post->year,$post->ctype,true,true);
                $nestedData['PERCENTAGE'] =  @$post->percentage;
                $nestedData['RESULT'] =  @$post->result.'<br>'.$update_certificate. '' ;
                $getDate = $post->timestamp;
                $genDate = $this->db->where(['type_id' => $post->student_id,'type' => 'certificate'])->get('gen_date');
                if($genDate->num_rows()){
                    $getDate = $genDate->row()->date;
                }
                
                
                $nestedData['GENRATE_DATE'] = '<input type="date" class="update-date" data-type="certificate" data-type_id="'.$post->student_id.'" value="'.date('Y-m-d',strtotime($getDate)).'">';
                $studentYear = $studentsType = 0;
                $nestedData['STATUS'] =  @$status;
                $students =   $this->db->query("SELECT * FROM `students` LEFT JOIN courses ON courses.id=students.course_id WHERE students.enrollment_no LIKE '".$post->enrollment_no."' ");
                if($students->num_rows()){
                    $students = $students->row();
                    $studentsType = $students->type;
                        $studentYear = $students->type == 3 ? $students->duration : $students->years;
                }                
                if($post->status==0){
                    if($_SESSION['type'] == 1){
                        //  $nestedData['ACTION'] = $post->roll_no; 
                       $num_result =  $this->db->query("SELECT * FROM `results` WHERE `enrollment_no` LIKE '".$post->enrollment_no."'")->num_rows();
                        
                    //   $students =   $this->db->query("SELECT * FROM `students` LEFT JOIN courses ON courses.id=students.course_id WHERE students.enrollment_no LIKE '".$post->enrollment_no."' ")->row();
                        if($studentsType == 1){   //  for month
                            
                            if($num_result == 1){
                                $nestedData['ACTION'] = '
                                    <div style="min-width:100px;" class="btn-group">
                                      <button type="button" class="btn btn-theme03">Action</button>
                                      <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                      
                                      <li><a class="generate_student_certificate"  center_id="'.$post->center_id.'" enroll_no="'.$post->enrollment_no.'"   result_id="'.$post->result_id.'"  course_id="'.$post->course_id.'" qr_code="'.$post->qr_code.'" year="'.$duration.'"  href="javascript:void(0);"><i class="fa fa-user"> GENERATE CERTIFICATE </i></a></li>
                                       
                                        
                                      </ul>
                                    </div>                      
                                ';
                            }else{
                                $nestedData['ACTION'] = $post->course_id;
                            }
                            
                        }
                        // elseif($students->type == 3){
                        //     $nestedData['ACTION'] = "SELECT * FROM `students` LEFT JOIN courses ON courses.id=students.course_id WHERE students.enrollment_no LIKE '".$post->enrollment_no."' ";
                        // }
                        else{   // for year
                           
                            if($post->year == $studentYear ){
                                $nestedData['ACTION'] = '
                                    <div style="min-width:100px;" class="btn-group">
                                      <button type="button" class="btn btn-theme03">Action</button>
                                      <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                      
                                      <li><a class="generate_student_certificate"  center_id="'.@$post->center_id.'" enroll_no="'.$post->enrollment_no.'"   result_id="'.$post->result_id.'"  course_id="'.$post->course_id.'" qr_code="'.@$post->qr_code.'" year="'.$duration.'"  href="javascript:void(0);"><i class="fa fa-user"> GENERATE CERTIFICATE </i></a></li>
                                       
                                        
                                      </ul>
                                    </div>                      
                                ';
                            // }elseif($num_result == $students->years){
                            //     $nestedData['ACTION'] = '
                            //         <div style="min-width:100px;" class="btn-group">
                            //           <button type="button" class="btn btn-theme03">Action</button>
                            //           <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            //             <span class="caret"></span>
                            //             <span class="sr-only">Toggle Dropdown</span>
                            //           </button>
                            //           <ul class="dropdown-menu" role="menu">
                                      
                            //           <li><a class="generate_student_certificate"  center_id="'.$post->center_id.'" enroll_no="'.$post->enrollment_no.'"   result_id="'.$post->result_id.'"  course_id="'.$post->course_id.'" qr_code="'.$post->qr_code.'" year="'.$duration.'"  href="javascript:void(0);"><i class="fa fa-user"> GENERATE CERTIFICATE </i></a></li>
                                       
                                        
                            //           </ul>
                            //         </div>                      
                            //     ';
                            }else{
                                $nestedData['ACTION'] = '2';
                            }
                        
                            
                        }    
                        
                        
                        
                    }else{
                        $nestedData['ACTION'] = '3
                                                  
                        ';
                    }
                    
                    
                }else{
                    if($_SESSION['type'] == 1){
                        // $studentYear = $students->type == 3 ? $students->duration : $students->years;
                        if($post->year == $studentYear ){
                            $nestedData['ACTION'] = '
                                <div style="min-width:100px;" class="btn-group">
                                  <button type="button" class="btn btn-theme03">Action</button>
                                  <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                  <li><a class=""    href="'.base_url('printbill/print_certificate/').AJ_ENCODE($post->student_id).'" target="_blank"><i class="fa fa-edit"> VIEW CERTIFICATE</i></a></li>
                                  <li><a class="delete_certificate"  enroll_no="'.$post->enrollment_no.'"    href="javascript:void(0)"><i class="fa fa-edit"> DEELTE CERTIFICATE</i></a></li>
                                   
                                    
                                  </ul>
                                </div>                      
                            '; 
                        }else{
                            $nestedData['ACTION'] = '4';
                        }
                    }else{
                        $nestedData['ACTION'] = '
                            <div style="min-width:100px;" class="btn-group">
                              <button type="button" class="btn btn-theme03">Action</button>
                              <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                              <li><a class=""    href="'.base_url('printbill/print_certificate/').AJ_ENCODE($post->student_id).'" target="_blank"><i class="fa fa-edit"> VIEW CERTIFICATE</i></a></li>
                                
                              </ul>
                            </div> '; 
                    }
                   
                }
            
                
                
                if($post->year == $studentYear ){        
                   
                    $i++;
                    $data[] = $nestedData;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
// PENDING ENQUIRY
public function pending_enquiry()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        if($_SESSION['type'] == 1){
            $center = 'all';
            $type=$_SESSION['type'];
        }else{
             $type=$_SESSION['type'];   
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
        }
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status=$_POST['status'];  
        // die(var_dump($status));
        $totalData = count_all_pending_list($status,$type,$center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_pending_list($limit, $start, $order, $dir,$status,$type,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  pending_list_search($limit, $start, $search, $order, $dir,$status,$type,$center);
            $totalFiltered =  pending_list_search_count($search,$status,$type,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                  if($post->status==0){
                      $status='<b class"text-info">PENDING</b>';
                  }elseif($post->status==1){
                      $status='<b class="text-success">APPROVE </b>';
                  }else{
                      $status='<b class="text-danger">CANCEL</b>';
                  }  
        
        
                
    
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['ENQ_DATE'] = date('Y-m-d',strtotime($post->enquiry_date));
                $nestedData['FOLLOW_DATE'] =  date('Y-m-d',strtotime($post->followup));
                $nestedData['NAME'] =  $post->name;
                $nestedData['EMAIL'] =  $post->emailid;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['DOB'] =  $post->dob;
                $nestedData['COURSE'] =  $post->course_name;
                $nestedData['SESSION'] =  $post->start.'-'.$post->end;
                $nestedData['REMARKS'] =  @$post->remarks;
                $nestedData['SOURCE'] =  @$post->source;
                
                $nestedData['STATUS'] =  $status;
                              
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
// all enquiry
public function all_enquiry()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        if($_SESSION['type'] == 1){
            $center = 'all';
            $type=$_SESSION['type'];
        }else{
             $type=$_SESSION['type'];   
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
        }
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status=0;  
        // die(var_dump($status));
        $totalData = count_all_enquiry_list($status,$center,$type);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_enquiry_list($limit, $start, $order, $dir,$status,$center,$type);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  enquiry_list_search($limit, $start, $search, $order, $dir,$status,$center,$type);
            $totalFiltered =  enquiry_list_search_count($search,$status,$center,$type);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                  if($post->status==0){
                      $status='<b class"text-info">PENDING</b>';
                  }elseif($post->status==1){
                      $status='<b class="text-success">APPROVE </b>';
                  }else{
                      $status='<b class="text-danger">CANCEL</b>';
                  }  
        
        
                
    
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['ENQ_DATE'] = date('Y-m-d',strtotime($post->enquiry_date));
                $nestedData['FOLLOW_DATE'] =  date('Y-m-d',strtotime($post->followup));
                $nestedData['NAME'] =  $post->name;
                $nestedData['EMAIL'] =  $post->emailid;
                $nestedData['MOBILE'] =  $post->mobile;
                $nestedData['DOB'] =  $post->dob;
                $nestedData['COURSE'] =  $post->course_name;
                $nestedData['SESSION'] =  $post->start.'-'.$post->end;
                $nestedData['REMARKS'] =  @$post->remarks;
                $nestedData['SOURCE'] =  @$post->source;
                
                $nestedData['STATUS'] =  $status;
                  $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                          <li><a class="approve_enquiry"  id="'.$post->eid.'" approve_enquiry_id="'.$post->eid.'" " href="javascript:void(0);"><i class="fa fa-user"> APPROVE </i></a></li>
                            <li><a class="reject_enquiry"  id="'.$post->eid.'" enquiry_id="'.$post->eid.'" " href="javascript:void(0);"><i class="fa fa-user"> REJECT </i></a></li>
                            
                          </ul>
                        </div>                      
                    ';
                              
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }
/*----------------------- END STUDENT LIST --------------------------------------------------*/
    
    
    public function get_course()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $get = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."'")->row();
        		    $c = $this->db->query("SELECT * FROM courses where id = '".@$get->course_id."'")->row();
        		    $response =  @$c->course_name.'|'.@$c->id;
                    
                    
                    //$response = get_all_states();
                    
                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    // get course by enrollment
        
    public function get_course_by_enrollment()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    // die(var_dump($_POST['enrollment_no']));
                    $get = $this->db->query("SELECT * FROM students where enrollment_no = '".$_POST['enrollment_no']."'")->row();
                    // die(var_dump("SELECT * FROM students where id = '".$get->course_id."'"));
        		    $c = $this->db->query("SELECT * FROM courses where id = '".@$get->course_id."'")->row();
        		  //  die(var_dump($c));
        		    	$response = '';
        				$response.= '
    						        <option value="">SELECT COURSE</option>';
                              
                               $response.= '     <option value="'.$c->id.'">'.$c->course_name.'</option>';
                              
                              
                               $response.='	';
                               
        		    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }


    public function get_roll()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $get = $this->db->query("SELECT * FROM admit_card where enrollment_no = '".$_POST['enrollment_no']."'")->row();
		    
		    	$c = $this->db->query("SELECT * FROM courses where id = '".@$get->course_id."'")->row();
			
		        $response =  @$get->roll_no.'|'.@$c->id.'|'.@$c->course_name;
                    
                    
                    //$response = get_all_states();
                    
                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }

    
    public function get_subject()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    // die(var_dump("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' and year = '".$_POST['year']."'"));
                    $response = '';
                    $check = $this->db->select('roll_no')->where(['enrollment_no' => $_POST['enrol'],'year' => $_POST['year'],'course_id' => $_POST['course_id']] )->get('admit_card');
                    if($check->num_rows()){
                        $roll_no = $check->row()->roll_no;
                        $response = '<input type="hidden" name="roll_no" value="'.$roll_no.'">
                                <h1>Roll Number : - '.$roll_no.'</h1>'; 
                        if(empty($_POST['result_id'])){
                            
                            $get = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' and year = '".$_POST['year']."'")->result();
                            
                			foreach($get as $g){
                			        
                			        if( $g->practical ==2){
            					            $response.= '	  
            					                        <div class="form-group col-md-3">
                                							<label>'.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->max_marks.'] | [Min Marks: '.$g->min_marks.']</span>
                                							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'" value="'.@$marks->marks.'" required>
                                						</div>
                        					            <div class="form-group col-md-3">
                                							<label> '.$g->subject_name.'&nbsp; Theory </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
                                							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" value="'.@$marks->practical_marks.'" required>
                                						</div>';  
            						}elseif( $g->practical ==1){
            						    	$response.= '	<div class="form-group col-md-3">
                                    							<label>Practical '.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
                                    							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" value="'.@$marks->practical_marks.'" required>
                                        					</div>';
            						}elseif( $g->practical ==0){
            						   $response.= '
                        						<div class="form-group col-md-3">
                        							<label>'.$g->subject_name.'&nbsp; Theory</label><br> <span class="text-danger">[Max Marks: '.$g->max_marks.'] | [Min Marks: '.$g->min_marks.']</span>
                        							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'" value="'.@$marks->marks.'" required>
                        						</div>
                        				';
            						}
                			    
                			}
            			
                			$response.= '<div class="form-group col-md-3">
                				<label>Result</label>
                				<input type="text" class="form-control" name="result" placeholder="Enter Result">
                			</div>
                			<div class="form-group col-md-12">
                				<button class="btn btn-primary" type="submit" >Submit</button>
                			</div>
                			';
                        
                            
                        }else{
                        $get_result = $this->db->query("SELECT * FROM subjects where course_id = '".$_POST['course_id']."' and year = '".$_POST['year']."'")->result();
                        $result=$this->db->get_where('results',['id'=>$_POST['result_id']])->row();
                      
        			    foreach($get_result as $g){
        			     //   $subject_id=$g->
        			            $marks=$this->db->get_where('marks_table',['subject_id'=>@$g->id,'result_id'=>@$_POST['result_id']])->row();
                        
                        	    if( $g->practical ==2){
        					            $response.= '	  
        					                        <div class="form-group col-md-3">
                            							<label>'.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->max_marks.'] | [Min Marks: '.$g->min_marks.']</span>
                            							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'" value="'.@$marks->marks.'" required>
                            						</div>
                    					            <div class="form-group col-md-3">
                            							<label> '.$g->subject_name.'&nbsp; Theory </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
                            							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" value="'.@$marks->practical_marks.'" required>
                            						</div>';  
        						}elseif( $g->practical ==1){
        						    	$response.= '	<div class="form-group col-md-3">
                                							<label>Practical '.$g->subject_name.'&nbsp; </label><br> <span class="text-danger">[Max Marks: '.$g->practical_max_marks.'] | [Min Marks: '.$g->practical_min_marks.']</span>
                                							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'practical" value="'.@$marks->practical_marks.'" required>
                                    					</div>';
        						}elseif( $g->practical ==0){
        						   $response.= '
                    						<div class="form-group col-md-3">
                    							<label>'.$g->subject_name.'&nbsp; Theory</label><br> <span class="text-danger">[Max Marks: '.$g->max_marks.'] | [Min Marks: '.$g->min_marks.']</span>
                    							<input type="number" class="form-control" min="0" name="'.$_POST['course_id'].'_'.$g->id.'" placeholder="Enter Marks '.$g->subject_name.'" value="'.@$marks->marks.'" required>
                    						</div>
                    				';
        						}
        			    }
        			
        			    $response.= '   <div class="form-group col-md-3">
                        				<label>Result</label>
                        				<input type="text" class="form-control" name="result" value="'.@$result->result.'"placeholder="Enter Result">
                        			</div>
                        			<div class="form-group col-md-12">
                        				<button class="btn btn-primary" type="submit" name="status" value="create_result">Submit</button>
                        			</div>
                        			';
                        
                    }
                    }
                    else{
                        $response = '<div class="form-group"><div class="alert alert-danger">Sorry, This student doesn\'t have Admit Card.</div></div>'; 
                    }
                    
                    //$response = get_all_states();
                    
                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    // get course type
    
    public function get_course_type()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $response = '';
                    $get_type = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
                    
                    if($get_type->type==2){
                        $years=$get_type->years;
                    	$response.= '
        				                <option value=" ">SELECT YEAR</option>';
                                          for($i=1; $i<=$years;$i++){
                                              $year= getCourseType($i);//.$st;
                        $response.= '   <option value="'.$i.'">'.$year.'</option>';
                                          }
                    }
                    if($get_type->type==3){
                        $years=$get_type->duration;
        				$response.= '
        						                      <option value="">SELECT SEMESTER</option>';
					                      for($i=1; $i<=$years;$i++){
                                              $year= getCourseType($i,'semester');//.$st;
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
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    // get year
    
    public function get_year()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $response = '';
                    
                    $get_type = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
                    if($get_type->type==1){
                        $years=$get_type->duration;
        				$response.= '
        						<select class="col-sm-12 col-xs-12 get_subject year" result_id="<?php echo $this->uri->segment(3)?>" course_id="'.$_POST['course_id'].'"   name="year" required="required">
				                        <option value="">SELECT MONTHS</option>';
                                    $response.= '     <option value="">'.$years.'</option>';
                                    $response.='	</select>';
        			}
                    if($get_type->type==2){
                        $years=$get_type->years;
        				$response.= '
        						<select class="col-sm-12 col-xs-12 get_subject year" result_id="<?php echo $this->uri->segment(3)?>" course_id="'.$_POST['course_id'].'"  name="year" required="required">
				                        <option value="">SELECT YEAR</option>';
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
                                        
                               $response.= '     <option value="'.$i.'">'.$year.'</option>';
                                          }
		                	$response.='	</select>';
        			}

                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    
    
    public function get_year_by_course()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $class = isset($_POST['type']) ? $_POST['type'] : 'get_subject';
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $get_type = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
                    
                     $response = '	<select class="col-sm-12 col-xs-12 '.$class.' year" result_id="<?php echo $this->uri->segment(3)?>" course_id="'.$_POST['course_id'].'"   name="year" required="required">
				                        ';
                    
                    if($get_type->type==1){
                        $years=$get_type->duration;
        				$response.= '
        					              <option value="">SELECT MONTHS</option>';
                        $response.= '     <option value="">'.$years.'</option>';
        			}
        			if($get_type->type == 3){
        			    $sems = $get_type->duration;
        			    $response.= '
        						        <option value="">SELECT SEMESTER</option>';
				                        for($i=1; $i<=$sems;$i++){
				                            
				                             $check = $this->db->query("SELECT * FROM `results` WHERE `enrollment_no` LIKE '".$_POST['enroll_id']."' AND year='".$i."'  ")->num_rows();
                                            
                                                $year= getCourseType($i,'semester');//.$st;
                        $response.= '     <option value="'.$i.'"  '.( ($check > 0 ) ? ' disabled="disabled" ' : '').'>'.$year.'</option>';
				                        }
                        
                        // $response.='	</select>';
        			}
                    if($get_type->type==2){
                        $years=$get_type->years;
        				$response.= '
        						 <option value="">SELECT YEAR</option>';
                                          for($i=1; $i<=$years;$i++){
                                            
                                            $check = $this->db->query("SELECT * FROM `results` WHERE `enrollment_no` LIKE '".$_POST['enroll_id']."' AND year='".$i."'  ")->num_rows();
                                            
                                                $year= getCourseType($i);//.$st;
                                                
                                            $response.= '<option value="'.$i.'" '.( ($check > 0 ) ? ' disabled="disabled" ' : '').'>'.$year.' </option>';
                                                
                                        
                               
                                          }
        			}
		                	$response.='	</select>';

                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }
    
    
    
    
    // get year web
    
    public function get_year_web()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $response = '';
                    // if(empty($_POST['result_id'])){
                    $get_type = $this->db->query("SELECT * FROM courses where id = '".$_POST['course_id']."'")->row();
                    
                    
                    if($get_type->type == 3){
                        $sems = $get_type->duration;
                        
        				$response.= '
        				
        				<div class="form-group">
        				<label>Select Semester</label>
        						<select class="form-control "  course_id="'.$_POST['course_id'].'"  name="year">
				                        <option>SELECT SEMESTER</option>';
                            
                                       
                                          for($i=1; $i<=$sems;$i++){
                                              $year=getCourseType($i,'semester');//.$st;
                                        
                               $response.= '     <option value="'.$i.'">"'.$year.'"</option>';
                                     
                                          }
                                    
		                	$response.='	</select></div>';
        						  
                    }
                    
                    if($get_type->type==2){
                        // $get = $this->db->query("SELECT * FROM courses where course_id = '".$_POST['course_id']."'")->row();
                        $years=$get_type->years;
        // 			foreach($get as $g){
        			
        				$response.= '
        				
        				<div class="form-group">
        				<label>Select Year</label>
        						<select class="form-control "  course_id="'.$_POST['course_id'].'"  name="year">
				                        <option>SELECT YEAR</option>';
                            
                                       
                                          for($i=1; $i<=$years;$i++){
                                              $year=getCourseType($i);//.$st;
                                        
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
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }


/*------------------ START UPLOAD CERTIFICATE LIST -------------------------------*/
public function uploaded_certificate_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        $totalData = count_all_uploaded_certificate_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_uploaded_certificate_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  uploaded_certificate_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  uploaded_certificate_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                     $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->file.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->file.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['PHOTO'] = $image;
                $nestedData['ROLL_NO'] = $post->enrollment_no;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" delete_cerficate_list"  id="'.$post->id.'" certificate_id="'.$post->id.'" " href="javascript:void(0);"><i class="fa fa-user"> REMOVE </i></a></li>
                            
                          </ul>
                        </div>                      
                    ';               
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


/*---------------------- END UPLOAD CERTIFICATE LIST -------------------------------*/

    public function get_subject_list()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $response = $this->Authentication_model->auth();
                if ($response['status'] == 200) {
                    
                    $response = '';
                    $response.= '<table class="table table-bordered">
        				<thead>
        					<tr>
        						<th>#</th>
        						<th>SUBJECT NAME</th>
        						<th>SUBJECT CODE</th>
        						<th>SUBJECT Duration</th>
        						<th>THEORY MAX </th>
        						<th>THEORY MIN </th>
        						<th>PRACTICAL MAX </th>
        						<th>PRACTICAL MIN </th>
        						<th>Remove</th>
        					</tr>
        				</thead>
        				<tbody>';
        					$i=1;
        					$get = $this->db->query("SELECT *,subjects.id as subjectid,subjects.year as yearid FROM subjects LEFT JOIN courses ON courses.id=subjects.course_id where course_id = '".$_POST['course_id']."' ORDER BY subjects.year DESC")->result();
        					$flag = '';
        					foreach($get as $g){
        					    
        					    if($g->type==1){
                                    $year= $g->duration;
                                    $years = getDurationName($year,'month',true,true);
        					    }

                                if($g->type==2){
                                    
                                    $year=$g->yearid;  
                                    $years = getDurationName($year,'year',true,true);
                                }
                                
                                if($g->type==3){
                                    $year = $g->year;
                                    $years = getDurationName($year,'semester',true,true);
                                }
                                
                                
        					    
        					    if($g->practical == 0){
        					        $marks = '
        					                    <td>'.$g->max_marks.'</td>
        					                    <td>'.$g->min_marks.'</td>
        					                    <td></td>
        					                    <td></td>
        					                    ';
        					    }else if($g->practical == 1){
        					        $marks = '
        					                    <td></td>
        					                    <td></td>
        					                    <td>'.$g->practical_max_marks.'</td>
        					                    <td>'.$g->practical_min_marks.'</td>
        					                    ';
        					    }else{
        					        $marks = '
        					                    <td>'.$g->max_marks.'</td>
        					                    <td>'.$g->min_marks.'</td>
        					                    <td>'.$g->practical_max_marks.'</td>
        					                    <td>'.$g->practical_min_marks.'</td>
        					                    ';
        					    }
        					    $style = '';
        					    if($flag){
        					           if($flag != $year){
        					               $style = 'style="border-top:2px solid #d2d2d2;"';
        					               $flag = $year;
        					           }
        					    }
        					    else{
        					        $flag = $year;
        					    }
        						$response.= '
        								<tr '.$style.'>
        									<td>'.$i++.'</td>
        									<td>'.$g->subject_name.'</td>
        									<td>'.$g->SUBJECT_CODE.'</td>
        									<td>'.$years.'</td>
        									'.$marks.'
        									<td><a href="javascript:void(0);" class="btn btn-danger" onclick="delete_subjects('.$g->subjectid.')"><i class="fa fa-trash"></i></a></td>
        								</tr>
        						';
        					}
        				$response.= '</tbody>
        			</table>';
                    
                    //$response = get_all_states();
                    
                    json_output(200, $response);
                } else if ($response['status'] == 303) {
                    $this->Common_model->logout();
                    $this->session->sess_destroy();
                    json_output(401, $response);
                }
            }
        }
    }





    /*------------------ START UPLOAD CERTIFICATE LIST -------------------------------*/
public function uploaded_result_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        
        $totalData = count_all_uploaded_result_list();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_uploaded_result_list($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  uploaded_result_list_search($limit, $start, $search, $order, $dir);
            $totalFiltered =  uploaded_result_list_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                    
                     $image = '<div style="width:50px; height:50px;" class="project-wrapper">
                                                <div class="project">
                                                    <div class="photo-wrapper">
                                                        <div class="photo">
                                                            <a class="fancybox"  href="'.base_url('uploads/').$post->file.'" target="_blank"><img style="width:50px; height:50px;"class="img-responsive" src="'.base_url('uploads/').$post->file.'" alt=""></a>
                                                        </div>
                                                        <div class="overlay"></div>
                                                    </div>
                                                </div>
                                            </div>';
                    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['PHOTO'] = $image;
                $nestedData['ROLL_NO'] = $post->enrollment_no;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class=" delete_result_list"  id="'.$post->id.'" result_id="'.$post->id.'" " href="javascript:void(0);"><i class="fa fa-user"> REMOVE </i></a></li>
                            
                          </ul>
                        </div>                      
                    ';               
                   
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }


/*---------------------- END UPLOAD CERTIFICATE LIST -------------------------------*/
    

/*------------ start occupation list ----------------------------------------------------*/
public function occupation_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_occupation_type();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_occupation_type($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  occupation_type_search($limit, $start, $search, $order, $dir);
            $totalFiltered = occupation_type_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $nestedData['SR_NO'] = $i;
                $nestedData['BRAND_NAME'] = $post->BUSINESS_NAME;
                $nestedData['ACTION'] = '
                                        <div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                           <li><a  href="'.site_url('admin/Occupation/'.$post->BUSSINESS_ID.' ').'" ><i class="fa fa-pencil"></i>  Edit </a></li>
                                           <li><a  href="javascript:void(0);" class=" remove_occupation  Occupationid="'.$post->BUSSINESS_ID.'"  remove_Occupation_id="'.$post->BUSSINESS_ID.'"  "><i class="fa fa-remove"></i>  Remove </a></li>
                                          </ul>
                                        </div>
                                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*----------- end occupation list -----------------------------------------------------*/




/*------------ start occupation list ----------------------------------------------------*/
public function batch_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'BRAND_NAME',
            2 => 'BRAND_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $company_id = '1';
        $status = '1';
        $totalData = count_all_batch_type();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_batch_type($limit, $start, $order, $dir);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  batch_type_search($limit, $start, $search, $order, $dir);
            $totalFiltered = batch_type_search_count($search);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $nestedData['SR_NO'] = $i;
                $nestedData['BRAND_NAME'] = $post->BATCH_NAME;
                $nestedData['ACTION'] = '
                                        <div style="min-width:100px;" class="btn-group">
                                          <button type="button" class="btn btn-theme03">Action</button>
                                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                           <li><a  href="'.site_url('admin/batch_session/'.$post->BATCH_ID.' ').'" ><i class="fa fa-pencil"></i>  Edit </a></li>
                                           <li><a  href="javascript:void(0);" class=" remove_batch  batchid="'.$post->BATCH_ID.'"  remove_batch_id="'.$post->BATCH_ID.'"  "><i class="fa fa-remove"></i>  Remove </a></li>
                                          </ul>
                                        </div>
                                    ';
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }



/*----------- end occupation list -----------------------------------------------------*/


    public function director_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = $_POST['status'];
        $totalData = count_all_chairman($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_chairman($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  chairman_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered =  chairman_search_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                $nestedData['SR_NO'] = $post->CHAIRMAN_NAME;
                $nestedData['FB_PER_NAME'] = $post->CHAIRMAN_EMAIL;
                $nestedData['FB_COMMENT'] = $post->CHAIRMAN_CONTACT;
                $nestedData['STATUS'] = $post->CHAIRMAN_TITLE;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class="remove_chairman" id="'.$post->CHAIRMAN_ID.'" chairmanid="'.$post->CHAIRMAN_ID.'"  href="javascript:void(0);"><i class="fa fa-upload"> Remove </i></a></li>
                          </ul>
                        </div>                      
                    ';    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }





/*-------------- start state office -------------------------------------------------------*/
    public function state_office_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $status = $_POST['status'];
        $totalData = count_all_state_office($status);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_state_office($limit, $start, $order, $dir,$status);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  state_office_search($limit, $start, $search, $order, $dir,$status);
            $totalFiltered =  state_office_search_count($search,$status);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                
                $nestedData['SR_NO'] = $i;
                $nestedData['FB_PER_NAME'] = $post->SO_NAME;
                $nestedData['FB_COMMENT'] = $post->SO_MOBILE;
               $nestedData['STATUS'] = $post->SO_EMAIL;
                $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a class="remove_state_office" id="'.$post->SO_ID.'" state_office_id="'.$post->SO_ID.'"  href="javascript:void(0);"><i class="fa fa-upload"> Remove </i></a></li>
                          </ul>
                        </div>                      
                    ';    
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }




/*----------------- end state office ----------------------------------------------------*/





    public function print_result_list()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        if($_SESSION['type'] == 1){
            $center = 'all';
        }else{
                
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
        }
        $totalData = count_all_result($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_result($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  all_result_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  all_result_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            foreach ($posts as $post) {
                $year=date('Y',strtotime(@$post->timestamp));
                
                if($post->COURSE_TYPE==2){ 
                    $duration = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->PASSING_YEAR.' Year </span>';
                    $course_timing = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->YEAR_DURATION.' Year </span>';
                    
                }
                elseif($post->COURSE_TYPE==3){ 
                    $duration = '<span class="label label-success arrowed-in arrowed-in-right  col-md-10" style="padding: 5px;">'.numberToRomanRepresentation($post->PASSING_YEAR).'-Semester </span>';
                    $course_timing = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->MONTH_DURATION.' Semesters </span>';
                }else{
                    $duration = '<span class="label label-success arrowed-in arrowed-in-right  col-md-10" style="padding: 5px;">'.$post->MONTH_DURATION.'-Months </span>';
                    $course_timing = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->MONTH_DURATION.' Months </span>';
                    
                }
                
                
                $course_code = '<span class="label label-success arrowed-in arrowed-in-right col-md-10" style="padding: 5px;">'.$post->COURSE_CODE.'  </span>'; 
                $enrollment = '<span class="label label-success arrowed-in arrowed-in-right  col-md-10" style="padding: 10px;">'.$post->ENROLLMENT_NO.' </span>';
                
                $nestedData['SR_NO'] = $i;
                $nestedData['STUDENT'] = $post->STUDENT_NAME.$enrollment.$duration;
                $nestedData['ROLL_NO'] = $post->ROLL_NO;
                $nestedData['COURSE'] = $post->COURSE_NAME.$course_code.$course_timing;
                $nestedData['YEAR'] = @$post->BATCH_NAME;
                $nestedData['SESSION'] = $post->CENTER_NUMBER;
                $nestedData['SUBJECT'] = $post->CENTER_NAME;
                
                $nestedData['ACTION'] = '<div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <!--
                            <li><a class=""   href="'.base_url('admin/create_result/').$post->RESULT_ID.'"><i class="fa fa-upload"> Update</i></a></li>
                            <li class="divider"></li>
                             
                                  <li><a class="delete_result" delete_result_id="'.$post->RESULT_ID.'"   href="javascript:void(0);"><i class="fa fa-edit"> Delete</i></a></li>
                             <li class="divider"></li>
                            ----> 
                             
                                  <li><a class=""   href="'.base_url('marksheet/view/').AJ_ENCODE($post->RESULT_ID).'" target="_blank" ><i class="fa fa-print"> PRINT </i></a></li>
                          </ul>
                        </div>';     
                $i++;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }





    public function print_student_certificate()
    {
        $columns = array(
            0 => 'SR_NO',
            1 => 'MEASUREMENT_NAME',
            2 => 'MEASUREMENT_NAME',
            3 => 'MEASUREMENT_NAME',
            4 => 'MEASUREMENT_NAME',
            5 => 'MEASUREMENT_NAME',
            6 => 'MEASUREMENT_NAME',
            7 => 'MEASUREMENT_NAME',
            8 => 'MEASUREMENT_NAME',
            9 => 'MEASUREMENT_NAME',
            10 => 'MEASUREMENT_NAME',
            11 => 'MEASUREMENT_NAME',
            12 => 'MEASUREMENT_NAME',
            13 => 'MEASUREMENT_NAME',
            14 => 'MEASUREMENT_NAME',
            15 => 'MEASUREMENT_NAME',
            16 => 'MEASUREMENT_NAME',
            17 => 'MEASUREMENT_NAME',
        );
        if($_SESSION['type'] == 1){
            // die('here');
            $center = 'all';
            $type=$_SESSION['type'];
        }else{
             $type=$_SESSION['type'];   
            $center = $this->db->query("SELECT * FROM `centers` WHERE `id` = '".$_SESSION['loginid']."' ")->row('id');
        }
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        // $status=$_POST['status'];  
        // die(var_dump($center));
        $totalData = count_all_generate_certificate_list($center);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = all_generate_certificate_list($limit, $start, $order, $dir,$center);
        } else {
            $search = $this->input->post('search')['value'];
            $posts =  generate_certificate_list_search($limit, $start, $search, $order, $dir,$center);
            $totalFiltered =  generate_certificate_list_search_count($search,$center);
        }
        $data = array();
        if (!empty($posts)) {
            $i = $start + 1;
            $max_marks='';
            $obt_marks='';
            
            foreach ($posts as $post) {
                  
                  
                  if($post->status==0){
                      $status='<b class"text-info">PENDING</b>';
                  }elseif($post->status==1){
                      $status='<b class="text-success">CREATED </b>';
                  }else{
                      $status='<b class="text-danger">CANCEL</b>';
                  }  
                  if($post->ctype==1){
                    //   $duration=getDurationName$post->duration.'months';
                        $duration = getDurationName($post->duration,$post->ctype,true,true);
                  }else{
                        $duration = getDurationName($post->year,$post->ctype,true,true);
                  }
                  
                  
                  
                
            
        
                
    
    
    
                $nestedData['SR_NO'] = $i;
                $nestedData['DATE'] = date('Y-m-d',strtotime($post->timestamp));
                $nestedData['NAME'] =  $post->name;
                $nestedData['ENROLLMENT'] =  $post->enrollment_no;
                $nestedData['COURSE'] =  $post->course_name;
                $nestedData['DURATION'] =  $duration;
                $nestedData['YEAR'] =  $post->year;
                $nestedData['PERCENTAGE'] =  @$post->percentage;
                $nestedData['RESULT'] =  @$post->result;
                
                $nestedData['STATUS'] =  @$status;
                /*
                if($post->status==0){
                */
                    if($_SESSION['type'] == 1){
                        $nestedData['ACTION'] = '
                            <div style="min-width:100px;" class="btn-group">
                              <button type="button" class="btn btn-theme03">Action</button>
                              <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                              
                              <li><a class="" href="'.base_url('certificate/view_certificate/').AJ_ENCODE($post->student_id).'" target="_blank"><i class="fa fa-print"> PRINT </i></a></li>
                               
                                
                              </ul>
                            </div>                      
                        ';
                    }else{
                        $nestedData['ACTION'] = '
                                                  
                        ';
                    }
                    
                    
                /*
                    
                }else{
                   $nestedData['ACTION'] = '
                        <div style="min-width:100px;" class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                          <li><a class=""    href="'.base_url('printbill/print_certificate/').$post->student_id.'" target="_blank"><i class="fa fa-edit"> VIEW CERTIFICATE</i></a></li>
                          <li><a class="delete_certificate"  enroll_no="'.$post->enrollment_no.'"    href="javascript:void(0)"><i class="fa fa-edit"> DEELTE CERTIFICATE</i></a></li>
                           
                            
                          </ul>
                        </div>                      
                    '; 
                }
                */
                
                
                              
               $students =   $this->db->query("SELECT * FROM `students` LEFT JOIN courses ON courses.id=students.course_id WHERE students.enrollment_no LIKE '".$post->enrollment_no."' ")->row();
            $studentYear = $students->type == 3 ? $students->duration : $students->years;
                if($post->year == $studentYear){
                $i++;
                $data[] = $nestedData;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    
    
    
    
/*----------------- start password reset ------------------------------------------*/
public function password_reset_req()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method != 'POST') {
            json_output(400, array('status' => 400, 'message' => 'Bad request.'));
        } else {
            $check_auth_client = $this->Authentication_model->check_auth_client();
            if ($check_auth_client == true) {
                $params = $_REQUEST;
            
                $username = $_POST['user_email'];
                
                
                  $six_digit_random_number = random_int(100000, 999999);
                    // $centerid = time();
                
                 $num = $this->db->query("SELECT * FROM `centers` WHERE `email_id` LIKE '".$_POST['user_email']."'")->num_rows();
                if($num > 0){
                    $row = $this->db->query("SELECT * FROM `centers` WHERE `email_id` LIKE '".$_POST['user_email']."'")->row();
                    
                    
                    
                    $this->db->where('id',$row->id);
                    $this->db->update('centers',['password'=>md5($six_digit_random_number),'center_password' => $six_digit_random_number]);
                    
                    
                    /*---------- start send email ---------------------*/
               	    $from = 'info@vhtecindia.com';
                    $to = $_POST['user_email'];
                    $username = $row->username;
                    $password = $six_digit_random_number;
                    $name = 'Pankaj';
                    $get = $this->send_email($to,null,'Your New Password',"<b>$password</b>");
       
               	/*------------- end send email ----------------------*/
                    $response['message'] = 'password Send In Mail';
                    $response['email'] = $get ? 'yes' : 'no';
                    
                }else{
                    $response['message'] = 'User not found..';
                }
                
                            
                $response['status'] = '200';
                
                
                json_output($response['status'], $response);
                if ($response['message'] == "ok") {
                       // insert_activity_history(1,0);
                    }
            }
        }
    }
    
    function test(){
        if($this->send_email('ajaykumararya963983@gmail.com','System Admin','Your Password','admin')){
            echo 'Yes';
        }
        else
            echo 'no';
    }
    
    function send_email($to_email,$name = null,$subject,$message){
        $this->load->library('email');
        $this->load->config('email');
        $config = array(
                        'mailtype'  => 'html', 
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE);
      
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $name = $name == null ? $this->config->item('system_name') : $name;
        
        $name = $name ? $name : '';
        
        $this->email->from($this->config->item('system_email'), $name);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send() ? true : false;
    }



    
    
    
    
    public function send_email3($from,$to,$username,$password,$name){
	    
	    /*----------- send email start ----------------------------*/
	   	//if(!empty($_POST["cus_email"])) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		  $BUSINESS_INFO =   get_all_profile();
		
			
    		 $laodfile = 	''.$_SERVER['DOCUMENT_ROOT'].'/phpmailer/class.phpmailer.php';
    		 require_once ($laodfile);
    		    
    		$mail = new PHPMailer(true);
    
    		$mail->isSMTP();// Set mailer to use SMTP
    		$mail->CharSet = "utf-8";// set charset to utf8
    		$mail->SMTPAuth = true;// Enable SMTP authentication
    		$mail->SMTPSecure = 'tls';// Enable TLS encryption, `ssl` also accepted
    
    		$mail->Host = 'vhtecindia.com';// Specify main and backup SMTP servers
    		$mail->Port = 587;// TCP port to connect to
    		$mail->SMTPOptions = array(
    		    'ssl' => array(
    		        'verify_peer' => false,
    		        'verify_peer_name' => false,
    		        'allow_self_signed' => true
    		    )
		    );
		$mail->isHTML(true);// Set email format to HTML

		$mail->Username = 'info@vhtecindia.com';// S(zV,$PQFfQY8MTP username
		$mail->Password = '@qEH,O).@&e3';// SMTP password
	  
		   
		        $userEmail = 'info@vhtecindia.com';
		        $toEmail = $from;
		        $userName = $name;
		 
		        $subject = 'Credential For '.$BUSINESS_INFO[0]->ORG_NAME.'';
		        
//$message = 'DEAR CUSTOMER YOUR CONGRATULATION YOUR LOGIN DETAIL IS ';


         $PROFILE =    get_site_setting();

    //print_r($PROFILE);

            $message = '
           
            
   <div bgcolor="#F0F1F3" marginwidth="0" marginheight="0">
        <center style="background-color:#f0f1f3">
            <table>
                <tr>
                    <td>
                    <img src="'.base_url('uploads/'.$PROFILE[0]->SS_HEADER_LOGO.'').'">
                    </td>
                    <td>
                        <table> 
                            <tbody style="font-size:15px"> 
                                <tr>   
                                    <td>  User Name  :   </td>  
                                    <td>  <b>   '.$username.'  </b>  </td>   
                                </tr>
                                <tr>   
                                    <td>  Name :   </td>  
                                    <td>   <b>  '.$name.'   </b> </td>   
                                </tr>  
                                <tr>   
                                    <td>   Password   :   </td>  
                                    <td>  <b>    '.$password.'  </b> </td>   
                            </tr>  
                          </tbody>   
                        </table>
                    </td>
                </tr>
            </table>    
        </center>
</div>
            ';


            
            
            //echo $to;
            
            $userEmail = 'info@vhtecindia.com';
		    $mail->SetFrom("info@vhtecindia.com", $userEmail);
		    $mail->AddReplyTo($userEmail, $userName);
		    $mail->AddAddress($to); // set recipient email address
		    //$mail->AddAddress('support@onlineplanetpro.com');
		    //$mail->AddAddress('pankajkumar01.330@gmail.com');
		    $mail->Subject = $subject;
		    $mail->WordWrap = 80;
		    $mail->MsgHTML($message);
		    $mail->SMTPDebug = 1;
		 	
		    if (! $mail->Send()) {
		        
		        $this->session->set_flashdata("email_sent","Email sent successfully.");
		    } else {
		        
		        $this->session->set_flashdata("email_sent","Email sent successfully.");
		    }


	    
	    
	    
	    /*------------ end email ----------------------------------*/
	    
	}




/*--------------------- end password reset---------------------------------------------*/
    
    
    
    
    


    

}

?>