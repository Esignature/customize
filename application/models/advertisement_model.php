<?php

class Advertisement_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_advertisement';
	
	
	function __construct()
	{
		parent::__construct();
	}
	function find_by_id($content_id=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), 1, 0);
		return $q;
	}
	
	function getRecords($module_id=0,$limit=50, $offset=0,$where="",$orderby='')
	{
		$offset=(isset($offset) && $offset!="") ? $offset : 0; 
		$sql="
		SELECT c.title,i.image,i.image_path,c.ver1, a.location,c.sortorder,c.content_id,c.status,c.author,c.created,a.link
		FROM tbl_content c
		  INNER JOIN tbl_advertisement a
			ON c.content_id = a.content_id
	
		  LEFT JOIN tbl_image i 
		  	ON i.content_id=c.content_id
  	     WHERE c.del_flag=0 and c.module_id={$module_id} ";
		  $sql.=" ".$where." ";
		  
		  if($orderby!=""){
		  	$sql.=' order by '.$orderby;
		  }
		 
		  $sql.=" LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($sql);

	}
	
	public function count_all()
	{
		$q=self::getRecords('32','1024');
		
		return count($q);
	}
	
	public function getsellist($tbl_name,$prefix,$sel_id=0,$tit="",$where=""){
		$sql="select * from $tbl_name ";
		if($where!=""){
			$sql.=" where ".$where;
		}
		$q=$this->db->query($sql);
		$r=$q->result();
		$id=$prefix.'_id';
		
		$name=$prefix.'_name';
			
		$dropdown='<select name="'.$id.'" id="'.$id.'">';
		if($tit!=""){
			$dropdown.='<option value="">'.$tit.'</option>';
		}
		foreach($r as $val){
			if($prefix=="pg"){
				$id='page';
			}
			$sel='';
			if($sel_id==$val->$id){
				$sel="selected='selected'";	
			}
			
			$dropdown.='<option value="'.$val->$id.'" '.$sel.'>'.$val->$name.'</option>';
		}
		$dropdown.='</select>';
		return $dropdown;
	}
	
	public function sponsor_list($sp_id=0){
		$list=$this->content_model->getRecords(32, true, 0, 200);	
		
		$r=$list->result();
		$dropdown='<select name="sp_id" id="sp_id">';
		$dropdown.='<option value="">--Select Sponsor--</option>';
		foreach($r as $key=>$val){
			$sel='';
			if($sp_id==$val->content_id){
				$sel="selected='selected'";	
			}
			$dropdown.='<option value="'.$val->content_id.'" '.$sel.'>'.$val->title.'</option>';
		}
		$dropdown.='</select>';
		return $dropdown;
	}
	
	public function sponsor_pg_val($pbs_id){
		$query = $this->db->get_where(self::$tbl_name_pg_bk_sp, array('pbs_id' => $pbs_id));
		return $query;
		//$r = $query->result();
		
	}
	
	
	
	/*
	* -- Returns the total number of rows (searched only)
	*/
	public function count_search($mod_id=0, $cond='')
	{
		
		$q=self::getRecords($mod_id,1050,0,$cond);
		return @count($q);
	}
	
	public function getSearchRecords($mod_id=0, $cond='')
	{
		$q=self::getRecords($mod_id,1050,0,$cond);
		
		return $q;
		
	}
	
	//starts adv
	//Show location of the content_id
	public function getAdvlocation($content_id=0){
		$sql="select * from tbl_advertisement where content_id='$content_id'";
		$q=$this->db->query($sql);
		$r=@$q->result();
		$r=$r[0];
		return @$r->location;
	}
	
	public function fulllocation($location){
		$arr=array('homepage'=>'Homepage-Top (702*86px)','topinner'=>'Inner Page-Top (322*44px)','behindlogo'=>'Inner Page-Beside Logo (702*86px)');
		return @$arr[$location];
	} 
	
	//Returns homepage advertisement
	function adv_with_loc($loc){
		$q= $this->getRecords('33',3,0,'and a.location="'.$loc.'" and c.status=1 order by rand()');
		$r=$q->result();
		return $r;
	}
}