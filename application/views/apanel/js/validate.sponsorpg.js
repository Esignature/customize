$(function(){
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#pg_id');
		if($.trim(elm.val()) == ''){ alert('You must select page field!'); elm.focus(); return false; }
		
		elm = $('#block_id');
		if($.trim(elm.val()) == ''){ alert('You must select block field!'); elm.focus(); return false; }
		
		/*if($('#pg_id').val()!='homepage'){
			elm = $('#method');
			if($.trim(elm.val()) == ''){ alert('You must select method field!'); elm.focus(); return false; }
		}*/
		elm = $('#sp_id');
		if($.trim(elm.val()) == ''){ alert('You must select sponsor field!'); elm.focus(); return false; }
		
		$('#submit').trigger('click');
		return true;
	});
});