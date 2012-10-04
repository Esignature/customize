$(function(){

	$('form.form01').submit(function(){
		var elm = '';
		elm = $('#screen_name');
		if($.trim(elm.val()) == ''){ alert('Enter screen name.'); elm.focus(); return false; }
		
		elm = $('#email');
		if($.trim(elm.val()) == ''){ alert('Enter your email address'); elm.focus(); return false; }
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(elm.val()))){alert('Enter your valid email address'); elm.focus(); return false;}
		
		elm = $('#username');
		if($.trim(elm.val()) == ''){ alert('Enter your username'); elm.focus(); return false; }
		
		elm = $('#password');
		if(elm.val() != '' && elm.val() != $('#c_password').val())
		{
		      alert('Please confirm your new password'); 
			  $('#c_password').focus(); return false; 
	    }
				
		$('#submit').trigger('click');
		return true;
	});
});
