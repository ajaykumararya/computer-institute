<?php
class Authentication_model extends CI_Model {

    var $client_service = "frontend-client";
    var $auth_key       = "simplerestapi";
    public function check_auth_client()
	{
		$client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            
            return json_output(401,array('status' => 401,'message' => 'Unauthorized'));
        }
	}
	public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        //$token = $this->input->get_request_header('Authorization', TRUE);
        $token = $this->session->userdata('token');
        $type = $this->input->get_request_header('type', TRUE);
        $q  = $this->db->select('EXPIRED_AT')->from('users_authentication')->where('HRM_ID',$users_id)->where('TOKEN',$token)->where('HRM_TYPE',$type)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->EXPIRED_AT < date('Y-m-d H:i:s')){
                return array('status' => 303,'message' => 'Your session has been expired.');
            }else{
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('HRM_ID',$users_id)->where('TOKEN',$token)->where('HRM_TYPE',$type)->update('users_authentication',array('EXPIRED_AT' => $expired_at,'UPDATED_AT' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }
    
	 
}
?>