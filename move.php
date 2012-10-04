<?php
//include('dBug.php');
/*mysql_connect('localhost', 'admin', 'GUtgi5fYF');
mysql_select_db('cellroti_production');
$rs = mysql_query("SELECT N.title, V.nid, field_emfield_embed, field_emfield_data, field_emfield_duration FROM content_field_emfield V INNER JOIN node N ON N.nid=V.nid");
while($row=mysql_fetch_object($rs)){
	if(trim($row->field_emfield_data) != ''){
		$field_emfield_data = unserialize($row->field_emfield_data);
		$tb = $field_emfield_data['emthumb']['filepath'];
		if($tb=='')
			$tb= $field_emfield_data['thumbnail']['url'];
			
		$d= $row->field_emfield_duration;
		$v= $row->field_emfield_embed;
	}
	
	$arr[$row->nid] = array('video'=>$v, 'thumb'=>$tb, 'duration'=>$d, 'title'=>$row->title);
}
mysql_close();
*/


mysql_connect('localhost', 'admin', 'GUtgi5fYF');
mysql_select_db('ci_cellroti');

$rs = mysql_query("SELECT `length` FROM tbl_video");
while($row=mysql_fetch_object($rs)){
	if($row->length>0 ){
		$a = $row->length / 60;		
		list($min, $secMin) = explode('.', $a);
		$sec = round($secMin * 60);
		if(strlen($min) == 1) $min = '0'.$min;
		if(strlen($sec) == 1) $sec = '0'.$sec;
		
		$time = $min.':'.$sec;
	}else{
		$time = '00:00';	
	}
	echo $time.'<br />';
	//mysql_query("UPDATE `length` tbl_video SET `length` = '".$time."'");

}
mysql_close();
?>