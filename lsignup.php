<?php
/*
*@copyright   2018 Leadsengage Contributors. All rights reserved
*@author      Leadsengage
*
*@link        http://leadsengage.com
*/
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
$cssfile = 'css/apps.css';
//if(isMobile()){
//$cssfile = 'css/mobile.css';
//}
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' type='text/css' href="<?php echo $cssfile;?>">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="icon" type="image/ico" href='images/favicon.ico' />
<title>Signup | Leads Engage</title>
<script src="jquery-3.3.1.min.js"></script>
<script src="js/inputfieldvalidator.js"></script>
<script src="js/index.js"></script>
    <script>
        window.addEventListener('message', function(event) {
            try {
                var response = event.data;
                response = response.split(";");
                var sessionid = response[2];
                var leadid = response[1];
                var ct = response[0];
                var signupsuccess = response[3];
                document.cookie = "IsTrackingEnabled=true; path=/";
                document.cookie = "trackingct="+ct+"; path=/";
                document.cookie = "mautic_session_id="+sessionid+"; path=/";
                document.cookie = sessionid+"="+leadid+"; path=/";
                window.location = signupsuccess;
            } catch (err) {
            }
        }, false)
    </script>
</head>
<body>
<div class="form-wrapper">
<form name="signup" autocomplete="off"  onsubmit="return validateForm();" method='POST' class="form-field-container fdesk-signupform" data-redirect="/signup/thank-you" data-redirect-spam="/signup/success" novalidate="novalidate">
  <b id="error"></b>
<fieldset id= "signup_fieldset">
  <div class="name-field-wrapper">
    <div class="name-field">
      <div class="form-field">
	<i class="icon-user"></i>
	<input type="text" name="firstname" class="name-first_name" id="name-first_name" required="true"/>
<label class="form-placeholder" id = "form-placeholder-first-name">Name*</label>

</div>
<p id="firstname-error-wrapper" style="display:none;" class="signup_Error"></p>
</div>
</div>

<div class="name-field" style="display:none;">
  <div class="form-field">
    <input type="text" name="lastname" class="name-last_name" required="true"/>
    <label class="form-placeholder">Last Name*</label>
  </div>
<p id="lastname-error-wrapper" style="display:none;" class="signup_Error"></p>
</div>

<div class="form-field" style="display:none;">
  <i class="icon-office"></i>
  <input type="text" name="companyname" class="company-form" required="true"/>
  <label class="form-placeholder">Company*</label>
</div>

<p id="companyname-error-wrapper" style="display:none;" class="signup_Error"></p>

<div class="form-field">
  <i class="icon-mail4"></i>
  <input type="email" id="emailaddress" onfocusout="validateEmail(this.value)" name="useremail" class="email-form" required="true"/>
  <label class="form-placeholder">Business Email*</label>
</div>
<p id="useremail-error-wrapper" style="display:none;" class="signup_Error"></p>
<div class="form-field">
  <i class="icon-key"></i>
  <input type="password" id="password" name="password" class="password-form" required="true"/>
  <label class="form-placeholder">Password (Minimum 6 Characters)*</label>
</div>
<p id="password-error-wrapper" style="display:none;" class="signup_Error"></p>
<div class="form-field form-field-domain">
  <i class="icon-sphere"></i>
  <input type="text" name="userdomain" onfocusout="checkDomainonKeyup(this.value)" class="helpdesk-form" id="domain" required="true">
  <label class="form-leadsengage-text">.leadsengage.com</label>
  <label class="form-placeholder">Your Domain*</label>
</div>
<span style="font-size:13px;display:block;margin-top:-8px;color:#8f8f8f;">This is where you and your users will login to your account</span>
<p id="userdomain-error-wrapper" style="display:none;margin-top:-39px;" class="signup_Error"></p>
<div class="form-field" style="display:none;">
  <i class="icon-phone"></i>
  <input type="text" name="mobilenum" class="phone-form" required="true">
  <label class="form-placeholder">Phone No*</label>
</div>
<p id="mobilenum-error-wrapper" style="display:none;" class="signup_Error"></p>
<input type="submit" value="Sign up for free" name="signupbtn-fdesk-signupform" class="button button--solid button--block">
  
</fieldset>

</form>
    </div>

</body>
</html>
