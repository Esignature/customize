<?php

$ret = '';
if(isset($_GET) && isset($_GET['name']) && $_GET['name']!='')
{
	$name = $_GET['name'];
	if(file_exists('./uploads/'.$name))
	{
		list($w, $h) = getimagesize("./uploads/$name");
		$ar = ($w/$h);
		// determine image nature;; potrait or landscape..
		if($ar > 1)
		{
			// Landscape..
			$width = 575;  // Reference width
			$height = ceil($width/$ar);
		}
		else if($ar == 1)
		{
			// Square Image..
			$width = 575;
			$height = 335;
		}
		else
		{
			// Potrait Image..
			$width = 335;  // Reference width
			$height = ceil($height*$ar);
		}

		// check height displacement-----
		$d = '';
		if($height > 335)
		{
			$d = ' style="position:relative;top:-'.($height-335).'px"';
		}
		$ret = "<img src='http://www.cellroti.com/new/uploads/{$name}' alt='Loading..' width='{$width}' height='{$height}' {$d} />";
	}
}
echo $ret;