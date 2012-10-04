$(function(){
	$('a.triggerDummy').triggerAlternate();
});
(function($){
	$.fn.triggerAlternate = function(options){
		
		var defaults = {
			    scrollY : 140,
				scrollTime : 1000
			};
		var options = $.extend(defaults, options);
	    return $(this).each(function(){
			$(this).click(function(e){
			    var tr = $(this).attr('rel');
				if(tr != 'undefined' && tr != '')
				{
					var elm = $('#'+tr);
					if(elm.length > 0)
					{
					   $.scrollTo(options.scrollY, options.scrollTime);
					   $('#'+tr).trigger('click');
					}
				}
				return false;
		    });
		});
	}
})(jQuery);