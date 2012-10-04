<?php

// create the url with the keyword 'site/'
if(!function_exists('fsite_url')){
    
    function fsite_url($uri){
        $CI = & get_instance();
        $fp = $CI->config->item('fsite_page'); 
        return $CI->config->site_url($fp.$uri);
    }
}


// return the full current url.
if(!function_exists('full_url')){
    
    function full_url(){
        $CI = & get_instance();
        return $CI->config->site_url().$CI->uri->uri_string();
    }
}