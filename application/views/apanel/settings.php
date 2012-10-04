<script type="text/javascript" src="<?php echo $path;?>js/validate.settings.js"></script>
<script type="text/javascript">
$(function(){
	currentMenu('Profile', 'Profile');
});
</script>
<ul id="buttons">
    <li class="todo_icon" title="Save Changes"><?=anchor('apanel', '<img src="'.$path.'img/save_32.png" alt="Save" />', array('class'=>'submitfrm'))?></li>
</ul>
<h2>Profile Settings</h2>
<?php 
	echo $message; 
	echo validation_errors('<div class="fail curved8 hidden">', '</div>');
	echo form_open('apanel/settings', array('class'=>'form01'));
?>
<div id="tabs">
    <ul class="tab_link">
      <li><a href="#tab-1">Profile</a></li>
    </ul>
    <div id="tab-1" class="tab_box">
    <p>
        <label for="screen_name">Profile Name</label>
        <input name="screen_name" type="text" class="input medium form_tip" title="Enter your fullname." id="screen_name" value="<?=set_value('screen_name', $form['screen_name'])?>" />
    </p>
    <p>
        <label for="fname">First Name</label>
        <input name="fname" type="text" class="input medium form_tip" title="Enter First Name." id="fname" value="<?=set_value('fname', $form['fname'])?>" />
    </p> 
    <p>
        <label for="lname">Last Name</label>
        <input name="lname" type="text" class="input medium form_tip" title="Enter Last Name." id="lname" value="<?=set_value('lname', $form['lname'])?>" />
    </p> 
    <p>
        <label for="email">Email Address</label>
        <input name="email" type="text" class="input medium form_tip" title="Enter your email address." id="email" value="<?=set_value('email', $form['email'])?>" />
    </p>
    <p>
        <label for="role_id">Role</label>
        <?=$form['role_name']?>
    </p>
    <p>
        <label for="username">Username</label>
        <input name="username" type="text" class="input medium" id="username" value="<?=set_value('username', $form['username'])?>" maxlength="50" readonly="readonly" />
    </p>
    <p>
        <label for="password">New Password</label>
        <input name="password" type="password" class="input medium form_tip" title="Enter your new password." id="password" value="" maxlength="20" />
        <span class="abt_info">Leave this field blank if you do not want to change your current password.</span>
    </p>
    <p>
        <label for="c_password">Confirm Password</label>
        <input name="c_password" type="password" class="input medium form_tip" title="Re-type your new password." id="c_password" value="" maxlength="20" />
    </p>
    <p class="default_submit">
        <input type="submit" name="submit" value="Save" id="submit" />
    </p>
    </div><!--  end div #tab1 -->
    <!--  END TAB 1 -->

    </div>
    <input type="hidden" name="post_task" id="post_task" value="0" />
    </form>
    <!--  END TABS -->
    </div>
    <div id="sidebar">
        <ul>
            <?php
			    echo anchor('apanel/settings', '<img src="'.$path.'img/001_20.png" width="24" height="24" alt="List" />Profile Settings', array('class'=>'active'));
			?>
        </ul>
   </div>