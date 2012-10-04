<?php

class Language_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_language';
    
	function __construct()
	{
		parent::__construct();
	}
	
	// get sortorder >> maximum sortorder from the records
	function getSortOrder()
	{
		$this->db->select_max('sortorder');
		$q = $this->db->get(self::$tbl_name);
	    $r = $q->row();
		return intval($r->sortorder)+1;
	}
    
    function lang_exists($lang){
	    // check if the language exists in db.
        $db_exists = $this->db->get_where(self::$tbl_name, array('language'=>$lang))->num_rows();        
        return $db_exists || file_exists(APPPATH . 'language/'.$lang);
    }
    
    function saveLang($qarr){
        $this->db->insert('tbl_language', $qarr);
        return last_insert_id();     
    }
    
    function deleteLanguageByName($language){
        $this->db->delete('tbl_language', array('language'=>$language));
        return true;
    }
}