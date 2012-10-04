<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// firephp debugger
if(!function_exists('fl')){
    function fl($var){
        $ci = & get_instance();
        $ci->firephp->log($var);        
    }    
}

// check if given string
if(!function_exists('is_serialized')){
    function is_serialized( $data ) {
        $data = trim($data);
        // if it isn't a string, it isn't serialized
        if ( empty($data) || !is_string( $data ) )
            return false;
        $data = trim( $data );
        if ( 'N;' == $data )
            return true;
        if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
            return false;
        switch ( $badions[1] ) {
            case 'a' :
            case 'O' :
            case 's' :
                if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                    return true;
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                    return true;
                break;
        }
        return false;
        
        // if above does not work, try the following simplest way
        /*
        $data = @unserialize($str);
        if ($str === 'b:0;' || $data !== false) {
           return true;
        } else {
            return false;
        }*/        
        
    }
}

// combine protocol and domain name to create a complete url
if(!function_exists('urlmaker')){
    function urlmaker( $protocol, $domain ) {
        if(!strstr($domain, 'www.')) $domain = 'www.'.$domain;
        return $protocol.'://'.$domain;
    }
}


// calculate trial period remaining days.
    
function calc_trial_days($tdays, $exp_date = '', $reg_on = '', $show_txt = false, $prefix = ''){
   
    if($tdays>0 && ($reg_on!='' || $exp_date != '')){
        if($exp_date != ''){
            $exp_date = strtotime(date("Y-m-d H:i:s", strtotime($exp_date != '' ? $exp_date : $reg_on)));
        }else{
            $exp_date = strtotime(date("Y-m-d H:i:s", strtotime($exp_date != '' ? $exp_date : $reg_on)) . " +{$tdays} day");    
        }
        
        $cur_date = time();            
        $timeleft   = $exp_date-$cur_date;
        $daysleft   = round((($timeleft/24)/60)/60);
        if($daysleft>0)
            return $prefix. ($show_txt ? ('<span class="orange em">Trial Days Left: '.abs($daysleft).'</span>') : abs($daysleft));
        else
            return $prefix.($show_txt ? '<span class="orange em">Expired on '.mdate(DATE_STR, $exp_date).'</span>' : abs($daysleft));
    }
}

// calculate the expiry date based on the trial period (in days)
function calc_exp_date($trial_prd, $reg_on = ''){
    if($reg_on == '') $reg_on = date('Y-m-d H:i:s');
    return date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($reg_on)) . " +".$trial_prd." days"));
}

// return the defaulf
function def_currency($prep_to = '', $symbol = true){
    $CI=& get_instance();
    $cr = $CI->config->item($symbol ? 'def_curr_sym' : 'def_curr');
    return trim($prep_to) != '' ? ($cr.$prep_to) : $cr;            
}


function setup_email($id, $data){
    $ret = array();
    $CI = & get_instance();
    $r = $CI->db->get_where('tbl_mail_template', array('id' => $id), 1, 0);
    $row = $r->row();
   
    $map_array = array(
                    '_{name}_'  => $data['name'],
                    '_{email}_' => $data['email'],
                    '_{link}_'  => $data['link'],
                    '_{dlink}_' => $data['dlink'], 
                    '_{password}_' => $data['password'], 
                    );
    
    $ret['subject'] = $row->subject;
    $body = $row->body;
    foreach ($map_array as $k => $v) {
        $body = str_replace($k, $v, $body);    
    }
    $ret['body'] = $body;
    return $ret;  
}

// current loaded language
function current_lang(){
    $CI = & get_instance();
    //$CI->load->helper('cookie');
    $vlang = get_cookie('visitor_lang');
    if(!isset($vlang) || $vlang == '')
        $vlang = $CI->config->item('language');
    
    return $vlang;
        
}

function page_title($pre = '', $post = '', $sep = ' | '){
    $CI = & get_instance();
    if(empty($post) && !empty($pre))
        $post = $CI->config->item('SITE_TITLE');
    elseif(!empty($post) && empty($get))
        $pre = $CI->config->item('SITE_TITLE');
    return $pre . $sep . $post;     
}

//delete directory along with its file contents.

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException('$dirPath must be a directory');
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

function generateUniqNumber($len){
    return substr(number_format(time() * rand(), 0, '', ''),0, $len);
}

// generate a unique id for the website
function generateUniqSiteId($db_verify = true, $length = 7){
    $CI = & get_instance();
    $num = generateUniqNumber($length);   
    if($db_verify){
        if($CI->db->query("SELECT site_id FROM tbl_site WHERE site_id = '{$num}'")->num_rows())
           return generateUniqSiteId($db_verify, $length);             
    }
    return $num;
}

function generateTracker($site_id){
    return '<script type="text/javascript" src="//visitor-target.com/stat-tracker-lib.js"></script>
    <script type="text/javascript">try{_S_T.setup('.$site_id.')}catch(e){}</script>
    ';
}

// @mode: c=check for controller, m = check for method
function check_current($check, $mode = 'c', $class = 'class="current"'){
    $ci = & get_instance();
    $cntrl = $ci->router->fetch_class();
    $mthd = $ci->router->fetch_method();    
    
    if(is_array($check)){
        foreach($check as $b){
            list($b, $m) = explode("|", $b);
            if(($m == 'c' && $b === $cntrl) || 
                ($m == 'm' && $b === $mthd)) return $class;
        }
    }else{
        if($mode == 'c' && $check === $cntrl) return $class;
        if($mode == 'm' && $check === $mthd) return $class;
    }
    
    return '';
}

// return controller name
function check_cntrl_methd($mode = 'c'){
    $ci = & get_instance();
    $cntrl = $ci->router->fetch_class();
    $mthd = $ci->router->fetch_method();
    
    if($mode == 'c') return $cntrl;
    if($mode == 'm') return $mthd;
    return '';
}

// copy link for segment list
function copy_anchor($id){
    return ' <span class="tip">'.anchor("javascript:void(0);", '<img src="images/icons/copy.png" height="12" width="12" alt="." />', array('title'=> 'Copy', 'onclick'=>"copyRow('".fsite_url('ajax/copy_row/'.$id)."', this)")).'</span> ';    
}

// info link for segment list
function info_anchor($id){
    return ' <span class="tip">'.anchor("javascript:void(0);", '<img src="images/icons/info.png" height="12" width="12" alt="." />', array('title'=> 'Info', 'onclick'=>"showInfo('".fsite_url('ajax/copy_row/'.$id)."', this)")).'</span> ';    
}

// status icons display (published or unpublished) in data table list
function status_anchor($flag, $id, $id_cls=NULL, $no_off = 0){
    //if unpublishing is not allowed
    if($no_off)
        return ' <span class="tip"><a href="javascript:void(0)" class="restricted" title="Unpublishing restricted !!"><img src="images/icons/restrict.png" height="12" width="12" alt="." /></span> ';
    else
        return ' <span class="tip"><a href="javascript:void(0)" title='.($flag ? 'Active: Click to deactivate' : 'Inactive: Click to activate').' class='. ($flag ? 'active' : 'inactive').'><img src="images/icons/'. ($flag ? 'active.png' : 'inactive.png') . '" height="12" width="12" alt="." /></span> ';    
}

// graph icons display in segment list
function graph_anchor($id){
    return ' <span class="tip">'.anchor("javascript:void(0);", '<img src="images/icons/graph.png" height="12" width="12" alt="." />', array('title'=> 'Graph', 'onclick'=>"showGraph(this)")).'</span> ';    
}

// create edit link for data table grid
function edit_anchor($title, $link, $no_edit = 0){
    if(empty($title))
        $title = $no_edit ? '<img src="images/icons/custom/restrict.png" height="12" width="12" alt="." />' : '<img src="images/icons/icon_edit.png" height="12" width="12" alt="." />';
    
    //if editing is not allowed
    if($no_edit)
        return ' <span class="tip">'.anchor("javascript:void(0);", $title, array('class'=>'restricted', 'title'=> 'Editing restricted !!')).'</span> ';
    else
        return ' <span class="tip">'.anchor($link, $title, array('title'=>'Edit')).'</span> ';
    
}

// create delete link for data table grid
function delete_anchor($name, $id, $id_cls=NULL, $no_delete = 0){
    //if removal is not allowed
    if($no_delete)
        return ' <span class="tip">'.anchor("#", '<img src="images/icons/bullet_cross.png" height="12" width="12" alt="." />', array('class'=>'restricted', 'title'=> 'Delete restricted !!')).'</span> ';
    else
        return ' <span class="tip">'.anchor('#', ' <img src="images/icons/bullet_cross.png" height="12" width="12" alt="." />', array('class'=>isset($id_cls)?$id_cls:'delete', 'title'=>'Delete', 'name'=>$name, 'id'=>$id)).'</span> ';
}
