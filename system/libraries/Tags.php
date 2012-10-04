<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Tags {

	var $objTags= array();
	var $CI = '';
	 
	public function __construct($params = array())
	{
		// Set the super object to a local variable for use later
		$this->CI =& get_instance();

		// Are any config settings being passed manually?  If so, set them
		$config = array();
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				$config[$key] = $val;
			}
		}
		
		$rs = $this->CI->db->query("SELECT total_count AS weight, T.tag_id, T.tag_name FROM tbl_tag T 
						INNER JOIN tbl_content_tag CT ON T.tag_id = CT.tag_id 
						INNER JOIN tbl_content C ON CT.content_id = C.content_id 
						INNER JOIN tbl_content_counter CNT ON CNT.content_id = C.content_id 
						WHERE C.status = 1 AND C.del_flag = 0 GROUP BY T.tag_id ORDER BY weight DESC, T.tag_name");
		
		$this->objTags= $this->build_weighted_tags($rs);		
		usort($this->objTags, array($this, 'sort_by_title'));
	
	}

	// --------------------------------------------------------------------

	
	/**
	 * callback for usort, sort by count
	 */
	function sort_by_title($a, $b) {
	  return strnatcasecmp($a->tag_name, $b->tag_name);
	}

	function build_weighted_tags($result, $steps = 10) {
		$tags = $result->result();
		$tags=$this->calcSize($tags);
		return $tags;
	}


	function calcSize($tags) {  
      $max_size = 250; // max font size in %  
      $min_size = 100; // min font size in %  
      $min_qty = 0;  
      $max_qty = 0; 
      if( count($tags) ) {  
        foreach($tags as $k=>$t) {  
          if( $tags[$k]->weight>$max_qty )  
            $max_qty = $tags[$k]->weight;  
        }  
        $min_qty = $max_qty;  
        foreach($tags as $k=>$t) {  
          if( $tags[$k]->weight<$min_qty )  
            $min_qty = $tags[$k]->weight;  
        }  
        $spread = $max_qty - $min_qty;  
        if (0 == $spread) { // we don't want to divide by zero  
            $spread = 1;  
        }      
        // determine the font-size increment. this is the increase per tag quantity (times used)  
        $step = ($max_size - $min_size)/($spread);      
                
        foreach($tags as $k=>$t) {  
          $value = $tags[$k]->weight;  
          // calculate CSS font-size. find the $value in excess of $min_qty multiply by the font-size increment ($size) and add the $min_size set above  
          $size = $min_size + (($value - $min_qty) * $step);  
          // uncomment if you want sizes in whole %:  
          $size = ceil($size);  
          $tags[$k]->weight= $size;  
        }  
      }  
      return $tags;  
    }  

}
// END Tag Class

/* End of file Tag.php */
/* Location: ./system/libraries/Tag.php */