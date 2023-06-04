$(document).ready(function () {

//      alert('backend');
   /*
   $('body').on('click', '.delete_exam_date', function () {
            $('.deleteexamid').val($(this).attr('deleteexamid'));
            $('#delete_exam_date').modal('show');
    });
    */
    
    
    $('body').on('click', '#news', function () {

            let id = $(this).data('news_id');
            let title = $(this).data('news_title');
            let desc = $(this).data('news_desc');
           $('#news-model-title').html(title);
           $('#news-model-desc').html(desc);
           $('#news-model-href').attr('href','welcome/download/'+id);
            $('#NewsModal150').modal('show');

    });

     
    $('body').on('click', '.update_news_letter', function () {
        
        $('.update_news_letter_id').val($(this).attr('update_news_letter_id'));
        $('.update_news_letter_title').val($(this).attr('update_news_letter_title'));
        $('.update_news_letter_desc').val($(this).attr('update_news_letter_desc'));
        $('.update_news_letter_link').val($(this).attr('update_news_letter_link'));
        $('#update_news_letter_modal').modal('show');
    });
    
    $('body').on('click', '.edit_brand_model', function () {
        
        
         $('.updatebrandid').val($(this).attr('brandid'));
        $('.update_brand_name').val($(this).attr('bname'));
        $('#edit_brand_model').modal('show');
    });
    
    $('body').on('click', '.update_category', function () {
        
        $('.update_category_id').val($(this).attr('uc_id'));
        $('.update_category_name').val($(this).attr('category_name'));
        $('#update_category_modal').modal('show');
    });
    
    
    
    $('body').on('click', '.edit_sub_category_model', function () {
        
        $('.update_sub_category_id').val($(this).attr('sc_id'));
        $('.update_sc_name').val($(this).attr('sc_name'));
        $('#update_sub_category_modal').modal('show');
    });
    
    
     $('body').on('click', '.edit_product', function () {
        
        $('.update_product_id').val($(this).attr('product_id'));
        $('.update_product_name').val($(this).attr('product_name'));
        $('#edit_product_modal').modal('show');
    });
    
    $('body').on('click', '.modal_add_firm', function () {
        $('#modal_add_firm').modal('show');
    });

        // update feedback 
    $('body').on('click', '.update_feedback', function () {
            $('.updatefeedbackid').val($(this).attr('updatefeedbackid'));
            $('.feedback_name').val($(this).attr('feedback_name'));
            $('.feedback_massage').val($(this).attr('feedback_massage'));
            $('#update_feedback_modal').modal('show');

    });
    // delete feedback request
    $('body').on('click', '.delete_feedback', function () {
            $('.feedbackdeleteid').val($(this).attr('feedbackdeleteid'));
            $('#delete_feedback_modal').modal('show');
    });


        $('body').on('click', '.update_member', function () {

            //alert($(this).attr('memberid'));

            $('.memberid').val($(this).attr('memberid'));

            $('.member_name').val($(this).attr('member_name'));

            $('.member_contact').val($(this).attr('member_contact'));

            $('.member_address').val($(this).attr('member_address'));

            $('.member_post').val($(this).attr('member_post'));

            $('.member_about_us').val($(this).attr('member_aboutus'));

            $('#modal_update_member').modal('show');

    });
      // delete volunteer request
      $('body').on('click', '.delete_member', function () {
            // alert($(this).attr('volunteerid'));
            $('.memberdeleteid').val($(this).attr('memberdeleteid'));
            $('#delete_member').modal('show');

    });


    

     $('body').on('click', '.model_add_new_item', function () {

       

     //  alert($('#stage_status').val());

      

        $('.project_stage').val($('#stage_status').val());

        

        $('#model_add_new_item').modal('show');

    });

     // update volunteer request
      $('body').on('click', '.update_volunteer', function () {

            // alert($(this).attr('volunteerid'));
            $('.volunteerid').val($(this).attr('volunteerid'));
            $('.volunteer_name').val($(this).attr('volunteer_name'));

            $('.vol_email').val($(this).attr('vol_email'));

            $('.vol_num').val($(this).attr('vol_num'));

            $('.massage').val($(this).attr('massage'));
            $('#update_volunteer_request').modal('show');

    });
    // delete volunteer request
      $('body').on('click', '.delete_volunteer', function () {

            // alert($(this).attr('volunteerid'));
            $('.deletevol').val($(this).attr('deletevol'));
           
            $('#delete_volunteer').modal('show');

    });
    // update vision request
      $('body').on('click', '.update_vision', function () {

            // alert($(this).attr('visiontitle'));
            $('.visionid').val($(this).attr('visionid'));
            $('.visiontitle').val($(this).attr('visiontitle'));
            $('.visiondesc').val($(this).attr('visiondesc'));
           
            $('#update_vision').modal('show');

    });
    // delete vision request
      $('body').on('click', '.delete_vision', function () {

            // alert($(this).attr('volunteerid'));
            $('.deletevision').val($(this).attr('deletevision'));
           
           
            $('#delete_vision').modal('show');

    });
     // update slider request
    //  alert('fjdkfj');
      $('body').on('click', '.update_slider_detail', function () {

            // alert($(this).attr('updatesliderid'));
            $('.updatesliderid').val($(this).attr('updatesliderid'));
            $('.slider_id').val($(this).attr('slider_id'));
            $('.slider_title').val($(this).attr('slider_title'));
            $('.slider_desc1').val($(this).attr('slider_desc1'));
            $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_slider_details').modal('show');

    });
    // delete slider
      $('body').on('click', '.delete_slider_detail', function () {

            // alert($(this).attr('updatesliderid'));
            $('.sliderdeleteid').val($(this).attr('sliderdeleteid'));
           
            $('#delete_slider_details').modal('show');

    });    
      // update fquestion request
      $('body').on('click', '.update_fquestion', function () {

            // alert($(this).attr('visiontitle'));
            $('.updatefquestionid').val($(this).attr('updatefquestionid'));
            $('.fquestion').val($(this).attr('fquestion'));
            $('.fanswer').val($(this).attr('fanswer'));
           
            $('#update_fquestion').modal('show');

    });
    // delete fquestion request
      $('body').on('click', '.delete_fquestion', function () {

            // alert($(this).attr('volunteerid'));
            $('.fquestiondeleteid').val($(this).attr('fquestiondeleteid'));
           
           
            $('#delete_fquestion').modal('show');

    });
       // update enquiry request
      $('body').on('click', '.update_enquiry', function () {

            // alert($(this).attr('enquiryid'));
            $('.enquiry_comment').val($(this).attr('enquiry_comment'));
            $('.enquiryid').val($(this).attr('enquiryid'));
            $('.enquiry_name').val($(this).attr('enquiry_name'));
             $('.enquiry_email').val($(this).attr('enquiry_email'));
              $('.enquiry_subject').val($(this).attr('enquiry_subject'));
           
            $('#update_enquiry').modal('show');

    });
      // delete fquestion request
      $('body').on('click', '.delete_enquiry', function () {

            // alert($(this).attr('volunteerid'));
            $('.deleteenquiry').val($(this).attr('deleteenquiry'));
           
           
            $('#delete_enquiry').modal('show');

    });
         // update cause request
      $('body').on('click', '.update_causes_detail', function () {

            // alert($(this).attr('enquiryid'));
            $('.updatecausesid').val($(this).attr('updatecausesid'));
            $('.causes').val($(this).attr('causes'));
            $('.cause_title').val($(this).attr('cause_title'));
            $('.cause_desc').val($(this).attr('cause_desc'));
            $('.raised').val($(this).attr('raised'));
            $('.button_name').val($(this).attr('button_name'));
            $('.goal').val($(this).attr('goal'));
           
            $('#update_causes').modal('show');

    });
      // delete cause request
      $('body').on('click', '.delete_causes_detail', function () {

            // alert($(this).attr('volunteerid'));
            $('.causesdeleteid').val($(this).attr('causesdeleteid'));
           
           
            $('#delete_cause').modal('show');

    });
      $('body').on('click', '.delete_member', function () {

            // alert($(this).attr('volunteerid'));
            $('.memberdeleteid').val($(this).attr('memberdeleteid'));
           
           
            $('#delete_member').modal('show');

    });
       $('body').on('click', '.update_agent', function () {

            // alert($(this).attr('updatesliderid'));
            $('.agentid').val($(this).attr('agentid'));
            $('.agentname').val($(this).attr('agentname'));
            $('.agentusername').val($(this).attr('agentusername'));
            $('.agentpass').val($(this).attr('agentpass'));
            // $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_agent').modal('show');

    });
       $('body').on('click', '.delete_agent', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deleteagentid').val($(this).attr('deleteagentid'));
           
            $('#delete_agent').modal('show');

    });
        $('body').on('click', '.update_plan', function () {
            $('.plan_id').val($(this).attr('plan_id'));
            $('.planid').val($(this).attr('planid'));
            $('.planname').val($(this).attr('planname'));
            $('.update_commision').val($(this).attr('update_commision'));
           
            $('#update_plan').modal('show');

    });
       $('body').on('click', '.delete_plan', function () {

           
            $('.deleteplanid').val($(this).attr('deleteplanid'));
                      
            $('#delete_plan').modal('show');

    });
     $('body').on('click', '.update_user', function () {

          //  alert('jfkdjfkdf');
            $('.updateuserid').val($(this).attr('updateuserid'));
            $('.user_dpt_name').val($(this).attr('user_dpt_name'));
            $('.user_name').val($(this).attr('user_name'));
            $('.user_user_name').val($(this).attr('user_user_name'));
            $('.user_password').val($(this).attr('user_password'));
                      
                      
            $('#update_user').modal('show');

    });
    $('body').on('click', '.delete_user', function () {

          //  alert('jfkdjfkdf');
            $('.deleteuserid').val($(this).attr('deleteuserid'));
            // $('.chart_age').val($(this).attr('chart_age'));
            // $('.chart_amount').val($(this).attr('chart_amount'));
            // $('.chart_mode').val($(this).attr('chart_mode'));
                      
            $('#delete_user').modal('show');

    });
   
//latest news
   $('body').on('click', '.update_latest_news', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updatelatestnewsid').val($(this).attr('updatelatestnewsid'));
            $('.latest_news_title').val($(this).attr('latest_news_title'));
            $('.latest_news_desc').val($(this).attr('latest_news_desc'));
            // $('.latest_news_date').val($(this).attr('news_date'));
            // $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_latest_news').modal('show');

    });
       $('body').on('click', '.delete_latest_news', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deletelatestnewsid').val($(this).attr('deletelatestnewsid'));
           
            $('#delete_latest_news').modal('show');

    });
    // advance notice
    
   $('body').on('click', '.update_advance_notice', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updateadvancenoticeid').val($(this).attr('updateadvancenoticeid'));
            $('.advance_notice_title').val($(this).attr('advance_notice_title'));
            $('.advance_notice_desc').val($(this).attr('advance_notice_desc'));
            // $('.latest_news_date').val($(this).attr('news_date'));
            // $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_advance_notice').modal('show');

    });
       $('body').on('click', '.delete_advance_notice', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deleteadvancenoticeid').val($(this).attr('deleteadvancenoticeid'));
           
            $('#delete_advance_notice').modal('show');

    });
//update flash image
   $('body').on('click', '.update_flash_image', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updateadvancenoticeid').val($(this).attr('updateadvancenoticeid'));
            $('.flash_image_title').val($(this).attr('flash_image_title'));
            $('.flash_image_desc').val($(this).attr('flash_image_desc'));
            // $('.latest_news_date').val($(this).attr('news_date'));
            // $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_flash_image').modal('show');

    });
    $('body').on('click', '.delete_flash_image', function () {
	        $('.deleteflashimageid').val($(this).attr('deleteflashimageid'));
           
            $('#delete_flash_image').modal('show');

    });


    // news
   $('body').on('click', '.update_news', function () {

            // alert($(this).attr('updatesliderid'));
            $('.updatenewsid').val($(this).attr('updatenewsid'));
            $('.news_title').val($(this).attr('news_title'));
            $('.news_desc').val($(this).attr('news_desc'));
            $('.news_date').val($(this).attr('news_date'));
            // $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_news').modal('show');

    });
       $('body').on('click', '.delete_news', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deletenewsid').val($(this).attr('deletenewsid'));
           
            $('#delete_news').modal('show');

    });
// notice
   $('body').on('click', '.update_notice', function () {

            // alert($(this).attr('updatesliderid'));
            $('.updatenoticeid').val($(this).attr('updatenoticeid'));
            $('.notice_title').val($(this).attr('notice_title'));
            $('.notice_desc').val($(this).attr('notice_desc'));
            $('.notice_date').val($(this).attr('notice_date'));
            // $('.slider_desc2').val($(this).attr('slider_desc2'));
            // $('.slider_button').val($(this).attr('slider_button'));
           
            $('#update_notice').modal('show');

    });
       $('body').on('click', '.delete_notice', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deletenoticeid').val($(this).attr('deletenoticeid'));
           
            $('#delete_notice').modal('show');

    });


 $('body').on('click', '.add_document', function () {

            $('.form_id').val($(this).attr('form_id'));
            $('.agent_id').val($(this).attr('agent_id'));
            $('.form_name').val($(this).attr('form_name'));
            $('#modal_add_document').modal('show');
    });
    $('body').on('click', '.add_comment', function () {

            $('.formid').val($(this).attr('formid'));
            $('.agentid').val($(this).attr('agentid'));
            $('.formname').val($(this).attr('formname'));
            $('#modal_add_comment').modal('show');
    });
 
  $('body').on('click', '.approved', function () {

            $('.request_id').val($(this).attr('request_id'));
            $('.agentrequest_id').val($(this).attr('agentrequest_id'));
            // $('.form_name').val($(this).attr('form_name'));
            $('#approve_wallet_request').modal('show');
    });
  $('body').on('click', '.reject', function () {

            $('.reject_id').val($(this).attr('reject_id'));
            // $('.agentreject_id').val($(this).attr('agentreject_id'));
            // $('.form_name').val($(this).attr('form_name'));
            $('#reject_wallet_request').modal('show');
    });
    $('body').on('click', '.update_dpt', function () {

            $('.updatedepartmentid').val($(this).attr('updatedepartmentid'));
            $('.department').val($(this).attr('dpt_name'));
            $('.code').val($(this).attr('dpt_id'));
            $('#update_department').modal('show');
    });
// service comment
$('body').on('click', '.add_service_comment', function () {

            $('.serviceid').val($(this).attr('serviceid'));
            // $('.department').val($(this).attr('dpt_name'));
            // $('.code').val($(this).attr('dpt_id'));
            $('#modal_add_service_comment').modal('show');
    });
     $('body').on('click', '.update_service', function () {
// alert('in');
            $('.service_id').val($(this).attr('service_id'));
            $('.servicetitle').val($(this).attr('servicetitle'));
            $('.service_dec').val($(this).attr('service_dec'));
            $('#update_service').modal('show');
    });
      $('body').on('click', '.delete_service', function () {

            $('.delete_service_id').val($(this).attr('delete_service_id'));
            // $('.agentreject_id').val($(this).attr('agentreject_id'));
            // $('.form_name').val($(this).attr('form_name'));
            $('#delete_service').modal('show');
    });
    $('body').on('click', '.update_features', function () {
// alert('in');
            $('.features_id').val($(this).attr('features_id'));
            $('.featurestitle').val($(this).attr('featurestitle'));
            $('.featuresdesc').val($(this).attr('featuresdesc'));
            $('#update_features').modal('show');
    });
      $('body').on('click', '.delete_features', function () {

            $('.delete_features_id').val($(this).attr('delete_features_id'));
            // $('.agentreject_id').val($(this).attr('agentreject_id'));
            // $('.form_name').val($(this).attr('form_name'));
            $('#delete_features').modal('show');
    });
    // information board
      $('body').on('click', '.update_information_board', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.board_name').val($(this).attr('board_name'));
            $('.board_url').val($(this).attr('board_url'));
            $('.updateinformationboardid').val($(this).attr('updateinformationboardid'));
            
           
            $('#update_information_board').modal('show');

    });
       $('body').on('click', '.delete_information_baord', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deleteinformationboardid').val($(this).attr('deleteinformationboardid'));
           
            $('#delete_information_baord').modal('show');

    });
	$('body').on('click', '.update_admission_notice', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.notice_name').val($(this).attr('notice_name'));
            $('.notice_url').val($(this).attr('notice_url'));
            $('.updateadmissionnoticeid').val($(this).attr('updateadmissionnoticeid'));
            
           
            $('#update_admission_notice').modal('show');

    });
       $('body').on('click', '.delete_admission_notice', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deleteadmissionnoticeid').val($(this).attr('deleteadmissionnoticeid'));
           
            $('#delete_admission_notice').modal('show');

    });
	$('body').on('click', '.update_branches', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.branches_title').val($(this).attr('branches_title'));
            $('.branches_desc').val($(this).attr('branches_desc'));
            $('.branches_url').val($(this).attr('branches_url'));
            $('.updatebranchesid').val($(this).attr('updatebranchesid'));
            
           
            $('#update_branches').modal('show');

    });
       $('body').on('click', '.delete_branches', function () {

            // alert($(this).attr('updatesliderid'));
            $('.deletebranchesid').val($(this).attr('deletebranchesid'));
           
            $('#delete_branches').modal('show');

    });
// update event
$('body').on('click', '.update_event', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updateeventtitle').val($(this).attr('updateeventtitle'));
            $('.updateeventdesc').val($(this).attr('updateeventdesc'));
            // $('.branches_url').val($(this).attr('branches_url'));
            $('.updateeventid').val($(this).attr('updateeventid'));
            
           
            $('#update_event').modal('show');

    });
       $('body').on('click', '.delete_event', function () {

            
            $('.blogeventid').val($(this).attr('blogeventid'));
           
            $('#delete_event').modal('show');

    });
    // update gallery
$('body').on('click', '.update_gallery', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updategallerytitle').val($(this).attr('updategallerytitle'));
            $('.updategallerydesc').val($(this).attr('updategallerydesc'));
            // $('.branches_url').val($(this).attr('branches_url'));
            $('.updategalleryid').val($(this).attr('updategalleryid'));
            
           
            $('#update_gallery').modal('show');

    });
       $('body').on('click', '.delete_gallery', function () {

            
            $('.deletegalleryid').val($(this).attr('deletegalleryid'));
           
            $('#delete_gallery').modal('show');

    });
    // update gallery
$('body').on('click', '.update_exam', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updateexamtitle').val($(this).attr('updateexamtitle'));
            $('.updateexamdesc').val($(this).attr('updateexamdesc'));
            // $('.branches_url').val($(this).attr('branches_url'));
            $('.updateexamid').val($(this).attr('updateexamid'));
            
           
            $('#update_exam').modal('show');

    });
       $('body').on('click', '.delete_exam', function () {

            
            $('.deleteexamid').val($(this).attr('deleteexamid'));
           
            $('#delete_gallery').modal('show');

    });
// add
$('body').on('click', '.update_add', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updateaddtitle').val($(this).attr('updateaddtitle'));
            $('.updateadddesc').val($(this).attr('updateadddesc'));
            // $('.branches_url').val($(this).attr('branches_url'));
            $('.updateaddid').val($(this).attr('updateaddid'));
            
           
            $('#update_add').modal('show');

    });
       $('body').on('click', '.delete_add', function () {

            
            $('.deleteaddid').val($(this).attr('deleteaddid'));
           
            $('#delete_add').modal('show');

    });
     $('#practical').on('click', function () {
        //  alert();
            var c = this.checked ? 1 : 0;
            console.log(c);
            if (c) {
                // $('#ext_url_link').prop("disabled", false);
                $('#practical_marks').fadeIn();
                

            } 
            else {
                // $('#ext_url_link').prop("disabled", true);
                $('#practical_marks').fadeOut();
                

            }
        });
        // monthly course
        $('#monthly').on('change', function () {
         
            var c = this.checked ? 1 : 0;
            alert(c);
            if (c==1) {
                
                $("#monthly_yearly_course").html('<input type="number" name="duration" class="form-control monthly_course" placeholder="Enter Course in months"   required="">');
                //$("#content_type_title").html('URL');
                
                // $('.yearly_course').hide();
                // $('.monthly_course').show();
            } 
            
        });
        // yearly course
        $('#yearly').on('change', function () {
            var c = this.checked ? 1 : 0;
            if (c==1) {
                
                 $("#monthly_yearly_course").html('<input type="number"  name="yearly_course" class="form-control yearly_course"  placeholder="Enter Course in years"  required="">');
                
                // $('.yearly_course').show();
                // $('.monthly_course').hide();
            } 
            
        });
        // theory subject 
        $('#theory').on('change', function () {
          //alert();
            var c = this.checked ? 1 : 0;
            console.log(c);
            if (c==1) {
                // $('#ext_url_link').prop("disabled", false);
                //$('.practical_marks').hide();
                //$('.theory_marks').show();
                $('.practical_marks').html('');
                $(".theory_marks").html('<input type="number" min="0" class="form-control" name="max_marks" required="" placeholder="Enter Subject Max Marks"><input type="number" min="0" class="form-control" name="min_marks" required="" placeholder="Enter Subject Min Marks">');
            } 
            
        });
        // practical subject
        $('#practical').on('change', function () {
        //  alert();
            var c = this.checked ? 1 : 0;
            console.log(c);
            if (c==1) {
                // $('#ext_url_link').prop("disabled", false);
                
                $('.theory_marks').html('');
                $(".practical_marks").html('<input type="number" min="0" class="form-control" name="practical_max_marks"  placeholder="Enter Subject Max Marks"><input type="number" min="0" class="form-control" name="practical_min_marks"  placeholder="Enter Subject Min Marks">');
               // $('.theory_marks').hide();
                

            } 
            
        });
        // both subject
        $('#both').on('change', function () {
        //  alert();
            var c = this.checked ? 1 : 0;
            console.log(c);
            if (c==1) {
                // $('#ext_url_link').prop("disabled", false);
                $(".theory_marks").html('<input type="number" min="0" class="form-control" name="max_marks" required="" placeholder="Enter Subject Max Marks"><input type="number" min="0" class="form-control" name="min_marks" required="" placeholder="Enter Subject Min Marks">');
                $(".practical_marks").html('<input type="number" min="0" class="form-control" name="practical_max_marks"  placeholder="Enter Subject Max Marks"><input type="number" min="0" class="form-control" name="practical_min_marks"  placeholder="Enter Subject Min Marks">');

            } 
            
        });

/*        
        $('#theory').on('click', function () {
        //  alert();
            var c = this.checked ? 1 : 0;
            console.log(c);
            if (c) {
                // $('#ext_url_link').prop("disabled", false);
                $('.practical_marks').hide();
                

            } 
            else {
                // $('#ext_url_link').prop("disabled", true);
                $('#practical_marks').fadeOut();
                

            }
        });
        
*/        
        
        
    // update student
    $('body').on('click', '.update_student', function () {
// alert('fjdkfj');
            // alert($(this).attr('updatesliderid'));
            $('.updatestudenttitle').val($(this).attr('updatestudenttitle'));
            $('.updatestudentdesc').val($(this).attr('updatestudentdesc'));
            // $('.branches_url').val($(this).attr('branches_url'));
            $('.updatestudentid').val($(this).attr('updatestudentid'));
            
           
            $('#update_student').modal('show');

    });
       $('body').on('click', '.delete_student', function () {

            
            $('.deletestudentid').val($(this).attr('deletestudentid'));
           
            $('#delete_student').modal('show');

    });
//     alert('hiiiii');
        $('input[name="ext_url"]').on('change', function () {
            let val = $(this).val();
        //     var c = this.checked ? 1 : 0;
        // //     console.log('hello');
            if (val == 'ext_link') {
                // $('#ext_url_link').prop("disabled", false);
                $('#ext_url_link').fadeIn();
                $('#int_url_link').fadeOut();
            } else {
                // $('#ext_url_link').prop("disabled", true);
                $('#ext_url_link').fadeOut();
                $('#int_url_link').fadeIn();
            }
        });
		 $('#ext_url').on('change', function () {
            var c = this.checked ? 1 : 0;
        //     console.log('hello');
            if (c) {
                // $('#ext_url_link').prop("disabled", false);
                $('#open_link').fadeIn();
                

            } else {
                // $('#ext_url_link').prop("disabled", true);
                $('#open_link').fadeOut();
                

            }
        })
             $('#sub_menu').on('change', function () {
                //      alert();
            var c = this.checked ? 1 : 0;
        //     console.log('hello');
            if (c) {
                // $('#ext_url_link').prop("disabled", false);
                $('#submenu').fadeIn();
                

            } else {
                // $('#ext_url_link').prop("disabled", true);
                $('#submenu').fadeOut();
                

            }
        });
          $('#sub_sub_menu').on('change', function () {
            var c = this.checked ? 1 : 0;
        //     console.log('hello');
            if (c) {
                // $('#ext_url_link').prop("disabled", false);
                $('#subsubmenu').fadeIn();
                

            } else {
                // $('#ext_url_link').prop("disabled", true);
                $('#subsubmenu').fadeOut();
                

            }
        });
            $('#sub_menu').on('change', function () {
                //      alert();
            var c = this.checked ? 1 : 0;
        //     console.log('hello');
            if (c) {
                // $('#ext_url_link').prop("disabled", false);
                $('#toggle_submenu').fadeIn();
                

            } else {
                // $('#ext_url_link').prop("disabled", true);
                $('#toggle_submenu').fadeOut();
                

            }
        });
   
// OPEN LINK STATUS
 
       $('#openlink').change(function(){
       
      if($(this).prop('checked'))
      {
        
       $('#openlinkstatus').val('1');
      }
      else
      {
      
       $('#openlinkstatus').val('0');
      }
  });
//   URL ADDRESS
      $('#ext_url').change(function(){
       
      if($(this).prop('checked'))
      {
        
       $('#ext_url_status').val('1');
      }
      else
      {
      
       $('#ext_url_status').val('0');
      }
  });

});