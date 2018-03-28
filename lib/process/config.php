<?php

class DBINFO {

	public static $HOSTNAME = 'localhost';
	public static $APPDBNAME = 'leadsengage_base';
	public static $COMMONDBNAME = 'leadsengage_base';
	public static $DBNAME = 'dacamsys_hrms';
	public static $DBUSER = 'root';
	public static $DBPWD = 'dacam';
	public static $DBTYPE = 'mysql';
	public static $IS_AWS_SERVER = FALSE;
	public static $PORT = '3306';
	public static $LICENSEAPPID = 'cops';
	public static $SIGNUP_DBNAME = 'leadsengage_signup';
	public static $SIGNUP_SEGMENTNAME = 'signupcontacts';
	public static $DEFAULT_CREATEDBY_ID = '17';
	public static $DEFAULT_CREATEDBY_NAME = 'Kaviarasan S';
	public static $DEFAULT_EDITIONINDEX = '2';
	public static $DEFAULT_EMAILID = '1';
	public static $SIGNUP_URL = "http://dacam.localhost/mauto/index.php";
	public static $ACTIONVATION_LINK = "http://localhost/mautosaas/lib/activation.php";

}

class FACEBOOKINFO{
	public static $APPID = "322716221472864";
	public static $APPSECRET = "013f0271f91dfcffeac9e4d754aadd80";	
}
class LOGINFO {

	// public static $LOG_APPID = "All"; //Options = All (for All Application) // For Cpanel = "cpanel" // For Appid specific ex : "1_2_3,1_2_4" (User Comma as separator);
	public static $ISLOGENABLED = false;
	public static $ISSQLLOGENABLED = false;
	public static $ISSYNCLOGENABLED = false;
	public static $ISCRONLOGENABLED = false;
	public static $DEFAULT_FILE_SIZE = 25;
	//In MB

}

class MOBILE_SETTINGS {

	public static $IS_HYBRID = true;
	public static $ACTIVATION_LINK = "http://www.cratio.com/mobile-activation/";
	public static $FSM_VERSION = 19;
	public static $FSM_VERSION_MESSAGE = "";
	public static $FORCE_UPDATE_FSM_VERSION = false;
	public static $CRM_VERSION = 3;
	public static $CRM_VERSION_MESSAGE = "";
	public static $FORCE_UPDATE_CRM_VERSION = false;
	public static $MOBILE_SAAS_URL = "apps.cratio.com";
	public static $MOBILE_HOSTED_APPID = "";
	public static $MOBILE_NOTIFICATION_MESSAGE = "Mobile App is not used for last three days!";
	public static $MOBILE_NOTIFICATION_SUBJECT = "App not used!";
}

class GeneralSettings {

	public static $EXPORT_MAX_REC_SIZE = '2000';
	public static $TIMEZONE_SUPPORT = true;
	public static $APPIDFORDISABLETIMEZONE = '1_1_89';
	public static $LOADUNITAPPID = 'rl';
	public static $IS_HEADER_NEEDED = true;
	public static $DINAMALARAPPID = '';
	public static $FIELDNAME = 'Status';
	public static $FIELDVALUE = 'Closed';
	public static $REFERENCE_COLUMN_WIDTH = '200';
	public static $APPLICATION_MAIL_BOX = 'mailbox.cratiocrm.com';
	public static $CONNECTOR_LEAD_FORM="table_236";
}
class GlobalEmailConfig {
	public static $ISNEED_SYSTEM_BASED_EMAIL_Report = false;
}

class APIREQUESTCONSTANT {

	public static $API_REQUEST_TYPE_XML = 'xml';
	public static $API_REQUEST_TYPE_JSON = 'json';
	public static $API_DAILY_ACCESS_LIMIT = 250;
	//provide client public ip here to allow api access
	public static $IP_FILTER = array();
}

class SessionDetails {

	public static $SESSION_TIME_OUT_PERIOD = 6000;
	//in seconds
	public static $SYNC_TIME_OUT_PERIOD = 15;
	//in seconds

}

class ServerDetail {

	public static $SERVER_PATH = "/var/www";
	//Host Path
	public static $SERVER_URL = "http://apps.cratio.com";
	//Host URL

}

class MONITOR {

	public static $MAX_RESPONCE_TIME = "30";
	//In Seconds
	public static $MAX_RECORD_COUNT = "10000";
	// Table Record Count
	public static $NEED_MONITRING = TRUE;
	// TRUE OR FALSE

}

class DAILYREPORTS {
	public static $REPORTNAMES = "Attendance Report,Task Summary,Task Details";
	public static $TIMECONDITION = "Daily.-1,02:00";
	public static $NEED_DAILYREPORT = TRUE;

}

function getDBUser() {
	if (DBINFO::$IS_AWS_SERVER) {
		$username = encryptor("decrypt", "EWqDrRhg1qiCAtV/L0cf7g==");
	} else {
		$username = DBINFO::$DBUSER;
	}

	return $username;
}

function getDBPass() {
	if (DBINFO::$IS_AWS_SERVER) {
		$password = encryptor("decrypt", "qK8YAnIJSqdKPg3/P69SXw==");
	} else {
		$password = DBINFO::$DBPWD;
	}

	return $password;
}

function getDBHost() {
	if (DBINFO::$IS_AWS_SERVER) {
		$hostname = encryptor("decrypt", "zQ1EVh+AzmsOkDdcXZLe21A7yCdwawLoGzhK/R7yenYFx9fWs+1H4BExlWUkczfHImfovMCoOZ9jJjnzPKs1TI2EUOEGn9RBPQIovFUov5g=");
	} else {
		$hostname = DBINFO::$HOSTNAME;
		if(strpos($hostname,"amazonaws") > 0){
		$hostname = gethostbyname($hostname);	
		}
	}

	return $hostname;
}
?>
