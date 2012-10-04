<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Apanel extends CI_Controller {

    private $adminid = 0;
	private $roleid = 0;
	private $_usr_id = 0;

	function __construct()
	{
		parent::__construct();
			
		if($this->router->fetch_method() != 'login')
			$this->checkLogin();
	}

	// backend dashboard
	function index()
	{		
		$user_id = $this->checkLogin();
		$data['greet']   = $this->getGreeting($user_id);
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}

	//◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ADMIN USER RELATED METHODS◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘

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
    	
	// backend login form
	function login()
	{
		$this->lang->load('login', 'english');
		$this->load->library('form_validation');
		
		$data['title']   = $this->lang->line('login_title');
		$data['heading'] = $this->lang->line('login_heading');
		$data['submit']  = $this->lang->line('login_submit');
		$data['uname']   = $this->lang->line('login_uname');
		$data['pword']   = $this->lang->line('login_pword');
		$data['message'] = '<div class="attention curved8" id="msg_status">'.$this->lang->line('login_message').'</div>';
		
		if(isset($_POST) && isset($_POST['username']))
		{			
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
		    $this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if($this->form_validation->run() == TRUE)
			{		
				if(!get_cookie(APPID.'_trials'))
				{
					set_cookie(array('name' => APPID.'_trials', 'value'=>'1', 'expire'=>SESSION));
				}
				$trials = intval(get_cookie(APPID.'_trials'));
				
				/*
				* INSPECT THE NUMBER OF USER TRIALS.
				*/
				if($trials <= 30)
				{
					$username =  $_POST['username'];
					$password =  md5($_POST['password']);
					
					$userid   = $this->user_model->doLogin($username, $password);
					$sql 	  = $this->user_model->find_by_id($userid);
	
					if($userid == 0)
					{
						delete_cookie(APPID.'_trials');
						set_cookie(array('name' => APPID.'_trials', 'value'=>($trials+1), 'expire'=>SESSION));
					}
					else
					{						
						$row	  = $sql->row();
						set_cookie(array('name'=>APPID.'_admin', 	'value'=>$userid, 'expire'=>SESSION));
						set_cookie(array('name'=>APPID.'_loggedin',	'value'=>date('Y-m-d H:i:s'), 'expire'=>SESSION));
						delete_cookie(APPID.'_trials');
						redirect('apanel', 'refresh');
						exit();
					}
				}
			}
			$data['message'] = '<div class="fail curved8" id="msg_status">'.$this->lang->line('login_error').'</div>';
		}
		$this->load->view(APANEL_FOLDER.'login.php', $data);
	}
	
	// logout function
	function logout()
	{
		// set last login..
		$user_id = get_cookie(APPID.'_admin');
		$login   = (get_cookie(APPID.'_loggedin')) ? get_cookie(APPID.'_loggedin') : date('Y-m-d H:i:s');
		$this->db->update('tbl_user', array('loggedin'=>$login), array('user_id' => $user_id));
		
		delete_cookie(APPID.'_admin');
		delete_cookie(APPID.'_loggedin');
		redirect('apanel/login');
	}
		
	function chk_username($str){
			
		if(!$this->user_model->username_available($str, $this->_usr_id)){
			$this->form_validation->set_message('username', 'The username '.$str.' is already taken. Please use another.');
			return false;
		}
		return true;
	}
	
	function chk_email(){
			
		if(!$this->user_model->email_available($str, $this->_usr_id)){
			$this->form_validation->set_message('email', 'The email '.$str.' is already registered. Please use another.');
			return false;
		}
		return true;
	}
	
	function user_edit($id=0)
	{
		$user_id = $this->checkLogin(); 
			
		$this->_usr_id = $rec_id  = $this->uri->segment(3) ? intval($this->uri->segment(3)) : 0; 
				
		$data['view']    = 'user_form';
		$data['title']   = ($rec_id == 0) ? 'Add User' : 'Edit User';
		$data['greet']   = $this->getGreeting($user_id);
		$data['message'] = $this->session->userdata('feed');
		
		/* ** - Prepare form fields for populating. - set values to blank when adding. - get values from db when editing. */
        $add = ($rec_id == 0) ? true : false;
		$q   = $this->user_model->find_by_id($rec_id);
		$r   = $q->row();
		
     
		$form['screen_name']= ($add) ? '' : $r->screen_name;
		$form['username']   = ($add) ? '' : $r->username;
		$form['password']  	= ($add) ? '' : $r->password;
		$form['email']   	= ($add) ? '' : $r->email;
		$form['status']     = ($add) ? 0  : $r->status;
		$form['fname']     	= ($add) ? '' : $r->fname;
		$form['lname']     	= ($add) ? '' : $r->lname;
		$form['status']     = ($add) ? 0  : $r->status;	
		$form['role_id']    = ($add) ? '' : $r->role_id;
		$form['role_name']  = ($add) ? '' : $rec_id==1 ? $this->user_model->getRoleById($r->role_id):'';
		$form['record_id']  = ($add) ? '' : $rec_id;
		
		//===========================================================				
		$roles_opts = $this->user_model->getUserRoles();
		$data['roles_opts'] = $roles_opts;		
		//===========================================================
		
				
		// validate form when submitted..
		if(isset($_POST) && isset($_POST['username']))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]|callback_chk_username|xss_clean');
		    $this->form_validation->set_rules('screen_name', 'Screen Name', 'trim|required|min_length[5]|max_length[20]|xss_clean');
			//validate password for add mode			
			$add && $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]|md5|xss_clean');
			$add && $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|c_password[password]|xss_clean');
			//validate password for edit mode
			!$add && trim($_POST['password']) != '' && $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[20]|md5|xss_clean');
			!$add && trim($_POST['password']) != '' && $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|c_password[password]|xss_clean');
			
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_chk_email|xss_clean');
			
			if($this->form_validation->run() == TRUE)
			{		
			   // add to the list..
			   $queryarray = array(
			                      'user_id'     => $rec_id,
								  'screen_name' => $this->input->post('screen_name', true),
								  'username'   	=> $this->input->post('username', true),
								  'status'      => $this->input->post('status', true),
								  'fname'       => $this->input->post('fname', true),
								  'lname'       => $this->input->post('lname', true),
								  'email'       => $this->input->post('email', true),	
								  'role_id'    	=> $rec_id == 1 ? 1 : $this->input->post('role_id', true),
								  'status'    	=> $this->input->post('status', true)
							  );
				
				
							  
			    if($rec_id == 0)
				{
					$queryarray['created']   = date('Y-m-d H:i:s');
					$queryarray['creator']   = $user_id;
					$queryarray['sortorder'] = $this->user_model->getSortOrder();
					$queryarray['password']  = $this->input->post('password', true);
				} 
				else 
				{
					$queryarray['modified']  = date('Y-m-d H:i:s');
					// chceck password change..
					$this->input->post('password', true) != '' 
						&& $this->input->post('c_password', true) == $this->input->post('password', true) 
						&& $queryarray['password'] = $this->input->post('password', true);
				}
				// DB query
				$this->db->set($queryarray);
				$task = ($this->input->post('record_id', true) == 0) ? $this->db->insert('tbl_user') : $this->db->update('tbl_user', $queryarray, array('user_id'=>$this->input->post('record_id', true)));
				
				if($task)
				{
					$id = ($this->input->post('record_id', true) == 0) ? mysql_insert_id() : $this->input->post('record_id', true);
				    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
				} else {
					$this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
				}
				(isset($_POST['post_task']) && $this->input->post('post_task', true) == 1) ? redirect('apanel/user_form', 'refresh') : redirect('apanel/user');
				exit;
			}
		}
		$data['form']    = $form;
		$data['is_add']  = $add;
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function getGreeting($id=0)
	{
		$q = $this->user_model->find_by_id($id);
		$r = $q->row();
		return ' Welcome '.$r->screen_name.' <span class="italic">Last login: '.$r->loggedin.' </span> ';
	}
	
	  
    /*
    ** -- Site Admin Users
    */
    function user()
    {
        $user_id = $this->checkLogin();
        //$this->load->model('mail_model', 'inbox');
        // Clear unsaved images..
        //$this->clearFiles();
        
        // paginating....
        $this->load->library('pagination');
        $per_page                 = 100;
        $config['base_url']       = site_url('apanel/user');
        $config['total_rows']     = $this->user_model->count_all_users();
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
        
        $data['pages']       = $this->pagination->create_links();
        
        $data['view']    = 'user';
        $data['title']   = 'User Manager ';
        $data['search'] = '';
        $data['greet']   = $this->getGreeting($user_id);
        $data['query']   = $this->user_model->getRecords($per_page, $this->uri->segment(3));
        $data['message'] = $this->session->userdata('feed');
        $data['tbl_name']= 'user';
        $data['total'] = 'Total Users: '.$this->user_model->count_all_users().' <i>[active:'.$this->user_model->count_all_users(true, 1).']</i>';
        
        $this->session->unset_userdata('feed');
        $this->load->view(APANEL_FOLDER.'index.php', $data);
    }
    
    function user_search()
    {
        $user_id = $this->checkLogin();
        $module_id = 2; // get this from tbl_module
        $this->load->model('mail_model', 'inbox');
        
        $keyword = '';
        if(isset($_POST) && isset($_POST['search']) && $_POST['search']!=''){
            $keyword = $_POST['search'];
        } else if($this->session->userdata('search_keyword') && $this->session->userdata('search_keyword')!=''){
            $keyword = $this->session->userdata('search_keyword');
        } else {
            redirect('article/index');
        }
        
        $this->session->set_userdata('search_keyword', $keyword);
        
        // paginating....
        $this->load->library('pagination');
        $per_page                 = 100;
        $config['base_url']       = site_url('apanel/user_search');
        $config['total_rows']     = $this->user_model->count_search($keyword);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();
        
        $data['view']    = 'user';
        $data['title']   = 'User Manager | Search Results for: '.$keyword;
        $data['search']  = $keyword;
        $data['greet']   = $this->getGreeting($user_id);
        $data['query']   = $this->user_model->getSearchRecords($keyword, $per_page, $this->uri->segment(3));
        $data['message'] = $this->session->userdata('feed');
        $data['tbl_name']= 'content';
        $data['total'] = '';
        $this->session->unset_userdata('feed');
        $this->load->view(APANEL_FOLDER.'index.php', $data);
    }
    
    // Admin settings page..
    public function settings()
    {
        $data = array();    
        $user_id = $this->checkLogin();
        
        // Validate and operate if valid form submission
        if(isset($_POST) && isset($_POST['screen_name']))
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('screen_name', 'Fullname', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            
            if($this->form_validation->run() == TRUE)
            {       
               // add to the list..
               $queryarray = array(
                                  'screen_name' => $_POST['screen_name'],
                                  'email'       => $_POST['email'],
                                  'fname'       => $_POST['fname'],
                                  'lname'       => $_POST['lname'],
                                  'creator'     => $user_id
                              );
                              
                // chceck password change..
                if($_POST['password'] != '' && $_POST['c_password'] == $_POST['password'])
                {
                    $queryarray['password'] = md5($_POST['password']);
                }
                
                // DB query
                $this->db->set($queryarray);
                $task = $this->db->update('tbl_user', $queryarray, array('user_id'=>$user_id));
                
                if($task)
                {
                    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
                } else {
                    $this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
                }
                
                redirect('apanel/settings', $data);
                exit;
            }
        }
        
        $q = $this->user_model->find_by_id($user_id);
        $r = $q->row();
                
        $form['screen_name']= $r->screen_name;
        $form['username']   = $r->username;
        $form['fname']      = $r->fname;
        $form['lname']      = $r->lname;
        $form['password']   = $r->password;
        $form['email']      = $r->email;
        $form['role_name']    = $this->user_model->getRoleById($r->role_id);
        
                
        $data['view']       = 'settings';
        $data['title']      = 'User Profile settings';
        $data['greet']      = $this->getGreeting($user_id);
        $data['message']    = $this->session->userdata('feed');
        $data['form']       = $form;
        
        //===========================================================               
        $roles_opts = $this->user_model->getUserRoles();
        $this->load->helper('form');
        $data['roles_opts'] = $roles_opts;      
        //===========================================================
        
        $this->session->unset_userdata('feed');
        
        $this->load->view(APANEL_FOLDER.'index.php', $data);
    }
	
	//........................ END OF ADMIN USER RELATED METHODS .......................
	
		
	//◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ ARTICLE MANAGEMENT ◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘
	
	function article()
	{
		$user_id = $this->checkLogin();
		$module_id = 2; // get this from tbl_module
		
		// Clear unsaved images..
		//$this->clearFiles();
		
		// paginating....
		$this->load->library('pagination');
		$per_page                 = 50;
        $config['base_url']       = site_url('apanel/article');
        $config['total_rows']     = $this->content_model->count_all($module_id);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
		
        $data['pages']       = $this->pagination->create_links();
		
		$data['view']    = 'article';
		$data['title']   = 'Article Manager ';
		$data['search']  = '';
		$data['greet']   = $this->getGreeting($user_id);
		$data['query']   = $this->content_model->getRecords($module_id, true, 0, $per_page, $this->uri->segment(3));
		$data['message'] = $this->session->userdata('feed');
		$data['tbl_name']= 'content';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function article_search()
	{
		$user_id = $this->checkLogin();
		$module_id = 2; // get this from tbl_module
		
		$keyword = '';
		if(isset($_POST) && isset($_POST['search']) && $_POST['search']!=''){
		    $keyword = $_POST['search'];
		} else if($this->session->userdata('search_keyword') && $this->session->userdata('search_keyword')!=''){
			$keyword = $this->session->userdata('search_keyword');
		} else {
			redirect('article/index');
		}
		
		$this->session->set_userdata('search_keyword', $keyword);
		
		// paginating....
		$this->load->library('pagination');
		$per_page                 = 50;
        $config['base_url']       = site_url('apanel/article_search');
        $config['total_rows']     = $this->content_model->count_search($module_id, $keyword);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();
		
		$data['view']    = 'article';
		$data['title']   = 'Article Manager | Search Results for: '.$keyword;
		$data['search']  = $keyword;
		$data['greet']   = $this->getGreeting($user_id);
		$data['query']   = $this->content_model->getSearchRecords($module_id, $keyword, true, 0, $per_page, $this->uri->segment(3));
		$data['message'] = $this->session->userdata('feed');
		$data['tbl_name']= 'content';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	// database deals.. add or edit.
	function article_form()
	{
		$user_id = $this->checkLogin(); 
		$module_id = 2; //get this from tbl_module
		$rec_id  = ($this->uri->segment(3)) ? intval($this->uri->segment(3)) : 0;
        
		$this->load->model('image_model', 'img');
		$this->load->helper('slug');
				
		$data['view']    = 'article_form';
		$data['title']   = ($rec_id == 0) ? 'Add Article' : 'Edit Article';
		$data['greet']   = $this->getGreeting($user_id);
		$data['message'] = $this->session->userdata('feed');
		
		/* ** - Prepare form fields for populating. - set values to blank when adding. - get values from db when editing. */
		// Also retrive the tags for the news.
        $add = ($rec_id == 0) ? true : false;
		$q   = $this->content_model->find_by_id($rec_id);
		$r   = $q->row();
		$q_t = $this->tag->getTags();
		
		$form['title']         = ($add) ? '' : $r->title;
		$form['slug']          = ($add) ? '' : $r->slug;
		$form['full_content']  = ($add) ? '' : $r->full_content;
		$form['meta_key']      = ($add) ? '' : $r->meta_key;
		$form['meta_desc']     = ($add) ? '' : $r->meta_desc;
		$form['author']        = ($add) ? $this->user_model->getScreenName($user_id) : $r->author;
		$form['status']        = ($add) ? '1' : $r->status;
		$form['featured']      = ($add) ? '1' : $r->featured;
		$form['slideshow']     = ($add) ? '1' : $r->slideshow;
		$form['active_from']   = ($add) ? date('Y-m-d') : $r->active_from;
		$form['active_to']     = ($add) ? '' : $r->active_to;
		$form['record_id']     = ($add) ? '' : $rec_id;
		$form['artist']        = ($add) ? '' : $this->artist_tag->getArtistList($rec_id);
		$form['tags']          = ($add) ? '' : $this->ctag->getTagList($rec_id);
		$form['image_properties']= '';
		$form['image_name']= '';
				
		$q_img = $this->img->find_by_id($rec_id);
		$form['has_image']   = 0;
		if($q_img->num_rows() == 1){
			$r_img = $q_img->row();
			$form['image']= $r_img->image_path;
			$form['image_name']= $r_img->image;
			$form['image_properties']= $r_img->properties;
			if($r_img->image != '' && file_exists('./uploads/'.$r_img->image)  && file_exists('./uploads/416x231/'.$r_img->image)){
				$form['has_image']   = 1;
			}
		} else {
			$form['image'] = '';
			$form['width']  = 0;
		}
		// validate form when submitted..
		if(isset($_POST) && isset($_POST['title']))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
		    $this->form_validation->set_rules('full_content', 'Content', 'trim|required');
			
			if($this->form_validation->run() == TRUE)
			{		
			   // add to the list..
			   $queryarray = array(
			                      'module_id'      => $module_id,
								  'title'          => $_POST['title'],
								  'full_content'   => $_POST['full_content'],
								  'meta_key'       => $_POST['meta_key'],
								  'meta_desc'      => $_POST['meta_desc'],
								  'author'         => $_POST['author'],
								  'status'         => $_POST['status'],
								  'featured'       => $_POST['featured'],
								  'slideshow'      => $_POST['slideshow'],
								  'active_from'    => $_POST['active_from'],
								  'active_to'      => $_POST['active_to'],
								  'posted_date'    => date('Y-m-d H:i:s'),
								  'creator'        => $user_id
							  );
							  
			    if($_POST['record_id'] == 0)
				{
					$queryarray['del_flag']  = 0;
					$queryarray['created']   = date('Y-m-d H:i:s');
					$queryarray['slug']      = createSlug($_POST['title'], $_POST['slug']);
					$queryarray['sortorder'] = $this->content_model->getSortOrder();
				} 
				else 
				{
					$queryarray['modified']  = date('Y-m-d H:i:s');
					$queryarray['slug']      = createSlug($_POST['slug']);
				}
				// DB query
				$this->db->set($queryarray);
				$task = ($_POST['record_id'] == 0) ? $this->db->insert('tbl_content') : $this->db->update('tbl_content', $queryarray, array('content_id'=>$_POST['record_id']));
				
				if($task)
				{
					$id = ($_POST['record_id'] == 0) ? mysql_insert_id() : $_POST['record_id'];
					
					/*
					Add the tags..
					* - Default format is : [ 982||983||984|| ] >> omit the last record..
					*/
					$tags = $_POST['tags_value'];
					$this->db->delete('tbl_content_tag', array('content_id' => $id)); 
					if($tags != ''){
						$sptag = explode('||', $tags);
						$count = count($sptag) - 1;
						for($i=0; $i<$count; $i++){
							$this->db->insert('tbl_content_tag', array('content_id'=>$id, 'tag_id'=>$sptag[$i]));
						}
					}
					/*
					Add the artist..
					* - Default format is : [ 982||983||984|| ] >> omit the last record..
					*/
					$tags = $_POST['artist_value'];
					$this->db->delete('tbl_artist_in_content', array('content_id' => $id)); 
					//die($tags);
					if($tags != ''){
						$sptag = explode('||', $tags);
						$count = count($sptag) - 1;
						for($i=0; $i<$count; $i++){
							$this->db->insert('tbl_artist_in_content', array('content_id'=>$id, 'artist_content_id'=>$sptag[$i]));
						}
					}
					// insert/update the image field..
					$img = $_POST['uploadedImageName1'];
					$q = $this->img->find_by_id($id);
					$img_prop = ($_POST['image_properties'] == '') ? '0:0|0:0|0:0|' : $_POST['image_properties'];
					$detail = array(
							   'content_id' => $id,
							   'image'      => $img,
							   'caption'    => ' ',
							   'hyperlink'  => '',
							   'target'     => '',
							   'default_img'=> '',
							   'properties' => $img_prop,
							   'image_path' => site_url('uploads/'.$img)
							);
					
					if($img !='' && $id == 0)
					{
						$this->db->insert('tbl_image', $detail);
					}
					else if($img !='' && $id != 0)
					{
						$row = $q->row();
						//$this->session->set_userdata('tmp_imgname', $row->image);
						$this->db->delete('tbl_image', array('content_id' => $id));
						$this->db->insert('tbl_image', $detail);
					}
				    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
				} else {
					$this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
				}
				(isset($_POST['post_task']) && $_POST['post_task'] == 1) ? redirect('apanel/article_form', 'refresh') : redirect('apanel/article');
				exit;
			}
		}
		$data['form']    = $form;
		$data['is_add']  = $add;
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	    
	//........................ END OF ARTICLE MANAGEMENT ........................
	
	
	
	
	
	//◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ NEWS MANAGEMENT ◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘
	
	function news()
	{
		$user_id = $this->checkLogin();
		$module_id = 3; // get this from tbl_module
		
		// Clear unsaved images..
		//$this->clearFiles();
		
		// paginating....
		$this->load->library('pagination');
		$per_page                 = 50;
        $config['base_url']       = site_url('apanel/news');
        $config['total_rows']     = $this->content_model->count_all($module_id);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
		
        $data['pages']       = $this->pagination->create_links();
		
		$data['view']    = 'news';
		$data['title']   = 'News Manager ';
		$data['search']  = '';
		$data['greet']   = $this->getGreeting($user_id);
		$data['query']   = $this->content_model->getRecords($module_id, true, 0, $per_page, $this->uri->segment(3));
		$data['message'] = $this->session->userdata('feed');
		$data['tbl_name']= 'content';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function news_search()
	{
		$user_id = $this->checkLogin();
		$module_id = 3; // get this from tbl_module
		
		$keyword = '';
		if(isset($_POST) && isset($_POST['search']) && $_POST['search']!=''){
		    $keyword = $_POST['search'];
		} else if($this->session->userdata('search_keyword') && $this->session->userdata('search_keyword')!=''){
			$keyword = $this->session->userdata('search_keyword');
		} else {
			redirect('news/index');
		}
		
		$this->session->set_userdata('search_keyword', $keyword);
		
		// paginating....
		$this->load->library('pagination');
		$per_page                 = 50;
        $config['base_url']       = site_url('apanel/news_search');
        $config['total_rows']     = $this->content_model->count_search($module_id, $keyword);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();
		
		$data['view']    = 'news';
		$data['title']   = 'News Manager | Search Results for: '.$keyword;
		$data['search']  = $keyword;
		$data['greet']   = $this->getGreeting($user_id);
		$data['query']   = $this->content_model->getSearchRecords($module_id, $keyword, true, 0, $per_page, $this->uri->segment(3));
		$data['message'] = $this->session->userdata('feed');
		$data['tbl_name']= 'content';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	// database deals.. add or edit.
	function news_form()
	{
		$user_id = $this->checkLogin(); 
		$module_id = 3; //get this from tbl_module
		$rec_id  = ($this->uri->segment(3)) ? intval($this->uri->segment(3)) : 0;
        
		$this->load->model('image_model', 'img');
		$this->load->helper('slug');
				
		$data['view']    = 'news_form';
		$data['title']   = ($rec_id == 0) ? 'Add News' : 'Edit News';
		$data['greet']   = $this->getGreeting($user_id);
		$data['message'] = $this->session->userdata('feed');
		
		/* ** - Prepare form fields for populating. - set values to blank when adding. - get values from db when editing. */
		// Also retrive the tags for the news.
        $add = ($rec_id == 0) ? true : false;
		$q   = $this->content_model->find_by_id($rec_id);
		$r   = $q->row();
		$q_t = $this->tag->getTags();
		
		$form['title']         = ($add) ? '' : $r->title;
		$form['slug']          = ($add) ? '' : $r->slug;
		$form['full_content']  = ($add) ? '' : $r->full_content;
		$form['meta_key']      = ($add) ? '' : $r->meta_key;
		$form['meta_desc']     = ($add) ? '' : $r->meta_desc;
		$form['author']        = ($add) ? $this->user_model->getScreenName($user_id) : $r->author;
		$form['status']        = ($add) ? '1' : $r->status;
		$form['featured']      = ($add) ? '1' : $r->featured;
		$form['slideshow']     = ($add) ? '1' : $r->slideshow;
		$form['active_from']   = ($add) ? date('Y-m-d') : $r->active_from;
		$form['active_to']     = ($add) ? '' : $r->active_to;
		$form['record_id']     = ($add) ? '' : $rec_id;
		$form['artist']        = ($add) ? '' : $this->artist_tag->getArtistList($rec_id);
		$form['tags']          = ($add) ? '' : $this->ctag->getTagList($rec_id);
		$form['image_properties']= '';
		$form['image_name']= '';
				
		$q_img = $this->img->find_by_id($rec_id);
		$form['has_image']   = 0;
		if($q_img->num_rows() == 1){
			$r_img = $q_img->row();
			$form['image']= $r_img->image_path;
			$form['image_name']= $r_img->image;
			$form['image_properties']= $r_img->properties;
			if($r_img->image != '' && file_exists('./uploads/'.$r_img->image)  && file_exists('./uploads/416x231/'.$r_img->image)){
				$form['has_image']   = 1;
			}
		} else {
			$form['image'] = '';
			$form['width']  = 0;
		}
		// validate form when submitted..
		if(isset($_POST) && isset($_POST['title']))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
		    $this->form_validation->set_rules('full_content', 'Content', 'trim|required');
			
			if($this->form_validation->run() == TRUE)
			{		
			   // add to the list..
			   $queryarray = array(
			                      'module_id'      => $module_id,
								  'title'          => $_POST['title'],
								  'full_content'   => $_POST['full_content'],
								  'meta_key'       => $_POST['meta_key'],
								  'meta_desc'      => $_POST['meta_desc'],
								  'author'         => $_POST['author'],
								  'status'         => $_POST['status'],
								  'featured'       => $_POST['featured'],
								  'slideshow'      => $_POST['slideshow'],
								  'active_from'    => $_POST['active_from'],
								  'active_to'      => $_POST['active_to'],
								  'posted_date'    => date('Y-m-d H:i:s'),
								  'creator'        => $user_id
							  );
							  
			    if($_POST['record_id'] == 0)
				{
					$queryarray['del_flag']  = 0;
					$queryarray['created']   = date('Y-m-d H:i:s');
					$queryarray['slug']      = createSlug($_POST['title'], $_POST['slug']);
					$queryarray['sortorder'] = $this->content_model->getSortOrder();
				} 
				else 
				{
					$queryarray['modified']  = date('Y-m-d H:i:s');
					$queryarray['slug']      = createSlug($_POST['slug']);
				}
				// DB query
				$this->db->set($queryarray);
				$task = ($_POST['record_id'] == 0) ? $this->db->insert('tbl_content') : $this->db->update('tbl_content', $queryarray, array('content_id'=>$_POST['record_id']));
				
				if($task)
				{
					$id = ($_POST['record_id'] == 0) ? mysql_insert_id() : $_POST['record_id'];
					
					/*
					Add the tags..
					* - Default format is : [ 982||983||984|| ] >> omit the last record..
					*/
					$tags = $_POST['tags_value'];
					$this->db->delete('tbl_content_tag', array('content_id' => $id)); 
					if($tags != ''){
						$sptag = explode('||', $tags);
						$count = count($sptag) - 1;
						for($i=0; $i<$count; $i++){
							$this->db->insert('tbl_content_tag', array('content_id'=>$id, 'tag_id'=>$sptag[$i]));
						}
					}
					/*
					Add the artist..
					* - Default format is : [ 982||983||984|| ] >> omit the last record..
					*/
					$tags = $_POST['artist_value'];
					$this->db->delete('tbl_artist_in_content', array('content_id' => $id)); 
					//die($tags);
					if($tags != ''){
						$sptag = explode('||', $tags);
						$count = count($sptag) - 1;
						for($i=0; $i<$count; $i++){
							$this->db->insert('tbl_artist_in_content', array('content_id'=>$id, 'artist_content_id'=>$sptag[$i]));
						}
					}
					// insert/update the image field..
					$img = $_POST['uploadedImageName1'];
					$q = $this->img->find_by_id($id);
					$img_prop = ($_POST['image_properties'] == '') ? '0:0|0:0|0:0|' : $_POST['image_properties'];
					$detail = array(
							   'content_id' => $id,
							   'image'      => $img,
							   'caption'    => ' ',
							   'hyperlink'  => '',
							   'target'     => '',
							   'default_img'=> '',
							   'properties' => $img_prop,
							   'image_path' => site_url('uploads/'.$img)
							);
					
					if($img !='' && $id == 0)
					{
						$this->db->insert('tbl_image', $detail);
					}
					else if($img !='' && $id != 0)
					{
						$row = $q->row();
						//$this->session->set_userdata('tmp_imgname', $row->image);
						$this->db->delete('tbl_image', array('content_id' => $id));
						$this->db->insert('tbl_image', $detail);
					}
				    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
				} else {
					$this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
				}
				(isset($_POST['post_task']) && $_POST['post_task'] == 1) ? redirect('apanel/news_form', 'refresh') : redirect('apanel/news');
				exit;
			}
		}
		$data['form']    = $form;
		$data['is_add']  = $add;
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	
	//◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ PAGE MANAGEMENT ◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘
	
	function pages()
	{
		$user_id = $this->checkLogin();
		$module_id = 25; // get this from tbl_module
		
		// Clear unsaved images..
		//$this->clearFiles();
		
		// paginating....
		$this->load->library('pagination');
		$per_page                 = 50;
        $config['base_url']       = site_url('apanel/pages');
        $config['total_rows']     = $this->content_model->count_all($module_id);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
		
        $data['pages']       = $this->pagination->create_links();
		
		$data['view']    = 'pages';
		$data['title']   = 'Page Manager ';
		$data['search']  = '';
		$data['greet']   = $this->getGreeting($user_id);
		$data['query']   = $this->content_model->getRecords($module_id, true, 0, $per_page, $this->uri->segment(3));
		$data['message'] = $this->session->userdata('feed');
		$data['tbl_name']= 'content';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function pages_search()
	{
		$user_id = $this->checkLogin();
		$module_id = 25; // get this from tbl_module
		
		$keyword = '';
		if(isset($_POST) && isset($_POST['search']) && $_POST['search']!=''){
		    $keyword = $_POST['search'];
		} else if($this->session->userdata('search_keyword') && $this->session->userdata('search_keyword')!=''){
			$keyword = $this->session->userdata('search_keyword');
		} else {
			redirect('apanel/pages');
		}
		
		$this->session->set_userdata('search_keyword', $keyword);
		
		// paginating....
		$this->load->library('pagination');
		$per_page                 = 50;
        $config['base_url']       = site_url('apanel/pages_search');
        $config['total_rows']     = $this->content_model->count_search($module_id, $keyword);
        $config['per_page']       = $per_page;
        $this->pagination->initialize($config);
        $data['pages']       = $this->pagination->create_links();
		
		$data['view']    = 'pages';
		$data['title']   = 'Page Manager | Search Results for: '.$keyword;
		$data['search']  = $keyword;
		$data['greet']   = $this->getGreeting($user_id);
		$data['query']   = $this->content_model->getSearchRecords($module_id, $keyword, true, 0, $per_page, $this->uri->segment(3));
		$data['message'] = $this->session->userdata('feed');
		$data['tbl_name']= 'content';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function pages_form()
	{
		$user_id = $this->checkLogin(); 
		$module_id = 25; //get this from tbl_module
		$rec_id  = ($this->uri->segment(3)) ? intval($this->uri->segment(3)) : 0;
		$this->load->helper('slug');
				
		$data['view']    = 'pages_form';
		$data['title']   = ($rec_id == 0) ? 'Add Page' : 'Edit Page';
		$data['greet']   = $this->getGreeting($user_id);
		$data['message'] = $this->session->userdata('feed');
		
		/* ** - Prepare form fields for populating. - set values to blank when adding. - get values from db when editing. */
		// Also retrive the tags for the news.
        $add = ($rec_id == 0) ? true : false;
		$q   = $this->content_model->find_by_id($rec_id);
		$r   = $q->row();
		
		$form['title']         = ($add) ? '' : $r->title;
		$form['slug']          = ($add) ? '' : $r->slug;
		$form['full_content']  = ($add) ? '' : $r->full_content;
		$form['meta_key']      = ($add) ? '' : $r->meta_key;
		$form['meta_desc']     = ($add) ? '' : $r->meta_desc;
		$form['author']        = ($add) ? $this->user_model->getScreenName($user_id) : $r->author;
		$form['status']        = ($add) ? '1' : $r->status;
		$form['active_from']   = ($add) ? date('Y-m-d') : $r->active_from;
		$form['active_to']     = ($add) ? '' : $r->active_to;
		$form['record_id']     = ($add) ? '' : $rec_id;
				
		// validate form when submitted..
		if(isset($_POST) && isset($_POST['title']))
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
		    $this->form_validation->set_rules('full_content', 'Content', 'trim|required');
			
			if($this->form_validation->run() == TRUE)
			{		
			   // add to the list..
			   $queryarray = array(
			                      'module_id'      => $module_id,
								  'title'          => $_POST['title'],
								  'full_content'   => $_POST['full_content'],
								  'meta_key'       => $_POST['meta_key'],
								  'meta_desc'      => $_POST['meta_desc'],
								  'author'         => $_POST['author'],
								  'status'         => $_POST['status'],
								  'featured'       => 0,
								  'slideshow'      => 0,
								  'active_from'    => $_POST['active_from'],
								  'active_to'      => $_POST['active_to'],
								  'posted_date'    => date('Y-m-d H:i:s'),
								  'creator'        => $user_id
							  );
							  
			    if($_POST['record_id'] == 0)
				{
					$queryarray['del_flag']  = 0;
					$queryarray['created']   = date('Y-m-d H:i:s');
					$queryarray['slug']      = createSlug($_POST['title'], $_POST['slug']);
					$queryarray['sortorder'] = $this->content_model->getSortOrder();
				} 
				else 
				{
					$queryarray['modified']  = date('Y-m-d H:i:s');
					$queryarray['slug']      = createSlug($_POST['slug']);
				}
				// DB query
				$this->db->set($queryarray);
				$task = ($_POST['record_id'] == 0) ? $this->db->insert('tbl_content') : $this->db->update('tbl_content', $queryarray, array('content_id'=>$_POST['record_id']));
				
				if($task)
				{
					$id = ($_POST['record_id'] == 0) ? mysql_insert_id() : $_POST['record_id'];
				    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
				} else {
					$this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
				}
				(isset($_POST['post_task']) && $_POST['post_task'] == 1) ? redirect('apanel/pages_form', 'refresh') : redirect('apanel/pages');
				exit;
			}
		}
		$data['form']    = $form;
		$data['is_add']  = $add;
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function pages_link()
	{
		$user_id = $this->checkLogin();
		$module_id = 25;
		$ret = '';
		if(isset($_POST) && $_POST['title']!='' && $_POST['link'] != '' && $_POST['target'] != '')
		{			
		    $id = $_POST['record_id'];
			$data_array = array(
			                  'module_id'      => $module_id,
							  'title'          => $_POST['title'],
							  'status'         => 1,
							  'homepage'       => 1,
							  'featured'       => 0,
							  'slideshow'      => 0,
							  'author'         => 'admin',
							  'posted_date'    => date('Y-m-d H:i:s'),
							  'creator'        => $user_id
						  );
			if($id == 0)
			{
				$this->db->insert('tbl_content', $data_array);
			} 
			else 
			{
				$this->db->update('tbl_content', $data_array, array('content_id' => $id)); 
			}
			
			$content_id = ($_POST['record_id'] == 0) ? mysql_insert_id() : $_POST['record_id'];
			$menu_array = array(
			                  'menu_id'        => $content_id,
							  'link'           => $_POST['link'],
							  'title'          => '',
							  'target'         => $_POST['target']
						  );
			
			if($id == 0)
			{
				$this->db->insert('tbl_menu', $menu_array);
			} 
			else 
			{
				$this->db->update('tbl_menu', $menu_array, array('menu_id' => $id)); 
			}
			$ret = 'Your changes has been saved!';
		}
		echo $ret;
	}
	
	
	//◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ PACKAGE MANAGEMENT ◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘
	
	
	function package()
	{
		    
		$this->load->model('package_model');
		$this->load->library('pagination');
        $this->load->config('site_config');
		$per_page               = 50;
        $config['base_url']     = site_url('apanel/package');
        $config['total_rows']   = $this->package_model->count_all();
        $config['per_page']     = $per_page;
        $this->pagination->initialize($config);
		
        $data['pages']       	= $this->pagination->create_links();
		
		$data['view']    		= 'package';
		$data['title']   		= 'Package Manager ';
		$data['search']  		= '';
		$data['greet']   		= $this->getGreeting($user_id);
		$data['query']   		= $this->package_model->getRecords($per_page, $this->uri->segment(3));
		$data['message'] 		= $this->session->userdata('feed');
		$data['tbl_name']		= 'tbl_package';
        $data['pkg_currency']   = $this->config->item('def_curr_sym');
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	
	function package_search()
	{		
		$this->load->model('package_model');
		$this->load->library('pagination');
        $keyword                = mysql_real_escape_string($this->input->post('search'));
		$per_page               = 50;
        $config['base_url']     = site_url('apanel/package_search');
        $config['total_rows']   = $this->content_model->count_search('tbl_package', 'pkg_name', $keyword);
        $config['per_page']     = $per_page;
        $this->pagination->initialize($config);
        $data['pages']       	= $this->pagination->create_links();
		
		$data['view']    		= 'package';
		$data['title']   		= 'Package Manager | Search Results for: '.$keyword;
		$data['search']  		= $keyword;
		$data['greet']   		= $this->getGreeting($this->adminid);
		$data['query']   		= $this->package_model->getSearchRecords($keyword, $per_page, $this->uri->segment(3));
		$data['message'] 		= $this->session->userdata('feed');
		$data['tbl_name']		= 'package';
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
	    
	function package_form()
	{
		$this->load->model('package_model');    
		$module_id = 1;
        $image_dir = 'package';    		
		$rec_id  = ($this->uri->segment(3)) ? intval($this->uri->segment(3)) : 0;
        /********************************************************************************/
		$this->load->config('site_config');
		$this->load->model('image_model', 'img');
		$this->load->helper('slug');
				
		$data['view']    = 'package_form';
		$data['title']   = ($rec_id == 0) ? 'Add Package' : 'Edit Package';
		$data['greet']   = $this->getGreeting($this->adminid);
		$data['message'] = $this->session->userdata('feed');
		
		/* ** - Prepare form fields for populating. - set values to blank when adding. - get values from db when editing. */
		// Also retrive the tags for the news.
        $add = ($rec_id == 0) ? true : false;
        
        if(!$add){
            $q   = $this->package_model->find_by_id($rec_id);
            $r   = $q->row();
        }
		
		$form['pkg_name']             = ($add) ? '' : $r->pkg_name;
		$form['slug']                 = ($add) ? '' : getSlug('tbl_package', $rec_id);
		$form['intro']                = ($add) ? '' : $r->intro;
		$form['full_content']         = ($add) ? '' : $r->full_content;
        
		$form['meta_key']             = ($add) ? '' : $r->meta_key;
		$form['meta_desc']            = ($add) ? '' : $r->meta_desc;
        
        $form['pkg_price']            = ($add) ? '0' : $r->pkg_price;
        $form['pkg_trial_period']     = ($add) ? '0' : $r->pkg_trial_period;
		$form['status']               = ($add) ? '1' : $r->status;
		$form['featured']             = ($add) ? '0' : $r->featured;
		$form['free_trial']           = ($add) ? '0' : $r->free_trial;
		$form['pkg_upgradable']       = ($add) ? '0' : $r->pkg_upgradable;
		$form['pkg_downgradable']     = ($add) ? '0' : $r->pkg_downgradable;		
		$form['record_id']            = ($add) ? '' : $rec_id;
		
        /* Load module properties especially for image upload and cropping purpose. */
        $this->load->library('modules');
        $data['pkg_mod_props']      = $this->modules->mod_props($module_id);
		$form['image_properties']   = '';
		$form['image_name']         = '';
		$form['pkg_currency']       = $this->config->item('def_curr_sym');
		$form['has_image']          = 0;
        $form['image']              = '';
        $form['width']              = 0;
        $form['package_services']   = $this->package_model->getPackageServices($rec_id);
        
        /* get the images for edit mode only */ 
        if(!$add){
            $q_img = $this->img->find_by_id($rec_id, $module_id);
    		if($q_img->num_rows() == 1){
    			$r_img = $q_img->row();
    			$form['image']= $r_img->image_path;
    			$form['image_name']= $r_img->image;
    			$form['image_properties']= $r_img->properties;
    			if($r_img->image != '' && file_exists('./uploads/'.$image_dir.'/'.$r_img->image)  && file_exists('./uploads/'.$image_dir.'/thumb/'.$r_img->image)){
    				$form['has_image']   = 1;
    			}
    		}	
		}		
		
		/* validate form when submitted..*/
		if(isset($_POST) && isset($_POST['pkg_name']))
		{
			$this->load->library('form_validation');			
			$this->form_validation->set_rules('pkg_name', 'Package Name', 'trim|required');
		    $this->form_validation->set_rules('pkg_price', 'Package Price', 'trim|numeric|required');
            $this->form_validation->set_rules('pkg_trial_period', 'Trial Period', 'trim|numeric');
			$this->form_validation->set_rules('slug', 'Slug', 'trim|required|uniqslug[tbl_package'.','. $rec_id.']');
                       
            
			if($this->form_validation->run() == TRUE){		
			   // add to the list..
			   $queryarray = array(			                      
								  'pkg_name'        => $_POST['pkg_name'],
								  'intro'           => $_POST['intro'],
								  'full_content'    => $_POST['full_content'],
								  'meta_key'        => $_POST['meta_key'],
								  'meta_desc'       => $_POST['meta_desc'],								  
								  'status'          => $_POST['status'],
								  'pkg_price'       => $_POST['pkg_price'],
								  'pkg_trial_period'=> $_POST['pkg_trial_period'],
								  'featured'        => $_POST['featured'],
								  'free_trial'      => $_POST['free_trial'],
								  'pkg_upgradable'  => $_POST['pkg_upgradable'],
								  'pkg_downgradable'=> $_POST['pkg_downgradable'],
								  'created'         => date('Y-m-d H:i:s'),
								  'creator'         => $this->adminid
							  );
							  
			    if($_POST['record_id'] == 0)
				{
					$queryarray['del_flag']  = 0;
					$queryarray['created']   = date('Y-m-d H:i:s');					
					$queryarray['sortorder'] = $this->package_model->getSortOrder();
				} 
				else 
				{
					$queryarray['modified']  = date('Y-m-d H:i:s');					
				}
                
                
				// DB query
				$this->db->set($queryarray);
				$task = ($_POST['record_id'] == 0) ? $this->db->insert('tbl_package') : $this->db->update('tbl_package', $queryarray, array('pkg_id'=>$_POST['record_id']));
                                             
				if($task)
				{
					$id = ($_POST['record_id'] == 0) ? last_insert_id() : $_POST['record_id'];
					
                    /* Add slug of the record */
                    saveSlug('tbl_package', $this->input->post('slug'), 'pkg_id', $id, $module_id, 'package');
                
                    
					/* Add services to the package.. */
					$pkgsrv = $_POST['pkg_services'];
					$this->db->delete('tbl_package_has_services', array('pkg_id' => $id)); 
					
					$count = count($sptag) - 1;
					foreach($pkgsrv as $srvc_id=>$srvc){
					    $pkg_service_value = $_POST['pkg_service_value'][$srvc_id];
						$this->db->insert('tbl_package_has_services', array('pkg_id'=>$id, 'srvc_id'=>$srvc_id, 'value'=>$pkg_service_value));
					}					
					
					// insert/update the image field..
					$img = $_POST['uploadedImageName1'];
					$q = $this->img->find_by_id($id);
					$img_prop = ($_POST['image_properties'] == '') ? '0:0|0:0|0:0|' : $_POST['image_properties'];
					$detail = array(
							   'content_id' => $id,
							   'module_id'  => $module_id,
							   'image'      => $img,
							   'caption'    => ' ',
							   'hyperlink'  => '',
							   'target'     => '',
							   'default_img'=> '',
							   'properties' => $img_prop,
							   'image_path' => 'uploads/'.$image_dir.'/'
							);
					
					if($img !='' && $id == 0){
						$this->db->insert('tbl_image', $detail);
					}else if($img !='' && $id != 0){
						$row = $q->row();
						$this->db->delete('tbl_image', array('content_id' => $id, 'module_id' => $module_id));
						$this->db->insert('tbl_image', $detail);
					}
				    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
				} else {
					$this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
				}
				(isset($_POST['post_task']) && $_POST['post_task'] == 1) ? redirect('apanel/package_form'.($rec_id>0?('/'.$rec_id):''), 'refresh') : redirect('apanel/package');
				exit;
			}
		}
		$data['form']    = $form;
		$data['is_add']  = $add;
		$this->session->unset_userdata('feed');
		$this->load->view(APANEL_FOLDER.'index.php', $data);
	}
		
	
    //◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘ ACCOUNT MANAGEMENT ◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘
    function account()
    {
        $user_id = $this->checkLogin();
        
        $this->load->library('pagination');
        $this->load->model('account_model');
        $per_page               = 100;
        $config['base_url']     = site_url('apanel/account'); 
        $config['total_rows']   = $this->account_model->count_all();
        $config['per_page']     = $per_page;
        $this->pagination->initialize($config);
        
        $data['pages']          = $this->pagination->create_links();
        $data['view']           = 'account';
        $data['title']          = 'Accounts Manager ';
        $data['search']         = '';
        $data['greet']          = $this->getGreeting($user_id);
        $data['query']          = $this->account_model->getRecords($per_page, $this->uri->segment(3));
        $data['message']        = $this->session->userdata('feed');
        $data['tbl_name']       = 'account';
        $data['total']          = 'Total Accounts: '.$config['total_rows'].' <i>[active:'.$this->account_model->count_all(true, 1).']</i>';
        
        $data['name_search']    = 'Name';
        $data['email_search']   = 'Email';
        $data['comp_search']    = 'Company';
        $data['domain_search']  = 'Domain: eg. google.com';
        
        $this->session->unset_userdata('feed');
        $this->load->view(APANEL_FOLDER.'index.php', $data);
    }
    
    function account_search()
    {       
        $this->load->model('account_model');
        $this->load->library('pagination');
        
        $data['name_search']    = $kw['name']  = mysql_real_escape_string($this->input->post('name_search'));
        $data['email_search']   = $kw['email'] = mysql_real_escape_string($this->input->post('email_search'));
        $data['comp_search']    = $kw['company']  = mysql_real_escape_string($this->input->post('comp_search'));
        $data['domain_search']  = $kw['domain']= mysql_real_escape_string($this->input->post('domain_search'));
       
        // Neutralizing default texts in search fields.
        if($kw['name']          == 'Name') unset($kw['name']);
        if($kw['email']         == 'Email') unset($kw['email']);
        if($kw['company']       == 'Company') unset($kw['company']);
        if($kw['domain']        == 'Domain: eg. google.com') unset($kw['domain']);          
        
        $per_page               = 50;
        $config['base_url']     = site_url('apanel/account_search');
        $config['total_rows']   = $this->account_model->count_search($kw);
        $config['per_page']     = $per_page;
        $this->pagination->initialize($config);
        
        $data['pages']          = $this->pagination->create_links();
        $data['view']           = 'account';
        $data['title']          = 'Account Manager | Search Results for: {'.join('} {', $kw).'}';
        $data['greet']          = $this->getGreeting($this->adminid);
        $data['query']          = $this->account_model->getSearchRecords($kw, $per_page, $this->uri->segment(3));
        $data['message']        = $this->session->userdata('feed');
        $data['total']          = 'Total Accounts: '.$config['total_rows'];
        $data['tbl_name']       = 'package';
        $this->session->unset_userdata('feed');
        $this->load->view(APANEL_FOLDER.'index.php', $data);
    }
       
    function account_form($id=0)
    {
        $user_id = $this->checkLogin(); 
        $this->load->helper('address');  
        $this->load->model('account_model');
            
        $rec_id  = $this->uri->segment(3) ? intval($this->uri->segment(3)) : 0; 
                
        $data['view']       = 'account_form';
        $data['title']      = ($rec_id == 0) ? 'Add User' : 'Edit User';
        $data['greet']      = $this->getGreeting($user_id);
        $data['message']    = $this->session->userdata('feed');
        
        /* ** - Prepare form fields for populating. - set values to blank when adding. - get values from db when editing. */
        $add = ($rec_id == 0) ? true : false;
        $q   = $this->account_model->find_by_id($rec_id);
        $r   = $q->row();
        
        // account info 
        $form['country']    = countrySB(array('name'=>'country_id', 'class'=>'input medium form_tip', 'initial'=>'Select a Country', 'nameAsValue'=>false, 'selected'=>$add?'':$r->country_id));
        $form['timezone']   = timezoneSB(array('name'=>'timezone_id', 'class'=>'input medium form_tip', 'initial'=>'Select a Timezone', 'selected'=>$add?'':$r->tz_id));
        $form['username']   = ($add) ? '' : $r->username;
        $form['password']   = ($add) ? '' : $r->password;
        $form['email']      = ($add) ? '' : $r->email;
        $form['phone']      = ($add) ? '' : $r->phone;
        $form['company']    = ($add) ? '' : $r->company;
        $form['status']     = ($add) ? 0  : $r->status;
        $form['fname']      = ($add) ? '' : $r->fname;
        $form['lname']      = ($add) ? '' : $r->lname;
        $form['created']    = ($add) ? 0  : mdate(DATE_STR, strtotime($r->created));
        $form['confirmed']  = ($add) ? 0  : $r->confirmed;
        $form['confirmed_on']=($add) ? 0 : $r->confirmed_on;
        $form['record_id']  = ($add) ? 0 : $rec_id;
        
        $sq   = ($add) ? array() : $this->account_model->find_sites($rec_id);
        $site = array();
        $data['tbl_name']   = 'tbl_site';
        foreach($sq as $sr){        
            // package n site info
            $_sdata['site_id']        = ($add) ? '' : $sr->site_id;
            $_sdata['uniq_id']        = ($add) ? '' : $sr->uniq_id;
            $_sdata['pkg_id']         = ($add) ? '' : $sr->pkg_id;
            $_sdata['pkg_name']       = ($add) ? '' : $sr->pkg_name;
            $_sdata['trial_period']   = ($add) ? '' : $sr->pkg_trial_period;
            $_sdata['protocol']       = ($add) ? '' : $sr->protocol;
            $_sdata['domain']         = ($add) ? '' : $sr->domain;
            $_sdata['sub_domains']    = ($add) ? 0  : $sr->sub_domains;
            $_sdata['site_name']      = ($add) ? '' : $sr->site_name;
            $_sdata['site_type_id']   = ($add) ? '' : $sr->site_type_id;
            $_sdata['site_type']      = ($add) ? '' : $sr->site_type;
            $_sdata['status']         = ($add) ? 0  : $sr->status;
            $_sdata['created']        = ($add) ? 0  : mdate(DATE_STR, strtotime($sr->created)); 
            $_sdata['expired']        = ($add) ? 0  : $sr->expired; 
            $_sdata['xpry_date']      = ($add) ? 0  : $sr->expiry_date; 
            $_sdata['tracker']        = ($add) ? 0  : $sr->tracker;
            $_sdata['sortorder']      = ($add) ? 0  : $sr->sortorder;
            $_sdata['trial_txt']      = calc_trial_days($_sdata['trial_period'], $_sdata['xpry_date'], $sr->created, true, '<br />');
            $_sdata['prchsd_txt']     = $sr->purchased == '1' ? '<br /><span class="lgreen em">Purchased On: '.mdate(DATE_STR, strtotime($sr->purchased_on)).'</span>':'';
            $site[] = $_sdata;
        }
             
           
        // validate form when submitted..
        if(isset($_POST) && isset($_POST['company']))
        {
            $this->load->library('form_validation');
            
            //$this->form_validation->set_rules('fname', 'First Name', 'trim|required|min_length[2]|max_length[30]|xss_clean');
            //$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|min_length[2]|max_length[30]|xss_clean');
            //$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_chk_ac_user_email|xss_clean');
            //$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[4]|max_length[30]|xss_clean');
            $this->form_validation->set_rules('country_id', 'Country', 'required|xss_clean');
            $this->form_validation->set_rules('timezone_id', 'Timezone', 'required|xss_clean');
            
            
            
            if($this->form_validation->run() == TRUE)
            {      
               // add to the list..
               $queryarray = array(
                                  //'fname'       => $this->input->post('fname', true),
                                  //'lname'       => $this->input->post('lname', true),
                                  //'email'       => $this->input->post('email', true),
                                  //'phone'       => $this->input->post('phone', true),
                                  'company'     => $this->input->post('company', true),
                                  'country_id'  => $this->input->post('country_id', true),
                                  'tz_id'       => $this->input->post('timezone_id', true),
                                  'status'      => $this->input->post('status', true)
                              );              
                
                              
                /*if($rec_id == 0)
                {
                    $queryarray['created']   = date('Y-m-d H:i:s');
                    $queryarray['creator']   = $user_id;
                    $queryarray['sortorder'] = $this->user_model->getSortOrder();
                    $queryarray['password']  = $this->input->post('password', true);
                } 
                else 
                {*/
                    $queryarray['modified']  = date('Y-m-d H:i:s');
                    // chceck password change..
                /*
                }*/
                
                // DB query
                $this->db->set($queryarray);
                $task = ($this->input->post('record_id', true) == 0) ? $this->db->insert('tbl_account') : $this->db->update('tbl_account', $queryarray, array('account_id'=>$this->input->post('record_id', true)));
                
                if($task)
                {
                    $id = ($this->input->post('record_id', true) == 0) ? mysql_insert_id() : $this->input->post('record_id', true);
                    $this->session->set_userdata('feed', ' <div class="success curved8">Your changes has been saved.</div> ');
                } else {
                    $this->session->set_userdata('feed', ' <div class="fail curved8">Unable to save your changes!</div> ');
                }
                (isset($_POST['post_task']) && $this->input->post('post_task', true) == 1) ? redirect('apanel/account_form', 'refresh') : redirect('apanel/account');
                exit;
            }
        }
        $data['form']    = $form;
        $data['site']    = $site;
        $data['is_add']  = $add;
        $this->session->unset_userdata('feed');
        $this->load->view(APANEL_FOLDER.'index.php', $data);
    }
    
    		
	/*
	* Clear Files.
	*/
	function clearFiles($index='tmp_imgname')
	{
		$filename = $this->session->userdata($index);
		@unlink( './uploads/'.$filename );
	}
	
	
}