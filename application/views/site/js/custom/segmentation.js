var _VALIDATION_ON = true; 

function p2(obj){
    if(obj.value == 'Is Empty' || obj.value == 'Is Not Empty')
        $j(obj).parent().next('.wrp_flds').addClass('hidden').find('input').attr('disabled', 'disabled');
    else
        $j(obj).parent().next('.wrp_flds').removeClass('hidden').find('input').removeAttr('disabled');
}

function p4(obj, retainInitialSelection){
    
    var _parent     = $j(obj).parent();   
    var _ctns       = _parent.next('.ctns');
    var _ctns_txt   = _ctns.next('.ctns_txt');
    var _nm_pair    = _ctns_txt.next('.nm_pair');
    var _val_pair   = _nm_pair.next('.val_pair');
    var _eqls       = _val_pair.next('.eqls'); 
    var _pg_title   = _eqls.next('.pg_title');
    var _pg_grp     = _pg_title.next('.pg_grp');
       
    retainInitialSelection = $j.type(retainInitialSelection) == 'undefined' ? false : retainInitialSelection;
    
    if(obj.value == 'All Pages' || obj.value == 'Current Pages'){
        
        _ctns.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        _ctns_txt.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        _nm_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        _val_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        _pg_title.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        _pg_grp.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        _eqls.addClass('hidden').find('input, select').attr('disabled', 'disabled')
        
        
    }else if(obj.value == 'URL Parameters'){
                
        _ctns.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _ctns_txt.addClass('hidden').find('input, select').attr('disabled', 'disabled');        
        _nm_pair.removeClass('hidden').find('input, select').removeAttr('disabled');
        _val_pair.removeClass('hidden').find('input, select').removeAttr('disabled');
        _pg_title.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _pg_grp.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _eqls.addClass('hidden').find('input, select').attr('disabled', 'disabled');
           
    }else if(obj.value == 'Full URL' || obj.value == 'URL Path' || obj.value == 'Hostname' || obj.value == 'Fragment'){
        
        _ctns.removeClass('hidden').find('input, select').removeAttr('disabled');
        if(!retainInitialSelection)
        _ctns.removeClass('hidden').find('select').find('option:selected').removeAttr('selected').end().find('option:first').attr('selected', 'selected');
        _ctns_txt.removeClass('hidden').find('input, select').removeAttr('disabled');        
        _nm_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _val_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _pg_title.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _pg_grp.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _eqls.addClass('hidden').find('input, select').attr('disabled', 'disabled');
                   
    }else if(obj.value == 'Page Title'){
        
        _ctns.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _ctns_txt.addClass('hidden').find('input, select').attr('disabled', 'disabled');        
        _nm_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _val_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _pg_title.removeClass('hidden').find('input, select').removeAttr('disabled');
        _pg_grp.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _eqls.removeClass('hidden').removeClass('hidden').find('input, select').removeAttr('disabled');
           
    }else if(obj.value == 'Page Group'){
        
        _ctns.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _ctns_txt.addClass('hidden').find('input, select').attr('disabled', 'disabled');        
        _nm_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _val_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _pg_title.addClass('hidden').find('input, select').attr('disabled', 'disabled');
        _pg_grp.removeClass('hidden').find('input, select').removeAttr('disabled');
        _eqls.addClass('hidden').find('input, select').attr('disabled', 'disabled');        
        
    }        
}

function p5(obj){
    
    var _parent = $j(obj).parent();
    var _pg_title = _parent.next('.pg_title');
    
    if(obj.value == 'Equals To' || obj.value == 'Not Equal To'){
        _pg_title.removeClass('hidden').find('input, select').removeAttr('disabled');
    }else if(obj.value == 'Empty' || obj.value == 'Not Empty'){
        _pg_title.addClass('hidden').find('input, select').attr('disabled', 'disabled'); 
    }        
}

function p6(obj){
    
    p4(obj);        
}


function p7(obj){
     
    p4(obj)     
}

function p11(obj){
    var _parent = $j(obj).parent().parent();
    if(obj.value == 'Views'){
        $j('.wrp_flds.cnt_prct:first', _parent).removeClass('hidden').find('select').removeAttr('disabled');
        $j('.wrp_flds.sec_prct:first', _parent).addClass('hidden').find('select').attr('disabled', 'disabled');
    }else{
        $j('.wrp_flds.sec_prct:first', _parent).removeClass('hidden').find('select').removeAttr('disabled');
        $j('.wrp_flds.cnt_prct:first', _parent).addClass('hidden').find('select').attr('disabled', 'disabled');   
    }        
}

function p12(obj){
    var _parent = $j(obj).parent().parent();
    var vw_tm = $j(obj).parent().prev('.vw_tm').find('select');
    if(obj.value == '>' || obj.value == '<'){
        $j(obj).parent().next('.mr_ls_txt:first').removeClass('hidden').find('input').removeAttr('disabled').val('0');
        if(vw_tm.val() == 'Time'){
            $j(obj).parent().next('.mr_ls_txt:first').next('.cnt_prct:first').addClass('hidden').find('select').removeAttr('disabled');
            $j(obj).parent().next('.mr_ls_txt:first').next('.cnt_prct:first').next('.sec_prct:first').removeClass('hidden').find('select').removeAttr('disabled');    
        }else{
            $j(obj).parent().next('.mr_ls_txt:first').next('.cnt_prct:first').removeClass('hidden').find('select').removeAttr('disabled');
            $j(obj).parent().next('.mr_ls_txt:first').next('.cnt_prct:first').next('.sec_prct:first').addClass('hidden').find('select').removeAttr('disabled');
        }
    }else{
        $j(obj).parent().next('.mr_ls_txt:first').addClass('hidden').find('input').attr('disabled', 'disabled').val('0')
        $j(obj).parent().next('.mr_ls_txt:first').next('.cnt_prct:first').addClass('hidden').find('select').attr('disabled', 'disabled');
        $j(obj).parent().next('.mr_ls_txt:first').next('.cnt_prct:first').next('.sec_prct:first').addClass('hidden').find('select').attr('disabled', 'disabled');
    }        
}

function p14(obj){
    var _parent = $j(obj).parent().parent();
    now = new Date();
    if(obj.value == 'Between Dates'){
        $j('.wrp_flds.dp1, .wrp_flds.dp2', _parent).removeClass('hidden').find('input').removeAttr('disabled').val(now.format("isoDate"));
        $j('.wrp_flds.tp1, .wrp_flds.tp2, .wrp_flds.dyp', _parent).addClass('hidden').find('input, select').attr('disabled', 'disabled');
    }else if(obj.value == 'Between Daily Times'){
        $j('.wrp_flds.tp1, .wrp_flds.tp2', _parent).removeClass('hidden').find('input').removeAttr('disabled').val(now.format("shkTime"));
        $j('.wrp_flds.dp1, .wrp_flds.dp2, .wrp_flds.dyp', _parent).addClass('hidden').find('input, select').attr('disabled', 'disabled');   
    }else if(obj.value == 'Days of Week'){
        $j('.wrp_flds.dyp', _parent).removeClass('hidden').find('select').removeAttr('disabled');
        $j('.wrp_flds.dp1, .wrp_flds.dp2, .wrp_flds.tp1, .wrp_flds.tp2', _parent).addClass('hidden').find('input, select').attr('disabled', 'disabled');   
    }        
}

function p17(obj, retainInitialSelection){
    
    var _parent      = $j(obj).parent();
    var _seg_mtch    = _parent.next('.seg_mtch');
    var _axn_types   = _seg_mtch.next('.axn_types');
    var _axns        = _axn_types.next('.axns');
    var _axn_status  = _axns.next('.axn_status');
    
    var _cntnr_types = _axn_status.next('.cntnr_types');
    var _cntnrs      = _cntnr_types.next('.cntnrs');
    var _ctns_op     = _cntnrs.next('.ctns_op');
    var _ctns_op_txt1= _ctns_op.next('.ctns_op_txt1');
    var _ctns_op_txt2= _ctns_op_txt1.next('.ctns_op_txt2');
    
    var _pg_n_url   = _ctns_op_txt2.next('.pg_n_url');
    var _ctns       = _pg_n_url.next('.ctns');
    var _ctns_txt   = _ctns.next('.ctns_txt');
    var _nm_pair    = _ctns_txt.next('.nm_pair');
    var _val_pair   = _nm_pair.next('.val_pair');
    var _eqls       = _val_pair.next('.eqls'); 
    var _pg_title   = _eqls.next('.pg_title');
    var _pg_grp     = _pg_title.next('.pg_grp');
    
    retainInitialSelection = $j.type(retainInitialSelection) == 'undefined' ? false : retainInitialSelection;
    
    if(obj.value == 'First Visit'){
        
        _seg_mtch.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axns.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_status.addClass('hidden').find('select').attr('disabled', 'disabled');
        _cntnr_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _cntnrs.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op_txt1.addClass('hidden').find('input').attr('disabled', 'disabled');
        _ctns_op_txt2.addClass('hidden').find('input').attr('disabled', 'disabled');
        _pg_n_url.addClass('hidden').find('select').attr('disabled', 'disabled');
        
    }else if(obj.value == 'Pages'){
        
        _seg_mtch.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axns.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_status.addClass('hidden').find('select').attr('disabled', 'disabled');         
        _cntnr_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _cntnrs.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op_txt1.addClass('hidden').find('input').attr('disabled', 'disabled');
        _ctns_op_txt2.addClass('hidden').find('input').attr('disabled', 'disabled');
        _pg_n_url.removeClass('hidden').find('select').removeAttr('disabled');
        if(!retainInitialSelection)
        _pg_n_url.removeClass('hidden').find('select').find('option:selected').removeAttr('selected').end().find('option:first').attr('selected', 'selected');
        
    }else if(obj.value == 'Container'){
        
        _seg_mtch.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axns.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_status.addClass('hidden').find('select').attr('disabled', 'disabled');        
        _cntnr_types.removeClass('hidden').find('select').removeAttr('disabled');
        _cntnrs.removeClass('hidden').find('select').removeAttr('disabled');
        _ctns_op.removeClass('hidden').find('select').removeAttr('disabled');
        if(!retainInitialSelection)
        _ctns_op.removeClass('hidden').find('select').find('option:selected').removeAttr('selected').end().find('option:first').attr('selected', 'selected')
        
        _ctns_op_txt1.removeClass('hidden').find('input').removeAttr('disabled', 'disabled');
        _ctns_op_txt2.addClass('hidden').find('input').attr('disabled', 'disabled');
        _pg_n_url.addClass('hidden').find('select').attr('disabled', 'disabled');
        
    }else if(obj.value == 'Segments Matched'){
        
        _seg_mtch.removeClass('hidden').find('select').removeAttr('disabled');
        _axn_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axns.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_status.addClass('hidden').find('select').attr('disabled', 'disabled');
        _cntnr_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _cntnrs.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op_txt1.addClass('hidden').find('input').attr('disabled', 'disabled');
        _ctns_op_txt2.addClass('hidden').find('input').attr('disabled', 'disabled');
        _pg_n_url.addClass('hidden').find('select').attr('disabled', 'disabled');
        
    }else if(obj.value == 'Actions'){
        
        _seg_mtch.addClass('hidden').find('select').attr('disabled', 'disabled');
        _axn_types.removeClass('hidden').find('select').removeAttr('disabled');
        _axns.removeClass('hidden').find('select').removeAttr('disabled');
        _axn_status.removeClass('hidden').find('select').removeAttr('disabled');
        _cntnr_types.addClass('hidden').find('select').attr('disabled', 'disabled');
        _cntnrs.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op.addClass('hidden').find('select').attr('disabled', 'disabled');
        _ctns_op_txt1.addClass('hidden').find('input').attr('disabled', 'disabled');
        _ctns_op_txt2.addClass('hidden').find('input').attr('disabled', 'disabled');
        _pg_n_url.addClass('hidden').find('select').attr('disabled', 'disabled');
        
    }      
    
    _ctns.addClass('hidden').find('input, select').attr('disabled', 'disabled')
    _ctns_txt.addClass('hidden').find('input, select').attr('disabled', 'disabled')
    _nm_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled')
    _val_pair.addClass('hidden').find('input, select').attr('disabled', 'disabled')
    _pg_title.addClass('hidden').find('input, select').attr('disabled', 'disabled')
    _pg_grp.addClass('hidden').find('input, select').attr('disabled', 'disabled')
    _eqls.addClass('hidden').find('input, select').attr('disabled', 'disabled')
}

function p18(obj, retainInitialSelection){
    retainInitialSelection = $j.type(retainInitialSelection) == 'undefined' ? false : retainInitialSelection;
    p17(obj, retainInitialSelection);   
}

function p36(obj){
    var _parent = $j(obj).parent();
    var _gls   = _parent.next('.gls');
    
    $j.ajax({
        url: _site_url+'ajax/goals_list',
        data: {'type': obj.value},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _gls.find('select').html(r.html);
             }else{
                 _gls.find('select').html('');                 
             }
        }
    })
}


function p47(obj){
    var _parent = $j(obj).parent();
    var _axns   = _parent.next('.axns');
        
    var _sel_opts   = $j(obj).find('option:selected');    
    var ids     = _sel_opts.map(function(){ return $j(this).val() }).toArray().join("|");
    
    $j.ajax({
        url: _site_url+'ajax/actions_list',
        data: {'type': ids},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _axns.find('select').html(r.html);
             }else{
                 _axns.find('select').html('');                 
             }
        }
    })
}


function p51(obj){
    var _parent     = $j(obj).parent();
    var _ctns_op_txt1   = _parent.next('.ctns_op_txt1');
    var _ctns_op_txt2  = _ctns_op_txt1.next('.ctns_op_txt2');
    
    if($j.inArray(obj.value, new Array('>=', '>', '=', '!=', '<', '<='))>=0){
        _ctns_op_txt1.addClass('hidden').find('input').attr('disabled', 'disabled');
        _ctns_op_txt2.removeClass('hidden').find('input').removeAttr('disabled');
    }else{
        _ctns_op_txt2.addClass('hidden').find('input').attr('disabled', 'disabled');
        _ctns_op_txt1.removeClass('hidden').find('input').removeAttr('disabled');
    }
}

// load regions by country
function p53(obj){
    var _parent     = $j(obj).parent();
    var _stt        = _parent.next('.stt');
    //var _sel_opts   = $j(obj).find('option:selected');    
    //var cn_code     = _sel_opts.map(function(){ return $j(this).val() }).toArray().join("|");    
    
    $j.ajax({
        url: _site_url+'ajax/state_list',
        data: {'cn_code': obj.value},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _stt.find('select').html(r.html);
             }else{
                 _stt.find('select').html('');                 
             }
        }
    })
}

function p53_ct(obj, ct_selected){
    var _parent     = $j(obj).parent();
    var _ct        = _parent.next('.ct');   
    
    if($j.type(ct_selected)== 'undefined') ct_selected = '';
    
    $j.ajax({
        url: _site_url+'ajax/city_list',
        data: {'cn_code': obj.value, sel: ct_selected},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _ct.find('select').html(r.html);
             }else{
                 _ct.find('select').html('');                 
             }
        }
    })
}

function p59(obj){
    var _parent     = $j(obj).parent();
    var _dmns        = _parent.next('.dmns');   
    
    $j.ajax({
        url: _site_url+'ajax/domain_list',
        data: {'type': obj.value},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _dmns.find('select').html(r.html);
             }else{
                 _dmns.find('select').html('');                 
             }
        }
    })
}


function p61(obj){
    var _parent = $j(obj).parent();
    var _dmns   = _parent.next('.dmns');
    var _mt_op  = _dmns.next('.mt_op');
    var _op_vl  = _mt_op.next('.mt_op_vl');
    
    _mt_op.removeClass('hidden').find('select').removeAttr('disabled');
    _op_vl.removeClass('hidden').find('input').removeAttr('disabled');
    
    var _sel_opts   = $j(obj).find('option:selected');    
    var ids     = _sel_opts.map(function(){ return $j(this).val() }).toArray().join("|");
    
    $j.ajax({
        url: _site_url+'ajax/domain_list',
        data: {'type': ids},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _dmns.find('select').html(r.html);
             }else{
                 _dmns.find('select').html('');                 
             }
        }
    })
}


function p64(obj){
    var _parent = $j(obj).parent();
    var _br_ver = _parent.next('.br_ver');
    
    var _sel_opts   = $j(obj).find('option:selected');    
    var ids     = _sel_opts.map(function(){ return $j(this).val() }).toArray().join("|");
    
    $j.ajax({
        url: _site_url+'ajax/browser_version_list',
        data: {'browser': ids},
        dataType: 'json',
        type: 'post',
        success: function(r){
             if(r.html != null){
                 _br_ver.find('select').html(r.html);
             }else{
                 _br_ver.find('select').html('');                 
             }
        }
    })
}


function p73(obj){
    
    /*
    var _parent = $j(obj).parent();
        var _camp   = _parent.next('.camp');
        var _msg    = _parent.next('.msg');
        var _var    = _parent.next('.var');
        
        var _sel_opts = $j(obj).find('option:selected');    
        var ids       = _sel_opts.map(function(){ return $j(this).val() }).toArray().join("|");   
        
        $j.ajax({
            url: _site_url+'ajax/campaign_list',
            data: {'type': ids},
            dataType: 'json',
            type: 'post',
            success: function(r){
                 if(r.html != null){
                     _camp.find('select').html(r.html);
                 }else{
                     _camp.find('select').html('');                 
                 }
            }
        }) */
        
}

function p74(obj){}
function p75(obj){}


// company search
var requests = new Array();
function p99(obj){    
    var _parent = $j(obj).parent();
    var _cmpny  = _parent.next('.cmpny');   
    var _val    = obj.value;
    
    for(var i=0; i<requests.length; i++){
        requests[i].abort();
    }
    
    if( _val.length > 1 ){
        requests.push(
            $j.ajax({
                url: _site_url+'ajax/company_list',
                data: {'s': obj.value},
                dataType: 'json',
                type: 'post',
                success: function(r){
                     if(r.html != null){
                         _cmpny.find('select').html(r.html);
                     }else{
                         _cmpny.find('select').html('');                 
                     }
                }
            })
       )        
    }else{
        _cmpny.find('select').html('');        
    }
    
}

function chooseRandom(l, h) {
    var l = parseInt(l);
    var h = parseInt(h) - l;
    return Math.round(Math.random() * h) + l;
}

function add_cgrp(obj){
    
    var OR = $j('<div class="wrp_flds cg-range-OR">OR</div>');
    var range_set = $j(obj).parent().siblings('.cg-range-set:first').clone(true);    
    range_set.find('input:eq(0)').val(0).attr('id', range_set.find('input:eq(0)').attr('id')+chooseRandom(99, 999));
    range_set.find('input:eq(1)').val(0).attr('id', range_set.find('input:eq(1)').attr('id')+chooseRandom(99, 999));
    range_set.find('.cg-interval').remove();
    range_set.css('width', '217px').prepend(OR);
    range_set.find('.tips').html('').removeClass('disp-inline').addClass('hidden')
    range_set.find('.error').removeClass('error')
    range_set.insertBefore($j(obj).parent());
}



//random id 
function random_id(){
        var d = new Date()
        return d.getTime();
    }

//sortorder for each event block
function evt_blk_sor(new_so){
    if(new_so){
        return $j('.event-group-block').length;
    }
}

function operator_change(obj){
    var op = $j(this).text()
    var nxt_op = op == 'AND' ? 'OR' : op == 'OR' ? 'XOR' : op == 'XOR' ? 'AND' : 'OR'
    hdn = $j(this).find(':hidden').val(nxt_op.toLowerCase()); 
        $j(this).text(nxt_op);
        $j(this).append(hdn); 
    }    
 
function add_rule(id, source_li, rule_group_id, new_so, not_op, pre_op, alias, fld_data, trigger_event){
        
    if($j.type(source_li) != 'undefined' && $j.type(source_li) != 'null')
        source_li.addClass('rule-clicked'); // show loader image
    
    if($j.type(rule_group_id)=='undefined'){
        var hdn_rule_group_id = $j('#hd_rule_group_id');
        var rule_group_id = hdn_rule_group_id.val();
    }
    
    if($j.type(not_op)=='undefined'){
        not_op=0;
    }
    if($j.type(trigger_event)=='undefined'){
        trigger_event=false;
    }
    
    
    // create new sortorder value for the event group
    if($j.type(new_so)=='undefined'){
        if($j('#'+rule_group_id).find('.event-so:last').length)
            var new_so = parseInt($j('#'+rule_group_id).find('.event-so:last').val())+1;
        else
            var new_so = 1;
    }
    if($j.type(fld_data)=='undefined'){
        fld_data = '';
    }
    
    alias = $j.type(alias)=='undefined' ? '' : decodeTxt(alias, 1);
    $j.ajaxQueue({
        
        url: _site_url + 'ajax/seg_field_sets',
        type: 'post',
        dataType: 'json',
        data: {i : id, g : rule_group_id, so: new_so, fld_data: fld_data },
        success: function(r){
             if(r.fields != ''){
                 
                 var d = new Date(), li_id = d.getTime();
                    
                 var event_block = $j('<li class="event-block" data-id="'+id+'" id="'+li_id+'"></li>');
                 var fieldset_wrapper = $j('<div class="fieldset-wrapper"></div>');
                 
                 var alias_txt  = $j('<input type="text" placeholder="Alias" class="alias-box" name="_group['+rule_group_id+'][event_alias][]" value="'+alias+'" />');
                 var event_so   = $j('<input type="hidden" class="event-so" name="_group['+rule_group_id+'][event_sortorder][]" value="'+new_so+'" />');
                 var title_box  = $j('<div class="contenttitle" />');
                 var h2_general = $j('<h2 class="general" />');
                 var span_title_wrp = $j('<span class="title" />');
                 var div_not    = $j('<div class="'+($j.type(not_op)!='undefined' && parseInt(not_op) == 1 ? 'not_on' : 'not_off')+'">(Not)</div>');
                 var input_hdn_not = $j('<input type="hidden" value="'+not_op+'" name="_group['+rule_group_id+'][fieldset]['+new_so+'][not_op]" />');
                 var span_title = $j('<span data-title="'+encodeTxt(r.title, 1)+'">'+(alias==''?r.title:alias)+'</span>');
                 
                 div_not.append(input_hdn_not)
                 span_title_wrp.append(div_not).append(span_title)
                 h2_general.append(span_title_wrp)
                 title_box.append(h2_general)
                                      
                 /* Controls*/                     
                 var closer     = $j('<li class="seg-controls seg-close" title="Delete"></li>');
                 var drag_handle= $j('<li class="seg-controls seg-dragger" title="Drag to Sort"></li>');
                 var move_up    = $j('<li class="seg-controls seg-move-up" title="Move Up"></li>');
                 var move_dn    = $j('<li class="seg-controls seg-move-dn" title="Move Down"></li>');
                 var collapse   = $j('<li class="seg-controls seg-expand" title="Collapse"></li>');
                 var cancel     = $j('<li class="seg-controls seg-cancel" title="Cancel"></li>');
                 var help       = $j('<li class="seg-controls seg-help tooltip"></li>')
                                    .colorTip({color:'blue', align: 'right', content: r.help, left: 46, arrow: false})
                 
                 var operator  = $j('<li class="operator">'+($j.type(pre_op)!='undefined'?pre_op.toUpperCase():'AND')+'<input type="hidden" name="_group['+rule_group_id+'][fieldset]['+new_so+'][pre_op]" value="'+($j.type(pre_op)!='undefined'?pre_op:'and')+'" /></li>').on('click', operator_change);
                 var rule_cntnr= $j('#'+rule_group_id+' .rule-container');                     
                 var event_blk_length  = $j('#'+rule_group_id+' .rule-container .event-block').length;
                 
                 var control_ul = $j('<ul class="control_ul" />')
                                                                .append(help)                        
                                                                .append(move_up)
                                                                .append(move_dn)
                                                                .append(cancel)
                                                                .append(collapse)
                                                                .append(closer);
                 
                 title_box.find('span.title').append(alias_txt).append(event_so)
                 title_box.find('span.title').append(control_ul);
                 
                 fieldset_wrapper.append(r.fields);                     
                 event_block.append(title_box).append(fieldset_wrapper);                     
                 // remove any occurrence of the given class 
                 rule_cntnr.find('.event-block:last').removeClass('evtblk-last');
                 
                 //if there are one or more event-blocks then only add the operator div in between
                 if(event_blk_length>0) rule_cntnr.append(operator);
                 
                 // finally add the overall block to the rule container.
                 rule_cntnr.append(event_block);
                 
                 // reassign the given class to the last occurrence after adding the element to the DOM
                 rule_cntnr.find('.event-block:last').addClass('evtblk-last');
                 
                 var eb = $j('.event-group-block#'+rule_group_id+' .event-block');
                 if(eb.length == 1){
                     eb.find('.seg-controls.seg-dragger, .seg-move-up, .seg-move-dn').addClass('hidden');
                 }else if(eb.length>1){
                     $j.each(eb, function(i, v){
                         _s = $j(this); 
                        _s.find('.seg-dragger, .seg-move-up, .seg-move-dn').removeClass('hidden');
                        
                        if(!i) // first
                            _s.find('.seg-move-up:first').addClass('hidden');
                            
                        if(i == eb.length - 1) // first
                            _s.find('.seg-move-dn:first').addClass('hidden');     
                            
                        // collapse all other rule blocks    
                        _s.find('.fieldset-wrapper:not(:last)').slideUp(200, 'easeInOutQuad', function(){
                           _s.find('.control_ul .seg-expand').removeClass('seg-expand').addClass('seg-collapse')   
                        });                                    
                          
                     })
                                              
                 }
                 
                 if($j.type(source_li) != 'undefined' && $j.type(source_li) != 'null'){             
                    //source_li.on('click', add_rule(source_li.id, $j(source_li)))
                    source_li.removeClass('rule-clicked');
                 }
                 if(trigger_event){
                      event_block.find('select:not(:hidden)').each(function(){
                          if($j.type(window[$j(this).attr('data-code')])=='function'){
                              
                              if(id == '_s_mrc21')
                                change_event = $j(this).attr("onChange").replace(')', ", '"+fld_data[1]['fields'][id]['p55'][0].join('|')+"')")
                              else  
                                change_event = $j(this).attr("onChange").replace(')', ', true)')
                             //eval($j(this).attr('data-code')+'(this, true)');
                             eval(change_event);                                   
                          }
                      })                                     
                 }
                 $j.colorbox.close();
             }
        }
    })
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
            //data: $j.merge($j('#frmAddSegments').serializeArray(), $j('#frmAddSegments:hidden').serializeArray()),
            data: $j('input:not(:disabled):visible, select:not(:disabled):visible, input:not(:disabled):hidden, select:not(:disabled):hidden', $j('#frmAddSegments')).serializeArray(),
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


function save_personalize(){
    return false;
} 
   
function swapNodes(a, b) {
    var aparent= a.parentNode;
    var asibling= a.nextSibling===b? a : a.nextSibling;
    b.parentNode.insertBefore(a, b);
    aparent.insertBefore(b, asibling);
    return true
}   
   
    
$j(function(){
    // trigger save_rules function
    $j('#btn_save_rules').on('click', save_rules);
    
    // collapse the left navigation menu
    $j('#togglemenuleft a').trigger('click');
    
    // add event block wrapper
    $j('#add_event_block').on('click', function(e, random_id, so){
        
        var evc = $j('.event-group-block-cloner').clone(true);
        
        //get reandom id
        if($j.type(random_id) == 'undefined'){
            var d = new Date()        
            var random_id = d.getTime();
        }
        if($j.type(so) == 'undefined'){
            var so = $j('.event-group-block').length+1;
        }    
        $j('.event-group-block.focused').removeClass('focused');
        evc
            .removeClass('hidden event-group-block-cloner')
            .attr({'id': random_id, 'data-sortorder': so = so})
            .addClass('event-group-block focused');         
                       
        evc  // show the rule event selection pop-up
            .find(".btn_add_rule").on('click', function(){
                var rules = $j('#selectable_rule_cats .mainrightinner .widgetbox').clone(true);
                // focuss the parent evc of the button being clicked
                $j('.event-group-block').removeClass('focused');
                evc.addClass('focused');
                
                $j('#hd_rule_group_id').val(random_id);
                
                // bind click event
                rules.find('.linklist li .widgetsubcontent .linklist li a').on('click', function(){
                    $j(this).off('click')
                    add_rule(this.id, $j(this));
                })
                
                //---------------------------------------------------
                $j.colorbox({inline:true, width: '25%', height: '542px', href:rules});
                return false;    
            })
            .end()
            .find('#evt_grp_blk_so').attr('name', '_group['+random_id+'][evt_grp_blk_so]').val(so).removeAttr('id')
            .end()
            // focus event-block when clicked
            .on('click', function(){            
                $j('.event-group-block').removeClass('focused');
                $j(this).addClass('focused');
            })     
        
        $j('#event_container').append(evc);       
    })
        
    $j('#wizard2').smartWizard({onFinish: onFinishCallback, keyNavigation: false});        
    
    function onFinishCallback(){
        alert('Finish Clicked');
    }

    $j('.operator').disableSelection();
    
    // from to datepickers
    $j( document ).on('click', ".datepicker1,.datepicker2", function(){
        var _parent = $j(this).parent().parent();
        $j(this).datepicker({
            dateFormat: "yy-mm-dd", 
            changeMonth: true, 
            changeYear: true, 
            showOtherMonths: true,
            selectOtherMonths: true, 
            showOn:'focus'}).focus();
    });
    
    $j( document ).on('click', ".not_off, .not_on", function(){
        if($j(this).hasClass('not_off')){
            $j(this).addClass('not_on').removeClass('not_off').find(':hidden').val(1)            
        }else{
            $j(this).addClass('not_off').removeClass('not_on').find(':hidden').val(0)
        }
            
    });
   
    $j( document ).on('click', ".timepicker1, .timepicker2", function(){        
        $j(this).timepicker({showOn:'focus'}).focus();
    });
   
    $j( document ).on('click', '.del-control-group', function(){
        
        var _p = $j(this).parent().parent();
        var _pp = _p.parent();
        var _s = _p.siblings('.cg-range-set');
        
        
        if(_s.length){
            _p.siblings('.cg-range-set:first').css({width: '177px'}).find('.cg-range-OR').remove();
            _p.remove();  
            
            if(!_pp.find('.cg-range-set:first .cg-interval').length)            
                $j('<small class="cg-interval">(Interval 0-100%)</small>').insertAfter(_pp.find('.cg-range-set:first .h_limit'));             
            
        }
    })
    
    // remove event-block on cross button click.
    $j( document ).on('click', '.seg-close', function(){        
        _self = $j(this);
        
        _self.closest('.event-group-block').siblings().andSelf().removeClass('working')
        _self.closest('.event-group-block').addClass('working')
        
        jConfirm('Remove this Segmentation Rule Block?', 'Confirmation Dialog', function(r) {
            if(r){
                event_blk = _self.closest('.event-block')
                rule_cntnr = event_blk.parent('ul')
                event_blk_ind = rule_cntnr.children('.event-block').index(event_blk) 
                // if its the first block being deleted then also remove the following operator otherwise remove the preceeding operator
                operator = event_blk_ind == 0 ? event_blk.next('.operator') : event_blk.prev('.operator')
                operator.fadeOut(450, function(){$j(this).remove()})
                event_blk.fadeOut(650, function(){
                    $j(this).remove()
                    rule_cntnr.find('.event-block:last').addClass('evtblk-last')
                    
                    //remove the whole parent block if no sub-block remains after delete
                    var egbw = $j('.event-group-block.working')
                    if(!egbw.find('.event-block').length){
                        egbw.fadeOut(650, function(){$j(this).remove()})
                    }                    
                })
            }
        });
        return false;
    })
    
    // expand-collapse the event block 
    $j( document ).on('click', '.seg-expand, .seg-collapse', function(){        
        _self = $j(this);
        fieldset_wrapper = _self.closest('.contenttitle').next('.fieldset-wrapper');
        if(_self.hasClass('seg-expand')){
            fieldset_wrapper.slideUp(200, 'easeInOutQuad', function(){_self.removeClass('seg-expand').addClass('seg-collapse')}); 
        }else{
            fieldset_wrapper.slideDown(200, 'easeInOutQuad', function(){_self.removeClass('seg-collapse').addClass('seg-expand')});
        }
        
        return false;
    })
    
    // change title text when typed in alias box
    $j( document ).on({
        keyup: function(){
            var titlebx = $j(this).prev('span');
            if(isEmpty($j(this))){
                if($j.type(titlebx.attr('data-title')) != 'undefined')
                    val = decodeTxt(titlebx.attr('data-title'), 1);
            }else{
                var val = $j(this).val();
            }
            titlebx.text(val);
        },
        blur: function(){
            var titlebx = $j(this).prev('span');
            if(isEmpty($j(this))){
                if($j.type(titlebx.attr('data-title')) != 'undefined')
                    val = decodeTxt(titlebx.attr('data-title'), 1);
            }else{
                var val = $j(this).val();
            }
            titlebx.text(val);
        }     
    }, '.alias-box')
    
    
    
    // Validation Error Tips
    
    
    // Drag-n-drop sorting of the event-block main wrapper
    $j('div.event_container').sortable({
        connectWith: '.event_container',
        item: '.event-group-block',
        revert: true,
        scroll: true,
        helper: 'clone',
        opacity: 0.7,
        tolerance: 'pointer',
        update: function(e, ui){
            
            var new_sortorder = ($j('div.event_container').sortable('toArray'))
            $j.each(new_sortorder, function(i, val){
                newso = i+1
                $j('.event-group-block#'+val).attr('data-sortorder', newso)
                $j('.event-group-block#'+val+'>input:hidden').val(newso)                
            })
        }
    }); 
    
    // sorting blocks up and down on button click.    
    $j(document).on('click', '.seg-move-up, .seg-move-dn', function(){
        dir = $j(this).hasClass('seg-move-up') ? 'up' : 'down'
        a = $j(this).closest('.event-block').get(0)
        ul = $j(a).parent('.rule-container')
        
        if(dir == 'up'){            
            b = $j(a).prev('.operator').prev('.event-block').get(0)
        }else{
            b = $j(a).next('.operator').next('.event-block').get(0)
        }        
        if(swapNodes(a, b)){
            t1 = $j(a).find('.event-so').val()
            t2 = $j(b).find('.event-so').val()            
            $j(a).find('.event-so').val(t2)
            $j(b).find('.event-so').val(t1)
            
            ul.find('.evtblk-last').removeClass('evtblk-last')
            ul.find('.event-block:last').addClass('evtblk-last');
            
            // reset the sorting controls
            c = a, a = b, b = c, eb_len = ul.find('.event-block').length
            
            a_first = ul.find('.event-block').index($j(a)) == 0
            a_last  = ul.find('.event-block').index($j(a)) == eb_len-1
            b_first = ul.find('.event-block').index($j(b)) == 0
            b_last  = ul.find('.event-block').index($j(b)) == eb_len-1
            
            if(a_first){
                $j(a).find('.seg-move-up').addClass('hidden')
                $j(a).find('.seg-move-dn').removeClass('hidden')
            }else if(a_last){
                $j(a).find('.seg-move-up').removeClass('hidden')
                $j(a).find('.seg-move-dn').addClass('hidden')
            }else{
                $j(a).find('.seg-move-up, .seg-move-dn').removeClass('hidden')
            }
            
            if(b_first){
                $j(b).find('.seg-move-up').addClass('hidden')
                $j(b).find('.seg-move-dn').removeClass('hidden')
            }else if(b_last){
                $j(b).find('.seg-move-up').removeClass('hidden')
                $j(b).find('.seg-move-dn').addClass('hidden')
            }else{
                $j(b).find('.seg-move-up, .seg-move-dn').removeClass('hidden')
            } 
        }     
    })
    
})