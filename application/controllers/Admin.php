<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper('dashboard_helper');
   		$this->load->helper('download');
   		 $this->load->library('email');
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		
		if($this->input->post('udf1',true)){
		    $id = $this->input->post('udf1');
		  
		    $this->session->set_userdata('loginid',$id);
            $this->session->set_userdata('type','2'); /* for admin login */
             $this->session->set_userdata('is_active','1');
            $this->session->set_userdata('comp_id',$id);
            $this->session->set_userdata('firm_id',get_firms_by_company($id));
		}
		
		if ($this->session->userdata('loginid') == '') {
			if (base_url() . 'admin' != $actual_link) {
				redirect('admin');
			}
		}
        setlocale(LC_MONETARY, 'en_IN');
        
		// Your own constructor code
	}
	function test(){
// 	  $test = AJ_ENCODE(1);
// 	  echo AJ_DECODE($test);
        $this->session->set_userdata('coding',1);
	}
	
	function list_all_transaction(){
	    $data = array();
    		$data['title'] = 'List All Transactions  |';
    		$data['linkactive'] = 'wallet';
    		//$data['allfirm'] = get_firms_by_id();
    		$this->load->view('header', $data);
            
    		$this->load->view('pages/'.__FUNCTION__);
    		//$this->load->view('modal');
    		$this->load->view('footer');
	}
	function list_other_students(){
	    $data = array();
    		$data['title'] = 'List All Other  Student(s)  |';
    		$data['linkactive'] = '';
    		//$data['allfirm'] = get_firms_by_id();
    		$this->load->view('header', $data);
            
    		$this->load->view('pages/'.__FUNCTION__);
    		//$this->load->view('modal');
    		$this->load->view('footer');
	}
	function wallet_payment_status(){
	    if($post = $this->input->post()){
	        if($post['status'] == 'success'){
	            $id = $post['udf1'];
	            
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
                    'type' => strpos($amount,'-') ? 'debit' : 'credit',
                    'response' => json_encode($post),
                    'via' => 'self'
                    ];
                    
                $this->center_model->add_transaction($trans);
                
                $this->center_model->update_wallet($id,$ttl);
                
               $this->session->set_flashdata('msg','<div class="alert alert-success">Wallet Load Successfully..');
	        }
	        else
	            $this->session->set_flashdata('msg','<div class="alert alert-danger">Transaction faild. Try Again..');
	        
	        
            redirect('Admin/Dashboard');
	    }
	   // echo '<pre>';
	   // print_r($_POST);
	   // print_r($_SESSION);
	}
	
	public function index()
	{
		$data = array();
		$data['title'] = 'LOGIN |ADMIN ';
		$this->load->view('login', $data);
	}

	/*
	 * Function to download files
	 *
	 * @param string $filename
	 * @return file
	 */
	 
	function payment_setting(){
	    
	    if($post = $this->input->post()){
	        foreach($post as $index => $value){
	            $this->db->update('few_setting',['value' => $value],['type' => $index]);
	        }
	        $this->session->set_flashdata('msg','<div class="alert alert-success">Setting Update Successfully...</div>');
	        redirect(base_url('admin/payment_setting'));
	    }
	    else{
    	    $data = array();
    		$data['title'] = 'Payment Setting  |';
    		$data['linkactive'] = 'payment_setting';
    		//$data['allfirm'] = get_firms_by_id();
    		$this->load->view('header', $data);
            
    		$this->load->view('pages/'.__FUNCTION__);
    		//$this->load->view('modal');
    		$this->load->view('footer');
	    }
	}
	public function download($fileName = NULL) {   

	   // die(var_dump($fileName));
	   
	   try { 

	   	if ($fileName) {
	    $file = realpath ('uploads'). "/" . $fileName;
	    // check file exists    
	    // die(var_dump($file,file_exists ( $file )));
	    if (file_exists ( $file )) {
	     // get file content
	     $data = file_get_contents ( $file );
	     //force download
	     //
	     
	     $productid =  $this->db->get_where('product',['IMG_1'=>$fileName])->row('PRODUCT_ID');
	    
	        $data2 = array(
	                    'PRODUCT_ID' => $productid,
	                    'USER_ID' => $_SESSION['userid'],
	                    'DOWNLOAD_DATE' => date('Y-m-d'),
	                );
	   
	    
	    $this->db->insert('product_download_history',$data2);
	   $last_id = $this->db->insert_id();
	   if($last_id!=0){
	       force_download ( $fileName, $data );
	   }    
	     
	    } else {
	     // Redirect to base url
	     // redirect ( base_url () );
	    }
	   }

	   } catch(Exception $e) {
	   	 die($e->getMessage());
	   }
	}
    
	public function dashboard()
	{
        
		$data = array();
		$data['title'] = 'Dashboard  |';
		$data['linkactive'] = 'dashboard';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
        
		$this->load->view('pages/dashboard');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function all_results()
	{
        
		$data = array();
		$data['title'] = 'Results  |';
		$data['linkactive'] = 'all_results';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
        
		$this->load->view('pages/all_results');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function download_result()
	{
        
		$data = array();
		$data['title'] = 'Download Result  |';
		$data['linkactive'] = 'download_result';
		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('header', $data);
        
		$this->load->view('pages/download_result');
// 		$this->load->view('modal');
// 		$this->load->view('footer');
	}
		public function download_certificate()
	{
        
		$data = array();
		$data['title'] = 'Download Certificate  |';
		$data['linkactive'] = 'download_certificate';
		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('header', $data);
        
		$this->load->view('pages/download_certificate');
// 		$this->load->view('modal');
// 		$this->load->view('footer');
	}
		public function enquiry_form()
	{
        
		$data = array();
		$data['title'] = 'Enquiry Form  |';
		$data['linkactive'] = 'enquiry_form';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
        
		$this->load->view('pages/enquiery_form');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function generate_certificate()
	{
        
		$data = array();
		$data['title'] = 'Generate Cirtificate  |';
		$data['linkactive'] = 'generate_certificate';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
        
		$this->load->view('pages/generate_certificate');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function download_id_card()
	{
        
		$data = array();
		$data['title'] = 'Download Id Card   |';
		$data['linkactive'] = 'download_id_card';
		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('header', $data);
        
		$this->load->view('pages/download_id_card');
		//$this->load->view('modal');
// 		$this->load->view('footer');
	}
	
	public function add_center()
	{
        
		$data = array();
		$data['title'] = 'Add Center  |';
		$data['linkactive'] = 'add_center';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
        
		$this->load->view('pages/add_center');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function homepage()
	{
		$data = array();
		$data['title'] = 'WELCOME MESSAGE  ';
		$data['linkactive'] = 'homepage';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/homepage');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function pending_admission()
	{
		$data = array();
		$data['title'] = 'PENDING STUDENT  ';
		$data['linkactive'] = 'homepage';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/pending_student');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function approve_admission()
	{
		$data = array();
		$data['title'] = 'APPROVE STUDENT  ';
		$data['linkactive'] = 'homepage';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/approve_admission');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function cancel_admission()
	{
		$data = array();
		$data['title'] = 'CANCEL STUDENT  ';
		$data['linkactive'] = 'homepage';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/cancel_admission');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function create_exam_schedule()
	{
		$data = array();
		$data['title'] = 'CREATE EXAM SCHEDULE  ';
		$data['linkactive'] = 'create_exam_schedule';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/create_exam_schedule');
		//$this->load->view('modal');
		$this->load->view('footer');
	}

	public function whyus()
	{
		$data = array();
		//$data['title'] = 'WHY US ';
		$data['title'] = get_title_name($this->uri->segment(2))->BACK_END_TITLE;
		$data['linkactive'] = $this->uri->segment(2);
		//$data['linkactive'] = get_title_name('whyus')->BACK_END_TITLE;
		// $data['whyus'] = homepage_second_blog();
		$this->load->view('header', $data);
		$this->load->view('pages/whyus');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function profile()
	{
		$data = array();
		$data['title'] = 'PROFILE ';
		$data['linkactive'] = 'profile';
		$data['profile'] =  get_all_profile();
		$this->load->view('header', $data);
		$this->load->view('pages/profile');
		//$this->load->view('modal');
		$this->load->view('footer');
	}

	
	public function request()
	{
		$data = array();
		$data['title'] = 'REQUEST ';
		$data['linkactive'] = 'request';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/request');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function member(){
		$data = array();
		$data['title'] = 'MEMBER REGISTRATION ';
		$data['linkactive'] = 'member';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/member');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function blog(){
		if ($this->uri->segment(3)!= '') 
		{
				$data = array();
				if ($this->uri->segment(3) =='1') {
					$data['title'] = 'BLOG  ';
					$data['linkactive'] = 'blog';
				}
				if ($this->uri->segment(3) =='2') {
					$data['title'] = 'EVENTS  ';
					$data['linkactive'] = 'events';
				}
				if ($this->uri->segment(3) =='3') {
					$data['title'] = 'GALLERY  ';
					$data['linkactive'] = 'gallery';
				}
				if ($this->uri->segment(3) =='4') {
					$data['title'] = 'EXAMINATION  ';
					$data['linkactive'] = 'examination';
				}if ($this->uri->segment(3) =='5') {
					$data['title'] = 'advertisment  ';
					$data['linkactive'] = 'advertisment';
				}
				if ($this->uri->segment(3) =='6') {
					$data['title'] = 'STUDENT CORNER';
					$data['linkactive'] = 'student_corner';
				}

				
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/blog');
				$this->load->view('modal');
				$this->load->view('footer');
		}else{
			redirect('admin/dashboard');
		}	
		
	
	}

	
	public function blog_list(){
				$data = array();
				$data['title'] = 'BLOG  ';
				$data['linkactive'] = 'blog';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/blog_list');
				//$this->load->view('modal');
				$this->load->view('footer');
	}
  	public function examination_list(){
				$data = array();
				$data['title'] = get_title_name($this->uri->segment(2))->BACK_END_TITLE;
				//$data['title'] = 'EXAMINATION LIST  ';
				$data['linkactive'] = 'examination_list';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/examination_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}
  	public function add_list(){
				$data = array();
				$data['title'] = 'ADVERTISMENT LIST  ';
				$data['linkactive'] = 'add_list';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/add_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}
  	public function student_corner_list(){
				$data = array();
			    $data['title'] = get_title_name($this->uri->segment(2))->BACK_END_TITLE;
				//$data['title'] = 'STUDENT CORNER LIST  ';
				$data['linkactive'] = 'student_corner_list';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/student_corner_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}

	public function feedback()
	{
		$data = array();
		$data['title'] = 'FEEDBACK ';
		$data['linkactive'] = 'feedback';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/feedback');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function flash_image_list()
	{
		$data = array();
		$data['title'] = 'FLASH IMAGE LIST ';
		$data['linkactive'] = 'flash_image_list';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/flash_image_list');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function site_setting()
	{
		$data = array();
		$data['title'] = 'SITE SETTING ';
		$data['linkactive'] = 'site_setting';
		$data['social_link'] = get_all_social_links();
		$data['site'] = get_site_setting();
		$this->load->view('header', $data);
		$this->load->view('pages/site_setting');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function color_setting()
	{
		$data = array();
		$data['title'] = 'COLOR SETTING ';
		$data['linkactive'] = 'color_setting';
		//$data['social_link'] = get_all_social_links();
		//$data['site'] = get_site_setting();
		$this->load->view('header', $data);
		$this->load->view('pages/color_setting');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function vision()
	{
		$data = array();
		$data['title'] = 'VISSION & MISSION ';
		$data['linkactive'] = 'vision';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/vision');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function fquestion()
	{
		$data = array();
		$data['title'] = 'FREQUENTLY ASK  QUESTION ';
		$data['linkactive'] = 'fquestion';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/fquestion');
		$this->load->view('modal');
		$this->load->view('footer');
	}

	public function event_list(){
				$data = array();
				$data['title'] = 'EVENTS LIST  ';
				$data['linkactive'] = 'event_list';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/event_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	public function gallery_list(){
				$data = array();
				$data['linkactive'] = 'gallery_list';
				$data['title'] = 'GALLERY LIST  ';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/gallery_list');
				//$this->load->view('modal');
				$this->load->view('footer');
	}
	public function contact_form_list(){
				$data = array();
				$data['title'] = get_title_name($this->uri->segment(2))->BACK_END_TITLE;
				//$data['title'] = 'ENQUIRY LIST  ';
				$data['linkactive'] = 'enquiry_list';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/enquiry_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	public function our_causes(){
				$data = array();
				$data['title'] = 'OUR CAUSES  ';
				$data['linkactive'] = 'our_causes';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/our_causes');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	public function our_services(){

				$data = array();

				$data['title'] = 'OUR SERVICES  ';

				$data['linkactive'] = 'our_services';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/our_services');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function slider_details(){

				$data = array();

				$data['title'] = 'SLIDER DETAILS  ';

				$data['linkactive'] = 'slider_details';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/slider_details');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function slider_list(){

				$data = array();

				$data['title'] = 'SLIDER LIST  ';

				$data['linkactive'] = 'slider_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/slider_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function agent_form(){
				$data = array();
				$data['title'] = 'AGENT FORM  ';
				$data['linkactive'] = 'agent_form';
				$this->load->view('header', $data);
				$this->load->view('pages/agent_form');
				$this->load->view('modal');
				$this->load->view('footer');
		}
		public function update_agent_form(){
				$data = array();
				$data['title'] = 'UPDATE AGENT FORM  ';
				$data['linkactive'] = 'agent_form';
				$this->load->view('header', $data);
				$this->load->view('pages/update_agent_form');
				$this->load->view('modal');
				$this->load->view('footer');
		}

		public function form_fields(){

				$data = array();

				$data['title'] = 'FORM FIELDS';

				$data['linkactive'] = 'form_fields';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/form_fields');

				// $this->load->view('modal');

				$this->load->view('footer');

	}
		public function agent_data_list(){

				$data = array();

				$data['title'] = 'FORM DATA';

				$data['linkactive'] = 'agent_data_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/agent_data_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function add_agent(){

				$data = array();

        $data['title'] = 'ADD AGENT';
				$data['linkactive'] = 'add_agent';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/add_agent');

				// $this->load->view('modal');

				$this->load->view('footer');

	}
	public function my_wallet()
	{
			$data = array();
				$data['title'] = 'ADD WALLET AMOUNT';
				$data['linkactive'] = 'my_wallet';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/my_wallet');
				$this->load->view('modal');
				$this->load->view('footer');



	}
		public function my_wallet_amount()
	{
			$data = array();
				$data['title'] = 'WALLET AMOUNT';
				$data['linkactive'] = 'my_wallet_amount';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/my_wallet_amount');
				$this->load->view('modal');
				$this->load->view('footer');



	}
	public function agent_form_list(){

				$data = array();

				$data['title'] = ' FORM LIST ';

				$data['linkactive'] = 'agent_form_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/agent_form_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	// public function upload_document(){

	// 			$data = array();

	// 			$data['title'] = ' UPLOAD DOCUMENT ';

	// 			$data['linkactive'] = 'upload_document';

	// 			//$data['allfirm'] = get_firms_by_id();

	// 			$this->load->view('header', $data);

	// 			$this->load->view('pages/upload_document');

	// 			$this->load->view('modal');

	// 			$this->load->view('footer');

	// }
		public function agent_list(){

				$data = array();

				$data['title'] = ' AGENT LIST ';

				$data['linkactive'] = 'agent_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/agent_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function add_plan(){

				$data = array();

				$data['title'] = ' ADD PLAN ';

				$data['linkactive'] = 'add_plan';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/add_plan');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function plan_list(){

				$data = array();

				$data['title'] = ' PLAN LIST ';

				$data['linkactive'] = 'plan_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/plan_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function wallet_request(){

				$data = array();

				$data['title'] = ' WALLET REQUEST ';

				$data['linkactive'] = 'wallet_request';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/wallet_amount');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function agent_wallet_request(){

				$data = array();

				$data['title'] = 'AGENT WALLET REQUEST ';

				$data['linkactive'] = 'agent_wallet_request';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/agent_wallet_request');

				$this->load->view('modal');

				$this->load->view('footer');

	}

	public function preview($id) {

		if(!is_numeric($id)) {
			redirect ( base_url('admin/agent_form_list') );
		}
		$data = array();

		$data['title'] = 'AGENT WALLET REQUEST ';


		$temp = get_form_data($id);

		if(!empty($temp) && $temp) {
			$data['data'] = $temp;
		} else {
			redirect ( base_url('admin/agent_form_list') );
		}

		$this->load->view('pages/preview_form',$data);
	}
	  public function add_account(){

				$data = array();

				$data['title'] = 'ADD ACCOUNT';

				$data['linkactive'] = 'add_account';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/add_account');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	  public function bank_detail(){

				$data = array();

				$data['title'] = 'BANK DETAIL';

				$data['linkactive'] = 'bank_detail';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/bank_detail');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function download_form(){

				$data = array();

				$data['title'] = 'DOWNLOAD FORM';

				$data['linkactive'] = 'download_form';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/download_form');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function download_document(){

				$data = array();

				$data['title'] = 'DOWNLOAD DOCUMENT';

				$data['linkactive'] = 'download_document';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/download_document');

				$this->load->view('modal');

				$this->load->view('footer');

	}
			public function add_vedio(){

				$data = array();

				$data['title'] = 'ADD VEDIO';

				$data['linkactive'] = 'add_vedio';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/add_vedio');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function add_pdf(){

				$data = array();

				$data['title'] = 'ADD pdf';

				$data['linkactive'] = 'add_pdf';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/add_pdf');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function training_center(){

				$data = array();

				$data['title'] = 'DOCUMENTS';

				$data['linkactive'] = 'training_center';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/training_center');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function links(){

				$data = array();

				$data['title'] = 'IMPORTANT LINKS';

				$data['linkactive'] = 'link';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/link');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function documents(){

				$data = array();

				$data['title'] = 'documents';

				$data['linkactive'] = 'documents';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/documents');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function account_statement(){

				$data = array();

				$data['title'] = 'ACCOUNT STATEMENT';

				$data['linkactive'] = 'account_statement';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/account_statement');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function add_department(){
				$data = array();
				$data['title'] = 'ADD DEPARTMENT';
				$data['linkactive'] = 'add_department';
				$this->load->view('header', $data);
				$this->load->view('pages/add_department');
				$this->load->view('modal');
				$this->load->view('footer');
	}
  public function list_department(){
				$data = array();
				$data['title'] = 'LIST DEPARTMENT';
				$data['linkactive'] = 'list_department';
				$this->load->view('header', $data);
				$this->load->view('pages/list_department');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	 public function add_user(){
				$data = array();
				$data['title'] = 'ADD USER';
				$data['linkactive'] = 'add_user';
				$this->load->view('header', $data);
				$this->load->view('pages/add_user');
				$this->load->view('modal');
				$this->load->view('footer');
	}
  public function listuser(){
				$data = array();
				$data['title'] = 'LIST USER';
				$data['linkactive'] = 'listuser';
				$this->load->view('header', $data);
				$this->load->view('pages/llist_users');
				$this->load->view('modal');
				$this->load->view('footer');
	}
   public function user_data_list(){
				$data = array();
				$data['title'] = 'DEPARMENT FORM DATA';
				$data['linkactive'] = 'user_data_list';
				$this->load->view('header', $data);
				$this->load->view('pages/user_form_data');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	   public function service_list(){
				$data = array();
				$data['title'] = 'SERVICE LIST';
				$data['linkactive'] = 'service_list';
				$this->load->view('header', $data);
				$this->load->view('pages/service_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	public function list_service(){

				$data = array();

				$data['title'] = 'OUR SERVICES  ';

				$data['linkactive'] = 'list_service';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/list_service');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    	   public function service_list_user(){
				$data = array();
				$data['title'] = 'SERVICE LIST';
				$data['linkactive'] = 'service_list_user';
				$this->load->view('header', $data);
				$this->load->view('pages/service_list_user');
				$this->load->view('modal');
				$this->load->view('footer');
	}

    public function apply_list(){
				$data = array();
				$data['title'] = 'APPLY LIST';
				$data['linkactive'] = 'apply_list';
				$this->load->view('header', $data);
				$this->load->view('pages/apply');
				$this->load->view('modal');
				$this->load->view('footer');
	}
   public function complete_list(){
				$data = array();
				$data['title'] = 'COMPLETE LIST';
				$data['linkactive'] = 'complete_list';
				$this->load->view('header', $data);
				$this->load->view('pages/complete_list');
				$this->load->view('modal');
				$this->load->view('footer');
	}
     public function report_list(){
				$data = array();
				$data['title'] = 'REPORT LIST';
				$data['linkactive'] = 'report_list';
				$this->load->view('header', $data);
				$this->load->view('pages/report');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	  public function wallet_report(){
				$data = array();
				$data['title'] = 'WALLET REPORT';
				$data['linkactive'] = 'wallet_report';
				$this->load->view('header', $data);
				$this->load->view('pages/wallet_report');
				$this->load->view('modal');
				$this->load->view('footer');
	}
	  public function wallet_report_date(){
				$data = array();
				$data['title'] = 'REPORT LIST';
				$data['linkactive'] = 'wallet_report_date';
				$this->load->view('header', $data);
				$this->load->view('pages/wallet_report_date');
				$this->load->view('modal');
				$this->load->view('footer');
	}
    		public function download_user_form()
	{
			$data = array();
				$data['title'] = 'DOWNLOAD FORM';
				$data['linkactive'] = 'download_user_form';
				//$data['allfirm'] = get_firms_by_id();
				$this->load->view('header', $data);
				$this->load->view('pages/download_user_form');
				$this->load->view('modal');
				$this->load->view('footer');



	}
  public function aboutus()
	{
		$data = array();
		$data['title'] = 'ABOUT US ';
		$data['linkactive'] = 'whyus';
		$data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/whyus');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function our_features()
	{
		$data = array();
		$data['title'] = 'OUR FEATURES ';
		$data['linkactive'] = 'our_features';
// 		$data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/our_features');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function list_features(){

				$data = array();

				$data['title'] = 'LIST FEATURES  ';

				$data['linkactive'] = 'list_features';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/list_features');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function news(){

				$data = array();

				$data['title'] = 'news';

				$data['linkactive'] = 'news';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/news');

				$this->load->view('modal');

				$this->load->view('footer');

	}
  		public function notice_board(){

				$data = array();

				$data['title'] = 'NOTICE BOARD';

				$data['linkactive'] = 'notice_board';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/notice_board');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function notice_list(){

				$data = array();

				$data['title'] = 'NOTICE LIST';

				$data['linkactive'] = 'notice_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/notice_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function latest_news_list(){

				$data = array();

				$data['title'] = 'LATEST NEWS';

				$data['linkactive'] = 'latest_news_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/latest_news_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
  public function news_list(){

				$data = array();

				$data['title'] = 'NEWS LIST';

				$data['linkactive'] = 'news_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/news_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
		public function latest_news(){

				$data = array();

				$data['title'] = 'LATEST NEWS';

				$data['linkactive'] = 'latest_news';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/latest_news');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    	public function admission_notice(){

				$data = array();

				$data['title'] = 'ADMISSION NOTICE';

				$data['linkactive'] = 'admission_notice';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/admission_notice');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    	public function admission_notice_list(){

				$data = array();

				$data['title'] = 'ADMISSION NOTICE LIST';

				$data['linkactive'] = 'admission_notice_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/admission_notice_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    public function advance_notice(){

				$data = array();

				$data['title'] = 'ADVANCE NOTICE';

				$data['linkactive'] = 'advance_notice';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/advance_notice');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    public function advance_notice_list(){

				$data = array();

				$data['title'] = 'ADVANCE NOTICE LIST';

				$data['linkactive'] = 'advance_notice_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/advance_notice_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
     public function our_branches(){

				$data = array();

				$data['title'] = 'OUR BRANCHES';

				$data['linkactive'] = 'our_branches';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/our_branches');

				$this->load->view('modal');

				$this->load->view('footer');

	}
      public function our_branches_list(){

				$data = array();

				$data['title'] = 'OUR BRANCHES LIST';

				$data['linkactive'] = 'our_branches_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/our_branches_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    public function information_board(){

				$data = array();

				$data['title'] = 'INFORMATION BOARD';

				$data['linkactive'] = 'information_board';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/information_board');

				$this->load->view('modal');

				$this->load->view('footer');

	}
   public function information_board_list(){

				$data = array();

				$data['title'] = 'INFORMATION BOARD LIST';

				$data['linkactive'] = 'information_board_list';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/information_board_list');

				$this->load->view('modal');

				$this->load->view('footer');

	}
    public function flash_image(){

				$data = array();

				$data['title'] = 'FLASH IMAGE';

				$data['linkactive'] = 'flash_image';

				//$data['allfirm'] = get_firms_by_id();

				$this->load->view('header', $data);

				$this->load->view('pages/flash_image');

				$this->load->view('modal');

				$this->load->view('footer');

	}
	public function menu()
	{
		$data = array();
		$data['title'] = 'MENU ';
		$data['linkactive'] = 'menu';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/menu');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function list_menu(){
	    $data = array();
		$data['title'] = 'MENU ';
		$data['linkactive'] = 'menu';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/list_menu');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	
	public function list_sub_menu(){
	    $data = array();
		$data['title'] = 'SUB MENU ';
		$data['linkactive'] = 'menu';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/list_sub_menu');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function list_sub_sub_menu(){
	    $data = array();
		$data['title'] = 'SUB SUB MENU ';
		$data['linkactive'] = 'menu';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/list_sub_sub_menu');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function fixed_menu()
	{
		$data = array();
		$data['title'] = 'FIXED PAGE ';
		$data['linkactive'] = 'fixed_menu';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/fixed_menu');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	
	
	public function page()
	{
		$data = array();
		$data['title'] = ' ADD PAGE ';
		$data['linkactive'] = 'page';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/page');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function update_page_content()
	{
		$data = array();
		$data['title'] = ' ADD PAGE ';
		$data['linkactive'] = 'page';
		// $data['aboutus'] = get_all_aboutus();
		$this->load->view('header', $data);
		$this->load->view('pages/update_page_content');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function brands(){
		$data = array();
		$data['title'] = 'COURSES';
		$data['linkactive'] = 'create_brands';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/brands');
		//$this->load->view('modal');
		$this->load->view('footer');

	}
	public function update_brands(){
		$data = array();
		$data['title'] = 'COURSES';
		$data['linkactive'] = 'create_brands';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/update_brands');
		//$this->load->view('modal');
		$this->load->view('footer');

	}
	public function category(){
		$data = array();
		$data['title'] = 'CLASSES';
		$data['linkactive'] = 'create_category';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/category');
		//$this->load->view('modal');
		$this->load->view('footer');

	}
	public function assign_student(){
		$data = array();
		$data['title'] = 'ASSIGN STUDENT';
		$data['linkactive'] = 'assign_student';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/assign_student');
		//$this->load->view('modal');
		$this->load->view('footer');

	}
	public function exam_schedule_list(){
		$data = array();
		$data['title'] = 'EXAM SCHEDULE LIST';
		$data['linkactive'] = 'exam_schedule_list';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/exam_schedule_list');
		$this->load->view('modal');
		$this->load->view('footer');

	}

	public function sub_category(){
		$data = array();
		$data['title'] = 'SUBJECT';
		$data['linkactive'] = 'sub_category';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/sub_category');
		//$this->load->view('modal');
		$this->load->view('footer');

	}


	public function product(){
		$data = array();
		$data['title'] = 'PRODUCT';
		$data['linkactive'] = 'create_product';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/product');
		//$this->load->view('modal');
		$this->load->view('footer');

	}

	public function master_setting(){
		$data = array();
		$data['title'] = 'MASTER SETTING';
		$data['linkactive'] = 'master_setting';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/master_setting');
		//$this->load->view('modal');
		$this->load->view('footer');

	}


	public function add_new_category(){
		$data = array();
		$data['title'] = 'ADD NEW CATEGORY';
		$data['linkactive'] = 'add_new_category';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/add_new_category');
		//$this->load->view('modal');
		$this->load->view('footer');

	}


	public function new_orders(){
		$data = array();
		$data['title'] = 'ADD NEW CATEGORY';
		$data['linkactive'] = 'new_orders';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/new_orders');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function subscriber(){
		$data = array();
		$data['title'] = 'ADD NEW CATEGORY';
		$data['linkactive'] = 'new_orders';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/subscriber_list');
		//$this->load->view('modal');
		$this->load->view('footer');
	}

	public function list_brands(){
		$data = array();
		$data['title'] = 'COURSE';
		$data['linkactive'] = 'list_brands';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_brands');
		$this->load->view('modal');
		$this->load->view('footer');
	}

	public function list_category(){
		$data = array();
		$data['title'] = 'CLASSES';
		$data['linkactive'] = 'list_category';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_category');
		$this->load->view('modal');
		$this->load->view('footer');
	}


	public function list_sub_category(){
		$data = array();
		$data['title'] = 'SUBJECT';
		$data['linkactive'] = 'list_sub_category';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_sub_category');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function list_product(){
		$data = array();
		$data['title'] = 'LIST PRODUCT';
		$data['linkactive'] = 'list_product';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_product');
		$this->load->view('modal');
		$this->load->view('footer');
	}

	
	
	
	public function delivered_product(){
		$data = array();
		$data['title'] = 'DELIVERED PRODUCT';
		$data['linkactive'] = 'delivered_product';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/delivered_product');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function pending_product(){
		$data = array();
		$data['title'] = 'PENDING PRODUCT';
		$data['linkactive'] = 'pending_product';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/pending_product');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
		public function pending_enquiry(){
		$data = array();
		$data['title'] = 'PENDING ENQUIRY';
		$data['linkactive'] = 'pending_enquiry';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/pending_enquiry');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
			public function cancel_enquiry(){
		$data = array();
		$data['title'] = 'CANCEL ENQUIRY';
		$data['linkactive'] = 'cancel_enquiry';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/cancel_enquiry');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
			public function all_enquiry(){
		$data = array();
		$data['title'] = 'ALL ENQUIRY';
		$data['linkactive'] = 'all_enquiry';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/all_enquiry');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
			public function approve_enquiry(){
		$data = array();
		$data['title'] = 'APPROVE ENQUIRY';
		$data['linkactive'] = 'approve_enquiry';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/approve_enquiry');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function cancelled_product(){
		$data = array();
		$data['title'] = 'CANCELLED PRODUCT';
		$data['linkactive'] = 'cancelled_product';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/cancelled_product');
		//$this->load->view('modal');
		$this->load->view('footer');
	}

	public function deals_today(){
		$data = array();
		$data['title'] = 'DEALS TODAY';
		$data['linkactive'] = 'deals_today';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/deals_today');
		//$this->load->view('modal');
		$this->load->view('footer');
	}

	public function add_banner(){
		$data = array();
		$data['title'] = 'ADD BANNER';
		$data['linkactive'] = 'add_banner';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/add_banner');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	public function list_banner(){
		$data = array();
		$data['title'] = 'LIST BANNER';
		$data['linkactive'] = 'list_banner';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_banner');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
    
    
    public function new_users(){
		$data = array();
		$data['title'] = 'NEW REGISTRATION';
		$data['linkactive'] = 'list_banner';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/new_users');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function page_list(){
	    $data = array();
		$data['title'] = 'NEW REGISTRATION';
		$data['linkactive'] = 'page_list';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/page_list');
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function add_marquee(){
	    $data = array();
		$data['title'] = 'ADD MARQUEE ';
		$data['linkactive'] = 'add_marquee';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/add_marquee');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function manage_frontent(){
	    $data = array();
		$data['title'] = 'MANAGE FRONTEND ';
		$data['linkactive'] = 'manage_frontend';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/manage_frontend');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function manage_backend(){
	    $data = array();
		$data['title'] = 'MANAGE BACKEND ';
		$data['linkactive'] = 'manage_backend';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/manage_backend');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function get_result(){
	    $data = array();
		$data['title'] = 'GET RESULT';
		$data['linkactive'] = 'get_result';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/get_result');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function create_result(){
	    $data = array();
		$data['title'] = 'CREATE RESULT';
		$data['linkactive'] = 'create_result';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/create_result');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function create_admit_card(){
	    $data = array();
		$data['title'] = 'CREATE ADMIT CARD';
		$data['linkactive'] = 'create_admit_card';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/create_admit_card');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function get_admit_card(){
	    $data = array();
		$data['title'] = 'GET ADMIT CARD';
		$data['linkactive'] = 'create_admit_card';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/get_admit_card');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function download_admit_card(){
	    $data = array();
		$data['title'] = 'GET ADMIT CARD';
		$data['linkactive'] = 'download_admit_card';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/download_admit_card');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function download_admitcard(){
	    $data = array();
		$data['title'] = 'DOWNLAOD ADMIT CARD';
		$data['linkactive'] = 'download_admitcard';
		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('header', $data);
		$this->load->view('pages/download_admitcard');
// 		$this->load->view('modal');
// 		$this->load->view('footer');
	}
	
	
	
	
	public function center_list(){
	    $data = array();
		$data['title'] = 'CENTER LIST';
		$data['linkactive'] = 'center_list';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/center_list');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	public function student_list(){
	    $data = array();
		$data['title'] = 'STUDENT LIST';
		$data['linkactive'] = 'student_list';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/student_list');
		$this->load->view('modal');
		$this->load->view('footer'); 
	}
	public function download_admission_form(){
	    $data = array();
		$data['title'] = 'DOWNLOAD FORM';
		$data['linkactive'] = 'download_form';
		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('header', $data);
		$this->load->view('pages/download_form');
// 		$this->load->view('modal');
// 		$this->load->view('footer'); 
	}
	
	
	
	
	
		public function add_menu (){
		$slug = 'main-menu';
		$data = array();
		$data['title'] = 'LIST COUPAN';
		$data['linkactive'] = 'list_coupan';
		$result = $this->cms_menu_model->getBySlug(urldecode($slug));
        $data['result'] = $result;
		$data['top_menu'] = urldecode($slug);
		$listMenus = $this->cms_menuitems_model->getMenus($result['id']);
        $data['listdropdown_Menus'] = $listMenus;
		

		$listMenus = $this->db->get('link_page')->result();
        
        $data['listMenus'] = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('group_id',$group_id);
       // $this->db->order_by('parent_id , position');
        $query = $this->db->get();
        $menu = $query->result();
        

        $data['menu_ul'] = '<li class="dd-list"></li>';
        if ($menu) {
            foreach ($menu as $row) {
                $this->add_row(
                    $row->id, $row->parent_id, ' data-id="' . $row->id . '" class="dd-item dd2-item"', $this->get_label($row)
                );
            }

            $data['menu_ul'] = $this->generate_list('class="dd-list"');
        }
        
            
		$this->load->view('header', $data);
		$this->load->view('pages/add_menu',$data);
		//$this->load->view('modal');
		$this->load->view('footer');
	}
	
	function add_row($id, $parent, $li_attr, $label)
    {
        $this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
    }
    
	function generate_list($ul_attr = '')
    {
       
        
        return $this->ul(0, $ul_attr);
    }
	
	function ul($parent = 0, $attr = '')
    {
        
        //print_r($this->data[$parent]);
        static $i = 1;
        $indent = str_repeat("\t\t", $i);
        if (isset($this->data[$parent])) {
	        if ($attr) {
	            $attr = ' ' . $attr;
	        }



            $html = "\n$indent";
            $html .= " 
            			 <ol class='sortable dd-list'>
            <!--
            <ol$attr>
            -->
            ";
            

            $i++;
           
           
            foreach ($this->data[$parent] as $row) {
               
               $main_menu = $this->db->get_where('front_cms_menu_items',['id'=>$row['id'] ])->row();

                $child = $this->ul($row['id']);
                $html .= "\n\t$indent";
                $html .= '
                			<li  id="list_'.$row['id'].'" class="dd-item dd2-item">
                              <div class="dd-handle dd2-handle">
                                  <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>

                                  <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                              </div>

                              <div class="dd2-content"> '.@$main_menu->menu.'</div>
                              <input type="hidden" name="title" value="' . $main_menu->menu . '">
                                <input type="hidden" name="menu" value="' . $row['id'] . '">
                <!--
                <li' . $row['li_attr'] . '>
                -->
                ';
                //$html .= $row['label'];
               

                if ($child) {
                
                    $i--;
                    $html .= $child;
                    $html .= "\n\t$indent";
                }

                $html .= '</li>';
            }
            
            $html .= "\n$indent</ol>";
           //print_r($html);
            return $html;


        } else {
            return false;
        }
    }
	
	
	
	private function get_label($row)
    {
     

        $row = $this->db->get_where('front_cms_menu_items',['id'=>$row->id])->row();

          $count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$row->id])->num_rows();

          	if ($count_menu > 0) {
               
          		$menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$row->id])->result();
          		
          		$label2 = '';
          		foreach ($menu2 as $key) {
          			$xx = 	$this->get_label2($key->id);
           		


           		$label2 .= '<ol class="dd-list">
                        <li class="dd-item dd2-item" id="list_'.$key->id.'">
                            <div class="dd2-content dd-handle dd2-handle">
                                <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>
                                
                                <input type="hidden" name="title" value="' . $key->menu . '">
                                <input type="hidden" name="menu" value="' . $key->id . '">
                                
                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>
                            <div class="dd2-content">'.$key->menu.'212</div>
                            '.$xx.'
                        </li>
                        </ol>    
                        '; 
             	}

          }else{
            $label2 = '';
          }


            $label = '<ol class="dd-list">
                        <li class="dd-item dd2-item" id="list_'.$row->id.'">
                            <div class="dd2-content dd-handle dd2-handle">
                                <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>
                                
                                <input type="hidden" name="title" value="' . $row->menu . '">
                                <input type="hidden" name="menu" value="' . $row->id . '">
                                
                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>
                            <div class="dd2-content">'.$row->menu.'</div>
                            '.$label2.'
                        </li>
                        </ol>    
                        ';
       // }		
        
        
       
        
       
       
        
        return $label;
    }
	


    function get_label2($parentid){

    	$count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->num_rows();

    		$label2 = '';

    		//print_r($count_menu);

    		$menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->result();
          	if ($count_menu > 0) {
               
          		


          		
                   
                // print_r($menu2);	

          		foreach (@$menu2 as $key) {
          			$label2 .= '<ol class="dd-list">
                        <li class="dd-item dd2-item" id="list_'.$key->id.'">
                            <div class="dd-handle dd2-handle">
                                <i class="normal-icon ace-icon fa fa-comments blue bigger-130"></i>
                                
                                <input type="hidden" name="title" value="' . @$menu2->menu . '">
                                <input type="hidden" name="menu" value="' . @$menu2->id . '">
                                
                                <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i>
                            </div>';
          			//$this->get_label($key->id);
           			$label2 .='<div class="dd2-content">'.$key->menu.'212</div>';
             		
           			$label2 .= '</li>
                        </ol>    
                        ';

             		$count_menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$key->id])->num_rows();
             		if ($count_menu2 > 0) {
             			$this->get_label2($key->id);
             		}
             		
             	}

             
            }

           //s print_r($label2);
            return $label2;



    }

    
    public function upload_certificate(){
        $data = array();
		$data['title'] = 'UPLOAD CERTIFICATE';
		$data['linkactive'] = 'upload_certificate';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/upload_certificate');
		$this->load->view('modal');
		$this->load->view('footer');
    }

    
    public function create_course(){
        $data = array();
		$data['title'] = 'CREATE COURSE';
		$data['linkactive'] = 'create_course';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/create_course');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    public function list_course(){
        $data = array();
		$data['title'] = 'CREATE COURSE';
		$data['linkactive'] = 'create_course';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_course');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    
	 public function get_course(){
        $data = array();
		$data['title'] = 'GET COURSE';
		$data['linkactive'] = 'create_course';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/get_course');
		$this->load->view('modal');
		$this->load->view('footer');
    }
	
	public function add_subject(){
	    $data = array();
		$data['title'] = 'ADD SUBJECT';
		$data['linkactive'] = 'create_course';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/add_subject');
		$this->load->view('modal');
		$this->load->view('footer');
	    
	}
	
	
	public function add_student(){
	    $data = array();
		$data['title'] = 'ADD STUDENT';
		$data['linkactive'] = 'add_student';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/add_student');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function upload_result(){
        $data = array();
		$data['title'] = 'UPLOAD RESULT';
		$data['linkactive'] = 'upload_result';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/upload_result');
		$this->load->view('modal');
		$this->load->view('footer');
    }
	
	public function generate_qrcode(){
        $data = array();
		$data['title'] = 'GENERATE QRCODE';
		$data['linkactive'] = 'generate_qrcode';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/generate_qrcode');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    public function generate_ticket()
	{
		
				//header('Content-type: text/plain');
				
					$SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/temp/';
				    
				    $text = 'HELLO THIS IS QRCODE CONTENT';
					$text1= substr($text, 0,9);
					
					$folder = $SERVERFILEPATH;
					$file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
					$file_name = $folder.$file_name1;
					
					QRcode::png($text,$file_name);
					
				  
			   
	}
    
    
    public function update_password(){
        $data = array();
		$data['title'] = 'UPDATE PASSWORD';
		$data['linkactive'] = 'update_password';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/update_password');
		$this->load->view('modal');
		$this->load->view('footer');
        
    }
    
    
    public function Occupation(){
        $data = array();
		$data['title'] = 'OCCUPATION';
		$data['linkactive'] = 'Occupation';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/Occupation');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    public function batch_session(){
        $data = array();
		$data['title'] = 'BATCH ';
		$data['linkactive'] = 'batch_session';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/batch_session');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    
    public function chairman(){
        $data = array();
		$data['title'] = 'CHAIMAN ';
		$data['linkactive'] = 'chairman';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/chairman');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    
    public function director(){
        $data = array();
		$data['title'] = 'DIRECTOR ';
		$data['linkactive'] = 'director';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/director');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    public function state_office(){
        $data = array();
		$data['title'] = 'STATE OFFICE ';
		$data['linkactive'] = 'state_office';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/state_office');
		$this->load->view('modal');
		$this->load->view('footer');
    }
    
    
    public function print_result(){
	    $data = array();
		$data['title'] = 'PRINT RESULT';
		$data['linkactive'] = 'print_result';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/print_result');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	
	public function print_certificate(){
	    $data = array();
		$data['title'] = 'PRINT CERTIFICATE';
		$data['linkactive'] = 'print_certificate';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/print_certificate');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	
    public function update_result(){
	    $data = array();
		$data['title'] = 'CREATE RESULT';
		$data['linkactive'] = 'create_result';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/update_result');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	
	/*
	THis section is craete for student fee system;
	*/
	
	function student_fee(){
	    
	    $data = array();
	    $data['title'] = 'Student Fee';
	    $data['linkactive'] = __FUNCTION__;
	    
	    $this->load->view('header', $data);
		$this->load->view('pages/'.__FUNCTION__);
		$this->load->view('modal');
		$this->load->view('footer');
	    
	    
	    
	    
	}
	
	
	
    

}
