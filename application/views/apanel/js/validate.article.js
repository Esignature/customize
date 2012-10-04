$(function(){
	
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Title field can not be blank!'); elm.focus(); return false; }
		elm = $('#uploadedImageName1');
		if($.trim(elm.val()) == ''){ alert('Upload the image for the article!'); return false; }
		elm = $('#full_content');
		elm.val(tinyMCE.get('full_content').getContent());
		if($.trim(elm.val()) == ''){ alert('Content field can not be blank!'); elm.focus(); return false; }
		
		$('#submit').trigger('click');
		return true;
	});
});