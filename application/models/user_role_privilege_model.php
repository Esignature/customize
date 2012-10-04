<?php

class User_role_privilege_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_user_role_privilege';
	
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	*-- return the role id of the user.
	*/
	public function get_role($id=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('user_id'=>$id), 1);
		$r = $q->row();
		return ($q->num_rows == 0) ? 0 : $r->role_id;
	}
}