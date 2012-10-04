<?php

class Mail_model extends CI_Model
{
	public static $tbl_name = 'tbl_mail';
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	* - get the content id as param..
	* - select all tag_id from tbl_content_tag
	* - from the retrived tag_id, get the tag name and return as tag1||tag2||tag3||....
	*/
	function countUnread($id=0)
	{
		$s = "SELECT COUNT(mail_id) AS total FROM ".self::$tbl_name."
		        WHERE `read`='0'
		    ";
		$q = $this->db->query($s);
		return $q->num_rows();
	}
	
	function showInboxNumber($id=0)
	{
		$s = "SELECT mail_id FROM ".self::$tbl_name." WHERE user_id=".$id;
		$q = $this->db->query($s);
		$ret = $q->num_rows();
		return $ret;
	}
}