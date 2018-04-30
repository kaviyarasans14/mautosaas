<?php
ini_set ( "display_errors", "1" );
error_reporting ( E_ALL );
include("process/config.php");
include("process/field.php");
include("util.php");
include("smtpmaillip.php");

define('MAUTIC_DOMAIN', "localhost/mauto");

$companyname=$_REQUEST['companyname'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$fromname=$firstname." ".$lastname;
$frommail=$_REQUEST['useremail'];
$domain=$_REQUEST['userdomain'];
$usermobile=$_REQUEST['mobilenum'];
$pwd=$_REQUEST['password'];
$domain = str_replace(' ', '', $domain);
$pdoconn = new PDOConnection ( "" );
if ($pdoconn) {
	$con = $pdoconn->getConnection ();
	if ($con == null) {
		throw new Exception ( $pdoconn->getDBErrorMsg () );
	}
} else {
	throw new Exception ( "Not able to connect to DB" );
}

$res = insertInLeadsengage($firstname,$lastname,$companyname,$frommail, $pwd,$usermobile, $domain, $con);
$idhash = $res[0];
$ct = $res[1];
$leadid = $res[2];
$trackinghash = $res[3];
$content = sendSignupVerifyMail($firstname,$lastname,$frommail,$idhash,$con,$pwd);
$subject = "Activate your LeadsEngage Account Now";
//file_put_contents("/var/www/log.txt",$content."\n",FILE_APPEND);
$emailids = array();
$emailids[]=$frommail;
//$emailids[]='';
//$emailids[]='sales@leadsengage.com';
$reason = smtpmail ( $emailids, $subject, $content, "", [], false, "", "" );
//echo "<script>top.window.location = 'https://leadsengage.com/thankyou/'</script>";
$response="signupsuccessct=".$ct."=".$leadid."=".$trackinghash."=".DBINFO::$SIGNUP_SUCCESS;
die($response);

function insertInLeadsengage($firstname,$lastname,$companyname,$frommail, $pwd,$usermobile, $domain, $con){
	$leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
	$stattable = DBINFO::$SIGNUP_DBNAME.".email_stats";
	$segtable = DBINFO::$SIGNUP_DBNAME.".lead_lists";
	$segmenttable = DBINFO::$SIGNUP_DBNAME.".lead_lists_leads";
	$userid = DBINFO::$DEFAULT_CREATEDBY_ID;
	$username = DBINFO::$DEFAULT_CREATEDBY_NAME;
	$email_ID = DBINFO::$DEFAULT_EMAILID;
    $leadstage = DBINFO::$LEAD_STAGE;
    $leadstatus = DBINFO::$LEAD_STATUS;
	date_default_timezone_set('UTC');
	$dateidentified = date('Y-m-d H:i:s');

	$sql="select email,domain from $leadtable where email='$frommail' and (domain IS NULL OR domain = '');";
	$dbrow = getResultArray ( $con, $sql );
	if(sizeof($dbrow) > 0){
	   $sql = "update $leadtable set firstname='$firstname',lastname='$lastname',company_new='$companyname',email='$frommail',mobile='$usermobile',domain='$domain',password='$pwd',created_by='$userid',created_by_user='$username',is_published='1',owner_id='$userid',date_identified='$dateidentified',date_added='$dateidentified',lead_status='$leadstatus',lead_stage='$leadstage' where email='$frommail'";
	   execSQL($con, $sql);	
	} else {
	  $isql = "insert into $leadtable (firstname,lastname,company_new,email,mobile,domain,password,created_by,created_by_user,is_published,owner_id,date_identified,date_added,lead_status,lead_stage) values ('$firstname','$lastname','$companyname','$frommail','$usermobile','$domain','$pwd','$userid','$username',1,'$userid','$dateidentified','$dateidentified','$leadstatus','$leadstage')";
	   execSQL($con, $isql);	
	}
	
	$asql = "select id from $leadtable where email = '$frommail'";
	$autoidarr = getResultArray($con, $asql);
	$autoid = $autoidarr[0][0];
	$clickthrough = [
            'lead'  => $autoid,
	];
	$ct = encodeArrayForUrl($clickthrough);
	//echo "<script>document.cookie = 'trackingct=$ct; path=/';</script>";
	$segmentname = DBINFO::$SIGNUP_SEGMENTNAME;
	$segsql = "select * from $segtable where alias = '$segmentname'";
	$segarr = getResultArray($con, $segsql);
	if (sizeof($segarr) > 0) {
		$segmentid = $segarr[0][0];
		$sql = "select lead_id from $segmenttable where leadlist_id = '$segmentid' and lead_id = '$autoid'";
        $seglist = getResultArray($con, $sql);
		if(sizeof($seglist) > 0){
			//$isegment = "update $segmenttable set lead_id='$autoid',date_added='$dateidentified',manually_removed='0',manually_added='1' where leadlist_id = '$segmentid'";
		    //execSQL($con, $isegment);
		} else {
			$isegment = "insert into $segmenttable values (" . $segmentid . "," . $autoid . ",'" . $dateidentified . "',0,1)";
		    execSQL($con, $isegment);
		}
		
	}	
	$idhash = uniqid();
	$isql = "insert into $stattable (lead_id,email_id,email_address,is_read,is_failed,tracking_hash,is_unsubscribe,is_bounce,date_sent) values ('$autoid','$email_ID','$frommail',0,0,'$idhash',0,0,'$dateidentified')";
	execSQL($con, $isql);
    $trackinghash = hash('sha1', uniqid(mt_rand()));
	$retarr = array();
	$retarr[] = $idhash;
	$retarr[] = $ct;
    $retarr[] = $autoid;
	$retarr[] = $trackinghash;
	return $retarr;
}

function encodeArrayForUrl($array)
{
	return urlencode(base64_encode(serialize($array)));
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function sendSignupVerifyMail($firstname,$lastname,$email,$idhash,$con,$password){
	$email_ID = DBINFO::$DEFAULT_EMAILID;
	$leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
	$asql = "select id from $leadtable where email = '$email'";
	$autoidarr = getResultArray($con, $asql);
	$autoid = $autoidarr[0][0];
	$clickthrough = [
            'email' => $email_ID,
            'stat'  => $idhash,
	    'lead'  => $autoid,
	];
	$marlestyle = "background-color:#fff;border-bottom:5px solid #0071ff;";
	$butlestyle = "text-align:center;text-decoration:none;font-family: Montserrat,sans-serif;transition: all .1s ease;color: #fff;font-weight: 400;font-size: 18px;margin-top: 10px;font-family: Montserrat,sans-serif;display: inline-block;letter-spacing: .6px;box-shadow: 0 1px 2px rgba(0,0,0,.36);white-space: nowrap;border-radius: 35px;background-color: #0071ff;border: #0071ff;";
	if(isMobile()){
		$marlestyle .= "margin:0px 5px;padding: 5px 0px;";
		$butlestyle .= "padding: 15px 20px;";
	} else {
		$marlestyle .= "margin:0% 11.5%;padding: 50px 50px 50px 50px;";
		$butlestyle .= "padding: 15px 30px;";
	}
	$ct = encodeArrayForUrl($clickthrough);
	$activateUrl = DBINFO::$ACTIONVATION_LINK;
	$redirecttable = DBINFO::$SIGNUP_DBNAME.".page_redirects";
	$signupurl = DBINFO::$SIGNUP_URL;
	$sql = "select redirect_id from $redirecttable where url = '$activateUrl';";
	$result = getResultArray($con, $sql);
	$redirectid = "";
	if (sizeof($result) > 0) {
		$redirectid = $result[0][0];
	}
	$redirecturl = $signupurl."/r/".$redirectid."?ct=".$ct."&email=".$email;
	$url = $signupurl."/email/".$idhash.".gif";
	$temp = "<!DOCTYPE html>
<html>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>

	<head>
		<title></title>
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>
		
	</head>
	<body aria-disabled='false' style='min-height: 300px;margin:0px;'>
		<div style='background-color:#eff2f7'>
			<div style='padding-top: 55px;'>
				<div class='marle' style='$marlestyle'>
					<p style='text-align:center;'><img height='1' width='1' src=\"$url\"></p>
				
					<p style='text-align:center;'><img src='https://s3.amazonaws.com/leadsroll.com/home/leadsengage_logo-black.png' class='fr-fic fr-dii' height='40'></p>
					<br>
					<div style='text-align:center;width:100%;'>
						<div style='display:inline-block;width: 80%;'>

							<p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;'>Hi $firstname $lastname</p>

							<p style='text-align:left;font-size:14px;line-height: 30px;font-family: Montserrat,sans-serif;'>Thanks for signing up! We're thrilled to have you on-board.
								<br>Please click following link to verify your email and Login in to your account.</p><a href=\"$redirecturl\" class='butle' style='$butlestyle'>Login to Your Account</a>
							<br>

							<p style='text-align:left;font-size:14px;line-height: 30px;font-family: Montserrat,sans-serif;'>We're always around to help you set up and make the best use of the product. If you have any questions, just reply to this email, and we'll be on it.</p>
<p style='text-align:left;font-size:14px;line-height: 30px;font-family: Montserrat,sans-serif;'>Here are your login details</p>
<p style='text-align:left;font-size:14px;line-height: 15px;font-family: Montserrat,sans-serif;'><b>Login ID : $email</b></p>
<p style='text-align:left;font-size:14px;line-height: 15px;font-family: Montserrat,sans-serif;'><b>Password : $password</b></p>
							<br>

							<p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;'>Cheers!
								<br>Team LeadsEngage.</p>
						</div>
					</div>
				</div>
				<br>
				<br>
				<br>
			</div>
		</div>
		
<div>
<span style='display:none;'>
{unsubscribe}
</span>
<span style='display:none;'>
{accountaddress}
</span>
</div>

	</body>
</html>
";
return $temp;
}

?>
