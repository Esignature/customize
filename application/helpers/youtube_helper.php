<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('youtube_info'))
{
	function youtube_info($str)
	{ 
	    if (strpos($str, 'youtube.com') || strpos($str, 'youtu.be')) {
			if (strpos($str, 'youtube.com')){
				$yt1 = true;
			    preg_match('!youtube\.com/(.*?)v[=/]([\w\-]+)!i', $str, $matches);
			}
			else{
				$yt1 = false;
			    preg_match('!youtu\.be/([\w\-]+)!i', $str, $matches);
			}
            $video['provider'] = 'youtube';
            $video['key'] = $vid_key = $yt1 ? $matches[2] : $matches[1];
            $video['file'] = 'http://www.youtube.com/v/'.$video['key'];
            $sxml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/'.$vid_key);
			$video = array();
			
			if($sxml){
				// print_r($sxml) //extract other information from here
				$video['title'] = (string)$sxml->title;
				$video['description'] = (string)$sxml->content;
				$video['thumbnail'][0] = 'http://img.youtube.com/vi/'.$vid_key.'/0.jpg';
				$video['thumbnail'][1] = 'http://img.youtube.com/vi/'.$vid_key.'/1.jpg';
				$video['thumbnail'][2] = 'http://img.youtube.com/vi/'.$vid_key.'/2.jpg';
				$video['thumbnail'][3] = 'http://img.youtube.com/vi/'.$vid_key.'/3.jpg';
				
				$media = $sxml->children('http://search.yahoo.com/mrss/');
				// get <yt:duration> node for video length
				$yt = $media->children('http://gdata.youtube.com/schemas/2007');
				$attrs = $yt->duration->attributes();
				$video['duration'] = round($attrs['seconds']/60, 2); // in minutes		
			}
            return $video;
        }
	}
}

if ( ! function_exists('youtube_thmb'))
{
	function youtube_thmb($str, $size=0)
	{ 
	    if (strpos($str, 'youtube.com') || strpos($str, 'youtu.be')) {
            if (strpos($str, 'youtube.com')){
				$yt1 = true;
			    preg_match('!youtube\.com/(.*?)v[=/]([\w\-]+)!i', $str, $matches);
			}
			else{
				$yt1 = false;
			    preg_match('!youtu\.be/([\w\-]+)!i', $str, $matches);
			}
			            
            return 'http://img.youtube.com/vi/'.($yt1?$matches[2]:$matches[1]).'/'.$size.'.jpg';
        }
	}
}

// video length
if ( ! function_exists('youtube_length'))
{
	function youtube_length($str, $size=0)
	{ 
	    if (strpos($str, 'youtube.com') || strpos($str, 'youtu.be')) {
            if (strpos($str, 'youtube.com')){
				$yt1 = true;
			    preg_match('!youtube\.com/(.*?)v[=/]([\w\-]+)!i', $str, $matches);
			}
			else{
				$yt1 = false;
			    preg_match('!youtu\.be/([\w\-]+)!i', $str, $matches);
			}
			
			$sxml = simplexml_load_file('http://gdata.youtube.com/feeds/api/videos/'.$yt1?$matches[2]:$matches[1])  || false;        
            $video = array();
			if($sxml){
				$media = $sxml->children('http://search.yahoo.com/mrss/');
				// get <yt:duration> node for video length
				$yt = $media->children('http://gdata.youtube.com/schemas/2007');
				$attrs = $yt->duration->attributes();
				return $attrs['seconds']/60;
			}
			return 0;
        }
	}
}