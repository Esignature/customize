<?php

class User_pick_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_user_pick';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function checkUserPick($user_id=0, $rec_id=0, $type=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('user_id' => $user_id, 'type'=>$type, 'rec_id' => $rec_id));
		return ($q->num_rows() == 0) ? false : true;
	}
	
	function get_pick($content_id=0, $type=0, $append='')
	{
		$ret = '';
		if(get_cookie(APPID.'_user'))
		{
			$user_id = get_cookie(APPID.'_user');
			$cls = '';
			if($this->checkUserPick($user_id, $content_id, $type))
			{
				$cls = ' is_fav';
			}
			$ret = '<div class="usr_fav_grid'.$append.' '.$cls.'" rec_id="'.$content_id.'" type="'.$type.'"></div>';
		}
		return $ret;
	}
	
	function getPicks($user_id=0, $type=0)
	{
		$s = "SELECT C.title, C.content_id, C.ver1, I.image, I.image_path
				FROM tbl_user_pick P
				INNER JOIN tbl_content C
				ON C.content_id = P.rec_id
				LEFT JOIN tbl_image I
				ON I.content_id=C.content_id
				WHERE P.type={$type} AND P.user_id={$user_id} AND C.del_flag=0 AND C.status=1
				ORDER BY P.pick_date";
		return $this->db->query($s);
	}
}