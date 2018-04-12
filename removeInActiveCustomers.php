<?php

session_start();

ini_set('display_errors', '1');
error_reporting(E_ALL);

include 'lib/process/config.php';
include 'lib/process/field.php';
include 'lib/util.php';

function displayCleanUpDBlog($msg) {
    $logdir="log/";
    if (!is_dir($logdir)) {
        $old = umask(0);
        mkdir($logdir, 0777, true);
        umask($old);
    }
    $logfile = "$logdir/cleanup.log";
    $baseurl = "localhost";
    $remoteaddr = "localhost";
    if (isset($_SERVER['REQUEST_URI'])) {
        $baseurl = $_SERVER['REQUEST_URI'];
        $remoteaddr = $_SERVER['REMOTE_ADDR'];
    }
    $logfilesize = getLogFileSize($logfile);
    if ($logfilesize > LOGINFO::$DEFAULT_FILE_SIZE) {
        $filepath = $logfile;
        createLogZipfile($logdir, "cleanup.log");
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
    $sql                   = 'select date_added,email,domain FROM '.DBINFO::$SIGNUP_DBNAME.'.leads';
    $applist               = getResultArray($con, $sql);
    $numdbs                = sizeof($applist);
    $currenttime           = date('Y-m-d H:i:s');
    $lastupdateddateandtime='';

    for ($i = 0; $i < $numdbs; $i++) {
        $dateadded = $applist[$i][0];
        $email     = $applist[$i][1];
        $domain    = $applist[$i][2];
   
     if($dateadded !='' && $email !='' && $domain !='' ) {
        $updateddate=getConvertedDateTimeByTZ($dateadded,false);
        $hourdiff   = round((strtotime($currenttime) - strtotime($updateddate)) / 3600, 1);
            if ($domain != '') {
                $sql       ='select f5 from '.DBINFO::$DBNAME.".applicationlist  where f5='$domain'";
                $domainlist = getResultArray($con, $sql);
                $domainlistsize    = sizeof($domainlist);
				
			    if ($domainlistsize === 0 && $hourdiff > 48) {
                      $sql='delete from '.DBINFO::$SIGNUP_DBNAME.".leads where email ='$email'";
                      execSQL($con, $sql);
					  displayCleanUpDBlog('Datas Successfully Cleaned Up');
                } else {
                	displayCleanUpDBlog('No Datas For Cleaned Up');
                }
            }
        }
    }
    commitTransaction($con);
} catch (Exception $ex) {
    $msg = $ex->getMessage();
    echo '<br><br>'.'Error:'.$msg;
}
