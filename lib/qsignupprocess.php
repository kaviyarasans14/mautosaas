<?php
//ini_set ( "display_errors", "1" );
//error_reporting ( E_ALL );
include("process/config.php");
include("process/field.php");
include("util.php");
include("process/createElasticEmailSubAccount.php");

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
	if($_REQUEST['checkavailability']){
	$domain=$_REQUEST['checkavailability'];
	$isavailable=checkDomainAvailability($con,$domain);
	if($isavailable){
       die("domainnotexists");
	}else{
	die("domainexist");
	}
	}else{
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
		displaysignuplog("Company:$companyname");
		displaysignuplog("User Name:$fromname");
		displaysignuplog("User Mail:$frommail");
		displaysignuplog("Domain:$domain");
		$response=createSaasDatabase($con);
		if(isset($response['dbname'])){
		$dbname=$response['dbname'];
		$appid=$response['appid'];
		$sql="insert into applicationlist(appid,domain,company,username,usermail,usermobile) values('$appid','$domain','$companyname','$fromname','$frommail','$usermobile');";
		displaysignuplog("SQL:".$sql);
		$result = execSQL ( $con, $sql );
		displaysignuplog("DB Name:".$dbname);
		$elasticuser="";
		$elasticpwd="";
		if(strpos(MAUTIC_DOMAIN, "leadsengage.com") !== false || strpos(MAUTIC_DOMAIN, "cratio.in") !== false){
            $status=createSubAccount("$domain@leadsengage.com","LeadsEngage@44#");
            if($status[1] == ""){
                $elasticuser="$domain@leadsengage.com";
                $elasticpwd=$status[0];
                $isupdated=updateHTTPNotification($status[0], "http://$domain.".MAUTIC_DOMAIN."/mailer/elasticemail/callback");
                if(!$isupdated){
                    $response['alert']="HTTP Notification not enabled!Do Manually.";
                }
                $isupdated=updateAccountProfile($status[0]);
                if(!$isupdated){
                	if($response['alert'] != ""){
                        $response['alert'].="Sub Account Profile Not Updated.Do Manually.";
					}else{
                        $response['alert']="Sub Account Profile Not Updated.Do Manually.";
					}
                }
            }else{
                $response['alert']="Elastic Sub Account Creation Failed:".$status[1];
            }
		}

		createMauticConfigFile($domain,$dbname,$fromname,$frommail,$elasticuser,$elasticpwd);
		createMauticFirstUser($con,$dbname,$frommail,$firstname,$lastname,$pwd);


		$url="http://$domain.".MAUTIC_DOMAIN."/index.php";
		$url ='../qsignup.php?message=success&url='.$url;
		if(isset($response['alert'])){
            $url.="&notify=".$response['alert'];
		}
		header ( 'Location:' . $url );
		}else if(isset($response['error'])){
			$url ='qsignup.php?message=' .$response['error'];
			header ( 'Location:' . $url );
		}
	}
	commitTransaction($con);
}catch(Exception $ex){
rollbackTransaction($con);
$msg = $ex->getMessage ();
displaysignuplog("Exception Occur:".$msg);
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
function checkDomainAvailability($con,$domain){
$sql="select appid from applicationlist where domain='$domain';";
$dbrow = getResultArray ( $con, $sql );
return sizeof($dbrow) == 0;
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
function createSaasDatabase($con) {
	$response=array();
	$sql = 'select min(appid) from freeappidtable where schemastatus = ' . '\'' . 'Created' . '\'';
	$resultrow = getResultArray ( $con, $sql );
	$appid = $resultrow [0] [0];
	if($appid != ""){
	$response['appid']=$appid;
	$response['dbname']= DBINFO::$APPDBNAME . $appid;
	}else{
		createFreeAppIDS ($con);
		$sql = "select min(appid) from freeappidtable where schemastatus != 'Created'";
		$resultrow = getResultArray ( $con, $sql );
		$appid = $resultrow [0] [0];
		$sourcedbname = DBINFO::$APPDBNAME ."base";
		$destdbname = DBINFO::$APPDBNAME . $appid;
		$sql = "show databases like '$sourcedbname';";
		$resultrows = getResultArray ( $con, $sql );
		if (sizeof ( $resultrows ) > 0) {
			$sql = 'create database ' . $destdbname;
			$result = execSQL ( $con, $sql );
			$username = getDBUser ();
			$hostname = getDBHost ();
			$pwd = getDBPass ();
			$sql = "mysqldump -h $hostname -u $username -p$pwd  -P " . DBINFO::$PORT . " $sourcedbname | mysql -h $hostname -u $username -p$pwd -P" . DBINFO::$PORT . " $destdbname;";
			displaysignuplog("Dump Command:".$sql);
			exec ( $sql );
			$sql="delete from freeappidtable where appid='$appid ';";
			displaysignuplog("SQL:".$sql);
			$result = execSQL ( $con, $sql );
			$response['appid']=$appid;
			$response['dbname']= DBINFO::$APPDBNAME . $appid;
		}else{
		$response['error']='Product DB not exist,Please Configure';
		}
	}
	return $response;
}

function createMauticConfigFile($domain,$dbname,$fromname,$frommail,$elastic_user,$elastic_pwd){
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
		\'mailer_transport\' => \'mautic.transport.elasticemail\',
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
	\'email_frequency_number\' => 3,
\'email_frequency_time\' => \'DAY\',
\'mailer_is_owner\' => 0,
	);
	?>';
	$configpath=MAUTIC_ROOT_DIR."/app/config/".$domain;
	if (! is_dir ( $configpath )) {
		$old = umask ( 0 );
		mkdir ( $configpath, 0777 );
		umask ( $old );
	}
	if (is_dir ( $configpath )) {
	    $filepath=$configpath."/local.php";
		displaysignuplog("File Path:".$filepath);
		file_put_contents($filepath,$parameters);
	}
	return;
}
?>
