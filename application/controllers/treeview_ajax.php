<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TreeView_Ajax extends CI_Controller {
   
    function __construct(){
        parent::__construct();               
        $this->load->library('jsontreeview', '', 'jstree');        
    }
    
    function tree_axn(){
            
        $operation = $this->input->get_post('operation');
        parse_str($_SERVER['QUERY_STRING'],$_GET);
        if($operation && strpos($operation, "_") !== 0 && method_exists($this->jstree, $operation)) {
            
            $this->output->set_header("HTTP/1.1 200 OK");
            $this->output->set_header("Content-type: application/json; charset=utf-8");
            $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
            $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
            $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            $this->output->set_header("Pragma: no-cache"); 
            
            echo $this->jstree->{$_REQUEST["operation"]}($_REQUEST);
            die();
        }        
    }
}
