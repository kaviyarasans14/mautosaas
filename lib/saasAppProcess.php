<?php

include("process/config.php");
include("process/field.php");
include("util.php");

function displaylog($msg) {
    $logdir="../log/";
	$logfile = "$logdir/saasAppLog.log";
    $baseurl = "localhost";
    $remoteaddr = "localhost";
    if (isset($_SERVER['REQUEST_URI'])) {
        $baseurl = $_SERVER['REQUEST_URI'];
        $remoteaddr = $_SERVER['REMOTE_ADDR'];
    }
    date_default_timezone_set('Asia/Calcutta');
    $currenttime = date("Y-m-d H:i:s");
    error_log($remoteaddr . " : " . $currenttime . " : $msg\n", 3, $logfile);
}

date_default_timezone_set('Asia/Calcutta');
$pdoconn = new PDOConnection("");
$con = $pdoconn->getConnection();
createFreeAppIDS($con);
createSAASDatabase($con);

function createSAASDatabase($con){
	$ssql = "select appid from freeappidtable where schemastatus = 'Created'";
	$row = getResultArray ( $con, $ssql );
	$limit = '3';
	if(sizeof($row) == '3'){
		die('Already 3 Database Created');
	} else if (sizeof($row) == '2'){
		$limit = '1';
	} else if (sizeof($row) == '1'){
		$limit = '2';
	}
	$sql = "select appid from freeappidtable where schemastatus != 'Created' order by appid asc limit $limit";
    $resultrow = getResultArray ( $con, $sql );
    $sourcedbname = DBINFO::$APPDBNAME ."base";
    $sql = "show databases like '$sourcedbname';";
    $resultrows = getResultArray ( $con, $sql );
    if (sizeof ( $resultrows ) > 0) {
     	for($i = 0; $i < sizeof($resultrow); $i++){
       		$appid = $resultrow [$i] [0];
           	$destdbname = DBINFO::$APPDBNAME . $appid;
       		$sql = 'create database ' . $destdbname;
           	$result = execSQL ( $con, $sql );
           	$username = getDBUser ();
           	$hostname = getDBHost ();
           	$pwd = getDBPass ();
           	$sql = "mysqldump -h $hostname -u $username -p$pwd  -P " . DBINFO::$PORT . " $sourcedbname | mysql -h $hostname -u $username -p$pwd -P" . DBINFO::$PORT . " $destdbname;";
           	displaylog("Dump Command:".$sql);
           	exec ( $sql );
           	$sql="update freeappidtable set schemastatus = 'Created' where appid='$appid ';";
           	displaylog("SQL:".$sql);
           	$result = execSQL ( $con, $sql );
           	$response['appid']=$appid;
           	$response['dbname']= DBINFO::$APPDBNAME . $appid;
		}
    } else{
        $response['error']='Product DB not exist,Please Configure';
    }
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
            displaylog("SQL:".$sql);
            $result = execSQL ( $con, $sql );
        }
    }
    return;
}

?>

