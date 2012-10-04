<?php

class Package_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_package';
	
	function __construct()
	{
		parent::__construct();
	}	
	
	/*
	*-- return every detail of the package.
	*/
	public function find_by_id($id=0)
	{
		$q 	= $this->db->get_where(self::$tbl_name, array('pkg_id'=>$id), 1);
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
	* -- Returns the total number of rows
	*/
	public function count_all()
	{
		$query 	= $this->db->query("SELECT pkg_id FROM ".self::$tbl_name."");
		return $query->num_rows();
	}

	
	function getSearchRecords($keyword='', $limit=50, $offset=0, $del_flag = 0)
    {
        $keyword = trim($keyword);
        $cond = 'del_flag='.$del_flag;
        $offset = ($offset) ? $offset : 0;
        
        $s = "SELECT * FROM tbl_package ";
        $s.= "WHERE {$cond} ";
        $s.= "AND ( `pkg_name` LIKE '%".$keyword."%' OR `full_content` LIKE '%".$keyword."%') ";
        $s.= "ORDER BY `sortorder` DESC ";
        $s.= "LIMIT {$limit} OFFSET ".$offset;
        
        return $this->db->query($s);
        
    }	
        
	/*
	* -- Returns the last record id of the package
	*/
	public function getLastId()
	{
		$query 	= $this->db->query("SELECT MAX(id) AS maxid FROM ".self::$tbl_name." ");
		$row	= $query->row();
		return ($row->maxid == '' || $row->maxid == null) ? 0 : $row->maxid ;
	}
	
	// apanel functions..
	public function count_all_packages($all=false, $status=1)
	{
		$adSql = '';
		if($all)
		{
			$adSql = ' WHERE status='.$status;
		}
		$s = "SELECT pkg_id FROM ".self::$tbl_name.$adSql;
		$q = $this->db->query($s);
		return $q->num_rows();
	}

	
	public function getRecords($perpage=50, $offset=0, $del_flag = 0, $front = false)
	{
		$offset = (!$offset) ? 0 : $offset;
		$where = $front ? ' AND status =1 ':'';
        $limit = $front ? '':" LIMIT {$perpage} OFFSET {$offset}"; 
		$s = "SELECT pkg_id, pkg_name, full_content, intro, pkg_trial_period, featured, free_trial, pkg_price, pkg_upgradable, 
				pkg_downgradable, del_flag, status, sortorder 
			  FROM ".self::$tbl_name." WHERE del_flag = {$del_flag} {$where} ORDER BY sortorder ASC {$limit}";
		return $this->db->query($s);
	}
	
	
	// check if the package name is available during creation and update.
    function packageAvailable($pkg_name, $skip_id=0)
	{
		$wh = "";	
		$skip_id>0 && $wh = " AND pkg_id <> $pkg_id";	
		$s = "SELECT pkg_id FROM ".self::$tbl_name." WHERE pkg_name = '{$pkg_name}'".$wh;
		$q = $this->db->query($s);
		return $q->num_rows>0?false:true;
	}	
	
	public function getPackageServices($pkg_id = 0)
	{
		if($pkg_id>0)
		$s = "SELECT t1.srvc_id, srvc_name, IFNULL(t2.pkg_id, 0) AS pkg_id, t2.value FROM tbl_services t1 LEFT JOIN tbl_package_has_services t2 ON t1.srvc_id = t2.srvc_id AND t2.pkg_id = {$pkg_id} ORDER BY srvc_name";
		else	
		$s = "SELECT srvc_id, srvc_name, '0' as pkg_id, '' as `value` FROM tbl_services ORDER BY srvc_name";
		
		$q = $this->db->query($s);
		$rdata = array();
		foreach ($q->result() as $row)
		{
			$rdata[$row->srvc_id] = array($row->srvc_name, $row->pkg_id, $row->value);
		}
		return $rdata;		
	}
	
	
    /* -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* */
    /* -*-*-*-*-*-*-*-*-*-*- FRONT END METHODS -*-*-*-*-*-*-*-*-*-*-*-* */
    /* -*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* */
    
    
    
}