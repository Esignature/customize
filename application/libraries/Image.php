<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Image 
{
    private $file;
    private $image;
    private $info;
        
    public function init($file) {
        if (file_exists($file)) {
            $this->file = $file;

            $info = getimagesize($file);

            $this->info = array(
                'width'  => $info[0],
                'height' => $info[1],
                'bits'   => $info['bits'],
                'mime'   => $info['mime']
            );
            
            $this->image = $this->create($file);
        } else {
            exit('Error: Could not load image ' . $file . '!');
        }
    }
        
    private function create($image) {
        $mime = $this->info['mime'];
        
        if ($mime == 'image/gif') {
            return imagecreatefromgif($image);
        } elseif ($mime == 'image/png') {
            return imagecreatefrompng($image);
        } elseif ($mime == 'image/jpeg') {
            return imagecreatefromjpeg($image);
        }
    }   
    
    public function save($file, $quality = 100) {
       $info = pathinfo($file);
       
       $extension = strtolower($info['extension']);
   
        if ($extension == 'jpeg' || $extension == 'jpg') {
            imagejpeg($this->image, $file, $quality);
        } elseif($extension == 'png') {
            imagepng($this->image, $file, 0);
        } elseif($extension == 'gif') {
            imagegif($this->image, $file);
        }
           
        imagedestroy($this->image);
    }       
    
    public function resizeme($width = 0, $height = 0) {
        if (!$this->info['width'] || !$this->info['height']) {
            return;
        }

        $xpos = 0;
        $ypos = 0;

        $scale = min($width / $this->info['width'], $height / $this->info['height']);
        
        if ($scale == 1) {
            return;
        }
        
        $new_width = (int)($this->info['width'] * $scale);
        $new_height = (int)($this->info['height'] * $scale);            
        $xpos = (int)(($width - $new_width) / 2);
        $ypos = (int)(($height - $new_height) / 2);
                        
        $image_old = $this->image;
        $this->image = imagecreatetruecolor($width, $height);
            
        if (isset($this->info['mime']) && $this->info['mime'] == 'image/png') {     
            imagealphablending($this->image, false);
            imagesavealpha($this->image, true);
            $background = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
            imagecolortransparent($this->image, $background);
        }else {         
            $background = imagecolorallocate($this->image, 255, 255, 255);
        }
        
        imagefilledrectangle($this->image, 0, 0, $width, $height, $background);
    
        imagecopyresampled($this->image, $image_old, $xpos, $ypos, 0, 0, $new_width, $new_height, $this->info['width'], $this->info['height']);
        imagedestroy($image_old);
           
        $this->info['width']  = $width;
        $this->info['height'] = $height;
    }
    
    public function watermark($file, $position = 'bottomright') {
        $watermark = $this->create($file);
        
        $watermark_width = imagesx($watermark);
        $watermark_height = imagesy($watermark);
        
        switch($position) {
            case 'topleft':
                $watermark_pos_x = 0;
                $watermark_pos_y = 0;
                break;
            case 'topright':
                $watermark_pos_x = $this->info['width'] - $watermark_width;
                $watermark_pos_y = 0;
                break;
            case 'bottomleft':
                $watermark_pos_x = 0;
                $watermark_pos_y = $this->info['height'] - $watermark_height;
                break;
            case 'bottomright':
                $watermark_pos_x = $this->info['width'] - $watermark_width;
                $watermark_pos_y = $this->info['height'] - $watermark_height;
                break;
        }
        
        imagecopy($this->image, $watermark, $watermark_pos_x, $watermark_pos_y, 0, 0, 120, 40);
        
        imagedestroy($watermark);
    }
    
    public function crop($top_x, $top_y, $bottom_x, $bottom_y) {
        $image_old = $this->image;
        $this->image = imagecreatetruecolor($bottom_x - $top_x, $bottom_y - $top_y);
        
        imagecopy($this->image, $image_old, 0, 0, $top_x, $top_y, $this->info['width'], $this->info['height']);
        imagedestroy($image_old);
        
        $this->info['width'] = $bottom_x - $top_x;
        $this->info['height'] = $bottom_y - $top_y;
    }
    
    public function rotate($degree, $color = 'FFFFFF') {
        $rgb = $this->html2rgb($color);
        
        $this->image = imagerotate($this->image, $degree, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));
        
        $this->info['width'] = imagesx($this->image);
        $this->info['height'] = imagesy($this->image);
    }
        
    private function filter($filter) {
        imagefilter($this->image, $filter);
    }
            
    private function text($text, $x = 0, $y = 0, $size = 5, $color = '000000') {
        $rgb = $this->html2rgb($color);
        
        imagestring($this->image, $size, $x, $y, $text, imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]));
    }
    
    
    
    private function merge($file, $x = 0, $y = 0, $opacity = 100) {
        $merge = $this->create($file);

        $merge_width = imagesx($image);
        $merge_height = imagesy($image);
                
        imagecopymerge($this->image, $merge, $x, $y, 0, 0, $merge_width, $merge_height, $opacity);
    }
            
    private function html2rgb($color) {
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }
        
        if (strlen($color) == 6) {
            list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);   
        } elseif (strlen($color) == 3) {
            list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);    
        } else {
            return false;
        }
        
        $r = hexdec($r); 
        $g = hexdec($g); 
        $b = hexdec($b);    
        
        return array($r, $g, $b);
    }   
    
    //  METHODS THAT FOLLOW ARE STRICTLY DEDICATED TO RESIZING ANIMATED GIFs. 
    //  REGULAR CODE FOR RESIZING WILL ONLY RESIZE THE FIRST FRAME CAUSING IT TO LOSE OTHER FRAMES.
    
    
    public function isAnimated($filename) {
        return (bool)preg_match('/\x00\x21\xF9\x04.{4}\x00(\x2C|\x21)/s', file_get_contents($filename), $m);
    }
    
    public function scaleImageFile($w, $h, $saveTo, $resizemethod = 1){
        
        $CI = & get_instance();
        $CI->load->library('gifdecoder');
        
        $delays = array(5);
        $fileSrc = $this->file;
        if(file_exists($fileSrc) && is_numeric($w) && is_numeric($h)) {
            if(list($width, $height, $type, $attr) = getimagesize($fileSrc)){       
    
/*              if($type == 1 && $this->isAnimated($fileSrc)){
*/                  $gif = new Gifdecoder();
                    $gif->init(file_get_contents($fileSrc));
                    $delays = $gif->GIFGetDelays();
                    $oldimg_a = $gif->GIFGetFrames();
                    if(sizeof($oldimg_a) <= 0) return false;
                    
                    for($i = 0; $i < sizeof($oldimg_a); $i++){
                        $oldimg_a[$i] = imagecreatefromstring($oldimg_a[$i]);
                    }
                    
                /*}else{
                    $oldimg = imagecreatefromgif($fileSrc);
                    $oldimg_a = array($oldimg);
                }*/
                $newimg_a = array();
                
                
                foreach($oldimg_a as $oldimg){
                    $newimg = null;
        
                    if($resizemethod == 4){
                        $ratio = 1.0;
                        $ratio_w = $width / $w;
                        $ratio_h = $height / $h;
                        $ratio = ($ratio_h < $ratio_w ? $ratio_h : $ratio_w);
                        $neww = intval($width / $ratio);
                        $newh = intval($height / $ratio);
                        $tempimg = imagecreatetruecolor($neww, $newh);
                        imagecopyresampled($tempimg, $oldimg, 0, 0, 0, 0, $neww, $newh, $width, $height);
                        $clipw = 0; $cliph = 0;
                        if($neww > $w) $clipw = $neww - $w;
                        if($newh > $h) $cliph = $newh - $h;
        
        
                        $cliptop = floor($cliph / 2);
                        $clipleft = floor($clipw / 2);
                        $newimg = imagecreatetruecolor($w, $h);
                        imagecopy($newimg, $tempimg, 0, 0, $clipleft, $cliptop, $w, $h);
                    }else if($resizemethod == 3){
                        $newimg = imagecreatetruecolor($w, $h);
                        imagecopyresampled($newimg, $oldimg, 0, 0, 0, 0, $w, $h, $width, $height);
                    }else if($resizemethod == 2){
                        $ratio = 1.0;
                        $ratio_w = $width / $w;
                        $ratio_h = $height / $h;
                        $ratio = ($ratio_h > $ratio_w ? $ratio_h : $ratio_w);
                        $newimg = imagecreatetruecolor(intval($width / $ratio), intval($height / $ratio));
                        imagecopyresampled($newimg, $oldimg, 0, 0, 0, 0, intval($width / $ratio), intval($height / $ratio), $width, $height);
                    }else{
                        $ratio = 1.0;
                        if($width > $w || $height > $h){
                            $ratio = $width / $w;
                            if(($height / $h) > $ratio) $ratio = $height / $h;  
                        }
                        
                        $newimg = imagecreatetruecolor(intval($width / $ratio), intval($height / $ratio));
                        imagecopyresampled($newimg, $oldimg, 0, 0, 0, 0, intval($width / $ratio), intval($height / $ratio), $width, $height);
                    }
                    array_push($newimg_a, $newimg);
                }
    
                if(sizeof($newimg_a) > 1){
                    $newa = array();
                    foreach($newimg_a as $i){
                        ob_start();
                        imagegif($i);
                        $gifdata = ob_get_clean();
                        array_push($newa, $gifdata);
                    }
    
                    $gifmerge = new GIFEncoder  ( $newa, $delays, 999, 2, 0, 0, 0, "bin");  
                    fwrite ( fopen ( $saveTo, "wb" ), $gifmerge->GetAnimation ( ) );
                }else{
                    $this->outputImage($newimg, $saveTo);
                }
                
                foreach($newimg_a as $newimg){
                    imagedestroy($newimg);
                }
                return true;
                
            } else return false;
        }
        return false;
    }
        
    private function outputImage($img, $saveTo){
        if(strlen($saveTo) > 0){
            imagejpeg($img, $saveTo, 90);
        }
    
        return true;
    }
            
    // custome method by shakti
    
    public function resize($dir, $file, $w, $h, $returnUrl = true, $retain_orig_name = false, $sub_dir = 'thumb') {
        
        $imagefile = $dir.$file;        
                    
        if(!file_exists($imagefile) || !is_file($imagefile)) {
            return;
        }
       
        if(trim($sub_dir) != '')
            $sub_dir = $sub_dir . '/';
        
        list($width, $height, $type)  = getimagesize($imagefile); 
               
        if((int)$h == 0){ $aspect = $width/$height;  $h = round($w/$aspect); }
        if((int)$w == 0){ $aspect = $height/$width;  $w = round($h/$aspect); }
        
        $directory = pathinfo($imagefile, PATHINFO_DIRNAME).'/'; 
        $filename  = str_replace('_orig', '', pathinfo($imagefile, PATHINFO_FILENAME));  
        $extension = '.'.pathinfo($imagefile, PATHINFO_EXTENSION);
        
        $old_image = $file;        
        $new_image = $retain_orig_name ? $filename . $extension : $filename . '-' . $w . 'x' . $h . $extension;
        $thumb_loc = $directory .$sub_dir. $new_image;
        
        // if the requested thumnail file does not exist, then create one
        if (!file_exists($thumb_loc) || (filemtime($imagefile) > filemtime($thumb_loc))) {
           
           if(!is_writable($directory .$sub_dir))               
              return 'error: <'.$directory .$sub_dir.'> is not writable';           
           
           //========================================================
           
           $dst_img = imagecreatetruecolor($w, $h);
           
           /* Check if this image is PNG or GIF, then set transparency */ 
           if($type == 1 || $type==3){
              imagealphablending($dst_img, false);
              imagesavealpha($dst_img,true);
              //$transparent = imagecolorallocatealpha($dst_img, 255, 255, 255, 127);
              imagefilledrectangle($dst_img, 0, 0, $w, $h, IMG_COLOR_TRANSPARENT);
           } 
           
           
           if ($type == "1")
               $img = imagecreatefromgif($imagefile);
           elseif ($type == "2")
               $img = imagecreatefromjpeg($imagefile);  
           elseif($type == "3")
               $img = imagecreatefrompng($imagefile);
            
           imagecopyresampled($dst_img, $img, 0, 0, 0, 0, $w, $h, $width, $height);
           
           
           if ($type == "1")
               imagegif($dst_img, $thumb_loc);
           elseif ($type == "2")
               imagejpeg($dst_img, $thumb_loc, 100);  
           elseif($type == "3")
               imagepng($dst_img, $thumb_loc, 0);
            
           imagedestroy($dst_img);
           imagedestroy($img);
               
        }
        
        if($returnUrl) return base_url() . $thumb_loc;
           
    }


    function createThumb($image='', $folder='thumb', $new_width=190, $new_height=190, $keep_ratio=false, $new_filename = '')
    {              
        
        $imagefile='./uploads/'.$folder.'/'.$image;            
        list($width, $height, $type)  = getimagesize($imagefile);
        
        if($width>=$height){    
            @$ratio=($new_width/$width);
            if($keep_ratio){$new_height=round($height*$ratio);}
        }else{
            $ratio=($new_height/$height);
            if($keep_ratio){$new_width=round($width*$ratio);}
        }
        
        @$image_p = imagecreatetruecolor($new_width,$new_height);
    
        $directory = pathinfo($imagefile, PATHINFO_DIRNAME).'/'; 
        $filename  = pathinfo($imagefile, PATHINFO_FILENAME);  
        $ext       = '.'.pathinfo($imagefile, PATHINFO_EXTENSION);
        
        if ($type == "1")
            $img = @imagecreatefromgif($imagefile);
        elseif ($type == "2")
            $img = @imagecreatefromjpeg($imagefile);  
        elseif($type == "3")
            $img=@imagecreatefrompng($imagefile);
        
        imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        
        if($new_filename != '')
            $location = $new_filename;
        else
            $location="./uploads/".$folder.'/thumb/'.$filename.$ext;
        
        if ($type == "1")
            imagegif($image_p,$location);
        elseif ($type == "2")
            imagejpeg($image_p,$location, 100);  
        elseif($type == "3")
            imagepng($image_p,$location, 0);    
        
        imagedestroy($image_p);
        imagedestroy($img);
        
    }
}