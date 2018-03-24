<?php
ini_set ( "display_errors", "1" );
error_reporting ( E_ALL );
include("process/config.php");
include("process/field.php");
include("util.php");

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

insertInLeadsengage($firstname,$lastname,$companyname,$frommail, $pwd,$usermobile, $domain, $con);
//header ( 'Location:' . 'https://leadsengage.com/thankyou/' );
echo "<script>top.window.location = 'https://leadsengage.com/thankyou/'</script>";
die;

function insertInLeadsengage($firstname,$lastname,$companyname,$frommail, $pwd,$usermobile, $domain, $con){
	$leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
	$segtable = DBINFO::$SIGNUP_DBNAME.".lead_lists";
	$segmenttable = DBINFO::$SIGNUP_DBNAME.".lead_lists_leads";
	$userid = DBINFO::$DEFAULT_CREATEDBY_ID;
	$username = DBINFO::$DEFAULT_CREATEDBY_NAME;
	date_default_timezone_set('UTC');
	$dateidentified = date('Y-m-d H:i:s');
	$isql = "insert into $leadtable (firstname,lastname,company_new,email,mobile,domain,password,created_by,created_by_user,is_published,owner_id,date_identified,date_added) values ('$firstname','$lastname','$companyname','$frommail','$usermobile','$domain','$pwd','$userid','$username',1,'$userid','$dateidentified','$dateidentified')";
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
}
?>
