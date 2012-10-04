<?php

class Uploader extends CI_Controller
{	
	function __construct()
	{
		parent::__construct();
		$this->load->model('upload_model', 'upload');
	}
	
	/*
	* -- checkLogin >> checks if the user is logged in or not
	* -- returns the user's id if logged in.
	*/
	function checkLogin()
	{
		$this->adminid = get_cookie(APPID.'_admin');
		!$this->adminid && redirect('apanel/login', 'refresh');
		return $this->adminid;
	}
	
	function index()
	{
		$user_id = $this->checkLogin();
		
		if(!isset($_FILES['uploadfile']['name']))
		    die('INVALID ACCESS');
		
		// relocate the folder to be uploaded.
		$uploaddir  = $_REQUEST['myLocation'];
		
		$maxsize	= ($_REQUEST['maxsize'] == 'undefined'	|| $_REQUEST['maxsize'] == '') 	? 1048576 	: intval($_REQUEST['maxsize']);		// Max File Size 1MB = 1048576
        $maxwidth	= ($_REQUEST['maxwidth'] == 'undefined'	|| $_REQUEST['maxwidth'] == '')	? 1600 		: intval($_REQUEST['maxwidth']);
        $maxheight	= ($_REQUEST['maxheight'] == 'undefined'|| $_REQUEST['maxheight'] == '')? 800		: intval($_REQUEST['maxheight']);
		
		$imgsize = $_FILES['uploadfile']['size'];
		$file = $uploaddir . basename(strtolower($_FILES['uploadfile']['name']));

        // Rename file
		$curname = strtolower($_FILES['uploadfile']['name']);
		$myext 	 = explode('.', $curname);
		$length	 = count($myext);
		$filename = '';
		for($i=0;$i<($length-2);$i++)
		{
			$filename.= $myext[$i];
		}
		$temp_filename = 'i_'.rand(0,5000).time().'.'.$myext[$length-1];
		$file = $uploaddir.$temp_filename;

		$imgarray = 'jpg|jpeg|gif|png';
		$myext = explode('.', $file);
		$total = count($myext);

		if($imgsize > $maxsize && $myext[$total-1] != 'zip')
		{
			$this->alert('FILE SIZE LIMIT! You can upload file less than '.$this->myFileSize($maxsize).' only.');
			exit;
		}

		if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) 
		{ 
	  		if(file_exists($file) && preg_match("/".$myext[$total-1]."/", $imgarray))
	  		{
		  		// check height and width
		  		list($width, $height) = getimagesize($file);
		 
		  		if($width <= $maxwidth && $height <= $maxheight)
		  		{
					// Create a thumbnail as well.. 160x100 px
					$thumb_width  = 160;
					$thumb_height = 100;
					if($width > $thumb_width && $height > $thumb_height){
						$this->createThumb($temp_filename, '160x100', $thumb_width, $thumb_height);
					}
					
					if(file_exists('./uploads/160x100/'.$temp_filename))
					    echo '160x100/'.$temp_filename;
					else
					    echo $temp_filename;
					
					/*
					* INSERT INTO DATABASE
					*/
					$data['name']    = $temp_filename;
					$data['user_id'] = $user_id;
					$data['date']    = date('Y-m-d H:i:s');
					$data['u_id']    = md5(time().rand(1, 500000));
					$this->db->insert('tbl_uploads', $data);
			 		exit;
		  		}
		  		else
		  		{
			 		$error ='Image dimension should not exceed '.$maxwidth.'x'.$maxheight.'px!'; 
			 		@unlink($file);
			 		$this->alert($error);
			 		echo "error";exit;
		  		}
	  		}
  		    echo $temp_filename; 
		} 
		else  // unable to move uploaded file
		{
			echo "error";exit;
		}
    	exit;
    }
	
	/*
	* Upload from other sections.
	* has multi-upload feature.
	*/
	function upload($file_field='imgname')
	{
		$user_id = $this->checkLogin();
		
		if(!isset($_FILES[$file_field]['name']))
		    die('INVALID ACCESS');		
		
		// relocate the folder to be uploaded.
		$uploaddir  = './uploads/';
		$maxsize	= 1024 * 1024 * 2;		// Max File Size 2MB = 1048576
        $maxwidth	= 800;
        $maxheight	= 600;
		
		$imgsize    = $_FILES[$file_field]['size'];
		$file       = $uploaddir . basename(strtolower($_FILES[$file_field]['name']));

        // Rename file
		$curname = strtolower($_FILES[$file_field]['name']);
		$myext 	 = explode('.', $curname);
		$length	 = count($myext);
		$filename = '';
		for($i=0;$i<($length-2);$i++)
		{
			$filename.= $myext[$i];
		}
		$temp_filename = 'i_'.rand(0,5000).time().'.'.$myext[$length-1];
		$file = $uploaddir . $temp_filename;

		$imgarray = 'jpg|jpeg|gif|png';
		$myext = explode('.', $file);
		$total = count($myext);

		if(move_uploaded_file($_FILES[$file_field]['tmp_name'], $file)) 
		{ 
	  		if(file_exists($file) && preg_match("/".$myext[$total-1]."/", $imgarray))
	  		{
		  		// check height and width
		  		list($width, $height) = getimagesize($file);
		  		if($width > $maxwidth && $height > $maxheight)
		  		{
			 		// crop the image ...
					$this->createThumb($temp_filename, 'thumbs', $maxwidth, $maxheight);
			 		@unlink($file);
					// move the image from thumbs to root ..
					@copy('./uploads/thumbs/'.$temp_filename, './uploads/'.$temp_filename);
					@unlink('./uploads/thumbs/'.$temp_filename);
		  		}
	  		}
			$this->session->set_userdata('tmp_imgname', $temp_filename);
  		    echo $temp_filename.'|'.$width.'|'.$height;
		} 
		else  // unable to move uploaded file
		{
			echo "error";exit;
		}
    	exit;
    }
	
	function uploadnResize($file_field='imgname', $min_width=416, $min_height=231, $rz_width=0, $rz_height=0,$fixed=false,$folder="0")
	{
		$user_id = $this->checkLogin();
		
		if(!isset($_FILES[$file_field]['name']))
		    die('INVALID ACCESS');		
		
        
        if($this->input->post('folder')){
            $folder = $this->input->post('folder');
        }
        if($this->input->post('fixed')){
            $fixed = $this->input->post('fixed');
            $fixed =  $fixed=='false' ? false : true;
        }
        
		// relocate the folder to be uploaded.
		if($folder!="0"){
			$uploaddir  = './uploads/'.$folder."/";
		}else{
			$uploaddir  = './uploads/';
		}
		$maxsize	= 1024 * 1024 * 4;
		
		if($rz_width>0 && $rz_height>0){
			$maxwidth	= $rz_width; // 600
        	$maxheight	= $rz_height; // 480	
		}else{
			$maxwidth	= 800; // 600
        	$maxheight	= 500; // 480	
		}
		
		$imgsize    = $_FILES[$file_field]['size'];
		$file       = $uploaddir . basename(strtolower($_FILES[$file_field]['name']));

        // Rename file
		$curname = strtolower($_FILES[$file_field]['name']);
		$myext 	 = explode('.', $curname);
		$length	 = count($myext);
		$filename = '';
		for($i=0;$i<($length-2);$i++)
		{
			$filename.= $myext[$i];
		}
        
        $random = md5(rand(0,5000).time());
		$temp_filename_rs = $random.'.'.$myext[$length-1];
        $temp_filename = $random.'_orig.'.$myext[$length-1];
        
		$file = $uploaddir . $temp_filename;
		if($folder!="0"){
			$file = $uploaddir .$temp_filename;
		}
		$imgarray = 'jpg|jpeg|gif|png';
		$myext = explode('.', $file);
		$total = count($myext);
	
		if(move_uploaded_file($_FILES[$file_field]['tmp_name'], $file)) 
		{ 
	  		if(file_exists($file) && preg_match("/".$myext[$total-1]."/", $imgarray))
	  		{
		  		// check height and width
		  		list($width, $height) = getimagesize($file);			
				if($fixed && !$this->checkFixWH($min_width, $min_height, $width, $height)){
				    echo 'error';
				    @unlink($uploaddir.$temp_filename);
				    exit; 
                }
				
				if($min_width>0 && $min_height>0 && !$this->checkValidSize($min_width, $min_height, $width, $height)){
				    echo 'error';
				    @unlink($uploaddir.$temp_filename);
				    exit; 
                }
			
				
		  		if(($width > $maxwidth || $height > $maxheight) && $folder=="0")
		  		{
			 		// crop the image ... if size is too high..  reduce to the specified size..
					$this->createThumb($temp_filename, 'thumbs', $maxwidth, $maxheight);
			 		@unlink($file);
					// move the image from thumbs to root ..
					@copy('./uploads/'.$uploaddir.'/thumbs/'.$temp_filename, './uploads/'.$uploaddir.'/'.$temp_filename);
					@unlink('./uploads/'.$uploaddir.'/thumbs/'.$temp_filename);
		  		}
				// Resized image.. check for size again..
				list($width, $height) = getimagesize($file);
				if(!$this->checkValidSize($min_width, $min_height, $width, $height, true)){  echo 'error'; @unlink($file); exit; }
				
				$this->session->set_userdata('tmp_imgname', $temp_filename);
                
                // Keep a thumbnail of the original file for display in admin.                
                $this->load->library('image');
                $this->image->resize($uploaddir, $temp_filename, 180, 0, false, true);
                $this->image->resize($uploaddir, $temp_filename, 900, 0, false, true, '');
  		        echo $temp_filename_rs.'|'.$width.'|'.$height;
	  		}
		} 
		else  // unable to move uploaded file
		{
			echo "error";exit;
		}
    	exit;
    }
	
	function uploadnResizeBg($file_field='imgname_sub', $min_width=400, $min_height=200)
	{
		$user_id = $this->checkLogin();
		$uploaddir = "./uploads/theme_bg/";
		
		if(!isset($_FILES[$file_field]['name']))
		    die('INVALID ACCESS');		
		
		$maxsize	= 1024 * 1024 * 4;
		$maxwidth	= 1000; // 600
		$maxheight	= 800; // 480	
		
		$imgsize    = $_FILES[$file_field]['size'];
		$file       = $uploaddir . basename(strtolower($_FILES[$file_field]['name']));

        // Rename file
		$curname = strtolower($_FILES[$file_field]['name']);
		$myext 	 = explode('.', $curname);
		$length	 = count($myext);
		$filename = '';
		for($i=0;$i<($length-2);$i++)
		{
			$filename.= $myext[$i];
		}
		$temp_filename = 'i_'.rand(0,5000).time().'.'.$myext[$length-1];
		$file = $uploaddir . $temp_filename;

		$imgarray = 'jpg|jpeg|gif|png';
		$myext = explode('.', $file);
		$total = count($myext);

		if(move_uploaded_file($_FILES[$file_field]['tmp_name'], $file)) 
		{ 
	  		if(file_exists($file) && preg_match("/".$myext[$total-1]."/", $imgarray))
	  		{
		  		// check height and width
		  		list($width, $height) = getimagesize($file);							
				$this->session->set_userdata('tmp_imgname', $temp_filename);
  		        echo $temp_filename.'|'.$width.'|'.$height;
	  		}
		} 
		else  // unable to move uploaded file
		{
			echo "error";exit;
		}
    	exit;
    }
	
	function crop()
	{
		$user_id = $this->checkLogin();
		$ret = 'error';
		// get required params.
		if(isset($_POST) && $_POST['image'] != '')
		{
			$folder = 1;
			$image  = $_POST['image'];
			$mode   = $_POST['mode'];
			$width  = $_POST['width'];
			$height = $_POST['height'];
			$offx   = $_POST['offx'];
			$offy   = $_POST['offy'];
			
			switch($mode){
				case 1:
					$folder = '416x231'; // slideshow
					break;
				case 2:
					$folder = '310x175'; // list img
					break;
				case 3:
					$folder = '145x85'; // thumb img
					break;
				case 4:
					$folder = '278x264'; // thumb img
					break;
				case 5:
					$folder = '253x213'; // thumb img
					break;
				case 6:
					$folder = '222x172'; // thumb img
					break;
				case 7:
					$folder = '416x373'; // thumb img
					break;
			}
			if($this->resizeMyImage($image, $mode, $width, $height, $offx, $offy)){
				$ret = base_url().'uploads/'.$folder.'/'.$image;
			}
		}
		echo $ret;
	}
	
	function getImages()
	{
		$user_id = $this->checkLogin();
		
		// paginating....
		$this->load->library('pagination');
		$total                = $this->upload->count_all($user_id);
		$per_page             = 9;
        $config['base_url']   = base_url().'uploader/getImages';
        $config['total_rows'] = $total;
        $config['per_page']   = $per_page;
        $this->pagination->initialize($config);
        $pages  = $this->pagination->create_links();
		
		$query = $this->upload->find_all($user_id, $per_page, $this->uri->segment(3));
		
		$ret = '';
		$ret.= '<script type="text/javascript">$(document).ready(function(){$("#upimgcontainer").preloader()});</script>';
		$ret.= '<div id="show_img_uploader"><a href="#">Upload Image</a></div>';
		$ret.= '<ul>';
		foreach($query->result() as $row):
		  if(file_exists('uploads/'.$row->name))
		  {
			  if(file_exists('uploads/160x100/'.$row->name))
			  {
				 $img = base_url().'uploads/160x100/'.$row->name;  
			  }
			  else
			  {
			     $img = base_url().'uploads/'.$row->name;
			  }
		      $ret.= '<li style="background:url('.$img.') no-repeat center center;" id="my_image_'.$row->id.'" src="'.base_url().'uploads/'.$row->name.'">';
			  $ret.= '<div class="delete_uploadimg" imgid="'.$row->u_id.'">x</div>';
			  $ret.= '<div class="insert_up_imgs" name="'.$row->id.'">Insert</div></li>';
			  
		  }
		endforeach;
		$ret.= '</ul>';
		$ret.= '<div id="imgpaginate">'.$pages.'</div>';
        echo $ret;
	}
	
	function delete()
	{
		$user_id = $this->checkLogin();
		$msg = 'error';
		if(isset($_POST['action']) && $_POST['action'] == 'delete')
		{
			$id = $this->db->escape($_POST['id']);
			$chk = $this->upload->find_by_uid($id, $user_id);
			$row = $chk->row();
			if($chk)
			{
				$sql = "DELETE FROM tbl_uploads WHERE u_id=".$id;
				$this->db->query($sql);
				@unlink('uploads/'.$row->name);
				@unlink('uploads/160x100/'.$row->name);
				$msg = 'done';
			}
		}
		echo $msg;
	}
	
	//phpalert
    function alert($str='Message: ')
    {
	    $str = 'Message: '.$str;
	    echo '<script language="javascript">window.alert("'.$str.'");</script>';
    }
	
	function myFileSize($n=0)
    {
		$return = $n;
		if($n > 0)
	    {
		    $return = $n.' Bytes';
	    }
	    if($n > 1024)
	    {
		    $return = ceil($n/1024).' KB';
	    }
	    if($n > 1048576)
	    {
		    $return = ceil($n/1048576).' MB';
	    }
	    return $return;
	}
	
     
	function createThumb($image='', $folder='thumb', $new_width=190, $new_height=190, $keep_ratio=false)
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
	
	function thumbfix_WOrH($image='', $folder='thumbs', $new_width="0", $new_height="0",$fix="h")
	{
		$imagesize=getimagesize("./uploads/".$image);
		$width = $imagesize[0];
		$height = $imagesize[1];
		$type=$imagesize[2];
		
			if($fix=="h")
			{
				$ratio=($new_height/$height);
				$new_width=round($width*$ratio);
				//$new_height=190;
			}
			else if($fix=="w")
			{
				@$ratio=($new_width/$width);
				$new_height=round($height*$ratio);
			}	
		
		$imagefile="./uploads/".$image;
		list($width, $height) = getimagesize($imagefile);
		@$image_p = imagecreatetruecolor($new_width,$new_height);
		if ($imagesize[2] == "1")
		{
			$img = @imagecreatefromgif($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./uploads/".$folder.'/'.$thename;
			imagegif($image_p,$location, 100);
		}
		if ($imagesize[2] == "2")
		{
			$img = @imagecreatefromjpeg($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./uploads/".$folder.'/'.$thename;
			imagejpeg($image_p,$location, 100);
		}
		
		//png images support
		if($imagesize[2] == "3")
		{
			$img=@imagecreatefrompng($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			$location="./uploads/".$folder.'/'.$thename;
			@imagepng($image_p,$location, 100);
		}
	}
	
	function resizeMyImage($img='', $mode=1, $w=416, $h=231, $offx=0, $offy=0)
	{
		$ret = false;
		$fr_fld = '';
		$to_fld = '';
		switch($mode){
			case 1:
				$fr_fld = ''; 
				$to_fld = '416x231/';
				break;
			case 2:
				$fr_fld = '416x231/'; 
				$to_fld = '310x175/';
				break;
			case 3:
				$fr_fld = '310x175/'; 
				$to_fld = '145x85/';
				break;
			case 4:
				$fr_fld = ''; 
				$to_fld = '278x264/';
				break;
			case 5:
				$fr_fld = '278x264/'; 
				$to_fld = '253x213/';
				break;
			case 6:
				$fr_fld = ''; 
				$to_fld = '222x172/';
				break;
			case 7:
				$fr_fld = ''; 
				$to_fld = '416x373/';
				break;
		}
		
		$image = './uploads/'.$fr_fld.$img;
		$thumb = './uploads/'.$to_fld.$img;
		if(file_exists($image))
		{
			if(file_exists($thumb)){ @unlink($thumb); }
			
			list($width,$height) = getimagesize($image);
			$canvas         = imagecreatetruecolor($w, $h);
			$current_image  = imagecreatefromjpeg($image);
			@imagecopy($canvas, $current_image, 0, 0, $offx, $offy, $width, $height);
			@imagejpeg($canvas, $thumb, 100);
			$ret = true;
		}
		return $ret;
	}
	
	function galleryupload(){
		$w = 416;
		$h = 231;
		$uploaddir = './uploads/';
		$curname = strtolower($_FILES['uploadfile']['name']);
		$myext 	 = explode('.', $curname);
		$length	 = count($myext);
		$filename = '';
		for($i=0;$i<($length-2);$i++)
		{
			$filename.= $myext[$i];
		}
		$temp_filename = 'g_'.rand(0,5000).time().'.'.$myext[$length-1];
		$file = $uploaddir . $temp_filename;
		
		// check format..
		if($myext[$length-1] != 'jpg' && $myext[$length-1] != 'jpeg')
		{
			echo 'failure'; return;
		}
		
		$size=$_FILES['uploadfile']['size'];
		if($size > (1024 * 1024 * 4))
		{
			//$this->alert( "error file size > 4 MB" );
			@unlink($_FILES['uploadfile']['tmp_name']);
			echo 'failure'; return;
			exit;
		}
		if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
		    list($width, $height) = getimagesize($file);
			if($width < $w || $height < $h){
				@unlink($file);
				echo 'failure'; return;
			} else if($width > 800 || $height > 340){
				$this->createThumb($temp_filename, 'thumbs', 800, 640);
				@unlink($file);
				// move the image from thumbs to root ..
				@copy('./uploads/thumbs/'.$temp_filename, './uploads/'.$temp_filename);
				@unlink('./uploads/thumbs/'.$temp_filename);
				
                list($width, $height) = getimagesize($file);
				while($width >= $w && $height >= $h):
					$width--;
					$height--;
				endwhile;
				$this->createThumb($temp_filename, 'gallery', $width, $height);
			}
			list($width, $height) = getimagesize('./uploads/gallery/'.$temp_filename);
			echo $width.':'.$height.':'.$temp_filename;
		} else {
			echo 'failure'; return;
		}
	}
	
	function checkValidSize($min_width=431, $min_height=312, $width=0, $height=0, $checkResized=false){
		$ret = true;
		if($width < $min_height || $height < $min_height){
			$ret = false;
			
			if($checkResized)
			$this->alert("Image after resize got smaller than {$min_width}x{$min_height}px. \\nPlease use proper landscape image if possible.");
			else
			$this->alert("Image size can not be smaller than {$min_width}x{$min_height}px");
		}
		return $ret;
	}
	
	function resizeimg($img, $w, $h, $newfilename,$folder,$fixwh="") {
		
     //Get Image size info
     $imgInfo = getimagesize($img);
	
     switch ($imgInfo[2]) {
      case 1: $im = imagecreatefromgif($img); break;
      case 2: $im = imagecreatefromjpeg($img);  break;
      case 3: $im = imagecreatefrompng($img); break;
      //default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
     }
     
     //If image dimension is smaller, do not resize
     if ($imgInfo[0] <= $w && $imgInfo[1] <= $h) {
      $nHeight = $imgInfo[1];
      $nWidth = $imgInfo[0];
     }else{
                    //yeah, resize it, but keep it proportional
	
      if ($w/$imgInfo[0] > $h/$imgInfo[1]) {
       $nWidth = $w;
       $nHeight = $imgInfo[1]*($w/$imgInfo[0]);
      }else{
       $nWidth = $imgInfo[0]*($h/$imgInfo[1]);
       $nHeight = $h;
      }
	  
	  if($fixwh!="" && $fixwh=="h"){
		 $nWidth = $imgInfo[0]*($h/$imgInfo[1]);
       	 $nHeight = $h;
		}
	  else if($fixwh!="" && $fixwh=="w"){
			$nWidth = $w;
		   $nHeight = $imgInfo[1]*($w/$imgInfo[0]);
		}
	
     }
     $nWidth = round($nWidth);
     $nHeight = round($nHeight);
     
     $newImg = imagecreatetruecolor($nWidth, $nHeight);
     
     /* Check if this image is PNG or GIF, then set if Transparent*/  
     if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
      imagealphablending($newImg, false);
      imagesavealpha($newImg,true);
      $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
      imagefilledrectangle($newImg, 0, 0, $nWidth, $nHeight, $transparent);
     }
     imagecopyresampled($newImg, $im, 0, 0, 0, 0, $nWidth, $nHeight, $imgInfo[0], $imgInfo[1]);
     
     //Generate the file, and rename it to $newfilename
     switch ($imgInfo[2]) {
      case 1: imagegif($newImg,SITE_PATH.'uploads/'.$folder.'/'.$newfilename); break;
      case 2: imagejpeg($newImg,SITE_PATH.'uploads/'.$folder.'/'.$newfilename);  break;
      case 3: imagepng($newImg,SITE_PATH.'uploads/'.$folder.'/'.$newfilename); break;		
    //  default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
     }
       
       return $newfilename;
    }
	
	function resizeme($img,$folder,$w,$h,$fixwh=""){
		
		$newfilename=$img;
		$img=SITE_PATH."uploads/".$img;
		self::resizeimg($img, $w, $h, $newfilename,$folder,$fixwh);
		
	}
	
	// Logged in User's Profile image..
	function uploadUserProfile($id=0, $file_field='imgname', $min_width=110, $min_height=110)
	{
		if(!isset($_FILES[$file_field]['name']))
		    die('INVALID ACCESS');		
		
		// relocate the folder to be uploaded.
		$uploaddir  = './uploads/user/';
		$maxsize	= 1024 * 1024 * 1;
        $maxwidth	= 800; // 600
        $maxheight	= 500; // 480
		
		$imgsize    = $_FILES[$file_field]['size'];
		$file       = $uploaddir . basename(strtolower($_FILES[$file_field]['name']));

        // Rename file
		$curname = strtolower($_FILES[$file_field]['name']);
		$myext 	 = explode('.', $curname);
		$length	 = count($myext);
		$filename = '';
		for($i=0;$i<($length-2);$i++)
		{
			$filename.= $myext[$i];
		}
		$temp_filename = 'profile_'.$id.'.'.$myext[$length-1];
		$file = $uploaddir . $temp_filename;

		$imgarray = 'jpg|jpeg|gif|png';
		$myext = explode('.', $file);
		$total = count($myext);

		if(move_uploaded_file($_FILES[$file_field]['tmp_name'], $file)) 
		{ 
	  		if(file_exists($file) && preg_match("/".$myext[$total-1]."/", $imgarray))
	  		{
		  		// check height and width
		  		list($width, $height) = getimagesize($file);
				if(!$this->checkValidSize($min_width, $min_height, $width, $height)){  echo 'error';exit; }
				
		  		if($width > $maxwidth || $height > $maxheight)
		  		{
			 		// crop the image ... if size is too high..  reduce to the specified size..
					//$this->createThumb('user/'.$temp_filename, 'temp', $maxwidth, $maxheight);
					$this->createUserThumb($temp_filename, 'user/temp', $maxwidth, $maxheight);
			 		@unlink($file);
					// move the image from thumbs to root ..
					@copy('./uploads/user/temp/'.$temp_filename, './uploads/user/'.$temp_filename);
					@unlink('./uploads/user/temp/'.$temp_filename);
		  		}
				// Resized image.. check for size again..
				//list($width, $height) = getimagesize($file);
				//if(!$this->checkValidSize($min_width, $min_height, $width, $height)){  echo 'error'; @unlink($file); exit; }
				
  		        //echo $temp_filename.'|'.$width.'|'.$height;
				echo base_url().'uploads/user/'.$temp_filename.'||--||wnh';
	  		}
		} 
		else  // unable to move uploaded file
		{
			echo "error";exit;
		}
    	exit;
	}
	
	function createUserThumb($image='', $folder='thumbs', $new_width=190, $new_height=190)
	{
		$imagesize=getimagesize("./uploads/user/".$image);
		$width  = $imagesize[0];
		$height = $imagesize[1];
		$type   = $imagesize[2];
		
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
		
		$imagefile="./uploads/user/".$image;
		list($width, $height) = getimagesize($imagefile);
		@$image_p = imagecreatetruecolor($new_width,$new_height);
		if ($imagesize[2] == "1")
		{
			$img = @imagecreatefromgif($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./uploads/".$folder.'/'.$thename;
			imagegif($image_p,$location, 100);
		}
		if ($imagesize[2] == "2")
		{
			$img = @imagecreatefromjpeg($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			//$thenames="thumb$thename";
			$location="./uploads/".$folder.'/'.$thename;
			imagejpeg($image_p,$location, 100);
		}
		
		//png images support
		if($imagesize[2] == "3")
		{
			$img=@imagecreatefrompng($imagefile);
			imagecopyresampled($image_p, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			$thename=$image;
			$location="./uploads/".$folder.'/'.$thename;
			imagepng($image_p,$location, 100);
		}
	}
		function checkFixWH($min_width=20, $min_height=20, $max_width=1, $max_height=1){
		$ret = true;
		if($min_width != $max_width && $min_height != $max_height){
			$ret = false;
			$this->alert("Image should be fixed size of  {$min_width}x{$min_height}px.");
		}
		return $ret;
	}

    /*
	* Image uploading function
	* Upload Scale, resize and crop image
	*/
	public function cropImage($main_file='', $folder='', $offx1=0, $offy1=0, $offx2=0, $offy2=0)
	{
		$ret = 'error';
		if($main_file!='' && $folder!='' && $offx2>$offx1 && $offy2>$offy1)
		{
			// get the fodler name and new dimension..
			$width     = $offx2 - $offx1;
			$height    = $offy2 - $offy1;
			$new_width = $this->input->post('target_w');
			$new_height= $this->input->post('target_h');
			$image     = './uploads/'.$folder.'/'.$main_file;
			$directory = pathinfo($image, PATHINFO_DIRNAME).'/'; 
            $filename  = pathinfo($image, PATHINFO_FILENAME);  
            $ext       = '.'.pathinfo($image, PATHINFO_EXTENSION);
			$thumb     = $directory.$filename.'_'.$new_width.'x'.$new_height.$ext;
			
			// First crop the original image to specified dimension
			// Then resize the cropped image and place it to specified folder
            if(file_exists($image))
	        {
				if(file_exists($thumb)){ @unlink($thumb); }
				
				$imgInfo = getimagesize($image);
				$canvas  = imagecreatetruecolor($width, $height);
				
                switch ($imgInfo[2]) {
                      case 1: $im = imagecreatefromgif($image); break;
                      case 2: $im = imagecreatefromjpeg($image);  break;
                      case 3: $im = imagecreatefrompng($image); break;
                      default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
                }
                
                /* Check if this image is PNG or GIF, then set if Transparent*/  
                if(($imgInfo[2] == 1) OR ($imgInfo[2]==3)){
                     imagealphablending($canvas, false);
                     imagesavealpha($canvas,true);
                     //$transparent = imagecolorallocatealpha($canvas, 255, 255, 255, 127);
                     imagefilledrectangle($canvas, 0, 0, $width, $height, IMG_COLOR_TRANSPARENT);
                }
                
                @imagecopy($canvas, $im, 0, 0, $offx1, $offy1, $width, $height);
				                
                //Generate the file, and rename it to $newfilename
                switch ($imgInfo[2]) {
                    case 1: imagegif($canvas, $thumb); break;
                    case 2: imagejpeg($canvas, $thumb, 100);  break;
                    case 3: imagepng($canvas, $thumb, 0); break;
                    default:trigger_error('Failed resize image!', E_USER_WARNING);  break;
                }
				
			    //@unlink('./uploads/temp/'.$main_file);
				$ret = 'done';
			}
			// ELSE >> no image found
		}
		echo $ret;
	}	
	
	function createCroppedThumb($image='', $folder='thumbs', $new_width=190, $new_height=190, $break_name=false, $keep_ratio=false)
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
        $location="./uploads/cache/".$folder.'/'.$filename.$ext;
        
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