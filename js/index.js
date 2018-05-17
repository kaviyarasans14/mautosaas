function clearerrormsg() {
    	var firstnameerror = document.getElementById("firstname-error-wrapper");
	firstnameerror.innerHTML = "";
	firstnameerror.style.display = "none";
	var lastnameerror = document.getElementById("lastname-error-wrapper");
	lastnameerror.innerHTML = "";
	lastnameerror.style.display = "none";
	var cnameerror = document.getElementById("companyname-error-wrapper");
	cnameerror.innerHTML = "";
	cnameerror.style.display = "none";
	var emailiderror = document.getElementById("useremail-error-wrapper");
	emailiderror.innerHTML = "";
	emailiderror.style.display = "none";
	var mobilenoerror = document.getElementById("mobilenum-error-wrapper");
	mobilenoerror.innerHTML = "";
	mobilenoerror.style.display = "none";
	var passworderror = document.getElementById("password-error-wrapper");
	passworderror.innerHTML = "";
	passworderror.style.display = "none";
	var userdomainerror = document.getElementById("userdomain-error-wrapper");
	userdomainerror.innerHTML = "";
	userdomainerror.style.display = "none";
	var firstnamewidget = document.forms['signup']['firstname'];
	firstnamewidget.parentElement.className = "form-field";
        var lastnamewidget = document.forms['signup']['lastname'];
	lastnamewidget.parentElement.className = "form-field";
        var cnamewidget = document.forms['signup']['companyname'];
	cnamewidget.parentElement.className = "form-field";
        var emailidwidget = document.forms['signup']['useremail'];
        emailidwidget.parentElement.className = "form-field";
        var domainwidget = document.forms['signup']['userdomain'];
        domainwidget.parentElement.className = "form-field form-field-domain";
        var mobilenowidget = document.forms['signup']['mobilenum'];
        mobilenowidget.parentElement.className = "form-field";
        var passwordwidget = document.forms['signup']['password'];
	passwordwidget.parentElement.className = "form-field";
}
function validateForm() {
	var isvalidform = true;
	clearerrormsg();
	var firstnamewidget = document.forms['signup']['firstname'];
	var lastnamewidget = document.forms['signup']['lastname'];
	var cnamewidget = document.forms['signup']['companyname'];
	var emailidwidget = document.forms['signup']['useremail'];
    var domainwidget = document.forms['signup']['userdomain'];
    var mobilenowidget = document.forms['signup']['mobilenum'];
    var passwordwidget = document.forms['signup']['password'];
	var firstname = firstnamewidget.value;
	var lastname = lastnamewidget.value;
	var cname = cnamewidget.value;
    var emailid = emailidwidget.value;
    var domain = domainwidget.value;
    var mobileno = mobilenowidget.value;
    var password = passwordwidget.value;
	var firstnameerror = document.getElementById("firstname-error-wrapper");
	var lastnameerror = document.getElementById("lastname-error-wrapper");
	var cnameerror = document.getElementById("companyname-error-wrapper");
	var emailiderror = document.getElementById("useremail-error-wrapper");
	var mobilenoerror = document.getElementById("mobilenum-error-wrapper");
	var passworderror = document.getElementById("password-error-wrapper");
	var userdomainerror = document.getElementById("userdomain-error-wrapper");
    if (firstname == null || firstname == ''){
		firstnameerror.style.display = "block";
		firstnameerror.innerHTML = "Please Fill Your Name";
		firstnamewidget.parentElement.className += " error";
		isvalidform = false;
	}
    //if (lastname == null || lastname == ''){
		//lastnameerror.style.display = "block";
		//lastnameerror.innerHTML = "Please Fill Your Last Name";
		//lastnamewidget.parentElement.className += " error";
		//isvalidform = false;
	//}

	/*if (cname == null || cname == '') {
		cnameerror.style.display = "block";
		cnameerror.innerHTML = "Please Fill Your Company";
		cnamewidget.parentElement.className += " error";
		isvalidform = false;
	}*/
				              
	if (!validateEmail(emailid)) {   
		isvalidform = false;                   
	}
	if (!validateDomain(domain)) {             
		isvalidform = false;         
	}

	if (password == null || password == '') {
		passworderror.style.display = "block";
		passworderror.innerHTML = "Please Fill Your Password";
		passwordwidget.parentElement.className += " error";
		isvalidform = false;
	} else if (password.toString().length < 6) {
		passworderror.style.display = "block";
		passworderror.innerHTML = "Use 6 or more characters for your Password";
		passwordwidget.parentElement.className += " error";
		isvalidform = false;
	} 
	/*if (mobileno == null || mobileno == '') {
		mobilenoerror.style.display = "block";
		mobilenoerror.innerHTML = "Please Fill Your Phone No";
		mobilenowidget.parentElement.className += " error";
		isvalidform = false;
	} else if (isNaN(mobileno)) {
		mobilenoerror.style.display = "block";
		mobilenoerror.innerHTML = "Phone No doesn't look right. Use the Valid one";
		mobilenowidget.parentElement.className += " error";
		    
		isvalidform = false;
	}*/
	if(isvalidform){
		document.cookie = "IsTrackingEnabled=true; path=/";
		sendSignupMail(cname,firstname,lastname,emailid,domain,mobileno,password);
	}
	return isvalidform;
}

function validateEmail(emailid){  
	var emailidwidget = document.forms['signup']['useremail'];
	var emailiderror = document.getElementById("useremail-error-wrapper");
	emailiderror.style.display = "none";
	emailiderror.innerHTML = "";
	emailidwidget.parentElement.className = "form-field";
	var othersignup = 'Please Enter Your Business Email or <a target="_blank" href="https://leadsengage.com/signup-free-trial/" style="color:#FFFFFF;">Contact Sales For Free Trial</a>';
	var invalidemailsids = ["gmail", "yahoo", "hotmail", "live", "outlook", "rediffmail", "mail", "yandex","sify"];
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!yahoo.co.in)(?!aol.com)(?!abc.com)(?!xyz.com)(?!pqr.com)(?!rediffmail.com)(?!live.com)(?!outlook.com)(?!me.com)(?!msn.com)(?!ymail.com)([\w-]+\.)+[\w-]{2,4})?$/;
	var isValidemail = true;
	if (emailid == null || emailid == '') {
		emailiderror.style.display = "block";
		emailiderror.innerHTML = "Please Fill Your Email";
		emailidwidget.parentElement.className += " error";
		isValidemail=false;                  
	}else if (!emailid.match(mailformat)) {
		emailiderror.style.display = "block";
		emailiderror.innerHTML = "Email doesn't look right. Use the Valid one";
		emailidwidget.parentElement.className += " error";
		isValidemail=false;                  
	} else if (!reg.test(emailid)){
		emailiderror.style.display = "block";
		emailiderror.innerHTML = othersignup;
		emailidwidget.parentElement.className += " error";
		isValidemail=false;           
	}	
	if(isValidemail){
		isValidemail = checkEmail(emailid);
	}
	return  isValidemail;
}

function checkEmail(email){
	var emailidwidget = document.forms['signup']['useremail'];
	var emailiderror = document.getElementById("useremail-error-wrapper");
	emailiderror.style.display = "none";
	emailiderror.innerHTML = "";
	var isValidemail = true;
	if (email == null || email == '') {
		emailiderror.style.display = "block";
		emailiderror.innerHTML = "Please fill valid Email";
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
					var emailidwidget = document.forms['signup']['useremail'];
					var emailiderror = document.getElementById("useremail-error-wrapper");
					emailiderror.style.display = "block";
					emailiderror.innerHTML = email+" already registered with us";
					emailidwidget.parentElement.className += " error";
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
	var domainwidget = document.forms['signup']['userdomain'];
	var userdomainerror = document.getElementById("userdomain-error-wrapper");
	userdomainerror.style.display = "none";
	userdomainerror.innerHTML = "";
	domainwidget.parentElement.className = "form-field form-field-domain";
	var isValiddomain = true;
	if (domain == null || domain == '') {
		userdomainerror.style.display = "block";
		userdomainerror.innerHTML = "Please Fill Your Domain";
		domainwidget.parentElement.className += " error";
		isValiddomain=false;                  
	}
	var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
	if(format.test(domain)){
		userdomainerror.style.display = "block";
		userdomainerror.innerHTML = "Use Letters, Numbers only in Domain";
		domainwidget.parentElement.className += " error";
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
					userdomainerror.style.display = "block";
					userdomainerror.innerHTML = domain+" not available. Try another";
					domainwidget.parentElement.className += " error";
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
function sendSignupMail(cname,firstname,lastname,emailid,domain,mobileno,password){
	var requesturl = "?companyname="+cname+"&firstname="+firstname+"&lastname="+lastname+"&useremail="+emailid+"&userdomain="+domain+"&mobilenum="+mobileno+"&password="+password;
    var xmlhttp;
    var isvalidSignup = false;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }else{// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
    	if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
			var response = xmlhttp.responseText;
			if(response.toString().indexOf("signupsuccessct") != -1){
				var res = response.split("=");
				var ct = res[1];
				var leadid = res[2];
				var trackinghash = res[3];
                var signupsuccess = res[4];
				var response = ct+"^"+leadid+"^"+trackinghash+"^"+signupsuccess;
	        	isvalidSignup = true;
            	document.cookie = "trackingct="+ct+"; path=/";
            //	window.location = "http://test.leadsengage.com";
                parent.postMessage(response, '*');
			} else {
		    	isvalidSignup = false;
        	}
		}
	}
    xmlhttp.open("POST", "lib/signupprocess.php"+requesturl, false);
	xmlhttp.send();
    return isvalidSignup;
}
