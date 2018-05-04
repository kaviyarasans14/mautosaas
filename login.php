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
//$cssfile = 'width: 50%;margin-left: 25%;margin-top: 10%;';
//if(isMobile()){
    $cssfile = 'width: 100%;padding:2%;margin-top: 10%;';
   if(isMobile()) {
      $fontSize = 'font-size: 13px;';
   }
//}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
 
<title>Login | Leads Engage</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="icon" type="image/ico" href='images/favicon.ico' />
    <style>
         .loginpanel{
        <?php echo $cssfile;?>
    }
         .loginpanel-forgot-domain{
         <?php echo $cssfile;?>
         }
    .btnproceed{  
        text-transform: uppercase;
        width: 100%;
        color: #fff;
        text-align: center;
        font-weight: 700;
        cursor: pointer;
        height: 40px;
        border-color: #2dad89;
        font-size: 18px !important;
        margin-top: 10px;
        margin-bottom: 20px;
        /* background: #f9a82f; */
        background: linear-gradient(to bottom, #f9a82f, #d88913) repeat scroll 0 0 transparent;
        border: solid 1px #D3D637;
        box-shadow: none;
        text-shadow: 0 1px 1px #c37c10;
    }
    .forgot-domain-success {
        max-width: 530px;
        display: none;
        margin-left: auto;
        margin-right: auto;
        border-radius: 9px;
        background-color: rgba(118, 193, 37, .05);
        margin-top: 225px;
        border: solid 1px #ff9900;
        text-align: -webkit-center;
    }
    .verified-check {
             width: 36px;
             height: 36px;
             background-color: #FFFFFF;
             border-radius: 50%;
             color: orange;
             margin: 15px auto 10px;
             line-height: 38px;
    }
    .btnproceed:focus{
        outline: 0;
        box-shadow: none;
    }
    #domain::-webkit-input-placeholder { /* WebKit, Blink, Edge */
    <?php echo $fontSize;?>
    }
    #domain{
        outline: 0;
        box-shadow: none; 
    }
         #domain::placeholder{
             text-overflow:ellipsis;
         }
    #error {
    font-size: .75rem;
    color: red;
    line-height: 1.2;
    font-style: normal;
    letter-spacing: 0;
    }
    #error-email {
        font-size: .75rem;
        color: red;
        line-height: 1.2;
        font-style: normal;
        letter-spacing: 0;
    }
     </style>
  </head>
  <body>
  <form  id="domainchecker" name="domainchecker"  action="#"
  onsubmit='return domainurlfetcher();' method="POST" >
  <div class='loginpanel' id="loginpanel">
  <span id='error'></span>
  <div class="input-group">
  <input style="height: 50px;" type="text" id="domain" name="domain" class="form-control" placeholder="Enter your registered domain here." aria-label="domain" aria-describedby="basic-addon2">
  <span style="background: #f7f7f7;color: #333;font-size: 12px;" class="input-group-addon " id="basic-addon2">.leadsengage.com</span>
   </div>
  <button id="forgot-domains" type="submit" class="btn btnproceed" >Proceed</button>
  </div>
</form>
  <a href="javascript:proceedButtonClicked();" id="forgot-domain" style="font-size: 1.125rem;display: block;text-align: -webkit-center;">Forgot your leadsengage domain? </a>
  <form class="emailchecker" name="emailchecker"  action="#" onsubmit='return getDomainName();' method="POST" >
      <div class='loginpanel-forgot-domain' id="loginpanel-forgot-domain" style="display:none"; >
          <span id='error-email'></span>
          <div class="input-group">
              <input style="height: 50px;" type="text" id="email" name="email" class="form-control" placeholder="Email address" aria-label="email" aria-describedby="basic-addon2">
          </div>
          <button  type="submit" class="btn btnproceed" onclick="javascript:showSuccessMsg();">Proceed</button>
      </div>
  </form>
  <div class="forgot-domain-success" id = 'forgot-domain-success' style="display: none;">
      <div class="verified-check">
          <svg viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg>
      </div>
      <p style="width: 350px;">We’ve sent you an email with your associated Leadsengage account(s)</p>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script type='text/javascript'>
     function clearerrormsg() {
            	document.getElementById('error').innerHTML = '';         
                document.getElementById('error').style.display = "none";   
            }
     function clearemailerrormsg() {
         document.getElementById('error-email').innerHTML = '';
         document.getElementById('error-email').style.display = "none";
     }
    function domainurlfetcher()
            {
                clearerrormsg();
      
                var domain = document.forms['domainchecker']['domain'].value;
                domain=domain.toLowerCase();
                if (domain == null || domain == '')
                {
                        document.getElementById("domain").style.borderColor = "red";                   
                        document.getElementById('error').style.display = "block";
                        document.getElementById('error').innerHTML = "Please fill your domain!";                                      
                        return false; 
                }

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
                                if (response.toString().indexOf("domainnotexists") != -1) {

                                    document.getElementById("domain").style.borderColor = "red";
                                    document.getElementById('error').style.display = "block";
                                    document.getElementById('error').innerHTML = "Given domain name is not registered with us!"; 
                                }else{
                                    var url="https://"+domain+".cratio.in/index.php";
                                    window.open(url,"_blank")
                                } 
                            }
                        }

                        xmlhttp.open("POST", "lib/qsignupprocess.php?checkavailability=" + domain, false);
                        xmlhttp.send();
                return false;
               
            }

        function getDomainName() {
            clearemailerrormsg();

            var email = document.forms['emailchecker']['email'].value;
            email= email.toLowerCase();

            if (email == null || email == '')
            {
                document.getElementById("email").style.borderColor = "red";
                document.getElementById('error-email').style.display = "block";
                document.getElementById('error-email').innerHTML = "Please fill your registered email!";
                document.getElementById('loginpanel-forgot-domain').style.display = 'block';
                return false;
            }

            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }else{// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange = function ()
            {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                {
                    var response = xmlhttp.responseText;
                    if (response.toString().indexOf("emailnotexists") != -1) {
                        document.getElementById("email").style.borderColor = "red";
                        document.getElementById('error-email').style.display = "block";
                        document.getElementById('error-email').innerHTML = "Given Email ID is not registered with us!";
                        document.getElementById('loginpanel-forgot-domain').style.display = 'block';
                    } else {
                        document.getElementById('forgot-domain-success').style.display = 'block';
                    }
                }
            }
            xmlhttp.open("POST", "lib/qsignupprocess.php?checkforgotemailavailability=" + email, false);
            xmlhttp.send();
            return false;
        }
     function proceedButtonClicked() {
             document.getElementById('loginpanel-forgot-domain').style.display = 'block';
             document.getElementById('loginpanel').style.display = 'none';
             document.getElementById('forgot-domain').style.display = 'none';
     }
     function showSuccessMsg() {
         document.getElementById('loginpanel-forgot-domain').style.display = 'none';
         document.getElementById('forgot-domain').style.display = 'none';
     }
    </script>  
</body>
</html>
