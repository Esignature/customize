<?php

class Album_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_album';
	public static $tbl_name_cont = 'tbl_content';
	public static $tbl_name_pop = 'tbl_popular_album';
	public static $mod_id=9;
	function __construct()
	{
		parent::__construct();
	}
	
	// get sortorder >> maximum sortorder from the records
	function getSortOrderPop($tbl_name_pop="tbl_popular_album")
	{
		$this->db->select_max('position');
		$q = $this->db->get($tbl_name_pop);
	    $r = $q->row();
		return intval($r->position)+1;
	}
	function find_by_id($content_id=0, $joinAlbum = false)
	{
		return $this->db->get_where(self::$tbl_name, array('content_id'=>$content_id), 1, 0);
	}
	
	function getRecords($mod_id=0,$popular=0,$sort="sortorder", $trash_filter=true, $trash_cond=0, $limit=50, $offset=null)
	{
		$this->db->order_by($sort.' desc'); 
		
		// prepare condition..
		$cond = array('module_id' => $mod_id);
		if($trash_filter == true){
			$cond['del_flag'] = $trash_cond;
		}
		if($popular!=0){
			$cond[$popular] = 1;
		}
		if($popular=="slideshow"){
			$tbl_name_pop='tbl_pick_album';
		}
		else if($popular=="homepage"){
			$tbl_name_pop='tbl_homepage_album';
		}
		else if($popular=="alb_of_week"){
			$tbl_name_pop='tbl_alb_of_week';
		}
		else{
			$tbl_name_pop=	self::$tbl_name_pop;
		}
		$offset = ($offset) ? $offset : 0;


		$this->db->join($tbl_name_pop, ''.self::$tbl_name_cont.'.content_id = '.$tbl_name_pop.'.content_id', 'inner');
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
	public function getAllEvents($module_id=0)
	{
		$s = "SELECT * ";
		//$s.= ", c.posted_date AS posted_date, tbl_content.full_content AS full_content ";
		$s.= "FROM tbl_content as c LEFT JOIN tbl_album as e ON c.content_id = e.content_id ";
		$s.= "WHERE (c.status <> 0 AND c.del_flag = 0) AND (c.module_id={$module_id}) ORDER BY sortorder DESC ";
		
		return $this->db->query($s);
	}
	
	public function getAlbumsOfWeek($limit=1)
	{
		$s = "SELECT C.content_id, C.title, C.ver1, I.image, I.image_path, ART.content_id AS artist_cid, ART.title AS artist_title, ART.slug AS artist_slug 
			FROM tbl_content C 
			INNER JOIN tbl_alb_of_week AW ON C.module_id = 9 AND C.content_id = AW.content_id 
			LEFT JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id 
  			LEFT JOIN tbl_content ART ON AC.artist_content_id = ART.content_id 
			LEFT JOIN tbl_image I ON C.content_id = I.content_id 
			WHERE C.del_flag=0 AND C.status=1 ORDER BY AW.position";
			
		$s .= " LIMIT $limit";
		$q = $this->db->query($s);
		
		if($limit == 1){			
			$r = $q->result();
			return $q->num_rows() ? $r[0] : false;
		}else{
			return $q->num_rows() ? $q : false;	
		}
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
	
	
	
	
	/*
	* -- Returns the total number of rows for frontend album listing
	*/
	public function count_active_albums($filter=NULL)
	{
		$s = "SELECT COUNT(DISTINCT C.content_id) as cnt ";
		$s.= "FROM tbl_content C ";
		$s.= "INNER JOIN tbl_album A ON C.content_id = A.content_id ";
		$s.= "INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id "; 
  		$s.= "INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id ";  
		$s.= "LEFT JOIN tbl_image M ON C.content_id = M.content_id ";
		$s.= "WHERE C.module_id = 9 AND C.status=1 AND C.del_flag = 0 AND ART.status = 1 AND ART.del_flag=0 ";
		if(isset($filter)){
			$filter = urldecode($filter);
			if($filter == '9')
			$s.= "AND C.title REGEXP '^[0-9]' ";
			else
			$s.= "AND C.title LIKE '{$filter}%' ";
		}		
		$r = $this->db->query($s);
		$r = $r->result();
		return isset($r[0]) ? $r[0]->cnt:0;
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
	public function getnewupc($mod_id=9,$table_name="tbl_album",$fld="upc"){
		$sql="select max(".$fld.")+1 as maxupc from ".$table_name." where upc NOT LIKE 'D%'";
		$q=$this->db->query($sql);
		$r=$q->row();
		$rupc=$r->maxupc;
		return $rupc;
	}
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
	Frontend functions
	*/
		function count_crbt_albums($mod_id=9, $popular='latest')
	{
		if($popular == 'latest')
		{
			$s = "SELECT c.content_id, c.title, c.posted_date, t.content_id AS tid, t.artist_display, i.image, i.image_path, i.ver1 
					FROM tbl_content AS c 
					LEFT JOIN tbl_image AS i
					ON c.content_id = i.content_id
					INNER JOIN tbl_track AS t
					ON t.album_content_id = c.content_id 
					INNER JOIN tbl_crbt_to_track AS ct 
					ON t.content_id = ct.track_content_id
					WHERE c.module_id={$mod_id} AND c.del_flag=0 AND STATUS=1
					GROUP BY c.content_id ORDER BY c.sortorder asc
				 ";
		} 
		else if($popular == 'show_all')
		{
			$s = "SELECT c.content_id, c.title, c.posted_date, t.content_id AS tid, t.artist_display, i.image, i.image_path, i.ver1 
					FROM tbl_content AS c 
					LEFT JOIN tbl_image AS i
					ON c.content_id = i.content_id
					INNER JOIN tbl_track AS t
					ON t.album_content_id = c.content_id 
					
					WHERE c.module_id={$mod_id} AND c.del_flag=0 AND STATUS=1
					GROUP BY c.content_id ORDER BY c.sortorder asc
				 ";
		}
		else {
			$s = "SELECT  c.content_id,  c.title,c.posted_date,  t.content_id     AS tid,  t.artist_display,  i.image,  i.image_path,  i.ver1
					FROM tbl_content AS c
					  LEFT JOIN tbl_image AS i
						ON c.content_id = i.content_id
					  INNER JOIN tbl_track AS t
						ON t.album_content_id = c.content_id
					  INNER JOIN tbl_crbt_to_track AS ct
						ON t.content_id = ct.track_content_id
					  INNER JOIN tbl_popular_crbt AS pc
						ON ct.crbt_content_id = pc.content_id
					WHERE c.module_id = 9  AND c.del_flag = 0  AND STATUS = 1
					GROUP BY c.content_id
					ORDER BY pc.position asc
				 ";
		}
	    $q = $this->db->query($s);
		return $q->num_rows();
	}
	 
	function get_crbt_list($mod_id=9, $popular='latest', $perpage=5, $offset=0)
	{	
		if($popular == 'latest')
		{
			$s = "SELECT 
						c.content_id, c.title, c.posted_date, t.content_id AS tid, ART.content_id AS artist_cid, ART.slug AS artist_slug, ART.title AS artist_display, i.image, i.image_path, i.ver1, AC.artist_content_id,
						T_R.total_votes AS t_total_votes , T_R.total_value AS t_total_value, T_R.used_ips AS t_used_ips,						
						A_R.total_votes AS art_total_votes, A_R.total_value AS art_total_value, A_R.used_ips AS art_used_ips,
						ALB_R.total_votes AS alb_total_votes, ALB_R.total_value AS alb_total_value, ALB_R.used_ips AS alb_used_ips 	
					FROM tbl_content AS c 
					LEFT JOIN tbl_image AS i ON c.content_id = i.content_id
					INNER JOIN tbl_track AS t ON t.album_content_id = c.content_id 
					INNER JOIN tbl_crbt_to_track AS ct ON t.content_id = ct.track_content_id 
					LEFT JOIN tbl_rating ALB_R ON c.content_id = ALB_R.content_id 	
					LEFT JOIN tbl_rating T_R ON t.content_id = T_R.content_id 
					LEFT JOIN tbl_artist_in_content AC ON c.content_id = AC.content_id 
					LEFT JOIN tbl_content ART ON ART.content_id = AC.artist_content_id
					LEFT JOIN tbl_rating A_R ON AC.artist_content_id = A_R.content_id  
					WHERE c.module_id={$mod_id} AND c.del_flag=0 AND c.status=1
					GROUP BY c.content_id 
					ORDER BY c.posted_date desc  
					LIMIT {$perpage} OFFSET {$offset}
				 ";
		} else if($popular == 'show_all') 
		{
				$s = "SELECT c.content_id, c.title, c.posted_date, t.content_id AS tid, ART.content_id AS artist_cid, ART.slug AS artist_slug, ART.title AS artist_display, i.image, i.image_path, i.ver1, AC.artist_content_id,    
						T_R.total_votes AS t_total_votes , T_R.total_value AS t_total_value, T_R.used_ips AS t_used_ips,						
						A_R.total_votes AS art_total_votes, A_R.total_value AS art_total_value, A_R.used_ips AS art_used_ips,
  						ALB_R.total_votes AS alb_total_votes, ALB_R.total_value AS alb_total_value, ALB_R.used_ips AS alb_used_ips 						
						FROM tbl_content AS c 
						LEFT JOIN tbl_image AS i ON c.content_id = i.content_id
						INNER JOIN tbl_track AS t ON t.album_content_id = c.content_id 
						LEFT JOIN tbl_artist_in_content AC ON c.content_id = AC.content_id 
						LEFT JOIN tbl_content ART ON ART.content_id = AC.artist_content_id
						LEFT JOIN tbl_rating ALB_R ON c.content_id = ALB_R.content_id 	
						LEFT JOIN tbl_rating T_R ON t.content_id = T_R.content_id 						
						LEFT JOIN tbl_rating A_R ON AC.artist_content_id = A_R.content_id  								
						WHERE c.module_id={$mod_id} AND c.del_flag=0 AND c.status=1
						GROUP BY c.content_id 
						ORDER BY c.posted_date desc 
						LIMIT {$perpage} OFFSET {$offset}
					 ";
		}
		else{
			$s = "SELECT  c.content_id, c.title,c.posted_date, t.content_id AS tid, ART.content_id AS artist_cid, ART.slug AS artist_slug, ART.title AS artist_display, i.image, i.image_path, i.ver1, AC.artist_content_id,    
						T_R.total_votes AS t_total_votes , T_R.total_value AS t_total_value, T_R.used_ips AS t_used_ips,						
						A_R.total_votes AS art_total_votes, A_R.total_value AS art_total_value, A_R.used_ips AS art_used_ips,
  						ALB_R.total_votes AS alb_total_votes, ALB_R.total_value AS alb_total_value, ALB_R.used_ips AS alb_used_ips 
					FROM tbl_content AS c
					  LEFT JOIN tbl_image AS i ON c.content_id = i.content_id
					  INNER JOIN tbl_track AS t ON t.album_content_id = c.content_id
					  INNER JOIN tbl_crbt_to_track AS ct ON t.content_id = ct.track_content_id
					  INNER JOIN tbl_popular_crbt AS pc ON ct.crbt_content_id = pc.content_id 
					  LEFT JOIN tbl_artist_in_content AC ON c.content_id = AC.content_id 
					  LEFT JOIN tbl_content ART ON ART.content_id = AC.artist_content_id
					  LEFT JOIN tbl_rating ALB_R ON c.content_id = ALB_R.content_id 	
					  LEFT JOIN tbl_rating T_R ON t.content_id = T_R.content_id 						
					  LEFT JOIN tbl_rating A_R ON AC.artist_content_id = A_R.content_id  		
					WHERE c.module_id = 9  AND c.del_flag = 0  AND c.status = 1
					GROUP BY c.content_id
					ORDER BY c.posted_date desc 
					LIMIT {$perpage} OFFSET {$offset}
				 ";
		}
		return $this->db->query($s);
	}
	
	public function createThumb($image='', $folder='', $new_width=190, $new_height=190)
	{
		$imagesize=getimagesize("./uploads/".$image);
		$width = $imagesize[0];
		$height = $imagesize[1];
		$type=$imagesize[2];
		if($width>=$height)
		{
			@$ratio=($new_width/$width);
			$new_height=round($height*$ratio);
			//$new_height=190;
		}
		else
		{
			$ratio=($new_height/$height);
			$new_width=round($width*$ratio);
			//$new_width=190;
		}
		$imagefile="./uploads/".$image;
		list($width, $height) = getimagesize($imagefile);
		@$image_p = imagecreatetruecolor($new_width,$new_height);
		if ($imagesize[2] == "1")
		{
			$img = @imagecreatefromgif($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./uploads/".$folder.'/'.$thename;
			imagegif($image_p,$location, 100);
		}
		if ($imagesize[2] == "2")
		{
			$img = @imagecreatefromjpeg($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./uploads/".$folder.'/'.$thename;
			imagejpeg($image_p,$location, 100);
		}
		
		//png images support
		if($imagesize[2] == "3")
		{
			$img=@imagecreatefrompng($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			$location="./uploads/".$folder.'/'.$thename;
			imagepng($image_p,$location, 100);
		}
	}
	
	public function homepageimage(){
		$arralbum=array();
		$sql="SELECT c.title,c.content_id,c.ver1 FROM tbl_content AS c INNER JOIN tbl_album AS a ON c.content_id = a.content_id WHERE c.homepage=1";
		$q=$this->db->query($sql);
		$r=$q->result();
		$this->load->model('artist_in_content_model');
		//new dbug($r);
		foreach($r as $key=>$res){
			$art_id=$this->content_model->getartistids($res->content_id);	
			$explodeart=@explode(",",$art_id->cid);
			//new dbug($explodeart);
			if(count($explodeart)>1 and $art_id->cid!=""){
				$artname="Various artist";	
			}
			else{
				$artobj=$this->content_model->find_by_id($art_id->cid);
				$resobj=$artobj->result();
				$artname=@$resobj[0]->title;
			}
			$arralbum[$key]['album_name']=$res->title;
			$arralbum[$key]['album_artist']=$artname;
			$arralbum[$key]['ver1']=$res->ver1;
			$arralbum[$key]['content_id']=$res->content_id;
		}
		return $arralbum;
		//new dbug($arralbum);
	}
	public function homepageimghtml(){
		$homepage_album=self::homepageimage();
		 $final='';
		
		  foreach($homepage_album as $res){
			  
			    $q = $this->img->find_by_id($res['content_id']);
				$i = $q->row();
				if($q->num_rows() == 0){
					$img_name = $img_path = $img_caption = $img_src = '';
				} else {
					$img_name =@ $i->image;
					$img_path = @$i->image_path;
					$img_caption = @$i->caption;
				}
			  if(@$res->ver1 == 0 && file_exists('./uploads/albumimg/232x193/'.$img_name))
			  {
					$home_img= '<img class="cover active forCaption" src="'.base_url().'uploads/albumimg/232x193/'.@$img_name.'"  alt="'.$img_caption.'"title="'.$img_caption.' " width="232">';
				} 
			  else
			  {
					$home_img= '<img class="cover active forCaption" src="'.$img_path.'" width="232"  width="232">';
			  }
			  
		 $final.=' <div class="wholeImg">
          '.$home_img.'
           <div class="cover boxcaption">
              <h3>'.$res['album_name'].'</h3>
              <p>'.$res['album_artist'].'</p>
          </div>
		  </div>
		 ';
		 }
		 return $final;
		   
	} 
	public function getgenre($content_id=0){
		$q=self::find_by_id($content_id);
		$r=$q->row();
		$genre=$r->genre;
		$l='<select name="genre" id="genre" class="input medium form_tip"><option value="">Select Genre</option>';
		$arrgenre=array("Jazz","Rock","Hip Hop","Pop","Latin","Opera","Sound Track","Flimy");
		
		foreach($arrgenre as $val){
			$sel="";
			if($genre==$val){
			
			$sel='selected="selected"';
				}
        $l.='<option '.$sel.'>'.$val.'</option>';
		}
      $l.='</select>';
	  return $l;
	} 
	
	
}