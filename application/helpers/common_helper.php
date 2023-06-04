<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

{

function get_admission_type($type = 0){
    if($type){
        return ('<br> <span class="label label-success arrowed">'.config_item(config_item('admission_types')[$type]).'</span>');
    }
    return 'ss';
}
function issetData($index,$array = 0,$default = ''){
    if($array == 0)
        $array = $_POST;
    return isset($array[$index]) ? $array[$index] : $default;
}
function getCourseType($i,$type = 'year'){
    if($i==1){
          $st='st ';
          
    }elseif($i==2){
          $st='nd ';
    }elseif($i==3){
          $st='rd ';
    }else{
          $st='th ';
    }
    return $i.$st.$type;
}

function lowKey($key, $flg = false){
    
    $CI = &get_instance();
    $CI->load->library(['encrypt']);
    if($flg)
        return $CI->encrypt->decode(str_replace('A_J','/',$key));
        
    return str_replace('/','A_J',$CI->encrypt->encode($key) );
    
}

function highKey($key, $flg = false){
    
    $CI = get_instance();
    if($flg)
        return $CI->encryption->decrypt(str_replace('/','A_J',$key));
        
    return str_replace('/','A_J',$CI->encryption->encrypt($key) );
}

function AJ_ENCODE($id,$key=0){
 
    return str_replace('=','',lowKey($id));
}

function AJ_DECODE($id,$key=0){
    return lowKey($id,true);
}


function getDurationName($number = 1,$type = 'year',$singlur  = true,$inRoman = false){
    // exit(is_string($type));
    $types = ['','Month','Year','Semester'];
    
    $type = (array_key_exists($type,$types)) ? $types[$type] : $type;
    
    // $type = (in_array($type,[1,2,3]))
    //                 ? ( ($type == '1') ? 'Month' : ( $type == 2) ? 'Year' : 'Semester')
    //                 : $type;
                    
                    // exit($type);
    $string  = ($inRoman ? numberToRomanRepresentation($number) : $number ) .' '.$type;
    return $string . ( ($number > 1 AND !$singlur) ? 's' : '');
}

function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
        foreach ($map as $roman => $int) {
            if($number >= $int) {
                $number -= $int;
                $returnValue .= $roman;
                break;
            }
        }
    }
    return $returnValue;
}
function numberTowords1($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
1 => "ten",
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
} 

function get_district($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from district where STATE_ID='" . $id . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}


function get_district_by_id($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from district where DISTRICT_ID='" . $id . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}
function get_user_type($id,$password)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from user_registration where email='" . $id . "' and password='" . $password . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
// 	die(var_dump("select * from user_registration where id='" . $id . "' and password='" . $password . "'"));
// 	die(var_dump($row));
if (!empty($row)) {
		return $row[0]->type;
	} else {
		return '';
	}
// 	return $row->type;
	
}

function get_state_by_id($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from state where STATE_ID='" . $id . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
		return $row[0]->STATE_NAME;
	} else {
		return '';
	}
}
function get_city($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from district where STATE_ID='" . $id . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
// 		return $row[0]->city_name;
        return $row;
	} else {
		return '';
	}
}


function random_color_part() {

    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);

}



function random_color() {

    return random_color_part() . random_color_part() . random_color_part();

}

function allsite()

{

	$ci = &get_instance();

	$ci->load->database();



	$query = $ci->db->query('SELECT * from `product_division` pd LEFT JOIN  purchased_product pp on pp.PURC_PROD_ID=pd.PURC_PROD_ID order by pd.PROD_DIVISION_ID ASC');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function get_mode_name($id)

{

	if ($id == 0) {

		return "Percentage";

	} else {

		return "Flat";

	}

}

function get_act_inact_name($id)

{

	if ($id == 1) {

		return "Active";

	} else {

		return "Inactive";

	}

}

function get_emi_ref_in_acc($emiid,$firmid){

    $ci = &get_instance();

	$ci->load->database();

	$sale_id=get_ledger_id("Sale_".$firmid);

	$sql = "select * from accounts where REFRENCE='" . $emiid . "' and HRM_TYPE_ID=4 and CR_ID='".$sale_id."'";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}

function get_act_inact_name_for_prod_const($id)

{

	if ($id == 0) {

		return "Inactive";

	} else if ($id == 1) {

		return "Active";

	} else {

		return "discarded";

	}

}

function get_branch($firmid)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from branch where FIRM_ID='" . $firmid . "'";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}

function get_rank($firmid)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "SELECT * from rank where FIRM_ID='" . $firmid . "' AND RANK_STATUS=1 ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}





function get_religion()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from hrm_religion";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row;

	} else {

		return '';

	}

}





function update_pass_hrms($hrm_id, $key, $pass)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "update `hrm_post` set " . $key . "='" . $pass . "' where HRM_ID='" . $hrm_id . "'";

	$query = $ci->db->query($sql);

}





function get_all_states()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from state";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row;

	} else {

		return '';

	}

}

function get_city_name_by_id($districtname)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from district where DISTRICT_NAME='" . $districtname . "'";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row[0]->DISTRICT_ID;

	} else {

		return '';

	}

}

function get_city_by_id($cityid)

{

	$ci = &get_instance();

	$ci->load->database();

	$city_nm = $ci->db->query('select * from district where DISTRICT_ID="' . $cityid . '"');

	$city_name = $city_nm->result();

	if (!empty($city_name)) {

		return $city_name[0]->DISTRICT_NAME;

	} else {

		return '';

	}

}

function get_firms_by_id()

{

	$ci = &get_instance();

	$ci->load->database();

	if($ci->session->userdata('firm_id')!=''){

    	$sql = "select * from firm where FIRM_ID IN (" . $ci->session->userdata('firm_id') . ")";

    	$query = $ci->db->query($sql);

    	$row = $query->result();

    	if (!empty($row)) {

    		return $row;

    	} else {

    		return '';

    	}

	}else{

	    return '';

	}

}





function get_firms_by_company($id)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from firm where COMPANY_ID='" . $id . "'";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row;

	} else {

		return '';

	}

}



function get_comp_short_name($hrmtype)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query("select * from comp_short_code where COMPANY_ID='" . $ci->session->userdata('comp_id') . "' and HRM_TYPE_ID='" . $hrmtype . "'");

	$row = $query->result();

	if (!empty($row)) {

		return $row[0]->COMP_PREFIX;

	} else {

		return 0;

	}

}

function get_all_hrm_by_type($hrmtype)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->select("*")->from('hrm')

		->where('HRM_TYPE_ID', $hrmtype)

		->get()->result();

	return $query;

}

function get_last_reg_no($hrm_type_id,$firmid)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query("SELECT * FROM hrm where HRM_TYPE_ID='" . $hrm_type_id . "' and FIRM_ID='".$firmid."' ORDER BY HRM_ID DESC LIMIT 1");

	$row = $query->result();

	if (!empty($row)) {

		return $row[0]->HRM_REG_NO;

	} else {

		return 0;

	}

}



function insert_activity($userid, $remarks)

{

	$ci = &get_instance();

	$ci->load->database();



	$sql = "INSERT INTO `activity_history`(`USER_ID`, `IP_ADDRESS`, `REMARKS`) VALUES ('" . $userid . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $remarks . "')";

	$query = $ci->db->query($sql);



	if (!empty($query)) {

		return $ci->db->insert_id();

	} else {

		return '';

	}

}

function get_all_activity()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "Select * from activity_history";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row;

	} else {

		return '';

	}

}



function insert_activity_history($activity_type,$for_hrm)

{

	$ci = &get_instance();

	$ci->load->database();

	$date = date('Y-m-d H:i:s');

	$data = array(

		'HRM_ID' => $ci->session->userdata('loginid'),

		'HRM_TYPE' => $ci->session->userdata('type'),

		'ACTIVITY_TYPE_ID' => $activity_type,

		'ACTIVITY_IP' => $_SERVER['REMOTE_ADDR'],

		'ACTIVITY_TIME' => $date,

		'FOR_HRM_ID' => $for_hrm

	);

	$ci->db->insert('activity_history', $data);

	return $ci->db->insert_id();

}

function count_all_activity_history()

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `activity_history` act_h LEFT JOIN `hrm_type` hrm on act_h.HRM_TYPE=hrm.HRM_TYPE_ID LEFT JOIN `activity_type` act_type on act_h.ACTIVITY_TYPE_ID=act_type.ACTIVITY_TYPE_ID');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}



function all_activity_history($limit, $start, $order, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `activity_history` act_h LEFT JOIN hrm_type hrm on act_h.HRM_TYPE=hrm.HRM_TYPE_ID LEFT JOIN `activity_type` act_type on act_h.ACTIVITY_TYPE_ID=act_type.ACTIVITY_TYPE_ID ORDER BY act_h.ACITIVITY_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}



function activity_history_search($limit, $start, $search, $col, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `activity_history` act_h LEFT JOIN `hrm_type` hrm on act_h.HRM_TYPE=hrm.HRM_TYPE_ID LEFT JOIN `activity_type` act_type on act_h.ACTIVITY_TYPE_ID=act_type.ACTIVITY_TYPE_ID where (  hrm.HRM_TYPE_NAME LIKE "' . $search . '%" OR act_type.ACTIVITY_TYPE_NAME LIKE "' . $search . '") ORDER BY act_h.ACITIVITY_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function activity_history_search_count($search)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `activity_history` act_h LEFT JOIN `hrm_type` hrm on act_h.HRM_TYPE=hrm.HRM_TYPE_ID LEFT JOIN `activity_type` act_type on act_h.ACTIVITY_TYPE_ID=act_type.ACTIVITY_TYPE_ID where (  hrm.HRM_TYPE_NAME LIKE "' . $search . '%" OR act_type.ACTIVITY_TYPE_NAME LIKE "' . $search . '") ORDER BY act_h.ACITIVITY_ID ASC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}



/*---------------- game start ---------------------*/

function check_data_exits($database)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from ".$database." ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row[0];

	} else {

		return '0';

	}

}



function check_data_exits_status_by_id($database,$fieldname,$id)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from ".$database." where ".$fieldname."=".$id." ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	if (!empty($row)) {

		return $row[0];

	} else {

		return '0';

	}

}







function count_all_volunteer($status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `volunteer` where VOL_STATUS="'.$status.'"');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_volunteer($limit, $start, $order, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `volunteer` where VOL_STATUS="'.$status.'" ORDER BY VOL_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function volunteer_search($limit, $start, $search, $col, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `volunteer`  where ( VOL_NAME LIKE "' . $search . '%" OR VOL_EMAIL LIKE "' . $search . '%" OR  VOL_PHONE LIKE "' . $search . '%" OR VOL_MESSAGE LIKE "' . $search . '%"  ) AND VOL_STATUS="'.$status.'" ORDER BY VOL_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function volunteer_search_count($search,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `volunteer` where (   VOL_NAME LIKE "' . $search . '%" OR VOL_EMAIL LIKE "' . $search . '%" OR VOL_PHONE LIKE "' . $search . '%" OR VOL_MESSAGE LIKE "' . $search . '%"  ) AND VOL_STATUS="'.$status.'" ORDER BY VOL_ID DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}
// vision
function count_all_vision()

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `vision`');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_vision($limit, $start, $order, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `vision` ORDER BY VISION_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function vision_search($limit, $start, $search, $col, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `vision`  where ( VISION_TITLE LIKE "' . $search . '%" OR VISION_DESCRIPTION LIKE "' . $search . '%") ORDER BY VISION_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function vision_search_count($search)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `vision` where (   VISION_TITLE LIKE "' . $search . '%" OR VISION_DESCRIPTION LIKE "' . $search . '%") ORDER BY VISION_ID DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}





// features list

function count_all_features_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `our_features`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_features_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `our_features`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function features_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `our_features` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function features_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `our_features` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function count_all_feedback($status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `feedback`');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_feedback($limit, $start, $order, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `feedback`  ORDER BY FEEDBACK_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function feedback_search($limit, $start, $search, $col, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `feedback`  where ( FB_PER_NAME LIKE "' . $search . '%" OR FB_COMMENT LIKE "' . $search . '%" )  ORDER BY FEEDBACK_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function feedback_search_count($search,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `feedback` where (  FB_PER_NAME LIKE "' . $search . '%" OR FB_COMMENT LIKE "' . $search . '%"  )  ORDER BY FEEDBACK_ID DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}









function count_all_blog($page_name)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `blogs`where PAGE_NAME="'.$page_name.'"');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

function all_blog($limit, $start, $order, $dir,$page_name)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `blogs`where PAGE_NAME="'.$page_name.'"  ORDER BY BLOG_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function blog_search($limit, $start, $search, $col, $dir,$page_name)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `blogs`  where ( BLOG_TITLE LIKE "' . $search . '%" OR BLOG_DESC LIKE "' . $search . '%" ) AND PAGE_NAME="'.$page_name.'"  ORDER BY BLOG_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function blog_search_count($search,$page_name)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `blogs` where (  BLOG_TITLE LIKE "' . $search . '%" OR BLOG_DESC LIKE "' . $search . '%"  ) AND PAGE_NAME="'.$page_name.'"  ORDER BY BLOG_ID DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


// slider details

function count_all_slider_details()

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `slider_details`');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_slider_details($limit, $start, $order, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `slider_details` ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function slider_details_search($limit, $start, $search, $col, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `slider_details`  where ( rs_id LIKE "' . $search . '%" OR slider_image LIKE "' . $search . '%" title LIKE "' . $search . '%" discription1 LIKE "' . $search . '%" button_label LIKE "' . $search . '%" discription2 LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function slider_details_search_count($search)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `slider_details` where (   rs_id LIKE "' . $search . '%" OR slider_image LIKE "' . $search . '%" title LIKE "' . $search . '%" discription1 LIKE "' . $search . '%" button_label LIKE "' . $search . '%" discription2 LIKE "' . $search . '%") ORDER BY id DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}
// end slider details
// causes details

function count_all_causes_details()

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `causes`');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_causes_details($limit, $start, $order, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `causes` ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function causes_details_search($limit, $start, $search, $col, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `causes`  where ( causes LIKE "' . $search . '%" OR cause_title LIKE "' . $search . '%" cause_desc LIKE "' . $search . '%" raised LIKE "' . $search . '%" goal LIKE "' . $search . '%" button_name LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function causes_details_search_count($search)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `slider_details` where (   causes LIKE "' . $search . '%" OR cause_title LIKE "' . $search . '%" cause_desc LIKE "' . $search . '%" raised LIKE "' . $search . '%" goal LIKE "' . $search . '%" button_name LIKE "' . $search . '%") ORDER BY id DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}
// end slider details


function get_all_vision($id)

{

	if ($id == 'all') {

		$ci = &get_instance();

		$ci->load->database();

		$sql = "select * from vision";

		$query = $ci->db->query($sql);

		$row = $query->result();

		return $row;

	}else{

		$ci = &get_instance();

		$ci->load->database();

		$sql = "select * from vision where VISION_ID='" . $id . "'";

		$query = $ci->db->query($sql);

		$row = $query->result();

		return $row;

	}



	

}









function count_all_question($status,$code)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `fquestion` WHERE PAGE_MENU_CODE="'.$code.'"');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_question($limit, $start, $order, $dir,$status,$code)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `fquestion` where  PAGE_MENU_CODE="'.$code.'"  ORDER BY FQUESTION_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function question_search($limit, $start, $search, $col, $dir,$status,$code)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `fquestion`  where ( FQUESTION LIKE "' . $search . '%" OR FANSWER LIKE "' . $search . '%" ) AND  PAGE_MENU_CODE="'.$code.'"  ORDER BY FQUESTION_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function question_search_count($search,$status,$code)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `fquestion` where (  FQUESTION LIKE "' . $search . '%" OR FANSWER LIKE "' . $search . '%"  ) AND  PAGE_MENU_CODE="'.$code.'"  ORDER BY FQUESTION_ID DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}









function count_all_member($status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `member_list` ml LEFT JOIN state s on s.STATE_ID=ml.MEMBER_STATE LEFT JOIN district d on d.DISTRICT_ID=s.STATE_ID');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_member($limit, $start, $order, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `member_list` ml LEFT JOIN state s on s.STATE_ID=ml.MEMBER_STATE LEFT JOIN district d on d.DISTRICT_ID=s.STATE_ID  ORDER BY ml.MEMBER_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function member_search($limit, $start, $search, $col, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `member_list` ml LEFT JOIN state s on s.STATE_ID=ml.MEMBER_STATE LEFT JOIN district d on d.DISTRICT_ID=s.STATE_ID  where ( ml.MEMBER_NAME LIKE "' . $search . '%" OR ml.MEMBER_CONTACT LIKE "' . $search . '%" OR ml.MEMBER_ADDRESS LIKE "' . $search . '%" OR ml.MEMBER_POST LIKE "' . $search . '%" OR s.STATE_NAME LIKE "' . $search . '%" OR d.DISTRICT_NAME LIKE "' . $search . '%" )  ORDER BY MEMBER_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function member_search_count($search,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `member_list` ml LEFT JOIN state s on s.STATE_ID=ml.MEMBER_STATE LEFT JOIN district d on d.DISTRICT_ID=s.STATE_ID  where ( ml.MEMBER_NAME LIKE "' . $search . '%" OR ml.MEMBER_CONTACT LIKE "' . $search . '%" OR ml.MEMBER_ADDRESS LIKE "' . $search . '%" OR ml.MEMBER_POST LIKE "' . $search . '%" OR s.STATE_NAME LIKE "' . $search . '%" OR d.DISTRICT_NAME LIKE "' . $search . '%" )  ORDER BY MEMBER_ID DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}


// all results
function count_all_result($center)
{
	$ci = &get_instance();
	$ci->load->database();
		if($center == 'all'){
        $query = $ci->db->query('SELECT count(*) as count FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year ) LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch ');	    
	}else{
	    $query = $ci->db->query('SELECT count(*) as count FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch where students.center_id="'.$center.'" ');  
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

function all_result($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
     	$query = $ci->db->query('SELECT results.id AS RESULT_ID, admit_card.roll_no AS ROLL_NO,results.enrollment_no AS ENROLLMENT_NO, results.result AS RESULT,courses.type AS COURSE_TYPE, courses.duration AS MONTH_DURATION,courses.years AS YEAR_DURATION,courses.course_name AS COURSE_NAME,courses.course_code AS COURSE_CODE,centers.center_number AS CENTER_NUMBER,centers.institute_name AS CENTER_NAME,students.name AS STUDENT_NAME,results.year AS PASSING_YEAR,batch_session.BATCH_NAME AS BATCH_NAME FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch  ORDER BY results.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	  	$query = $ci->db->query('SELECT results.id AS RESULT_ID, admit_card.roll_no AS ROLL_NO,results.enrollment_no AS ENROLLMENT_NO, results.result AS RESULT,courses.type AS COURSE_TYPE, courses.duration AS MONTH_DURATION,courses.years AS YEAR_DURATION,courses.course_name AS COURSE_NAME,courses.course_code AS COURSE_CODE,centers.center_number AS CENTER_NUMBER,centers.institute_name AS CENTER_NAME,students.name AS STUDENT_NAME,results.year AS PASSING_YEAR,batch_session.BATCH_NAME AS BATCH_NAME FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch where students.center_id="'.$center.'"  ORDER BY results.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function all_result_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
     $query = $ci->db->query('SELECT results.id AS RESULT_ID, admit_card.roll_no AS ROLL_NO,results.enrollment_no AS ENROLLMENT_NO,batch_session.BATCH_NAME AS BATCH_NAME, results.result AS RESULT,courses.type AS COURSE_TYPE, courses.duration AS MONTH_DURATION,courses.years AS YEAR_DURATION,courses.course_name AS COURSE_NAME,courses.course_code AS COURSE_CODE,centers.center_number AS CENTER_NUMBER,centers.institute_name AS CENTER_NAME,students.name AS STUDENT_NAME,results.year AS PASSING_YEAR FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch  where (students.name LIKE "' . $search . '%" OR results.roll_no LIKE "' . $search . '%" OR students.enrollment_no LIKE "' . $search . '%" OR admit_card.roll_no LIKE "' . $search . '%" OR courses.course_name  LIKE "' . $search . '%" OR courses.course_code  LIKE "' . $search . '%"  OR batch_session.BATCH_NAME  LIKE "' . $search . '%" OR centers.center_number  LIKE "' . $search . '%" OR centers.institute_name  LIKE "' . $search . '%")   ORDER BY results.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	    $query = $ci->db->query('SELECT results.id AS RESULT_ID, admit_card.roll_no AS ROLL_NO,results.enrollment_no AS ENROLLMENT_NO, results.result AS RESULT,courses.type AS COURSE_TYPE, courses.duration AS MONTH_DURATION,courses.years AS YEAR_DURATION,courses.course_name AS COURSE_NAME,courses.course_code AS COURSE_CODE,centers.center_number AS CENTER_NUMBER,centers.institute_name AS CENTER_NAME,students.name AS STUDENT_NAME,results.year AS PASSING_YEAR,batch_session.BATCH_NAME AS BATCH_NAME FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) LEFT JOIN batch_session ON batch_session.BATCH_ID=students.Batch where (students.name LIKE "' . $search . '%" OR results.roll_no LIKE "' . $search . '%" OR students.enrollment_no LIKE "' . $search . '%" OR admit_card.roll_no LIKE "' . $search . '%" OR courses.course_name  LIKE "' . $search . '%" OR courses.course_code  LIKE "' . $search . '%" OR batch_session.BATCH_NAME  LIKE "' . $search . '%" OR centers.center_number  LIKE "' . $search . '%" OR centers.institute_name  LIKE "' . $search . '%"  ) and students.center_id="'.$center.'"  ORDER BY results.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	  	// $query = $ci->db->query('SELECT r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no where r.center_id="'.$center.'"  ORDER BY r.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function all_result_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
     $query = $ci->db->query('SELECT count(*) as count FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) where ( results.roll_no LIKE "' . $search . '%" OR students.enrollment_no LIKE "' . $search . '%"  )   ORDER BY results.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count FROM results LEFT JOIN courses ON courses.id=results.course_id LEFT JOIN centers ON centers.id=results.center_id LEFT JOIN students ON students.enrollment_no=results.enrollment_no LEFT JOIN district ON district.DISTRICT_ID=students.distric LEFT JOIN admit_card ON (admit_card.enrollment_no=results.enrollment_no AND admit_card.course_id=results.course_id AND admit_card.year=results.year) where ( results.roll_no LIKE "' . $search . '%" OR students.enrollment_no LIKE "' . $search . '%"  ) and students.center_id="'.$center.'"  ORDER BY results.id DESC');
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


// all generate_certificate
function count_all_generate_certificate_list($center)

{

	$ci = &get_instance();

	$ci->load->database();
	if($center == 'all'){
        $query = $ci->db->query('SELECT count(*) as count FROM `results` r  left join courses c on c.id=r.course_id left join students st on st.enrollment_no=r.enrollment_no ');	    
	}else{
	    $query = $ci->db->query('SELECT count(*) as count FROM `results` r  left join courses c on c.id=r.course_id left join students st on st.enrollment_no=r.enrollment_no where st.center_id="'.$center.'" ');  
	}


// 	$query = $ci->db->query('SELECT count(*) as count FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_generate_certificate_list($limit, $start, $order, $dir,$center)

{

	$ci = &get_instance();
// die(var_dump($center));
	$ci->load->database();
	if($center == 'all'){
     	$query = $ci->db->query('SELECT *,r.status as status,st.id as student_id,r.year as year,c.type as ctype, r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,c.course_name,c.duration FROM `results` r  left join courses c on c.id=r.course_id left join students st on st.enrollment_no=r.enrollment_no  ORDER BY r.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
        // die(var_dump('SELECT *, r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,c.course_name,c.duration FROM `results` r  left join courses c on c.id=r.course_id left join students st on st.enrollment_no=r.enrollment_no'));
	}else{
	  	$query = $ci->db->query('SELECT *,r.status as status,c.type as ctype,st.id as student_id, r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,c.course_name,c.duration FROM `results` r  left join courses c on c.id=r.course_id left join students st on st.enrollment_no=r.enrollment_no where st.center_id='.$center.'  ORDER BY r.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}


    //print_r($query);


	if ($query->num_rows() > 0) {

		return $query->result();
    
	} else {

		return null;

	}

}

function generate_certificate_list_search($limit, $start, $search, $col, $dir,$center)

{

	$ci = &get_instance();

	$ci->load->database();
		if($center == 'all'){
     $query = $ci->db->query('SELECT  r.id as result_id,st.id as student_id,c.type as ctype,r.status as status,r.timestamp,st.name, r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration,r.year as year FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where ( r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR c.duration LIKE "' . $search . '%" )  ORDER BY r.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	    $query = $ci->db->query('SELECT ,r.status as status, r.id as result_id,c.type as ctype,st.id as student_id,r.status as status,r.timestamp,st.name, r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration,r.year as year FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where ( r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR c.duration LIKE "' . $search . '%" ) and st.center_id='.$center.' ORDER BY r.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	  	// $query = $ci->db->query('SELECT r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no where r.center_id="'.$center.'"  ORDER BY r.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}


// 	$query = $ci->db->query('SELECT  r.id as result_id,r.timestamp,st.name, r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where ( r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR d.duration LIKE "' . $search . '%" )  ORDER BY r.id DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function generate_certificate_list_search_count($search,$center)

{

	$ci = &get_instance();

	$ci->load->database();


    	if($center == 'all'){
     $query = $ci->db->query('SELECT count(*) as count FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where (r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR c.duration LIKE "' . $search . '%" )  ORDER BY r.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where (r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR c.duration LIKE "' . $search . '%" )  and st.center_id="'.$center.'"  ORDER BY r.id DESC');
	   // $query = $ci->db->query('SELECT  r.id as result_id,r.timestamp,st.name, r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where ( r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR d.duration LIKE "' . $search . '%" ) and r.center_id="'.$center.'" ORDER BY r.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	  	// $query = $ci->db->query('SELECT r.id as result_id,r.timestamp,st.name,r.roll_no as roll_no,r.course_id,r.enrollment_no,m.marks,m.subject_id,m.result_id,s.subject_name,s.min_marks,s.max_marks,c.course_name,c.duration FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no where r.center_id="'.$center.'"  ORDER BY r.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}
// 	$query = $ci->db->query('SELECT count(*) as count FROM `results` r left join marks_table m on r.id=m.result_id left join subjects s on s.id=m.subject_id left join courses c on c.id=s.course_id left join students st on st.enrollment_no=r.enrollment_no  where (r.roll_no LIKE "' . $search . '%" OR s.subject_name LIKE "' . $search . '%" OR r.enrollment_no LIKE "' . $search . '%" OR m.marks LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR d.duration LIKE "' . $search . '%" )  ORDER BY r.id DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}




function get_site_setting()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from site_setting";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}



function get_all_social_links()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from social_links";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}





function get_all_profile()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from profile";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}



function get_all_feedback()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from feedback where FB_STATUS=1";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}





function welcome_text()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from welcome_message";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}

function members_list()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from member_list where MEMBER_STATUS=1";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}


function get_all_aboutus()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from whyus";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}
function homepage_second_blog()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from whyus ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}



function blogs_list($page_name)

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from blogs where PAGE_NAME='".$page_name."' ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}

function vision_list()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from vision ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}

function faq_list()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from fquestion where FSTATUS=1 ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}

function events_list()

{

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from fquestion where FSTATUS=1 ";

	$query = $ci->db->query($sql);

	$row = $query->result();

	return $row;

}



function count_all_enquiry($status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `contact_us_form_list`');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_enquiry($limit, $start, $order, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `contact_us_form_list`  ORDER BY CONTACT_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function enquiry_search($limit, $start, $search, $col, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `contact_us_form_list`  where ( PERSON_NAME LIKE "' . $search . '%" OR PERSON_EMAIL LIKE "' . $search . '%" OR PERSON_SUBJECT LIKE "' . $search . '%" OR PERSON_COMMENT LIKE "' . $search . '%"  )  ORDER BY CONTACT_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function enquiry_search_count($search,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `contact_us_form_list`  where ( PERSON_NAME LIKE "' . $search . '%" OR PERSON_EMAIL LIKE "' . $search . '%" OR PERSON_SUBJECT LIKE "' . $search . '%" OR PERSON_COMMENT LIKE "' . $search . '%"  )  ORDER BY CONTACT_ID DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}
// admit card list
function count_all_admit_card($status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on ad.course_id=c.id');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_admit_card($limit, $start, $order, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT *,ad.year as year ,ad.id as card_id,s.name as name FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on ad.course_id=c.id  ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function admit_card_search($limit, $start, $search, $col, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on ad.course_id=c.id where ( ad.enrollment_no LIKE "' . $search . '%" OR ad.roll_no LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR s.name LIKE "' . $search . '%"  )  ORDER BY ad.id DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function admit_card_search_count($search,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on ad.course_id=c.id`  where ( ad.enrollment_no LIKE "' . $search . '%" OR ad.roll_no LIKE "' . $search . '%" OR c.course_name LIKE "' . $search . '%" OR s.name LIKE "' . $search . '%"  )  ORDER BY ad.id DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}
// subscriber


function count_all_subscriber()

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `subscription`');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_subscriber($limit, $start, $order, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM `subscription`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function subscriber_search($limit, $start, $search, $col, $dir)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from `subscription`  where ( email LIKE "' . $search . '%"  )  ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function subscriber_search_count($search)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `subscription`  where ( email LIKE "' . $search . '%")  ORDER BY id DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}
// add wallet



function count_all_wallet($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `admin_login` ad LEFT JOIN `my_wallet` wl on wl.login_id=ad.ADMIN_ID where ad.ADMIN_TYPE ="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_wallet($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `admin_login` ad LEFT JOIN `my_wallet` wl on wl.login_id=ad.ADMIN_ID where ad.ADMIN_TYPE="'.$agentid.'" ORDER BY ad.ADMIN_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `admin_login` ad LEFT JOIN `my_wallet` wl on wl.login_id=ad.ADMIN_ID  where ( ad.ADMIN_NAME LIKE "' . $search . '%") ORDER BY ad.ADMIN_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `admin_login` ad LEFT JOIN `my_wallet` wl on wl.login_id=ad.ADMIN_ID where (   ad.ADMIN_NAME LIKE "' . $search . '%" ) ORDER BY ad.ADMIN_ID DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// agent wallet request list
function count_all_agent_wallet_request()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `wallet_request` wl LEFT JOIN `admin_login` ad on wl.agent_id=ad.ADMIN_ID');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_agent_wallet_request($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `wallet_request` wl LEFT JOIN `admin_login` ad  on wl.agent_id=ad.ADMIN_ID ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function agent_wallet_request_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `wallet_request` wl LEFT JOIN `admin_login` ad  on wl.agent_id=ad.ADMIN_ID   where ( date LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function agent_wallet_request_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `wallet_request` wl LEFT JOIN `admin_login` ad  on wl.agent_id=ad.ADMIN_ID where (   date LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// accout statement
// agent wallet request list
function count_all_account_statement($from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `wallet_request` wl LEFT JOIN `admin_login` ad on wl.agent_id=ad.ADMIN_ID where wl.date between "'.$from.'" and "'.$to.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_account_statement($limit, $start, $order, $dir,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `wallet_request` wl LEFT JOIN `admin_login` ad  on wl.agent_id=ad.ADMIN_ID where wl.date between "'.$from.'" and "'.$to.'" ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function account_statement_search($limit, $start, $search, $col, $dir,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `wallet_request` wl LEFT JOIN `admin_login` ad  on wl.agent_id=ad.ADMIN_ID   where ( date LIKE "' . $search . '%") and wl.date between "'.$from.'" and "'.$to.'" ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function account_statement_search_count($search,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `wallet_request` wl LEFT JOIN `admin_login` ad  on wl.agent_id=ad.ADMIN_ID where (   date LIKE "' . $search . '%" ) and wl.date between "'.$from.'" and "'.$to.'" ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
//  wallet request



function count_all_wallet_request($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `wallet_request` where agent_id ="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_wallet_request($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `wallet_request` where agent_id ="'.$agentid.'" ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_request_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `wallet_request`  where ( date LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_request_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `wallet_request`  where (   date LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}
}
// add vedio




function count_all_vedio_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `videos`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_vedio_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `videos`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function vedio_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `videos`  where ( title LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function vedio_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `videos`  where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}
}

// add agent
function count_all_add_agent()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID where ad.ADMIN_TYPE=2');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_add_agent($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID  where ad.ADMIN_TYPE=2 ORDER BY ad.ADMIN_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function add_agent_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID where ( ad.ADMIN_NAME LIKE "' . $search . '%") and  ad.ADMIN_TYPE=2  ORDER BY ad.ADMIN_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function add_agent_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID where (   ad.DMIN_NAME LIKE "' . $search . '%" ) ORDER BY ad.ADMIN_ID DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// service list

function count_all_service_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_service_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT ad.form_menu , ad.form_fee ,ad.id as form_id, dp.dpt_name,ad.status from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function service_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department where ( ad.form_menu LIKE "' . $search . '%")   ORDER BY ad.id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function service_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department where (   ad.form_menu LIKE "' . $search . '%" ) ORDER BY ad.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// service list user
// service list user

function count_all_service_list_user($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department left join `admin_login` admin on admin.COMPANY_ID=ad.department where admin.ADMIN_ID="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_service_list_user($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT ad.form_menu , ad.form_fee ,ad.id as form_id, dp.dpt_name,ad.status from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department left join `admin_login` admin on admin.COMPANY_ID=ad.department where admin.ADMIN_ID="'.$agentid.'" ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function service_list_user_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department left join `admin_login` admin on admin.COMPANY_ID=ad.department where admin.ADMIN_ID="'.$agentid.'" where ( ad.form_menu LIKE "' . $search . '%") and admin.ADMIN_ID="'.$agentid.'"   ORDER BY ad.id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function service_list_user_search_count($search,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `form_fields_data` ad LEFT JOIN `department` dp on dp.id=ad.department left join `admin_login` admin on admin.COMPANY_ID=ad.department where (   ad.form_menu LIKE "' . $search . '%" ) ORDER BY ad.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
//  plan list
function count_all_plan_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `plan`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_plan_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `plan`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function plan_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `plan` where ( plan_name LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function plan_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `plan` where (   plan_name LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



// UPLOAD DOCUMENT



function count_all_upload_document($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `admin_login` ad LEFT JOIN `document` wl on wl.agent_id=ad.ADMIN_ID where ad.ADMIN_TYPE ="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_upload_document($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `admin_login` ad LEFT JOIN `document` wl on wl.agent_id=ad.ADMIN_ID where ad.ADMIN_TYPE="'.$agentid.'" ORDER BY ad.ADMIN_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function upload_document_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `admin_login` ad LEFT JOIN `document` wl on wl.agent_id=ad.ADMIN_ID  where ( ad.ADMIN_NAME LIKE "' . $search . '%") ORDER BY ad.ADMIN_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function upload_document_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `admin_login` ad LEFT JOIN `document` wl on wl.agent_id=ad.ADMIN_ID where (   ad.ADMIN_NAME LIKE "' . $search . '%" ) ORDER BY ad.ADMIN_ID DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}

//  download document
function count_all_download_document_list($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `document` where agent_id ="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_download_document_list($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `document` where agent_id="'.$agentid.'" ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function download_document_list_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `document` where ( date LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function download_document_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `document`  where ( document_name LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// download form
function count_all_download_form_list($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` where seller_id ="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_download_form_list($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_form_data` where seller_id="'.$agentid.'" ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function download_form_list_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_form_data` where ( form_name LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function download_form_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data`  where ( form_name LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// download form department
// download form
function count_all_download_form($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id left join `admin_login` ad on fm.department=ad.COMPANY_ID where ad.ADMIN_ID="'.$agentid.'" ');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_download_form($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT ba.form_name, ba.id as form_id FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id left join `admin_login` ad on fm.department=ad.COMPANY_ID where ad.ADMIN_ID="'.$agentid.'"  ORDER BY fm.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function download_form_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT ba.form_name, ba.id as form_id FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id left join `admin_login` ad on fm.department=ad.COMPANY_ID where ad.ADMIN_ID="'.$agentid.'"  where ( ba.form_name LIKE "' . $search . '%") and and ad.ADMIN_ID="'.$agent_id.'" ORDER BY fm.id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function download_form_search_count($search,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id left join `admin_login` ad on fm.department=ad.COMPANY_ID    where ( ba.form_name LIKE "' . $search . '%" ) and and ad.ADMIN_ID="'.$agentid.'" ORDER BY fm.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function count_all_wallet_amount($agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_wallet_transactions` where agent_id ="'.$agentid.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_wallet_amount($limit, $start, $order, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_wallet_transactions` where agent_id="'.$agentid.'" ORDER BY date  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_amount_search($limit, $start, $search, $col, $dir,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_wallet_transactions` where ( date LIKE "' . $search . '%") ORDER BY date DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_amount_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_wallet_transactions`  where ( date LIKE "' . $search . '%" ) ORDER BY date DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// wallet report

function count_all_wallet_report()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_wallet_transactions` ba LEFT JOIN `admin_login` ad on ba.agent_id=ad.ADMIN_ID');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_wallet_report($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_wallet_transactions` ba LEFT JOIN `admin_login` ad on ba.agent_id=ad.ADMIN_ID  ORDER BY ba.date  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_report_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_wallet_transactions`ba LEFT JOIN `admin_login` ad on ba.agent_id=ad.ADMIN_ID where ( ba.date LIKE "' . $search . '%") ORDER BY ba.date DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_report_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_wallet_transactions` ba LEFT JOIN `admin_login` ad on ba.agent_id=ad.ADMIN_ID where ( ba.date LIKE "' . $search . '%" ) ORDER BY ba.date DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// complete list
function count_all_complete_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `document` ba LEFT JOIN `admin_login` ad on ba.admin_id=ad.ADMIN_ID');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_complete_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select * FROM `document` ba LEFT JOIN `admin_login` ad on ba.admin_id=ad.ADMIN_ID ORDER BY ba.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function complete_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `document` ba LEFT JOIN `admin_login` ad on ba.admin_id=ad.ADMIN_ID  where ( ad.ADMIN_NAME LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function complete_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `document` ba LEFT JOIN `admin_login` ad on ba.admin_id=ad.ADMIN_ID where (   ad.ADMIN_NAME LIKE "' . $search . '%" ) ORDER BY ba.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// complete user list
// complete list
function count_all_complete_list_user($agentid,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `document` ba left join `form_fields_data` fm on fm.id=ba.form_id LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID   where ad.ADMIN_ID="'.$agentid.'" and ba.date between "'.$from.'" and "'.$to.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_complete_list_user($limit, $start, $order, $dir,$agentid,$to,$from)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select * FROM `document` ba left join `form_fields_data` fm on fm.id=ba.form_id LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID   where ad.ADMIN_ID="'.$agentid.'" and ba.date between "'.$from.'" and "'.$to.'" ORDER BY ba.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function complete_list_user_search($limit, $start, $search, $col, $dir,$agentid,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `document` ba left join `form_fields_data` fm on fm.id=ba.form_id LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID     where ( ad.ADMIN_NAME LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function complete_list_user_search_count($search,$agentid)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `document` ba left join `form_fields_data` fm on fm.id=ba.form_id LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID    where (   ad.ADMIN_NAME LIKE "' . $search . '%" ) ORDER BY ba.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}

function count_all_apply_list($agentid,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id  LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID where ad.ADMIN_ID="'.$agentid.'" and ba.date_time between "'.$from.'" and "'.$to.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_apply_list($limit, $start, $order, $dir,$agentid,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select * FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id  LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID where ad.ADMIN_ID="'.$agentid.'" and ba.date_time between "'.$from.'" and "'.$to.'" ORDER BY ba.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function apply_list_search($limit, $start, $search, $col, $dir,$agentid,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id  LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID   where ( ad.ADMIN_NAME LIKE "' . $search . '%") and ad.ADMIN_ID="'.$agentid.'" and ba.date_time between "'.$from.'" and "'.$to.'" ORDER BY ba.id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function apply_list_search_count($search,$agentid,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` ba LEFT JOIN `form_fields_data` fm on ba.form_id=fm.id  LEFT JOIN `admin_login` ad on fm.department=ad.COMPANY_ID   where (   ad.ADMIN_NAME LIKE "' . $search . '%" )  ORDER BY ba.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// report
function count_all_report_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` ba LEFT JOIN `admin_login` ad on ba.seller_id=ad.ADMIN_ID');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_report_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select * FROM `agent_form_data` ba LEFT JOIN `admin_login` ad on ba.seller_id=ad.ADMIN_ID ORDER BY ba.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function report_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_form_data` ba LEFT JOIN `admin_login` ad on ba.seller_id=ad.ADMIN_ID  where ( ad.ADMIN_NAME LIKE "' . $search . '%") ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function report_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_form_data` ba LEFT JOIN `admin_login` ad on ba.seller_id=ad.ADMIN_ID where (   ad.ADMIN_NAME LIKE "' . $search . '%" ) ORDER BY ba.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// wallet report date
// report
function count_all_wallet_report_date($from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `agent_wallet_transactions` wl LEFT JOIN `admin_login` ad on wl.agent_id=ad.ADMIN_ID where wl.date between "'.$from.'" and "'.$to.'"');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_wallet_report_date($limit, $start, $order, $dir,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select * FROM `agent_wallet_transactions` wl LEFT JOIN `admin_login` ad on wl.agent_id=ad.ADMIN_ID where wl.date between "'.$from.'" and "'.$to.'" ORDER BY wl.date  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_report_date_search($limit, $start, $search, $col, $dir,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `agent_wallet_transactions` wl LEFT JOIN `admin_login` ad on wl.agent_id=ad.ADMIN_ID   where ( ad.ADMIN_NAME LIKE "' . $search . '%") and  wl.date between "'.$from.'" and "'.$to.'" ORDER BY ba.date DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function wallet_report_date_search_count($search,$from,$to)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count * FROM `agent_wallet_transactions` wl LEFT JOIN `admin_login` ad on wl.agent_id=ad.ADMIN_ID where (   ad.ADMIN_NAME LIKE "' . $search . '%" ) ORDER BY wl.date DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// bank detail
function count_all_bank_detail()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `bank_account` ba LEFT JOIN `admin_login` ad on ba.login_id=ad.ADMIN_ID');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_bank_detail($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `bank_account` ba LEFT JOIN `admin_login` ad on ba.login_id=ad.ADMIN_ID ORDER BY ba.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function bank_detail_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * FROM `bank_account` ba LEFT JOIN `admin_login` ad on ba.login_id=ad.ADMIN_ID  where ( ad.bank_name LIKE "' . $search . '%") ORDER BY ba.id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function bank_detail_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count FROM `bank_account` ba LEFT JOIN `admin_login` ad on ba.login_id=ad.ADMIN_ID where (   ad.bank_name LIKE "' . $search . '%" ) ORDER BY ba.id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// list department
function count_all_department($agentid)

{

	$ci = &get_instance();
	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `department` where login_id="'.$agentid.'" ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_department($limit, $start, $order, $dir,$agentid)

{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `department` where login_id="'.$agentid.'" ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');


# where date > CURDATE() - interval 3 day
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}

}

function department_search($limit, $start, $search, $col, $dir,$agentid)
{
	$ci = &get_instance();
	$ci->load->database();
	// $query = $ci->db->query('SELECT *  FROM `premium` where ( pr.policy_no LIKE "' . $search . '%" OR pr.date LIKE "' . $search . '%") ORDER BY premium.policy_no DESC limit ' . $limit . ' OFFSET ' . $start . '');
	$query = $ci->db->query('SELECT * FROM `department` where ( dpt_name 
		LIKE "'.$search.'%" OR  dpt_id LIKE "' . $search . '") and login_id="'.$agentid.'" ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function department_search_count($search,$agentid)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `department` where ( dpt_name LIKE "' . $search . '%" OR  dpt_id LIKE "' . $search . '" ) and status = 0 ORDER BY id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}

}
// user
function count_all_user()

{


	$ci = &get_instance();
	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID where ad.ADMIN_TYPE=3');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_user($limit, $start, $order, $dir)

{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID  where ad.ADMIN_TYPE=3 ORDER BY ad.ADMIN_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');


# where date > CURDATE() - interval 3 day
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}

}

function usersearch($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	// $query = $ci->db->query('SELECT *  FROM `premium` where ( pr.policy_no LIKE "' . $search . '%" OR pr.date LIKE "' . $search . '%") ORDER BY premium.policy_no DESC limit ' . $limit . ' OFFSET ' . $start . '');
	$query = $ci->db->query('SELECT * FROM `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID  where ( ad.ADMIN_NAME
		LIKE "'.$search.'%" OR  ad.USER_NAME LIKE "' . $search . '" dp.dpt_name LIKE "' . $search . '") and ad.ADMIN_TYPE=3 ORDER BY ad.ADMIN_ID  DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function usersearch_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `admin_login` ad LEFT JOIN `department` dp on dp.id=ad.COMPANY_ID  where ( ad.ADMIN_NAME LIKE "' . $search . '%" OR ad.USER_NAME  LIKE "' . $search . '" OR dp.dpt_name  LIKE "' . $search . '" ) and ad.ADMIN_TYPE = 3 ORDER BY ad.ADMIN_ID  DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}

}
// list service

function count_all_list_service()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `our_services`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_list_service($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `our_services`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function list_service_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `our_services` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function list_service_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `our_services` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// news list

function count_all_news_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `news`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_news_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `news`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function news_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `news` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function news_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `news` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// our branches


function count_all_branches_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `our_branches`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_branches_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `our_branches`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function branches_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `our_branches` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function branches_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `our_branches` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
//latest news list

function count_all_latest_news_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `latest_news`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_latest_news_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `latest_news`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function latest_news_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `latest_news` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function latest_news_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `latest_news` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
//advance notice list

function count_all_advance_notice_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `advance_notice`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_advance_notice_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `advance_notice`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function advance_notice_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `advance_notice` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function advance_notice_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `advance_notice` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// flash image
function count_all_flash_image_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `flash_image`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_flash_image_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `flash_image`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function flash_image_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `flash_image` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function flash_image_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `flash_image` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// information board


function count_all_information_board_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `information_board`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_information_board_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `information_board`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function information_board_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `information_baord` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function information_board_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `information_board` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// admission notice


function count_all_admission_notice_list()



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('select count(*) as count from `admission_notice`');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}



function all_admission_notice_list($limit, $start, $order, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT  * from `admission_notice`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function admission_notice_list_search($limit, $start, $search, $col, $dir)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT * from `admission_notice` where ( link_name LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');



	if ($query->num_rows() > 0) {



		return $query->result();



	} else {



		return null;



	}



}



function admission_notice_list_search_count($search)



{



	$ci = &get_instance();



	$ci->load->database();



	$query = $ci->db->query('SELECT count(*) as count from `admission_notice` where (   link_name LIKE "' . $search . '%" ) ORDER BY id DESC');



	$res = $query->result();



	if (!empty($res)) {



		return $res[0]->count;



	} else {



		return 0;



	}



}
// notice


function count_all_notice_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('select count(*) as count from `notice_board`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

function all_notice_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  * from `notice_board`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function notice_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `notice_board` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function notice_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `notice_board` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*----------------- game end ---------------------------*/

/*---------------------- start page listing-----------------------------------------------------*/
function count_all_page_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('select count(*) as count from `page`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

function all_page_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  * from `page`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function page_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `page` where ( title LIKE "' . $search . '%")   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function page_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `page` where (   title LIKE "' . $search . '%" ) ORDER BY id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}




/*----------------------  end page listing -----------------------------------------------------*/




function numberTowords($num)

{ 

$decones = array( 

            '01' => "One", 

            '02' => "Two", 

            '03' => "Three", 

            '04' => "Four", 

            '05' => "Five", 

            '06' => "Six", 

            '07' => "Seven", 

            '08' => "Eight", 

            '09' => "Nine", 

            10 => "Ten", 

            11 => "Eleven", 

            12 => "Twelve", 

            13 => "Thirteen", 

            14 => "Fourteen", 

            15 => "Fifteen", 

            16 => "Sixteen", 

            17 => "Seventeen", 

            18 => "Eighteen", 

            19 => "Nineteen" 

            );

$ones = array( 

            0 => " ",

            1 => "One",     

            2 => "Two", 

            3 => "Three", 

            4 => "Four", 

            5 => "Five", 

            6 => "Six", 

            7 => "Seven", 

            8 => "Eight", 

            9 => "Nine", 

            10 => "Ten", 

            11 => "Eleven", 

            12 => "Twelve", 

            13 => "Thirteen", 

            14 => "Fourteen", 

            15 => "Fifteen", 

            16 => "Sixteen", 

            17 => "Seventeen", 

            18 => "Eighteen", 

            19 => "Nineteen" 

            ); 

$tens = array( 

            0 => "",

            2 => "Twenty", 

            3 => "Thirty", 

            4 => "Forty", 

            5 => "Fifty", 

            6 => "Sixty", 

            7 => "Seventy", 

            8 => "Eighty", 

            9 => "Ninety" 

            ); 

$hundreds = array( 

            "Hundred", 

            "Thousand", 

            "Million", 

            "Billion", 

            "Trillion", 

            "Quadrillion" 

            ); //limit t quadrillion 

$num = number_format($num,2,".",","); 

$num_arr = explode(".",$num); 

$wholenum = $num_arr[0]; 

$decnum = $num_arr[1]; 

$whole_arr = array_reverse(explode(",",$wholenum)); 

krsort($whole_arr); 

$rettxt = ""; 

foreach($whole_arr as $key => $i){ 

    if($i < 20){ 

        $rettxt .= $ones[$i]; 

    }

    elseif($i < 100){ 

        $rettxt .= $tens[substr($i,0,1)]; 

        $rettxt .= " ".$ones[substr($i,1,1)]; 

    }

    else{ 

        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 

        $rettxt .= " ".$tens[substr($i,1,1)]; 

        $rettxt .= " ".$ones[substr($i,2,1)]; 

    } 

    if($key > 0){ 

        $rettxt .= " ".$hundreds[$key]." "; 

    } 



} 

$rettxt = $rettxt." peso/s";



if($decnum > 0){ 

    $rettxt .= " and "; 

    if($decnum < 20){ 

        $rettxt .= $decones[$decnum]; 

    }

    elseif($decnum < 100){ 

        $rettxt .= $tens[substr($decnum,0,1)]; 

        $rettxt .= " ".$ones[substr($decnum,1,1)]; 

    }

    $rettxt = $rettxt." centavo/s"; 

} 

return $rettxt;

} 







}

function get_form_data($id) {

	$ci = &get_instance();

	$ci->load->database();

	$sql = "select * from agent_form_data where id='" . $id . "'";

	$query = $ci->db->query($sql);

	$row = $query->row();

	if(!empty($row)) {
		return json_decode($row->description);
	}

	return false;
}
// 
function get_user($user_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from admin_login where COMPANY_ID= '".$user_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}
// get enroll
function get_enroll($center_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from students where center_id= '".$center_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}
function get_submenu($sub_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from submenu where menu= '".$sub_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
  // var_dump($row);
  // die;
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}
function get_subsubmenu($subsub_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * FROM link_page LEFT JOIN subsubmenu on subsubmenu.id = link_page.subsubmenu WHERE link_page.submenu='".$subsub_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
  // var_dump($row);
  // die;
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}


/*----------------- start program ----------------------------------------------------------------*/

function get_sub_categories($category_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from state where COUNTRY_ID= '".$category_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}

function get_sub_subcategories($sub_category_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from city where state_id= '".$sub_category_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}
function check_sub_category_name_exist($brandid,$category,$sub_cat)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `sub_cat` where BRAND_ID="' . $brandid . '" AND CAT_ID="'.$category.'" AND SUB_CAT_NAME="'.$sub_cat.'" ');
	$res = $query->result();
	if (!empty($res)) {
		return true;
	} else {
		return false;
	}
}


function get_category_by_brand($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from courses where category='" . $id . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}


function get_all_category($limit)
{
	$ci = &get_instance();
	$ci->load->database();
    if($limit > 0){
        $sql = "SELECT * FROM `categorylist` ORDER by CAT_ID DESC LIMIT ".$limit." ";
    }else{
        $sql = "SELECT * FROM `categorylist` ORDER by CAT_ID DESC ";
    }
	
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}

function get_all_product($limit)
{
	$ci = &get_instance();
	$ci->load->database();
    if($limit > 0){
        $sql = "SELECT * FROM `product` p LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID LEFT JOIN brand b ON b.id=p.BRAND_ID LEFT JOIN measurement m on m.MEASUREMENT_ID=p.MEASUREMENT_ID ORDER BY p.PRODUCT_ID DESC LIMIT ".$limit." ";
    }else{
        $sql = "SELECT * FROM `product` p LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID LEFT JOIN brand b ON b.id=p.BRAND_ID LEFT JOIN measurement m on m.MEASUREMENT_ID=p.MEASUREMENT_ID ORDER BY p.PRODUCT_ID DESC  ";
    }
	
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}

function get_search_all_products($search)
{
	$ci = &get_instance();
	$ci->load->database();
        $sql = "SELECT * FROM `product` p LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID LEFT JOIN brand b ON b.id=p.BRAND_ID LEFT JOIN measurement m on m.MEASUREMENT_ID=p.MEASUREMENT_ID where ( p.PRODUCT_NAME LIKE '%".$search."%' OR cl.CATEGORY_NAME LIKE '%".$search."%' ) ORDER BY p.PRODUCT_ID DESC  ";
  
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}


function get_all_book_marks($userid)
{
	$ci = &get_instance();
	$ci->load->database();
    $sql = "SELECT * FROM bookmarks bm LEFT JOIN  `product` p on p.PRODUCT_ID=bm.P_ID LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID LEFT JOIN brand b ON b.id=p.BRAND_ID LEFT JOIN measurement m on m.MEASUREMENT_ID=p.MEASUREMENT_ID where bm.USER_ID='".$userid."'  ORDER BY p.PRODUCT_ID DESC  ";
  
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}



function get_product_detail_by_id($id)
{
	$ci = &get_instance();
	$ci->load->database();
    
        $sql = "SELECT * FROM `product` p LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID LEFT JOIN brand b ON b.id=p.BRAND_ID LEFT JOIN measurement m on m.MEASUREMENT_ID=p.MEASUREMENT_ID where p.PRODUCT_ID=".$id." ORDER BY p.PRODUCT_ID DESC  ";
    
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}

function get_sub_category($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from sub_cat where CAT_ID='" . $id . "'";
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}

function check_category_name_exist($brandid,$category)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `categorylist` where BRAND_ID="' . $brandid . '" AND CATEGORY_NAME="'.$category.'" ');
	$res = $query->result();
	if (!empty($res)) {
		return true;
	} else {
		return false;
	}
}

function check_product_type_exist($product_name)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `product` where PRODUCT_NAME="' . $product_name . '"');
	$res = $query->result();
	if (!empty($res)) {
		return true;
	} else {
		return false;
	}
}
/*------------- END OF THEKEDAR LIST ------------------------------*/



function count_all_new_order_history($status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `orderlist` ol LEFT JOIN product p on p.PRODUCT_ID=ol.PRODUCT_ID LEFT JOIN user_registration u on u.id=ol.USER_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where ol.ORDER_STATUS="'.$status.'" ORDER BY ol.ORDER_LIST_ID' );
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_new_order_history($limit, $start, $order, $dir,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `orderlist` ol LEFT JOIN product p on p.PRODUCT_ID=ol.PRODUCT_ID LEFT JOIN user_registration u on u.id=ol.USER_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where ol.ORDER_STATUS='.$status.' ORDER BY ol.ORDER_LIST_ID   ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function purchase_new_order_history_search($limit, $start, $search, $col, $dir,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `orderlist` ol LEFT JOIN product p on p.PRODUCT_ID=ol.PRODUCT_ID LEFT JOIN user_registration u on u.id=ol.USER_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where (  p.PRODUCT_NAME LIKE "' . $search . '%" OR u.mobile LIKE "' . $search . '%" OR b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME LIKE "' . $search . '%" OR sc.SUB_CAT_NAME LIKE "' . $search . '%"  )
	  AND ol.ORDER_STATUS="'.$status.'" ORDER BY ol.ORDER_LIST_ID   ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function purchase_new_order_history_count($search,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `orderlist` ol LEFT JOIN product p on p.PRODUCT_ID=ol.PRODUCT_ID LEFT JOIN user_registration u on u.id=ol.USER_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where (  p.PRODUCT_NAME LIKE "' . $search . '%" OR u.mobile LIKE "' . $search . '%" OR b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME LIKE "' . $search . '%" OR sc.SUB_CAT_NAME LIKE "' . $search . '%"  ) AND ol.ORDER_STATUS="'.$status.'" ORDER BY ol.ORDER_LIST_ID ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


/*------------- END OF LIST ------------------------------*/

/*------------- START BRAND LIST --------------------*/

function count_all_brand_type()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `brand`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_brand_type($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `brand` ORDER BY id ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function brand_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `brand`  where (  brand_name LIKE "' . $search . '%" )  ORDER BY id ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function brand_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `brand` where (  brand_name LIKE "' . $search . '%" ) ORDER BY id ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF BRAND LIST -------------------*/


/*------------- START CATEGORY LIST --------------------*/

function count_all_category_type()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `categorylist` cl LEFT JOIN brand b on b.id=cl.BRAND_ID');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_category_type($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `categorylist` cl LEFT JOIN brand b on b.id=cl.BRAND_ID ORDER BY cl.CAT_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function category_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `categorylist` cl LEFT JOIN brand b on b.id=cl.BRAND_ID ORDER BY cl.CAT_ID where (  b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME  LIKE "' . $search . '%" )  ORDER BY cl.CAT_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function category_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `categorylist` cl LEFT JOIN brand b on b.id=cl.BRAND_ID ORDER BY cl.CAT_ID where (  b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME  LIKE "' . $search . '%" )  ORDER BY cl.CAT_ID ASC ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF CATEGORY LIST -------------------*/



/*------------- START CATEGORY LIST --------------------*/

function count_all_sub_category_type()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM sub_cat sc  LEFT JOIN categorylist cl on cl.CAT_ID=sc.CAT_ID LEFT JOIN brand b on b.id=sc.BRAND_ID  ORDER BY sc.SUB_CAT_ID');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_sub_category_type($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM  sub_cat sc  LEFT JOIN categorylist cl on cl.CAT_ID=sc.CAT_ID LEFT JOIN brand b on b.id=sc.BRAND_ID ORDER BY sc.SUB_CAT_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function sub_category_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM sub_cat sc  LEFT JOIN categorylist cl on cl.CAT_ID=sc.CAT_ID LEFT JOIN brand b on b.id=sc.BRAND_ID where (  b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME  LIKE "' . $search . '%" OR sc.SUB_CAT_NAME  LIKE "' . $search . '%" )  ORDER BY sc.SUB_CAT_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function sub_category_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM sub_cat sc  LEFT JOIN categorylist cl on cl.CAT_ID=sc.CAT_ID LEFT JOIN brand b on b.id=sc.BRAND_ID where (  b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME  LIKE "' . $search . '%"  OR sc.SUB_CAT_NAME  LIKE "' . $search . '%" )  ORDER BY sc.SUB_CAT_ID ASC ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF CATEGORY LIST -------------------*/


/*------------- START CATEGORY LIST --------------------*/

function count_all_product_type()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM product p LEFT JOIN `categorylist` cl on cl.CAT_ID=p.CAT_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID  ORDER BY p.PRODUCT_ID');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_product_type($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM product p LEFT JOIN `categorylist` cl on cl.CAT_ID=p.CAT_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID ORDER BY p.PRODUCT_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function product_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM product p LEFT JOIN `categorylist` cl on cl.CAT_ID=p.CAT_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where (  b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME  LIKE "' . $search . '%" OR sc.SUB_CAT_NAME  LIKE "' . $search . '%" OR p.PRODUCT_NAME  LIKE "' . $search . '%" )  ORDER BY p.PRODUCT_ID  ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function product_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM product p LEFT JOIN `categorylist` cl on cl.CAT_ID=p.CAT_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where (  b.brand_name LIKE "' . $search . '%" OR cl.CATEGORY_NAME  LIKE "' . $search . '%" OR sc.SUB_CAT_NAME  LIKE "' . $search . '%" OR p.PRODUCT_NAME  LIKE "' . $search . '%" )  ORDER BY p.PRODUCT_ID ASC ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF CATEGORY LIST -------------------*/


/*------------- START BANNER LIST --------------------*/

function count_all_banners($status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `promotional_add` WHERE STATUS="'.$status.'" ORDER BY PROMOTION_ID');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_banners($limit, $start, $order, $dir,$status )
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `promotional_add` WHERE STATUS="'.$status.'"  ORDER BY PROMOTION_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function banners_type_search($limit, $start, $search, $col, $dir,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `promotional_add`  where (  IMAGE_TITLE LIKE "' . $search . '%" ) AND STATUS="'.$status.'"  ORDER BY PROMOTION_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function banners_type_search_count($search,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `promotional_add` where (  IMAGE_TITLE LIKE "' . $search . '%" ) AND STATUS="'.$status.'"  ORDER BY PROMOTION_ID ASC ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF BANNER LIST -------------------*/

/*---  get all brands --------------*/
function get_all_brands()
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from brand";
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row;
}


function count_orders_by_status($status){
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `orderlist` where  ORDER_STATUS="'.$status.'"  ORDER BY ORDER_LIST_ID  ');
	//$res = $query->result();
		return $query->num_rows();
}

function count_all_category()
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from categorylist ";
	$query = $ci->db->query($sql);
	$row = $query->num_rows();
	return $row;
}
function count_all_sub_category()
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from sub_cat ";
	$query = $ci->db->query($sql);
	$row = $query->num_rows();
	return $row;
}
function count_all_product()
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from product ";
	$query = $ci->db->query($sql);
	$row = $query->num_rows();
	return $row;
}

function count_total_payment($payment_type){
	$ci = &get_instance();
	$ci->load->database();
	if ($payment_type=='all') {
		$sql = "SELECT SUM(QTY*PRODUCT_PRICE) AS AMOUNT FROM `orderlist`";
		
	}else{
		$sql = "SELECT SUM(QTY*PRODUCT_PRICE) AS AMOUNT FROM `orderlist` WHERE PAYMENT_TYPE='".$payment_type."'";
	}
	
	$query = $ci->db->query($sql);
	$row = $query->result();
	return $row[0];

}

function count_new_user_registration($date){
	$ci = &get_instance();
	$ci->load->database();
		$sql = "SELECT * FROM `user_registration` WHERE `date` >= '".$date."'";
	$query = $ci->db->query($sql);
	$row = $query->num_rows();
	return $row;

}


function today_all_deals($status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `orderlist` ol LEFT JOIN product p on p.PRODUCT_ID=ol.PRODUCT_ID LEFT JOIN user_registration u on u.id=ol.USER_ID LEFT JOIN brand b on b.id=p.BRAND_ID LEFT JOIN categorylist cl on cl.CAT_ID=p.CAT_ID LEFT JOIN sub_cat sc on sc.SUB_CAT_ID=p.PRODUCT_SUB_CAT_ID where ol.ORDER_STATUS="'.$status.'" ORDER BY ol.ORDER_LIST_ID' );
	return $res = $query->result();
	
}


/*------------- START TABLE  ORDER LIST --------------------*/

function count_all_table_orders_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `final_bill` fb LEFT JOIN user_registration ur on ur.id=fb.customer_id ORDER BY fb.id');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_table_orders_list($limit, $start, $order, $dir )
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `final_bill`  fb LEFT JOIN user_registration ur on ur.id=fb.customer_id ORDER BY fb.id ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function table_orders_list_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `final_bill`  fb LEFT JOIN user_registration ur on ur.id=fb.customer_id  where (  fb.BILL_DATE LIKE "' . $search . '%" OR fb.invoice_no LIKE "' . $search . '%" )  ORDER BY fb.id ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function table_orders_list_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `final_bill`  fb LEFT JOIN user_registration ur on ur.id=fb.customer_id where (   fb.BILL_DATE LIKE "' . $search . '%" OR fb.invoice_no LIKE "' . $search . '%" )  ORDER BY fb.id ASC ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF TABLE ORDER LIST -------------------*/
function get_product($sub_id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from product where PRODUCT_SUB_CAT_ID= '".$sub_id."' ";
	$query = $ci->db->query($sql);
	$row = $query->result();
	if (!empty($row)) {
		return $row;
	} else {
		return '';
	}
}



/*-------------------------- start all news letter list ---------------------------------------------------*/
// service list

function count_all_news_letter_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('select count(*) as count from `news_letter_list`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_news_letter_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  * from `news_letter_list`  ORDER BY NEWS_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function news_letter_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `news_letter_list` where ( NEWS_TITLE LIKE "' . $search . '%" OR NEWS_DESC LIKE "' . $search . '%" OR NEWS_LINK LIKE "' . $search . '%")   ORDER BY NEWS_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function news_letter_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `news_letter_list` where ( NEWS_TITLE LIKE "' . $search . '%" OR NEWS_DESC LIKE "' . $search . '%" OR NEWS_LINK LIKE "' . $search . '%" ) ORDER BY NEWS_ID DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}





/*------------------------ end all news letter list ------------------------------------------------------------*/



/*------------- START FIXED MENU LIST --------------------*/

function count_all_fixed_menu()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `fixed_menu`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_fixed_menu($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `fixed_menu` ORDER BY FM_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function fixed_menu_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `fixed_menu`  where (  FM_NAME LIKE "' . $search . '%" )  ORDER BY FM_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function fixed_menu_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `fixed_menu` where (  FM_NAME LIKE "' . $search . '%" ) ORDER BY id ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF FIXED MENU LIST -------------------*/




/*----------------------- START COLOR SETTING --------------------------------------*/

function count_all_color_setting()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `color_setting`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

function all_color_setting($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `color_setting` ORDER BY CS_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function color_setting_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `color_setting`  where ( CS_NAME LIKE "' . $search . '%" OR CS_CODE LIKE "' . $search . '%" OR CS_BACKGROUN_HOVER LIKE "' . $search . '%" OR CS_FONT_HOVER LIKE "' . $search . '%"  )  ORDER BY CS_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function color_setting_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `color_setting` where (  CS_NAME LIKE "' . $search . '%" OR CS_CODE LIKE "' . $search . '%"  OR CS_BACKGROUN_HOVER LIKE "' . $search . '%" OR CS_FONT_HOVER LIKE "' . $search . '%"  )  ORDER BY CS_ID DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}



/*------------------ END COLOR SETTING ---------------------------------------------*/


/*------------- START FRONT SETTING  LIST --------------------*/

function count_all_front_setting_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `front_setting`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_front_setting_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `front_setting` ORDER BY FB_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function front_setting_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `front_setting`  where (  FB_NAME LIKE "' . $search . '%" )  ORDER BY FB_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function front_setting_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `front_setting` where (  FB_NAME LIKE "' . $search . '%" ) ORDER BY FB_ID ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF FRONT SETTING LIST -------------------*/


/*------------- START  MENU LIST --------------------*/

function count_all_menu_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `front_cms_menu_items`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_menu_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `front_cms_menu_items` ORDER BY id ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function menu_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `front_cms_menu_items`  where (  menu LIKE "' . $search . '%" )  ORDER BY id ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function menu_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `front_cms_menu_items` where (  menu LIKE "' . $search . '%" ) ORDER BY id ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF  MENU LIST -------------------*/


/*------------- START sub MENU LIST --------------------*/

function count_all_sub_menu_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `submenu`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_sub_menu_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `submenu` ORDER BY id ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function sub_menu_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `submenu`  where (  submenu LIKE "' . $search . '%" )  ORDER BY id ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function sub_menu_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `submenu` where (  submenu LIKE "' . $search . '%" ) ORDER BY id ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF sub  MENU LIST -------------------*/


/*------------- START SUB SUB MENU LIST --------------------*/

function count_all_sub_sub_menu_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `menu`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_sub_sub_menu_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `menu` ORDER BY id ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function sub_sub_menu_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `menu`  where (  menu_name LIKE "' . $search . '%" )  ORDER BY id ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function sub_sub_menu_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `menu` where (  menu_name LIKE "' . $search . '%" ) ORDER BY id ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF SUB SUB MENU LIST -------------------*/








/*------------- START BACKEND SETTING  LIST --------------------*/

function count_all_backend_setting_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `backend_setting`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_backend_setting_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `backend_setting` ORDER BY BACK_END_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function backend_setting_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `backend_setting`  where (  BACK_END_TITLE LIKE "' . $search . '%" )  ORDER BY BACK_END_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function backend_setting_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `backend_setting` where (  BACK_END_TITLE LIKE "' . $search . '%" ) ORDER BY BACK_END_ID ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF BACKEND SETTING LIST -------------------*/





function get_title_name($method_list)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "select * from method_list ML LEFT JOIN backend_setting BS ON BS.BACK_END_ID=ML.METHOD_LINK where ML.METHOD_NAME='" . $method_list . "'";
	$query = $ci->db->query($sql);
	$row = $query->row();
	return $row;
}


/*------------- START NEW USER REGISTRATON  LIST --------------------*/

function count_all_new_user_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM user_registration UR LEFT JOIN gender as g on g.GENDER_ID=UR.gender LEFT JOIN cast c on c.CAST_ID=UR.category LEFT JOIN enroll_for as ef on ef.ENROLL_ID=UR.enroll_for LEFT JOIN brand b on b.id=UR.course ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_new_user_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  *, UR.id as USER_ID FROM user_registration  UR LEFT JOIN gender as g on g.GENDER_ID=UR.gender LEFT JOIN cast c on c.CAST_ID=UR.category  LEFT JOIN enroll_for as ef on ef.ENROLL_ID=UR.enroll_for LEFT JOIN brand b on b.id=UR.course  ORDER BY UR.id ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function new_user_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  *, UR.id as USER_ID from  user_registration  UR LEFT JOIN gender as g on g.GENDER_ID=UR.gender LEFT JOIN cast c on c.CAST_ID=UR.category  LEFT JOIN enroll_for as ef on ef.ENROLL_ID=UR.enroll_for LEFT JOIN brand b on b.id=UR.course   where (  UR.name LIKE "' . $search . '%" OR UR.email LIKE "' . $search . '%" OR  UR.mobile LIKE "' . $search . '%")  ORDER BY UR.id ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function new_user_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from  user_registration  UR LEFT JOIN gender as g on g.GENDER_ID=UR.gender LEFT JOIN cast c on c.CAST_ID=UR.category  LEFT JOIN enroll_for as ef on ef.ENROLL_ID=UR.enroll_for LEFT JOIN brand b on b.id=UR.course  where (  UR.name LIKE "' . $search . '%"  OR UR.email LIKE "' . $search . '%" OR  UR.mobile LIKE "' . $search . '%" ) ORDER BY UR.id ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

/*--------------- END OF NEW USER REGISTRATION LIST -------------------*/

/*---------------- start check menu status ----------------------------------*/



function check_menu_linking_status($id)
{
	$ci = &get_instance();
	$ci->load->database();
	$sql = "SELECT * FROM `link_page` WHERE `menu` = '" . $id . "' AND `submenu` = 0 AND `subsubmenu` = 0 ";
	$query = $ci->db->query($sql);
	$row = $query->row();
	return $row;
}





/*----------------- end check menu status ---------------------------------*/



/*-------------------------- start all CENTER list ---------------------------------------------------*/
// service list

function count_all_center_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('select count(*) as count from `centers` left join state on state.STATE_ID=centers.state_id left join district on district.DISTRICT_ID=centers.city_id  LEFT JOIN admin_login ON admin_login.INSTITUTE_CENTER_ID=centers.id');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_center_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  * from `centers`  left join state on state.STATE_ID=centers.state_id left join district on district.DISTRICT_ID=centers.city_id  LEFT JOIN admin_login ON admin_login.INSTITUTE_CENTER_ID=centers.id ORDER BY centers.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ' ');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function center_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `centers`  left join state on state.STATE_ID=centers.state_id left join district on district.DISTRICT_ID=centers.city_id  LEFT JOIN admin_login ON admin_login.INSTITUTE_CENTER_ID=centers.id where ( centers.center_number LIKE "' . $search . '%" OR centers.name LIKE "' . $search . '%" OR centers.institute_name LIKE "' . $search . '%" OR centers.pan_number LIKE "' . $search . '%" OR centers.aadhar_number LIKE "' . $search . '%" OR centers.email_id LIKE "' . $search . '%" )   ORDER BY centers.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function center_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `centers` left join state on state.STATE_ID=centers.state_id left join district on district.DISTRICT_ID=centers.city_id  LEFT JOIN admin_login ON admin_login.INSTITUTE_CENTER_ID=centers.id where ( centers.center_number LIKE "' . $search . '%" OR centers.name LIKE "' . $search . '%" OR centers.institute_name LIKE "' . $search . '%" OR centers.pan_number LIKE "' . $search . '%" OR centers.aadhar_number LIKE "' . $search . '%" OR centers.email_id LIKE "' . $search . '%"  ) ORDER BY centers.id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}





/*------------------------ end all CENTER list ------------------------------------------------------------*/



/*-------------------------- start all STUDENT list ---------------------------------------------------*/
//show student
function count_all_show_student($status,$course,$center,$type,$year)
{
	$ci = &get_instance();
	$ci->load->database();
if($center == 'all'){
    $query = $ci->db->query('select count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join  subjects su on su.course_id=ad.course_id where   students.pay_status=1  and ad.course_id="'.$course.'"  AND ad.year = "'.$year.'" AND su.year="'.$year.'"  ');  
        // $query = $ci->db->query('select count(*) as count from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join  subjects su on su.course_id=students.course_id where students.exam_status=0 and students.pay_status=1 and students.addmission_date<= "'.$status.'" and students.course_id="'.$course.'" and su.year="'.$year.'" ');  
	}else{
	   //  $query = $ci->db->query('select count(*) as count from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join  subjects su on su.course_id=students.course_id where students.exam_status=0 and students.pay_status=1 and students.addmission_date<= "'.$status.'" and students.course_id="'.$course.'" and students.center_id="'.$center.'" and su.year="'.$year.'"  ');  
	     $query = $ci->db->query('select count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join  subjects su on su.course_id=ad.course_id where   students.pay_status=1 and students.addmission_date<= "'.$status.'" and students.course_id="'.$course.'" and students.center_id="'.$center.'"   ');  
	    
	}
	
	   
	
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_show_student($limit, $start, $order, $dir,$status,$course,$center,$type,$year)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   if($center == 'all'){
          $query = $ci->db->query('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id left join  session_year se on se.id=students.session where  students.pay_status=1  and students.course_id="'.$course.'"   AND ad.year = "'.$year.'" AND su.year="'.$year.'"   ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
            // die(var_dump('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id left join  session_year se on se.id=students.session where  students.pay_status=1 and ad.year="'.$year.'" and students.course_id="'.$course.'" and su.year="'.$year.'"'));
	}else{
	     $query = $ci->db->query('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id left join  session_year se on se.id=students.session where  students.pay_status=1  and students.course_id="'.$course.'"    and students.center_id="'.$center.'"  ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}
	   // $query = $ci->db->query('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where  students.pay_status=1 and students.addmission_date >= "'.$status.'" and students.course_id="'.$course.'"  ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
        
// 	die(var_dump('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where students.exam_status=0 and students.pay_status=1 and students.addmission_date <= "'.$status.'" and students.course_id="'.$course.'"'));
// die(var_dump($query->result()));
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function show_student_search($limit, $start, $search, $col, $dir,$status,$course,$center,$type,$year)
{
	$ci = &get_instance();
	$ci->load->database();
   
   	   if($center == 'all'){
         $query = $ci->db->query('SELECT *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no   left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'"   AND ad.year = "'.$year.'" AND su.year="'.$year.'"    ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	    $query = $ci->db->query('SELECT *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'" and students.center_id="'.$center.'"     ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}
	   // $query = $ci->db->query('SELECT * from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.exam_status=0 and students.pay_status=1 and students.addmission_date >= "'.$status.'" and students.course_id="'.$course.'"   ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
   
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function show_student_search_count($search,$status,$course,$center,$type,$year)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   //
	     if($center == 'all'){
         $query = $ci->db->query('SELECT count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'"  AND ad.year = "'.$year.'" AND su.year="'.$year.'"   ORDER BY students.id DESC');
	}else{
	   $query = $ci->db->query('SELECT count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'"   and students.center_id="'.$center.'" ORDER BY students.id DESC');
	}
	   //$query = $ci->db->query('SELECT count(*) as count from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.exam_status=0 and students.pay_status=1 and students.addmission_date >= "'.$status.'" and students.course_id="'.$course.'" ORDER BY students.id DESC');
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
// exam schedule list
function count_all_assign_exam_student($center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	   // SELECT su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id left join subjects su on su.course_id=ad.course_id left join session_year se on se.id=students.session where students.pay_status=1 and ad.year="1" and ad.course_id="4" and su.year="1"
	     $query = $ci->db->query('select count(*) as count from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id left join `students` on students.id=a.student_id left join `session_year` se on se.id=students.session  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id   ');  
	}else{
	    $query = $ci->db->query('select count(*) as count from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id left join `students` on students.id=a.student_id left join `session_year` se on se.id=students.session  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where a.center_id="'.$center.'"  ');  
	}
	
	   // $query = $ci->db->query('select count(*) as count from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id left join `students` on students.id=a.student_id  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where a.center_id="'.$center.'"  ');  
	
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_assign_exam_student($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	      $query = $ci->db->query('SELECT  *,a.id as exam_id, students.id as student_id, students.name as student_name,students.dob as student_dob   from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id  left join `students` on students.id=a.student_id left join `session_year` se on se.id=students.session left join courses on courses.id=students.course_id   ORDER BY a.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');  
	}else{
	   $query = $ci->db->query('SELECT  *,a.id as exam_id, students.id as student_id, students.name as student_name,students.dob as student_dob   from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id  left join `students` on students.id=a.student_id left join `session_year` se on se.id=students.session left join courses on courses.id=students.course_id left join session_year se on se.id=students.session where a.center_id="'.$center.'"   ORDER BY a.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}
	   // $query = $ci->db->query('SELECT  *,a.id as exam_id, students.id as student_id, students.name as student_name,students.dob as student_dob   from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id  left join `students` on students.id=a.student_id left join courses on courses.id=students.course_id where a.center_id="'.$center.'"   ORDER BY a.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
// 	die(var_dump('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from `students`  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where students.exam_status=0 and students.pay_status=1 and students.addmission_date >= "'.$status.'" and students.course_id="'.$course.'"'));
// die(var_dump($query->result()));
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function assign_exam__student_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
   if($center == 'all'){
	     $query = $ci->db->query('SELECT *,a.id as exam_id, students.id as student_id, students.name as student_name,students.dob as student_dob from Assign_exam_student a left join exam_schedule e on e.id=a.exam_id  left join `students` on students.id=a.student_id left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%" OR courses.course_name LIKE "' . $search . '%"  )     ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	   $query = $ci->db->query('SELECT *,a.id as exam_id, students.id as student_id, students.name as student_name,students.dob as student_dob from Assign_exam_student a left join exam_schedule e on e.id=a.exam_id  left join `students` on students.id=a.student_id left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%" OR courses.course_name LIKE "' . $search . '%"   ) and a.center_id="'.$center.'"    ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}
	   // $query = $ci->db->query('SELECT * from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id  left join `students` on students.id=a.student_id left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and a.center_id="'.$center.'"    ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
   
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function assign_exam__student_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	  if($center == 'all'){
	    $query = $ci->db->query('SELECT count(*) as count from Assign_exam_student a left join exam_schedule e on e.id=a.exam_id  left join `students` on students.id=a.student_id  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%" OR courses.course_name LIKE "' . $search . '%"   )   ORDER BY students.id DESC');
	}else{
	  $query = $ci->db->query('SELECT count(*) as count from Assign_exam_student a left join exam_schedule e on e.id=a.exam_id  left join `students` on students.id=a.student_id  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%" OR courses.course_name LIKE "' . $search . '%"   ) and a.center_id="'.$center.'"  ORDER BY students.id DESC');
	}
	   // $query = $ci->db->query('SELECT count(*) as count from Assign_exam_student a left join exam_schedule e on a.exam_id=e.id  left join `students` on students.id=a.student_id  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and a.center_id="'.$center.'"  ORDER BY students.id DESC');
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
// service list

function count_all_student_list($center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id ');	    
	}else{
	    $query = $ci->db->query('select count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where centers.id="'.$center.'" ');  
	}
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_student_list($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT  *, students.id as id,students.status as status, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	   $query = $ci->db->query('SELECT  *, students.id as id,students.status as status , students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where centers.id="'.$center.'" ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function student_list_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    if($center == 'all'){
	    $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )   ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
    }else{
        $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and centers.id="'.$center.'"   ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    }
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function student_list_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) ORDER BY students.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and centers.id="'.$center.'" ORDER BY students.id DESC');   
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
// download admit  card
function count_download_admit_card($center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	if($center == 'all'){
        $query = $ci->db->query('select count(*) as count FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id');	    
	}else{
	    $query = $ci->db->query('select count(*) as count FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id where ad.center_id="'.$center.'" ');  
	}
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_download_admit_card($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	      $query = $ci->db->query('SELECT *,s.name as name ,ad.id as card_id,s.id as id,s.dob as dob,ad.year as course_year FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	   // $query = $ci->db->query('SELECT  *,ad.id as card_id , students.id as id,students.status as status, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join session_year se on students.session=se.id left join admit_card ad on ad.center_id=students.center_id ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	   //$query = $ci->db->query('SELECT  *,ad.id as card_id , students.id as id,students.status as status , students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join session_year se on students.session=se.id left join admit_card ad on ad.center_id=students.center_id  where students.center_id="'.$center.'" ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	 $query = $ci->db->query('SELECT *,s.name as name,ad.id as card_id,s.id as id,ad.year as course_year,s.dob as dob FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id  where ad.center_id="'.$center.'" ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	    
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function download_admit_card_list_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    if($center == 'all'){
	    $query = $ci->db->query('SELECT *,s.name as name,ad.id as card_id,s.id as id,ad.year as course_year,s.dob as dob FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id where ( s.enrollment_no LIKE "' . $search . '%" OR s.name LIKE "' . $search . '%" OR s.email LIKE "' . $search . '%" OR s.center_id LIKE "' . $search . '%"  )   ORDER BY ad.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
    }else{
        $query = $ci->db->query('SELECT *,s.name as name,ad.id as card_id,s.id as id,ad.year as course_year,s.dob as dob FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id where ( s.enrollment_no LIKE "' . $search . '%" OR s.name LIKE "' . $search . '%" OR s.email LIKE "' . $search . '%" OR s.center_id LIKE "' . $search . '%"  ) and ad.center_id="'.$center.'"   ORDER BY s.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    }
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function download_admit_card_list_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT count(*) as count FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id where ( s.enrollment_no LIKE "' . $search . '%" OR s.name LIKE "' . $search . '%" OR s.email LIKE "' . $search . '%" OR s.center_id LIKE "' . $search . '%"  ) ORDER BY ad.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count FROM `admit_card` ad left join students s on s.enrollment_no=ad.enrollment_no left join courses c on c.id=s.course_id left join  centers ce on ce.id=s.center_id left join session_year se on s.session=se.id where ( s.enrollment_no LIKE "' . $search . '%" OR s.name LIKE "' . $search . '%" OR s.email LIKE "' . $search . '%" OR s.center_id LIKE "' . $search . '%"  ) and ad.center_id="'.$center.'" ORDER BY ad.id DESC');   
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
// pending student list
function count_all_student_pending_list($center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where students.pay_status=0 ');	    
	}else{
	    $query = $ci->db->query('select count(*) as count from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where students.pay_status=0 and students.center_id="'.$center.'"');  
	}
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_student_pending_list($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where students.pay_status=0  ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	   $query = $ci->db->query('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where students.center_id="'.$center.'" and students.pay_status=0 ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function student_pending_list_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    if($center == 'all'){
	    $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=0 ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
    }else{
        $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.center_id="'.$center.'" and students.pay_status=0   ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    }
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function student_pending_list_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.pay_status=0 ORDER BY students.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.center_id="'.$center.'" and students.pay_status=0 ORDER BY students.id DESC');   
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
//cancel student list
function count_all_student_cancel_list($center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch   where students.pay_status=2');	    
	}else{
	    $query = $ci->db->query('select count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where centers.center_number="'.$center.'" and students.pay_status=2');  
	}
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_student_cancel_list($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where students.pay_status=2  ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	   $query = $ci->db->query('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where centers.center_number="'.$center.'" and students.pay_status=2 ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function student_cancel_list_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    if($center == 'all'){
	    $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.pay_status=2 ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
    }else{
        $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and centers.center_number="'.$center.'" and students.pay_status=2 ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    }
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function student_cancel_list_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.pay_status=2 ORDER BY students.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and centers.center_number="'.$center.'" and students.pay_status=2 ORDER BY students.id DESC');   
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
// approve student list
function count_all_student_approve_list($center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where students.pay_status=1');	    
	}else{
	    $query = $ci->db->query('select count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where students.center_id="'.$center.'" and students.pay_status=1 ');  
	}
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_student_approve_list($limit, $start, $order, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where students.pay_status=1 ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	   $query = $ci->db->query('SELECT  *, students.id as id, students.name as student_name,students.dob as student_dob  from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where students.center_id="'.$center.'" and students.pay_status=1 ORDER BY students.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function student_approve_list_search($limit, $start, $search, $col, $dir,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    if($center == 'all'){
	    $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.pay_status=1  ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
    }else{
        $query = $ci->db->query('SELECT *, students.id as id, students.name as student_name,students.dob as student_dob from students  left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.center_id="'.$center.'" and students.pay_status=1  ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    }
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function student_approve_list_search_count($search,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	if($center == 'all'){
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.pay_status=1 ORDER BY students.id DESC');
	}else{
	    $query = $ci->db->query('SELECT count(*) as count from `students` left join state on state.STATE_ID=students.state left join district on district.DISTRICT_ID=students.distric left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join brand on brand.id=students.category left join batch_session on batch_session.BATCH_ID=students.Batch where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  ) and students.center_id="'.$center.'" and students.pay_status=1 ORDER BY students.id DESC');   
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


// pending list
function count_all_pending_list($status,$type,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" ');	    
	}else{
	    $query = $ci->db->query('select count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" and e.user_id="'.$center.'" and e.type="'.$type.'"');  
	}
	   // $query = $ci->db->query('select count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'"');  
	
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_pending_list($limit, $start, $order, $dir,$status,$type,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   if($center == 'all'){
       $query = $ci->db->query('SELECT  *,e.id as eid from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" ORDER BY e.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}else{
	    $query = $ci->db->query('SELECT  *,e.id as eid from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" and e.user_id="'.$center.'" and e.type="'.$type.'" ORDER BY e.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}
	 
	   //$query = $ci->db->query('SELECT  * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" ORDER BY e.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
// 	die(var_dump())
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function pending_list_search($limit, $start, $search, $col, $dir,$status,$type,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    
      if($center == 'all'){
      $query = $ci->db->query('SELECT * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id   where ( e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
	}else{
	    $query = $ci->db->query('SELECT * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id   where ( e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.user_id="'.$center.'" and e.type="'.$type.'" and  e.status="'.$status.'" ORDER BY e.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
	}
        // $query = $ci->db->query('SELECT * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id   where ( e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function pending_list_search_count($search,$status,$type,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   if($center == 'all'){
      $query = $ci->db->query('SELECT count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id where (  e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC');   
	}else{
	    $query = $ci->db->query('SELECT count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id where (  e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.user_id="'.$center.'" and e.type="'.$type.'" and  e.status="'.$status.'" ORDER BY e.id DESC');   
	}
	   
	   // $query = $ci->db->query('SELECT count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id where (  e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC');   
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

/*------------------------ end all STUDENT list ------------------------------------------------------------*/
//ALL ENQUIRY
function count_all_enquiry_list($status,$center,$type)
{
	$ci = &get_instance();
	$ci->load->database();
	
	    if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" ');	    
	}else{
	    $query = $ci->db->query('select count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" and e.user_id="'.$center.'" and e.type="'.$type.'"');  
	}
	   // $query = $ci->db->query('select count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'"');  
	
	
	
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_enquiry_list($limit, $start, $order, $dir,$status,$center,$type)
{
	$ci = &get_instance();
	$ci->load->database();
	
	
	   if($center == 'all'){
       $query = $ci->db->query('SELECT  *,e.id as eid from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" ORDER BY e.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}else{
	    $query = $ci->db->query('SELECT  *,e.id as eid from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" and e.user_id="'.$center.'" and e.type="'.$type.'" ORDER BY e.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
	}
	   //$query = $ci->db->query('SELECT  *,e.id as eid from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id  where  e.status="'.$status.'" ORDER BY e.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . ''); 
// 	die(var_dump())
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function enquiry_list_search($limit, $start, $search, $col, $dir,$status,$center,$type)
{
	$ci = &get_instance();
	$ci->load->database();
      if($center == 'all'){
      $query = $ci->db->query('SELECT * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id   where ( e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
	}else{
	    $query = $ci->db->query('SELECT * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id   where ( e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.user_id="'.$center.'" and e.type="'.$type.'" and  e.status="'.$status.'" ORDER BY e.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
	}
        // $query = $ci->db->query('SELECT * from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id   where ( e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC limit ' . $limit . ' OFFSET ' . $start . '');        
    
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function enquiry_list_search_count($search,$status,$center,$type)
{
	$ci = &get_instance();
	$ci->load->database();
	 if($center == 'all'){
      $query = $ci->db->query('SELECT count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id where (  e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC');   
	}else{
	    $query = $ci->db->query('SELECT count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id where (  e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.user_id="'.$center.'" and e.type="'.$type.'" and  e.status="'.$status.'" ORDER BY e.id DESC');   
	}
	   // $query = $ci->db->query('SELECT count(*) as count from `enquiry` e left join courses c on e.course=c.id left join session_year s on e.session=s.id where (  e.name LIKE "' . $search . '%" OR e.mobile LIKE "' . $search . '%" OR e.email LIKE "' . $search . '%" OR e.dob LIKE "' . $search . '%"  ) and  e.status="'.$status.'" ORDER BY e.id DESC');   
	
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}



/*-------------------------- start all uploaded certificate list ---------------------------------------------------*/
// service list

function count_all_uploaded_certificate_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('select count(*) as count from `certificates` ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_uploaded_certificate_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  * from `certificates`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function uploaded_certificate_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `certificates`   where ( enrollment_no LIKE "' . $search . '%" )   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function uploaded_certificate_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `certificates` where ( enrollment_no LIKE "' . $search . '%" ) ORDER BY id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}





/*------------------------ end upload certificate  list ------------------------------------------------------------*/







/*-------------------------- start all uploaded result list ---------------------------------------------------*/
// service list

function count_all_uploaded_result_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('select count(*) as count from `upload_result` ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_uploaded_result_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT  * from `upload_result`  ORDER BY id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function uploaded_result_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `upload_result`   where ( enrollment_no LIKE "' . $search . '%" )   ORDER BY id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function uploaded_result_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `upload_result` where ( enrollment_no LIKE "' . $search . '%" ) ORDER BY id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}





/*------------------------ end upload result  list ------------------------------------------------------------*/




/*-------------- start course list --------------------------------------------------*/


function count_all_course_list()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM  courses c left join  brand b on b.id=c.category ');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}

function all_course_list($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT *,c.id as id FROM courses c left join  brand b on b.id=c.category   ORDER BY c.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function course_list_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT *,c.id as id from courses c left join  brand b on b.id=c.category  where ( course_name LIKE "' . $search . '%" OR course_code LIKE "' . $search . '%" )  ORDER BY c.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}


function course_list_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from courses c left join  brand b on b.id=c.category where (  course_name LIKE "' . $search . '%" OR course_code LIKE "' . $search . '%"  )   ORDER BY c.id DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


/*-------------- end course list -------------------------------------------------*/








/*------------- START BRAND LIST --------------------*/

function count_all_occupation_type()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `business_list`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_occupation_type($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `business_list` ORDER BY BUSSINESS_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function occupation_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `business_list`  where (  BUSINESS_NAME LIKE "' . $search . '%" )  ORDER BY BUSSINESS_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function occupation_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `business_list` where (  BUSINESS_NAME LIKE "' . $search . '%" ) ORDER BY BUSSINESS_ID ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF BRAND LIST -------------------*/



/*------------- START BATCH LIST --------------------*/

function count_all_batch_type()
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `batch_session`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
function all_batch_type($limit, $start, $order, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `batch_session` ORDER BY BATCH_ID ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function batch_type_search($limit, $start, $search, $col, $dir)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `batch_session`  where (  BATCH_NAME LIKE "' . $search . '%" )  ORDER BY BATCH_ID ASC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}
function batch_type_search_count($search)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `batch_session` where (  BATCH_NAME LIKE "' . $search . '%" ) ORDER BY BATCH_ID ASC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
/*--------------- END OF BATCH LIST -------------------*/





/*----------- start show listing2----------------------------------------------------------------------------*/
function count_all_show_student2($status,$center)
{
	$ci = &get_instance();
	$ci->load->database();
    if($center == 'all'){
        $query = $ci->db->query('select count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join  subjects su on su.course_id=ad.course_id where   students.pay_status=1   ');  
    }else{
	    $query = $ci->db->query('select count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id  left join  subjects su on su.course_id=ad.course_id where   students.pay_status=1 and students.addmission_date<= "'.$status.'" and students.center_id="'.$center.'"   ');  
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_show_student2($limit, $start, $order, $dir,$status,$center)
{
	$ci = &get_instance();
	$ci->load->database();
	
	   if($center == 'all'){
          $query = $ci->db->query('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id left join  session_year se on se.id=students.session where  students.pay_status=1     ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
        }else{
	     $query = $ci->db->query('SELECT  *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob  from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id left join  session_year se on se.id=students.session where  students.pay_status=1   and students.center_id="'.$center.'"  ORDER BY ad.id  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	    }
	    if ($query->num_rows() > 0) {
		    return $query->result();
	    } else {
		    return null;
	    }
}


function show_student_search2($limit, $start, $search, $col, $dir,$status,$course,$center,$type,$year)
{
	$ci = &get_instance();
	$ci->load->database();
   
   	if($center == 'all'){
         $query = $ci->db->query('SELECT *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no   left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'"   AND ad.year = "'.$year.'" AND su.year="'.$year.'"    ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}else{
	    $query = $ci->db->query('SELECT *,su.id as subject_id, students.id as student_id, students.name as student_name,students.dob as student_dob from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'" and students.center_id="'.$center.'"     ORDER BY students.id DESC limit ' . $limit . ' OFFSET ' . $start . '');
	}
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function show_student_search_count2($search,$status,$course,$center,$type,$year)
{
	$ci = &get_instance();
	$ci->load->database();
	
	if($center == 'all'){
         $query = $ci->db->query('SELECT count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'"  AND ad.year = "'.$year.'" AND su.year="'.$year.'"   ORDER BY students.id DESC');
	}else{
	   $query = $ci->db->query('SELECT count(*) as count from admit_card ad left join `students` on students.enrollment_no=ad.enrollment_no  left join centers on centers.id=students.center_id  left join courses on courses.id=students.course_id left join  subjects su on su.course_id=students.course_id where ( students.enrollment_no LIKE "' . $search . '%" OR students.name LIKE "' . $search . '%" OR students.email LIKE "' . $search . '%" OR students.center_id LIKE "' . $search . '%"  )  and students.pay_status=1  and students.course_id="'.$course.'"   and students.center_id="'.$center.'" ORDER BY students.id DESC');
	}
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}
















/*----------------- start chairman --------------------------------------------------------*/
function count_all_chairman($status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count FROM `chairman`');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}


function all_chairman($limit, $start, $order, $dir,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * FROM `chairman`  ORDER BY CHAIRMAN_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function chairman_search($limit, $start, $search, $col, $dir,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT * from `chairman`  where ( CHAIRMAN_NAME LIKE "' . $search . '%" OR CHAIRMAN_EMAIL LIKE "' . $search . '%" OR CHAIRMAN_CONTACT LIKE "' . $search . '%" )  ORDER BY CHAIRMAN_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');
	if ($query->num_rows() > 0) {
		return $query->result();
	} else {
		return null;
	}
}

function chairman_search_count($search,$status)
{
	$ci = &get_instance();
	$ci->load->database();
	$query = $ci->db->query('SELECT count(*) as count from `chairman` where (  CHAIRMAN_NAME LIKE "' . $search . '%" OR CHAIRMAN_EMAIL LIKE "' . $search . '%" OR CHAIRMAN_CONTACT LIKE "' . $search . '%"  )  ORDER BY CHAIRMAN_ID DESC');
	$res = $query->result();
	if (!empty($res)) {
		return $res[0]->count;
	} else {
		return 0;
	}
}






/*-------------- end chairman ----------------------------------------------------------------*/




/*----------- start state office ------------------------------------------------------------*/

function count_all_state_office($status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count FROM  `state_office` LEFT JOIN state ON state.STATE_ID=state_office.SO_STATE_ID LEFT JOIN district ON district.DISTRICT_ID=state_office.SO_DISTRICT_ID ORDER BY state_office.SO_STATE_ID');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}

function all_state_office($limit, $start, $order, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * FROM  `state_office` LEFT JOIN state ON state.STATE_ID=state_office.SO_STATE_ID LEFT JOIN district ON district.DISTRICT_ID=state_office.SO_DISTRICT_ID ORDER BY state_office.SO_STATE_ID  ' . $dir . ' limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function state_office_search($limit, $start, $search, $col, $dir,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT * from  `state_office` LEFT JOIN state ON state.STATE_ID=state_office.SO_STATE_ID LEFT JOIN district ON district.DISTRICT_ID=state_office.SO_DISTRICT_ID   where ( state_office.SO_MOBILE LIKE "' . $search . '%" OR state_office.SO_EMAIL LIKE "' . $search . '%" )  ORDER BY state_office.SO_STATE_ID DESC limit ' . $limit . ' OFFSET ' . $start . '');

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return null;

	}

}

function state_office_search_count($search,$status)

{

	$ci = &get_instance();

	$ci->load->database();

	$query = $ci->db->query('SELECT count(*) as count from `state_office` LEFT JOIN state ON state.STATE_ID=state_office.SO_STATE_ID LEFT JOIN district ON district.DISTRICT_ID=state_office.SO_DISTRICT_ID   where ( state_office.SO_MOBILE LIKE "' . $search . '%" OR state_office.SO_EMAIL LIKE "' . $search . '%" )  ORDER BY state_office.SO_STATE_ID  DESC');

	$res = $query->result();

	if (!empty($res)) {

		return $res[0]->count;

	} else {

		return 0;

	}

}





/*------------------------- end state office------------------------------------------------*/






/*---------------- end show listing ----------------------------------------------------------------------------*/

/*-------------------------- end program -------------------------------------------------------*/
?>