$(document).ready(function(){
	
	// Tabs..
	$('.tab_container_div ul').css('display', 'none');
	$('.tab_container_div').each(function(){
		$(this).find('ul:eq(0)').fadeIn('slow');
	}); 
	
	$('.tab_btn').click(function(){
		$(this).parent().find('.cur_tab').removeClass('cur_tab');
		$(this).addClass('cur_tab');
		var id  = $(this).parent().attr('id');
		var elm = $('.cur_tab', $('#'+id));
		var ind = $('#'+id+' div').index(elm);
		
		$('.'+id+' ul').css('display', 'none');
		$('.'+id+' ul:eq('+ind+')').fadeIn('slow');
	});
});