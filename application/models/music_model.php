<?php

class Music_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}	
	
	/*
	* -- Returns Top artists. It is determined by the view count
	*/
	public function top_artists($limit=3, $offset=0)
	{
		$s = "SELECT 
				C.content_id, C.title, C.ver1, C.slug, I.image, I.image_path FROM tbl_content C 
				INNER JOIN tbl_content_counter CC ON C.module_id = 11 AND C.content_id = CC.content_id 
				LEFT JOIN tbl_image I ON C.content_id = I.content_id 
				WHERE C.del_flag=0 AND C.status=1 ORDER BY CC.total_count DESC LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;
	}
	
	/*
	* -- Latest album releases.
	*/
	public function latest_releases($limit=16, $offset=0){
		$s = "SELECT 
				C.content_id, C.title, C.ver1, M.image, M.image_path, ART.content_id AS artist_cid, ART.title AS artist, ART.slug AS artist_slug FROM tbl_content C 
				INNER JOIN tbl_album A ON C.content_id = A.content_id 
				INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id 
				INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id 
				LEFT JOIN tbl_image M ON C.content_id = M.content_id 
				WHERE C.del_flag=0 AND C.status=1 ORDER BY A.release_date DESC LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;	
	}
	
	/*
	* -- Recommended Songs.
	*/
	public function recommended_songs($limit=14, $offset=0){
		$s = "SELECT c.content_id, c.title, ac.content_id AS album_cid, ac.title AS album_title, i.image, i.image_path, i.ver1,
			  ac.content_id AS album_content_id, ART.content_id AS artist_cid, ART.title AS artist, ART.slug AS artist_slug  
				FROM tbl_content AS c
				  INNER JOIN tbl_track AS t ON t.content_id = c.content_id
				  INNER JOIN tbl_album AS a ON t.album_content_id = a.content_id
				  INNER JOIN tbl_content AS ac ON ac.content_id = a.content_id
				  INNER JOIN tbl_track_recommend AS rec ON t.content_id = rec.content_id 
				  LEFT JOIN tbl_artist_in_content AC ON c.content_id = AC.content_id 
				  LEFT JOIN tbl_content ART ON AC.artist_content_id = ART.content_id 
				  LEFT JOIN tbl_image AS i ON ac.content_id = i.content_id
				WHERE c.module_id = 20
					AND c.del_flag = 0
					AND c.status = 1
					AND ac.del_flag = 0
					AND ac.status = 1
				GROUP BY c.content_id 
				ORDER BY rec.position LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;	
	}
	
	/*
	* -- Cellroti Picked Albums
	*/
	public function cellroti_pick($limit=14, $offset=0){
		$s = "SELECT 
				C.content_id, C.title, C.ver1, M.image, M.image_path, ART.content_id AS artist_cid, 
				ART.title AS artist, ART.slug AS artist_slug FROM tbl_content C 
				INNER JOIN tbl_album A ON C.content_id = A.content_id 
				INNER JOIN tbl_pick_album P ON C.content_id = P.content_id 
				INNER JOIN tbl_artist_in_content AC ON C.content_id = AC.content_id 
				INNER JOIN tbl_content ART ON AC.artist_content_id = ART.content_id 
				LEFT JOIN tbl_image M ON C.content_id = M.content_id 
				WHERE C.del_flag=0 AND C.status=1 ORDER BY P.position DESC 
				LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;	
	}
	
	/*
	* -- Featured Artists
	*/
	public function featured_artists($limit=6, $offset=0){
		$s = "SELECT c.content_id, c.title, i.image, i.image_path, i.ver1, c.slug 
				FROM tbl_content AS c 
				LEFT JOIN tbl_image AS i ON c.content_id = i.content_id
				WHERE c.module_id = 11
					AND c.del_flag = 0
					AND c.status = 1 
					AND c.featured = 1 
				ORDER BY c.title 
				LIMIT $offset, $limit";
		
		$r = $this->db->query($s);
		$rs = $r->result();
		return $r->num_rows() ? $rs : false;	
	}
}