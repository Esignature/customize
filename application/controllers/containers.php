<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Containers extends CI_Controller {



	function __construct()

	{

		parent::__construct();

     $this->site_id = $this->session->userdata(APPID. '_site_id');		

	}



    function index()

    {

        $data = array();

        $this->load->view('site/containers_list', $data);

    }
    function container(){
          $data = array();

        $this->load->view('site/containers_list', $data);
    }
function add(){
    
}
function container_datalist12(){
    
}

 function container_datalist(){       

        $this->load->model('segment_model', 'segmo');   

        $aColumns = array('seg_id', 'seg_name', 'seg_desc', 'status');

        $bColumns = array('seg_name');

               

        $dtbl_data = $this->segmo->get_list_data($this->site_id, $_GET, $aColumns, $bColumns);

                

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

            

            $row['DT_RowId'] = 'row_'.$aRow->seg_id;

            $row[] = '<input type="checkbox" name="seg_id_chk[]" class="chkbox"  id="seg_id_'.$aRow->seg_id.'" value="'.$aRow->seg_id.'" />';

            

            for ( $i=0 ; $i<count($aColumns) ; $i++ ){

                if ( in_array($aColumns[$i], $bColumns) && $aColumns[$i] != ' ' ){                                        

                    
                    if($aColumns[$i] == 'seg_name'){

                        $row[] = edit_anchor($aRow->$aColumns[$i], fsite_url('segment/edit/'.$aRow->$aColumns[0]));

                    }else{                    

                        $row[] = $aRow->$aColumns[$i];

                    }

                }

            }

            

            $row[] = '2';

            $row[] = 'manage';

            $row[] = 'Constant';

            $row[] = '5';

            $row[] = '6(78%)';

            

            $output['aaData'][] = $row;
        

        }

        

        echo json_encode( $output );

        

    }
    function container_adddata(){
        $data=array(
    
        'placeholder'=>array('name','html_id','testa','testb','testc'),
        'text_input'=>array('name','html_id'),
        'text_input_search'=>array('name','html_id'),
        'click_event'=>array('name','html_id'),
            'click_event_page'=>array('name','html_id'),
            'mouse_over_event'=>array('name','html_id'),
            'grab_static_html '=>array('name','html_id','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between')),
            'grab_html'=>array('name','html_id','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between')),
            'grab_volatile_html'=>array('name','html_id','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between')),
            'user_data'=>array('name','html_id','user_data_field'),
            'custom_event'=>array('name','html_id','argument_value'),
            'load_event'=>array('name','html_id'),
            'grab_cookie'=>array('name','cookie_name:','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between')),
            'grab_url'=>array('name','html_id','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between')),
            'grab_internal_id'=>array('name','html_id','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between')),
            'grab_user_data'=>array('name','html_id','grab_HTML_mask','profile_data_type'),
            'grab_meta_tag'=>array('name','html_id','grab_HTML_mask'=>array('all','number','not_number','REGULAR_EXPRESSION','if_found','if_not_found','fragment','after','between'))
       
);   
echo json_encode($data);
    } 
}