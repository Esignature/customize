<?php
require_once (dirname(__FILE__).'/TreeView.php');
class JsonTreeView extends TreeView {
         
    function __construct($table = "tbl_segment_category", $fields = array(), $add_fields = array("title" => "title", "type" => "type")) {
        parent::__construct($table, $fields);
        $this->fields = array_merge($this->fields, $add_fields);
        $this->add_fields = $add_fields;
    }

    function create_node($data) {
        $id = parent::_create((int)$data[$this->fields["id"]], (int)$data[$this->fields["position"]]);
        if($id) {
            $data["id"] = $id;
            $this->set_data($data);
            return  json_encode(array('status'=>1, 'id'=>(int)$id));
        }
        return json_encode(array('status'=>0));
    }
    
    function set_data($data) {
        if(count($this->add_fields) == 0) { return "{ \"status\" : 0 }"; }
        $s = "UPDATE `".$this->table."` SET `".$this->fields["id"]."` = `".$this->fields["id"]."` "; 
        foreach($this->add_fields as $k => $v) {
            if(isset($data[$k]))    $s .= ", `".$this->fields[$v]."` = \"".$data[$k]."\" ";
            else                    $s .= ", `".$this->fields[$v]."` = `".$this->fields[$v]."` ";
        }
        $s .= "WHERE `".$this->fields["id"]."` = ".(int)$data["id"]." AND `site_id` = ".$this->site_id;
        $this->_CI->db->query($s);
        return json_encode(array('status'=>1));
    }
    
    function rename_node($data) { return $this->set_data($data); }

    function move_node($data) { 
        $id = parent::_move((int)$data["id"], (int)$data["ref"], (int)$data["position"], (int)$data["copy"]);
        if(!$id) return "{ \"status\" : 0 }";
        if((int)$data["copy"] && count($this->add_fields)) {
            $ids    = array_keys($this->_get_children($id, true));
            $data   = $this->_get_children((int)$data["id"], true);

            $i = 0;
            foreach($data as $dk => $dv) {
                $s = "UPDATE `".$this->table."` SET `".$this->fields["id"]."` = `".$this->fields["id"]."` "; 
                foreach($this->add_fields as $k => $v) {
                    if(isset($dv[$k]))  $s .= ", `".$this->fields[$v]."` = \"".$dv[$k]."\" ";
                    else                $s .= ", `".$this->fields[$v]."` = `".$this->fields[$v]."` ";
                }
                $s .= "WHERE `".$this->fields["id"]."` = ".$ids[$i]." AND site_id = ".$this->site_id;
                $this->_CI->db->query($s);
                $i++;
            }
        }
        return  json_encode(array('status'=>1, 'id'=>(int)$id));
    }
    
    function remove_node($data) {
        $id = parent::_remove((int)$data["id"]);
        return  json_encode(array('status'=>1));
    }
    
    function get_children($data) {
        $tmp = $this->_get_children((int)$data["id"]);
        if((int)$data["id"] === 1 && count($tmp) === 0) {
            $this->_create_default();
            $tmp = $this->_get_children((int)$data["id"]);
        }
        $result = array();
        if((int)$data["id"] === 0) return json_encode($result);
        
        foreach($tmp as $k => $v) {
            $v = (array)$v;
            $result[] = array(
                "attr" => array("id" => "node_".$k, "rel" => $v[$this->fields["type"]]),
                "data" => $v[$this->fields["title"]],
                "state" => ((int)$v[$this->fields["right"]] - (int)$v[$this->fields["left"]] > 1) ? "closed" : ""
            );
        }
        return json_encode($result);
    }
    
    function search($data) {
        $this->db->query("SELECT `".$this->fields["left"]."`, `".$this->fields["right"]."` FROM `".$this->table."` WHERE `".$this->fields["title"]."` LIKE '%".$data["search_str"]."%'");
        if($this->db->nf() === 0) return "[]";
        $q = "SELECT DISTINCT `".$this->fields["id"]."` FROM `".$this->table."` WHERE 0 ";
        while($this->db->nextr()) {
            $q .= " OR (`".$this->fields["left"]."` < ".(int)$this->db->f(0)." AND `".$this->fields["right"]."` > ".(int)$this->db->f(1).") ";
        }
        $result = array();
        $this->db->query($q);
        while($this->db->nextr()) { $result[] = "#node_".$this->db->f(0); }
        return json_encode($result);
    }

    function _create_default() {
        //$this->_drop();
        $this->create_node(array("id" => 1, "position" => 0, "title" => "Main Category", "type" => "drive", "site_id" => $this->site_id));
    }
}