<?php
class TreeView {
    protected $_CI = '';
	// Structure table and fields
	protected $table	= "";
	protected $fields	= array(
			"id"		=> false,
			"parent_id"	=> false,
			"position"	=> false,
			"left"		=> false,
			"right"		=> false,
			"level"		=> false,
			"site_id"   => false
		);
    protected $site_id;
    
	// Constructor
	function __construct($table = "tbl_segment_category", $fields = array()) {
	    $this->_CI = & get_instance();
	    $this->site_id = $this->_CI->session->userdata(APPID. '_site_id');
		$this->table = $table;
		if(!count($fields)) {
			foreach($this->fields as $k => &$v) { $v = $k; }
		}
		else {
			foreach($fields as $key => $field) {
				switch($key) {
					case "id":
					case "parent_id":
					case "position":
					case "left":
					case "right":
					case "level":
                    case "site_id":
						$this->fields[$key] = $field;
						break;
				}
			}
		}
	}

	function _get_node($id) {
		$r = $this->_CI->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["id"]."` = ".(int) $id);
		return $r->num_rows() === 0 ? false : $r->row_array();
	}
	function _get_children($id, $recursive = false) {
		$children = array();
		if($recursive) {
			$node = $this->_get_node($id);
			$r = $this->_CI->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["left"]."` >= ".(int) $node[$this->fields["left"]]." AND `".$this->fields["right"]."` <= ".(int) $node[$this->fields["right"]]." AND site_id = ".$this->site_id." ORDER BY `".$this->fields["left"]."` ASC");
		}
		else {
			$r = $this->_CI->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["parent_id"]."` = ".(int) $id." AND site_id = ".$this->site_id." ORDER BY `".$this->fields["position"]."` ASC");
		}
        
		foreach($r->result() as $row) $children[$row->id] = $row;
		return $children;
	}
	function _get_path($id) {
		$node = $this->_get_node($id);
		$path = array();
		if(!$node === false) return false;
		$this->_CI->db->query("SELECT `".implode("` , `", $this->fields)."` FROM `".$this->table."` WHERE `".$this->fields["left"]."` <= ".(int) $node[$this->fields["left"]]." AND `".$this->fields["right"]."` >= ".(int) $node[$this->fields["right"]]." AND site_id = ".$this->site_id);
		while($row = $r->row_array()) $path[$row[$this->fields["id"]]] = $row;
		return $path;
	}

	function _create($parent, $position) {
		return $this->_move(0, $parent, $position);
	}
	function _remove($id) {
		if((int)$id === 1) { return false; }
		$data = $this->_get_node($id);
		$lft = (int)$data[$this->fields["left"]];
		$rgt = (int)$data[$this->fields["right"]];
		$dif = $rgt - $lft + 1;

		// deleting node and its children
		$this->_CI->db->query("" . 
			"DELETE FROM `".$this->table."` " . 
			"WHERE `".$this->fields["left"]."` >= ".$lft." AND `".$this->fields["right"]."` <= ".$rgt." AND site_id = ".$this->site_id
		);
		// shift left indexes of nodes right of the node
		$this->_CI->db->query("".
			"UPDATE `".$this->table."` SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - ".$dif." " . 
			"WHERE `".$this->fields["left"]."` > ".$rgt." AND site_id = ".$this->site_id
		);
		// shift right indexes of nodes right of the node and the node's parents
		$this->_CI->db->query("" . 
			"UPDATE `".$this->table."` SET `".$this->fields["right"]."` = `".$this->fields["right"]."` - ".$dif." " . 
			"WHERE `".$this->fields["right"]."` > ".$lft." AND site_id = ".$this->site_id
		);

		$pid = (int)$data[$this->fields["parent_id"]];
		$pos = (int)$data[$this->fields["position"]];

		// Update position of siblings below the deleted node
		$this->_CI->db->query("" . 
			"UPDATE `".$this->table."` SET `".$this->fields["position"]."` = `".$this->fields["position"]."` - 1 " . 
			"WHERE `".$this->fields["parent_id"]."` = ".$pid." AND `".$this->fields["position"]."` > ".$pos." AND site_id = ".$this->site_id
		);
		return true;
	}
	function _move($id, $ref_id, $position = 0, $is_copy = false) {
		if((int)$ref_id === 0 || (int)$id === 1) { return false; }
		$sql		= array();						// Queries executed at the end
		$node		= $this->_get_node($id);		// Node data
		$nchildren	= $this->_get_children($id);	// Node children
		$ref_node	= $this->_get_node($ref_id);	// Ref node data
		$rchildren	= $this->_get_children($ref_id);// Ref node children

		$ndif = 2;
		$node_ids = array(-1);
		if($node !== false) {
			$node_ids = array_keys($this->_get_children($id, true));
			// TODO: should be !$is_copy && , but if copied to self - screws some right indexes
			if(in_array($ref_id, $node_ids)) return false;
			$ndif = $node[$this->fields["right"]] - $node[$this->fields["left"]] + 1;
		}
		if($position >= count($rchildren)) {
			$position = count($rchildren);
		}

		// Not creating or copying - old parent is cleaned
		if($node !== false && $is_copy == false) {
			$sql[] = "" . 
				"UPDATE `".$this->table."` SET `".$this->fields["position"]."` = `".$this->fields["position"]."` - 1 " . 
				"WHERE " . 
					"`".$this->fields["parent_id"]."` = ".$node[$this->fields["parent_id"]]." AND " . 
					"`".$this->fields["position"]."` > ".$node[$this->fields["position"]]." AND `site_id` = ".$this->site_id;
			$sql[] = "" . 
				"UPDATE `".$this->table."` SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - ".$ndif." " . 
				"WHERE `".$this->fields["left"]."` > ".$node[$this->fields["right"]]." AND site_id = ".$this->site_id;
			$sql[] = "" . 
				"UPDATE `".$this->table."` SET `".$this->fields["right"]."` = `".$this->fields["right"]."` - ".$ndif." " . 
				"WHERE " . 
					"`".$this->fields["right"]."` > ".$node[$this->fields["left"]]." AND " . 
					"`".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).")  AND site_id = ".$this->site_id;
		}
		// Preparing new parent
		$sql[] = "" . 
			"UPDATE `".$this->table."` SET `".$this->fields["position"]."` = `".$this->fields["position"]."` + 1 " . 
			"WHERE " . 
				"`".$this->fields["parent_id"]."` = ".$ref_id." AND " . 
				"`".$this->fields["position"]."` >= ".$position." " . 
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).")  AND site_id = ".$this->site_id);

		$ref_ind = $ref_id === 0 ? (int)$rchildren[count($rchildren) - 1][$this->fields["right"]] + 1 : (int)$ref_node[$this->fields["right"]];
		$ref_ind = max($ref_ind, 1);

		$self = ($node !== false && !$is_copy && (int)$node[$this->fields["parent_id"]] == $ref_id && $position > $node[$this->fields["position"]]) ? 1 : 0;
		foreach($rchildren as $k => $v) {
		    $v = (array)$v;
			if($v[$this->fields["position"]] - $self == $position) {
				$ref_ind = (int)$v[$this->fields["left"]];
				break;
			}
		}
		if($node !== false && !$is_copy && $node[$this->fields["left"]] < $ref_ind) {
			$ref_ind -= $ndif;
		}

		$sql[] = "" . 
			"UPDATE `".$this->table."` SET `".$this->fields["left"]."` = `".$this->fields["left"]."` + ".$ndif." " . 
			"WHERE " . 
				"`".$this->fields["left"]."` >= ".$ref_ind." " . 
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") AND site_id = ".$this->site_id);
		$sql[] = "" . 
			"UPDATE `".$this->table."` SET `".$this->fields["right"]."` = `".$this->fields["right"]."` + ".$ndif." " . 
			"WHERE " . 
				"`".$this->fields["right"]."` >= ".$ref_ind." " . 
				( $is_copy ? "" : " AND `".$this->fields["id"]."` NOT IN (".implode(",", $node_ids).") AND site_id = ".$this->site_id);

		$ldif = $ref_id == 0 ? 0 : $ref_node[$this->fields["level"]] + 1;
		$idif = $ref_ind;
		if($node !== false) {
			$ldif = $node[$this->fields["level"]] - ($ref_node[$this->fields["level"]] + 1);
			$idif = $node[$this->fields["left"]] - $ref_ind;
			if($is_copy) {
				$sql[] = "" . 
					"INSERT INTO `".$this->table."` (" . 
						"`".$this->fields["parent_id"]."`, " . 
						"`".$this->fields["position"]."`, " . 
						"`".$this->fields["left"]."`, " . 
						"`".$this->fields["right"]."`, " . 
						"`".$this->fields["level"]."`, " .
						"`".$this->fields["site_id"]."`" . 
					") " . 
						"SELECT " . 
							"".$ref_id.", " . 
							"`".$this->fields["position"]."`, " . 
							"`".$this->fields["left"]."` - (".($idif + ($node[$this->fields["left"]] >= $ref_ind ? $ndif : 0))."), " . 
							"`".$this->fields["right"]."` - (".($idif + ($node[$this->fields["left"]] >= $ref_ind ? $ndif : 0))."), " . 
							"`".$this->fields["level"]."` - (".$ldif."), " . 
							"`".$this->site_id."` " .
						"FROM `".$this->table."` " . 
						"WHERE " . 
							"`".$this->fields["id"]."` IN (".implode(",", $node_ids).")  AND `site_id` = ".$this->site_id . " ".
						"ORDER BY `".$this->fields["level"]."` ASC";
			}
			else {
				$sql[] = "" . 
					"UPDATE `".$this->table."` SET `".$this->fields["parent_id"]."` = ".$ref_id.", `".$this->fields["position"]."` = ".$position." " . 
					"WHERE " . 
						"`".$this->fields["id"]."` = ".$id." AND site_id = ".$this->site_id;
				$sql[] = "" . 
					"UPDATE `".$this->table."` SET `".$this->fields["left"]."` = `".$this->fields["left"]."` - (".$idif."), " . 
						"`".$this->fields["right"]."` = `".$this->fields["right"]."` - (".$idif."), " . 
						"`".$this->fields["level"]."` = `".$this->fields["level"]."` - (".$ldif.") " . 
					"WHERE " . 
						"`".$this->fields["id"]."` IN (".implode(",", $node_ids).") AND `site_id` = ".$this->site_id;
			}
		}
		else {
			$sql[] = "" . 
				"INSERT INTO `".$this->table."` (" . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."`, " . 
					"`".$this->fields["site_id"]."` " . 
					") " . 
				"VALUES (" . 
					$ref_id.", " . 
					$position.", " . 
					$idif.", " . 
					($idif + 1).", " . 
					$ldif.", ".
					$this->site_id. 
				")";
		}
		foreach($sql as $q) { $this->_CI->db->query($q); }
		$ind = $this->_CI->db->insert_id();
		if($is_copy) $this->_fix_copy($ind, $position);
		return $node === false || $is_copy ? $ind : true;
	}
	function _fix_copy($id, $position) {
		$node = $this->_get_node($id);
		$children = $this->_get_children($id, true);

		$map = array();
		for($i = $node[$this->fields["left"]] + 1; $i < $node[$this->fields["right"]]; $i++) {
			$map[$i] = $id;
		}
		foreach($children as $cid => $child) {
			if((int)$cid == (int)$id) {
				$this->_CI->db->query("UPDATE `".$this->table."` SET `".$this->fields["position"]."` = ".$position." WHERE `".$this->fields["id"]."` = ".$cid." AND site_id = ".$this->site_id);
                
				continue;
			}
			$this->_CI->db->query("UPDATE `".$this->table."` SET `".$this->fields["parent_id"]."` = ".$map[(int)$child[$this->fields["left"]]]." WHERE `".$this->fields["id"]."` = ".$cid." AND site_id = ".$this->site_id);
			for($i = $child[$this->fields["left"]] + 1; $i < $child[$this->fields["right"]]; $i++) {
				$map[$i] = $cid;
			}
		}
	}

	function _reconstruct() {
		$this->_CI->db->query("" . 
			"CREATE TEMPORARY TABLE `temp_tree` (" . 
				"`".$this->fields["id"]."` INTEGER NOT NULL, " . 
				"`".$this->fields["parent_id"]."` INTEGER NOT NULL, " . 
				"`". $this->fields["position"]."` INTEGER NOT NULL, " . 
				"`". $this->fields["site_id"]."` INTEGER NOT NULL" . 
			") type=HEAP"
		);
		$this->_CI->db->query("" . 
			"INSERT INTO `temp_tree` " . 
				"SELECT " . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " .
					"`".$this->fields["site_id"]."` " .					 
				"FROM `".$this->table."`"
		);

		$this->_CI->db->query("" . 
			"CREATE TEMPORARY TABLE `temp_stack` (" . 
				"`".$this->fields["id"]."` INTEGER NOT NULL, " . 
				"`".$this->fields["left"]."` INTEGER, " . 
				"`".$this->fields["right"]."` INTEGER, " . 
				"`".$this->fields["level"]."` INTEGER, " . 
				"`stack_top` INTEGER NOT NULL, " . 
				"`".$this->fields["parent_id"]."` INTEGER, " . 
				"`".$this->fields["position"]."` INTEGER, " .
				"`".$this->fields["site_id"]."` INTEGER " . 
			") type=HEAP"
		);
		$counter = 2;
		$r = $this->_CI->db->query("SELECT COUNT(*) FROM temp_tree WHERE site_id = ".$this->site_id);
		$row = $r->row();
		$maxcounter = (int) $row->id * 2;
		$currenttop = 1;
		$this->_CI->db->query("" . 
			"INSERT INTO `temp_stack` " . 
				"SELECT " . 
					"`".$this->fields["id"]."`, " . 
					"1, " . 
					"NULL, " . 
					"0, " . 
					"1, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " .
					"`".$this->fields["site_id"]."` " . 
				"FROM `temp_tree` " . 
				"WHERE `".$this->fields["parent_id"]."` = 0 AND site_id = ".$this->site_id
		);
		$this->_CI->db->query("DELETE FROM `temp_tree` WHERE `".$this->fields["parent_id"]."` = 0 AND `".$this->fields["site_id"]."` = ".$this->site_id);

		while ($counter <= $maxcounter) {
			$r = $this->_CI->db->query("" . 
				"SELECT " . 
					"`temp_tree`.`".$this->fields["id"]."` AS tempmin, " . 
					"`temp_tree`.`".$this->fields["parent_id"]."` AS pid, " . 
					"`temp_tree`.`".$this->fields["position"]."` AS lid " . 
				"FROM `temp_stack`, `temp_tree` " . 
				"WHERE " . 
					"`temp_stack`.`".$this->fields["id"]."` = `temp_tree`.`".$this->fields["parent_id"]."` AND " . 
					"`temp_stack`.`stack_top` = ".$currenttop." AND `temp_stack`.`site_id` = ".$this->site_id . 
				"ORDER BY `temp_tree`.`".$this->fields["position"]."` ASC LIMIT 1"
			);

			if ($row = $r->row()) {
				$tmp = $row->tempmin;

				$q = "INSERT INTO temp_stack (stack_top, `".$this->fields["id"]."`, `".$this->fields["left"]."`, `".$this->fields["right"]."`, `".$this->fields["level"]."`, `".$this->fields["parent_id"]."`, `".$this->fields["position"]."`, `site_id`) VALUES(".($currenttop + 1).", ".$tmp.", ".$counter.", NULL, ".$currenttop.", ".$this->_CI->db->f("pid").", ".$this->_CI->db->f("lid").", ".$this->site_id.")";
				$this->_CI->db->query($q);
				$this->_CI->db->query("DELETE FROM `temp_tree` WHERE `".$this->fields["id"]."` = ".$tmp . " AND site_id = `".$this->site_id."`");
				$counter++;
				$currenttop++;
			}
			else {
				$this->_CI->db->query("" . 
					"UPDATE temp_stack SET `".$this->fields["right"]."` = ".$counter.", `stack_top` = -`stack_top` " . 
					"WHERE `stack_top` = ".$currenttop." AND `site_id` = ".$this->site_id
				);
				$counter++;
				$currenttop--;
			}
		}

		$temp_fields = $this->fields;
		unset($temp_fields["parent_id"]);
		unset($temp_fields["position"]);
		unset($temp_fields["left"]);
		unset($temp_fields["right"]);
		unset($temp_fields["level"]);
        unset($temp_fields["site_id"]);
        
		if(count($temp_fields) > 1) {
			$this->_CI->db->query( 
				"CREATE TEMPORARY TABLE `temp_tree2` " . 
					"SELECT `".implode("`, `", $temp_fields)."` FROM `".$this->table."` WHERE site_id = ".$this->site_id
			);
		}
		$this->_CI->db->delete($this->table, array('site_id'=>$this->site_id));
		$this->_CI->db->query("" . 
			"INSERT INTO ".$this->table." (" . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."`, " .
					"`".$this->fields["site_id"]."` " . 
				") " . 
				"SELECT " . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."`, " .
					"`".$this->fields["site_id"]."` " . 
				"FROM temp_stack WHERE site_id = " .$this->site_id. 
				"ORDER BY `".$this->fields["id"]."`"
		);
		if(count($temp_fields) > 1) {
			$sql = "UPDATE `".$this->table."` v, `temp_tree2` SET v.`".$this->fields["id"]."` = v.`".$this->fields["id"]."` ";
			foreach($temp_fields as $k => $v) {
				if($k == "id") continue;
				$sql .= ", v.`".$v."` = `temp_tree2`.`".$v."` ";
			}
			$sql .= " WHERE v.`".$this->fields["id"]."` = `temp_tree2`.`".$this->fields["id"]."` AND v.site_id = ".$this->site_id;
			$this->_CI->db->query($sql);
		}
	}

	function _analyze() {
		$report = array();

		$this->_CI->db->query("SELECT `".$this->fields["left"]."` FROM `".$this->table."` s WHERE `".$this->fields["parent_id"]."` = 0 ");
		$this->_CI->db->nextr();
		if($this->_CI->db->nf() == 0) {
			$report[] = "[FAIL]\tNo root node.";
		}
		else {
			$report[] = ($this->_CI->db->nf() > 1) ? "[FAIL]\tMore than one root node." : "[OK]\tJust one root node.";
		}
		$report[] = ($this->_CI->db->f(0) != 1) ? "[FAIL]\tRoot node's left index is not 1." : "[OK]\tRoot node's left index is 1.";

		$this->_CI->db->query( 
			"SELECT COUNT(*) FROM `".$this->table."` s WHERE " . 
				"`".$this->fields["parent_id"]."` != 0 AND s.`site_id` = " . $this->site_id." AND ". 
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE `".$this->fields["id"]."` = s.`".$this->fields["parent_id"]."`) = 0 AND `site_id` = ". $this->site_id);
		$this->_CI->db->nextr();
		$report[] = ($this->_CI->db->f(0) > 0) ? "[FAIL]\tMissing parents." : "[OK]\tNo missing parents.";

		$this->_CI->db->query("SELECT MAX(`".$this->fields["right"]."`) FROM `".$this->table."` WHERE `site_id`=" . $this->site_id);
		$this->_CI->db->nextr();
		$n = $this->_CI->db->f(0);
		$this->_CI->db->query("SELECT COUNT(*) FROM `".$this->table."` WHERE `site_id`=" . $this->site_id );
		$this->_CI->db->nextr();
		$c = $this->_CI->db->f(0);
		$report[] = ($n/2 != $c) ? "[FAIL]\tRight index does not match node count." : "[OK]\tRight index matches count.";

		$this->_CI->db->query("" . 
			"SELECT COUNT(`".$this->fields["id"]."`) FROM `".$this->table."` s " . 
			"WHERE " . 
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE " . 
					"`".$this->fields["right"]."` < s.`".$this->fields["right"]."` AND " . 
					"`".$this->fields["left"]."` > s.`".$this->fields["left"]."` AND " . 
					"`".$this->fields["level"]."` = s.`".$this->fields["level"]."` + 1 AND " .
					"`".$this->fields["site_id"]."` = `".$this->site_id."`" . 
				") != " .
				"(SELECT COUNT(*) FROM `".$this->table."` WHERE " . 
					"`".$this->fields["parent_id"]."` = s.`".$this->fields["id"]."` AND `".$this->fields['site_id']."`=`".$this->site_id."`" . 
				") "
			);
		$this->_CI->db->nextr();
		$report[] = ($this->_CI->db->f(0) > 0) ? "[FAIL]\tAdjacency and nested set do not match." : "[OK]\tNS and AJ match";

		return implode("<br />",$report);
	}

	function _dump($output = false) {
		$nodes = array();
		$this->_CI->db->query("SELECT * FROM ".$this->table." ORDER BY `".$this->fields["left"]."`");
		while($this->_CI->db->nextr()) $nodes[] = $this->_CI->db->get_row("assoc");
		if($output) {
			echo "<pre>";
			foreach($nodes as $node) {
				echo str_repeat("&#160;",(int)$node[$this->fields["level"]] * 2);
				echo $node[$this->fields["id"]]." (".$node[$this->fields["left"]].",".$node[$this->fields["right"]].",".$node[$this->fields["level"]].",".$node[$this->fields["parent_id"]].",".$node[$this->fields["position"]].")<br />";
			}
			echo str_repeat("-",40);
			echo "</pre>";
		}
		return $nodes;
	}
	function _drop() {
		$this->_CI->db->delete($this->table, array('site_id'=>''));
		$this->_CI->db->query("" . 
				"INSERT INTO `".$this->table."` (" . 
					"`".$this->fields["id"]."`, " . 
					"`".$this->fields["parent_id"]."`, " . 
					"`".$this->fields["position"]."`, " . 
					"`".$this->fields["left"]."`, " . 
					"`".$this->fields["right"]."`, " . 
					"`".$this->fields["level"]."` " . 
					"`".$this->fields["site_id"]."` " .
					") " . 
				"VALUES (" . 
					"1, " . 
					"0, " . 
					"0, " . 
					"1, " . 
					"2, " . 
					"0, ".
					$this->site_id. 
				")");
	}
}
?>