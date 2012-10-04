<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

    private $_module_id = 25;

	function __construct()
	{
		parent::__construct();
		$this->output->cache(10);
	}

    /*
	*  listing section..
	*/
	function view()
	{
		$id = $this->uri->segment(3);		
		!$id && redirect(base_url());
		
		$q = $this->content_model->getPage($id);
		if($q->num_rows() == 0)
		{
			redirect(base_url());
		}
		$r = $q->row();
		
		$data['title'] =  $r->title.' || Cellroti - Artists, News, Views, Reviews and everything about Nepali Music';
		$data['content'] = $r->full_content;
		$data['page_title'] = $r->title;
		$data['q_pages']  = $this->content_model->getPages();
		$data['site_keywords'] = $r->meta_key;
		$data['site_description'] = $r->meta_desc;
		
		$this->load->view(SITE_FOLDER.'page.php', $data);
	}
}