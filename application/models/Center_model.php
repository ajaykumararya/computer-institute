<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Center_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function get_course($center_id){
        $get = $this->db->select('center_course_show')->where('id',$center_id)->get('centers');
        if($get->num_rows()){
            $row = $get->row();
            if($row->center_course_show !== NULL)
                return (array)json_decode($row->center_course_show);
        }
        return [];
    }
    
    function get_center_course_options($center_id,$selected = 0){
        $courses  = $this->get_course($center_id);
        $html = '<option value="">-Select Course-</option>';
        if(count($courses)){
            $get = $this->db->where_in('id',$courses)->get('courses');
            if($get->num_rows()){
                foreach($get->result() as $r){
                    $select = $selected == $r->id ? 'selected' :'';
                    $html .= '<option value="'.$r->id.'" '.$select.'>'.$r->course_name.'</option>';
                }
            }
        }
        return $html;
    }
    
    function assign_course($courses,$center){
        return $this->db->where('id',$center)->update('centers',['center_course_show' => json_encode($courses)]);
    }
    
    function open_balance($center){
        $get = $this->db->where('center_id',$center)->order_by('id','DESC')->limit(1)->get('wallet_transactions');
        if($get->num_rows())
            return $get->row()->c_balance;
        return 0;
    }
    
    function add_transaction($data){
        return $this->db->insert('wallet_transactions',$data);
    }
    function add_transaction_history($data){
        return $this->db->insert('wallet_load_history',$data);
    }
    function get_wallet($center){
        $get = $this->db->select('wallet')->where('id',$center)->get('centers');
        if($get->num_rows())
            return $get->row()->wallet;
        return 0;
    }
    function update_wallet($center,$wallet){
        return $this->db->update('centers',['wallet' => $wallet],['id' => $center]);
    }
    
    function collect_fee_by_duration($enroll,$course,$duration = 'all'){
        $where = ['enroll_no' => $enroll,'course_id' => $course];
        if($duration != 'all')
            $where['year'] = $duration;
            
        $g = $this->db->select('*,SUM(fee) as ttl_amount')->where($where)
                            ->group_by('enroll_no')
                        ->get('collect_fee');
        if($g->num_rows())
            return $g->row('ttl_amount');
        return 0;
    }
    
    function get_collection_transaction($course_id =0 ){
        
         $this->db->select('*,SUM(fee) as total')
                 ->from('collect_fee as fee');
                 if($course_id){
                     $this->db->join('courses as c','fee.course_id = c.id AND fee.center_id = '.$_SESSION['loginid'])
                     ->where('fee.course_id',$course_id);
                 }
                 else if($_SESSION['type'] == 2){
                     $this->db->where('fee.center_id',$_SESSION['loginid']);
                 }
        return $this->db ->get();
    }
    
    function get_transaction($center_id = 0){
        if($center_id)
            $this->db->where('center_id',$center_id);
        return $this->db->get('wallet_transactions');
    } 
    
    
    
}