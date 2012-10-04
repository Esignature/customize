$(function(){
	
   $('.user_menu_wrap').removeClass('no_js_fn');
   $('.user_menu_wrap').css('display', 'none');
   
   $('.is_drop_button').click(function(){
	 //$('#user_menu .user_menu_wrap').css('display', 'none');
	 $(this).next().slideToggle(200);  
   });
   
   var is_btn_sign_in = 0;
   var is_btn_register = 0;
   $('#is_btn_sign_in').click(function(){
	   
	   is_btn_sign_in = (is_btn_sign_in == 0) ? 1 : 0;
	   is_btn_register = 0;
	   
	   $('#is_btn_register').parent().removeClass('active_user_menu');
	   if(is_btn_sign_in == 1)
	   {
		   $(this).parent().addClass('active_user_menu');
	   }
	   else
	   {
		   $(this).parent().removeClass('active_user_menu');
	   }
	   
	   $('#div_user_register').css('display', 'none');
	   $('#div_user_login').toggle();  
   });
   $('#is_btn_register').click(function(){
	   is_btn_register = (is_btn_register == 0) ? 1 : 0;
	   is_btn_sign_in = 0;
	   
	   $('#is_btn_sign_in').parent().removeClass('active_user_menu');
	   if(is_btn_register == 1)
	   {
		   $(this).parent().addClass('active_user_menu');
	   }
	   else
	   {
		   $(this).parent().removeClass('active_user_menu');
	   }
	   
	   $('#div_user_login').css('display', 'none');
	   $('#div_user_register').toggle();  
   });
   
   // Place Holder
   $('.placeholder').focus(function(){
	 var df = $(this).attr('def');
	 var vl = $(this).val();
	 if(df == vl)
	 {
		$(this).val(''); 
     }
   });
   $('.placeholder').blur(function(){
	 var df = $(this).attr('def');
	 var vl = $.trim($(this).val());
	 if(vl == '')
	 {
		$(this).val(df); 
     }
   });
   
   // Form actions
   $('#usr_login_form').submit(function(){
	 var elm = $('#usr_login_username');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_lgn_frm_err').html('Enter your username!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_login_password');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_lgn_frm_err').html('Enter your password!').fadeIn('fast'); elm.focus(); return false; }
	 $('#usr_lgn_frm_err').addClass('axn_msg').html('Please wait...');
	 var dt = prepareQuerystring(this);
	 $.ajax({
		type : 'post',
		data : dt,
		url  : $('#base_url').text() + 'index.php/user/dologin', 
		success : function(m){
			if(m == '0')
			{
				$('#usr_lgn_frm_err').html('Invalid credentials!').removeClass('axn_msg').css('display', 'none').fadeIn('slow');
			}
			else
			{
				$('#usr_lgn_frm_err').html('Please wait..')
				window.location.reload();
			}
		}
	 });
	 return false; 
   });
   
   $('li#logout_user').click(function(){
	   $.ajax({
		type : 'post',
		data : '',
		url  : $('#base_url').text() + 'index.php/user/logout', 
		success : function(m){
			window.location.reload();
		}
	 });
   });
   
   $('#usr_register_form').submit(function(){
	 var elm = $('#usr_reg_username');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your username!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_reg_email');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your email address!').fadeIn('fast'); elm.focus(); return false; }
	 if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(elm.val()))){$('#usr_reg_frm_err').html('Enter your valid email address!').fadeIn('fast'); elm.focus(); return false;}
	 elm = $('#usr_reg_password');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your password!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_reg_c_password');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Re-type your password again!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_reg_c_password');
	 if($.trim(elm.val()) != '' && elm.val() != $('#usr_reg_password').val()){ $('#usr_reg_frm_err').html('Confirm your password!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_reg_firstname');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your first name!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_reg_lastname');
	 if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ $('#usr_reg_frm_err').html('Enter your last name!').fadeIn('fast'); elm.focus(); return false; }
	 elm = $('#usr_reg_country');
	 if($.trim(elm.val()) == '0'){ $('#usr_reg_frm_err').html('Select your country!').fadeIn('fast'); elm.focus(); return false; }
	 $('#usr_lgn_frm_err').addClass('axn_msg').html('Please wait...');
	 var dt = prepareQuerystring(this);
	 $.ajax({
		type : 'post',
		data : dt,
		url  : $('#base_url').text() + 'index.php/user/register', 
		success : function(m){
			$('#usr_register_form').html(m).removeClass('axn_msg').css('display', 'none').fadeIn('slow');
		}
	 });
	 return false;
   });
   
   // Check username availability..
   $('#usr_reg_username').blur(function(){
     var vl = $(this).val();
	 var ovl = $(this).attr('oval');
	 $(this).attr('oval', vl);  
	 if(vl != ovl && vl != $(this).attr('def'))
	 {
		// send ajax request to check the username..
		$.ajax({
			type : 'POST',
			url : $('#base_url').text()+'index.php/user/chk_username',
			data : 'uname='+vl,
			success: function(m){
				if(m != ''){
					$('#usr_reg_frm_err').html(m).css('display', 'none').fadeIn('fast'); 
				}
			}
		}); 
	 }
   });
	
	$('#compose_email').submit(function(){
		var elm = $('#mail_to');
	    if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ alert('Enter recepient username!'); elm.focus(); return false; }
		$('#mail_body').val(tinyMCE.get('mail_body').getContent());
		var elm = $('#mail_body');
	    if($.trim(elm.val()) == ''){ alert('Type your message!'); return false; }
		
		var elm = $('#mail_subject');
	    if($.trim(elm.val()) == '' || elm.val() == elm.attr('def')){ elm.val('[No subject]'); return false; }
		var dt = prepareQuerystring(this);
		$('#halt_sending').css({'display':'block', 'opacity':'0.8'}).html('Sending<span class="loading_dots">.</span><span class="loading_dots">.</span><span class="loading_dots">.</span>');
		likeWaiting();
		$('#send_mail, #canel_mail').css('opacity', '0');
		$.ajax({
			type : 'POST',
			data : dt,
			url  : $('#base_url').text() + 'index.php/user/send_message', 
			success : function(m){
				$('#canel_mail').trigger('click');
				alert(m);
				$('#halt_sending').html('').css('display', 'none');
				$('#send_mail, #canel_mail').css('opacity', '1');
			}
		});
		return false;
	});
	
	// Load Message Detail
	$('span.has_message').live('click', function(){
		var id = $(this).attr('rel');
		$('#inbox_pagination, #trash_messages').css('display', 'none');
		$(this).parent().parent().addClass('read');
		var tm = $('#msg_detail_wrap').html();
		$('#msg_detail_wrap').html('<div style="padding:10px;color:#fff;">Loading....</div>');
		$('#temp_val_hold').html(tm);
		$("#msg_detail_wrap").load($('#base_url').text() + 'index.php/user/load_message/'+id);
    });
	
	// post msg fn
	$('#view_inbox').live('click', function(){
		var tm = $('#temp_val_hold').html();
		$('#msg_detail_wrap').css('display', 'none').html(tm).fadeIn('fast');
		$('#inbox_pagination, #trash_messages').fadeIn('fast');
	});
	
	// Function..
	$('.wrap_pagination a').live('click', function(){
		var off = ($(this).attr('href')).split('inbox/');
		var src = $('#inbox_pagination');
		var rid = src.attr('ref_id');
		var per = src.attr('perpage');
		var offset = (off[1] == '') ? 0 : off[1];
		$('#inbox_pagination').html('<div style="float:right">Loading...</div>');
		$('#temp_val_hold').load($('#base_url').text() + 'index.php/user/load_paginated_msg/'+rid+'/'+per+'/'+offset, '', function(){
			var tm = $('#temp_val_hold').html();
			var sp = tm.split('||####||');
			$('#inbox_pagination').html(sp[0]);
			$('#inbox_pages_info').text(sp[1]);
			$('#email_wrapper').html($('#t_table').html());
		});
		return false;
	});
	
	// Delete
	$('#trash_messages').click(function(){
		var total = $('.list_checkbox:checked').length;
		if(total == 0)
		{
			alert('Select messages to delete!');
		}
		else
		{
			if(confirm('Delete '+total+' messages?'))
			{
				var id = '';
				var sep = '';
				$('.list_checkbox:checked').each(function(){
					id += sep + $(this).attr('rel');
					sep = '||';
				});
				var src = $('#inbox_pagination');
				var rid = src.attr('ref_id');
				var per = src.attr('perpage');
				$.ajax({
					type : 'POST',
					data : 'mode=delete&id='+id,
					url  : $('#base_url').text() + 'index.php/user/trash/'+rid,
					success : function(m)
					{
						$('.total_inbox_msg').text(m);
						$('#temp_val_hold').load($('#base_url').text() + 'index.php/user/load_paginated_msg/'+rid+'/'+per+'/0', '', function(){
							var tm = $('#temp_val_hold').html();
							var sp = tm.split('||####||');
							$('#inbox_pagination').html(sp[0]);
							$('#inbox_pages_info').text(sp[1]);
							$('#email_wrapper').html($('#t_table').html());
						});
					},
					error : function(){
						alert('Unable to delete!');
					}
				});
			}
		}
	});
});
function likeWaiting()
{
	var total = $('#halt_sending .loading_dots').length;
	if(total > 0)
	{
		$('#halt_sending .loading_dots').remove();
		var to = (total % 3) + 3;
		to = (to == 0) ? 1 : to;
		for(i=0; i<=to; i++)
		{
			$('#halt_sending').append(' <span class="loading_dots">.</span> ');
		}
		window.setTimeout('likeWaiting()', 1000);
	}
}

$(function(){
	  $('#showInbox').click(function(){
		  $(this).toggleClass('active_user_menu');
		  $('#album_wrap, #song_wrap').css('display', 'none');
		  $('#inbox_wrap').slideDown('fast');
		  $('#usr_ws_wrap').slideToggle(400);
	  });
	  
	  $('#select_all_inbox').live('click', function(){
		if($('#select_all_inbox:checked').length == 1){
			$('.list_checkbox').attr('checked','checked');
		} else {
			$('.list_checkbox').attr('checked','');
		}
		showHighlight();
	});
	
	$('.list_checkbox').live('click', function(){
		showHighlight();
	});
	
	showHighlight();
});
  
function showHighlight()
{
 $('.list_checkbox').each(function(){
	if( $(this).is(':checked')){
		$(this).parent().parent().addClass('selected');
	} else {
		$(this).parent().parent().removeClass('selected');
	}
}); 
}