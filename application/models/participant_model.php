<?php

class Participant_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_participant';
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function find_by_id($content_id=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('participant_id'=>$content_id), 1, 0);
		return $q;
	}
	
	function getRecords($content_id=0, $limit=100, $offset=0)
	{
		$this->db->order_by('participant_id', 'DESC');
		$q = $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), $limit, $offset);
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
}