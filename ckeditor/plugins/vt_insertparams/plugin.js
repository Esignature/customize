CKEDITOR.plugins.add("vt_insertparams", {
	init: function(editor) {
		var pluginName = 'vt_insertparams'
		CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/'+pluginName+'.js')
		editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
		editor.ui.addButton(pluginName, {
			label: "Dynamic param will be replaced with their values when the action content will be displayed.",
			command: pluginName,
			icon: this.path + "icon.png"
		});
	}
});
