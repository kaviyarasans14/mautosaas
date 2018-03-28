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
if(isMobile()){
$cssfile = 'css/mobile.css';
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' type='text/css' href="<?php echo $cssfile;?>">
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="icon" type="image/ico" href='images/favicon.ico' />
<title>Signup | Leads Engage</title>
<script src="jquery-3.3.1.min.js"></script>
<script src="js/inputfieldvalidator.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div class="form-wrapper">
<form name="signup" action='lib/signupprocess.php' autocomplete="off"  onsubmit="return validateForm();" method='POST' class="form-field-container fdesk-signupform" data-redirect="/signup/thank-you" data-redirect-spam="/signup/success" novalidate="novalidate">
  <b id="error"></b>
<fieldset id= "signup_fieldset">
  <div class="name-field-wrapper">
    <div class="name-field">
      <div class="form-field">
	<?php if (!isMobile()): ?>
        <i class="icon-user"></i>
	<?php endif; ?>
        <input type="text" name="firstname" class="name-first_name" id="name-first_name" required/>
<label class="form-placeholder" id = "form-placeholder-first-name">First Name</label><div class="error-wrapper"></div>
</div>
</div>
<div class="name-field">
  <div class="form-field">
    <input type="text" name="lastname" class="name-last_name" required/>
    <label class="form-placeholder">Last Name</label><div class="error-wrapper"></div>
  </div>
</div>
</div>

<div class="form-field">
  <i class="icon-office"></i>
  <input type="text" name="companyname" class="company-form" required/>
  <label class="form-placeholder">Company</label><div class="error-wrapper"></div>
</div>
<div class="form-field">
  <i class="icon-mail2"></i>
  <input type="email" id="emailaddress" onfocusout="validateEmail(this.value)" name="useremail" class="email-form" required/>
  <label class="form-placeholder">Email</label><div class="error-wrapper"></div>
</div>
<div class="form-field">
  <i class="icon-key"></i>
  <input type="password" id="password" name="password" class="password-form" required/>
  <label class="form-placeholder">Password</label>
<div class="error-wrapper"></div>
</div>
<div class="form-field form-field-domain">
  <i class="icon-sphere"></i>
  <input type="text" name="userdomain" onfocusout="checkDomainonKeyup(this.value)" class="helpdesk-form" id="domain" required>
  <label class="form-leadsengage-text">.leadsengage.com</label>
  <label class="form-placeholder">Domain</label>
<div class="error-wrapper"></div>
</div>
<div class="form-field">
  <i class="icon-phone"></i>
  <input type="text" name="mobilenum" class="phone-form" required>
  <label class="form-placeholder">Phone No</label>
<div class="error-wrapper"></div>

</div>
<label class="control control-checkbox">
Agree With LeadsEngage AntiSpam & Privacy Policy
<input type="checkbox" name="conditionagree" required/>
<div class="control_indicator"></div>
</label>
<input type="submit" value="Sign up for free" name="signupbtn-fdesk-signupform" class="button button--solid button--block">
  <div class="copy_write-text align-center">
    <p style="text-align:center;"> Note: All the fields are mandatory</p>
  </div>
</fieldset>

</form>
    </div>

</body>
</html>
