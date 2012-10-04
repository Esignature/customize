<?php

class Gallery_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_gallery_image';
	public static $tbl_name_cont = 'tbl_content';
	public static $mod_id=6;
	
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
	
	function find_by_id($content_id=0)
	{
		return $this->db->get_where(self::$tbl_name, array('gallery_image_id'=>$content_id), 1, 0);
	}
	
	function getRecords($content_id=0, $limit=1000, $offset=null, $exclude_id=0)
	{
		$this->db->order_by('sortorder asc'); 
		// prepare condition..
		
		$cond = array('content_id' => $content_id);
		$offset = ($offset) ? $offset : 0;
        
		$this->db->where('gallery_image_id !=', $exclude_id);
		$this->db->where($cond);
		return $this->db->get(self::$tbl_name, $limit, $offset);
	}
	function getSearchRecords($mod_id=0, $keyword='', $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$keyword = trim($keyword);
		$this->db->order_by('sortorder desc'); 
		$this->db->like('title', $keyword);
		$this->db->or_like('full_content', $keyword);
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		
		$offset = ($offset) ? $offset : 0;
		
		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
		$this->db->where($cond);
		$q= $this->db->get(self::$tbl_name_cont, $limit, $offset);
		
		
		//$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($content_id=0)
	{
		// prepare condition..
		$cond = array('content_id' => $content_id);		
		$this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name);
	}
	
	// FRONTEND methods
	public function get_list($mod_id=0, $popular_filter=false, $popular=1, $limit=5, $offset=null)
	{
		$this->db->order_by('sortorder desc'); 
		$cond = array('module_id' => $mod_id, 'status'=>1);
		if($popular_filter == true){
			$cond['popular'] = $popular;
		}
		
		$offset = ($offset) ? $offset : 0;
		$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
	
	//Frontend upcoming event
	public function front_event($mod_id){
		$cont = array('module_id' => $this->mod_id, 'status'=>1);
		
	}
}