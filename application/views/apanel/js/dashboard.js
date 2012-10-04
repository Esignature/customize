function isBrowserIE() {
	return navigator.appName=="Microsoft Internet Explorer";
}
function jInsertEditorText( text, editor ) {
	if (isBrowserIE()) {
		if (window.parent.tinyMCE) {
			window.parent.tinyMCE.selectedInstance.selection.moveToBookmark(window.parent.global_ie_bookmark);
		}
	}
	tinyMCE.execInstanceCommand(editor, 'mceInsertContent',false, text);
}

$(document).ready(function(){
	showHighlight();
    window.setTimeout('clear()', 5000);
	
	$('.has_sub_menu').click(function(){
		$('#nav ul li').removeClass('active');
		$('#nav ul li a').removeClass('active');
		$(this).addClass('active');
		$(this).parent().addClass('active');
		var sb = $(this).parent().find('.submenulist').html();
		if(sb == null){
		    $('#subnav').html('').slideUp();
			return true;
		} else {
			$('#subnav').html('<ul>'+sb+'</ul>').slideDown();
		}
		return false;
	});
	
	// delete icon clicked.
	$('.ic_delete').click(function(){
		if(confirm('Delete this record permanently?'))
		  return true;
		return false;
	});
	
	//
	$('#checkbox_main').click(function(){
		if($('#checkbox_main:checked').length == 1){
			$('.list_checkbox').attr('checked','checked');
		} else {
			$('.list_checkbox').attr('checked','');
		}
		showHighlight();
	});
	
	$('.list_checkbox').click(function(){
		showHighlight();
	});
	
	// Single action
	$('.single_action').click(function(){
		var ln = $('.list_checkbox:checked').length;
		if(ln != 1){ alert('Select one record to perform the action.');$('.todoboard li').removeClass('active'); return false; } else {
			var hr = $(this).attr('href') + '/' + $('.list_checkbox:checked').attr('uid');
			$(this).attr('href', hr);
		}
		$('.todoboard li').removeClass('active');
		return true;
	});
	
	// Group Action handling.
	$('.group_action').click(function(){
		var id = getSelectedId();
		if(id == '0'){ alert('Select at least one record.');$('.todoboard li').removeClass('active'); return false; }
		if(this.href.indexOf('delete_group')>-1 || this.href.indexOf('trash_group')>-1){ if(!confirmDelete()){$('.list_checkbox:checked').each(function(){this.checked=false}); return false;}}
		
		var hr = $(this).attr('href');
        $.ajax({
		   type: "POST",
		   url:  hr,
		   data: 'id='+id,
		   dataType: 'json',
		   success: function(ms){
			   var st = (ms.flag == 1) ? 'success' : 'fail';
			   clear();
		       $('#task_status').html('<div class="'+st+' curved8 canhide" style="display:block">'+ ms.msg +'</div>').css('display', 'none').fadeIn('fast');
			   if(ms.txtflag == 'strip' && ms.flag == 1){ stripRows(); $('.total_users').html(ms.total_rec) }
			   else if(ms.txtflag == 'publish' && ms.flag == 1){ publishRows(); $('.total_users').html(ms.total_rec) }
			   else if(ms.txtflag == 'unpublish' && ms.flag == 1){ unpublishRows(); $('.total_users').html(ms.total_rec) }
			   $('.todoboard li').removeClass('active');
			   window.setTimeout('delayResponseHide()', 5000);
		   }
		});
		return false;
	});
	
	// Popular or not..
	$('span.starred').click(function(){
		var id = $(this).attr('name');
		var tbl = $(this).attr('tbl');
		var fld = $(this).attr('fld');
		if(fld != '') fld = '/'+fld;
		$('#mark_popular_'+id).addClass('popular_loading');
		$.ajax({
		   type: "POST",
		   url:  base_url() + 'index.php/ajax/togglePopular/'+tbl+fld,
		   data: 'id='+id,
		   success: function(msg){
			   if(msg == 1){
				  $('#mark_popular_'+id).addClass('popular');
			   } else {
					$('#mark_popular_'+id).removeClass('popular');
			   }
			   $('#mark_popular_'+id).removeClass('popular_loading');
		   }
		});
		return false;
	});
	// Slideshow image or not..
	$('span.has_slideshow').click(function(){
		var id = $(this).attr('name');
		var tbl = $(this).attr('tbl');
		$('#mark_slideshow_'+id).addClass('popular_loading');
		$.ajax({
		   type: "POST",
		   url:  base_url() + 'index.php/ajax/toggleSlideshow/'+tbl,
		   data: 'id='+id,
		   success: function(msg){
			   if(msg == 1){
				  $('#mark_slideshow_'+id).addClass('has_slide');
			   } else {
					$('#mark_slideshow_'+id).removeClass('has_slide');
			   }
			   $('#mark_slideshow_'+id).removeClass('popular_loading');
		   }
		});
		return false;
	});
	
	
	// hide default submit button
	$('.addmorelink').click(function(){
		$('#post_task').val(1);
		$('.form01').submit();
		return false;
	});
	$('.default_submit').hide();
	$('.fail:eq(0)').fadeIn('slow');
	$('.submitfrm').click(function(){
		$('.form01').submit();
		return false;
	});
	
	// Inserting a readmore in the content
	$('#insert_read_more').click(function(){
		var content = tinyMCE.get('full_content').getContent();
		if (content.match(/<hr\s+id=("|')system_readmore("|')\s+style=("|')border:1px dashed red("|')\s*\/*>/i)) {
			alert('Only one read more allowed!');
			return false;
		} else {
			jInsertEditorText('<hr id="system_readmore" style="border:1px dashed red" />', 'full_content');
		}
		return false;
	});	
	
	// Popular or not..
	$('span.starred_pop').click(function(){
		
		var id = $(this).attr('name');
		var tbl = $(this).attr('tbl');
		
		var load_module='album_model';
		
			var tbl_pop='tbl_popular_album';
		
		var fld='featured';
		$('#mark_popular_'+id).addClass('popular_loading');
		$.ajax({
		   type: "POST",
		   url:  base_url() + 'index.php/ajax/togglePopular_pop/'+tbl+'/'+load_module+'/'+tbl_pop+'/'+fld,
		   data: 'id='+id,
		   success: function(msg){
			   if(msg == 1){
				  $('#mark_popular_'+id).addClass('popular');
			   } else {
					$('#mark_popular_'+id).removeClass('popular');
			   }
			   $('#mark_popular_'+id).removeClass('popular_loading');
		   }
		});
		return false;
	});
	
	// Slideshow image or not..
	$('span.cellroti_pick').click(function(){
		var id = $(this).attr('name');
		var tbl = $(this).attr('tbl');
		var load_module='album_model';
		var tbl_pop='tbl_pick_album';
		var fld='slideshow';
		$('#mark_slideshow_'+id).addClass('popular_loading');
		$.ajax({
		   type: "POST",
		    url:  base_url() + 'index.php/ajax/togglePopular_pop/'+tbl+'/'+load_module+'/'+tbl_pop+'/'+fld,
		   data: 'id='+id,
		   success: function(msg){
			   if(msg == 1){
				  $('#mark_slideshow_'+id).addClass('has_slide');
			   } else {
					$('#mark_slideshow_'+id).removeClass('has_slide');
			   }
			   $('#mark_slideshow_'+id).removeClass('popular_loading');
		   }
		});
		return false;
	});
	// Homepage image or not..
	$('span.homepage_album').click(function(){
		var id = $(this).attr('name');
		var tbl = $(this).attr('tbl');
		var load_module='album_model';
		var tbl_pop='tbl_homepage_album';
		var fld='homepage';
		$('#mark_homepage_'+id).addClass('popular_loading');
		$.ajax({
		   type: "POST",
		    url:  base_url() + 'index.php/ajax/togglePopular_pop/'+tbl+'/'+load_module+'/'+tbl_pop+'/'+fld,
		   data: 'id='+id,
		   success: function(msg){
			   if(msg == 1){
				  $('#mark_homepage_'+id).addClass('has_slide');
			   } else {
					$('#mark_homepage_'+id).removeClass('has_slide');
			   }
			   $('#mark_homepage_'+id).removeClass('popular_loading');
		   }
		});
		return false;
	});
	
	// Popular or not..
	$('span.starred_star, span.tick_css').click(function(){
		
		var id = $(this).attr('name');
		var tbl = $(this).attr('tbl');
		var load_module=$(this).attr('load_module');
		var tbl_pop=$(this).attr('tbl_pop');
		var fld=$(this).attr('fld');
		var preid=$(this).attr('preid');
		var changeclass=$(this).attr('changeclass');
		$('#'+preid+id).addClass('popular_loading');
		$.ajax({
		   type: "POST",
		   url:  base_url() + 'index.php/ajax/togglePopular_pop/'+tbl+'/'+load_module+'/'+tbl_pop+'/'+fld,
		   data: 'id='+id,
		   success: function(msg){
			   if(msg == 1){
				  $('#'+preid+id).addClass(changeclass);
			   } else {
					$('#'+preid+id).removeClass(changeclass);
			   }
			   $('#'+preid+id).removeClass('popular_loading');
		   }
		});
		return false;
	});
	
});
function clear(){
	$('#task_status, .curved8').slideUp();
}
function removeResponse(){
	$('.response').slideUp();
}
function delayResponseHide(){
	$('#task_status').slideUp();
}
function showHighlight(){
	$('.list_checkbox').each(function(){
		if( $(this).is(':checked')){
		    $(this).parent().parent().addClass('selected');
		} else {
			$(this).parent().parent().removeClass('selected');
		}
	});
}
function stripRows(){
	$('.list_checkbox').each(function(){
		if( $(this).is(':checked')){
		    $(this).parent().parent().remove();
		}
	});
}
function publishRows(){
	$('.list_checkbox:checked').each(function(){
		$(this).parent().parent().find('.status0').removeClass('status0').addClass('status1').text('On');
	});
}
function unpublishRows(){
	$('.list_checkbox:checked').each(function(){
		$(this).parent().parent().find('.status1').removeClass('status1').addClass('status0').text('Off');
	});
}
function getSelectedId(){
	var sn = '0';
	$('.list_checkbox').each(function(){
		if( $(this).is(':checked')){
			sn+= '|' + $(this).val();
		}
	});
	return sn;
}
function currentMenu(root, node){
	$("div#nav a:contains('"+node+"')").addClass('current').trigger('click');
}
function confirmDelete(){
	return confirm('Are you sure you want to delete the record(s)?');

}
function toggleDefaultValue(obj, axn){
    if(axn == 'focusin'){
        var this_default = $(obj).attr('tg_default')
        var this_val_focus = (this_default == $(obj).val()) ? '' : $.trim($(obj).val())
        $(obj).val(this_val_focus)
    }else if(axn == 'focusout'){
        var this_default = $(obj).attr('tg_default')
        var this_val_blur = ('' == $.trim($(obj).val())) ? this_default : $.trim($(obj).val())
        $(obj).val(this_val_blur)
    }
}

// Auto bind and execute the form field default value toggler
$(function(){
    $("input[tg_default]").each(function(){
        $(this).bind('focusin focusout', function(e){ 
                toggleDefaultValue(this, e.type) 
                /*switch (e.type) {
                    case 'focusin':
                        var this_default = $(this).attr('tg_default')
                        var this_val_focus = (this_default == $(this).val()) ? '' : $.trim($(this).val())
                        $(this).val(this_val_focus)
                    break;
                    case 'focusout':    
                        var this_default = $(this).attr('tg_default')
                        var this_val_blur = ('' == $.trim($(this).val())) ? this_default : $.trim($(this).val())
                        $(this).val(this_val_blur)
                    break;
                }*/
            });
    })
    
    $("textarea[tg_default]").each(function(){
        $(this).bind('focusin focusout', function(e){
            toggleDefaultValue(this, e.type) 
        });
    })
})



// redirection 

function redirect(url){
    
    document.location = url;
}
