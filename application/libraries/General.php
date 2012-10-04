<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_General {

	var $CI = '';
	var $_colpopup = '';
	var $sp='';
	var $controller='';
	var $action='';
	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();
		$router =& load_class('Router');
		//$spon =& load_class('Sponsor');
        $this->controller = strtolower($router->fetch_class());
        $this->action     = strtolower($router->fetch_method()); 
		
		// Are any config settings being passed manually?  If so, set them
		$config = array();
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				$config[$key] = $val;
			}
		}
		
	}
	
	function popcrbt(){
		$this->CI->load->model('CRBT_model','crbt');
		$q=$this->CI->crbt->get_crbt_list(20,6,0,'pop.position desc','and crbt_f.featured=1');
		
		$q_latest=$this->CI->crbt->get_crbt_list(20,6,0,'c.posted_date');
		
		$html='<div class="crbt">
    <div class="title_wrapper">
        <div class="crbt_title">CRBT</div>
        <div class="crbt_sponser"><img class="sponsor_title" title="Aarati Audio Video" src="images/sponser/arati.jpg" /></div>
        <div class="clear"></div>
    </div>
    
    <div class="tab_wrapper" id="ul_crbt_list">
        <div class="tab_btn cur_tab" style="width:75px">Popular</div>
        <div class="tab_btn" style="width:75px">Latest</div>
        <div class="clear"></div>
    </div>	
    
    <div class="content_wrapper">
    
    <div id="contents" class="ul_crbt_list tab_container_div">
        <ul>
          <li>';
    	foreach($q->result() as $r){
			 $anchTrk = anchor(base_url().'index.php/artist/profile/'.$r->artist_cid.'/'.$r->artist_slug.'/crbt/'.base64_encode($r->album_content_id.'/'.$r->content_id), truncateStr($r->title,17,true), 'title="'.$r->title.'"');
			 $anchAlb= anchor(base_url().'index.php/artist/profile/'.$r->artist_cid, $r->artist_display);
			 
			 $anchDownl = anchor(base_url().'index.php/artist/profile/'.$r->artist_cid.'/'.$r->artist_slug.'/crbt/'.base64_encode($r->album_content_id.'/'.$r->content_id), '<img src="images/download_icon.png" width="25" height="28" border="0" />', 'title="'.$r->title.'"');
			 
          $html.='  <div class="crbt_songs_container">
            <div class="song_title_container">
            <div class="song_title">'.$anchTrk.'</div>
            <div class="song_subtitle">'.$anchAlb.'</div>
            </div>
            <div class="crbt_download_icon">'.$anchDownl.'</div>
            <div class="clear"></div>
            </div>';
          }
          $html.='</li>
        </ul>
        
        <ul>
          <li>';
		  
       	foreach($q_latest->result() as $r_l){
			 $anchTrk_l = anchor(base_url().'index.php/artist/profile/'.$r_l->artist_cid.'/'.$r_l->artist_slug.'/crbt/'.base64_encode($r_l->album_content_id.'/'.$r_l->content_id), $r_l->title, 'title="'.$r_l->title.'"');
			 $anchAlb_l= anchor(base_url().'index.php/artist/profile/'.$r_l->artist_cid, $r_l->artist_display);
			 $anchDownl = anchor(base_url().'index.php/artist/profile/'.$r_l->artist_cid.'/'.$r_l->artist_slug.'/crbt/'.base64_encode($r_l->album_content_id.'/'.$r_l->content_id), '<img src="images/download_icon.png" width="25" height="28" border="0" />', 'title="'.$r_l->title.'"');
			 
           $html.=' <div class="crbt_songs_container">
            <div class="song_title_container">
            <div class="song_title">'.$anchTrk_l.'</div>
            <div class="song_subtitle">'.$anchAlb_l.'</div>
            </div>
            <div class="crbt_download_icon">'.$anchDownl.'</div>
            <div class="clear"></div>
            </div>';
          }
           $html.='
          </li>
        </ul>
    </div>
    
      
      <br />
      <div class="clear"></div>
            <div class="see_all"><a href="'.base_url().'" >See all CRBT</a></div>
    </div>

    </div>';
		
		return $html;
	}
	// --------------------------------------------------------------------


}
// END Column Class

/* End of file Columns.php */
/* Location: ./system/libraries/Columns.php */