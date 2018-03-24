<!DOCTYPE html>
<html style="background: #f3f4f5;">
<head>
<link rel='stylesheet' type='text/css' href='css/custom.css'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="icon" type="image/ico" href='images/favicon.ico' />
<title>QSignup | Leads Engage</title>
<style>
p.title {
	margin: 30px 0px 0px 0px;
}

p.content {
	margin: 10px 0px 0px 0px;
}

p.bottom-30 {
	margin: 0px 0px 30px 0px;
}

#othersign {
	position: relative;
	bottom: 579px;;
	left: 6%;
	font-size: 15px;
	display: none;
}

#error {
	text-align: center;
}

#error {
	box-shadow: 1px 1px 1px #dddddd;
	padding-top: 13px;
	padding-bottom: 13px;
	top: -16px;
	left: -2px;
	font-family: helvetica, arial, sans-serif;
	text-shadow: 0px 0px 1px #999999;
	letter-spacing: 1px;
	font-weight: 300;
}
</style>
</head>
<body>
        <?php
    		                 
								
                                $msg = '';
                                $url='';						
								$panel1class = 'form-panel';						
    		                    $userdomain = ""; 
								$useremail = ""; 
								$companyname = "";
								$username = "";
    			
						
								if (isset ( $_REQUEST ['message'] )) {
									$msg = $_REQUEST ['message'];
                                }

                                if (isset ( $_REQUEST ['url'] )) {
                                    $url = $_REQUEST ['url'];
                                    $msg="Signup Successfully!.<a style=\"color:#fff;\" href=\"$url\">Click here to login</a>";
                                    if (isset ( $_REQUEST ['notify'] )) {
                                        $msg .= "<br>".$_REQUEST ['notify'];
                                    }
                                }
									?>
            <div id="signup">
		<div class='ex-form'>
			<form name='signup' action='lib/qsignupprocess.php?signupmode=qsignup' method='POST'
				onsubmit='return validateForm();' autocomplete='off' target='_top'>
				<div id='panel1' class='<?php echo $panel1class ?>'>
					<b id="error"></b>
					<fieldset class='ui-corner-all'>
						<label> <span class='input'><input placeholder='First Name '
								id="firstname" onkeyup='clearFirstNameError();' type='text'
								name='firstname'
								value=''
								style="background-image: url(images/signup-user.png); background-repeat: no-repeat; background-position: 9px;"></span>
						</label>
                        <label> <span class='input'><input placeholder='Last Name '
								id="lastname" onkeyup='clearLastNameError();' type='text'
								name='lastname'
								value=''
								></span>
						</label>
                        <label> <span class='input'><input
								placeholder="Company Name" id="companyname"
								onkeyup='clearCompanyError();' type='text' name='companyname'
								value='<?php echo $companyname ?>'
								style="background-image: url(images/company.png); background-repeat: no-repeat; background-position: 9px;"></span>
						</label> <label> <span class='input'><input
								placeholder="Email (User ID)" id="email"
								onkeyup='clearEmailError();' type='text' name='useremail'	
							    value='<?php echo $useremail ?>'
								style="background-image: url(images/Gmail-icon.png); background-repeat: no-repeat; background-position: 9px;"
								></span>
						</label>  <label> <span class='input'><input
								placeholder="Valid Domain Name" id="domain"
								onkeyup='clearDomainError();' type='text' name='userdomain'	
							    value='<?php echo $userdomain ?>'
								style="background-image: url(images/domain.png); background-repeat: no-repeat; background-position: 9px;"
								onblur="validateDomain(this.value)"></span>
						</label><label> <span class='input'><input
								placeholder="Password (Minimum 4 character)" id="password"
								onkeyup='clearPasswordError();' type='password'
								style="background-image: url(images/password.png); background-repeat: no-repeat; background-position: 9px;"
								name='password'></span>
						</label> <label> <span class='input'><input
								placeholder="Phone No (A valid phone number)" id="mobile"
								onkeyup='clearMobileError();' type='text' name='mobilenum'
								style="background-image: url(images/mobile.png); background-repeat: no-repeat; background-position: 9px;"></span>
						</label>  <label> <input class="button" id="submitbutton"
							type="submit" value="Sign Up">
						</label>
					</fieldset>				
				</div>
			</form>
		</div>
	</div>   
        <script type='text/javascript'>
            function setErrorMsg(error){
            document.getElementById('error').style.display = "block";
            document.getElementById('error').innerHTML =error;                                      
            }
            function setInfoMsg(info){
            document.getElementById('error').style.backgroundColor = "#3fae29";
            document.getElementById('error').innerHTML =info;
            document.getElementById('error').style.display = "block";
            }
            function clearerrormsg() {
            	document.getElementById('error').innerHTML = '';         
                document.getElementById('error').style.display = "none";   
            }
            function clearFirstNameError() {              	       	
                document.getElementById("firstname").style.borderColor = "#e0e0e0";
            }
            function clearLastNameError() {              	       	
                document.getElementById("lastname").style.borderColor = "#e0e0e0";
            }
            function clearCompanyError() { 	        	
                document.getElementById("companyname").style.borderColor = "#e0e0e0";
            }
            function clearEmailError() {            	           	
                document.getElementById("email").style.borderColor = "#e0e0e0";
            }
            function clearMobileError() {        	
                var mobileno = document.forms['signup']['mobilenum'].value;
                if (isNaN(mobileno)) {
                    document.getElementById("mobile").style.borderColor = "#e66c3e";
                } else {
                    document.getElementById("mobile").style.borderColor = "#e0e0e0";

                }
            }          
            function clearPasswordError() {             	         	
                document.getElementById('password').style.borderColor = "#e0e0e0";
            }
            function validateForm()
            {
                clearerrormsg();            
                var firstname = document.forms['signup']['firstname'].value;
                var lastname = document.forms['signup']['lastname'].value;
                var cname = document.forms['signup']['companyname'].value;
                var emailid = document.forms['signup']['useremail'].value;
                var domain = document.forms['signup']['userdomain'].value;
                var mobileno = document.forms['signup']['mobilenum'].value;
                var password = document.forms['signup']['password'].value;               
                if (firstname == null || firstname == '')
                {
                        document.getElementById("firstname").style.borderColor = "#e66c3e";                   
                        document.getElementById('error').style.display = "block";
                        document.getElementById('error').innerHTML = "Please fill your firstname!";                                      
                        return false;
                }
                if (lastname == null || lastname == '')
                {
                        document.getElementById("lastname").style.borderColor = "#e66c3e";                   
                        document.getElementById('error').style.display = "block";
                        document.getElementById('error').innerHTML = "Please fill your lastname!";                                      
                        return false;
                }
				 if (cname == null || cname == '') {
                        document.getElementById("companyname").style.borderColor = "#e66c3e";                  
                        document.getElementById('error').style.display = "block";
                        document.getElementById('error').innerHTML = "Please fill your companyname!";                                   
                        return false;
                }          
				              
                if (!validateEmail(emailid)) {                      
                   return false;  
                }
                if (!validateDomain(domain)) {                      
                   return false;  
                }
                if (password == null || password == '') {
                    document.getElementById("password").style.borderColor = "#e66c3e";                   
                    document.getElementById('error').style.display = "block";
                    document.getElementById('error').innerHTML = "Please fill your password!";                       
                    return false;
                } else if (password.toString().length < 6) {
                    document.getElementById("password").style.borderColor = "#e66c3e";                 
                        document.getElementById('error').style.display = "block";
                        document.getElementById('error').innerHTML = "Please fill your password atleast 6 character!";
                        return false;
                } 
                if (mobileno == null || mobileno == '') {
                    document.getElementById("mobile").style.borderColor = "#e66c3e";                   
                    document.getElementById('error').style.display = "block";
                    document.getElementById('error').innerHTML = "Please fill your mobileno!";
                    return false;  
                } else if (isNaN(mobileno)) {
                    document.getElementById("mobile").style.borderColor = "#e66c3e";                    
                    document.getElementById('error').style.display = "block";
                    document.getElementById('error').innerHTML = "Please fill valid mobileno!";                    
                    
                    return false; 
                }
             
               
                    document.getElementById('error').style.backgroundColor = "#3fae29";
                    document.getElementById('error').innerHTML ='Processing your account signup please wait a while';
                    document.getElementById('error').style.display = "block";

                    document.getElementById("username").style.borderColor = "#e0e0e0";
                    document.getElementById("companyname").style.borderColor = "#e0e0e0";
                    document.getElementById("email").style.borderColor = "#e0e0e0";
                    document.getElementById("mobile").style.borderColor = "#e0e0e0";
                    $isvalid = checktermsofservice();
                    if ($isvalid) {
                        document.getElementById("after-signup").style.display = "block";
                        document.getElementById("signup-error").style.display = "block";
                        document.getElementById("signup").style.display = "none";
                    }
                
                return true;
            }
            function validateEmail(emailid)
            {           	
                othersignup = 'Please signup with your business E-Mail (or) <a target="_parent" style="color:white;font-family: helvetica,arial;text-decoration: none;" href="http://www.cratiocrmsoftware.com/othersignup/"> <br><u style="color: rgb(204, 255, 0);font-size: 13px;">Click here</u></a> to contact our sales team.';
                var invalidemailsids = ["gmail", "yahoo", "hotmail", "live", "outlook", "rediffmail", "mail", "yandex","sify"];
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                var isValidemail = true;
                if (emailid == null || emailid == '') {
                    document.getElementById("email").style.borderColor = "#e66c3e";                   
                    document.getElementById('error').style.display = "block";
                    document.getElementById('error').innerHTML = "Please fill your emailid!";  
                    isValidemail=false;                  
                }else if (!emailid.match(mailformat)) {
                    document.getElementById("email").style.borderColor = "#e66c3e";
                    document.getElementById('error').style.display = "block";
                    document.getElementById('error').innerHTML = "Please fill valid email!";   
                    isValidemail=false;                  
                } else {
                    var resarr = emailid.toString().split("@");
                    var domainext = "";
                    if (resarr.length > 0) {
                        domainext = resarr[resarr.length - 1];
                        domainext = domainext.toLowerCase();
                    }
					 if (emailid.length < 12) {
                        document.getElementById("email").style.borderColor = "#e66c3e";
                        document.getElementById('error').style.display = "block";
                        document.getElementById('error').innerHTML = "Please enter a valid Emailid";
                        isValidemail = false;
                    }                  
                }
                return  isValidemail;
            }

            function validateDomain(domain){
                clearerrormsg();
                var isValiddomain = true;
                if (domain == null || domain == '') {
                    document.getElementById("domain").style.borderColor = "#e66c3e";                   
                    document.getElementById('error').style.display = "block";
                    document.getElementById('error').innerHTML = "Please fill valid domain name!";  
                    isValiddomain=false;                  
                }
                if (isValiddomain) {
                        var xmlhttp;
                        if (window.XMLHttpRequest)
                        {// code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        }
                        else
                        {// code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function ()
                        {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {
                                var response = xmlhttp.responseText;                               
                                if (response.toString().indexOf("domainexist") != -1) {

                                    document.getElementById("domain").style.borderColor = "#e66c3e";
                                    document.getElementById('error').style.display = "block";
                                    document.getElementById('error').innerHTML = "Looks like this domain is already in use. Please choose another to signup....";
                                    isValiddomain=false;      
                                } 
                            }
                        }
                        xmlhttp.open("POST", "lib/qsignupprocess.php?checkavailability=" + domain, false);
                        xmlhttp.send();
                    } 
                    return isValiddomain;
            }
            
           
        </script>
        <?php
if($msg != "" && $url == ""){
        ?>
        <script type='text/javascript'>setErrorMsg('<?php echo $msg ?>')</script>
          <?php
}
        ?>
             <?php
if($msg != "" && $url != ""){
        ?>
        <script type='text/javascript'>setInfoMsg('<?php echo $msg ?>')</script>
          <?php
}
        ?>
</body>
</html>
    
    
