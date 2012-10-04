$(function(){
	
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Title field can not be blank!'); elm.focus(); return false; }
		elm = $('#track_txt');
		if($.trim(elm.val()) == ''){ alert('Enter the track only from the list!'); elm.focus(); return false; }
		
		elm = $('#full_content');
		elm.val(tinyMCE.get('full_content').getContent());
		
		$('#submit').trigger('click');
		return true;
	});
});