<script type="text/javascript" src="<?=$path?>js/jquery.tablednd.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var tmpStartIndex = null;
	var initOrderHolder = '';
	$('.sort-order').mousedown(function(){
		$(this).parent().addClass('activeHandle');
	});
	$("#table_dnd").tableDnD({
	    onDragClass: "myDragClass",
		dragHandle:  "sort-order",
		onDragStart: function(table, row) {
			tmpStartIndex = row.getAttribute('order');
			var rows = table.tBodies[0].rows;
			var all_id = "sortIds|";
			var sep = '';
            for (var i=0; i<rows.length; i++) {
				all_id += sep+rows[i].getAttribute('id');
				sep = '|';
            }
			initOrderHolder = all_id;
		},
	    onDrop: function(table, row) {
            var rows = table.tBodies[0].rows;
            var debugStr = "Row dropped was "+row.getAttribute('order')+". New order: ";
			var all_id = "sortIds|";
			var cur_order = "sortOrder|";
			var sep = '';
            for (var i=0; i<rows.length; i++) {
				all_id += sep+rows[i].getAttribute('id');
				sep = '|';
            }
			$('tr.activeHandle').removeClass('activeHandle');
			if(initOrderHolder == all_id){ return false; }
			var fixedOrder = $('#final-order-list').html();
			$.ajax({
			   type: "POST",
			   url:  base_url() + 'index.php/ajax/reorder/<?=$tbl_name?>/pkg',
			   data: "action=sort&id=" + all_id + "&order=" + fixedOrder,
			   success: function(msg){
				   var ms = msg.split('|');
			   	   var st = (ms[1] == 1) ? 'success' : 'fail';
				   clear();
			       $('#task_status').html('<div class="'+st+' curved8 canhide" style="display:block">'+ ms[0] +'</div>').css('display', 'none').fadeIn('fast');
				   if(ms[2] == 'reorder' && ms[1] == 1){  }
				   $('.todoboard li').removeClass('active');
				   window.setTimeout('delayResponseHide()', 5000);
			   }
			});
	    }
	});
	currentMenu('Package', 'Package');
});
	
</script>

<h2>Package Manager</h2>
<div id="task_status"></div>
<?=$message?>
<div class="todoboard">
  
  <ul>
    <li><?=anchor('ajax/trash_group/'.$tbl_name, 'Delete', array('class'=>'group_action'))?></li>
    <li><?=anchor('ajax/publish_group/'.$tbl_name, 'Publish', array('class'=>'group_action'))?></li>
    <li><?=anchor('ajax/unpublish_group/'.$tbl_name, 'Unpublish', array('class'=>'group_action'))?></li>
  </ul>
  
</div><div class="clear"></div>
    <!--  START TAB -->
<div id="tabs">
    
	<!--  START TAB 1 -->
    <div>

<p class="description_icons">
    
    <span class="starred popular">&nbsp;</span>Recommended Package 
</p>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="list_table" id="table_dnd">
    <thead>
      <tr class="nodrop">
        <td width="1%" align="center">&nbsp;</td>
        <td width="2%" align="center"><input type="checkbox" name="checkbox" id="checkbox_main" /></td>
        <td width="30%">Package</td>
        <td width="15%">Free Trial?</td>
        <td width="15%">Trial Period (Days)</td>
        <td width="18%">Price (<?=$pkg_currency?>)</td>
        <td width="16%" align="center">Status</td>
      </tr>
    </thead>
    <tbody>
<?php
$i = 1;
$fixedOrder = "sortOrder";
foreach($query->result() as $r):
    $fixedOrder.= "|".$r->sortorder;
?>
      <tr id="<?php echo $r->pkg_id;?>" order="<?php echo $r->sortorder;?>">
      
<?php
      if($search != ''){
		  echo '<td align="center">::</td>';
	  } else {
?>
        <td align="center" class="sort-order"><span class="drag_handle">::</span></td>
<?php } ?>
        
        <td align="center"><input type="checkbox" name="list_checkbox[]" class="list_checkbox" id="list_checkbox<?=$i?>" value="<?=$r->pkg_id?>" uid="<?=$r->pkg_id?>" /></td>
        <td> 
        <?php $class = ($r->featured == 1) ? 'popular' : '' ;?>
        <span class="starred <?=$class?>" id="mark_popular_<?=$r->pkg_id?>" name="<?=$r->pkg_id?>" tbl="<?=$tbl_name?>" fld='pkg'>&nbsp;</span> 
		<?=anchor('apanel/package_form/'.$r->pkg_id, $r->pkg_name, array('class'=>'tooltip', 'title'=>'Click to Edit this package.'))?></td>
        <td align="center"><?=($r->free_trial == 1) ? '<span class="status1 curved2">Yes</span>' : '<span class="status0 curved5">No</span>'?></td>
        <td align="center"><label for="list_checkbox<?=$i?>"> <?php echo $r->pkg_trial_period;?></label></td>
        <td align="center"><label for="list_checkbox<?=$i?>"> <?php echo $r->pkg_price;?></label></td>
        <td> 
          <label for="list_checkbox<?=$i?>"> 
            <?=($r->status == 1) ? '<span class="status1 curved2">On</span>' : '<span class="status0 curved5">Off</span>'; ?> 
            </label>
        </td>
      </tr>
<?php
$i++;
endforeach;
?>
    </tbody>
  </table>
<div id="final-order-list" style="display:none;"><?php echo $fixedOrder;?></div>

<!-- The paginator -->
<?=$pages?>
<!-- Paginator end -->
<br /><br />
       

    </div><!--  end div #tab1 -->
    <!--  END TAB 1 -->

    </div>
    <!--  END TABS -->

    </div>
    
    
    <div id="sidebar">
        <ul>
			<?php
			    $s1 = $menu = ''; 
				$s2 = 'active';
				if($search != ''){
					$s1 = 'active';
					$s2 = '';
					$menu = anchor('apanel/package', '<img src="'.$path.'img/package.png" width="24" height="24" alt="List" />Search Result', array('class'=>$s1));
				}
			    echo anchor('apanel/package', '<img src="'.$path.'img/package.png" width="24" height="24" alt="List" />View All Packages', array('class'=>$s2));
				echo $menu;
				echo anchor('apanel/package_form', '<img src="'.$path.'img/package_add.png" width="24" height="24" alt="Add" />Add Package');
			?>
        </ul>
   </div>