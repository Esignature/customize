<?php

class Artist_profile_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_artist_profile';
	
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
		$q = $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), 1, 0);
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
	
	function getSearchRecords($mod_id=0, $keyword='', $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$keyword = trim($keyword);
		$cond = '';
		$offset = ($offset) ? $offset : 0;
		
		$s = "SELECT * FROM ".self::$tbl_name." ";
		$s.= "WHERE module_id=".$mod_id." {$cond} ";
		$s.= "AND ( `title` LIKE '%".$keyword."%' OR `full_content` LIKE '%".$keyword."%') ";
		$s.= "ORDER BY `sortorder` DESC ";
		$s.= "LIMIT {$limit} OFFSET ".$offset;
		return $this->db->query($s);
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($mod_id=0, $trash_filter=true, $trash_cond=0, $status_filter=false, $status=1)
	{
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		if($status_filter == true){
			$cond['status'] = $status;
		}

		$this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name);
	}
	
	/*
	* -- Returns the total number of rows (searched only)
	*/
	public function count_search($mod_id=0, $keyword='')
	{
		$cond = array('module_id' => $mod_id);
		$this->db->like('title', $keyword);
        $this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name);
	}
	
	public function related_content($profile_id=0, $mod_id=0, $limit=100, $offset=0)
	{
		$s = "SELECT C.content_id, C.ver1, C.title, C.module_id, C.posted_date, C.full_content, I.image, I.image_path ".($mod_id==8?', V.video ':'').($mod_id==9?', ALB.lyricist, ALB.composer ':'')." 
				  FROM tbl_artist_in_content AC
				  LEFT JOIN tbl_image I ON I.content_id = AC.content_id
				  INNER JOIN tbl_content C ON C.content_id = AC.content_id AND AC.artist_content_id={$profile_id} ".
				  ($mod_id==8?"INNER JOIN tbl_video V ON V.content_id = C.content_id ":'').
				  ($mod_id==9?"INNER JOIN tbl_album ALB ON ALB.content_id = C.content_id ":'')."
				  WHERE C.del_flag=0 AND C.status=1 AND C.module_id={$mod_id} GROUP BY content_id
				  LIMIT {$limit} OFFSET {$offset}
			  ";
        //echo "<br />**********************<br />".$s."";
		return $this->db->query($s);
	}
}