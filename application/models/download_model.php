<?php
class Download_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
	}
		
	function getRecords($limit=8, $offset=0, $count=false, $key ='', $isPopular ='')
	{	
		$cond = trim($key) != '' ?  (" AND C.title LIKE '%".$key."%' ") : '';
		$order = $isPopular ? ' downloads DESC ' : ' FD.position ASC ';
		
		$s = "SELECT 
				C.content_id AS track_cid, C.title AS track, T.artist_display, T.track_file, A.upc,  
				AC.title AS album, AC.content_id AS album_cid, C.posted_date, T.content_id AS tid, AC.ver1, 
				I.image_path AS image, I.ver1, AC.content_id AS album_content_id, 
				ART.title AS artist, ART.content_id AS artist_cid, ART.slug AS artist_slug,  
				R.total_votes, R.total_value, R.used_ips,
				(SELECT COUNT(DL.track_id) FROM tbl_download_info DL WHERE DL.track_id = T.content_id GROUP BY DL.track_id )  AS downloads
				FROM tbl_content AS C
				  INNER JOIN tbl_track AS T ON T.content_id = C.content_id
				  INNER JOIN tbl_track_download_free AS FD ON C.content_id = FD.content_id
				  INNER JOIN tbl_album AS A ON T.album_content_id = A.content_id
				  INNER JOIN tbl_content AS AC ON AC.content_id = A.content_id
				  LEFT JOIN tbl_artist_in_content AIC ON C.content_id = AIC.content_id 
				  LEFT JOIN tbl_content ART ON AIC.artist_content_id = ART.content_id AND ART.del_flag = 0 AND ART.status = 1 	
				  LEFT JOIN tbl_image AS I ON AC.content_id = I.content_id
				  LEFT JOIN tbl_rating R ON C.content_id = R.content_id 
				WHERE C.module_id = 20 AND C.del_flag = 0 AND C.status = 1 AND AC.del_flag = 0 AND AC.status = 1 $cond 
				ORDER BY $order";
		if(!$count)	  
			  $s .= " LIMIT $offset, $limit";

		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	function getTrackInfo($track_id){
		$s = "SELECT C.content_id AS track_cid, C.title AS track, T.track_file, A.upc 
				FROM tbl_content C 
				INNER JOIN tbl_track T ON C.content_id = T.content_id AND C.content_id = $track_id AND C.del_flag=0 AND C.status=1 
				INNER JOIN tbl_album AS A ON T.album_content_id = A.content_id";
		$r = $this->db->query($s);
		
		if($r->num_rows()){
			$rs = $r->result();	
			return is_array($rs) ? $rs[0] : false;				
		}
		return false;
		
	}		
	
	/*
	* -- Returns Top artists. It is determined by the view count
	*/
	public function top_artists($limit=6, $offset=0, $count=false)
	{
		$s = "SELECT 
				C.content_id, C.title, C.ver1, C.slug, I.image, I.image_path FROM tbl_content C 
				INNER JOIN tbl_content_counter CC ON C.module_id = 11 AND C.content_id = CC.content_id 
				LEFT JOIN tbl_image I ON C.content_id = I.content_id 
				WHERE C.del_flag=0 AND C.status=1 ORDER BY CC.total_count DESC";
		
		if(!$count)	$s .= " LIMIT $offset, $limit";		
		$r = $this->db->query($s);
		if($count)	return $r->num_rows();		
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
					$link= '<div style="background-color:#751313;color:#fff;font-weight:bold;font-size:8px;line-height:4em;height:33px;width:42px;text-align:center">No Image</div>';
			} 
			else{						
				if(strstr($img_path, 'sites/'))
					$link= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=42&h=33" alt="'.$img_caption.'">';
				else{						
					if(!file_exists($img_path))
					$link= '<div style="background-color:#751313;color:#fff;font-weight:bold;font-size:8px;line-height:4em;height:33px;width:42px;text-align:center">No Image</div>';
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
	
	
	public function homeDownloads($isPoular=false, $innerPage=false){
		$rs_latest = $this->getRecords($innerPage? 3 : 7, 0, false, '', $isPoular);
		$latest = '';
		if($rs_latest){
			$latest =  '<ul><li>';
			foreach($rs_latest as  $r){	
				// dont show in list if the file is not physically available
				if(empty($r->upc) || empty($r->track_file) || !file_exists('./uploads/album/'.$r->upc.'/'.$r->track_file)){
					continue;	
				}
						
				/*********************************/
				$img_path = $r->image;
				if(!strstr($img_path, 'sites/')){				
					$img_url = $img_path;
					$img_path=str_replace('http://www.cellroti.com', $_SERVER['DOCUMENT_ROOT'], $img_path);						 
				}				
				
				if(strstr($img_path, 'sites/'))
					$img_alb= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=30&h=30" alt="'.$r->album.'" border="0" title="'.$r->album.'" width="30" height="30" >';
				else{
					if(!file_exists($img_path))
						$img_alb= '<div style="font-weight:bold;height:30px;text-align:center;color:#fff;border:1px solid #fff;line-height:5em;" title="'.$r->album.'">No Image</div>';
					else
						$img_alb= '<img src="'.base_url().'resizer.php?s='.urlencode($img_url).'&w=30&h=30" border="0" alt="'.$r->album.'" title="'.$r->album.'" width="30" height="30" >';
				}
				/*********************************/
				
				$artistLink = '';
				if($r->artist!='')
					$artistLink = anchor(base_url().'index.php/artist/profile/'.$r->artist_cid, $r->artist, 'title="'.$r->artist.'"');
				
				//$albumLink = anchor(base_url().'index.php/artist/profile/'.$r->artist_cid.'/'.$r->artist_slug.'/album/'.$r->album_cid, $r->album, 'title="'.$r->album.'"');
				$albumImg = anchor(base_url().'index.php/artist/profile/'.$r->artist_cid.'/'.$r->artist_slug.'/album/'.$r->album_cid, $img_alb, 'title="'.$r->album.'"');
				$truncatedTrack = truncateStr($r->track, 16, true);
				$latest .= '            
						  <div class="'.($innerPage?'songs_container_innerpage':'songs_container').'">
								<div class="song_title_container">
								  <div class="song_title">'.anchor(base_url().'index.php/downloads/getform/'.$r->track_cid.'/?lightbox[width]=460&lightbox[height]=420', $truncatedTrack, 'class="lightbox" title="'.$r->track.'"').'</div>								  
								  <div class="song_subtitle">'.$artistLink.'</div>
								</div>
								<div class="song_img">'.$albumImg.'</div>
								<div class="clear"></div>
						   </div>';
			}
			$latest .= '</li></ul>';
		}
		return $latest;
	}
}