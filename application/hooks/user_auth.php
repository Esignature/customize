<?php

class UserAuth{
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
    }

	/*function setTimeZone(){
		
		date_default_timezone_set ( 'Asia/Kathmandu' );
	
	}*/

    function is_logged_in() {
		//$this->setTimeZone();
		$controller = $this->CI->router->fetch_class();
        $action = $this->CI->router->fetch_method();
		//redirect(fsite_url('dashboard/index'));
		if($this->is_auth_region()){		     
            if(!$this->CI->session->userdata(APPID.'_loggedin')) {			
    			if($controller == 'user' && (in_array($action, array('index', 'login', 'register', 'forgot', 'confirm', 'register_post', 'cancel', 'logout', 'validate_captcha', 'validate_email', 'validate_pkg', 'website_available')))){				
    				//do nothing			
    			}else {
    				redirect(fsite_url('user/login'));
    			}		
    		}elseif($controller == 'user' && $action == 'login'){
                 redirect(fsite_url('dashboard/index'));
    		}			
		}else{
		}
    }
    
    // check if the current page is within authenticable area: like site/
    function is_auth_region(){

        $this->CI = & get_instance();
        $this->CI->config->load('site_config');
        $fsite_page = $this->CI->config->item('fsite_page');
        $fsite_page = rtrim($fsite_page, '/');
        return $this->CI->uri->segment(1) == $fsite_page; 
        
    }
}