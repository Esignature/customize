$(function(){
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#posted_date');
		if($.trim(elm.val()) == ''){ alert('Select the date for your album.'); elm.focus(); return false; }
		elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Title field can not be blank!'); elm.focus(); return false; }
		$('#submit').trigger('click');
		return true;
	});
});