<?php 
session_start();
ini_set("display_errors", "1");
error_reporting(E_ALL);

include 'lib/process/config.php';
include 'lib/process/field.php';
include 'lib/util.php';

function displaySynclog($msg) {
    $logdir="log/";
    if (!is_dir($logdir)) {
        $old = umask(0);
        mkdir($logdir, 0777, true);
        umask($old);
    }
    $logfile = "$logdir/sync.log";
    $baseurl = "localhost";
    $remoteaddr = "localhost";
    if (isset($_SERVER['REQUEST_URI'])) {
        $baseurl = $_SERVER['REQUEST_URI'];
        $remoteaddr = $_SERVER['REMOTE_ADDR'];
    }
    $logfilesize = getLogFileSize($logfile);
    if ($logfilesize > LOGINFO::$DEFAULT_FILE_SIZE) {
        $filepath = $logfile;
        createLogZipfile($logdir, "sync.log");
        if (file_exists($filepath)) {
            $old = umask(0);
            unlink($filepath);
            umask($old);
        }
    }
    $currenttime = date("Y-m-d H:i:s");
    error_log($remoteaddr . " : " . $currenttime . " : $msg\n", 3, $logfile);

}
try {
	$apppdoconn = new PDOConnection("");
	$con = null;
	if ($apppdoconn) {
		$con = $apppdoconn -> getConnection();
		if ($con == null) {
			throw new Exception($apppdoconn -> getDBErrorMsg());
		}
	} else {
		throw new Exception("Not able to connect to DB");
	}
	startTransaction($con);
	$ledbconfig = checkLeDBConfig();
	if($ledbconfig) {
		
	$sql = "select appid,f4,f5 FROM ".DBINFO::$APPDBNAME.".applicationlist";
	$applist = getResultArray($con, $sql);
	$numdbs = sizeof($applist);
	for ($i = 0; $i < $numdbs; $i++) {
		$appid = $applist[$i][0];
		$email = $applist[$i][1];
		$domain = $applist[$i][2];
	if($appid!= '' && $email!= '' && $domain!= ''){
	$appdbname = DBINFO::$APPDBNAME . $appid;	
	
	$sql = "select user_name,action,date_added from ".$appdbname.".audit_log where  user_name not like 'Sadmin LeadsEngage' order by date_added desc limit 1";
    $result = getResultArray($con, $sql);
	$username="";
	$action="";
	$dateandtime="";
	if(sizeof($result) > 0 ){
	  $username=$result[0][0];
	  $action= $result[0][1];
	  $dateandtime=$result[0][2];
	}
	$dateadded = getConvertedDateTimeByTZ ($dateandtime, false );
	
    $sql="select planname from  ".$appdbname.".paymenthistory order by createdOn desc limit 1";
	$result = getResultArray($con, $sql);
	$plantype="";
	if(sizeof($result) > 0 ){
		$plantype=$result[0][0];
	}
	
	$sql = "select * FROM ".$appdbname.".licenseinfo";
	$licenseinfo = getResultArray($con, $sql);
	$licensedbs = sizeof($licenseinfo);
	
	  $totalrecordcount = $licenseinfo[0][1];
	  $actualrecordcount = $licenseinfo[0][2];
	  $totalemailcount = $licenseinfo[0][3];
	  $actualemailcount = $licenseinfo[0][4];
	  $activeusercount = $licenseinfo[0][5];
	  $totalusercount = $licenseinfo[0][6];
	  $licensedays = $licenseinfo[0][7];
	  $licensestartdays = $licenseinfo[0][8];
	  $licenseenddays = $licenseinfo[0][9];
	  $totalattachmentsize = $licenseinfo[0][10];
	  $actualattachmentsize = $licenseinfo[0][11];
	  $bounce = $licenseinfo[0][12];
	  $appstatus = $licenseinfo[0][14];
	  $emailvalidity = $licenseinfo[0][15];
	 
	   if($totalrecordcount == 'UL'){
	      $availcontactcredits='UL';
	   }else {
	   	  $availcontactcredits= $totalrecordcount - $actualrecordcount ;
	   }
	   if($totalemailcount == 'UL') {
	   	   $availemailcredits='UL';
	   }else {
	   	  $availemailcredits= $totalemailcount - $actualemailcount ;
	   }
	  
	  $leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
      $sql="update $leadtable set plan_type='$plantype',validity_start_date='$licensestartdays',validity_end_date='$licenseenddays',total_email_credits='$totalemailcount',used_email_credits='$actualemailcount',available_email_credits='$availemailcredits',total_contacts_credits='$totalrecordcount',used_contacts_credits='$actualrecordcount',available_contacts_credit='$availcontactcredits',status='$appstatus',bounce='$bounce',last_activity='$action',last_active='$dateadded' where email='$email' and domain='$domain'";                                                                                
	  execSQL($con, $sql);	
	  displaySynclog("Updated:SuccessFully");
      }  
    }
}
 
	commitTransaction($con);
	
} catch(Exception $ex) {
	$msg = $ex -> getMessage();
	echo "<br><br>" . "Error:" . $msg;
}

function checkLeDBConfig() {
	$dbcon = getRemoteDBConnection("Mysql", getDBHost(), getDBUser(), getDBPass(), DBINFO::$SIGNUP_DBNAME);
	$dbcon = $dbcon -> getConnection();
	if ($dbcon) {
		$signupdatabase=DBINFO::$SIGNUP_DBNAME;
		$sql = "show databases like '$signupdatabase'";
		$checklist = getResultArray($dbcon, $sql);
			if (sizeof($checklist) == 0) {
				displaySynclog("SignUp DataBase not found ! Please Go and Check config.php");
				return false;
		    }
				
		$leadstable = "leads";
		$sql = "show tables like '$leadstable'";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Table:leads not found in database");
			return false;
		}
		
		$sql = "show fields from $leadstable where field='last_active';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:last_active missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='plan_type';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:plan_type missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='validity_start_date';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:validity_start_date missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='validity_end_date';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:validity_end_date missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='total_email_credits';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:total_email_credits missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='used_email_credits';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:used_email_credits missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='available_email_credits';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:available_email_credits missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='total_contacts_credits';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:total_contacts_credits missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='used_contacts_credits';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:used_contacts_credits missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='available_contacts_credit';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:available_contacts_credit missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='bounce';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:bounce missing in $leadstable table.Please check.");
			return false;
		}
		$sql = "show fields from $leadstable where field='last_activity';";
		$checklist = getResultArray($dbcon, $sql);
		if (sizeof($checklist) == 0) {
			displaySynclog("Column:last_activity missing in $leadstable table.Please check.");
			return false;
		}
		return true;
	} else {
		displaySynclog("LeadsEngage Connection Not Established");
		return false;
	}
}

?>
