<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('createImageThumb'))
{
	function createImageThumb($image='', $new_width=190, $new_height=190, $folder='thumbs', $root='uploads')
	{
		$imagesize=getimagesize("./{$root}/{$image}");
		
		if(file_exists("./{$root}/{$folder}/{$image}")){
		    return false;
		}
		
		$width = $imagesize[0];
		$height = $imagesize[1];
		$type=$imagesize[2];
		if($width>=$height)
		{
			@$ratio=($new_width/$width);
			$new_height=round($height*$ratio);
			//$new_height=190;
		}
		else
		{
			$ratio=($new_height/$height);
			$new_width=round($width*$ratio);
			//$new_width=190;
		}
		$imagefile="./{$root}/{$image}";
		list($width, $height) = getimagesize($imagefile);
		@$image_p = imagecreatetruecolor($new_width,$new_height);
		if ($imagesize[2] == "1")
		{
			$img = @imagecreatefromgif($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./{$root}/{$folder}/{$thename}";
			imagegif($image_p,$location, 100);
		}
		if ($imagesize[2] == "2")
		{
			$img = @imagecreatefromjpeg($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./{$root}/{$folder}/{$thename}";
			imagejpeg($image_p,$location, 100);
		}
		
		//png images support
		if($imagesize[2] == "3")
		{
			$img=@imagecreatefrompng($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			$location="./{$root}/{$folder}/{$thename}";
			imagepng($image_p,$location, 100);
		}
		
		return true;
	}
}

if ( ! function_exists('createImageAndMaintain'))
{
	function createImageAndMaintain($image='', $new_width=190, $new_height=190, $folder='thumbs', $root='uploads')
	{
		$imagesize=getimagesize("./{$root}/{$image}");
		
		if(file_exists("./{$root}/{$folder}/{$image}")){
		    return false;
		}
		
		$width = $imagesize[0];
		$height = $imagesize[1];
		$type=$imagesize[2];
		
		
		
		if($width>=$height)
		{
			@$ratio=($new_width/$width);
			$new_height=round($height*$ratio);
			//$new_height=190;
		}
		else
		{
			$ratio=($new_height/$height);
			$new_width=round($width*$ratio);
			//$new_width=190;
		}
		$imagefile="./{$root}/{$image}";
		list($width, $height) = getimagesize($imagefile);
		@$image_p = imagecreatetruecolor($new_width,$new_height);
		if ($imagesize[2] == "1")
		{
			$img = @imagecreatefromgif($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./{$root}/{$folder}/{$thename}";
			imagegif($image_p,$location, 100);
		}
		if ($imagesize[2] == "2")
		{
			$img = @imagecreatefromjpeg($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./{$root}/{$folder}/{$thename}";
			imagejpeg($image_p,$location, 100);
		}
		
		//png images support
		if($imagesize[2] == "3")
		{
			$img=@imagecreatefrompng($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			$location="./{$root}/{$folder}/{$thename}";
			imagepng($image_p,$location, 100);
		}
		
		return true;
	}
}


if(!function_exists('cropImage')){

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
		
}