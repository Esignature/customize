<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// get referrers defined for the current selected site in the dashboard
if(!function_exists('getSiteAdwordSetting')){
    function getSiteAdwordSetting(){
        $c = array();
        $CI  = & get_instance(); 
        
        $cur_site_info = $CI->session->userdata(APPID.'_current_site');
        $cur_site_id = $cur_site_info['site_id'];                 
        $CI->db->select('setting_value, serialized')
                   ->from('tbl_site_setting')
                   ->where('setting_key', 'ADW_SETTINGS')
                   ->where('site_id', $cur_site_id);
       
        $query = $CI->db->get();
        $row = $query->row();
        
        return $row->serialized ? (object)unserialize($row->setting_value) : $row->setting_value;
    }
}



/* End of file settings_helper.php */
/* Location: ./system/helpers/site_settings_helper.php */  