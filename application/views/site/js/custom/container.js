$j(function(){

       $j('#togglemenuleft a').trigger('click');

        

       // data table       

       $j( document).on('click', '.checkall', function(){

           

           if($j(this).is(':checked')){

               $j(this).closest('table').find('.chkbox').attr('checked', true);

               $j(this).closest('table').find('span.checkbox').addClass('checked').closest('tr').addClass('selected');

           }else{

               $j(this).closest('table').find('.chkbox').attr('checked', false);

               $j(this).closest('table').find('span.checkbox').removeClass('checked').closest('tr').removeClass('selected');;

           }                               

       })

       

       var oTable = $j('#table2').dataTable({

            "sDom": 'fClrtip',

            "sPaginationType": "full_numbers",

            "bProcessing": true,

            "bServerSide": true,

            "sAjaxSource": _site_url + "containers/container_datalist",

            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {                                    

                

                $j('td:eq(0) :checkbox.chkbox', nRow).each(function(){

                    var t = $j(this);

                    t.wrap('<span class="checkbox"></span>');

                    t.click(function(){

                        if($j(this).is(':checked')) {

                            t.attr('checked',true);

                            t.parent().addClass('checked');

                        } else {

                            t.attr('checked',false);

                            t.parent().removeClass('checked');

                        }

                    });

                }); 

                

                                              

            },

            "oLanguage": {

               "sLengthMenu": '_MENU_'

             },

            "aoColumnDefs": [

                { "sWidth": "16", "aTargets": [ 0 ] },

                { "sWidth": "155", "aTargets": [ 1 ] },

                { "sWidth": "100", "aTargets": [ 2 ] },

                { "sWidth": "90", "aTargets": [ 3 ] },

                { "sWidth": "80", "aTargets": [ 4 ] },                     
                                         

               
                { "bSortable": false, "aTargets": [ 0, 4 ] }

            ]   

        });

        

        $j(document).on('click', '.dt-refresh', function(){

            oTable.fnClearTable( 0 );

            oTable.fnDraw();

        })

   

    

    

        // end of data table=====================================>

        

        

        // TOP BUTTON ACTIONS

        $j(document).on('click', '.seg_del, .active, .inactive', function(){

            if($j('.checkall:first').is(':checked')) $j('.checkall').trigger('click');

            $j('#table2_wrapper .chkbox').removeAttr('checked').closest('span').removeClass('checked').closest('tr').removeClass('selected') // uncheck everything first

            $j(this).closest('tr').find('td:first :checkbox').attr('checked', true).closest('span').addClass('checked').closest('tr').addClass('selected') // check the correspoding check box

            

            if($j(this).hasClass('seg_del')){                                

                $j('#btn_delete_sel').trigger('click')

            }

            else if($j(this).hasClass('active')){

                

                $j('#btn_deactivate_sel').trigger('click', ['active'])

            }

            else if($j(this).hasClass('inactive')){

                $j('#btn_activate_sel').trigger('click', ['inactive'])                

            }        

            return false

        })

        

        $j('#btn_delete_sel').on('click', function(){       

           var data = $j('#table2_wrapper .chkbox').serializeArray();

           if(data.length == 0){

                jAlert('No selection made for removal', 'Alert');

                return false;

           }

           

           $j(this).attr('disabled', true);

           jConfirm('Remove selected Segments?', 'Confirmation Dialog', function(r) {            

                //prepare data to be ajaxed            

                data.push({

                    name: "axn",

                    value: "delete",

                });

                data = $j.param(data);

                

                $j.ajax({                

                    url: _site_url+'segment/segment_list_actions',

                    type: 'post',

                    dataType: 'json',

                    data: data,

                    success: function(r){

                        if(parseInt(r.success)>0){

                            $j('#btn_refresh').trigger('click')                        

                            $j.jGrowl("Segment(s) successfully deleted!", {life: 5000});

                        }else{

                            $j.jGrowl("Problem deleting Segment(s). Please try again.", {life: 5000});

                        }

                        $j('#btn_delete_sel').removeAttr('disabled');

                    },

                    error: function(a, b){                    

                        $j('#btn_delete_sel').removeAttr('disabled');

                        $j.jGrowl("Problem deleting Segment(s). Please try again.", {life: 5000});

                    }                

                })

           }) 

        })

        

        

        $j('#btn_activate_sel, #btn_deactivate_sel').on('click', function(e, triggerer){

            var _self = $j(this)

            var _self_id = _self.attr('id')              

            var mode = _self_id == 'btn_activate_sel' ? 'activate' : 'deactivate';

            var mode_img = mode == 'activate' ? 'active' : 'inactive';

            var mode_vrb = mode == 'activate' ? 'activated' : 'deactivated';     

            var mode_inv = mode == 'activate' ? 'inactive' : 'active';     

            var data = $j('#table2_wrapper .chkbox').serializeArray();

            if(data.length == 0){

                jAlert('No selection made for '+mode, 'Alert');

                return false;

            }

                        

            _self.attr('disabled', true);

                 

            //prepare data to be ajaxed            

            data.push({

                name: "axn",

                value: mode,

            });

            data = $j.param(data);

            

            if($j.type(triggerer) != 'undefined'){

                $j.each($j('.chkbox:checked'), function(){

                    $j(this).closest('tr').find('td:last .'+triggerer).parent('span').hide()

                    $j(this).closest('tr').find('td:last .'+triggerer).parent('span').after('<span class="busy"><img width="12" height="12" alt="*" src="images/throbber.gif" /></span>');

                                            

                })

            }

            

            $j.ajax({                

                url: _site_url+'segment/segment_list_actions',

                type: 'post',

                dataType: 'json',

                data: data,

                success: function(r){

                    if(parseInt(r.success)>0){     

                        

                        if($j.type(triggerer) != 'undefined'){

                            $j.each($j('.chkbox:checked'), function(){

                                $j(this).closest('tr').find('td:last .'+triggerer).parent('span').show()

                                $j(this).closest('tr').find('td:last .'+triggerer).parent('span').next('span.busy').remove();                   

                            })

                        }

                        

                        ids = r.ids.split(/,/)

                        for(i=0; i<ids.length; i++){

                            $j('#row_'+ids[i]).find('td:last .'+mode_inv+' img').attr('src', 'images/icons/'+mode_img+'.png')

                            $j('#row_'+ids[i]).find('td:last .'+mode_inv).removeClass(mode_inv).addClass(mode_img)

                        }

                            

                        $j.jGrowl("Segment(s) successfully "+mode_vrb+"!", {life: 5000});

                    }else{

                        $j.jGrowl("Problem executing the command. Please try again.", {life: 5000});

                    }                   

                    _self.removeAttr('disabled');

                },

                error: function(a, b){                    

                    _self.removeAttr('disabled');

                    $j.jGrowl("Problem executing the command. Please try again.", {life: 5000});

                }                

            })

       }) 

        

})