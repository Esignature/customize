(function(){
    //Section 1 : Code to execute when the toolbar button is pressed
    var a= {
        exec:function(editor){
        	editor.insertHtml('[__VT__.minimize]<a href="#">Minimize</a>[/__VT__.minimize]');
        }
    },
    //Section 2 : Create the button and add the functionality to it
    b='vt_minimizeinbody';
    
    CKEDITOR.plugins.add(b,{
        init:function(editor){
            editor.addCommand(b,a);
            editor.ui.addButton('vt_minimizeinbody',{
                label:'Minimize button in popup body',
                icon: this.path + "icon.png",
                command:b
            });
        }
    });
})();

