<?php

class User_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_user';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// check the username / password combination
	public function doLogin($username='', $password='')
	{
		$q = $this->db->get_where(self::$tbl_name, array('username' => $username, 'password'=>$password), 1);
		$r = $q->row();
		return ($q->num_rows() > 0) ? $r->user_id : 0 ;
	}
	
	/*
	*-- return every detail of the user.
	*/
	public function find_by_id($id=0)
	{
		$q 	= $this->db->get_where(self::$tbl_name, array('user_id'=>$id), 1);
		return $q;
	}
	
	// get sortorder >> maximum sortorder from the records
	function getSortOrder()
	{
		$this->db->select_max('sortorder');
		$q = $this->db->get(self::$tbl_name);
	    $r = $q->row();
		return intval($r->sortorder)+1;
	}
	
	/*
	*-- Returns the Screen Name of the user. 
	*/
	public function getScreenName($userid=0)
	{
		$this->db->select('screen_name');
		$q = $this->db->get_where(self::$tbl_name, array('user_id' => $userid), 1, 0);
		$r = $q->row();
		return ($q->num_rows() == 1) ? $r->screen_name : '';
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all()
	{
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE access=0");
		return $query->num_rows();
	}

	
	/*
	*-- Returns the user specified property 
	*/
	public function checkAccess($userid=0, $property='')
	{
		$query 	= $this->db->query("SELECT properties FROM ".self::$tbl_name." WHERE id='".$userid."' LIMIT 1");
		$result = $query->row();

		$pro = explode('|', $result->properties);  //  import:0  |  export:0  |  scheduled:0
		for($i=0; $i<count($pro); $i++){
			$pr = explode(':', $pro[$i]);
			$$pr[0] = $pr[1]; 
		}
		return (isset($$property)) ? $$property : 0;
	}
	
	/*
	*-- Returns the Fullname of the user. "firstname lastname"
	*/
	public function getAdminName($userid=0)
	{
		$query 	= $this->db->query("SELECT firstname,lastname FROM ".self::$tbl_name." WHERE id='".$userid."' LIMIT 1");
		$result = $query->row();
		return $result->firstname.' '.$result->lastname;
	}
	
	/*
	*-- Returns the Fullname of the user. "firstname lastname"
	*/
	public function getAdminEmail($userid=0)
	{
		$query 	= $this->db->query("SELECT email FROM ".self::$tbl_name." WHERE id='".$userid."' LIMIT 1");
		$result = $query->row();
		return $result->email;
	}
	
	// return every detail of th eproject 
	public function find_by_uid($id=0)
	{
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE u_id=".$id." LIMIT 1");
		return $query;
	}
	
	// check theusername
	public function check($username='', $userid=0)
	{
		$query 	= $this->db->query("SELECT user_id FROM ".self::$tbl_name." WHERE username=".$this->db->escape($username)." AND user_id<>{$userid} LIMIT 1");
		$result = $query->num_rows();
		return ($result == 0) ? true : false;
	}
	
	/*
	*-- return every user other than super admin.
	*/
	public function find_all($userid=0, $limit = 0, $offset = null)
	{
		$offset = ($offset) ? $offset : 0;
		$addsql = ($limit == 0) ? '' : 'LIMIT '.$limit.'  OFFSET '.$offset;
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE access='0' ORDER BY firstname ASC ".$addsql);
		return $query;
	}
	
	// check the username with id exception
	public function usernameAvailable($id=0, $username='user1')
	{
		$query 	= $this->db->query("SELECT username FROM ".self::$tbl_name." WHERE user_id<>".$id." AND username={$username} LIMIT 1");
		return ($query->num_rows() == 0) ? true : false;
	}
	
	// find all the users with admin access 0
	public function findMembers()
	{
		$query 	= $this->db->query("SELECT * FROM ".self::$tbl_name." WHERE access=0 ORDER BY id DESC");
		return $query;
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
	
	// apanel functions..
	public function count_all_users($all_users=false, $user_status=1)
	{
		$adSql = '';
		if($all_users)
		{
			$adSql = ' WHERE status='.$user_status;
		}
		$s = "SELECT user_id FROM tbl_user".$adSql;
		$q = $this->db->query($s);
		return $q->num_rows();
	}

	
	public function getRecords($perpage=50, $offset=0)
	{
		$offset = (!$offset) ? 0 : $offset;
		$s = "SELECT user_id, screen_name, username, password, email, t1.created, t1.sortorder, t1.status, fname, lname, t1.role_id, t2.role_name 
			  FROM tbl_user t1 INNER JOIN tbl_role t2 ON t1.role_id = t2.role_id AND t2.status=1 
			  ORDER BY username ASC LIMIT {$perpage} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	public function getUserRoles($retFormat = 'array')
	{
		$s = "SELECT role_id, role_name FROM tbl_role WHERE status=1 ORDER BY sortorder";
		$q = $this->db->query($s);
		$rdata = array();
		if($retFormat == 'array'){
			foreach ($q->result() as $row)
			{
				$rdata[$row->role_id] = $row->role_name;
			}
			return $rdata;
		}		
		return $this->db->query($s);		
	}
	
	public function getRoleById($role_id)
	{
		$s = "SELECT role_name FROM tbl_role WHERE role_id = '{$role_id}'";
		$q = $this->db->query($s);
		$row = $q->row();		
		return $row->role_name;				
	}
	
	public function count_search($keyword='')
	{
		$s = "SELECT * FROM tbl_user WHERE username LIKE '{$keyword}%'";
		$q = $this->db->query($s);
		return $q->num_rows();
	}
	
	public function getSearchRecords($keyword='', $perpage=50, $offset=0)
	{
		$offset = (!$offset) ? 0 : $offset;
		$s = "SELECT * FROM tbl_user WHERE username LIKE '{$keyword}%' LIMIT {$perpage} OFFSET {$offset} ";
		return $this->db->query($s);
	}
	
	// check if the username is available during creation and update.
    function username_available($username, $skip_id=0)
	{
		$wh = "";	
		$skip_id>0 && $wh = " AND user_id <> $skip_id";	
		$s = "SELECT user_id FROM tbl_user WHERE username = '{$username}'".$wh;
		$q = $this->db->query($s);
		return $q->num_rows>0?false:true;
	}
	
	// check if the email is available during creation and update.
    function email_available($email, $skip_id=0)
	{
		$wh = "";	
		$skip_id>0 && $wh = " AND user_id <> $skip_id";	
		$s = "SELECT user_id FROM tbl_user WHERE email = '{$email}'".$wh;
		$q = $this->db->query($s);
		return $q->num_rows>0?false:true;
	}
}