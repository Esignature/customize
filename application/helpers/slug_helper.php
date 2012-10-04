<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
if ( ! function_exists('createSlug'))
{
	function createSlug($title='', $slug='')
	{
		$ret = '';
		$title = stripslashes(trim(strtolower($title)));
		$slug  = stripslashes(trim(strtolower($slug)));
		$disallowed = array(' ', '@', '!', '$', '%', '^', '&', '*', '(', ')', '.', '/', '\\', '{', '}', '+', '=', '`', '<', '>', ',', '"');

		if($slug == '')
		{
			$ret = str_replace($disallowed, '-', $title);
		} else if($slug != ''){
			$ret = str_replace($disallowed, '-', $slug);
		}
		return $ret;
	}
}*/


if ( ! function_exists('prepareLink'))
{
	function prepareLink($id=0, $mod=0)
	{
		$ret = '';
		switch($mod){
			case 2:
				$ret = 'article/detail/'.$id;
				break;
				
			case 3:
				$ret = 'news/detail/'.$id;
				break;
		}
		return $ret;
	}
}



if ( ! function_exists('createSlug'))
{
	//create db checked unique slug for contents
	function createSlug($title, $table, $key_id=NULL){
		        
		$CI = & get_instance();
		$slug = slugify(strtolower($title));
		
		$CI->db->where('slug', $slug);
        $CI->db->where('table_name', $table);
		!empty($key_id) && $CI->db->or_where('key_id !=', $key_id);
        
        $CI->db->select("slug");        
        $s = "SELECT slug FROM tbl_slug WHERE slug = ? AND table_name = ?";
        
        if(!empty($key_id))
            $s .= ' AND key_id <> ?';
               
		while($CI->db->query($s, array($slug, $table, $key_id))->num_rows()){			
			if (!preg_match ('/-{1}[0-9]+$/', $slug)) 
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug ); 
		} 
        
		return slugify($slug);
	}	
}


if ( ! function_exists('slugify'))
{	
	function slugify($text){ 
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		$text = trim($text, '-');		
		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);		
		// lowercase
		$text = strtolower($text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);
		
		if (empty($text))
		{
			return 'n-a';
		}		
		return $text;
	}
}


if ( 1==0 && ! function_exists('slugAvailable'))
{
	function slugAvailable($slug, $param){
		$CI = & get_instance();        
        list($table, $key_id) = preg_split('/,/', $param);      
        
		if($keyid == null || !isset($keyid)) $keyid = 0; 
		$CI->db->where("slug", $slug);
        $CI->db->where("table_name", $table);
		$keyid>0 && $CI->db->where(array("key_id<>"=>$keyid));
        
		$rows=$CI->db->query("SELECT slug FROM tbl_slug")->num_rows();
		return $rows ? false:true;
	}
}
	
if ( ! function_exists('saveSlug'))
{
	//SAVE THE SLUG
	function saveSlug($t, $s, $k, $kid, $m, $mn){
		$CI = & get_instance();
		$CI->db->query("DELETE FROM tbl_slug WHERE key_id = '{$kid}' AND table_name = '{$t}'");
		$CI->db->set('module_id', $m);
        $CI->db->set('module_name', $mn);
		$CI->db->set('table_name', $t);
		$CI->db->set('slug', $s);
		$CI->db->set('key_field', $k);
		$CI->db->set('key_id', (int)$kid);
		$CI->db->insert('tbl_slug');
	}
}

if ( ! function_exists('removeSlug'))
{
	//REMOVE THE SLUG RECORDS
	function removeSlug($t, $k){		    
        $CI = & get_instance();
		$CI->db->delete('tbl_slug', array('table_name'=>$CI->db->escape($t), 'key_id'=>$k));
	}
}


if ( ! function_exists('getSlug'))
{		
	//SAVE THE SLUG
	function getSlug($table, $keyid){
		$CI = & get_instance();		       
		$CI->db->select('slug');
        $CI->db->where(array('table_name'=>$table, 'key_id'=>$keyid));
        $query = $CI->db->get('tbl_slug');
        
		if($query->num_rows($query)){
			return $query->row()->slug;
		}
		return '';
	}
}

if ( ! function_exists('getDetailsBySlug'))
{       
    	
	//RETREIVE ALL DETAILS FROM THE RELEVANT TABLE AND KEYID FOR THE GIVEN SLUG
	function getDetailsBySlug($slug){
		$CI = & get_instance();		
		$CI->db->select('module_id, module_name, table_name, key_field, key_id');
		$CI->db->where(array('slug'=>$CI->db->escape($slug)));
        $query=$CI->db->get('tbl_slug');
		if($query->num_rows())			
            return $query->row();
        else
			return false;
	}
}