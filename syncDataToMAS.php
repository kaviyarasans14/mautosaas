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
                $leadtable = DBINFO::$SIGNUP_DBNAME.".leads";
                $sql = "select user_name,action,date_added from ".$appdbname.".audit_log where  user_name not like 'Sadmin LeadsEngage' order by date_added desc limit 1";
                $result = getResultArray($con, $sql);
                $dateandtime="";
                $dateadded='';
                if(sizeof($result) > 0 ){
                    $dateadded=$result[0][2];
                }
                $sql="select lead_stage from  ".$leadtable." where email='$email' and domain='$domain'";
                $result = getResultArray($con, $sql);
                if(sizeof($result) > 0 ){
                    $leadstage = $result[0][0];
                }
                $sql="select planname from  ".$appdbname.".paymenthistory where paymentstatus='Paid' order by createdOn desc limit 1";
                $result = getResultArray($con, $sql);
                $plantype="";
                if(sizeof($result) > 0 ){
                    $plantype=$result[0][0];
                    $leadstage= 'Paid- Active';
                }
                $sql = "select companyname,city,state,country from ".$appdbname.".billinginfo";
                $accountdetails = getResultArray($con, $sql);
                $companyname='';
                $city='';
                $state='';
                $country='';
                if(sizeof($accountdetails) > 0 ){
                    $companyname=$accountdetails[0][0];
                    $city=$accountdetails[0][1];
                    $state=$accountdetails[0][2];
                    $country=$accountdetails[0][3];
                }
                $sql = "select first_name,last_name from ".$appdbname.".users where email='$email'";
                $userinfo = getResultArray($con, $sql);
                $firstname='';
                $lastname='';
                if(sizeof($userinfo) > 0 ){
                    $firstname = $userinfo[0][0];
                    $lastname  = $userinfo[0][1];
                }
                $sql = "select website,timezone,phonenumber from ".$appdbname.".accountinfo";
                $userresult = getResultArray($con, $sql);
                $website='';
                $timezone='';
                $mobilenumber='';
                if(sizeof($userresult) > 0 ){
                    $website = $userresult[0][0];
                    $timezone  = $userresult[0][1];
                    $mobilenumber  = $userresult[0][2];
                }
                $last15dayscontactcreated = getLast15DaysContactsCreated($con,$appid);
                $last15daysmailsent=getLast15DaysEmailSent($con,$appid);
                $sql = "select * FROM ".$appdbname.".licenseinfo";
                $licenseinfo = getResultArray($con, $sql);
                $licensedbs = sizeof($licenseinfo);
                $actualrecordcount = $licenseinfo[0][2];
                $dateadded   =  empty($dateadded) ? "NULL" :"'".$dateadded."'";
                $currentdate =  date('Y-m-d H:i:s');
                $sql="update $leadtable set app_id='$appid',domain='$domain',plan_type='$plantype',contact_used='$actualrecordcount',last_15_days_contact_crea='$last15dayscontactcreated',last_15_days_email_send='$last15daysmailsent',last_activity_in_app=$dateadded,timezone1='$timezone',website1='$website',lead_stage='$leadstage',mobile='$mobilenumber',company_new='$companyname',date_modified='$currentdate',city='$city',state='$state',country='$country',firstname='$firstname',lastname='$lastname' where email='$email' and domain='$domain'";
                execSQL($con, $sql);
                displaySynclog("Updated:SuccessFully".$sql);
            }
        }
    }

    commitTransaction($con);

} catch(Exception $ex) {
    $msg = $ex -> getMessage();
    echo "<br><br>" . "Error:" . $msg;
}

function getLast15DaysEmailSent ($con, $appid){
    $appusage = array();
    $appdbname = DBINFO::$APPDBNAME . $appid;
    $sql = "select count(*) from  " . $appdbname . ".email_stats WHERE date_sent >= DATE(NOW()) + INTERVAL -15 DAY";
    $result = getResultArray($con, $sql);
    if (sizeof($result) > 0) {
        $last15daysmailsent = $result[0][0];
    }
    return $last15daysmailsent;

}

function getLast15DaysContactsCreated ($con, $appid){
    $appusage = array();
    $appdbname = DBINFO::$APPDBNAME . $appid;
    $sql = "select count(*) from  " . $appdbname . ".leads WHERE date_added >= DATE(NOW()) + INTERVAL -15 DAY";
    $result = getResultArray($con, $sql);
    if (sizeof($result) > 0) {
        $last15dayscontactcreated = $result[0][0];
    }
    return $last15dayscontactcreated;

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

        $sql = "show fields from $leadstable where field='app_id';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:app_id missing in $leadstable table.Please check.");
            return false;
        }
        $sql = "show fields from $leadstable where field='domain';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:domain missing in $leadstable table.Please check.");
            return false;
        }

        $sql = "show fields from $leadstable where field='plan_type';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:plan_type missing in $leadstable table.Please check.");
            return false;
        }
        $sql = "show fields from $leadstable where field='contact_used';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:contact_used missing in $leadstable table.Please check.");
            return false;
        }
        $sql = "show fields from $leadstable where field='last_15_days_contact_crea';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:last_15_days_contact_crea missing in $leadstable table.Please check.");
            return false;
        }
        $sql = "show fields from $leadstable where field='last_15_days_email_send';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:last_15_days_email_send missing in $leadstable table.Please check.");
            return false;
        }

        $sql = "show fields from $leadstable where field='last_activity_in_app';";
        $checklist = getResultArray($dbcon, $sql);
        if (sizeof($checklist) == 0) {
            displaySynclog("Column:last_activity_in_app missing in $leadstable table.Please check.");
            return false;
        }
        return true;
    } else {
        displaySynclog("LeadsEngage Connection Not Established");
        return false;
    }
}

?>
