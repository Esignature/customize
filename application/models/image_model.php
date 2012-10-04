<?php

class Image_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_image';
	
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
	
	function find_by_id($content_id=0, $module_id=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id, 'module_id'=>$module_id), 1, 0);
		return $q;
	}
	
	function getRecords($mod_id=0, $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$this->db->order_by('sortorder desc'); 
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		
		$offset = ($offset) ? $offset : 0;
		$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($mod_id=0, $trash_filter=true, $trash_cond=0)
	{
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		$this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name);
	}
	
	// FRONTEND methods
	public function get_list($mod_id=0, $popular_filter=false, $popular=1, $limit=5, $offset=null)
	{
		$this->db->order_by('sortorder desc'); 
		$cond = array('module_id' => $mod_id);
		if($popular_filter == true){
			$cond['popular'] = $popular;
		}
		
		$offset = ($offset) ? $offset : 0;
		$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
}