CKEDITOR.plugins.add('vt_dontshowagain',
{
    init: function(editor)
    {
        var pluginName = 'vt_dontshowagain';
        CKEDITOR.dialog.add(pluginName, this.path + 'dialogs/'+pluginName+'.js');
        editor.addCommand(pluginName, new CKEDITOR.dialogCommand(pluginName));
        editor.ui.addButton(pluginName,
            {
                label: 'Dont Show Again',
                command: pluginName,
                icon: this.path + "icon.png"
            });
    }
});