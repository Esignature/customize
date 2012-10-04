<script type="text/javascript" src="<?=$path?>/js/jquery.image.js"></script>
<script type="text/javascript" src="<?=$library_folder?>ajaxupload/ajaxupload.js"></script>
<script type="text/javascript">
$(function() {
	var btnUpload	= $('#mineImageUpload');
	var status		= $('#upload_area');
	var upFolder	= $('#uploadPath');	// name of the field carrying all the image info.
	var folder		= 'uploads/';
	var maxsize		= upFolder.attr('maxSize');
 	var maxwidth	= upFolder.attr('maxWidth');
	var maxheight	= upFolder.attr('maxHeight');
	if(upFolder.val() != undefined){folder=upFolder.val();}
	
	new AjaxUpload(btnUpload, {
		action: '<?=base_url()?>index.php/uploader/index',
		name: 'uploadfile',
		data: {'myLocation':folder,'maxsize':maxsize,'maxwidth':maxwidth,'maxheight':maxheight},
		onSubmit: function(file, ext){
			 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
				// extension is not allowed 
				status.text('*Only JPG, PNG OR GIF files are allowed');
				return false;
			}
			status.css({'display':'none'}).html('<img src="<?=$path?>img/wait.gif" class="noborder" />').fadeIn('slow');
		},
		onComplete: function(file, response){
			//On completion clear the status
			status.text('');
			//Add uploaded file to list
			if(response==="error")
			{
				status.html('Unable to upload file');
			}
			else
			{
				$('#uploadedImageName').val(response);
				var adstr = '<img src="<?=base_url()?>uploads/'+response+'" width="160" class="just_uploaded_img" />';
				adstr += '<div class="uploadimgattr">Align &nbsp;&nbsp;&nbsp;<select id="selectAlign"><option value="">Default</option><option value="left">Left</option><option value="right">Right</option>';
				adstr += '</select><br /><br />Title &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="imgtitle" value="" size="32" /><br /><br />';
				adstr += '<button id="insertImg">Insert</button></div>';
				status.html(adstr);
			}
		}
	});
});
</script>
<script type="text/javascript" src="<?=$library_folder?>preloader/jquery.preloader.js"></script>