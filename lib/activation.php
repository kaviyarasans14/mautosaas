<?php
/*
 *@copyright   2018 Leadsengage Contributors. All rights reserved
 *@author      Leadsengage
 *
 *@link        http://leadsengage.com
 */

$email = "";
if (isset($_REQUEST['email'])) {
	$email = $_REQUEST['email'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Activation | Leadsengage</title>
		<script src="../js/index.js"></script>
		
	</head>
	<body onload="createSignup()">
		<input type="text" style="display:none;" id="emailid" value="<?php echo $email;?>" class="name-first_name" required/>
		<div style="display:flex;margin-left: -8px;width: 104%;">
			<div style="background-color: #0071ff;text-align: left;width: 100%;margin-top: -15px;height: 70px;"><img height="35" style="margin-top:15px;" src="https://s3.amazonaws.com/leadsroll.com/home/leadsengage_logo-white-orange.png"/>
			</div>
		</div>
		<div id="signup_progress" style="padding-top:100px;text-align:center;">
			<img src="../images/loading.gif" style="text-align:center;height:200px;width:auto;" />
			
		</div>
		<div id="activation_success" style="padding-top:100px;display:none;">
			<h1 style="text-align:center;font-family: Montserrat,sans-serif;"><b>Activation Successful</b></h1>
			<p id="click_here" style="text-align:center;font-size:16px;line-height:30px; font-weight:500;font-family: Montserrat,sans-serif;">
				To continue working with Leadsengage <a href="<?php echo $url;?>">click here</a>
				<br>
				<br>
			</p>
		</div>
		
	</body>
</html>

