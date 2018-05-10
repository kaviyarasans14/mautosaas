<?php
//ini_set ( "display_errors", "1" );
//error_reporting ( E_ALL );
include("process/config.php");
include("process/field.php");
include("util.php");
include("process/createElasticEmailSubAccount.php");
include("process/createSendGridAccount.php");
include("smtpmaillip.php");

define('MAUTIC_ROOT_DIR', "/var/www/mauto");
define('MAUTIC_DOMAIN', "localhost/mauto");

function displaysignuplog($msg) {
    $logdir="../log/";
    if (!is_dir($logdir)) {
        $old = umask(0);
        mkdir($logdir, 0777, true);
        umask($old);
    }
    $logfile = "$logdir/qsignup.log";
    $baseurl = "localhost";
    $remoteaddr = "localhost";
    if (isset($_SERVER['REQUEST_URI'])) {
        $baseurl = $_SERVER['REQUEST_URI'];
        $remoteaddr = $_SERVER['REMOTE_ADDR'];
    }
    $logfilesize = getLogFileSize($logfile);
    if ($logfilesize > LOGINFO::$DEFAULT_FILE_SIZE) {
        $filepath = $logfile;
        createLogZipfile($logdir, "qsignup.log");
        if (file_exists($filepath)) {
            $old = umask(0);
            unlink($filepath);
            umask($old);
        }
    }
    $currenttime = date("Y-m-d H:i:s");
    error_log($remoteaddr . " : " . $currenttime . " : $msg\n", 3, $logfile);

}


try{
    $pdoconn = new PDOConnection ( "" );
    if ($pdoconn) {
        $con = $pdoconn->getConnection ();
        if ($con == null) {
            throw new Exception ( $pdoconn->getDBErrorMsg () );
        }
    } else {
        throw new Exception ( "Not able to connect to DB" );
    }
    startTransaction($con);
    if (isset ( $_REQUEST ["params"] )) {
        setREQUESTPARAM ( $_REQUEST ["params"] );
    }
    if(isset($_REQUEST['checkavailability'])){
        $domain=$_REQUEST['checkavailability'];
        $domain = strtolower($domain);
		$domain = str_replace(' ', '', $domain);
        $isavailable=checkDomainAvailability($con,$domain);
        if($isavailable){
            die("domainnotexists");
        }else{
            die("domainexist");
        }
    } else if(isset($_REQUEST['checkemailavailability'])){
        $email=$_REQUEST['checkemailavailability'];
        $email = strtolower($email);
        $isavailable=checkEmailAvailability($con,$email);
        if($isavailable){
            die("emailnotexists");
        }else {
            die("emailexist");
        }
    } else if(isset($_REQUEST['checkforgotemailavailability'])) {
        $email=$_REQUEST['checkforgotemailavailability'];
        $email = strtolower($email);
        $isavailable=checkEmailAvailability($con,$email);
        if($isavailable){
            die("emailnotexists");
        }else {
            $sendmail = sendForgotDomainMail($email,$con);
            die("emailexist");
        }
    } else {
	if(!isset($_REQUEST['signupmode'])){
       		$frommail=$_REQUEST['email'];
	        $userdetails = getUserDetails($con,$frommail);
	        $firstname = $userdetails[0][0];
        	$lastname = $userdetails[0][1];
	        $companyname = $userdetails[0][2];
        	$pwd = $userdetails[0][3];
        	$domain = $userdetails[0][4];
        	$usermobile = $userdetails[0][5];
        	$domain = strtolower($domain);
            if(empty($domain)) {
            $url = "https://leadsengage.com/activation-expired";
            die("url=".$url);
            }
        	$fromname=$firstname;//." ".$lastname;
	} else {
		if(!isset($_REQUEST['userdomain'])){
			die("Domain Not Found!");	
		}
		$companyname=$_REQUEST['companyname'];
		$firstname=$_REQUEST['firstname'];
		$lastname=$_REQUEST['lastname'];
		$fromname=$firstname." ".$lastname;
		$frommail=$_REQUEST['useremail'];
		$domain=$_REQUEST['userdomain'];
		$usermobile=$_REQUEST['mobilenum'];
		$pwd=$_REQUEST['password'];
	}
        displaysignuplog("Company:$companyname");
        displaysignuplog("User Mail:$frommail");
        displaysignuplog("Domain:$domain");
        $isavailable=checkDomainCpanel($con,$domain);
        if(!$isavailable){
            $url="http://$domain.".MAUTIC_DOMAIN."/index.php";
            die("url=".$url);
            //return;
        }
        $response=createSaasDatabase($con);
        if(isset($response['dbname'])){
            $dbname=$response['dbname'];
            $appid=$response['appid'];
            $migrationtable = $dbname.'.migrations';
            $ssql = "select version from $migrationtable  order by version desc limit 1";
            $dbrow = getResultArray ( $con, $ssql );
            $version = "0";
			$currentdatetime = date ( 'Y-m-d H:i:s' );
            if(sizeof($dbrow) > 0){
                $version = $dbrow[0][0];
            }
            $sql="insert into applicationlist(appid,f5,f2,f3,f4,f11,f17,f18,f19,f20,f21,f26,f27,f28,f6,createdtimeat,f7,f14,f15,f16) values('$appid','$domain','$companyname','$fromname','$frommail','$usermobile','1','1','1','1','1','0','0','0','$version','$currentdatetime','Active','','','');";
            displaysignuplog("SQL:".$sql);
            $result = execSQL ( $con, $sql );
            updateLicenseInfo($con, $appid,$dbname);
            displaysignuplog("DB Name:".$dbname);
            if(DBINFO::$SIGNUP_ELASTIC) {
                $elasticuser = "";
                $elasticpwd = "";
                $transport = "mautic.transport.elasticemail";
                $apikey = "";
            } else {
                $elasticuser = "";
                $elasticpwd = "";
                $transport = "mautic.transport.sendgrid_api";
                $apikey = "";
            }
            if(strpos(MAUTIC_DOMAIN, "leadsengage.com") !== false){

                if(DBINFO::$SIGNUP_ELASTIC) {
                    $status = createSubAccount(
                        "$domain@lemailer2.com", "<ELASTIC_PASSWORD>");
                    if ($status[1] == "") {
                        $elasticuser = "$domain@lemailer2.com";
                        $elasticpwd = $status[0];
                        $isupdated = updateHTTPNotification($status[0], "http://$domain." . MAUTIC_DOMAIN . "/mailer/elasticemail/callback");
                        if (!$isupdated) {
                            $response['alert'] = "HTTP Notification not enabled!Do Manually.";
                        }
                        $isupdated = updateAccountProfile($status[0]);
                        if (!$isupdated) {
                            if ($response['alert'] != "") {
                                $response['alert'] .= "Sub Account Profile Not Updated.Do Manually.";
                            } else {
                                $response['alert'] = "Sub Account Profile Not Updated.Do Manually.";
                            }
                        }
                    } else {
                        $response['alert'] = "Elastic Sub Account Creation Failed:" . $status[1];
                    }
                } else {
                    $elasticuser = "$domain@lemailer1.com";
                    $transport = "mautic.transport.sendgrid_api";
                    $status = createSubuser($elasticuser,$frommail,"<SENDGRID_PASSWORD>");
                    if($status){
                        $apikey = createAPI($elasticuser);
                        if($apikey != ""){
                            $isupdated = updateEventnotificationURL($elasticuser,"http://$domain." . MAUTIC_DOMAIN . "/mailer/sendgrid_api/callback");
                            if($isupdated){
                                updateWhiteLabelDomain($elasticuser);
                                updateWhiteLabelLink($elasticuser);
                                updateForwardBounce($elasticuser);
                                updateForwardSpam($elasticuser);
                            } else {
                                if ($response['alert'] != "") {
                                    $response['alert'] .= "Sub Account Profile Not Updated.Do Manually.";
                                } else {
                                    $response['alert'] = "Sub Account Profile Not Updated.Do Manually.";
                                }
                            }
                        } else {
                            if ($response['alert'] != "") {
                                $response['alert'] .= "Sub Account Profile Not Updated.Do Manually.";
                            } else {
                                $response['alert'] = "Sub Account Profile Not Updated.Do Manually.";
                            }
                        }
                    }
                }
            }

            createMauticConfigFile($domain,$dbname,$fromname,$frommail,$elasticuser,$elasticpwd,$transport,$apikey);
            createMauticFirstUser($con,$dbname,$frommail,$firstname,$lastname,$pwd);
            commitTransaction($con);
            $url="http://$domain.".MAUTIC_DOMAIN."/index.php";
            updateAPIdetails($domain,$frommail,$con);
            if(!isset($_REQUEST['signupmode'])){
                die("url=".$url);
		    } else {
                header ( 'Location:' . $url );
		    }
        }else if(isset($response['error'])){
            $url ='thank-you.php?message=' .$response['error'];
            header ( 'Location:' . $url );
        }
    }
    commitTransaction($con);
}catch(Exception $ex){
    rollbackTransaction($con);
    $msg = $ex->getMessage ();
    displaysignuplog("Exception Occur:".$msg);
}
function updateAPIdetails($domain,$email,$con) {
    require_once MAUTIC_ROOT_DIR."/app/config/$domain/local.php";
    $provider = $parameters['mailer_transport'];
    $apikey='';
    $username='';
    if (strpos($provider, 'sendgrid') !== false) {
        $apikey   = $parameters['mailer_api_key'];
        $username = $parameters['mailer_user'];
    } else {
        $username   = $parameters['mailer_user'];
        $apikey     = $parameters['mailer_password'];
    }
    $sql="update applicationlist set f14='$apikey',f15='$username',f16='$provider'where f4='$email' and f5='$domain'";
    execSQL($con, $sql);
}
function sendForgotDomainMail($email,$con) {
    $domain = getDomain($email,$con);
    $bodyContent =getForgotDomainContent($domain);
    $content = alterElasticEmailBodyContent($bodyContent);
    $subject = "LeadsEngage Account - Forgot Domain";
    $emailids = array();
    $emailids[]=$email;
    $reason = smtpmail ( $emailids, $subject, $content, "", [], false, "", "" );

}

function alterElasticEmailBodyContent($bodyContent) {
        $doc                      = new \DOMDocument();
        $doc->strictErrorChecking = false;
        libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="UTF-8">'.$bodyContent);
        // Get body tag.
        $body = $doc->getElementsByTagName('body');
        if ($body and $body->length > 0) {
            $body = $body->item(0);
            //create the div element to append to body element
            $divelement = $doc->createElement('div');
            $ptag1      = $doc->createElement('span', '{unsubscribe}');
            $ptag1->setAttribute('style', 'display:none;');
            $divelement->appendChild($ptag1);
            $ptag2 = $doc->createElement('span', '{accountaddress}');
            $ptag2->setAttribute('style', 'display:none;');
            $divelement->appendChild($ptag2);
            //actually append the element
            $body->appendChild($divelement);
            $bodyContent = $doc->saveHTML();
        }
        libxml_clear_errors();

        return $bodyContent;
}

function getForgotDomainContent($domain) {

    $content = "<html>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
 <head>
 <title></title>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>
 </head>
<body aria-disabled='false' style='min-height: 300px;margin:0px;'>
<div style='background-color:#eff2f7'>
<div style='padding-top: 55px;'>
	<div class='marle' style='margin: 0% 11.5%;background-color:#fff;padding: 50px 50px 50px 50px;border-bottom:5px solid #0071ff;'>
 <p style='text-align:center;'><img src='https://s3.amazonaws.com/leadsroll.com/home/leadsengage_logo-black.png' class='fr-fic fr-dii' height='40'></p>
	<br>
<div style='text-align:center;width:100%;'>
<div style='display:inline-block;width: 80%;'>
    <p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;'>Hi,</p>
    <p style='text-align:left;font-size:14px;line-height: 30px;font-family: Montserrat,sans-serif;'>This email is in your inbox because you requested for forgot domain. </p>
    <p style='text-align:left;font-size:14px;line-height: 30px;font-family: Montserrat,sans-serif;'>Here is a list of accounts where you are an agent. You can click on any of the links below to access your account .</p>
    <a style='font-weight:bold;font-size:15px;'href=\"http://$domain.leadsengage.com\" target=\"_blank\" data-saferedirecturl=\"https://www.google.com/url?hl=en&amp;q=http://$domain.leadsengage.com&amp;source=gmail&amp;ust=1525438903489000&amp;usg=AFQjCNH05Ddf69ly6ktv-4GYs2fY9rUgOA\">$domain.leadsengage.com</a>
    <p style='text-align:left;font-size:14px;line-height: 30px;font-family: Montserrat,sans-serif;' >If you did not request a forgot domain please send a mail to support@leadsengage.com </p ><br >
    <p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;' > Thanks,<br > LeadsEngage Support </p ></div >
     </div >
   </div >
<br >
<br >
<br >
</div >
</div >
</body >
</html >";
    return $content;
}

function getDomain($email,$con) {
    $sql="select f5 from applicationlist where f4='$email';";
    $dbrow = getResultArray ( $con, $sql );
    $domain = '';
    if(sizeof($dbrow) != 0){
        return $domain = $dbrow[0][0];
    }
}

function checkDomainCpanel($con,$domain){
    $sql="select appid from applicationlist where f5='$domain';";
    displaysignuplog("CPanel Domain Validation SQL:".$sql);
    $dbrow = getResultArray ( $con, $sql );
    $domainexist = true;
    if(sizeof($dbrow) != 0){
        $domainexist = false;
    }
    return $domainexist;
}

function checkDomainAvailability($con,$domain){
    $sql="select appid from applicationlist where f5='$domain';";
    displaysignuplog("SQL:".$sql);
    $dbrow = getResultArray ( $con, $sql );
	$domainexist = true;
    if(sizeof($dbrow) != 0){
        return $domainexist = false;
    } else {
        return checkDomainAvail($con,$domain);
    }
}

function checkEmailAvailability($con,$email){
    $sql="select appid from applicationlist where f4='$email';";
    $dbrow = getResultArray ( $con, $sql );
    $emailexist = true;
    if(sizeof($dbrow) != 0){
        return $emailexist = false;
    } else {
        return checkEmailAvail($con,$email);
    }

}

function checkEmailAvail($con,$email) {
    $leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
    $sql="select email,domain from $leadtable where email='$email';";
    $dbrow = getResultArray ( $con, $sql );
    if(sizeof($dbrow) != 0){
        if($dbrow[0][1] == ""){
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }

}

function checkDomainAvail($con,$domain){
    $leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
    $sql="select domain from $leadtable where domain='$domain';";
    $dbrow = getResultArray ( $con, $sql );
    $emailexist = true;
    if(sizeof($dbrow) != 0){
        return $emailexist = false;
    } else {
        return true;
    }

}

function createMauticFirstUser($con,$dbname,$frommail,$firstname,$lastname,$pwd){
    $pwd=getEncodedPwd($pwd);
    $sql="insert into ".$dbname.".users(role_id,is_published,username,password,first_name,last_name,email,online_status,signature,timezone,locale) values('2','1','$frommail','$pwd','$firstname','$lastname','$frommail','offline','Best regards, |FROM_NAME|','Asia/Kolkata','en_US')";
    displaysignuplog("SQL:".$sql);
    $result = execSQL ( $con, $sql );
    return;
}
function getEncodedPwd($pwd){
    $options = [
        'cost' => 12,
    ];
    $pwd=password_hash($pwd, PASSWORD_BCRYPT, $options);
    return $pwd;
}
function getUserDetails($con,$email){
    $leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
    $sql="select firstname,lastname,company_new,password,domain,mobile from $leadtable where email='$email';";
    displaysignuplog("SQL:".$sql);
    $dbrow = getResultArray ( $con, $sql );
    return $dbrow;
}
function createFreeAppIDS($con){
    $maxlimit=10;
    $sql = "select count(1),max(appid) from freeappidtable";
    $dbrow = getResultArray ( $con, $sql );
    $count = $dbrow [0] [0];
    $maxcount = $dbrow [0] [1];
    if ($maxcount == NULL)
        $maxcount = - 1;
    if ($count < $maxlimit) {
        $neededcount = $maxlimit - $count;
        for($i = 0; $i < $neededcount; $i ++) {
            $sql = "insert into freeappidtable values ('" . ++ $maxcount . "','')";
            displaysignuplog("SQL:".$sql);
            $result = execSQL ( $con, $sql );
        }
    }
    return;
}
function updateLicenseInfo($con, $appid, $dbname){
    $currentdatetime=date('Y-m-d H:i:s');
    $currentdate=date('Y-m-d');
	$emailValidityDays = DBINFO::$EMAIL_VALIDITY;
	$emailValid= "+".$emailValidityDays."days";
	$emailvalidity = date('Y-m-d', strtotime($currentdate.$emailValid));
    $enddate = "";
    $editionindex = DBINFO::$DEFAULT_EDITIONINDEX;
    $licensehistorytable=DBINFO::$APPDBNAME.".licensehistory";
    $licenseinfotable = $dbname.".licenseinfo";
    $emailProvider =  DBINFO::$SIGNUP_ELASTIC ? 'Elastic Email' : 'Sendgrid - API';

    $sql = "select featureset from editiontable where editionindex = '$editionindex'";
    displaysignuplog("Edition SQL:".$sql);
    $dbrow = getResultArray ( $con, $sql );
    $featureset = $dbrow[0][0];
	$sql = 'delete from appeditiontable where appid=' . '\'' . $appid . '\'';
	$result = execSQL ( $con, $sql );
    $isql = "insert into appeditiontable values ('$appid','$editionindex','$featureset')";
    displaysignuplog("Insert Edition SQL:".$isql);
    $result = execSQL ( $con, $isql );
    $sql = "select featureindex,value from editionvaluetable where editionindex = '$editionindex'";
    displaysignuplog("Select Feature SQL:".$sql);
    $dbrow = getResultArray ( $con, $sql );
    $licenseinfoval = "";
    $sql = "insert into $licenseinfotable values (1,'0','0','0','0','0','0','0','$currentdate','','UL','0','0','0','Active','$emailvalidity','$emailProvider','0','');";
    displaysignuplog("Insert  LicenseInfo SQL:".$sql);
    $result = execSQL ( $con, $sql );
    for($i = 0; $i < sizeof($dbrow); $i++){
        $featureindex = $dbrow[$i][0];
        $featurevalue = $dbrow[$i][1];
        if ($featureindex == LICENSE::$NOOFUSERS){
            $actualusercount = $featurevalue - 1;
            $sql = "update $licenseinfotable set total_user_count ='$featurevalue'";
            $result = execSQL ( $con, $sql );
        }
        if ($featureindex == LICENSE::$TOTALRECORDCOUNT){
            $sql = "update $licenseinfotable set total_record_count ='$featurevalue'";
            $result = execSQL ( $con, $sql );
        }
        if ($featureindex == LICENSE::$TOTAL_ATTACHMENT_SIZE){
            $sql = "update $licenseinfotable set total_attachement_size ='$featurevalue'";
            $result = execSQL ( $con, $sql );
        }
        if ($featureindex == LICENSE::$TOTAL_EMAIL_COUNT){
            $sql = "update $licenseinfotable set total_email_count  ='$featurevalue'";
            $result = execSQL ( $con, $sql );
        }
        if($featureindex == LICENSE::$DURATIONOFDAYS){
            if($featurevalue != "UL"){
                $daysval = "+".$featurevalue." days";
                $enddate = date("Y-m-d",strtotime(date("Y-m-d", strtotime($currentdate)) . " $daysval"));
                $sql = "update $licenseinfotable set email_validity = '$emailvalidity'";
                $result = execSQL ( $con, $sql );
            }
            $sql = "update $licenseinfotable set licensed_days = '$featurevalue', license_start_date  ='$currentdate',license_end_date ='$enddate';";
            $result = execSQL ( $con, $sql );
			$sql = "update $licensehistorytable set licensed_days = '$featurevalue', license_start_date  ='$currentdate',license_end_date ='$enddate';";
        }

	$nextid = getNextIdValue ( $con, DBINFO::$APPDBNAME . ".licensehistory", "id" );
    $isql = "insert into $licensehistorytable  values('$nextid','$appid','$currentdate','$enddate','$editionindex','$featureindex','Edition','','','','','');";
	displaysignuplog("License History SQL:".$isql);
    $result = execSQL ( $con, $isql );

        $isql = "insert into customfeaturetable values ('$appid','$featureindex','$featurevalue','$currentdatetime')";
        displaysignuplog("Insert Custom SQL:".$isql);
        $result = execSQL ( $con, $isql );
    }
}
function createSaasDatabase($con) {
    $response=array();
    $sql = 'select min(appid) from freeappidtable where schemastatus = ' . '\'' . 'Created' . '\'';
    displaysignuplog("Select APPID:".$sql);
    $resultrow = getResultArray ( $con, $sql );
    $appid = $resultrow [0] [0];
   	if($appid != ""){
        $sql="delete from freeappidtable where appid='$appid ';";
		displaysignuplog("SQL:".$sql);
        $result = execSQL ( $con, $sql );
        $response['appid']=$appid;
        $response['dbname']= DBINFO::$APPDBNAME . $appid;
    }else{
        createFreeAppIDS ($con);
        $sql = "select min(appid) from freeappidtable where schemastatus = 'Created'";
        displaysignuplog("SELECT SQL:".$sql);
	$resultrow = getResultArray ( $con, $sql );
	displaysignuplog("SEIZE OF RESULT SQL:".$resultrow [0] [0]);
	if(sizeof($resultrow) > 0 && $resultrow [0] [0] != null && $resultrow [0] [0] != "") {
            $appid = $resultrow [0] [0];
            $sourcedbname = DBINFO::$APPDBNAME . "base";
            $destdbname = DBINFO::$APPDBNAME . $appid;
            $sql = "show databases like '$sourcedbname';";
            $resultrows = getResultArray($con, $sql);
            if (sizeof($resultrows) > 0) {
                $sql = "show databases like '$destdbname';";
                $resultrows = getResultArray($con, $sql);
                if (sizeof($resultrows) > 0) {
                    $sql = "delete from freeappidtable where appid='$appid';";
                    displaysignuplog("SQL:" . $sql);
                    $result = execSQL($con, $sql);
                    $response['appid'] = $appid;
                    $response['dbname'] = DBINFO::$APPDBNAME . $appid;
                } else {
                    $sql = 'create database ' . $destdbname;
                    $result = execSQL($con, $sql);
                    $username = getDBUser();
                    $hostname = getDBHost();
                    $pwd = getDBPass();
                    $sql = "mysqldump -h $hostname -u $username -p$pwd  -P " . DBINFO::$PORT . " $sourcedbname | mysql -h $hostname -u $username -p$pwd -P" . DBINFO::$PORT . " $destdbname;";
                    displaysignuplog("Dump Command:" . $sql);
                    exec($sql);
                    $sql = "delete from freeappidtable where appid='$appid ';";
                    displaysignuplog("SQL:" . $sql);
                    $result = execSQL($con, $sql);
                    $response['appid'] = $appid;
                    $response['dbname'] = DBINFO::$APPDBNAME . $appid;
                }
            } else {
                $response['error'] = 'Product DB not exist,Please Configure';
            }
        } else {
            $sql = "select min(appid) from freeappidtable where schemastatus != 'Created'";
            $resultrow = getResultArray ( $con, $sql );
            $appid = $resultrow [0] [0];
            $sourcedbname = DBINFO::$APPDBNAME . "base";
            $destdbname = DBINFO::$APPDBNAME . $appid;
            $sql = "show databases like '$sourcedbname';";
            $resultrows = getResultArray($con, $sql);
            if (sizeof($resultrows) > 0) {
                $sql = 'create database ' . $destdbname;
                $result = execSQL($con, $sql);
                $username = getDBUser();
                $hostname = getDBHost();
                $pwd = getDBPass();
                $sql = "mysqldump -h $hostname -u $username -p$pwd  -P " . DBINFO::$PORT . " $sourcedbname | mysql -h $hostname -u $username -p$pwd -P" . DBINFO::$PORT . " $destdbname;";
                displaysignuplog("Dump Command:" . $sql);
                exec($sql);
                $sql = "delete from freeappidtable where appid='$appid ';";
                displaysignuplog("SQL:" . $sql);
                $result = execSQL($con, $sql);
                $response['appid'] = $appid;
                $response['dbname'] = DBINFO::$APPDBNAME . $appid;
            } else {
                $response['error'] = 'Product DB not exist,Please Configure';
            }
        }
    }
    return $response;
}

function createMauticConfigFile($domain,$dbname,$fromname,$frommail,$elastic_user,$elastic_pwd,$transport,$apikey){
    $commondbname = DBINFO::$APPDBNAME;
    $parameters='<?php
	$parameters = array(
		\'db_driver\' => \'pdo_mysql\',
		\'db_host\' => \'localhost\',
		\'db_table_prefix\' => null,
		\'db_port\' => \'3306\',
		\'db_name\' => \''.$dbname.'\',
		\'db_user\' => \'root\',
		\'db_password\' => \'dacam\',
		\'db_backup_tables\' => 1,
		\'db_backup_prefix\' => \'bak_\',
		\'db_server_version\' => \'5.5.58-0ubuntu0.14.04.1\',
		\'mailer_from_name\' => \''.$fromname.'\',
		\'mailer_from_email\' => \''.$frommail.'\',
		\'mailer_transport\' => \''.$transport.'\',
		\'mailer_host\' => null,
		\'mailer_port\' => null,
		\'mailer_user\' => \''.$elastic_user.'\',
		\'mailer_password\' => \''.$elastic_pwd.'\',
		\'mailer_encryption\' => null,
		\'mailer_auth_mode\' => null,
		\'mailer_spool_type\' => \'file\',
		\'mailer_spool_path\' => \'%kernel.root_dir%/spool/'.$domain.'\',
		\'secret_key\' => \'61fe7d5e17d03e585ebf52ff75224c30a47d449860607df686ddccfcd85fc2df\',
		\'site_url\' => \'http://'.$domain.'.'.MAUTIC_DOMAIN.'/index.php\',
			\'cache_path\' => \''.MAUTIC_ROOT_DIR.'/app/cache/'.$domain.'\',
		\'log_path\' => \''.MAUTIC_ROOT_DIR.'/app/logs/'.$domain.'\',
		\'image_path\' => \'media/images/'.$domain.'\',
		\'tmp_path\' => \''.MAUTIC_ROOT_DIR.'/app/../media/files/'.$domain.'\',
        \'api_enabled\' => 0,
	\'api_enable_basic_auth\' => false,
	\'api_oauth2_access_token_lifetime\' => 60,
	\'api_oauth2_refresh_token_lifetime\' => 14,
	\'api_batch_max_limit\' => \'200\',
        \'upload_dir\' => \''.MAUTIC_ROOT_DIR.'/app/../media/files/'.$domain.'\',
	\'max_size\' => \'10\',
	\'cors_restrict_domains\' => 0,
	\'cors_valid_domains\' => array(

	),
	\'default_timezone\' => \'Asia/Kolkata\',
	\'locale\' => \'en_US\',
	\'email_frequency_number\' => 10,
	\'email_frequency_time\' => \'MONTH\',
	\'mailer_is_owner\' => 0,
	\'background_import_if_more_rows_than\' => 5000,
	\'footer_text\' => \'To make sure you keep getting these emails in your INBOX, please add {from_email} to your address book or whitelist us.<br />Want out of the loop? {unsubscribe_link}<br /><br />Our Postal Address: {postal_address}\',
	\'mailer_api_key\' => \''.$apikey.'\',
	\'track_contact_by_ip\' => true,
	\'track_by_fingerprint\' => true,
	);
	?>';
    $configpath=MAUTIC_ROOT_DIR."/app/config/".$domain;
    if (! is_dir ( $configpath )) {
        $old = umask ( 0 );
        mkdir ( $configpath, 0777 );
        umask ( $old );
    }
    chmod(MAUTIC_ROOT_DIR."/app/cache", 0777);
    if (is_dir ( $configpath )) {
        $filepath=$configpath."/local.php";
        displaysignuplog("File Path:".$filepath);
        file_put_contents($filepath,$parameters);
    }
    return;
}
?>
