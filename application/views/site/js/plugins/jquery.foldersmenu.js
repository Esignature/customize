(function($) {	
	$.fn.foldersMenu = function(menuId, onSelectCallback, settings) {		
		settings = $.extend({			
			//widgetUrl: 'shared/folderMenu/widget?id=900&serverId=1750&server_id=1750&_=1343809541713
			widgetUrl: _site_url+'etemplates/templates_menu?sub=0&id=-id-',
			folderListUrl: _site_url+'etemplates/templates_menu?sub=1&id=-id-&menu_id=-menuId-',
			selectObject: false
			
		}, settings);
		
		this.each(function() {			
			var menu = $(this);
			var loader = $('<div class="loader"/>');			
			menu.addClass('foldersMenu');			
			menu.load(settings.widgetUrl.replace('-id-', menuId), function() {				
				var dropDownList = menu.find('.dropDownList');				
				$(document).click(function() {
					dropDownList.hide();
				});				
				var buttom = menu.find('.buttom');				
				buttom.click(function() {
					dropDownList.show();
					return false;
				});				
				function initDropDownList(dropDownList) {					
					dropDownList.find('.parentFolders a, .childFolders a').click(function() {						
						var attr = $(this).attr('href').split('#')[1].split('|');						
						dropDownList.empty();
						dropDownList.append(loader);					
						$.get(settings.folderListUrl.replace('-id-', attr[0]).replace('-menuId-', attr[1]), function(dropDownListCode) {
							dropDownList.empty();
							dropDownList.append(dropDownListCode);
							initDropDownList(dropDownList);
						});						
						return false;
					});
					
					dropDownList.find('.folderObjects a').click(function(event) {						
						event.preventDefault();						
						var a = $(this);						
						if (settings.selectObject) {
							buttom.text(a.text());
						}						
						var data = a.attr('href').split('#')[1].split(',');						
						var pk = data[1];
						pk = pk.split('&');
						var primeryKey = {};
						
						for (var i = 0, length = pk.length, pair; i < length; i++) {
							pair = pk[i].split('=');
							primeryKey[pair[0]] = pair[1];
						}						
						onSelectCallback(primeryKey, data[2], a.text());						
					});
				}				
				initDropDownList(dropDownList);				
			});			
		});		
		return this;
	}	
})(jQuery);