<script type="text/javascript" src="<?php echo $path;?>js/validate.package.js"></script>
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

$(document).ready(function(){
	$('#active_from, #active_to').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: 'yy-mm-dd'
	});
	currentMenu('Content', 'Pages');
});
</script>

<ul id="buttons">
    <li class="todo_icon" title="Save Changes"><?=anchor('apanel', '<img src="'.$path.'img/save_32.png" alt="Save" />', array('class'=>'submitfrm'))?></li>
    <li class="todo_icon" title="Save and Add More"><?=anchor('apanel', '<img src="'.$path.'img/new.png" alt="Save" />', array('class'=>'addmorelink'))?></li>
    <li class="todo_icon" title="Cancel"><?=anchor('apanel/pages', '<img src="'.$path.'img/block_32.png" alt="Cancel" />')?></li>
</ul>
<h2>Page Manager</h2>
<?php 
	echo $message; 
	echo validation_errors('<div class="fail curved8 hidden">', '</div>'); 
	echo form_open('apanel/pages_form', array('class'=>'form01'));
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
        <span class="abt_info">This will be your page name.</span>
    </p>
    <p>
        <label>Slug</label>
        <input name="slug" type="text" class="input medium slug form_tip" title="Enter the slug for the news.<br />Use alphanumeric characters only." id="slug" value="<?=set_value('slug', $form['slug'])?>" maxlength="80" />
        <span class="abt_info">This will be used to navigate through site.</span>
    </p>
    <p class="tinymce">
        <label>Content</label>
        <textarea name="full_content" id="full_content" rows="26" class="styled_textarea"><?=set_value('full_content', $form['full_content'])?></textarea>
        <ul class="editor_helper">
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
        <span class="abt_info">Enter the name of the page creator.</span>
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
			    echo anchor('apanel/pages', '<img src="'.$path.'img/001_20.png" width="24" height="24" alt="List" />View all Pages');
				$cls = ($is_add) ? array('class'=>'active') : array();
				echo anchor('apanel/pages_form', '<img src="'.$path.'img/addpage.png" width="24" height="24" alt="Add" />Add Page', $cls);
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

<div class="curved5" id="image_cropper">
    <div class="img_wrapper">
        <div class="img_tools">
            <label class="title" w="416" h="231" title="Select the area in the image for slideshow."><span class="ckuck"></span>Slideshow 416x231px</label><br />
            <label class="title" w="210" h="175" title="Select the area in the image for listing page."><span class="ckuck"></span>List image 310x175px</label><br />
            <label class="title" w="145" h="85" title="Select the area in the image for thumbnail."><span class="ckuck"></span>Thumbnail 145x85px</label><br />
            <div class="img_btns"><span id="crop_selection">crop</span><span class="working">&nbsp;</span>
                <span id="selection_m" class="hidden">1</span>
                <span id="selection_y" class="hidden">0</span>
                <span id="selection_x" class="hidden">0</span>
            </div>
        </div>
        <div class="img_holder">
            <img src="<?=base_url()?>uploads/i_i.jpg" alt="Loading.." id="myImage" />
        </div>
        <div class="clear"></div>
    </div>
</div>