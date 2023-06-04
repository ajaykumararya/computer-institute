<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';
 
 $route['default_controller'] = 'welcome';
 $route['404_override'] = '';
$route['pages'] = 'site/pages';
$route['pages/:num'] = 'site/pages';


if($this->uri->segment(2)!= ''){

    if($this->uri->segment(1) == 'course-detail'){
        $route['course-detail/:num'] = "welcome/course_detail/$1";    
    }else if($this->uri->segment(1) =='blog-detail'){
        $route['blog-detail/:num'] = "welcome/blog_detail/$1";
    }else if($this->uri->segment(1) =='download'){
     $route['download/(:any)'] = "admin/download/$1";
    }else if($this->uri->segment(1) =='download-admit-card'){
        $route['download-admit-card/:num'] = "welcome/download_admit_card/$1";
    }else if($this->uri->segment(1) =='print-id'){
        $route['print-id/:num'] = "printbill/id_demo/$1";
    }else if($this->uri->segment(1) =='admit-card'){
        $route['admit-card/:num'] = "printbill/admit_card/$1";
    }else if($this->uri->segment(1) =='generate-certificate'){
        $route['generate-certificate/:num'] = "printpdf/print_student_certificate/$1";
    }else if($this->uri->segment(1) =='generate-admit-card'){
        $route['generate-admit-card/:num'] = "printpdf/print_admit_card/$1";
    }else if($this->uri->segment(1) =='generate-id-card'){
        $route['generate-id-card/:num'] = "printpdf/print_id/$1";
    }else if($this->uri->segment(1) =='generate-admission-form'){
        $route['generate-admission-form/:num'] = "printpdf/print_admission_form/$1";
    }else if($this->uri->segment(1) =='generate-marksheet'){
        $route['generate-marksheet/:num'] = "printpdf/print_student_marksheet/$1";
    }else if($this->uri->segment(1) =='print-certificate'){
        $route['print-certificate/:num'] = "printbill/print_certificate/$1";
    }else if($this->uri->segment(1) =='print-marksheet'){
        $route['print-marksheet/:num'] = "printpdf/print_marksheet/$1";
    }else if($this->uri->segment(1) =='print-form'){
        $route['print-form/:num'] = "printbill/print_form/$1";
    }else if($this->uri->segment(1) =='download-result'){
        $route['download-result/:num'] = "welcome/download_result/$1";
    }else if($this->uri->segment(1) =='download-student-id'){
        $route['download-student-id/:num'] = "welcome/print_student_id/$1";
    }else if($this->uri->segment(1) =='download-certificate'){
        $route['download-certificate/:num'] = 'welcome/print_certificate/$1';
    }else if($this->uri->segment(1) =='get-certificate'){
        $route['get-certificate/:num'] = 'welcome/get_certificate/$1';
    }else if($this->uri->segment(1) =='course-category'){
        $route['course-category/:num'] = 'welcome/get_course_category_detail/$1';
        
        //$route['course-category'] = 'welcome/get_course_category_detail';
    }else{
        
    }

}else{
        if($this->uri->segment(1) =='admit-card'){
            $route['admit-card'] = 'welcome/get_admit_card';
        }
        if($this->uri->segment(1) =='enrollment-verification'){
            $route['enrollment-verification'] = 'welcome/enrollment_verification';
        }
        if($this->uri->segment(1) =='get-certificate'){
            $route['get-certificate'] = 'welcome/get_certificate/$1';
        }
        if($this->uri->segment(1) =='print-marksheet'){
            $route['print-marksheet'] = "welcome/get_marksheet/";
        }
        
}

if($this->uri->segment(1) =='form-download'){
    $route['form-download'] = 'welcome/print_preview';


}else if($this->uri->segment(1) =='member-registration'){
    $route['member-registration'] = 'welcome/registration';
}else if($this->uri->segment(1) =='volunteer-registration'){
    $route['volunteer-registration'] = 'welcome/volunteer_registration';
}else if($this->uri->segment(1) =='signup'){
            $route['signup'] = 'welcome/student_registration';
}else if($this->uri->segment(1) =='get-result'){
                $route['get-result'] = 'welcome/get_result';
}else if($this->uri->segment(1) =='admit-card'){
            $route['admit-card'] = 'welcome/get_admit_card';
}else if($this->uri->segment(1) =='franchise-registration'){
        $route['franchise-registration'] = "welcome/franchisee_registration";
}else if($this->uri->segment(1) =='student-registration'){
        $route['student-registration'] = "welcome/student_form";
}else if($this->uri->segment(1) =='e-certificate'){
            $route['e-certificate'] = 'welcome/e_certificate/';
}else if($this->uri->segment(1) =='our-course'){
            $route['our-course'] = "welcome/our_course";
}else if($this->uri->segment(1) =='center-list'){
            $route['center-list'] = "welcome/list_center";
}else if($this->uri->segment(1) =='blogs'){
            $route['blogs'] = 'welcome/blogs';
}else if($this->uri->segment(1) =='our-teacher-detail'){
            $route['our-teacher-detail'] = 'welcome/our_teacher_detail';
}else if($this->uri->segment(1) =='contact'){
        $route['contact'] = 'welcome/contact';
}else if($this->uri->segment(1) =='events'){
        $route['events'] = 'welcome/events';
}else if($this->uri->segment(1) =='faq'){
        $route['faq'] = 'welcome/faq';
}else if($this->uri->segment(1) =='team-members'){
   $route['team-members'] = 'welcome/team_members';
}else if($this->uri->segment(1) =='vision'){
        $route['vision'] = 'welcome/vision';
}else if($this->uri->segment(1) =='our-teacher'){
    $route['our-teacher'] = 'welcome/our_teacher';
}else if($this->uri->segment(1) =='gallery'){
    $route['gallery'] = 'welcome/gallery';
}else if($this->uri->segment(1) =='site-download'){
    $route['site-download'] = 'welcome/site_download/';
}else{
    
    
  //$str =   str_replace("&","and",$this->uri->segment(1));
    
    $route['(:any)/:num'] = 'welcome/dynamic_page';    
}






//$route['page-name/:num'] = 'welcome/dynamic_page';



$route['product-listing'] = 'welcome/product_listing';

$route['home'] = 'welcome/index';
$route['index'] = 'welcome/home';
$route['login'] = 'welcome/login';
$route['cart-list'] = 'welcome/cart_list';
// $route['index'] = 'admin/student_list';

$route['download-history'] = 'welcome/download_history';
$route['translate_uri_dashes'] = true;

$route['uploads'] = "uploads";









$route['member-registration/:num'] = 'welcome/volunteer_registration/';
$route['about-us'] = 'welcome/about_us';
$route['demo'] = 'welcome/demo_check';
$route['logout'] = "welcome/logout";
$route['schedule-syllabus'] = "welcome/syllabus";



$route['center-login'] = "welcome/center_login";



$route['student-login'] = "welcome/student_form";










