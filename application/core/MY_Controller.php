<?php
class MY_Controller extends CI_Controller{
    function __construct(){
        
        parent :: __construct();
        
        if($this->session->userdata('type') == 2){
            $this->load->config('valid_center_urls');
            $this->check_center_urls();
        }
        
        
    }
    
    public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['photo']['name']);
        if(isset($_FILES['photo']['name']) && $_FILES['photo']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file For Photo.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a Profile Photo to upload.');
            return false;
        }
    }
    
    function check_center_urls(){
        $fetchClass = strtolower($this->router->fetch_class());
        $fetchMethod  = strtolower($this->router->fetch_method());
        // print_r(config_item('valid_center_urls'));
        if(!in_array($fetchMethod,config_item('valid_center_urls'))  AND !$this->input->post()){
            $this->session->set_flashdata('msg','<div class="alert alert-danger"><a href="'.current_url().'">'.current_url().'</a> url is not valid For Your Panel. </div>');
            redirect('Admin/dashboard'); 
            exit;
        }
        
        
    }
}




require_once __DIR__.'/Student_Controller.php';

?>