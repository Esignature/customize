$(function(){
	
	$('form#user_profile').submit(function(){
	   elm = $('#screen_name');
	   if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your full name!').fadeIn('fast'); elm.focus(); return false; }
	    elm = $('#email');
	   if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your email address!').fadeIn('fast'); elm.focus(); return false; }
	   if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(elm.val()))){$('#usr_reg_frm_err').html('Enter your valid email address!').fadeIn('fast'); elm.focus(); return false;}
	   elm = $('#usr_reg_country');
	   if($.trim(elm.val()) == '0'){ $('#usr_reg_frm_err').html('Select your country!').fadeIn('fast'); elm.focus(); return false; }
	   var elm = $('#username');
	   if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your username!').fadeIn('fast'); elm.focus(); return false; }
	   
	   elm = $('#password');
	   elm1 = $('#c_password');
	   if(elm.val() != '' && elm.val() != elm1.val()){
		 alert('Re-type your new password'); elm1.focus(); return false;  
		}
	   
	   return true;
	});

    $('#lnk001').click(function(){
		$('#lnk002').removeClass('current');
		$(this).addClass('current');
		$('#user_profile_form').slideUp('fast');
		$('#user_favourites').slideDown('fast');
		$('li.has_ajax_link').removeClass('halt_selection_li');
	});
    $('#lnk002').click(function(){
		$('#lnk001').removeClass('current');
		$(this).addClass('current');
		$('#user_favourites').slideUp('fast');
		$('#user_profile_form').fadeIn('fast');
		$('li.has_ajax_link').addClass('halt_selection_li');
	});

    $('li.has_ajax_link').click(function(){
		$('#lnk001').trigger('click');
		$('#user_favourites').fadeIn('fast');
        $('li.has_ajax_link').removeClass('current');
		$(this).addClass('current');
		var prid = $('ul#user_actions').attr('prid');
		var tar = $(this).attr('rel');
		$.ajax({
			type : 'POST',
			data : 'load=true',
			url  : $('#user_favourites').attr('rel') + tar +'/'+prid,
			success : function(m){
				$('#user_favourites').html(m);
			}
		});
	});
	
	$('li.has_ajax_link:eq(0)').trigger('click');

});