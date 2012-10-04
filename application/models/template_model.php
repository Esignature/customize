<?php

class Template_model extends CI_Model
{
	
	public static $tbl_name = 'tbl_template';

	function __construct()
	{
		parent::__construct();
	}
	
	function find_by_id($id=0)
	{
		return $this->db->get_where(self::$tbl_name, array('template_id' => $id));
	}
	
	function getTemplateFolder($id=0)
	{
		$q = $this->db->get_where(self::$tbl_name, array('template_id'=>$id));
		$r = 'greyout';
		if($q->num_rows() == 1){
			$rw = $q->row();
			$r = $rw->name;
		}
		return $r.'/';
	}
	
	function getTemplatesList($cur=0)
	{
		$ret = '';
		$q = $this->db->get_where(self::$tbl_name);
		foreach($q->result() as $r):
		    $sel = ($cur == $r->template_id) ? 'selected="selected"' : '';
		    $ret.= ' <option value="'.$r->template_id.'" '.$sel.' >'.$r->name.'</option> ';
		endforeach;
		return $ret;
	}
	
	function getThemes()
	{
		$ret = '';
		$q = $this->db->get_where(self::$tbl_name);
		foreach($q->result() as $r):
		    $themes = explode('||', $r->themes);
			for($i=0; $i<count($themes); $i++)
			{
				 $ret.= '<div class="opt_'.$r->template_id.'">';
				 $ret.= ' <option value="'.$themes[$i].'" id="option_'.$r->template_id.'_'.$themes[$i].'">'.$themes[$i].'</option> ';
				 $ret.= '</div>';
			}
		endforeach;
		return $ret;
	}
}