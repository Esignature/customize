<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('account_model');
	}
	
    function validate_captcha($str){
       $this->load->language('register', CURRENT_LANGUAGE);    
       if(!isset($_SESSION)) session_start();
       if(!isset($_SESSION['rgst_captcha']) || $_SESSION['rgst_captcha'] !== $str){          
           $this->form_validation->set_message('validate_captcha', $this->lang->line('lang_inv_captcha'));
           return false;
       }   
       return true;        
    }
    
    function validate_email($email){
        $this->load->language('register', CURRENT_LANGUAGE);    
        if(!$this->account_model->email_available($email)){
            $this->form_validation->set_message('validate_email', $this->lang->line('lang_inv_email'));
            return false;
        }
        return true;
    }
    
    function validate_pkg($pkg_id){
        $this->load->language('register', CURRENT_LANGUAGE);
        $this->load->model('package_model');    
        if(empty($pkg_id) || !$this->package_model->find_by_id($pkg_id)->num_rows()){
            $this->form_validation->set_message('validate_pkg', $this->lang->line('lang_inv_pkg'));            
            return false;
        }
        return true;
    }
   
    
    function website_available($url){
       if(!$this->account_model->website_available($url)){
           $this->form_validation->set_message('website_available', 'The domain has already been registered.');
           return false;
       }
       return true;
    }
    
	// Register user..
	function register($pkg_id)
	{          
	    
        $this->load->helper('address');
        $this->load->library('form_validation');    
        $this->load->library('email');       
        $this->load->language('register', CURRENT_LANGUAGE);
        
	    $data = array();
        $data['cntry']      = countrySB(array('name'=>'country_id', 'nameAsValue'=>false, 'class'=>'darkselect'));
        $data['tz']         = timezoneSB(array('name'=>'tz_id', 'class'=>'darkselect', 'initial'=>'Select Timezone'));
        $data['cap']        = '<img src="application/views/site/all_captchas.php?_t=rgst" id="icap" class="darkcap fl two_fifth" />';       
        $data['pkg_id']     = $this->uri->segment(4);
        $data['pg_title']   = page_title($this->lang->line('lang_signup'));
        
        $data['lang_email']     = $this->lang->line('reg_email');
        $data['lang_pword']     = $this->lang->line('reg_pword');
        $data['lang_cpword']    = $this->lang->line('reg_cpword');
        $data['lang_fname']     = $this->lang->line('reg_fname');
        $data['lang_lname']     = $this->lang->line('reg_lname');
        $data['lang_company']   = $this->lang->line('reg_comp');
        $data['lang_phone']     = $this->lang->line('reg_phone');
        $data['lang_country']   = $this->lang->line('reg_cntry');
        $data['lang_timezone']  = $this->lang->line('reg_tz');
        $data['lang_agree']     = sprintf($this->lang->line('reg_agree'), anchor('#', 'Terms & Conditions'), anchor('#', 'Privacy Policy'));
        $data['lang_noread']    = $this->lang->line('reg_noread');
        $data['lang_signup']    = $this->lang->line('lang_signup');
        $data['lang_website']   = $this->lang->line('reg_website');
        
		if(isset($_POST['email']))
		{
            
            $this->form_validation->set_rules('pkg_id', 'Package', 'callback_validate_pkg|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_validate_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]|xss_clean');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]|xss_clean');
            $this->form_validation->set_rules('website', 'Website', 'trim|required|callback_valid_url|callback_real_url|callback_website_available|xss_clean');
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('company', 'Company', 'trim|required|min_length[4]|max_length[30]|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|xss_clean');
            $this->form_validation->set_rules('country_id', 'Country', 'required|xss_clean');
            $this->form_validation->set_rules('tz_id', 'Timezone', 'required|xss_clean'); 
            $this->form_validation->set_rules('captcha', 'Captcha', 'required|callback_validate_captcha|xss_clean');
            $this->form_validation->set_rules('agree', 'Agree Terms & Conditions and Privacy Policy', 'required');
             
			if($this->form_validation->run() == TRUE)
            {
               // add to the list..
               $qarray = array(
                                  'company'     => $this->input->post('company', true),
                                  'country_id'  => $this->input->post('country_id', true),
                                  'tz_id'       => $this->input->post('tz_id', true),
                                  'created'     => date('Y-m-d H:i:s'),
                                  'creator'     => '0',
                                  'sortorder'   => $this->account_model->getSortOrder()
                              );
                               
				if($acc_id = $this->account_model->save($qarray)){
				    $fname = $this->input->post('fname', true);
                    $lname = $this->input->post('lname', true);
                    $email = $this->input->post('email', true);
                    $password = $this->input->post('password', true);
                    $website  = $this->input->post('website', true);
                    $conf_code = md5($acc_id);
                    
                    //update the confirmation code;
                    $this->account_model->updateConfCode($acc_id, $conf_code);
                    
                    $qarray = array(
                                  'fname'       => $fname,
                                  'lname'       => $lname,
                                  'email'       => $email,
                                  'password'    => md5($this->input->post('password', true)),
                                  'phone'       => $this->input->post('phone', true), 
                                  'created'     => date('Y-m-d H:i:s'),
                                  'status'      => 1,
                                  'sortorder'   => 1
                              );    
                    
                    if($this->account_model->saveUser($qarray, $acc_id)){
                        
                        // now save website information and generate tracker code.
                        $this->load->model('package_model', 'pm');
                        $pkg_row = $this->pm->find_by_id($data['pkg_id'])->row();
                        
                        $__website  = parse_url($website);
                        $scheme     = $__website['scheme'];
                        $host       = str_replace('www.', '', $__website['host']);
                        $sub_host   = '*.'.$host;
                        $reg_on     = date('Y-m-d H:i:s');
                        $trial_prd  = $pkg_row->pkg_trial_period;
                        $expiry_date= (int)$pkg_row->free_trial && $trial_prd > 0 ? calc_exp_date($trial_prd, $reg_on) : '';
                        $site_id    = generateUniqSiteId();
                         
                        $qarray = array(
                                  'uniq_id'      => $site_id,
                                  'package_id'  => $data['pkg_id'],
                                  'account_id'  => $acc_id,
                                  'protocol'    => $scheme,
                                  'domain'      => $host, 
                                  'sub_domains' => $sub_host,
                                  'site_name'   => '',
                                  'description' => '',
                                  'purchased'   => (int)$pkg_row->free_trial ? 0 : 1,
                                  'purchased_on'=> (int)$pkg_row->free_trial ? '' : $reg_on,
                                  'status'      => 1,
                                  'created'     => $reg_on,
                                  'expired'     => 0,
                                  'expiry_date' => $expiry_date,
                                  'tracker'     => generateTracker($site_id),
                                  'sortorder'   => 1
                              ); 
                        
                        
                        $this->account_model->saveSite($qarray);
                        
                        // Send Verification E-mail
                        
                        $_link = fsite_url('user/confirm/'.$conf_code);
                        $_dlink = fsite_url('user/cancel/'.$conf_code);                        
                        $link = anchor($_link, $_link);
                        $dlink = anchor($_dlink, $_dlink);
                        
                        $email_param = setup_email(1, array('name'=>$fname, 'email'=>$email, 'link'=>$link, 'dlink'=>$dlink, 'password'=> $password));
                        $subject = $email_param['subject'];
                        $body = $email_param['body'];                        
                        
                        $this->email->initialize(array('mailtype'=>'html'));                    
                        $this->email->from($this->config->item('INFO_EMAIL'), $this->config->item('SITE_TITLE'));
                        $this->email->to($email);  
                        $this->email->bcc($this->config->item('INFO_EMAIL')); //  to the admin info address also                  
                        $this->email->subject($subject);
                        $this->email->message($body);
                        $this->email->send();
                        
                        redirect(fsite_url('user/register_post', 'refresh'));                        
                    }
				    
				}
			}
		}	
		
		$this->load->view('site/register', $data);
	}
	
    
    // Post registraiont thank you page.	
    function register_post(){
        $this->load->language('register', CURRENT_LANGUAGE);
        $data['lang_R104'] = $this->lang->line('lang_R104');  
        $data['pg_title'] = $this->lang->line('lang_reg_completed');
        $this->load->view('site/register_post', $data);
    }    


    // confirm the registration
    function confirm()
    {
        $this->load->language('register', CURRENT_LANGUAGE);    
        $code = $this->uri->segment(4);        
        
        if($this->account_model->is_confirmed($code)){
            $data['pg_title'] = page_title($this->lang->line('lang_acc_alr_active'));
            $data['lang_R105'] = $this->lang->line('lang_R105');    
            $this->load->view('site/registration_isactivated', $data); 
        }elseif($this->account_model->code_exists($code)){    
            $this->account_model->setConfirmed($code);
            $data['lang_R103'] = $this->lang->line('lang_R103');
            $data['lang_R106'] = $this->lang->line('lang_R106');    
            $data['pg_title'] = page_title($this->lang->line('lang_reg_confd'));
            $data['tracker'] = $this->account_model->trackerByConfCode($code);
            // initialize required data.
            $this->account_model->init_data($code); 
            $this->load->view('site/registration_confirmed', $data);
        }else{
            $data['lang_R101'] = $this->lang->line('lang_R101');
            $data['pg_title'] = page_title($this->lang->line('lang_conf_err'));
            $this->load->view('site/unauthorized_confirmation', $data);
        }    
    }
        
	// confirm canellation [unauthorized email]
	function cancel($id=0)
	{
	    $code = $this->uri->segment(4);	    
		if($this->account_model->isCancellable($code))
            $this->account_model->isCancellable($code);
        else{
            $data['pg_title'] = page_title($this->lang->line('lang_canc_err'));
            $data['lang_R102'] = $this->lang->line('lang_R102');    
            $this->load->view('site/unauthorized_cancellation', $data);
        }
	}

	
    function login(){
                    
        $ret = 0;
        $this->load->library('form_validation');  
        $this->load->language('login', CURRENT_LANGUAGE);
        $data = array();
        
        $data['ln_sign_in'] = $this->lang->line('ln_sign_in');
        $data['pg_title']   = page_title($data['ln_sign_in']);
        $data['ln_email']   = $this->lang->line('ln_email');
        $data['ln_pswd']    = $this->lang->line('ln_pswd');
        $data['ln_forgot']  = $this->lang->line('ln_forgot');
        $data['ln_reg']     = $this->lang->line('ln_reg');
                
        if(isset($_POST['email']) && isset($_POST['password']))
        {   
            $this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
             
            if($this->form_validation->run() == TRUE)
            {
                $uinfo = $this->account_model->doLogin($this->input->post('email'), md5($this->input->post('password')));
                
                if($uinfo){
                    
                    $all_sites = $this->account_model->site_details_by_userid($uinfo->account_id, $uinfo->account_user_id, $uinfo->role);
                    $site_arr = array();
                    $first = true;
                    foreach($all_sites as $r){
                        $site_arr[$r->uniq_id] = array(                            
                            'site_id'=>$r->site_id, 
                            'package_id'=>$r->package_id, 
                            'account_id'=> $r->account_id, 
                            'protocol'=>$r->protocol, 
                            'domain'=>$r->domain, 
                            'sub_domains'=>$r->sub_domains, 
                            'site_name'=>$r->site_name, 
                            'site_type_id'=>$r->site_type_id, 
                            'description'=>$r->description, 
                            'purchased'=>$r->purchased, 
                            'purchased_on'=>$r->purchased_on, 
                            'status'=>$r->status, 
                            'created'=>$r->created, 
                            'expired'=>$r->expired, 
                            'expiry_date'=>$r->expiry_date, 
                            'tracker'=>$r->tracker, 
                            'sortorder'=>$r->sortorder,
                            'pkg_name'=>$r->pkg_name, 
                            'free_trial'=>$r->free_trial, 
                            'pkg_downgradable'=>$r->pkg_downgradable, 
                            'pkg_price'=>$r->pkg_price, 
                            'pkg_trial_period'=>$r->pkg_trial_period, 
                            'pkg_upgradable'=>$r->pkg_upgradable
                        );
                        
                        // set current site in session. site can be switched to manage.
                        if($first){                            
                            $this->session->set_userdata(APPID.'_current_site', $site_arr[$r->uniq_id]);
                            $this->session->set_userdata(APPID.'_site_id', $site_arr[$r->uniq_id]['site_id']);
                        }
                        $first = false;
                    }        
 
                    // set session params 
                    $set_userdata = 
                        array(
                            'user_id'   => $uinfo->account_user_id,
                            'email'     => $uinfo->email,
                            'phone'     => $uinfo->phone,
                            'fname'     => $uinfo->fname,
                            'lname'     => $uinfo->lname,
                            'status'    => $uinfo->status,
                            'company'   => $uinfo->company,
                            'account_id'=> $uinfo->account_id,
                            'tz_id'     => $uinfo->tz_id,
                            'country_id'=> $uinfo->country_id,
                            'role'      => $uinfo->role,
                            'sites'     => $site_arr
                            );
                    
                    $this->session->unset_userdata(APPID.'_user');
                    $this->session->unset_userdata(APPID.'_loggedin');
            
                    $this->session->set_userdata(APPID.'_user', $set_userdata);
                    $this->session->set_userdata(APPID.'_loggedin', true);
                    redirect(fsite_url('dashboard/index'), 'refresh');
                }else{
                    $data['ln_inv_crd'] = $this->lang->line('ln_inv_crd');
                }              
            }
        }     
        
        $this->load->view('site/login', $data);
    }
    
    function logout()
    {
        //$this->session->unset_userdata(APPID.'_user');
        //$this->session->unset_userdata(APPID.'_loggedin');
        $this->session->sess_destroy();        
        redirect(base_url(), 'refresh');
    }
    	
	/* User Profile.. Show by id..*/
	function profile($id=0)
	{
		$id = intval($id);
		$data['id'] = $id;
		$q = $this->db->query("SELECT * FROM tbl_user WHERE user_id={$id} AND status=1");
		if($q->num_rows() == 0)
		{
			die('<h1>Invalid User</h1>');
		}
		$r = $q->row();
		
		$data['usr_name']     = $r->screen_name;
		$data['usr_dob']      = $r->dob;
		$data['usr_gender']   = $r->gender;
		$data['usr_mobile']   = $r->mobile_no;
		$data['usr_country']  = $r->country;
		$data['usr_username'] = $r->username;
		$data['usr_email']    = $r->email;
		
		$uid = get_cookie(APPID.'_user');
		$data['is_admin_user'] = ($uid == $id) ? true : false;
		
		if(file_exists("./uploads/user/profile_".$id.".jpg"))
		{
			$img = 'profile_'.$id.'.jpg';
			$has_or_not = true;
		}
		else if(file_exists("./uploads/user/profile_".$id.".jpeg"))
		{
			$img = 'profile_'.$id.'.jpeg';
			$has_or_not = true;
		}
		else
		{
		     $img = ($r->gender == 'Male' || $r->gender == 'male') ? 'avatar_male.png' : 'avatar_female.png';
			 $has_or_not = false;
		}
		$data['usr_image'] = base_url().'uploads/user/'.$img;
		$data['has_image'] = $has_or_not;
		
		$data['q_pages']  = $this->content_model->getPages();
		$this->load->view('frontend/user_profile.php', $data);
	}	
}