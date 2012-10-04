<script type="text/javascript" src="<?=$path?>js/jquery.tablednd.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	currentMenu('Personalization A/C', 'Personalization A/C');
});
</script>

<h2>Personalization Account Manager</h2>
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
 <?=form_open('apanel/account_search', array('class'=>'search_form', 'method'=>'post'))?>
        <span style="font-size: 11px; font-weight: bold;">Search By:</span>
        <input type="text" name="name_search" id="name_search" value="<?=$name_search?>" tg_default="Name" />
        <input type="text" name="email_search" id="email_search" value="<?=$email_search?>" tg_default="Email" />
        <input type="text" name="comp_search" id="comp_search" value="<?=$comp_search?>" tg_default="Company" />
        <input type="text" name="domain_search" id="domain_search" value="<?=$domain_search?>" tg_default="Domain: eg. google.com" /> 
        <input type="submit" value="Search" />
        <input type="button" value="All Records" onclick="redirect('<?=site_url('apanel/account')?>')" />
    </form>
<?=$pages?>
<p class="clear"></p>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="list_table" id="table_dnd">
    <thead>
      <tr class="nodrop">
        <td width="2%" class="center"><input type="checkbox" name="checkbox" id="checkbox_main" /></td>
        <td width="17%">Name</td>
        <td width="15%">Email</td>
        <td width="15%">Company</td>
        <td width="10%">Phone</td>
        <td width="10%">Regd. On</td>
        <td width="15%">Websites</td>        
        <td width="12%" class="center">Status</td>
      </tr>
    </thead>
    <tbody>
<?php
$i = 1;
foreach($query->result() as $r):?>
      <tr id="<?php echo $r->account_id;?>">
        <td align="center"><input type="checkbox" name="list_checkbox[]" class="list_checkbox" id="list_checkbox<?=$i?>" value="<?=$r->account_id?>" uid="<?=$r->account_id?>" /></td>
        <td><label for="list_checkbox<?=$i?>"><?=anchor(site_url('apanel/account_form/'.$r->account_id), $r->name)?></label></td>
        <td><label for="list_checkbox<?=$i?>"><?=anchor(site_url('apanel/account_form/'.$r->account_id), $r->email)?></label></td>
        <td><label for="list_checkbox<?=$i?>"><?=anchor(site_url('apanel/account_form/'.$r->account_id), $r->company);?></label></td>
        <td><?=$r->phone?></td>
        <td><?=mdate(DATE_STR, strtotime($r->created))?></td>
        <td><?=$r->sites?></td>
        <td class="center"> 
            <label for="list_checkbox<?=$i?>">
                <?=($r->status == 1) ? '<span class="status1 curved21">On</span>' : '<span class="status0 curved21">Off</span>'; ?> 
            </label>
            <?=($r->confirmed == 0)? '<br /><span class="curved21">Unconfirmed</span>':''?>
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