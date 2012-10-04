$(function(){

	$('form.form01').submit(function(){
		var elm = '';
		elm = $('#fname');
		if($.trim(elm.val()) == ''){ alert('Enter First Name of the Site Owner/Site Admin.'); elm.focus(); return false; }
		elm = $('#lname');
        if($.trim(elm.val()) == ''){ alert('Enter Last Name of the Site Owner/Site Admin.'); elm.focus(); return false; }		
		elm = $('#email');
		if($.trim(elm.val()) == ''){ alert('Enter your email address'); elm.focus(); return false; }
		if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(elm.val()))){alert('Enter your valid email address'); elm.focus(); return false;}
		elm = $('#phone');
		if($.trim(elm.val()) == ''){ alert('Enter Phone Number'); elm.focus(); return false; }		
		elm = $('#country_id');
		if($.trim(elm.val()) == ''){ alert('Select a Country'); elm.focus(); return false; }
		elm = $('#timezone_id');
		if($.trim(elm.val()) == ''){ alert('Select a Timezone'); elm.focus(); return false; }		
		$('#submit').trigger('click');
		return true;
	});
	
	$(".closebtn").click(function(){$(this).parent('.pop-up').fadeOut("fast")});	
});

function showTracker(site_id, site_name){
    var content = $('#trkc_'+site_id).val();
    var container = $('#site_tracker_code');
    container.show();
    container.find('.closebtn').show();    
    container.find('#trk_container').val(content);    
    container.find('.uploadnotice').html(site_name != null ? '<b>Tracker Code: '+site_name+'</b>': '<b>Tracker Code:</b>');
    scrollTo(0, 100);   
    return false; 
}

function showSiteDetails(site_id){
    
    var container = $('#site_details');
    container.show();
    
    $.ajax({
        
        url: base_url()+'index.php/ajax/site_details', 
        data: {site_id: site_id},
        type: 'post',
        dataType: 'json',
        success: function(r){
            container.find('#sd_ph').html(r.html);
            container.find('.closebtn').show();
            scrollTo(0, 100); 
        },
        error: function(){            
            container.hide();
            alert('There was some error processing your request. Please retry and contact us if the problem persists.');
        }
    }) 
    return false; 
}


