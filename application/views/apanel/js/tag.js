$(function(){
	saveTags();
	$('.close_tag').live('click', function(){
		$(this).parent().remove();
		saveTags();
	});
	$('#tags_txt').keyup(function(){checkTag()});
	$('#tags_txt').focus(function(){checkTag()});
	$('#tags_txt').blur(function(){checkTag()});
	$('#insert_tag').click(function(){
		var t = '';
		$('ul.current_tags li').each(function(e){
			t += $.trim($(this).find('.tag_val').text()) + '||';
		});
		var v = $.trim($('#tags_txt').val());
		var comp = t.split(v+'||');
		if(comp.length == 1)
		{
			$('ul.current_tags').append('<li class="loading" id="temp_status">&nbsp;</li>');
			$.ajax({
				type: "POST",
			    url:  base_url() + 'index.php/ajax/checkTag',
			    data: 'tag='+v,
			    success: function(msg){
					$('#temp_status').remove();
					if(msg == ''){
						alert('Unable to add this tag!');
					} else {
						var a = '<li> <span class="tag_val" name="'+msg+'">'+v+'</span> <span class="close_tag" title="Remove this tag">x</span></li>';
			            $('ul.current_tags').append(a);
						$('#tags_txt').focus();
					}
				}
			});
		} else {
			alert('Tag already exist.');
		}
		$('#tags_txt').val('');checkTag();
	});
});
function checkTag(){
	var v = $.trim($('#tags_txt').val());
	if(v == ''){
		$('#insert_tag').hide();
	} else {
		$('#insert_tag').show();
	}
	saveTags();
}
function saveTags()
{
	var t = '';
	$('ul.current_tags li').each(function(e){
		t += $.trim($(this).find('.tag_val').attr('name')) + '||';
	});
	$('#tags_value').val(t);
}