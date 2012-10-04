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
			   url:  base_url() + 'index.php/ajax/reorder/<?=$tbl_name?>',
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
	currentMenu('Content', 'Article');
});
	
</script>

<h2>Article Manager</h2>
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
 <?=form_open('apanel/article_search', array('class'=>'search_form', 'method'=>'post'))?>
        <input type="text" name="search" id="search" value="<?=$search?>" /> 
        <input type="submit" value="Search" />
    </form>   
<p class="description_icons">
    
    <span class="starred popular">&nbsp;</span> Featured Article 
    <span class="has_slideshow has_slide">&nbsp;</span> Slideshow Image
</p>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="list_table" id="table_dnd">
    <thead>
      <tr class="nodrop">
        <td width="1%" align="center">&nbsp;</td>
        <td width="2%" align="center"><input type="checkbox" name="checkbox" id="checkbox_main" /></td>
        <td width="68%">Article Title</td>
        <td width="13%">Author</td>
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
      <tr id="<?php echo $r->content_id;?>" order="<?php echo $r->sortorder;?>">
      
<?php
      if($search != ''){
		  echo '<td align="center">::</td>';
		} else {
?>
        <td align="center" class="sort-order"><span class="drag_handle">::</span></td>
<?php } ?>
        
        <td align="center"><input type="checkbox" name="list_checkbox[]" class="list_checkbox" id="list_checkbox<?=$i?>" value="<?=$r->content_id?>" uid="<?=$r->content_id?>" /></td>
        <td> 
        <?php
		    $class = ($r->featured == 1) ? 'popular' : '' ;
		?>
        <span class="starred <?=$class?>" id="mark_popular_<?=$r->content_id?>" name="<?=$r->content_id?>" tbl="<?=$tbl_name?>">&nbsp;</span>
        
        <?php
		    $class = ($r->slideshow == 1) ? 'has_slide' : '' ;
		?>
        <span class="has_slideshow <?=$class?>" id="mark_slideshow_<?=$r->content_id?>" name="<?=$r->content_id?>" tbl="<?=$tbl_name?>">&nbsp;</span> 
		
		<?=anchor('apanel/article_form/'.$r->content_id, $r->title, array('class'=>'tooltip', 'title'=>'Click to Edit this article.'))?></td>
        <td><label for="list_checkbox<?=$i?>"> <?php echo $r->author;?></label></td>
        <td> 
          <label for="list_checkbox<?=$i?>"> 
            <?=mdate(DATE_STR, strtotime($r->created)); ?> 
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
					$menu = anchor('apanel/article', '<img src="'.$path.'img/search.png" width="24" height="24" alt="List" />Search Result', array('class'=>$s1));
				}
			    echo anchor('apanel/article', '<img src="'.$path.'img/001_20.png" width="24" height="24" alt="List" />View all articles', array('class'=>$s2));
				echo $menu;
				echo anchor('apanel/article_form', '<img src="'.$path.'img/addpage.png" width="24" height="24" alt="Add" />Add Article');
			?>
        </ul>
   </div>