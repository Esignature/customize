<?php

class Search_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}	
	
	/*
	* -- News, Articles, Interviews, Blogs, Columnist, etc.
	*/
	public function contents($key, $limit=20, $offset=0, $count=false, $tg_id=0)
	{
		$cond1 = ($tg_id>0) ? " AND TG.tag_id = '$tg_id' " : " AND (CONCAT(C.title, C.full_content) LIKE '%$key%' OR TG.tag_name LIKE '%$key%')";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		
		$s = "SELECT C.content_id, C.title, C.ver1, C.created, C.posted_date, C.full_content, C.slug, M.name AS module FROM tbl_content C
				INNER JOIN tbl_module M ON M.module_id = C.module_id 
				LEFT JOIN tbl_image I ON C.content_id = I.content_id 
				$join
				WHERE C.status = 1 AND C.del_flag = 0 AND C.module_id IN (2, 3, 12, 21/*16, 25, 28,*/ ) AND M.status=1 
				$cond1
			  ORDER BY C.created DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";

		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Artists
	*/
	public function artists($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		$cond1 = ($tg_id>0) ? " AND TG.tag_id = '$tg_id' " : " AND (C.title LIKE '%$key%' OR AP.nick_name LIKE '%$key%' OR TG.tag_name LIKE '%$key%') ";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		$s = "SELECT C.content_id, C.title, C.ver1, C.created, C.posted_date, C.full_content, C.slug, 
				I.image, I.image_path, R.total_votes, R.total_value, R.used_ips 
				FROM tbl_content C		
				$join 		
				LEFT JOIN tbl_image I ON C.content_id = I.content_id 
				LEFT JOIN tbl_artist_profile AP ON AP.content_id = C.content_id 
				LEFT JOIN tbl_content_counter CC ON CC.content_id = C.content_id 
				LEFT JOIN tbl_rating R ON C.content_id = R.content_id 	
				WHERE C.status = 1 AND C.del_flag = 0 AND C.module_id = 11  
				$cond1 
			  ORDER BY CC.total_count DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Videos
	*/
	public function videos($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		$cond1 = ($tg_id>0) ? " AND TG.tag_id = '$tg_id' " : " AND (CONCAT(C.title, C.full_content) LIKE '%$key%' OR TG.tag_name LIKE '%$key%') ";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		$s = "SELECT C.content_id, C.title, C.ver1, C.created, C.posted_date, C.full_content, C.slug, 
				AAC.content_id AS artist_cid, AAC.title AS artist_title, 
			    I.image, I.image_path, R.total_votes, R.total_value, R.used_ips  
				FROM tbl_content C	
				$join			
				LEFT JOIN tbl_image I ON C.content_id = I.content_id 
				LEFT JOIN tbl_artist_in_content AC ON AC.content_id = C.content_id 
				LEFT JOIN tbl_content AAC ON AAC.content_id = AC.artist_content_id AND AAC.status = 1 AND AAC.del_flag = 0 
				LEFT JOIN tbl_content_counter CC ON CC.content_id = C.content_id 
				LEFT JOIN tbl_rating R ON C.content_id = R.content_id 
				WHERE C.status = 1 AND C.del_flag = 0 AND C.module_id = 8   
				$cond1
				GROUP BY C.content_id 
			  ORDER BY C.created DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Photoes
	*/
	public function photos($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		$cond1 = ($tg_id>0) ? " AND TG.tag_id = '$tg_id' " : " AND (CONCAT(C.title, C.full_content, G.caption) LIKE '%$key%'  OR TG.tag_name LIKE '%$key%') ";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		$s = "SELECT C.content_id, C.title, C.ver1, C.created, C.posted_date, C.full_content, C.slug, G.image FROM tbl_content C  
				$join 				
				LEFT JOIN tbl_gallery_image G ON G.content_id = C.content_id 
				WHERE C.status = 1 AND C.del_flag = 0 AND C.module_id = 6  
				$cond1
				AND G.sortorder IN (SELECT MIN(GI.sortorder) FROM tbl_gallery_image AS GI GROUP BY GI.content_id ORDER BY GI.sortorder ASC) 
				GROUP BY G.content_id ORDER BY C.created DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Albums
	*/
	public function albums($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		$cond1 = ($tg_id>0) ? " AND TG.tag_id = '$tg_id' " : " AND (CONCAT(C.title, C.full_content, ART.title) LIKE '%$key%' OR TG.tag_name LIKE '%$key%') ";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		$s = "SELECT C.content_id, C.title, C.ver1, C.created, C.posted_date, C.full_content, C.slug, A.itunes_url, A.release_date, 
				M.image_path as image, ART.content_id AS artist_content_id, ART.title AS artist, ART.slug AS artist_slug, R.total_votes, R.total_value, R.used_ips 
				FROM tbl_content C	
				$join 
				INNER JOIN tbl_album A ON C.content_id = A.content_id 
				INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id 
				INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id 				
				LEFT JOIN tbl_image M ON C.content_id = M.content_id 
				LEFT JOIN tbl_rating R ON C.content_id = R.content_id 				
				WHERE C.status = 1 AND C.del_flag = 0 AND C.module_id = 9 
				 AND ART.status = 1 AND ART.del_flag=0 
				 $cond1
			  	ORDER BY C.created DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- CRBT
	*/
	public function crbts($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		$cond1 = ($tg_id>0) ? " TG.tag_id = '$tg_id' " : " (CONCAT(CT.title, CT.full_content, ART.title) LIKE '%$key%'  OR TG.tag_name LIKE '%$key%') ";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		$s = "SELECT 
				C.content_id AS album_cid, C.title AS album, C.ver1, 
				CT.content_id AS track_cid, CT.title AS track, 
				R.used_ips, R.total_votes, R.total_value, I.image_path AS image,
				ART.title AS artist, ART.content_id AS artist_cid, ART.slug AS artist_slug 
				FROM tbl_content C 
				$join 
				INNER JOIN tbl_track T ON C.content_id = T.album_content_id AND C.del_flag = 0 AND C.status = 1 
				INNER JOIN tbl_crbt_to_track C2T ON C2T.track_content_id = T.content_id 
				INNER JOIN tbl_content CT ON CT.content_id = T.content_id AND CT.del_flag = 0 AND CT.status = 1 
				INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id 
				INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id AND ART.del_flag = 0 AND ART.status = 1 		
				LEFT JOIN tbl_image I ON I.content_id = C.content_id 
				LEFT JOIN tbl_rating R ON R.content_id = T.content_id 
				WHERE $cond1
				ORDER BY CT.created DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Songs
	*/
	public function songs($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		$cond1 = ($tg_id>0) ? " AND TG.tag_id = '$tg_id' " : " AND (CONCAT(C.title, ART.title) LIKE '%$key%' OR TG.tag_name LIKE '%$key%') ";
		$join = ($tg_id>0) ? " INNER JOIN tbl_content_tag CTG ON CTG.content_id = C.content_id 
								INNER JOIN tbl_tag TG ON TG.tag_id = CTG.tag_id  " : " LEFT JOIN (tbl_tag TG INNER JOIN tbl_content_tag CTG ON TG.tag_id = CTG.tag_id ) ON TG.tag_name LIKE '%$key%' AND CTG.content_id = C.content_id	";
		
		$s = "SELECT 
				C.content_id AS track_cid, C.title AS track, T.artist_display, 
				AC.title AS album, AC.content_id AS album_cid, C.posted_date, T.content_id AS tid, AC.ver1, 
				I.image_path AS image, I.ver1, AC.content_id AS album_content_id, 
				ART.title AS artist, ART.content_id AS artist_cid, ART.slug AS artist_slug,  
				R.total_votes, R.total_value, R.used_ips 
				FROM tbl_content AS C 
					$join
				  INNER JOIN tbl_track AS T ON T.content_id = C.content_id
				  INNER JOIN tbl_album AS A ON T.album_content_id = A.content_id
				  INNER JOIN tbl_content AS AC ON AC.content_id = A.content_id
				  LEFT JOIN tbl_artist_in_content AIC ON C.content_id = AIC.content_id 
				  LEFT JOIN tbl_content ART ON AIC.artist_content_id = ART.content_id AND ART.del_flag = 0 AND ART.status = 1 	
				  LEFT JOIN tbl_image AS I ON AC.content_id = I.content_id
				  LEFT JOIN tbl_rating R ON C.content_id = R.content_id 
				WHERE C.module_id = 20 AND C.del_flag = 0 AND C.status = 1 AND AC.del_flag = 0 AND AC.status = 1 
				$cond1 
				ORDER BY C.created DESC ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Users
	*/
	public function users($key, $limit=20, $offset=0, $count=false, $tg_id=0){
		
		if($tg_id>0 && $key == 'tagsrch') return false;
		
		$s = "SELECT *, picture_path AS image 
				FROM tbl_user U 
				INNER JOIN tbl_user_role UR ON U.user_id = UR.user_id 
				WHERE U.status = 1 AND UR.role_id = 5
				AND U.username LIKE '%$key%' 
				ORDER BY U.username ";
		
		if(!$count)	  
			  $s .= "LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		
		if($count)	  return $r->num_rows();
		
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
}