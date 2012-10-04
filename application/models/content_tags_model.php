<?php

class Content_tags_model extends CI_Model
{
	public static $tbl_name = 'tbl_content_tag';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_tags($id=0)
	{
		$s = "SELECT ct.content_id AS ctid, ct.tag_id AS tid, t.tag_id AS tag_id, t.tag_name AS tag_name ";
		$s.= "FROM ".self::$tbl_name." AS ct JOIN tbl_tag AS t ";
		$s.= "ON ct.tag_id = t.tag_id ";
		$s.= "WHERE content_id=".$this->db->escape($id);
		return $this->db->query($s);
	}
	
	function getTagList($id=0)
	{
		$ret = '';
		$q = $this->get_tags($id);
		foreach($q->result() as $r):
		    $ret.= "<li> <span class=\"tag_val\" name=\"".$r->tag_id."\">";
			$ret.= $r->tag_name."</span> <span class=\"close_tag\" title=\"Remove this tag\">x</span></li> \n";
		endforeach;
		
		return $ret;
	}
}