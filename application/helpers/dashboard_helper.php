<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function today_registration(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_REG_DATE="' . $date . '" and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function today_advisor_reg(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_REG_DATE="' . $date . '" and HRM_TYPE_ID=3 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function today_customer_reg(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_REG_DATE="' . $date . '" and HRM_TYPE_ID=4 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function today_employee_reg(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_REG_DATE="' . $date . '" and HRM_TYPE_ID=8 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function total_member(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_TYPE_ID=6 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function total_customer(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_TYPE_ID=4 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function total_advisor(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_TYPE_ID=3 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function total_employee(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from hrm where HRM_TYPE_ID=8 and FIRM_ID IN (' . $ci->session->userdata('firm_id') . ')');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function today_booked_plot(){
	$ci = &get_instance();
    $ci->load->database();
    $date = date('Y-m-d');
	$query = $ci->db->query('SELECT count(*) as count from product_activation where ACTIVATION_DATE="'.$date.'" ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function available_plot(){
	$ci = &get_instance();
    $ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from finished_products where FINISHED_PROD_STATUS=1 and TRACK_STATUS=1');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


// function  money_format($str1,$str2){
// 	return	number_format($str2);
// }