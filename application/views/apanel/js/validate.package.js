$(function(){
	$('form.form01').submit(function(){
		var elm = '';
		// First Tab
		$('ul.tab_link li:eq(0) a').trigger('click');
		elm = $('#pkg_name');
		if($.trim(elm.val()) == ''){ 
		    $("a[href=#tab-1]").trigger('click'); alert('Package Name field can not be blank!'); elm.focus(); return false; }
		elm = $('#slug');
        if($.trim(elm.val()) == ''){ 
            $("a[href=#tab-1]").trigger('click'); alert('Slug field can not be blank! Either generate it or type in a slug'); elm.focus(); return false; }   		
		elm = $('#pkg_price');
		if($.trim(elm.val()) == '' || isNaN($.trim(elm.val()))){ 
		      $("a[href=#tab-3]").trigger('click');elm.focus(); alert('Please enter correct value in Package Price field.'); return false; 
		}
		elm = $('#pkg_trial_period');
        if(isNaN($.trim(elm.val()))){ 
            $("a[href=#tab-3]").trigger('click'); elm.focus(); alert('Please enter numeric value in Trial Period field.'); return false; 
        }	
		
		$('#submit').trigger('click');
		return true;
	});
	
	$('#pkg_name').blur(function() {
	   	$('#slugGenerator').trigger('click');
	});
	
	$('#slugGenerator').click(function() {
	    var title = $.trim($('#pkg_name').val());
	    if(title == '') return false;
	    var rec_id = $('#record_id').val();
	    
	    var data = {'title': $.trim($('#pkg_name').val()), 'table': 'package', 'module': '1', 'key_id':rec_id};
        $.ajax({          
            url: base_url()+'index.php/ajax/slug',
            data: data,
            dataType: 'json',
            type: 'post',
            success: function(r){
                r.slug && $('#slug').val(r.slug);
                r.err && $('#slugUnvailable').val(r.error);
            }
        })
    });
});