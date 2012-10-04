<?php require_once("inc/header_main.php")?>	
	<?php require_once('inc/header_inner.php')?>            	
        <?php require_once('inc/main_left.php')?>
        
        <div class="maincontent noright">
        	<div class="maincontentinner">            	
                <ul class="maintabmenu">
                	<li class="current"><a>Add New Segment</a></li>
                </ul><!--maintabmenu-->
                
                <div class="content">                	
                    <div class="wizard" id="wizard2">                        
                        <ul class="tabbedmenu anchor">
                            <li>
                                <a href="#wiz1step2_1" class="selected" isdone="1" rel="1">
                                    <span class="h2">Action Rules</span>
                                </a>
                            </li>
                            <li>
                                <a href="#wiz1step2_2" class="disabled" isdone="0" rel="2">
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
                                <form action="" method="post" class="stdform stdform2" onsubmit="return false" id="frmAddSegments"> 
                                    <input type="hidden" name="seg_id" id="seg_id" value="<?=@$seg_id?>" />   
                                <span>
                                    <span class="less_one_third">
                                        <label for="" class="simple">Name</label>
                                        <input type="text" name="seg_name" id="seg_name" class="largeinput" value="<?=@$seg_name?>" />
                                    </span>
                                    <span class="less_one_third">
                                        <label for="" class="simple">Description</label>
                                        <input type="text" name="seg_desc" id="seg_desc" class="largeinput" value="<?=@$seg_desc?>" />
                                    </span>
                                    <div class="less_one_third last">
                                        <label for="" class="simple">Category <a href="javascript:void(0)" id="tree_reload">Reload</a></label><br clear="all" />
                                        <!-- <input type="text" name="seg_cat" id="seg_cat" class="largeinput" value="" /> -->
                                        
                                        <?php require_once('inc/segment_category_tree.php')?>                                        
                                        
                                        
                                    </div>
                                </span><br clear="all" />
                                <div class="par terms">
                                    <p>Add 'Rules' and 'Relations' that define your target segment. Add new event rows when you want conditions to be matched in a specific sequence.</p>
                                </div>
                                
                                <br>
                                
                                <!-------------------------------------------------------------------->
                                
                                <div id="event_container" class="event_container"></div>                                
                                
                                <hr />
                                
                                <input type="hidden" id="hd_rule_group_id" name="hd_rule_group_id" value="0" />
                                <a class="btn_dark btn_book" id="add_event_block" href="javascript:void(0);"><span>Add Event Group</span></a>
                                <a class="btn_dark btn_book" href="javascript:void(0);" id="btn_save_rules"><span>Save</span></a>
                                <!-- <a class="btn_dark btn_book" href="javascript:void(0);" onclick="javascript:save_personalize()"><span>Save and Add Personalization Action</span></a> -->
                                <br clear="all" /><br />
                                
                                <!-------------------------------------------------------------------->
                                                                
                                <?=event_group_block_tmpl()?>
                                
                                
                                </form>
                                
                            </div>
                            <div class="formwiz content" id="wiz1step2_2" style="display: none;">              
                                <p>
                                    <label>Account No</label>
                                    <span class="field"><input type="text" class="longinput" name="lastname"></span>
                                </p>
                                <p>
                                    <label>Address</label>
                                    <span class="field"><textarea name="location" rows="5" cols="80"></textarea></span>
                                </p>                                                                                                   
                            </div>
                            <div id="wiz1step2_3" class="content" style="display: none;">
                                <h2>Step 3: Terms of Agreement</h2>
                                <div class="par terms">
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                    <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                                    <p><input type="checkbox"> I agree with the terms and agreement...</p>
                                </div>
                            </div>                            
                        
                        
                    </div><!--#wizard-->
                    <br clear="all" /><br />                
                </div><!--content-->                
            </div><!--maincontentinner-->
            
            <?php require_once('inc/footer_cr.php')?>            
        </div><!--maincontent-->                    
     	
     	<?php require_once('inc/segmentation_events.php')?>
     	
<?php require_once("inc/footer_main.php")?>