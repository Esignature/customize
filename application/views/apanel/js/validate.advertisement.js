$(function(){
	$('form.form01').submit(function(){
		
		
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Title field can not be blank!'); elm.focus(); return false; }
		elm = $('#location');
		if($.trim(elm.val()) == ''){ alert('You must select location!'); elm.focus(); return false; }
		$('#submit').trigger('click');
		return true;
	});
	
	/*$('.location_adv').click(function(){
		var sizew=$(this).attr('sizew');
		var sizeh=$(this).attr('sizeh');
		var thisval=$(this).val();
		
	});*/
});