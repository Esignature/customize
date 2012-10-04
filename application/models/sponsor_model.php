<?php

class Sponsor_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_sponsor';
	public static $tbl_name_block = 'tbl_block';
	public static $tbl_name_pg_bk_sp = 'tbl_pg_block_sp';
	public static $tbl_name_page = 'tbl_page';
	public static $tbl_name_pg_block = 'tbl_page_has_block';
	
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
		SELECT c.title,pbs.status,b.block_name,p.pg_name,pbs.method,pbs.pbs_id,i.image,i.image_path,c.ver1 
		FROM tbl_content c
		  INNER JOIN tbl_pg_block_sp pbs
			ON c.content_id = pbs.sp_id
		  INNER JOIN tbl_block b
			ON b.block_id = pbs.block_id
		  INNER JOIN tbl_page p
			ON 
		  p.page=pbs.pg_id 
		  LEFT JOIN tbl_image i 
		  	ON i.content_id=c.content_id
		  WHERE c.del_flag=0 and pbs.del_flag=0 and c.module_id={$module_id} ";
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
	public function methoddrop($sel=""){
		
		$d='
			<select name="method" id="method" >
			<option value="">--Select Method--</option>
			<option ';
			if($sel=="List")$d.= 'selected="selected"';
		$d.='>List</option>
			<option ';
			if($sel=="Detail")$d.=  'selected="selected"';
		$d.='>Detail</option>
			</select>
		';
		return $d;
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
	public function putsponsor($page="",$block_id,$method=""){
		$mod_id=32;
		$where='';
		if($page!="" && $block_id!=""){	
		
			$where.=" and pbs.pg_id='$page' and pbs.block_id='$block_id' ";
			/*if($method!=""){
				$where.=" and pbs.method='$method' ";
			}*/
			$where.=' and pbs.status=1  and c.status=1 ';
			$q=self::getRecords($mod_id,1, 0,$where,'rand()');
			//return $where;
			$r=$q->result();
			
			$r=@$r[0];
			
			
			if(isset($r->image_path) && $r->image_path!="" and file_exists(SITE_PATH.'uploads/sponsor/'.$r->image)){
				
				return "<img class='sponsor_title  btns_tip' src='".base_url().'uploads/sponsor/'.$r->image."' original-title='".$r->title."' alt='".$r->title."'  title='".$r->title."' style='max-height:20px;'>"; 
			}
		}
		else{
			return false;	
			//$data['imags']=$this->spg->putsponsor('downloads','11');
		}
	}
/*	public function pagetoid($page){
		$arr=array('homepage'=>'1','news'=>'2','events'=>'3','interview'=>'4','articles'=>'5','crbt'=>'6','photos'=>'7','videos'=>'8','downloads'=>'9','album'=>'10','song'=>'11');
		if(in_array($page,$arr)) {
		 return $arr[$page];	
		}
		else{
		 return false;	
		}
	}*/
}