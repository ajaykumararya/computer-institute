<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		ini_set('display_errors', 1);
		$this->load->helper('download');

		$this->load->helper('url');
		date_default_timezone_set('Asia/Calcutta'); 
		$this->load->helper('common_helper');
		$this->load->database('default');

		
	}
    function test1(){
      		echo '<pre>';
		print_r($_SESSION);
		echo '</pre>';   
    }
    // home
    public function index()
	{	
    // die('dwdwd');
		$data = array();
		 $data['title'] = 'WELCOME TO Ch.Shivcharan institute of Health Science  ';
		 
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		 
		 
		 
		
		$this->load->view('web/header',$data);
		$this->load->view('web/index_home');
		$this->load->view('web/footer');
	}
	
	
	
	public function get_course_category_detail(){
        $data = array();
        $data['title'] = 'WELCOME';
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$this->load->view('web/header',$data);
		$this->load->view('web/get_course_category_detail');
		$this->load->view('web/footer');
		
		//$this->load->view('web/get_course_category_detail', $data);
	}
	
	
	
	
	
	
	public function home()
	{	
    // die('dwdwd');
		$data = array();
		 $data['title'] = 'WELCOME TO Ch.Shivcharan institute of Health Science  ';
		 
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		 
		 
		 
		// $data['profile'] = get_all_profile();
		// $data['top'] = welcome_text();
		// $data['member'] = members_list();
		// $data['whyus'] = homepage_second_blog();
		// $data['blogs'] = blogs_list(1);
		$this->load->view('web/header',$data);
		$this->load->view('web/home');
		$this->load->view('web/footer');
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
	    
	  
	    
	     force_download ( $fileName, $data );
	    } else {
	     // Redirect to base url
	     // redirect ( base_url () );
	    }
	   }

	   } catch(Exception $e) {
	   	 die($e->getMessage());
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
	public function custome_page($id)
	{
		$data = array();
        //$data['id'] = $id;
        
        $data['title'] = 'WELCOME';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		//$this->load->view('web/header');
		$this->load->view('web/page', $data);
		//$this->load->view('web/footer');
	}
// 	public function student_registration()
// 	{
// 		$data = array();
//         //$data['id'] = $id;
        
//         $data['title'] = 'WELCOME';
		
// 		$listMenus = $this->generate_list('id="easymm"');
//         $data['listMenus'] = $listMenus;
//         $group_id = 1;
//         $this->db->select('*');
//         $this->db->from('front_cms_menu_items');
//         $this->db->where('MENU_STATUS','0');
//         $this->db->where('group_id',$group_id);
//         $this->db->order_by("position", "asc");
//         $query = $this->db->get();
//         $menu = $query->result();
        

//         $data['menu_ul'] = '<li class="dd-list"></li>';
//         if ($menu) {
//             foreach ($menu as $row) {
//                 $this->add_row(
//                     $row->id, $row->parent_id, ' data-id="' . $row->id . '" class="dd-item dd2-item"', $this->get_label($row)
//                 );
//             }

//             $data['menu_ul'] = $this->generate_list('class="dd-list"');
//         }
		
		
// 		$this->load->view('web/header');
// 		$this->load->view('web/student_registration', $data);
// 		$this->load->view('web/footer');
// 	}


    public function dynamic_page(){
        $data = array();
       // $data['id'] = $this->uri->segment();
        
		$data['title'] = 'WELCOME';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		//$this->load->view('web/header');
		//$this->load->view('web/dynamic_pages', $data);
			$this->load->view('web/page', $data);
		//$this->load->view('web/footer');
		
// 		$this->load->view('web/header', $data);
// 		 $this->load->view('web/registration');
// 		 $this->load->view('web/footer');
		
    }
    
    
    
    
	
	public function registration(){
	     $data = array();
	     $data['title'] = 'REGISTRATION FORM';
	     
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/registration');
		 $this->load->view('web/footer');
	}
	public function download_admit_card(){
	     $data = array();
	     $data['title'] = 'DOWNLOAD ADMIT CARD';
	     $listMenus = $this->generate_list('id="easymm"');
            $data['listMenus'] = $listMenus;
            $group_id = 1;
            $this->db->select('*');
            $this->db->from('front_cms_menu_items');
            $this->db->where('MENU_STATUS','0');
            $this->db->where('group_id',$group_id);
            $this->db->order_by("position", "asc");
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
	     
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/download_admit_card');
 		 $this->load->view('web/footer');
	}
	public function download_result(){
	     $data = array();
	     $data['title'] = 'DOWNLOAD RESULT ';
	     
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/download_result');
 		 $this->load->view('web/footer');
	}
	public function print_certificate(){
	     $data = array();
	     $data['title'] = 'DOWNLOAD CERTIFICATE ';
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/download_certificate');
 		 $this->load->view('web/footer');
	}
	public function print_student_id(){
	     $data = array();
	     $data['title'] = 'DOWNLOAD STUDENT ID ';
	     
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/print_student_id');
 		 $this->load->view('web/footer');
	}
	public function login(){
	     $data = array();
	     $data['title'] = 'Login FORM';
	     
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/login');
		 $this->load->view('web/footer');
	}
	
	public function volunteer_registration(){
	     $data = array();
	     $data['title'] = 'REGISTRATION FORM';
	     
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/volunteers_registration');
		 $this->load->view('web/footer');
	}
		public function print_preview(){
	     $data = array();
	     $data['title'] = 'FORM PREVIEW';
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	    
	     
	     $this->load->view('web/header', $data);
		 $this->load->view('web/preview');
		 $this->load->view('web/footer');
	}

    
    
    public function product_listing(){
	     $data = array();
	     $data['title'] = 'PRODUCTS';
	     
	     
	    $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     
	     $data['product'] = get_all_product(0);
	     $this->load->view('web/header', $data);
		 $this->load->view('web/product_listing');
		 $this->load->view('web/footer');
	}



     public function cart_list(){
	     $data = array();
	     $data['title'] = 'PRODUCTS';
	     
	     $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	    // $data['product'] = get_all_product(0);
	     $this->load->view('web/header', $data);
		 $this->load->view('web/cart_list');
		 $this->load->view('web/footer');
	}


// public function download_certificate(){
// 	    $data = array();
// 		$data['title'] = 'LIST CENTER';
		
// 	    $listMenus = $this->generate_list('id="easymm"');
//         $data['listMenus'] = $listMenus;
//         $group_id = 1;
//         $this->db->select('*');
//         $this->db->from('front_cms_menu_items');
//         $this->db->where('MENU_STATUS','0');
//         $this->db->where('group_id',$group_id);
//         $this->db->order_by("position", "asc");
//         $query = $this->db->get();
//         $menu = $query->result();
        

//         $data['menu_ul'] = '<li class="dd-list"></li>';
//         if ($menu) {
//             foreach ($menu as $row) {
//                 $this->add_row(
//                     $row->id, $row->parent_id, ' data-id="' . $row->id . '" class="dd-item dd2-item"', $this->get_label($row)
//                 );
//             }

//             $data['menu_ul'] = $this->generate_list('class="dd-list"');
//         }
		
		
// 		$data['linkactive'] = 'list_center';
// 		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('web/header', $data);
// 		$this->load->view('web/get_certificate');
// // 		$this->load->view('modal');
// 		$this->load->view('web/footer');
// 	}

     public function download_history(){
	     $data = array();
	     $data['title'] = 'PRODUCTS';
	    
	    
	    
	    $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
	     
	     
	    // $data['product'] = get_all_product(0);
	     $this->load->view('web/header', $data);
		 $this->load->view('web/download_history');
		 $this->load->view('web/footer');
	}
	public function events()
	{
		$data = array();
		$data['title'] = 'EVENTS  ';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(2);
		//$data['events'] = events_list();
		$this->load->view('web/header',$data);
		$this->load->view('web/events');
		$this->load->view('web/footer');
	}
// 	blog details
public function blog_detail()
	{
		$data = array();
		$data['title'] = 'BLOG DETAIL  ';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(2);
		//$data['events'] = events_list();
		$this->load->view('web/header',$data);
		$this->load->view('web/blog_detail');
		$this->load->view('web/footer');
	}
// 	blog detail
public function course_detail()
	{
		$data = array();
		$data['title'] = 'COURSE DETAIL  ';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(2);
		//$data['events'] = events_list();
		$this->load->view('web/header',$data);
		$this->load->view('web/course_detail');
		$this->load->view('web/footer');
	}
	public function faq()
	{
		$data = array();
		$data['title'] = 'FREQUENTLY ASK QUESTIONS   ';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(1);
		$data['faq_list'] = faq_list();
		$this->load->view('web/header',$data);
		$this->load->view('web/faq');
		$this->load->view('web/footer');
	}
	public function gallery()
	{
		$data = array();
		$data['title'] = 'GALLERY  ';
		
		
	    $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(3);
		//['top'] = welcome_text();
		$this->load->view('web/header',$data);
		$this->load->view('web/gallery');
		$this->load->view('web/footer');
	}
		public function student_id()
	{
		$data = array();
		$data['title'] = 'STUDENT ID  ';
		
		
	    $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(3);
		//['top'] = welcome_text();
		$this->load->view('web/header',$data);
		$this->load->view('web/student_id');
		$this->load->view('web/footer');
	}
	public function team_members()
	{
		$data = array();
		$data['title'] = 'TEAM MEMBERS  ';
		$listMenus = $this->generate_list('id="easymm"');
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(1);
		//$data['top'] = welcome_text();
		$this->load->view('web/header',$data);
		$this->load->view('web/team_members');
		$this->load->view('web/footer');
	}
	public function blogs()
	{
		$data = array();
		$data['title'] = 'BLOGS  ';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(1);
		//$data['top'] = welcome_text();
		$this->load->view('web/header',$data);
		$this->load->view('web/blogs');
		$this->load->view('web/footer');
	}
	public function logout(){
	    $this->session->sess_destroy();
        redirect('');
	}
	public function about_us()
	{
		$data = array();
		$data['title'] = 'ABOUT US  ';
	
	
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		$data['blogs'] = blogs_list(1);
		$this->load->view('web/header',$data);
		$this->load->view('web/about_us');
		//$this->load->view('web/modal');
		$this->load->view('web/footer');
	}
		public function student_registration()
	{
		$data = array();
		$data['title'] = 'STUDENT REGISTRATION ';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		// $data['blogs'] = blogs_list(3);
		$this->load->view('web/header',$data);
		$this->load->view('web/student_registration');
		$this->load->view('web/footer');
	}
	public function contact()
	{
		$data = array();
		$data['title'] = 'CONTACT US ';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		// $data['blogs'] = blogs_list(3);
		$this->load->view('web/header',$data);
		$this->load->view('web/contact');
		$this->load->view('web/footer');
	}
	public function our_teacher()
	{
		$data = array();
		$data['title'] = 'OUR TEACHER ';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		// $data['blogs'] = blogs_list(3);
		$this->load->view('web/header',$data);
		$this->load->view('web/our_teacher');
		$this->load->view('web/footer');
	}
	public function our_teacher_detail()
	{
		$data = array();
		$data['title'] = 'OUR TEACHER DETAIL';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		// $data['blogs'] = blogs_list(3);
		$this->load->view('web/header',$data);
		$this->load->view('web/teacher_detail');
		$this->load->view('web/footer');
	}
	public function our_course()
	{
		$data = array();
		$data['title'] = 'OUR COURSE ';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['profile'] = get_all_profile();
		$data['members_list'] = members_list();
		// $data['blogs'] = blogs_list(3);
		$this->load->view('web/header',$data);
		$this->load->view('web/our_course');
		$this->load->view('web/footer');
	}
	public function e_certificate(){
		$data = array();
		$data['title'] = 'E-CERTIFICATE  ';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$this->load->view('web/header',$data);
		$this->load->view('web/ecertificate');
		$this->load->view('web/footer');

	}
	public function demo_check()
	{
		$data = array();
		
		$this->load->view('web/standard.html');
	
	}
	public function center_login(){
		$data = array();
		$data['title'] = 'center_login';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		
		$this->load->view('web/header',$data);
		$this->load->view('web/center_login');
		$this->load->view('web/footer');

	}
	public function franchisee_registration(){
		$data = array();
		$data['title'] = 'franchisee_registration';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$this->load->view('web/header',$data);
		$this->load->view('web/franchisee_registration');
		$this->load->view('web/footer');

	}
	public function student_form(){
		$data = array();
		$data['title'] = 'student_form';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		$this->load->view('web/header',$data);
		$this->load->view('web/student_form');
		$this->load->view('web/footer');

	}
    public function syllabus(){
		$data = array();
		$data['title'] = 'LIST PRODUCT';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
        
        
		$data['linkactive'] = 'syllabus';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('header', $data);
		$this->load->view('pages/list_syllabus');
		$this->load->view('modal');
		$this->load->view('footer');
	}
	public function list_center(){
		$data = array();
		$data['title'] = 'LIST CENTER';
		
	$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		$data['linkactive'] = 'list_center';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('web/header', $data);
		$this->load->view('web/list_center');
		$this->load->view('modal');
		$this->load->view('web/footer');
	}
	
	public function site_download(){
	    $data = array();
		$data['title'] = 'LIST CENTER';
		$data['linkactive'] = 'list_center';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('web/header', $data);
		$this->load->view('web/site_downlad');
		$this->load->view('modal');
		$this->load->view('web/footer');
	}
	public function enrollment_verification(){
	    $data = array();
		$data['title'] = 'LIST CENTER';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		$data['linkactive'] = 'list_center';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('web/header', $data);
		$this->load->view('web/enrollment_verification');
		$this->load->view('modal');
		$this->load->view('web/footer');
	}
	public function get_admit_card(){
	    $data = array();
		$data['title'] = 'LIST CENTER';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		
		$data['linkactive'] = 'list_center';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('web/header', $data);
		$this->load->view('web/get_admit_card');
// 		$this->load->view('modal');
		$this->load->view('web/footer');
	}
	public function get_certificate(){
	    $data = array();
		$data['title'] = 'LIST CENTER';
		
	    $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['linkactive'] = 'list_center';
		$this->load->view('web/header', $data);
		$this->load->view('web/get_certificate');
		$this->load->view('web/footer');
	}
    
    
    public function get_marksheet(){
	    $data = array();
		$data['title'] = 'LIST CENTER';
		
	    $listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['linkactive'] = 'list_center';
		$this->load->view('web/header', $data);
		$this->load->view('web/get_marksheet');
		$this->load->view('web/footer');
	}



	public function test(){
	    $data = array();
		$data['title'] = 'TEST';
		$data['linkactive'] = 'test';
		
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		//$data['allfirm'] = get_firms_by_id();
// 		$this->load->view('web/header', $data);
		$this->load->view('web/test');
// 		$this->load->view('modal');
// 		$this->load->view('web/footer');
	}
	
	public function get_result(){
	    
	    $data = array();
		$data['title'] = 'LIST CENTER';
		
		$listMenus = $this->generate_list('id="easymm"');
        $data['listMenus'] = $listMenus;
        $group_id = 1;
        $this->db->select('*');
        $this->db->from('front_cms_menu_items');
        $this->db->where('MENU_STATUS','0');
        $this->db->where('group_id',$group_id);
        $this->db->order_by("position", "asc");
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
		
		
		$data['linkactive'] = 'list_center';
		//$data['allfirm'] = get_firms_by_id();
		$this->load->view('web/header', $data);
		$this->load->view('web/get_result');
// 		$this->load->view('modal');
		$this->load->view('web/footer');
	}
	
	
	
	
	public function list_menu (){
		$slug = 'main-menu';
		$data = array();
		$data['title'] = 'LIST MENU';
		
		$listMenus = $this->generate_list('id="easymm"');
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
		
		
		$data['linkactive'] = 'list_coupan';
		
	    $listMenus = $this->generate_list('id="easymm"');
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
        
         $this->load->view('web/header',$data);
    	$this->load->view('web/home');
    	$this->load->view('web/footer');

		// $this->load->view('header', $data);
		// $this->load->view('pages/add_menu',$data);
		// //$this->load->view('modal');
		// $this->load->view('footer');
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
            $html .= "";
            

            $i++;
           
           
            foreach ($this->data[$parent] as $row) {
               
               $main_menu = $this->db->get_where('front_cms_menu_items',['id'=>$row['id'] ])->row();

                $child = $this->ul($row['id']);
                $html .= "\n\t$indent";
                $html .= '<li >
                				<a href="'.str_replace("&","and",$main_menu->ext_url_link).'">'.@$main_menu->menu.' </a>
                              
                
                ';
                $html .= $row['label'];
               

                // if ($child) {
                
                //     $i--;
                //     $html .= $child;
                //     $html .= "\n\t$indent";
                // }

                $html .= '';
            }
            
            $html .= "\n$indent</li>";
           //print_r($html);
            return $html;


        } else {
            return false;
        }
    }
	
	
	
	private function get_label($row)
    {
     


        $row = $this->db->get_where('front_cms_menu_items',['id'=>@$row->id])->row();

          $count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>@$row->id])->num_rows();

          	if ($count_menu > 0) {
               
          		$menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$row->id])->result();
          		
          		$label2 = '';
          		$label2 .= '
          		            
          		            <ul  >'; 
          		foreach ($menu2 as $key) {
          			$xx = 	$this->get_label2($key->id);
           			$label2 .= '<li class="dropdown"><a href="'.str_replace("&","and",$key->ext_url_link).'">' . $key->menu . ' </a>'.$xx.'</li>';

               
             	}
             	 $label2 .= '</ul>'; 
             	//print_r($label2);
             	return $label2;
          }else{
            $label2 = '';
          }

        
        //return $label;
    }
	


    function get_label2($parentid){

    	$count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->num_rows();
    		$label2 = '';
    		$menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->result();
          	if ($count_menu > 0) {
               	$label2 .= '
          						<ul >'; 
          		foreach (@$menu2 as $key) {
          			

          			$xx = 	$this->get_label3($key->id);
           			$label2 .= '<li ><a href="'.str_replace("&","and",$key->ext_url_link).'">' . $key->menu . '</a>'.$xx.'</li>';

                        //$label2 .= '<li><a href="'.$key->ext_url_link.'">' . $key->menu . '</a></li>';
                }
             	$label2 .= '

                        	</ul>   
                        ';
             
            }

           //s print_r($label2);
            return $label2;



    }



    function get_label3($parentid){

    	$count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->num_rows();
    		$label2 = '';
    		$menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->result();
          	if ($count_menu > 0) {
               	$label2 .= '
          						<ul  >'; 
          		foreach (@$menu2 as $key) {
          			

          			$xx = 	$this->get_label4($key->id);
           			$label2 .= '<li ><a href="'.str_replace("&","and",$key->ext_url_link).'">' . $key->menu . '</a>'.$xx.'</li>';

                      //  $label2 .= '<li><a href="">' . $key->menu . '</a></li>';
                }
             	$label2 .= '

                        	</ul>   
                        ';
             
            }

           //s print_r($label2);
            return $label2;



    }


    function get_label4($parentid){

    	$count_menu = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->num_rows();
    		$label2 = '';
    		$menu2 = $this->db->get_where('front_cms_menu_items',['parent_id'=>$parentid])->result();
          	if ($count_menu > 0) {
               	$label2 .= '
          						<ul  >'; 
          		foreach (@$menu2 as $key) {
          			

          			//$xx = 	$this->get_label4($key->id);
           			

                        $label2 .= '<li ><a href="'.str_replace("&","and",$key->ext_url_link).'">' . $key->menu . '</a></li>';
                }
             	$label2 .= '

                        	</ul>   
                        ';
             
            }

           //s print_r($label2);
            return $label2;



    }

/*------------end of form submition -------------*/
}
