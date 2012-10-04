function p86(obj, retainInitialSelection){
    
    var _parent = $j(obj).parent();   
    var _proto  = _parent.next('br').next('.proto');
    var _dmn    = _proto.next('.dmn');
    var _url    = _dmn.next('.url');
    var _qry    = _url.next('.qry');
    var _frg    = _qry.next('.frg'); 
       
    retainInitialSelection = $j.type(retainInitialSelection) == 'undefined' ? false : retainInitialSelection;
    
    if(obj.checked){
       
        if(!retainInitialSelection)
        _proto.removeClass('hidden').find('select').find('option:selected').removeAttr('selected').end().find('option:first').attr('selected', 'selected').end().removeAttr('disabled');
              
        _proto.removeClass('hidden').find('select').removeAttr('disabled');        
        _dmn.removeClass('hidden').find('input').removeAttr('disabled')
        _url.removeClass('hidden').find('input').removeAttr('disabled')
        _qry.removeClass('hidden').find('input').removeAttr('disabled')
        _frg.removeClass('hidden').find('input').removeAttr('disabled')       
        
    }else{                
        _proto.addClass('hidden').find('select').attr('disabled', 'disabled')
        _dmn.addClass('hidden').find('input').attr('disabled', 'disabled')
        _url.addClass('hidden').find('input').attr('disabled', 'disabled')
        _qry.addClass('hidden').find('input').attr('disabled', 'disabled')
        _frg.addClass('hidden').find('input').attr('disabled', 'disabled')     
    }   
}

function p94(obj, cls){
    
    var _parent = $j(obj).parent();
    var clsimg = _parent.prev(cls);
    openKCFinder(clsimg.find('input').get(0))
               
}

function p114(obj){
    
    var _parent = $j(obj).parent();
    var cntnr = _parent.next('.cntnr');
    if(obj.checked) cntnr.removeClass('hidden')
    else cntnr.addClass('hidden')               
}

function p116(obj){
    
    var srchalsoin = $j('.srchalsoin');
    var settltip = $j('.settltip');
    if(obj.checked){ srchalsoin.addClass('hidden').find('input:checkbox').attr('disabled', 'disabled'); settltip.removeClass('hidden').removeAttr('disabled') }
    else { srchalsoin.removeClass('hidden').find('input:checkbox').removeAttr('disabled'); settltip.addClass('hidden').attr('disabled', 'disabled') }             
}

function p21(obj){
    var _parent = $j(obj).parent();
    var ctns = _parent.next('.ctns');
    switch(obj.value){
        case 'pg_reload': ctns.find('textarea').val( ctns.find('textarea').val()+"\r\nlocation.reload();" ); break;
        case 'redirect': 
            jPrompt('Type the redirect target URL', '', 'Redirect URL', function(r) {
                if( r ){
                    ctns.find('textarea').val( ctns.find('textarea').val()+"\r\nlocation= '"+r+"';" ); 
                } 
            });
            break;
        case 'zoom': 
            jPrompt('Type the zoom level (zoom in: 1; zoom out: 0)', '1', 'Zoom level', function(r) {
                if( r ){
                    ctns.find('textarea').val( ctns.find('textarea').val()+"\r\ndocument.body.style.zoom = "+r+";\r\ndocument.body.style.MozTransform = 'scale("+r+")';" ); 
                } 
            });
            break;
        break;
        case 'print': ctns.find('textarea').val( ctns.find('textarea').val()+"\r\nprint();" ); break;
        case 'alert': 
            jPrompt('Type the text to be shown in alert box', '', 'Alert Text', function(r) {
                if( r ){
                    ctns.find('textarea').val( ctns.find('textarea').val()+"\r\nalert('"+r+"');" ); 
                } 
            });            
        break;        
    }
}

function p135(obj){
    var _parent = $j(obj).parent();
    if(obj.checked){
        _parent.next().next('.popup').removeClass('hidden').find('input, select').removeAttr('disabled', 'disabled');
        _parent.next().next('.popup').next('.popup').removeClass('hidden').find('input, select').removeAttr('disabled', 'disabled');
    }else{
        _parent.next().next('.popup').addClass('hidden').find('input, select').attr('disabled');
        _parent.next().next('.popup').next('.popup').addClass('hidden').find('input, select').attr('disabled');
    }
}

function add_action_fieldset(id, source_li, axn_group_id, fld_data, trigger_event){
    
    if(source_li.attr('subcat') == 0){            
        source_li.find('span').addClass('rule-clicked'); // show loader image    
    }else{
        source_li.addClass('rule-clicked'); // show loader image
    }    
    
    if($j.type(trigger_event)=='undefined'){
        trigger_event=false;
    }
    
    if($j.type(fld_data)=='undefined'){
        fld_data = '';
    }
    
    if($j.type(axn_group_id)=='undefined'){
        var d = new Date();        
        var axn_group_id = d.getTime();
    }
    
        
    $j.ajaxQueue({        
        url: _site_url + 'action/axn_field_sets',
        type: 'post',
        dataType: 'json',
        data: {i : id, g: axn_group_id, fld_data: fld_data },
        success: function(r){
             if(r.fields != ''){
                 
                 $j('#dynamic_form_ph').html(r.fields);
                 $j('#frmAddAction').removeClass('hidden');                 
                 
                 if(source_li.attr('subcat') == 0){            
                    source_li.find('span').removeClass('rule-clicked'); // show loader image    
                 }else{
                    source_li.removeClass('rule-clicked'); // show loader image
                 }
                 
                 /*var d = new Date(), li_id = d.getTime();
                                  
                 if(trigger_event){
                      event_block.find('select:not(:hidden)').each(function(){
                          if($j.type(window[$j(this).attr('data-code')])=='function'){
                              
                              if(id == '_s_mrc21')
                                change_event = $j(this).attr("onChange").replace(')', ", '"+fld_data[1]['fields'][id]['p55'][0].join('|')+"')")
                              else  
                                change_event = $j(this).attr("onChange").replace(')', ', true)')
                             eval(change_event);                                   
                          }
                      })                                     
                 }
                 */
                 $j.colorbox.close();
                 
                 if($j.inArray( id, new Array('_axn2', '_axn3', '_axn4', '_axn5', '_axn8', '_axn9', '_axn10', '_axn12', '_axn13', '_s_axn14_1', '_s_axn14_2', '_s_axn14_3', '_s_axn14_4', '_s_axn14_5', '_s_axn14_6'))>=0){
                    
                    if($j.inArray( id, new Array('_axn2', '_axn8', '_axn12', '_axn13'))){ 
                        var config = { extraPlugins : 'vt_closeinbody,vt_dontshowagain,vt_minimizeinbody,vt_insertparams,vt_insert_templates' };
                        $j('.editor').ckeditor(config);
                    }
                    var optionspinner = {
                        'spn_1': {min: 10, max: 1000, decimal: 2, number_sep: false},
                        'spn_2': {min: 0, max: 100, decimal: 2, number_sep: false},
                        'spn_3': {min: 0, max: 1000, number_sep: false}        
                    };  
                    for (var n in optionspinner){
                        $j("."+n).spinner(optionspinner[n]);
                    }                                      
                 }
                 
                 // get the event back to the element
                 source_li.on('click', function(){
                    $j(this).off('click')
                    add_action_fieldset(this.id, $j(this));
                })
             }
        }
    })
}
    
// update the style textbox collectively from all the inputs off the css editor dropdown
function update_style_definition(obj){
    var coll = $j(obj).closest('.cssCollector');        
    var c = '';
    coll.find('input.css-prop-input').each(function(){
        if(!isEmpty($j(this))){
            c += $j(this).parent('td').prev('th').text()+':'+this.value+';';    
        } 
    })    
    coll.prev('input').val(c)
}

//open KCFinder FileManager
function openKCFinder(field, wrap_st, wrap_end, caller) {
    if($j.type(wrap_st) == 'undefined') wrap_st = '';
    if($j.type(wrap_end) == 'undefined') wrap_end = '';
    
    window.KCFinder = {
        callBack: function(url) {
            field.value = wrap_st+url+wrap_end;
            window.KCFinder = null;
            
            if($j.type(caller) != 'undefined'){
                caller.parent('ul').slideUp('fast');                
                update_style_definition(field)
            }
        }
    };
    window.open(_root_url + 'kcfinder/browse.php?type=images&langCode=en', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}       
    
    
// field validations:

function validate_rules(validate){
    
    if($j.type(validate) === 'undefined'){
        validate = 'block';
    }
    var err = 0 
    var initerr = 0 // for name and category only
    var egb = $j('.event-group-block')
    
    $j('#seg_name, #seg_cats_ph').removeClass('error')
    if(isEmpty($j('#seg_name'))){
        $j('#seg_name').addClass('error')
        initerr++
    }
    if(isEmpty($j('#hdn_seg_cats')) || $j('#hdn_seg_cats').val() == 0){
        $j('#seg_cats_ph').addClass('error')
        initerr++
    }
    if(initerr){return -1;}
    // remove any open jgrowl notification
    $j('.jGrowl-close').trigger('click')
    
    $j.each(egb, function(){
        
        var rc = $j(this).find('.rule-container li.event-block')
        $j.each(rc, function(){
            $j(this).find('.contenttitle').removeClass('error')
            id = $j(this).attr('data-id')
            switch(id){
                
                case '_s_mrc0':
                    var f1 = $j(this).find(".fieldset-wrapper select[data-code='p14']").removeClass('error')
                    var f2 = $j(this).find(".fieldset-wrapper input[data-code='p80']").removeClass('error')
                    var f3 = $j(this).find(".fieldset-wrapper input[data-code='p81']").removeClass('error')
                    var f4 = $j(this).find(".fieldset-wrapper input[data-code='p82']").removeClass('error')
                    var f5 = $j(this).find(".fieldset-wrapper input[data-code='p83']").removeClass('error')
                    var f6 = $j(this).find(".fieldset-wrapper select[data-code='p16']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f4.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f5.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f6.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // var err = 0                        
                    switch(f1.val()){
                        
                        case 'Between Dates': 
                            if(isEmpty(f2) || !isDate(f2.val(), 1)){
                                f2.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Date'})
                                err++
                            }    
                            if(isEmpty(f3) || !isDate(f3.val(), 1)){
                                f3.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Date'})
                                err++    
                            }
                            // now compare to and from dates
                            if(!err && Date.compare(Date.parse(f3.val()), Date.parse(f2.val())) == -1){
                                f2.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'To- Date is earlier than From- Date'})
                                f3.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'To- Date is earlier than From- Date'})
                                err++
                            }    
                        break;
                        case 'Between Daily Times': 
                            if(isEmpty(f4) || !isTime(f4.val())){
                                f4.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Time'})
                                err++
                            }
                            if(isEmpty(f5) || !isTime(f5.val())){
                                f5.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Time'})
                                err++
                            }
                        break;
                        case 'Days of Week': 
                            err = validate_min_selected(f6, err, 'Weekdays')                  
                        break;
                    }
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                case '_s_mrc1':
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p14']")
                    var f2  = $j(this).find(".fieldset-wrapper input[data-code='p80']").removeClass('error')
                    var f3  = $j(this).find(".fieldset-wrapper input[data-code='p81']").removeClass('error')
                    var f4  = $j(this).find(".fieldset-wrapper input[data-code='p82']").removeClass('error')
                    var f5  = $j(this).find(".fieldset-wrapper input[data-code='p83']").removeClass('error')
                    var f6  = $j(this).find(".fieldset-wrapper select[data-code='p16']").removeClass('error')
                     
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error')
                    
                    //f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f4.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f5.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f6.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // var err = 0                        
                    switch(f1.val()){
                        
                        case 'Between Dates': 
                            if(isEmpty(f2) || !isDate(f2.val(), 1)){
                                f2.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Date'})
                                err++
                            }    
                            if(isEmpty(f3) || !isDate(f3.val(), 1)){
                                f3.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Date'})
                                err++    
                            }
                            // now compare to and from dates
                            if(!err && Date.compare(Date.parse(f3.val()), Date.parse(f2.val())) == -1){
                                f2.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'To- Date is earlier than From- Date'})
                                f3.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'To- Date is earlier than From- Date'})
                                err++
                            }    
                        break;
                        case 'Between Daily Times': 
                            if(isEmpty(f4) || !isTime(f4.val())){
                                f4.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Time'})
                                err++
                            }
                            if(isEmpty(f5) || !isTime(f5.val())){
                                f5.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Time'})
                                err++
                            }
                        break;
                        case 'Days of Week': 
                            err = validate_min_selected(f6, err, 'Weekdays')
                        break;
                    }                        
                    
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)                        
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;    
                    
                
                case '_s_mrc2':
                     
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p7']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']:first").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:first").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']:first").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']:first").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']:first").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']:first").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']:first").removeClass('error')
                    
                    var f15 = $j(this).find(".fieldset-wrapper select[data-code='p12']").removeClass('error')
                    var f16 = $j(this).find(".fieldset-wrapper input[data-code='p91']").removeClass('error')
                    
                    var f17  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f18  = $j(this).find(".fieldset-wrapper select[data-code='p2']:last").removeClass('error')
                    var f19  = $j(this).find(".fieldset-wrapper input[data-code='p88']:last").removeClass('error')
                    var f20 = $j(this).find(".fieldset-wrapper input[data-code='p89']:last").removeClass('error')
                    var f21 = $j(this).find(".fieldset-wrapper input[data-code='p90']:last").removeClass('error')
                    var f22 = $j(this).find(".fieldset-wrapper select[data-code='p5']:last").removeClass('error')
                    var f23 = $j(this).find(".fieldset-wrapper select[data-code='p29']:last").removeClass('error')
                    var f24 = $j(this).find(".fieldset-wrapper select[data-code='p30']:last").removeClass('error')
                                            
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f16.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f17.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f18.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f19.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f20.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f21.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f22.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f23.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f24.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // var err = 0                        
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err) 
                    
                    
                    if( f15.val() == '>' || f15.val() == '<'){                            
                        err = validate_empty_numeric(f16, err)
                    }
                    
                    err = validate_pages_set(f17, f18, f19, f20, f21, f22, f23, f24, err) 
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                 
                
                case '_s_mrc3':
                     
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']:first").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:first").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']:first").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']:first").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']:first").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']:first").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']:first").removeClass('error')
                    
                    var f15 = $j(this).find(".fieldset-wrapper input[data-code='p92']").removeClass('error')
                                                                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f15.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                                            
                    // var err = 0                        
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    err = validate_empty_numeric(f15, err)                        
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                 
                case '_s_mrc4':
                    
                    // Firsr Set for 'From'
                     
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p17']") 
                     
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']:first").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']:first").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:first").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']:first").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']:first").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']:first").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']:first").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']:first").removeClass('error')
                    
                    var f15 = $j(this).find(".fieldset-wrapper select[data-code='p51']:first").removeClass('error')
                                            
                    var f16 = $j(this).find(".fieldset-wrapper select[data-code='p49']:first").removeClass('error')
                    var f17 = $j(this).find(".fieldset-wrapper select[data-code='p50']:first").removeClass('error')
                    var f18 = $j(this).find(".fieldset-wrapper select[data-code='p45']:first").removeClass('error')
                    var f19 = $j(this).find(".fieldset-wrapper select[data-code='p47']:first").removeClass('error')
                    var f20 = $j(this).find(".fieldset-wrapper select[data-code='p48']:first").removeClass('error')
                    
                    var f21 = $j(this).find(".fieldset-wrapper input[data-code='p94']:eq(1)").removeClass('error')
                    var f22 = $j(this).find(".fieldset-wrapper input[data-code='p94']:eq(0)").removeClass('error')
                    var f2 = $j(this).find(".fieldset-wrapper input[data-code='p93']").removeClass('error')
                                                                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                                            
                    f16.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f17.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f18.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f19.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f20.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f21.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f22.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // Second Set for 'To'
                    
                    var f23 = $j(this).find(".fieldset-wrapper select[data-code='p18']") 
                     
                    var f24 = $j(this).find(".fieldset-wrapper select[data-code='p4']:last").removeClass('error')
                    var f25 = $j(this).find(".fieldset-wrapper select[data-code='p2']:last").removeClass('error')
                    var f26 = $j(this).find(".fieldset-wrapper input[data-code='p88']:last").removeClass('error')
                    var f27 = $j(this).find(".fieldset-wrapper input[data-code='p89']:last").removeClass('error')
                    var f28 = $j(this).find(".fieldset-wrapper input[data-code='p90']:last").removeClass('error')
                    var f29 = $j(this).find(".fieldset-wrapper select[data-code='p5']:last").removeClass('error')
                    var f30 = $j(this).find(".fieldset-wrapper select[data-code='p29']:last").removeClass('error')
                    var f31 = $j(this).find(".fieldset-wrapper select[data-code='p30']:last").removeClass('error')
                    
                    var f32 = $j(this).find(".fieldset-wrapper select[data-code='p49']:last").removeClass('error')
                    var f33 = $j(this).find(".fieldset-wrapper select[data-code='p50']:last").removeClass('error')
                    var f34 = $j(this).find(".fieldset-wrapper select[data-code='p45']:last").removeClass('error')
                    var f35 = $j(this).find(".fieldset-wrapper select[data-code='p47']:last").removeClass('error')
                    var f36 = $j(this).find(".fieldset-wrapper select[data-code='p48']:last").removeClass('error')
                    
                    var f37 = $j(this).find(".fieldset-wrapper input[data-code='p94']:eq(2)").removeClass('error')  
                                          
                    var f3 = $j(this).find(".fieldset-wrapper select[data-code='p51']:last").removeClass('error')
                    var f4 = $j(this).find(".fieldset-wrapper input[data-code='p93']:last").removeClass('error')
                    var f5 = $j(this).find(".fieldset-wrapper input[data-code='p94']:eq(3)").removeClass('error')
                    
                    f23.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f24.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f25.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f26.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f27.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f28.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f29.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f30.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()                                                
                    f31.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f32.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f33.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f34.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f35.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f36.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f37.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f4.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f5.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                                          
                    // var err = 0                        
                    
                    switch(f1.val()){
                        case 'Pages':
                            err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)                                
                        break;
                        case 'Container':
                            err = validate_min_selected(f16, err, 'Container Type', false)
                            err = validate_min_selected(f17, err, 'Containers')                                
                            
                            if($j.inArray(f15.val(), new Array('>=', '>', '=', '!=', '<', '<='))>=0){
                                err = validate_empty_numeric(f22, err)
                            }else{
                                err = validate_empty(f2, err)
                            }
                        break;
                        case 'Segments Matched':
                            err = validate_min_selected(f18, err, 'Segments')
                            //err = validate_min_selected(f14, err)                            
                        break;
                        case 'Actions':
                            err = validate_min_selected(f19, err, 'Action Types')
                            err = validate_min_selected(f20, err, 'Actions')
                        break;
                    }    
                    
                    err = validate_empty_numeric(f21, err)                      
                    
                    
                    // Validating second set 
                    
                    switch(f23.val()){
                        case 'Pages':
                            err = validate_pages_set(f24, f25, f26, f27, f28, f29, f30, f31, err)                                
                        break;
                        case 'Container':
                            
                            err = validate_min_selected(f32, err, 'Container Type', false)
                            err = validate_min_selected(f33, err, 'Containers')                                
                            
                            if($j.inArray(f3.val(), new Array('>=', '>', '=', '!=', '<', '<='))>=0){
                                err = validate_empty_numeric(f37, err)
                            }else{
                                err = validate_empty(f4, err)
                            }
                       
                        
                        if(err){
                            $j(this).find('.seg-collapse').trigger('click')
                            $j(this).find('.contenttitle').addClass('error')                            
                        }   
                            
                        break;
                        case 'Segments Matched':
                            err = validate_min_selected(f34, err, 'Segments')                                
                                                            
                        break;
                        case 'Actions':
                            err = validate_min_selected(f35, err, 'Action Types')
                            err = validate_min_selected(f36, err, 'Actions')
                        break;
                    }
                    
                    //err = validate_empty_numeric(f37, err)
                    err = validate_empty_numeric(f5, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                    
                if(validate == 'block')   
                    break; 
               
               
                case '_s_mrc5':
                    // var err = 0
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error')                        
                    
                    var f15 = $j(this).find(".fieldset-wrapper input[data-code='p97']").removeClass('error')
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f15.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    err = validate_empty_numeric(f15, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                    
                case '_s_mrc6':
                case '_s_mrc7':
                case '_s_mrc8':
                case '_s_mrc80':
                case '_s_mrc10':
                    // var err = 0
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error')                        
                    
                    var f15 = $j(this).find(".fieldset-wrapper input[data-code='p98']").removeClass('error')
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f15.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    err = validate_empty_numeric(f15, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                
                
                case '_s_mrc11':
                    // var err = 0
                    
                    var f6  = $j(this).find(".fieldset-wrapper input[data-code='p88']:first").removeClass('error')
                    
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:last").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error')                        
                    
                    var f15 = $j(this).find(".fieldset-wrapper input[data-code='p98']").removeClass('error')
                    
                    
                    f6.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f15.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    err = validate_empty(f6, err)
                    err = validate_empty_numeric(f15, err)                        
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;  
                    
                    
               case '_s_mrc13':
               case '_s_mrc28':
               case '_s_mrc29':
               case '_s_mrc31':
                    // var err = 0
                    
                    if(id == '_s_mrc31')
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p6']").removeClass('error')
                    else                        
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:last").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error')                        
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;     
                    
                
                
                case '_s_mrc14':
                    // var err = 0
                    
                    var f6  = $j(this).find(".fieldset-wrapper input[data-code='p98']").removeClass('error')
                    
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:last").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error')                        
                    
                    f6.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_empty_numeric(f6, err)
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
               
               
                case '_s_mrc15':
                case '_s_mrc17':
                case '_s_mrc30':
                case '_s_mrc55':
                case '_s_mrc57':
                case '_s_mrc58':
                case '_s_mrc59':
                case '_s_mrc60':
                case '_s_mrc61':
                case '_s_mrc62':
                case '_s_mrc63':
                case '_s_mrc66':
                case '_s_mrc67':
                case '_s_mrc68':
                case '_s_mrc69':
                case '_s_mrc70':
                case '_s_mrc72':
                case '_s_mrc73':
                case '_s_mrc75':
                case '_s_mrc76':
                case '_s_mrc77':
                case '_s_mrc79':
                    // var err = 0
                    
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')                        
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']").removeClass('error')
                    
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_contains(f8, f9, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                case '_s_mrc18':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper input[data-code='p98']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_empty_numeric(f1, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;    
               
                
                case '_s_mrc19':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p52']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Countries')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc20':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p53']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p54']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Country', false)
                    err = validate_min_selected(f2, err, 'Regions')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc21':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p53']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p55']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Country', false)
                    err = validate_min_selected(f2, err, 'Cities')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                
                case '_s_mrc22':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p56']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Continents')
                                            
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                    
                case '_s_mrc23':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p25']").removeClass('error')
                    
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p4']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:last").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']").removeClass('error') 
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Visitor Types')
                    err = validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
               
                
                case '_s_mrc25':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p28']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                                            
                    err = validate_min_selected(f1, err, 'Languages')
                                            
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;      
                    
                
                
                case '_s_mrc26':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper input[data-code='p99']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                                            
                    err = validate_empty(f1, err)
                                            
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                    
                case '_s_mrc27':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p1']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p2']").removeClass('error')
                    var f3  = $j(this).find(".fieldset-wrapper input[data-code='p100']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Search Engine Types')                        
                    err = validate_contains(f2, f3, err)
                                            
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;                         
                
                
                
                case '_s_mrc28':
                     
                    var f7  = $j(this).find(".fieldset-wrapper select[data-code='p7']").removeClass('error')
                    var f8  = $j(this).find(".fieldset-wrapper select[data-code='p2']:first").removeClass('error')
                    var f9  = $j(this).find(".fieldset-wrapper input[data-code='p88']:first").removeClass('error')
                    var f10 = $j(this).find(".fieldset-wrapper input[data-code='p89']:first").removeClass('error')
                    var f11 = $j(this).find(".fieldset-wrapper input[data-code='p90']:first").removeClass('error')
                    var f12 = $j(this).find(".fieldset-wrapper select[data-code='p5']:first").removeClass('error')
                    var f13 = $j(this).find(".fieldset-wrapper select[data-code='p29']:first").removeClass('error')
                    var f14 = $j(this).find(".fieldset-wrapper select[data-code='p30']:first").removeClass('error')
                                            
                    f7.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f8.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f9.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f10.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f11.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f12.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f13.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f14.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                if(validate == 'block')   
                    break;
                    
                    
                
                case '_s_mrc32':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p58']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Domains')
                                            
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;    
               
                
                case '_s_mrc33':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p59']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p60']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Domain Types', false)
                    err = validate_min_selected(f2, err, 'Domains')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                    
                case '_s_mrc34':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p61']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p62']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Domain Types')
                    err = validate_min_selected(f2, err, 'Domains')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc35':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p63']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Operating Systems')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;       
                
                
                case '_s_mrc36':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p64']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p65']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Web Browsers')
                    err = validate_min_selected(f2, err, 'Web Browsers Versions')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
               
                case '_s_mrc37':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p31']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Screen Bit Depths')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc38':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p66']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Platforms')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                case '_s_mrc41':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p67']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Media Versions')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                    
                case '_s_mrc43':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p47']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p48']").removeClass('error')
                    var f3  = $j(this).find(".fieldset-wrapper input[data-code='p94']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Action Types')
                    err = validate_min_selected(f2, err, 'Actions')                        
                    err = validate_empty_numeric(f3, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;  
                    
                    
                    
                case '_s_mrc44':
                    
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p49']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p50']").removeClass('error')
                    var f3  = $j(this).find(".fieldset-wrapper select[data-code='p51']").removeClass('error')
                    var f4  = $j(this).find(".fieldset-wrapper input[data-code='p93']").removeClass('error')                        
                    var f5  = $j(this).find(".fieldset-wrapper input[data-code='p94']:first").removeClass('error')
                    var f6  = $j(this).find(".fieldset-wrapper input[data-code='p94']:last").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f4.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f5.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f6.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                                            
                    err = validate_min_selected(f1, err, 'Container Type', false)
                    err = validate_min_selected(f2, err, 'Containers')                                
                    
                    if($j.inArray(f3.val(), new Array('>=', '>', '=', '!=', '<', '<='))>=0){
                        err = validate_empty_numeric(f5, err)
                    }else{
                        err = validate_empty(f4, err)
                    }
                    
                    err = validate_empty_numeric(f6, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                case '_s_mrc45':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p45']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper input[data-code='p94']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Segments to be matched')                        
                    err = validate_empty_numeric(f2, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                    
                case '_s_mrc46':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p69']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper input[data-code='p94']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Goals')                        
                    err = validate_empty_numeric(f2, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;    
                    
                    
                    
                case '_s_mrc47':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p70']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper input[data-code='p94']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Goals Achieved')                        
                    err = validate_empty_numeric(f2, err)
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc48':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p70']").removeClass('error')                        
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Campaigns')                        
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc49':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p71']").removeClass('error')                        
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Lists')                        
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                    
                    
                case '_s_mrc50':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p73']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p74']").removeClass('error')
                    var f3  = $j(this).find(".fieldset-wrapper select[data-code='p75']").removeClass('error')
                                            
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Types')
                    err = validate_min_selected(f2, err, 'Campaigns')
                    err = validate_min_selected(f3, err, 'Messages')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break; 
                
                case '_s_mrc51':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper select[data-code='p73']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper select[data-code='p74']").removeClass('error')
                    var f3  = $j(this).find(".fieldset-wrapper select[data-code='p75']").removeClass('error')
                    var f4  = $j(this).find(".fieldset-wrapper select[data-code='p76']").removeClass('error')
                                            
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f3.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f4.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_min_selected(f1, err, 'Types')
                    err = validate_min_selected(f2, err, 'Campaigns')
                    err = validate_min_selected(f3, err, 'Messages')
                    err = validate_min_selected(f4, err, 'Variations')
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                case '_s_mrc52':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper input[data-code='p101']").removeClass('error')
                    var f2  = $j(this).find(".fieldset-wrapper input[data-code='p102']").removeClass('error')
                    
                    $j.each(f1, function(){
                        
                        var my_indx = f1.index($j(this));
                        
                        $j(this).prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                        tmp_err1 = err
                        err = validate_empty_numeric($j(this), err) 
                        
                        if(tmp_err1 == err && parseInt($j(this).val())>100)  {
                            $j(this).addClass('error')
                                .prev('label').find('.tips')
                                .removeClass('hidden').addClass('disp-inline')
                                .colorTip({color:'red', align: 'left', content: 'Field value should not exceed 100'})
                        }
                        
                        
                        this_f2 = f2.filter(':eq('+my_indx+')');
                        
                        this_f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                        tmp_err2 = err
                        err = validate_empty_numeric(this_f2, err) 
                        
                        if(tmp_err2 == err && parseInt(this_f2.val())>100)  {
                            this_f2.addClass('error')
                                .prev('label').find('.tips')
                                .removeClass('hidden').addClass('disp-inline')
                                .colorTip({color:'red', align: 'left', content: 'Field value should not exceed 100'})
                        }
                        
                        // if no error occurred in previous validations
                        if(tmp_err1 == err && tmp_err2 == err){
                            
                            if($j(this).val() > this_f2.val()){
                                $j(this).addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'This field should have smaller value than the following field.'})
                                    
                                this_f2.addClass('error')
                                    .prev('label').find('.tips')
                                    .removeClass('hidden').addClass('disp-inline')
                                    .colorTip({color:'red', align: 'left', content: 'This field should have greater value than the following field.'})
                                    
                                    
                               err++         
                            }
                        }                         
                        
                    })
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;     
                
                
                
                case '_s_mrc53':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper input[data-code='p101']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    tmp_err = err
                    err = validate_empty_numeric(f1, err) 
                        
                    if(tmp_err == err && parseInt(f1.val())>100)  {
                        f1.addClass('error')
                            .prev('label').find('.tips')
                            .removeClass('hidden').addClass('disp-inline')
                            .colorTip({color:'red', align: 'left', content: 'Field value should not exceed 100'})
                    }
                        
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                
                
                
                case '_s_mrc54':
                    // var err = 0
                    
                    var f1  = $j(this).find(".fieldset-wrapper input[data-code='p94']").removeClass('error')
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    err = validate_empty_numeric(f1, err) 
                        
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                
                    
                 
                /* FACEBOOK STARTS HERE */
               
                case '_s_mrc56':
                    var f1 = $j(this).find(".fieldset-wrapper input[data-code='p80']").removeClass('error')
                    var f2 = $j(this).find(".fieldset-wrapper input[data-code='p81']").removeClass('error')
                    
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    f2.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // var err = 0                        
                    
                    if(isEmpty(f1) || !isDate(f1.val(), 1)){
                        f1.addClass('error')
                            .prev('label').find('.tips')
                            .removeClass('hidden').addClass('disp-inline')
                            .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Date'})
                        err++
                    }    
                    if(isEmpty(f2) || !isDate(f2.val(), 1)){
                        f2.addClass('error')
                            .prev('label').find('.tips')
                            .removeClass('hidden').addClass('disp-inline')
                            .colorTip({color:'red', align: 'left', content: 'Empty or Invalid Date'})
                        err++    
                    }
                    // now compare to and from dates
                    if(!err && Date.compare(Date.parse(f2.val()), Date.parse(f1.val())) == -1){
                        f1.addClass('error')
                            .prev('label').find('.tips')
                            .removeClass('hidden').addClass('disp-inline')
                            .colorTip({color:'red', align: 'left', content: 'To- Date is earlier than From- Date'})
                        f2.addClass('error')
                            .prev('label').find('.tips')
                            .removeClass('hidden').addClass('disp-inline')
                            .colorTip({color:'red', align: 'left', content: 'To- Date is earlier than From- Date'})
                        err++
                    }    
                        
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;
                    
                    
                    
                case '_s_mrc71':
                    var f1 = $j(this).find(".fieldset-wrapper input[data-code='p103']").removeClass('error')                        
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // var err = 0
                    err = validate_empty_numeric(f1, err) 
                    this_yr = new Date().toString('yyyy');
                    
                    if(!err && (parseInt(f1.val()) < 1950 || parseInt(f1.val()) > this_yr) ){
                        f1.addClass('error')
                            .prev('label').find('.tips')
                            .removeClass('hidden').addClass('disp-inline')
                            .colorTip({color:'red', align: 'left', content: 'Year must be within the range of 1950 - '+this_yr})
                        err++
                    }                            
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;  
                    
                    
                case '_s_mrc74':
                case '_s_mrc78':
                    var f1 = $j(this).find(".fieldset-wrapper input[data-code='p98']").removeClass('error')                        
                    f1.prev('label').find('.tips').addClass('hidden').removeClass('disp-inline').find('.colorTip').remove()
                    
                    // var err = 0
                    err = validate_empty_numeric(f1, err) 
                    
                    if(err){
                        $j(this).find('.seg-collapse').trigger('click')
                        $j(this).find('.contenttitle').addClass('error')                            
                    }
                    
                if(validate == 'block')   
                    break;         
                                                                             
            }
        })
    })

    return err
}
    
function validate_pages_set(f7, f8, f9, f10, f11, f12, f13, f14, err){
    
    switch(f7.val()){
                                
        case 'Full URL':                            
        case 'URL Path':
        case 'Hostname':
        case 'Fragment':
            
            err = validate_contains (f8, f9, err)
            
        break;
        case 'URL Parameters': 
            err = validate_empty(f10, err)                                   
            err = validate_empty(f11, err)
        break;                            
        case 'Page Title':
            if(f12.val() == 'Equals To' || f12.val() == 'Not Equal To'){
                err = validate_min_selected(f13, err, 'Page Title')                                    
            }
        break;
        case 'Page Group':                
            err = validate_min_selected(f14, err, 'Page Group', false)
        break;
    }
    
    return err;
}

function validate_contains(f8, f9, err){
    switch(f8.val()){            
        case 'Contains':
        case 'Does Not Contain':
        case 'Equals':
        case 'Does Not Equal':
        case 'Matches by RegEx':
        case 'Starts With':
        case 'Ends With':
            err = validate_empty(f9, err)
        break;
    }
    
    return err;
}

function validate_empty_numeric(f1, err){
    if(isEmpty(f1)){
        f1.addClass('error')
                    .prev('label').find('.tips')
                    .removeClass('hidden').addClass('disp-inline')
                    .colorTip({color:'red', align: 'left', content: 'Field cannot be empty'})
        err++                           
    }else if( !isNumeric(f1.val()) || parseInt(f1.val()) < 0){
        f1.addClass('error')
                    .prev('label').find('.tips')
                    .removeClass('hidden').addClass('disp-inline')
                    .colorTip({color:'red', align: 'left', content: 'Field value should be numeric and greater than or equals to 0'})
        err++                           
    }
    return err;
}

function validate_empty(f1, err){
    if(isEmpty(f1)){
        f1.addClass('error')
                    .prev('label').find('.tips')
                    .removeClass('hidden').addClass('disp-inline')
                    .colorTip({color:'red', align: 'left', content: 'Field cannot be empty'})
        err++                           
    }
    return err;
}

// at least 1 selected
// type: single selection or multi-select
function validate_min_selected(f1, err, term, multi_select, min){
    if($j.type(min) == 'undefined') min = 1;
    if($j.type(term) == 'undefined') term = 'Item';
    if($j.type(multi_select) == 'undefined') multi_select = true;
    
    if(f1.find('option:selected').length < min || (!multi_select && isEmpty(f1))){
        f1.addClass('error')
                    .prev('label').find('.tips')
                    .removeClass('hidden').addClass('disp-inline')
                    .colorTip({color:'red', align: 'left', content: (multi_select ? 'Select one or more ' : 'Select a ')+term})
        err++                      
    }
    
    return err;   
}

function save_rules(){
    
    $j('.event-group-block').each(function(){            
        if($j(this).find('.rule-container li').length == 0){
            $j(this).remove()
        }            
    })
    
    if($j('.event-group-block').length == 0){
        $j.jGrowl('Sorry! Can\'t save with no segment rules defined.', {life: 5000, beforeOpen: function(){$j('.jGrowl-close').trigger('click') }});
        return false;
    }
    
    $j('#btn_save_rules').off('click');
    
    var vr = validate_rules();
    if(vr===0){            
        $j.ajax({                
            url: _site_url+'ajax/save_segments',
            type: 'post',
            dataType: 'json',
            //data: $j.merge($j('#frmAddAction').serializeArray(), $j('#frmAddAction:hidden').serializeArray()),
            data: $j('input:not(:disabled):visible, select:not(:disabled):visible, input:not(:disabled):hidden, select:not(:disabled):hidden', $j('#frmAddAction')).serializeArray(),
            success: function(r){
                if(r.seg_id>0){
                    $j('#seg_id').val(r.seg_id);
                    $j.jGrowl(r.mode=='add'?"Segment Created!":'Segment Updated!!', {life: 10000});
                }
                $j('#btn_save_rules').on('click', save_rules);
            },
            error: function(a, b){                    
                $j('#btn_save_rules').on('click', save_rules);
                alert('There was an error while submitting your data. Please retry.')
            }                
        })
    }else if(vr == -1){
        //remove any existing jgrowls
        $j('#btn_save_rules').on('click', save_rules);
        $j.jGrowl('Please fill up the red-bordered fields.', {life: 20000, beforeOpen: function(){$j('.jGrowl-close').trigger('click') }}); 
        return false;
    }else{
        $j('#btn_save_rules').on('click', save_rules);
        //remove any existing jgrowls
        $j('.jGrowl-close').trigger('click')
        $j.jGrowl('Please clear all the errors before proceeding. Errors are highlight red for your convinience.', {life: 20000, beforeOpen: function(){$j('.jGrowl-close').trigger('click') }}); 
        return false;
    }
}   

$j(function(){
    
    // collapse the left navigation menu
    $j('#togglemenuleft a').trigger('click');
    
    $j('#wizard2').smartWizard({keyNavigation: false});
    
    // add event block wrapper
    $j('#btn_add_axn').on('click', function(e, random_id, so){        
          $j.colorbox({inline:true, width: '25%', height: '542px', href:$j('#selectable_action_cats .widgetbox')}); 
          return false;  
    })  
    
    
    // bind click event to each item in the pop-up action type selection
    $j('.widgetbox .linklist li a').on('click', function(){
        $j(this).off('click')
        add_action_fieldset(this.id, $j(this));
    })
    
    $j('#btn_close_axn').on('click', function(){
        $j('#frmAddAction').slideUp(800, function(){
            $j(this).removeAttr('style').addClass('hidden')
            $j('#dynamic_form_ph').html('')
        })
    })
    
    // Hide cssCollector when clicked elsewhere ---- >    
    $j("body").on('click', function(e ){
        var target = $j(e.target);
        if(!target.parents().is(".cssCollector") && !target.is(".cssCollector") && !target.is("input[data-code=p91]") && !target.is(".colorpicker") && !target.is(".colorpicker *")){
            $j("body").find(".cssCollector").hide().find('ul').slideUp('fast');
        }
    });
    // End of  ... Hide cssCollector when clicked elsewhere ---- >
    
    // Hide cssCollector's UL dropdown when clicked elsewhere ---- >    
    $j(document).on('click', '.cssCollector', function(e){
        var target = $j(e.target);
        if(!target.parents().is("input") && !target.is("input")){
            $j(".cssCollector").find("ul:not(.color-matrix):visible").slideUp('fast');
        }
    });
    // End of  ... Hide cssCollector's UL dropdown when clicked elsewhere ---- >    
    
    // When this Style textbox is on focus...show the style input collectro form dropdown
    $j(document).on('focus', "input[data-code='p91']", function(){
        $j(this).next('.cssCollector').slideDown('fast')
    })
    $j(document).on('focus', ".cssCollector input", function(){
        $j('.cssCollector:visible ul:not(.color-matrix)').slideUp('fast')
        $j(this).next('ul:not(.color-matrix)').slideDown('fast')
    })
    
    $j(document).on('click', ".cssCollector li", function(){        
        
        if($j(this).hasClass('color-selector')){  
            
            $j(this).parent('ul:not(.color-matrix)').hide().prev('input').addClass('focused');
            $j('.hdn-colorpicker').trigger('click')
            
        }else if($j(this).hasClass('image-selector')){
            
             openKCFinder($j(this).parent('ul').prev('input').get(0), 'url(\'', '\')', $j(this))             
             
        }else if($j(this).hasClass('percentage')){
            
            $j(this).closest('tr').next('.pc-entry').show().next('.length-entry').hide()
            $j(this).parent('ul:not(.color-matrix)').slideUp('fast')            
            
        }else if($j(this).hasClass('length')){
            
            $j(this).closest('tr').next('.pc-entry').hide().next('.length-entry').show()
            $j(this).parent('ul:not(.color-matrix)').slideUp('fast')        
        }
        else{
            
            $j(this).parent().prev('input:text').val($j(this).text())
            //hide any percentage or length form if previously displayed
            $j(this).closest('tr').next('.pc-entry').hide().next('.length-entry').hide()            
            $j(this).parent('ul:not(.color-matrix)').slideUp('fast')
            update_style_definition($j(this).parent().prev('input:text').get())
            
        }        
    })
    // when color palette block is clicked, get and put the color name to the textbox
    .on('click', ".color-matrix li img", function(e){
        $j(this).closest('.matrix').parent('ul').prev('input:text').val($j(this).attr('title'))
        //hide any percentage or length form if previously displayed
        $j(this).closest('tr').next('.pc-entry').hide().next('.length-entry').hide()            
        $j(this).closest('.matrix').parent('ul:not(.color-matrix)').slideUp('fast')
        update_style_definition($j(this).closest('.matrix').parent('ul').prev('input:text').get())
        e.stopPropagation()
    })
    //clear all fields
    .on('click', '.css-clear', function(){
        $j('.css-prop-input').each(function(){
            $j(this).val('')
        })
        $j(this).closest('.cssCollector').prev('input').val('')
        return false;
    })
    
    // OK and Cancel events for the Percentage and Length CSS properties in cssCollector
    $j(document)
        .on('click', ".pc-ok", function(){
            var input_type = $j(this).closest('tr').attr('class');
            
            if(input_type == 'pc-entry'){
                var txtbx = $j(this).prev('.pc-input').removeClass('error')
            }else{
                var txtbx = $j(this).prev().prev('.ln-input').removeClass('error')
            }
            
            if(isEmpty(txtbx) || !isNumeric(txtbx.val())){
                txtbx.addClass('error')
            }else{
                if(input_type == 'pc-entry'){
                    val = txtbx.val() + '%';
                    $j(this).closest('tr').prev('tr').find('input').val( val )
                    update_style_definition($j(this).closest('tr').prev('tr').find('input').get())
                }else{        
                    val = txtbx.val() + txtbx.next('select.ln-type').val()
                    $j(this).closest('tr').prev('tr').prev('tr').find('input').val( val )
                    update_style_definition($j(this).closest('tr').prev('tr').prev('tr').find('input').get())
                }
                $j('.'+input_type).hide()                
            }        
        })
        .on('click', ".pc-cancel", function(){
            var input_type = $j(this).closest('tr').attr('class');
            $j('.'+input_type).hide()
        })
        // update the style textbox collectively from all the inputs off the css editor dropdown
        .on('change', '.css-prop-input', function(){
            var coll = $j(this).closest('.cssCollector');        
            var c = '';
            coll.find('input.css-prop-input').each(function(){
                if(!isEmpty($j(this))){
                    c += $j(this).parent('td').prev('th').text()+':'+this.value+';';    
                } 
            })    
            coll.prev('input').val(c)        
        })  
        // colorpicker for Font Properties Action
        .on('focus', 'input[data-code=p108], input[data-code=p109]', function(){
        
            $j(this).ColorPicker({
                    onSubmit: function(hsb, hex, rgb, el) {
                        $j(el).val('#'+hex);
                        $j(el).ColorPickerHide();
                    },
                    onBeforeShow: function () {
                        $j(this).ColorPickerSetColor(this.value);
                    },
                    onChange: function (hsb, hex, rgb, el) {
                        $j(el).val('#'+hex);
                    }
                })
                
                $j(this).ColorPickerShow();
                $j(this).ColorPickerSetColor(this.value);                        
        })      
        
    // color picker for live event on Pop-Up actions
    $j('.hdn-colorpicker').ColorPicker({
        onShow: function (colpkr) {
            var cssCollector = $j('.cssCollector:visible');
            var target = $j('.cssCollector:visible input.focused');
            var coll_pos = cssCollector.offset();
            var pos = target.offset();
            
            var left = coll_pos.left-10, top = pos.top-10;
            $j(colpkr).css({top: top, left: left})
            
            $j(colpkr).fadeIn(500);            
            return false;
        },
        onHide: function (colpkr) {
            $j(colpkr).fadeOut(500);
            $j('.cssCollector input.focused').removeClass('focused');
            return false;
        },
        onSubmit: function(hsb, hex, rgb, el) {
            $j('.cssCollector input.focused').val('#'+hex)
            .next('ul').find('.color-selector').find('.color-chooser').css('background-color', '#'+hex)
            $j(el).ColorPickerHide();
            update_style_definition($j('.cssCollector input.focused').get())
        },
        onChange: function (hsb, hex, rgb) {
           $j('.cssCollector input.focused').val('#'+hex)
            .next('ul').find('.color-selector').find('.color-chooser').css('background-color', '#'+hex)
        }
    });
                 
})


    