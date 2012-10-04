<?php

class Account_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_account';
    
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	*-- return every detail of the user.
	*/
	public function find_by_id($id=0, $del_flag = 0)
	{
	    
	    $s = "SELECT t2.fname, t2.lname, t2.email, t2.password, t2.username, t1.status, t2.phone, 
	           t1.created, t1.country_id, t1.tz_id, t1.company, t1.confirmed, t1.confirmed_on 
	           FROM tbl_account t1 
	           INNER JOIN tbl_user_to_site t3 ON t1.account_id = t3.account_id AND t1.del_flag = {$del_flag} 
	           INNER JOIN tbl_account_user t2 ON t3.account_user_id = t2.account_user_id AND t3.role = 'admin' AND t3.site_id = 0 
	           /* since admin manages all site, so 0 is checked */
	           LIMIT 1";
               
		$q 	= $this->db->query($s);
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
    
	
	/* -- Returns the last record id of the user */
	public function getLastId()
	{
		$query 	= $this->db->query("SELECT MAX(id) AS maxid FROM ".self::$tbl_name." ");
		$row	= $query->row();
		return ($row->maxid == '' || $row->maxid == null) ? 0 : $row->maxid ;
	}
	
	// apanel functions..
	public function count_all($all=false, $status=1, $del_flag = 0)
	{
	    $adSql = " WHERE del_flag = {$del_flag}";
		if($all){
			$adSql .= ' AND status='.$status;
		}
		$s = "SELECT account_id FROM tbl_account".$adSql;
		$q = $this->db->query($s);
		return $q->num_rows();
	}

	
	public function getRecords($perpage=50, $offset=0, $del_flag = 0)
	{
		$offset = (!$offset) ? 0 : $offset;
		$s = "SELECT t1.account_id, t1.company, CONCAT_WS(' ', t3.fname, t3.lname) AS name, 
                      t1.status, t1.created, t1.confirmed, t3.email, t3.phone, 
                      (SELECT GROUP_CONCAT(CONCAT('- ', domain) SEPARATOR '<br />') FROM tbl_site WHERE account_id = t1.account_id) AS sites
                FROM tbl_account t1 
                INNER JOIN tbl_user_to_site t2 ON t1.account_id = t2.account_id AND t2.site_id = 0 AND t2.role='admin' AND t1.del_flag = {$del_flag} 
                INNER JOIN tbl_account_user t3 ON t3.account_user_id = t2.account_user_id 
                ORDER BY t1.created DESC LIMIT {$perpage} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	public function count_search($kws)
	{
		$q = $this->getSearchRecords($kws, 0, 0, true);
		return $q->num_rows();
	}
	
	public function getSearchRecords($kws, $perpage=50, $offset=0, $countme = false, $del_flag = 0)
	{
	    if(!count($kws)) return $this->getRecords($perpage, $offset);
        
		$offset = (!$offset) ? 0 : $offset;
		$join = ''; $cond = array();
		foreach($kws as $kw=>$kv){
		        
		    switch ($kw) {
				case 'name':
					$cond[] = "t3.fname LIKE '%{$kv}%' OR t3.lname LIKE '%{$kv}%'";
					break;				
				case 'email':
                    $cond[] = "t3.email LIKE '%{$kv}%'";
                    break;
                case 'company':
                    $cond[] = "t1.company LIKE '%{$kv}%'";
                    break;   
                case 'domain':
                    $join = "INNER JOIN tbl_site t4 ON t4.account_id = t1.account_id AND t4.domain LIKE '%$kv%'";
                    break;        
			}
		}
        
        $where = join(' AND ', $cond);
        $where = trim($where)!= '' ? ' WHERE '.$where : '';
        
		$s = "SELECT t1.account_id, t1.company, CONCAT_WS(' ', t3.fname, t3.lname) AS name, 
                      t1.status, t1.created, t1.confirmed, t3.email, t3.phone, 
                      (SELECT GROUP_CONCAT(CONCAT('- ', domain) SEPARATOR '<br />') FROM tbl_site WHERE account_id = t1.account_id) AS sites
                FROM tbl_account t1 
                INNER JOIN tbl_user_to_site t2 ON t1.account_id = t2.account_id AND t2.site_id = 0 AND t2.role='admin' AND t1.del_flag = {$del_flag}  
                INNER JOIN tbl_account_user t3 ON t3.account_user_id = t2.account_user_id 
                {$join} 
                {$where}
                GROUP BY t1.account_id 
                ORDER BY t1.created DESC";
        if((int)$perpage > 0 ) $s .= " LIMIT {$perpage} OFFSET {$offset}";
		return $this->db->query($s);
	}

	    
    /* METHODS FOR SITES */

    public function find_sites($acc_id){
            
        $s = "SELECT t1.site_id, t1.uniq_id, t1.site_name, t1.package_id, t1.account_id, 
                     t1.site_type_id, t1.description, t1.domain, t1.sub_domains, t1.created, t1.expired, t1.protocol, 
                     CONCAT(t1.protocol,'://', t1.domain) AS full_url, t1.purchased, t1.purchased_on,
                     t1.expiry_date, t1.tracker, t1.sortorder, t1.status, t1.purchased, t1.purchased_on, 
                     t2.pkg_id, t2.pkg_name, t2.pkg_trial_period, t2.pkg_price, 
                     t3.confirmed, t3.confirmed_on,
                     t4.site_type_id, t4.site_type  
                     FROM tbl_site t1 
                     INNER JOIN tbl_package t2 ON t1.package_id = t2.pkg_id AND t2.status = 1 AND t2.del_flag = 0
                     INNER JOIN tbl_account t3 ON t1.account_id = t3.account_id AND t3.account_id = {$acc_id}
                     LEFT JOIN tbl_site_type t4 ON t1.site_type_id = t4.site_type_id 
                     ORDER BY t1.sortorder";
                    
        $q = $this->db->query($s);
        return $q->num_rows() ? $q->result() : false;        
        
    } 

    //find site details by site_id    
    public function site_by_id($site_id){

        $s = "SELECT t1.uniq_id, t1.site_name, t1.description, t1.domain, t1.sub_domains, t1.created, t1.expired, 
                     t1.protocol, t1.expiry_date, t1.tracker, t1.status, t1.purchased, t1.purchased_on,
                     CONCAT(t1.protocol,'://', t1.domain) AS full_url, 
                     t2.pkg_name, t2.pkg_trial_period, t2.pkg_price, t3.confirmed, t3.confirmed_on, t4.site_type 
                     FROM tbl_site t1 
                     INNER JOIN tbl_package t2 ON t1.package_id = t2.pkg_id AND t2.status = 1 AND t2.del_flag = 0 AND t1.site_id = {$site_id} 
                     INNER JOIN tbl_account t3 ON t1.account_id = t3.account_id
                     LEFT JOIN tbl_site_type t4 ON t1.site_type_id = t4.site_type_id";
                    
        $q = $this->db->query($s);
        return $q->num_rows() ? $q->row() : false;  
    }   
    
    //find user_based site details
    public function site_details_by_userid($acc_id, $user_id, $role = 'assistant'){
            
        $app = $role == 'admin' ? '' : ' AND t3.site_id = t1.site_id '; 
        $s = "SELECT t1.site_id, t1.uniq_id, t1.package_id, t1.account_id, t1.protocol, t1.domain, t1.sub_domains, 
                    t1.site_name, t1.site_type_id, t1.description, t1.purchased, t1.purchased_on, t1.status, t1.created, 
                    t1.expired, t1.expiry_date, t1.tracker, t1.sortorder,
                    t2.pkg_name, t2.free_trial, t2.pkg_downgradable, t2.pkg_price, t2.pkg_trial_period, t2.pkg_upgradable  
                    FROM tbl_site t1 
                    INNER JOIN tbl_package t2 ON t1.package_id = t2.pkg_id AND t2.status = 1 AND t2.del_flag = 0 
                    INNER JOIN tbl_user_to_site t3 ON t3.account_id = t1.account_id {$app} 
                    WHERE t1.account_id = {$acc_id} AND t3.account_user_id = {$user_id}";
                    
        $r = $this->db->query($s);
        return $r->result();        
    }
    
    
    // save account
    public function save($qarr){
        if($this->db->insert('tbl_account', $qarr))
            return last_insert_id();
        else
            return false;
    }
    
    // update confirmation code
    public function updateConfCode($acc_id, $code){
        $this->db->update('tbl_account', array('conf_code'=>$code), array('account_id'=>$acc_id));
    }
    
    // save account user
    public function saveUser($qarr, $acc_id){
        
        if($this->db->insert('tbl_account_user', $qarr)){
            $ins_id = last_insert_id();
            $this->db->insert('tbl_user_to_site', array('account_user_id'=>$ins_id, 'site_id'=>0, 'account_id' => $acc_id, 'role'=> 'admin'));
            return $ins_id; 
        }    
        else    
            return false;
    }
    
    // save website information
    public function saveSite($qarr, $ret_id = false){
        $this->db->insert('tbl_site', $qarr);
        return $ret_id ? last_insert_id() : true;    
    }
    
    // check if the email is available during creation and update.
    function email_available($email, $skip_id=0)
    {
        $wh = "";   
        $skip_id>0 && $wh = " AND account_user_id <> $skip_id"; 
        $s = "SELECT account_user_id FROM tbl_account_user WHERE email = '{$email}'".$wh;
        $q = $this->db->query($s);
        return $q->num_rows>0?false:true;
    }
    
    // check if the given url is already registered.
    function website_available($url, $skip_id=0)
    {
        $url = preg_replace('#^https?\:\/\/(www.)?#', '', $url);
        $wh = "";   
        $skip_id>0 && $wh = " AND site_id <> $skip_id"; 
        $s = "SELECT site_id FROM tbl_site WHERE domain = '{$url}'".$wh;
        $q = $this->db->query($s);
        return $q->num_rows>0?false:true;
    }
    
    
    // REGISTRATION PROCESS: check if account exists for given confirmation code
    function code_exists($code)
    {
        $s = "SELECT account_id FROM tbl_account WHERE conf_code = '{$code}' AND confirmed = 0 AND status = 0 AND del_flag = 0";
        return $this->db->query($s)->num_rows ? true : false;
    }
    
    function trackerByConfCode($code){
        $row = $this->db->query("SELECT tracker FROM tbl_site t1 INNER JOIN tbl_account t2 ON t1.account_id = t2.account_id AND t1.status = 1 WHERE t2.conf_code = '{$code}'")->row();
        return $row->tracker;
    }
    
    // REGISTRATION PROCESS: check if account has already been cofirmed and activated
    function is_confirmed($code)
    {
        $s = "SELECT account_id FROM tbl_account WHERE conf_code = '{$code}' AND confirmed = 1";
        return $this->db->query($s)->num_rows ? true : false;
    }
    // REGISTRATION PROCESS: set the registration as confirmed
    public function setConfirmed($code){
        $this->db->update('tbl_account', array('confirmed'=>1, 'confirmed_on'=>date('Y-m-d H:i:s'), 'status'=>1), array('conf_code'=>$code));
    }
    
    // REGISTRATION PROCESS: delete registration by code: from the confirmation email link
    public function cancelRegistrtion($code){
        $this->db->delete('tbl_account', array('conf_code'=>$code, 'confirmed'=>0, 'status'=>0));
    }
    
    // REGISTRATION PROCESS: check if the account is really cancellable. Account already confirmed cannot be cancelled through confirmation code.
    // instead they will need to cancel from their logged in session features.
    public function isCancellable($code){
        $rows = $this->db->query("SELECT account_id FROM tbl_account WHERE conf_code = '{$code}' AND confirmed=0 AND status=0")->num_rows();
        return $rows ? true : false;
    }

    // check the username / password combination
    public function doLogin($email, $password){
        
        $q = $this->db->query("SELECT t1.account_user_id, email, fname, lname, phone, t1.status, 
                                t3.company, t3.country_id, t3.account_id, t3.tz_id, t2.role  
                    FROM tbl_account_user t1 
                    INNER JOIN tbl_user_to_site t2 ON t1.account_user_id = t2.account_user_id AND t1.status =1 AND t1.del_flag = 0 
                    INNER JOIN tbl_account t3 ON t2.account_id = t3.account_id AND t3.status = 1 AND t3.del_flag = 0 AND t3.confirmed = 1   
                    WHERE t1.email = '{$email}' AND t1.password = '{$password}' GROUP BY account_user_id LIMIT 1" );
        $r = $q->row();
        return ($q->num_rows() > 0) ? $r : false ;
    }

    // install pre-requisite data for a newly registered and confirmed user account
    public function init_data($ccode){
        $site_id = $this->siteid_by_conf($ccode);
        // COPY referrers from master table for the given site
        $this->db->query("INSERT INTO tbl_setting_referrer (`name`, `domain`, `url_srch_param`, `url_srch_param_pay`, 
                        `url_pos_param`, `ref_srch_param`, `ref_srch_param_pay`, `ref_pos_param`, `ref_container_id`, `site_id`) 
                        (SELECT `name`, `domain`, `url_srch_param`, `url_srch_param_pay`, `url_pos_param`, `ref_srch_param`, 
                        `ref_srch_param_pay`, `ref_pos_param`, `ref_container_id`, {$site_id} AS site_id FROM tbl_mstr_referrer)");
                        
                        
        $this->db->insert('tbl_segment_category', array('parent_id'=>0, 'position'=>1, 'title'=>'Main Category', 'site_id'=>$site_id));
        $this->db->insert('tbl_action_category', array('parent_id'=>0, 'position'=>1, 'title'=>'Main Category', 'site_id'=>$site_id));
                                   
    }

    //find site id by account cofirmation code for the first time.
    public function siteid_by_conf($ccode){
        $s = "SELECT site_id FROM tbl_site t1 INNER JOIN tbl_account t2 ON t1.account_id = t2.account_id AND t2.conf_code = '{$ccode}'";
        $q = $this->db->query($s);
        return $q->num_rows() ? $q->row()->site_id : false;  
    }
}