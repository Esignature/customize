<?php
class Columnist_model extends CI_Model
{	
	public static $tbl_name = 'tbl_columnist';
	public static $tbl_name_cont = 'tbl_content';
	public static $tbl_name_rel = 'tbl_columnist_content';
	public static $mod_id=31;
	function __construct()
	{
		parent::__construct();
	}
		
	function find_by_id($content_id=0)
	{
		$s = "SELECT C.* FROM tbl_content C WHERE C.content_id=$content_id";
		return $this->db->query($s);
	}
	
	function find_content_by_id($content_id=0)
	{
		$s = "SELECT C.*, M.image, M.image_path FROM tbl_content C INNER JOIN tbl_image M ON C.content_id = M.content_id WHERE C.content_id=$content_id LIMIT 1";
		$r = $this->db->query($s);
		if($r->num_rows()){
			return $r->result();	
		}
		return false;
	}
	
	function getUniqueColumnists($limit=0, $offset=0, $count=false){
		$s = "SELECT DISTINCT C.author, C.intro FROM tbl_content C WHERE C.module_id=31 AND C.status=1 AND C.del_flag=0";
		if(!$count && $limit>0)	  
			  $s .= " LIMIT $offset, $limit";
		$r = $this->db->query($s);		
		if($count)	  return $r->num_rows();		
		if($r->num_rows()){
			return $r->result();	
		}
		return false;
	}
	
	function getLatestColumn($count=1){
		$s = "SELECT C.content_id, C.title, C.intro, C.full_content, C.author, M.image, M.image_path FROM tbl_content C LEFT JOIN tbl_image M ON C.content_id = M.content_id WHERE C.module_id = $mod_id AND C.status = 1 AND C.del_flag=0 LIMIT $count";
		$r = $this->db->query($s);
		if($r->num_rows()){
			return $r->result();	
		}
		return false;	
	}
	
	function getRecords($limit=8, $offset=0, $count=false, $columnist='')
	{		
		$where = '';
		if($columnist != ''){
			$where = " AND C.author = '$columnist'";	
		}
		
		$s = "SELECT 
					C.content_id, C.title, C.full_content, C.author, C.intro,  
					M.image, M.image_path FROM tbl_content C 
			  LEFT JOIN tbl_image M ON C.content_id = M.content_id 
			  WHERE C.module_id = 31 AND C.status = 1 AND C.del_flag=0 $where 
			  ORDER BY C.created DESC ";
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}		
	
	public function getRelatedArticle($content_id, $type="Article", $mod_id=2, $related = true){
		
		$CI =& get_instance();
        $CI->load->model('content_model');
		
		$link_lc=strtolower($type);
		if($related){
			$result=$CI->content_model->getrelatedcontent($content_id, $mod_id, 0, 4, '', false);
		}else{
			$result=$CI->content_model->getallrecords($mod_id, 'posted_date');			
		}
		$v='';
		foreach($result as $row){
			
			$q_img = $this->img->find_by_id($row->content_id);
			$i_img = $q_img->row();
			if($q_img->num_rows() == 0){
				$img_name = $img_path = $img_caption = '';
			} else {
				$img_name = $i_img->image;
				$img_path = $i_img->image_path;
				$img_caption = $i_img->caption;
			}
			if($row->ver1 == 0 && file_exists('./uploads/145x85/'.$img_name))
			{
				if(!empty($img_path))
					$link= '<img src="'.base_url().'resizer.php?&h=33&w=42&s='.urlencode(base_url().'uploads/'.$img_name).'" alt="'.$img_caption.'" width="42" >';
				else
					$link= '<div style="border:1px solid #CCCCCC;color:#4775FF;font-weight:bold;line-height:4em;height:33px;width:42px;font-size: 8px;text-align:center">No Image</div>';
			} 
			else{						
				if(strstr($img_path, 'sites/'))
					$link= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=42&h=33" alt="'.$img_caption.'">';
				else{						
					if(!file_exists($img_path))
					$link= '<div style="border:1px solid #CCCCCC;color:#4775FF;font-weight:bold;line-height:4em;width:42px;height:33px;font-size: 8px;text-align:center">No Image</div>';
					else
					$link= '<img src="'.$img_path.'" width="42" height="33" >';
				}
			}
		   $imgLink=anchor($link_lc.'/detail/'.$row->content_id, $link);
		   $titleLink=anchor($link_lc.'/detail/'.$row->content_id, titleLimit($row->title, 25));
		   $date =convertfulldate($row->posted_date);
			
			$v.='<ul>
					<li>
						<div class="colm_main_div_li">
							<div class="colm_newslist_img">'.$imgLink.'</div>
							<div class="colm_newslist_text">'.$titleLink.'<br /><span class="songs_time">'.$date.'</span></div>
							<div class="clear"></div>
						</div>
					</li>
				</ul>';
		}
		return $v;
	}
	
}