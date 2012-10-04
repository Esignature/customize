<?php

class Action_model extends CI_Model
{
	
	public static $tbl_seg      = 'tbl_segment';
    public static $tbl_cat      = 'tbl_segment_category';
    public static $tbl_info     = 'tbl_segment_info';
    public static $tbl_rule     = 'tbl_segment_rule';
    public static $tbl_seg2cat  = 'tbl_segment_to_cat';
    
	function __construct()
	{
		parent::__construct();
	}
	
    // Save Segments
    public function save_segments($post, $site_id, $mode){
            
        /*
        $this->db->query('truncate table '.self::$tbl_seg);
        $this->db->query('truncate table '.self::$tbl_info);
        $this->db->query('truncate table '.self::$tbl_rule);
        $this->db->query('truncate table '.self::$tbl_seg2cat);
        #*/        
        
        $seg_id = $this->security->xss_clean($_POST['seg_id']);
                
        #/*
        // insert into tbl_segment
        $name    = $this->security->xss_clean($_POST['seg_name']);
        $desc    = $this->security->xss_clean($_POST['seg_desc']);        
        $date = date('Y-m-d H:i:s');  
        
        
        // ---------------------------tbl_segment------------------------------------>
        if($mode == 'add'){
            $this->db->insert(self::$tbl_seg, array('seg_name'=>$name, 'seg_desc'=>$desc, 'site_id'=>$site_id, 'created'=>$date));
            $seg_id = last_insert_id();
        }else{
            $this->db->update(self::$tbl_seg, array('seg_name'=>$name, 'seg_desc'=>$desc, 'modified'=>$date), array('seg_id'=>$seg_id, 'site_id'=>$site_id));
        }
        // --------------------------tbl_segment_to_cat------------------------------->
        $seg_cat = isset($_POST['hdn_seg_cats']) ? $_POST['hdn_seg_cats'] : false;
        //for edit mode...copy this to edit mode later.
        //clear before insert
        $this->db->delete(self::$tbl_seg2cat, array('seg_id'=>$seg_id, 'site_id'=>$site_id));                
        if($seg_cat){
            //foreach($seg_cat as $k=>$v){
                $this->db->insert(self::$tbl_seg2cat, array('seg_id'=>$seg_id, 'cat_id'=>$seg_cat, 'site_id'=>$site_id));
            //}
        }
        // -------------------------------tbl_info--------------------------------->
        // -------------------------------tbl_rule--------------------------------->
        #*/
        $rules = isset($_POST['_group']) ? $_POST['_group'] : false;  #/*
        $this->db->delete(self::$tbl_info, array('seg_id'=>$seg_id));
        $this->db->delete(self::$tbl_rule, array('seg_id'=>$seg_id));
        #*/
        //$this->dbug->show($rules);
        //die();       
        
        if($rules){
            foreach($rules as $k=>$v){
                $grp_code = $k;
                $grp_so = $v['evt_grp_blk_so'];
                $alias = $v['event_alias'];
                $fld_set = $v['fieldset']; 
                
                $this->db->insert(self::$tbl_info, array('seg_id'=>$seg_id, 'grp_code'=>$grp_code, 'group_so'=>$grp_so));
                $grp_id = last_insert_id();
                
                foreach($fld_set as $a=>$b){  
                    $rule_so = $a;
                    
                    $pre_op = isset($b['pre_op']) ? strtolower($b['pre_op']) : '';
                    $not_op = isset($b['not_op']) ? (int)$b['not_op'] : '0';                    
                    unset($b['pre_op'], $b['not_op']); // throw them out so that it wont hamper the following looping
                    
                    foreach($b as $c=>$d){
                        $this->db->insert(self::$tbl_rule, array(
                                            'seg_id'=>$seg_id, 
                                            'grp_id'=>$grp_id, 
                                            'grp_code'=>$grp_code, 
                                            'rule_so'=>$rule_so, 
                                            'set_code'=>$c, 
                                            'rule_alias'=>$alias[$rule_so-1], 
                                            'rules'=>serialize($d),
                                            'pre_op'=>$pre_op,
                                            'not_op'=>$not_op                                            
                                         ));
                    }
                }   
            }
        }
        return $seg_id ? $seg_id : 0;    
    }
    
    
    function delete($ids, $site_id){
        
        $this->db->query("DELETE t1, t2, t3, t4 
            FROM ".self::$tbl_seg." t1 
            INNER JOIN ".self::$tbl_info." t2 ON t1.seg_id = t2.seg_id 
            LEFT JOIN ".self::$tbl_seg2cat." t3 ON t1.seg_id = t3.seg_id 
            LEFT JOIN ".self::$tbl_rule." t4 ON t1.seg_id = t4.seg_id 
            WHERE t1.site_id = {$site_id} AND t1.seg_id IN ($ids) ");            
        return true;
    }
    
    function activate($ids, $site_id){        
        $this->db->query("UPDATE ".self::$tbl_seg." SET status = 1 WHERE site_id = {$site_id} AND seg_id IN ($ids) ");            
        return true;
    }
    
    function deactivate($ids, $site_id){        
        $this->db->query("UPDATE ".self::$tbl_seg." SET status = 0 WHERE site_id = {$site_id} AND seg_id IN ($ids) ");            
        return true;
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

    public function get_list_data($site_id, $_get, $aColumns, $bColumns)
    {   
        $this->db->select("SQL_CALC_FOUND_ROWS `".join("`, `", $aColumns)."`", false);
        $this->db->from(self::$tbl_seg);
        
        /* Paging */
        if ( isset( $_get['iDisplayStart'] ) && $_get['iDisplayLength'] != '-1' ){            
            $this->db->limit( $_get['iDisplayLength'], $_get['iDisplayStart'] );            
        }
            
        /* Ordering */
        if ( isset( $_get['iSortCol_0'] ) ){        
            for ( $i=0 ; $i<intval( $_get['iSortingCols'] ) ; $i++ ){                
                if ( $_get[ 'bSortable_'.intval($_get['iSortCol_'.$i]) ] == "true" )                    
                    $this->db->order_by($aColumns[ intval( $_get['iSortCol_'.$i] ) ], $_get['sSortDir_'.$i] );
            }           
        }
        
        /* Filtering */     
        if ( isset($_get['sSearch']) && $_get['sSearch'] != "" ){
            for ( $i=0 ; $i<count($aColumns) ; $i++ ){                
                $i == 0 ? 
                    $this->db->like($aColumns[$i] == 'name' ? "CONCAT(title, ' ', fname, ' ', lname)" : $aColumns[$i], $_get['sSearch'] ) :
                    $this->db->or_like($aColumns[$i] == 'name' ? "CONCAT(title, ' ', fname, ' ', lname)" : $aColumns[$i], $_get['sSearch'] ) ;
            }           
        }
        
        /* Individual column filtering */
        /*for ( $i=0 ; $i<count($aColumns) ; $i++ ){            
            if ( isset($_get['bSearchable_'.$i]) && $_get['bSearchable_'.$i] == "true" && $_get['sSearch_'.$i] != '' ){             
                $this->db->like($aColumns[$i], $_get['sSearch_'.$i]);
            }
        }*/ 
        
        $result_op = $this->db->get();
        /* Data set length after filtering */
        $sQuery = "SELECT FOUND_ROWS() AS found_rows";      
        $result_filter_total = $this->db->query( $sQuery );
        $aResultFilterTotal = $result_filter_total->result();       
        $iFilteredTotal = $aResultFilterTotal[0]->found_rows;
        
        /* Total data set length */
        $iTotal = $iFilteredTotal[0];  
        
        return array(
            'result_filter_total'=>$result_filter_total, 
            'aResultFilterTotal' => $aResultFilterTotal, 
            'iFilteredTotal'=>$iFilteredTotal,
            'iTotal'=>$iTotal,
            'data'=>$result_op->result()
            );    
    }
    
    
    public function getRecords($site_id, $perpage=50, $offset=0)
    {
        $offset = (!$offset) ? 0 : $offset;
        $this->db->select('seg_id, seg_name, seg_desc')
                   ->from ('tbl_segment')
                   ->order_by('created','desc')
                   ->where(array('site_id'=>$site_id))
                   ->limit($perpage, $offset);
                   
        $r = $this->db->get();
        return $r;
    }
    
    public function find_by_id($seg_id, $site_id)
	{
	    // from tbl_segment    	    
	    $s = "SELECT seg_name, seg_desc FROM ". self::$tbl_seg;               
		$q = $this->db->query($s);
        if($q->num_rows()){
            $q = $q->row();    
            $res = array('seg_name'=>$q->seg_name, 'seg_desc'=>$q->seg_desc);
        }
        // from tbl_seg2cat         
        $s = "SELECT cat_id FROM ". self::$tbl_seg2cat." WHERE seg_id = ? AND site_id = ?";               
        $q = $this->db->query($s, array($seg_id, $site_id));
        if($q->num_rows()){
            $res['check_node']=$q->row()->cat_id;                
        }
        $t = array();
        // from tbl_info         
        $s = "SELECT grp_id, grp_code, group_so FROM ". self::$tbl_info." WHERE seg_id = ? ORDER BY grp_code, group_so";               
        $q = $this->db->query($s, array($seg_id));
        
        if($q->num_rows()){
            foreach( $q->result() as $r)
                $t[$r->grp_code]['evt_grp_blk_so'] = $r->group_so;
        }
        
        
        // from tbl_info         
        $s = "SELECT grp_id, grp_code, set_code, rule_alias, rules, rule_so, not_op, pre_op FROM ". self::$tbl_rule." WHERE seg_id = ? ORDER BY grp_code, rule_so";               
        $q = $this->db->query($s, array($seg_id));
        
        
        if($q->num_rows()){
            foreach( $q->result() as $r){
                $t[$r->grp_code]['event_alias'][] = $r->rule_alias;
                $t[$r->grp_code]['event_sortorder'][] = $r->rule_so;
                
                $t[$r->grp_code]['fieldset'][$r->rule_so]['not_op'] = $r->not_op;
                $t[$r->grp_code]['fieldset'][$r->rule_so]['pre_op'] = $r->pre_op;
                
                $t[$r->grp_code]['fieldset'][$r->rule_so]['fields'][$r->set_code] = unserialize($r->rules);
            }
        }
        
        $res['_group'] = $t;        
		return $res;
	}
    
    
	/*
	*-PURANO CODE....DELETE IF NOT USABLE
	*/
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
    

}