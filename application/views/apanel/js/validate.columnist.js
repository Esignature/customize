$(function(){
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Columnist\'s Name field can not be blank!'); elm.focus(); return false; }
		elm = $('#uploadedImageName1');
		if($.trim(elm.val()) == ''){ alert('Upload the image of the columnist!'); return false; }		
		// Second Tab
		$('ul.tab_link li:eq(1) a').trigger('click');
		//elm = $('#artists_value');
		//if($.trim(elm.val()) == ''){ alert('You have to select artist(s) in the interview!'); $('#artist_txt').focus(); return false; }
		elm = $('#full_content');
		elm.val(tinyMCE.get('full_content').getContent());
		if($.trim(elm.val()) == ''){ alert('Content field can not be blank!'); elm.focus(); return false; }
		// Third Tab
		$('ul.tab_link li:eq(2) a').trigger('click');
		elm = $('#posted_date');
		if($.trim(elm.val()) == ''){ alert('Select the published date.'); elm.focus(); return false; }
		
		$('#submit').trigger('click');
		return true;
	});
});