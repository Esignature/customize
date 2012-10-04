<?php

class Artist_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	/*
	* -- Returns the total number of rows for frontend album listing
	*/
	public function count_records($filter=NULL)
	{
		$s = "SELECT COUNT(DISTINCT C.content_id) as cnt ";
		$s.= "FROM tbl_content C ";
		$s.= "LEFT JOIN tbl_image M ON C.content_id = M.content_id ";
		$s.= "WHERE C.module_id = 11 AND C.status=1 AND C.del_flag = 0 ";
		if(isset($filter)){
			$filter = urldecode($filter);
			if($filter == '9')
			$s.= "AND C.title REGEXP '^[0-9]' ";
			else
			$s.= "AND C.title LIKE '{$filter}%' ";
		}		
		$r = $this->db->query($s);
		$r = $r->result();
		return isset($r[0]) ? $r[0]->cnt:0;
	}
	
	public function getRecords($limit=40, $offset=0, $filter=NULL)
	{
		$s = "SELECT C.*, M.image_path AS image ";
		$s.= "FROM tbl_content C ";
		$s.= "LEFT JOIN tbl_image M ON C.content_id = M.content_id ";
		$s.= "WHERE C.module_id = 11 AND C.status=1 AND C.del_flag = 0 ";
		if(isset($_REQUEST['_tsa']) && trim($_REQUEST['_tsa']) != ''){
			$_tsa = addslashes($_REQUEST['_tsa']);
			$s.= "AND C.title LIKE '%{$_tsa}%' ";			
		}elseif(isset($filter)){
			if($filter == '9')
				$s.= "AND C.title REGEXP '^[0-9]' ";
			else
				$s.= "AND C.title LIKE '{$filter}%' ";			
		}
		$s.= "ORDER BY C.title ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";		
			
		$r = $this->db->query($s);
		$rw = $r->result();
		return $r->num_rows() ? $rw:false;
	}
	
}