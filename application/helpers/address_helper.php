<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('getCountries')){
    function getCountries(){
        $c = array();
        $CI  = & get_instance();            
        $CI->db->select('country_id, name, iso_code_2, iso_code_3, postcode_reqd')
                   ->from('tbl_country')
                   ->where('status', '1')
                   ->order_by('name', 'asc');
        
        $query = $CI->db->get();
                
        foreach($query->result() as $row){
            
            $c[$row->country_id] = array(
                                        'name' => $row->name,
                                        'iso_code_2' => $row->iso_code_2,
                                        'iso_code_3' => $row->iso_code_3,
                                        'postcode_reqd' => $row->postcode_reqd
                                        );
        }   
        return $c;
    }
}

if(!function_exists('getStates')){
    function getStates($cntry_code){
        $c = array();
        $CI  = & get_instance();            
        $CI->db->select('state_id, state')
                   ->from('tbl_state')
                   ->where_in('country_code', $cntry_code)
                   ->order_by('state', 'asc');
        
        $query = $CI->db->get();
                
        foreach($query->result() as $row){
            
            $c[$row->state_id] = array('state' => $row->state);
        }   
        return $c;
    }
}

if(!function_exists('getCities')){
    function getCities($cntry_code){
        $c = array();
        $CI  = & get_instance();            
        $CI->db->select('city_id, city')
                   ->from('tbl_city')
                   ->where_in('country', $cntry_code)
                   ->order_by('city', 'asc');
        
        $query = $CI->db->get();                
        foreach($query->result() as $row){            
            $c[$row->city_id] = array('city' => $row->city);
        }   
        return $c;
    }
}
    

if(!function_exists('onlyCountryNames')){
    function onlyCountryNames(){
       $r = array();     
       $cnty = getCountries();
       
       foreach($cnty as $c){
           $r[$c['iso_code_2']] = $c['name'];
       }   
       return $r;
    }
}
    
if(!function_exists('getTimezones')){
    function getTimezones(){
        $c = array();
        $CI  = & get_instance();            
        $CI->db->select('tz_id, cntry_code, tz_group, tz, offset, dst')
                   ->from('tbl_timezone')
                   ->order_by('tz_group', 'asc')
                   ->order_by('tz', 'asc');;
        
        $query = $CI->db->get();
                
        foreach($query->result() as $row){
            
            $c[$row->tz_id] = array(
                                    'tz_group' => $row->tz_group,
                                    'cntry_code' => $row->cntry_code,
                                    'tz' => $row->tz,
                                    'offset' => $row->offset,
                                    'dst' => $row->dst
                                    );
        }   
        return $c;
    }
}

if(!function_exists('uniqTimezoneOffsets')){
    function uniqTimezoneOffsets(){
        $c = array();
        $CI  = & get_instance();            
        $CI->db->select('offset')->from('tbl_timezone')->order_by('offset', 'asc')->group_by('offset');;        
        $query = $CI->db->get();                
        foreach($query->result() as $row){            
            $c[$row->offset] = $row->offset;
        }   
        return $c;
    }
}

if(!function_exists('getZones')){    
    
    function getZones($c_id = 0){   
        
        $z = array();
        $CI = & get_instance();            
        $CI->db->select('zone_id, name, code, country_id')
                   ->from('tbl_zone')
                   ->order_by('name', 'asc');
        
        if($c_id>0){
            $CI->db->where('country_id', $c_id);            
        }
        
        while($row = $query->result())
        {
            $z[$row->zone_id] = array(
                                    'name' => $row->name,
                                    'code' => $row->code,
                                    'country_id' => $row->country_id
                                    );
        }   
        
        return $z;
    }
    
}

if(!function_exists('countrySB')){
    /* SELECT BOX FOR COUNTRY */
    function countrySB($params = array()){
        if(!isset($params['id'])) $params['id'] = $params['name'];
        $__c = getCountries();
        $sb = '<select id="'.$params['id'].'" name="'.$params['name'].'" class="'.$params['class'].'">';
        if(isset($params['initial']) && $params['initial'] != '')
            $sb .= '<option value="">'.$params['initial'].'</option>';  
        
        foreach($__c as  $k=>$c){
            $selected = isset($params['selected']) && $params['selected'] == $k ? true : false;
            $value = isset($params['nameAsValue']) && $params['nameAsValue'] === true ? $c['name'] : $k;
            
            $sb .= '<option value="'.$value.'"'. set_select($params['name'], $value, $selected).'>'.$c['name'].'</option>'; 
        }
        $sb .= '</select>';
        return $sb;
    }
}

if(!function_exists('soneSB')){    
    /* SELECT BOX FOR ZONE */
    function zoneSB($cid, $params = array()){
        $__c = getZones($cid);
        $sb = '<select id="'.$params['id'].'" name="'.$params['name'].'" class="'.$params['class'].'">';
        $sb .= '<option value="">'.$params['initial'].'</option>';  
        foreach($__c as  $k=>$c){
            $selected = isset($params['selected']) && $params['selected'] == $k ? ' selected' : '';
            $sb .= '<option value="'.$k.'"'.$selected.'>'.$c['name'].'</option>';   
        }
        $sb .= '</select>';
        return $sb;
    }
}

if(!function_exists('timezoneSB')){
    /* SELECT BOX FOR TIMEZONE */
    function timezoneSB($params = array()){
        $__c = getTimezones();
         if(!isset($params['id'])) $params['id'] = $params['name'];
        $sb = '<select id="'.$params['id'].'" name="'.$params['name'].'" class="'.$params['class'].'">';
        if(isset($params['initial']) && $params['initial'] != '')
            $sb .= '<option value="">'.$params['initial'].'</option>';  
        foreach($__c as  $k=>$c){
            $tmp_grp[$c['tz_group']][] = $c; 
        }

        foreach($tmp_grp as  $grp=>$tzc){
            $sb .= '<optgroup label="'.str_repeat('&mdash;', 15).'"></optgroup>';     
            $sb .= '<optgroup label="'.$grp.'"></optgroup>';   
            foreach($tzc as  $k=>$c){
                $selected = isset($params['selected']) && $params['selected'] == $k ? ' selected' : '';
                $sb .= '<option value="'.$k.'" '. set_select($params['name'], $k, $selected).'>'.$c['tz'].'</option>';   
            }
        }

        $sb .= '</select>';
        return $sb;
    }
}        

/**
* Get Geo Location by Given/Current IP address for local database
*
* @access    public
* @param    string
* @return    array
*/

if (!function_exists('get_geolocation')) {
    function getLocationByIP($IP_ADDRSS, $CITY=false){  
        // visit http://ipinfodb.com/ip_location_api.php for more info
        $KEY="eb792c39b60cd0151767c7ff1fdf3ac6aad3bf2dd22e2ffa95e2cfded03f1290";  
        // registered at ipinfodb.com as shaktiwonder/blackhole with email shakya.shakti@gmail.com
        
        $TYPE=$CITY==true?"ip-city":"ip-country";  
        // Check if city information is requried too  
      
        $API_URL="http://api.ipinfodb.com/v3/$TYPE/?key=$KEY&ip=$IP_ADDRSS&format=xml";  
        // Construst API URL  
        // there two more formats json and raw if preder xml  
        // there is another parameter callback if you use it via javascript it will be handy  
          
        $xml=simplexml_load_file($API_URL);  
          
        if($xml->statusCode=="OK"){  
            // Check if everything is OK  
              
            /*
            $xml->countryCode  
            $xml->countryName  
      
            if($CITY){               
                $xml->regionName  
                $xml->cityName  
                $xml->zipCode  
                $xml->latitude  
                $xml->longitude  
                $xml->timeZone  
            }*/
                        
            return $xml;
            
        }else{  
            echo "Somthing Went Wrong";  
        }  
    } 

}

if(!function_exists('getLocalTimezone')){
    
	function getLocalTimezone()
    {
        $iTime = time();
        $arr = localtime($iTime);
        $arr[5] += 1900;
        $arr[4]++;
        $iTztime = gmmktime($arr[2], $arr[1], $arr[0], $arr[4], $arr[3], $arr[5], $arr[8]);
        $offset = doubleval(($iTztime-$iTime)/(60*60));
        $zonelist =
        array
        (
            'Kwajalein' => -12.00,
            'Pacific/Midway' => -11.00,
            'Pacific/Honolulu' => -10.00,
            'America/Anchorage' => -9.00,
            'America/Los_Angeles' => -8.00,
            'America/Denver' => -7.00,
            'America/Tegucigalpa' => -6.00,
            'America/New_York' => -5.00,
            'America/Caracas' => -4.30,
            'America/Halifax' => -4.00,
            'America/St_Johns' => -3.30,
            'America/Argentina/Buenos_Aires' => -3.00,
            'America/Sao_Paulo' => -3.00,
            'Atlantic/South_Georgia' => -2.00,
            'Atlantic/Azores' => -1.00,
            'Europe/Dublin' => 0,
            'Europe/Belgrade' => 1.00,
            'Europe/Minsk' => 2.00,
            'Asia/Kuwait' => 3.00,
            'Asia/Tehran' => 3.30,
            'Asia/Muscat' => 4.00,
            'Asia/Yekaterinburg' => 5.00,
            'Asia/Kolkata' => 5.30,
            'Asia/Katmandu' => 5.45,
            'Asia/Dhaka' => 6.00,
            'Asia/Rangoon' => 6.30,
            'Asia/Krasnoyarsk' => 7.00,
            'Asia/Brunei' => 8.00,
            'Asia/Seoul' => 9.00,
            'Australia/Darwin' => 9.30,
            'Australia/Canberra' => 10.00,
            'Asia/Magadan' => 11.00,
            'Pacific/Fiji' => 12.00,
            'Pacific/Tongatapu' => 13.00
        );
        $index = array_keys($zonelist, $offset);
        if(sizeof($index)!=1)
            return false;
        return $index[0];
        
        //date_default_timezone_set(getLocalTimezone());
    }
}




/* End of file address_helper.php */
/* Location: ./system/helpers/address_helper.php */  