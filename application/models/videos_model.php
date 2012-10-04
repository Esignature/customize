<?php

class Videos_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_video';
	public static $tbl_name_cont = 'tbl_content';
	public static $mod_id=8;
	function __construct()
	{
		parent::__construct();
	}
	
	// get sortorder >> maximum sortorder from the records
	function getSortOrder()
	{
		$this->db->select_max('sortorder');
		$q = $this->db->get(self::$tbl_name);
	    $r = $q->row();
		return intval($r->sortorder)+1;
	}
	
	function find_by_id($content_id=0)
	{
		return $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), 1, 0);
	}
	
	function getRecords($mod_id=0, $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$this->db->order_by('sortorder desc'); 
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		
		$offset = ($offset) ? $offset : 0;


		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
		$this->db->where($cond);
		$q= $this->db->get(self::$tbl_name_cont, $limit, $offset);
				
		return $q;
	}
	function getSearchRecords($mod_id=0, $keyword=array(), $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$like=" like ";
		$cond='';
		$this->db->order_by(self::$tbl_name_cont.'.sortorder desc'); 
		if(count($keyword)>0){
			if($keyword['keyword']!=""){
				$this->db->like(self::$tbl_name_cont.'.title', $keyword['keyword']);
			}
			
			if(isset($keyword['trailor']) and $keyword['trailor']!=""){
				$cond[self::$tbl_name.'.trailor'] = $keyword['trailor'];
			}
		}
		// prepare condition..
		$cond[self::$tbl_name_cont.'.module_id'] =$mod_id;
		if($trash_filter == true){
			$cond[self::$tbl_name_cont.'.del_flag'] = $trash_cond;
		}
		$offset = ($offset) ? $offset : 0;
		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
		$this->db->where($cond);
		$q= $this->db->get(self::$tbl_name_cont, $limit, $offset);
		
		return $q;
	}
	public function getAllVideos($module_id=0)
	{
		$s = "SELECT * ";
		$s.= "FROM tbl_content as c LEFT JOIN tbl_event as e ON c.content_id = e.content_id ";
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
		$s.= "AND (c.module_id=2 OR c.module_id='".$this->mod_id."') ";
		$s.= "ORDER BY c.sortorder DESC ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($mod_id=0, $trash_filter=true, $trash_cond=0, $status_filter=false, $status=1,$trailor=0,$minus=false)
	{
		// prepare condition..
		$cond = array(self::$tbl_name_cont.'.module_id' => $mod_id);
		if($trash_filter == true){
			$cond[self::$tbl_name_cont.'.del_flag'] = $trash_cond;
		}
		if($status_filter == true){
			$cond[self::$tbl_name_cont.'.status'] = $status;
		}
		
		$cond[self::$tbl_name.'.trailor']=$trailor;
		
		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
		
		$this->db->where($cond);
		$r=$this->db->count_all_results(self::$tbl_name_cont);
		if($r>0 and $minus=true){
			$r=$r-1;
			}
		return $r;
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
	
	//Frontend upcoming event
	public function front_event($mod_id){
		$cont = array('module_id' => $this->mod_id, 'status'=>1);
		
	}
	public function count_search($mod_id=0, $keyword=array(),$trash_filter=true ,$trash_cond=0)
	{
		
		if($keyword!="" && count($keyword)>0){
			if($keyword['keyword']!=""){
				$this->db->like(self::$tbl_name_cont.'.title', $keyword['keyword']);
				$this->db->or_like(self::$tbl_name_cont.'.full_content', $keyword['keyword']);
			}
			if(isset($keyword['trailor']) and $keyword['trailor']!=""){
				$cond[self::$tbl_name.'.trailor'] = $keyword['trailor'];
			}
		}
		$cond[self::$tbl_name_cont.'.module_id'] =$mod_id;
		if($trash_filter == true){
			$cond[self::$tbl_name_cont.'.del_flag'] = $trash_cond;
		}
		
		$this->db->join(self::$tbl_name, ''.self::$tbl_name_cont.'.content_id = '.self::$tbl_name.'.content_id', 'inner');
        $this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name_cont);
	}
	public function nextprevcontent($posted_date,$trailor=0){
	
		$prev_link= '<img src="'.base_url().'images/page_prev.gif" alt="" border="0" style="float:left" class="btns_tip" title="Previous Video" />';
		
		$next_link= '<img src="'.base_url().'images/page_next.gif" alt="" border="0" style="float:left" class="btns_tip" title="Next Video" />';
		$res='';
		$prev_id=self::nextprev($posted_date,"prev",$trailor);
		if($prev_id and $prev_id!=""){
			$res.= '<a href="'.base_url().'index.php/videos/detail/'.$prev_id.'">'.$prev_link.'</a>';
		}
		$next_id=self::nextprev($posted_date,"next",$trailor);
		if($next_id and $next_id!=""){
			$res.= '<a href="'.base_url().'index.php/videos/detail/'.$next_id.'">'.$next_link.'</a>';
		}
		return $res;
		
	}
	public function nextprev($posted_date,$type,$trailor=0){
		$sql="select * from tbl_cotent";
		$s = "SELECT * ";
		$s.= "FROM tbl_content as c INNER JOIN tbl_video as e ON c.content_id = e.content_id";
		$s.= " WHERE"; 
		if($type=="prev"){
			$s.= "	c.posted_date<'".$posted_date."' and";
		}
		else{
			$s.= "	c.posted_date>'".$posted_date."' and";
		}
		$s.=" trailor='$trailor' and";
		$s.= " (c.status <> 0 AND c.del_flag = 0) AND (c.module_id='".self::$mod_id."') ORDER BY c.posted_date DESC ";
		
		$q= $this->db->query($s);
	    $r = $q->row();
		
		return @$r->content_id;
	}
	public function homepagevideo($limit=8,$feature=0,$rand=false,$trailor=0){
		
		$s = "SELECT * ";
		$s.= "FROM ".self::$tbl_name_cont." as c INNER JOIN ".self::$tbl_name." as v ON c.content_id = v.content_id ";
		$s.= "WHERE (c.status <> 0 AND c.del_flag = 0) AND (c.module_id=".self::$mod_id.") ";
		if($feature==1){
			$s.= "AND c.featured=1";
		}
		$s.=" AND v.trailor='$trailor'";
		if($rand){
			$s.=" ORDER BY rand()";
		}
		else{
			$s.=" ORDER BY c.posted_date DESC";
		}
		
		$s.=" LIMIT $limit";
		$q=$this->db->query($s);
		return $q->result();
		
	}
	public function showscrollvid($result=true,$content_id=0,$mod_id=8){
		
		$sponsor=$this->sponsor->sponsor_in_page('8');
			if($result){
				$featured_video=self::homepagevideo(10,0,false);
			}
			else{
				$this->load->model('content_model');
				$featured_video=$this->content_model->getrelatedcontent($content_id,$mod_id);
			}
			$d='<div class="main_related_vdo_wrapper">
				  <div class="title_wrapper">
					<div class="related_vdo_titles">Videos</div>
					<div class="jcarousel-btnbg"><img class="jcarousel-prev" id="vdo_jcarousel-prev" src="'.base_url().'images/btn_prev.png" /><img class="jcarousel-next" id="vdo_jcarousel-next" src="'.base_url().'images/btn_next.png" /></div>';
					
				   $d.='<div class="related_vdo_sponsers "><!--<img src="'.base_url().'images/BIKALPA.jpg" class="sponsor_title  btns_tip" title="Bikalpa Creation">-->'.$sponsor.'</div>';
				   $d.='<div class="clear"></div>
				</div><div class="related_vdo_contents">
				  <ul id="vdo_carousel">';
  	
		$rec_count = count($featured_video);
		$this->load->helper('youtube');
		foreach($featured_video as $row){
			$className="related_vdo_wraper_left";
			if(@$row->video != ''){				
				$img = youtube_thmb($row->video, 1);
				$img = '<img src="'.$img.'" width="122" height="90" />';
			}else{		
				$q = @$this->img->find_by_id(@$row->content_id);
			$i = $q->row();
			if($q->num_rows() == 0){
				$img_name = $img_path = $img_caption = '';
			} else {
				$img_name = $i->image;
				$img_path = $i->image_path;
				$img_caption = $i->caption;
			}
			if(@$row->ver1 == 0 && $img_name != '' && file_exists('./uploads/145x85/'.$img_name))
			{
				  $img = '<img src="'.base_url().'uploads/145x85/'.$img_name.'" alt="'.$img_caption.'" title="'.$img_caption.'"width="122"  >';
			} 
			else
			{
				  if(strstr($img_path, 'sites/'))
					$img = '<img src="'.$img_path.'" width="122"  alt="'.$img_caption.'" >';
				  else{
					 if(!file_exists($img_path)){
						 $img = '<div style="color:#4775FF;font-weight:bold;line-height:7em;height:90px;width:122px;border:1px solid #CCC;text-align:center">No Image</div>';	 
					 }else{
						 $img = '<img src="'.$img_path.'" width="122"  alt="'.$img_caption.'" >';	 
					 }
				  }
			}
			}
			$path=base_url().'index.php/videos/detail/'.@$row->content_id;
            $d.='<li class="'.$className.'">
					<div class="related_vdo_img"><a href="'.$path.'" >'.$img.'</a></div>
					<div class="related_vdo_text"><a href="'.$path.'">'.@$row->title.'</a></div>
                </li>';
   	   }
	
	   $d.='</ul>
		  <div class="clear"></div>
		  <div class="see_all"><a href="'.base_url().'index.php/videos">See all Videos</a></div>
		</div></div>';
		return $d;
	}
	
	public function showonevideo($trailor=0,$w=220,$h=180){
		$r=self::homepagevideo(1,0,false,$trailor);
	
		if(count($r)>0){
			$res= $r[0];
			$this->load->model('artist_in_content_model', 'acm');
			$ra = $this->acm->get_tags($res->content_id);
			$rs_art = $ra->result();		
			$artist_link = '';
			if($ra->num_rows()){
				$rs_art = $rs_art[0];	
				$art_link = base_url().'index.php/artist/profile/'.$rs_art->artist_content_id;
				$artist_link = '<div style="margin-top:3px;"><b>Artist: </b>' . anchor($art_link, truncateStr($rs_art->title, 25)). '</div>';
			}			
			
			$vdo_link = base_url().'index.php/videos/detail/'.$res->content_id;
			$video_link = '<div style="margin-top:3px;"><b>Title: </b>' . anchor($vdo_link, truncateStr($res->title, 26)). '</div>';
						
			$emb=embedvideo($res->video,$w,$h);
			$emb.= $video_link.$artist_link;
			return $emb;
		}
	}
}