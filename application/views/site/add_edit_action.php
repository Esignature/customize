<?php require_once("inc/header_main.php")?>	
	<?php require_once('inc/header_inner.php')?>            	
        <?php require_once('inc/main_left.php')?>
        
        <div class="maincontent noright">
        	<div class="maincontentinner">            	
                <ul class="maintabmenu">
                	<li class="current"><a>Segment Action Group<?=$axn_grp_name?></a></li>
                </ul><!--maintabmenu-->
                
                <div class="content">                	
                    <div class="wizard" id="wizard2">                        
                        <ul class="tabbedmenu anchor">
                            <li>
                                <a href="#wiz1step2_1" class="disabled" isdone="1" rel="1">
                                    <span class="h2">Action Rules</span>
                                </a>
                            </li>
                            <li>
                                <a href="#wiz1step2_2" class="selected" isdone="1" rel="2">
                                    <span class="h2">Actions</span>
                                </a>
                            </li>
                            <li>
                                <a href="#wiz1step2_3" class="disabled" isdone="0" rel="3">
                                    <span class="h2">Action Statistics</span>
                                </a>
                            </li>
                        </ul>                        
                        <br clear="all">
                            
                        <!--#wiz1step2_1-->                        
                        <!--#wiz1step2_2-->                        
                        <!--#wiz1step2_3-->
                         
                            <div class="formwiz content" id="wiz1step2_1" style="display: block;">   
                                <!--<p>
                                   <img src="images/bar.jpg" height="307" width="1029" alt="" />
                                </p>-->
                                <div class="hidden hdn-colorpicker"></div>
                                <form action="" method="post" class="stdform stdform2 hidden" onsubmit="return false" id="frmAddAction">                                    
                                    <input type="hidden" name="seg_id" id="seg_id" value="<?=@$seg_id?>" />
                                    <input type="hidden" name="axn_grp_id" id="axn_grp_id" value="<?=@$axn_grp_id?>" />
                                    <input type="hidden" name="axn_id" id="axn_id" value="<?=@$axn_id?>" />   
                                    
                                    <span>
                                        <span class="less_one_third">
                                            <label for="" class="simple">Name</label>
                                            <input type="text" name="seg_name" id="seg_name" class="largeinput" value="<?=@$axn_name?>" />
                                        </span>
                                        <span class="less_one_third">
                                            <label for="" class="simple">Description</label>
                                            <input type="text" name="seg_desc" id="seg_desc" class="largeinput" value="<?=@$axn_desc?>" />
                                        </span>
                                        <div class="less_one_third last">
                                            <label for="" class="simple">Category <a href="javascript:void(0)" id="tree_reload">Reload</a></label><br clear="all" />
                                            <!-- <input type="text" name="seg_cat" id="seg_cat" class="largeinput" value="" /> -->
                                            
                                            <?php require_once('inc/action_category_tree.php')?>
                                            
                                        </div>
                                    </span>
                                    <br clear="all" />
                                    
                                    <span id="dynamic_form_ph"></span>
                                
                                <!-------------------------------------------------------------------->
                                
                                <hr />                                                                
                                <a class="btn_dark btn_book" href="javascript:void(0);" id="btn_save_axn"><span>Save</span></a>
                                <a class="btn_dark btn_book" id="btn_close_axn" href="javascript:void(0);"><span>Close</span></a>
                                <!-- <a class="btn_dark btn_book" href="javascript:void(0);" onclick="javascript:save_personalize()"><span>Save and Add Personalization Action</span></a> -->
                                <br clear="all" /><br />
                                
                                <!-------------------------------------------------------------------->                                
                                </form>
                                
                                
                                
                                
                                <!-- ACTION TABLE -->
                                <div class="contenttitle radiusbottom0">
                                    <h2 class="table"><span>Segment Table</span></h2>
                                </div>                     
                                <div class="tableoptions">                                    
                                    <a class="btn btn_add radius50" href="javascript:void(0)" id="btn_add_axn"><span>Add Action</span></a> &nbsp;
                                    <a class="btn btn_activate radius50" href="javascript:void(0)" id="btn_activate_sel"><span>Activate</span></a> &nbsp;
                                    <a class="btn btn_deactivate radius50" href="javascript:void(0)" id="btn_deactivate_sel"><span>Deactivate</span></a> &nbsp;
                                    <a class="btn btn_refresh radius50 dt-refresh" href="javascript:void(0)" id="btn_refresh"><span>Refresh</span></a>
                                    <select class="radius3">
                                        <option value="">Show All</option>
                                        <option value="">Rendering Engine</option>
                                        <option value="">Platform</option>
                                    </select>
                                    
                                    <span style="float:right; width:auto; margin:0 3px;">
                                        | <a href="#">Go to action group (advanced users)</a>
                                    </span>
                                    <span style="float:right; width:auto; margin:0 3px;">
                                        <a href="#">Edit Action Group</a>
                                    </span>    
                                </div><!--tableoptions-->   
                                <table cellpadding="0" cellspacing="0" border="0" id="table2" class="stdtable stdtablecb">
                                    <colgroup>
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                        <col class="con1" />
                                        <col class="con0" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="head0"><input type="checkbox" class="checkall" /></th>
                                            <th class="head1">Main Action</th>
                                            <th class="head0">Type</th>
                                            <th class="head1">Rotation Ratio</th>
                                            <th class="head0">Time on Session</th>
                                            <th class="head1">Showing Time</th>
                                            <th class="head0">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="head0"><input type="checkbox" class="checkall" /></th>
                                            <th class="head1">Main Action</th>
                                            <th class="head0">Type</th>
                                            <th class="head1">Rotation Ratio</th>
                                            <th class="head0">Time on Session</th>
                                            <th class="head1">Showing Time</th>
                                            <th class="head0">&nbsp;</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    </tbody>
                                </table>  
                                
                                
                            </div>
                                                       
                        
                        
                    </div><!--#wizard-->
                    <br clear="all" /><br />                
                </div><!--content-->                
            </div><!--maincontentinner-->
            
            <?php require_once('inc/footer_cr.php')?>            
        </div><!--maincontent-->                    
     	
     	<?php require_once('inc/action_type_selection.php')?>
     	
<?php require_once("inc/footer_main.php")?>