<?php
class PREDEFINED_ENUMS {
	public static $MONTHS = array (
			'Jan',
			'Feb',
			'Mar',
			'Apr',
			'May',
			'Jun',
			'Jul',
			'Aug',
			'Sep',
			'Oct',
			'Nov',
			'Dec' 
	);
	public static $WEEKS = array (
			'Week 1',
			'Week 2',
			'Week 3',
			'Week 4',
			'Week 5' 
	);
}
class DinamalarReportDetails {
	public static $DINAMALAR_APPID = "";
	public static $IS_DINAMALAR_APP = false;
	public static $PRODUCTION_DETAILS_REPORT = "Production Details";
	public static $CLEANING_DETAILS_REPORT = "Cleaning Details";
	public static $PRODUCTION_FORMNAME = "table_201";
	public static $BREAKDOWN_FORMNAME = "table_210";
	public static $SIMULATION_FORMNAME = "table_227";
	public static $UNIT_DETAILS_FORMNAME = "table_204";
	public static $CLEANING_DETAILS_FORMNAME = "table_230";
	public static $UNIT_DETAILS_REFERENCE = "table_201_0_table_201_id";
	// Headers
	public static $DESCRIPTION_HEADER = "Description";
	public static $CURRENT_YEAR_HEADER = "Current Year";
	public static $PREVIOUS_YEAR_HEADER = "Previous Year";
	public static $DETAILS_HEADER = "Details";
	public static $UNITS_HEADER = "Units";
	public static $DATE_HEADER = "Date";
	public static $COUNT_HEADER = "Count";
	public static $SEGMENTS_HEADER = "Segments";
	public static $ROW_HEADER = "Row";
	// Columns
	public static $TODAY_PRODUCTION = "Today Production";
	public static $AS_ON_DATE_PRODUCTION = "As On Date Production";
	public static $AVG_UNITS = "Avg Units Per Day";
	public static $SIMULATION = "Simulation on ";
	public static $BREAK_DOWN_HOURS = "Breakdown Hours";
	public static $AUX_CONSUMPTION_UNITS = "Aux Consumption Units";
	public static $AS_ON_DATE_AUX_CONSUMPTION_UNITS = "As On Date Aux Consumption Units";
	public static $LAST_YEAR_SAME_DAY_SINGLE_HOUR_PRODCTION = "Last Year Same Day Highest Single Hour Production";
	public static $TODAY_FIRST_HOUR_PRODUCTION = "Today's First Hour Production";
	public static $TODAY_LAST_HOUR_PRODUCTION = "Today's Last Hour Production";
	public static $HIGHEST_SINGLE_DAY_PRODUCTION = "Highest Single Day Production";
	public static $HIGHEST_SINGLE_HOUR_PRODUCTION = "Highest Single Hour Production";
	public static $HIGHEST_FIRST_HOUR_PRODUCTION = "Highest First Hour Production";
	public static $HIGHEST_LAST_HOUR_PRODUCTION = "Highest Last Hour Production";
	public static $NO_OF_SEGMENTS_CLEANED = "Total Count Of Cleaned Segments";
	// Fields
	public static $UNIT_DETAILS_IS_LAST_BILLING = "is_Last_Billing";
	public static $UNIT_DETAILS_PRODUCTION_REFERENCE = "table_201_0_table_201_id";
	public static $UNIT_DETAILS_INVOICE_REFERENCE = "table_216_0_table_216_id";
}
class UsageReportDetails {
	public static $REPORTNAME = "Crm Usage Details";
	public static $REPORT_FORMNAME = "table_49";
	public static $HEADER_USERNAME = "User Name";
	public static $HEADER_TOTAL_RECORDS = "Total Records";
	public static $HEADER_FORMWISE_COUNT = "Forms Wise Count";
	public static $HEADER_LAST_USAGE_DETAILS = "Last Usage detail";
}
class SystemReports {
	public static $ATTANDANCE_REPORT = "Attendance Report";
	public static $TASK_SUMMARY = "Task Summary";
	public static $TASK_DETAILED = "Task Details";
	public static $TASK_SUMMARY_CUSTOMER_WISE = "Customer Wise Task Detail";
	public static $TASKSUMMARY_FORMNAME = "table_52";
	public static $TASKSUMMARY_USERNAME = "Staff";
	public static $TASKSUMMARY_COMPLETED = "Completed Task";
	public static $TASKSUMMARY_ACTUALHOURSE = "Actual Hrs";
	public static $TASKSUMMARY_PLANEDHOURSE = "Planned Hrs";
	public static $PAYROLLREPORT = "Payroll Report";
}
class MasterFormConfiguration {
	public static $NEED_ALL_RECORDS = true;
}
class NativeCustomers {
	public static $NATIVE_CUSTOMERS_IDS = array (
			'2_2_40',
			'1_2_72',
			'1_1_55',
			'1_1_7' 
	);
	
	// MVGL - 2_2_40 >Marpol- 1_2_72 >Gesco- 1_1_55 >Newtronics 1_1_7
}
class GetAllSQlFormat {
	public static $REFERENCE_TABLE_INDEX = 0;
	public static $CONDITION_STMT_INDEX = 1;
	public static $QRY_STMT_INDEX = 2;
	public static $QRY_FROM_INDEX = 3;
	public static $JOINCLAUSE_INDEX = 4;
	public static $LEGACY_DETAIL_INDEX = 5;
}
class HI_FILTER {
	public static $IMD_SUPERIERS = '1';
	public static $ALL_SUPERIERS = '2';
	public static $IMD_SUBBORDINATES = '3';
	public static $ALL_SUBBORDINATES = '4';
	public static $PEERS = '5';
}
class VERSIONINFO {
	public static $MOBILE_FC_LATESTCHANGES = '1.No Recent Changes Made in Server!';
	public static $MOBILE_CRM_LATESTCHANGES = '1.No Recent Changes Made in Server!';
	public static $MOBILE_RECRM_LATESTCHANGES = '1.No Recent Changes Made in Server!';
	public static $MOBILE_LOG_LATESTCHANGES = '1.No Recent Changes Made in Server!';
	public static $MOBILE_INT_LATESTCHANGES = '1.No Recent Changes Made in Server!';
	public static $MOBILE_FC_FORCE = 'false';
	public static $MOBILE_CRM_FORCE = 'false';
	public static $MOBILE_RECRM_FORCE = 'false';
	public static $MOBILE_LOG_FORCE = 'false';
	public static $MOBILE_INT_FORCE = 'false';
}
class DEFAULT_MAPPING {
	public static $DEFAULT = "default";
}
class COMMONCONSTANTS {
	public static $BUILDER_ID = 'builderid';
	public static $UNLIMITED_STRING = 'UL';
	public static $UNLIMITED_DAYS = '7300';
	public static $SYSDATE_STRING = "SYSDATE";
	public static $SYSDATE_TIME_STRING = "SYSDATETIME";
}
class GCM_NOTIFICATION_DETAILS {
	public static $PROJECT_NO = "699732097412";
	public static $IOS_API = "AAAA4IOcvv8:APA91bFLrXHHGJqk4oXPZl9DxQ6wWmYK_-aC8KmSvcQAJFZvzftuo04_Bm1BIYUd6BCHDh5h3-z2zEQnLrgP6-UATjWjzu7rphnw_6rTEvQIIIcmV8OSJENJFoNzWbj9A6jYlbsBGXKc";
	public static $ANDROID_API = "AAAAO6nY4Ek:APA91bHy6xdMw0Y2NamJPXQXMFLFSIZcUTj5IAj_4bCBLMpledg9BPvWyHdQWudVQ9ivVZ42D-XTKtLuhrcJxIwcRzr_NEuBEydiXm-0U2xN8sjmj5iX0W400h3I-G5w_rV6XPF0yRVO";
}
class S3_VALUES {
	public static $APPS_BUCKETNAME = 'apps.cratiocrm.com';
	public static $HOSTED_BUCKETNAME = 'cratiocrm.hosted';
	public static $QC_BUCKETNAME = 'qc.cratiocrm.com';
	public static $I_BUCKETNAME = 'cops.cratiocrm.com';
	public static $APPS_GETSALES_BUCKETNAME = 'apps.getsales.co';
	public static $APPS_LEADSROLL_BUCKETNAME = 'apps.leadsroll.com';
	public static $S3BASEURL_OLD = 'https://s3.amazonaws.com/';
	public static $S3BASEURL = "https://s3.ap-south-1.amazonaws.com/";
}
class OPENID {
	public static $LOGINID_USINGOPENID = 1;
	public static $LOGINID_USINGUSERID = 0;
}
class SAASDETAILS {
	public static $USERNAME = 0;
	public static $APPID = 2;
	public static $NUMBEROFFREEDB = 20;
	public static $NEEDSIGNUPMAILTODAP = false;
}
class APPINFO {
	public static $SUPPORT_MAIL_ID = 'support@cratio.com';
	public static $SALES_MAIL_ID = 'sales@cratio.com';
	public static $ACTIVATION_MAIL_ID = 'suresh@cratio.com';
	public static $ACTIVATION_USER_NAME = 'Suresh Shamalan';
	public static $ISSAAS = false;
	public static $IS_BUILDER_APP = false;	
	public static $CUSTOM_LOGOUT_URL = array(
    "appid1" => "http://url1",
    "appid2" => "http://url2");
	public static $CUSTOM_MOBILE_APP_URL = array(
    "appid1" => "Labelname,PlayStoreURL",
    "appid2" => "Labelname,PlayStoreURL");
	public static $LOGIN_URL = "http://www.cratiocrm.com/login";
	public static $PLAYSTORE_LINK = "https://play.google.com/store/apps/details?id=com.cratio.salescrm.lite";
}
class CHECKBOXVALUES {
	public static $ENABLED = 'Yes';
	public static $DISABLED = 'No';
}
class THIRDPARTYDBINFO {
	public static $HOSTNAME = 'localhost';
	public static $DBNAME = 'thani';
	public static $DBUSER = 'sa';
	public static $DBPWD = 'dacam';
	public static $DBTYPE = 'mssql';
}
class UserFieldNames {
	public static $PROFILE_ID_NAME = 'table_2_0_table_2_id';
	public static $ROLE_ID_NAME = 'table_4_0_table_4_id';
}
class SAASAccountType {
	public static $PROSPECT = 'Prospect';
	public static $CUSTOMER = 'Customer';
}
class SAASConfig {
	public static $SAAS_INDEX_FILE = 'saas.html';
}
class ForecastingInfo {
	public static $SCREEN_PROPERTY_FORECASTING_POTMODULENAME = 'potentialmodulename';
	public static $SCREEN_PROPERTY_FORECASTING_POTNAME = 'potentialname';
	public static $SCREEN_PROPERTY_FORECASTING_STAGEFIELD = 'stagefield';
	public static $SCREEN_PROPERTY_FORECASTING_EXPCLOSEDATE = 'expclosedatefield';
	public static $SCREEN_PROPERTY_FORECASTING_TYPE = 'forecastingtype';
	public static $SCREEN_PROPERTY_FORECASTING_CATEGORY = 'forcastingcatgory';
	public static $SCREEN_PROPERTY_FORECASTING_POT_AMOUNT = 'potantialamont';
	public static $OPERATION_SAVE_FORECASTING = 'SAVE_FORECASTING_INFO';
	public static $OPERATION_GET_ALL_FORECASTING_HISTORY = 'GET_ALL_FORECASTING_HISTORY';
	public static $OPERATION_SAVE_FORECASTING_HISTORY = 'SAVE_FORECASTING_HISTORY_INFO';
	public static $OPERATION_GET_ALL_FORCASTING = 'OPERATION_GET_ALL_FORCASTING';
	public static $OPERATION_DELETEL_FORCASTING = 'DELETE_FORECASTING_HISTORY';
}
class ServerError {
	public static $ALREADY_EXISTS_ERROR = 'Already exists';
	public static $GENERAL_ERROR = 'Failed';
	public static $GENERAL_SUCCESS_MSG = '';
}
class Formfields {
	public static $FORMNAME = 'formname';
	private $_tablename = null;
	private $_columns = array ();
	public function __construct($tablename) {
		$_tablename = $tablename;
	}
	public function getTablename() {
		return $this->_tablename;
	}
	public function getColumns() {
		return $this->_columns;
	}
	public function addColumn($columnname) {
		$_columns [] = $_columnname;
	}
}
class APIOPERATIONTYPE {
	public static $GET_MY_RECORD = 'getMyRecords';
	public static $GET_ALL_RECORD = 'getAllRecords';
	public static $GET_RECORD_BYID = 'getRecordById';
	public static $GET_FIELDS = 'getFields';
	public static $GET_RECORD_BY_SEARCH = 'getRecordsBySearch';
	public static $GET_RECORD_BY_COLUMN = 'getRecordByColumn';
	public static $GET_RELATED_RECORD = 'getRelatedRecord';
	public static $INSERT_RECORDS = 'insertRecords';
	public static $UPDATE_RECORDS = 'updateRecords';
	public static $DELETE_RECORDS = 'deleteRecords';
	public static $DOWNLOAD_IMAGE = 'downloadImage';
	public static $TNALICENSELOGIN = 'tnalicenselogin';
}
class OPERATIONTYPE {
	public static $ENTITY = 'ENTITY';
	public static $KEY = 'OPERATION';
	public static $GETALL = 'GETALL';
	public static $GET = 'GET';
	public static $SEARCH = 'SEARCH';
	public static $LOGIN = 'LOGIN';
	public static $GETALLVALUE = 'GETALLFEATUREVALUE';
	public static $IS_BUILDER_REQ = 'Isbuilderreq';
	public static $NEW = 'NEW';
	public static $SAVE = 'SAVE';
	public static $EDIT = 'EDIT';
	public static $CHANGE = 'CHANGE';
	public static $DELETE = 'DELETE';
	public static $CLEANANDLAUNCH = 'CLEANANDLAUNCH';
	public static $CLEANANDCREATE = 'CLEANANDCREATE';
	public static $VERSIONUPDATE = 'VERSIONUPDATE';
	public static $DBBACKUP = 'DBBACKUP';
	public static $CLONE = 'CLONE';
	public static $SUBTABLEENTRYDELETE = 'SUBTABLEENTRYDELETE';
	public static $FIND = 'FIND';
	public static $TIMESELECTION = 'TIMESELECTION';
	public static $CUSTOM = 'CUSTOM';
	public static $MASSEDIT = 'MASSEDIT';
	public static $NEWLISTITEM = 'NEWLISTITEM';
	public static $CUSTOMACTIONNAME = 'customactionname';
	public static $FORMNAME = 'FORMNAME';
	public static $SEARCHFIELDS = 'SEARCHFIELDS';
	public static $ADV_SEARCHKEYS = 'advanced_search_key';
	public static $GETALL_HIERARCHDETAILS = 'GETALLHIERARCHY';
	public static $SAVEHIERACHYVALUE = 'SAVEHIERACHYVALUE';
	public static $UPDATEHIERACHYVALUE = 'UPDATEHIERACHYVALUE';
	public static $GETALLTREEENTITYDATA = 'GETALLTREEENTITYDATA';
	public static $DELETEHIERACHYVALUE = 'DELETEHIERACHYVALUE';
	public static $STRUCTURE_ENTITYNAME = 'STRUCTURE_ENTITYNAME';
	public static $MODULENAME = 'MODULENAME';
	public static $OMODULENAME = 'OMODULENAME';
	public static $FORM_INPUTFIELDS = 'FORM_INPUTFIELDS';
	public static $INPUTFORM_INPUTFIELDS = 'INPUTFORM_INPUTFIELDS';
	public static $SUBTABLE_INPUTFIELDS = 'SUBTABLE_INPUTFIELDS';
	public static $LINEITEM_INPUTFIELDS = 'LINEITEM_INPUTFIELDS';
	public static $SUBTABLELINK_INPUTFIELDS = 'SUBTABLELINK_INPUTFIELDS';
	public static $BASETABLE_INPUTFIELDS = 'BASETABLE_INPUTFIELDS';
	public static $GET_SUBTABLE_DATA = 'GET_SUBTABLE_DATA';
	public static $GET_HIERARCHY_STRUCTURE_FORMNAMES = 'GET_HIERARCHY_STRUCTURE_FORMNAMES';
	public static $ACTIONUPDATE = 'ACTIONUPDATE';
	public static $FIELDADD = 'FIELDADD';
	public static $FIELDUPDATE = 'FIELDUPDATE';
	public static $FIELDDELETE = 'FIELDDELETE';
	public static $FORMADD = 'FORMADD';
	public static $FORMUPDATE = 'FORMUPDATE';
	public static $FORMDELETE = 'FORMDELETE';
	public static $MODULEADD = 'MODULEADD';
	public static $MODULEUPDATE = 'MODULEUPDATE';
	public static $MODULEDELETE = 'MODULEDELETE';
	public static $MODULEORDER = 'MODULEORDER';
	public static $FORMMOVE = 'FORMMOVE';
	public static $MODULERENAME = 'MODULERENAME';
	public static $FORMRENAME = 'FORMRENAME';
	public static $FieldViewColChange = 'FieldViewColChange';
	public static $FieldColumnChange = 'FieldColumnChange';
	public static $FORM_FIELDSDETAIL = 'FORM_FIELDSDETAIL';
	public static $PAGENUMBER = 'PAGENUMBER';
	public static $NUMBEROFROW = 'NUMBEROFROW';
	public static $FORMTYPE = 'FORMTYPE';
	public static $LASTTEMPLATENAME = 'LASTSELECTEDTEMPLATE';
	public static $SendEmail = 'SendEmail';
	public static $SendSMS = 'SendSMS';
	public static $EmailFormAttachment = 'EmailFormAttachment';
	public static $PurchaseSMS = 'PurchaseSMS';
	public static $LOAD_REVISION_DIALOG = 'load Revision';
	public static $CHECK_REVISION = 'check revision';
	public static $LOAD_REVISION_RECORD = 'load Revision Record';
	public static $LOAD_RESIGN_CONFIG = 'load Resign';
	public static $REPLACE_USER = 'replace user';
	public static $REPLACE_PROFILE = 'replace profile';
	public static $SEND_EMAIL_DATA = 'Send Email Data';
	public static $SEND_EMAIL_TYPE = 'Send Email';
	public static $REMAINDER_DATA = 'Remainder Data';
	public static $GENERATE_API_KEY = 'GENERATE_API_KEY';
	public static $CONCURRENT_PROCESS_CONFIRMED = 'concurrent_process_confirmed';
	public static $SUB_USER_LIST = 'SUB_USER_LIST';
	public static $APPID_KEY = 'APPID';
	public static $IMPORT = 'IMPORT';
	public static $INSTANTCREATE = 'INSTANTCREATE';
	public static $GET_USER_AND_ROLE_DETAILS = 'GET_USER_AND_ROLE_DETAILS';
	public static $GET_USER_DETAILS = 'GET_USER_DETAILS';
	public static $COMPUTE_MOBILE_DB = 'COMPUTE_MOBILE_DB';
	public static $CONFIG_MOBILE_LOG = 'CONFIG_MOBILE_LOG';
	public static $GET_REPORTING_TO_USER = 'GET_REPORTING_TO_USER';
	public static $BACKUP_DATABASE = 'TAKE_BACKUP';
}
class Application {
	public static $WEBSITE_URL = 'www.cratio.com';
	public static $CREATED_TIME_INDEX = 0;
	public static $UPDATED_TIME_INDEX = 1;
	public static $CREATED_BY_INDEX = 2;
	public static $UPDATED_BY_INDEX = 3;
	public static $APPLICATION_NAME_INDEX = 4;
	public static $DESCRIPTION_INDEX = 5;
	public static $TITLE_INDEX = 6;
	public static $LAUNCH_NAME_INDEX = 7;
	public static $DB_MAJOR_VERSION_INDEX = 8;
	public static $DB_MINOR_VERSION_INDEX = 9;
	public static $FOOTER_URL_INDEX = 10;
	public static $POWERED_BY_INDEX = 11;
	public static $CLIEND_ID_INDEX = 12;
	public static $CU1_INDEX = 13;
	public static $CU2_INDEX = 14;
	public static $ISNEED_ROLE_BASED_REPORTING_TO = true;
	public static $GUI_DATE_FORMAT = 'd-M-y';
	public static $DB_DATE_FORMAT = 'YYYY-MM-DD';
	public static $IMPORT_DATE_FORMAT = 'd/m/Y';
	public static $IMPORT_DATE_TIME_FORMAT = 'd/m/Y H:i:s';
	public static $GUI_DATE_TIME_FORMAT = 'Y-M-d h:i A';
}
class OrgizationMaster {
	public static $ORG_MASTER_ORG_NAME_INDEX = 1;
	public static $ORG_MASTER_LOGO_INDEX = 2;
	public static $ORG_MASTER_ADDRESS_INDEX = 3;
	public static $ORG_MASTER_EMAILID_INDEX = 4;
	public static $ORG_MASTER_PHONE1_INDEX = 5;
	public static $ORG_MASTER_PHONE2_INDEX = 6;
	public static $ORG_MASTER_WEBSITE_INDEX = 7;
	public static $ORG_MASTER_FAX_INDEX = 8;
	public static $ORG_MASTER_FINALCIAL_YR_START_INDEX = 9;
	public static $ORG_MASTER_DEFAULT_CURRENCY_INDEX = 10;
	public static $ORG_MASTER_EMAIL_STATUS_INDEX = 11;
	public static $ORG_MASTER_SMS_STATUS_INDEX = 12;
	public static $ORG_MASTER_DATE_FORMAT_INDEX = 13;
	public static $ORG_MASTER_TIMEZONE_INDEX = 14;
	public static $ORG_MASTER_NO_OF_USER_INDEX = 15;
	public static $ORG_MASTER_REMAINING_USER_INDEX = 16;
	public static $ORG_MASTER_TOT_ACTIVE_INDEX = 17;
	public static $ORG_MASTER_TOT_REC_COUNT_INDEX = 18;
	public static $ORG_MASTER_TOT_STORAGE_SIZE_INDEX = 19;
	public static $ORG_MASTER_AUTO_TRACKING_INDEX = 34;
}
class EntityNames {
	public static $ROLE_ENTITY_NAME = 'table_4';
}
class SaasMetricTable {
	public static $TOTAL_RECORD_COUNT = 10000;
	public static $TOTAL_STORAGE_SIZE = 25;
}
class LICENSE {
	public static $NOOFEDITIONS = 3;
	public static $NOOFPROFILE = 3;
	public static $NOOFUSERS = 4;
	public static $DURATIONOFDAYS = 5;
	public static $TOTALRECORDCOUNT = 6;
	public static $TOTALSTORAGESIZE = 7;
	public static $GRACEPERIOD = 8;
	public static $GRAVEPERIOD = 9;
	public static $REPORT_SCHEDULAR = 14;
	public static $TOTAL_EMAIL_COUNT = 15;
	public static $TOTAL_SMS_COUNT = 16;
	public static $TOTAL_ATTACHMENT_SIZE = 17;
	public static $CLOUD_TELEPHONY = 18;
}
class FieldDetailIndex {
	public static $MODULE_NAME_INDEX = 0;
	public static $FORM_NAME_INDEX = 1;
	public static $FIELD_NAME_INDEX = 2;
	public static $FIELD_LABEL_INDEX = 3;
	public static $FIELD_TYPE_INDEX = 4;
	public static $FIELD_LENGTH_INDEX = 5;
	public static $FIELD_INSTRUCTION_INDEX = 6;
	public static $TOOLTIP_INDEX = 7;
	public static $LINK_NAME_INDEX = 8;
	public static $LINK_URL_INDEX = 9;
	public static $ISCONFIG_HIDE_INDEX = 10;
	public static $ISVIEW_HIDE_INDEX = 11;
	public static $VIEW_COLUMN_MIN_WIDTH_INDEX = 12;
	public static $VIEW_COLUMN_MAX_INDEX = 13;
	public static $VIEW_COLUMN_PREF_INDEX = 14;
	public static $ISGUI_INDEX = 15;
	public static $ISMANDATORY_INDEX = 16;
	public static $ENABLE_TYPE_INDEX = 17;
	public static $SEARCH_TYPE_INDEX = 18;
	public static $DEFAULT_VALUE_INDEX = 19;
	public static $DEFAULT_VISIBLE_INDEX = 20;
	public static $ISSYSTEM_FIELD_INDEX = 21;
	public static $FIELDORDER_INDEX = 22;
	public static $ISUNIQUE_INDEX = 23;
	public static $ISQUICK_CREATE_INDEX = 24;
	public static $ISMASS_EDIT_INDEX = 25;
	public static $ISSEARCH_INDEX = 26;
	public static $ISDISPLAY_INDEX = 27;
	public static $GROUP_NAME_INDEX = 28;
	public static $ISLABEL_DISPLAY_INDEX = 29;
	public static $ISVIEW_MANDATORY_INDEX = 30;
	public static $ISROLLING_UPDATE_INDEX = 31;
	public static $RELATION_ID_INDEX = 32;
}
class Remainder {
	public static $DAYS = 'Days';
	public static $MONTHS = 'Months';
	public static $WEEKS = 'Weeks';
	public static $HOURS = 'Hours';
	public static $MINS = 'Min';
	public static $BEFORE = 'Before';
	public static $AFTER = 'After';
	public static $CURRENT = 'Current';
	public static $SEND_AS_REMAINDER = 'Remainder';
	public static $SEND_AS_EMAIL = 'Email';
	public static $SEND_AS_SMS = 'SMS';
	public static $DB_UPDATE = 'DB Update';
	public static $REMAIND_ALL_USER = 'All User';
}
class CalendarType {
	public static $CALENDAR_DATE = 'calendardate';
	public static $CALENDAR_FIELD = 'calendarfield';
	public static $CALENDAR_TYPE = 'calendartype';
	public static $CALENDAR_USER = 'calendarfilterbyuser';
	public static $CALENDARTYPE_DAY = 0;
	public static $CALENDARTYPE_WEEK = 1;
	public static $CALENDARTYPE_MONTH = 2;
}
class ExportType {
	public static $EXPORT_WITH_SEARCH_RECORD = 'expwithserrec';
	public static $EXPORT_WITHOUT_SEARCH_RECORD = 'expwithoutsearchrec';
	public static $EXPORT_ALL_RECORD = 'expalldata';
	public static $EXPORT_CURRENT_PAGE = 'expcurpagedata';
	public static $EXPORT_SELECTED_RECORD = 'expselrec';
}
class FieldType {
	public static $FORM_ENTITYID = 'form_entityid';
	public static $TEXT = 'Text';
	public static $REFERENCE = 'reference';
	public static $REFERENCE_ENTITYID = 'reference_entityid';
	public static $HYPERLINK_FIELD = "Hyperlink";
	public static $SUBTABLE = 'subtable';
	public static $AUTO_PREFIX = 'auto_prefix';
	public static $AUTO_SUFFIX = 'auto_suffix';
	public static $DATE = 'date';
	public static $INT_FIELD = 'Int';
	public static $FLOAT_FIELD = 'Float';
	public static $ENTITY_GROUP = 'entity_group';
	public static $REFERENCE_GROUP_ENTITYID = 'reference_group_entityid';
	public static $REFERENCE_GROUP = 'reference_group';
	public static $COMBOBOX = 'ComboBox';
	public static $LISTFIELD = 'List';
	public static $FORM_HISTORY = 'form_history';
	public static $SUGGESSION_BOX = 'SuggestBox';
	public static $BASE_VIEW_FIELD = 'base_view_field';
	public static $DOCUMENT_FIELD = 'Document';
	public static $DOCUMENT_MULTI_FIELD = 'Document_multi';
	public static $DATE_TIME = 'Date_Time';
	public static $DATE_TIME_TEXT = 'Date_Time_Text';
	public static $TIME = 'Time';
	public static $TIME24 = 'Time(24Hr)';
	public static $OWN_REFERENCE = 'own_refrence';
	public static $CURRENCY = 'Currency';
	public static $IMAGE = 'Image';
	public static $HTMLTEXT = 'Html Text';
	public static $LOCATION = 'Location';
	public static $ADDRESS = 'Address';
	public static $PHOTO_CAPTURE = 'Photo Capture';
	public static $SIGNATURE_CAPTURE = 'Signature Capture';
	public static $BARCODE = 'Barcode';
	public static $PASSWORD = 'Password';
	public static $CHECKBOX = 'CheckBox';
	public static $EMAIL = 'Email';
	public static $REFERRED = 'Referred';
	public static $TEXT_AREA = 'Text Area';
	public static $MOBILE_NO = 'MobileNo';
	public static $OTG_CODE = 'OTG Code';
	public static $MULTI_COMBOBOX = 'MultiComboBox';
}
class FormType {
	public static $KEY = 'FORMTYPE';
	public static $GROUP = 'group';
	public static $CONFIG = 'config';
	public static $HIERARCHYSTRUCTURE = 'hierarchystructure';
	public static $HIERARCHYVALUE = 'hierarchyvalue';
	public static $HIERARCHYENTITY = 'hierarchyentity';
	public static $HIERARCHYSTRUCTRUEENTITY = 'HierarchyStructureEntity';
	public static $SUBTABLE = 'subtable';
	public static $REQUEST = 'request';
	public static $INPUT_FORM = 'inputform';
	public static $LEGACY = 'Legacy';
	public static $RECURRING = 'Recurring';
	public static $FORECASTING = 'forecasting';
}
class SubTableReqFormat {
	public static $TABLE_INFO = 0;
	public static $NEW_ROWDATA_INFO = 1;
	public static $UPDATED_ROWDATA_INFO = 2;
	public static $DELETED_ROWDATA_INFO = 3;
}
class ProcessKey {
	public static $FORMPROCESS = 'FORMPROCESS';
}
class BuilderKey {
	public static $TABLE_EXDENTION = '_frm';
	public static $UNCHANGED = 0;
	public static $CHANGED = 1;
	public static $NEW = 2;
	public static $DELETE = 3;
}
class ReferenceField {
	public static $MODULENAME_INDEX = 0;
	public static $FORMNAME_INDEX = 1;
	public static $FIELDNAME_INDEX = 2;
}
class UserTheme {
	public static $BLUE_THEME_COMFORT = 'style2.css';
	public static $SKY_BLUE_THEME_CONFIDENCE = 'bluetheme.css';
	public static $RED_THEME_PASSION = 'redtheme.css';
	public static $GREEN_THEME_GROWTH = 'greentheme.css';
	public static $PINK_THEME_UNCONDITIONAL = 'pinktheme.css';
	public static $SILVER_THEME_TREASURE = 'silvertheme.css';
}
class UserDetails {
	public static $SUPER_ADMIN_PROFILE_NAME = 'super admin profile';
	public static $DEFAULT_USER_THEME = 'style2.css';
}
class TableProperties {
	public static $SCREEN_PROPERTY_MODULENAME = 'modulename';
	public static $SCREEN_PROPERTY_FORMNAME = 'screenname';
	public static $SCREEN_PROPERTY_LABELNAME = 'labelname';
	public static $SCREEN_PROPERTY_OPERATIONTYPE = 'operationType';
	public static $SCREEN_PROPERTY_HASGROUP = 'hasgroup';
	public static $SCREEN_PROPERTY_GUIMODE = 'guimode';
	public static $SCREEN_PROPERTY_ISINMENU = 'isinmenu';
	public static $SCREEN_PROPERTY_IS_NEED_FOR_GLOBAL_SEARCH = 'isneedforglobalsearch';
	public static $SCREEN_PROPERTY_ISSUBTABLEALONE = 'issubtablealone';
	public static $SCREEN_PROPERTY_ISCALENDAR = 'iscalendar';
	public static $SCREEN_PROPERTY_IMAGE = 'image';
	public static $SCREEN_PROPERTY_LINKEDFORMS = 'linkedforms';
	public static $SCREEN_PROPERTY_NEWLINKEDFORMS = 'newlinkedforms';
	public static $SCREEN_PROPERTY_DELETEDLINKEDFORMS = 'deletedlinkedforms';
	public static $SCREEN_PROPERTY_STYLE = 'style';
	public static $SCREEN_PROPERTY_DBTYPE = 'dbtype';
	public static $SCREEN_PROPERTY_DBHOSTNAME = 'dbhostname';
	public static $SCREEN_PROPERTY_DBUSERNAME = 'dbusername';
	public static $SCREEN_PROPERTY_DBPASSWORD = 'dbpwd';
	public static $SCREEN_PROPERTY_DBNAME = 'dbname';
	public static $SCREEN_PROPERTY_DBTABLENAME = 'dbtablename';
	// PROPRETY ACTION KEYS
	public static $ACTION_PROPERTY_ACTIONNAME = 'actionname';
	public static $ACTION_PROPERTY_LABELNAME = 'label';
	public static $ACTION_PROPERTY_ACTIONITEMS = 'actionitems';
	public static $ACTION_PROPERTY_ISMANDATARY = 'actionmandatary';
	public static $ACTION_PROPERTY_ISNEWADDED = 'isnewadded';
	public static $ACTION_PROPERTY_ISMODIFIED = 'ismodified';
	public static $ACTION_PROPERTY_ISDELETED = 'isdeleted';
	public static $ACTION_PROPERTY_ORDER = 'actionorder';
	public static $ACTION_PROPERTY_ACTION_ICON = 'actionicon';
	public static $ACTION_PROPERTY_CUSTOM_ACTION_ICON = 'cusactionicon';
	// PROPRETY TRIGGER KEYS
	public static $TRIGGER_PROPERTY_ID = 'id';
	public static $TRIGGER_PROPERTY_NAME = 'name';
	public static $TRIGGER_PROPERTY_DESC = 'desc';
	public static $TRIGGER_PROPERTY_MODULENAME = 'modulename';
	public static $TRIGGER_PROPERTY_FORMNAME = 'formname';
	public static $TRIGGER_PROPERTY_FIELDNAME = 'fieldname';
	public static $TRIGGER_PROPERTY_INPUTMODULENAME = 'inputmodulename';
	public static $TRIGGER_PROPERTY_INPUTFORMNAME = 'inputformname';
	public static $TRIGGER_PROPERTY_ACTIONTYPE = 'actiontype';
	public static $TRIGGER_PROPERTY_EXPRESSION = 'expression';
	public static $TRIGGER_PROPERTY_ONCONDITION = 'oncondition';
	public static $TRIGGER_PROPERTY_FROMFLNAME = 'fromflname';
	public static $TRIGGER_PROPERTY_TOFLNAME = 'toflname';
	public static $TRIGGER_PROPERTYINDEX_ID = 0;
	public static $TRIGGER_PROPERTYINDEX_NAME = 1;
	public static $TRIGGER_PROPERTYINDEX_DESC = 2;
	public static $TRIGGER_PROPERTYINDEX_MODULENAME = 3;
	public static $TRIGGER_PROPERTYINDEX_FORMNAME = 4;
	public static $TRIGGER_PROPERTYINDEX_FIELDNAME = 5;
	public static $TRIGGER_PROPERTYINDEX_INPUTMODULENAME = 6;
	public static $TRIGGER_PROPERTYINDEX_INPUTFORMNAME = 7;
	public static $TRIGGER_PROPERTYINDEX_ACTIONTYPE = 8;
	public static $TRIGGER_PROPERTYINDEX_EXPRESSION = 9;
	public static $TRIGGER_PROPERTYINDEX_CONDITION = 10;
	public static $TRIGGER_PROPERTYINDEX_ORDER = 11;
	public static $REQTRIGGER_PROPERTYINDEX_ID = 0;
	public static $REQTRIGGER_PROPERTYINDEX_NAME = 1;
	public static $REQTRIGGER_PROPERTYINDEX_DESC = 2;
	public static $REQTRIGGER_PROPERTYINDEX_FTID = 3;
	public static $REQTRIGGER_PROPERTYINDEX_FROMFLNAME = 4;
	public static $REQTRIGGER_PROPERTYINDEX_TOFLNAME = 5;
	public static $REQTRIGGER_PROPERTYINDEX_EXPRESSION = 6;
	public static $REQTRIGGER_PROPERTYINDEX_ORDER = 7;
	// properity fields KEY
	public static $FIELD_PROPERTY_FIELD_OLD_NAME = 'fieldoldname';
	public static $FIELD_PROPERTY_FIELDNAME = 'fieldname';
	public static $FIELD_PROPERTY_ISMOBILEVIEW = 'ismobileview';
	public static $FIELD_PROPERTY_FIELDLBL = 'label';
	public static $FIELD_PROPERTY_LENGTH = 'langth';
	public static $FIELD_PROPERTY_SEARCHTYPE = 'seatchtype';
	public static $FIELD_PROPERTY_FIELDTYPE = 'fieldtype';
	public static $FIELD_PROPERTY_ENABLETYPE = 'enabletype';
	public static $FIELD_PROPERTY_ISGUIFIELD = 'isguifield';
	public static $FIELD_PROPERTY_ISMANDATORY = 'ismandatary';
	public static $FIELD_PROPERTY_ISUNIQUE = 'isunique';
	public static $FIELD_PROPERTY_ISQUICKCREATE = 'isquickcreate';
	public static $FIELD_PROPERTY_ISMASSEDIT = 'ismassedit';
	public static $FIELD_PROPERTY_DEFAULTVAL = 'defaultval';
	public static $FIELD_PROPERTY_DEFAULTVISIBLE = 'defaultvisible';
	public static $FIELD_PROPERTY_FIELDORDER = 'fieldorder';
	public static $FIELD_PROPERTY_ISSYSTEMFIELD = 'issystemfield';
	public static $FIELD_PROPERTY_OPERATIONTYPE = 'operationType';
	public static $FIELD_PROPERTY_ISPRIMARYVALUE_CHANGED = 'isprimarychanged';
	public static $FIELD_PROPERTY_ISFIELD_TYPE_CHANGED = 'isfiedtypechanged';
	public static $FIELD_PROPERTY_LINK_NAME = 'linkname';
	public static $FIELD_PROPERTY_LINK_URL = 'linkurl';
	public static $FIELD_PROPERTY_INSTRUCTION = 'instruction';
	public static $FIELD_PROPERTY_TOOLTIP = 'tooltip';
	public static $FIELD_PROPERTY_ISCONFIGHIDE = 'isconfighide';
	public static $FIELD_PROPERTY_ISVIEWHIDE = 'isviewhide';
	public static $FIELD_PROPERTY_VIEWCOLMINWIDTH = 'viewcolminwidth';
	public static $FIELD_PROPERTY_VIEWCOLMAXWIDTH = 'viewcolmaxwidth';
	public static $FIELD_PROPERTY_VIEWCOLPREFWIDTH = 'viewcolprefwidth';
	public static $FIELD_PROPERTY_REL_MODULENAME = 'relmodulename';
	public static $FIELD_PROPERTY_REL_FORMNAME = 'relformname';
	public static $FIELD_PROPERTY_REL_FIELDNAME = 'relfieldname';
	public static $FIELD_PROPERTY_REL_NTHINSTANCE = 'relnthinstance';
	public static $FIELD_PROPERTY_REL_RELATION = 'relrelation';
	public static $FIELD_PROPERTY_REL_ISDIRECT = 'relisdirect';
	public static $FIELD_PROPERTY_REL_ISEDITABLE = 'reliseditable';
	public static $FIELD_PROPERTY_REL_ISHAVINGMULTIPLETABLE = 'ishavingmultipletable';
	public static $FIELD_PROPERTY_REL_HAVINGFIELDNAME = 'relhavingfield';
	public static $FIELD_PROPERTY_REL_HAVINGFIELDVALUE = 'relhavingvalue';
	public static $FIELD_PROPERTY_REL_MUL_SUB_CONDITIONS = 'mulsubcondition';
	public static $FORM_PROPERTY_CUSTOM_TYPE = 'custom';
	public static $FORM_TYPE = 'formtype';
	public static $FIELD_PROPERTY_ISSEARCH = 'issearch';
	public static $FIELD_PROPERTY_ISDISPLAY = 'isdisplay';
	public static $FIELD_PROPERTY_GROUPNAME = 'groupname';
	public static $FIELD_PROPERTY_ISLABEL_DISPLAY = 'islabeldisplay';
	public static $FIELD_PROPERTY_ISVIEWMANDATORY = 'isviewmandatory';
	public static $FIELD_PROPERTY_ISROLLING_UPDATE = 'isrollingupdate';
	public static $FIELD_PROPERTY_ISCUSTOM_FIELD = 'iscustomfield';
	public static $FIELD_PROPERTY_FIELD_VISIBLE_FOR = 'fieldvisiblefor';
	public static $FIELD_PROPERTY_ISVIEW_NOTE = 'isviewnote';
	public static $FIELD_PROPERTY_ISATTACHMENT = 'isattachment';
	public static $FIELD_PROPERTY_ISSYSTEMFORM = 'issystemform';
	public static $FIELD_PROPERTY_ISEMAILLOG = 'isemailog';
	public static $FIELD_PROPERTY_ISREVIEW = 'isrevisionneeded';
	public static $FIELD_PROPERTY_ISREMAINDER = 'needremainder';
	public static $FIELD_PROPERTY_IS_INVENTORYFORM = 'isinventoryform';
	public static $FIELD_PROPERTY_IS_PORTALFORM = 'isportalform';
	public static $FIELD_PROPERTY_IS_HISTORY_NEEDED = 'ishistoryneeded';
	public static $SCREEN_PROPERTY_IS_APPLICABLE_FOR_MOBILE_DEVICES = 'isapplicableformobiledevice';
	public static $SCREEN_PROPERTY_IS_MAP_VIEW_NEEDED = 'ismapviewneeded';
	public static $SCREEN_PROPERTY_IS_DIS_CONFIG_VIEW_NEEDED = 'isdisconfigviewneeded';
	public static $SCREEN_PROPERTY_MAP_VIEW_LOCATION = 'mapviewlocationfield';
	public static $SCREEN_PROPERTY_MAP_VIEW_IN_TIME = 'mapviewintimefield';
	public static $SCREEN_PROPERTY_MAP_VIEW_OUT_TIME = 'mapviewouttimefield';
	public static $SCREEN_PROPERTY_MAP_VIEW_FILTER = 'mapviewfilterfield';
	public static $SCREEN_PROPERTY_MAP_VIEW_DISPLAY_FIELD = 'mapviewdisplayfield';
	public static $SELFPOPULATE_SHOWLASTRECORD = 'Show last record';
	public static $FIELD_PROPERTY_LEGACY_FIELDNAME = 'legacyfieldname';
	public static $FIELD_PROPERTY_HELP = 'help';
	public static $FIELD_PROPERTY_TOOL_TIP = 'tooltip';
	public static $FIELD_PROPERTY_AUTO_REFRESH = 'autorefresh';
	public static $FIELD_REFERED_IS_LOCAL_REF = "islocalref";
	public static $FIELD_REFERED_IS_REMOTE_REF = "isremoteref";
	public static $FIELD_REFERED_IS_MULTI_REF = "ismultiref";
	public static $FIELD_REFERED_BASE_REF_FIELD = "basereffield";
	public static $FIELD_REFERED_IS_AUTO_SUGGEST = "isautosuggest";
	public static $FIELD_REFERED_FILTER_BY = "filterby";
}
function insertHistoryInformation($con, $obj, $resultArr) {
	// date_default_timezone_set('Asia/Calcutta');
	$username = getUserName ();
	if ($username == '' && isset ( $obj->{'username'} )) {
		$username = $obj->{'username'};
	}
	if ($username == '' && isset ( $obj->{'LoginUser'} )) {
		$username = getUserNameFromMailId ( $con, $obj->{'LoginUser'} );
	}
	$entity = '';
	$appid = $obj->{'APPID'};
	if (isset ( $obj->{'ENTITY'} )) {
		$entity = $obj->{'ENTITY'};
	}
	$entity = trim ( $entity );
	$currenttime = date ( 'Y-m-d H:i:s' );
	$operationType = '';	
	if (isset ( $obj->{OPERATIONTYPE::$KEY} )) {
		$operationType = $obj->{OPERATIONTYPE::$KEY};
	}
	if (! ($entity == 'logout' || $entity == 'BuilderFormAndGroupRequest' || $entity == 'RequestRequest')) {
		if ($operationType == OPERATIONTYPE::$SAVE || $operationType == OPERATIONTYPE::$SAVEHIERACHYVALUE || $operationType == OPERATIONTYPE::$EDIT || $operationType == OPERATIONTYPE::$UPDATEHIERACHYVALUE || $operationType == OPERATIONTYPE::$DELETE || $operationType == OPERATIONTYPE::$LOGIN || $operationType == OPERATIONTYPE::$MASSEDIT || $operationType == "DataSync") {
			$formname = $obj->{OPERATIONTYPE::$FORMNAME};
			$appdbname = DBINFO::$APPDBNAME . $appid;
			$sql = 'select labelname from ' . $appdbname . '.formtable where formname=' . '\'' . $formname . '\'';
			$resultset = getResultArray ( $con, $sql );
			$formlabelname = $resultset [0] [0];
			$modulename = $obj->{OPERATIONTYPE::$MODULENAME};
			if ($modulename != 'Notes' && $modulename != 'Attachments' && $modulename != "") {
				$issync = $obj->{'issync'};
				if (! ($operationType == 'LOGIN' && $issync == 'yes')) {				
					updateUserUsageDetailsTable($con,$obj,$username,$formlabelname,$operationType,$currenttime,$formname,$resultArr);
				}				
			} 
		}
	} else if ($entity == 'logout') {	
		$lastlogintime = $currenttime;
		$emailid = getUserMailId ( $con );
		$prodext = getSaasProductExt ();
		$sql = 'select lastlogindate from ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable where appid=' . '\'' . $appid . '\'' . ' and saasuserid=' . '\'' . $emailid . '\'';
		$resultset = getResultArray ( $con, $sql );
		$lastlogintime = $resultset [0] [0];
		$a1 = explode ( ' ', $lastlogintime );
		$a2 = explode ( ' ', $currenttime );
		$duration = getMyTimeDiff ( $a1 [1], $a2 [1] );
		if (sizeof ( $resultset ) > 0) {
			$sql = 'update ' . DBINFO::$APPDBNAME . '.' . $prodext . 'uservsapptable set lastlogout=' . '\'' . $currenttime . '\'' . ',duration=' . '\'' . $duration . '\'' . ' where appid=' . '\'' . $appid . '\'' . ' and saasuserid=' . '\'' . $emailid . '\'';
			$result = execSQL ( $con, $sql );
		}
		unset ( $_SESSION [getAppId () . 'username'] );
		unset ( $_SESSION ['appid'] );
		session_destroy ();	
	}
}
function getCircleFeedsTemplateByFormname($con, $formname, $id, $username, $operationtype, $subid, $subname) {
	$circlefeeds = "";
	$sql = "select * from circletemplate where formname = '$formname'";
	$resultset = getResultArray ( $con, $sql );
	if (sizeof ( $resultset ) > 0) {
		$subtablenames = $resultset [0] [3];
		$template = $resultset [0] [2];
		$circlefeeds = $template;
		$circlefeeds = str_replace ( "#Action#", $operationtype, $circlefeeds );
		$sql = "SELECT label,name,type FROM formfieldtable where formname = '$formname' order by fieldorder";
		$fieldarr = getResultArray ( $con, $sql );
		for($i = 0; $i < sizeof ( $fieldarr ); $i ++) {
			$ffieldsysntax = "$" . $fieldarr [$i] [0] . "$";
			if (strpos ( $circlefeeds, $ffieldsysntax ) === 0 || strpos ( $circlefeeds, $ffieldsysntax )) {
				$fieldname = $fieldarr [$i] [1];
				$isformhistoryuserdetails = false;
				$fieldtype = $fieldarr [$i] [2];
				if ($fieldtype == FieldType::$FORM_HISTORY) {
					if ($fieldname == "table_6_0_createdusername") {
						$fieldname = "table_6_0_table_6_id";
						$isformhistoryuserdetails = true;
					} else if ($fieldname == "table_6_1_updatedusername") {
						$fieldname = "table_6_1_table_6_id";
						$isformhistoryuserdetails = true;
					} else if ($fieldname == "table_6_2_viewedusername") {
						$fieldname = "table_6_2_table_6_id";
						$isformhistoryuserdetails = true;
					}
				}
				$sql = " select $fieldname from $formname" . "_frm where $formname" . "_id = '$id'";
				$result = getResultArray ( $con, $sql );
				$replace = $result [0] [0];
				if ($isformhistoryuserdetails) {
					$sql = "select Name from table_6_frm where table_6_id = '$replace'";
					$result = getResultArray ( $con, $sql );
					$replace = $result [0] [0];
				}
				if ($fieldtype == "Text Area") {
					$replace = str_replace ( "\n", "<br>", $replace );
				}
				$circlefeeds = str_replace ( $ffieldsysntax, $replace, $circlefeeds );
			}
		}
		preg_match_all ( "/\[@[@a-zA-Z0-9._ -()%\/@#$&]+@\]/", $circlefeeds, $matches );
		$msize = sizeof ( $matches );
		for($mi = 0; $mi < $msize; $mi ++) {
			$toks = $matches [$mi];
			$numt = sizeof ( $toks );
			for($ti = 0; $ti < $numt; $ti ++) {
				$token = $toks [$ti];
				$toklen = strlen ( $token );
				$tokendetail = substr ( $token, 2, $toklen - 4 );
				$fielddetail = stringSplitByDelimit ( $tokendetail, "@" );
				$subtablenamelabel = $fielddetail [0];
				$subtablename = getFormNamefromLable ( $con, $subtablenamelabel );
				$subfield = getFieldNameByLabel ( $con, $subtablename, $fielddetail [1] );
				if ($subtablename == $subname) {
					$sql = "select $subfield from " . $subtablename . "_frm where " . $subtablename . "_id = '$subid' order by createdon desc";
				} else {
					$sql = "select nthinstance from formrelationtable where mtable = '$formname' and stable = '$subtablename'";
					$result = getResultArray ( $con, $sql );
					$nthinstance = $result [0] [0];
					$sql = "select $subfield from " . $subtablename . "_frm where " . $subtablename . "_id in (select " . $subtablename . "_id from $nthinstance" . $formname . "_" . $subtablename . "_frm where $formname" . "_id = '$id') order by createdon desc";
				}
				$subdblist = getResultArray ( $con, $sql );
				$subfieldval = $subdblist [0] [0];
				$circlefeeds = str_replace ( $token, $subfieldval, $circlefeeds );
			}
		}
	}
	return $circlefeeds;
}
function insertSubtableHistoryDetails($con, $obj) {
	$username = getUserName ();
	$appid = $obj->{'APPID'};
	$currenttime = date ( 'Y-m-d H:i:s' );
	$operationType = OPERATIONTYPE::$EDIT;
	$bformname = $obj->{'baseformname'};
	$bformid = $obj->{'baseformid'};
	$sformname = $obj->{'subformname'};
	$sformid = $obj->{'subformid'};
	$modulename = getModulename ( $con, $bformname );
	$sql = "select * from circletemplate where formname = '$bformname'";
	$resultset = getResultArray ( $con, $sql );
	if (sizeof ( $resultset ) > 0) {
		$subtablenames = $resultset [0] [3];
		$sublist = stringSplitByDelimit ( $subtablenames, "," );
		for($i = 0; $i < sizeof ( $sublist ); $i ++) {
			$subname = $sublist [$i];
			if ($subname == $sformname) {
				$circlefeeds = getCircleFeedsTemplateByFormname ( $con, $bformname, $bformid, $username, $operationType, $sformid, $sformname );
				$sql = 'insert into entityhistory values(' . '\'' . $username . '\'' . ',' . '\'' . $modulename . '\'' . ',' . '\'' . $bformname . '\'' . ',' . '\'' . $operationType . '\'' . ',' . '\'' . $bformid . '\'' . ',' . '\'' . $currenttime . '\'' . ',\'' . $circlefeeds . '\');';
				$count = execSQL ( $con, $sql );
				break;
			}
		}
	}
}
function getMyTimeDiff($t1, $t2) {
	$a1 = explode ( ':', $t1 );
	$a2 = explode ( ':', $t2 );
	$time1 = (($a1 [0] * 60 * 60) + ($a1 [1] * 60) + ($a1 [2]));
	$time2 = (($a2 [0] * 60 * 60) + ($a2 [1] * 60) + ($a2 [2]));
	$diff = abs ( $time1 - $time2 );
	$hours = floor ( $diff / (60 * 60) );
	$mins = floor ( ($diff - ($hours * 60 * 60)) / (60) );
	$secs = floor ( ($diff - (($hours * 60 * 60) + ($mins * 60))) );
	$result = $hours . ':' . $mins . ':' . $secs;
	return $result;
}
function stringSplit($str) {
	return stringSplitByDelimit ( $str, ' \n\t' );
}
function stringSplitByDelimit($str, $delimit) {
	$ret = array ();
	$tok = strtok ( $str, $delimit );
	while ( $tok !== false ) {
		$ret [] = $tok;
		$tok = strtok ( $delimit );
	}
	return $ret;
}
function getUniqueValuesInArray($listvaluearr) {
	$num = sizeof ( $listvaluearr );
	$retarray = array ();
	for($i = 0; $i < $num; $i ++) {
		$val = $listvaluearr [$i];
		$retarray [$val] = $val;
	}
	return array_keys ( $retarray );
}
function getStringFromArray($listvaluearr) {
	$num = sizeof ( $listvaluearr );
	$retstr = '';
	for($i = 0; $i < $num; $i ++) {
		$val = $listvaluearr [$i];
		$retstr .= $val . ',';
	}
	return $retstr;
}
function getThirdPartyConnection($con, $formname) {
	$sql = 'select * from legacyinformation where formname=' . '\'' . $formname . '\'';
	$dbrows = getResultArray ( $con, $sql );
	$legacydetail = $dbrows [0];
	$databasetype = $legacydetail [1];
	$hostname = $legacydetail [2];
	$username = $legacydetail [3];
	$passwrd = $legacydetail [4];
	$schemaname = $legacydetail [5];
	$lformname = $legacydetail [6];
	DBINFO::$DBTYPE = 'mssql';
	THIRDPARTYDBINFO::$HOSTNAME = $hostname;
	THIRDPARTYDBINFO::$DBNAME = $schemaname;
	THIRDPARTYDBINFO::$DBUSER = $username;
	THIRDPARTYDBINFO::$DBPWD = $passwrd;
	THIRDPARTYDBINFO::$DBTYPE = $databasetype;
	$thireparcon = new PDOConnection ( $schemaname );
	if ($thireparcon) {
		$tpcon = $thireparcon->getConnection ();
		if ($tpcon == null) {
			throw new Exception ( $thireparcon->getDBErrorMsg () );
		}
	} else {
		throw new Exception ( 'Not able to connect to DB' );
	}
	$condetails = array ();
	$condetails [] = $tpcon;
	$condetails [] = $legacydetail;
	return $condetails;
}
class PDOConnection extends PDO {
	private $conn = null;
	private $dberror = '';
	protected $hasActiveTransaction = false;
	public function __construct($appschemaname) {
		try {
			$dbconn = null;
			if (! class_exists ( 'config.php' )) {
				require_once ('config.php');
			}
			switch (DBINFO::$DBTYPE) {
				case 'mysql' :
					if ($appschemaname == '')
						DBINFO::$DBNAME = DBINFO::$DBNAME = DBINFO::$APPDBNAME;
					else
						DBINFO::$DBNAME = DBINFO::$DBNAME = DBINFO::$APPDBNAME . $appschemaname;
					$dbhost = getDBHost ();
					$dbname = DBINFO::$DBNAME;
					$dbuser = getDBUser ();
					$dbpass = getDBPass ();
					$dbconn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname;
					break;
				
				case 'postgresql' :
					$dbconn = 'pgsql:host=' . $host . ' dbname=' . $dbname;
					break;
				case 'mssql' :
					$dbhost = THIRDPARTYDBINFO::$HOSTNAME;
					$dbname = THIRDPARTYDBINFO::$DBNAME;
					$dbuser = THIRDPARTYDBINFO::$DBUSER;
					$dbpass = THIRDPARTYDBINFO::$DBPWD;
					$dbconn = 'mssql:dbname=' . $dbname . ';host=' . $dbhost;
					// $dbconn = 'mssql:host=' . $dbhost . ' dbname=' . $dbname;
					break;
			}
			$this->conn = new PDO ( $dbconn, $dbuser, $dbpass, array (
					PDO::ATTR_PERSISTENT => false 
			) );
			$this->conn->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( Exception $e ) {
			$error = $e->getMessage ();
			displaylogmsg ( 'DB Error : ' . $error );
			if (strpos ( $error, '1049' ) > 0) {
				$this->dberror = 'DB Error: ' . $dbname . ' schema is not found';
			} else if (strpos ( $error, '1045' ) > 0) {
				$this->dberror = 'DB Error: Password may be wrong for user ' . $dbuser;
			} else {
				$this->dberror = 'DB Error: ' . $e->getMessage ();
			}
			setError ( $this->dberror );
		}
	}
	public function getDBErrorMsg() {
		return $this->dberror;
	}
	public function getConnection() {
		return $this->conn;
	}
	function beginTransaction() {
		if ($this->hasActiveTransaction) {
			return false;
		} else {
			$this->hasActiveTransaction = parent::beginTransaction ();
			return $this->hasActiveTransaction;
		}
	}
	function commit() {
		parent::commit ();
		$this->hasActiveTransaction = false;
	}
	function rollback() {
		parent::rollback ();
		$this->hasActiveTransaction = false;
	}
}
class RemotePDOConnection extends PDO {
	private $conn = null;
	private $dberror = '';
	protected $hasActiveTransaction = false;
	public function __construct($dbtype, $dbhost, $dbuser, $dbpass, $dbname) {
		try {
			$dbconn = null;
			switch ($dbtype) {
				case 'Mysql' :
					$dbconn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname;
					break;
				case 'postgresql' :
					$dbconn = 'pgsql:host=' . $host . ' dbname=' . $dbname;
					break;
				case 'Mssql' :
					$dbconn = 'mssql:dbname=' . $dbname . ';host=' . $dbhost;
					// $dbconn = 'mssql:host=' . $dbhost . ' dbname=' . $dbname;
					break;
			}
			$this->conn = new PDO ( $dbconn, $dbuser, $dbpass, array (
					PDO::ATTR_PERSISTENT => false 
			) );
			$this->conn->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( Exception $e ) {
			$error = $e->getMessage ();
			displaylogmsg ( 'DB Error : ' . $error );
			if (strpos ( $error, '1049' ) > 0) {
				$this->dberror = 'DB Error: ' . $dbname . ' schema is not found';
			} else if (strpos ( $error, '1045' ) > 0) {
				$this->dberror = 'DB Error: Password may be wrong for user ' . $dbuser;
			} else {
				$this->dberror = 'DB Error: ' . $e->getMessage ();
			}
			setError ( $this->dberror );
		}
	}
	public function getDBErrorMsg() {
		return $this->dberror;
	}
	public function getConnection() {
		return $this->conn;
	}
	function beginTransaction() {
		if ($this->hasActiveTransaction) {
			return false;
		} else {
			$this->hasActiveTransaction = parent::beginTransaction ();
			return $this->hasActiveTransaction;
		}
	}
	function commit() {
		parent::commit ();
		$this->hasActiveTransaction = false;
	}
	function rollback() {
		parent::rollback ();
		$this->hasActiveTransaction = false;
	}
}
class SaasInfo {
	private $_username = '';
	private $_appid = '';
	public function __construct($dbrow) {
		$this->_username = $dbrow [SAASDETAILS::$USERNAME];
		$this->_appid = $dbrow [SAASDETAILS::$APPID];
	}
	public function getAppId() {
		return $this->_appid;
	}
	public function getUserNameame() {
		return $this->_username;
	}
}
class DateDuration {
	private $_startdate = '';
	private $_enddate = '';
	private $_type = 0;
	private $_typestr = 'Day ';
	public function __construct($type, $startdate, $enddate) {
		$this->_type = $type;
		$this->_startdate = $startdate;
		$this->_enddate = $enddate;
		if ($type == 3) {
			$this_typestr = 'Month ';
		} else if ($type == 2) {
			$this_typestr = 'Week ';
		} else {
			$this_typestr = 'Day ';
		}
	}
	public function getStartDate() {
		return $this->_startdate;
	}
	public function getEndDate() {
		return $this->_enddate;
	}
	public function getType() {
		return $this->_type;
	}
	public function getStringType() {
		return $this->_typestr;
	}
}
function getCategoryExtTableFormLablenames($con) {
	$formlablenames = array ();
	$alisenames = array ();
	$formnameandlablenames = prepareInventoryFormnameHash ( $con );
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PO_LINEITEM];
	$alisenames [] = 'PO';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SO_LINEITEM];
	$alisenames [] = 'SO';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$QUOTE_LINEITEM];
	$alisenames [] = 'Quote';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$STOCKIN_LINEITEM];
	$alisenames [] = 'Stock In';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$STOCKOUT_LINEITEM];
	$alisenames [] = 'Stock Out';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$MREJ_LINEITEM];
	$alisenames [] = 'MetRej';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SPAYMENT_LINEITEM];
	$alisenames [] = 'SP';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SR_LINEITEM];
	$alisenames [] = 'SR';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$MRN_LINEITEM];
	$alisenames [] = 'MRN';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PINVOICE_LINEITEM];
	$alisenames [] = 'PI';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$SINVOICE_LINEITEM];
	$alisenames [] = 'SI';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PERFINVOICE_LINEITEM];
	$alisenames [] = 'PerInvoice';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PPAYMENT_LINEITEM];
	$alisenames [] = 'PP';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PR_LINEITEM];
	$alisenames [] = 'PReturn';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$PRQ_LINEITEM];
	$alisenames [] = 'PRequest';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$DC_LINEITEM];
	$alisenames [] = 'DC';
	$formlablenames [] = $formnameandlablenames [INVENTORY_ENTITYLABELNAME::$STOCK_DETAILS];
	$alisenames [] = 'Stock';
	
	$catdetails = array ();
	$catdetails [] = $formlablenames;
	$catdetails [] = $alisenames;
	return $catdetails;
}
class INVENTORY_ENTITYLABELNAME {
	public static $UOMMASTER = 'UOM Master';
	public static $UOMDETAILS = 'UOM Details';
	public static $DISCOUNTMASTER = 'Discount Master';
	public static $DISCOUNTDETAILS = 'Discount Details';
	public static $TAXMASTER = 'Tax Master';
	public static $PRODUCTCATEGORY = 'Product Category';
	public static $PRODUCTCATEGORYDETAILS = 'Category Details';
	public static $PRODUCT = 'Product';
	public static $VENDOR = 'Vendor';
	public static $PRQ = 'Purchase Request';
	public static $PRQ_LINEITEM = 'PR Line Item';
	public static $PO = 'Purchase Order';
	public static $PO_LINEITEM = 'PO Product Line Item';
	public static $MRN = 'Material Receipt Note';
	public static $MRN_LINEITEM = 'Material Receipt Line Item';
	public static $PR = 'Purchase Return';
	public static $PR_LINEITEM = 'Purchase Return Line Item';
	public static $PINVOICE = 'Purchase Invoice';
	public static $PINVOICE_LINEITEM = 'Purchase Invoice Line Item';
	public static $PPAYMENT = 'Purchase Payment Receipt';
	public static $PPAYMENT_LINEITEM = 'Purchase Payment Receipt Line Item';
	public static $QUOTE = 'Quotation';
	public static $QUOTE_LINEITEM = 'Quotation Line Item';
	public static $SO = 'Sales Order';
	public static $SO_LINEITEM = 'SO Product Line Item';
	public static $SINVOICE = 'Sales Invoice';
	public static $SINVOICE_LINEITEM = 'Sales Invoice Line Item';
	public static $PERFINVOICE = 'Performa Invoice';
	public static $PERFINVOICE_LINEITEM = 'Performa Invoice Line Item';
	public static $DC = 'Delivery Chalan';
	public static $DC_LINEITEM = 'DC Line Item';
	public static $SR = 'Sales Return';
	public static $SR_LINEITEM = 'Sales Return Line Item';
	public static $SPAYMENT = 'Sales Payment Receipt';
	public static $SPAYMENT_LINEITEM = 'Sales Payment Receipt Line Item';
	public static $STOCKIN = 'Material In';
	public static $STOCKIN_LINEITEM = 'Material In Line Item';
	public static $STOCKOUT = 'Material Out';
	public static $STOCKOUT_LINEITEM = 'Material Out Line Item';
	public static $MREJ = 'Material Rejection';
	public static $MREJ_LINEITEM = 'Material Rejection Line Item';
	public static $TERMSANDCOND = 'Terms and Conditions';
	public static $OINPUTFORM = 'Order Input Form';
	public static $IINPUTFORM = 'Invoice Input Form';
	public static $DCINPUTFORM = 'DC Input Form';
	public static $OPENING_STOCK = 'Opening Stock';
	public static $OPENING_STOCK_DETAILS = 'Opening Stock Details';
	public static $STOCK_DETAILS = 'Stock Details';
}
class INVENTORYTYPE {
	public static $GENERAL = 'General';
	public static $SERIAL = 'Serial';
}
class INVENTORY_TRIGGER_VALUES {
	public static $PAID = 'Paid';
	public static $PARTIAL_PAID = 'Partial Paid';
	public static $OPEN = 'Open';
	public static $DELIVERED = 'Delivered';
	public static $PARTIAL_DELIVERED = 'Partial Delivered';
	public static $M_OPEN = 'Open';
}
class INVENTORYFIELDS {
	public static $FIELDS_PURCHASE_PRICE = 'Purchase_Price';
	public static $FIELDS_UOM = 'UOM';
	public static $FIELDS_PUR_TAX = 'Purchase_Tax';
	public static $FIELDS_PUR_TAX_AMT = 'Purchase_Tax_Amount';
	public static $FIELDS_SAL_PRICE = 'Sales_Price';
	public static $FIELDS_SAL_TAX = 'Sales_Tax';
	public static $FIELDS_SAL_TAX_AMT = 'Sales_Tax_Amount';
	public static $FIELDS_DISCOUNT = 'Discount';
	public static $FIELDS_DISCOUNT_RATE = 'Discount_Rate';
	public static $FIELDS_QTY = 'Qty';
	public static $FIELDS_TOT_AMT = 'Total_Amount';
}
class INVENTORY_CONVERT_BUTTON_LABEL {
	public static $CONVERT_PO = 'Convert PO';
	public static $CONVERT_MRN = 'Convert MRN';
	public static $CONVERT_PI = 'Convert PI';
	public static $CONVERT_PPAYMENT = 'Convert PP';
	public static $CONVERT_PR = 'Convert PR';
	public static $CONVERT_SO = 'Convert SO';
	public static $CONVERT_DC = 'Convert DC';
	public static $CONVERT_PERINVOICE = 'Convert Performa Inv';
	public static $CONVERT_INVOICE = 'Convert Invice';
	public static $CONVERT_SPR = 'Convert SP';
	public static $CONVERT_SR = 'Convert SR';
}
class FFA_OPERATION {
	public static $MODULENAME = 'Calendar';
	public static $FORMNAME = 'Field Event';
}
class CALL_LOG_INFO {
	public static $MODULENAME = 'Activity';
	public static $DEFAULTMODULENAME = 'Calendar';
	public static $FORMNAME = 'Call Log';
	public static $REFERENCEMODULE = 'Sales';
	public static $REFERENCELEAD = 'Lead';
	public static $REFERENCECONTACT = 'Contact';
}
class DB_ACTION {
	public static $INSERT = 'insert';
	public static $UPDATE = 'update';
	public static $DELETE = 'delete';
	public static $SUB_TABLE_DELETE = 'subtabledelete';
	public static $SUB_TABLE_INSERT = 'subtableinsert';
	public static $SUB_TABLE_UPDATE = 'subtableupdate';
	public static $PROFILE_INSERT = 'profileinsert';
	public static $PROFILE_UPDATE = 'profileupdate';
	public static $PROFILE_DELETE = 'profiledelete';
	public static $TEMPLATE = 'template';
}
class SYNC_ACTION {
	public static $UPDATE = 'update';
	public static $STRUC_INSERT = 'struc_insert';
	public static $STRUC_UPDATE = 'struc_update';
	public static $STRUC_DELETE = 'struc_delete';
	public static $STRUC_FIELD_DELETE = 'struc_field_delete';
	public static $STRUC_FORM_DELETE = 'struc_form_delete';
	public static $MAX_SYNC_TABLE_DATA_LIMIT = '500000';
}
class GENERAL_SETTINGS {
	public static $IS_MOBILE_CLIENT_ENABLED = "IS_MOBILE_CLIENT_ENABLED";
	public static $IS_GPS_ENABLED = "IS_GPS_ENABLED";
	public static $IS_NEED_UNREAD_REC_COUNT = "IS_NEED_UNREAD_REC_COUNT";
	public static $IS_NEED_KM_CALC = "IS_NEED_KM_CALC";
	public static $DEFAULT_MODE = "DEFAULT_MODE";
	public static $SYNC_SETTINGS = "SYNC_SETTINGS";
	public static $IS_REPORTING_TO_BASED_DS = "IS_REPORTING_TO_BASED_DS";
	public static $IS_MOBILE_DB_DOWNLOAD_ENABLED = "IS_MOBILE_DB_DOWNLOAD_ENABLED";
	public static $MOBILE_HOME_SCREEN_FORM_PAGE = "MOBILE_HOME_SCREEN_FORM_PAGE";
	public static $MOBILE_HOME_SCREEN_FORM_TEMPLATES = "MOBILE_HOME_SCREEN_FORM_TEMPLATES";
}
class CRATIOMYSQL {
	public static $FORBIDDONWORD = array (
			'ACCESSIBLE',
			'ALTER',
			'AS',
			'BEFORE',
			'BINARY',
			'BY',
			'CASE',
			'CHARACTER',
			'COLUMN',
			'CONTINUE',
			'CROSS',
			'CURRENT_TIMESTAMP',
			'DATABASE',
			'DAY_MICROSECOND',
			'DEC',
			'DEFAULT',
			'DESC',
			'DISTINCT',
			'DOUBLE',
			'EACH',
			'ENCLOSED',
			'EXIT',
			'FETCH',
			'FLOAT8',
			'FOREIGN',
			'GRANT',
			'HIGH_PRIORITY',
			'HOUR_SECOND',
			'IN',
			'INNER',
			'INSERT',
			'INT2',
			'INT8',
			'INTO',
			'JOIN',
			'KILL',
			'LEFT',
			'LINEAR',
			'LOCALTIME',
			'LONG',
			'LOOP',
			'MATCH',
			'MEDIUMTEXT',
			'MINUTE_SECOND',
			'NATURAL',
			'NULL',
			'OPTIMIZE',
			'OR',
			'OUTER',
			'PRIMARY',
			'RANGE',
			'READ_WRITE',
			'REGEXP',
			'REPEAT',
			'RESTRICT',
			'RIGHT',
			'SCHEMAS',
			'SENSITIVE',
			'SHOW',
			'SPECIFIC',
			'SQLSTATE',
			'SQL_CALC_FOUND_ROWS',
			'STARTING',
			'TERMINATED',
			'TINYINT',
			'TRAILING',
			'UNDO',
			'UNLOCK',
			'USAGE',
			'UTC_DATE',
			'VALUES',
			'VARCHARACTER',
			'WHERE',
			'WRITE',
			'ZEROFILL',
			'ALL',
			'AND',
			'ASENSITIVE',
			'BIGINT',
			'BOTH',
			'CASCADE',
			'CHAR',
			'COLLATE',
			'CONSTRAINT',
			'CREATE',
			'CURRENT_TIME',
			'CURSOR',
			'DAY_HOUR',
			'DAY_SECOND',
			'DECLARE',
			'DELETE',
			'DETERMINISTIC',
			'DIV',
			'DUAL',
			'ELSEIF',
			'EXISTS',
			'FALSE',
			'FLOAT4',
			'FORCE',
			'FULLTEXT',
			'HAVING',
			'HOUR_MINUTE',
			'IGNORE',
			'INFILE',
			'INSENSITIVE',
			'INT1',
			'INT4',
			'INTERVAL',
			'ITERATE',
			'KEYS',
			'LEAVE',
			'LIMIT',
			'LOAD',
			'LOCK',
			'LONGTEXT',
			'MASTER_SSL_VERIFY_SERVER_CERT',
			'MEDIUMINT',
			'MINUTE_MICROSECOND',
			'MODIFIES',
			'NO_WRITE_TO_BINLOG',
			'ON',
			'OPTIONALLY',
			'OUT',
			'PRECISION',
			'PURGE',
			'READS',
			'REFERENCES',
			'RENAME',
			'REQUIRE',
			'REVOKE',
			'SCHEMA',
			'SELECT',
			'SET',
			'SPATIAL',
			'SQLEXCEPTION',
			'SQL_BIG_RESULT',
			'SSL',
			'TABLE',
			'TINYBLOB',
			'TO',
			'TRUE',
			'UNIQUE',
			'UPDATE',
			'USING',
			'UTC_TIMESTAMP',
			'VARCHAR',
			'WHEN',
			'WITH',
			'YEAR_MONTH',
			'ADD',
			'ANALYZE',
			'ASC',
			'BETWEEN',
			'BLOB',
			'CALL',
			'CHANGE',
			'CHECK',
			'CONDITION',
			'CONVERT',
			'CURRENT_DATE',
			'CURRENT_USER',
			'DATABASES',
			'DAY_MINUTE',
			'DECIMAL',
			'DELAYED',
			'DESCRIBE',
			'DISTINCTROW',
			'DROP',
			'ELSE',
			'ESCAPED',
			'EXPLAIN',
			'FLOAT',
			'FOR',
			'FROM',
			'GROUP',
			'HOUR_MICROSECOND',
			'IF',
			'INDEX',
			'INOUT',
			'INT',
			'INT3',
			'INTEGER',
			'IS',
			'KEY',
			'LEADING',
			'LIKE',
			'LINES',
			'LOCALTIMESTAMP',
			'LONGBLOB',
			'LOW_PRIORITY',
			'MEDIUMBLOB',
			'MIDDLEINT',
			'MOD',
			'NOT',
			'NUMERIC',
			'OPTION',
			'ORDER',
			'OUTFILE',
			'PROCEDURE',
			'READ',
			'REAL',
			'RELEASE',
			'REPLACE',
			'RETURN',
			'RLIKE',
			'SECOND_MICROSECOND',
			'SEPARATOR',
			'SMALLINT',
			'SQL',
			'SQLWARNING',
			'SQL_SMALL_RESULT',
			'STRAIGHT_JOIN',
			'THEN',
			'TINYTEXT',
			'TRIGGER',
			'UNION',
			'UNSIGNED',
			'USE',
			'UTC_TIME',
			'VARBINARY',
			'VARYING',
			'WHILE',
			'XOR' 
	);
}
class AUTOPUNCH {
	public static $AUTO_PUNCH_ENTITY = 'table_41';
}
class FieldName {
	public static $ORGANIZATION_NAME = 'Organization_Name';
	public static $DISPLAY_NAME = 'Display_Name';
}
class PDORemoteConnection extends PDO {
	private $conn = null;
	private $dberror = '';
	protected $hasActiveTransaction = false;
	public function __construct($dbtype, $dbhost, $dbport, $dbuser, $dbpwd, $dbname) {
		$dbtype = strtolower ( $dbtype );
		try {
			$dbconn = null;
			if (! class_exists ( 'config.php' )) {
				require_once ('config.php');
			}
			switch ($dbtype) {
				case 'mysql' :
					$dbconn = 'mysql:host=' . $dbhost . ';dbname=' . $dbname;
					break;
			}
			$this->conn = new PDO ( $dbconn, $dbuser, $dbpwd, array (
					PDO::ATTR_PERSISTENT => false 
			) );
			$this->conn->setAttribute ( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true );
			$this->conn->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( Exception $e ) {
			$error = $e->getMessage ();
			displaylogmsg ( 'DB Error : ' . $error );
			if (strpos ( $error, '1049' ) > 0) {
				$this->dberror = 'DB Error: ' . $dbname . ' schema is not found';
			} else if (strpos ( $error, '1045' ) > 0) {
				$this->dberror = 'DB Error: Password may be wrong for user ' . $dbuser;
			} else {
				$this->dberror = 'DB Error: ' . $e->getMessage ();
			}
			setError ( $this->dberror );
		}
	}
	public function getDBErrorMsg() {
		return $this->dberror;
	}
	public function getConnection() {
		return $this->conn;
	}
	function beginTransaction() {
		if ($this->hasActiveTransaction) {
			return false;
		} else {
			$this->hasActiveTransaction = parent::beginTransaction ();
			return $this->hasActiveTransaction;
		}
	}
	function commit() {
		parent::commit ();
		$this->hasActiveTransaction = false;
	}
	function rollback() {
		parent::rollback ();
		$this->hasActiveTransaction = false;
	}
}
function encryptor($action, $string) {
	$output = false;
	
	$encrypt_method = "AES-256-CBC";
	// pls set your unique hashing key
	$secret_key = 'cratio';
	$secret_iv = 'cratio123';
	
	// hash
	$key = hash ( 'sha256', $secret_key );
	
	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr ( hash ( 'sha256', $secret_iv ), 0, 16 );
	
	// do the encyption given text/string/number
	if ($action == 'encrypt') {
		$output = openssl_encrypt ( $string, $encrypt_method, $key, $iv );
		$output = base64_encode ( $output );
	} else if ($action == 'decrypt') {
		// decrypt the given text/string/number
		$output = openssl_decrypt ( base64_decode ( $string ), $encrypt_method, $key, $iv );
	}
	
	return $output;
}
function updateUserUsageDetailsTable($con,$obj,$username,$formlabelname,$operationType,$currenttime,$formname,$resultArr){
if(isset($obj->{'requestfrom'})){
$device=$obj->{'requestfrom'};	
}
if($device == 'Calendar'){
$device='Web';	
}
if($device != 'Web'){
$device="Mobile";	
}
if(isset($obj->{'locationforsync'})){
$location = $obj->{'locationforsync'};
}else{
$location=getClientIP ();//getGEOLocationByIP ();
}
$datearr=explode(" ", $currenttime);
$date=$datearr[0];
$time=$datearr[1];
$dayarr=explode("-", $date);
$timearr=explode(":", $time);
if($dayarr[2] == 1 && $timearr[0] == 1){
$date = new DateTime('NOW');
			$last30daysinterval = new DateInterval('P30D');
		    $date -> sub($last30daysinterval);
		    $startdate = $date -> format('Y-m-d H:i:s');
$sql="delete from entityhistory where updatedtime < '$startdate'";
$result = execSQL($con, $sql);	
}
$detail="";
if($operationType == "SAVE" || $operationType=="EDIT"){
if(isset($obj->{'auditinfo'})){
$auditinfo = $obj->{'auditinfo'};	
$displaystr=$auditinfo->{'displaystring'};
if($displaystr != ""){
$detail=$displaystr."@|@".$resultArr[0];	
}
}
}else if($operationType == "DELETE" || $operationType=="MASSEDIT"){
if(isset($obj->{'auditinfo'})){
$auditinfo = $obj->{'auditinfo'};	
$detail=$auditinfo->{'displaystring'};
}	
}
else if($operationType == "IMPORT"){
$created = $obj->{'created'};	
$updated=$obj->{'updated'};
		
	if($created > 0){
		$detail=$created ." "."Created";
	}
	
	if($updated > 0){
		if($created > 0){
		$detail.=",";
	}
		$detail.=$updated ." "."Updated";
	}
}
$sql="insert into entityhistory values('$username','$formname','$formlabelname','$operationType','$detail','$currenttime','$location','$device');";
$result = execSQL($con, $sql);
if(VERSION::$MINOR >= 537){
$actiondetails=$formlabelname."/".$operationType;
$sql="update table_6_frm set Last_Used_Device='$device',Last_Used_Form='$actiondetails',Last_Used_Time='$currenttime',Last_Used_Location='$location' where Name='$username';";
$result = execSQL($con, $sql);
}	
}
?>