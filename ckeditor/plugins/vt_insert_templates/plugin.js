CKEDITOR.plugins.add("vt_insert_templates", {	
	init: function(editor) {
		var pluginName = 'vt_insert_templates'
		CKEDITOR.dialog.add(pluginName, this.path+'dialogs/'+pluginName+'.js')
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
		editor.ui.addButton(pluginName, {
			label: "Insert Template",
			command: pluginName,
			icon: this.path + "icon.png"
		});
	}
	
});
