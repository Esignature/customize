<?php

class Tags_model extends CI_Model
{
	public static $tbl_name = 'tbl_tag';
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	* - get the content id as param..
	* - select all tag_id from tbl_content_tag
	* - from the retrived tag_id, get the tag name and return as tag1||tag2||tag3||....
	*/
	function getTags($id=0)
	{
		return;
	}
	
	/*
	* - Look for the tag existence..
	* - add the tag if not exist..
	* - return the tag query
	*/
	function searchTag($tag='')
	{
		$tag = trim($tag);
		return $this->db->get_where(self::$tbl_name, array('tag_name' => $tag), 1, 0);
	}
}