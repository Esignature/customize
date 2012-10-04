(function() {
	var exampleDialog = function(editor){
		
		var id = editor.id + "selector";
		var templatesMenuId = 900;
		return {		
			title: "Templates",
			width: 220,
			height: 36,
			resizable: 'none', //CKEDITOR.DIALOG_RESIZE_NONE,
			selectedTemplateId: null,			
			contents: [{
				elements: [{
					type: "html",
					html: "<div id=\"" + id + "\"></div>"
				}],
				id: "templates",
				label: "templates",
				title: "Templates",			
			}],
			
			onLoad: function() {
				var dialog = this;
				//$j("#" + id).foldersMenu(editor.config.templatesMenuId, function(object) {
				$j("#" + id).foldersMenu(templatesMenuId, function(object) {	
					dialog.selectedTemplateId = object.id;
				}, {
					selectObject: true
				});
			},
			
			onOk: function() {
				var id = this.selectedTemplateId;
				if (id) {
					$j.get(_site_url+"etemplates/load_template", {
						id: id
					}, function(template) {
						editor.setData(template);
					});
				}
			}
		}
	}
	
	CKEDITOR.dialog.add('vt_insert_templates', function(editor) {
        return exampleDialog(editor);
    });
	
})();