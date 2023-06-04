<?php
class Common_model extends CI_Model {

    public function login($username,$password,$type)
    {
        if($type==1){
          
            $query  = $this->db->query('select * from admin_login where USER_NAME="'.$username.'" and ADMIN_PASSWORD="'.$password.'" and COMPANY_HRM_TYPE="'.$type.'" ');
        }elseif($type=2){
            $query = $this->db->query("SELECT * FROM centers where email_id = '".$username."' AND password = '".$password."' AND status = 1");
            
        }else{
            $query = $this->db->query("SELECT * FROM students where username = '".$username."' AND password = '".$password."' AND pay_status = 1");
            //return array('status' => 400,'message' => 'Invalid Login Credential');
        }
        $result= $query->result();
        
        //print_r($type);
        
        if(empty($result)){
            return array('status' => 400,'message' => 'Invalid Login Credential');
        } else {
           $last_login = date('Y-m-d H:i:s');
           $token = crypt(substr( md5(rand()), 0, 7),rand());
           $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
           $this->db->trans_start();
           if($type==1){
                $this->db->insert('users_authentication',array('HRM_ID' => $result[0]->ADMIN_ID,'TOKEN' => $token,'EXPIRED_AT' => $expired_at,'HRM_TYPE' => $type));
           }else if($type==2){
                $this->db->insert('users_authentication',array('HRM_ID' => $result[0]->id,'TOKEN' => $token,'EXPIRED_AT' => $expired_at,'HRM_TYPE' => $type));
           }else{
               $this->db->insert('users_authentication',array('HRM_ID' => $result[0]->id,'TOKEN' => $token,'EXPIRED_AT' => $expired_at,'HRM_TYPE' => $type));
           }
           if ($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('status' => 500,'message' => 'Internal server error.');
           } else {
              if($type==1){
                
                    $this->db->where('ADMIN_ID',$result[0]->ADMIN_ID)->update('admin_login',array('LAST_LOGIN' => $last_login));
                    $this->session->set_userdata('loginid',$result[0]->ADMIN_ID);
                   
                    $this->session->set_userdata('type','1'); /* for admin login */
                     $this->session->set_userdata('is_active','1');
                    $this->session->set_userdata('comp_id',$result[0]->COMPANY_ID);
                    $this->session->set_userdata('firm_id',get_firms_by_company($result[0]->COMPANY_ID));
                   
              }elseif($type==2){
                
                    $this->db->where('USER_NAME',$result[0]->center_number)->update('admin_login',array('LAST_LOGIN' => $last_login));
                    $this->session->set_userdata('loginid',$result[0]->id);
                   
                    $this->session->set_userdata('type','2'); /* for admin login */
                     $this->session->set_userdata('is_active','1');
                    $this->session->set_userdata('comp_id',$result[0]->id);
                    $this->session->set_userdata('firm_id',get_firms_by_company($result[0]->id));
                   
              }else{
                    
                    //$this->db->where('ADMIN_ID',$result[0]->ADMIN_ID)->update('admin_login',array('LAST_LOGIN' => $last_login));
                    $this->session->set_userdata('loginid',$result[0]->id);
                   
                    $this->session->set_userdata('type','3'); /* for admin login */
                     $this->session->set_userdata('is_active','1');
                    $this->session->set_userdata('comp_id',$result[0]->id);
                    $this->session->set_userdata('firm_id',$result[0]->id);
                    
                    
              }
              // else if($type==3 || $type==4){
              //      $this->session->set_userdata('loginid',$result[0]->HRM_ID);
              //      $this->session->set_userdata('type',$result[0]->COMPANY_ID); /* for member login */
              //       $this->session->set_userdata('is_active','1');
              //      $firmarr=get_comp_by_firm_id($result[0]->FIRM_ID);
              //      $this->session->set_userdata('comp_id',$firmarr[0]->COMPANY_ID);
              //      $this->session->set_userdata('firm_id',$result[0]->FIRM_ID);
              //      $this->session->set_userdata('is_active','1');
              // }
              $this->session->set_userdata('token',$token); 
              $this->db->trans_commit();
              if($type==1){
                return array('status' => 200,'message' => 'ok','id' => $result[0]->ADMIN_ID, 'token' => $token);
              }else if($type==2){
                return array('status' => 200,'message' => 'ok','id' => $result[0]->id, 'token' => $token);
              }
           }
            
        }
    }
    
    
    
    public function login_web($username,$password,$type)
    {
        
        if($type==3){
            //   unset($_SESSION);
            $query  = $this->db->query('select * from students where username="'.$username.'" and password="'.$password.'"  AND pay_status = 1');
            // die(var_dump('select * from user_registration where email="'.$username.'" and password="'.$password.'"'));
        }elseif($type==4){
            //   unset($_SESSION);
            $query  = $this->db->query('select * from students where username="'.$username.'" and password="'.$password.'"  AND pay_status = 1');
            // die(var_dump('select * from user_registration where email="'.$username.'" and password="'.$password.'"'));
        }elseif($type==5){
            $query  = $this->db->query('select * from students where username="'.$username.'" and password="'.$password.'"  ');
            
            //echo $type;
        }else{
            return array('status' => 400,'message' => 'Invalid Login Credential');
        }
        $result= $query->result();
       
       //print_r($result);
       
        if(empty($result)){
            return array('status' => 400,'message' => 'Invalid Login Credential');
        } else {
           $last_login = date('Y-m-d H:i:s');
           $token = crypt(substr( md5(rand()), 0, 7),rand());
           $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
           $this->db->trans_start();
           if($type==3){
                $this->db->insert('users_authentication',array('HRM_ID' => $result[0]->id,'TOKEN' => $token,'EXPIRED_AT' => $expired_at,'HRM_TYPE' => $type));
           }elseif($type==4){
               $this->db->insert('users_authentication',array('HRM_ID' => $result[0]->id,'TOKEN' => $token,'EXPIRED_AT' => $expired_at,'HRM_TYPE' => $type));
           }elseif($type==5){
               $this->db->insert('users_authentication',array('HRM_ID' => $result[0]->id,'TOKEN' => $token,'EXPIRED_AT' => $expired_at,'HRM_TYPE' => $type));
           }
           if ($this->db->trans_status() === FALSE){
              $this->db->trans_rollback();
              return array('status' => 500,'message' => 'Internal server error.');
           } else {
              if($type==3){
                    
                    $this->session->set_userdata('userid',$result[0]->id);
                    $this->session->set_userdata('type','4'); /* for admin login */
                     $this->session->set_userdata('useractive','1');
                    
                   
              }elseif($type==4){
                   $this->session->set_userdata('userid',$result[0]->id);
                    $this->session->set_userdata('type','5'); /* for admin login */
                     $this->session->set_userdata('useractive','1');
                    
              }elseif($type==5){
                   $this->session->set_userdata('userid',$result[0]->id);
                    $this->session->set_userdata('type','5'); /* for admin login */
                     $this->session->set_userdata('useractive','1');
                    
              }
              
              $this->session->set_userdata('token',$token); 
              $this->db->trans_commit();
              if($type==3){
                return array('status' => 200,'message' => 'ok','id' => $result[0]->id, 'token' => $token);
              }elseif($type==4){          
                  return array('status' => 200,'message' => 'ok','id' => $result[0]->id, 'token' => $token);
              }elseif($type==5){          
                  return array('status' => 200,'message' => 'ok','id' => $result[0]->id, 'token' => $token);
              }
               
           }
            
        }
    }
    
    
    
    
    
    public function get_shipping_list()
    {
       $this->load->database();
       $this->db->select('create_shipping.*,shipping_details.*');
       $this->db->from('create_shipping');
       $this->db->join('shipping_details','create_shipping.SHIPPING_ID = shipping_details.CREATE_SHIPPING_ID','inner');
       return $this->db->get();
     }
   
     public function book_shipment_alert($alert =0)
    {
       $this->load->database();
       
            $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID  and timeline.TASK_NAME = 'PRE_20' where DATEDIFF(ship.DATE,CURDATE())<=20 and DATEDIFF(ship.DATE,CURDATE())>0 and stts.PRE_20 = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
         return  $this->db->query($color);
          // echo  $this->db->last_query(); exit();
        // $this->load->database();
       
        // $this->db->query("SELECT * FROM `create_shipping` AS ship inner JOIN shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID WHERE DATEDIFF(DATE, CURDATE())<=20 AND DATEDIFF(DATE,CURDATE())> 0 and stts.PRE_20 = 'off'");
    }

    public function bring_container_in_fac_alert($alert=0)
    {
      
        $this->load->database();
       
            $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID and timeline.TASK_NAME = 'PRE_10' where DATEDIFF(ship.DATE,CURDATE())<=10 and DATEDIFF(ship.DATE,CURDATE())>0 and stts.PRE_10 = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
         return  $this->db->query($color);
          // echo  $this->db->last_query(); exit();
    }
    public function ask_debit_note_of_forwarder($alert=0)
    {
      $this->load->database();
       
        $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID AND timeline.TASK_NAME = 'POST_7' where DATEDIFF(CURDATE(),ship.DATE) = 7 and stts.POST_7 = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
          return $this->db->query($color);
             // $this->db->last_query(); exit();
    }
     public function sent_docs_to_buyer_for_collection($alert=0)
    {
        $this->load->database();       
        $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID AND timeline.TASK_NAME = 'POST_11' where DATEDIFF(CURDATE(),ship.DATE) = 11 and stts.POST_11 = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
        return $this->db->query($color); 
    }
    public function payment_receive_checkup_alert($alert=0)
    {
     $this->load->database();
       
        $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID and timeline.TASK_NAME = 'POST_21_PAYMENT' where DATEDIFF(CURDATE(),ship.DATE) = 21 and stts.POST_21_PAYMENT = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
        return $this->db->query($color);
    
    }
    public function make_brc_alert($alert=0)
    {
      $this->load->database();
       
        $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left JOIN shipping_details as details on ship.SHIPPING_ID = details.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID and timeline.TASK_NAME = 'POST_3_BRC_MAKE' where DATEDIFF(CURDATE(),details.DBK_DATE) = 3 and stts.POST_3_BRC_MAKE = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
          return $this->db->query($color);
           // echo $this->db->last_query(); exit();

    }
    public function brc_alert($alert=0)
    {
     $this->load->database();
       
        $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left JOIN shipping_details as details on ship.SHIPPING_ID = details.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID and timeline.TASK_NAME = 'POST_14_BRC' where DATEDIFF(CURDATE(),details.BRC_SUBMIT_DATE) = 14 and stts.POST_14_BRC = 'off' GROUP by ship.SHIPPING_ID";

        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
         return $this->db->query($color);
           // echo $this->db->last_query(); exit();
    }
    public function drawback_alert($alert=0)
    {
      $this->load->database();
       
        $color= "SELECT *, MAX(timeline.ALERT_DATE) as latest_date from create_shipping as ship left join shipping_status as stts on ship.SHIPPING_ID = stts.CREATE_SHIPPING_ID left JOIN shipping_details as details on ship.SHIPPING_ID = details.CREATE_SHIPPING_ID left join alert_timeline as timeline on ship.SHIPPING_ID=timeline.CREATE_SHIPPING_ID and timeline.TASK_NAME = 'POST_7_BRC' where DATEDIFF(CURDATE(),details.BRC_SUBMIT_DATE) = 7 and stts.POST_7_BRC = 'off' GROUP by ship.SHIPPING_ID";
        
        if($alert)
          $color.=" HAVING latest_date <= CURDATE() or latest_date is NULL";
           return $this->db->query($color);
           // echo $this->db->last_query(); exit();
    }
    
     public function get_shipping_status()
    {
       $this->load->database();
       $this->db->select('create_shipping.*,shipping_status.*');
       $this->db->from('create_shipping');
       $this->db->join('shipping_status','create_shipping.SHIPPING_ID = shipping_status.CREATE_SHIPPING_ID','inner');
       return $this->db->get();
    }
   
    public function get_agent()
    { 
      $this->load->database();
      return $this->db->get('agent');
    }
    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $type     = $this->input->get_request_header('type', TRUE);
        $this->db->where('HRM_ID',$users_id)->where('TOKEN',$token)->where('HRM_TYPE',$type)->delete('users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }
	 
}
?>