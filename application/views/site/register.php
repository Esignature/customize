<?php require_once('inc/header_login.php')?>
<script>
    $j(function(){
        if($j('.loginerror').length)
            $j('.loginerror').slideDown(); 
    })
</script>
<?php require_once(dirname(__FILE__).'/../frontend/inc/pick_lang.php')?>
<div class="loginbox radius3">
	<div class="loginboxinner radius3">
    	<div class="loginheader">
    		<h1 class="bebas"><?=$lang_signup?></h1>
        	<div class="logo"><img src="images/admin_logo_small.png" alt="" /></div>
    	</div>
    	<!--sinpuheader--> 
        <div class="loginform">
        	<?=validation_errors('<div class="loginerror"><p>', '</p></div>');?> 
        	<form id="login" action="<?=fsite_url('user/register/'.$pkg_id)?>" method="post">
        	    <input type="hidden" name="pkg_id" id="pkg_id" value="<?=$pkg_id?>">
            	<p>
                	<label for="email" class="bebas"><?=$lang_email?></label>
                    <input type="text" id="email" name="email" class="radius2" value="<?=set_value('email', @$form['email'])?>" />
                </p>
                <p>
                	<label for="password" class="bebas"><?=$lang_pword?></label>
                    <input type="password" id="password" name="password" class="radius2" value="<?=set_value('password', @$form['password'])?>"/>
                </p>
                <p>
                    <label for="cpassword" class="bebas"><?=$lang_cpword?></label>
                    <input type="password" id="cpassword" name="cpassword" class="radius2" value="<?=set_value('cpassword', @$form['cpassword'])?>" />
                </p>
                <p>
                    <label for="website" class="bebas"><?=$lang_website?></label>
                    <input type="text" id="website" name="website" class="radius2" value="<?=set_value('website', @$form['website'])?>" />
                    <small>Type the URL of your website's top level domain (without any path or resource name). Eg. http://www.yoursite.com or http://www.yourblog.blogspot.com. (You can change this in your account settings at any time).</small>
                </p>
                <p>
                    <label for="fname" class="bebas"><?=$lang_fname?></label>
                    <input type="text" id="fname" name="fname" class="radius2" value="<?=set_value('fname', @$form['fname'])?>" />
                </p>
                <p>
                    <label for="lname" class="bebas"><?=$lang_lname?></label>
                    <input type="text" id="lname" name="lname" class="radius2" value="<?=set_value('lname', @$form['lname'])?>" />
                </p>
                <p>
                    <label for="company" class="bebas"><?=$lang_company?></label>
                    <input type="text" id="company" name="company" class="radius2" value="<?=set_value('company', @$form['company'])?>" />
                </p>
                <p>
                    <label for="phone" class="bebas"><?=$lang_phone?></label>
                    <input type="text" id="phone" name="phone" class="radius2" value="<?=set_value('phone', @$form['phone'])?>" />
                </p>
                <p>
                    <label for="country_id" class="bebas"><?=$lang_country?></label>
                    <?=$cntry?>
                </p>
                <p>
                    <label for="tz_id" class="bebas"><?=$lang_timezone?></label>
                    <?=$tz?>
                </p>
                <p>
                    <?=$cap?>
                    <span class="fl one_half">
                         <input type="text" id="captcha" name="captcha" class="radius2" style="width: 100%; margin-top: 0px;" /><br />
                         <span><a href="javascript:refreshCap('#icap', '#captcha')"><?=$lang_noread?></a></span>
                    </span>                    
                    <br class="clear" />
                </p>                
                <p>
                    <input type="checkbox" name="agree" id="agree" value="1" <?=set_checkbox('agree', '1')?> />&nbsp;<?=$lang_agree?>.                    
                </p>
                <p>
                	<button class="radius3 bebas"><?=$lang_signup?></button>
                </p>
            </form>
        </div><!--sign form-->
    </div><!--signupboxinner-->
</div><!--signupbox-->
<?php require_once('inc/footer_login.php')?>
