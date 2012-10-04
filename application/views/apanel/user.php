<script type="text/javascript" src="<?=$path?>js/jquery.tablednd.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	currentMenu('User', 'User');
});
	
</script>

<h2>User Manager</h2>
<div id="task_status"></div>
<?=$message?>
<div class="todoboard">
  
  <ul>
    <li><?=anchor('ajax/delete_group/'.$tbl_name, 'Delete', array('class'=>'group_action'))?></li>
    <li><?=anchor('ajax/publish_group/'.$tbl_name, 'Publish', array('class'=>'group_action'))?></li>
    <li><?=anchor('ajax/unpublish_group/'.$tbl_name, 'Unpublish', array('class'=>'group_action'))?></li>
  </ul>
  
</div><div class="clear"></div>
    <!--  START TAB -->
<div id="tabs">
    
	<!--  START TAB 1 -->
    <div>
 <?=form_open('apanel/user_search', array('class'=>'search_form', 'method'=>'post'))?>
        <input type="text" name="search" id="search" value="<?=$search?>" /> 
        <input type="submit" value="Search" />
    </form>   
<?=$pages?>
<p class="clear"></p>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="list_table" id="table_dnd">
    <thead>
      <tr class="nodrop">
        <td width="1%" class="center">&nbsp;</td>
        <td width="2%" class="center"><input type="checkbox" name="checkbox" id="checkbox_main" /></td>
        <td width="16%">Username</td>
        <td width="35%">Email</td>
        <td width="18%">Screen Name</td>
        <td width="15%">Role</td>
        <td width="10%" class="center">Status</td>
      </tr>
    </thead>
    <tbody>
<?php
$i = 1;
$fixedOrder = "sortOrder";
foreach($query->result() as $r):
    $fixedOrder.= "|".$r->sortorder;
?>
      <tr id="<?php echo $r->user_id;?>" order="<?php echo $r->sortorder;?>">
      
<?php
      if($search != ''){
		  echo '<td class="center">::</td>';
		} else {
?>
        <td class="center" class="sort-order"><span class="drag_handle">::</span></td>
<?php } ?>
        
        <td align="center"><input type="checkbox" name="list_checkbox[]" class="list_checkbox" id="list_checkbox<?=$i?>" value="<?=$r->user_id?>" uid="<?=$r->user_id?>" /></td>
        <td><label for="list_checkbox<?=$i?>"><?=anchor(site_url('apanel/user_edit/'.$r->user_id), $r->username)?></label></td>
        <td><label for="list_checkbox<?=$i?>"><?=anchor(site_url('apanel/user_edit/'.$r->user_id), $r->email)?></label></td>
        <td><label for="list_checkbox<?=$i?>"><?=anchor(site_url('apanel/user_edit/'.$r->user_id), $r->screen_name);?></label></td>
        <td><?=$r->role_name?></td>
        <td class="center"> 
          <label for="list_checkbox<?=$i?>">
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
<p class="total_users" style="float:right;font:bold 11px/11px Arial, Helvetica, sans-serif;color:#333;cursor:default;">
    <?=$total?> 
</p>
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
					$menu = anchor('apanel/user', '<img src="'.$path.'img/search.png" width="24" height="24" alt="List" />Search Result', array('class'=>$s1));
				}
			    
			    echo anchor('apanel/user', '<img src="'.$path.'img/users.png" width="24" height="24" alt="List" />View all users', array('class'=>$s2));
				echo anchor('apanel/user_edit', '<img src="'.$path.'img/user_add.png" width="24" height="24" alt="List" />Add user', array('class'=>$s2));
				echo $menu;
			?>
        </ul>
   </div>