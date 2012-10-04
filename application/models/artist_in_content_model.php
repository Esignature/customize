<?php

class Artist_in_content_model extends CI_Model
{
	public static $tbl_name = 'tbl_artist_in_content';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_tags($id=0)
	{
		$s = "SELECT  a.content_id AS a_content_id, a.artist_content_id, ";
		$s.= "c.title AS title, c.content_id AS c_content_id, c.ver1 ";
		$s.= "FROM tbl_artist_in_content AS a JOIN tbl_content AS c ";
		$s.= "ON a.artist_content_id=c.content_id ";
		$s.= "WHERE c.status=1 AND c.del_flag=0 AND a.content_id=".$this->db->escape($id);
		return $this->db->query($s);
	}
	
	function getArtistList($id=0)
	{
		$ret = '';
		$q = $this->get_tags($id);
		foreach($q->result() as $r):
		    $ret.= "<li> <span class=\"artist_val\" name=\"".$r->artist_content_id."\">";
			$ret.= $r->title."</span> <span class=\"close_tag\" title=\"Remove this artist.\">x</span></li> \n";
		endforeach;
		return $ret;
	}
}