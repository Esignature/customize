<?php require_once("inc/header_main.php")?> 
    <?php require_once('inc/header_inner.php')?>                
        <?php require_once('inc/main_left.php')?>        
        <div class="maincontent noright">
            <div class="maincontentinner">            	
                <ul class="maintabmenu">
                	<li class="current"><a>Segment List</a></li>
                </ul><!--maintabmenu-->                
                <div class="content">                        
                    <div class="contenttitle radiusbottom0">
                    	<h2 class="table"><span>Segment Table</span></h2>
                    </div>                     
                    <div class="tableoptions">
                    	<button class="deletebutton radius3" title="table2" id="btn_activate_sel">Activate Selected</button> &nbsp;
                    	<button class="deletebutton radius3" title="table2" id="btn_deactivate_sel">Deactivate Selected</button> &nbsp;
                    	<button class="deletebutton radius3" title="table2" id="btn_delete_sel">Delete Selected</button> &nbsp;                        
                        <button class="radius3" onclick="redirect('<?=fsite_url('segment/add')?>')">Add New Segment</button> &nbsp;
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
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                        </colgroup>
                        <thead>
                            <tr>
                            	<th class="head0"><input type="checkbox" class="checkall" /></th>
                                <th class="head1">Segment</th>
                                <th class="head0">Actions</th>
                                <th class="head1">Action Groups</th>
                                <th class="head0">Goal Type</th>
                                <th class="head1">Happened</th>
                                <th class="head0">Sessions</th>
                                <th class="head1">Conver</th>
                                <th class="head0">Bounce</th>
                                <th class="head1">Avg pageview</th>
                                <th class="head0">Avg t.focus</th>
                                <th class="head1"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            	<th class="head0"><input type="checkbox" class="checkall" /></th>
                                <th class="head1">Segment</th>
                                <th class="head0">Actions</th>
                                <th class="head1">Action Groups</th>
                                <th class="head0">Goal Type</th>
                                <th class="head1">Happened</th>
                                <th class="head0">Sessions</th>
                                <th class="head1">Conver</th>
                                <th class="head0">Bounce</th>
                                <th class="head1">Avg pageview</th>
                                <th class="head0">Avg t.focus</th>
                                <th class="head1"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>                    
                </div><!--content-->                
            </div><!--maincontentinner-->            
            <?php require_once('inc/footer_cr.php')?>
        </div><!--maincontent-->
        <?php require_once("inc/footer_main.php")?>