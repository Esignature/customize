<?php
class SetLang{
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
    }

    function setLangSession() {
        
        if(isset($_POST['__set_lng'])){           
           $_COOKIE['visitor_lang'] = $_SESSION['visitor_lang'] = $_POST['__set_lng'];            
        }
        
        $visitor_lang = get_cookie('visitor_lang');          
        
        if($visitor_lang == '')
            $visitor_lang = $this->CI->config->item('language');
        
        // Sets a constant to use throughout ALL of CI.
        define('CURRENT_LANGUAGE', $visitor_lang);       
    }    
}