<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->site_id = $this->session->userdata(APPID. '_site_id');		
        /* Get the session user_id */        
        $user_id = $this->session->userdata(APPID.'_user');
        $this->user_id = $user_id['user_id'];        
	}

    function index()
    {
        $data = array();
        $this->load->view('site/action_list', $data);
    }

    function set_kcfinder_session(){
        session_start();               
        /* Set session parameters for KCFinder/CKEditor*/
        $_SESSION['KCFINDER'] = array();
        $_SESSION['KCFINDER']['disabled'] = false;
        $_SESSION['KCFINDER']['uploadURL'] = "../uploads/user_res/" . $this->user_id . "/" . $this->site_id . "";
        $_SESSION['KCFINDER']['uploadDir'] = "";
    }

	function add()
	{
	    $this->load->helper('action');
        $this->load->language('actions', CURRENT_LANGUAGE);
        $this->set_kcfinder_session();
        
		$data = array();
        $data['axn_id'] = 0;
        $data['axn_grp_name'] = '';
        $data['main_cats'] = main_axn_categories();    
        
		$this->load->view('site/add_edit_action', $data);
	} 
        
    function edit()
    {
        $this->load->helper('action');
        $this->load->language('actions', CURRENT_LANGUAGE);
        $this->load->model('action_model', 'axnmo');
        $this->set_kcfinder_session();
        
        $axn_id = $this->uri->segment(4);
        $axn_data = $this->axnmo->find_by_id($axn_id, $this->site_id);
        
        
        /*
        $this->dbug->show($axn_data);
        //die();
        #*/
        
        $data = array();
        $data['axn_id'] = $axn_id;
        $data['axn_grp_name'] = '';
        $data['main_cats'] = $axn_cats = main_axn_categories();
        
        $data['axn_name'] = $axn_data['axn_name'];
        $data['axn_desc'] = $axn_data['axn_desc'];
        $data['hdn_axn_cats'] = $axn_data['check_node'];
        $_group = $axn_data['_group'];
        $data['js_script'] = "\$j(function(){\r\n";
        
        foreach($_group as $grp_id=>$grp_data){
            $arrAlias   = $grp_data['event_alias'];
            $grp_so     = $grp_data['evt_grp_blk_so'];
            
            $data['js_script'] .= "\$j('#add_event_block').trigger('click', [{$grp_id}, {$grp_so}])\r\n";
                        
            foreach($grp_data['fieldset'] as $k=>$dt){
                $evt_so = $k;
                $not_op = isset($dt['not_op']) && !empty($dt['not_op']) ? $dt['not_op'] : 0;
                $pre_op = $dt['pre_op'];
                $alias = $arrAlias[$k-1];
                
                foreach($dt['fields'] as $fld_id=>$flds){
                    $data['js_script'] .= "add_rule('{$fld_id}', null, '{$grp_id}', '{$evt_so}', '{$not_op}', '{$pre_op}', encodeTxt('{$alias}', 1), ".json_encode($grp_data['fieldset']).", true)\r\n";
                }   
            }  
             
            
        }
        
        $data['js_script'] .= "})";
        $this->load->view('site/add_edit_action', $data);
    }   
    
    // actions
    function axn_list_actions(){
        $this->load->model('action_model', 'axnmo');
        $axn = $this->input->post('axn', true);
        $ids = $this->input->post('axn_id_chk', true);
        if($axn){
            switch($axn){
                case 'delete':
                    if($this->axnmo->delete(join(', ', $ids), $this->site_id))
                        echo json_encode(array('success'=>1));
                    else
                        echo json_encode(array('success'=>0));
                    break;
                case 'activate':
                    $this->axnmo->activate(join(', ', $ids), $this->site_id);
                    echo json_encode(array('success'=>1, 'ids'=>join(',', $ids)));
                    break;
                case 'deactivate':
                    $this->axnmo->deactivate(join(', ', $ids), $this->site_id);
                    echo json_encode(array('success'=>1, 'ids'=>join(',', $ids)));
                    break;
                    
            }
        }
    }
    
    function axn_datalist(){       
        $this->load->model('action_model', 'axnmo');   
        
        $aColumns = array('axn_id', 'axn_name', 'axn_desc', 'status');
        $bColumns = array('axn_name');
               
        $dtbl_data = $this->axnmo->get_list_data($this->site_id, $_GET, $aColumns, $bColumns);
                
        // Output 
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $dtbl_data['iTotal'],
            "iTotalDisplayRecords" => $dtbl_data['iFilteredTotal'],
            "aaData" => array()
        );
        
        $result = $dtbl_data['data'];
        
        foreach ( $result as $aRow )
        {
            $row = array();
            
            $row['DT_RowId'] = 'row_'.$aRow->axn_id;
            $row[] = '<input type="checkbox" name="axn_id_chk[]" class="chkbox"  id="axn_id_'.$aRow->axn_id.'" value="'.$aRow->axn_id.'" />';
            
            for ( $i=0 ; $i<count($aColumns) ; $i++ ){
                if ( in_array($aColumns[$i], $bColumns) && $aColumns[$i] != ' ' ){                                        
                    
                    if($aColumns[$i] == 'axn_name'){
                        $row[] = edit_anchor($aRow->$aColumns[$i], fsite_url('action/edit/'.$aRow->$aColumns[0]));
                    }else{                    
                        $row[] = $aRow->$aColumns[$i];
                    }
                }
            }
            
            $row[] = '2';
            $row[] = 'manage';
            $row[] = 'Constant';
            $row[] = '9';
            $row[] = '6(78%)';
            $row[] = '0%(Â±0%)';
            $row[] = '83.3%(+8.3%)';
            $row[] = '1.5(Â±0)';
            $row[] = '1 min 15 sec';
            $row[] = copy_anchor( $aRow->axn_id ) .
                     info_anchor( $aRow->axn_id ) .
                     graph_anchor( $aRow->axn_id ) .
                     status_anchor( $aRow->status, $aRow->axn_id ) .
                     delete_anchor( $aRow->axn_name, 'axn_del.'.$aRow->axn_id, 'axn_del' );
            $output['aaData'][] = $row;
        
        }
        
        echo json_encode( $output );
        
    }

    
    // action field set for add form
    function axn_field_sets(){
        /*$this->dbug->show($_POST);
        die();*/
        $this->load->helper('action');
        $i = $this->input->post('i', true);
        $g = $this->input->post('g', true); 
        $fld_data= $this->input->post('fld_data', true);      
        $r = display_axn_fields($i, $g, $fld_data);
        echo json_encode($r);
    }

    
}