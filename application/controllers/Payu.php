<?php
class Payu extends CI_Controller{
    function __construct(){
        parent :: __construct();
    }
    
    function index(){
        echo '<pre>';
        print_r($_POST);
    }
    function frenschise_response(){
        if($_POST['status'] == 'success'){
            $this->db->update('centers',['status' => 1],['id' => $_POST['udf1']]);
            $this->db->update('admin_login',['ADMIN_STATUS'=>1],['INSTITUTE_CENTER_ID' => $_POST['udf1']]);
        }
        $this->save_history('center',$_POST);
        redirect(base_url('admin'));
    }
    
    function student_response(){
        if($_POST['status'] == 'success'){
            $this->db->update('students',['pay_status' => 1],['id' => $_POST['udf1']]);
            // $this->db->update('admin_login',['ADMIN_STATUS'=>1],['INSTITUTE_CENTER_ID' => $_POST['udf1']]);
        }
        $this->save_history('student',$_POST);
        redirect(base_url('student-registration'));
    }
    
    function center_add_student_response(){
        if($_POST['status'] == 'success'){
            $this->db->update('students',['pay_status' => 1],['id' => $_POST['udf1']]);
        }
        $this->save_history('student',$_POST);
        redirect(base_url('admin/add_student'));
    }
    
    function save_history($type = 'student', $data = array()){
        $this->db->insert('payment_history',['type' => $type, 'data' => json_encode($data)]);
    }
}
?>