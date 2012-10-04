<?php

// return the last insert id. Useful when the original code may not return the value correctly.
if(!function_exists('last_insert_id')){
    
    function last_insert_id(){
        $CI = & get_instance();
        
        $query = $CI->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }
}
