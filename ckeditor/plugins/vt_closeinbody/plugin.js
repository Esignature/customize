(function(){
    var a= {
        exec:function(editor){
        	editor.insertHtml('[__VT__.hide]<a href="#">Close</a>[/__VT__.hide]');
        }
    },
    //Section 2 : Create the button and add the functionality to it
    b='vt_closeinbody';
    
    CKEDITOR.plugins.add(b,{
        init:function(editor){
            editor.addCommand(b,a);
            editor.ui.addButton('vt_closeinbody',{
                label:'Close button in popup body',
                icon: this.path + "icon.png",
                command:b
            });
        }
    });
})();

