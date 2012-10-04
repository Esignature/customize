<?php require_once("inc/header_main.php") ?> 

<?php require_once('inc/header_inner.php') ?>                

<?php require_once('inc/main_left.php') ?>   
<style>
    body, ul, li{margin:0; padding:0; font-family:Arial, Helvetica, sans-serif; font-size:12px;}
    .ner form select{height:175px; width:140px; overflow:scroll; border:solid 1px #eee;}
    .container ul li{display:block;}
    .container ul li a{color:#333; text-decoration:none; padding:3px 5px; float:left; width:100%;}
    .container ul li a:hover{color:#333; background:#eee; text-decoration:none; padding:3px 5px;}
    .ner label{font-weight:bold; margin:5px 0; width:100%; float:left;}
    .ner{width:727px; margin:0 auto; padding:10px; padding-top:0;}

    .form_box{width:135px; float:left; margin:0 5px;}
    .form_b_box{width:570px; float:right;}
    .inn_form_box{width:48%; float:left; margin-right:2%;}
    .inn_form_box label{width:35%; float:left; margin-right:8px;}
    .inn_form_box input{width:55%; float:left; padding:2px 5px; }

    .inn_form_btn{width:100%; float:left;}
    .inn_form_btn a{width:auto; float:right; margin:0 10px;}
    .ner h1{font:bold 14px Arial, Helvetica, sans-serif; background:#eee; color:#333; padding:5px 8px; margin:0 0 10px 0;}
</style>
<script>
    function swap_me(valS) {
             
        $j('#cont_ div').hide();
        $j('.'+valS).show();
    }
    function popup() {
        var p = "<select name='cont' multiple='true' class='cont' onchange='swap_me(this.value)'>";
        var content="";  
        $j.getJSON(_site_url + "containers/container_adddata", function(data) {
            $j.each(data, function(key, val) {
                var n=key.replace(/_/gi, " ");
                p+=('<option value="'+key+'">'+n+'</option>');
                content+="<div class='"+key+" inn_form_box' style='display:none;'>";
                $j.each(val,function(k,v){
                    content+="<label>"+v+"</label>";
                    content+="<input type='text'>";
                });
                content+="</div>"; 
            });
            p+="</select>";
            $j('#cont_').html('');
            $j('#cont_').html(content);
            $j('#selector').html(p);
        });
        
        $j.colorbox({inline:true, width: '55%', height: '550px', href:('#pop')}); 

        return false;
    }
    function isArray(what) {
        return Object.prototype.toString.call(what) === '[object Array]';
    }        
    function objectLength(obj) {
        var result = 0;
        for(var prop in obj) {
            if (obj.hasOwnProperty(prop)) {
                // or Object.prototype.hasOwnProperty.call(obj, prop)
                result++;
            }
        }
        return result;
    }
    function updown(v) {
        return $j.map(v.split(/\s|_/), function(n1) {
            return n1.charAt(0).toUpperCase() + n1.slice(1).toLowerCase();
        }).join(" ");
    }

</script>

<div class="maincontent noright">

    <div class="maincontentinner">            	

        <ul class="maintabmenu">

            <li class="current"><a>
                    Containers </a></li>

        </ul><!--maintabmenu-->                

        <div class="content">                        

            <div class="contenttitle radiusbottom0">

                <h2 class="table"><span>Containers Table</span></h2>

            </div>                     


            <div class="tableoptions">



                <button class="deletebutton radius3" title="table2" id="btn_delete_sel">Delete Container</button> &nbsp;                        

                <button class="radius3" onclick="popup()">Add New Container</button> &nbsp;

                <button class="radius3 dt-refresh" id="btn_refresh">Refresh</button> &nbsp;

                <select class="radius3">

                    <option value="">Show All</option>

                    <option value="">Rendering Engine</option>

                    <option value="">Platform</option>

                </select>

            </div><!--tableoptions-->	

            <table cellpadding="0" cellspacing="0" border="0" id="table2" class="stdtable stdtablecb">

                <colgroup>

                    <col class="con0" />

                    <col class="con1" />

                    <col class="con0" />

                    <col class="con1" />






                </colgroup>

                <thead>

                    <tr>

                        <th class="head0"><input type="checkbox" class="checkall" /></th>

                        <th class="head1">Name</th>

                        <th class="head0">Html ID</th>

                        <th class="head1">Type</th>

                        <th class="head0">Pages</th>





                    </tr>

                </thead>

                <tfoot>

                    <tr>

                        <th class="head0"><input type="checkbox" class="checkall" /></th>

                        <th class="head1">Name</th>

                        <th class="head0">Html ID</th>

                        <th class="head1">Type</th>

                        <th class="head0">Pages</th>                                                         

                    </tr>

                </tfoot>

                <tbody>

                </tbody>

            </table>                    

        </div><!--content-->                

    </div><!--maincontentinner-->            
    <div  style="display: none;" >
        <div id="pop">
            <div class="ner">
                <h1>New Container</h1>
                <form>
                    <div class="form_box">
                        <label>Container Types</label>
                        <div id="selector">
                        </div>
                    </div>
                    <div class="form_b_box">
                        <div id="cont_" class="form_b_box">


                        </div>
                    </div>
                    <div style="clear:both; height:10px;"></div>
                    <div class="form_box">
                        &nbsp;
                    </div>


                    <div class="form_b_box">
                        <div class="inn_form_box">
                            <label>Container Types</label>
                            <select multiple="multiple" style="height:170px; width:100%;">
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                            </select>
                        </div>
                        <div class="inn_form_box">
                            <label>Container Types</label>
                            <select multiple="multiple" style="height:170px; width:100%;">
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                                <option value="test">test</option>
                            </select>
                        </div>
                    </div>

                    <div style="clear:both; height:10px;"></div>
                    <div class="inn_form_btn">
                        <a href="#"><img src="close.jpg" height="24" width="69" alt="" /></a>
                        <a href="#"><img src="save.jpg" height="24" width="63" alt="" /></a>
                    </div> 
                </form>
            </div>
        </div>

    </div>
    <?php require_once('inc/footer_cr.php') ?>

</div><!--maincontent-->

<?php require_once("inc/footer_main.php") ?>