<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Modules {

    var $CI = '';
    var $props = '';
    var $id='';
    var $name='';
    var $desc='';
    var $raw_props='';
    var $sorto='';
    var $status='';
    
    public function __construct($params = array())
    {
        // Set the super object to a local variable for use later
        $this->CI =& get_instance();
        $router =& load_class('Router');
        $this->controller = strtolower($router->fetch_class());
        $this->action     = strtolower($router->fetch_method()); 
        
        // Are any config settings being passed manually?  If so, set them
        $config = array();
        if (count($params) > 0)
        {
            foreach ($params as $key => $val)
            {
                $config[$key] = $val;
            }
        }
        
    }
    
    function set_params($mod_id){
        
        $r=$this->CI->db->get_where('tbl_module', array('module_id'=>$mod_id), 1, 0)->row();
        $this->desc = $r->description;
        $this->props = $r->properties;
        $this->raw_props = $r->raw_prop;
        $this->name = $r->name;
        $this->sorto = $r->sortorder;
        $this->status = $r->status;        
        
    }
    
    function mod_props($mod_id){
        
        $this->set_params($mod_id);
        if($this->props!='')
            return unserialize($this->props);
    }
    
    
    // --------------------------------------------------------------------


}
// END Modules Class

/* End of file Modules.php */
/* Location: ./system/libraries/Modules.php */