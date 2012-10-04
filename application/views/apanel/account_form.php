<script type="text/javascript" src="<?php echo $path;?>js/validate.account_form.js"></script>
<script type="text/javascript">
$(function(){
	currentMenu('Personalization A/C', 'Personalization A/C');
});
</script>
<ul id="buttons">
    <li class="todo_icon" title="Save Changes"><?=anchor('apanel', '<img src="'.$path.'img/save_32.png" alt="Save" />', array('class'=>'submitfrm'))?></li>
</ul>
<h2><?=$form['record_id'] == 0 ? 'Add Personalization Account':'Edit Personalization Account'?></h2>
<?php 
	echo $message; 
	echo validation_errors('<div class="fail curved8 hidden">', '</div>'); 
	echo form_open(site_url('apanel/account_form/'.$form['record_id']), array('class'=>'form01'));	
	echo form_hidden('record_id', set_value('record_id', $form['record_id']), 'id="record_id"');
?>
<div id="tabs">
    <ul class="tab_link" style="margin: -6px 0 0;padding: 4px 0 0;">
      <li><a href="#tab-1">Account Information</a></li>
      <li><a href="#tab-2">Personalized Websites</a></li>
    </ul>
    <div id="tab-1" class="tab_box">
    
    <p>
        <label for="fname">First Name</label>
        <input name="fname" type="text" readonly="1" class="input medium form_tip" title="Read-only: First Name." id="fname" value="<?=set_value('fname', $form['fname'])?>" />
    </p> 
    <p>
        <label for="lname">Last Name</label>
        <input name="lname" type="text" readonly="1" class="input medium form_tip" title="Read-only: Last Name." id="lname" value="<?=set_value('lname', $form['lname'])?>" />
    </p> 
    <p>
        <label for="email">Email Address</label>
        <input name="email" type="text" readonly="1" class="input medium form_tip" title="Read-only: Email Address." id="email" value="<?=set_value('email', $form['email'])?>" />
    </p>
    <!--<p>
        <label for="password">Password</label>
        <input name="password" type="password" class="input medium form_tip" title="Enter your new password." id="password" value="" maxlength="20" />
        <?php if($form['record_id'] > 0){?>
        <span class="abt_info">Leave this field blank if you do not want to change your current password.</span>
        <?php }?>
    </p>-->
    <p>
        <label for="company">Company</label>
        <input name="company" type="company" class="input medium form_tip" title="Enter Company Name (Optional)" id="company" value="<?=set_value('company', $form['company'])?>" maxlength="80" />
    </p>
    <p>
        <label for="phone">Phone</label>
        <input name="phone" type="text" class="input medium form_tip" title="Read-only: Phone Number" id="phone" value="<?=set_value('phone', $form['phone'])?>" maxlength="20" />        
    </p>
    <p>
        <label for="country_id">Country</label>
        <?=$form['country']?>        
    </p>
    <p>
        <label for="timezone_id">Timezone</label>
        <?=$form['timezone']?>        
    </p>
    <!--<p>
        <label for="username">Username</label>
        <input name="username" type="text" class="input medium" id="username" value="<?=set_value('username', $form['username'])?>" maxlength="50" />
    </p>-->    
    <p>
        <label for="created">Registered</label>
        <input name="created" type="text" class="input medium form_tip" title="Read-only: Account registered date" id="phone" value="<?=set_value('created', $form['created'])?>" readonly="1" />
    </p>
    <p>
        <label for="created">Registration Confirmed?</label>
        <?=$form['confirmed']=='1'?'Yes':'Not Yet'?>
    </p>
    <p>
        <label for="status">Status</label>
        <input name="status" type="radio" class="form_tip" title="Turn the user on." id="status_on" value="1" <?=set_radio('status', $form['status'], $form['status'] == '1' ? true: false)?> /> On 
        <input name="status" type="radio" class="form_tip" title="Turn the user off." id="status_off" value="0" <?=set_radio('status', $form['status'], $form['status'] == '0' ? true: false)?> /> Off
    </p>    
    <p class="default_submit">
        <input type="submit" name="submit" value="Save" id="submit" />
    </p>
    </div>
    <!--  end div #tab1 -->
    <!--  END TAB 1 -->
    <div id="tab-2" class="tab_box">    
        <div class="todoboard" id="list_baord">  
          <ul>            
            <li><?=anchor('ajax/publish_group/'.$tbl_name.'/site', 'Publish', array('class'=>'group_action'))?></li>
            <li><?=anchor('ajax/unpublish_group/'.$tbl_name.'/site', 'Unpublish', array('class'=>'group_action'))?></li>
          </ul>          
        </div>
        <div class="clear"></div>
        
        <table width="100%" border="0" cellpadding="4" cellspacing="0" class="list_table" id="table_dnd">
            <thead>
              <tr class="nodrop">
                <td width="1%" class="center">&nbsp;</td>
                <td width="2%" class="center"><input type="checkbox" name="checkbox" id="checkbox_main" /></td>
                <td width="10%">Site Id</td>                
                <td width="20%">Site Name</td>
                <td width="20%">Domains</td>
                <td width="17%">Package</td>
                <td width="11%" style="text-align: center">Registered</td>
                <td width="10%" style="text-align: center">Tracker</td>
                <td width="7%" style="text-align: center">Status</td>
              </tr>
            </thead>
            <tbody>
        <?php
        $i = 1;
        $fixedOrder = "sortOrder";
        foreach($site as $r):
            $fixedOrder.= "|".$r->sortorder; ?>
              <tr id="<?php echo $r['site_id']?>" order="<?php echo $r['sortorder']?>">
              
            <?php
            if($search != ''){
                echo '<td class="center">::</td>';
            } else {?>
                <td class="center" class="sort-order"><span class="drag_handle">::</span></td>
            <?php } ?>                
                <td align="center"><input type="checkbox" name="list_checkbox[]" class="list_checkbox" id="list_checkbox<?=$i?>" value="<?=$r['site_id']?>" uid="<?=$r['site_id']?>" /></td>
                <td><label for="list_checkbox<?=$i?>"><?=anchor('#', $r['uniq_id'], 'class="tooltip" title="Click the view site details" onclick="return showSiteDetails('.$r['site_id'].')"')?></label></td>
                <td>
                    <label for="list_checkbox<?=$i?>"><?=anchor('#', $r['site_name'], 'class="tooltip" title="Click the view site details" onclick="return showSiteDetails('.$r['site_id'].')"')?></label>
                    <?php if(trim($r['site_type']) != ''){?><span class="em">Under Category: <?=$r['site_type']?></span><?php }?>
                </td>
                <td>
                    <?=anchor(urlmaker($r['protocol'], $r['domain']), $r['domain'], 'title="Click to visit the website." class="tooltip" target="_blank"');?>
                    <?=is_serialized($r['sub_domains'])?('<hr />'.join('<br />', unserialize($r['sub_domains']))):''?>
                </td>
                <td>
                    <?=anchor(site_url('apanel/package_form/'.$r['pkg_id']), $r['pkg_name'], 'target="_blank" class="tooltip" title="Click to view package details"');?>
                    <?=$r['trial_txt']?>
                    <?=$r['prchsd_txt']?>
                </td>
                <td style="text-align: center"><?=$r['created']?></td>
                <td style="text-align: center"><?=anchor('#', '<img src="'.$path.'img/code1.png">', 'onclick="javascript:return showTracker('.$r['site_id'].', \''.$r['site_name'].'\')" class="tooltip" title="Click to view Tracker Code"')?>
                    <textarea style="display:none" id="trkc_<?=$r['site_id']?>" name="trkc_<?=$r['site_id']?>"><?=set_value("trkc_".$r['site_id'], $r['tracker'])?></textarea>
                </td>
                <td  style="text-align: center"> 
                  <label for="list_checkbox<?=$i?>">
                    <?=($r['status'] == 1) ? '<span class="status1 curved21">On</span>' : '<span class="status0 curved21">Off</span>'; ?> 
                  </label>
                </td>
              </tr>
                <?php
                $i++;
                endforeach;
                ?>
            </tbody>
          </table>
    
        
        <div class="curved5 pop-up" id="site_tracker_code" style="display: block;">
            <div class="closebtn" id="closebtn">X</div>
            <p class="uploadnotice"><b>Tracker Code: </b></p>
            <textarea id="trk_container"></textarea>
            <div class="mineImageUpload" id="btnGenerateCode"><span>Re-generate Code</span></div>
        </div>
        
        <div class="curved5 pop-up" id="site_details" style="display: block;">
            <div class="closebtn" id="closebtn">X</div>
            <p id="sd_ph">
                
            </p>
        </div>
    
    
    </div>
    
    <!--  END TAB 2 -->
    </div>
    <input type="hidden" name="post_task" id="post_task" value="0" />
    </form>
    <!--  END TABS -->
    </div>
    <!--<div id="sidebar">
        <ul>
            <?php
			    echo anchor('apanel/settings', '<img src="'.$path.'img/001_20.png" width="24" height="24" alt="List" />Profile Settings', array('class'=>'active'));
			?>
        </ul>
   </div>-->