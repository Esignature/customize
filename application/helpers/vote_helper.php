<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('myshare'))
{
	function myshare($share=0, $total=0, $pre='%')
	{
		if($total == 0)
		{
			$per = 0;
		} else {
		    $per = ($share/$total) * 100;
		    $per = ceil($per * 100) / 100;	
		}
		return $per.$pre;
	}
}