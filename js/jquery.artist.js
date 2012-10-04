  $(function() {
    $('.crossbtn').tipsy({gravity: 'e', html:true, fade:true});
	$('.btns_tip').tipsy({gravity: 's', html:true});
	var dt = new Date();
	var cy = dt.getYear() + 1900;
	
	$('li.li_crbt_list').hover(function(){
		$('li.li_crbt_list').removeClass('current_crbt');
		$(this).addClass('current_crbt');
	});
	$('li.main_node').live('hover', function(){
		$('li.main_node').removeClass('current_track');
		$(this).addClass('current_track');
	});
	$('.show_crbt_detail').live('click', function(){
		var cr_id = $(this).attr('name');
		var tr_id = $(this).attr('tr_id');
		var nt_id = $(this).attr('nt_id');
		var rid   = $(this).attr('rid');
		$('#prbt_info_'+rid).html(' <img src="'+base_url()+'images/load-indicator.gif" alt="Loading...." /> ');
		$.ajax({
			type   : 'POST',
			url    : base_url()+'index.php/ajax/load_crbt_detail',
			data   : 'crbt='+cr_id+'&track='+tr_id+'&network='+nt_id,
			success: function(msg)
			{
				$('#prbt_info_'+rid).html(msg);
			}, error: function(){
				alert('unable to get the information!');
			}
		});
	});
	$('.nav_tracks_next').click(function(){
		var tk = $(this).attr('name');
		var cr = Number($('#page_'+tk).val());
		var total_p = Math.ceil(($('#ul_'+tk+' > li').length) / 5);
		var np = cr+1;
		var pn = np % total_p;
		pn = (pn == 0) ? total_p : pn;
		$('#page_'+tk).val(pn);
		$('#ul_'+tk+' > li').addClass('hidden_tracks');
		$('li.list_'+tk+'_page_'+pn).removeClass('hidden_tracks').css('display', 'none').fadeIn('fast');
	});
	$('.nav_tracks_prev').click(function(){
		var tk = $(this).attr('name');
		var cr = Number($('#page_'+tk).val());
		var total_p = Math.ceil(($('#ul_'+tk+' > li').length) / 5);
		var np = cr-1;
		var pn = np % total_p;
		pn = (pn == 0) ? total_p : pn;
		$('#page_'+tk).val(pn);
		$('#ul_'+tk+' > li').addClass('hidden_tracks');
		$('li.list_'+tk+'_page_'+pn).removeClass('hidden_tracks').css('display', 'none').fadeIn('fast');
	});
	var total_lists = ($('li.li_crbt_list').length);
	for(i=0; i<total_lists; i++)
	{
		var ln = $('ul.crbt_tracks:eq('+i+') > li').length;
		if(ln > 5)
		{
			$('.crbt_nav:eq('+i+') span').css('display', 'block');
		}
	}
		
	// -------------------------------------
	$('ul.artist_tab li:first').css('border', 'none');
	$('li.artist_tab_index').click(function(){
		var ind = $('ul.artist_tab li').index(this);
		$('li.artist_tab_index, li.artist_tab_content').removeClass('current_tab');
		$(this).addClass('current_tab');
		$('.artist_tab_content:eq('+ind+')').addClass('current_tab').css('display', 'none').fadeIn('fast');
	});
	$('#close_overlay, #close_overlay2').click(function(){
		$('ul#top_menu li a').removeClass('current_menu');
		$('.overlay_wrap').fadeOut('fast');
	});
	$('ul#top_menu li a').click(function(){
		$('.overlay_wrap').fadeIn('fast');
		var src = $(this).attr('href');
		var lod = $(this).text();
		var mid = $(this).attr('id');
		$('ul#top_menu li a').removeClass('current_menu');
		$(this).addClass('current_menu');
		$('#primary_container').html('<h1 class="overlay_h1">'+lod+'</h1><p class="temp_content">Loading content... <img src="'+base_url()+'images/square_loading.gif" alt="" /> </p>');
		$('#secondary_container').html('');
		$('.ext_arr').hide();
		// Manage containers..
		(mid == 'menu_photos') ? makeOneContainer() : 	makeTwoContainer();
		$.ajax({
			type : 'post',
			url  : src,
			data : 'load=true',
			success:function(m){
				$('.temp_content').remove();
				var spc = m.split('||--sep--||');
				$('#primary_container').append(spc[0]).css('display', 'none').fadeIn();
				$('#secondary_container').html('');
				
				if(spc.length == 2)
				{
					$('#secondary_container').html(spc[1]).css('display', 'none').fadeIn();
					$('.ext_arr').fadeIn();
				}
				
				if(mid == 'menu_albums')
				{
					// Load the first album detail..
					if($('#triggerClickDefaultOrNot').val() == '1')
					{
					    $('li.has_detail:eq(0)').trigger('click');
					}
				}
				
				if(mid == 'menu_videos')
				{
					// Load the first album detail..
					if($('#triggerClickDefaultOrNot').val() == '1')
					{
					    $('li.has_video:eq(0)').trigger('click');
					}
				}
				
				if(mid == 'menu_news' || mid == 'menu_article' || mid == 'menu_interview')
				{
					// Load the first album detail..
					if($('#triggerClickDefaultOrNot').val() == '1')
					{
					    $('li.has_content:eq(0)').trigger('click');
					}
				}
			},
			error:function(){
				alert('Unable to load content!');
			}
		});
		return false;
	});
	
	$('li.has_detail').live('click', function(){
		var refid = $(this).attr('refid');
		$('li.has_detail').removeClass('current_overlay_li');
		$(this).addClass('current_overlay_li');
		$.ajax({
			type : 'post',
			url  : base_url() + 'index.php/ajax_artist/get_detail/' + refid,
			data : '',
			success : function(m){
				$.scrollTo(140, 100);
				$('#secondary_container').css('display', 'none').html(m).fadeIn();
				$('.ext_arr').fadeIn();
			},
			error : function(){
				alert('Could not fetch content!');
			}
		});
	});
	
	$('li.has_video').live('click', function(){
		var refid = $(this).attr('refid');
		$('li.has_video').removeClass('current_overlay_li');
		$(this).addClass('current_overlay_li');
		$.ajax({
			type : 'post',
			url  : base_url() + 'index.php/ajax_artist/get_video/' + refid,
			data : '',
			success : function(m){
				$.scrollTo(140, 100);
				$('#secondary_container').css('display', 'none').html(m).fadeIn();
				$('.ext_arr').fadeIn();
			},
			error : function(){
				alert('Could not fetch content!');
			}
		});
	});
	
	// contents..
	$('li.has_content').live('click', function(){
		var refid = $(this).attr('refid');
		$('li.has_content').removeClass('current_overlay_li');
		$(this).addClass('current_overlay_li content_loading');
		$.ajax({
			type : 'post',
			url  : base_url() + 'index.php/ajax_artist/content_detail/' + refid,
			data : '',
			success : function(m){
				$.scrollTo(140, 100);
				$('#secondary_container').css('display', 'none').html(m).fadeIn();
				$('.ext_arr').fadeIn();
			},
			error : function(){
				alert('Could not fetch content!');
			}
		});
		$(this).removeClass('content_loading');
	});
	
	// Overlay Pagination
	$(' .overlay_pagination .next_page').live('click', function(){
		var tk = $(this).attr('name');
		var cr = Number($('#page_'+tk).val());
		var pp = Number($(this).attr('perpage'));
		var total_p = Math.ceil(($('#ul_'+tk+' > li').length) / pp);
		var np = cr+1;
		var pn = np % total_p;
		pn = (pn == 0) ? total_p : pn;
		$('#pn_c_'+tk).text(pn);
		$('#page_'+tk).val(pn);
		$('#ul_'+tk+' > li').addClass('hidden');
		$('#ul_'+tk+' li.c_page_'+pn).removeClass('hidden').css('display', 'none').fadeIn('fast');
		//console.log('NAME:'+tk+'||PAGE:'+cr+'||PER PAGE:'+pp+'||TOTAL:'+total_p+'||NEW PAGE:'+pn);
	});
	$('.overlay_pagination .prev_page').live('click', function(){
		var tk = $(this).attr('name');
		var cr = Number($('#page_'+tk).val());
		var pp = Number($(this).attr('perpage'));
		var total_p = Math.ceil(($('#ul_'+tk+' > li').length) / pp);
		var np = cr-1;
		var pn = np % total_p;
		pn = (pn == 0) ? total_p : pn;
		$('#pn_c_'+tk).text(pn);
		$('#page_'+tk).val(pn);
		$('#ul_'+tk+' > li').addClass('hidden');
		$('#ul_'+tk+' li.c_page_'+pn).removeClass('hidden').css('display', 'none').fadeIn('fast');
	});
	
	/*
	* - Artist search indexing!
	*/
	$('ul#search_index li a').hover(function(){
		var key = $(this).text();
		if(key == '#'){ key = '9'; }
		// Create a dynamic content box at the bottom for holding 
		// the search results..
		var address = 'search_result_' + key;
		if($('#box_'+address).length == 0)
		{
			var ap = '<div id="box_'+address+'">'+$('#'+address).html()+'</div>';
			$('#search_result').append(ap);
			$.ajax({
				type : 'post',
				data : 'mode=load_artists',
				url  : base_url()+'index.php/ajax_artist/search_artists/'+key,
				success : function(m){
					$('#'+address).html(m);
				}, error : function(){
					//alert('Unable to find results!');
				}
			});
		}
	});
	$('ul#search_index li a').click(function(){return false;});
	
	/* User links.. */
	$('#become_fan').click(function(){
		var usrid = $(this).attr('usrid');
		var prid  = $(this).attr('prid');
		$.ajax({
			type : 'post',
			data : 'mode=become_fan',
			url  : base_url()+'index.php/ajax_artist/fan/'+usrid+'/'+prid,
			success : function(m){
				$('#become_fan').text(m);
			}, error : function(){
				//alert('Unable to find results!');
			}
		});
		return false;
	});
	
	$('a#send_message').click(function(){
		var nm = $(this).attr('artist_name');
		var ui = $(this).attr('usrid');
		var pi = $(this).attr('prid');
		$('#artist_name_msg').text(nm);
		$('#msg_usrid').val(ui);
		$('#msg_prid').val(pi);
		$('#modal_wrap').fadeIn('fast');
		return false;
	});
	$('#modal_close').click(function(){
		$('#modal_wrap').css('display', 'none');
	});
	
	$('#artist_msg_frm').submit(function(){
		var dt = prepareQuerystring(this);
		$.ajax({
			type : 'post',
			data : dt,
			url  : base_url()+'index.php/ajax_artist/message',
			success : function(m){
				alert(m);
				$('#modal_close').trigger('click');
				tinyMCE.get('usr_artist_msg').setContent('');
			}, error : function(){
				//alert('Unable to find results!');
			}
		});
		return false;
	});
	
	//DISPLAY ALBUM COMPOSER AND LYRICIST WHEN HOVERED IN THE ALBUM TABS
	$('.album_list li').hover(
		function(){
			$(this).find('.retractible').animate({marginTop:'72px'},{queue:false,duration:260});
		}, function() {
			$(this).find('.retractible').animate({marginTop:'170px'},{queue:false,duration:260});
		});
  
    // Open contents in self container
	$('a.viewNewsContainer').click(function(){
		$.scrollTo(140, 100);
		$('#triggerClickDefaultOrNot').val(0);
		$('a#menu_news').trigger('click');
		var id = $(this).attr('refid');
		findMyContent('li#list_news_index_'+id);
		return false;
	});
	$('a.viewPhotoContainer').click(function(){
		$.scrollTo(140, 100);
		$('a#menu_photos').trigger('click');
		var id = $(this).attr('refid');
		findMyContent('li a#list_photo_index_'+id);
		return false;
	});
	$('a.viewVideoContainer').click(function(){
		$.scrollTo(140, 100);
		$('a#menu_videos').trigger('click');
		var id = $(this).attr('refid');
		findMyContent('li#list_video_index_'+id);
		return false;
	});
	$('a.viewAlbumContainer').click(function(){
		$.scrollTo(140, 100);
		$('#triggerClickDefaultOrNot').val(0);
		$('a#menu_albums').trigger('click');
		var id = $(this).attr('refid');
		findMyContent('li#album_link_id_'+id);
		return false;
	});
	$('a.viewAlbumContainer,a.viewVideoContainer,a.viewPhotoContainer,a.viewNewsContainer').css('cursor', 'pointer');
	$('li.artist_tab_index').css('cursor', 'default');
});

function findMyContent(sel)
{
	var totalTrials = 12;
	var obj = $('#primary_container').find(sel);
	var count = parseInt($('#contentFinderCount').val());
	var len = obj.length;
	if(len == 1 || count == totalTrials) // Try for 10 seconds.
	{
		/*
		*  Perform pagination if necessary
		*/
		obj.trigger('click');
		searchTrialTimes = 0;
		$('#contentFinderCount').val(0);
		$('#triggerClickDefaultOrNot').val(1);
		if(obj.hasClass('hidden'))
		{
			autoPaginate(sel);
		}
	}
	else if(len == 0 && count == totalTrials)
	{
		alert("Unable to load! Please try again later.");
		$('#contentFinderCount').val(0);
	}
	else
	{
		window.setTimeout("findMyContent('"+sel+"')", 1000);
		$('#contentFinderCount').val(count+1);
	}
}

function autoPaginate(sel)
{
	var totalTrials = 10;
	var obj = $('#primary_container').find(sel);
	var count = parseInt($('#contentFinderCount').val());
	console.log(totalTrials + ':' + count);
	if( !obj.hasClass('hidden') || count == totalTrials)
	{
		$('#contentFinderCount').val(0);
	}
	else
	{
		$('#primary_container .next_page').trigger('click');
		window.setTimeout("autoPaginate('"+sel+"')", 50);
		$('#contentFinderCount').val(count+1);
	}
}
function makeOneContainer()
{
	$('.right_overlay, .ext_arr').css('display', 'none');
	$('.left_overlay').css('width', '958px');
	$('.overlay_wrap').addClass('singleWrap');
	$('#close_overlay2').css('display', 'block');
}
function makeTwoContainer()
{
	$('.overlay_wrap').removeClass('singleWrap');
	$('.right_overlay').css('display', 'block');
	$('.left_overlay').css('width', '427px');
	$('#close_overlay2').css('display', 'none');
}