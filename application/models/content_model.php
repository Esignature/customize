<?php

class Content_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_content';
	
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
		$q = $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), 1, 0);
		return $q;
	}
	
	function getRecords($mod_id=0, $trash_filter=true, $trash_cond=0, $limit=50, $offset=null, $orderby='sortorder', $mode='desc')
	{
		$this->db->order_by($orderby.' '.$mode); 
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		
		$offset = ($offset) ? $offset : 0;
		$q = $this->db->get_where(self::$tbl_name, $cond, $limit, $offset);
		return $q;
	}
	
	function getSearchRecords($mod_id=0, $keyword='', $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$keyword = trim($keyword);
		$cond = '';
		$offset = ($offset) ? $offset : 0;
		
		$s = "SELECT * FROM ".self::$tbl_name." ";
		$s.= "WHERE module_id=".$mod_id." {$cond} ";
		$s.= "AND ( `title` LIKE '%".$keyword."%' OR `full_content` LIKE '%".$keyword."%') ";
		$s.= "ORDER BY `sortorder` DESC ";
		$s.= "LIMIT {$limit} OFFSET ".$offset;
		
		return $this->db->query($s);
		
	}
	
	public function getPopularNews($module_id=0, $limit=5, $offset=0)
	{
		$s = "SELECT tbl_content.content_id, tbl_content.title AS title, tbl_content_counter.total_count AS counts, tbl_content.ver1 ";
		$s.= ", tbl_content.posted_date AS posted_date, tbl_content.full_content AS full_content ";
		$s.= "FROM tbl_content LEFT JOIN tbl_content_counter ON tbl_content.content_id = tbl_content_counter.content_id ";
		$s.= "WHERE (tbl_content.status <> 0 AND tbl_content.del_flag = 0) AND (tbl_content.module_id={$module_id}) ORDER BY counts DESC ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	public function getSlideshow($limit=10, $offset=0)
	{
		$s = "SELECT c.content_id AS contentid, c.title, c.module_id, c.ver1, i.content_id AS i_content_id, i.image, i.image_path ";
		$s.= "FROM tbl_content AS c JOIN tbl_image AS i ";
		$s.= "ON c.content_id=i.content_id ";
		$s.= "WHERE c.status=1 AND c.del_flag=0 AND i.image <> '' AND c.slideshow=1 ";
		// allow news and article module's image for slideshow.
		$s.= "AND (c.module_id=2 OR c.module_id=3) ";
		$s.= "ORDER BY c.sortorder DESC ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	public function getInterviews($limit=10, $offset=0)
	{
		$s = "SELECT c.content_id AS content_id, c.title, c.module_id, c.posted_date, c.ver1, i.content_id AS i_content_id, i.image, i.image_path ";
		$s.= "FROM tbl_content AS c JOIN tbl_image AS i ";
		$s.= "ON c.content_id=i.content_id AND c.module_id=12 "; // 12 being interview module id.
		$s.= "WHERE c.status=1 AND c.del_flag=0 AND i.image <> '' ";
		$s.= "ORDER BY c.posted_date DESC ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	public function getGallery($limit=10, $offset=0)
	{
		$s = "SELECT c.content_id, c.title, c.posted_date, c.ver1, g.image, g.caption ";
		$s.= "FROM tbl_content AS c ";
		$s.= "JOIN tbl_gallery_image AS g ";
		$s.= "ON c.content_id=g.content_id ";
		$s.= "WHERE c.module_id=6 AND c.del_flag=0 AND c.status=1 AND g.sortorder IN  ";
		$s.= "     (SELECT MIN(gi.sortorder) FROM tbl_gallery_image AS gi GROUP BY gi.content_id ORDER BY gi.sortorder ASC) ";
		$s.= "ORDER BY c.sortorder desc ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	public function getAlbum($limit=40, $offset=0, $filter=NULL)
	{
		$s = "SELECT C.content_id, C.title, C.slug, C.ver1, C.full_content, C.featured, C.popular, C.cellroti_pick, A.upc, A.itunes_url, A.release_date, ";
		$s.= "M.image_path as image, ART.content_id AS artist_content_id, ART.title AS artist/*, A.alb_of_week*/, ";
		$s.= "R.total_votes, R.total_value, R.used_ips ";
		$s.= "FROM tbl_content C ";
		$s.= "INNER JOIN tbl_album A ON C.content_id = A.content_id ";
		$s.= "INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id "; 
  		$s.= "INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id ";  
		$s.= "LEFT JOIN tbl_image M ON C.content_id = M.content_id ";
		$s.= "LEFT JOIN tbl_rating R ON C.content_id = R.content_id ";
		$s.= "WHERE C.module_id = 9 AND C.status=1 AND C.del_flag = 0 AND ART.status = 1 AND C.homepage!=1 AND ART.del_flag=0 ";
		if(isset($_REQUEST['_tsa']) && trim($_REQUEST['_tsa']) != ''){
			$_tsa = addslashes($_REQUEST['_tsa']);
			$s.= "AND C.title LIKE '%{$_tsa}%' ";			
		}elseif(isset($filter)){
			if($filter == '9')
				$s.= "AND C.title REGEXP '^[0-9]' ";
			else
				$s.= "AND C.title LIKE '{$filter}%' ";			
		}
		$s.= "GROUP BY C.content_id ";
		$s.= "ORDER BY C.title /*A.release_date desc, C.sortorder desc*/ ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";		
		
		return $this->db->query($s);
	}
	
	
	public function getItunes($limit=40, $offset=0, $filter=NULL)
	{
		$s = "SELECT C.content_id, C.title, C.slug, C.ver1, A.itunes_url, A.release_date, M.image_path as image, ART.content_id AS artist_content_id, ART.slug AS artist_slug, ART.title AS artist, ";
		$s.= "R.total_votes, R.total_value, R.used_ips ";
		$s.= "FROM tbl_content C ";
		$s.= "INNER JOIN tbl_album A ON C.content_id = A.content_id ";
		$s.= "INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id "; 
  		$s.= "INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id ";  
		$s.= "LEFT JOIN tbl_image M ON C.content_id = M.content_id ";
		$s.= "LEFT JOIN tbl_rating R ON C.content_id = R.content_id ";
		$s.= "WHERE C.module_id = 9 AND C.status=1 AND C.del_flag = 0 AND ART.status = 1 AND ART.del_flag=0 AND A.itunes_url<>'' AND A.itunes_url IS NOT NULL ";
		if(isset($_REQUEST['_tsa']) && trim($_REQUEST['_tsa']) != ''){
			$_tsa = addslashes($_REQUEST['_tsa']);
			$s.= "AND C.title LIKE '%{$_tsa}%' ";			
		}elseif(isset($filter)){
			if($filter == '9')
				$s.= "AND C.title REGEXP '^[0-9]' ";
			else
				$s.= "AND C.title LIKE '{$filter}%' ";			
		}
		$s.= "GROUP BY C.content_id ";
		$s.= "ORDER BY C.title /*A.release_date desc, C.sortorder desc*/ ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";		
		
		return $this->db->query($s);
	}
	
	
	public function getRelatedRecords($module_id=0, $content_id=0, $limit=4, $offset=0)
	{
		$s = "( ";
		$s.= "	  SELECT c.content_id, c.title, c.module_id, c.posted_date, i.image, i.image_path ";
		$s.= "	  FROM tbl_content AS c ";
		$s.= "	  INNER JOIN tbl_artist_in_content AS a ";
		$s.= "    ON c.content_id=a.content_id  AND c.module_id={$module_id} ";
		$s.= "    LEFT JOIN tbl_image AS i ";
		$s.= "    ON i.content_id=c.content_id AND i.image <> '' ";
		$s.= "    WHERE c.status=1 AND c.del_flag=0 AND c.content_id={$content_id} ";
		$s.= "    ORDER BY c.posted_date DESC ";
		$s.= "    LIMIT 4 ";
		$s.= ") UNION ( ";
		$s.= "    SELECT c.content_id, c.title, c.module_id, c.posted_date, i.image, i.image_path ";
		$s.= "    FROM tbl_content AS c  ";
		$s.= "	  LEFT JOIN tbl_image AS i ";
		$s.= "	  ON i.content_id=c.content_id  AND i.image <> '' ";
		$s.= "	  WHERE c.status=1 AND c.del_flag=0 AND c.content_id<>{$content_id}  AND c.module_id={$module_id} ";
		$s.= "	  ORDER BY c.posted_date DESC ";
		$s.= "	  LIMIT 4 ";
		$s.= ") LIMIT 4 ";
		return $this->db->query($s);
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($mod_id=0, $trash_filter=true, $trash_cond=0, $status_filter=false, $status=1)
	{
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		if($status_filter == true){
			$cond['status'] = $status;
		}

		$this->db->where($cond);
		return $this->db->count_all_results(self::$tbl_name);
	}
	
	/*
	* -- Returns the total number of rows (searched only)
	*/
	public function count_search($tbl_name, $field, $keyword='')
	{
		$this->db->like($field, $keyword);     
		return $this->db->count_all_results($tbl_name);
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
	// FRONTEND methods
	public function getallrecords($mod_id=0, $sortorder="posted_date",$limit=4,$del_flag=0)
	{
		$s='select * from '.self::$tbl_name.' where status <> 0 AND del_flag='.$del_flag.' and module_id='.$mod_id.' ORDER BY '.$sortorder.' DESC LIMIT '.$limit;
		$q=$this->db->query($s);
		
		$r= $q->result();
		return $r;
		
	}
	
	public function getPages($limit=20, $order='DESC', $mod_id=25)
	{
		$s = "SELECT c.content_id, c.title, c.slug, c.homepage, m.link, m.target
				FROM tbl_content AS c
				LEFT JOIN tbl_menu AS m
				ON m.menu_id = c.content_id
				WHERE module_id={$mod_id} AND c.status=1 AND del_flag=0 
				ORDER BY c.sortorder {$order} LIMIT ".$limit;
		return $this->db->query($s);
	}
	
	public function getPage($id=0)
	{
		$s = "SELECT c.content_id, c.title, c.full_content, c.slug, c.meta_key, c.meta_desc, c.homepage, m.link, m.target
				FROM tbl_content AS c
				LEFT JOIN tbl_menu AS m
				ON m.menu_id = c.content_id
				WHERE module_id=25 AND c.status=1 AND del_flag=0 AND content_id={$id}
				LIMIT 1";
		return $this->db->query($s);
	}
	
	//get news and articles related or not related to content_id to content_id
	public function getrelatedcontent($content_id=0,$mod_id=0,$del_flag=0,$limit=8,$tbl_name='tbl_video',$join=true){
		$subquery=self::getartistids($content_id,$mod_id,$del_flag);
		$s="(SELECT
			  C.*
			FROM tbl_content C
			  INNER JOIN tbl_artist_in_content A
				ON C.content_id = A.content_id
				 
				  AND A.artist_content_id IN('";
				  
				 $s.=@$subquery->cid;
				 
				 $s.="')";
		if($join){	 
			$s.=" INNER JOIN $tbl_name AS V ON C.content_id=V.content_id";
		}
		$s.=" WHERE C.content_id <>'$content_id'
				AND C.status <> 0  AND C.module_id = '$mod_id'
			ORDER BY C.posted_date DESC LIMIT $limit
			)
			UNION
			(
			";
		$s.=" SELECT
			  C.*
			FROM tbl_content C";
		if($join){	 
	  	  $s.=" INNER JOIN $tbl_name V
				ON C.content_id = V.content_id";
		}
		$s.=" WHERE
				  C.module_id = '$mod_id' AND C.content_id <>'$content_id'
				AND C.status <> 0 AND C.del_flag='$del_flag' ORDER BY posted_date DESC LIMIT $limit
			)    
			LIMIT $limit
    ";
		
		$q=$this->db->query($s);
		return $q->result();
	}
	public function getartistids($content_id=0,$mod_id=0,$del_flag=0){
		$s="SELECT group_concat(A1.artist_content_id) as cid  FROM tbl_content C1";
		$s.=" INNER JOIN tbl_artist_in_content A1 ON C1.content_id = A1.content_id WHERE C1.status <> 0 and C1.del_flag='$del_flag'  AND A1.content_id = '$content_id'";
		$q=$this->db->query($s);
		$r=$q->result();
		return @$r[0];
	}
	
	public function getrelatedarticle($content_id,$type="Article",$mod_id=2,$related=true){
		
		$link_lc=strtolower($type);
		if($related){
			$result=self::getrelatedcontent($content_id,$mod_id,0,4,'',false);
		}
		else{
			$result=self::getallrecords($mod_id,'posted_date');
			
		}
		$v='<style>
			.article_album_left_wrapper {
				margin-bottom: 8px !important;
			}
			.album_img{
				height:60px !important;
				overflow:hidden!important;
				}
		</style>';
		$v.='<div class="main_articles_wrapper">
      <div class="title_wrapper">';
        $v.='<div class="articles_title">'.$type.'</div>';
		
       		 $v.='<div class="articles_sponser">';
			 if($type=="Article"){
				 $v.=$this->sponsor->sponsor_in_page('5');
			 }
			 else{
				  $v.=$this->sponsor->sponsor_in_page('2');
			}
			 $v.='</div>';
		
       $v.=' <div class="clear"></div>
    </div>
    <div class="articles_contents">';
     $i = 0;
	 foreach($result as $row):
	 $cls = ($i%2 == 0) ? 'left' : 'right';
	
		$v.='<div class="article_album_'.$cls.'_wrapper">
				<div class="album_img"> ';
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
						$link= '<img src="'.base_url().'resizer.php?&h=57&w=70&s='.urlencode(base_url().'uploads/'.$img_name).'" alt="'.$img_caption.'" width="70" >';
					else
						$link= '<div style="border:1px solid #CCCCCC;color:#4775FF;font-weight:bold;line-height:3.5em;height:44px;text-align:center">No Image</div>';
				} 
				else
				{
					
					if(strstr($img_path, 'sites/'))
						$link= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=145&h=85" alt="'.$img_caption.'">';
					else{						
						if(!file_exists($img_path))
						$link= '<div style="border:1px solid #CCCCCC;color:#4775FF;font-weight:bold;line-height:3.5em;height:44px;text-align:center">No Image</div>';
						else
						$link= '<img src="'.$img_path.'" width="70" >';
					}
				}
			   $v.=anchor($link_lc.'/detail/'.$row->content_id, $link);
			   $v.='</div>
				<div class="album_text">
					<div class="album_title">';
					   $v.=anchor($link_lc.'/detail/'.$row->content_id, titleLimit($row->title, 30));
				   $v.=' </div>
					<div class="songs_time">'.convertfulldate($row->posted_date).'</div>
				</div>
				<div class="clear"></div>
			 </div>';
	
	 $i++;
	 endforeach;

	$v.='<div class="clear"></div>
 
    <div class="see_all">';
     $v.=anchor($link_lc.'/index', 'See all '.$type);
     $v.='</div>
     </div> 
    
     </div>';
	return $v;
	}
	
public function getrelatedinterview($content_id=0,$mod_id=12,$related=true){
	
		if($related){
			$result=self::getrelatedcontent($content_id,$mod_id,0,8,'',false);
		}
		else{
			$result=self::getallrecords($mod_id,'posted_date',8);
			
		}
		

$int_img = '';
$int_list= '';
$v='';
foreach($result as $r):
    
	$int_img.= '<li>';
	$q = $this->img->find_by_id($r->content_id);
	$i = $q->row();
	if($q->num_rows() == 0){
		$img_name = $img_path = $img_caption = $img_src = '';
	} else {
		$img_name = $i->image;
		$img_path = $i->image_path;
		$img_caption = $i->caption;
	}
			
	if($r->ver1 == 0 && file_exists('./uploads/253x213/'.$img_name))
	{
		$int_img.= '<img src="'.base_url().'uploads/253x213/'.@$img_name.'"  alt="'.$img_caption.'"title="'.$img_caption.'">';
	} 
	else
	{
		$int_img.= '<img src="'.$img_path.'" width="253" height="213" >';
	}
	
	$int_img.= '<div class="lof-main-item-desc"><p>';
    $int_img.= anchor('interview/detail/'.$r->content_id, truncateStr($r->title, 80, true), array('title'=>$r->title));
	$int_img.= '</p></div>';
    $int_img.= '</li>';
		
	$int_list.= '<li>';
    $int_list.= '<div  title="'.$r->title.'">';
    $int_list.= '<h3>'.truncateStr($r->title, 20, true).'</h3>';
    $int_list.= '<span><em>'.ago($r->posted_date, true).'</em></span>';
    $int_list.= '</div> ';
    $int_list.= '</li>';
endforeach;

    $v.='<div id="tabbed_interview_slider" class="lof-slidecontent">
    <div class="preload"><div></div></div>
    <div class="lof-main-outer">
        <ul class="lof-main-wapper"> '.$int_img.'</ul>  	
    </div>                         
    <div class="lof-navigator-outer">
        <ul class="lof-navigator">'.$int_list.'</ul>
    </div>
    <div class="clear"></div>

    <div class="see_all">'.anchor("interview", "See all Interviews").'</div>
</div>';
		return $v;
		}
		
	public function getmainartist($content_id,$del_flag=0,$main=true){
		$getartist=self::getartistids($content_id,"",$del_flag=0);
		$arr=@explode(",",$getartist->cid);
		if($main){
			if(@count($arr)>0 and is_array($arr)){
				return @self::gettitleinarray($arr[0]);
			}
			
			
		}
		else{
			if(count($arr) > 0)
			{
				unset($arr[0]);
				$otherarr=self::gettitleinarray($arr);
				return $otherarr;
			}
		}
		
	}
	
	public function gettitleinarray($id)
	{
		$rr=array();
		if(is_array($id)){
			foreach($id as $key=>$val){
				$byid=self::find_by_id($val);
				$r=$byid->row();
				$rr[$key]['content_id']=@$r->content_id;
				$rr[$key]['title']=@$r->title;
			}
		}
		else{
				$byid=self::find_by_id($id);
				$r=$byid->row();
				$rr['content_id']=@$r->content_id;
				$rr['title']=@$r->title;	
		}
		return $rr;
	}
	
	/*
	* - Artist Profile page
	*/
	public function getArtistProfile($content_id=0)
	{
		
		$s = "SELECT C.content_id AS content_id, C.title, C.slug, C.ver1, C.full_content, I.image, I.image_path, I.caption, A.*
				FROM tbl_content AS C
				LEFT JOIN tbl_image AS I
				ON C.content_id = I.content_id
				LEFT JOIN tbl_artist_profile AS A
				ON A.content_id = C.content_id
				WHERE C.content_id=".$content_id." AND module_id=11 AND del_flag=0 AND status=1
				LIMIT 1";
		return $this->db->query($s);
	}
	
	public function relatedgallery($content_id=0,$mod_id=23,$related=true)
	{
	if($related){
		$result=self::getrelatedcontent($content_id,$mod_id,0,8,'',false);
	}
	else{
		$result=self::getallrecords($mod_id,'posted_date',8);
		
	}
	$cont='	<div class="photographs_wrapper ">
    <div class="title_wrapper">
        <div class="photographs_title">Photographs</div>
        <div class="jcarousel-btnbg" style="left:122px;*left:0"><img class="jcarousel-prev" id="pic-jcarousel-prev" src="'.base_url().'images/btn_prev.png" /><img class="jcarousel-next" id="pic-jcarousel-next" src="'.base_url().'images/btn_next.png" /></div>
        <div class="photographs_sponser"><!--<img src="'.base_url().'images/sponser/fursad.jpg" />--></div>
        <div class="clear"></div>
    </div>
    <div class="photographs_contents">
    <div class="image_slide_display">
        <ul id="pic_carousel">';
$h=1;
foreach($result as $r):
	
	$className = $h++%2==0 ? 'slide_image_center' : 'slide_image';
	
	if($r->ver1 == 0){
		$img = base_url().'uploads/416x231/'.$r->image;
	} else {
		$img = $r->image;
	}
  
    $cont.='<li class="'.$className.'"><div style="width:186px;height:125px;margin-bottom:5px;background:#F5F5F5; overflow:hidden;text-align:center">';
	$cont.=anchor('gallery/detail/'.$r->content_id, '<img src="'.$img.'" border="0" width="186" />').'</div>';
	$cont.=anchor('gallery/detail/'.$r->content_id, truncateStr($r->caption, 30), array('title'=>$r->caption)).'</li>';

endforeach;
       
       $cont.=' </ul>       
        <div class="clear"></div>
    </div>
    <div class="see_all">'.anchor("gallery", "See all Photographs").'</div>
    <div class="clear"></div>
  </div>
</div>';	
	return $cont;
	}
	
	
	
	//get related album
	public function getrelatedalbum($content_id,$mod_id=9,$join=true,$del_flag=0,$limit=4)
	{
		
		$subquery=self::getartistids($content_id,9,$del_flag);
		$s="
			
		(SELECT
			   C.content_id,
  C.title,
  C.slug,
  C.ver1,
  C.full_content,
  C.featured,
  C.popular,
  C.cellroti_pick,
  A.upc,
  A.itunes_url,
  A.release_date,
  M.image_path    AS image,
  ART.content_id  AS artist_content_id,
  ART.title       AS artist";
		
		$s.=" FROM tbl_content C
			  INNER JOIN tbl_album A
				ON C.content_id = A.content_id
			  INNER JOIN tbl_artist_in_content AC
				ON C.content_id = AC.content_id
			  
	
				  AND AC.artist_content_id IN('";
				  
				 $s.=@$subquery->cid;
				 
				 $s.="') 
			INNER JOIN tbl_content ART
				ON AC.artist_content_id = ART.content_id
			  LEFT JOIN tbl_image M
				ON C.content_id = M.content_id
				";
		
		$s.=" WHERE C.content_id <>'$content_id'
				AND C.status <> 0  AND C.module_id = '$mod_id' AND ART.status = 1
  				AND ART.del_flag = 0 GROUP BY C.content_id
			ORDER BY C.posted_date DESC  LIMIT $limit
			)
			UNION
			(
			
			SELECT
				  C.content_id,
				  C.title,
				  C.slug,
				  C.ver1,
				  C.full_content,
				  C.featured,
				  C.popular,
				  C.cellroti_pick,
				  A.upc,
				  A.itunes_url,
				  A.release_date,
				  M.image_path    AS image,
				  ART.content_id  AS artist_content_id,
				  ART.title       AS artist
				FROM tbl_content C
				  INNER JOIN tbl_album A
					ON C.content_id = A.content_id
				  INNER JOIN tbl_artist_in_content AC
					ON C.content_id = AC.content_id
				  INNER JOIN tbl_content ART
					ON AC.artist_content_id = ART.content_id
				  LEFT JOIN tbl_image M
					ON C.content_id = M.content_id
				WHERE C.module_id = '$mod_id'
					AND C.content_id <>'$content_id'
					AND C.status = 1
					AND C.del_flag = '$del_flag'
					AND ART.status = 1
					AND ART.del_flag = '$del_flag' AND C.content_id <>'$content_id' GROUP BY C.content_id
					 ORDER BY C.posted_date DESC
					 LIMIT $limit
			   )
			LIMIT $limit
    ";
		
		$q=$this->db->query($s);
		return $q->result();
	}
	
	
}