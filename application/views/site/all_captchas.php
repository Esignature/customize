<?php
include_once(dirname(__FILE__).'/captcha.php');

if(isset($_GET['_t'])){
	$captcha = new SimpleCaptcha();
    $captcha->session_var  = $_GET['_t'].'_captcha';
    
	switch($_GET['_t']){
		case 'rgst': 			
			$captcha->imageFormat = 'png'; 
			$captcha->width  = 150;
			$captcha->height = 50;
			$captcha->backgroundColor = array(51, 51, 51);
            $captcha->colors = array(
                                array(255 ,255, 0),
                                array(128 ,255, 0),
                                array(0 ,255, 64),
                                array(6 ,174, 255),
                                array(255 ,128, 64),
                                array(207 ,207, 207),
                                array(255 ,255, 255)
                                );
			$captcha->minWordLength = 4;
			$captcha->maxWordLength = 6;
			$captcha->fontSize  = 40;
		break;
		case 'inq': 			
			$captcha->imageFormat = 'png'; 
			$captcha->width  = 120;
			$captcha->height = 30;
			$captcha->minWordLength = 4;
			$captcha->maxWordLength = 6;
			$captcha->fontSize  = 30;
		break;
	}	
}
$captcha->CreateImage();