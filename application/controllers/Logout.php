<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

	public function index(){


		$data = array();
		$data['title'] = 'LOGIN |  UMA GLASS ';
		$this->load->view('login', $data);
	}

	public function logoff(){
				$this->session->unset_userdata('loginid');
	            $this->session->unset_userdata('type'); /* for admin login */
	            $this->session->unset_userdata('comp_id');
	            $this->session->unset_userdata('firm_id');
	            $this->session->unset_userdata('is_active');
	            
	            //$data = array();
				//$data['title'] = 'LOGIN |  UMA GLASS ';
				//$this->load->view('login', $data);

	            redirect('logout');
	}

}

?>