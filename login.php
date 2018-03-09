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
        width: 50%;
        margin-left: 25%;
        margin-top: 10%;
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
        border: 1px solid #ff9900;
        box-shadow: none;
        text-shadow: 0 1px 1px #c37c10;
    }
    .btnproceed:focus{
        outline: 0;
        box-shadow: none;
    }
    #domain{
        outline: 0;
        box-shadow: none; 
    }
    #error {
    font-size: .75rem;
    color: red;
    line-height: 1.2;
    font-style: normal;
    letter-spacing: 0;
    }
     </style>
  </head>
  <body>
  <form id="domainchecker" name="domainchecker"  action="#" 
  onsubmit='return domainurlfetcher();' method="POST" >
  <div class='loginpanel'>
  <span id='error'></span>
  <div class="input-group">
  <input style="
    height: 50px;
" type="text" id="domain" name="domain" class="form-control" placeholder="Enter your registered domain here." aria-label="domain" aria-describedby="basic-addon2">
  <span style="
    background: #f7f7f7;
    color: #333;
    font-size: 1rem;
" class="input-group-addon" id="basic-addon2">.leadsengage.com</span>
   </div>
  <button type="submit" class="btn btnproceed" >Proceed</button>
  </div>
</form>
 

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
    
    </script>  
</body>
</html>
