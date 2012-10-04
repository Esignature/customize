<div class="mainright hidden" style="position: absolute; top: 0px; right: 0px;" id="selectable_action_cats">
    <div class="mainrightinner">                
        <div class="widgetbox uncollapsible">
            <div class="title"><h2 class="general"><span>Select Action Type</span></h2></div>
            <div class="widgetcontent2">
                <ul class="linklist">
                    <?php foreach($main_cats as $cat_code=>$cat_info):?>
                    <li><a id="<?=$cat_code?>" href="javascript:void('<?=$cat_code?>')" subcat="<?=count($cat_info['sub'])?>" class="subtitle nohover"><span><?=$cat_info['title']?></span></a>
                        <div class="widgetsubcontent">
                            <ul class="linklist">
                                 <?php 
                                 $last_key = end(array_keys($cat_info['sub']));                                 
                                 foreach($cat_info['sub'] as $k=>$v):?>
                                 <li <?=$k == $last_key ? 'class="last"':''?>><a href="javascript:void(0);" id="<?=$k?>"><?=$v?></a></li>
                                 <?php endforeach;?>
                            </ul>     
                        </div>
                    </li>
                    <?php endforeach;?>                                        
                </ul>
            </div><!--widgetcontent-->
        </div><!--widgetbox-->        
    </div><!--mainrightinner-->
</div>