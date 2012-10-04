$(function(){
	saveArtist();
	$('.close_artist').live('click', function(){
		$(this).parent().remove();
		saveArtist();
	});
	$('#artist_txt').keyup(function(){checkArtist()});
	$('#artist_txt').blur(function(){checkArtist()});
	$('#artist_txt').focus(function(){checkArtist()});
	$('#insert_artist').click(function(){
		var t = '';
		$('ul.current_artist li').each(function(e){
			t += $.trim($(this).find('.artist_val').text()) + '||';
		});
		var v = $.trim($('#artist_txt').val());
		var comp = t.split(v+'||');
		if(comp.length == 1)
		{
			var msg = $('#temp_artist').val();
			var a = '<li> <span class="artist_val" name="'+msg+'">'+v+'</span> <span class="close_artist" title="Remove this Artist">x</span></li>';
			$('ul.current_artist').append(a);
			$('#temp_artist').val('0')
		} else {
			alert('Artist already added.');
		}
		$('#artist_txt').focus().val('');checkArtist();
	});
});
function checkArtist(){
	var v = $.trim($('#artist_txt').val());
	if(v == '' || $('#temp_artist').val() == '0'){
		$('#insert_artist').hide();
	} else {
		$('#insert_artist').show();
	}
	saveArtist();
}
function saveArtist()
{
	var t = '';
	$('ul.current_artist li').each(function(e){
		t += $.trim($(this).find('.artist_val').attr('name')) + '||';
	});
	$('#artists_value').val(t);
}