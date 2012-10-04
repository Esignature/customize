(function(){    
    var exampleDialog = function(editor){
        return {
            title : 'Number of Sessions',
            minWidth : 80,
            minHeight : 40,
            buttons:[CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton],
            onOk: function() {
                editor.insertHtml('[dontshowagain:'+this.getContentElement("params", "param").getValue()+']<a href="javascript:void(0)">Dont show me again</a>[/dontshowagain]');
            },            
            resizable: 'none',
            contents: [{
                id: "params",
                label: "Number of sessions",
                title: "Number of sessions",
                expand: true,
                padding: 0,
                elements: [{
                    label: "Number of Sessions",
                    type: "text",
                    id: "param",
                    default: 1
                    
                }]
            }]
        }
    }    
    
    CKEDITOR.dialog.add('vt_dontshowagain', function(editor) {
        return exampleDialog(editor);
    });
        
})();