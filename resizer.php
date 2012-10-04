<?php
define('BASEPATH', '');
require_once(dirname(__FILE__).'/application/helpers/uploader_helper.php');

$s=urldecode($_GET['s']);
if(strstr($s, 'sites/')){
	$s = str_replace('http://www.cellroti.com/', '', $s);
	$s = dirname(__FILE__).'/../'.$s;
}else{
	
	$s = dirname(__FILE__).'/'.$s;	
	if(strstr($_SERVER['HTTP_HOST'], '192.168.'))
	$s = str_replace('http://'.$_SERVER['HTTP_HOST'].'/cellroti_new/', '', $s);
	else
	$s = str_replace('http://www.cellroti.com/new/', '', $s);
	$s = 'C:\wamp\www\cellroti_new\uploads\416x231\g_37291316765782.jpg';
	
}

createImageThumb($s, $_GET['w'], $_GET['h'], '', '', true, true);

?>