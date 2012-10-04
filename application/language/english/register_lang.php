<?php

/*
* - Account User Registration
*/

$lang['lang_signup']= 'Sign Up';
$lang['reg_email']  = 'Email';
$lang['reg_pword']  = 'Password';
$lang['reg_cpword'] = 'Confirm Password';
$lang['reg_fname']  = 'First Name';
$lang['reg_lname']  = 'Last Name';
$lang['reg_comp']   = 'Company';
$lang['reg_phone']  = 'Phone';
$lang['reg_cntry']  = 'Country';
$lang['reg_tz']     = 'Timezone';
$lang['reg_website']= 'Website';
$lang['reg_noread'] = 'Can\'t read? Click here.';
$lang['reg_agree']  = 'I have read and agree to the %s and %s.';


$lang['lang_reg_completed']     = 'Registration Completed';
$lang['lang_acc_alr_active']    = 'Account Already Activated';
$lang['lang_reg_confd']         = 'Registration Confirmed';
$lang['lang_conf_err']          = 'Account Confirmation Error';
$lang['lang_canc_err']          = 'Registration Cancellation Error';
$lang['lang_inv_pkg']           = 'Invalid Package selection. Please get back to the package page and register for one.';
$lang['lang_inv_email']         = 'The email <i>%s</i> is already registered. Please use another.';
$lang['lang_inv_captcha']       = 'Incorrect word entered in %s field';
$lang['lang_inv_url']           = 'Invalid URL provided.';
$lang['lang_unreal_url']       = 'The URL does not even exists.';


$lang['lang_R101'] = 'Sorry !! The link  you are using to confirm your registration seems invalid. Please check the link in your inbox and click it again to retry.';
$lang['lang_R102'] = 'Sorry !! We cannot not cancel your registration. Please check the cancellation link in your inbox and click it again to retry.';
$lang['lang_R103'] = 'Thank you for Signing Up! Your account is now ready to use. Please '.anchor(fsite_url('user/login'), 'Login').' to start off. ';
$lang['lang_R104'] = 'We\'ve sent you a confirmation email! <br />Click the link in the email to verify your email address and complete registration.<br />TIP: If you do not receive any email from us within a few minutes, check your spam or junk folder.<br />After verifying your email, login to your account to begin.';
$lang['lang_R105'] = 'You have already activated your account previously. Please '.anchor(fsite_url('user/login'), 'Login').' to start off.';
$lang['lang_R106'] = 'Copy the tracker code below, and place it right before the &lt;/head&gt; tag in every page that you want to track.';

// js validation

$lang['lang_val_email_reqd']= 'Please enter your email address.';
$lang['lang_val_email_inv'] = "Please enter your valid email address.";

$lang['lang_val_pwd_reqd']  = 'Please enter your email address.';
$lang['lang_val_pwd_min']   = "Please enter a password (6-20 character).";
$lang['lang_val_pwd_max']   = 'Password must not exceed 20 characters.';

$lang['lang_val_cped_reqd'] = "Please confirm your password.";
$lang['lang_val_cpwd_eq']   = 'Password did not match.';

$lang['lang_val_web_reqd']  = "Please specify your valid website url. e.g. http://www.somesite.com";
$lang['lang_val_web_url']   = 'The url you specified is not in valid format.';

$lang['lang_val_fname']     = "Please enter your first name.";
$lang['lang_val_lname']     = 'Please enter your last name.';
$lang['lang_val_comp']      = "Please enter your company name.";
$lang['lang_val_phone']     = "Please enter your phone number.";
$lang['lang_val_cntry']     = 'Please select your country.';
$lang['lang_val_tz']        = "Please select your timezone.";
$lang['lang_val_cap_reqd']  = "Please enter the word you see alongside.";
$lang['lang_val_cap_inv']   = "Invalid captcha word entered.";
$lang['lang_val_agree']     = "You must agree to the Terms & Condition and Privacy Policy in order to continue.";
