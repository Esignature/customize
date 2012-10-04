<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// get referrers defined for the current selected site in the dashboard
if(!function_exists('getSiteReferrers')){
    function getSiteReferrers($container_id = -1){
        $c = array();
        $CI  = & get_instance(); 
        
        $cur_site_info = $CI->session->userdata(APPID.'_current_site');
        $cur_site_id = $cur_site_info['site_id'];                 
        $CI->db->select('ref_id, name, domain, ref_container')
                   ->from('tbl_setting_referrer AS sr')
                   ->join('tbl_referrer_container AS rc', 'sr.ref_container_id = rc.ref_container_id', 'left')
                   ->where('site_id', $cur_site_id)                   
                   ->order_by('name', 'asc');
        
        if($container_id>-1){
            $CI->db->where('sr.ref_container_id', $container_id);
        }
        
        $query = $CI->db->get();
                        
        foreach($query->result() as $row){
            
            $c[$row->ref_id] = array(
                                        'name' => $row->name,
                                        'domain' => $row->domain,
                                        'ref_container' => $row->ref_container
                                        );
        }   
        return $c;
    }
}


// get referrers defined for the current selected site in the dashboard
if(!function_exists('getSiteCommercialReferrers')){
    function getSiteCommercialReferrers(){
        $c = array();
        $ref = getSiteReferrers(10);
        foreach($ref as $k=>$row){            
            $c[$k] = $row['name'] . ' (' . $row['domain'] . ')';
        }
        return $c; 
    }
}



// get domain container types or domain types
if(!function_exists('getDomainTypes')){
    function getDomainTypes(){
        $c = array();
        $CI  = & get_instance();        
                   
        $CI->db->select('ref_container_id AS id, ref_container AS name')
                   ->from('tbl_referrer_container')                   
                   ->order_by('ref_container', 'asc');
        
        $query = $CI->db->get();                
        foreach($query->result() as $row){            
            $c[$row->id] = $row->name;
        }   
        return $c;
    }
}

// get search domain container types or domain types
if(!function_exists('getSearchDomainTypes')){
    function getSearchDomainTypes(){
        $c = array();
        $CI  = & get_instance();        
                   
        $CI->db->select('ref_container_id AS id, ref_container AS name')
                   ->from('tbl_referrer_container')  
                   ->where_in('ref_container_id', array(2, 8))                 
                   ->order_by('ref_container', 'asc');
        
        $query = $CI->db->get();               
        foreach($query->result() as $row){            
            $c[$row->id] = $row->name;
        }
        return $c;
    }
}

// get saved campaigns
if(!function_exists('campaigns')){
    function campaigns(){
        $c = array();        
        return $c;
    }
}

// message types
if(!function_exists('msg_types')){
    function msg_types(){
        $c = array();        
        return $c;
    }
}

// message types
if(!function_exists('messages')){
    function messages(){
        $c = array();        
        return $c;
    }
}

/* End of file settings_helper.php */
/* Location: ./system/helpers/settings_helper.php */  