<?php

class Itunes_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_album';
	public static $tbl_name_cont = 'tbl_content';
	public static $mod_id=9;
	
	function __construct()
	{
		parent::__construct();
	}	
	
	/*
	* -- Returns the total number of rows for frontend itunes listing
	*/
	public function count_active_itunes($filter=NULL)
	{
		$s = "SELECT COUNT(DISTINCT C.content_id) as cnt ";
		$s.= "FROM tbl_content C ";
		$s.= "INNER JOIN tbl_album A ON C.content_id = A.content_id ";
		$s.= "INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id "; 
  		$s.= "INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id ";  
		$s.= "LEFT JOIN tbl_image M ON C.content_id = M.content_id ";
		$s.= "WHERE C.module_id = 9 AND C.status=1 AND C.del_flag = 0 AND ART.status = 1 AND ART.del_flag=0 AND A.itunes_url<>'' AND A.itunes_url IS NOT NULL ";
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
	
	
}