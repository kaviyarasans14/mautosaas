function clearerrormsg() {
    	document.getElementById('error').innerHTML = '';         
	document.getElementById('error').style.display = "none";   
}
function validateForm() {
	clearerrormsg();
	var firstname = document.forms['signup']['firstname'].value;
	var lastname = document.forms['signup']['lastname'].value;
	var cname = document.forms['signup']['companyname'].value;
        var emailid = document.forms['signup']['useremail'].value;
        var domain = document.forms['signup']['userdomain'].value;
        var mobileno = document.forms['signup']['mobilenum'].value;
        var password = document.forms['signup']['password'].value;               
        if (firstname == null || firstname == ''){
		document.getElementById('error').style.display = "block";
                document.getElementById('error').innerHTML = "Please fill your firstname!";                                      
                return false;
	} else if (lastname == null || lastname == ''){
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill your lastname!";                                      
	        return false;
        }else if (cname == null || cname == '') {
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
		document.getElementById("domain").style.borderColor = "#e66c3e";
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill your password!";                       
		return false;
	} else if (password.toString().length < 4) {
		document.getElementById("domain").style.borderColor = "#e66c3e";
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill your password atleast 4 character!";
		return false;
	} 
	if (mobileno == null || mobileno == '') {
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill your mobileno!";
		return false;  
	} else if (isNaN(mobileno)) {
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill valid mobileno!";                    
                    
		return false; 
	}
             
        return true;
}

function validateEmail(emailid){  
	document.getElementById('error').style.display = "none";
	document.getElementById('error').innerHTML = ""; 
	var othersignup = 'Please signup with your business E-Mail (or) <a target="_parent" style="color:white;font-family: helvetica,arial;text-decoration: none;" href="http://www.cratiocrmsoftware.com/othersignup/"> <br><u style="color: rgb(204, 255, 0);font-size: 13px;">Click here</u></a> to contact our sales team.';
	var invalidemailsids = ["gmail", "yahoo", "hotmail", "live", "outlook", "rediffmail", "mail", "yandex","sify"];
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!yahoo.co.in)(?!aol.com)(?!abc.com)(?!xyz.com)(?!pqr.com)(?!rediffmail.com)(?!live.com)(?!outlook.com)(?!me.com)(?!msn.com)(?!ymail.com)([\w-]+\.)+[\w-]{2,4})?$/;
	var isValidemail = true;
	if (emailid == null || emailid == '') {
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill your emailid!";  
		isValidemail=false;                  
	}else if (!emailid.match(mailformat)) {
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill valid email!";   
		isValidemail=false;                  
	} else if (!reg.test(emailid)){
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please provide your business email!";   
		isValidemail=false;           
	}	
	if(isValidemail){
		isValidemail = checkEmail(emailid);
	}
	return  isValidemail;
}

function checkEmail(email){
	var isValidemail = true;
	if (domain == null || domain == '') {
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill valid Email!";  
		isValidemail=false;                  
	}
	if (isValidemail) {
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var response = xmlhttp.responseText;                               
				if (response.toString().indexOf("emailexist") != -1) {
					document.getElementById('error').style.display = "block";
					document.getElementById('error').innerHTML = "Looks like this Email address is already in use. Please choose another to signup....";
					isValidemail=false;      
				} 
			}
        	}
		xmlhttp.open("POST", "lib/qsignupprocess.php?checkemailavailability=" + email, false);
		xmlhttp.send();
	} 
	return isValidemail;
}

function validateDomain(domain){
	document.getElementById('error').style.display = "none";
	document.getElementById('error').innerHTML = "";
	var isValiddomain = true;
	if (domain == null || domain == '') {
		document.getElementById("domain").style.borderColor = "#e66c3e";                   
		document.getElementById('error').style.display = "block";
		document.getElementById('error').innerHTML = "Please fill valid domain name!";  
		isValiddomain=false;                  
	}
	if (isValiddomain) {
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
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

function checkDomainonKeyup(domain){
	validateDomain(domain);
}

function createSignup(){
	var isValidemail = true;
	var email = document.getElementById("emailid").value;
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	setTimeout(function(){
		xmlhttp.onreadystatechange = function () {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				var response = xmlhttp.responseText;                               
				if (response.toString().indexOf("emailexist") != -1) {
					
					isValidemail=false;      
				} else{
					//alert("Response"+response);
					if(response.toString().indexOf("url") != -1){
						var res = response.split("=");
						window.location = res[1];
					} else {
						var res = response.split("=");
						var url = res[1];
						var atag = "To continue working with Leadsengage <a href="+url+">Click here</a>"
						document.getElementById('click_here').innerHTML = "";
						document.getElementById('click_here').innerHTML = atag;
						document.getElementById('activation_success').style.display = "block";
						document.getElementById('signup_progress').style.display = "none";
					}
				}
			}
		}
		xmlhttp.open("POST", "qsignupprocess.php?email=" + email, false);
		xmlhttp.send();
	}, 500);
	return isValidemail;
}
