<script type="text/javascript" src="<?php echo $path;?>js/validate.package.js"></script>
<?php include('inc/uploader.php');?>
<script type="text/javascript" src="<?php echo base_url();?>application/libraries/tiny_mce/plugins/swampy_browser/sb.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>application/libraries/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">


     tinyMCE.init({
        mode : "exact",
        elements : "intro",
        theme : "advanced",
        skin : "o2k7",
        skin_variant : "silver",
        plugins : "safari,pagebreak,style,layer,table,advimage,advlink,emotions,iespell,insertdatetime,media,searchreplace,contextmenu,paste,directionality,noneditable,visualchars,nonbreaking,xhtmlxtras,inlinepopups",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor,|",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,|,sub,sup,|,charmap,media,|,attribs",
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
        file_browser_callback : "openSwampyBrowser",
        relative_urls : false,
        remove_script_host : false
    });
    
    
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
        file_browser_callback : "openSwampyBrowser",
        relative_urls : false,
        remove_script_host : false,
        width: "100%"
    });
    	
	
	$(function(){
	    
		var btnUpload=$('#upload1');
		var status=$('#status1');
		new AjaxUpload(btnUpload, {
			action: '<?=base_url()?>index.php/uploader/uploadnResize/imgname/100/100/0/0',
			name: 'imgname',
			data: {
                folder: 'package',
                fixed: false
            },
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|jpeg|png)$/.test(ext))){ 
					status.text('Only JPG files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				status.text('');
				if(response==="error"){
					status.html('Unable to upload file');
				}
				else{
					var sp = response.split('|');
					if(sp.length == 3){
						$('#uploadedImageName1').val(sp[0]);
                        $('#image_properties').val('0:0|0:0|0:0|');
						initCropping(1);
					}
				}
			}
		});
		
		currentMenu('Package', 'Package');
	});
</script>
<script type="text/javascript" src="<?=$path?>js/jquery.autocomplete.js"></script>
<link rel="stylesheet" href="<?=$path?>css/jquery.autocomplete.css" type="text/css" />
<ul id="buttons">
    <li class="todo_icon" title="Save Changes"><?=anchor('apanel', '<img src="'.$path.'img/save_32.png" alt="Save" />', array('class'=>'submitfrm'))?></li>
    <li class="todo_icon" title="Save and Add More"><?=anchor('apanel', '<img src="'.$path.'img/new.png" alt="Save" />', array('class'=>'addmorelink'))?></li>
    <li class="todo_icon" title="Cancel"><?=anchor('apanel/package', '<img src="'.$path.'img/block_32.png" alt="Cancel" />')?></li>
</ul>
<h2>Package Manager</h2>
<?php 
	echo $message; 
	echo validation_errors('<div class="fail curved8 hidden">', '</div>'); 
	echo form_open('apanel/package_form'.($form['record_id']>0?('/'.$form['record_id']):''), array('class'=>'form01'));    
?>
<div id="tabs">
    <ul class="tab_link">
      <li><a href="#tab-1">General</a></li>
      <li><a href="#tab-2">Meta Data</a></li>
      <li><a href="#tab-3">Properties</a></li>
    </ul>
    <div id="tab-1" class="tab_box">
    <p>
        <label for="pkg_name">Package Name *</label>
        <input name="pkg_name" type="text" class="input medium form_tip" title="Enter the name of your package." id="pkg_name" value="<?=set_value('pkg_name', $form['pkg_name'])?>" />
    </p>
    <p>
       <label>Slug (<a href="javascript:;" id="slugGenerator">Generate Slug</a>) *</label>
       <input name="slug" type="text" class="input medium slug form_tip" title="Enter the slug for the package.<br />Use alphanumeric characters only." id="slug" value="<?=set_value('slug', $form['slug'])?>" maxlength="80" />
       
       <span class="abt_info">This will be used to navigate through site.</span>
    </p>
    <p class="img_upload">
        <label>Image</label>
        <p id="upload1" class="curved5"><span>Upload Image<span></p> <div class="clear"></div>
        <span class="abt_info">This image will be used for the package list and thumbnail image. <br /><span style="color:red;">*You can upload only JPG image</span></span>
        <span id="status1" style="display:block;float:left;font:12px Arial, Helvetica, sans-serif;margin-top:10px;" >
            <?php
			    if( $form['image'] != '' && $form['has_image'] == 1){
					echo ' <img src="'.base_url().'uploads/package/thumb/'.$form['image_name'].'" alt="'.$form['image'].'" /> ';
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
        <label>Intro Text (if any)</label>
        <textarea name="intro" id="intro" rows="26" class="styled_textarea"><?=set_value('intro', $form['intro'])?></textarea>
        <span class="clear"></span>
    </p>    
    <p class="tinymce">
        <label>Content</label>
        <textarea name="full_content" id="full_content" rows="26" class="styled_textarea"><?=set_value('full_content', $form['full_content'])?></textarea>        
        <span class="clear"></span>
    </p>
    <p class="default_submit">
        <input type="submit" name="submit" value="Save" id="submit" />
    </p>
    </div><!-- end div #tab1 -->
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
        <span class="abt_info">Describe about this package in a sentence.</span>
    </p>
    </div>

    <div id="tab-3" class="tab_box">
    <p class="phalf">
        <label for="pkg_price">Package Price (<?=$form['pkg_currency']?>) *</label>
        <input name="pkg_price" type="text" class="input medium" id="pkg_price" value="<?=set_value('pkg_price', $form['pkg_price'])?>" />
        <span class="abt_info">Just input the price amount as 99 or 99.99. Do not enter any other characters. User 0 for free package.</span>
    </p>
    <p class="clear"></p>
    <p class="phalf">
        <label for="pkg_trial_period">Trial Period (Days)</label>
        <input name="pkg_trial_period" id="pkg_trial_period" type="text" class="input medium" value="<?=set_value('pkg_trial_period', $form['pkg_trial_period'])?>" />
        <span class="abt_info">Type in the no. of days allowed as trial period for the given package. Leave blank or set to 0 for no trial period provision.</span>
    </p>
    <p class="clear"></p>    
    <p class="phalf">
        <label>Package Services</label>
		<?php
		foreach($form['package_services'] as $srvc_id=>$pkg_name):
			$chk = $pkg_name[1] > 0 ? ' checked="checked"' : '';
		?>		
        <input name="pkg_services[<?=$srvc_id?>]" type="checkbox" id="pkg_services<?=$srvc_id?>" value="<?=$srvc_id?>" <?=$chk?> /> 
        <input name="pkg_service_value[<?=$srvc_id?>]" type="text" class="input medium mrg_btm2" id="pkg_service_value<?=$srvc_id?>" value="<?=$pkg_name[2]?>" /> 
        <?=$pkg_name[0]?>
        <br />
        <?endforeach;?>
        <span class="abt_info">Check the services that will be available under the package. You may enter the no. or texts like <u>Unlimited</u> <u>limited</u> etc.</span>
    </p>
    <p class="clear"></p>
    <p>
        <label for="featured">Is Free Trial Package?</label>
        <?php
        $ck1 = ' checked="checked" '; $ck2 = '';
        if($form['free_trial'] == 0){$ck2 = ' checked="checked" '; $ck1 = '';}
        ?>
        <input name="free_trial" type="radio" class="radio" id="rec1" value="1" <?=$ck1?> /> Yes
        <input name="free_trial" type="radio" class="radio" id="rec0" value="0" <?=$ck2?> /> No        
        <span class="abt_info">Check if the package is considered as Free Trial Package or not. This will work along with the price you defined. Set Price 0 for Free Package.</span>
    </p>
    <p>
        <label for="featured">Recommended</label>
        <?php
        $ck1 = ' checked="checked" '; $ck2 = '';
        if($form['featured'] == 0){$ck2 = ' checked="checked" '; $ck1 = '';}
        ?>
        <input name="featured" type="radio" class="radio" id="rec1" value="1" <?=$ck1?> /> Yes
        <input name="featured" type="radio" class="radio" id="rec0" value="0" <?=$ck2?> /> No        
        <span class="abt_info">Check if the package is either recommended or popular to the users.</span>
    </p>
    <p>
        <label for="status">Status</label>
        <?php
        $ck1 = ' checked="checked" '; $ck2 = '';
        if($form['status'] == 0){ $ck2 = ' checked="checked" '; $ck1 = '';}
        ?>
        <input name="status" type="radio" class="radio" id="status1" value="1" <?=$ck1?> /> On
        <input name="status" type="radio" class="radio" id="status0" value="0" <?=$ck2?> /> Off
        <span class="abt_info">Publish this package. Select now or later.</span>
    </p>
    <p>
        <label>Mark as Upgradable</label>
        <?php
        $ck1 = ' checked="checked" ';$ck2 = '';
        if($form['pkg_upgradable'] == 0){ $ck2 = ' checked="checked" '; $ck1 = '';}
        ?>
        <input name="pkg_upgradable" type="radio" class="radio" id="pkg_upgradable1" value="1" <?=$ck1?> /> Yes
        <input name="pkg_upgradable" type="radio" class="radio" id="pkg_upgradable0" value="0" <?=$ck2?> /> No
        <span class="abt_info">This will mark this package as upgradable.</span>
    </p>
    <p>
        <label>Mark as Downgradable</label>
        <?php
        $ck1 = ' checked="checked" ';$ck2 = '';
        if($form['pkg_downgradable'] == 0){ $ck2 = ' checked="checked" '; $ck1 = '';}
        ?>
        <input name="pkg_downgradable" type="radio" class="radio" id="pkg_downgradable1" value="1" <?=$ck1?> /> Yes
        <input name="pkg_downgradable" type="radio" class="radio" id="pkg_downgradable0" value="0" <?=$ck2?> /> No
        <span class="abt_info">This will mark this package as degradable.</span>
    </p>
    
    
    <div class="clear"></div>
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
			    echo anchor('apanel/package', '<img src="'.$path.'img/package.png" width="24" height="24" alt="List" />View All Packages');
				$cls = ($is_add) ? array('class'=>'active') : array();
				echo anchor('apanel/package_form', '<img src="'.$path.'img/package_add.png" width="24" height="24" alt="Add" />Add Package', $cls);
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
var maxW = <?=$pkg_mod_props['img_dim'][0]['x']?>;
var maxH = <?=$pkg_mod_props['img_dim'][0]['y']?>;

function initCropping(mod)
{
	$('#uploader_wrap, #uploader_bg').css('display', 'block');
	switch(mod){
	    <?php foreach($pkg_mod_props['img_dim'] as $ind=>$props){
           echo 'case '.($ind+1).': maxW = '. $props['x'] . '; maxH = '.$props['y'] .'; break;'."\n\t\t";
        }?>
	}
	var ratio = maxW+':'+maxH;
	var pos  = $('#image_properties').val();
	var poss = pos.split('|');
	var i = Number(mod)-1;
	var s = poss[i];
	var xny = s.split(':');
	
	var folder = '<?=base_url()?>uploads/package/';
	var file = folder + $('#uploadedImageName1').val();
	
	$('#crop_img_w').text(maxW);
	$('#crop_img_h').text(maxH);
	
	$('#selection_m').text(mod);
	$('#crop_img_location').text('package');
	$('#myImage').remove();
	$('#status1').html('');
	$('.img_holder').load(file, '', function(){
		    $('.img_holder').html('<img src="'+file+'" alt="Loading.." id="myImage" style="max-width:953px" />');
			$('#crop_selection').show();
			$('#myImage').imgAreaSelect({scaleX: 953, aspectRatio:ratio, hide:false, minWidth:maxW, minHeight:maxH, handles: "corners", x1: xny[0], y1: xny[1], x2: maxW, y2:maxH, outerOpacity:0.9,  show:true, persistent:true,  
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
		var m = Number($('#selection_m').text());
		var fld = $('#crop_img_location').text();
		var x = $('#selection_x').text();
		var y = $('#selection_y').text();
		var x2 = $('#selection_x2').text();
		var y2 = $('#selection_y2').text();
		var i = $('#uploadedImageName1').val();
		var img_w = $('#crop_img_w').text();
		var img_h = $('#crop_img_h').text();
		
		$('.img_holder').addClass('cropping').html(' <div style="height:200px;width:100%;">&nbsp;</div> ');
		$.ajax({
			type : 'POST',
			url  : '<?=base_url()?>index.php/uploader/cropImage/'+i+'/'+fld+'/'+x+'/'+y+'/'+x2+'/'+y2,
			data : 'crop=true&target_w='+img_w+'&target_h='+img_h,
			success : function (msg){
				if(msg == 'error'){
					alert('Unable to perform cropping! Try again.');
					initCropping(1);
				} else {
					var t = $('#image_properties').val(); //  x + ':' + y + '|';
					var st = t.split('|');
					
					<?php 
					$concat_prop = array();
					foreach($pkg_mod_props['img_dim'] as $ind=>$props){
                       echo "var p".($ind+1)." = (m == ".($ind+1).") ? x+':'+y+'|':st[".$ind."] + '|';\n\t\t\t\t\t";
                       $concat_prop[] = "p".($ind+1); 
                    }?>
					
					
					$('#image_properties').val(<?=join('+', $concat_prop)?>)
					
					if(m<<?=count($pkg_mod_props['img_dim'])?>){
						n = m-1;
						m = m+1;
						$('ul#crop_queue span.ckuck:eq('+n+')').addClass('ckonly');
						initCropping(m);
					} else{
						// done cropping!
						$('#uploader_wrap, #uploader_bg').css('display', 'none');
						$('#status1').html('<img src="<?=base_url()?>uploads/package/thumb/'+i+'" class="just_uploaded_img" /> <br /><span id="edit_img_crop">Edit thumbnail</span> ').show();
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
      <div id="crop_selection">crop</div>
      <div id="crop_img_location" style="display:none;"></div>
      <div id="crop_img_w" style="display:none;"></div>
      <div id="crop_img_h" style="display:none;"></div>
      <ul id="crop_queue">
          <?php foreach($pkg_mod_props['img_dim'] as $props){?>
          <li><span class="ckuck"></span> <?=$props['label']?> </li>
          <?php }?>
      </ul>
  </div>
  
  <span id="selection_m" class="hidden">1</span>
  <span id="selection_y" class="hidden">0</span>
  <span id="selection_x" class="hidden">0</span>
  <span id="selection_y2" class="hidden">0</span>
  <span id="selection_x2" class="hidden">0</span>
</div