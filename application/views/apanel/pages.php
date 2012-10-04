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
	currentMenu('Content', 'Pages');
	
	// Popup Form
	$('#box_ext_link').click(function(){
		$('#upload_imglist').show();
		$('#err_ext').hide();
		$('#reset_ext_frm').trigger('click');
		return false;
	});
	$('#closebtn1').click(function(){
		$('#upload_imglist').fadeOut();
	});
	$('form#external_link').submit(function(){
		var elm = $('#ext_title');
		var err = $('#err_ext');
		if(elm.val() == ''){ err.text('Enter the link name!').fadeIn('slow');elm.focus();return false; }
		var elm = $('#ext_link');
		if(elm.val() == '' || elm.val() == 'http://'){ err.text('Enter the link!').css('display', 'none').fadeIn('slow');elm.focus();return false; }
		$('#err_ext').show().addClass('err_ext_wait').text('Saving...');
		var data = prepareQuerystring('#external_link');
		$.ajax({
			type : 'POST',
			data : data,
			url  : '<?=base_url()?>index.php/apanel/pages_link',
			success: function(m){
				$('#err_ext').text(m);
				window.location.reload();
			},
			error: function(){
				alert('Could not save your changes!');
				$('#closebtn1').trigger('click');
			}
		});
		return false;
	});
	$('.loadMenuDetail').click(function(){
		var id = $(this).attr('menuid');
		$('#box_ext_link').trigger('click');
		$('#ext_title').val( $('#hidden_'+id).attr('ext_title') );
		$('#ext_link').val( $('#hidden_'+id).attr('ext_link') );
		$('#record_id').val(id);
		if($('#hidden_'+id).attr('ext_target') == '_blank')
		{
			  $('#blank_target').attr('selected', 'selected');
		}
		return false;
	});
});
</script>

<h2>Page Manager</h2>
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
 <?=form_open('apanel/pages_search', array('class'=>'search_form', 'method'=>'post'))?>
        <input type="text" name="search" id="search" value="<?=$search?>" /> 
        <input type="submit" value="Search" />
    </form>   
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="list_table" id="table_dnd">
    <thead>
      <tr class="nodrop">
        <td width="1%" align="center">&nbsp;</td>
        <td width="2%" align="center"><input type="checkbox" name="checkbox" id="checkbox_main" /></td>
        <td width="68%">Page Title</td>
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
		    $cls = ($r->homepage == '1') ? 'loadMenuDetail' : '';
            echo anchor('apanel/pages_form/'.$r->content_id, $r->title, array('class'=>'tooltip '.$cls, 'title'=>'Click to Edit this Page.', 'menuid'=>$r->content_id));
			
			$ext_title = $r->title;
			$q = $this->db->get_where('tbl_menu', array('menu_id'=>$r->content_id));
			if($q->num_rows() == 0)
			{
				$ext_link = $ext_target = '';
			} 
			else
			{
				$menu = $q->row();
				$ext_link = $menu->link;
				$ext_target = $menu->target;
			}
	    ?>
            <input type="hidden" id="hidden_<?=$r->content_id?>" ext_title="<?=$ext_title?>" ext_link="<?=$ext_link?>" ext_target="<?=$ext_target?>" />
        </td>
        <td><label for="list_checkbox<?=$i?>"> <?php echo $r->author;?></label></td>
        <td> 
          <label for="list_checkbox<?=$i?>"> 
            <?=mdate(DATE_STR, strtotime($r->created)); ?> 
            <?=($r->status == 1) ? '<span class="status1 curved21">On</span>' : '<span class="status0 curved21">Off</span>'; ?> 
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
					$menu = anchor('apanel/pages', '<img src="'.$path.'img/search.png" width="24" height="24" alt="List" />Search Result', array('class'=>$s1));
				}
			    echo anchor('apanel/pages', '<img src="'.$path.'img/001_20.png" width="24" height="24" alt="List" />View all pages', array('class'=>$s2));
				echo $menu;
				echo anchor('apanel/pages', '<img src="'.$path.'img/addlink.png" width="24" height="24" alt="Add" />Add Link', array('id'=>'box_ext_link'));
				echo anchor('apanel/pages_form', '<img src="'.$path.'img/addpage.png" width="24" height="24" alt="Add" />Add Page');
			?>
        </ul>
   </div>
   
<style type="text/css">
#upimgcontainer{font:12px Arial, Helvetica, sans-serif;color:#333;}
#upimgcontainer label{display:block;font-weight:bold;margin-top:10px;}
#upimgcontainer input[type="text"], #upimgcontainer select{border:1px solid #ccc;padding:2px 4px;width:220px;color:#777}
#err_ext{ padding:5px;text-align:center;margin:8px 0;border:1px dashed #ccc;background:#FFD9D9;}
.err_ext_wait{ background:#FFC!important; }
</style>
<div id="upload_imglist" class="curved5">
    <div id="closebtn1">X</div>
	<div id="upimgcontainer">
        <div id="err_ext">Enter link name!</div>
        <form action="#" id="external_link" method="post">
             <label>Link Name</label>
             <input type="text" name="title" id="ext_title" value="" maxlength="255" />
             <label>Link</label>
             <input type="text" name="link" id="ext_link" value="http://" maxlength="255" style="width:90%!important;" />
             <label>Link Target</label>
             <select name="target" id="ext_target">
                 <option value="_parent" selected="selected">Load in same page</option>
                 <option value="_blank" id="blank_target">Load in new page</option>
             </select>
             <br /><br />
             <input type="hidden" name="record_id" value="0" id="record_id" />
             <input type="submit" name="submitbtn" value="Save" />
             <input type="reset" id="reset_ext_frm" name="resetbtn" value="Reset" />
        </form>
    </div>
    <div class="clear"></div>
</div>