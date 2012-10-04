<?php

class CRBT_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_crbt';
	public static $tbl_name_cont = 'tbl_content';
	public static $tbl_name_pop = 'tbl_popular_crbt';
	public static $mod_id=10;
	function __construct()
	{
		parent::__construct();
	}
	
	// get sortorder >> maximum sortorder from the records
	function getSortOrderPop($tbl_name_pop="tbl_popular_crbt")
	{
		$this->db->select_max('position');
		$q = $this->db->get($tbl_name_pop);
	    $r = $q->row();
		return intval($r->position)+1;
	}
	
	function find_by_id($content_id=0)
	{
		return $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), 1, 0);
	}
	
	function getRecords($mod_id=0,$popular=0,$sort="sortorder", $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$this->db->order_by($sort.' desc'); 
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond[self::$tbl_name_cont.'.del_flag'] = $trash_cond;
		}
		if($popular==1){
			$cond[self::$tbl_name_cont.'.featured'] = 1;
		}
		$offset = ($offset) ? $offset : 0;


		$this->db->join(self::$tbl_name_pop, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name_pop.'.content_id', 'inner');
		$this->db->where($cond);
		$q= $this->db->get(self::$tbl_name_cont, $limit, $offset);
		//new dbug($q->result());
		return $q;
	}
	function getSearchRecords($mod_id=0, $keyword='', $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$keyword = trim($keyword);
		$this->db->order_by('sortorder desc'); 
		$this->db->like('title', $keyword);
		$this->db->or_like('full_content', $keyword);
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		
		$offset = ($offset) ? $offset : 0;
		
		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
		$this->db->where($cond);
		$q= $this->db->get(self::$tbl_name_cont, $limit, $offset);
		
		
		//$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
	public function getAll($module_id=0)
	{
		$s = "SELECT * ";
		$s.= "FROM tbl_content as c ";
		$s.= "WHERE (c.status <> 0 AND c.del_flag = 0) AND (c.module_id={$module_id}) ORDER BY sortorder DESC ";
		
		return $this->db->query($s);
	}
	
	
	
	public function getSlideshow($limit=10, $offset=0)
	{
		$s = "SELECT c.content_id AS contentid, c.title, c.module_id, i.content_id AS i_content_id, i.image ";
		$s.= "FROM tbl_content AS c JOIN tbl_image AS i ";
		$s.= "ON c.content_id=i.content_id ";
		$s.= "WHERE c.status=1 AND c.del_flag=0 AND i.image <> '' AND c.slideshow=1 ";
		// allow news and article module's image for slideshow.
		$s.= "AND (c.module_id=2 OR c.module_id=3) ";
		$s.= "ORDER BY c.sortorder DESC ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($mod_id=0, $trash_filter=true, $trash_cond=0, $status_filter=false, $status=1,$regular="0",$types="past",$day=NULL)
	{
		// prepare condition..
		$cond = array(self::$tbl_name_cont.'.module_id' => $mod_id);
		if($trash_filter == true){
			$cond[self::$tbl_name_cont.'.del_flag'] = $trash_cond;
		}
		if($status_filter == true){
			$cond[self::$tbl_name_cont.'.status'] = $status;
		}
		if($regular==1){
			$cond[self::$tbl_name.'.regular'] = 1;
		}
		else{
			$cond[self::$tbl_name.'.regular != '] = 1;
			}
		if($types=="past"){
			$cond[self::$tbl_name.'.date_from < '] = todaydate();
		}
		if($types=="upcoming"){
			$cond[self::$tbl_name.'.date_from > '] = todaydate();
		}
		if($day!=NULL){
			$cond[self::$tbl_name.'.day'] = $day;
		}
		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
		
		$this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name_cont);
	}
	
	// FRONTEND methods
	public function get_list($mod_id=0, $popular_filter=false, $popular=1, $limit=5, $offset=null)
	{
		$this->db->order_by('sortorder desc'); 
		$cond = array('module_id' => $mod_id, 'status'=>1);
		if($popular_filter == true){
			$cond['popular'] = $popular;
		}
		
		$offset = ($offset) ? $offset : 0;
		$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
	
	
	public function getallserviceprovider($content_id=0){
		$q='<select name="netop_content_id[]"><option value="">--None--</option>';
		$r=$this->content_model->getRecords(27);
		$res=$r->result();
		
		foreach($res as $val){
			if($content_id==$val->content_id){
				$sel='selected="selected"';
			}
			else{
				$sel='';
			}
		$q.='<option '.$sel.' value="'.$val->content_id.'">'.$val->title.'</option>';
		}
		$q.='</select>';
		return $q;
	}
	public function servprovcode($netop_content_id=0,$code=""){
		
		$html='<label>Service Provider: </label>
        
        '.self::getallserviceprovider($netop_content_id).'
        
       &nbsp;<strong>&nbsp;Code:</strong>
         <input name="code[]" type="text" class="input medium width-inp-num" id="code[]" value="'.$code.'" /> Remove?<select name="remcode[]" id="remcode[]"><option value="yes">Yes</option><option value="no" selected="selected">No</option></select>
        <span class="abt_info">Code for crbt. If Service Provider or Code is blank then it will not added in this CRBT</span>';	
		return $html;
	}
	public function telcocode($netop_content_id=0,$code=0,$content_id=0){			
		
		$r='';
		if($content_id==0 or  $content_id==NULL or $content_id==""){
			$r=self::servprovcode($netop_content_id);
		}
		else{
			$sql="select * from tbl_crbt where content_id='$content_id'";
			$q=$this->db->query($sql);
			$rr=$q->result();
			foreach($rr as $val){
				$r.=self::servprovcode($val->netop_id,$val->code);
			}
			if(count($rr)<1){
				$r=self::servprovcode();
			}
		}
		
		return $r;
	}
	function find_by_id_track($content_id=0)
	{	$table="tbl_crbt_to_track";
		$table_track='tbl_track';
		
		$this->db->join($table, ''.self::$tbl_name_cont.'.content_id = '.$table.'.track_content_id', 'inner');
		return $this->db->get_where(self::$tbl_name_cont, array('crbt_content_id'=>$content_id), 1, 0);
	}
	/*
	* -- Returns the total number of rows
	*/
	public function count_all_pop($mod_id=0,$popular="0", $trash_filter=true, $trash_cond=0, $status_filter=false, $status=1)
	{
		// prepare condition..
		$cond = array(self::$tbl_name_cont.'.module_id' => $mod_id);
		if($trash_filter == true){
			$cond[self::$tbl_name_cont.'.del_flag'] = $trash_cond;
		}
		if($status_filter == true){
			$cond[self::$tbl_name_cont.'.status'] = $status;
		}
		if($popular==1){
			$cond[self::$tbl_name_cont.'.featured'] = 1;
		}
		else{
			$cond[self::$tbl_name_cont.'.featured != '] = 1;
			}
	
		$this->db->join(self::$tbl_name_pop, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name_pop.'.content_id', 'inner');
		
		$this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name_cont);
	}
	
	/*
	ALL CRBT goes here..
	*/
	function get_crbt_tracks($content_id=0, $crbt_mandatory=false, $with_rating=false)
	{
		$s = "SELECT CT.content_id, CT.title, CT.ver1, CT.slug, CT.status, CT.posted_date, CT.alb_of_week ";
		if($with_rating){
			$s .= ", R.used_ips, R.total_votes, R.total_value ";	
		}
		$s .= "FROM tbl_content C 
                INNER JOIN tbl_track T ON C.content_id = T.album_content_id ";
		if($crbt_mandatory){		
           $s .= "INNER JOIN tbl_crbt_to_track C2T ON C2T.track_content_id = T.content_id ";
           $s .= "INNER JOIN tbl_content CT ON CT.content_id = T.content_id ";
		}else{
		   $s .= "LEFT JOIN tbl_crbt_to_track C2T ON C2T.track_content_id = T.content_id ";
           $s .= "LEFT JOIN tbl_content CT ON CT.content_id = T.content_id ";
		}
		if($with_rating){
			$s .= "LEFT JOIN tbl_rating R ON R.content_id = T.content_id ";
		}
        $s .= "WHERE C.content_id=".$content_id." GROUP BY CT.content_id";
		

        return $this->db->query($s);
	}
	
	function get_crbt_operator($content_id=0)
	{
		$s = "SELECT CNTY.country_id, CNTY.country, CNTY.flag_icon FROM tbl_crbt_to_track C 
INNER JOIN tbl_crbt CR ON CR.content_id=C.crbt_content_id  
INNER JOIN tbl_network_operator NOP ON CR.netop_id = NOP.content_id 
INNER JOIN tbl_country CNTY ON CNTY.country_id = NOP.country_id 
WHERE C.track_content_id=".$content_id." AND CNTY.status = 1 GROUP BY CNTY.country_id";
		return $this->db->query($s);
	}
	
	function get_operator($content_id=0, $country_id=0)
	{
		$s = "SELECT C.*, CR.netop_id, NOP.crbt_charge, NOP.mno_code, NOP.logo, NOP.country_id FROM tbl_crbt_to_track C 
				INNER JOIN tbl_crbt CR ON CR.content_id=C.crbt_content_id 
				INNER JOIN tbl_network_operator NOP ON CR.netop_id = NOP.content_id 
				WHERE C.track_content_id=".$content_id."  AND NOP.country_id = ".$country_id." GROUP BY CR.netop_id";	
		
		return $this->db->query($s);
	}
	
	function get_crbt_code($country_id=0, $network_id=0)
	{
		$s = "SELECT C.*, CR.netop_id, NOP.crbt_charge, NOP.mno_code, NOP.country_id FROM tbl_crbt_to_track C 
              	INNER JOIN tbl_crbt CR ON CR.content_id=C.crbt_content_id 
				INNER JOIN tbl_network_operator NOP ON CR.netop_id = NOP.content_id 
                WHERE C.track_content_id=".$content_id."  AND NOP.country_id = ".$country_id;
		return $this->db->query($s);
	}
	
	function get_crbt_list($mod_id=20, $perpage=0, $offset=0,$sortorder="c.title",$where=''){
		$sql="SELECT
				  c.content_id, c.title, ART.content_id AS artist_cid, ART.slug AS artist_slug, t.artist_display, ac.title AS album_title, c.posted_date, t.content_id AS tid,
				  ac.content_id as album_content_id 
				FROM tbl_content AS c
				  INNER JOIN tbl_track AS t ON t.content_id = c.content_id
				  INNER JOIN tbl_album AS a ON t.album_content_id = a.content_id
				  INNER JOIN tbl_content AS ac ON ac.content_id = a.content_id ";
				$sql.=" INNER JOIN tbl_crbt_to_track AS crbt    ON c.content_id = crbt.track_content_id ";
				$sql.=" INNER JOIN tbl_content AS crbt_f    ON crbt_f.content_id = crbt.crbt_content_id ";
				if($where!=""){
					$sql.=" INNER JOIN tbl_popular_crbt AS pop    ON pop.content_id = crbt_f.content_id ";
				}
				$sql.=" LEFT JOIN tbl_artist_in_content AIC ON ac.content_id = AIC.content_id ";
		
		$sql.=" LEFT JOIN tbl_content ART ON AIC.artist_content_id = ART.content_id AND ART.del_flag = 0 AND ART.status = 1"; 	
		
		$sql.=" 
				WHERE c.module_id = {$mod_id}
					AND c.del_flag = 0
					AND c.status = 1
					AND ac.del_flag = 0
					AND ac.status = 1
					AND crbt_f.status = 1
					";
			
		
		if($where!=""){
			$sql.=" ".$where." ";
		}		
		$sql.=" GROUP BY c.content_id
				ORDER BY ".$sortorder;
			if($perpage!=0){	
				$sql.=" LIMIT {$perpage}";
				$sql.=" OFFSET {$offset}
				";	
			}
			//new dbug($sql);
		//return $sql;
		$q=$this->db->query($sql);
		return $q;
	}
}