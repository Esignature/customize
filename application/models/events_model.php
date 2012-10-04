<?php

class Events_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_event';
	public static $tbl_name_cont = 'tbl_content';
	public static $mod_id=21;
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
		$s.= "AND (c.module_id=2 OR c.module_id=3) ";
		$s.= "ORDER BY c.sortorder DESC ";
		$s.= "LIMIT {$limit} OFFSET {$offset}";
		return $this->db->query($s);
	}
	
	/*
	* -- Returns the total number of rows
	*/
	public function count_all($mod_id=0, $trash_filter=true, $trash_cond=0, $status_filter=false, $status=1,$regular="0",$types="past")
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
	
	//Frontend upcoming event
	public function getpast_up($type="upcoming",$pg="home"){
		if($type=="upcoming"){
			$cond="e.date_from > now()";
			$title="Upcoming Events";
			$all_link=base_url()."index.php/events";
		}
		else{
			$cond="e.date_from < now()";
			$title="Past Events";
			$all_link=base_url()."index.php/events/index/archive";
		}
		
			$sql="select * from tbl_content c inner join tbl_event e on c.content_id=e.content_id where ".$cond." and c.status=1 AND c.del_flag=0 and c.module_id='21' limit 2";
			$q=$this->db->query($sql);
			
			$num=$q->num_rows($q);
			//Check if there is no upcoming event... if not show past events
			if($type=="upcoming" && $num==0){
				$sql="select * from tbl_content c inner join tbl_event e on c.content_id=e.content_id where e.date_from < now() and c.status=1 AND c.del_flag=0 and c.module_id='21'  limit 2";
				$title="Past Events";
				$all_link=base_url()."index.php/events/index/archive";
				$q=$this->db->query($sql);
			}
			$r=$q->result();
	if($pg=="home"){
			$htm='<div id="events_wrapper">
    <div class="title_wrapper">
      <div class="events_title">'.$title.'</div>
        <div class="events_sponser">'.$this->sponsor->sponsor_in_page('15').'</div>
        <div class="clear"></div>
    </div>
    <div class="events-contents">';
		//for Home Page
	foreach($r as $key=>$row){
			$htm.='
    	
        <div style="margin-bottom:3px;">
            '.anchor('events/detail/'.@$row->content_id, truncateStr($row->title, 32)).'
            <div class="song_subtitle">'.date('jS M g:ia', strtotime($row->date_from)).'</div>
        </div>';
       }
        $htm.='<div class="hh">
            '.anchor($all_link, 'See all '.$title, array('class'=>'more_events', 'style'=>'color:#36f')).'
        </div>
    </div>
</div>';	
	}
	else{
		
		//for Inner Page
		$htm='<div class="upcoming_wrapper">
    <div class="title_wrapper">
    	<div class="upcoming_title">'.$title.'</div>
        <div class="related_tags">
       '.$this->sponsor->sponsor_in_page('15').'</div>
        <div class="clear"></div>
    </div>

    <div class="content_wrapper">
        <div id="upcoming_events">
        <ul>';
	foreach($r as $key=>$row){
			$htm.='
    	
        <li>
            '.anchor('events/detail/'.@$row->content_id, truncateStr($row->title, 32)).'<br>
            '.date('jS M g:ia', strtotime($row->date_from)).'</li>';
       }
      

            
		$htm.='</ul>
        </div>
        <div class="clear"></div>
        <div class="see_all"><a href="'.$all_link.'" >See all '.$title.'</a></div>
    </div>
</div>';
		
	}
		return $htm;
		
	}
	
}