$(function(){
	
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		/*elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Title field can not be blank!'); elm.focus(); return false; }*/
		
	elm = $('#video');
		if($.trim(elm.val()) == ''){ alert('Video url field can not be blank!'); elm.focus(); return false; }
		
		$('#submit').trigger('click');
		return true;
	});
});