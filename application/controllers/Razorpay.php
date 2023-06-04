<?
class Razorpay extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    
    function success()
    {
        echo '<pre>';
        print_r($_POST);
    }
    
    function failer()
    {
        echo '<pre>';
        print_r($_POST);
    }
    
    function callback()
    {
        $post = $this->input->post();
	      
        
        /*-------------- image -----------------*/

						
            

        if($post){
            
            /*---------------------- start upload image  ---------------------------------------*/
           /*
            $banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}     
                    if ($_FILES['image']['name']) {
						$arr1 = array(
										 'MEMBER_PHOTO' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									);
					}
            */
                   
            
            /*------------------------- end uplod image -----------------------------------------*/
            $database = 'payment_transaction';
            //$six_digit_random_number = random_int(100000, 999999);
            $six_digit_random_number = $post['uid'];
               $tran = array(
                        'payment_id'   =>  $post['razorpay_payment_id'],
                        'transaction'  => $post['merchant_amount'],
                        'txnid'        => $post['merchant_trans_id'],
                      //  'payment_type' => $post['need_id_card'],
                        //'vounteer_no'=> '1122334455',
                        //'vounteer_email'=>'pank@gmail.com',
                        'vounteer_no'=> @$post['phone'],
                        'vounteer_email'=>@$post['email'],
                        'MEMBER_REG_CODE' => $six_digit_random_number,
                );
				
			    $this->db->insert($database,$tran);
              /*  
                $database2 = 'member_list';
                
                 $tran2 = array(
                          'MEMBER_NAME'   =>  $post['name'],
                          'MEMBER_EMAIL'  => $post['email'],
                          'MEMBER_PHONE'  => $post['phone'],
                          'MEMBER_ADDRESS' => $post['address'],
                          'MEMBER_DOB'=> $post['date'],
                          'MEMBER_CODE' =>$six_digit_random_number,
                          'MEMBER_STATE' =>$post['state'],
                          'MEMBER_DISTRICT' =>$post['district'],
                          'MEMBER_CITY' =>$post['city'],
                  );
              
              
              $arr3 = array_merge($tran2,$arr1);	
              
              $this->db->insert($database2,$arr3);
            */     
               redirect(site_url('member-registration/'.$six_digit_random_number.''));
        }else{
             
             print_r($this->input->post());
             ////redirect(site_url('member-registration/'.$six_digit_random_number.''));
        }
    }


  function callback2()
    {
         $post = $this->input->post();
         
         
         
         /*---------------------- start upload image  ---------------------------------------*/
            $banner=$_FILES['image']['name']; 

                    	if($banner!=''){

                        	$file_size = $_FILES['image']['size'];

                        	

                        	$expbanner=explode('.',$banner);

                    		$allowed_format = array('jpg','jpeg','png');	

                    		//if(in_array(strtolower(end($expbanner)),$allowed_format)){	

                    			$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';	

                    			$full_file_name = uniqid().".".end($expbanner);		

                    			$uploadfile = $uploaddir.$full_file_name;

                    			$upload_nm=$full_file_name;

                				move_uploaded_file($_FILES["image"]["tmp_name"] , $uploadfile);

						}else{

							$upload_nm = '';

						}     
                    if ($_FILES['image']['name']) {
						$arr1 = array(
										 'MEMBER_PHOTO' => $upload_nm, 
									);
					}else{
						$arr1 = array(
									);
					}
            
            
            
            /*------------------------- end uplod image -----------------------------------------*/
        // print_r($post);
         
         
      $database2 = 'member_list';
                $six_digit_random_number = random_int(100000, 999999);
                $tran2 = array(
                          'MEMBER_NAME'   =>  $post['name'],
                          'MEMBER_EMAIL'  => $post['email'],
                          'MEMBER_PHONE'  => $post['phone'],
                          'MEMBER_ADDRESS' => $post['address'],
                          'MEMBER_DOB'      => $post['date'],
                          'MEMBER_CODE'     =>$six_digit_random_number,
                          'MEMBER_STATE'    =>$post['state'],
                          'MEMBER_DISTRICT' =>$post['district'],
                          'MEMBER_CITY'     =>$post['city'],
                );
	
	
	        $arr3 = array_merge($tran2,$arr1);	
	
        

  $member = $this->db->query("SELECT * FROM `member_list` WHERE `MEMBER_PHONE` LIKE '".$_POST['phone']."' AND `MEMBER_DOB` = '".$_POST['date']."' ")->row();
  
  $member_num = $this->db->query("SELECT * FROM `member_list` WHERE `MEMBER_PHONE` LIKE '".$_POST['phone']."' AND `MEMBER_DOB` = '".$_POST['date']."' ")->num_rows();
   if($member_num > 0){
     echo $member->MEMBER_CODE;
   }else{
       $this->db->insert($database2,$arr3);
        $last_id = $this->db->insert_id();
        if($last_id!=0){
            echo $six_digit_random_number;
        }else{
            echo 0;
        }
   }


      
           

    }


}
?>