<?php

class Poll_option_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_poll_option';
	
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
	
	function getRecords($content_id=0, $limit=100, $offset=0)
	{
		$this->db->order_by("sortorder", "asc"); 
		return $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), $limit, $offset);
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
	
	function getTotalVotes($content_id=0){
		$ret = 0;
		$this->db->select_sum('votes');
        $q = $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id));
		if($q->num_rows() == 1){
			$r = $q->row();
			$ret = $r->votes;
		}
		return $ret;
	}
}