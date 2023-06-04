<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

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
		
		
		$this->load->helper('dashboard_helper');
		// $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		// if ($this->session->userdata('loginid') == '') {
		// 	if (base_url() . 'admin' != $actual_link) {
		// 		redirect('admin');
		// 	}
		// }
  //       setlocale(LC_MONETARY, 'en_IN');

		// Your own constructor code
		
		if ($this->session->userdata('is_active')  == '') {
           redirect('Logout/logoff');
        }else{
        	
        	 $method = $this->uri->segment(2);
			if (method_exists($this,$method)) {
	    		
	        } else {
	        redirect('user/dashboard');
	        }
        }
    }

    public function dashboard()
	{
		$data = array();
		$data['title'] = 'Dashboard  ';
		$data['linkactive'] = 'dashboard';
		//$data['allfirm'] = get_firms_by_id();
		
		$this->load->view('header', $data);
		$this->load->view('pages/dashboard');
		//$this->load->view('modal');
		$this->load->view('footer');
	}

	public function labour()
	{
		$data = array();
		$data['title'] = 'LABOUR  ';
		$data['linkactive'] = 'labour';
		//$data['allfirm'] = get_firms_by_id();
		
		$this->load->view('header', $data);
		$this->load->view('pages/labour');
		//$this->load->view('modal');
		$this->load->view('footer');
	}



 }
 ?>