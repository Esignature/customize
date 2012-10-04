<?php

class Upload_model extends CI_Model
{
	public static $tbl_name = 'tbl_uploads';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// return every detail of th eproject 
	public function find_by_id($id=0)
	{
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE id='".$id."' LIMIT 1");
		return $query;
	}
	
	// return every detail of th eproject 
	public function find_by_uid($id=0, $userid=0)
	{
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE u_id=".$id." AND user_id=$userid LIMIT 1");
		return $query;
	}
	
	/*
	*-- return every user other than super admin.
	*/
	public function find_all($userid=0, $limit = 0, $offset = null)
	{
		$offset = ($offset) ? $offset : 0;
		$addsql = ($limit == 0) ? '' : 'LIMIT '.$limit.'  OFFSET '.$offset;
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE user_id='$userid' ORDER BY id DESC ".$addsql);
		return $query;
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($userid=0)
	{
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE user_id=$userid");
		return $query->num_rows();
	}
	
	/*
	* -- Returns the last record id of the user
	*/
	public function getLastId()
	{
		$query 	= $this->db->query("SELECT MAX(id) AS maxid FROM ".self::$tbl_name." ");
		$row	= $query->row();
		return ($row->maxid == '' || $row->maxid == null) ? 0 : $row->maxid ;
	}
}