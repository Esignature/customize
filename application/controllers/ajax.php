<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    private $adminid = 0;
	private $roleid = 0;

	function __construct()
	{
		parent::__construct();
		$this->load->model('tags_model', 'tag');
	}

    /*
	* -- checkLogin >> checks if the user is logged in or not
	* -- returns the user's id if logged in.
	* -- redirects to login page if false
	*/
	function checkLogin()
	{
		$this->adminid = get_cookie(APPID.'_admin');
		!$this->adminid && redirect('apanel/login', 'refresh');
		return $this->adminid;
	}
	
	/*
	**  get the user's role id
	*/
	function getRoleId()
	{
		$this->roleid = get_cookie(APPID.'_access');
		return $this->roleid;
	}
		
	/*
	* - Trash the contents
	* - set del_flag = 1 :: tbl_content
	*/
	function trash_group()
	{	
	    $ret = array();
		$tbl_name = str_replace('tbl_', '', $this->uri->segment(3));
		
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			if($tbl_name=='pg_block_sp'){
				$id_fld="pbs_id";
			}
            if($tbl_name=='package'){
                $id_fld="pkg_id";
            }
			// table name
			$tbl_name = 'tbl_'.$tbl_name;
			
			$allid = $_POST['id'];
			$sepid = explode('|', $allid);
			$total = count($sepid);
			$del = 0;
			for($i=1; $i<$total; $i++){
				($this->db->update($tbl_name, array('del_flag'=>'1', 'status'=>'0'), array($id_fld => $sepid[$i]) )) ? $del++ : '' ;
			}
			
			if($tbl_name == 'user'){
			 $this->load->model('user_model');
			 $total_rec =" Total Users: ".$this->user_model->count_all_users()." [active:".$this->user_model->count_all_users(true, 1)."]";
            }
            
			$show = ($del == ($total-1)) ? $del : $del.'/'.($total-1);
			$ret = ($del == 0) ? array('msg'=>'Unable to trash selected rows!', 'flag'=>0, 'txtflag'=>'strip') : array('msg'=>' Selected '.$show.' records has been moved to trash!', 'flag'=>1, 'txtflag'=>'strip', 'total_rec'=>$total_rec);
		}
		echo json_encode($ret);
	}
	
	/*
	* - Delete the trashed contents
	* - Delete permanently from DB
	* - ** Need to have Administrator Previlege for deleting **
	*/
	function delete_group()
	{		
	    $ret = array();
	    
		$tbl_name = str_replace('tbl_', '', $this->uri->segment(3));
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			if($tbl_name=='pg_block_sp'){
				$id_fld="pbs_id";
			}
            if($tbl_name=='package'){
                $id_fld="pkg_id";
            }elseif($tbl_name == 'account'){
                
                
                
                
            }
			// table name
			$tbl_name = 'tbl_'.$tbl_name;
			
			$allid = $_POST['id'];
			$sepid = explode('|', $allid);
			$total = count($sepid);
			$del = 0;
			for($i=1; $i<$total; $i++){
			    
                ($this->db->delete($tbl_name, array($id_fld => $sepid[$i]))) ? $del++ : '' ;    
			    if($tbl_name == 'tbl_account'){
                    
                    $this->db->delete("tbl_account_log", array("account_id"=>$sepid[$i]));
                    $this->db->delete("tbl_site", array("account_id"=>$sepid[$i]));
                    $this->db->query("DELETE t1, t2 FROM tbl_account_user t1 INNER JOIN tbl_user_to_site t2 ON t1.account_user_id 
                    = t2.account_user_id AND t2.account_id=".$sepid[$i]);                                        
                }
				
			}
			
            if($tbl_name == 'user'){			
			$this->load->model('user_model');
			$total_rec ="Total Users: ".$this->user_model->count_all_users()." [active:".$this->user_model->count_all_users(true, 1)."]";
            }
            
			$show = ($del == ($total-1)) ? $del : $del.'/'.($total-1);
			$ret = ($del == 0) ? array('msg'=>'Unable to delete selected rows!', 'flag'=>0, 'txtflag'=>'strip') : array('msg'=>'Selected '.$show.' records has been deleted.!', 'flag'=>1, 'txtflag'=>'strip', 'total_rec'=>$total_rec);
		}
		echo json_encode($ret);
	}

    /*
	* - Initialy meant to Popular tagging of the content. later changed to featured.
	* - Toggle the record's featured flagging to 1 or 0.
	*/
	function togglePopular()
	{		
	    $ret = '';
		$tbl_name = $this->uri->segment(3);
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			
			// table name
			$tbl_name = 'tbl_'.str_replace('tbl_', '', $tbl_name);
			
			$id = $_POST['id'];
			$this->db->select('featured');
			$q = $this->db->get_where($tbl_name, array($id_fld => $id), 1, 0);
			$r = $q->row();
			$marked = ($r->featured == 1) ? 0 : 1;

			$del = 0;
			($this->db->update($tbl_name, array('featured'=>$marked), array($id_fld => $id) )) ? $del++ : '' ;
			$ret = ($del == 0) ? $r->featured : $marked;
		}
		echo $ret;
	}
	
	/*
	* - Toggle the record's slideshow flagging to 1 or 0.
	* - Record with slideshow=1 will be listed for slideshow.
	*/
	function toggleSlideshow()
	{		
	    $ret = '';
		$tbl_name = $this->uri->segment(3);
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			
			// table name
			$tbl_name = 'tbl_'.$tbl_name;
			
			$id = $_POST['id'];
			$this->db->select('slideshow');
			$q = $this->db->get_where($tbl_name, array($id_fld => $id), 1, 0);
			$r = $q->row();
			$marked = ($r->slideshow == 1) ? 0 : 1;

			$del = 0;
			($this->db->update($tbl_name, array('slideshow'=>$marked), array($id_fld => $id) )) ? $del++ : '' ;
			$ret = ($del == 0) ? $r->slideshow : $marked;
		}
		echo $ret;
	}
	
	/*
	* - Set the record's status to 1
	* - setting status=1 will enable record to be visible in frontend.
	*/
	function publish_group()
	{		
	    $ret = array();
		$tbl_name = str_replace('tbl_', '', $this->uri->segment(3));
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			if($tbl_name=='pg_block_sp'){
				$id_fld="pbs_id";
			}
            if($tbl_name=='package'){
                $id_fld="pkg_id";
            }
			// table name
			$tbl_name = 'tbl_'.$tbl_name;
			
			$allid = $_POST['id'];
			$sepid = explode('|', $allid);
			$total = count($sepid);
			$del = 0;
			for($i=1; $i<$total; $i++){
				($this->db->update($tbl_name, array('status'=>'1'), array($id_fld => $sepid[$i]) )) ? $del++ : '' ;
			}
			
			if($tbl_name == 'user'){
			$this->load->model('user_model');
			$total_rec =" Total Users: ".$this->user_model->count_all_users()." [active:".$this->user_model->count_all_users(true, 1)."]";
            }
            
			$show = ($del == ($total-1)) ? $del : $del.'/'.($total-1);
			$ret = ($del == 0) ? array(msg=>'Unable to perform the task.', 'flag'=>0, 'txtflag'=>'publish') : array('msg'=>'Selected '.$show.' record\'s status set to On!', 'flag'=>1, 'txtflag'=>'publish', 'total_rec'=>$total_rec);
		}
		echo json_encode($ret);
	}
	
	/*
	* - Set the record's status to 0
	* - setting status=0 will disable record to be visible in frontend.
	*/
	function unpublish_group()
	{		
	    $ret = array();
		$tbl_name = str_replace('tbl_', '', $this->uri->segment(3));
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			if($tbl_name=='pg_block_sp'){
				$id_fld="pbs_id";
			}
            if($tbl_name=='package'){
                $id_fld="pkg_id";
            }
			// table name
			$tbl_name = 'tbl_'.$tbl_name;
			
			$allid = $_POST['id'];
			$sepid = explode('|', $allid);
			$total = count($sepid);
			$del = 0;
			for($i=1; $i<$total; $i++){
				($this->db->update($tbl_name, array('status'=>'0'), array($id_fld => $sepid[$i]) )) ? $del++ : '' ;
			}
			
            if($tbl_name == 'user'){
			$this->load->model('user_model');
			$total_rec =" Total Users: ".$this->user_model->count_all_users()." [active:".$this->user_model->count_all_users(true, 1)."]";
            }
			$show = ($del == ($total-1)) ? $del : $del.'/'.($total-1);
			$ret = ($del == 0) ? array(msg=>'Unable to perform the task.', 'flag'=>0, 'txtflag'=>'strip') : array('msg'=>'Selected '.$show.' record\'s status set to Off!', 'flag'=>1, 'txtflag'=>'unpublish', 'total_rec'=>$total_rec);
		}
		echo json_encode($ret);
	}
	
	/*
	* - Reorder the record's listing order 
	* - By modifying the sortorder field in the database.
	*/
	function reorder()
	{		
	    $ret = '';
		$tbl_name = str_replace('tbl_', '', $this->uri->segment(3));
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			$id_fld = ($field) ? $field : $tbl_name;
			$id_fld.= '_id';
			if($tbl_name=='pg_block_sp'){
				$id_fld="pbs_id";
			}
			// sortorder field name
			$field     = $this->uri->segment(5);
			$order_fld = ($field) ? $field : 'sortorder';

			// table name
			$tbl_name = 'tbl_'.$tbl_name;

			$id 	= $_POST['id']; 	// IS a line containing ids starting with : sortIds
			$order	= $_POST['order'];  // IS a line containing sortorder
			$arr_id = explode("|", $id);
			$arr_or	= explode("|", $order);

			$total = count($arr_or);
			$del = 0;
			for($i=1; $i<$total; $i++){
				$cond_array = array($id_fld => $arr_id[$i]);
				$data_array = array($order_fld => $arr_or[$i]);
				($this->db->update($tbl_name, $data_array, $cond_array)) ? $del++ : '' ;
			}
			
			$show = ($del == ($total-1)) ? $del : $del.'/'.($total-1);
			$ret  = ($del == 0) ? 'Unable to perform the task.|0|reorder' : ' Records has been reordered! |1|reorder';
		}
		echo $ret;
	}
	
	/*
	* - Get the tag suggestion list.
	*/
	function getSuggestion()
	{
		$q = $this->uri->segment(3);
		if($q)
		{				
			  $sql = "SELECT DISTINCT(tag_name), tag_id FROM tbl_tag WHERE tag_name LIKE '%$q%'";
			  $q = $this->db->query($sql);
			  foreach($q->result() as $r):
				 echo $r->tag_name."\n";
			  endforeach;
		}
		exit;
	}
	
	/*
	* - Get the artist suggestion list
	*/
	function getArtistSuggestion()
	{
		$module_id = 11; // module id of Artist.
		$q = $this->uri->segment(3);
		if($q)
		{					
			  $sql = "SELECT DISTINCT(title), content_id FROM tbl_content WHERE module_id=11 AND title LIKE '%$q%'";
			  $q = $this->db->query($sql);
			  foreach($q->result() as $r):
				 echo $r->title."|".$r->content_id."\n";
			  endforeach;
		}
		exit;
	}
	
	/*
	* - Check the tag requested by the user
	* - create if not exist
	* - Return the tag id.
	*/
	function checkTag()
	{
		$ret = '';
		if(isset($_POST) && $_POST['tag'] != ''){
		    $tag = $_POST['tag'];
			// check if the tag already exist..
			$q = $this->tag->searchTag($tag);
			if($q->num_rows() == 1){
				$r = $q->row();
				$ret = $r->tag_id;
			} else {
				if($this->db->insert('tbl_tag', array('tag_name' => $tag, 'weight'=>0, 'ver1'=>2)))
				{
					$q = $this->tag->searchTag($tag);
					$r = $q->row();
					$ret = $r->tag_id;
				}
			}
		}
		echo $ret;
		exit;
	}
	
	/*
	** - Ajax Request for removing image..
	*/
	function removeGalleryImg($img=''){
		$ret = '';
		$dir = './uploads/';
		if($img == ''){
		    $img = (isset($_POST['img'])) ? $_POST['img'] : '';
		}
		if($img != ''){
			$this->db->delete('tbl_gallery_image', array('image' => $img)); 
			@unlink($dir.$img);
			@unlink($dir.'gallery/'.$img);
			@unlink($dir.'416x231/'.$img);
			$ret = 'done';
		}
		return $ret;
	}
	
	function removeArtistGalleryImg($img=''){
		$ret = '';
		$dir = './uploads/';
		if($img == ''){
		    $img = (isset($_POST['img'])) ? $_POST['img'] : '';
		}
		if($img != ''){
			$this->db->delete('tbl_artist_image', array('image' => $img)); 
			@unlink($dir.$img);
			@unlink($dir.'artist/'.$img);
			$ret = 'done';
		}
		return $ret;
	}
	
	function cropImage(){
		$this->load->helper('uploader');
		$img = $_POST['image'];
		$w = $_POST['width'];
		$h = $_POST['height'];
		$offx = $_POST['offx'];
		$offy = $_POST['offy'];
		if(crop($img, 'gallery/', '416x231/', $w, $h, $offx, $offy)){
			echo 'done';
		} else {
			echo 'fail';
		}
	}
	//order for popular crbt
	
	function reorder_pop()
	{		
	    $ret = '';
		$tbl_name = $this->uri->segment(3);
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			$field = $this->uri->segment(4);
			//$id_fld = ($field) ? $field : $tbl_name;
			$id_fld= 'content_id';

			// sortorder field name
			$field     = $this->uri->segment(5);
			$order_fld = ($field) ? $field : 'position';

			// table name
			$tbl_name = 'tbl_'.$tbl_name;

			$id 	= $_POST['id']; 	// IS a line containing ids starting with : sortIds
			$order	= $_POST['order'];  // IS a line containing sortorder
			$arr_id = explode("|", $id);
			$arr_or	= explode("|", $order);

			$total = count($arr_or);
			$del = 0;
			for($i=1; $i<$total; $i++){
				$cond_array = array($id_fld => $arr_id[$i]);
				$data_array = array($order_fld => $arr_or[$i]);
				($this->db->update($tbl_name, $data_array, $cond_array)) ? $del++ : '' ;
			}
			
			$show = ($del == ($total-1)) ? $del : $del.'/'.($total-1);
			$ret  = ($del == 0) ? 'Unable to perform the task.|0|reorder' : ' Records has been reordered! |1|reorder';
		}
		echo $ret;
	}
	
	function togglePopular_pop($tbl_name_cont="content",$load_module="crbt_model",$tbl_pop="tbl_popular_crbt",$fld="featured")
	{		
	    $ret = '';
		//$tbl_name = $this->uri->segment(3);
		$tbl_name = $tbl_name_cont;
		if($tbl_name && isset($_POST) && $_POST['id'] != '')
		{
			// id field name
			//$field = $this->uri->segment(4);
			//$id_fld = ($field) ? $field : $tbl_name;
			$id_fld= $tbl_name.'_id';
			
			// table name
			$tbl_name = 'tbl_'.$tbl_name;
			
			
			
			$id = $_POST['id'];
			
		
			
			$this->db->select($fld);
			$q = $this->db->get_where($tbl_name, array($id_fld => $id), 1, 0);
			$r = $q->row();
			$marked = ($r->$fld == 1) ? 0 : 1;
			
				//for popular sorting
			$this->load->model($load_module);
			//$this->load->model('album_model');
			
			$this->db->where('content_id', $id);
			$this->db->delete($tbl_pop); 
			if($marked==1){
				$pos = $this->$load_module->getSortOrderPop($tbl_pop);
				$popdata=array("content_id"=>$id,"position"=>$pos);
				$this->db->insert($tbl_pop,$popdata);
			}
			//end popular sorting
			
			$del = 0;
			($this->db->update($tbl_name, array($fld=>$marked), array($id_fld => $id) )) ? $del++ : '' ;
			$ret = ($del == 0) ? $r->featured : $marked;
		}
		echo $ret;
	}
	
    function getTrackSuggestion()
	{
		$module_id = 20; // module id of Artist.
		$q = $this->uri->segment(3);
		if($q)
		{					
			  $sql = "SELECT DISTINCT(title), content_id FROM tbl_content WHERE module_id='".$module_id."' AND title LIKE '%$q%'";
			  $q = $this->db->query($sql);
			  foreach($q->result() as $r):
				 echo $r->title."|".$r->content_id."\n";
			  endforeach;
		}
		exit;
	}
	
	function load_crbt_detail($crbt=0, $network=0, $track=0)
	{
		$ret = 'fail';
		if(isset($_POST) && isset($_POST['crbt']) && isset($_POST['track']) && isset($_POST['network']))
		{
			$crbt = $_POST['crbt'];
			$track = $_POST['track'];
			$network = $_POST['network'];
			$q = $this->db->get_where('tbl_network_operator', array('content_id'=>$network));
			$q_c = $this->db->get_where('tbl_crbt', array('netop_id'=>$network, 'content_id'=>$crbt));
			
			$r_n = $q->row();
			$r_c = $q_c->row();
			
			$crbt_inst = str_replace('!crbtcode!', $r_c->code, $r_n->crbt_instruction);
			$ret = '<div class="mycustom_show">'.$crbt_inst.'<div class="clear"></div></div>';
			
		}
		echo $ret;
	}
	
	function getAlbumSuggestion()
	{
		$module_id = 9; // module id of Artist.
		$q = $this->uri->segment(3);
		if($q)
		{					
			  $sql = "SELECT DISTINCT(title), content_id FROM tbl_content WHERE module_id='".$module_id."' AND title LIKE '%$q%'";
			  $q = $this->db->query($sql);
			  foreach($q->result() as $r):
				 echo $r->title."|".$r->content_id."\n";
			  endforeach;
		}
		exit;
	}
	
	function rate()
	{		
		header("Cache-Control: no-cache");
		header("Pragma: nocache");
		
		//getting the values
		$v_s = preg_replace("/[^0-9\.]/","",$_REQUEST['v']);	// voted count
		$id = preg_replace("/^rt_/","",$_REQUEST['id']); 	// id
		$units = 5;											// total voting unit
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if ($v_s > $units) die(json_encode(array('i'=>$id, 's'=>0, 'm'=>'Sorry, vote appears to be invalid.')));		
		
		$_q = $this->db->query("SELECT total_votes, total_value, used_ips FROM tbl_rating WHERE content_id='$id' LIMIT 1")or die(json_encode(array('i'=>$id, 's'=>0, 'm'=>'Error: '.mysql_error())));
		if($_q->num_rows()){
			$r = $_q->result();
			$r = $r[0];	
			$chkIP = unserialize($r->used_ips);
			$cnt = $r->total_votes; //how many votes total
			$c_r = $r->total_value; //current rating recorded in db
			
			$sum = $v_s+$c_r; // add together the current vote value and the total vote value
			
			// checking to see if the first vote has been tallied or increment the current number of votes
			($sum==0 ? $added=0 : $added=$cnt+1);
									
			// if it is an array i.e. already has entries the push in another value
			$voted = false;
			if(is_array($chkIP)){
				if(!in_array($ip, $chkIP)){
					array_push($chkIP,$ip);
					$voted = false;
				}
				else{
					$voted = true;		 		
					die(json_encode(array('s'=>0, 'r'=>$this->srate($id), 'i'=>$id, 'av'=>1, 'm'=>'You\'ve already voted to this item.')));
				}
			}
			
			$insip=serialize($chkIP);
			
			//IP check when voting			
			if(!$voted) {//if the user hasn't yet voted, then vote normally...			
				if ($v_s >= 1 && $v_s <= $units) { // keep votes within range
					$q_u = "UPDATE tbl_rating SET total_votes='".$added."', total_value='".$sum."', used_ips='".$insip."' WHERE content_id='$id'";
					$result = $this->db->query($q_u);		
				} 
			}			
		}else{	
			$insip=serialize(array($ip));				
			if ($v_s >= 1 && $v_s <= $units) { // keep votes within range
				$q_i = "INSERT INTO tbl_rating SET total_votes='1', total_value='".$v_s."', used_ips='".$insip."', content_id='$id'";
				$this->db->query($q_i);
			}			
		}
					
		// these are new queries to get the new values!
		$r_nt = $this->db->query("SELECT total_votes, total_value, used_ips FROM tbl_rating WHERE content_id='$id' ")or die(json_encode(array('i'=>$id, 's'=>0, 'm'=>'Error: '.mysql_error())));
		$r_nt = $r_nt->result();
		$r_nt = $r_nt[0];
		$cnt = $r_nt->total_votes;
		$c_r = $r_nt->total_value;			
		die(json_encode(array('i'=>$id, 's'=>1, 'm'=>'', 'r'=>$this->srate($id))));
	}
	
	//display the updated rating for given content_id
	function srate($id){
		// these are new queries to get the new values!
		$r_nt = $this->db->query("SELECT total_votes, total_value, used_ips FROM tbl_rating WHERE content_id='$id' ")or die(json_encode(array('i'=>$id, 's'=>0, 'm'=>'Error: '.mysql_error())));
		if(!$r_nt->num_rows()) return 0;
		
		$r_nt = $r_nt->result();
		$r_nt = $r_nt[0];
		$cnt = $r_nt->total_votes;
		$c_r = $r_nt->total_value;		
		return round($c_r/$cnt, 2);	
	}
	
	//save contact form  submission and email
	//display the updated rating for given content_id
	function contact(){

    //generate slug
    function slug(){
        $json = array();    
        $this->load->helper('ajax');
        
        $title = $this->input->post('title');
        $table      = $this->input->post('table');
        $mod_id     = $this->input->post('module');            
        $json['slug'] = createSlug($title, $table=NULL, $value=NULL);        
    }



		
		if(count($_POST)){
			$nm  = $_POST['nm'];
			$eml = $_POST['eml'];
			$sbj = $_POST['sbj'];
			$msg = $_POST['msg'];
			
			$data = array(
			   'm_type' => 'contact',
			   'm_sbj' => $sbj,
			   'm_eml' => $eml,
			   'm_msg' => $msg,
			   'm_date' => date('Y-m-d h:i:s'),
			   'm_ip' => $_SERVER['REMOTE_ADDR'],
			   'm_uid' => 0,
			   'm_sender' => $nm,
			   'm_status' => 1			   
			);
			$this->db->insert('tbl_message', $data);			
			if($this->db->insert_id()){			
				/*******SEND AN EMAIL TO ADMIN NOTIFYING ABOUT THE CONTACT SUBMISSION*****/
				if(!strstr($_SERVER['HTTP_HOST'], 'localhost')){
					$this->load->library('email');		
					$this->email->from($eml, $nm);
					$this->email->to('info@cellroti.com');			
					$this->email->subject('Cellroti Contact Form: '.$sbj);
					$this->email->message($msg);					
					$this->email->send();
				}
				die(json_encode(array('m'=>'Thank you for the message. We will respond as soon as possible.', 's'=>1)));
			}else{
				die(json_encode(array('m'=>'There was some error while submitting the form. <br />We apolosize for the inconvinience. Please try again or call Cellroti.', 's'=>0)));
			}
		}else{
			die(json_encode(array('m'=>'Sorry! We did not find any data posted.', 's'=>0)));	
		}		
	}	
    
    function slug(){
        
        $json = array();
        $title = $this->input->post('title');
        $module_id = $this->input->post('module');
        $table = 'tbl_'.$this->input->post('table');
        $key_id = $this->input->post('key_id');
        
        $json['slug'] = createSlug($title, $table, $key_id);
        echo json_encode($json);        
    }
    
    // get site_details in admin's Personalization Section
    function site_details(){
        $site_id = $this->input->post('site_id');
        if($site_id == 0) return false;
        
        $this->load->model('account_model', 'ac');
        $r = $this->ac->site_by_id($site_id);
        $html  = '<ul class="s_d_r">
                    <li class="lbl fl">Site ID: </li>
                    <li class="lbl_val fl">'.$r->uniq_id.'</li>
                  </ul>';
        $html .= '<ul class="s_d_r">
                    <li class="lbl fl">Site Name: </li>
                    <li class="lbl_val fl">'.$r->site_name;        
                    if(trim($r->site_type) != ''){
                        $html .= '<br /><span class="em">Under Category: '.$r->site_type.'</span>';
                    }                        
        $html .= '</li></ul>';
        
        $html .= '<ul class="s_d_r">
                    <li class="lbl fl">Site Domain: </li>
                    <li class="lbl_val fl">'.
                        anchor(urlmaker($r->protocol, $r->domain), $r->domain, 'title="Click to visit the website." class="tooltip" target="_blank"').
                        ( is_serialized($r->sub_domains)?('<br /><hr />'.join('<br />', unserialize($r->sub_domains))):'')        
                    .'</li></ul>';
        $html .= '<ul class="s_d_r">
                    <li class="lbl fl">Site Description: </li>
                    <li class="lbl_val fl">'.$r->description.'</li>
                  </ul>';        
        $html .= '<ul class="s_d_r">
                    <li class="lbl fl">Package: </li>
                    <li class="lbl_val fl">'.$r->pkg_name.            
                    calc_trial_days($r->pkg_trial_period, $r->expiry_date, $r->created, true, '<br />').
                    (!empty($r->pkg_price) ? '<br />Price: '.$this->config->item('def_curr_sym').$r->pkg_price : '').        
                    '</li></ul>';
        if($r->purchased == '1'){
            $html .= '<ul class="s_d_r">
                        <li class="lbl fl">Package Purchased: </li>
                        <li class="lbl_val fl">'.mdate(DATE_STR, strtotime($r->purchased_on)).'</li>
                     </ul>';
        }
        $html .= '<ul class="s_d_r">
                    <li class="lbl fl">Site Registered On: </li>
                    <li class="lbl_val fl">'.mdate(DATE_STR, strtotime($r->created)).'</li>
                  </ul>';
        if(!empty($r->expiry_date) && $r->expiry_date != '0000-00-00 00:00:00'){
            $html .= '<ul class="s_d_r">
                        <li class="lbl fl">Expiry Date: </li>
                        <li class="lbl_val fl">'.mdate(DATE_STR, strtotime($r->expiry_date)).'</li>
                      </ul>';
        }
        
        echo json_encode(array('html'=>$html));
        
    }

    // get state list according to given country code in segmentation creation page.    
    function state_list(){
        $this->load->helper('address');    
        $cn_code = $this->input->post('cn_code');
        $cn_code = explode('|', $cn_code);
        $sel = $this->input->post('sel');
        $cnty = getStates($cn_code);
        
        $op = '';
        foreach($cnty as $k=>$c){
           $op .= '<option value="'.$k.'" '.($sel==$k ? 'selected':'').'>'.$c['state'].'</option>';
        }   
        echo json_encode(array('html'=>$op));      
    }

    // get city list according to given country code in segmentation creation page.    
    function city_list(){
        $this->load->helper('address');    
        $cn_code = $this->input->post('cn_code', true);
        $cn_code = explode('|', $cn_code);
        $sel = $this->input->post('sel', true);
        $sel = explode('|', $sel);        
        $cnty = getCities($cn_code);
        
        $op = '';
        foreach($cnty as $k=>$c){
           $op .= '<option value="'.$k.'" '.(in_array($k, $sel) ? 'selected':'').'>'.$c['city'].'</option>';
        }   
        echo json_encode(array('html'=>$op));      
    }

    // fetch company lists according to the search keyword posted.    
    function company_list(){
        $this->load->helper('segmentation');    
        $s = $this->input->post('s');
        $sel = $this->input->post('sel');
        $cnty = company_list($s, $sel);
        
        $op = '';
        foreach($cnty as $k=>$c){
           $op .= '<option value="'.$k.'" '.($sel==$k ? 'selected':'').'>'.$c.'</option>';
        }   
        echo json_encode(array('html'=>$op));      
    }

    
    // fetch domains based on the domain type passed on from parameter.
    
    function domain_list(){
        $this->load->helper('settings');    
        $type = explode('|', $this->input->post('type', true));
        $sel = $this->input->post('sel', true);
        $cur_site_info = $this->session->userdata(APPID.'_current_site');
        $cur_site_id = $cur_site_info['site_id'];    
                                
        $this->db->select('ref_id, name, domain')
                   ->from('tbl_setting_referrer')   
                   ->where_in('ref_container_id', $type) 
                   ->where('site_id', $cur_site_id)                
                   ->order_by('name', 'asc');
        
        $query = $this->db->get();                
        $op = '';
        foreach($query->result() as $row){            
            $op .= '<option value="'.$row->ref_id.'" '.($sel==$row->ref_id ? 'selected':'').'>'.$row->name.' ('.$row->domain.')'.'</option>';
        }   
        echo json_encode(array('html'=>$op)); 
    }
    
    function browser_version_list(){
        $this->load->helper('visitor_prop');
        $type = explode('|', $this->input->post('browser', true));
        $sel = $this->input->post('sel', true);
        
        $bwrs = visitorBrowserVersions($type);        
        $op = '';
        foreach($bwrs as $k=>$v){            
            $op .= '<option value="'.$k.'" '.($sel==$k ? 'selected':'').'>'.$v.'</option>';
        }   
        echo json_encode(array('html'=>$op));
    }
    
    function actions_list(){
        $this->load->helper('segmentation');
        $type = explode('|', $this->input->post('type', true));
        $sel = $this->input->post('sel', true);
        
        $bwrs = actions($type);        
        $op = '';
        foreach($bwrs as $k=>$v){            
            $op .= '<option value="'.$k.'" '.($sel==$k ? 'selected':'').'>'.$v.'</option>';
        }   
        echo json_encode(array('html'=>$op));
    }
    
    function goals_list(){
        $this->load->helper('segmentation');
        $type = $this->input->post('type', true);
        $sel = $this->input->post('sel', true);
        
        $bwrs = goals($type);        
        $op = '';
        foreach($bwrs as $k=>$v){            
            $op .= '<option value="'.$k.'" '.($sel==$k ? 'selected':'').'>'.$v.'</option>';
        }   
        echo json_encode(array('html'=>$op));
    }

    
    // segmentation rule field set    
    function seg_field_sets(){
        /*$this->dbug->show($_POST);
        die();*/
        $this->load->helper('segmentation');
        $i = $this->input->post('i', true);
        $g = $this->input->post('g', true);
        $so= $this->input->post('so', true); 
        $fld_data= $this->input->post('fld_data', true);      
        $r = display_rule_fields($i, $g, $so, $fld_data);
        echo json_encode($r);
    }
    
    // save segments    
    function save_segments(){
        //$this->dbug->show($_POST);die();
        $this->load->model('segment_model', 'segmo');
        
        $mode = isset($_POST['seg_id']) && is_numeric($_POST['seg_id']) && $_POST['seg_id']>0 ? 'edit' : 'add';
        $site_id = $this->session->userdata(APPID. '_site_id');
        if($seg_id = $this->segmo->save_segments($_POST, $site_id, $mode)){
            echo json_encode(array('seg_id'=>$seg_id, 'mode'=>$mode));
        }      
    }
    
    /**********SEGMENTATION CATEGORY TREE METHODS******/
    
    function create_tree($data, $pre_checked){
        $tree = '[';    
        foreach($data as $k=>$v){
            $checked = $pre_checked == $v->key ? ', "select" : true' : '';
            if(isset($v->children) && count($v->children))
                $tree .= '{"title":"'.$v->title.'", "key":'. $v->key.', "isFolder": true ' . $checked . ',"href": "javascript:void(0)", "children": '.$this->create_tree($v->children, $pre_checked)."},";
            else    
                $tree .= '{"title":"'.$v->title.'", "key":'. $v->key.', "isFolder": true' . $checked . ', "href": "javascript:void(0)"},';
        }
        $tree .= "]";
        
        return str_replace('},]', '}]', $tree);
    }

    // Segmentation Tree View
    function dynatree_data(){
        
        $site_id = $this->session->userdata(APPID . '_site_id');
        $pkey =isset($_REQUEST['key']) && !empty($_REQUEST['key']) ? $this->security->xss_clean($_REQUEST['key']) : -1;        
        $table ='tbl_'.$this->security->xss_clean($_REQUEST['lbt']);        
        $pre_checked = $this->security->xss_clean($_REQUEST['checked']);
        
        $r = $this->db
            ->select('id, parent_id, position, title')
            ->from($table)
            ->where(array('site_id'=>$site_id))
            ->order_by('parent_id', 'asc')
            ->order_by('position', 'asc');        
        
        if($pkey>=0) $this->db->where(array('parent_id'=>$pkey));
        $r = $this->db->get();
        $items = array();   
        if($r->num_rows()){
             foreach($r->result() as $row){
                 $items[] = (object) array('key'=>$row->id, 'parent_id'=>$row->parent_id, 'title'=>$row->title);
             }
        }   
         
        $children = array();

        foreach($items as $item)
            $children[$item->parent_id][] = $item;
        
        foreach($items as $item) if (isset($children[$item->key]))
            $item->children = $children[$item->key];
        
        
        $tree = '[{}]';
        if(count($children)){
            $data = $children[0];
            $tree = $this->create_tree($data, $pre_checked);
        } 
        die($tree);      
    }
    
    function get_next_pos($parent, $site_id, $table){        
        $r = $this->db->select_max('position', 'position')->from($table)->where(array('site_id'=>$site_id, 'parent_id'=>$parent))->get();
        if(!$r->num_rows()){
            return 1;
        }else{
            return $r->row()->position+1;
        }
    }
    
    function dynatree_create_node(){
        $p =$this->security->xss_clean($_POST);
        $site_id = $this->session->userdata(APPID . '_site_id');
        
        if(isset($_POST['title']) && isset($_POST['parent']) && isset($site_id)){            
            
            $title = $p['title'];
            $parent = $p['parent'];
            $table = 'tbl_'.$p['lbt'];
            $this->db->insert($table, array(
                                    'parent_id'=>$parent, 
                                    'title'=>$title, 
                                    'site_id'=>$site_id, 
                                    'position'=>$this->get_next_pos($parent, $site_id, $table)
                                    )
                              );
            //$this->dbug->show($p);
            echo json_encode(array('key'=>last_insert_id()));                 
        }
        
    }
    
    function dynatree_edit_node(){
        $p =$this->security->xss_clean($_POST);
        $site_id = $this->session->userdata(APPID . '_site_id');
        
        if(isset($_POST['title']) && isset($_POST['key']) && isset($site_id)){            
            
            $title  = $p['title'];
            $key    = $p['key'];
            $table  = 'tbl_'.$p['lbt'];
            $this->db->update($table, array('title'=>$title), array('id'=>$key, 'site_id'=>$site_id) );
            echo json_encode(array('done'=>true));                 
        }        
    }
    
    // find the root category id for the given site id
    function cat_root_id($site_id, $table){
        $r = $this->db->select('id')
                  ->from($table)
                  ->where(array('site_id'=>$site_id, 'parent_id'=>0))
                  ->get()->row()->id;
        return $r;          
    }
    
    // check if the given category is associated with any of the segments before deleting.
    function reset_to_main_cat($id, $site_id, $table){
        $table = $table == 'tbl_segment_category' ? 'tbl_segment_to_cat' : 'tbl_action_to_cat';
        $r = $this->db->select($table == 'tbl_segment_to_cat' ? 'seg_id' : 'axn_id')
                ->from($table)
                ->where(array('cat_id'=>$id, 'site_id'=>$site_id))
                ->get();
        if($r->num_rows()){
            if($table == 'tbl_segment_to_cat'){
                $seg_id = $r->row()->seg_id;
                $root_id = $this->cat_root_id($site_id, $table);
                $this->db->update($table, array('cat_id'=>$root_id), array('seg_id'=>$seg_id, 'site_id'=>$site_id));
            }else{
                $seg_id = $r->row()->axn_id;
                $root_id = $this->cat_root_id($site_id, $table);
                $this->db->update($table, array('cat_id'=>$root_id), array('axn_id'=>axn_id, 'site_id'=>$site_id));
            }
        }
    }
    
    // delete all child categories recursively, while checking the association of any segments to the categories. 
    // If detected they will be linked to the root category    
    function recursive_delete($id, $site_id, $table) {
        $r=$this->db->query("SELECT id FROM {$table} WHERE parent_id='$id' AND site_id = '$site_id'");
        if ($r->num_rows()>0) {
             foreach($r->result() as $row){
                  $this->recursive_delete($row->id, $site_id, $table);
             }
        }
        $this->reset_to_main_cat($id, $site_id, $table);
        $this->db->delete($table, array('id'=>$id, 'site_id'=>$site_id));
        
    }
    
    function dynatree_remove_node(){           
        
        $p =$this->security->xss_clean($_POST);
        $site_id = $this->session->userdata(APPID . '_site_id');
        
        if(isset($_POST['key']) && !empty($_POST['key']) && isset($site_id)){
            $key = $p['key'];
            $table = 'tbl_'.$p['lbt'];
            $this->recursive_delete($key, $site_id, $table);                                     
        }
        
    }

     
    

}