<script type="text/javascript" src="<?php echo $path;?>js/validate.news.js"></script>
<?php
include('inc/uploader.php');
?>
<script type="text/javascript" src="<?php echo base_url();?>application/libraries/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "exact",
		elements : "full_content",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "safari,pagebreak,style,layer,save,table,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,|",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,media,|,fullscreen,attribs",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,
		content_css : "<?php echo base_url()."css/wysiwyg.css";?>",
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		relative_urls : false,
		remove_script_host : false,
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	$(function(){
		var btnUpload=$('#upload1');
		var status=$('#status1');
		new AjaxUpload(btnUpload, {
			action: '<?=base_url()?>index.php/uploader/uploadnResize',
			name: 'imgname',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|jpeg)$/.test(ext))){ 
					status.text('Only JPG files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				status.text('');
				if(response==="error")
				{
					status.html('Unable to upload file');
				}
				else
				{
					var sp = response.split('|');
					if(sp.length == 3){
						$('#uploadedImageName1').val(sp[0]);
                        $('#image_properties').val('0:0|0:0|0:0|');
						initCropping(1);
					}
				}
			}
		});
		$('#active_from, #active_to').datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'yy-mm-dd'
		});
		currentMenu('Content', 'News');
	});
</script>
<script type="text/javascript" src="<?=$path?>js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="<?=$path?>css/jquery.autocomplete.css" type="text/css" />

<ul id="buttons">
    <li class="todo_icon" title="Save Changes"><?=anchor('apanel', '<img src="'.$path.'img/save_32.png" alt="Save" />', array('class'=>'submitfrm'))?></li>
    <li class="todo_icon" title="Save and Add More"><?=anchor('apanel', '<img src="'.$path.'img/new.png" alt="Save" />', array('class'=>'addmorelink'))?></li>
    <li class="todo_icon" title="Cancel"><?=anchor('apanel/news', '<img src="'.$path.'img/block_32.png" alt="Cancel" />')?></li>
</ul>
<h2>News Manager</h2>
<?php 
	echo $message; 
	echo validation_errors('<div class="fail curved8 hidden">', '</div>'); 
	echo form_open('apanel/news_form', array('class'=>'form01'));
?>
<div id="tabs">
    <ul class="tab_link">
      <li><a href="#tab-1">General</a></li>
      <li><a href="#tab-2">Meta Data</a></li>
      <li><a href="#tab-3">Properties</a></li>
    </ul>
    <div id="tab-1" class="tab_box">
    <p>
        <label>Title</label>
        <input name="title" type="text" class="input medium form_tip" title="Enter the title of your news." id="title" value="<?=set_value('title', $form['title'])?>" />
        <span class="abt_info">This appears at your browser's title bar.</span>
    </p>
    <p>
        <label>Slug</label>
        <input name="slug" type="text" class="input medium slug form_tip" title="Enter the slug for the news.<br />Use alphanumeric characters only." id="slug" value="<?=set_value('slug', $form['slug'])?>" maxlength="80" />
        <span class="abt_info">This will be used to navigate through site.</span>
    </p>
    <p class="img_upload">
        <label>Image</label>
        <p id="upload1" class="curved5"><span>Upload Image<span></p> <div class="clear"></div>
        <span class="abt_info">This image will be used for the news list and thumbnail image. <br /><span style="color:red;">*You can upload only JPG image</span></span>
        <span id="status1" style="display:block;float:left;font:12px Arial, Helvetica, sans-serif;margin-top:10px;" >
            <?php
			    if( $form['image'] != '' && $form['has_image'] == 1){
					echo ' <img src="'.base_url().'uploads/416x231/'.$form['image_name'].'" alt="'.$form['image'].'" /> ';
					echo ' <br /><span id="edit_img_crop">Edit thumbnail</span>';
				}
			?>
            <div class="clear"></div>
        </span>
        <div class="clear"></div> 
            <input type="hidden" name="uploadedImageName1" id="uploadedImageName1" value="<?=$form['image_name'];?>" />
            <input type="hidden" name="image_properties" id="image_properties" value="<?=$form['image_properties'];?>" />
    </p>
    <p class="tinymce">
        <label>Content</label>
        <textarea name="full_content" id="full_content" rows="26" class="styled_textarea"><?=set_value('full_content', $form['full_content'])?></textarea>
        <ul class="editor_helper">
          <li> <a href="#" id="insert_read_more">Insert Read More</a> </li>
          <li><?=anchor('#', 'Upload Image', array('id'=>'insert_image'))?></li>
          <li><?=anchor('#', 'My Images', array('id'=>'list_image'))?></li>
        </ul>
        <span class="clear"></span>
    </p>
    <p class="default_submit">
        <input type="submit" name="submit" value="Save" id="submit" />
    </p>
    </div><!--  end div #tab1 -->
    <!--  END TAB 1 -->
    
    <div id="tab-2" class="tab_box">
    <p>
        <label>Artists in this news</label>
        <input type="text" name="artist" id="artist_txt" class="input medium form_tip" /> 
        <img src="<?=$path?>img/accept.png" id="insert_artist" alt="Add Artist" class="todo_icon" title="Click to add the artist to the news." />
        <span class="abt_info">Enter the name of the artist and select from the artist from suggestion box.</span>
        <input type="hidden" name="artist_value" id="artists_value" value="" />
        <input type="hidden" name="temp_artist" id="temp_artist" value="0" />
        <p>
       <ul class="current_artist"><?=$form['artist']?></ul>
        <div class="clear"></div>
   </p>
    </p>
    <p>
        <label>Tags</label>
        <input type="text" name="tags" id="tags_txt" class="input medium form_tip" /> 
        <img src="<?=$path?>img/accept.png" id="insert_tag" alt="Add Tag" class="todo_icon" title="Click to Add the tag." />
        <span class="abt_info">Enter the tags for the news, so that we can show the related news.</span>
        <input type="hidden" name="tags_value" id="tags_value" value="" />
    </p>
    <p>
       <ul class="current_tags"><?=$form['tags']?></ul>
        <div class="clear"></div>
   </p>
    <p>
        <label>Meta Keywords</label>
        <textarea name="meta_key" cols="70" rows="2" class="styled_textarea"><?=set_value('meta_key', $form['meta_key'])?></textarea>
        <span class="abt_info">Keywords will be used for SEO purpose.</span>
    </p>
    <p>
        <label>Meta Description</label>
        <textarea name="meta_desc" cols="70" rows="2" class="styled_textarea"><?=set_value('meta_desc', $form['meta_desc'])?></textarea>
        <span class="abt_info">Describe about this news in a sentence.</span>
    </p>
    </div>

    <div id="tab-3" class="tab_box">
    <p class="phalf">
        <label>Publish From</label>
        <input name="active_from" id="active_from" type="text" class="input medium" value="<?=set_value('active_from', $form['active_from'])?>" />
    </p>
    <p class="phalf">
        <label>Publish To</label>
        <input name="active_to" type="text" class="input medium" id="active_to" value="<?=set_value('active_top', $form['active_to'])?>" />
    </p>
    <div class="clear"></div>
    <p>
        <label>Author</label>
        <input name="author" type="text" class="input medium" id="author" value="<?=set_value('author', $form['author'])?>" />
        <span class="abt_info">Enter the name of the news writer.</span>
    </p>
    <p>
<?php
$ck1 = ' checked="checked" ';
$ck2 = '';
if($form['status'] == 0){
	$ck2 = ' checked="checked" ';
    $ck1 = '';
}
?>
        <label>Status</label>
        <input name="status" type="radio" class="radio" id="status1" value="1" <?php echo $ck1; ?> />
        On
        <input name="status" type="radio" class="radio" id="status0" value="0" <?php echo $ck2; ?> />
        Off
        <span class="abt_info">Publish this news. Select now or later.</span>
    </p>
    <p>
        <label>Mark as Featured</label>
<?php
$ck1 = ' checked="checked" ';
$ck2 = '';
if($form['featured'] == 0){
	$ck2 = ' checked="checked" ';
    $ck1 = '';
}
?>
        <input name="featured" type="radio" class="radio" id="featured1" value="1" <?php echo $ck1; ?> />
        Featured
        <input name="featured" type="radio" class="radio" id="featured0" value="0" <?php echo $ck2; ?> />
        Common
        <span class="abt_info">This will mark this news as featured.</span>
    </p>
    <p>
        <label>Use image for slideshow</label>
<?php
$ck1 = ' checked="checked" ';
$ck2 = '';
if($form['slideshow'] == 0){
	$ck2 = ' checked="checked" ';
    $ck1 = '';
}
?>
        <input name="slideshow" type="radio" class="radio" id="slideshow1" value="1" <?php echo $ck1; ?> />
        Yes
        <input name="slideshow" type="radio" class="radio" id="slideshow0" value="0" <?php echo $ck2; ?> />
        Not now
        <span class="abt_info">This will use it's image for slideshow.</span>
    </p>
    
    </div>
    </div>
<input type="hidden" name="record_id" id="record_id" value="<?=$form['record_id']?>" />
<input type="hidden" name="post_task" id="post_task" value="0" />
    </form>
    <!--  END TABS -->
    </div>
    <div id="sidebar">
        <ul>
            <?php
			    echo anchor('apanel/news', '<img src="'.$path.'img/001_20.png" width="24" height="24" alt="List" />View all news');
				$cls = ($is_add) ? array('class'=>'active') : array();
				echo anchor('apanel/news_form', '<img src="'.$path.'img/addpage.png" width="24" height="24" alt="Add" />Add news', $cls);
			?>
        </ul>
   </div>

<div id="swfupload-control" class="curved5">
    <div id="closebtn">X</div>
	<p class="uploadnotice">Upload an image file(jpg, png, gif). Maximum file size of 1MB </p>
    <div id="view_my_img_div"><a href="#" id="view_my_images">View Images</a></div>
    <div id="mineImageUpload" class="mineImageUpload"><span>Select file to Upload!</span></div>
    <input type="hidden" name="uploadPath" id="uploadPath" value="uploads/" maxWidth="1600" maxHeight="1200" maxSize="1048576" ><br />
    <div id="upload_area"></div>
    <input type="hidden" name="uploadedImageName" id="uploadedImageName" value="" />
</div>
<div id="upload_imglist" class="curved5">
    <div id="closebtn1">X</div>
	<div id="upimgcontainer"></div>
    <div class="clear"></div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo $library_folder?>crop/css/imgareaselect-default.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $library_folder?>crop/css/examples.css" />
<script type="text/javascript" src="<?php echo $library_folder?>crop/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript">
var maxW = 416;
var maxH = 231;
function initCropping(mod)
{
	$('#uploader_wrap, #uploader_bg').css('display', 'block');
	switch(mod){
		case 2:
		  maxW = 310;
		  maxH = 175;
		  break;
		case 3:
		  maxW = 145;
		  maxH = 85;
		  break;
		case 1:
		  maxW = 416;
		  maxH = 231;
		  break;
	}
	var ratio = maxW+':'+maxH;
	var pos  = $('#image_properties').val();
	var poss = pos.split('|');
	var i = Number(mod)-1;
	var s = poss[i];
	var xny = s.split(':');
	
	var folder = '<?=base_url()?>uploads/';
	var file = folder + $('#uploadedImageName1').val();
	$('#selection_m').text(mod);
	$('#crop_img_location').text(maxW+'x'+maxH);
	$('#myImage').remove();
	$('#status1').html('');
	$('.img_holder').load(file, '225', function(){
		    $('.img_holder').html('<img src="'+file+'" alt="Loading.." id="myImage" />');
			$('#crop_selection').show();
			$('#myImage').imgAreaSelect({aspectRatio:ratio, hide:false, minWidth:maxW, minHeight:maxH, handles: "corners", x1: xny[0], y1: xny[1], x2: maxW, y2:maxH, outerOpacity:0.9,  show:true, persistent:true,  
		  onSelectEnd: function (img, selection) { 
			$('#selection_x').text(selection.x1);
			$('#selection_y').text(selection.y1);
			$('#selection_x2').text(selection.x2);
			$('#selection_y2').text(selection.y2);
		      }
	      });
	});
}

$(function () {
	$('#uploader_cancel').click(function(){
		if(confirm('Cancel cropping?'))
		{
			$('#crop_selection').hide();
		    $('#myImage').imgAreaSelect({ hide:true});
			$('#uploader_wrap, #uploader_bg').css('display', 'none');
		}
	});
	$('#edit_img_crop').live('click', function(){
		initCropping(1);
	});
	$('#crop_selection').click(function(){
		$('#crop_selection').hide();
		$('#myImage').imgAreaSelect({ hide:true});
		$('.img_holder').addClass('cropping').html(' <div style="height:200px;width:100%;">&nbsp;</div> ');
		var m = Number($('#selection_m').text());
		var fld = $('#crop_img_location').text();
		var x = $('#selection_x').text();
		var y = $('#selection_y').text();
		var x2 = $('#selection_x2').text();
		var y2 = $('#selection_y2').text();
		var i = $('#uploadedImageName1').val();
		$('.img_holder').addClass('cropping').text(' ');
		$.ajax({
			type : 'POST',
			url  : '<?=base_url()?>index.php/uploader/cropImage/'+i+'/'+fld+'/'+x+'/'+y+'/'+x2+'/'+y2,
			data : 'crop=true',
			success : function (msg){
				if(msg == 'error'){
					alert('Unable to perform cropping! Try again.');
					initCropping(1);
				} else {
					var t = $('#image_properties').val(); //  x + ':' + y + '|';
					var st = t.split('|');
					var p1 = (m == 1) ? x+':'+y+'|' : st[0] + '|';
					var p2 = (m == 2) ? x+':'+y+'|' : st[1] + '|';
					var p3 = (m == 3) ? x+':'+y+'|' : st[2] + '|';
					$('#image_properties').val(p1+p2+p3)
					
					if(m<3){
						n = m-1;
						m = m+1;
						$('ul#crop_queue span.ckuck:eq('+n+')').addClass('ckonly');
						initCropping(m);
					} else{
						// done cropping!
						$('#uploader_wrap, #uploader_bg').css('display', 'none');
						$('#status1').html('<img src="<?=base_url()?>uploads/416x231/'+i+'" class="just_uploaded_img" /> <br /><span id="edit_img_crop">Edit thumbnail</span> ').show();
						$('.ckuck').removeClass('ckonly');
					}
				}
				$('.working').hide();
			}
		});
		$('.img_holder').removeClass('cropping').text(' ');
	});
});
</script>



<div id="uploader_bg"></div>
<div id="uploader_wrap" class="curved5">
      <div id="uploader_cancel">close</div>
      <div class="img_holder">
          <img src="<?=base_url()?>uploads/i_i.jpg" alt="Loading.." id="myImage" />
      </div>
      <div class="upload_info">Adjust the corners of the selection area to crop your image and press crop button.</div>
  <div id="uploader_status" class="progressing">
      <div id="crop_selection">crop</div><div id="crop_img_location" style="display:none;"></div>
      <ul id="crop_queue">
          <li><span class="ckuck"></span> Slideshow 416x231px </li>
          <li><span class="ckuck"></span> List image 310x175px </li>
          <li><span class="ckuck"></span> Thumbnail 145x85px </li>
      </ul>
  </div>
  
  <span id="selection_m" class="hidden">1</span>
  <span id="selection_y" class="hidden">0</span>
  <span id="selection_x" class="hidden">0</span>
  <span id="selection_y2" class="hidden">0</span>
  <span id="selection_x2" class="hidden">0</span>
</div>



<script type="text/javascript">
    $("#tags_txt").autocomplete(
      base_url()+'index.php/ajax/getSuggestion/',
      {
			matchContains: true,
		    maxItemsToShow:10,
		    selectFirst: false
  	 }
    );
	$("#artist_txt").autocomplete(
      base_url()+'index.php/ajax/getArtistSuggestion/',
      {
			matchContains: true,
			mustMatch: false,
			selectFirst: false
  		}
    );
	$("#artist_txt").result(function(event, data, formatted) {
		$('#temp_artist').val(data[1]);
	});
</script>