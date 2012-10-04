<?php

class DynamicConfig{
    var $CI;

    function __construct(){
        $this->CI =& get_instance();
    }

    function setSiteConfig() {
        
        $r = $this->CI->db->get('tbl_settings');
        foreach($r->result() as $row){
            //$config[$row->setting_key] = $row->setting_value;
            $this->CI->config->set_item($row->setting_key, $row->setting_value);
        }

    }
}