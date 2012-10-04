$(function(){
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#title');
		if($.trim(elm.val()) == ''){ alert('Question field can not be blank!'); elm.focus(); return false; }
		// check if it contains at least two options..
		var count = 0;
		$('.optional_opt').each(function(){
			var tval = $.trim($(this).val());
			if(tval != ''){
				count++;
			}
		});
		if(count < 2){
			alert('You should provide at least two options!');
			return false;
		}
		
		$('ul.tab_link li:eq(1) a').trigger('click');
		elm = $('#active_from');
		if($.trim(elm.val()) == ''){ alert('Select Poll publish date from!'); elm.focus(); return false; }
		var date_frm_val = Date.parse($.trim(elm.val()));
		elm = $('#active_to');
		if($.trim(elm.val()) == ''){ alert('Select Poll publish date to!'); elm.focus(); return false; }
		var date_to_val = Date.parse($.trim(elm.val()));
		
		if(date_frm_val > date_to_val){
			alert('Invalid publish date range selected! PUBLISH FROM date can not surpass PUBLISH TO date.');
			elm.focus();return false;
		}
		
		$('#submit').trigger('click');
		return true;
	});
	
	$('.optional_opt').each(function(){ checkOptional( $(this) ); });
	$('.optional_opt').keyup(function(){ checkOptional( $(this) ); });
	$('.optional_opt').keyup(function(){ checkPosition($(this)); });
	$('.optional_opt').focus(function(){ checkOptional( $(this) ); });
	$('.optional_opt').blur(function(){ checkOptional( $(this) ); });
});
function serial_number(){
	var ind = 1;
	$('.serial_no').each(function(){
		$(this).text(ind + '. ');
		ind++;
	});
}
function checkOptional(t){
	var v = $.trim(t.val());
	if(v == ''){
		t.prev().css('color', 'silver');
	} else {
		t.prev().css('color', '#666666');
	}
}
function checkPosition(t){
	var ind = $(".optional_opt").index(t);
	checkOptional(t);
	var def = t.val();
	t.val('');
	for(i=0; i<ind; i++){
		var val = $.trim($('.optional_opt:eq('+i+')').val());
		if(val == ''){
			ind = i;
			break;
		}
	}
	$('.optional_opt:eq('+ind+')').val( def ).focus();
	checkOptional(t);
}