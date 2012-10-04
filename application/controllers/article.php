<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

    private $_module_id = 2;

	function __construct()
	{
		parent::__construct();
		$this->load->model('image_model', 'img');
		$this->load->model('content_tags_model', 'tag');
		$this->output->cache(10);
	}

    /*
	*  listing section..
	*/
	function index()
	{
		$data['title'] =  'Articles || Cellroti - Artists, News, Views, Reviews and everything about Nepali Music';
		$uri_popular = $this->uri->segment(3);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$this->load->model('videos_model');
		$data['srollallvideos']=$this->videos_model->showscrollvid();
		
		
		//get related articles
		$this->load->model('content_model');
		
		$data['q_pages']  = $this->content_model->getPages();
		$relatedc=$this->content_model->getrelatedarticle('',"News",3,false);
		$data['r_related_news_article']=$relatedc;
	
		//related interview
		$data['r_related_interview']=$this->content_model->getrelatedinterview('',12,false);
		
		$this->load->library('pagination');
		$per_page = 10;
		
		$popular = 0;
		$list_tag = 'featured';
				
		$show_archive = $show_popular = $show_this_week = false;
		if($uri_popular && $uri_popular=='popular'){
			$show_popular = true;
		    $popular = 1;
			$list_tag = 'popular';
		} else if($uri_popular && $uri_popular == 'featured'){
			$show_popular = false;
		    $popular = 0;
			$list_tag = 'featured';
		}  else if($uri_popular && $uri_popular == 'this-week'){
			// get the archived contents..
			$s = "SELECT * FROM tbl_content WHERE WEEK(NOW(), 7) = WEEK(tbl_content.posted_date, 7) AND YEAR(NOW()) = YEAR(tbl_content.posted_date)";
			$s.= " AND tbl_content.posted_date <=NOW() AND status=1 AND del_flag=0 AND module_id=".$this->_module_id." ";
			
			$q = $this->db->query($s);
			$n = $q->num_rows();
			$list_tag = 'this-week';
			$show_this_week = true;
		}  else if($uri_popular){
			// get the archived contents..
			$subs = explode('-', $uri_popular);
			$cnt  = count($subs);
			if($cnt == 3){
				$todo = $subs[0];
				if($todo == 'archive'){
					$data['ar_year']  = $year  = trim($subs[1]);
					$data['ar_month'] = $month = trim($subs[2]);
					$s = "SELECT * FROM tbl_content WHERE status=1 AND del_flag=0 AND module_id=".$this->_module_id." ";
					$s.= "AND posted_date LIKE '".$year."-".$month."-%' ";
					$q = $this->db->query($s);
					$n = $q->num_rows();
					$list_tag = 'archive-'.$year.'-'.$month;
					$show_archive = true;
				}
			}
		}
		
		// Pagination
        $config['base_url']            = base_url().'index.php/article/index/'.$list_tag.'/';
		$config['uri_segment']         = 4;
        $config['total_rows']          = ($show_archive && isset($n)) ? $n : $this->content_model->count_all($this->_module_id, true, 0, true, 1);
        $config['per_page']            = $per_page;
		$config['full_tag_open']       = ' <div class="paginate" style="float:right;">';
		$config['full_tag_close']      = '</div>';
		$config['first_tag_open']      = '<span class="hidden">';
		$config['first_tag_close']     = '</span>';
		$config['last_tag_open']       = '<span class="hidden">';
		$config['last_tag_close']      = '</span>';
		$config['first_url']           = '';
		$config['cur_tag_open']        = '<span class="hidden">';
		$config['cur_tag_close']       = '</span>';
		$config['next_tag_open']       = '';
		$config['next_tag_close']      = '';
		$config['prev_tag_open']       = '';
		$config['prev_tag_close']      = '';
		$config['num_tag_open']        = '<span class="hidden">';
		$config['num_tag_close']       = '</span>';
		$config['first_link']          = '';
		$config['prev_link'] = '<img src="'.base_url().'images/page_prev.gif" alt="" border="0" style="float:left" class="btns_tip" title="Previous Page" />';
		$config['next_link'] = '<img src="'.base_url().'images/page_next.gif" alt="" border="0" style="float:left" class="btns_tip" title="Next Page" />';
		$config['last_link'] = '';
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();

		if($show_popular){
			// showing popular ref: hit count.
			$q = $this->content_model->getPopularNews($this->_module_id, $per_page, $offset);
		} else if($show_archive){
			$s.= "ORDER BY posted_date DESC LIMIT $per_page OFFSET ".$offset;
			$q = $this->db->query($s);
			$data['is_archived_list'] = true;
		}  else if($show_this_week){
			$s.= "ORDER BY posted_date DESC LIMIT $per_page OFFSET ".$offset;
			$data['is_thisweek_list'] = true;
			$q = $this->db->query($s);
		}else {
			$this->db->order_by('posted_date', 'DESC');
			$cond = array('module_id' => $this->_module_id, 'status' => 1, 'del_flag' => 0);
			$q = $this->db->get_where('tbl_content', $cond, $per_page, $offset);
			$data['is_featured_list'] = true;
		}

		$cn = 0;
		$d_intro = '';
		$d_list = '';
		foreach($q->result() as $r):
		    
			// get the image of the content..
			$q = $this->img->find_by_id($r->content_id);
			$i = $q->row();
			if($q->num_rows() == 0){
				$img_name = $img_path = $img_caption = '';
			} else {
				$img_name = $i->image;
				$img_path = $i->image_path;
				$img_caption = $i->caption;
			}
			
			if($cn == 0){
				
				if(!empty($img_name) || file_exists($img_path)){
					$d_intro.= '<div class="news_list_img">';
					$d_intro.= ' <div style="width:310px;height:175px;overflow:hidden;text-align:center">';
				
					if($r->ver1 == 0 && file_exists('./uploads/310x175/'.$img_name))
					{
						$d_intro.= '<img src="'.base_url().'uploads/310x175/'.$img_name.'" alt="'.$img_caption.'" >';
					} 
					else
					{
						if(strstr($img_path, 'sites/'))
							$d_intro.= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=310&h=175" alt="'.$img_caption.'">';
						else
							$d_intro.= '<img src="'.$img_path.'" width="310" height="175" >';
					}
					
					$d_intro.= '</div>';
					$d_intro.= '</div>';
					$d_intro.= '<div class="news_brief">
					<div style="height: 155px;margin-bottom: 4px;overflow: hidden;">';
				}else{
					$d_intro.= '<div class="">';
				}
				
				$d_intro.= '<div class="posted">'.($r->posted_date != '' ? date('Y-m-d h:i a', strtotime($r->posted_date)): '').'</div>';
				$d_intro.= '<div class="news_heading">'.$r->title.'</div>';
				$d_intro.= '<div class="news_brief_content">';
				
				// get the readmore content..
				$content = explode('<hr id="system_readmore" style="border:1px dashed red" />', $r->full_content);
				if(count($content) == 1){
					if(!empty($img_name) || file_exists($img_path)){
						$d_intro.= strip_tags(truncate($r->full_content, 400, '...', true));
					}else{
						$d_intro.= strip_tags(truncate($r->full_content, 700, '...', true));
					}
				} else {
					$d_intro.= $content[0];
				}
				if(!empty($img_name) || file_exists($img_path)){
					$d_intro.= '</div>';
				}
				$d_intro.= '</div><div class="see_all">'.anchor('article/detail/'.$r->content_id, 'Read More').'</div></div>';
			} 
			else 
			{
				  $d_list.= '<li><div class="songs_container_inner" style="clear:both;">';
				  $d_list.= '<div class="newslist_img">';
				  $d_list.= ' <div style="width:145px;height:85px;overflow:hidden;text-align:center;background:#fff;">';
				  
				  if($r->ver1 == 0 && $img_name != '' && file_exists('./uploads/145x85/'.$img_name))
				  {
					  $img = '<img src="'.base_url().'uploads/145x85/'.$img_name.'" alt="'.$img_caption.'" alt="'.$img_caption.'" >';
				  } 
				  else
				  {
					 	@list($w, $h) = getimagesize(str_replace('http://www.cellroti.com', $_SERVER['DOCUMENT_ROOT'], $img_path));					
						if(intval($w)>intval($h) && intval($w) == '145')
							$dim= ' width="145" ';
						elseif(intval($w)<intval($h) && intval($h) == '85')
							$dim= ' height="85" ';
						else
							$dim= ' width="145" height="85" ';
						
						if(strstr($img_path, 'sites/'))
						$img= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=145&h=85" alt="'.$img_caption.'">';
						else{
							if(!file_exists($img_path))
								$img= '<div style="color:#4775FF;font-weight:bold;line-height:7em;height:85px">No Image</div>';
							else
								$img= '<img src="'.$img_path.'" width="145" height="85" >';
						}
				  }
				  
				  $d_list.= anchor('article/detail/'.$r->content_id, $img); 
				  $d_list.= '</div></div>';
				  
				  $d_list.= '<div class="newstitle_container">';
				  $d_list.= '     <div class="posted_date">'.($r->posted_date != '' ? date('Y-m-d h:i a', strtotime($r->posted_date)): '').'</div>';
				  $d_list.= '     <div class="newslist_title">'.anchor('article/detail/'.$r->content_id, $r->title).'</div>';                	
				  $d_list.= '     <div class="newslist_content">'.truncateStr(strip_tags($r->full_content), 200, true).' </div>';
				  $d_list.= '</div>';
				  $d_list.= '<div class="clear"></div>';
				  
				$d_list.= '</div><div class="clear"></div></li>';
			}
			$cn++;
		endforeach;
		
		$data['d_intro'] = $d_intro;
		$data['d_list'] = $d_list;
		// get the latest news for right display.
		$cond = array('module_id' => 3, 'status' => 1, 'del_flag' => 0);
		$this->db->join('tbl_image', 'tbl_image.content_id = tbl_content.content_id', 'left');
		$data['q_related_news'] = $this->db->get_where('tbl_content', $cond, 4, 0);
		$data['q_interview']    = $this->content_model->getInterviews(); 
		$data['q_gallery_list'] = $this->content_model->getGallery();
		$data['q_current_poll'] = $this->content_model->get_list(7, false, 1, 1, 0); // 7 :: tbl_module :: Poll
		$data['q_pages']  = $this->content_model->getPages();
		
		$this->load->view(SITE_FOLDER.'article_list.php', $data);
	}
	
	
	/*
	DISPLAY article DETAIL...........
	*/
	function detail()
	{
		$mod_id=2;
		$this->load->model('comment_model', 'comment');
		
		$data['title'] =  'Article Detail || Cellroti - Artists, News, Views, Reviews and everything about Nepali Music';
		$id = $this->uri->segment(3);

		if(!$id){
			redirect('article/index');
		}

		//get related news
		$this->load->model('content_model');
		$relatedc=$this->content_model->getrelatedarticle($id,"Article",2);
		$relatedc.=$this->content_model->getrelatedarticle($id,"News",3);
		$data['r_related_news_article']=$relatedc;
		$data['q_pages']  = $this->content_model->getPages();
		$this->load->model('videos_model');
		$data['srollallvideos']=$this->videos_model->showscrollvid(false,$id);
		
		//related interview
		$data['r_related_interview']=$this->content_model->getrelatedinterview($id,12,true);
		
		//related artist biography
		$data_main=$this->content_model->getmainartist($id);
		if(is_array($data_main) and count($data_main)>0){
			$data['related_main_id']=$data_main['content_id'];
			$data['related_main_title']=$data_main['title'];
		}
		//related other artist biography
		$data['related_other_artist']=$this->content_model->getmainartist($id,'',false);
		
		//related Album
		$data['relatedalbums']=$this->content_model->getrelatedalbum($id, 9);
		
		// fetch query for the specific id..
		//$q = $this->db->get_where('tbl_content', array('content_id' => $id), 1, 0);
		$q = $this->db->query('SELECT c.*, m.image, m.image_path, m.caption AS img_caption FROM tbl_content c LEFT JOIN tbl_image m ON c.content_id = m.content_id WHERE c.content_id = '.$this->db->escape($id).' LIMIT 1');
		$r = $q->row();
		$data['site_keywords'] = $r->meta_key;
		$data['site_description'] = $r->meta_desc;
		
		// content count :::: hitcounter
		$q_c = $this->db->get_where('tbl_content_counter', array('content_id' => $id));
		// add the counter if not eixts.
		if($q_c->num_rows() == 0){
			$this->db->insert('tbl_content_counter', array('content_id'=>$id, 'total_count'=>1));
			$q_c = $this->db->get_where('tbl_content_counter', array('content_id' => $id));
		} else {
			$r_c = $q_c->row();
			$this->db->update('tbl_content_counter', array('total_count'=>($r_c->total_count + 1)), array('content_id' => $id));
		}
		$r_c = $q_c->row();
        $hit_count = $r_c->total_count;

		// content tags
		$tags = '';
		$tag_array_id = array();
		$q_t = $this->tag->get_tags($id);
		$t_c = 0;
		foreach($q_t->result() as $r_t):
		    $sep = ($t_c == 0) ? " " : ", ";
            $tags.= $sep.' <a href="'.base_url().'index.php/search/index/tagsrch/'.$r_t->tag_id.'">'.$r_t->tag_name." </a>";
			$tag_array_id[] = $r_t->tag_id; 
			$t_c++;
		endforeach;
		if($t_c > 0){ $tags = '<strong>Tags:</strong>  '.$tags; } else { $tags = '<i>No Tags</i>';}

		$by = '<div class="content-data-cling">By: ';
		$by.= ($r->author == '') ? 'Administrator' : ''.$r->author;
		$by.= '</div>';

		/***** IMAGES *******/
		
		$img_name = $r->image;
		$image_path = $r->image_path;
		$img_caption = $r->img_caption;
		$image = '';
		if(!empty($image_path) || file_exists($image_path)){
			if($r->ver1 == 0 && file_exists('./uploads/310x175/'.$img_name)){
				$image='<div style="float:left;margin-bottom: 10px;"><img src="'.base_url().'uploads/310x175/'.$img_name.'" alt="'.$img_caption.'" /></div>';
			} 
			else{						
				if(strstr($image_path, 'sites/'))
					$image='<div style="float:left;margin-bottom: 10px;"><img src="'.base_url().'resizer.php?s='.urlencode($image_path).'&w=310&h=175" alt="'.$img_caption.'"/></div>';
				else
					$image='<div style="float:left;margin-bottom: 10px;"><img src="'.$image_path.'" width="310" height="175" /></div>';
			}
		}
		


$ret = '
<div class="inner_content">
	  <div class="sponsor">'.$this->sponsor->sponsor_in_page('2').'</div>
	  <ul class="breadcrumb">
		<li>'.anchor('', 'home').'</li>
		<li><img src="'.base_url().'images/bredcrum_arrow.jpg"/></li>
		<li>'.anchor('article/index', 'article').'</li>
	   </ul>
	   <div class="clear"></div>
	   <div class="right">
	   		<h2>'.$r->title.'</h2>
	   </div>
	   <div class="content-data-cling">'.($r->posted_date != '' ? date('Y-m-d h:i a', strtotime($r->posted_date)) : '').'</div>
		<div class="content-data-cling">Views ['.$hit_count.']  </div>	
	'.$by.'
		<div class="clear"></div>
		<div class="article1">
		<div class="content">'.$image.$r->full_content.'</div><div class="clear"></div></div><div class="clear"></div>
                          <div class="content1">
</div>
                          <div>
<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="'.base_url().'index.php/article/detail/'.$id.'" send="true" width="481" show_faces="false" action="recommend" font=""></fb:like>
						  </div>
                          <!--<div class="tags">'.$tags.'</div>-->
                          <div ><div>';
/*
GEt related article from the tags.
Tags id received from above queries..
*/
$total = count($tag_array_id);
$related = "";
if($total > 0){
	
	// get the content_id first filtering from tag_id 
	$s_related = "SELECT DISTINCT(content_id) FROM tbl_content_tag WHERE content_id <> $id AND (content_id = 0 ";
	for($i=0; $i<$total; $i++){
		$s_related.= "OR tag_id = ".$tag_array_id[$i].' ';
	}
	$s_related.= ')';
	$q_related = $this->db->query($s_related);
	$total_related = $q_related->num_rows();
	
	$s_related = "SELECT content_id, title FROM tbl_content WHERE status =1 AND (content_id=0 ";
	foreach($q_related->result() as $r_related):
		$s_related.= "OR content_id =".$r_related->content_id.' ';
	endforeach;
	$s_related.= ") LIMIT 4 OFFSET 0";
	
	// final query for related article..
	$q = $this->db->query($s_related);
	if($q->num_rows() == 0){
		$related.= '<div class="clear"></div></div>';
	} 
	else 
	{
		$related.= '<div class="relatednews">Related Articles</div>
               <div class="nextbtn">'.anchor('article/index', '<img src="'.base_url().'images/nxt_prev_btn.gif" border="0" />').'</div>
               <div class="clear"></div></div>';
	    $related.= '<div class="images"><ul>';
		
		foreach($q->result() as $row):
			// get the image of the content..
			$q_img = $this->img->find_by_id($row->content_id);
			$i_img = $q_img->row();
			if($q_img->num_rows() == 0){
				$img_name = $img_path = $img_caption = '';
			} else {
				$img_name = $i_img->image;
				$img_path = $i_img->image_path;
				$img_caption = $i_img->caption;
			}
			$related.= '<li>'.anchor('article/detail/'.$row->content_id, '<img src="'.base_url().'cropper.php?s='.urlencode($img_path).'&w=145&h=85" width="130" height="85" border="0" />').'<p>';
			$related.= anchor('article/detail/'.$row->content_id, $row->title).'</p></li>';
		endforeach;
		$related.= '</ul></div>';
	}
}

/*
SHOW USER COMMENTS..
********************************
if no comments found for the article.. then show the latest article.
*/
$block_title = 'Comments [0]';
$comment_pagination = '';
$loop = '';
if( $this->comment->count_all($id, true, 1) == 0){
	// query for listing article..
	$q = $this->content_model->getPopularNews($this->_module_id, 5, 0); // module id, limit, offset
	$block_title = 'Popular Articles ['.$q->num_rows().']';

	foreach($q->result() as $r):
	    // get the image of the content..
		$q = $this->img->find_by_id($r->content_id);
		$i = $q->row();
		if($q->num_rows() == 0){
			$img_name = $img_path = $img_caption = '';
		} else {
			$img_name = $i->image;
			$img_path = $i->image_path;
			$img_caption = $i->caption;
		}
		
	    $loop.= '<li style="margin-bottom:0px"><div class="songs_container_inner" style="clear:both;">';
			
		if($r->ver1 == 0 && $img_name != '' && file_exists('./uploads/145x85/'.$img_name))
		  {
			  $img = '<img src="'.base_url().'uploads/145x85/'.$img_name.'" alt="'.$img_caption.'" alt="'.$img_caption.'" >';
		  }
		  else
		  {					  
				@list($w, $h) = getimagesize(str_replace('http://www.cellroti.com', $_SERVER['DOCUMENT_ROOT'], $img_path));					
				if(intval($w)>intval($h) && intval($w) == '145')
					$dim= ' width="145" ';
				elseif(intval($w)<intval($h) && intval($h) == '85')
					$dim= ' height="85" ';
				else
					$dim= ' width="145" height="85" ';
				
				if(strstr($img_path, 'sites/'))
				$img= '<img src="'.base_url().'resizer.php?s='.urlencode($img_path).'&w=145&h=85" alt="'.$img_caption.'">';
				else{
					if(!file_exists($img_path))
						$img= '<div style="color:#4775FF;font-weight:bold;line-height:7em;height:85px">No Image</div>';
					else
						$img= '<img src="'.$img_path.'" width="145" height="85" >';
				}
		  }

		
		$loop.= '<div class="newslist_img">
				<div style="width:145px;height:85px;overflow:hidden;text-align:center;background:#fff;">
				'.anchor('article/detail/'.$r->content_id, $img).'</div>';
		$loop.= '</div>';
		$loop.= '<div class="newstitle_container">';
		$loop.= '     <div class="posted_date">'.($r->posted_date != '' ? date('Y-m-d h:i a', strtotime($r->posted_date)): '').'</div>';
		$loop.= '     <div class="newslist_title">'.anchor('article/detail/'.$r->content_id, $r->title).'</div>';                	
		$loop.= '     <div class="newslist_content">'.strip_tags(truncate($r->full_content, 200, '...', false)).' </div>';
		$loop.= '</div>';
		$loop.= '<div class="clear"></div>';
		$loop.= '</div><div class="clear"></div></li>';
	endforeach;
	
} else {
	
	// query for listing.. comments.
    // Pagination
	$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
	$this->load->library('pagination');
	$per_page = 5;
	$config['base_url']            = base_url().'index.php/article/detail/'.$id.'/';
	$config['total_rows']          = $this->comment->count_all($id, true, 1);
	$config['per_page']            = $per_page;
	$config['uri_segment']         = 4;
	$config['full_tag_open']       = ' <div class="paginate" style="float:right;">';
	$config['full_tag_close']      = '</div>';
	$config['first_tag_open']      = '<span class="hidden">';
	$config['first_tag_close']     = '</span>';
	$config['last_tag_open']       = '<span class="hidden">';
	$config['last_tag_close']      = '</span>';
	$config['first_url']           = '';
	$config['cur_tag_open']        = '<span class="hidden">';
	$config['cur_tag_close']       = '</span>';
	$config['next_tag_open']       = '';
	$config['next_tag_close']      = '';
	$config['prev_tag_open']       = '';
	$config['prev_tag_close']      = '';
	$config['num_tag_open']        = '<span class="hidden">';
	$config['num_tag_close']       = '</span>';
	$config['first_link']          = '';
	$config['prev_link'] = '<img src="'.base_url().'images/page_prev.gif" alt="" border="0" style="float:left" class="btns_tip" title="Previous Page" />';
	$config['next_link'] = '<img src="'.base_url().'images/page_next.gif" alt="" border="0" style="float:left" class="btns_tip" title="Next Page" />';
	$config['last_link'] = '';
	$this->pagination->initialize($config);
	$comment_pagination = $this->pagination->create_links();
	
	$q = $this->comment->getComments($id, $per_page, $offset);
	foreach($q->result() as $r):
	    $loop.= '<li><div class="comments_left">';
		$loop.= '<div class="left_pic"><img src="'.base_url().'images/img.jpg" /></div>';
		$loop.= '<div class="names"><strong>'.$r->name.' </strong><p>'.$r->posted_date.'</p></div></div>';
		$loop.= '<div class="comments_right">'.strip_tags(truncate($r->comment, 220, '...', false)).'</div>';
		$loop.= '<div class="clear"></div></li>';
	endforeach;
	$block_title = 'Comments ['.$this->comment->count_all($id, true, 1).']';
}

$comments = '<div class="comments"><div><div class="relatednews">'.$block_title.'</div>
			 <div class="nextbtn">'.$comment_pagination.'</div><div class="clear"></div>
			 <div class="comments_inner"><ul>'.$loop.'</ul></div></div></div></div></div>';
	
	    $data['content_id'] = $id;
		$data['content'] = $ret;
		$data['comments'] = $comments;
		$data['related'] = $related;
		$data['q_related_news'] = $this->content_model->getRelatedRecords(3, $id, 4);
		$data['q_interview']    = $this->content_model->getInterviews(); 
		$data['q_gallery_list'] = $this->content_model->getGallery(3);
		$data['q_current_poll'] = $this->content_model->get_list(7, false, 1, 1, 0); // 7 :: tbl_module :: Poll
		$data['q_pages']  = $this->content_model->getPages();
		
		$this->load->view(SITE_FOLDER.'article_detail.php', $data);
	}
	
	/*
	Add article comment.
	*/
	function add_comment()
	{
		$ret = 'fail';
		$news_id = $this->uri->segment(3);
		if($news_id && isset($_POST) && $_POST['email_address']!='' && $_POST['fullname']!='' && $_POST['comments']!=''){
			
			$data = array(
			              'content_id' => $news_id,
						  'user_id'    => 0,
						  'comment'    => $_POST['comments'],
						  'name'       => $_POST['fullname'],
						  'email'      => $_POST['email_address'],
						  'homepage'   => $_POST['homepage'],
						  'host'       => $_SERVER['REMOTE_ADDR'],
						  'posted_date'=> date('Y-m-d H:i:s'),
						  'status'     => 1,
						  'subject'    => ' '
					  );
			if($this->db->insert('tbl_comment', $data)){
				$ret = 'success';
			}
		}
		echo $ret;
	}
}