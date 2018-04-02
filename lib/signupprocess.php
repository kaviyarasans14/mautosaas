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

$pdoconn = new PDOConnection ( "" );
if ($pdoconn) {
	$con = $pdoconn->getConnection ();
	if ($con == null) {
		throw new Exception ( $pdoconn->getDBErrorMsg () );
	}
} else {
	throw new Exception ( "Not able to connect to DB" );
}

$idhash = insertInLeadsengage($firstname,$lastname,$companyname,$frommail, $pwd,$usermobile, $domain, $con);
$content = sendSignupVerifyMail($firstname,$lastname,$frommail,$idhash,$con);
$subject = "Leadsengage - Activation email";
//file_put_contents("/var/www/log.txt",$content."\n",FILE_APPEND);
$emailids = array();
$emailids[]=$frommail;
$reason = smtpmail ( $emailids, $subject, $content, "", [], false, "", "" );
echo "<script>top.window.location = 'https://leadsengage.com/thankyou/'</script>";
die;

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
	$isql = "insert into $leadtable (firstname,lastname,company_new,email,mobile,domain,password,created_by,created_by_user,is_published,owner_id,date_identified,date_added,lead_status,lead_stage) values ('$firstname','$lastname','$companyname','$frommail','$usermobile','$domain','$pwd','$userid','$username',1,'$userid','$dateidentified','$dateidentified','$leadstatus','$leadstage')";
	execSQL($con, $isql);
	$asql = "select id from $leadtable where email = '$frommail'";
	$autoidarr = getResultArray($con, $asql);
	$autoid = $autoidarr[0][0];
	$segmentname = DBINFO::$SIGNUP_SEGMENTNAME;
	$segsql = "select * from $segtable where alias = '$segmentname'";
	$segarr = getResultArray($con, $segsql);
	if (sizeof($segarr) > 0) {
		$segmentid = $segarr[0][0];
		$isegment = "insert into $segmenttable values (" . $segmentid . "," . $autoid . ",'" . $dateidentified . "',0,1)";
		execSQL($con, $isegment);
	}	
	$idhash = uniqid();
	$isql = "insert into $stattable (lead_id,email_id,email_address,is_read,is_failed,tracking_hash,is_unsubscribe,is_bounce,date_sent) values ('$autoid','$email_ID','$frommail',0,0,'$idhash',0,0,'$dateidentified')";
	execSQL($con, $isql);
	return $idhash;
}

function encodeArrayForUrl($array)
{
	return urlencode(base64_encode(serialize($array)));
}
function sendSignupVerifyMail($firstname,$lastname,$email,$idhash,$con){
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
	$redirecturl = $signupurl."/r/".$redirectid."?ct=".$ct."&utm_source=leadsengage&utm_medium=email&utm_campaign=Activation+Email&utm_content=Activation+Email&email=".$email;
	$url = $signupurl."/email/".$idhash.".gif";
	$temp = "<html>
	<head>
		<title></title>
	</head>
	<body>
		<div style='padding-top:100px;'>

	<p style='text-align:center;'><img height='1' width='1' src=\"$url\"><img src='https://s3.amazonaws.com/leadsroll.com/home/leadsengage_logo-black.png' class='fr-fic fr-dii' height='40'></p>
	<br>
	<div style='text-align:center;width:100%;'>
		<div style='display:inline-block;width: 60%;'>

			<p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;'>Hi $firstname $lastname</p>

			<p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;'>Good to have you on <a href='http://leadsengage.com'>Leadsengage</a>. Please click following link to verify your email</p><a href=\"$redirecturl\" style='text-align:center;text-decoration:none;font-family: Montserrat,sans-serif;transition: all .1s ease;color: #fff;font-weight: 400;font-size: 18px;margin-top: 10px;font-family: Montserrat,sans-serif;display: inline-block;letter-spacing: .6px;padding: 15px 30px;box-shadow: 0 1px 2px rgba(0,0,0,.36);white-space: nowrap;background-color: #f90;    border: 1px solid #f90;'>Verify Email</a>
			<br>
			<br>

			<p style='text-align:left;font-size:14px;font-family: Montserrat,sans-serif;'>Best,
				<br>Team Leadsengage</p>
		</div>
	</div>
	<br>
	<br>
	<br>

</div>
<div style='text-align:center;margin-top:30px;background-color:#ffffff;border-top:1px solid #d0d0d0;font-family: 'GT-Walsheim-Regular', 'Poppins-Regular', Helvetica, Arial, sans-serif;
            font-weight: normal;font-size:14px;'><span style='display:block;padding-top:20px;'>To make sure you keep getting these emails, please add <Sender Mail ID> to your address book or whitelist us.<br>
Powered by <a href='www.leadsengage.com'>LeadsEngage</a>.
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
