<?php
function cropImage($w=200, $h=180, $x, $y, $src){
			
	if (preg_match('~gif$~i', $src) >= 1)
	{
		$current_image = imagecreatefromgif($src);
	}

	else if (preg_match('~png$~i', $src) >= 1)
	{
		
		$current_image = imagecreatefrompng($src);
	}

	else if (preg_match('~jpe?g$~i', $src) >= 1)
	{
		$current_image = imagecreatefromjpeg($src);
	}
	
	
	// assuming that $src holds the image with which you are working
	$img_width  = imagesx($current_image);
	$img_height = imagesy($current_image);
	
	
	// Starting point of crop
	$x = !isset($x) ? floor($img_width / 2) - floor ($w / 2) : $x;
	$y = !isset($y) ? floor($img_height / 2) - floor($h / 2) : $y;
	
	// Adjust crop size if the image is too small
	if ($x < 0)
	{
	  $x = 0;
	}
	if ($y < 0)
	{
	  $y = 0;
	}
	
	if (($img_width - $x) < $w)
	{
	  $w = $img_width - $x;
	}
	if (($img_height - $y) < $h)
	{
	  $h = $img_height - $y;
	}

	$result = imagecreatetruecolor($w, $h);
	imagecopy($result, $current_image, 0, 0, $x, $y, $w, $h);
		
	imagefill($result, 0, 0, IMG_COLOR_TRANSPARENT);
	imagesavealpha($result, true);
	imagealphablending($result, true);
	
	
	if (preg_match('~gif$~i', $src) >= 1)
	{
		header('Content-Type: image/gif');
		//imageinterlace($result, true);
		imagegif($result, null);
	}

	else if (preg_match('~png$~i', $src) >= 1)
	{
		
		header('Content-Type: image/png');
		//imageinterlace($result, true);
		imagepng($result, null, 9);
	}

	else if (preg_match('~jpe?g$~i', $src) >= 1)
	{
		
		header('Content-Type: image/jpeg');
		//imageinterlace($result, true);
		imagejpeg($result, null, 100);
	}
			
}
$s = urldecode($_GET['s']);
$s = str_replace('http://www.cellroti.com/', '', $s);
if(!empty($s)){
	$f = dirname(__FILE__) . '/../' . $s;
}

cropImage($_GET['w'], $_GET['h'], null, null, $f);

?>