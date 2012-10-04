<?php

class Subscriber_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_subscribers';
	
	function __construct()
	{
		parent::__construct();
	}
	
	
	function find_by_id($content_id=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('participant_id'=>$content_id), 1, 0);
		return $q;
	}
	
	function is_available($email='')
	{
		$ret = false;
		$q = $this->db->get_where(self::$tbl_name, array('sub_email' => $email));
		if($q->num_rows() == 0)
		{
			$data['sub_email']  = $email;
			$data['sub_date']   = date('Y-m-d H:i:s');
			$data['sub_status'] = 1;	
			$data['uid']        = md5(rand(1000,50000).time());		
			if($this->db->insert(self::$tbl_name, $data))
			{
				$ret = true;
			}
		}
		return $ret;
	}
}